<?
include "../_header.popup.php";

$_POST[type] = isset($_POST[type]) ? $_POST[type] : 1;

switch ($_POST[type]){
	case "1":				// ���� �߼�

		$_POST[level] = '';
		$total = 1;

		# ȸ���ΰ��
		if ($_REQUEST['m_id']){
			if ($_REQUEST['m_id']) list ($phone) = $db->fetch("SELECT mobile FROM ".GD_MEMBER." WHERE m_id='".$_REQUEST['m_id']."'");
			if ($_REQUEST['mobile']) $phone = $_REQUEST['mobile'];
		}
		# SMS �ּҷ��� ���
		if ($_REQUEST['sno']){
			list ($phone) = $db->fetch("SELECT sms_mobile FROM ".GD_SMS_ADDRESS." WHERE sno='".$_REQUEST['sno']."'");
		}

		# �����Է�
		if ($_REQUEST[mobile]) {

			$phone = $_REQUEST[mobile];
			$phone = str_replace("-","",$phone);
			$div = explode("\r\n",$phone);
			$div = array_notnull(array_unique($div));
			sort($div);
			$to_tran = implode(",",$div);
			$total = count($div);
		}

		break;
	case "2":				// �ּҷ�
		$to_tran= "SMS ȸ�� �ּҷ� �˻� ���";
		$query	= stripslashes($_POST['query']);
		$res	= $db->query($query);
		$total	= $db->count_($res);
		break;
	case "3":				// �ּҷ�
		$to_tran= "SMS ȸ�� �ּҷ� ���� ���";
		$where	= "sno IN (".implode(",",$_POST['chk']).")";
		$query	= "SELECT count(sno) FROM ".GD_SMS_ADDRESS." WHERE ".$where;
		list($total) = $db->fetch($query);
		break;
	case "4":				// �ּҷ�
		$to_tran= "SMS �Ϲ� �ּҷ� �˻� ���";
		$query	= stripslashes($_POST['query']);
		$res	= $db->query($query);
		$total	= $db->count_($res);
		break;
	case "5":				// �ּҷ�
		$to_tran= "SMS �Ϲ� �ּҷ� ���� ���";
		$where	= "sno IN (".implode(",",$_POST['chk']).")";
		$query	= "SELECT count(sno) FROM ".GD_SMS_ADDRESS." WHERE ".$where;
		list($total) = $db->fetch($query);
		break;
	case "6":				// �ּҷ�
		$to_tran= "SMS ȸ�� �ּҷ� ��ü";
		$where[] = "sms='y'";
		$where[] = "mobile!=''";
		if ($where) $where = "where ".implode(" and ",$where);
		$query	= "select count(m_no) from ".GD_MEMBER." $where";
		list($total) = $db->fetch($query);
		break;
	case "7":				// �ּҷ�
		$to_tran= "SMS �Ϲ� �ּҷ� ��ü";
		$query	= "SELECT count(sno) FROM ".GD_SMS_ADDRESS;
		list($total) = $db->fetch($query);
		break;
}


### �з��� ���� üũ
$query = "select category,count(*) cnt from ".GD_SMS_SAMPLE." group by category";
$res = $db->query($query);
while ($data=$db->fetch($res)) $cnt[$data[category]] = $data[cnt];

?>

<div class="title title_top"><font face="����" color="black"><b>SMS</b></font> ������<span>SMS���ڸ޼����� �̿��Ͽ� ������ ������Ű����</span></div>

<form method="post" action="indb.php" target="ifrmHidden" onsubmit="return chkForm(this);">
<input type="hidden" name="mode" value="send_sms">
<input type="hidden" name="type" value="<?=$_POST['type']?>">
<input type="hidden" name="level" value="<?=$_POST['level']?>">
<input type="hidden" name="group" value="<?=$_POST['group']?>">
<input type="hidden" name="query" value="<?=(get_magic_quotes_gpc()) ? stripslashes($_POST['query']) : $_POST['query'] ?>">
<? if (is_array($_POST['chk'])) foreach($_POST['chk'] as $chk) { ?>
<input type="hidden" name="chk[]" value="<?=$chk?>">
<? } ?>
<?
	$_smsReceiverChk	= "Y";
	include "./_smsForm.php";
?>

</form>

