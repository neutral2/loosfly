<?php
$location = "네이버 지식쇼핑 광고 > 네이버 포커스코너";
include "../_header.php";
$requestVar = array(
	'code'=>'marketing_naver_focus'
);
?>
<div class="title title_top">네이버 포커스코너</div>
<iframe name="inguide" src="../proc/remote_godopage.php?<?=http_build_query($requestVar)?>" frameborder="0" marginwidth="0" marginheight="0" width="100%" height="500" scrolling="no"></iframe>
<? include "../_footer.php"; ?>