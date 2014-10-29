<?
// 인기상품
class populate {

	var $cfg;
	var $cache_path;

	var $sites = array();

	function populate() {

		$_dir = dirname(__FILE__);
		$cfg_populate = array();

		// cache directory
		if (!is_dir($_dir.'/../data/statistics')) {
			@mkdir($_dir.'/../data/statistics', 0777);
		}

		$this->cache = $_dir.'/../data/statistics/populate_goods_data.cached.txt';

		if (is_file($_dir."/../conf/config.populate.php")) {
			include $_dir."/../conf/config.populate.php";
		}

		$this->cfg = $cfg_populate;

	}

	function getData() {

		if (empty($this->cfg)) return false;

		$_update = false;

		// 캐시 파일이 없다면 업데이트
		if (!is_file($this->cache)) {
			$data = $this->_getLiveData();
		}
		else {

			// 유지기간 내 라면 캐시를 불러오고, 지났으면 갱신
			$_now = time();

			$_mtime = filemtime( $this->cache );

			switch ($this->cfg['range']) {

				case 'hour':
					if (date('H',$_now) != date('H',$_mtime)) $_update = true;
					break;
				case 'week':
					if (date('W',$_now) != date('W',$_mtime)) $_update = true;
					break;
				case 'month':
					$_now = strtotime('+'.$this->cfg['range_month'].' month',$_now);
					if (date('Ym',$_now) < date('Ym',$_mtime)) $_update = true;
					break;
			}

			if ($_update == true) {
				$data = $this->_getLiveData();
			}
			else {
				$data = $this->_getCache( $this->cache );
			}
		}

		return array_slice($data, 0, $this->cfg['limit']);

	}

	function _getCache($file) {

		// 파일을 읽어 배열형태로 변환하여 리턴.
		$data = array();
		$_data = '';
		$LF = chr(10);

		if ($fh = @fopen($file, 'r')) {

			flock($fh, LOCK_SH);
			if (filesize($file) > 0) $_data = fread($fh, filesize($file));
			flock($fh, LOCK_UN);
			fclose($fh);

			$tmp_data = explode($LF, $_data);


			for($i=0,$m=sizeof($tmp_data);$i<$m;$i++) {
				if (empty($tmp_data[$i])) continue;
				$row = explode('|',$tmp_data[$i]);
				$data[$i]['goodsno'] = array_shift($row);
				$data[$i]['goods_cnt'] = array_pop($row);
				$data[$i]['goodsnm'] = implode('|',$row);
			}

		}

		return $data;

	}

	function _setCache($data,$file='') {

		// 데이터를 파일에 저장
		$data_size = sizeof($data);

		$LF = chr(10);
		$_data = '';

		for($i=0,$m=sizeof($data);$i<$m;$i++) {
			$row = $data[$i];
			$_data .= $row['goodsno'].'|'.$row['goodsnm'].'|'.$row['goods_cnt'].$LF;
		}

		if ($fh = @fopen($file, 'w')) {

			flock($fh, LOCK_EX);
			fwrite($fh, $_data);
			flock($fh, LOCK_UN);
			fclose($fh); @chmod($file, 0777);
		}

		return;

	}

	function _getLiveData() {

		// 현재부터 기존 시간이전의 db 데이터를 읽어 캐시에 저장하고, 리턴
		global $db;

		$data = array();

		if ($this->cfg['type'] == 'pageview') {
			$query = "
			SELECT
				SUM(PGV.cnt) AS `goods_cnt`,
				G.goodsno, G.goodsnm
			FROM gd_goods_pageview AS PGV
			INNER JOIN gd_goods AS G
			ON PGV.goodsno = G.goodsno
			";

			switch ($this->cfg['range']) {

				case 'hour':
					$query .= ' WHERE PGV.date >= DATE_SUB(CURDATE(), INTERVAL 1 HOUR)';
					break;
				case 'week':
					$query .= ' WHERE PGV.date >= DATE_SUB(CURDATE(), INTERVAL 1 WEEK)';
					break;
				case 'month':
					$query .= ' WHERE PGV.date >= DATE_SUB(CURDATE(), INTERVAL '.$this->cfg['range_month'].' MONTH)';
					break;
			}

			if ($this->cfg['include_soldout'] === '0') {
				$query .= ' AND ( G.runout <> 1 AND (G.usestock <> \'o\' OR G.totstock > 1))';
			}

			$query .= '
			GROUP BY G.goodsno

			ORDER BY `goods_cnt` DESC

			LIMIT 20
			';
		}
		else {
			$query = "
			SELECT
				OI.goodsno, OI.goodsnm, COUNT(OI.goodsno) AS `goods_cnt`
			FROM gd_order as O
				FORCE INDEX (PRIMARY, orddt)
			STRAIGHT_JOIN gd_order_item AS OI
				FORCE INDEX (idx)
				ON O.ordno = OI.ordno
			INNER JOIN gd_goods AS G
			ON OI.goodsno = G.goodsno
			";

			switch ($this->cfg['range']) {

				case 'hour':
					$query .= ' WHERE O.orddt >= DATE_SUB(NOW(), INTERVAL 1 HOUR)';
					break;
				case 'week':
					$query .= ' WHERE O.orddt >= DATE_SUB(NOW(), INTERVAL 1 WEEK)';
					break;
				case 'month':
					$query .= ' WHERE O.orddt >= DATE_SUB(NOW(), INTERVAL '.$this->cfg['range_month'].' MONTH)';
					break;
			}

			if ($this->cfg['include_soldout'] === '0') {
				$query .= ' AND ( G.runout <> 1 AND (G.usestock <> \'o\' OR G.totstock > 1))';
			}

			$query .= '

			AND G.open = 1

			GROUP BY OI.goodsno

			ORDER BY `goods_cnt` DESC

			LIMIT 20
			';

		}

		$res = $db->query($query);

		while($row = $db->fetch($res,1)) {
			$data[] = $row;
		}

		$this->_setCache($data, $this->cache);

		return $data;

	}

}	// eof populate;
?>