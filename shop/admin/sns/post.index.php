<?php
$location = "SNS ���� > SNS �ǽð� ���� �ȳ�";
include "../_header.php";
$requestVar = array(
	'code'=>'sns_service_sharinginfo'
);
?>
<div class="title title_top">SNS �ǽð� ���� �ȳ�</div>
<iframe name="inguide" src="../proc/remote_godopage.php?<?=http_build_query($requestVar)?>" frameborder="0" marginwidth="0" marginheight="0" width="100%" height="1600" scrolling="no"></iframe>
<? include "../_footer.php"; ?>