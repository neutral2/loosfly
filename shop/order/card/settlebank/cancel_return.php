<?php
include "../../../lib/library.php";
include "../../../conf/config.php";
include "../../../conf/pg.settlebank.php";
include "../../../lib/cardCancel.class.php";

foreach ( $_POST as $k => $v ) $_POST[$k] = URLdecode(trim( $v ));

extract($_POST);
$respStr2 = explode(':',$_POST['respStr2']);

$oid = $respStr2[4];
$respcode = $respStr2[2];

### 결제로그 저장
print_r($respStr2);
if( !strcmp($respcode,"0000") ){
    $cancel = new cardCancel();
    $cancel -> cancel_proc($oid,'관리자 승인취소');
    msg('결제승인취소완료');
	echo("<script>parent.location.reload();</script>");
}else{
    msg('승인취소 실패!');
}
?>
