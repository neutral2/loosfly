<?php
include "../../../lib/library.php";
include "../../../conf/config.php";
include "../../../conf/pg.dacom.php";
include "../../../lib/cardCancel.class.php";

foreach ( $_POST as $k => $v ) $_POST[$k] = trim( $v );
extract($_POST);

### �����α� ����
if( !strcmp($respcode,"0000") ){
    $cancel = new cardCancel();
    $cancel -> cancel_proc($oid,'������ �������');
    msg('����������ҿϷ�');
		echo("<script>parent.location.reload();</script>");
}else{
    msg('������� ����!');
}
?>