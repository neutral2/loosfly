<?

include dirname(__FILE__) . "/../_header.php";
@include $shopRootDir . "/conf/config.pay.php";
@include $shopRootDir . "/conf/egg.usafe.php";
@include $shopRootDir . "/conf/merchant.php";

### ��ٱ��� ����
if ($_COOKIE[gd_isDirect]) setcookie("gd_isDirect",'',time() - 3600,'/');
else setcookie("gd_cart",'',time() - 3600,'/');

$cart = & load_class('cart','Cart',$_COOKIE[gd_isDirect]);
if (method_exists($cart, 'buy')) $cart->buy();	// �߰��� �޼��� �̹Ƿ� Ȯ��.

$query = "
select * from
	".GD_ORDER." a
	left join ".GD_LIST_BANK." b on a.bankAccount=b.sno
where
	a.ordno='$_GET[ordno]'
";
$data = $db->fetch($query,1);

### ���ݿ�������û����
if ($data['settlekind'] == 'a' && $set['receipt']['order'] == 'Y')
{
	$query = "select useopt from ".GD_CASHRECEIPT." where ordno='{$_GET['ordno']}' order by crno limit 1";
	list($data['cashreceipt_useopt']) = $db->fetch($query);
}

$tpl->assign('NaverMileageAmount', include dirname(__FILE__).'/../../shop/proc/naver_mileage/use_amount_type_2.php');
$tpl->assign('NaverOrderCompleteData', $naverCommonInflowScript->getOrderCompleteData($_GET['ordno']));

$tpl->assign($data);
$tpl->print_('tpl');
?>