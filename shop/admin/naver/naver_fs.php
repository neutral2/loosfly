<?php
$location = "���̹� ���ļ��� ���� > ���̹� �мǼ�ȣ";
include "../_header.php";
$requestVar = array(
	'code'=>'marketing_naver_fs'
);
?>
<div class="title title_top">���̹� �мǼ�ȣ</div>
<iframe name="inguide" src="../proc/remote_godopage.php?<?=http_build_query($requestVar)?>" frameborder="0" marginwidth="0" marginheight="0" width="100%" height="500" scrolling="no"></iframe>
<? include "../_footer.php"; ?>