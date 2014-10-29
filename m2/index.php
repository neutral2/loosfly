<?
/*********************************************************
* 파일명     :  index.php
* 프로그램명 :	메인페이지
* 작성자     :  dn
* 생성일     :  2012.04.14
**********************************************************/	
include dirname(__FILE__) . "/_header.php";
@include $shopRootDir . "/conf/config.mobileShop.main.php";

$_view_search_form = true;
$mainpage = true;

## 모바일샵 미설정일때는 PC화면으로 돌려준다 
if(!$cfgMobileShop['useMobileShop']){
	header("location:".$cfg['rootDir']."/main/intro.php");
}

## 모바일샵 일반인트로 사용일 경우 도메인으로 들어 온 것인지 메인으로 들어온 것인지 체크
if ( $cfg['introUseYNMobile'] == 'Y' && (int)$cfg['custom_landingpageMobile'] < 2 ) {
	if(preg_match('/^http(s)?:\/\/'.$_SERVER[SERVER_NAME].'\/m2$/',$_SERVER[HTTP_REFERER]) || strpos($_SERVER[HTTP_REFERER],"http://".$_SERVER[SERVER_NAME]) !==0 ){ // 인트로 사용
		header("location:intro/intro.php" . ($_SERVER[QUERY_STRING] ? "?{$_SERVER[QUERY_STRING]}" : ""));
	}
}

/* 모바일샵 팝업창 관리 시작 */
$today = date("Y-m-d H:i:s");
$hour = date("H");

$query = "	SELECT * FROM ".GD_MOBILEV2_POPUP." 
			WHERE open=1 
			and (	open_type=0 
					or 
					(open_type=1 and ('$today' between concat(start_date, ' ',if(length(start_time) = 1,concat('0',start_time),start_time),':00:00') 
										  and concat(end_date, ' ',if(length(end_time) = 1,concat('0',end_time),end_time),':59:59'))
					)
				)
			limit 0,1
";

$popup_query = $db->_query_print($query);
$res_popup = $db->_select($popup_query);
$popup_data = $res_popup[0];


if($popup_data['popup_type'] == '0') {
	$src = "../m/upload_img/".$popup_data['popup_img'];
	
	$size	= getimagesize($src);

	if($size[0] > 320)  $width='320';
	else				$width=$size[0];
	
	$popup_data['popup_img'] = goodsimgMobile($src,$width,'',1);
}
/* 모바일샵 팝업창 관리 종료 */

$tpl->assign('popup_data',$popup_data);

$tpl->print_('tpl');

?>