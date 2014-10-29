<?
include dirname(__FILE__) . "/../_header.php";
include $shopRootDir . "/conf/fieldset.php";
@include $shopRootDir . "/conf/config.mobileShop.main.php";

$config = Core::loader('config');
$shopConfig = $config->load('config');
$hpauthDreamCfg = $config->load('hpauthDream');

if( ((int)$sess['level'] >=80 || $_SESSION['adult']) ){
	msg("°í°´´ÔÀº ÀÌ¹Ì ¼ºÀÎÀÎÁõ ÇÏ¼Ì½À´Ï´Ù.","index.php");
}

if (!$_GET['returnUrl']) $returnUrl = 'http://'.$_SERVER['HTTP_HOST'];
else $returnUrl = $_GET['returnUrl'];

$tpl->assign($_POST);
$tpl->assign('realnameyn', (empty($realname[id]) ? 'n' : empty($realname[useyn])? 'n': $realname[useyn]));
$tpl->assign('ipinyn', (empty($ipin[id]) ? 'n' : empty($ipin[useyn])? 'n': $ipin[useyn]));
$tpl->assign('niceipinyn', ($ipin[nice_useyn] == 'y' && $ipin[nice_minoryn] == 'y') ? 'y' : 'n');
$tpl->assign('hpauthDreamyn', ($hpauthDreamCfg['useyn'] == 'y' && $hpauthDreamCfg['minoryn'] == 'y') ? 'y' : 'n');
$tpl->assign('hpauthDreamcpid', $hpauthDreamCfg['cpid']);
$tpl->assign('shopName', $cfg['shopName']);

$tpl->print_('tpl');
?>
