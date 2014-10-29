<?
if (class_exists('member_grp', false)) return;

class member_grp {

	var $ruleset = array();
	var $prevent = false;

	var $member = null;
	var $m_id = null;
	var $m_no = null;

	var $db = null;
	var $queue = null;
	var $work = null;

	function _microtime() {	// (from php.net)

		list($usec, $sec) = explode(" ", microtime());
		return ((float)$usec + (float)$sec);

	}

	function member_grp() {

		$cfg = dirname(__FILE__).'/../conf/config.member_group.php';
		if (is_file($cfg)) {
			include($cfg);
			$this->ruleset = & $member_grp_ruleset;
		}
		else {
			$this->ruleset = array(
				'automaticFl' => '',
				'apprSystem' => '',
				'apprPointTitle' => '',
				'apprPointLabel' => '',
				'apprPointOrderPriceUnit' => '',
				'apprPointOrderPricePoint' => '',
				'apprPointOrderRepeatPoint' => '',
				'apprPointReviewRepeatPoint' => '',
				'apprPointLoginRepeatPoint' => '',
				'calcPeriodFl' => '',
				'calcPeriodBegin' => '',
				'calcPeriodMonth' => '',
				'calcCycleMonth' => '',
				'calcCycleDay' => '',
				'calcKeep' => ''
			);

			$this->prevent = true;
		}

		$this->now = time();

		$this->db = & $GLOBALS['db'];

		$this->_i_am_updated();
	}


	function _i_am_updated() {

		$_tpl = & $GLOBALS['tpl'];

		if (!is_object($_tpl)) return;

		if ($_SESSION['sess']['m_no'] && ($log = $this->db->fetch("SELECT * FROM ".GD_MEMBER_GRP_CHANGED_LOG." WHERE m_no = ".$_SESSION['sess']['m_no']." AND notified = 0",1)) !== false) {
			$_tpl->assign('useMyLevelLayerBox', 'y');
		}
		else {
			$_tpl->assign('useMyLevelLayerBox', 'n');
		}
	}


	function checkUpdate() {

		if ($this->ruleset['automaticFl'] != 'y' || $this->prevent === true) return;

		// ���� ������
		$row = $this->db->fetch("SELECT MAX(last_work) AS last_work FROM ".GD_MEMBER_GRP_SCHEDULE."",1);

		if (! $row['last_work']) {
			return $this->_setWork();
		}

		// ���� ���ų����. (�ش� ���� ���� ������ �׳� ���Ϸ�)
		//*/
		$last_work = strtotime($row['last_work']);

		$_t = strtotime('+'.$this->ruleset['calcCycleMonth'].' month' ,$last_work);
		$_d = date('t' ,$_t);
		$next_work = strtotime(date('Y-m',$_t).'-'.($this->ruleset['calcCycleDay'] > $_d ? $_d : $this->ruleset['calcCycleDay']));
		/*
		// �� �ڵ尡 0.0001 �� ���� �� ����...
		$date = new DateTime($row['last_work']);
		$date->modify('+'.$this->ruleset['calcCycleMonth'].' month');
		$_y =  $date->format('Y');
		$_m =  $date->format('m');
		$_t =  $date->format('t');
		$date->setDate( $_y , $_m , ($this->ruleset['calcCycleDay'] > $_t ? $_t : $this->ruleset['calcCycleDay']) );
		$next_work = strtotime($date->format('Y-m-d'));
		*/

		if ($this->now >= $next_work) {
			$this->_setWork();
		}

	}

	function execUpdate($force = false) {

		if ($this->prevent === true) return false;

		if ($force === true && $this->_setQueue() === true) {
			if (($this->work = $this->db->fetch("SELECT * FROM ".GD_MEMBER_GRP_SCHEDULE." WHERE excuted = 0",1)) === false) {
				$this->work['last_work'] = date('Y-m-d H:i:s',$this->now);	// ���� �� or ���� ����� ���� �������� ����� ����.
			}
			$this->_go();
			return true;
		}

		if (($this->work = $this->db->fetch("SELECT * FROM ".GD_MEMBER_GRP_SCHEDULE." WHERE excuted = 0",1)) === false) return;	// 2���� �и����� �����..

		if ($this->_setQueue()) {
			$this->_go();
		}

		if ($this->work) {
			$this->db->query("UPDATE ".GD_MEMBER_GRP_SCHEDULE." SET excuted = 1 WHERE sno = '".$this->work['sno']."'");
		}

		return true;

	}

	function _setQueue() {

		// �޸� �Ӱ�ġ ������
		@ini_set('memory_limit', -1);

		if (empty($this->queue)) {
			$rs = $this->db->query("SELECT MB.m_no, MB.m_id, MB.level, MB.regdt, LOG.last_level_updated FROM ".GD_MEMBER." AS MB LEFT JOIN ".GD_MEMBER_GRP_CHANGED_LOG." AS LOG ON MB.m_no = LOG.m_no WHERE MB.level < 80");

			while($mb = $this->db->fetch($rs,1)) {
				$this->queue[] = $mb;
			}

		}

		return (sizeof($this->queue) > 0) ? true : false;
	}


	function _setWork() {
		$query = "
		INSERT INTO ".GD_MEMBER_GRP_SCHEDULE." SET
			`sno`			= '',
			`last_work`		= CURDATE(),
			`affected_rows` = 0,
			`excuted`		= 0
		";
		$this->db->query($query);
	}



	function _go() {
		while ($mb = array_pop($this->queue)) {
			if ($lv = $this->_get_level($mb)) {
				$mb['previous_level'] = $mb['level'];
				$mb['current_level'] = $lv;
				$this->_update($mb);
			}
		}

	}

	function _get_level($mb = false) {

		$this->m_no = $this->m_id = null;

		if(is_array($mb)) {
			$this->m_no = $mb['m_no'];
			$this->m_id = $mb['m_id'];
		}
		else if(is_numeric($mb)) {	// m_no
			$this->m_no = $mb;
			$this->m_id = $this->_get_memberinfo('m_id');

		}
		else if(is_string($mb)) {	// m_id
			$this->m_id = $mb;
			$this->m_no = $this->_get_memberinfo('m_no');
		}
		else {
			return false;
		}

		// ��� ���� �Ⱓ�� �����´�.
		$range = $this->_getCalcRange();

		if ($this->ruleset['apprSystem'] === 'point') {
			// ���� ������
			$point_or_figure = $this->_getMemberPoint($range);				//PC��
			$mobile_point_or_figure = $this->_getMobileMemberPoint($range);	//����Ͽ�
		}
		else {
			// ���� ��ġ�� (�� ����̻�, �Ӵ� ��� �̻� ��)
			$point_or_figure = $this->_getMemberFigure($range);					//PC��
			$mobile_point_or_figure = $this->_getMobileMemberFigure($range);	//����Ͽ�
		}

		return $this->_getMemberGroup($point_or_figure, $mobile_point_or_figure);
	}

	function _update($mb) {

		// ��� �����Ⱓ�� ��� ������Ʈ ����.
		$_t = $mb['last_level_updated'] ? strtotime($mb['last_level_updated']) : strtotime(substr($mb['regdt'],0,10));
		$_keep = strtotime('+'.$this->ruleset['calcKeep'].' month', $_t);

		if ((int)$this->ruleset['calcKeep']==0 || $this->now > $_keep) {

			$query = "
			UPDATE ".GD_MEMBER." SET
				level = '".$mb['current_level']."'
			WHERE m_no = '".$mb['m_no']."'
			";
			$this->db->query($query);

			// �α� ���
			$this->_log($mb);


		}

	}

	function _log($mb) {

		list($m_no) = $this->db->fetch("SELECT m_no FROM ".GD_MEMBER_GRP_CHANGED_LOG." WHERE m_no = '".$mb['m_no']."'");
		if ($m_no) {
			$query = "
			UPDATE ".GD_MEMBER_GRP_CHANGED_LOG." SET
				current_level = '".$mb['current_level']."',
				previous_level = '".$mb['previous_level']."',
				last_level_updated = CURDATE(),
				notified = '0'
			WHERE m_no = '".$mb['m_no']."'
			";
		}
		else {
			$query = "
			INSERT INTO ".GD_MEMBER_GRP_CHANGED_LOG." SET
				m_no = '".$mb['m_no']."',
				current_level = '".$mb['current_level']."',
				previous_level = '".$mb['previous_level']."',
				last_level_updated = CURDATE(),
				notified = '0'
			";
		}
		$this->db->query($query);
	}



	function _get_memberinfo($key) {

		if (! $this->member) {
			$this->_get_member();
		}

		return ($this->member) ? $this->member[$key] : false;
	}


	function _get_member() {

		$query = "
			SELECT
					*
			FROM ".GD_MEMBER."
			";

		if ($this->m_id !== null) $query .= "WHERE m_id = '".$this->m_id."'";
		elseif ($this->m_no !== null) $query .= "WHERE m_no = '".$this->m_no."'";
		else return false;

		$this->member = $this->db->fetch($query,1);
		return ($this->member) ? true : false;
	}


	function _getMemberGroup($point_or_figure, $mobile_point_or_figure=0) {

		static $groups = null;

		if ($groups === null) {

			// ����� �ҷ��´�.
			$query = "
			SELECT
				*
			FROM ".GD_MEMBER_GRP." AS GRP
			INNER JOIN ".GD_MEMBER_GRP_RULESET." AS RULE
			ON GRP.sno = RULE.sno
			WHERE GRP.level < 80
			ORDER BY GRP.level DESC
			";
			$rs = $this->db->query($query);

			while ($row = $this->db->fetch($rs,1)) {
				$groups[] = $row;
			}
		}

		if ($this->ruleset['apprSystem'] === 'point') {
			// ���� ������
			/*
			by_score_limit
			by_score_max
			*/
			foreach ($groups as $group) {

				//PC�� ����Ʈ�� ����Ͽ� ����Ʈ ���Ͽ� ���� ����Ʈ�� ȸ�� �׷� ����
				$point_or_figure = ($mobile_point_or_figure > $point_or_figure) ? $mobile_point_or_figure : $point_or_figure;

				if ($point_or_figure >= $group['by_score_limit'] && $point_or_figure  < $group['by_score_max']) return $group['level'];
				unset($group);
			}
		}
		else {
			// ���� ��ġ�� (�� ����̻�, �Ӵ� ��� �̻� ��)
			foreach ($groups as $group) {

				if($point_or_figure) {
					if (($point_or_figure['OrderPrice'] >= $group['by_number_buy_limit'] && $point_or_figure['OrderPrice'] < $group['by_number_buy_max']) && $point_or_figure['ReviewCount'] >= $group['by_number_review_require'] && $point_or_figure['OrderCount'] >= $group['by_number_order_require']) $pc_level = $group['level'];
				} 
				if($mobile_point_or_figure) {
					if (($mobile_point_or_figure['OrderPrice'] >= $group['mobile_by_number_buy_limit'] && $mobile_point_or_figure['OrderPrice'] < $group['mobile_by_number_buy_max']) && $mobile_point_or_figure['ReviewCount'] >= $group['mobile_by_number_review_require'] && $mobile_point_or_figure['OrderCount'] >= $group['mobile_by_number_order_require']) 
					$mobile_level = $group['level'];
				}

				$level = ($mobile_level > $pc_level) ? $mobile_level : $pc_level;
				
				if($level) return $level;
				unset($group);
			}

		}

		return 1;	// �Ϲ�ȸ��

	}


	/**
		���� ��ġ ���ϱ�
		���ž��� ��,����Ƚ�� ���,�����ı� ���
	 */
	function _getMemberFigure($range) {

		// �����Ѿ�, Ƚ��
			$query = "
				SELECT
					SUM(goodsprice) AS OrderPrice,
					COUNT(ordno) AS OrderCount
				FROM ".GD_ORDER."
				WHERE m_no = '".$this->m_no."'
				AND step = 4 AND step2 = 0
			";
			if ($range['unlimited'] === false) $query .= " AND orddt >= '".$range['begin']."' AND orddt <= '".$range['end']."' ";
			$row1 = $this->db->fetch($query,1);

		// �ı� �ۼ� Ƚ��
			$query = "
				SELECT
					COUNT(sno) AS ReviewCount
				FROM ".GD_GOODS_REVIEW."
				WHERE m_no = '".$this->m_no."'
			";
			if ($range['unlimited'] === false) $query .= " AND regdt >= '".$range['begin']."' AND regdt <= '".$range['end']."' ";
			$row2 = $this->db->fetch($query,1);

		// ��!
		$r = array_merge((array)$row1, (array)$row2);
		return $r;
	}


	/**
		���� ���� ���ϱ�
		���űݾ� x���� y��	apprPointOrderPriceUnit / apprPointOrderPricePoint
		����Ƚ�� ȸ�� x��	apprPointOrderRepeatPoint
		�����ı� ȸ�� x��	apprPointReviewRepeatPoint
		�α��� ���� x��	apprPointLoginRepeatPoint
	 */
	function _getMemberPoint($range) {

		$figure = $this->_getMemberFigure($range);

		// �α��� Ƚ�� ��������
		$logcnt = $this->_getMemberLoginCount($range);

		$point = 0;

		$point += ($this->ruleset['apprPointOrderPrice'])	? ($figure['OrderPrice'] * $this->ruleset['apprPointOrderPricePoint'] / $this->ruleset['apprPointOrderPriceUnit']) : 0;
		$point += ($this->ruleset['apprPointOrderRepeat'])	? ($figure['OrderCount'] * $this->ruleset['apprPointOrderRepeatPoint']) : 0;
		$point += ($this->ruleset['apprPointReviewRepeat'])	? ($figure['ReviewCount'] * $this->ruleset['apprPointReviewRepeatPoint']) : 0;
		$point += ($this->ruleset['apprPointLoginRepeat'])	? ($logcnt * $this->ruleset['apprPointLoginRepeatPoint']) : 0;

		return floor($point);
	}


	function _getMemberLoginCount($range) {

		$count = 0;

		if ($range['unlimited'] === false) {
			$beg_time = strtotime($range['begin']);
			$end_time = strtotime($range['end']);
		}
		else {
			$beg_time = $end_time = null;
		}

		$log_path = dirname(__FILE__).'/../log/';
		$fl = scandir($log_path);

		foreach ($fl as $filename) {

			if (preg_match('/^login_([0-9]{6})\.log$/',$filename,$matches)) {

				if (!is_null($beg_time) && !is_null($end_time)) {
					$log_time = strtotime($matches[1]);
					if ($log_time < $beg_time || $log_time > $end_time) continue;
				}

				$log = file($log_path.$filename);
				$log_size = sizeof($log);

				for($i=0,$max=sizeof($log);$i < $max; $i++) {
					if (preg_match('/\t('.$this->m_id.')$/',$log[$i])) $count++;
				}
			}
		}

		return $count;
	}



	/**
		��� ���� �Ⱓ ��������.
	 */
	function _getCalcRange() {

		switch($this->ruleset['calcPeriodBegin']) {
			case '-1d':
				$str_time = '-1 day';
				break;
			case '-1w':
				$str_time = '-1 week';
				break;
			case '-2w':
				$str_time = '-2 week';
				break;
			case '-1m':
				$str_time = '-1 month';
				break;
		}

		$_time1 = strtotime($str_time, strtotime($this->work['last_work']) );			# ����
		$_time2 = strtotime('-'.$this->ruleset['calcPeriodMonth'].' month', $_time1 );	# ��

		$range = array(
			'unlimited' => ($this->ruleset['calcPeriodFl'] == 'y' ? false : true),
			'begin' => date('Y-m-d',$_time2),
			'end' => date('Y-m-d',$_time1)
		);

		return $range;
	}

/********** ���⼭���� ����� ��� ���� �߰� ********************/
	/*
		���� ���� ���ϱ�
		���űݾ� x���� y��	mobile_apprPointOrderPriceUnit / mobile_apprPointOrderPricePoint
		����Ƚ�� ȸ�� x��	mobile_apprPointOrderRepeatPoint
		�����ı� ȸ�� x��	mobile_apprPointReviewRepeatPoint
		�α��� ���� x��	mobile_apprPointLoginRepeatPoint
	*/
	function _getMobileMemberPoint($range) {

		$figure = $this->_getMobileMemberFigure($range);

		// �α��� Ƚ�� ��������
		$logcnt = $this->_getMobileMemberLoginCount($range);

		$point = 0;
		$point += ($this->ruleset['apprPointOrderPrice'])	? (floor($figure['OrderPrice'] / $this->ruleset['mobile_apprPointOrderPriceUnit']) * $this->ruleset['mobile_apprPointOrderPricePoint']) : 0;
		$point += ($this->ruleset['apprPointOrderRepeat'])	? ($figure['OrderCount'] * $this->ruleset['mobile_apprPointOrderRepeatPoint']) : 0;
		$point += ($this->ruleset['apprPointReviewRepeat'])	? ($figure['ReviewCount'] * $this->ruleset['mobile_apprPointReviewRepeatPoint']) : 0;
		$point += ($this->ruleset['apprPointLoginRepeat'])	? ($logcnt * $this->ruleset['mobile_apprPointLoginRepeatPoint']) : 0;

		return floor($point);
	}

	/**
		����� ���� ��ġ ���ϱ�
		���ž��� ��,����Ƚ�� ���,�����ı� ���
	 */
	function _getMobileMemberFigure($range) {

		// �����Ѿ�, Ƚ��
		$query = "
			SELECT
				SUM(goodsprice) AS OrderPrice,
				COUNT(ordno) AS OrderCount
			FROM ".GD_ORDER."
			WHERE m_no = '".$this->m_no."'
			AND step = 4 AND step2 = 0 AND mobilepay = 'y'
		";
		if ($range['unlimited'] === false) $query .= " AND orddt >= '".$range['begin']."' AND orddt <= '".$range['end']."' ";
		$row1 = $this->db->fetch($query,1);

		// �ı� �ۼ� Ƚ��
		$query = "
			SELECT
				COUNT(sno) AS ReviewCount
			FROM ".GD_GOODS_REVIEW."
			WHERE m_no = '".$this->m_no."'
			AND is_mobile = 'y'
		";
		if ($range['unlimited'] === false) $query .= " AND regdt >= '".$range['begin']."' AND regdt <= '".$range['end']."' ";
		$row2 = $this->db->fetch($query,1);

		// ��!
		$r = array_merge((array)$row1, (array)$row2);
		return $r;
	}

	/* ����� �α��� Ƚ�� */
	function _getMobileMemberLoginCount($range) {

		$count = 0;

		if ($range['unlimited'] === false) {
			$beg_time = strtotime($range['begin']);
			$end_time = strtotime($range['end']);
		}
		else {
			$beg_time = $end_time = null;
		}

		$log_path = dirname(__FILE__).'/../log/';
		$fl = scandir($log_path);

		foreach ($fl as $filename) {

			if (preg_match('/^mobile_login_([0-9]{6})\.log$/',$filename,$matches)) {

				if (!is_null($beg_time) && !is_null($end_time)) {
					$log_time = strtotime($matches[1]);
					if ($log_time < $beg_time || $log_time > $end_time) continue;
				}

				$log = file($log_path.$filename);
				$log_size = sizeof($log);

				for($i=0,$max=sizeof($log);$i < $max; $i++) {
					if (preg_match('/\t('.$this->m_id.')$/',$log[$i])) $count++;
				}
			}
		}

		return $count;
	}

	function _get_report($m_no) {

		$this->m_no = $m_no;
		$this->m_id = $this->_get_memberinfo('m_id');

		$this->work['last_work'] = date('Y-m-d H:i:s',$this->now);

		// ��� ���� �Ⱓ�� �����´�.
		$range = $this->_getCalcRange();
		
		$data = array();
		if ($this->ruleset['apprSystem'] === 'point') {
			// ���� ������
			$point_or_figure = $this->_getMemberPoint($range);				//PC��
			$mobile_point_or_figure = $this->_getMobileMemberPoint($range);	//����Ͽ�
		}
		else {
			// ���� ��ġ�� (�� ����̻�, �Ӵ� ��� �̻� ��)
			$point_or_figure = $this->_getMemberFigure($range);					//PC��
			$mobile_point_or_figure = $this->_getMobileMemberFigure($range);	//����Ͽ�
		}
		
		$data[type] = $this->ruleset['apprSystem'];
		$data[pc] = $point_or_figure;
		$data[mobile] = $mobile_point_or_figure;

		return $data;

	}


}
?>
