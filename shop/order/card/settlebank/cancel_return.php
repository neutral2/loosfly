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

### �����α� ����
print_r($respStr2);
if( !strcmp($respcode,"0000") ){
    $cancel = new cardCancel();
    $cancel -> cancel_proc($oid,'������ �������');
    msg('����������ҿϷ�');
	echo("<script>parent.location.reload();</script>");
}else{
    msg('������� ����!');
}
?>