<?
$noDemoMsg = 1;
include "../_header.php";

### �˾�Ÿ��Ʋ ���� �Ҵ�
if ( ereg("^popup/",$key_file) ) $popup_title = $data_file['text'];

$tpl->print_('tpl');
?>