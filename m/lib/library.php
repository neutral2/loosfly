<?
	$mobileRootDir = "/m";
	$shopRootDir = dirname(__FILE__)."/../../shop";

	@include dirname(__FILE__)."/lib.func.php";
	@include $shopRootDir . "/lib/library.php";
	@include $shopRootDir . "/conf/config.php";
	@include $shopRootDir . "/conf/config.mobileShop.php";

	// ����ϼ� design_basic�� conf ���� �ҷ���
	if(is_file( $shopRootDir . "/conf/design_basicMobile_".$cfg['tplSkinMobile'].".php")){
		include $shopRootDir . "/conf/design_basicMobile_".$cfg['tplSkinMobile'].".php";
	}
	Clib_Application::setMobile();
?>