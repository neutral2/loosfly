<?php
@include "../lib/library.php";
$godojuso = Core::loader('godojuso');
$gubun = $_GET['gubun'];
if (isset($_GET['isMobile'])) $godojuso->setMobile();

echo $godojuso->getCurlData($gubun);

/* ��) ���� Bridge ���� �����ϴ� ���
 * $returnurl = ProtocolPortDomain().$cfg['rootDir']."/proc/popup_address_bridge.php";
 * $godojuso->getCurlData($gubun, $returnurl);
 */
?>