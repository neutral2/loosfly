<?

$scriptLoad='<script src="../design/codi/_codi.js"></script>';
include "../_header.popup.php";

// �Ǹ�Ȯ�� ���� ��� ����
@include_once dirname(__FILE__)."/../../conf/fieldset.php";
if($realname['id'] != '' && $realname['useyn'] = 'y') $use_realname = true;
else $use_realname = false;
if($ipin['id'] != '' && $ipin['useyn'] = 'y') $use_ipin = true;
else $use_ipin = false;
if($ipin['nice_useyn'] == 'y' && $ipin['nice_minoryn'] == 'y') $use_niceipin = true;
else $use_niceipin = false;

//�޴�������Ȯ�� ���� ����� �ÿ��� ������Ʈ�� ��밡���ϰԲ� �߰� 2013-07-26
$hpauthDreamCfg = $config->load('hpauthDream');
if($hpauthDreamCfg['useyn'] =='y' && $hpauthDreamCfg['minoryn'] == 'y') $use_hpauth = true;
else $use_hpauth = false;
if($use_realname || $use_ipin || $use_niceipin || $use_hpauth) $adultro_ready = true;
else $adultro_ready = false;

if ( !$_GET['mode'] ) $_GET['mode'] = "mod_intro";
?>

<script language="javascript"><!--


function fnToggleIntroForm(b) {
	$$('input[name="custom_landingpage"]').each(function(el){
		el.writeAttribute({disabled: !b});
		<? if(!$adultro_ready) { ?>if(el.value == "2") el.writeAttribute({disabled: true});<? } ?>
	});
}

function fnDesignIntroTemplate(t) {

	var url = false;

	switch (t) {
	case 1:			// ���� ��Ʈ��
		url = './iframe.intro.default.php';
		break;
	case 2:			// ����
		url = './iframe.intro.adultonly.php';
		break;
	case 3:			// ȸ��
		url = './iframe.intro.memberonly.php';
		break;
	}

	if (url != false)
	{
		var win = popup_return( url, 'INTRODESIGN', 900, 650, 100, 100, 1 );
		win.focus();
	}
	return;
}

window.onload = function() {
	fnToggleIntroForm(<?=$cfg['introUseYN'] == 'Y' ? 'true' : 'false'?>);

}
--></script>


<form name="fm" method="post" action="../design/indb.php" onsubmit="return chkForm(this)">
<input type="hidden" name="mode" value="<?=$_GET['mode']?>" />
<input type=hidden name=tplSkinWork value="<?=$cfg['tplSkinWork']?>">

<div class="title title_top">��Ʈ��/������ ����<span>��Ʈ�������� �Ǵ� �������������� ����� �� �ֽ��ϴ�</span> <a href="javascript:manual('<?=$guideUrl?>board/view.php?id=design&no=4')"><img src="../img/btn_q.gif" border="0" align="absmiddle"></a></div>

<?=$workSkinStr?>

<table class=tb>
<col class=cellC><col class=cellL>
<tr>
	<td>��뿩��</td>
	<td class="noline" width=80%>
	<input type="radio" name="introUseYN" value="Y" <?=( $cfg['introUseYN'] == 'Y' ? 'checked' : '' )?> required label="��뿩��" onClick="fnToggleIntroForm(true);" /> ���
	<input type="radio" name="introUseYN" value="N" <?=( $cfg['introUseYN'] != 'Y' ? 'checked' : '' )?> required label="��뿩��" onClick="fnToggleIntroForm(false);" /> ������
	</td>
</tr>
</table>

<table border="0" cellpadding="0">
<tr><td height=15 colspan=2></td></tr>
<tr>
	<td><font class=extext>��Ʈ��/�������������� �ּҴ� <font class=ver7 color="#627dce"><b>http://<font class=small1><b>������</b></font>/shop/intro.php</b></font> �Դϴ�</td>
	<td width=10></td>
	<td><a href="/shop/main/intro.php?tplSkin=<?=$cfg['tplSkinWork']?>" target="_blank"><img src="../img/btn_view_intro.gif"></a></td>
</tr>
<tr><td height=1 colspan=5></td></tr>
<tr>
	<td><font class=extext>���θ� ������������ �ּҴ� <font class=ver7 color="#627dce"><b>http://<font class=small1><b>������</b></font>/shop/main/index.php </b></font> �Դϴ�</td>
	<td width=10></td>
	<td><a href="/shop/main/index.php?tplSkin=<?=$cfg['tplSkinWork']?>" target="_blank"><img src="../img/btn_view_mainpage.gif"></a></td>
</tr>
<tr><td height=15 colspan=2></td></tr>
</table>



<table class=tb>
<tr>
	<td class=cellC style="width:60%;height:30px;">��Ʈ�� ������ ��� ����</td>
	<td class=cellC style="width:25%;">���� ������ �湮 ����</td>
	<td class=cellC style="width:15%;">������ ������</td>
</tr>
<tr>
	<td class="noline">
		<label><input type="radio" name="custom_landingpage" value="1" <?=$cfg['custom_landingpage'] == 1 ? 'checked' : ''?> />������ �湮�� ������ ���� �Ϲ����� ��Ʈ�� ������</label>
	</td>
	<td>��ü</td>
	<td><a href="javascript:void(0);" onClick="fnDesignIntroTemplate(1);"><img src="../img/btn_view_intro2.gif"></a></td>
</tr>
<tr>
	<td class="noline">
		<label><input type="radio" name="custom_landingpage" value="2" <?=$cfg['custom_landingpage'] == 2 ? 'checked' : ''?> <?=!$adultro_ready ? 'disabled' : ''?> />���������� ������ ���θ� ���� ������ ��Ʈ�� ������</label><br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(���������� ����Ȯ�� ��������(�� : ������ ��)�� �̿��Ͽ� �ּ���.) <img src="../img/<?=(!$adultro_ready ? 'btn_nouse.gif' : 'btn_on_func.gif') ?>" align="absmiddle">
	</td>
	<td>����</td>
	<td><a href="javascript:void(0);" onClick="fnDesignIntroTemplate(2);"><img src="../img/btn_view_intro2.gif"></a></td>
</tr>
<tr>
	<td class="noline"><label><input type="radio" name="custom_landingpage" value="3" <?=$cfg['custom_landingpage'] == 3 ? 'checked' : ''?> />���������� ������ ȸ���� ���� ������ ��Ʈ�� ������</label></td>
	<td>ȸ��</td>
	<td><a href="javascript:void(0);" onClick="fnDesignIntroTemplate(3);"><img src="../img/btn_view_intro2.gif"></a></td>
</tr>
</table>

<p/>

<!--<div style="margin:10px 0 10px 0;"><font class=extext>������ �������� ������ '<a href="/shop/main/intro.php" target="_blank"><font class=ver7 color="#0074BA"><b><u>http://�����θ�</u></b></font></a>' �� Ŭ���ϼ���.</div>
<div style="margin:10px 0 10px 0;"><font class=extext>������������ ������ '<a href="/shop/main/index.php" target="_blank"><font class=ver7 color="#0074BA"><b><u>http://�����θ�/shop/main/index.php</u></b></font></a>' �� Ŭ���ϼ���.</div>-->




<div style="padding:20px" align="center">
<input type="image" src="../img/btn_register.gif" class="null" />
</div>

</form>


<div id="MSG01">
<table cellpadding="1" cellspacing="0" border="0" class=small_ex>
<tr><td>��Ʈ�� ������ �Ǵ� ������ �������� ������ �� �ֽ��ϴ�.</td></tr>
<tr><td>�����̹��� 5���� �����ص帳�ϴ�. �� �Ķ��ڽ����� �ҽ��� ���� �� �����Ϳ� �־� Ȱ���ϼ���.</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td>�������� ��Ʈ�� �������� ������ ���� 2������ �����˴ϴ�.</td></tr>
<tr><td>�� ���� ������ ������ ���� �Ǵ� ȸ���� ���� ������ ��Ʈ�� ������</td></tr>
<tr><td>&nbsp;- ���� �Ǵ� ȸ���� ������ ������ ����Ʈ�� ���˴ϴ�. ������ ������ �� �ִ� ����Ȯ�� �������񽺸� ��û�ϰ� �̿��Ͽ� �ּ���.</td></tr>
<tr><td>�� ���� ������ ������ ȸ���� ���� ������ ��Ʈ�� ������</td></tr>
<tr><td>&nbsp;- ȸ���� ������ ������ ����Ʈ�� ���Ǹ�, ��ǰ ���Ŵ� ȸ���� �����մϴ�.</td></tr>
</table>
</div>
<script>cssRound('MSG01')</script>



<script>
table_design_load();
setHeight_ifrmCodi();
</script>