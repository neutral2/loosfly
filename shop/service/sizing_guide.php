<?
$noDemoMsg = 1;
include "../_header.php";

### 팝업타이틀 변수 할당
if ( ereg("^popup/",$key_file) ) $popup_title = $data_file['text'];

$size_type = $_GET[size_type];
if( strlen($size_type) == 0 )
	$size_type = "women";

$tpl->assign(array(
	'size_type' => "$size_type"
));
$tpl->print_('tpl');
?>