<?

include dirname(__FILE__)."/../../../../conf/config.mobileShop.php";
include dirname(__FILE__)."/../../../../conf/pg.inicis.php";

$page_type = $_GET['page_type'];

if($page_type=='mobile') {
	$order_end_page = $cfgMobileShop['mobileShopRootDir'].'/ord/order_end.php';
}
else {
	$order_end_page = $cfg['rootDir'].'/order/order_end.php';
}

$pg_mobile = $pg;

### ����ũ�� ������ pgId ����
if ($_POST[escrow]=="Y") $pg_mobile[id] = $escrow[id];

if(!preg_match('/mypage/',$_SERVER[SCRIPT_NAME])){
	$item = $cart -> item;
}

foreach($item as $v){
	$i++;
	if($i == 1) $ordnm = $v[goodsnm];
}
//��ǰ���� Ư������ �� �±� ����
$ordnm	= pg_text_replace(strip_tags($ordnm));
if($i > 1)$ordnm .= " ��".($i-1)."��";

switch ($_POST[settlekind]){
	case "c":	// �ſ�ī��
		$actionURL		= "https://mobile.inicis.com/smart/wcard/";
		break;
	case "v":	// �������
		$actionURL		= "https://mobile.inicis.com/smart/vbank/";
		break;
	case "h":	// �ڵ���
		$actionURL		= "https://mobile.inicis.com/smart/mobile/";
		break;
}

//ssl ���ȼ��� ���� �߰�
if($_SERVER['SERVER_PORT'] == 80) {
	$Port = "";
} elseif($_SERVER['SERVER_PORT'] == 443) {
	$Port = "";
} else {
	$Port = $_SERVER['SERVER_PORT'];
}

if (strlen($Port)>0) $Port = ":".$Port;

$Protocol = $_SERVER['HTTPS']=='on'?'https://':'http://';
$host = parse_url($_SERVER['HTTP_HOST']);

if ($host['path']) {
	$Host = $host['path'];
} else {
	$Host = $host['host'];
}

?>
<script language="javascript">
function on_load()
{
	curr_date = new Date();
	year = curr_date.getYear();
	month = curr_date.getMonth();
	day = curr_date.getDay();
	hours = curr_date.getHours();
	mins = curr_date.getMinutes();
	secs = curr_date.getSeconds();
	/****************************************************************************
	ȸ���翡�� ����ϴ� �ֹ���ȣ�� �̿��ϴ� ��쿡�� ������ �ּ�ó�� �ϼ���
	�ּ�ó���Ͻ� ��쿡�� form tag�� P_OID�� ���� �Ѱ��ּž� �մϴ� ****************************************************************************/
//	document.btpg_form.P_OID.value = year.toString() + month.toString() + day.toString() + hours.toString() + mins.toString() + secs.toString();
}

function on_card() {
	myform = document.btpg_form;
	/****************************************************************************
	�ſ�ī�� action url�� �Ʒ��� ���� �����մϴ�
	****************************************************************************/
	myform.action = "<?=$actionURL;?>";
	myform.submit();
}
</script>

<!--<div style="text-align:center;padding:20px 0;font-size:12px;"><strong><b>����� INIPay Mobile ����ȭ������ �̵��մϴ�.</b></strong></div>-->

<form name="btpg_form" method="post">

<!-- VISA3D ���� -->
<input type="hidden" name="P_NEXT_URL" value="<?=$Protocol.$Host.$Port?><?=$cfg['rootDir']?>/order/card/inicis/mobile/nscreen_card_return.php<?php echo '?ordno='.$_POST['ordno'].'&settlekind='.$_POST['settlekind'].'&page_type='.$page_type; ?>">

<!-- ISP ���� -->
<input type="hidden" name="P_NOTI_URL" value="http://<?=$Host?><?=$cfg['rootDir']?>/order/card/inicis/mobile/vacctinput.php">
<input type="hidden" name="P_RETURN_URL" value="<?=$Protocol.$Host.$Port?><?=$order_end_page?>?ordno=<?=$_POST['ordno']?>">

<input type="hidden" name="P_EMAIL" value="<?=$_POST["email"]?>">
<input type="hidden" name="P_MOBILE" value="<?=$_POST['mobileOrder']?>">
<input type="hidden" name="P_GOODS" value="<?=$ordnm?>">
<input type="hidden" name="P_OID" value="<?=$_POST['ordno']?>">
<input type="hidden" name="P_NOTI" value="">
<input type="hidden" name="P_UNAME" value="<?=$_POST["nameOrder"]?>">
<input type="hidden" name="P_MID" value="<?=$pg_mobile['id']?>">
<input type="hidden" name="P_AMT" value="<?=$_POST['settleprice']?>">
<input type="hidden" name="P_HPP_METHOD" value="2">
</form>

<script>$(document).ready(on_load);</script>