<?php

include dirname(__FILE__) . "/../_header.php";
@include $shopRootDir . "/lib/cart.class.php";
@include $shopRootDir . "/conf/config.pay.php";
@include $shopRootDir . "/conf/coupon.php";
@include $shopRootDir . "/conf/pg_mobile.$cfg[settlePg].php";

// getordno �Լ��� /shop/lib/lib.func.php ���Ϸ� �̵�
if(!function_exists('getordno')) {
	function getordno(){
		global $db;
		$old = (time() - 86400) .'999';
		$db->query("delete from ".GD_ORDER_TEMP . " where ordno < '$old'");
		$ordno = time().sprintf("%03d",rand(0,999));
		$query = "insert into ".GD_ORDER_TEMP." (ordno)  values('$ordno')";
		$res = $db->query($query);
		if($res) return $ordno;
		else getordno();
	}
}

### ȸ������ ��������
if ($sess){
	$query = "
	select * from
		".GD_MEMBER." a
		left join ".GD_MEMBER_GRP." b on a.level=b.level
	where
		m_no='$sess[m_no]'
	";
	$member = $db->fetch($query,1);
	$style_member = "readonly";
}

$mobilians = Core::loader('Mobilians');

### ��ٱ��� ��Ű ����
if ($_POST[mode]=="addItem" && !$_COOKIE[gd_isDirect]) setcookie('gd_isDirect',1,0,'/');
$isDirect = ($_POST[mode]=="addItem" || $_COOKIE[gd_isDirect]) ? 1 : 0;

$cart = new Cart($isDirect); 
if ($_POST[mode]=="addItem"){
	chkOpenYn($_POST[goodsno],"D",-1);	//�������� üũ
	$cart->addCart($_POST[goodsno],$_POST[opt],$_POST[addopt],$_POST[_addopt_inputable],$_POST[ea],$_POST[goodsCoupon]);
}
else {
	chkOpenYn($cart,"D",-1);
}

if (!isset($_POST[idxs])) $_POST[idxs] = $_COOKIE['_posted_idxs'] ? unserialize( get_magic_quotes_gpc() ? stripslashes($_COOKIE['_posted_idxs']) : $_COOKIE['_posted_idxs']) : 'all';
$cart->setOrder($_POST[idxs]);	// $_POST[idxs] �� , �� ���е� 0 �̻��� ���� �Ǵ� 'all'


if(!$cart->item) echo "<script>history.back();</script>";

if($member){
	$cart->excep = $member['excep'];
	$cart->excate = $member['excate'];
	$cart->dc = $member[dc]."%";
}
$cart -> coupon = $_POST['coupon'];
$cart -> coupon_emoney = $_POST['coupon_emoney'];
$cart->calcu();


### s1��Ų���� ���� �⺻ ��ۺ� ��������
$param = array(
	'mode' => '0',
	'zipcode' => $member[zipcode],
	'emoney' => 0,
	'deliPoli' => 0,
	'coupon' => 0
);

$delivery = getDeliveryMode($param);
$cart -> delivery = $delivery['price'];
$cart -> totalprice += $delivery['price'];

### �ܿ� ��� üũ........2007-07-18 modify
if ($cart->item) {
	foreach ($cart->item as $v){
		$cart->chkStock($v[goodsno],$v[opt][0],$v[opt][1],$v[ea]);
	}
}
//debug($sess);
//debug($_GET);


### ��ȸ���� ��� �α���â���� �̵�
if ($_GET[guest]) setCookie('guest',1,0,'/');
if (!$sess && !$_GET[guest] && !$_COOKIE[guest]){
	setCookie('_posted_idxs', serialize($_POST[idxs]) ,0,'/');
	go("../mem/login.php?guest=1&returnUrl=$_SERVER[PHP_SELF]");
}
else {
	# ��ȸ���� ���� �α����������� �������� �� �����Ƿ�, _posted_idxs �� ��Ű�� �����Ǿ��� �� �ִ�
	# ����, _posted_idxs �� �����ش�. 
	setCookie('_posted_idxs', false , time() - 86400 ,'/');
}

### �ֹ���ȣ ����
$ordno = getordno();

$set['emoney']['base'] = pow(10,$set['emoney']['cut']);

### ������ ������
if(!$set['emoney']['emoney_use_range'])$tmp = $cart->goodsprice;
else $tmp = $cart->totalprice;
$tmp = $tmp - getDcPrice($cart->goodsprice,$cart->dc);
$emoney_max = getDcprice($tmp,$set[emoney][max])+0;

$r_deli = explode('|',$set['r_delivery']['title']);

if ($member){
	$member[zipcode] = explode("-",$member[zipcode]);
	$member[phone] = explode("-",$member[phone]);
	$member[mobile] = explode("-",$member[mobile]);
	$tpl->assign($member);
}

$naverNcash = Core::loader('naverNcash');
$load_config_ncash = $config->load('ncash');

if ($naverNcash->canUseMobile() === false) {
	$load_config_ncash['useyn'] = 'N';
	$naverNcash->useyn = 'N';
}

// ���̹� ���ϸ��� ���� ���ܻ�ǰ üũ
$exceptionYN = $naverNcash->exception_goods($cart->item);
$load_config_ncash['exception_price'] = $naverNcash->exception_price($cart->item);

if ($naverNcash->useyn == 'Y' && $exceptionYN == 'N') {
	$tpl->assign('NaverMileageScript', $naverNcash->getMobileScript());
	$tpl->assign('NaverMileageConfig', $load_config_ncash);
	$tpl->assign('NaverMileageForm', include dirname(__FILE__).'/../../shop/proc/naver_mileage/accum_order_form_type_2.php');
	$tpl->assign('NaverMileageForm2', include dirname(__FILE__).'/../../shop/proc/naver_mileage/accum_order_form_type_3.php');
	$tpl->assign('NaverMileageCalc', include dirname(__FILE__).'/../../shop/proc/naver_mileage/accum_order_calc_type_1.php');
}

// ������� ���񽺰� Ȱ��ȭ �Ǿ����� �� ����� ���� �߰� ����
if ($mobilians->isEnabled()) {
	$set['use_mobile']['h'] = 'on';
	$tpl->assign('Mobilians_PaymentLimitPrice', Mobilians::DEFAULT_PAYMENT_LIMIT_PRICE);
}

$tpl->assign('cart',$cart);
$tpl->assign('ordno',$ordno);
$tpl->print_('tpl');

?>