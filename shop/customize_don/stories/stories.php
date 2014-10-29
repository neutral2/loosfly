<?
$noDemoMsg = 1;
include "../_header.php";

### 팝업타이틀 변수 할당
if ( ereg("^popup/",$key_file) ) $popup_title = $data_file['text'];

$tpl->print_('tpl');
?>