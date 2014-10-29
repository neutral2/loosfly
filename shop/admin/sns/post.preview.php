<?
@require "../../lib/sns.class.php";

$previewData = $_POST;

$sns = new SNS();
$preview = $sns->get_post_listbox(null, $previewData);
echo $preview;
?>