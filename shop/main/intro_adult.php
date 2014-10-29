<?
include "../_header.php";
include "../conf/fieldset.php";

$config = Core::loader('config');
$shopConfig = $config->load('config');
$hpauthDreamCfg = $config->load('hpauthDream');

if( Clib_Application::session()->isAdult() ){
	msg("°í°´´ÔÀº ÀÌ¹Ì ¼ºÀÎÀÎÁõ ÇÏ¼Ì½À´Ï´Ù.", -1 );
}

if (!$_GET['returnUrl']) $returnUrl = 'http://'.$_SERVER['HTTP_HOST'];
else $returnUrl = $_GET['returnUrl'];

$loginActionUrl = "../member/login_ok.php";

$tpl->assign($_POST);
$tpl->assign('realnameyn', (empty($realname[id]) ? 'n' : empty($realname[useyn])? 'n': $realname[useyn]));
$tpl->assign('ipinyn', (empty($ipin[id]) ? 'n' : empty($ipin[useyn])? 'n': $ipin[useyn]));
$tpl->assign('niceipinyn', ($ipin[nice_useyn] == 'y' && $ipin[nice_minoryn] == 'y') ? 'y' : 'n');
$tpl->assign('hpauthDreamyn', ($hpauthDreamCfg['useyn'] == 'y' && $hpauthDreamCfg['minoryn'] == 'y') ? 'y' : 'n');
$tpl->assign('hpauthDreamcpid', $hpauthDreamCfg['cpid']);
$tpl->assign('shopName', $cfg['shopName']);
$tpl->define('intro_auth', 'proc/intro_auth.htm');

$tpl->print_('tpl');
?>
