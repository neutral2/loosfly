<?
$location = "�⺻���� > ��ٱ��� ���ü���";
include "../_header.php";

include  "../../lib/cart.class.php";
$cart = new Cart;

if($cart->keepPeriod>0)
	$checked[keepPeriod][1]='checked';
else
	$checked[keepPeriod][0]='checked';

$checked[runoutDel][$cart->runoutDel]='checked';
$checked[redirectType][0]=($cart->redirectType=='Direct')?'checked':'';
$checked[redirectType][1]=($cart->redirectType=='Confirm')?'checked':'';
$checked[redirectType][2]=($cart->redirectType=='Keep')?'checked':'';
?>

<form method="post" action="indb.php">
<input type="hidden" name="mode" value="cartSet">
<div class="title title_top">�� ��ٱ��� ��ǰ ���� ����  <span>�� ��ٱ��Ͽ� ��� ��ǰ�� �����Ⱓ�� �����մϴ�.</span>
<a href="javascript:manual('<?=$guideUrl?>board/view.php?id=basic&no=28')"><img src="../img/btn_q.gif" border=0 align=absmiddle></a></div>
<table class=tb>
<col class=cellC><col class=cellL>
<tr>
	<td>��ǰ ���� �Ⱓ ����</td>
	<td class=noline>
	<input type=radio name=keepPeriodYn value="Y" <?=$checked[keepPeriod][0]?>>���� ���� �� ���� ����&nbsp;&nbsp;
	<input type=radio name=keepPeriodYn value="N" <?=$checked[keepPeriod][1]?>>
	<select name="keepPeriod">
	<? 
	if($cart->keepPeriod>0)
		$tmp[keepPeriod]=$cart->keepPeriod;
	else 
		$tmp[keepPeriod]='7';

	for($i=1; $i<=30; $i++){
		$selected[keepPeriod]="";
		if($i==$tmp[keepPeriod])
			$selected[keepPeriod]="selected";
	echo "<option value='".$i."' ".$selected[keepPeriod].">".$i."</option>";
	}?>
	</select>
	
	�� ���� ���� �� �ڵ�����
	</td>
</tr>

<tr>
	<td>ǰ����ǰ ��������</td>
	<td class=noline>
		<input type=radio name="runoutDel" value="1" <?=$checked[runoutDel][1]?>>������ǰ ǰ�� �� �ڵ�����&nbsp;&nbsp;
		<input type=radio name="runoutDel" value="0" <?=$checked[runoutDel][0]?>>������ǰ ǰ�� �� ���ܵ�
	</td>
</tr>

</table>
<div class="extext" style="padding: 5px 0 0 5px;line-height:140%;">
��ȸ�� ��ٱ��Ͽ��� ���������� ����Ǹ�, ��ȸ���� ��� ���������� ������� �ʽ��ϴ�.<br/>
�ذ� ��ٱ��� ��ǰ���� ������ �ִ� 300�� ���� �����Ǹ�, �ʰ��� �ȳ� ��Ʈ�� ��� �˴ϴ�.
</div>

<div class=title>��ٱ��� ������ �̵� ���� <span>��ٱ��ϴ�� ����� ��ٱ��� ���������� ȭ�� �̵����θ� �����մϴ�.  </span> <a href="javascript:manual('<?=$guideUrl?>board/view.php?id=basic&no=28')"><img src="../img/btn_q.gif" border=0 align=absmiddle></a></div>
<table class=tb>
<col class=cellC><col class=cellL>
<tr>
	<td rowspan="2">��ٱ��� ���<br/>������ �̵����� <br/>����</td>
	<td class="noline">
		<label><input type="radio" name="redirectType" value="Direct" <?=$checked[redirectType][0]?> >��ٱ��� ������ �ٷ� �̵�</label>
		<div class="extext" style="padding: 5px 0 0 5px;line-height:140%;">��ٱ��� ��� ��ư Ŭ���� ��ٱ��� �������� �ٷ� �̵��˴ϴ�.</div>
	</td>
</tr>
<tr>
	<td class="noline">
		<label><input type="radio" name="redirectType" value="Confirm" <?=$checked[redirectType][1]?>>��ٱ��� ������ �̵����� ����</label>
		<div class="extext" style="padding: 5px 0 0 5px;line-height:140%;">��ٱ��� ��� ��ư Ŭ���� Ȯ�� �˾��� �߸�, ��ٱ��� ������ �̵����θ� ������ �� 
    �ֽ��ϴ�.<br/>
    ����ٱ��Ͽ� ��ҽ��ϴ�. ���� Ȯ�� �Ͻðڽ��ϱ�? [��ٱ��Ϻ���] [��Ӽ����ϱ�]�� <br/>
     [��ٱ��Ϻ���] -> ��ٱ��� �������� �̵��մϴ�.<br/>
     [��Ӽ����ϱ�] -> ���������� �������¿��� �ɼǼ��� �κ��� �ʱ�ȭ �˴ϴ�.<br/>
</div>
	</td>
</tr>
	</td>
</tr>

</table>
<div class=button><input type=image src="../img/btn_save.gif"></div>
</form>

<p>
<div id=MSG01>
<table cellpadding=1 cellspacing=0 border=0 class=small_ex>
<tr><td><img src="../img/icon_list.gif" align="absmiddle">�� ��ٱ��ϴ�� Ȯ�� �˾� ������ ����</font></td></tr>
<tr><td><img src="../img/icon_list.gif" align="absmiddle">���� ��ٱ��� ������ �̵��������� ����ٱ��� �������� �̵����� ���á����� ������ ������ ����ٱ��� ��� Ȯ�� </td></tr>
<tr><td><img src="../img/icon_list.gif" align="absmiddle">�˾��� �������� �����ΰ��� ���� Ʈ�� �׸��� <a href="../design/codi.php?design_file=goods/popup_cart_add.htm"><font color=white><b>[ ��ǰ > ��ٱ��ϴ�� �˾� ]</b></font></a> ���� ������ ������ �����մϴ�. 

</td></tr>
 
</table>
</div>
<script>cssRound('MSG01')</script>
 


<? include "../_footer.php"; ?>