<?
include "../_header.popup.php";

if($_POST['action'] == 'ok') {

	unset($_POST['action'], $_POST['x'], $_POST['y']);

	require_once("../../lib/qfile.class.php");
	$qfile = new qfile();

	$qfile->open("../../conf/config.populate.php");
	$qfile->write("<? \n");
	$qfile->write("\$cfg_populate = array( \n");
	foreach ($_POST as $k=>$v) $qfile->write("'$k' => '$v', \n");
	$qfile->write(") \n;");
	$qfile->write("?>");
	$qfile->close();

	echo "
	<script>
	alert('����Ǿ����ϴ�');
	self.location.href='iframe.populate.setting.php';
	</script>
	";
	exit;

}

if (is_file("../../conf/config.populate.php")) include "../../conf/config.populate.php";
else {
	// �⺻ ���� ��
	$cfg_populate['type'] = 'order';
	$cfg_populate['limit'] = 20;
	$cfg_populate['range'] = 'hour';
	$cfg_populate['range_month'] = 1;
	$cfg_populate['include_soldout'] =  1;
	$cfg_populate['title'] = '';
	$cfg_populate['design'] = 'expand';
}

?>
<script>
function copy_txt(val){
	window.clipboardData.setData('Text', val);
	alert( 'ġȯ�ڵ带 �����߽��ϴ�. \n���ϴ� ���� �ٿ��ֱ�(Ctrl+V)�� �Ͻø� �˴ϴ�.' );
}
</script>
<form id="frmPopulate" action="<?=$_SERVER['PHP_SELF']?>" method="post">
<input type="hidden" name="action" value="ok">

<div class="title title_top">�α��ǰ ���⼳��<span> ���θ��� ��ǰ �Ǹ� ���� �Ǵ� ���� ���� �� ��ǰ���� ������ �����մϴ�. </span> <a href="javascript:manual('<?=$guideUrl?>board/view.php?id=design&no=20')"><img src="../img/btn_q.gif" border="0" align="absmiddle"></a></div>
<table class="tb">
<col class="cellC">
<col class="cellL">
<tr>
	<td>����Ÿ�� ����</td>
	<td>
		<label><input type="radio" name="type" style="border:0px" <?=$cfg_populate['type'] == 'order' ? 'checked' : '' ?> value="order"> ��ǰ �Ǹ� ����</label>
		<label><input type="radio" name="type" style="border:0px" <?=$cfg_populate['type'] == 'pageview' ? 'checked' : '' ?> value="pageview"> ��������(���̺� ��ǰ) ����</label>
	</td>
</tr>
<tr>
	<td>���� ���� ����</td>
	<td>
		1�� ~ <select name="limit"><? for ($i=1;$i<=20;$i++) { ?><option value="<?=$i?>" <?=$cfg_populate['limit'] == $i ? 'selected' : '' ?>><?=$i?></option><? } ?></select>
	</td>
</tr>
<tr>
	<td>��ȸ�Ⱓ ����</td>
	<td>
		<label><input type="radio" name="range" style="border:0px" <?=$cfg_populate['range'] == 'hour' ? 'checked' : '' ?> value="hour"> �ǽð�</label>
		<label><input type="radio" name="range" style="border:0px" <?=$cfg_populate['range'] == 'week' ? 'checked' : '' ?> value="week"> ������</label>
		<label><input type="radio" name="range" style="border:0px" <?=$cfg_populate['range'] == 'month' ? 'checked' : '' ?> value="month"> <select name="range_month"><? for ($i=1;$i<=12;$i++) { ?><option value="<?=$i?>" <?=$cfg_populate['range_month'] == $i ? 'selected' : '' ?>><?=$i?></option><? } ?></select> ����</label>
	</td>
</tr>
<tr>
	<td>ǰ����ǰ ����</td>
	<td>
		<label><input type="radio" name="include_soldout" style="border:0px" <?=$cfg_populate['include_soldout'] == '0' ? 'checked' : '' ?> value="0"> ǰ����ǰ ����</label>
		<label><input type="radio" name="include_soldout" style="border:0px"<?=$cfg_populate['include_soldout'] == '1' ? 'checked' : '' ?>  value="1"> ǰ����ǰ ����</label>
	</td>
</tr>

<tr>
	<td>���ø� ����</td>
	<td>
		<fieldset><legend><label><input type="radio" name="design" style="border:0px" <?=$cfg_populate['design'] == 'expand' ? 'checked' : '' ?> value="expand"> ��ħ��</label></legend>
		<span class="extext">Ÿ��Ʋ �κа� �����κ��� ������ ���·� �����Ǿ� ����˴ϴ�.</span>
		</fieldset>

		<fieldset><legend><label><input type="radio" name="design" style="border:0px" <?=$cfg_populate['design'] == 'rollover' ? 'checked' : '' ?> value="rollover"> �ѿ�����</label></legend>
		<span class="extext">Ÿ��Ʋ �κ��� ������ �ڵ����� ���ư��鼭 �������� Ÿ��Ʋ�� ���콺������ �����κ��� ���ĺ������ϴ�.</span>
		</fieldset>
	</td>
</tr>

<tr>
	<td>ġȯ�ڵ�</td>
	<td>
		<div style="padding-top:5;">{#populate} <img class="hand" src="../img/i_copy.gif" onclick="copy_txt('{#populate}')" alt="�����ϱ�" align="absmiddle"/></div>
		<div style="padding-top:5;" class="extext">ġȯ�ڵ带 �����Ͽ� ���ϴ� ������ ��ġ�� '�ٿ��ֱ�(Ctrl+V)'�Ͽ� ����Ͻø� ���մϴ�.</div>

	</td>
</tr>
</table>

<div id="MSG01">
<table cellpadding=1 cellspacing=0 border=0 class=small_ex>
<tr><td><img src="../img/icon_list.gif" align="absmiddle">�ǽð� �α��ǰ ������ ���θ��� �����Ͽ�  �ַ»�ǰ�� ���� �ΰ���Ű�� ��������  �Ǹ����� ���� �� �ִ� ����Դϴ�.</td></tr>
<tr><td><img src="../img/icon_list.gif" align="absmiddle">��ǰȫ�� �� �����ý� Ȱ���Ͻø� ���� ȿ�����Դϴ�.</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td><img src="../img/icon_list.gif" align="absmiddle">���ø� �������� ������������ > ��Ÿ������ > �α��ǰ ���� ��ħ�� / �νð�ǰ ���� �ѿ����� ���������� ���� �� ������ ���� �մϴ�.</td></tr>
</table>
</div>
<script>
cssRound('MSG01')
</script>


<div class="button">
<input type=image src="../img/btn_register.gif">
</div>

</form>
<script>
table_design_load();
setHeight_ifrmCodi();
</script>