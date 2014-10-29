<?
/*********************************************************
* 파일명     :  mGetDesignData.php
* 프로그램명 :	모바일 디자인 데이터 가져오기
* 작성자     :  dn
* 생성일     :  2012.05.14
**********************************************************/	
@include '../lib/library.php';
@include $shopRootDir . "/lib/json.class.php";

$json = new Services_JSON(16);
$goodsDisplay = Core::loader('Mobile2GoodsDisplay');

/** 
 *  파라미터 POST/GET 호환 처리 
 */
if(is_array($_POST) && !empty($_POST)) {
	$req_arr = $_POST;
}
else {
	$req_arr = $_GET;
}
/** 
 * 테스트용
 */
if($_GET['debug']) {
	$_POST['mdesign_no'] = 5;
	$_POST['display_type'] = 3;
}		

//$req_arr['mdesign_no'] = intval($req_arr['mdesign_no']);
//$req_arr['display_type'] = intval($req_arr['display_type']);
 
switch ($req_arr['display_type']) {
	case '1' :
		$tmp_query = '
			SELECT 
				md.goodsno, g.goodsnm, g.img_mobile, g.img_l, g.img_m, go.price
			FROM 
				'.GD_MOBILE_DISPLAY.' md
				LEFT JOIN '.GD_GOODS.' g ON md.goodsno = g.goodsno
				LEFT JOIN '.GD_GOODS_OPTION.' go ON md.goodsno = go.goodsno AND link and go_is_deleted <> "1" and go_is_display = "1"
			WHERE 
				md.mdesign_no=[s] AND md.display_type=[s]
				and g.open_mobile
			ORDER BY
				md.sort ASC
			';

		$display_query = $db->_query_print($tmp_query, $req_arr['mdesign_no'], $req_arr['display_type']);
		$tmp_display = $db->_select($display_query);
		
		$img_path = '';
		
		if($cfg['rootDir']) {
			$img_path = $cfg['rootDir'].'/data/goods/';			
		}
		else {
			$img_path = '/shop/data/goods/';
		}

		$res_display = array();

		if(is_array($tmp_display) && !empty($tmp_display)) {
			foreach($tmp_display as $row_display) {
				$tmp_arr = array();
				
				$tmp_arr['goodsno'] = $row_display['goodsno'];
				$tmp_arr['goodsnm'] = strip_tags($row_display['goodsnm']);
 

				$img_l_arr = explode("|", $row_display['img_l']); 
				if (preg_match("/^http/i", $img_l_arr[0])) {
					$tmp_arr['goods_img'] = $img_l_arr[0];
				} else {
					$tmp_arr['goods_img'] = $img_path.$img_l_arr[0];
				}
				if($row_display['img_m']) {
					$img_m_arr = explode("|", $row_display['img_m']); 
					if (preg_match("/^http/i", $img_m_arr[0])) {
						$tmp_arr['goods_img'] = $img_m_arr[0];
					} else {
						$tmp_arr['goods_img'] = $img_path.$img_m_arr[0];
					}
					
				}

				$tmp_arr['goods_price'] = number_format($row_display['price']).' 원';	
				$res_display[] = $tmp_arr;
			}
		}

		break;

	case '2' :
		$tmp_query = '
			SELECT 
				md.category, g.goodsno, g.goodsnm, g.img_mobile, g.img_l, g.img_m, go.price
			FROM 
				'.GD_MOBILE_DISPLAY.' md
				LEFT JOIN '.GD_GOODS_LINK.' gl ON gl.category LIKE CONCAT(md.category, "%")
				LEFT JOIN '.GD_GOODS.' g ON gl.goodsno = g.goodsno
				LEFT JOIN '.GD_GOODS_OPTION.' go ON g.goodsno = go.goodsno AND link and go_is_deleted <> "1" and go_is_display = "1"
			WHERE 
				md.mdesign_no=[s] AND md.display_type=[s]
				and g.open_mobile
			ORDER BY
				md.sort, gl.sort ASC
			';

		$display_query = $db->_query_print($tmp_query, $req_arr['mdesign_no'], $req_arr['display_type']);

		$tmp_display = $db->_select($display_query);

		$img_path = '';

		// 매거진의 경우,  이미지 
		if($cfg['rootDir']) {
			$img_path = $cfg['rootDir'].'/data/goods/';	
		}
		else {
			$img_path = '/shop/data/goods/';
		}

		$res_display = array();

		if(is_array($tmp_display) && !empty($tmp_display)) {
			foreach($tmp_display as $row_display) {
				$tmp_arr = array();
				
				$tmp_arr['goodsno'] = $row_display['goodsno'];
				$tmp_arr['goodsnm'] = strip_tags($row_display['goodsnm']);
 

				$img_l_arr = explode("|", $row_display['img_l']); 
				if (preg_match("/^http/i", $img_l_arr[0])) {
					$tmp_arr['goods_img'] = $img_l_arr[0];
				} else {
					$tmp_arr['goods_img'] = $img_path.$img_l_arr[0];
				}
				if($row_display['img_m']) {
					$img_m_arr = explode("|", $row_display['img_m']); 
					if (preg_match("/^http/i", $img_m_arr[0])) {
						$tmp_arr['goods_img'] = $img_m_arr[0];
					} else {
						$tmp_arr['goods_img'] = $img_path.$img_m_arr[0];
					}
				}

				$tmp_arr['goods_price'] = number_format($row_display['price']).' 원';
				$res_display[] = $tmp_arr;
			}
		}
		break;
	case '3' :
		$tmp_query = '
			SELECT 
				md.category, c.catnm, md.temp2
			FROM 
				'.GD_MOBILE_DISPLAY.' md
				LEFT JOIN '.GD_CATEGORY.' c ON md.category = c.category
			WHERE 
				md.mdesign_no=[s] AND md.display_type=[s]
			ORDER BY
				md.sort ASC
			';
			
			$display_query = $db->_query_print($tmp_query, $req_arr['mdesign_no'], $req_arr['display_type']);

			$tmp_display = $db->_select($display_query);
					
			$img_path = '';
			
			if($cfg['rootDir']) {
				$img_path = $cfg['rootDir'].'/data/m/upload_img/';			
			}
			else {
				$img_path = '/shop/data/m/upload_img/';
			}

			$res_display = array();
			
			if(is_array($tmp_display) && !empty($tmp_display)) {
				foreach($tmp_display as $row_display) {
					$tmp_arr = array();
					
					$tmp_arr['goodsno'] = $row_display['category'];
					$tmp_arr['goodsnm'] = $row_display['catnm'];
					$tmp_arr['goods_img'] = $img_path.$row_display['temp2'];
					$tmp_arr['goods_price'] = '';

					if(is_file('../../'.$tmp_arr['goods_img']) && $tmp_arr['goodsnm']) {				
						$res_display[] = $tmp_arr;
					}
				}
			}
			
		break;

	case '5' :
		$tab_query = $db->_query_print('SELECT tpl_opt FROM '.GD_MOBILE_DESIGN.' WHERE mdesign_no=[s]', $req_arr['mdesign_no']);
		$tab_res = $db->_select($tab_query);
		$tab_res = $tab_res[0];

		$json = new Services_JSON(16);
		$tab_info = $json->decode($tab_res['tpl_opt']);
		
		$res_display = array();

		if(is_array($tab_info['tab_name']) && !empty($tab_info['tab_name'])) {
			foreach ($tab_info['tab_name'] as $key => $val) {
				
				$tmp_query = '
					SELECT 
						md.goodsno, g.goodsnm, g.img_mobile, g.img_l, g.img_m, go.price
					FROM 
						'.GD_MOBILE_DISPLAY.' md
						LEFT JOIN '.GD_GOODS.' g ON md.goodsno = g.goodsno
						LEFT JOIN '.GD_GOODS_OPTION.' go ON md.goodsno = go.goodsno AND link and go_is_deleted <> "1" and go_is_display = "1"
					WHERE 
						md.mdesign_no=[s] AND md.display_type=[s] AND md.tab_no=[s]
						and g.open_mobile
					ORDER BY
						md.sort ASC
					';

				$display_query = $db->_query_print($tmp_query, $req_arr['mdesign_no'], $req_arr['display_type'], $key);
				$tmp_display = $db->_select($display_query);

				$img_path = '';
		
				if($cfg['rootDir']) {
					$img_path = $cfg['rootDir'].'/data/goods/';			
				}
				else {
					$img_path = '/shop/data/goods/';
				}

				$tmp_res = array();
				if(is_array($tmp_display) && !empty($tmp_display)) {
					foreach($tmp_display as $row_display) {
						$tmp_arr = array();
						
						$tmp_arr['goodsno'] = $row_display['goodsno'];
						$tmp_arr['goodsnm'] = strip_tags($row_display['goodsnm']);
						$img_l_arr = explode("|", $row_display['img_l']); 
						if (preg_match("/^http/i", $img_l_arr[0])) {
							$tmp_arr['goods_img'] = $img_l_arr[0];
						} else {
							$tmp_arr['goods_img'] = $img_path.$img_l_arr[0];
						}
						if($row_display['img_m']) {
							$img_m_arr = explode("|", $row_display['img_m']); 
							if (preg_match("/^http/i", $img_m_arr[0])) {
								$tmp_arr['goods_img'] = $img_m_arr[0];
							} else {
								$tmp_arr['goods_img'] = $img_path.$img_m_arr[0];
							}
						}
						$tmp_arr['goods_price'] = number_format($row_display['price']).' 원';
						$tmp_res[] = $tmp_arr;
					}
				}
				$res_display[] = $tmp_res;
			}
		}
	
		break;

	case '7' :
		$banner_query = $db->_query_print('SELECT tpl_opt FROM '.GD_MOBILE_DESIGN.' WHERE mdesign_no=[s]', $req_arr['mdesign_no']);
		$banner_res = $db->_select($banner_query);
		$banner_res = $banner_res[0];
		
		$json = new Services_JSON(16);
		$banner_info = $json->decode($banner_res['tpl_opt']);
		
		$res_display = array();

		if(is_array($banner_info['banner_img']) && !empty($banner_info['banner_img'])) {
		
			foreach ($banner_info['banner_img'] as $key => $val) {
				
				$tmp_query = '
					SELECT 
						md.temp1
					FROM 
						'.GD_MOBILE_DISPLAY.' md
					WHERE 
						md.mdesign_no=[s] AND md.display_type=[s] AND md.banner_no=[s]
					ORDER BY
						md.sort ASC
					';

				$display_query = $db->_query_print($tmp_query, $req_arr['mdesign_no'], $req_arr['display_type'], $key);
				$tmp_display = $db->_select($display_query);
				$tmp_display = $tmp_display[0];

				$tmp_res = array();
				
				if($cfg['rootDir']) {
					$img_path = $cfg['rootDir'].'/data/m/upload_img/';			
				}
				else {
					$img_path = '/shop/data/m/upload_img/';
				}
				
				$tmp_res['banner_img'] = $img_path.$val;

				if(strstr($tmp_display, 'http')) { 
					$tmp_res['link_url'] = $tmp_display['temp1'];
				}
				else {
					$tmp_res['link_url'] = 'http://'.$tmp_display['temp1'];
				}

				if(is_file('../../'.$tmp_res['banner_img'])) {				
					$res_display[] = $tmp_res;
				}		

			}
		}
		break;
}

if ($goodsDisplay->isPCDisplay()) {
	$res_display = $goodsDisplay->getPCMainDisplayGoods($req_arr['mdesign_no']);
}
echo $json->encode($res_display);
?>