<?php
$location = "SNS 서비스 > SNS 실시간 연동 안내";
include "../_header.php";
$requestVar = array(
	'code'=>'sns_service_sharinginfo'
);
?>
<div class="title title_top">SNS 실시간 연동 안내</div>
<iframe name="inguide" src="../proc/remote_godopage.php?<?=http_build_query($requestVar)?>" frameborder="0" marginwidth="0" marginheight="0" width="100%" height="1600" scrolling="no"></iframe>
<? include "../_footer.php"; ?>