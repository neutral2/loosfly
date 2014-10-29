<?
/*********************************************************
* 파일명     :  mGetDesignData.php
* 프로그램명 :	모바일 디자인 데이터 가져오기
* 작성자     :  dn
* 생성일     :  2012.05.14
**********************************************************/	
@include '../lib/library.php';
include $shopRootDir . "/lib/json.class.php";

$json = new Services_JSON(16);

$req_arr = $list_arr = $arr = array();
/** 
 *  파라미터 POST/GET 호환 처리 
 */
if($_GET['debug']) {
	$_POST['mdesign_no'] = 13;
	$_POST['display_type'] = 1;
}
if(is_array($_POST) && !empty($_POST)) {
	$req_arr = $_POST;
}
else {
	$req_arr = $_GET;
}
$design_query = $db->_query_print('SELECT tpl, tpl_opt FROM '.GD_MOBILE_EVENT.' WHERE mevent_no=[s]', $req_arr['mevent_no']);
$res_design = $db->_select($design_query);

switch ( $res_design[0]['tpl']) {
	case "tpl_05": 
		$tab_info = $json->decode($res_design[0]['tpl_opt']);

		if(is_array($tab_info['tab_name']) && !empty($tab_info['tab_name'])) {
			foreach ($tab_info['tab_name'] as $key => $val) {
				$tmp_query = '
					SELECT 
						md.goodsno, g.goodsnm, g.img_mobile, g.img_l, go.price
					FROM 
						'.GD_MOBILE_DISPLAY.' md
						LEFT JOIN '.GD_GOODS.' g ON md.goodsno = g.goodsno
						LEFT JOIN '.GD_GOODS_OPTION.' go ON md.goodsno = go.goodsno AND link and go_is_deleted <> "1" and go_is_display = "1"
					WHERE 
						md.mevent_no=[s] AND md.tab_no=[s]
					ORDER BY
						md.sort ASC
					';		

				$display_query = $db->_query_print($tmp_query, $req_arr['mevent_no'], $key);
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
						$tmp_arr['goodsnm'] = $row_display['goodsnm'];
						$img_l_arr = explode("|", $row_display['img_l']); 
						if (preg_match("/^http/i", $img_l_arr[0])) {
							$tmp_arr['goods_img'] = $img_l_arr[0];
						} else {
							$tmp_arr['goods_img'] = $img_path.$img_l_arr[0];
						}
						if($row_display['img_mobile']) {
							if (preg_match("/^http/i", $row_display['img_mobile'])) { 
								$tmp_arr['goods_img'] = $row_display['img_mobile'];
							} else {
								$tmp_arr['goods_img'] = $img_path.$row_display['img_mobile'];
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
	default: 
		$tmp_query = '
			SELECT 
				md.goodsno, g.goodsnm, g.img_mobile, g.img_l, go.price
			FROM 
				'.GD_MOBILE_DISPLAY.' md
				LEFT JOIN '.GD_GOODS.' g ON md.goodsno = g.goodsno
				LEFT JOIN '.GD_GOODS_OPTION.' go ON md.goodsno = go.goodsno AND link and go_is_deleted <> "1" and go_is_display = "1"
			WHERE 
				md.mevent_no=[s]
			ORDER BY
				md.sort ASC
			';
		
		$display_query = $db->_query_print($tmp_query, $req_arr['mevent_no']);
		$tmp_display = $db->_select($display_query);
		$img_path = '';
		if($cfg['rootDir']) {
			$img_path = $cfg['rootDir'].'/data/goods/';			
		}
		else {
			$img_path = '/shop/data/goods/';
		}
		
		$res_display = array();
		//debug($tmp_display);
		if(is_array($tmp_display) && !empty($tmp_display)) {
			foreach($tmp_display as $row_display) {
				$tmp_arr = array();
				
				$tmp_arr['goodsno'] = $row_display['goodsno'];
				$tmp_arr['goodsnm'] = $row_display['goodsnm'];
				$img_l_arr = explode("|", $row_display['img_l']); 
				if (preg_match("/^http/i", $img_l_arr[0])) {
					$tmp_arr['goods_img'] = $img_l_arr[0];
				} else {
					$tmp_arr['goods_img'] = $img_path.$img_l_arr[0];
				}
				if($row_display['img_mobile']) {
					if (preg_match("/^http/i", $row_display['img_mobile'])) { 
						$tmp_arr['goods_img'] = $row_display['img_mobile'];
					} else {
						$tmp_arr['goods_img'] = $img_path.$row_display['img_mobile'];
					}
				}

				$tmp_arr['goods_price'] = number_format($row_display['price']).' 원';
				$res_display[] = $tmp_arr;
			}
		}		
		break; 
		
}
//debug($res_display);
echo $json->encode($res_display);

unset($req_arr, $list_arr, $arr);

exit;
?>