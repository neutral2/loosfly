<?
$noDemoMsg = 1;
include "../_header.php";

$pathinfo = pathinfo($tpl->template_dir . DIRECTORY_SEPARATOR . $_GET['htmid']);

if (!in_array($pathinfo['extension'], array('htm'))) {
	$error = true;
}
else if (!preg_match('/^(\/data)?\/skin/', str_replace('\\','/',str_replace(SHOPROOT, '', realpath($pathinfo['dirname']))), $matches)) {
	$error = true;
}
else {
	$error = false;
}

if ($error === true) {
	go('../');
	exit;
}

### 팝업타이틀 변수 할당
if ( ereg("^popup/",$key_file) ) $popup_title = $data_file['text'];

$tpl->print_('tpl');
?>