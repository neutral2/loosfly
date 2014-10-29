<?php

$location = "모바일샵관리 > 모바일샵 메인상품 진열 설정";
include "../_header.php";
include "../../conf/config.mobileShop.php";
include "../../conf/config.mobileShop.main.php";

$query = "
select
	distinct a.mode,a.goodsno,b.goodsnm,b.img_s,c.price
from
	".GD_GOODS_DISPLAY_MOBILE." a,
	".GD_GOODS." b,
	".GD_GOODS_OPTION." c
where
	a.goodsno=b.goodsno
	and a.goodsno=c.goodsno and link and go_is_deleted <> '1'
order by sort
";

$res = $db->query($query);
while ($data=$db->fetch($res)) $loop[$data[mode]][] = $data;

?>

<script src="../../lib/js/categoryBox.js"></script>
<script>

var r_list = new Array('step0','step1');

function open_box(name,isopen)
{
	show_elements("select", eval("obj2_"+name));
	var mode;
	var isopen = (isopen || document.getElementById('obj_'+name).style.display!="block") ? true : false;
	for (i=0;i<r_list.length;i++){
		mode = (r_list[i]==name && isopen) ? "block" : "none";
		document.getElementById('obj_'+r_list[i]).style.display = document.getElementById('obj2_'+r_list[i]).style.display = mode;
	}
	if (document.getElementById('obj_'+name).style.display=="block") hide_elements("select", eval("obj2_"+name));
	else iciRow = null;
}

function list_goods(name)
{
	var category = '';
	open_box(name,true);
	var els = document.forms[0][name+'[]'];
	for (i=0;i<els.length;i++) if (els[i].value) category = els[i].value;
	var ifrm = eval("ifrm_" + name);
	var goodsnm = eval("document.forms[0].search_" + name + ".value");
	ifrm.location.href = "_goodslist.php?name=" + name + "&category=" + category + "&goodsnm=" + goodsnm;
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
		tmp[tmp.length] = "<div style='float:left;width:0;border:1 solid #cccccc;margin:1px;' title='" + obj.rows[i].cells[1].getElementsByTagName('div')[0].innerText + "'>" + obj.rows[i].cells[0].innerHTML + "</div>";
	}
	document.getElementById(name+'X').innerHTML = tmp.join("") + "<div style='clear:both'>";
}

function hide_elements(tagName, menu){
	windowed_element_visibility(tagName, -1, menu)
}

function show_elements(tagName, menu){
	windowed_element_visibility(tagName, +1, menu)
}

function windowed_element_visibility(tagName, change, menu){
	var els = document.getElementsByTagName(tagName);
	var rect = new element_rect(menu)
	for (i=0; i < els.length; i++){
		var el = els.item(i);
		if (elements_overlap(el, rect)){
			if (change==-1){
				if (el.name!='yearS' && el.name!='monthS') el.style.visibility = "hidden";
			} else el.style.visibility = "visible";
		}
	}
}

function element_rect(el){
	var left = 0
	var top = 0
	this.width = el.offsetWidth
	this.height = el.offsetHeight
	while (el){
		left += el.offsetLeft
		top += el.offsetTop
		el = el.offsetParent
	}
	this.left = left;
	this.top = top;
}

function elements_overlap(el, rect){
	var r = new element_rect(el);
	return ((r.left < rect.left + rect.width) && (r.left + r.width > rect.left) && (r.top < rect.top + rect.height) && (r.top + r.height > rect.top))
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
	objTop.moveRow(iciRow.rowIndex,nextPos);
	react_goods(nameObj);
}

function keydnTree()
{
	if (iciRow==null) return;
	switch (event.keyCode){
		case 38: moveTree(-1); break;
		case 40: moveTree(1); break;
	}
	return false;
}

document.onkeydown = keydnTree;

</script>

<form id=form action="indb.php" method=post>
<input type=hidden name=mode value="disp_main">

<?
for ($i=0;$i<2;$i++){
	$checked[tpl][$i][$cfg_mobile_step[$i][tpl]] = "checked";
	$selected[img][$i][$cfg_mobile_step[$i][img]] = "selected";
?>

<div class=title <?if(!$i){?>style="margin-top:0"<?}?>>모바일샵 메인상품진열 <?=$i+1?> <a href="javascript:manual('<?=$guideUrl?>board/view.php?id=mobileshop&no=4')"><img src="../img/btn_q.gif" border=0 align=absmiddle hspace=2></a> <span><a href="javascript:popup2('<?php echo $cfgMobileShop['mobileShopRootDir']?>','320','480','1');"><font color=0074BA>[메인화면보기]</font></a></span></div>

<table class=tb>
<col class=cellC><col class=cellL>
<tr>
	<td>설명</td>
	<td><input type=text name=title[] value="<?=$cfg_mobile_step[$i][title]?>" class=lline></td>
</tr>
<tr>
	<td>사용유무</td>
	<td class=noline>
	<input type=checkbox name=chk[<?=$i?>] <? if ($cfg_mobile_step[$i][chk]){ ?>checked<?}?>> 체크시 모바일샵 메인페이지에 출력이됩니다
	</td>
</tr>
<tr>
	<td>디스플레이유형</td>
	<td>

	<table>
	<col align=center span=2>
	<tr>
		<td><img src="../img/goodalign_style_01.gif"></td>
		<td><img src="../img/goodalign_style_02.gif"></td>
	</tr>
	<tr class=noline>
		<td><input type=radio name=tpl[<?=$i?>] value="tpl_01" checked <?=$checked[tpl][$i][tpl_01]?>></td>
		<td><input type=radio name=tpl[<?=$i?>] value="tpl_02" <?=$checked[tpl][$i][tpl_02]?>></td>
	</tr>
	</table>
	<font class=extext>
		[갤러리형 설명]<br />
		가로화면 : 한 라인에 4개의 상품이 디스플레이 됩니다.<br />
		세로화면 : 한 라인에 6개의 상품이 디스플레이 됩니다.<br />
		(가로화면↔세로화면 전환시 상품 디스플레이 수가 자동변경 됩니다)<br />
	</font>
	</td>
</tr>
<tr>
	<td>메인출력 상품수</td>
	<td><input type=text name=page_num[] value="<?=$cfg_mobile_step[$i][page_num]?>" class="rline"> 개 <font class=extext>메인페이지에 보여지는 총 상품수입니다</td>
</tr>
<tr>
	<td>진열할 상품선정<div style="padding-top:3px"></div>
	<a href="javascript:popup('http://guide.godo.co.kr/guide/php/ex_display.html',850,523)"><font class=extext_l>[상품순서변경 방법]</font></a>
	<div style="padding-top:3px"></div>
	<a href="javascript:popup('http://guide.godo.co.kr/guide/php/ex_display.html',850,523)"><img src="../img/icon_sample.gif" border="0" align=absmiddle hspace=2></a>
	</td>
	<td>

	<div style="padding-top:5px;z-index:-10">
	<script>new categoryBox('step<?=$i?>[]',4,'','');</script>
	<input type=text name=search_step<?=$i?> onkeydown="return go_list_goods('step<?=$i?>')">
	<a href="javascript:list_goods('step<?=$i?>')"><img src="../img/i_search.gif" border=0></a>
	<a href="javascript:view_goods('step<?=$i?>')"><img src="../img/i_openclose.gif" border=0></a>
	</div>
	<div style="position:relative;">
	<div id=obj_step<?=$i?> class=box1><iframe id=ifrm_step<?=$i?> style="width:100%;height:100%" frameborder=0></iframe></div>
	<div id=obj2_step<?=$i?> class="box2 scroll" onselectstart="return false" onmousewheel="return iciScroll(this)">
		<div class=boxTitle>- 메인상품디스플레이 <font class=small1 color=white>(삭제시 더블클릭)</font></div>
		<table id=tb_step<?=$i?> class=tb>
		<col width=50>
		<? if ($loop[$i]){ foreach ($loop[$i] as $v){ ?>
		<tr onclick="spoit('step<?=$i?>',this)" ondblclick=remove('step<?=$i?>',this) class=hand>
			<td width=50 nowrap><a href="../../goods/goods_view.php?goodsno=<?=$v[goodsno]?>" target=_blank><?=goodsimg($v[img_s],40,'',1)?></a></td>
			<td width=100%>
			<div><?=$v[goodsnm]?></div>
			<b><?=number_format($v[price])?></b>
			<input type=hidden name=e_step<?=$i?>[] value="<?=$v[goodsno]?>">
			</td>
		</tr>
		<? }} ?>
		</table>
	</div>
	<div style="padding-top:2px"></div>
	<div id=step<?=$i?>X style="padding-top:3px"></div>
	<script>react_goods('step<?=$i?>');</script>
	</div>

	</td>
</tr>
</table>


<? } ?>


<div class=button>
<input type=image src="../img/btn_save.gif">
<a href="../mobileShop/mobile_goods_list.php"><img src='../img/btn_list.gif'></a>
</div>

</form>

<div id=MSG01>
<table cellpadding=2 cellspacing=0 border=0 class=small_ex>
<!--<tr><td><img src="../img/arrow_blue.gif" align=absmiddle>상품디스플레이 선정방법</td></tr>-->
<tr><td><img src="../img/icon_list.gif" align=absmiddle>분류를 선택하고 검색버튼을 누르세요. 또는 검색어를 입력후 검색버튼을 누르세요.</td></tr>
<tr><td><img src="../img/icon_list.gif" align=absmiddle>검색된 상품을 더블클릭하면 진열되며, 선정된 상품을 더블클릭하면 삭제됩니다.</td></tr>
<tr><td><img src="../img/icon_list.gif" align=absmiddle>상품진열 순서를 변경하시려면 변경할 상품을 선택한 후 키보드의 이동키 Up/Down키로 이동하시면 됩니다.</td></tr>
<tr><td><img src="../img/icon_list.gif" align=absmiddle>펼쳐진 창을 닫고 아래의 저장버튼을 누르셔야 최종 저장됩니다.</td></tr>
<tr><td><img src="../img/icon_list.gif" align=absmiddle>진열할 수 있는 상품의 갯수는 무제한입니다.</td></tr>
<tr><td><img src="../img/icon_list.gif" align=absmiddle>모바일샵에 진열될 상품을 설정하지 않으면, PC용 메인상품진열에 설정된 상품리스트가 출력됩니다.</td></tr>
</table>

</div>
<script>cssRound('MSG01')</script>


<? include "../_footer.php"; ?>