<?

### KCP �⺻ ���ð�
$_pg		= array(
			'id'	=> '',
			'receipt'	=> 'N',
			);
$_escrow	= array(
			'use_mobile'		=> 'N',
			'min'		=> 50000,
			);

$location = "������⿬�� > �������� PG����";
include "../_header.popup.php";
include "../../conf/config.pay.php";
if ($cfg[settlePg]=="easypay"){
	@include "../../conf/pg.$cfg[settlePg].php";
	@include "../../conf/pg_mobile.$cfg[settlePg].php";
	@include "../../conf/pg.escrow.php";
}

$pg = @array_merge($_pg,$pg);
$escrow = @array_merge($_escrow,$escrow);
if ($cfg[settlePg]=="easypay") $spot = "<b style='color:#ff0000;padding-left:10px'>[�����]</b>";
$checked[ssl][$pg[ssl]] = $checked[zerofee][$pg_mobile[zerofee]] = $checked[cert][$pg[cert]] = $checked[bonus][$pg[bonus]] = "checked";
$checked[escrow]['use_mobile'][$escrow['use_mobile']] = $checked[escrow][comp][$escrow[comp]] = $checked[escrow]['min'][$escrow['min']] = "checked";
$checked[receipt][$pg[receipt]] = "checked";

if ($set['use_mobile'][c]) $checked[c] = "checked";
if ($set['use_mobile'][v]) $checked[v] = "checked";
if ($set['use_mobile'][h]) $checked[h] = "checked";

if ($escrow[c]) $checked[method][c] = "checked";
if ($escrow[v]) $checked[method][v] = "checked";
$checked[displayEgg][$cfg[displayEgg]+0] = "checked";
?>
<script language=javascript>
var arr=new Array('c','v','h');
function chkSettleKind(){
	var f = document.forms[0];

	var ret = false; var sk = false;
	for(var i=0;i < arr.length;i++)
	{
		sk = document.getElementsByName('set[use_mobile]['+arr[i]+']')[0].checked;
		if(sk == true)ret=true;
	}
	var robj =  new Array('pg[id]');
}
function chkFormThis(f){

	var ret = false;
	var sk = false;
	var p_id = document.getElementsByName('pg[id]')[0];

	for(var i=0;i < arr.length;i++)
	{
		sk = document.getElementsByName('set[use_mobile]['+arr[i]+']')[0].checked;
		if(sk == true)ret=true;
	}

	if(!p_id.value && ret){
		p_id.focus();
		alert('�������� ID�� �ʼ��׸��Դϴ�.');
		return false;
	}

	return chkForm(f);
}
var IntervarId;

function resizeFrame()
{

    var oBody = document.body;
    var oFrame = parent.document.getElementById("pgifrm");
    var i_height = oBody.scrollHeight + (oFrame.offsetHeight-oFrame.clientHeight);
    oFrame.style.height = i_height;

    if ( IntervarId ) clearInterval( IntervarId );
}

window.onload = function(){
	resizeFrame()
}
</script>
<div class="title title_top">
�������� PG ����<span>�ſ�ī�� ���� �� ��Ÿ��������� �ݵ�� ���ڰ������� ��ü�� ����� �����ñ� �ٶ��ϴ�</span> <a href="javascript:manual('<?=$guideUrl?>board/view.php?id=basic&no=29')"><img src="../img/btn_q.gif" border=0 align=absmiddle></a>
</div>
<div id="easypay_banner"><script>panel('easypay_banner', 'pg');</script></div>
<form method=post action="indb.pg.php" enctype="multipart/form-data" onsubmit="return chkFormThis(this)">
<input type=hidden name=mode value="setPg">
<input type=hidden name=cfg[settlePg] value="easypay">

<div id=MSG01>
<table cellpadding=1 cellspacing=0 border=0 class=small_ex>
<tr><td>easypay���� �����ϴ� �ſ�ī��,������ü,�������,�ڵ����� ���������� �湮��(�Һ���)���� �����ϱ� ���ؼ�</td></tr>
<tr><td>KCP���� <b>���Ϸ� ������ ID�� �Է�</b>�Ͻ��� �� ������ �ϴ��� �����ư�� Ŭ���� �ּ���.</td></tr>
<!--<tr><td>���� KCP�� ����� ���� �����̴ٸ�</td></tr>
<tr><td style="padding-left:10">��<u>�¶��ν�û �Ͻ� ��</u></td></tr>
<tr><td style="padding-left:10">��<u>��༭���� �������� KCP�� ����</u>�ּ��� <a href="../basic/pg.intro.php" target="_blank"><font color="#ffffff"><b>[��� �󼼾ȳ�]</b></font></a></td></tr>//-->
</table>
</div>
<script>cssRound('MSG01')</script>
<div style="padding-top:15px"></div>
<table border=1 bordercolor=#e1e1e1 style="border-collapse:collapse" width=100%>
<col class=cellC><col class=cellL>
<tr>
	<td>PG��</td>
	<td><b>�������� (Easypay V7.0 ����Ʈ��) <?=$spot?></b></td>
</tr>
<tr>
	<td>�������� ����</td>
	<td class=noline>
	<input type=checkbox name=set[use_mobile][c] <?=$checked[c]?> onclick="chkSettleKind()"> �ſ�ī��
	<input type=checkbox name=set[use_mobile][v] <?=$checked[v]?> onclick="chkSettleKind()"> �������
	<input type=checkbox name=set[use_mobile][h] <?=$checked[h]?> onclick="chkSettleKind()"> �޴���
	&nbsp;&nbsp;&nbsp;<font class=extext><b>(�ݵ�� �������̿� ����� �������ܸ� üũ�ϼ���)</b></font></td>
</tr>
<tr>
	<td class=ver8><b>�������� ID</td>
	<td>
	<input type=text name="pg[id]" class="lline" value="<?=$pg[id]?>"  disabled="disabled">
	</td>
</tr>

<tr>
	<td>�ҺαⰣ</td>
	<td>
	<input type=text name=pg[quota] value="<?=$pg[quota]?>" class=lline disabled="disabled" >
	<div class=extext style="padding-top:4">�����ڰ� �Һ� ������ ������ �Һΰ��� �� �Դϴ�. 00 ���� 12 �� ���� �����ϴ�.ex) 00:02:03:04:05:06:07:08:09:10:11:12   </div>
	</td>
</tr>
<tr>
	<td>������ ����</td>
	<td class=noline>
	<input type=radio name=pg[zerofee] value="no" checked disabled="disabled" disabled="disabled"> �Ϲݰ���
	<input type=radio name=pg[zerofee] value="yes" <?=$checked[zerofee][yes]?> disabled="disabled"> �����ڰ��� (�Ʒ� �Ⱓ �Է�)
	 <font class=extext><b>(�����ڰ����� �ݵ�� PG��� ���ü�� �Ŀ� ����ؾ� �մϴ�!)</b></font></td>
</tr>
<tr>
	<td>������ �Ⱓ</td>
	<td>
	<input type=text name=pg[zerofee_period] value="<?=$pg[zerofee_period]?>" class=lline style="width:500px" disabled="disabled">
	<a href="javascript:popupLayer('../basic/popup.easypay.php',500,470)" style="color:#616161;" class=ver8><img src="../img/btn_carddate.gif" align=absmiddle></a>
	 
	</td>
</tr>


</table>
</div>

<div style="padding-top:15px"></div>

<div id=MSG02>
<table cellpadding=1 cellspacing=0 border=0 class=small_ex>
<tr><td><img src="../img/icon_list.gif" align="absmiddle">PG��� ����� ���� ���Ŀ��� ���Ϸ� ������ ���� ID�� �����ø� �˴ϴ�.</td></tr>
<tr><td><img src="../img/icon_list.gif" align="absmiddle">PG���� �������� ������ ���Բ��� ī����� �׽�Ʈ�� �� �غ��ñ� �ٶ��ϴ�.</td></tr>
<tr><td><img src="../img/icon_list.gif" align="absmiddle">��Ȥ PG�縦 ���� ī����ε� ���� �������Ͽ� �ֹ��������������� �Ա�Ȯ������ �ڵ�������� ������ �ֽ��ϴ�.</td></tr>
<tr><td><img src="../img/icon_list.gif" align="absmiddle">�ݵ�� �ֹ������������� �ֹ����¿� PG�翡�� �����ϴ� ������ȭ�鳻�� ī����γ����� ���ÿ� Ȯ���� �ֽʽÿ�.</font></td></tr>
<tr><td><img src="../img/icon_list.gif" align="absmiddle">������� ���� �Ա� �뺸�� ���θ��� �ޱ� ���ؼ��� �������̰����ڿ��� ����URL�� ������ּž� �մϴ�.</td></tr>
<tr><td><img src="../img/icon_list.gif" align="absmiddle">����URL�� "http://<?=$_SERVER['HTTP_HOST']?><?=$cfg['rootDir']?>/order/card/easypay/easypay_noti.php" �Դϴ�.</td></tr>
</table>
</div>
<script>cssRound('MSG02')</script>
<div class=title>���ݿ����� <a href="javascript:manual('<?=$guideUrl?>board/view.php?id=basic&no=29')"><img src="../img/btn_q.gif" border=0 align=absmiddle></a></div>
<table border=1 bordercolor=#e1e1e1 style="border-collapse:collapse" width=100%>
<col class=cellC><col class=cellL>
<tr>
	<td>���ݿ�����</td>
	<td class=noline>
	<div>
	<input type="radio" <?if($pg['receipt']=='Y'){echo "checked";}?> disabled />���  
	<input type="radio" <?if($pg['receipt']=='N'){echo "checked";}?> disabled />�̻��  
	<?if($pg['receipt']=='N'):?>
	�̻��
	<?else:?>
	���
	<?endif;?>
	<input type="hidden" name="pg[receipt]" value="<?=$pg[receipt]?>">
	</div>
	<font class=extext style="padding-left:5px">�������� ���ݿ����� �̿��� �������� ���ݿ����� �ȳ��� Ȯ���Ͻñ� �ٶ��ϴ�. <a class="extext" style="font-weight:bold" href="http://www.easypay.co.kr/service_receipt.jsp" target="_blank">[�ٷΰ���]</a></font>
	</td>
</tr>
 
</table><p>

 
<div id=MSG03>
<table cellpadding=1 cellspacing=0 border=0 class=small_ex>
<tr><td><img src="../img/icon_list.gif" align="absmiddle">���ݿ����� ��뿩�� �����ϱ�
</td></tr>
<tr><td><img src="../img/icon_list.gif" align="absmiddle"><a href="/shop/admin/basic/easypay.php" class="extext" style="font-weight:bold" >[ �⺻���� > ���������������� ]</a> ���������� �ش� PG������ �� �Ʒ��� "���ݿ�����" ��뿩�� �������� ���� �����մϴ�. </td></tr>

</table>
</div>
<script>cssRound('MSG03')</script>

<div class=button>
<input type=image src="../img/btn_save.gif">
<a href="javascript:history.back()"><img src="../img/btn_cancel.gif"></a>
</div>

</form>
<script>chkSettleKind();</script>