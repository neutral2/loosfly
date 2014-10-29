<?
$location = "해외판매 > 고글 안내/가입 > 고글 서비스 안내";
include "../_header.php";

$requestVar = array(
	'code'=>'service_gogl',
	'etc'=>array(
		'shopName'=>$cfg['shopName'],
		'shopUrl'=>$_SERVER['HTTP_HOST'],
	),
);

?>

<div class="title title_top">고글 서비스 안내</div>

<iframe name='innaver' src='../proc/remote_godopage.php?<?=http_build_query($requestVar)?>' frameborder='0' marginwidth='0' marginheight='0' width='100%' height='2100'></iframe>

<?include "../_footer.php"; ?>