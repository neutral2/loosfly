<?
include dirname(__FILE__)."/../conf/config.php";
include dirname(__FILE__)."/lib.php";
include dirname(__FILE__)."/lib.skin.php";
include dirname(__FILE__)."/../lib/blogshop.class.php";

$blogshop = new blogshop();

// �����ΰ����϶� SET_HTML_DEFINE ����, SET_HTML5 ����
if ((preg_match('/\/admin\/design$/', dirname($_SERVER['PHP_SELF'])) || preg_match('/\/admin\/mobileShop(2|)$/', dirname($_SERVER['PHP_SELF']))) && strpos(basename($_SERVER['PHP_SELF']), 'iframe.') === 0) {
	$SET_HTML_DEFINE = true;
	$SET_HTML5 = true;
}

// SET_HTML_DEFINE�� ����� �������� �ű� ������ ������(adm_*.php) ������ DTD(xhtml)�� ����
if ($SET_HTML_DEFINE || strpos(basename($_SERVER['PHP_SELF']), 'adm_') === 0) {
	if ($SET_HTML5) {
		$DEFINE_DOCTYPE = '<!DOCTYPE html>';
		$scriptLoad .= '<style>img { vertical-align:top; }</style>';
	}
	else $DEFINE_DOCTYPE = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
	$DEFINE_HTML = $DEFINE_DOCTYPE.'<html xmlns="http://www.w3.org/1999/xhtml" lang="ko" xml:lang="ko">';
	$DEFINE_EXTRA_TAGS = '<meta http-equiv="X-UA-Compatible" content="IE=edge" />';
	$DEFINE_EXTRA_TAGS.= '<script type="text/javascript" src="'.$cfg['rootDir'].'/lib/js/jquery-1.10.1.min.js"></script>';
	$DEFINE_EXTRA_TAGS.= '<script type="text/javascript" src="'.$cfg['rootDir'].'/lib/js/jquery-ui.js"></script>';
	$DEFINE_EXTRA_TAGS.= '<script type="text/javascript">jQuery.noConflict();</script>';
}
else {
	$DEFINE_HTML = '<html>';
	$DEFINE_EXTRA_TAGS = '';
}
?>
<?php echo $DEFINE_HTML; ?>
<head>
<title>'Godo Shoppingmall e���� Season4 �����ڸ��'</title>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$_CFG['global']['charset']?>">
<?php echo $DEFINE_EXTRA_TAGS; ?>
<link rel="styleSheet" href="../style.css">
<script type="text/javascript" src="../common.js"></script>
<script type="text/javascript" src="../prototype.js"></script>
<script type="text/javascript" src="../prototype_ext.js"></script>
<script type="text/javascript" src="../../lib/js/json/json2.min.js"></script>
<?=$scriptLoad?>
<script language="javascript">
if(window.addEventListener)
{
	window.addEventListener('load',linecss,false);
}
else
{
	window.attachEvent('onload',linecss);
}
</script>
<div id="dynamic"></div>
<iframe name="ifrmHidden" src="../../blank.php" style="display:none;height:100px;width:100%;"></iframe>
<div id="jsmotion"></div>

<body class="scroll" <?// if (!$_GET['ifrmScroll']){ echo "onmousewheel=\"return iciScroll(document.body)\""; } ?>>