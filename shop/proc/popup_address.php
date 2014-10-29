<?php
@include "../lib/library.php";
$godojuso = Core::loader('godojuso');
$gubun = $_GET['gubun'];
if (isset($_GET['isMobile'])) $godojuso->setMobile();

echo $godojuso->getCurlData($gubun);

/* 예) 별도 Bridge 파일 구성하는 경우
 * $returnurl = ProtocolPortDomain().$cfg['rootDir']."/proc/popup_address_bridge.php";
 * $godojuso->getCurlData($gubun, $returnurl);
 */
?>