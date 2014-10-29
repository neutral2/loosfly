<?
include "../_header.php";
include "../conf/config.pay.php";
@include "../conf/pg.$cfg[settlePg].php";
include "../conf/pg.escrow.php";
@include "../conf/egg.usafe.php";
$mobilians = Core::loader('Mobilians');

// getordno 함수는 /shop/lib/lib.func.php 파일로 이동

if (!$_POST[ordno]) msg("주문번호가 존재하지 않습니다","order.php");

$data = $db->fetch("select * from ".GD_ORDER." where ordno='".$_POST[ordno]."'");
if($cfg['autoCancelFail'] > 0){
	$ltm = toTimeStamp($data['orddt']) + 3600 * $cfg['autoCancelFail'] ;
	if($ltm < time()){
		msg('재결재 가능시간은 결재후 '.$cfg['autoCancelFail'].'시간 까지입니다.\n재결제 기간이 만료 되었습니다.',-1);
		exit;
	}
}


$data[phoneOrder] = explode('-',$data[phoneOrder] );
$data[mobileOrder] = explode('-',$data[mobileOrder] );

// 수취인 전화번호
$data[phoneReceiver] = explode('-',$data[phoneReceiver] );
$data[mobileReceiver] = explode('-',$data[mobileReceiver] );
$data['zipcode'] = explode('-',$data['zipcode'] );

$_POST['nameReceiver'] = $data['nameReceiver'];
$_POST['phoneReceiver'] = $data['phoneReceiver'];
$_POST['mobileReceiver'] = $data['mobileReceiver'];
$_POST['zipcode'] = $data['zipcode'];
$_POST['address'] = $data['address'];
$_POST['email'] = $data['email'];

// 에스크로
$_POST[escrow] = ($_POST[escrowyn] == 'y' ? 'Y': 'N');
$tpl->assign('escrow',$_POST[escrow]);

$ordno = $_POST[ordno];
if($data[step2] == 54){	// 결제 실패시 주문번호 교체
	$ordno = $data['ordno'] = getordno();
	$db->query("update ".GD_ORDER." set ordno='$ordno' where ordno='".$_POST[ordno]."'");
	$db->query("update ".GD_ORDER_ITEM." set ordno='$ordno' where ordno='".$_POST[ordno]."'");
	$db->query("update ".GD_COUPON_ORDER." set ordno='$ordno' where ordno='".$_POST[ordno]."'");
	$db->query("update ".GD_INTEGRATE_ORDER." set ordno='$ordno' where channel = 'enamoo' AND ordno='".$_POST[ordno]."'");
	$db->query("update ".GD_INTEGRATE_ORDER_ITEM." set ordno='$ordno' where channel = 'enamoo' AND ordno='".$_POST[ordno]."'");
	$_POST[ordno] = $ordno;
}

$res = $db->query(" SELECT OI.*, TG.todaygoods FROM ".GD_ORDER_ITEM." AS OI LEFT JOIN ".GD_TODAYSHOP_GOODS_MERGED." AS TG ON OI.goodsno = TG.goodsno WHERE OI.ordno = ".$ordno." ");
$isTodayshop = false;
while($tmp = $db->fetch($res)){
	if ($tmp['todaygoods'] == 'y') $isTodayshop = true;
	list($tmp['img_s']) = $db->fetch("select img_s from ".GD_GOODS." where goodsno='".$tmp['goodsno']."'");
	$item[] = $tmp;
}


### 결제금액 설정
$discount = $data['coupon'] + $data['emoney'] + $data['memberdc'] + $data['ncash_emoney'] + $data['ncash_cash'];
$data['settleprice'] = $data['goodsprice'] - $discount + $_POST['eggFee'] + $data['delivery'];
$_POST[settleprice]=$data['settleprice'];
$tpl->assign($data);

### 결제수단에 따른 설정
switch ($data[settlekind]){

	case "a":	// 무통장입금

		### 무통장입금 계좌 리스트
		$res = $db->query("select * from ".GD_LIST_BANK." where useyn='y'");
		while ($tmp = $db->fetch($res)) $bank[] = $tmp;

		break;

	case "c":	// 신용카드
	case "o":	// 계좌이체
	case "v":	// 가상계좌
	case "h":	// 핸드폰
		if ($_POST['settlekind'] == 'h' && $mobilians->isEnabled() === true) {
			if (Mobilians::overflowLimitPrice($_POST['settleprice']) === false) {
				msg('휴대폰 결제 가능 금액은 '.number_format(Mobilians::DEFAULT_PAYMENT_LIMIT_PRICE).'원 이하 입니다.\r\n(한도금액은 본인 설정 또는 통신사별로 금액 차이가 있습니다.)', -1);
			}
			$tpl->assign('MobiliansEnabled', true);
		}
	case "u":	// 중국 은련카드

		if ($isTodayshop == true) {
			resetPaymentGateway(true);	// 경로가 투데이샵이 아니므로 true 파라미터를 던져줌
			$action_url = '../todayshop/indb.resettle.php';
			include "../todayshop/card/$cfg[settlePg]/card_gate.php";
			$tpl->assign('pg',$pg);
			$tpl->define('card_gate',"../../skin_today/".$cfg['tplSkinToday']."/todayshop/card/{$cfg[settlePg]}.htm");
		}
		else {
			$action_url = 'indb.resettle.php';
			include "../order/card/$cfg[settlePg]/card_gate.php";
			$tpl->assign('pg',$pg);
			$tpl->define('card_gate',"/order/card/{$cfg[settlePg]}.htm");
		}
		break;

	case "d":	// 할인결제 (결제금액이 0일 경우)

		break;

}

### 주민등록번호암호화/변수명변경 (전자보증보험)
$isScope = ($egg['scope'] == 'A' || ($egg['scope'] == 'P' && $_POST[eggIssue] == 'Y') ? true : false);
if ($isScope === true && $_POST[resno][0] != '' && $_POST[resno][1] != '' && $_POST[eggAgree] == 'Y'){
	$_POST[eggResno][0] = encode($_POST[resno][0],1);
	$_POST[eggResno][1] = encode($_POST[resno][1],1);
	unset($_POST[resno]);
	if (in_array($data[settlekind], array('c','o','v')) && $cfg[settlePg] == 'dacom'){
		$note_query = "eggs[o]={$ordno}&eggs[i]={$_POST[eggIssue]}&eggs[r1]={$_POST[eggResno][0]}&eggs[r2]={$_POST[eggResno][1]}&eggs[a]={$_POST[eggAgree]}";
		$isScope = false;
	}
}
else $isScope = false;
if ($isScope !== true){
	unset($_POST[eggIssue]);
	unset($_POST[resno]);
	unset($_POST[eggResno]);
	unset($_POST[eggAgree]);
}



if($ordno != $_POST['ordno'])$_POST[ordno]= $data['ordno'] = $ordno;

### 템플릿 출력
$tpl->assign('item',$item);
$tpl->assign('action_url',$action_url);
$tpl->print_('tpl');
?>
