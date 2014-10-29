<?
$location = "SNS ���� > SNS �ǽð� ����";
include "../_header.php";
$cfgfile = "../../conf/sns.cfg.php";
if(file_exists($cfgfile)) require $cfgfile;
$postcfgfile = "../../conf/snspost.cfg.php";
if(file_exists($postcfgfile)) require $postcfgfile;

if (!$snsCfg['usePost']) $snsCfg['usePost'] = 'n';
$checked['usePost'][$snsCfg['usePost']] = 'checked="checked"';
?>
<script type="text/javascript" src="../../lib/js/sns.js"></script>
<script type="text/javascript">
<!--
function copy_txt(val){
	window.clipboardData.setData('Text', val);
}

function setBgClr(clr) {
	document.getElementById('bgClr').value = "#" + clr;
	document.getElementById('bgClr_dp').style.backgroundColor = "#" + clr;
}
function setTitleClr(clr) {
	document.getElementById('titleClr').value = "#" + clr;
	document.getElementById('titleClr_dp').style.backgroundColor = "#" + clr;
}
function setTitleBgClr(clr) {
	document.getElementById('titleBgClr').value = "#" + clr;
	document.getElementById('titleBgClr_dp').style.backgroundColor = "#" + clr;
}
function setFontClr(clr) {
	document.getElementById('fontClr').value = "#" + clr;
	document.getElementById('fontClr_dp').style.backgroundColor = "#" + clr;
}
function setFontBgClr(clr) {
	document.getElementById('fontBgClr').value = "#" + clr;
	document.getElementById('fontBgClr_dp').style.backgroundColor = "#" + clr;
}

function preview() {
	fobj = document.frmReg;
	var sns = document.getElementById("sns").value;
	var snsid = document.getElementById("snsid").value;
	if (!sns || !snsid) {
		alert("SNS ���̵� �Է��ϼ���.");
		document.getElementById("snsid").focus();
		return;
	}
	var postCount = fobj.postCount.value;
	if (!postCount) {
		postCount = fobj.postCount.value = 3;
	}
	var boxWidth = fobj.boxWidth.value;
	if (!boxWidth) {
		boxWidth = fobj.boxWidth.value = 100;
	}
	var titleSize = fobj.titleSize.value;
	if (!titleSize) {
		titleSize = fobj.titleSize.value = 18;
	}
	var titleClr = fobj.titleClr.value;
	var titleBgClr = fobj.titleBgClr.value;
	var fontClr = fobj.fontClr.value;
	var fontBgClr = fobj.fontBgClr.value;
	var bgClr = fobj.bgClr.value;

	var pars = $(fobj).serialize();
	new Ajax.Request("post.preview.php", {
			method : 'post',
			parameters: pars,
			onSuccess : function(req) {
				document.getElementById("preview").innerHTML = req.responseText;
				var cfgdata = {
					sno : "preview",
					sns : sns,
					snsid : snsid,
					postCount : postCount,
					isAdmin : true,
					fontClr : fontClr,
					titleSize : titleSize
				}
				SNS.init("preview", cfgdata);
			}
	});
}

function chkForm(fobj) {
	for(var i = 0; i < document.all.length; i++) {
		if (document.all[i].required) {
			if (!document.all[i].value) {
				alert(document.all[i].title + "��(��) �Է��ϼ���.");
				fobj.snsid.focus();
				return false;
			}
		}
	}

	return true;
}

function resetForm() {
	document.frmReg.reset();
	document.getElementById("titleClr_dp").style.backgroundColor = "";
	document.getElementById("titleBgClr_dp").style.backgroundColor = "";
	document.getElementById("fontClr_dp").style.backgroundColor = "";
	document.getElementById("fontBgClr_dp").style.backgroundColor = "";
	document.getElementById("bgClr_dp").style.backgroundColor = "";
	document.getElementById("preview").innerHTML = "";
}

function edit(n) {
	var objTr = document.getElementById("item"+n);
	if (objTr) {
		var fobj = document.frmReg;
		var tds = objTr.getElementsByTagName("TD");
		fobj.sno.value = tds[0].innerHTML;
		for(var i = 0; i < fobj.sns.options.length; i++) {
			if (tds[1].innerHTML == fobj.sns.options[i].value) {
				fobj.sns.options[i].selected = "selected";
				break;
			}
		}
		fobj.snsid.value = tds[2].innerHTML;
		fobj.postCount.value = tds[3].innerHTML;
		fobj.boxWidth.value = tds[4].innerHTML;
		fobj.titleSize.value = tds[5].innerHTML;
		fobj.titleClr.value = tds[6].firstChild.title;
		document.getElementById("titleClr_dp").style.backgroundColor = fobj.titleClr.value;
		fobj.titleBgClr.value = tds[7].firstChild.title;
		document.getElementById("titleBgClr_dp").style.backgroundColor = fobj.titleBgClr.value;
		fobj.fontClr.value = tds[8].firstChild.title;
		document.getElementById("fontClr_dp").style.backgroundColor = fobj.fontClr.value;
		fobj.fontBgClr.value = tds[9].firstChild.title;
		document.getElementById("fontBgClr_dp").style.backgroundColor = fobj.fontBgClr.value;
		fobj.bgClr.value = tds[10].firstChild.title;
		document.getElementById("bgClr_dp").style.backgroundColor = fobj.bgClr.value;

		preview();
	}
}

function del(n) {
	if (confirm("�����Ͻðڽ��ϱ�?")) {
		document.frmList.sno.value = n;
		document.frmList.submit();
	}
}

//-->
</script>
<div style="width:800">
<form name="frm" method="post" action="sns.indb.php" target="ifrmHidden">
<div class="title title_top">SNS �ǽð� ���� <a href="javascript:manual('<?=$guideUrl?>board/view.php?id=event&no=14')"><img src="../img/btn_q.gif" border=0 align=absmiddle></a></div>
<table border="1" bordercolor="#e1e1e1" style="border-collapse:collapse" width="100%">
<col class="cellC"><col class="cellL">
<tr>
	<td height="30">��뼳��</td>
	<td class="noline">
		<label><input type="radio" name="usePost" value="y" <?=$checked['usePost']['y']?> />�����</label>
		<label><input type="radio" name="usePost" value="n" <?=$checked['usePost']['n']?> />������</label>
	</td>
</tr>
</table>
<div class=button>
<input type="image" src="../img/btn_save.gif">
<a href="javascript:history.back()"><img src="../img/btn_cancel.gif"></a>
</div>
</form>

<div class="title title_top">SNS �ǽð� ���� ���� <span>���θ��� �����Ǵ� SNS ���� �� ��Ų �������� �����մϴ�.</span><a href="javascript:manual('<?=$guideUrl?>board/view.php?id=event&no=14')"><img src="../img/btn_q.gif" border=0 align=absmiddle></a></div>
<form name="frmList" action="post.indb.php" method="post" target="ifrmHidden">
<input type="hidden" name="mode" value="del" />
<input type="hidden" name="sno" value="" />
<table width=100% cellpadding=0 cellspacing=0 border=0>
<tr><td class=rnd colspan=13></td></tr>
<tr class=rndbg>
	<th width=60>��ȣ</th>
	<th>SNS</th>
	<th>SNS ID</th>
	<th>�Խù���</th>
	<th>���λ�����</th>
	<th>Ÿ��Ʋ����ũ��</th>
	<th colspan="5">�÷� (Ÿ��Ʋ/Ÿ��Ʋ���/����/������/���)</th>
	<th>ġȯ�ڵ�</th>
	<th>����/����</th>
</tr>
<tr><td class=rnd colspan=14></td></tr>
<tr><td height=4 colspan=14></td></tr>
<? 
	if (is_array($snsPostCfg) && empty($snsPostCfg) === false) {
		foreach($snsPostCfg as $key => $val) {
?>
<tr align="center" id="item<?=$key?>">
	<td><?=$key?></td>
	<td><?=$val['sns']?></td>
	<td><?=$val['snsid']?></td>
	<td><?=$val['postCount']?></td>
	<td><?=$val['boxWidth']?></td>
	<td><?=$val['titleSize']?></td>
	<td><span style="border:solid 1px; background-color:<?=$val['titleClr']?>; width:18px;" title="<?=$val['titleClr']?>"></span></td>
	<td><span style="border:solid 1px; background-color:<?=$val['titleBgClr']?>; width:18px;" title="<?=$val['titleBgClr']?>"></span></td>
	<td><span style="border:solid 1px; background-color:<?=$val['fontClr']?>; width:18px;" title="<?=$val['fontClr']?>"></span></td>
	<td><span style="border:solid 1px; background-color:<?=$val['fontBgClr']?>; width:18px;" title="<?=$val['fontBgClr']?>"></span></td>
	<td><span style="border:solid 1px; background-color:<?=$val['bgClr']?>; width:18px;" title="<?=$val['bgClr']?>"></span></td>
	<td>{=snsPosts(<?=$key?>)} <img class="hand" src="../img/i_copy.gif" onclick="copy_txt('{=snsPosts(<?=$key?>)}')" alt="�����ϱ�" align="absmiddle"/></td>
	<td><a onclick="edit(<?=$key?>)" style="cursor:pointer"><img src="../img/i_edit.gif" /></a> <a onclick="del(<?=$key?>)" style="cursor:pointer"><img src="../img/i_del.gif" /></a></td>
</tr>
<tr><td height=4></td></tr>
<tr><td colspan=14 class=rndline></td></tr>
<tr><td height=4 colspan=13></td></tr>
<? 
		}
	}
?>
</table>
</form>
<div style="padding-top:5px;padding-bottom:5px;" class="small1 extext">
	<div>����Ʈ�� ������ ���� ��Ų�� ���Ͻô� ������ �������ּ���.</div>
</div>

<div style="height:20"></div>
<form name="frmReg" method="post" action="post.indb.php" onsubmit="return chkForm(this)" target="ifrmHidden">
<input type="hidden" name="mode" value='reg' />
<input type="hidden" name="sno" value='' />
<table border="1" bordercolor="#e1e1e1" style="border-collapse:collapse" width="100%">
<col class="cellC"><col class="cellL"><col class="cellC"><col class="cellL">
<tr>
	<td height="50">SNS ���̵�</td>
	<td colspan="3">
		<select name="sns">
			<option value="me2day" <?=$selected['sns']['me2day']?>>��������</option>
		</select>
		<input type="text" name="snsid" value="<?=$data['snsid']?>" required="required" title="SNS ���̵�" />
		<div style="padding-top:10;" class="small1 extext">
			<div>���θ��� �����ϰ��� �ϴ� SNS(��������)���� �� ���̵� �Է��� �ּ���.</div>
		</div>
	</td>
</tr>
<tr>
	<td height="50">�Խù� ��</td>
	<td align="left" colspan="3">
		<input type="text" name="postCount" size="4" required="required" title="�Խù� ��" onkeydown="onlynumber()" />
	</td>
</tr>
<tr>
	<td height="50">���λ�����</td>
	<td align="left">
		<input type="text" name="boxWidth" size="4" required="required" title="���λ�����" onkeydown="onlynumber()" />px
	</td>
	<td height="50">Ÿ��Ʋ����ũ��</td>
	<td align="left">
		<input type="text" name="titleSize" size="4" required="required" title="Ÿ��Ʋ����ũ��" onkeydown="onlynumber()" />px
	</td>
</tr>
<tr>
	<td height="50">Ÿ��Ʋ���ڻ�</td>
	<td><input type="text" id="titleClr" name="titleClr" required="required" title="Ÿ��Ʋ���ڻ�" /> <span id="titleClr_dp" onclick="window.open('../proc/help_colortable.php?callback=setTitleClr', 'colortable', 'width=400, height=400')" style="border:solid 1px #CCCCCC; width:25px; cursor:pointer; background-color:"></span></td>
	<td height="50">Ÿ��Ʋ����</td>
	<td><input type="text" id="titleBgClr" name="titleBgClr" required="required" title="Ÿ��Ʋ����" /> <span id="titleBgClr_dp" onclick="window.open('../proc/help_colortable.php?callback=setTitleBgClr', 'colortable', 'width=400, height=400')" style="border:solid 1px #CCCCCC; width:25px; cursor:pointer; background-color:"></span></td>
</tr>
<tr>
	<td height="50">������ڻ�</td>
	<td><input type="text" id="fontClr" name="fontClr" required="required" title="������ڻ�" /> <span id="fontClr_dp" onclick="window.open('../proc/help_colortable.php?callback=setFontClr', 'colortable', 'width=400, height=400')" style="border:solid 1px #CCCCCC; width:25px; cursor:pointer; background-color:"></span></td>
	<td height="50">�������</td>
	<td><input type="text" id="fontBgClr" name="fontBgClr" required="required" title="�������" /> <span id="fontBgClr_dp" onclick="window.open('../proc/help_colortable.php?callback=setFontBgClr', 'colortable', 'width=400, height=400')" style="border:solid 1px #CCCCCC; width:25px; cursor:pointer; background-color:"></span></td>
</tr>
<tr>
	<td height="50">����</td>
	<td colspan="3"><input type="text" id="bgClr" name="bgClr" required="required" title="����" /> <span id="bgClr_dp" onclick="window.open('../proc/help_colortable.php?callback=setBgClr', 'colortable', 'width=400, height=400')" style="border:solid 1px #CCCCCC; width:25px; cursor:pointer; background-color:"></span></td>
</tr>
<tr>
	<td height="50">�̸����� <a onclick="preview()" style="cursor:pointer;vertical-align:middle"><img src="../img/btn_viewbbs.gif" /></a></td>
	<td align="left" id="preview" colspan="3">
	</td>
</tr>
</table>

<div class=button>
<input type="image" src="../img/btn_save.gif">
<a onclick="resetForm()" style="cursor:pointer"><img src="../img/btn_cancel.gif"></a>
</div>
</form>


<div id=MSG02>
<table cellpadding=1 cellspacing=0 border=0 class=small_ex>
<tr><td>SNS�����ϱ� ���񽺸� ��������� �����Ͻø� ���θ���SNS����Ʈ�� �Խù��� �����Ǿ� ����˴ϴ�.</td></tr>
<tr><td>��뿩�� ���� �� �����ϰ��� �ϴ� SNS����Ʈ ������ �ݵ�� �Է��ؾ� �մϴ�.</td></tr>
<tr><td>*�Խù� �� �� ��Ų�� ������ �κ��� �⺻ ���� ������ ��ϵ˴ϴ�.</td></tr>
<tr><td>����Ʈ�� ������ ��Ų�� ġ���ڵ带 ���ϴ� ������ �����ϸ� ���θ� ���������� Ȯ���� �� �ֽ��ϴ�.</td></tr>
</table>
</div>
<script>cssRound('MSG02')</script>

</div>
<? include "../_footer.php"; ?>