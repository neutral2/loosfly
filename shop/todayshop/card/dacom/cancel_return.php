<?php
include "../../../lib/library.php";
include "../../../conf/config.php";
include "../../../conf/pg.dacom.php";
include "../../../lib/cardCancel.class.php";

foreach ( $_POST as $k => $v ) $_POST[$k] = trim( $v );
extract($_POST);

### 결제로그 저장
if( !strcmp($respcode,"0000") ){
    $cancel = new cardCancel();
    $cancel -> cancel_proc($oid,'관리자 승인취소');
    msg('결제승인취소완료');
		echo("<script>parent.location.reload();</script>");
}else{
    msg('승인취소 실패!');
}
?>
