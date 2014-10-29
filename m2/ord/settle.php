<?
$_POST[emoney] = str_replace(",","",$_POST[emoney]);
$_POST[coupon] = str_replace(",","",$_POST[coupon]);
$_POST[coupon_emoney] = str_replace(",","",$_POST[coupon_emoney]);

include dirname(__FILE__) . "/../_header.php";
@include $shopRootDir . "/lib/cart.class.php";
@include $shopRootDir . "/conf/config.pay.php";

if (!$_POST[ordno]) msg("주문번호가 존재하지 않습니다","order.php");
//debug($_POST); exit; 
### 회원정보 가져오기
if ($sess){
	$query = "
	select * from
		".GD_MEMBER." a
		left join ".GD_MEMBER_GRP." b on a.level=b.level
	where
		m_no='$sess[m_no]'
	";
	$member = $db->fetch($query,1);
}

### 적립금 유효성 체크
chkEmoney($set[emoney],$_POST[emoney]);

$mobilians = Core::loader('Mobilians');

if ($_POST['save_mode'] != '') {
	$load_config_ncash = $config->load('ncash');
}
else{
	$load_config_ncash = array();
}

$cart = new Cart($_COOKIE[gd_isDirect]);

### 주문서 정보 체크
$cart -> chkOrder();

if($member){
	$cart->excep = $member['excep'];
	$cart->excate = $member['excate'];
	$cart->dc = $member[dc]."%";
}
$cart -> coupon = $_POST['coupon'];
$cart->calcu();

$param = array(
	'mode' => '0',
	'zipcode' => @implode("",$_POST['zipcode']),
	'emoney' => $_POST['emoney'],
	'deliPoli' => $_POST['deliPoli'],
	'coupon' => $_POST['coupon']
);

$delivery = getDeliveryMode($param);
if ($delivery[type]=="후불" && $delivery[freeDelivery] =="1") {
	$msg_delivery = "- 0원";
} else {
	$msg_delivery = $delivery[msg];
}
if($delivery[price] && !$delivery[msg]){
	$msg_delivery = number_format($delivery[price])."원";
}
$cart -> delivery = $delivery[price];
$cart -> totalprice += $delivery[price];

### 장바구니 내역 존재 여부 체크
if (count($cart->item)==0) msg("주문내역이 존재하지 않습니다","../index.php");

### 적립금 재계산
$_POST['coupon'] = $cart -> coupon;
$discount = $_POST[coupon] + $_POST[emoney] + $cart->dcprice + $_POST['totalUseAmount'.$load_config_ncash['api_id']] + $cart->special_discount_amount;
if ($cart->totalprice - $discount < 0){
	## 총할인금액이 상품합계액보다 많으면, 할인에 사용되는 적립금을 조정한다. 
	$_POST[emoney] = $cart->totalprice - $_POST[coupon]-$cart->dcprice - $_POST['totalUseAmount'.$load_config_ncash['api_id']] - $cart->special_discount_amount;
}

### 쿠폰, 적립금 중복 사용 체크
if (! $set['emoney']['useduplicate']) {
	if ($_POST['emoney'] > 0 && ($_POST['coupon'] > 0 || $_POST['coupon_emoney'] > 0)) {
		msg('적립금과 쿠폰 사용이 중복적용되지 않습니다.',-1);
		exit;
	}
}

### 주문정보 체크
chkCartMobile(&$cart, $cfgMobileShop['vtype_goods']);
 
### 결제금액 설정
$discount = $_POST[coupon] + $_POST[emoney] + $cart->dcprice + $_POST['totalUseAmount'.$load_config_ncash['api_id']] + $cart->special_discount_amount;
$_POST[settleprice] = $cart->totalprice - $discount;

### 회원 추가 적립금 설정
switch($member['add_emoney_type']) {
	case 'goods':
		$tmp_price = $cart->goodsprice;
		break;
	case 'settle_amt':
		$tmp_price = $_POST[settleprice];
		break;
	default:
		$tmp_price = 0;
		break;
}
$addreserve = getExtraReserve($member['add_emoney'], $member['add_emoney_type'], $member['add_emoney_std_amt'], $tmp_price, $cart);

### 주문금액이 0일 경우 (적립금/할인결제시)
if ($_POST[settleprice]==0 && $discount>0){
	$_POST[settlekind] = "d";	// 할인결제
}

### 결제수단에 따른 설정
switch ($_POST[settlekind]){

	case "a":	// 무통장입금

		### 무통장입금 계좌 리스트
		$res = $db->query("select * from ".GD_LIST_BANK." where useyn='y'");
		while ($data= $db->fetch($res)) $bank[] = $data;
		break;
	case "c":	// 신용카드
	case "o":	// 계좌이체
	case "v":	// 가상계좌
	case "h":	// 핸드폰
		if ($_POST['settlekind'] == 'h' && $mobilians->isEnabled() === true) {
			if (Mobilians::overflowLimitPrice($_POST['settleprice']) === false) {
				msg('휴대폰 결제 가능 금액은 '.number_format(Mobilians::DEFAULT_PAYMENT_LIMIT_PRICE).'원 이하 입니다.\r\n(한도금액은 본인 설정 또는 통신사별로 금액 차이가 있습니다.)', -1);
			}
		}
	case "p":	// 포인트
		@include $shopRootDir.'/conf/pg.'.$cfg['settlePg'].'.php';
		@include $shopRootDir.'/conf/pg_mobile.'.$cfg['settlePg'].'.php';
		if (isset($pg_mobile) && isset($pg['id']) && strlen($pg['id']) > 0) {
			ob_start();
			include $shopRootDir."/order/card/$cfg[settlePg]/mobile/card_gate.php";
			$card_gate = ob_get_contents();
			ob_end_clean();
			$tpl->assign('card_gate',$card_gate);
		}
		break;

	case "d":	// 할인결제 (결제금액이 0일 경우)

		break;

}

### 주문데이타 가공
$_POST[memo] = htmlspecialchars(stripslashes($_POST[memo]), ENT_QUOTES);

// 네이버 Ncash
if($load_config_ncash['useyn'] == 'Y'){

	$load_config_ncash['ncash_emoney'] = $_POST['mileageUseAmount'.$load_config_ncash['api_id']];
	$load_config_ncash['ncash_cash'] = $_POST['cashUseAmount'.$load_config_ncash['api_id']];
	$load_config_ncash['totalAccumRate'] = $_POST['baseAccumRate'] + $_POST['addAccumRate'];
	if(in_array($load_config_ncash['save_mode'],array('choice','both'))) $load_config_ncash['save_mode'] = $_POST['save_mode'];	// 적립 위치

	// 네이버 포인트 적립일 때 회원추가적립금 0원으로 변경
	if( $load_config_ncash['save_mode'] == 'ncash' ) $addreserve = 0;

	// 트랜잭션 아이디 쿠키값 저장
	setcookie('reqTxId',$_POST['reqTxId'.$load_config_ncash['api_id']],0);

	$tpl->assign('ncash',$load_config_ncash);
}
$tpl->assign('NaverMileageAmount', include dirname(__FILE__).'/../../shop/proc/naver_mileage/use_amount_type_1.php');

$tpl->assign('MobiliansEnabled', $mobilians->isEnabled());

//debug($_POST); 
//debug($cart);
//exit; 
### 템플릿 출력
$tpl->assign($_POST);
$tpl->assign('cart',$cart);
$tpl->define(array(
			'orderitem'	=> '/proc/orderitem.htm',
			));
$tpl->print_('tpl');

?>
