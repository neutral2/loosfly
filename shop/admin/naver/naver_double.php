<?php
$location = "입점대행 서비스 > 네이버 더블 마케팅";
include "../_header.php";
$requestVar = array(
	'code'=>'marketing_naver_double'
);
?>
<div class="title title_top">네이버 더블 마케팅</div>
<iframe name="inguide" src="../proc/remote_godopage.php?<?=http_build_query($requestVar)?>" frameborder="0" marginwidth="0" marginheight="0" width="100%" height="500" scrolling="no"></iframe>
<? include "../_footer.php"; ?>