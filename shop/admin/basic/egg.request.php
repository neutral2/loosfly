<?

$location = "���ž��� ���� > ���θ� �������� ��û";
include "../_header.php";

?>
<script src="../basic/egg.request.js"></script>

<form name=form onsubmit="return ( usafeRequest(this) ? false : false );">

<div class="title title_top">���θ� �������� ��û <span>���θ� �������� ���񽺸� ��û�մϴ�.</span></div>

<div style="border:solid 3px #dce1e1; padding:7px 0 10px 10px">
	�߰�����Ʈ �������� �� 3�� ��������<br/>
	��ǰ ���� �� ���� ��� Ȯ���� ���� �߰�����Ʈ�� ���� ���� ��ü�� ȸ���� ���������� �����ϰ� �ֽ��ϴ�.<br/>
	���� �޴��� : ���ﺸ�������, ����������<br/>
	���� ���� : ���θ��������� ���� �� ���谡�� ���ݻ���<br/>
	���� �׸� : �����ڸ�, ������ �������, ������ ����, ��ȭ��ȣ(�Ϲ���ȭ �� �ڵ���), �̸���, �ֹ���ȣ, ���������, �ֹ��ݾ׵� ���� ������ ���� �ʼ����� �׸�<br/>
	�������� ���� �� �̿�Ⱓ : �������� �����Ⱓ(��, ��� �� ������ ������ ���Ͽ� �� ������ �ʿ伺�� �ִ�
	��쿡�� ���ɿ��� ������ �����Ⱓ ���� �ŷ������� �ּ����� �⺻������ �����մϴ�.)
</div>
<div class="noline" style="padding:5px 0 20px 10px;">
	<input type="checkbox" name="thirdAgree" value="y" required label="�������� ��3�� ������ ����"> �� �������� ��3�� ������ �����մϴ�.
</div>

<table class=tb>
<col class=cellC><col class=cellL><col class=cellC><col class=cellL>
<tr>
	<td>�������̵�</td>
	<td colspan=3><?=sprintf("GODO%05d", $godo[sno])?></td>
</tr>
<tr>
	<td>��ȣ��</td>
	<td><input type=text name=compName required label="��ȣ��"></td>
	<td>������</td>
	<td colspan=3>http://<input type=text name=domain style="width:80%" required label="������"></td>
</tr>
<tr>
	<td>����ڱ���</td>
	<td class=noline>
	<input type=radio name=compType value=0 required label="����ڱ���"> ���λ����
	<input type=radio name=compType value=1 required label="����ڱ���"> ���λ����
	</td>
	<td>����ڹ�ȣ</td>
	<td><input type=text name=compSerial onKeyDown=onlynumber() required label="����ڹ�ȣ"> <span class=small><font color=#5B5B5B>("-" ǥ�þ��� �Է�)</font></span></td>
</tr>
<tr>
	<td>��ǥ�ڸ�</td>
	<td><input type=text name=ceoName required label="��ǥ�ڸ�"></td>
</tr>
<tr>
	<td>����</td>
	<td><input type=text name=service required label="����"></td>
	<td>����</td>
	<td><input type=text name=item required label="����"></td>
</tr>
<tr>
	<td>��ȭ</td>
	<td><input type=text name=compPhone[] style="width:40px;" required label="��ȭ" onkeydown="onlynumber()">��<input type=text name=compPhone[] style="width:40px;" required label="��ȭ" onkeydown="onlynumber()">��<input type=text name=compPhone[] style="width:40px;" required label="��ȭ" onkeydown="onlynumber()"></td>
	<td>�ѽ�</td>
	<td><input type=text name=compFax[] style="width:40px;" onkeydown="onlynumber()">��<input type=text name=compFax[] style="width:40px;" onkeydown="onlynumber()">��<input type=text name=compFax[] style="width:40px;" onkeydown="onlynumber()"></td>
</tr>
<tr>
	<td>����ڵ�����ּ���</td>
	<td colspan=3>

	<div class=def>
		<input type=text name=zipcode[] id="zipcode0" size=3 readonly value=""> -
		<input type=text name=zipcode[] id="zipcode1" size=3 readonly value="">
		<a href="javascript:popup('../../proc/popup_address.php',500,432)"><img src="../img/btn_zipcode.gif" align=absmiddle></a>
	</div>
	<div class=def>
		����	��: <input type=text name=address id="address" style="width:60%" value="" required label="�ּ�"> <br />
		���θ�	 : <input type="text" name="road_address" id="road_address" style="width:60%" value="">
	</div>

	</td>
</tr>
</table>

<div class=title>���ǻ���</div>
<table class=tb>
<col class=cellC><col class=cellL>
<tr>
	<td>���ǻ���</td>
	<td><textarea name="inquiry" rows=3 cols=85></textarea></td>
</tr>
</table>

<div class=title>�������</div>
<table class=tb>
<col class=cellC><col class=cellL><col class=cellC><col class=cellL>
<tr>
	<td>��ڸ�</td>
	<td><input type=text name=adminName required label="��ڸ�"></td>
	<td>��ȭ</td>
	<td><input type=text name=adminPhone[] style="width:40px;" required label="�����ȭ" onkeydown="onlynumber()">��<input type=text name=adminPhone[] style="width:40px;" required label="�����ȭ" onkeydown="onlynumber()">��<input type=text name=adminPhone[] style="width:40px;" required label="�����ȭ" onkeydown="onlynumber()"></td>
</tr>
<tr>
	<td>�ڵ���</td>
	<td><input type=text name=adminMobile[] style="width:40px;" required label="����ڵ���" onkeydown="onlynumber()">��<input type=text name=adminMobile[] style="width:40px;" required label="����ڵ���" onkeydown="onlynumber()">��<input type=text name=adminMobile[] style="width:40px;" required label="����ڵ���" onkeydown="onlynumber()"></td>
	<td>�̸���</td>
	<td><input type=text name=adminEmail class=lline required label="����̸���"></td>
</tr>
</table>

<div class="button" id="avoidSubmit">
<input type=image src="../img/btn_confirm.gif">
<a href="javascript:history.back()"><img src="../img/btn_cancel.gif"></a>
</div>

</form>


<div id=MSG01>
<table cellpadding=1 cellspacing=0 border=0 class=small_tip>
<tr><td><img src="../img/icon_list.gif" align="absmiddle">�� ����� �׸��� �������� ������ �ּ���.</td></tr>
</table>
</div>
<script>cssRound('MSG01','#F7F7F7')</script>


<script language="javascript"><!--
function init_set()
{
	var fobj = document.forms['form'];
	fobj['compName'].value = '<?=$cfg[compName]?>';
	fobj['domain'].value = '<?=$cfg[shopUrl]?>';
	fobj['ceoName'].value = '<?=$cfg[ceoName]?>';
	fobj['compSerial'].value = '<?=str_replace("-","",$cfg[compSerial])?>';
	fobj['service'].value = '<?=$cfg[service]?>';
	fobj['item'].value = '<?=$cfg[item]?>';
	fobj['compPhone[]'][0].value = '<?$tmp = explode("-",$cfg[compPhone]); echo $tmp[ (count($tmp) - 3) ]?>';
	fobj['compPhone[]'][1].value = '<?=$tmp[ (count($tmp) - 2) ]?>';
	fobj['compPhone[]'][2].value = '<?=$tmp[ (count($tmp) - 1) ]?>';
	fobj['compFax[]'][0].value = '<?$tmp = explode("-",$cfg[compFax]); echo $tmp[ (count($tmp) - 3) ]?>';
	fobj['compFax[]'][1].value = '<?=$tmp[ (count($tmp) - 2) ]?>';
	fobj['compFax[]'][2].value = '<?=$tmp[ (count($tmp) - 1) ]?>';
	fobj['zipcode[]'][0].value = '<?=substr($cfg[zipcode],0,3)?>';
	fobj['zipcode[]'][1].value = '<?=substr($cfg[zipcode],3)?>';
	fobj['address'].value = '<?=$cfg[address]?>';
	fobj['road_address'].value = '<?=$cfg[road_address]?>';

	fobj['adminName'].value = '<?=$cfg[adminName]?>';
	fobj['adminPhone[]'][0].value = '<?=$tmp[ (count($tmp) - 3) ]?>';
	fobj['adminPhone[]'][1].value = '<?=$tmp[ (count($tmp) - 2) ]?>';
	fobj['adminPhone[]'][2].value = '<?=$tmp[ (count($tmp) - 1) ]?>';
	fobj['adminEmail'].value = '<?=$cfg[adminEmail]?>';
}

init_set();
--></script>


<? include "../_footer.php"; ?>