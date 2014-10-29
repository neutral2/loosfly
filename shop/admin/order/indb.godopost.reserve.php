<?php
include "../_header.popup.php";
include "../../lib/godopost.class.php";

if (get_magic_quotes_gpc()) {
	stripslashes_all($_POST);
	stripslashes_all($_GET);
}
function strcut_mb_custom($s, $l) {
if (!$s) return '';
preg_match('/^([\xa1-\xfe]{2}|.){'.$l.'}/s', $s, $m);
return (!$m[0]) ? $s : ($m[0].'...');
}


$godopost = new godopost();

$sel_dvcode = (array)$_POST['sel_dvcode'];
$ps_method = $_POST['ps_method'];

$regdt_start = (int)$_POST['regdt'][0];
$regdt_end = (int)$_POST['regdt'][1];

if($ps_method=='searched') { // �˻��� �ֹ� ��� ���� ��ȣ�� �Ҵ� �޾ƾ� �ϴ� ���
	// �˻� �迭 �����
	$arWhere=array();

	// �ֹ��� �˻�
	if($regdt_start && $regdt_end) {
		$tmp_start = date("Y-m-d 00:00:00",strtotime($regdt_start));
		$tmp_end = date("Y-m-d 23:59:59",strtotime($regdt_end));
		$arWhere[] = "orddt between '{$tmp_start}' and '{$tmp_end}'";
	}
	elseif($regdt_start) {
		$tmp_start = date("Y-m-d 00:00:00",strtotime($regdt_start));
		$arWhere[] = "orddt >= '{$tmp_start}'";
	}
	elseif($regdt_end) {
		$tmp_end = date("Y-m-d 23:59:59",strtotime($regdt_end));
		$arWhere[] = "orddt <= '{$tmp_end}'";
	}

	$arWhere[] = 'dvno="100"';
	$arWhere[] = 'isnull(r.deliverycode)';

	if(count($arWhere)) {
		$strWhere = 'where '.implode(" and ",$arWhere);
	}
	

	$query = "
		select 
			i.dvcode
		from
			gd_order_item as i
			left join gd_godopost_reserved as r on i.dvcode=r.deliverycode
		{$strWhere}
		group by 
			i.dvcode
	";
	$result = $db->_select($query);
	
	$sel_dvcode=array();
	foreach($result as $v) {
		$sel_dvcode[]=$v['dvcode'];
	}
}

?>

<div class="title title_top">��ü���ù� ���� ó�� ��</div>

<?=count($sel_dvcode)?>���� ���� ó�� ��...<br>

<?

$godopost->reserve_reset();

foreach($sel_dvcode as $each_dvcode) {
	$query = $db->_query_print("
		select
			ordno,
			goodsno,
			goodsnm,
			opt1,
			opt2,
			addopt,
			ea
		from
			gd_order_item
		where
			dvno='100' and
			dvcode=[s]
		order by
			sno
	",$each_dvcode);
	
	
	$item_result = $db->_select($query);
	$ordno = $item_result[0]['ordno'];

	$query = $db->_query_print("
		select
			nameOrder,
			phoneOrder,
			mobileOrder,
			nameReceiver,
			phoneReceiver,
			mobileReceiver,
			zipcode,
			address,
			memo,
			deli_type,
			deli_msg
		from
			gd_order
		where
			ordno=[s]
	",$ordno);
	$tmp = $db->_select($query);
	$order_result = $tmp[0];
	
	if(count($item_result) > 5) {
		$goodsnm1  = $item_result[0]['goodsnm'].'(���� : '.$item_result[0]['ea'].')'." �� ".(count($item_result)-1)."��";
		$goodscd1 = $item_result[0]['goodsno'];
	}
	else {
		$goodsnm1 = $item_result[0]['goodsnm'].'(���� : '.$item_result[0]['ea'].')';
		$goodscd1 = $item_result[0]['goodsno'];
		$goodsnm2 = $item_result[1]['goodsnm'].'(���� : '.$item_result[1]['ea'].')';
		$goodscd2 = $item_result[1]['goodsno'];
		$goodsnm3 = $item_result[2]['goodsnm'].'(���� : '.$item_result[2]['ea'].')';
		$goodscd3 = $item_result[2]['goodsno'];
		$goodsnm4 = $item_result[3]['goodsnm'].'(���� : '.$item_result[3]['ea'].')';
		$goodscd4 = $item_result[3]['goodsno'];
		$goodsnm5 = $item_result[4]['goodsnm'].'(���� : '.$item_result[4]['ea'].')';
		$goodscd5 = $item_result[4]['goodsno'];
	}


	if($order_result['deli_type']=='�ĺ�' && $order_result['deli_msg']=='0��') {
		$dfpayyn='N';
	}
	elseif($order_result['deli_type']=='�ĺ�'){
		$dfpayyn='Y';
	}
	elseif($order_result['deli_msg']=='���� ���� ��۹�') {
		$dfpayyn='Y';
	}
	else {
		$dfpayyn='N';
	}

	if(strlen($order_result['address'])>30) {
		$tmp = strrpos(substr($order_result['address'],0,30)," ");
		if(!$tmp) $tmp=30;
		$recprsnaddr = substr($order_result['address'],0,$tmp);
		$recprsndtailaddr = substr($order_result['address'],$tmp);
	}
	else {
		$recprsnaddr=$order_result['address'];
		$recprsndtailaddr="";
	}
	
	$arRequest=array(
		'sendreqdivcd'=>'01',
		'compdivcd'=>$godopost->config['compdivcd'],
		'orderno'=>$ordno,
		'regino'=>$each_dvcode,
		'recprsnnm'=>$order_result['nameReceiver'],
		'recprsntelno'=>getPurePhoneNumber($order_result['mobileReceiver']),	// ����߱޽�(����ܰ�) �������� ó������ �����Ƿ� �������� ����.
		'recprsnetctelno'=>getPurePhoneNumber($order_result['phoneReceiver']),
		'recprsnzipcd'=>str_replace('-','',$order_result['zipcode']),
		'recprsnaddr'=>$recprsnaddr,
		'recprsndtailaddr'=>$recprsndtailaddr,
		'orderprsnnm'=>$order_result['nameOrder'],
		'orderprsntelfno'=>$order_result['mobileOrder'],
		'orderprsnetctelno'=>'',
		'orderprsnzipcd'=>'',
		'orderprsnaddr'=>'',
		'orderprsndtailaddr'=>'',
		'sendwishymd'=>'',
		'sendmsgcont'=>strcut_mb_custom($order_result['memo'],50),
		'goodscd1'=>$goodscd1,
		'goodsnm1'=>$goodsnm1,
		'goodscd2'=>$goodscd2,
		'goodsnm2'=>$goodsnm2,
		'goodscd3'=>$goodscd3,
		'goodsnm3'=>$goodsnm3,
		'goodscd4'=>$goodscd4,
		'goodsnm4'=>$goodsnm4,
		'goodscd5'=>$goodscd5,
		'goodsnm5'=>$goodsnm5,
		'mailwght'=>'2000',
		'mailvolm'=>'60',
		'boxcnt'=>'',
		'dfpayyn'=>$dfpayyn,
		'expectrecevprc'=>'',
		'thisdddelivyn'=>'',
		'domexpyn'=>'',
		'microprclyn'=>'',
	);
	$godopost->reserve_add($arRequest);

	ctlStep($ordno,2);

}

$result = $godopost->reserve_send();

$date_reserved = time();
$insertValues=array();
foreach($result as $deliveryCode) {
	$insertValues[]=array($deliveryCode,$date_reserved);
}

$query = $db->_query_print("insert into gd_godopost_reserved (deliverycode,date_reserved) values [vs]",$insertValues);

$db->query($query);
?>
������ �Ϸ�Ǿ����ϴ�

<input type="button" value="�ݱ�" onclick="parent.location.href=parent.location.href;">
