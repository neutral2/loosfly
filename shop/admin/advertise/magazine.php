<?php
$location = "오프라인광고 > 잡지 광고";
include "../_header.php";
$requestVar = array(
	'code'=>'marketing_advertise_magazine'
);
?>
<div class="title title_top">잡지 광고</div>
<iframe name="inguide" src="../proc/remote_godopage.php?<?=http_build_query($requestVar)?>" frameborder="0" marginwidth="0" marginheight="0" width="100%" height="500" scrolling="no"></iframe>
<? include "../_footer.php"; ?>