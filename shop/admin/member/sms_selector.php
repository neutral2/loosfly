<?

include "../_header.popup.php";

### �з��� ���� üũ
$query = "select category,count(*) cnt from ".GD_SMS_SAMPLE." group by category";
$res = $db->query($query);
while ($data=$db->fetch($res)) $cnt[$data[category]] = $data[cnt];

# ȸ���ΰ��
if ($_GET['m_id']){
	if ($_GET['m_id']) list ($phone) = $db->fetch("SELECT mobile FROM ".GD_MEMBER." WHERE m_id='".$_GET['m_id']."'");
	if ($_GET['mobile']) $phone = $_GET['mobile'];
}
# SMS �ּҷ��� ���
if ($_GET['sno']){
	list ($phone) = $db->fetch("SELECT sms_mobile FROM ".GD_SMS_ADDRESS." WHERE sno='".$_GET['sno']."'");
}
# �����Է�
if ($_GET[mobile]) $phone = $_GET[mobile];

?>

<script>
function insChr(str)
{
	var fm = document.forms[0];
	fm.msg.value = fm.msg.value + str;
	chkLength(fm.msg);
}
function chkLength(obj){
	str = obj.value;
	document.getElementsByName('vLength')[0].value = chkByte(str);
	if (chkByte(str)>80){
		alert("80byte������ �Է��� �����մϴ�");
		obj.value = strCut(str,80);
	}
}

function fnSetSmsMessage() {

	if (document.frmSmeSelector.msg.value == '')
	{
		alert('SMS �޽��� ������ �ۼ��� �ּ���.');
		return false;
	}

	<? if ($_GET['mode'] == 'popup') { ?>
		opener.document.<?=$_GET['fname']?>.<?=$_GET['fld']?>.value = document.frmSmeSelector.msg.value;
		opener.fnToggleSms();
		self.close();
	<? } else if ($_GET['mode'] == 'frame') { ?>
		parent.document.<?=$_GET['fname']?>.<?=$_GET['fld']?>.value = document.frmSmeSelector.msg.value;
		opener.fnToggleSms();
		self.close();
	<? } ?>
}

</script>

<div class="title title_top"><font face="����" color="black"><b>SMS</b></font> ������<span>SMS���ڸ޼����� �̿��Ͽ� ������ ������Ű����</span></div>

<form name="frmSmeSelector" method="post" action="" target="ifrmHidden" onsubmit="return chkForm(this);">
<input type="hidden" name="mode" value="send_sms">
<input type="hidden" name="type" value="1">

<?
	$is_sms_selector = true;	// ��ǰ ���� �亯�� sms �޽����� �����ϱ� ����, ���ۿ� ���� �����ϹǷ� �ش� ������ �б�.
	include "./_smsForm.php";
?>

</form>