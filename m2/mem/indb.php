<?
/*********************************************************
* ���ϸ�     :  /mem/nomember_order.php
* ���α׷��� :	����ϼ� ȸ�� ����
* �ۼ���     :  dn
* ������     :  2012.08.14
**********************************************************/	
@include dirname(__FILE__) . "/../lib/library.php";
@include $shopRootDir . "/conf/config.php";
@include $shopRootDir . "/conf/config.pay.php";
@include $shopRootDir . "/lib/cart.class.php";
@include $shopRootDir . "/conf/coupon.php";


if ($_POST[mode]=="chkRealName"){

	header ("Cache-Control: no-cache, must-revalidate");
	header ("Pragma: no-cache");
	echo "
	<script>
	parent.document.frmAgree.action = '';
	parent.document.frmAgree.target = '';
	parent.document.frmAgree.submit();
	</script>
	";
	exit;
}

$mode = $_POST['mode'];
unset($_POST['mode']);

switch($mode) {
	case 'member_join' :

		include $shopRootDir."/conf/fieldset.php";
		@include $shopRootDir."/conf/mobile_fieldset.php";
		if (!$joinset[grp]) $joinset[grp] = 1;

		### ���̵� �Է�����
		if (preg_match('/^[a-zA-Z0-9_-]{6,16}$/',$_POST['m_id']) == 0) msg('���̵� �Է� ���� �����Դϴ�', -1);

		### �ź� ���̵� ���͸�
		if (find_in_set(strtoupper($_POST[m_id]),strtoupper($joinset[unableid]))) msg("��� �Ұ����� ���̵��Դϴ�", -1);
		
		### �ʼ��� üũ 
		@include $shopRootDir ."/conf/mobile_fieldset.php";
		
		if (!$_POST['m_id'] || !$_POST['password'] || !$_POST['name']) {
			msg('ȸ�� ���Խ�, ȸ�����̵�, ��й�ȣ, �̸��� �ʼ� �Է°��Դϴ�. �ٽ� �õ��� �ּ���', 'join.php', 'parent');
		}
		
		### ���̵� �ߺ����� üũ
		list ($chk) = $db->fetch("select m_id from ".GD_MEMBER." where m_id='$_POST[m_id]'");
		if ($chk) msg("�̹� ��ϵ� ���̵��Դϴ�",'join.php');
		
		### �̸��� �ߺ����� üũ
		if (isset($_POST['email']) === true) {
			list ($chk) = $db->fetch("select email from ".GD_MEMBER." where email='".$_POST['email']."'");
			if ($chk) msg("�̹� ��ϵ� �̸����Դϴ�",'join.php');
		}
				
		### �г��� �ߺ����� üũ
		if (isset($_POST['nickname']) === true) {
			list ($chk) = $db->fetch("select nickname from ".GD_MEMBER." where nickname='".$_POST['nickname']."'");
			if ($chk) msg("�̹� ��ϵ� �г����Դϴ�",'join.php');
		}
		
		# ������ �߰�
		if ($_POST[rncheck] == "ipin") {
			### dupeinfo �� �ʵ� dupeinfo ���� ���Ѵ�.
			list ($chk) = $db->fetch("select count(*) as cnt from ".GD_MEMBER." where dupeinfo = '".$_POST['dupeinfo']."'");
			if ($chk > 0) {
				msg("�̹� ȸ������� �����Դϴ�.", 'join.php');
			}
		} else {
			### �ֹε�Ϲ�ȣ �ߺ����� üũ
			list ($chk) = $db->fetch("select resno1 from ".GD_MEMBER." where resno1='$resno1' and resno2='$resno2'");
			if ($resno1 && $resno2 && $chk){
				msg("�̹� ��ϵ� �ֹε�Ϲ�ȣ�Դϴ�",'join.php');
			}
			### dupeinfo �����ε� üũ�Ѵ�.
			if ($_POST['dupeinfo']) {
				list ($chk) = $db->fetch("select count(*) as cnt from ".GD_MEMBER." where dupeinfo = '".$_POST['dupeinfo']."'");
				if ($chk > 0) {
					msg("�̹� ȸ������� �����Դϴ�.", 'join.php');
				}
			}
		}		
		
		### ȸ���簡�ԱⰣ üũ
		if ( $joinset[rejoin] > 0 ){
			$rejoindt = date('Ymd', time() - (($joinset[rejoin]-1)*86400));
			list ($chk) = $db->fetch("select regdt from ".GD_LOG_HACK." where resno1='$resno1' and resno2='$resno2' and date_format( regdt, '%Y%m%d' ) >={$rejoindt} order by regdt desc limit 1");
			if($resno1 && $resno2 && $chk) msg("ȸ��Ż�� �� {$joinset[rejoin]}�� ���� �簡���� �� �����ϴ�.\\nȸ������ {$chk}�� Ż���ϼ̽��ϴ�.",-1);

			if ($_POST['dupeinfo']) {
				list ($chk) = $db->fetch("select regdt from ".GD_LOG_HACK." where dupeinfo='".$_POST['dupeinfo']."' and date_format( regdt, '%Y%m%d' ) >={$rejoindt} order by regdt desc limit 1");
				if($_POST['dupeinfo'] && $chk) msg("ȸ��Ż�� �� {$joinset[rejoin]}�� ���� �簡���� �� �����ϴ�.\\nȸ������ {$chk}�� Ż���ϼ̽��ϴ�.",-1);
			}
		}

		if ($_POST[rncheck] != "ipin") {
			### �ֹι�ȣ�� ���� üũ
			if ($_POST[resno][1] && $_POST[sex]) {
				$resno_01 = substr($_POST[resno][1], 0, 1);
				if ( ( ($resno_01 == "2" || $resno_01 == "4") && $_POST[sex]=="m") || ( ($resno_01 == "1" || $resno_01 == "3") && $_POST[sex]=="w") ){
					msg("�ֹε�Ϲ�ȣ�� ������ ��ġ���� �ʽ��ϴ�.", -1);
					exit;
				}
			}
		}
		
		### ���� �缳��
		$ins_arr['name'] = $_POST['name'];
		$ins_arr['nickname'] = $_POST['nickname'];
		$ins_arr['sex'] = $_POST['sex'];
		$ins_arr['birth_year'] = $_POST['birth_year'];
		if ($_POST['birth']) {
			$ins_arr['birth'] = trim(sprintf("%02d%02d",$_POST['birth'][0],$_POST['birth'][1]));
		}

		$ins_arr['calendar'] = $_POST['calendar'];
		$ins_arr['email'] = $_POST['email'];
		$ins_arr['mailling'] =  ($_POST['mailling']) ? 'y' : 'n';
		$ins_arr['zipcode'] = @implode('-', $_POST['zipcode']);
		$ins_arr['address'] = $_POST['address'];
		$ins_arr['road_address'] = $_POST['road_address'];
		$ins_arr['address_sub'] = $_POST['address_sub'];
		$ins_arr['mobile'] = @implode("-",$_POST['mobile']);
		$mobile = @implode("-",$_POST['mobile']);
		$ins_arr['sms'] =  ($_POST['sms']) ? 'y' : 'n';
		$ins_arr['phone'] = @implode('-', $_POST['phone']);
		$ins_arr['fax'] = @implode('-', $_POST['fax']);
		$ins_arr['company'] = $_POST['company'];
		$ins_arr['service'] = $_POST['service'];
		$ins_arr['item'] = $_POST['item'];
		$ins_arr['busino'] = preg_replace("/[^0-9-]+/",'',$_POST['busino']);

		$ins_arr['marriyn'] = $_POST['marriyn'];
		if ($_POST['marridate']) {
			$ins_arr['marridate'] = trim(sprintf("%4d%02d%02d",$_POST['marridate'][0],$_POST['marridate'][1],$_POST['marridate'][2]));
		}
		$ins_arr['job'] = $_POST['job'];
		if (is_array($_POST['interest'])) {
			$ins_arr['interest'] = array_sum($_POST['interest']);
		}
		$ins_arr['birth_year'] = $_POST['birth_year'];
		if ($_POST['birth']) {
			$ins_arr['birth'] = trim(sprintf("%02d%02d",$_POST['birth'][0],$_POST['birth'][1]));
		} 
		$ins_arr['memo'] = $_POST['memo'];
		
		$ins_arr['ex1'] = $_POST['ex1'];
		$ins_arr['ex2'] = $_POST['ex2'];
		$ins_arr['ex3'] = $_POST['ex3'];
		$ins_arr['ex4'] = $_POST['ex4'];
		$ins_arr['ex5'] = $_POST['ex5'];
		$ins_arr['ex6'] = $_POST['ex6'];

		$ins_arr['private1']  = 'y';
		$ins_arr['private2']  = $_POST['private2'];
		$ins_arr['private3']  = $_POST['private3']; 
		$ins_arr['inflow']    = 'mobileshop'; 
		
		if (is_array($checked_mobile['reqField'])) { 
			foreach($checked_mobile[reqField] as $key=>$value) {
				if ($_POST[$key] == '') {
					msg('�ʼ��Է°�('.$key.')�� �����Ǿ� �ֽ��ϴ�.  �ٽ� �õ����ּ���.', 'join.php', 'parent');
				}
			} 
		}		
		
		$query = "
		insert into ".GD_MEMBER." set
			m_id		= '$_POST[m_id]',
			password	= password('$_POST[password]'),
			status		= '$joinset[status]',
			emoney		= '$joinset[emoney]',
			level		= '$joinset[grp]',
			regdt		= now(),
			recommid	= '$_POST[recommid]',
			LPINFO		= '$_COOKIE[LPINFO]',
			dupeinfo	= '$_POST[dupeinfo]',
			foreigner	= '$_POST[foreigner]',
			pakey		= '$_POST[pakey]',
			rncheck		= '$_POST[rncheck]',
		";		
		$qr = ""; 
		foreach ($ins_arr as $k=>$v) {
			$qr .= " ".$k." = '".$v."' "; 
			if ($k != 'inflow')  $qr .= ",";
		}
		$query .= $qr; 
		
		
		$db->query($query);
		$m_no = $db->_last_insert_id();
		
		if($m_no) {
			### ������ ���� �Է�
			$code = codeitem('point');
			$query = "
			insert into ".GD_LOG_EMONEY." set
				m_no	= '$m_no',
				emoney	= '$joinset[emoney]',
				memo	= '" . $code['01'] . "',
				regdt	= now()
			";
			$db->query($query);

			### ��õ�� ������ üũ shop/member/indb.php�� ���� ����
			if($checked_mobile['useField']['recommid'] == "checked" && $_POST['recommid']){
			
			
				# �ڱ� �ڽ��� ��õ�� ���ϰ� ó��
				if( $_POST['recommid'] != $_POST['m_id'] ){
			
					list ($recomm_m_id,$recomm_m_no) = $db->fetch("select m_id,m_no from ".GD_MEMBER." where m_id='".$_POST['recommid']."'");
			
					# ��õ���� �ִ°��
					if($recomm_m_id){
			
						# ��õ�ο��� ������ ����
						if($joinset['recomm_emoney'] > 0){
							$query = "
							insert into ".GD_LOG_EMONEY." set
								m_no	= '".$recomm_m_no."',
								emoney	= '".$joinset['recomm_emoney']."',
								memo	= '".$_POST['m_id']." ȸ���� ��õ���� ����Ʈ ����',
								regdt	= now()
							";
							$db->query($query);
			
							$strSQL = "UPDATE ".GD_MEMBER." SET emoney = emoney + '".$joinset['recomm_emoney']."' WHERE m_no = '".$recomm_m_no."'";
							$db->query($strSQL);
						}
			
						# ��õ�ѻ��(������) ������ ����
						if($joinset['recomm_add_emoney'] > 0){
							$query = "
							insert into ".GD_LOG_EMONEY." set
								m_no	= '".$m_no."',
								emoney	= '".$joinset['recomm_add_emoney']."',
								memo	= '".$_POST['recommid']." ȸ���� ��õ�Ͽ� ����Ʈ ����',
								regdt	= now()
							";
							$db->query($query);
			
							$strSQL = "UPDATE ".GD_MEMBER." SET emoney = emoney + '".$joinset['recomm_add_emoney']."' WHERE m_no = '".$m_no."'";
							$db->query($strSQL);
						}
			
					# ��õ���� ���°��
					} else {
						$query = "
						insert into ".GD_LOG_EMONEY." set
							m_no	= '".$m_no."',
							emoney	= '0',
							memo	= '��õ�ξ��̵��� ������ �����ȵ�',
							regdt	= now()
						";
						$db->query($query);
					}
				}
			}

            ### ȸ������SMS
			if (strlen($mobile)>7) {
                		sendSmsCase('join',$mobile);
			}

			### ȸ�����Ը���
			if ( $_POST[email] && $cfg[mailyn_10] == 'y' )
			{
				$modeMail = 10;
				include $shopRootDir."/lib/automail.class.php";
				$automail = new automail();
				$automail->_set($modeMail,$_POST[email],$cfg);
				$automail->_assign($_POST);
				$automail->_send();
			}
			
			### ȸ���������� �߱�
			$date = date('Y-m-d H:i:s');
			$query = "select * from ".GD_COUPON." where coupontype = 2 and (( priodtype = 1 ) or ( priodtype = 0 and sdate <= '$date' and edate >= '$date' ))";
			$res = $db->query($query);
			$couponCnt=0;
			while($data = $db->fetch($res)){
	
				$query = "select count(a.sno) from ".GD_COUPON_APPLY." a left join ".GD_COUPON_APPLY."member b on a.sno=b.applysno where a.couponcd='$data[couponcd]' and b.m_no = '$m_no'";
				list($cnt) = $db->fetch($query);
				if(!$cnt){
					$newapplysno = new_uniq_id('sno',GD_COUPON_APPLY);
					$query = "insert into ".GD_COUPON_APPLY." set
								sno				= '$newapplysno',
								couponcd		= '$data[couponcd]',
								membertype		= '2',
								member_grp_sno  = '',
								regdt			= now()";
					$db->query($query);
	
					$query = "insert into ".GD_COUPON_APPLY."member set m_no='$m_no', applysno ='$newapplysno'";
					$db->query($query);
					$couponCnt++;
				}
			}			
			
			if($joinset['status']=='0') {
				$_SESSION['tmp_m_no'] = $m_no;
				msg('������ ������ ����ó���˴ϴ�\n Ȩ���� �̵��Ͽ�\n������ ��� �̿��� �ּ���', 'join.php?mode=endjoin', 'parent');
			}
			else {
				$result = $session->login($_POST['m_id'],$_POST['password']);
				member_log( $session->m_id );
				
				msg('ȸ�� ���ԵǾ����ϴ�.\nȨ���� �̵��Ͽ�\n������ ��� �̿��� �ּ���', 'join.php?mode=endjoin', 'parent');
			}
			
			
		}
		else {
			msg('ȸ�� ������ ������ �߻��߽��ϴ�. �ٽ� �õ��� �ּ���', 'join.php', 'parent');
		}
		break;
	
	case 'member_addinfo' :

		$upd_arr = array();
		
		### ���� �缳��
		$upd_arr['name'] = $_POST['name'];
		$upd_arr['nickname'] = $_POST['nickname'];
		$upd_arr['sex'] = $_POST['sex'];
		$upd_arr['birth_year'] = $_POST['birth_year'];
		if ($_POST['birth']) {
			$upd_arr['birth'] = trim(sprintf("%02d%02d",$_POST['birth'][0],$_POST['birth'][1]));
		}

		$upd_arr['calendar'] = $_POST['calendar'];
		$upd_arr['zipcode'] = @implode('-', $_POST['zipcode']);
		$upd_arr['address'] = $_POST['address'];
		$upd_arr['address_sub'] = $_POST['address_sub'];
		$upd_arr['phone'] = @implode('-', $_POST['phone']);

		$upd_arr['fax'] = @implode('-', $_POST['fax']);
		$upd_arr['company'] = $_POST['company'];
		$upd_arr['service'] = $_POST['service'];
		$upd_arr['item'] = $_POST['item'];
		$upd_arr['busino'] = preg_replace("/[^0-9-]+/",'',$_POST['busino']);

		$upd_arr['marriyn'] = $_POST['marriyn'];
		if ($_POST['marridate']) {
			$upd_arr['marridate'] = trim(sprintf("%4d%02d%02d",$_POST['marridate'][0],$_POST['marridate'][1],$_POST['marridate'][2]));
		}
		$upd_arr['job'] = $_POST['job'];
		if (is_array($_POST['interest'])) {
			$upd_arr['interest'] = array_sum($_POST['interest']);
		}
		$upd_arr['memo'] = $_POST['memo'];

		$upd_arr['ex1'] = $_POST['ex1'];
		$upd_arr['ex2'] = $_POST['ex2'];
		$upd_arr['ex3'] = $_POST['ex3'];
		$upd_arr['ex4'] = $_POST['ex4'];
		$upd_arr['ex5'] = $_POST['ex5'];
		$upd_arr['ex6'] = $_POST['ex6'];
		
		$upd_arr['private1']  = 'y';
		
		$upd_query = $db->_query_print('UPDATE '.GD_MEMBER.' SET [cv] WHERE m_no=[i]', $upd_arr, $sess['m_no']);
		$result = $db->query($upd_query);

		if($result) {
			go('join.php?mode=endjoin', 'parent');
		}
		else {
			msg('�߰����� �Է��� ������ �߻��߽��ϴ�. PC ȭ�鿡�� �ٽ� �õ��� �ּ���', '/m2/index.php', 'parent');
		}

		break;
}
?>