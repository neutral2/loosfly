<?

$scriptLoad='<script src="../design/codi/_codi.js"></script>';
include "../_header.popup.php";

$dir = str_replace( $_SERVER['SCRIPT_NAME'], "", $_SERVER['SCRIPT_FILENAME'] ) . '/w3c/';
if (is_dir($dir)){
	# �۹̼� üũ
	$dirperms	= decoct(fileperms($dir) - octdec(40000));	// ȭ���� ���� decoct(fileperms($dir) - octdec(100000)); �� üũ
	if($dirperms == "707" || $dirperms == "777"){
		$w3cDirChk	= "";
	}else{
		$w3cDirChk	= "<p /><div><font color=\"#FF0000\"><b>/w3c/������ �۹̼ǿ� ������ �ֽ��ϴ�. 707�� ������ �Ͻðų�, ���� �������ͷ� ���� �ֽñ� �ٶ��ϴ�.</b></font><div>";
	}
	# ������ ǥ�� ȭ�� üũ
	$od = opendir($dir);
	while ($rd=readdir($od)){
		if (!ereg("\.$",$rd)) $fls[w3c][] = $rd;
	}
}else{
	$w3cDirChk	= "<p /><div><font color=\"#FF0000\"><b>/w3c/������ �������� �ʽ��ϴ�. ���� �������ͷ� ���� �ֽñ� �ٶ��ϴ�.</b></font><div>";
}

?>

<div class="title title_top">����������޹�ħ �� ������ǥ��<span><font class="small">������ǥ�ø� �ۼ��ϰ� �ش� ����(p3p.xml, p3policy.xml)�� ���ε��մϴ�.</span></div>

<table cellpadding="0" cellspacing="0" bgcolor="#fafafa">
<tr><td style="padding: 15px 15px 15px 15px; text-align: justify">
<div><font color="#EA0095">&#149; ����������޹�ħ�̶�?</font><div>
<div style="padding-top:3px" class="small1">'������Ÿ� �̿����� �� ������ȣ � ���� ����'�� ������ �����̹��� ��ȣ�� ���� ������� �������� ����, �̿�, ������ ���� ���� ���� ���� �����ϰ� �ֽ��ϴ�.</div>
<div style="padding-top:3px" class="small1">������Դ� �ո����� ������ȣ �ؼ��ǹ��� �ο��ϰ� ���ο��Դ� �δ��� �������� ħ�ط� ���� ���ظ� �ּ�ȭ�ϱ� ���� ������Ÿ����� �����Ͽ� 2007�� 7�� 27�Ϻ��� �����մϴ�.</div>

<div style="padding-top:3px" class="small1">'����������޹�ħ'�� Ȩ������ ùȭ��, ����/�繫���� ���� ���� ���, ���� ���� ���๰ � ���� �Ǵ� ��ġ�ϴ� ������� �̿��ڰ� �������� �����ϰ� Ȯ���� �� �ֵ��� �����Ͽ��� �մϴ�. (�����Ģ ��3����2 ��1��)</div>
<div style="padding-top:3px" class="small1">������������ �׵��� ������Ʈ���� ���������� ����ؿ��� '����������ȣ��å', '����������ȣ��ħ' ���� �� '����������޹�ħ'���� ���Ͽ� ����ϵ��� �Ͽ����ϴ�. (�����Ģ ��3����2 ��1��)</div>

<!--<div style="padding-top:12">������ '����������ȣ��å' �̶�� �޴��� '����������޹�ħ'���� ����Ǿ����ϴ�.</div>
<div style="padding-top:3">�������� ���θ� �ϴ��� ���� '����������ȣ��å' �̶�� �Ǿ��ִٸ�, '����������޹�ħ'���� ������ ���ƾ� �մϴ�.</div>-->

<div style="padding-top:12px"><font color="ea0095">&#149; ������ ǥ�ö�?</font></div>
<div style="padding-top:3px" class="small1">����������޹�ħ�� ���� �� ������ �԰�ȭ�Ͽ� �̿��ڰ� ������ ���� �ʿ� ���� ����Ʈ��� ���� �ڵ����� ������ �� �ֵ��� ���� ������, ������Ÿ��������� 2007�� 7�� 27�Ϻ��� �� ����Ʈ�� �������� ��޹�ħ�� �����ϴ� ��쿡 ������ ǥ�ø� �ݵ�� �Բ� ǥ���ϵ��� �����ϰ� �ֽ��ϴ�.</div>

<!--<div style="padding-top:12px"><font class=main>��</font> <font color="ea0095">�Ʒ� �ѱ�������ȣ��������� ������ ���̵带 �� �о�ð�, �����Ͻñ� �ٶ��ϴ�.</font></div>

<div style="padding:5px 0 0 14px"><a href="http://guide.godo.co.kr/shop/sample.pdf" target="_blank"><font color="#0074BA"><u>����������޹�ħ�ۼ�����</u></b></font></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://guide.godo.co.kr/shop/action.pdf" target="_blank"><font color="#0074BA"><u>���������� ���� ����������ȣ ��ġ����</u></b></font></a></div>-->

<div style="padding-top:12px"><font color="ea0095">&#149; �ѱ�������ȣ������� ����Ʈ�� �����Ͻð�, �����ϴ� ���̵带 �����Ͻñ� �ٶ��ϴ�. </font></div>
<div style="padding-top:3px" class="small1"> - �ѱ�������ȣ����� : <a href="http://www.1336.or.kr" target="_blank"><font color="#0074BA"><b><u>http://www.1336.or.kr</u></b></font></a></div>
<div style="padding-top:3px" class="small1"> - ���̵� �� �ۼ����� : <a href="http://www.i-privacy.kr/jsp/user/private/prv_plan1.jsp" target="_blank"><font color="#0074BA"><b><u>http://www.i-privacy.kr/jsp/user/private/prv_plan1.jsp</u></b></font></a></div>
<div style="padding-top:3px" class="small1"> - �������� ��ȣ ��ġ : <a href="http://guide.kisa.or.kr/" target="_blank"><font color="#0074BA"><b><u>http://guide.kisa.or.kr</u></b></font></a></div>

<div style="padding-top:12px"><font color="ea0095">&#149; ����������޹�ħ �� ������ǥ�� �ۼ����. (�Ʒ� �ּҸ� Ŭ���ϼż� �ۼ��ϼ���) </font></div>
<div style="padding-top:3px" class="small1"> - <a href="http://www.checkprivacy.co.kr/main.jsp" target="_blank"><font color="#0074BA"><b><u>�ۼ��ϱ�</u></b></font></a></div>

</td></tr></table>

<div style="padding-top:12px"></div>

<div class="title title_top">����������޹�ħ ����<span><font class="small">����������޹�ħ�� ������ �ۼ��ϰ�, �̿��ڵ��ǻ��׳��� �� ��3������,��޾��� ��Ź ���뿡 ���� ���� �մϴ�.</span></div>

<table width="100%" cellpadding="0" cellspacing="0" bgcolor="#fafafa">
<tr><td style="padding: 15px 15px 15px 15px; text-align: justify">

<div><font color="#EA0095">&#149; ��뿩�ζ�</font><div>
<div style="padding-top:3px" class="small1"> - ȸ�����Խ� �̿��� ���� ���� �̿ܿ�, ��3�ڿ��� �������� ���� �� �����Ź�� ���ο� ���� ������ ������ ���� ���θ� �޴����� �����ϴ� ���Դϴ�.</div>
<div style="padding-top:3px" class="small1"> - ���������� ���� �ϰų� �����Ź�� ���� �ʴ°�� ���������� üũ�� �Ͻø� �˴ϴ�.</div>
<div style="padding-top:3px" class="small1"> - ��ǰ ���, �ο� ��� �� ���� ������ ���� �ݵ�� �ʿ��� ������ ��Ź ������ ��� ���� ���Ǹ� ���� �ʾƵ� �˴ϴ�.</div>

<div style="padding-top:12px"><font color="ea0095">&#149; ����������޹�ħ ���� </font></div>
<div style="padding-top:3px" class="small1"> - '����������޹�ħ �� ������ǥ�� �ۼ����'���� 12���� �ۼ� �ܰ� ������ ����������޹�ħ�� ������ �����ø� �˴ϴ�.</div>
<div style="padding-top:3px" class="small1"> - ������ ������ �ؼ��� �ȵǸ�, �ش� ������ ���� ������ ������ �����մϴ�.</div>

<div style="padding-top:12px"><font color="ea0095">&#149; �������� �̿��� ���ǻ��� ���� </font></div>
<div style="padding-top:3px" class="small1"> - '����������޹�ħ ����'���� ���������� �������̿����,�����ϴ� ���������� �׸�,���������� ���� �� �̿� �Ⱓ�� �Է��� �մϴ�.</div>
<div style="padding-top:3px" class="small1"> - ȸ�����Խÿ� ������, �̿��ڰ� ���Ǹ� ���� �ʴ� ��� ������ ���� �ʽ��ϴ�.</div>
<div style="padding-top:3px" class="small1"> - ���� : 3���� ������ �����̳� ����������޹�ħ ���� ���縦 ���� �ϰ� ���Ǵ� ���ݻ����Դϴ�.</div>

<div style="padding-top:12px"><font color="ea0095">&#149; �������� ��3�� �������� ���� </font></div>
<div style="padding-top:3px" class="small1"> - '����������޹�ħ ����'���� ���������� �����޴� ��,���������� �����޴� ���� �������� �̿����,�����ϴ� ���������� �׸�,���������� �����޴� ���� �������� ���� �� �̿�Ⱓ �� �Է��� �մϴ�.</div>
<div style="padding-top:3px" class="small1"> - ���������� ��3�ڿ��� �����ϰų� �����Ź�� �ϴ� ��쿡�� �� �������� �������̿뿡 ���� ���ǿʹ� ������ �Ʒ� ���׿� ���� �����ϰ� ���Ǹ� �޾ƾ� �մϴ�.</div>
<div style="padding-top:3px" class="small1"> - ȸ�����Խÿ� ������, �̿��ڰ� ���Ǹ� ���� �ʴ� ��쿡�� ������ �Ҽ� �ֽ��ϴ�.</div>

<div style="padding-top:12px"><font color="ea0095">&#149; �������� ��޾��� ��Ź���� ���� </font></div>
<div style="padding-top:3px" class="small1"> - '����������޹�ħ ����'���� �������������Ź�� �޴� ��,�������������Ź�� �ϴ� ������ ���븸 �Է��� �մϴ�.</div>
<div style="padding-top:3px" class="small1"> - ���������� ��3�ڿ��� �����ϰų� �����Ź�� �ϴ� ��쿡�� �� �������� �������̿뿡 ���� ���ǿʹ� ������ �Ʒ� ���׿� ���� �����ϰ� ���Ǹ� �޾ƾ� �մϴ�.</div>
<div style="padding-top:3px" class="small1"> - ȸ�����Խÿ� ������, �̿��ڰ� ���Ǹ� ���� �ʴ� ��쿡�� ������ �Ҽ� �ֽ��ϴ�.</div>

<div style="padding-top:12px"><font color="ea0095">&#149; ��ȸ�� �������� ��޹�ħ ���� </font></div>
<div style="padding-top:3px" class="small1"> - '����������޹�ħ ����'���� ���������� �������̿����,�����ϴ� ���������� �׸�,���������� ���� �� �̿� �Ⱓ�� �Է��� �մϴ�.</div>
<div style="padding-top:3px" class="small1"> - �� ������ &quot;�������� �̿��� ���ǻ��� ����&quot;�� �����ϰ� �ۼ� �Ͻðų� ���� �޸� �ۼ� �ϼŵ� �˴ϴ�.</div>
<div style="padding-top:3px" class="small1"> - ��ȸ�� �ֹ��� �ֹ��� �������� ������, �����ڰ� ���Ǹ� ���� �ʴ� ��� �ֹ��� ���� �ʽ��ϴ�.</div>
<div style="padding-top:3px" class="small1"> - ���� : 3���� ������ �����̳� ����������޹�ħ ���� ���縦 ���� �ϰ� ���Ǵ� ���ݻ����Դϴ�.</div>

</td></tr></table>

<form method="post" action="../design/indb.php" enctype="multipart/form-data" onsubmit="return chkForm(this)">
<input type="hidden" name="mode" value="checkprivacy" />

<table class="tb">
<col class="cellC"><col class="cellL">
<tr>
	<td width="200">����������޹�ħ ����</td>
	<td>
	<img src="../img/i_edit.gif" align="absmiddle" class="hand" onclick="popup_return( 'iframe.codi.php?design_file=service/_private.txt&', 'private', 900, 650, 100, 100, 1 );"/>
	</td>
</tr>
<tr>
	<td width="200">�������� �̿��� ���ǻ��� ����</td>
	<td>
	<img src="../img/i_edit.gif" align="absmiddle" class="hand" onclick="popup_return( 'iframe.codi.php?design_file=service/_private1.txt&', 'private', 900, 650, 100, 100, 1 );"/>
	</td>
</tr>
<tr>
	<td width="200">�������� ��3�� �������� ����</td>
	<td>
	<table cellpadding=0 cellspacing=0 border=0>
	<tr>
		<td align=center><img src="../img/i_edit.gif" align="absmiddle" class="hand" onclick="popup_return( 'iframe.codi.php?design_file=service/_private2.txt&', 'private', 900, 650, 100, 100, 1 );"/></td>
		<td width=40></td>
		<td align=center>��뿩�� : </td>
		<td class=noline align=center>
		<input type=radio name=private2YN value='Y' <?=( $cfg['private2YN'] == 'Y' ? 'checked' : '' )?>>�����</td>
		<td width=10></td>
		<td class=noline align=center>
		<input type=radio name=private2YN value='N' <?=( $cfg['private2YN'] == 'N' ? 'checked' : '' )?>>������</td></tr>
	</table>
	</td>
</tr>
<tr>
	<td width="200">�������� ��޾��� ��Ź���� ����</td>
	<td>
	<table cellpadding=0 cellspacing=0 border=0>
	<tr>
		<td align=center><img src="../img/i_edit.gif" align="absmiddle" class="hand" onclick="popup_return( 'iframe.codi.php?design_file=service/_private3.txt&', 'private', 900, 650, 100, 100, 1 );"/></td>
		<td width=40></td>
		<td align=center>��뿩�� : </td>
		<td class=noline align=center>
		<input type=radio name=private3YN value='Y' <?=( $cfg['private3YN'] == 'Y' ? 'checked' : '' )?>>�����</td>
		<td width=10></td>
		<td class=noline align=center>
		<input type=radio name=private3YN value='N' <?=( $cfg['private3YN'] == 'N' ? 'checked' : '' )?>>������</td></tr>
	</table>
	</td>
</tr>
<tr>
	<td width="200">��ȸ�� �������� ��޹�ħ ����</td>
	<td>
	<img src="../img/i_edit.gif" align="absmiddle" class="hand" onclick="popup_return( 'iframe.codi.php?design_file=service/_private_non.txt&', 'private', 900, 650, 100, 100, 1 );"/>
	</td>
</tr>
</table>

<div style="padding-top:12px"></div>

<div class="title title_top">������ǥ�� ����<span><font class="small">������ǥ�ø� �ۼ��ϰ� �ش� ����(p3p.xml, p3policy.xml)�� ���ε��մϴ�.</span></div>

<table width="100%" cellpadding="0" cellspacing="0" bgcolor="#fafafa">
<tr><td style="padding: 15px 15px 15px 15px; text-align: justify">
<div><font color="#EA0095">&#149; ���ε� ���</font><div>
<div style="padding-top:3px" class="small1">'����������޹�ħ �� ������ǥ�� �ۼ����'���� �ۼ��� �ٿ�ε� ���� 2���� ������ �Ʒ����� ��� �� �����մϴ�.</div>
<div style="padding-top:3px" class="small1">������ ���� <font class="ver8" color="#0074BA"><b>p3p.xml, p3policy.xml</b></font> �Դϴ�. ������ ������� ����ϼ���.</div>
<?=$w3cDirChk?>
</td></tr></table>
<table class="tb">
<col class="cellC"><col class="cellL">
<? for ($i=1;$i<=2;$i++){ ?>
<tr>
	<td>������ǥ�� File #<?=$i?></td>
	<td>
	<input type="file" name="w3c[file_0<?=$i?>]" class="lline">
	<? if($fls[w3c][$i-1]){ ?>
	<span class="noline"><input type="checkbox" name="w3cDel[file_0<?=$i?>]" value="Y" />����</span> <?=$fls[w3c][$i-1]?>
	<input type="hidden" name="w3cOld[file_0<?=$i?>]" value="<?=$fls[w3c][$i-1]?>">
	<? } ?>
	</td>
</tr>
<? } ?>
</table>

<div class="button">
<input type="image" src="../img/btn_save.gif">
<a href="javascript:history.back()"><img src="../img/btn_cancel.gif"></a>
</div>

</form>



<script>
table_design_load();
setHeight_ifrmCodi();
</script>