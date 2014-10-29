<?
$location = "네이버 지식쇼핑 광고 상품 > 네이버 쇼핑캐스트 발행권";
include "../_header.php";
$requestVar = array(
	'code'=>'marketing_naver_minishop'
);
?>
<div class="title title_top">네이버 쇼핑캐스트 발행권</div>
<iframe name="inguide" src="../proc/remote_godopage.php?<?=http_build_query($requestVar)?>" frameborder="0" marginwidth="0" marginheight="0" width="100%" height="500" scrolling="no"></iframe>
<? include "../_footer.php"; ?>