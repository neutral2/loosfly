<?php
	include dirname(__FILE__) . "/_header.php";
	@include $shopRootDir . "/conf/config.pay.php";
	@include $shopRootDir . "/conf/config.mobileShop.main.php";

	$_view_search_form = true;
	$mainpage = true;

	if(!$cfgMobileShop['useMobileShop']){
		header("location:".$cfg['rootDir']."/main/intro.php");
	}
	
	## ����ϼ� �Ϲ���Ʈ�� ����� ��� ���������� ��� �� ������ �������� ���� ������ üũ
	if ( $cfg['introUseYNMobile'] == 'Y' && (int)$cfg['custom_landingpageMobile'] < 2 ) {
		if(preg_match('/^http(s)?:\/\/'.$_SERVER[SERVER_NAME].'\/m$/',$_SERVER[HTTP_REFERER]) || strpos($_SERVER[HTTP_REFERER],"http://".$_SERVER[SERVER_NAME]) !==0 ){ // ��Ʈ�� ���
			header("location:intro/intro.php" . ($_SERVER[QUERY_STRING] ? "?{$_SERVER[QUERY_STRING]}" : ""));
		}
	}

	$tpl->print_('tpl');
?>