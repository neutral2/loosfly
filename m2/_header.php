<?
/*********************************************************
* 파일명     :  _header.php
* 프로그램명 :	모바일샵 헤더파일
* 작성자     :  dn
* 생성일     :  2012.04.14
**********************************************************/	
include dirname(__FILE__).'/lib/library.php';
include $shopRootDir . "/Template_/Template_.class.php";
include_once $shopRootDir . "/lib/tplSkinMobileView.php";
/*
$cfg_mobileshop_query = $db->_query_print('SELECT name, value FROM gd_env WHERE category=[s]', 'cfg_mobileshop');
$res_cfg_mobileshop = $db->_select($cfg_mobileshop_query);
$cfg_mobileshop = Array();

if(!empty($res_cfg_mobileshop) && is_array($res_cfg_mobileshop)) {
	foreach($res_cfg_mobileshop as $row_cfg_mobileshop) {
		$cfg_mobileshop[$row_cfg_mobileshop['name']] = $row_cfg_mobileshop['value'];
	}
}
*/

if(!$cfgMobileShop['tplSkinMobile']) $cfgMobileShop['tplSkinMobile'] = 'default';

### 메타태그 변수 할당
$meta_title = $cfg['title'];
$meta_keywords = $cfgMobileShop['keywords'];
$shop_name = $cfg['shopName'];

$tpl = new Template_;
$tpl->template_dir	= $shopRootDir."/data/skin_mobileV2/".$cfgMobileShop['tplSkinMobile'];
$tpl->compile_dir	= $shopRootDir."/Template_/_compiles/skin_mobileV2/".$cfgMobileShop['tplSkinMobile'];
$tpl->prefilter		= "adjustPath|include_file|capture_print";

{ // File Key
$key_file = preg_replace( "'^.*$mobileRootDir/'si", "", $_SERVER['SCRIPT_NAME'] );
$key_file = preg_replace( "'\.php$'si", ".htm", $key_file );
 
if ( $key_file == 'html.htm' && $_GET['htmid'] != '' ) $key_file = $_GET['htmid'];

$data_file		= $design_skin[ $key_file ];		# File Data
}

	$referer_url = parse_url($_SERVER['HTTP_REFERER']);
	$host_url = explode(":",$_SERVER['HTTP_HOST']);

	$referer_domain = str_replace('www.','',$referer_url['host']);
	$shop_domain = str_replace('www.','',$host_url[0]);

	$cookie_domain = str_replace('www','',$host_url[0]);
	if(substr($cookie_domain,0,1) != '.') $cookie_domain = ".".$cookie_domain;

	### 성인인증 인트로
	if($cfg[custom_landingpageMobile] > 1 && !preg_match( "/intro\/intro*/", $key_file) && !preg_match( "/mem\/join*/", $key_file) && !preg_match( "/mem\/login*/", $key_file) && !preg_match( "/proc\/zipcode*/", $key_file)){
	
		if ($cfg[custom_landingpageMobile] == 2 && !((int)$sess['level'] >=80 || $_SESSION['adult'])) {    // 성인
			header('location:'.$mobileRootDir.'/intro/intro_adult.php' . ($_SERVER['QUERY_STRING'] ? '?'.$_SERVER['QUERY_STRING'] : ''));
		}
		elseif ($cfg[custom_landingpageMobile] == 3 && !$sess) {    // 회원
			header('location:'.$mobileRootDir.'/intro/intro_member.php' . ($_SERVER['QUERY_STRING'] ? '?'.$_SERVER['QUERY_STRING'] : ''));
		}
	}

	function _destroyNcachCookie() {

		global $cookie_domain;

		$expire = time() - 3600;

		foreach (array('Ncisy','N_t','N_e','N_ba','N_aa') as $v) {
		setCookie($v, "", $expire ,"/",$cookie_domain);
		$_COOKIE[$v] = "";
		}
		setCookie("cookie_check",0,0,'/',$cookie_domain); # 유효기간 24시간

	}
	if ($_COOKIE['N_e'] < time()) {
		_destroyNcachCookie();
	}
	else if ($_COOKIE['cookie_check'] != 1) {
		_destroyNcachCookie();
	}
	else if ($referer_domain && ($shop_domain != $referer_domain) && (!preg_match('/(naver\.com|godo\.co\.kr)/',$referer_url['host']))){
		_destroyNcachCookie();
	}
	

$mobile_script = array();

$mobile_script[] = array('script_file'=>$mobileRootDir.'/lib/js/mobileAction.js');
$mobile_script[] = array('script_file'=>$mobileRootDir.'/lib/js/mobileCommon.js');
$mobile_script[] = array('script_file'=>$mobileRootDir.'/lib/js/mobileDisplay.js');
$mobile_script[] = array('script_file'=>$mobileRootDir.'/lib/js/mobileAnalysis.js');
$mobile_script[] = array('script_file'=>$mobileRootDir.'/lib/js/swipe/swipe.js');
$mobile_script[] = array('script_file'=>$mobileRootDir.'/lib/js/iscroll/iscroll.js');
$mobile_script[] = array('script_file'=>$mobileRootDir.'/lib/js/mobileCommon2.js');

// 커스텀헤더 초기화
$customHeader = '';

// 네이버 공통유입 스크립트
$naverCommonInflowScript = &load_class('NaverCommonInflowScript', 'naverCommonInflowScript');
$customHeader .= $naverCommonInflowScript->getCommonInflowScript();

if(strstr($_SERVER[PHP_SELF], 'goods/view')) {
	$mobile_script[] = array('script_file'=>$mobileRootDir.'/lib/js/kakaoLink.js');
} 

$tpl->define( array(
	'tpl'			=> $key_file,
	'header'		=> 'outline/_header.htm',
	'footer'		=> 'outline/_footer.htm',
	'sub_header'	=> 'outline/_sub_header.htm',
	) );

$now_cate = $_GET['category'];

$tpl->assign( array(
	mobile_dir	=> $mobileRootDir,
	shop_dir	=> $shopRootDir,
	pfile	=> basename($_SERVER[PHP_SELF]),
	pdir	=> basename(dirname($_SERVER[PHP_SELF])),
	mobile_script => $mobile_script,
	now_cate => $now_cate,
	customHeader => $customHeader
	) );

//하단주소
$cfg['old_address'] = $cfg['address'];
if($cfg['road_address']) {
	$cfg['address'] = $cfg['road_address'];
} else {
	$cfg['address'] = $cfg['address'];
}
?>