<?
include "../_header.php";
include "../conf/config.pay.php";
@include "../conf/pg.$cfg[settlePg].php";
include "../conf/pg.escrow.php";
@include "../conf/egg.usafe.php";
$mobilians = Core::loader('Mobilians');

// getordno �Լ��� /shop/lib/lib.func.php ���Ϸ� �̵�

if (!$_POST[ordno]) msg("�ֹ���ȣ�� �������� �ʽ��ϴ�","order.php");

$data = $db->fetch("select * from ".GD_ORDER." where ordno='".$_POST[ordno]."'");
if($cfg['autoCancelFail'] > 0){
	$ltm = toTimeStamp($data['orddt']) + 3600 * $cfg['autoCancelFail'] ;
	if($ltm < time()){
		msg('����� ���ɽð��� ������ '.$cfg['autoCancelFail'].'�ð� �����Դϴ�.\n����� �Ⱓ�� ���� �Ǿ����ϴ�.',-1);
		exit;
	}
}


$data[phoneOrder] = explode('-',$data[phoneOrder] );
$data[mobileOrder] = explode('-',$data[mobileOrder] );

// ������ ��ȭ��ȣ
$data[phoneReceiver] = explode('-',$data[phoneReceiver] );
$data[mobileReceiver] = explode('-',$data[mobileReceiver] );
$data['zipcode'] = explode('-',$data['zipcode'] );

$_POST['nameReceiver'] = $data['nameReceiver'];
$_POST['phoneReceiver'] = $data['phoneReceiver'];
$_POST['mobileReceiver'] = $data['mobileReceiver'];
$_POST['zipcode'] = $data['zipcode'];
$_POST['address'] = $data['address'];
$_POST['email'] = $data['email'];

// ����ũ��
$_POST[escrow] = ($_POST[escrowyn] == 'y' ? 'Y': 'N');
$tpl->assign('escrow',$_POST[escrow]);

$ordno = $_POST[ordno];
if($data[step2] == 54){	// ���� ���н� �ֹ���ȣ ��ü
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


### �����ݾ� ����
$discount = $data['coupon'] + $data['emoney'] + $data['memberdc'] + $data['ncash_emoney'] + $data['ncash_cash'];
$data['settleprice'] = $data['goodsprice'] - $discount + $_POST['eggFee'] + $data['delivery'];
$_POST[settleprice]=$data['settleprice'];
$tpl->assign($data);

### �������ܿ� ���� ����
switch ($data[settlekind]){

	case "a":	// �������Ա�

		### �������Ա� ���� ����Ʈ
		$res = $db->query("select * from ".GD_LIST_BANK." where useyn='y'");
		while ($tmp = $db->fetch($res)) $bank[] = $tmp;

		break;

	case "c":	// �ſ�ī��
	case "o":	// ������ü
	case "v":	// �������
	case "h":	// �ڵ���
		if ($_POST['settlekind'] == 'h' && $mobilians->isEnabled() === true) {
			if (Mobilians::overflowLimitPrice($_POST['settleprice']) === false) {
				msg('�޴��� ���� ���� �ݾ��� '.number_format(Mobilians::DEFAULT_PAYMENT_LIMIT_PRICE).'�� ���� �Դϴ�.\r\n(�ѵ��ݾ��� ���� ���� �Ǵ� ��Ż纰�� �ݾ� ���̰� �ֽ��ϴ�.)', -1);
			}
			$tpl->assign('MobiliansEnabled', true);
		}
	case "u":	// �߱� ����ī��

		if ($isTodayshop == true) {
			resetPaymentGateway(true);	// ��ΰ� �����̼��� �ƴϹǷ� true �Ķ���͸� ������
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

	case "d":	// ���ΰ��� (�����ݾ��� 0�� ���)

		break;

}

### �ֹε�Ϲ�ȣ��ȣȭ/�������� (���ں�������)
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

### ���ø� ���
$tpl->assign('item',$item);
$tpl->assign('action_url',$action_url);
$tpl->print_('tpl');
?>
