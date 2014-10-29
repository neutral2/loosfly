<?php
$location = "검색 광고 > 엔비스타";
include "../_header.php";
$requestVar = array(
	'code'=>'marketing_nvista'
);
?>
<div class="title title_top">엔비스타</div>
<iframe name="inguide" src="../proc/remote_godopage.php?<?=http_build_query($requestVar)?>" frameborder="0" marginwidth="0" marginheight="0" width="100%" height="500" scrolling="no"></iframe>
<? include "../_footer.php"; ?>