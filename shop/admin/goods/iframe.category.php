<?
include "../_header.popup.php";
@include_once "../../conf/config.mobileShop.php";

$data = $db->fetch("select * from ".GD_CATEGORY." where category='$_GET[category]'",1);
list($cntGoods) = $db->fetch("select count(distinct goodsno) from ".GD_GOODS_LINK." where category like '$data[category]%'");
@include "../../conf/category/$data[category].php";

$checked['tpl'][$lstcfg['tpl']] = "checked";
$checked['rtpl'][$lstcfg['rtpl']] = "checked";
$checked['hidden'][$data['hidden']] = "checked";
$checked['hidden_mobile'][$data['hidden_mobile']] = "checked";
$selected['level'][$data['level']] = "selected";
$checked['level_auth'][$data['level_auth']] = "checked";
if( $data['level'] != '0') $display['level_auth_div'] = "inline-block";
else $display['level_auth_div'] = "none";
for($i=1; $i<5; $i++){
	if($i == $data['level_auth'])  $display['level_auth_txt'][$i] = "block;";
	else $display['level_auth'][$i] = "none;";
}
$level_nm = array();
if($data['auth_step']){
	$tmp_auth_step = explode(':', $data['auth_step']);
	foreach($tmp_auth_step as $val){
		$checked['auth_step'][$val] = "checked";
	}
}
$checked['sort_type'][$data['sort_type']] = 'checked="checked"';
$selected['manual_sort_on_link_goods_position'][$data['manual_sort_on_link_goods_position']] = 'selected="selected"';

### �׷����� ��������
$res = $db->query("select * from gd_member_grp order by level");
while($tmp = $db->fetch($res))$r_grp[] = $tmp;

### ���� �з��̹���
if($data[useimg])$imgName = getCategoryImg($_GET[category]);

$ar_display_type = array(1 => '��������');
$ar_display_type[] = '����Ʈ��';
$ar_display_type[] = '����Ʈ �׷���';
$ar_display_type[] = '';//'��ǰ�̵���';
$ar_display_type[] = '';//'�Ѹ�';
$ar_display_type[] = '';//'��ũ��';
$ar_display_type[] = '';//'��';
$ar_display_type[] = '���ð���';
$ar_display_type[] = '�̹���';
$ar_display_type[] = '��ǳ��';
$ar_display_type[] = '��ٱ���';
?>

<style>
body {margin:0}
#extra-display-form-wrap {}
.display-type-config-tpl {display:none;}
.display-type-wrap {width:94px;float:left;margin:3px;}
.display-type-wrap img {border:none;width:94px;height:72px;}
.display-type-wrap div {text-align:center;}

.display-type-config {width:100%;background:#e6e6e6;border:2px dotted #f54c01;}
.display-type-config  th, .display-type-config  td {font-weight:normal;text-align:left;}
.display-type-config  th {width:100px;background:#f6f6f6;}
.display-type-config  td {background:#ffffff;}

.display-type-level {float:left; text-align:center; padding-right:5px;}
</style>
<script>
function fun_auth(level){
	if( !level.value ){
		document.getElementById("levelnm").innerHTML = '';
		document.getElementById("level_auth_div").style.display = 'none';
		for(i=0; i<document.getElementsByName("level_auth").length; i++){
			document.getElementsByName("level_auth")[i].disabled = true;
		}
		get_auto_txt(0);
	}
	else {
		document.getElementById("levelnm").innerHTML = '"'+level.options[level.selectedIndex].text+'" �̸��� �׷쿡�� ���� ��� ����';
		document.getElementById("level_auth_div").style.display = 'inline-block';
		for(i=0; i<document.getElementsByName("level_auth").length; i++){
			document.getElementsByName("level_auth")[i].disabled = false;
		}
	}
}
function get_auto_txt(val){
	for(var i=1; i<5; i++){
		if(val == i) document.getElementById("auth_txt_"+i).style.display = 'block';
		else  document.getElementById("auth_txt_"+i).style.display = 'none';
	}
}
/*** ���û�ǰ ***/
function open_box(name,isopen)
{
	var mode;
	var isopen = (isopen || document.getElementById('obj_'+name).style.display!="block") ? true : false;
	mode = (isopen) ? "block" : "none";
	document.getElementById('obj_'+name).style.display = document.getElementById('obj2_'+name).style.display = mode;
	if (document.getElementById('obj_'+name).style.display!="block") iciRow = null;
}
function list_goods(name)
{
	var category = '';
	open_box(name,true);
	var els = document.forms[0][name+'[]'];
	for (i=0;i<els.length;i++) if (els[i].value) category = els[i].value;
	var ifrm = document.getElementById('ifrm_' + name);
	var goodsnm = eval("document.forms[0].search_" + name + ".value");
	ifrm.src = "_goodslist.php?name=" + name + "&category=" + category + "&goodsnm=" + goodsnm;
}
function go_list_goods(name){
	if (event.keyCode==13){
		list_goods(name);
		return false;
	}
}
function view_goods(name)
{
	open_box(name,false);
}
function moveEvent(obj, name)
{
	obj.onclick = function(){ spoit(name,this); }
	obj.ondblclick = function(){ remove(name,this); }
}
function remove(name,obj)
{
	var tb = document.getElementById('tb_'+name);
	tb.deleteRow(obj.rowIndex);
	react_goods(name);
}

function react_goods(name)
{
	var tmp = new Array();
	var obj = document.getElementById('tb_'+name);
	for (i=0;i<obj.rows.length;i++){
		tmp[tmp.length] = "<div style='float:left;border:1px solid #cccccc;margin:1px;' title='" + obj.rows[i].cells[1].getElementsByTagName('div')[0].innerHTML + "'>" + obj.rows[i].cells[0].innerHTML + "</div>";
	}
	document.getElementById(name+'X').innerHTML = tmp.join("") + "<div style='clear:both'>";
	parent.document.getElementById('ifrmCategory').style.height = document.body.scrollHeight;
}

var iciRow, preRow, nameObj;
function spoit(name,obj)
{
	nameObj = name;
	iciRow = obj;
	iciHighlight();
}
function iciHighlight()
{
	if (preRow) preRow.style.backgroundColor = "";
	iciRow.style.backgroundColor = "#FFF4E6";
	preRow = iciRow;
}
function moveTree(idx)
{
	if (document.getElementById("obj_"+nameObj).style.display!="block") return;
	var objTop = iciRow.parentNode.parentNode;
	var nextPos = iciRow.rowIndex+idx;
	if (nextPos==objTop.rows.length) nextPos = 0;

	var cln1 = iciRow.cells[0].cloneNode(true);
	var cln2 = iciRow.cells[1].cloneNode(true);
	objTop.deleteRow(iciRow.rowIndex);
	oTr = objTop.insertRow(nextPos);
	oTd = oTr.appendChild(cln1);
	oTd = oTr.appendChild(cln2);
	oTr.className = "hand";
	oTr.onclick = function(){ spoit(nameObj,this); }
	oTr.ondblclick = function(){ remove(nameObj,this); }

	iciRow = oTr;
	iciHighlight();
	react_goods(nameObj);
}
function keydnTree(e)
{
	if (iciRow==null) return;
	e = e ? e : event;
	switch (e.keyCode){
		case 38: moveTree(-1); break;
		case 40: moveTree(1); break;
	}
	return false;
}
document.onkeydown = keydnTree;

	// ���÷��� ���� ����
	function fnSetExtraOption(gid, tid) {	// ���� �׷� ����, ���� Ÿ�� ��ȣ
		if (tid == '��ǰ�̵���' || tid == '�Ѹ�' || tid == '��ũ��' || tid == '��') {
			alert('�ش� ���÷��� ������ ����� �� �����ϴ�.');
			return false;
		}
		var oTpl = $(tid);

		var data = <?=$lstcfg ? gd_json_encode($lstcfg) : '{}'?>;
		data.checked = {};
		data.gid = gid;

		$H(data).each(function(pair){
			if (pair.key.indexOf('dOpt') > -1 && pair.value) {
				eval('data.checked.'+ pair.key +' = ["",""];');
				eval('data.checked.'+ pair.key +'['+eval('pair.value.'+gid)+'] = "checked";');
			}
			else if (pair.key.indexOf('alphaRate') > -1 && pair.value)
			{
				data.alphaRate = eval('pair.value.'+gid);
			}
		});


		if (oTpl != null) {
			var tpl = new Template( oTpl.innerHTML.unescapeHTML() );

			var html = tpl.evaluate(data);
			$('gList_').style.display = 'block';

			$('extra-config-wrap-display-type-'+gid).update( html );
			$('extra-config-display-type-'+gid).style.display = 'block';

		}
		else {
			$('extra-config-wrap-display-type-'+gid).update('');
			$('extra-config-display-type-'+gid).style.display = 'none';
		}
	}

</script>


<!-- ���μ��� �ҽ� -->
	<textarea id="���ð���" class="display-type-config-tpl"><table class="display-type-config">
	<tr>
		<th>ȿ�� ���</th>
		<td class="noline">
		<label><input type="radio" name="lstcfg[dOpt8][#{gid}]" value="1" #{checked.dOpt8[1]}  />������ ��ǰ�� �帮��</label>
		<label><input type="radio" name="lstcfg[dOpt8][#{gid}]" value="2" #{checked.dOpt8[2]}  />������ ������ ��ǰ �帮��</label>
		</td>
	</tr>
	<tr>
		<th>����</th>
		<td>
		<input type="text" name="lstcfg[alphaRate][#{gid}]" value="#{alphaRate}" class="rline"> <font class="extext">0%�� �������� ������ ���ϴ�.</font>
		</td>
	</tr>
	</table></textarea>

	<textarea id="��ǳ��" class="display-type-config-tpl"><table class="display-type-config">
	<tr>
		<th>����</th>
		<td class="noline">
		<label><input type="radio" name="lstcfg[dOpt10][#{gid}]" value="1" #{checked.dOpt10[1]}  />Ÿ��1(Black)</label>
		<label><input type="radio" name="lstcfg[dOpt10][#{gid}]" value="2" #{checked.dOpt10[2]}  />Ÿ��2(white)</label>
		</td>
	</tr>
	<tr>
		<th>����</th>
		<td>
		<input type="text" name="lstcfg[alphaRate][#{gid}]" value="#{alphaRate}" class="rline"> <font class="extext">0%�� �������� ������ ���ϴ�.</font>
		</td>
	</tr>
	</table></textarea>
<!-- ���μ���-->


<form name=form method=post action="indb.php" onsubmit="return chkForm(this)" enctype="multipart/form-data">
<input type=hidden name=mode value="mod_category">
<input type=hidden name=category value="<?=$_GET[category]?>">

<div class="title_sub" style="margin:0">�з������/����/����<span>�з����� �����ϰ� ����, �����մϴ�. <font class=extext>(�Է��� �ݵ�� �Ʒ� ������ư�� ��������)</font></span> <a href="javascript:manual('<?=$guideUrl?>board/view.php?id=product&no=6')"><img src="../img/btn_q.gif" border=0 align=absmiddle hspace=2></a></div>

<table class=tb>
<col class=cellC><col class=cellL>
<tbody style="height:26px">
<tr>
	<td>����з�</td>
	<td>
	<?=($_GET[category])?currPosition($data[category],1):"��ü�з�";?>
	<a href="../../goods/goods_list.php?category=<?=$_GET[category]?>" target=_blank><img src="../img/i_nowview.gif" border=0 align=absmiddle hspace=10></a>
	</td>
</tr>
<tr>
	<td>�� �з��� ��ǰ��</td>
	<td><b><?=number_format($cntGoods)?></b>���� ��ϵǾ� �ֽ��ϴ�. <font class=extext>(�����з����� ����)</font></td>
</tr>
<? if ($_GET[category]){ ?>
<tr>
	<td>����з��� ����</td>
	<td>
	<input type=text name=catnm class=lline required value="<?=$data[catnm]?>" label="����з���" maxlen="100">
	&nbsp; �з��ڵ� : <b><?=$data[category]?></b>
	<div style='font:0;height:5'></div>
	<div class=extext style="font-weight:bold">�з��� ����</div>
	<div class=extext>- �ؽ�Ʈ ��� : �Էµ� �ؽ�Ʈ�� ���� �˴ϴ�.</div>
	<div class=extext>- �̹��� ��� : �Ʒ��� ��ϵ� �̹����� ���� �˴ϴ�.(�ؽ�Ʈ ���̹���)</div>
	</td>
</tr>
<tr>
	<td>�з��̹��� ���</td>
	<td>
	<input type=file name="img[]"> <input type="checkbox" name="chkimg_0" value="1" class="null"> ����
	<?if($imgName[$data['category']][0]){?>
	<div><img src="../../data/category/<?=$imgName[$data['category']][0]?>"></div>
	<?}?>
	</td>
</tr>
<tr>
	<td>���콺�����̹���<br>���</td>
	<td>
	<input type=file name="img[]"> <input type="checkbox" name="chkimg_1" value="1" class="null"> ����
	<?if($imgName[$data['category']][1]){?>
	<div><img src="../../data/category/<?=$imgName[$data['category']][1]?>"></div>
	<?}?>
	</td>
</tr>
<tr>
	<td>�з����߱�</td>
	<td class=noline>
<? if (getCateHideCnt(substr($data[category],0,-3))){ ?>
	<input type=hidden name=hidden value='<?=$data[hidden]?>'> <font class=small1 color=E83700>�����з��� �����̹Ƿ� �ڵ����� <font color=0074BA>(�� �з��� ���̰� �Ϸ��� ����, �����з��� ���̴� ���·� �ٲٰ��� �����ϼ���)</font>
<? } else { ?>
	<input type=radio name=hidden value=1 <?=$checked[hidden][1]?>> ���߱�
	<input type=radio name=hidden value=0 <?=$checked[hidden][0]?>> ���̱�
<? } ?>
	</td>
</tr>
<tr>
	<td>����ϼ����� ���߱�</td>
	<td class=noline>
		<?php if($cfgMobileShop['vtype_category']=='1'){?>
			<? if (getCateHideCnt(substr($data[category],0,-3),'mobile')){ ?>
				<input type=hidden name=hidden_mobile value='<?=$data[hidden_mobile]?>'> <font class=small1 color=E83700>�����з��� �����̹Ƿ� �ڵ����� <font color=0074BA>(�� �з��� ���̰� �Ϸ��� ����, �����з��� ���̴� ���·� �ٲٰ��� �����ϼ���)</font>
			<? } else { ?>
				<input type=radio name=hidden_mobile value=1 <?=$checked[hidden_mobile][1]?>> ���߱�
				<input type=radio name=hidden_mobile value=0 <?=$checked[hidden_mobile][0]?>> ���̱�
			<? } ?>
		<?php }else{?>
			<input type=hidden name=hidden_mobile value="<?php echo $data['hidden'];?>" />
		<font class="red">���� �з����߱�� �����ϰ� ����ǵ��� �����Ǿ��ֽ��ϴ�.</font>
		<?php }?>
	</td>
</tr>
<? } ?>
<?php if ($_GET['category']) { ?>
<tr>
	<td>��ǰ���� Ÿ��</td>
	<td class="noline">
		<div style="border: dashed 2px #ff0000; padding: 5px;">
			�� ��ǰ����Ÿ���� �ڵ������� �⺻���� �����˴ϴ�.<br/>
			��� ������(2013.07.10) �������� ������ ���� ������ �״�� ���� �Ǹ�, ���� ����� ��ǰ�� ī�װ��� ����� �������(�ֱ� ����� ��ǰ�� �� ��) �����Ǿ� ��µ˴ϴ�.
		</div>
		<div>
			<input id="sort-type-auto" type="radio" name="sort_type" value="AUTO" <?php echo $checked['sort_type']['AUTO']; ?>/>
			<label for="sort-type-auto">�ڵ�����</label>
			<span class="extext">���� �ֱٿ� ī�װ��� ��ϵ� ��ǰ������(�ֱ� ��ϵ� ��ǰ�� �Ǿ�) �����Ǿ� ��µ˴ϴ�.</span>
		</div>
		<div>
			<input id="sort-type-manual" type="radio" name="sort_type" value="MANUAL" <?php echo $checked['sort_type']['MANUAL']; ?>/>
			<label for="sort-type-manual">��������</label>
			<span class="extext">
				<a href="adm_goods_sort.php" target="_blank">"�з������� ��ǰ����"</a>���� ���������� ������ ������ �� �ֽ��ϴ�.<br/>
			</span>
			<div style="margin-left: 25px;">
				���� �߰��� ��ǰ
				<select name="manual_sort_on_link_goods_position">
					<option value="LAST" <?php echo $selected['manual_sort_on_link_goods_position']['LAST']; ?>>�� �ڿ� ����</option>
					<option value="FIRST" <?php echo $selected['manual_sort_on_link_goods_position']['FIRST']; ?>>�� �տ� ����</option>
				</select>
			</div>
		</div>
	</td>
</tr>
<?php } ?>
<? if (strlen($_GET[category])<=9){ ?>
<tr>
	<td>�����з� �����</td>
	<td><input type=text name=sub  label="�����з�����" maxlen="30" class="line"> <font class=extext>����з��� �����з��� �����մϴ�</font></td>
</tr>
<? } ?>
<?if($_GET[category]){?>
<tr>
	<td>����/���ű���</td>
	<td>
	<select name="level" onchange="fun_auth(this)">
		<option value="">���Ѿ���</option>
		<?
		foreach($r_grp as $k => $v){
			$level_nm[$v[level]] = $v[grpnm];
		?>
		<option value="<?=$v[level]?>" <?=$selected['level'][$v['level']]?>><?=$v[grpnm]?> - lv[<?=$v[level]?>]</option>
		<?
		}
		?>
	</select> �̻��� �׷쿡�Ը� ����/���Ÿ� ����մϴ�.
	<div id="levelnm" style="margin-top:15px;">
	<? if($data['level']) echo '"'.$level_nm[$data['level']].'" �̸��� �׷쿡�� ���� ��� ����';
	?>
	</div>
	<div id="level_auth_div" style="display:<?= $display['level_auth_div']?>; padding:2px,0,0,0;">
		<div class="display-type-level">
			<div><img src="../img/auth_01.gif" style="border:0"></div>
			<input type="radio" name="level_auth" value="1" style="border:0" onclick="get_auto_txt(this.value)" <?= $checked['level_auth'][1]?>>
		</div>
		<div class="display-type-level">
			<img src="../img/auth_arrow.gif">
		</div>
		<div class="display-type-level">
			<div><img src="../img/auth_02.gif" style="border:0"></div>
			<input type="radio" name="level_auth" value="2" style="border:0" onclick="get_auto_txt(this.value)" <?= $checked['level_auth'][2]?>>
		</div>
		<div class="display-type-level">
			<img src="../img/auth_arrow.gif">
		</div>
		<div class="display-type-level">
			<div><img src="../img/auth_03.gif" style="border:0"></div>
			<input type="radio" name="level_auth" value="3" style="border:0" onclick="get_auto_txt(this.value)" <?= $checked['level_auth'][3]?>>
		</div>
		<div class="display-type-level">
			<img src="../img/auth_arrow.gif">
		</div>
		<div class="display-type-level">
			<div><img src="../img/auth_04.gif" style="border:0"></div>
			<input type="radio" name="level_auth" value="4" style="border:0" onclick="get_auto_txt(this.value)" <?= $checked['level_auth'][4]?>>
		</div>
	</div>
	<div id="auth_txt_1" class="extext" style="margin-top:10px; display:<?= $display['level_auth'][1]?>;">
	ī�װ�>�������� ���� ��� ������� �ʽ��ϴ�<div style="padding:2px;"></div>
	<b>���� ī�װ��� ���� ��� ������� �ʽ��ϴ�.</b><br/>���� ī�װ��� ����/���� ���Ѽ����� �� ī�װ��� ��� �׷캸�� ���� �����Ͽ���<br/>ī�װ����� ��� ������� �ʽ��ϴ�. ���� �����Ͽ� �����Ͽ� �ּ���.
	</div>
	<div id="auth_txt_2" class="extext" style="margin-top:10px; display:<?= $display['level_auth'][2]?>;">
	ī�װ��� ���� ����Ǹ� ��ǰ����Ʈ ������ ������ ���� �ʽ��ϴ�.
	</div>
	<div id="auth_txt_3" class="extext" style="margin-top:10px; display:<?= $display['level_auth'][3]?>;">
	��ǰ����Ʈ ���� ����Ǹ� ��ǰŬ���� �������� ������ ���� �ʽ��ϴ�.<div style="padding:2px;"></div>
	��ǰ���Ⱚ ����
	<label><input type="checkbox" name="auth_step[]" value="1" style="border:0" disabled checked="checked" onclick="return(false)" <?= $checked['auth_step'][1]?>/> ��ǰ�̹���</label>
	<label><input type="checkbox" name="auth_step[]" value="2" style="border:0" <?= $checked['auth_step'][2]?>/> ��ǰ��</label>
	<label><input type="checkbox" name="auth_step[]" value="3" style="border:0" <?= $checked['auth_step'][3]?>/> ����</label><br/>
	��ǰ�̹���, ��ǰ��, ������ ������ ������ �� �������� ���� ��ǰ������ ������ �� �����ϴ�.
	</div>
	<div id="auth_txt_4" class="extext" style="margin-top:10px; display:<?= $display['level_auth'][4]?>;">
	�������� ���� ����Ǹ�, ����/��ٱ���/��ǰ�������� �̿������ �����ϴ�.<br/>
	<b>�������� ��ǰ��� ����ǥ�ô� ��ǰ����Ʈ ��ǰ ���Ⱚ ������ ���� �����ϰ� ����˴ϴ�.</b>
	</div>
	</td>
</tr>
<tr>
	<td>�з�����</td>
	<td><a href="javascript:if (document.form.category.value) parent.popupLayer('popup.delCategory.php?category='+document.form.category.value);else alert('��ü�з��� ��������� �ƴմϴ�');"><img src="../img/i_del.gif" border=0 align=absmiddle></a> <font class=extext>�з������� �����з��� �Բ� �����˴ϴ�. ������ �����ϼ���.</font></td>
</tr>
<? } ?>
<?
	if($_GET['category']) {
		$ssResult = $db->query("SELECT * FROM ".GD_GOODS_SMART_SEARCH." order by if(basic='y',0,1),themenm");
?>
<script language="JavaScript">
	function goSmartSearch() {
		if(!$('themeno').value) {
			alert("SMART�˻� �׸��� ������ �ּ���.");
			$('themeno').focus();
			return false;
		}
		else top.location.href='../goods/smart_search_register.php?mode=setTheme&no=' + $('themeno').value;
	}
</script>
<tr>
	<td>SMART�˻� ����</td>
	<td>
		�׸�����
		<select name="themeno" id="themeno"<?=($cfg['smartSearch_useyn'] == 'n') ? " disabled='true'" : ""?>>
			<option value="">������</option>
	<? if($cfg['smartSearch_useyn'] == 'y') while($ssData = $db->fetch($ssResult)) { ?>
			<option value="<?=$ssData['sno']?>"<?=(($ssData['sno'] == $data['themeno']) || ($data['themeno'] == "0" && $ssData['basic'] == 'y')) ? " selected" : ""?>><?=htmlspecialchars($ssData['themenm']).(($ssData['basic'] == 'y') ? "(�⺻�׸�)" : "")?></option>
	<? } ?>
		</select>
		<a href="javascript:;" onclick="goSmartSearch()" target="_top"><img src="../img/btn_theme_modify.gif" align="absmiddle" title="�׸�����/����" /></a>
		<a href="../goods/smart_search_register.php" target="_top"><img src="../img/btn_theme_add.gif" align="absmiddle" title="�׸��߰�/���" /></a><br />
		<span class="extext">���õ� �׸��� SMART�˻� �޴��� �����˴ϴ�.</span>
	</td>
</tr>
<?
	}
?>
</table>

<? if ($_GET[category]){ ?>
<div class="title_sub">�з������� ��ܺκ� �ٹ̱�<span>�з��������� ��õ��ǰ�� �����ϰ� HTML�� �̿��Ͽ� �ٹ̱��մϴ�</span> <a href="javascript:manual('<?=$guideUrl?>board/view.php?id=product&no=6')"><img src="../img/btn_q.gif" border=0 align=absmiddle hspace=2></a></div>
<table class=tb>
<col class=cellC><col class=cellL>
<tr id="gList_">
	<td>�� �з���<br>��õ��ǰ ����<div style="padding-top:3px"></div>
	<a href="javascript:popup('http://guide.godo.co.kr/guide/php/ex_display.html',850,523)"><img src="../img/icon_sample.gif" border="0" align=absmiddle hspace=2></a></td>
	<td style="padding:5px">

	<?
	$query = "
	select
		a.mode,a.goodsno,b.goodsnm,b.img_s,c.price
	from
		".GD_GOODS_DISPLAY." a,
		".GD_GOODS." b,
		".GD_GOODS_OPTION." c
	where
		a.goodsno=b.goodsno
		and a.goodsno=c.goodsno and link and go_is_deleted <> '1'
		and a.mode = '$_GET[category]'
	";
	$res = $db->query($query);
	?>

	<div id=divRefer style="position:relative;z-index:99">
	<div style="padding-bottom:3px">
	<script>new categoryBox('refer[]',4,'','');</script>
	<input type=text name=search_refer onkeydown="return go_list_goods('refer')">
	<a href="javascript:list_goods('refer')"><img src="../img/i_search.gif" align=absmiddle></a>
	<a href="javascript:view_goods('refer')"><img src="../img/i_openclose.gif" align=absmiddle></a>
	</div>
	<div id=obj_refer class=box1><iframe id=ifrm_refer style="width:100%;height:100%" frameborder=0></iframe></div>
	<div id=obj2_refer class="box2 scroll" onmousewheel="return iciScroll(this)">
		<div class=boxTitle>- ��ϵ� ���û�ǰ <font class=small color=#F2F2F2>(�����Ϸ��� ����Ŭ��)</font></div>
		<table id=tb_refer class=tb>
		<col width=50>
		<? while ($v=$db->fetch($res)){ ?>
		<tr onclick="spoit('refer',this)" ondblclick=remove('refer',this) class=hand>
			<td width=50 nowrap><a href="../../goods/goods_view.php?goodsno=<?=$v[goodsno]?>" target=_blank><?=goodsimg($v[img_s],40,'',1)?></a></td>
			<td width=100%>
			<div><?=$v[goodsnm]?></div>
			<b><?=number_format($v[price])?></b>
			<input type=hidden name=e_refer[] value="<?=$v[goodsno]?>">
			</td>
		</tr>
		<? } ?>
		</table>
	</div>
	<div id=referX style="font-size:0"></div>
	</div>
	<script>react_goods('refer');</script>

	</td>
</tr>
<tr>
	<td>���÷�������</td>
	<td>

	<? for ($t=1,$m=sizeof($ar_display_type);$t<=$m;$t++) { ?>
	<? if ($ar_display_type[$t] == '') continue; ?>
	<div class="display-type-wrap">
		<img src="../img/goodalign_style_<?=sprintf('%02d',$t)?>.gif"  alt="<?=$ar_display_type[$t]?>">
		<div class="noline">
		<input type=radio name=lstcfg[rtpl] value="tpl_<?=sprintf('%02d',$t)?>" <?=$checked[rtpl]['tpl_'.sprintf('%02d',$t)]?>  onclick="fnSetExtraOption('rtpl','<?=$ar_display_type[$t]?>')">
		</div>
	</div>
	<? } ?>
	</td>
</tr>
<tr id="extra-config-display-type-rtpl" style="display:none;">
	<td>���� ����</td>
	<td id="extra-config-wrap-display-type-rtpl"></td>
</tr>
<tr>
	<td>��õ��ǰ ��¼�</td>
	<td><input type=text name=lstcfg[rpage_num] value="<?=$lstcfg[rpage_num]?>" class="rline"> �� <font class=extext>������ ��õ��ǰ������ ��������</td>
</tr>
<tr>
	<td>���δ� ��ǰ��</td>
	<td><input type=text name=lstcfg[rcols] value="<?=$lstcfg[rcols]?>" class="rline"> �� <font class=extext>���ٿ� ������ ��ǰ������ �������� (5�� ���� ����)</td>
</tr>
<tr>
	<td>��ܲٹ̱�<br><font class=extext>(HTML ��ư�� ������ �ҽ������� �����մϴ�)</font></td>
	<td height=300 style="padding:5px">
	<textarea name=lstcfg[body] style="width:100%;height:300px" type=editor><?=stripslashes($lstcfg[body])?></textarea>
	<script src="../../lib/meditor/mini_editor.js"></script>
	<script>mini_editor("../../lib/meditor/");</script>
	</td>
</tr>
</table>
<? $t = (int)(array_pop(explode('_',$lstcfg[rtpl]))); ?>
<script language="JavaScript">fnSetExtraOption('rtpl','<?=$ar_display_type[$t]?>')</script>


<div class="title_sub">�з������� ����Ʈ�κ� �ٹ̱�<span>��ǰ�з������� �ϴ��� ����Ʈ�κ��� �ٹӴϴ�</span> <a href="javascript:manual('<?=$guideUrl?>board/view.php?id=product&no=6')"><img src="../img/btn_q.gif" border=0 align=absmiddle hspace=2></a></div>

<table class=tb>
<col class=cellC><col class=cellL>
<tr>
	<td>���÷�������</td>
	<td>

	<? for ($t=1,$m=sizeof($ar_display_type);$t<=$m;$t++) { ?>
	<? if ($ar_display_type[$t] == '') continue; ?>
	<div class="display-type-wrap">
		<img src="../img/goodalign_style_<?=sprintf('%02d',$t)?>.gif"  alt="<?=$ar_display_type[$t]?>">
		<div class="noline">
		<input type=radio name=lstcfg[tpl] value="tpl_<?=sprintf('%02d',$t)?>" <?=$checked[tpl]['tpl_'.sprintf('%02d',$t)]?>  onclick="fnSetExtraOption('tpl','<?=$ar_display_type[$t]?>')">
		</div>
	</div>
	<? } ?>

	</td>
</tr>
<tr id="extra-config-display-type-tpl" style="display:none;">
	<td>���� ����</td>
	<td id="extra-config-wrap-display-type-tpl"></td>
</tr>
<tr>
	<td>�������� ��ǰ��¼�</td>
	<td><input type=text name=lstcfg[page_num] value="<?=@implode(",",$lstcfg[page_num])?>" option="regPNum" msgO="�������� ��ǰ��¼��� 20,40,60,80 �� ���� �Է����ֽʽÿ�" class="rline"> �� <font class=extext>��) 20,40,60,80 (ù��°���ڴ� �⺻��¼�, �������ں��ʹ� ��¼�������) <a href="javascript:manual('<?=$guideUrl?>board/view.php?id=product&no=6')"><img src="../img/icon_sample.gif" border=0 align=absmiddle hspace=2></a></td>
</tr>
<tr>
	<td>���δ� ��ǰ��</td>
	<td><input type=text name=lstcfg[cols] value="<?=$lstcfg[cols]?>" class="rline"> �� <font class=extext>���ٿ� ������ ��ǰ������ �������� (5�� ���� ����)</td>
</tr>
<tr>
	<td height=28 colspan=2 class=extext style="padding-bottom:2">��ǰ���� ���������� ������ <a href="/shop/admin/goods/sort.php" target=_blank><font class=extext_l>[�з������� ��ǰ����]</font></a> ���� �ս��� ���������մϴ�.
</tr>
<tr>
	<td>�����з� ��������</td>
	<td><?if($_GET[category]){?><input type="checkbox" name="chkdesign" value="1" class="null">�����з����� ������ ������ ������� �����ϰ� �����մϴ�.<?}?>
	<div style="padding-top:3px" class=extext>���� '�з������� ��ܺκ� �ٹ̱�� '�з������� ����Ʈ�κ� �ٹ̱�'���� ������ ������ �����з����� �����ϰ� �����Ű�� ����Դϴ�</div></td>
</tr>
</table>
<? $t = (int)(array_pop(explode('_',$lstcfg[tpl]))); ?>
<script language="JavaScript">fnSetExtraOption('tpl','<?=$ar_display_type[$t]?>')</script>

<? } ?>

<div class="button"><input type=image src="../img/btn_modify.gif"></div>

</form>

<div id=MSG01>
<table class="small_ex">
<tr><td>
<img src="../img/icon_list.gif" align=absmiddle>��ǰ�з�Ž���⿡�� 1���з������ (�ֻ����з�)�� ������ 1���з��� ������ �� �ֽ��ϴ�.<br>
<img src="../img/icon_list.gif" align=absmiddle>�з���������ܿ��� �̺�Ʈ�� ��ʸ� ��ġ�Ͽ� ����ȭ�� �� �ְ� �������غ�����.<br>
<img src="../img/icon_list.gif" align=absmiddle>�з����������� �ش�з��� ������ Ű������ �����̵�Ű���� �����ϰ� ������ ���� �����մϴ�.
</table>
</div>

<script>cssRound('MSG01')</script>

<script>
table_design_load();
window.onload = function(){
	parent.document.getElementById('ifrmCategory').style.height = document.body.scrollHeight;
}
<? if ($_GET[focus]=="sub"){ ?>
document.form.sub.focus();
<? } ?>
</script>