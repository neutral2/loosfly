<?

include "../_header.php";

if (!$sess && !$_COOKIE[guest_ordno]) go("../member/login.php?returnUrl=$_SERVER[PHP_SELF]");

@include dirname(__FILE__)."/../conf/pg.cashbag.php";
@include dirname(__FILE__)."/../conf/auctionIpay.cfg.php";
$r_exc = $r_kind = array();
$cashbagprice = 0;
if($cashbag['paykind'])$r_kind = unserialize($cashbag['paykind']);
if($cashbag['e_refer'])$r_exc = unserialize($cashbag['e_refer']);

$query = "
SELECT
	a.*, b.*, c.*,
	d.cp_num,
	d.cp_publish,
	d.cp_sms_cnt,
	d.cp_ea,
	TG.usestartdt, TG.useenddt
FROM
	".GD_ORDER." as a
	LEFT JOIN ".GD_ORDER_ITEM." AS OI ON a.ordno = OI.ordno
	LEFT JOIN ".GD_TODAYSHOP_GOODS." AS TG ON TG.goodsno = OI.goodsno
	left join ".GD_LIST_BANK." as b ON a.bankAccount=b.sno
	left join ".GD_LIST_DELIVERY." as c ON a.deliveryno=c.deliveryno
	LEFT JOIN ".GD_TODAYSHOP_ORDER_COUPON." as d on a.ordno = d.ordno
where a.ordno = '$_GET[ordno]'
";
$data = $db->fetch($query,1);

if (!$data) {
	### ���̹� üũ�ƿ� �ֹ��� �˻�
	$query = "
	SELECT
		O.*, PO.*,

		D.DeliveryStatus, D.DeliveryMethod, D.DeliveryCompany, D.TrackingNumber,
		D.SendDate, D.PickupDate, D.DeliveredDate, D.IsWrongTrackingNumber, D.WrongTrackingNumberRegisteredDate,
		D.WrongTrackingNumberType
	FROM
		".GD_NAVERCHECKOUT_ORDERINFO." AS O

		INNER JOIN ".GD_NAVERCHECKOUT_PRODUCTORDERINFO." AS PO
			ON PO.OrderID = O.OrderID

		LEFT JOIN ".GD_MEMBER." AS MB
			ON PO.MallMemberID=MB.m_id

		LEFT JOIN ".GD_NAVERCHECKOUT_DELIVERYINFO." AS D
			ON PO.ProductOrderID = D.ProductOrderID

		LEFT JOIN ".GD_NAVERCHECKOUT_CANCELINFO." AS C
			ON PO.ProductOrderID = C.ProductOrderID

		LEFT JOIN ".GD_NAVERCHECKOUT_RETURNINFO." AS R
			ON PO.ProductOrderID = R.ProductOrderID

		LEFT JOIN ".GD_NAVERCHECKOUT_EXCHANGEINFO." AS E
			ON PO.ProductOrderID = E.ProductOrderID

		LEFT JOIN ".GD_NAVERCHECKOUT_DECISIONHOLDBACKINFO." AS DH
			ON PO.ProductOrderID = DH.ProductOrderID

	WHERE O.OrderID = '".$_GET['ordno']."'

	GROUP BY O.OrderID
	";
	$data = $db->fetch($query,1);
	if($data) {
		$orderType = "naverCheckout";
		list($data['m_no']) = $db->fetch("SELECT m_no FROM ".GD_MEMBER." WHERE m_id = '".$data['MallMemberID']."'");
		$data['ordno'] = $data['OrderID']; // �ֹ���ȣ
		$data['nameOrder'] = $data['OrdererName']; // �ֹ��ڸ�
		$data['phoneOrder'] = $data['OrdererTel1']; // �ֹ��� ��ȭ��ȣ
		$data['mobileOrder'] = $data['OrdererTel2']; // �ֹ��� �޴���ȭ
		$data['email'] = ''; // �ֹ��� �̸���
		$data['step'] = 0; // �ϴܿ� ������ ��û �κ��� ������ ���� 0���� ����
		$data['nameReceiver'] = $data['ShippingAddressName']; // �����ڸ�
		$data['phoneReceiver'] = $data['ShippingAddressTel1']; // ������ ��ȭ��ȣ
		$data['mobileReceiver'] = $data['ShippingAddressTel2']; // ������ �޴���ȭ
		$data['zipcode'] = $data['ShippingAddressZipCode']; // ������ �����ȣ
		$data['address'] = $data['ShippingAddressBaseAddress']; // ������ �ּ�
		$data['address_sub'] = $data['ShippingAddressDetailedAddress']; // ������ �����ּ�
		$data['memo'] = $data['ShippingMemo']; // ��۸޼���
		if($data['TrackingNumber']) { // �������

			$_checkout_delivery_company = array(
				'KOREX' => '�������','CJGLS' => 'CJGLS','SAGAWA' => 'SC ������(�簡���ͽ��������ù�)','YELLOW' => '���ο�ĸ','KGB' => '�����ù�','DONGBU' => '�����ͽ��������ù�','EPOST' => '��ü���ù�',
				'REGISTPOST' => '������','HANJIN' => '�����ù�','HYUNDAI' => '�����ù�','KGBLS' => 'KGB �ù�','HANARO' => '�ϳ����ù�','INNOGIS' => '�̳������ù�','DAESIN' => '����ù�',
				'ILYANG' => '�Ͼ������','KDEXP' => '�浿�ù�','CHUNIL' => 'õ���ù�','CH1' => '��Ÿ �ù�',
			);

			$data['deliverycomp'] = $_checkout_delivery_company[$data['DeliveryCompany']]; // ��ۻ�
			if($data['DeliveryMethod'] != "DELIVERY" && $data['DeliveryMethod'] != "GDFW_ISSUE_SVC") $data['deliverycode'] = "(��Ÿ���)"; // ��Ÿ ����� ��� �����ȣ�� ����
			else $data['deliverycode'] = $data['TrackingNumber']; // �����ȣ
		}
		// �ݾ������� �ϴܿ��� ó��
	}

	if (!$data) msg("�ش� �ֹ��� �������� �ʽ��ϴ�",-1);
}

### ���� üũ
if ($sess[m_no]){
	if ($data[m_no]!=$sess[m_no]) msg("���ٱ����� �����ϴ�",-1);
} else {
	if ($data[nameOrder]!=$_COOKIE[guest_nameOrder] || $data[m_no]) msg("���ٱ����� �����ϴ�",-1);
}

$query = "
select count(*) from
	".GD_ORDER_ITEM."
where
	ordno = '$_GET[ordno]' and istep < 40
	";
list($icnt) = $db->fetch($query);

$isSocial = false;	// ���� ��ǰ���� üũŰ ���� ����

$query = "
SELECT
	b.*, a.*,
	C.goodstype,

	IF (C.processtype = 'i',
	4,
		IF (
			NOW() < C.startdt,
			1,	/* �ǸŴ�� */
			IF (
				(NOW() <= C.enddt OR C.enddt IS NULL) AND b.runout = 0,
				2,	/* �Ǹ��� */
				IF (
					C.fakestock2real = 1,
						IF (C.limit_ea <> 0 AND (C.buyercnt + C.fakestock) < C.limit_ea,
						3,	/* �ǸŽ��� */
						4	/* �ǸſϷ� = �Ǹ����� */
						)
						,
						IF (C.limit_ea <> 0 AND C.buyercnt < C.limit_ea,
						3,	/* �ǸŽ��� */
						4	/* �ǸſϷ� = �Ǹ����� */
						)
				)
			)
		)
	) AS stats

FROM ".GD_ORDER_ITEM." AS a
INNER join ".GD_GOODS." AS b on a.goodsno=b.goodsno
LEFT JOIN ".GD_TODAYSHOP_GOODS." AS C ON a.goodsno = C.goodsno
where
	a.ordno = '$_GET[ordno]'
";
$res = $db->query($query);
while ($sub=$db->fetch($res)){
	$item[] = $sub;
	if(substr($sub[coupon],-1) == '%') $sub[coupon] = getDcprice($sub[price],$sub[coupon]);
	if(substr($sub[coupon_emoney],-1) == '%') $sub[coupon_emoney] = getDcprice($sub[price],$sub[coupon_emoney]);

	if($icnt == 0){ //��� �ֹ���ǰ�� ���,ȯ���� ���
		$goodsprice += $sub[price] * $sub[ea];
		$memberdc += $sub[memberdc] * $sub[ea];
		$coupon += $sub[coupon] * $sub[ea];
		$coupon_emoney += $sub[coupon_emoney] * $sub[ea];

	}else if ($sub[istep]<40){
		$goodsprice += $sub[price] * $sub[ea];
		$memberdc += $sub[memberdc] * $sub[ea];
		$coupon += $sub[coupon] * $sub[ea];
		$coupon_emoney += $sub[coupon_emoney] * $sub[ea];

		if( in_array($sub['goodsno'],$r_exc) ) $minus += $sub[price] * $sub[ea];
		$cashbagprice += $sub[price] * $sub[ea];
	}
	/**
		2011-01-27 by x-ta-c
		���� ��ǰ�� ������ǰ(Ƽ��)�� �����ϴ��� üũ (������ Ƽ���� �����ߴٸ� ���ڵ�� 1����)
	*/
	if ($sub['goodstype']) {
		$isSocial = true;		// �󼼺��� ���ø� ġȯ
		$goodstype = $sub['goodstype'];
		$socialStatus = $sub[stats];
	}
}
$cashbagprice -= $minus;

// üũ�ƿ��� ��� ��ǰ ������ �缳��
if($orderType == "naverCheckout") {
	$query = "
	SELECT COUNT(*) FROM
		".GD_NAVERCHECKOUT_PRODUCTORDERINFO."
	WHERE
		OrderID  = '".$_GET['ordno']."' and (ClaimType IS NULL OR ClaimType = '')
		";
	list($icnt) = $db->fetch($query); // ������� ���� ��ǰ

	$query = "
	SELECT
		a.*, b.*
	FROM ".GD_NAVERCHECKOUT_PRODUCTORDERINFO." AS a
	LEFT join ".GD_GOODS." AS b on a.ProductID=b.goodsno
	where
		a.OrderID = '".$_GET['ordno']."'
	";
	$res = $db->query($query);
	while ($sub=$db->fetch($res)){

		// ����, ���� �ݾ�
		$data['TotalOrderAmount'] = (int)$data['TotalOrderAmount'] + (int)$sub['UnitPrice'] * (int)$sub['Quantity'];
		$data['ProductDiscountAmount'] = (int)$data['ProductDiscountAmount'] + (int)$sub['ProductDiscountAmount'];

		// �ɼ� ����
			$tmpOption = explode('/', $sub['ProductOption']);
			$tmp = explode(':', $tmpOption[0]); $sub['opt1'] = $tmp[1];
			$tmp = explode(':', $tmpOption[1]); $sub['opt2'] = $tmp[1];

		$sub['price'] = $sub['UnitPrice']; // ����
		$sub['ea'] = $sub['Quantity']; // ����
		$sub['istep'] = getCheckoutOrderStatus($sub);
		$r_istep[$sub['istep']] = $sub['istep']; // �������� �ʴ� �ֹ������� ��� ���� ����

		$item[] = $sub;

	}

	// ���̹� üũ�ƿ� ��������
	$goodsprice = $data['TotalOrderAmount']; // �� �ֹ� �ݾ�
	$data['emoney'] = $data['ProductDiscountAmount']; // ������ ���
	$data['prn_settleprice'] = $data['TotalOrderAmount'] - $data['ProductDiscountAmount']; // ���� �ݾ�

	switch($data['PaymentMeans']) {
		case "�ſ�ī��" : $data['settlekind'] = "c"; break;
		case "�������Ա�" : $data['settlekind'] = "v"; $data['vAccount'] = "���������� <a href=\"http://checkout.naver.com/customer/orderList.nhn\" target=\"_blank\" style=\"text-decoration:underline;\">[���̹� üũ�ƿ� MY������]</a>���� Ȯ�����ּ���."; break;
	}
}

include "../conf/config.pay.php";
@include "../conf/pg.$cfg[settlePg].php";
include "../conf/pg.escrow.php";
@include "../conf/egg.usafe.php";

// �����̼� �ֹ��ΰ�� ��� PG ���� ��ü
if ($isSocial && function_exists('resetPaymentGateway')) resetPaymentGateway(true);

if($set['delivery']['deliverynm'] == '')$set['delivery']['deliverynm'] = '�⺻���';

if($data[step2] == '50' || $data[step2] == '54'){

	$r_deli = explode('|',$set['r_delivery']['title']);

}

### ���ݿ�����
$r_type = array(
		"a"	=> "NBANK",
		"o"	=> "ABANK",
		"v"	=> "VBANK",
		);
$cashReceipt['type'] = $r_type[$data['settlekind']];

if ($set['receipt']['compType'] == '1'){ // �鼼/���̻����
	$cashReceipt['supply'] = $data['prn_settleprice'];
	$cashReceipt['vat'] = 0;
}
else { // ���������
	$cashReceipt['supply'] = round($data['prn_settleprice'] / 1.1);
	$cashReceipt['vat'] = $data['prn_settleprice'] - $cashReceipt['supply'];
}

if ($data['cashreceipt_ectway'] == 'Y')
{
	$data['cashreceipt'] = '-';
	$tpl->define('cash_receipt',"proc/_cashreceipt.htm");
}
else if ($set['receipt']['publisher'] != 'seller'){
	$query = "select certno from gd_cashreceipt where ordno='$_GET[ordno]' order by crno desc limit 0,1";
	$cash = $db->fetch($query,1);
	if( $data[settlekind] != 'o' ){
		$tpl->assign('certno',$cash[certno]);
	}else{
		$tpl->assign('certno',$data[mobileOrder]);
	}
	$tpl->define('cash_receipt',"order/cash_receipt/{$cfg[settlePg]}.htm");
}
else if ($set['receipt']['publisher'] == 'seller'){
	@include dirname(__FILE__).'/../lib/cashreceipt.class.php';
	if (class_exists('cashreceipt'))
	{
		$cashreceipt = new cashreceipt();
		$cashreceipt->prnUserReceipt($_GET['ordno']);
		$tpl->assign('receipt',$cashreceipt);
	}
	$tpl->define('cash_receipt',"proc/_cashreceipt.htm");
}

### ���ݰ�꼭
if ( $set[tax][useyn] == 'y' ){
	$tmp = 0;
	if ( $set[tax][ "use_{$data[settlekind]}" ] == 'on' ) $tmp++;
	if ( in_array($set[tax][step], array('1', '2', '3', '4')) && $data[step] >= $set[tax][step] && !$data[step2] ) $tmp++;
	list($cnt) = $db->fetch("select count(*) from ".GD_ORDER_ITEM." where ordno='$_GET[ordno]' and tax='1'");
	if ( $cnt >= 1 ) $tmp++;
	if ( $tmp == 3 ) $data[taxapp] = 'Y';
	if (is_object($cashreceipt) && $cashreceipt->writeable != 'true') $data['taxapp'] = 'N'; // ���ݿ����� �������̸� ���ݰ�꼭 ��û�Ұ�
}

$data[taxmode] = '';
$query = "select name, company, service, item, busino, address, regdt, agreedt, printdt, price, step, doc_number from ".GD_TAX." where ordno='$_GET[ordno]' order by sno desc limit 1";
$res = $db->query($query);
if ( $db->count_($res) ){
	$data[taxmode] = 'taxview';
	$taxed = $db->fetch($res);
}
else if ( $data[taxapp] == 'Y' ) $data[taxmode] = 'taxapp';

// ���� ���� �ݾ��� �������� ����.
// ��� �ݾ��� (���ʰ��� �ݾ� - �ǰ����ݾ�)
//$data[settleprice] = $data[prn_settleprice];
$data[canceled_price] = (int)$data[settleprice] - (int)$data[prn_settleprice];
$data[goodsprice] = $goodsprice; $data[memberdc] = $memberdc;
if($coupon)$data[coupon] = $coupon;

if($data[phoneReceiver])$data['phone'] = explode('-',$data['phoneReceiver']);
if($data[mobileReceiver])$data['mobile'] = explode('-',$data['mobileReceiver']);
if($data[zipcode])$data['postcode'] = explode('-',$data['zipcode']);

if($cfg[settlePg]){
	$tmp = preg_split("/[\n]+/", $data[settlelog]);
	foreach($tmp as $v)if(preg_match('/KCP �ŷ���ȣ : /',$v))$data[tno] = str_replace('KCP �ŷ���ȣ : ','',$v);

	if($cfg['settlePg'] == 'allat' && preg_match('/�ŷ���ȣ : (.*)/', $data['settlelog'], $matched)){
		$data['tno'] = $matched[1];
	}
}

if($data['step2'] == 50 || $data['step2'] == 54)$resettleAble = true;
if($cfg['autoCancelFail'] > 0){
	$ltm = toTimeStamp($data['orddt']) + 3600 * $cfg['autoCancelFail'] ;
	if($ltm < time()){
		$resettleAble = false;
	}
}else{
	$resettleAble = false;
}

### PG �������л���
if($data['step'] == 0 && $data['step2'] == 54 && $data['settlelog']){
	if(preg_match('/������� : (.*)\n/',$data['settlelog'], $matched)){
		$data['pgfailreason'] = $matched[1];
	}
}

### ĳ���� ����
if(
	$cashbag['use'] == "on" &&
	$cashbag['code'] != null &&
	$data['cbyn'] == 'N' &&
	$data['step'] == '4' &&
	$data['step2'] == '0' &&
	in_array($data['settlekind'],$r_kind) &&
	$cashbagprice > 0

) $ableCashbag = 1;

$r_savetype = array(
	'ord' => 'orddt',
	'inc' => 'cdt',
	'deli' => 'ddt'
);
$r_savepriod = array(
	'mon' => 'month',
	'day' => 'day'
);
if($cashbag['savetype'] && $cashbag['savepriodtype'] && $cashbag['savepriod'] && $ableCashbag){
	$tmp = $data[$r_savetype[$cashbag['savetype']]];
	$tmp = strtotime($tmp);
	$tmp = strtotime("+".$cashbag['savepriod']." ".$r_savepriod[$cashbag['savepriodtype']],$tmp);
	if($tmp < time()){
		$ableCashbag = 0;
	}
}
if( $data[orddt] && $cashbag[savedt] && $ableCashbag ){
	if( $cashbag[savedt] > str_replace('-','',substr($data[orddt],0,10)) ){
		$ableCashbag = 0;
	}
}

if($data[cbyn] == 'Y'){
	$query = "select tno, add_pnt, pnt_app_time from " . GD_ORDER_OKCASHBAG . " where ordno='".$_GET['ordno']."' limit 1";
	list($data[oktno], $data[add_pnt], $data[pnt_app_time]) = $db->fetch($query);
}
$authdata = md5($pg[id].$data[cardtno].$pg[mertkey]); // dacom ���̷�Ʈ ������ǥ ��� �������ڿ� ����

/**
	�� ��ǰ�� �����̸� ��� ���ø� ��ü
*/
if ($isSocial === true && (is_file($tpl->template_dir.'/'.'mypage/mypage_orderview_social.htm'))) {


	$tpl->define('tpl','mypage/mypage_orderview_social.htm');

	// ��
	$tpl->assign('goodstype', $goodstype); // ��ǰ����

	$tpl->assign('socialStatus',$socialStatus);	// ()

	$tpl->assign('couponNumber',$data[cp_num]);	// ������ȣ
	$tpl->assign('couponEA',$data[cp_ea]);	// �������

	$tpl->assign('couponUseStartDate',$data[usestartdt]);	// ��ȿ�Ⱓ  ����
	$tpl->assign('couponUseEndDate',$data[useenddt]);	// ��ȿ�Ⱓ ��

}
//

$tpl->assign('authdata',$authdata);  // dacom ���̷�Ʈ ������ǥ ��� �������ڿ� ����
$tpl->assign($data);
$tpl->assign('item',$item);
$tpl->assign('taxed',$taxed);
$tpl->assign('ipay',$auctionIpayCfg);
$tpl->print_('tpl');

?>