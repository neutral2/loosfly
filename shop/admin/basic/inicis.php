<?

### �̴Ͻý� �⺻ ���ð�
$_pg		= array(
			'zerofee'	=> 'no',
			'receipt'	=> 'N',
			'quota'		=> '����:�Ͻú�:2����:3����:4����:5����:6����:7����:8����:9����:10����:11����:12����',
			);
$_escrow	= array(
			'use'		=> 'N',
			'type'		=> 'INI',
			'min'		=> 50000,			
			);

$location = "������⿬�� > �̴Ͻý�PG ����";
include "../_header.popup.php";
include "../../conf/config.pay.php";
if ($cfg[settlePg]=="inicis"){
	include "../../conf/pg.$cfg[settlePg].php";
	include "../../conf/pg.escrow.php";
}

$pg = @array_merge($_pg,$pg);
$escrow = @array_merge($_escrow,$escrow);

if($cfg['settlePg']!="inicis") $pg = array(); //pgŸ��üũ

if ($cfg[settlePg]=="inicis" && $pg['id']) $spot = "<b style='color:#ff0000;padding-left:10px'><img src=../img/btn_on_func.gif align=absmiddle></b>";
$checked[ssl][$pg[ssl]] = $checked[zerofee][$pg[zerofee]] = $checked[cert][$pg[cert]] = $checked[bonus][$pg[bonus]] = "checked";
$checked[escrow]['use'][$escrow['use']] = $checked['type'][$escrow[type]] = $checked[escrow][comp][$escrow[comp]] = $checked[escrow]['min'][$escrow['min']] = "checked";
$checked[receipt][$pg[receipt]] = "checked";

if ($set['use'][c]) $checked[c] = "checked";
if ($set['use'][o]) $checked[o] = "checked";
if ($set['use'][v]) $checked[v] = "checked";
if ($set['use'][h]) $checked[h] = "checked";

if ($escrow[c]) $checked[method][c] = "checked";
if ($escrow[o]) $checked[method][o] = "checked";
if ($escrow[v]) $checked[method][v] = "checked";
$checked[displayEgg][$cfg[displayEgg]+0] = "checked";

if ($cfg[settlePg]=="inicis"){

	$dir = "../../order/card/inicis/key/";

	if (is_dir($dir.$pg[id])){
		$od = opendir($dir.$pg[id]);
		while ($rd=readdir($od)){
			if (!ereg("\.$",$rd)) $fls[pg][] = $rd;
		}
	}
	if (is_dir($dir.$escrow[id])){
		$od = opendir($dir.$escrow[id]);
		while ($rd=readdir($od)){
			if (!ereg("\.$",$rd)) $fls[escrow][] = $rd;
		}
	}

}
// ����ũ�� ������ũ ó��
$escrow['eggDisplayLogo']	= stripslashes(html_entity_decode($escrow['eggDisplayLogo'], ENT_QUOTES));

// php 5�̻��� ��� inipay ���� ��ư
if (substr(phpversion(),0,1) >= 5) {
	$inipayBtn	= "<img src=\"../img/btn_inipayChange.gif\" border=\"0\" align=\"absmiddle\" class=\"hand\" alt=\"INIPay TX5 ���� ���� ��ȯ\" onclick=\"inipayChange()\">";
}
?>
<script language=javascript>

var arr=new Array('c','v','o','h');

function chkSettleKind(){
	var f = document.forms[0];

	var ret = false;
	for(var i=0;i < arr.length;i++)
	{
		var sk = document.getElementsByName('set[use]['+arr[i]+']')[0].checked;
		if(sk == true)ret=true;
	}
	var robj =  new Array('pg[id]');

	for(var i=0;i < robj.length;i++){
		var obj = document.getElementsByName(robj[i])[0];
		if(ret){
			obj.style.background = "#ffffff";
			obj.readOnly = false;
		}else{
			obj.style.background = "#e3e3e3";
			obj.readOnly = true;
		}
	}
}

function chkEscrow(){

	var obj = document.getElementsByName('escrow[id]')[0];

	if(document.getElementsByName('escrow[use]')[0].checked){
		obj.style.background = "#ffffff";
		obj.readOnly = false;
		return true;
	}else{
		obj.style.background = "#e3e3e3";
		obj.readOnly = true;
		return false;
	}

}

function chkFormThis(f){

	var ret = false;
	var sk = false;
	var p_id = document.getElementsByName('pg[id]')[0];
	var s_id =  document.getElementsByName('escrow[id]')[0];

	for(var i=0;i < arr.length;i++)
	{
		sk = document.getElementsByName('set[use]['+arr[i]+']')[0].checked;
		if(sk == true)ret=true;
	}

	if(!p_id.value && ret){
		p_id.focus();
		alert('INIPay ID�� �ʼ��׸��Դϴ�.');
		return false;
	}

	if( chkEscrow() && !s_id.value ){
		s_id.focus();
		alert('Escrow ID�� �ʼ��׸��Դϴ�.');
		return false;
	}

	if(!chkPgid()){
		alert('INIPay ID�� �ùٸ��� �ʽ��ϴ�.');
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

var oldId = "<?php echo $pg['id'];?>";
function openPrefix(){
	if(chkPgid()){
		alert("�������� INIPay ID�Դϴ�.\n���� ���� ��û�� �ʿ� �����ϴ�.\nâ�� �ݰ� INIPay ID�� �Է��ϼ���!");
		return;
	}
	var obj = document.getElementById('prefix');
	var pgid = document.getElementById('pgid').value;
	var ifrm = document.getElementById('pgifrm');
	get_pginfo(pgid);
	obj.className = 'show';
}
function closePrefix(){
	var obj = document.getElementById('prefix');
	document.getElementById('pgid').value='';
	obj.className = 'hide';
}
function get_pginfo(pgid){
	var ajax = new Ajax.Request( "../../proc/pginfo.indb.php",
	{
		method: "post",
		parameters: "mode=getPginfo&pgtype=inicis&pgid="+pgid,
		onComplete: function ()
		{
			var req = ajax.transport;
			if (req.status != 200) return;
			if (req.responseText =='') return;
			var ifrm = document.getElementById('pgifrm');
			ifrm.src = req.responseText;
		}
	} );
}
function chkPgid(){
	var obj = document.getElementById('pgid');
	var pattern = /^(GODO)/;
	var pattern2 = /^(GDP)/;
	if(pattern2.test(obj.value) || pattern.test(obj.value) || (oldId == obj.value && oldId)){
		return true;
	}else if(obj.value){
		return false;
	}
	return true;
}

window.onload = function(){
	resizeFrame();
	chkPgid();
}

function inipayChange(){
	if(confirm('INIPay TX5 ���� ���� ��ȯ �Ͻðڽ��ϱ�?\r\n\r\n������ ����\r\n1.��ȯ�� �Ͻø� ���� ����ϴ� �ϳ�����ũ�δ� ����� �ȵ˴ϴ�.\r\n2.�̴Ͻý��� �̴Ͽ���ũ�θ� ��û�ϼž� �մϴ�.\r\n- �ڼ��� ������ ���� �������ͷ� ���� �ٶ��ϴ�.\r\n\r\n��ȯ�� �ݵ�� �����ư�� ������ ��ȯ�� �Ϸ� �˴ϴ�.') == true){
		var inicisKeyName	= document.getElementById('pgid').value;
		var ajax = new Ajax.Request( "./indb.php",
		{
			method: "post",
			parameters: "mode=inipayKeyCopy&inicisKeyName="+inicisKeyName,
			onComplete: function ()
			{
				var req = ajax.transport;
				parent.chgifrm('inipay.php',3);
			}
		} );
	}
}
function iniescrowUSE() {	
	if(document.getElementsByName('escrow[type]')[1].checked){ //�̴Ͽ���ũ�θ� �����ߴٸ�
		document.getElementById('ini_mark').style.display="block";
		document.getElementById('MSG03_2').style.display="block";
		document.getElementById('MSG03_1').style.display="none";
		document.getElementById('hana_ment').style.display="none";
		document.getElementById('ini_ment').style.display="inline";
		document.getElementById('hana_ment2').style.display="none";
		document.getElementById('ini_ment2').style.display="inline";
	}else{ //�ϳ�����ũ�θ� �����ߴٸ�
		document.getElementById('ini_mark').style.display="none";		
		document.getElementById('MSG03_2').style.display="none";		
		document.getElementById('MSG03_1').style.display="block";
		document.getElementById('hana_ment').style.display="inline";
		document.getElementById('ini_ment').style.display="none";
		document.getElementById('hana_ment2').style.display="inline";
		document.getElementById('ini_ment2').style.display="none";
		
	}
}
</script>
<style>
.show {display:block}
.hide {display:none}
</style>
<div style="postion:relative">
<div id="prefix" style="position:absolute;" class="hide">
<iframe id="pgifrm" frameborder="0" width="554" height="366"></iframe>
</div>
</div>
<div class="title title_top">�̴Ͻý�PG ����<!--span>�ſ�ī�� ���� �� ��Ÿ��������� �ݵ�� ���ڰ������� ��ü�� ����� �����ñ� �ٶ��ϴ�</span--> <a href="javascript:manual('<?=$guideUrl?>board/view.php?id=basic&no=7')"><img src="../img/btn_q.gif" border=0 align=absmiddle></a>
</div>
<div id="inicis_banner"><script>panel('inicis_banner', 'pg');</script></div>
<form method=post action="indb.pg.php" enctype="multipart/form-data" onsubmit="return chkFormThis(this)">
<input type=hidden name=mode value="inicis">
<input type=hidden name=cfg[settlePg] value="inicis">
<div id=MSG01>
<table cellpadding=1 cellspacing=0 border=0 class=small_ex>
<tr><td colspan="2">
�̴Ͻý����� �����ϴ� �ſ�ī��,������ü,�������,�ڵ����� ���������� �湮��(�Һ���)���� �����ϱ� ���ؼ�<BR>
�̴Ͻý����� <b>���Ϸ� ������ ���������� Ǯ� INIPay ID�� Key File 3���� �Է�</b>�Ͻ��� �� ������ �ϴ��� �����ư�� Ŭ���� �ּ���.<BR>
���� �̴Ͻý��� ����� ���� �����̴ٸ� ��<u>�¶��ν�û �Ͻ���</u> ��<u>��༭���� �������� �̴Ͻý��� ����</u>�ּ��� <a href="../basic/pg.intro.php" target="_blank"><font color='#ffffff'><b>[��� �󼼾ȳ�]<b/></font></a>
</td></tr>
</table>
</div>
<script>cssRound('MSG01')</script>
<div style="font:0;height:5"></div>
<table border=1 bordercolor=#e1e1e1 style="border-collapse:collapse" width=100%>
<col class=cellC><col class=cellL>
<tr>
	<td class=ver8><b>PG��</b></td>
	<td><b>�̴Ͻý� (INIPay V4.119) <?=$spot?></b> <?=$inipayBtn?></td>
</tr>
<tr>
	<td>�������� ����</td>
	<td class=noline>
	<input type=checkbox name=set[use][c] <?=$checked[c]?> onclick="chkSettleKind()"> �ſ�ī��
	<input type=checkbox name=set[use][o] <?=$checked[o]?> onclick="chkSettleKind()"> ������ü
	<input type=checkbox name=set[use][v] <?=$checked[v]?> onclick="chkSettleKind()"> �������
	<input type=checkbox name=set[use][h] <?=$checked[h]?> onclick="chkSettleKind()"> �ڵ���
	&nbsp;&nbsp;&nbsp;<font class=extext><b>(�ݵ�� �̴Ͻý��� ����� �������ܸ� üũ�ϼ���)</b></font>
	</td>
</tr>
<tr>
	<td class=ver8><b>INIPay ID</b></td>
	<td>
	<div style="float:left"><input type="text" name="pg[id]" class="lline" value="<?=$pg[id]?>" onkeyup="chkPgid()" onblur="chkPgid()" id="pgid"></div>
	<div style="float:left;padding:0 0 0 5" id="btPgId"><a href="javascript:openPrefix();"><img src="../img/pginfo.gif" alt="���� ���� ��û" /></a></div>
	<div style="clear:both" class="extext">GODO,GDP�� ���۵Ǵ� INIPay ID�� ���� �Է� �����մϴ�. (��, ���� �Է°��� �����մϴ�)</div>
	<div class="extext">������ �ַ�� �̿����� ���� ������ ����ϰ� �־� ���� ���̵�� �������� �ʴ� ��쿡�� ���� ���� ��û�� �ϼž� �մϴ�.</div>
	</td>
</tr>
<? for ($i=1;$i<=3;$i++){ ?>
<tr>
	<td class=ver8><b>INIPay Key File #<?=$i?></b></td>
	<td class=ver8><input type=file name=pg[file_0<?=$i?>] class=lline> <?=$fls[pg][$i-1]?></td>
</tr>
<? } ?>
<tr>
	<td height=50>�Ϲ��ҺαⰣ</td>
	<td>
	<input type=text name=pg[quota] value="<?=$pg[quota]?>" class=lline style="width:500px">
	<div class=extext  style="padding-top:5px">ex) <?=$_pg[quota]?></div>
	</td>
</tr>
<tr>
	<td>������ ����</td>
	<td class=noline>
	<input type=radio name=pg[zerofee] value="no" checked> �Ϲݰ���
	<input type=radio name=pg[zerofee] value="yes" <?=$checked[zerofee][yes]?>> �����ڰ��� <font class=extext><b>(�����ڰ����� �ݵ�� PG��� ���ü�� �Ŀ� ����ؾ� �մϴ�!)</b> (�Ʒ� '������ �Ⱓ' ���� üũ)</font></td>
</tr>
<tr>
	<td height=92>������ �Ⱓ</td>
	<td><input type=text name=pg[zerofee_period] value="<?=$pg[zerofee_period]?>" class=lline style="width:500px">
	<div style="padding-top:7px"><font class=extext >* ī����ڵ� :  01 (��ȯ), 03 (�Ե�/(��)����), 04 (����), 06 (����), 11 (BC), 12 (�Ｚ), 14 (����), 34 (�ϳ�SK), 41 (NH - ����)</div>
	<div style="padding-top:3px">ex) ��ī�� 3���� / 6���� �Һο� �Ｚī�� 3���� ������ ����� �� 11-3:6,12-3 ��� �Է�</div>
	<div style="padding-top:3px">ex) ���ī�忡 ���ؼ� 3���� / 6���� ������ ����� �� ALL-3:6 ��� �Է�</div>
	<div style="padding:3px 0 7px 0">* ������ �Ⱓ�� ����Ϸ��� �ݵ�� ���� �����ڰ����� üũ�ϼ���!</div></td>
</tr>
</table>
<div id=MSG02>
<table cellpadding=1 cellspacing=0 border=0 class=small_ex>
<tr><td><img src="../img/icon_list.gif" align="absmiddle">PG���� �������� ������ �����Բ��� ī����� �׽�Ʈ�� �� �غ��ñ� �ٶ��ϴ�.</td></tr>
<tr><td><img src="../img/icon_list.gif" align="absmiddle">��Ȥ PG�縦 ���� ī����ε� ���� �������Ͽ� �ֹ��������������� �Ա�Ȯ������ �ڵ�������� ������ �ֽ��ϴ�.</td></tr>
<tr><td><img src="../img/icon_list.gif" align="absmiddle">�ݵ�� �ֹ������������� �ֹ����¿� PG�翡�� �����ϴ� ������ȭ�鳻�� ī����γ����� ���ÿ� Ȯ���� �ֽʽÿ�.</font></td></tr>
<tr><td height=8></td></tr>
<tr><td><font class=def1 color=white><b>- �̴Ͻý� PG��� "�������" ���������� ���Ǿ� �ִ� ��� (�ʵ�!) -</b></font></td></tr>
<tr><td>�� �̴Ͻý�PG��� "�������" ���������� ���Ǿ� �ִ� �����̶�� "��������Աݳ��� �ǽð� �뺸" ���񽺸� ���� �����ϰ� �Աݳ����� Ȯ���Ͻ� �� �ֽ��ϴ�.</td></tr>
<tr><td>�� "��������Աݳ��� �ǽð��뺸" ��  ������ ������·� �Ա��� �ϰ� �Ǿ� ������ �� ���  �Աݳ������ΰ������ e���� �������������� ������  �ش��ֹ��ǿ� ���Ͽ�
 �ڵ����� "�Ա�Ȯ��" ó���� �ǵ��� �� �� �ִ� ���Դϴ�. </td></tr>
<tr><td>�� ���� "��������Աݳ��� �ǽð� �뺸"�� �����Ͽ� �̴Ͻý� PG�翡 ��û�� �Ͻ� �������� Ȯ���� �غ��ñ� �ٶ��ϴ�. <a href="javascript:popup('http://guide.godo.co.kr/guide/php/ex_inisis_pg.html#01',1113,420)"><img src="../img/btn_dacompg_sample.gif" align=absmiddle></a></td></tr>
<tr><td>�� ��û�� �Ͻ� ���¶�� �׸����� �����Ǿ� �ִ� ����,   "�Աݳ����뺸URL"�� http://������/shop/order/card/inicis/vacctinput.php ���� �Է��� ���ֽñ� �ٶ��ϴ�. <a href="javascript:popup('http://guide.godo.co.kr/guide/php/ex_inisis_pg.html#02',1113,420)"><img src="../img/btn_dacompg_sample.gif" align=absmiddle></a></td></tr>
<tr><td>�� ������¿� �����Ͽ� "�Աݳ��� �뺸 ���" / "�뺸��ļ���" / "�Աݳ����뺸URL" ���������� ��� ��ġ�� ���¶�� ������� �ֹ� �׽�Ʈ �� ������·� �Ա��� �Ŀ�</td></tr>
<tr><td>�̴Ͻý� PG�翡���� ���ο��ο� e���� ������������������ �ֹ�ó�����°� "�Ա�Ȯ��"���� ����Ǿ����� Ȯ���� �ֽø� �˴ϴ�.</td></tr>
<tr><td>�� ���������� �Ա��뺸 ������� ���� ���� e���� �������������� �ֹ�����Ʈ���� �ش��ֹ����� (������¿� ����)   �ֹ�ó�����°� �Ա�Ȯ���� ���� �ʾ��� ��
   �� ����������� Ȯ���� �ֽñ� �ٶ��ϴ�. <a href="javascript:popup('http://guide.godo.co.kr/guide/php/ex_inisis_pg.html#03',1113,420)"><img src="../img/btn_dacompg_sample.gif" align=absmiddle></a></td></tr>
</table>
</div>
<script>cssRound('MSG02')</script>

<div style="display:block">
<div class=title>����ũ�� ���� <span>���ݼ� ������ �ǹ������� ����ũ�ΰ����� ����ؾ� �մϴ�. ����ũ�ζ�?</span> <a href="javascript:manual('<?=$guideUrl?>board/view.php?id=basic&no=7')"><img src="../img/btn_q.gif" border=0 align=absmiddle></a></div>

<div id="MSG03">
	<div id="MSG03_1">
	<table border=0 cellpadding=1 cellspacing=0 border=0 class=small_ex>
	<tr><td>�̴Ͻý����� �����ϴ� �ϳ����� ����ũ�� ���������� �湮��(�Һ���)���� �����ϱ� ���ؼ�</td></tr>
	<tr><td>�̴Ͻý����� <b>���Ϸ� ������ ���������� Ǯ� Escrow ID�� Escrow Key File 3���� �Է�</b>�Ͻ��� �� ������ �ϴ��� �����ư�� Ŭ���� �ּ���.</td></tr>
	<tr><td>���� �̴Ͻý��� �ϳ����� ����ũ�θ� ��� ���� �����̴ٸ�</td></tr>
	<tr><td style="padding-left:10">���༭���� �������� �̴Ͻý��� ������</td></tr>
	<tr><td style="padding-left:10">��<a href="http://www.hanaescrow.com/new/apply/1/1/index.jsp" target="_blank"><font color="#ffffff"><u>�ϳ�����ũ�� ����Ʈ(http://www.hanaescrow.com)���� ������������ ���ڼ���</u></font></a></td></tr>
	</table>
	</div>
	<div id="MSG03_2">
	<table border=0 cellpadding=1 cellspacing=0 border=0 class="small_ex">
	<tr><td>�̴Ͻý����� �����ϴ� �̴� ����ũ�� ���������� �湮��(�Һ���)���� �����ϱ� ���ؼ�</td></tr>
	<tr><td>�̴Ͻý����� <b>���Ϸ� ������ ���������� Ǯ� Escrow ID�� Escrow Key File 3���� �Է�</b>�Ͻ��� �� ������ �ϴ��� �����ư�� Ŭ���� �ּ���.</td></tr>
	<tr><td>���� �̴Ͻý� �̴� ����ũ�θ� ��� ���� �����̴ٸ�</td></tr>
	<tr><td style="padding-left:10">���༭���� �������� �̴Ͻý��� �����Ͻø� �˴ϴ�.</td></tr>
	</table>
	</div>
</div>

<script>cssRound('MSG03')</script>

<div style="padding-top:5"></div>
<table border=1 bordercolor=#e1e1e1 style="border-collapse:collapse" width=100%>
<col class=cellC><col class=cellL>
<tr>
	<td>��뿩��</td>
	<td class=noline>
	<input type=radio name=escrow[use] value="Y" <?=$checked[escrow]['use'][Y]?> onclick="chkEscrow()"> ���
	<input type=radio name=escrow[use] value="N" <?=$checked[escrow]['use'][N]?> onclick="chkEscrow()"> ������<span style="padding-left:15" id="hana_ment"><font class=extext><b>(�̴Ͻý��� �ϳ����� ����ũ�θ� ����ϼ̴ٸ� ������� üũ�ϼ���)</b></font></span><span style="padding-left:15" id="ini_ment"><font class=extext><b>(�̴Ͻý��� �̴Ͽ���ũ�θ� ����ϼ̴ٸ� ������� üũ�ϼ���)</b></font></span>
	</td>
</tr>
<tr>
	<td>����ũ������</td>
	<td class="noline">
	<input type="radio" name="escrow[type]" value="HANA" <?=$checked['type'][HANA]?> onclick="iniescrowUSE()"> �ϳ�����ũ��
	<input type="radio" name="escrow[type]" value="INI" <?=$checked['type'][INI]?> onclick="iniescrowUSE()"> �̴Ͽ���ũ��
	</td>
</tr>
<input type=hidden name=escrow[comp] value="PG">	<!-- ����ũ�� ������� -->
<!--
<tr>
	<td>��� ����</td>
	<td class=noline>
	<input type=radio name=escrow[comp] value="PG" <?=$checked[escrow][comp][PG]?>> �ش� PG�� ����ũ��
	<input type=radio name=escrow[comp] value="hanaBank" <?=$checked[escrow][comp][hanaBank]?> disabled> �ϳ����� ����ũ��
	</td>
</tr>
-->

<tr>
	<td>���� ����</td>
	<td class="noline">
	<input type=checkbox name=escrow[c] <?=$checked[method][c]?> disabled> �ſ�ī��
	<input type=checkbox name=escrow[o] <?=$checked[method][o]?> disabled> ������ü
	<input type=checkbox name=escrow[v] <?=$checked[method][v]?>> �������<span style="padding-left:15" id="hana_ment2"><font class=extext><b>(�̴Ͻý��� �ϳ����� ����ũ�δ� ������� �������ܿ� ���� �˴ϴ�)</b></font></span><span style="padding-left:15" id="ini_ment2"><font class=extext><b>(�̴Ͻý��� �̴Ͽ���ũ�δ� ������� �������ܿ� ���� �˴ϴ�)</b></font></span>
	</td>
</tr>
<tr>
	<td>��� �ݾ�</td>
	<td>
	<input type="text" name="escrow[min]" value="<?=$escrow[min]?>" class="lline" onkeydown="onlynumber()" style="width:100px;">
	<div class="extext"  style="padding-top:4px">PG�縶�� ����ũ�� ������ ��� �ݾ׿� ������ �ȵɼ��� �����Ƿ�, �ݵ�� ������ PG���� ����ũ�� ��೻���� �� Ȯ���ϼ���.</div>
	</td>
</tr>
<!--
<tr>
	<td>���� ������ �δ�</td>
	<td>
	<input type=text name=escrow[fee] value="<?=$escrow[fee]+0?>" size=5 class=right> %
	</td>
</tr>
-->
<tr>
	<td>Escrow ID</td>
	<td>
	<input type=text name=escrow[id] class=lline value="<?=$escrow[id]?>">
	</td>
</tr>
<? for ($i=1;$i<=3;$i++){ ?>
<tr>
	<td class=ver8><b>Escrow Key File #<?=$i?></b></td>
	<td class=ver8><input type=file name=escrow[file_0<?=$i?>] class=lline> <?=$fls[escrow][$i-1]?></td>
</tr>
<? } ?>
<tr>
	<td>���� ���� ǥ��<div style="padding-top:3"><a href="javascript:manual('<?=$guideUrl?>board/view.php?id=basic&no=10')"><font class=extext_l>[ǥ���̹��� ����]</font></a></div></td>
	<td class=noline>
	<input type=radio name=cfg[displayEgg] value=0 <?=$checked[displayEgg][0]?>> �����ϴܰ� �������� �������������� ǥ��
	<input type=radio name=cfg[displayEgg] value=1 <?=$checked[displayEgg][1]?>> ��ü�������� ǥ��
	<input type=radio name=cfg[displayEgg] value=2 <?=$checked[displayEgg][2]?>> ǥ������ ����
	</td>
</tr>
<tr id="ini_mark" style="display:;">
	<td>����ũ�� ���� ��ũ</td>
	<td class="noline">
		<textarea name="escrow[eggDisplayLogo]" style="width:100%;height:80px" class="tline"><?php echo $escrow['eggDisplayLogo'];?></textarea><br />
		<font class="extext"><b>�� <a href="http://mark.inicis.com/certi2/certi_escrow.php" class="extext_l" target="_blank">[KG �̴Ͻý� ��������]</a>���� ���� ���� ������ ��������.</b></font>
	</td>
</tr>
</table>

<div style="padding-top:10"></div>

<table border=1 bordercolor=#e1e1e1 style="border-collapse:collapse" width=100%>
<tr><td>
<table cellpadding=15 cellspacing=0 border=0 bgcolor=white width=100%>
<tr><td>
<div style="padding:0 0 5 0">* ���ž������� ǥ�� ������ (����ũ�� ���� ������ ���ž���ǥ�ø� üũ�ϰ�, �Ʒ� ǥ������ ���� �ݿ��ϼ���)</font></div>
<table width=100% height=100 class=tb style='border:1px solid #cccccc;' bgcolor=white>
<tr>
<td width=30% style='border:1px solid #cccccc;padding-left:20'>�� [���������� �ϴ�] ǥ����</td>
<td align=center rowspan=2 style='border:1px solid #cccccc;padding:0 10 0 10'><a href="javascript:manual('<?=$guideUrl?>board/view.php?id=basic&no=10')"><img src="../img/icon_sample.gif" align=absmiddle></a></td>
<td width=70% style='border:1px solid #cccccc;padding-left:40'><font class=extext><a href='../design/codi.php?design_file=outline/footer/standard.htm' target=_blank><font class=extext><b>[�����ΰ��� > ��ü���̾ƿ� ������ > �ϴܵ����� > html�ҽ� ��������]</b></font></a> �� ����<br> ġȯ�ڵ� <font class=ver8 color=000000><b>{=displayEggBanner()}</b></font> �� �����ϼ���. <a href='../design/codi.php?design_file=outline/footer/standard.htm' target=_blank><font class=extext_l>[�ٷΰ���]</font></a></font></td>
</tr>
<tr>
<td width=30% style='border:1px solid #cccccc;padding-left:20'>�� [�������� ����������] ǥ����</td>
<td width=70% style='border:1px solid #cccccc;padding-left:40'>
<a href='../design/codi.php?design_file=order/order.htm' target=_blank><font class=extext><font class=extext_l>[�����ΰ��� > ��Ÿ������ ������ > �ֹ��ϱ� > order.htm]</font></a> �� ����<br> ġȯ�ڵ� <font class=ver8 color=000000><b>{=displayEggBanner(1)}</b></font> �� �����ϼ���. <a href='../design/codi.php?design_file=order/order.htm' target=_blank><font class=extext_l>[�ٷΰ���]</font></a></font></td>
</tr>
</table>
</td></tr>
</table>

<div style="padding-top:15"></div>

<table cellpadding=1 cellspacing=0 border=0 class=small_tip>
<tr><td><img src="../img/icon_list.gif" align="absmiddle"><font class=extext><b>���ž������� ���� ǥ�� �ǹ�ȭ �ȳ� (2007�� 9�� 1�� ����)</b></font></td></tr>
<tr><td style="padding-top:4px">&nbsp;&nbsp;<font class=extext>�� ǥ�á����� �Ǵ� ������ ��ġ�� ���̹��� �ʱ�ȭ��� �Һ����� �������� ����ȭ�� �� ������ ����.</font></td></tr>
<tr><td style="padding-left:16"><font class=extext>- ���̹��� �ʱ�ȭ�� ��� ��10����1���� ������� �ſ� �� ǥ����� ����κ��� �ٷ� ���� �Ǵ� ������ ���ž������� ���� ������ ǥ���ϵ��� ��.</font></td></tr>
<tr><td style="padding-left:16"><font class=extext>- �Һ��ڰ� ��Ȯ�� ���ظ� �������� ���ž������� �̿��� ������ �� �ֵ���, �������� ���úκ��� �ٷ� ���� ���ž������� ���û����� �˱� ���� �����Ͽ���  ��.</font></td></tr>
<tr><td style="padding-top:4px">&nbsp;&nbsp;<font class=extext>�� ǥ�á����� �Ǵ� ���� �������� ������ �� ������ ������.</font></td></tr>
<tr><td style="padding-left:16"><font class=extext>- ���� ������ 5���� �̻� ������ �Һ��ڰ� ���ž��������� �̿��� ������ �� �ִٴ� ����</font></td></tr>
<tr><td style="padding-left:16"><font class=extext>- ����Ǹž��� �ڽ��� ������ ���ž��������� ��������ڸ� �Ǵ� ��ȣ</font></td></tr>
<tr><td style="padding-left:16"><font class=extext>- �Һ��ڰ� ���ž������� ���Ի���� ������ Ȯ�� �Ǵ� ��ȸ�� �� �ִٴ� ����</font></td></tr>
<tr><td height=10></td></tr>
</table>

<table cellpadding=1 cellspacing=0 border=0 class=small_tip>
<tr><td><img src="../img/icon_list.gif" align="absmiddle"><font class=extext><b>���ž������� ���� Ȯ�� (2011�� 7�� 29�� ����)</b></font></td></tr>
<tr><td style="padding-top:4px">&nbsp;&nbsp;<font class=extext>�� ����Ǹž��ڴ� 5���� �̻��� ���ſ� ���ؼ��� ���ž������񽺸� ������ �� �ֵ��� �ý����� �����Ͽ��� ��.</font></td></tr>
<tr><td style="padding-left:16"><font class=extext>- ���̹��� �ʱ�ȭ�� �� �������� ����â�� ���ž���ǥ�úο� ��10���� �̻󡯡� ��5���� �̻����� ������ ��.</font></td></tr>
<tr><td style="padding-top:4px">&nbsp;&nbsp;<font class=extext>�� ����Ǹž� ���� ���� ������ ���� ����� ��ġ���� �ȳ�.</font></td></tr>
<tr><td style="padding-left:16"><font class=extext>- ���� ����</font></td></tr>
<tr><td style="padding-left:16"><font class=extext>&nbsp;&nbsp;: ���ڻ�ŷ� ����� �Һ񰡺�ȣ�� ���� ���� : ����� ��28���� 2</font></td></tr>
<tr><td style="padding-left:16"><font class=extext>&nbsp;&nbsp;: ���ڻ�ŷ� ����� �Һ񰡺�ȣ�� ���� ���� : �����Ģ ��7���� 2(�ż�)</font></td></tr>
<tr><td style="padding-left:16"><font class=extext>- ���ž������� ���� Ȯ�� : ��10���� �̻󡯡� ��5���� �̻�(1ȸ ������)</font></td></tr>
<tr><td style="padding-left:16"><font class=extext>- ���̹��� �ʱ�ȭ�� �� �������� ����â ��5���� �̻����� ����</font></td></tr>
<tr><td height=10></td></tr>
</table>
</td></tr></table>


<div class=title>���ݿ����� <a href="javascript:manual('<?=$guideUrl?>board/view.php?id=basic&no=7')"><img src="../img/btn_q.gif" border=0 align=absmiddle></a></div>
<table border=1 bordercolor="#e1e1e1" style="border-collapse:collapse" width="100%">
<col class=cellC><col class=cellL>
<tr>
	<td>���ݿ�����</td>
	<td class=noline>
	<input type=radio name=pg[receipt] value="N" <?=$checked[receipt][N]?>> ������
	<input type=radio name=pg[receipt] value="Y" <?=$checked[receipt][Y]?>> ���
	<BR><font class=extext style="padding-left:5px">�̴Ͻý� ���ݿ����� �̿��� �̴Ͻý� ���ݿ����� �ȳ��� Ȯ���Ͻñ� �ٶ��ϴ�. <a class="extext" style="font-weight:bold" href="http://www.inicis.com/ini_22.jsp" target="_blank">[�ٷΰ���]</a></font>
	</td>
</tr>
</table><p>
</div>

<div id=MSG04>
<table cellpadding=1 cellspacing=0 border=0 class=small_ex>
<tr><td><img src="../img/icon_list.gif" align="absmiddle">���ž�������(����ũ�� �Ǵ� ���ں���)�� ���ڻ�ŷ��Һ��ں�ȣ�� �� ����� ������ ���� 2011�� 7�� 29�Ϻ��� 5���� �̻� ���ݼ� ������ �ǹ� ����˴ϴ�.</td></tr>
<tr><td><img src="../img/icon_list.gif" align="absmiddle">����ũ�� ������ �� ���ݾ׿� ���Ѱ��� ��û�� PG�糪 ���࿡ ���� �ٸ� �� �����Ƿ� ���Ǹ� �ϼž� �մϴ�.</td></tr>
<tr><td><img src="../img/icon_list.gif" align="absmiddle">�Һ��ڴ� 2008.7.1�Ϻ��� ���ݿ����� �߱޴��ݾ��� 5õ���̻󿡼� 1���̻����� ����Ǿ� 5õ�� �̸��� ���ݰŷ��� ���ݿ������� ��û�Ͽ� �߱� ���� �� �ֽ��ϴ�.</td></tr>
</table>
</div>
<script>cssRound('MSG04')</script>


<div class=button>
<input type=image src="../img/btn_save.gif">
<a href="javascript:history.back()"><img src="../img/btn_cancel.gif"></a>
</div>

</form>
<script>chkSettleKind();chkEscrow(); iniescrowUSE();</script>