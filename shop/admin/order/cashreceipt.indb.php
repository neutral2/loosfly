<?

include '../lib.php';
require_once("../../lib/qfile.class.php");
$qfile = new qfile();

switch ($_GET['mode'])
{
	case 'del':

		if ($_GET['orderinit'] == 'Y'){
			$data = $db->fetch("select ordno, cashreceipt from ".GD_CASHRECEIPT." where crno='{$_GET['crno']}'");
			$db->query("update ".GD_ORDER." set cashreceipt='' where ordno='{$data['ordno']}' and cashreceipt!='' and cashreceipt='{$data['cashreceipt']}'");
		}
		$db->query("delete from ".GD_CASHRECEIPT." where crno='{$_GET['crno']}'");
		break;

	case 'refuse':
		$db->query("update ".GD_CASHRECEIPT." set moddt=now(),status='RFS' where crno='{$_GET['crno']}'");
		break;

	case 'approval':
	case 'cancel':

		echo '<link rel="styleSheet" href="../style.css">';
		include dirname(__FILE__).'/../../lib/cashreceipt.class.php';
		$cashreceipt = new cashreceipt();
		if ($_GET['mode'] == 'approval')
		{
			$res = $cashreceipt->pgApproval();
		}
		else if ($_GET['mode'] == 'cancel')
		{
			$res = $cashreceipt->pgCancel();
		}

		if ($res === false) echo $cashreceipt->errMsg;

		echo '
		<iframe name="ifrmHidden" style="display:none;"></iframe>
		<script language="javascript">
		function iframe_resizeCall()
		{
			var urlStr = "../proc/_iframeresize.php?name="+ window.name + "&height="+ document.body.scrollHeight +"&dummy="+ new Date().getTime();
			document.getElementsByName(\'ifrmHidden\')[0].src = urlStr;
		}
		if (!window.onload){
			window.onload = iframe_resizeCall;
		}
		</script>';
		exit;
		break;
}

switch ($_POST['mode'])
{
	case 'manage':

		include '../../conf/config.php';
		include '../../conf/config.pay.php';
		$set = (array)$set;
		$set = array_map('strip_slashes',$set);
		$set = array_map('add_slashes',$set);
		$set = array_merge($set,(array)$_POST['set']);
		$qfile->open('../../conf/config.pay.php');
		$qfile->write("<? \n");
		if ($set) foreach ($set as $k=>$v) foreach ($v as $k2=>$v2) $qfile->write("\$set['$k']['$k2'] = '$v2'; \n");
		$qfile->write("?>");
		$qfile->close();

		if ($cfg['settlePg']){
			include '../../conf/pg.'.$cfg['settlePg'].'.php';
			$pg = (array)$pg;
			$pg = array_map('stripslashes',$pg);
			$pg = array_map('addslashes',$pg);
			$pg = array_merge($pg,(array)$_POST['pg']);
			$qfile->open('../../conf/pg.'.$cfg['settlePg'].'.php');
			$qfile->write("<? \n");
			$qfile->write("\$pg = array( \n");
			foreach ($pg as $k=>$v) $qfile->write("'$k' => '".trim($v)."', \n");
			$qfile->write(") \n;");
			$qfile->write("?>");
			$qfile->close();
		}

		break;

	case 'put':

		$indata = $_POST;
		if ($_POST['ordno'] == '') $indata['ordno'] = date('YmdHis');
		$indata['singly'] = ($_POST['ordno'] == '' ? 'Y' : 'N');
		$indata['buyerphone'] = implode('-', $indata['buyerphone']);

		include '../../lib/cashreceipt.class.php';
		$cashreceipt = new cashreceipt();
		$resid = $cashreceipt->putReceipt($indata);

		if ($_POST['ordno'] == '') go('../order/cashreceipt.list.php');
		else echo "<script>parent.location.reload();</script>";

		break;

}

go($_SERVER[HTTP_REFERER]);

?>