<?
$location = 'ȸ������ > ����Ȯ�� �������� > �޴�������Ȯ�� ����';
include '../_header.php';


$config = Core::loader('config');
$dreamsecurity = Core::loader('Dreamsecurity');

$shopConfig = $config->load('config');
$hpauthDreamCfg = $config->load('hpauthDream');
$dreamsecurityPrefix = $dreamsecurity->lookupPrefix();

$checked = array(
    'useyn' => array($hpauthDreamCfg['useyn'] => ' checked="checked"'),
    'minoryn' => array($hpauthDreamCfg['minoryn'] => ' checked="checked"'),
);

?>

<form name="frmField" method="post" action="adm_member_auth.hpauthDream.indb.php" onsubmit="return checkForm()">
<form action="<?php echo $shopConfig['rootDir']; ?>/admin/basic/adm_member_auth.hpauthDream.indb.php" method="post" onsubmit="return checkForm();">


<div class="title title_top">�޴�������Ȯ�� ����<span>�޴��� ����Ȯ�� ���񽺿� �ʿ��� ������ ���� �մϴ�. </span> <a href="javascript:manual('<?=$guideUrl?>board/view.php?id=member&no=21')"><img src="../img/btn_q.gif" border="0" align="absmiddle"></a></div>

<table border="4" bordercolor="#dce1e1" style="border-collapse:collapse" width="730">
<tr><td style="padding:7px 0px 10px 10px">
<div style="padding-top:5px; color:#666666; font-weight:bold;" class="g9"><b>�� �޴��� ����Ȯ�ο� ���� �ȳ��Դϴ�. �� �о����.</b></div>
<div style="padding-top:10px; color:#666666;" class="g9">�� �޴��� ����Ȯ�� ���񽺸� �����ϴ� (��)�帲��ť��Ƽ�� ��û���� �ۼ��մϴ�.</div>
<div style="padding-top:3px; color:#666666;" class="g9">�� (��)�帲��ť��Ƽ�� �ּҴ� "����� ���ı� ������ 150-28 ������� 5�� (��)�帲��ť��Ƽ ���� ���� ����� ��" �Դϴ�.</div>
<div style="padding-top:3px; color:#666666;" class="g9">�� ���� �� ���� �� ������ ���� �� ��ǰ������ ���� �ȳ� ��ȭ�� �帳�ϴ�.</div>
<div style="padding-top:3px; color:#666666;" class="g9">�� (��)�帲��ť��Ƽ���� �߱� ������ �ڵ带 �Ʒ� ���Զ��� �Է��ϰ� ��Ϲ�ư�� �����ϴ�.</div>
<div style="padding-top:3px; color:#666666;" class="g9">�� ���� �� ���θ����� ����Ȯ���� ���� �۵� �ϴ��� Ȯ�� �ϼ���.</div>
<div style="padding-top:3px; color:#666666;" class="g9">�� �� ���� �� �̿� ���� : 1899-4134 (��)�帲��ť��Ƽ </div>
<div style="padding-top:3px; color:#666666;" class="g9">[��û���� ����Ȯ�� �������� �ȳ� > �޴��� ����Ȯ�� �ȳ�����  ��û��  �ٿ�ε� ���ֽø� �˴ϴ�.]</div>
</td></tr>
</table>

<div style="padding-top:10"></div>

<table class="tb">
<col class="cellC"><col class="cellL">
<tr height="28">
	<td>ȸ���� Code</td>
	<td><input type=text name="cpid" id="cpid" class="line" value="<?=$hpauthDreamCfg['cpid']?>"> 
	<span class="extext">�帲��ť��Ƽ���� �������� �߱޵Ǵ� ���̵� �Դϴ�.(<?php echo implode(',', $dreamsecurityPrefix); ?>�� ���۵Ǿ�� ��)</span></td>
</tr>
<tr height="28">
	<td style="width:150;">�޴��� ���� Ȯ�� ��� ����</td>
	<td class="noline">
		<input type="radio" name="useyn" id="use_y" value="y" <?=$checked['useyn']['y']?> onclick="setDisabled()"> ���
		<input type="radio" name="useyn" id="use_n" value="n" <?=$checked['useyn']['n']?> onclick="setDisabled()"> ������
	</td>
</tr>
<tr height="28">
	<td>���� ���� ����</td>
	<td class="noline">
	<input type="radio" name="minoryn" value="y" <?=$checked['minoryn']['y']?>> ��� <font class="extext">(19�� �̸� ȸ������ �Ұ�)</font>
	&nbsp;&nbsp;<input type="radio" name="minoryn" value="n" <?=$checked['minoryn']['n']?>> ������
	</td>
</tr>
</table>

<div class="button"><input type="image" src="../img/btn_register.gif"> <a href="javascript:history.back()"><img src="../img/btn_cancel.gif"></a></div>

</form>


<div id="MSG01">
<table cellpadding="1" cellspacing="0" border="0" class="small_ex">
<tr><td><img src="../img/icon_list.gif" align="absmiddle">�޴��� ����Ȯ�μ��񽺰� �� �� �ֵ��� ���α׷��� �⺻ž�� �Ǿ� �ֽ��ϴ�. </td></tr>
<tr><td><img src="../img/icon_list.gif" align="absmiddle">�޴��� ����Ȯ�μ��񽺸� �ϱ� ���ؼ��� (��)�帲��ť��Ƽ�� ��ุ �����Ͻø� �˴ϴ�. </td></tr>
<tr><td><img src="../img/icon_list.gif" align="absmiddle">�޴��� ����Ȯ�μ��� ������ü: <a href="http://www.dreamsecurity.com/" target="_new"><font color="white">(��)�帲��ť��Ƽ <font class="ver7">(http://www.dreamsecurity.com)</font></a>
</font></td></tr>
</table>

<table cellpadding="1" cellspacing="0" border="0" class="small_ex">
<tr><td height="20"></td></tr>
<tr><td><font class="def1" color="white">[�ʵ�] �޴��� ����Ȯ�μ��� ���� </b></font></td></tr>
<tr><td><font class="def1" color="white">��</font> �޴��� ����Ȯ�� ���񽺸� �����ϴ� (��)�帲��ť��Ƽ�� ��û���� �ۼ��Ͽ� �߼��մϴ�.</td></tr>
<tr><td>(��)�帲��ť��Ƽ�� �ּ� "����� ���ı� ������ 150-28 ������� 5�� (��)�帲��ť��Ƽ ���� ���� ����� ��"</td></tr>
<tr><td><font class="def1" color="white">��</font> (��)�帲��ť��Ƽ�� ����ڷκ��� ȸ����Code�� �߱� �����ð� �˴ϴ�.</td></tr>
<tr><td><font class="def1" color="white">��</font> �߱� ������ ȸ����Code�� �� �������� �Է��ϼ���.</td></tr>
<tr><td><font class="def1" color="white">��</font> ���θ����� ����Ȯ���� ���� �۵� �ϴ��� Ȯ�� �ϼ���.</td></tr>
</table>
</div>

<script>
	function setDisabled() {
		var fm = document.frmField;
	}

	function checkForm(f) {
		if($('use_y').checked) {
			if(!$('cpid').value) {
				alert("ȸ���� Id�� �Է��ϼž� ��� ������ �����Դϴ�.");
				return false;
			}
		}

		return true;
	}

	window.onload = function() {
		cssRound('MSG01');
		setDisabled();
	}
</script>

<? include "../_footer.php"; ?>