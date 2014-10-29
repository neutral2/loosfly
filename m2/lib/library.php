<?
	header("Expires: ".gmdate("D, d M Y H:i:s", time()+3600)." GMT");
	header('Cache-Control: max-age = 3600, private'); 
	
	$path_var = explode("/",$_SERVER['SCRIPT_NAME']);

	if (is_array($path_var) && count($path_var) > 1) {
		$mobileRootDir = "/".$path_var[1];
	} else {
		$mobileRootDir = "/m";
	}
	$shopRootDir = dirname(__FILE__)."/../../shop";
	@include dirname(__FILE__)."/lib.func.php";
	
	@include $shopRootDir . "/lib/library.php";
	
	@include $shopRootDir . "/conf/config.php";
	@include $shopRootDir . "/conf/config.mobileShop.php";

	// 모바일샵 design_basic의 conf 파일 불러옴
	if(is_file( $shopRootDir . "/conf/design_basicMobileV2_".$cfg['tplSkinMobile'].".php")){
		include $shopRootDir . "/conf/design_basicMobileV2_".$cfg['tplSkinMobile'].".php";
	}
	Clib_Application::setMobile();
?>