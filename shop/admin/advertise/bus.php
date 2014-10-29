<?php
$location = "¿ÀÇÁ¶óÀÎ±¤°í > ¹ö½º ±¤°í";
include "../_header.php";
$requestVar = array(
	'code'=>'marketing_advertise_bus'
);
?>
<div class="title title_top">¹ö½º ±¤°í</div>
<iframe name="inguide" src="../proc/remote_godopage.php?<?=http_build_query($requestVar)?>" frameborder="0" marginwidth="0" marginheight="0" width="100%" height="500" scrolling="no"></iframe>
<? include "../_footer.php"; ?>