<?php

$location = "네이트 바스켓 광고상품 > 네이트 바스켓 패션소호";
include "../_header.php";
$requestVar = array(
	'code'=>'marketing_basket'
);

?>

<div class="title title_top">네이트 바스켓 패션소호</div>

<iframe name="inguide" src="../proc/remote_godopage.php?<?=http_build_query($requestVar)?>" frameborder="0" marginwidth="0" marginheight="0" width="100%" height="500" scrolling="no"></iframe>

<?include "../_footer.php"; ?>