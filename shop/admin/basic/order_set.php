<?
$location = "�⺻���� > �ֹ�����";
include "../_header.php";
include "../../lib/page.class.php";
include "../../conf/config.pay.php";

$cfg = array_map("slashes",$cfg);
$checked[stepStock][$cfg[stepStock]+0] = "checked";
$checked[basis][$set['delivery']['basis']] = "checked";
?>

<form method="post" action="indb.php">
<input type="hidden" name="mode" value="orderSet">
<div class="title title_top">���谨 <a href="javascript:manual('<?=$guideUrl?>board/view.php?id=basic&no=17')"><img src="../img/btn_q.gif" border=0 align=absmiddle></a></div>
<table class=tb>
<col class=cellC><col class=cellL>
<tr>
	<td>���谨�ܰ�</td>
	<td class=noline>
	<input type=radio name=stepStock value=0 <?=$checked[stepStock][0]?>> �ֹ��� <font class=extext>(�ֹ������ܰ�)</font>
	<input type=radio name=stepStock value=1 <?=$checked[stepStock][1]?>> �Աݽ� <font class=extext>(�Ա�Ȯ�δܰ�)</font>
	</td>
</tr>
<tr>
	<td>���� �õ�/����<br>����� ���ɽð�</td>
	<td>
	�ֹ� ���� <input type="text" name="autoCancelFail" size="2" value="<?=$cfg[autoCancelFail]?>" onkeydown="onlynumber()" class="right line" required> �ð����� ����� �����մϴ�.
	<span class=small><font class=extext>'1'�̻��� ���� �־���մϴ�. (�⺻ 24�ð�. '0'�̳� �����Է½� ����� ������)</font></span>
	</td>
</tr>
</table>

<div class=title>�ڵ� �ֹ���� ���� <span>�Աݵ��� ���� �ֹ��ǵ��� �ڵ��ֹ���ҿ� ���� �Ⱓ �� �ڵ� ���� ������ �����մϴ�.</span> <a href="javascript:manual('<?=$guideUrl?>board/view.php?id=basic&no=17')"><img src="../img/btn_q.gif" border=0 align=absmiddle></a></div>
<table class=tb>
<col class=cellC><col class=cellL>
<tr>
	<td>�ڵ� �ֹ���� ����</td>
	<td>
	�ֹ� ���� <input type="text" name="autoCancel" size="2" value="<?=$cfg[autoCancel]?>" onkeydown="onlynumber()" class="right line"> <select name="autoCancelUnit"><option value="d" <?=($cfg[autoCancelUnit] != 'h') ? 'selected' : ''?>>��</option><option value="h" <?=($cfg[autoCancelUnit] == 'h') ? 'selected' : ''?>>�ð�</option></select>���� �Ա����� ���� �������Ա� �ֹ��� �ڵ����� �ֹ�����մϴ�.
	<span class=small><font class=extext>'0'�̳� �������� ������ ��ɻ�� ����</font></span>
	</td>
</tr>
<tr>
	<td rowspan="3">�ڵ����� ����</td>
	<td class="noline">
		<label><input type="radio" name="autoCancelRecoverStock" value="y" <?=($cfg[autoCancelRecoverStock] != 'n') ? 'checked' : ''?>>��� �ڵ����� ����</label>
		<label><input type="radio" name="autoCancelRecoverStock" value="n" <?=($cfg[autoCancelRecoverStock] == 'n') ? 'checked' : ''?>>���� ����</label>
	</td>
</tr>
<tr>
	<!--td rowspan="3">�ڵ����� ���� ����</td-->
	<td class="noline">
		<label><input type="radio" name="autoCancelRecoverReserve" value="y" <?=($cfg[autoCancelRecoverReserve] != 'n') ? 'checked' : ''?>>������ ��볻�� �ڵ����� ����</label>
		<label><input type="radio" name="autoCancelRecoverReserve" value="n" <?=($cfg[autoCancelRecoverReserve] == 'n') ? 'checked' : ''?>>���� �ȵ�</label>
	</td>
</tr>
<tr>
	<!--td rowspan="3">�ڵ����� ���� ����</td-->
	<td class="noline">
		<label><input type="radio" name="autoCancelRecoverCoupon" value="y" <?=($cfg[autoCancelRecoverCoupon] != 'n') ? 'checked' : ''?>>���� ��볻�� �ڵ����� ����</label>
		<label><input type="radio" name="autoCancelRecoverCoupon" value="n" <?=($cfg[autoCancelRecoverCoupon] == 'n') ? 'checked' : ''?>>���� �ȵ�</label>
		<div class="extext" style="padding: 5px 0 0 5px;line-height:140%;">
		���� ��볻���� �ڵ����� ���� ������, <br>
		�������Ա� �ֹ����� �ڵ����� ��ҵ� ���� �Աݵ� �ǿ� ���ؼ� �ֹ����� �� �ֹ����� ó���� ���� ������, ������ ������ ��� �����ϵ��� ���� �ֽ��ϴ�.<br>
		�� ���, �ֹ����� �� �ֹ����� ó�� ���� ������ ������ �ٸ� �ֹ��ǿ� ���� ���� ������ ���� ������ �ּ���.
		</div>
	</td>
</tr>

</table>




<div class=title>�ֹ�����Ʈ ��ȸ���� ���� <a href="javascript:manual('<?=$guideUrl?>board/view.php?id=basic&no=17')"><img src="../img/btn_q.gif" border=0 align=absmiddle></a></div>
<table class=tb>
<col class=cellC><col class=cellL>
<tr>
	<td>�ֹ�����Ʈ<br>�⺻��ȸ�Ⱓ ����</td>
	<td>
	'�ֹ����� > �ֹ�����Ʈ'�� ������ �� �⺻��ȸ �Ⱓ�� <input type="text" name="orderPeriod" size="2" value="<?=$cfg[orderPeriod]?>" onkeydown="onlynumber()" class="right line"> �ϰ�����  �����մϴ�.
	<div class=extext style="padding-top:3px">�ʹ� �� �Ⱓ�� �Է��ϸ� �ֹ�����Ʈ�� �� ������ ���� ���ϰ� �ɸ� �� �ֽ��ϴ�. 1��~5�� �̳��� �����մϴ�</div>
	</td>
</tr>
</table>
<div class=title>�ֹ�����Ʈ�� �ֹ��� ��¼� ���� <a href="javascript:manual('<?=$guideUrl?>board/view.php?id=basic&no=17')"><img src="../img/btn_q.gif" border=0 align=absmiddle></a></div>
<table class=tb>
<col class=cellC><col class=cellL>
<tr>
	<td>�� ��������<br>�ֹ��� ��¼�</td>
	<td>�ֹ��Ϸ� �� �� �� �������� �ֹ��� <input type="text" name="orderPageNum" size="2" value="<?=$cfg[orderPageNum]?>" onkeydown="onlynumber()" class="right line"> ���� ����մϴ�.</td>
</tr>
</table>
<div class=title>�����Է¹�� ���� <a href="javascript:manual('<?=$guideUrl?>board/view.php?id=basic&no=17')"><img src="../img/btn_q.gif" border=0 align=absmiddle></a></div>
<table class=tb>
<col class=cellC><col class=cellL>
<tr height=40>
	<td>��ǰ�� ����</td>
	<td>�� �ֹ��� ��ǰ�� �������� ��� &nbsp;&nbsp;
	<input type=radio name=basis value='0' class=null <?=$checked[basis][0]?>>�Ѱ��� �����ȣ�� �Է�&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=radio name=basis class=null value='1' <?=$checked[basis][1]?>>��ǰ���� �����ȣ�� �Է�
	</td>
</tr>
</table>
<div class=button><input type=image src="../img/btn_save.gif"></div>
</form>

<? include "../_footer.php"; ?>