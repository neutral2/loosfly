<?
/*********************************************************
* 파일명     :  disp_main_form.php
* 프로그램명 :	메인진열 폼
* 작성자     :  dn
* 생성일     :  2012.04.26
**********************************************************/

@include('../_header.popup.php');
@include('../../lib/json.class.php');

$mdesign_no = $_GET['mdesign_no'];
$content_no = $_GET['content_no'];

$design_query = $db->_query_print('SELECT * FROM '.GD_MOBILE_DESIGN.' WHERE mdesign_no=[i]', $mdesign_no);
$res_design = $db->_select($design_query);
$design_data = $res_design[0];

$json = new Services_JSON(16);
$goodsDisplay = Core::loader('Mobile2GoodsDisplay');
$mobileGoodsDisplay = $goodsDisplay->isMobileDisplay();

$arr_tpl_type = array(1 => '갤러리형');
$arr_tpl_type[] = '리스트형';
$arr_tpl_type[] = '상품스크롤형';
$arr_tpl_type[] = '이미지스크롤형';
$arr_tpl_type[] = '탭';
$arr_tpl_type[] = '매거진';
$arr_tpl_type[] = '배너롤링형';

$checked['chk'][$design_data['chk']] = 'checked';
$checked['tpl'][$design_data['tpl']] = 'checked';
$checked['display_type'][$design_data['display_type']] = 'checked';

$loop = Array();

switch($design_data['tpl']) {
	case 'tpl_05' :
		$tab_data = $json->decode($design_data['tpl_opt']);

		$display_query = $db->_query_print('SELECT md.goodsno, md.tab_no, g.img_s, g.img_mobile, g.goodsnm, go.price FROM '.GD_MOBILE_DISPLAY.' md LEFT JOIN '.GD_GOODS.' g ON md.goodsno=g.goodsno LEFT JOIN '.GD_GOODS_OPTION.' go ON g.goodsno=go.goodsno and go_is_deleted <> \'1\' WHERE md.mdesign_no=[i] AND go.link=1 ORDER BY md.sort ASC', $mdesign_no);

		$res_display = $db->_select($display_query);

		foreach($res_display as $row_display) {
			$loop[$row_display['tab_no']][] = $row_display;
		}
		break;
	case 'tpl_07' :
		$banner_data = $json->decode($design_data['tpl_opt']);

		$display_query = $db->_query_print('SELECT * FROM '.GD_MOBILE_DISPLAY.' WHERE mdesign_no=[i] ORDER BY sort ASC', $mdesign_no);
		$res_display = $db->_select($display_query);

		foreach($res_display as $row_display) {
			$loop[$row_display['banner_no']] = $row_display['temp1'];
		}
		break;
	default :
		if($design_data['display_type'] == '1') {
			$display_query = $db->_query_print('SELECT md.goodsno, g.img_s, g.img_mobile, g.goodsnm, go.price FROM '.GD_MOBILE_DISPLAY.' md LEFT JOIN '.GD_GOODS.' g ON md.goodsno=g.goodsno LEFT JOIN '.GD_GOODS_OPTION.' go ON g.goodsno=go.goodsno and go_is_deleted <> \'1\' WHERE md.mdesign_no=[i] AND go.link=1 ORDER BY md.sort ASC', $mdesign_no);
			$res_display = $db->_select($display_query);

			$loop = $res_display;
		}
		else {
			$display_query = $db->_query_print('SELECT category, temp2 FROM '.GD_MOBILE_DISPLAY.' WHERE mdesign_no=[i] ORDER BY sort ASC', $mdesign_no);
			$res_display = $db->_select($display_query);

			if($design_data['display_type'] == '2') {

				$loop['categoods'] = $res_display;
			}
			else if($design_data['display_type'] == '3') {
				$loop['catelist'] = $res_display;
			}
		}
		break;
}

?>
<style>
.display-type-wrap {width:94px;float:left;margin:3px;}
.display-type-wrap img {border:none;width:94px;height:72px;}
.display-type-wrap div {text-align:center;}

xmp.extra-display-form-tplsrc {margin:0;font-size:11px;}
</style>

<script type="text/javascript">
<?php if ($mobileGoodsDisplay) { ?>
var autoDisplayGuideElement = window.parent.window.document.getElementById("auto-display-guide");
if (autoDisplayGuideElement) autoDisplayGuideElement.style.display = "none";
<?php } ?>
function open_box(name,isopen) {
	var mode;
	var isopen = (isopen || document.getElementById('obj_'+name).style.display!="block") ? true : false;
	mode = (isopen) ? "block" : "none";
	document.getElementById('obj_'+name).style.display = document.getElementById('obj2_'+name).style.display = mode;

	setFrameHeight();
}
function list_goods(name) {
	var category = '';
	open_box(name,true);
	var els = document.forms[0][name+'[]'];
	for (i=0;i<els.length;i++) if (els[i].value) category = els[i].value;
	var ifrm = eval("ifrm_" + name);
	var goodsnm = eval("document.forms[0].search_" + name + ".value");
	ifrm.location.href = "../goods/_goodslist.php?name=" + name + "&category=" + category + "&goodsnm=" + goodsnm;
}
function go_list_goods(name) {
	if (event.keyCode==13){
		list_goods(name);
		return false;
	}
}
function view_goods(name) {
	open_box(name,false);
}
function moveEvent(obj, name) {
	obj.onclick = function(){ spoit(name,this); }
	obj.ondblclick = function(){ remove(name,this); }
}
function remove(name,obj) {
	var tb = document.getElementById('tb_'+name);
	tb.deleteRow(obj.rowIndex);
	react_goods(name);
}

function react_goods(name) {
	var tmp = new Array();
	var obj = document.getElementById('tb_'+name);

	for (i=0;i<obj.rows.length;i++){
		tmp[tmp.length] = "<div style='float:left;width:0;border:1 solid #cccccc;margin:1px;' title='" + obj.rows[i].cells[1].getElementsByTagName('div')[0].innerText + "'>" + obj.rows[i].cells[0].innerHTML + "</div>";
	}
	document.getElementById(name+'X').innerHTML = tmp.join("") + "<div style='clear:both'>";
}

var iciRow, preRow, nameObj;
function spoit(name,obj) {
	nameObj = name;
	iciRow = obj;
	iciHighlight();
}

function iciHighlight() {
	if (preRow) preRow.style.backgroundColor = "";
	iciRow.style.backgroundColor = "#FFF4E6";
	preRow = iciRow;
}

function addCate(name) {
	var cate = document.getElementsByName("step_"+name+"[]");
	var cate_nm = "";
	var cate_val = "";

	for(var i =0; i< cate.length; i++) {


		if(cate[i].value != "") {
			cate_val = cate[i].value;

			if(i == 0) {
				cate_nm = cate[i].options[cate[i].selectedIndex].text;
			}
			else {
				cate_nm += " > " + cate[i].options[cate[i].selectedIndex].text;
			}
		}
	}

	if(cate_val == "") {
		alert("카테고리를 선택해 주세요.");
		cate[0].focus();
		return;
	}

	var cate_hidden = document.getElementsByName(name+'[]');

	for(var j=0; j< cate_hidden.length; j++) {

		if(cate_hidden[j].value == cate_val) {
			alert("이미 추가된 카테고리 입니다.");
			return;
		}
	}

	var id = document.getElementById('tb_'+name);
    var len = id.rows.length;
    var newRow = id.insertRow(len);
	newRow.id = 'tr_'+name+len;

    var td0 = newRow.insertCell(0);
	td0.colSpan="2";
	td0.style.fontWeight="normal";

	var html_str = '<div>' + cate_nm + ' <input type="hidden" name="'+name+'[]" value="'+cate_val+'" />';
	html_str += '&nbsp;&nbsp;&nbsp;<a href="javascript:delCate(\''+name+'\', \''+ newRow.id +'\');"><img src="../img/i_del.gif" align=absmiddle /></a></div>';

	if(name == 'catelist') {
		html_str += '<div><input type="file" name="cate_img[]" class="rline" size="50" /></div>';
	}

	td0.innerHTML = html_str;
	setFrameHeight();
}

function delCate(name, tr_id) {

	var id = document.getElementById('tb_' + name);
	var tr = document.getElementById(tr_id);
	if(name=='catelist') {

		var ele = tr.getElementsByTagName('INPUT');
		if(ele.length == 4) {
			if(ele[3].value) {
				var mode = "del_upload_img";
				var key;
				var ajax = new Ajax.Request('./indb.php', {
					method: "post",
					parameters: 'mode='+mode+'&img_name='+ele[3].value,
					asynchronous: false,
					onComplete: function(response) { if (response.status == 200) {

					}}
				});
			}
		}
	}

    id.deleteRow(tr.rowIndex);
}

function setTplType(tpl_no) {

	$('line-cnt').style.display = 'none';
	$('disp-cnt').style.display = 'none';
	$('banner-width').style.display = 'none';
	$('banner-height').style.display = 'none';
	$('display-type').style.display = 'none';
	$('tab-config').style.display = 'none';
	$('banner-config').style.display = 'none';
	$('banner-desc').style.display = 'none';
	$('magazine-desc').style.display = 'none';

	setDisabled($('line-cnt'), true);
	setDisabled($('disp-cnt'), true);
	setDisabled($('banner-width'), true);
	setDisabled($('banner-height'), true);
	setDisabled($('display-type'), true);
	setDisabled($('tab-config'), true);
	setDisabled($('banner-config'), true);

	switch (tpl_no) {
		case 'tpl_05' :
			$('line-cnt').style.display = '';
			$('disp-cnt').style.display = '';
			$('tab-config').style.display = '';
			setDisabled($('line-cnt'), false);
			setDisabled($('disp-cnt'), false);
			setDisabled($('tab-config'), false);
			changeTabNum($('tab_num').value);
			break;
		case 'tpl_06' :
			$('display-type').style.display = '';
			$('banner-height').style.display = '';
			$('magazine-desc').style.display = '';
			setDisabled($('display-type'), false);
			setDisabled($('banner-height'), false);
			break;
		case 'tpl_07' :
			$('banner-width').style.display = '';
			$('banner-height').style.display = '';
			$('banner-config').style.display = '';
			$('banner-desc').style.display = '';
			setDisabled($('banner-width'), false);
			setDisabled($('banner-height'), false);
			setDisabled($('banner-config'), false);
			changeBannerNum($('banner_num').value);
			break;
		default :
			$('line-cnt').style.display = '';
			$('disp-cnt').style.display = '';
			$('display-type').style.display = '';
			setDisabled($('line-cnt'), false);
			setDisabled($('disp-cnt'), false);
			setDisabled($('display-type'), false);
			break;
	}

	setFrameHeight();
}

function setDisabled(obj, bool_disabled) {
	var inputs = obj.getElementsByTagName('input');

	for(var i=0; i<inputs.length; i++) {
		inputs[i].disabled = bool_disabled;
	}

	var selects = obj.getElementsByTagName('select');

	for(var i=0; i<selects.length; i++) {
		selects[i].disabled = bool_disabled;
	}

}

function setDisplayType(disp_no) {
	$('display-type-goodslist').style.display = 'none';
	$('display-type-categoodslist').style.display = 'none';
	$('display-type-catelist').style.display = 'none';

	setDisabled($('display-type-goodslist'), true);
	setDisabled($('display-type-categoodslist'), true);
	setDisabled($('display-type-catelist'), true);

	switch (disp_no) {
		case '1' :
			$('display-type-goodslist').style.display = '';
			setDisabled($('display-type-goodslist'), false);
			break;
		case '2' :
			$('display-type-categoodslist').style.display = '';
			setDisabled($('display-type-categoodslist'), false);
			break;
		case '3' :
			$('display-type-catelist').style.display = '';
			setDisabled($('display-type-catelist'), false);
			break;
	}

	setFrameHeight();

}

function changeTabNum(num) {
	var tbl = $('tab-config-tbl');

	for(var i=0; i<4; i++) {
		var tab_num = i + 1;

		$('tab-name'+tab_num).style.display = 'none';
		$('tab-goods'+tab_num).style.display = 'none';

		setDisabled($('tab-name'+tab_num), true);
		setDisabled($('tab-goods'+tab_num), true);
	}

	for(i=0; i<num; i++) {
		var tab_num = i + 1;

		$('tab-name'+tab_num).style.display = '';
		$('tab-goods'+tab_num).style.display = '';

		setDisabled($('tab-name'+tab_num), false);
		setDisabled($('tab-goods'+tab_num), false);
	}

	setFrameHeight();
}

function changeBannerNum(num) {
	var tbl = $('banner-config-tbl');

	for(var i=0; i<5; i++) {
		var banner_num = i + 1;

		$('banner-img'+banner_num).style.display = 'none';
		$('banner-link'+banner_num).style.display = 'none';

		setDisabled($('banner-img'+banner_num), true);
		setDisabled($('banner-link'+banner_num), true);
	}

	for(i=0; i<num; i++) {
		var banner_num = i + 1;

		$('banner-img'+banner_num).style.display = '';
		$('banner-link'+banner_num).style.display = '';

		setDisabled($('banner-img'+banner_num), false);
		setDisabled($('banner-link'+banner_num), false);
	}

	setFrameHeight();
}

function setInitialConfig() {

	var arr_tpl = document.getElementsByName('tpl');

	var tpl_no = '';
	for (var i=0; i<arr_tpl.length; i++) {
		if(arr_tpl[i].checked == true) {
			tpl_no = arr_tpl[i].value;
		}
	}

	if(tpl_no) {
		setTplType(tpl_no);
	}

	if(tpl_no != 'tpl_05' && tpl_no != 'tpl_07') {

		var arr_display_type = document.getElementsByName('display_type');

		var display_type_no = '';
		for (var i=0; i<arr_display_type.length; i++) {
			if(arr_display_type[i].checked == true) {
				display_type_no = arr_display_type[i].value;
			}
		}

		setDisplayType(display_type_no);
	}
	else if(tpl_no == 'tpl_05') {
		changeTabNum($('tab_num').value);
	}
	else if(tpl_no == 'tpl_07') {
		changeBannerNum($('banner_num').value);
	}

	setFrameHeight();
}

function setFrameHeight() {
	parent.document.getElementById('ifrm_form<?=$mdesign_no?>').style.height = document.body.scrollHeight;
}

function delDesignForm(idx) {

	if (confirm('추가상품진열 폼을 삭제 하시겠습니까?'))
	{
		var mode = 'design_delete';

		var ajax = new Ajax.Request('./indb.php', {
			method: "post",
			parameters: 'mode='+mode+'&mdesign_no='+idx,
			asynchronous: false,
			onComplete: function(response) { if (response.status == 200) {
				var json = response.responseText.evalJSON(true);

				if(json.result == 'OK') {
					parent.location.reload();
				}
				else {
					alert('상품 진열 폼을 삭제 중 오류가 발생 하였습니다. 다시 시도해주세요.');
					return;
				}
			}}
		});
	}
}

function modDesignForm() {

	var elem = document.getElementById("form");
	if(chkForm(elem)) {
		elem.submit();
	}
}

function copyDisplaySrc(obj_id) {
	if (!document.all){
			alert('코드복사는 인터넷 익스플로러에서만 지원되는 기능입니다.');
			return false;
	}
	window.clipboardData.setData('Text', $(obj_id).innerText );
	alert( '코드를 복사하였습니다. \n원하는 곳에 붙여넣기(Ctrl+V)를 하시면 됩니다~' );
}
document.observe('dom:loaded', function() {
	table_design_load();
	setInitialConfig();
});

function modTimeout()
{
	var formElement = document.getElementById("form");
	if (!chkForm(formElement)) {
		return false;
	}
	setTimeout(function() { modDesignForm() }, 500);
	return true;
}

function imgLoadErr(obj) {
	obj.src = "/shop/admin/img/img_blank.jpg";
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

<form id="form" name="frmMainDisp" action="indb.php" method="post" enctype="multipart/form-data">
<input type="hidden" name="mode" value="disp_main">
<input type="hidden" name="mdesign_no" value="<?=$mdesign_no?>">
<input type="hidden" name="content_no" value="<?=$content_no?>">

<div class="title_sub"><?if($content_no){ echo '상품진열'.$content_no; } else { echo '추가상품진열'; } ?> <a href="javascript:modDesignForm();"><img src="../img/i_edit.gif" align="absmiddle" /></a> <a href="javascript:manual('<?=$guideUrl?>board/view.php?id=mobileshopV2&no=4')"><img src="../img/btn_q.gif"  align="absmiddle" /></a></div>
<table class="tb">
<col class="cellC"><col class="cellL">
<tr>
	<td>설명<?php if ($mobileGoodsDisplay) { ?> <img src="<?php echo $cfg['rootDir']; ?>/admin/img/icons/bullet_compulsory.gif" style="vertical-align: middle;"/><?php } ?></td>
	<td>
		<input type="text" name="title" value="<?=$design_data['title']?>" class="lline"<?php if ($mobileGoodsDisplay) { ?> fld_esssential msgR="[설명] 은 필수 입력사항 입니다."<?php } ?> />
	</td>
</tr>
<tr>
	<td>
		사용유무
		<? if(!$content_no){ ?>
		<a href="javascript:delDesignForm('<?=$mdesign_no?>');"><img src="../img/i_del.gif" align="absmiddle"></a>
		<? } ?>
	</td>
	<td class="noline">
		<label><input type="checkbox" name="chk" <?=$checked['chk']['on']?> /> 체크시 메인페이지에 출력이됩니다</label>
	</td>
</tr>
<? if(!$content_no) { ?>
<tr>
	<td>
		템플릿 소스코드<a href="javascript:copyDisplaySrc('display_src');"><img src="../img/btn_codecopy.gif" align="absmiddle"></a>
	</td>
	<td>
		<div id="display_src">&lt;script type="text/javascript"&gt;displayGoods('<?=$mdesign_no?>', 'main');&lt;/script&gt;</div>
	</td>
</tr>
<? } ?>
<tr>
	<td>디스플레이유형<?php if ($mobileGoodsDisplay) { ?> <img src="<?php echo $cfg['rootDir']; ?>/admin/img/icons/bullet_compulsory.gif" style="vertical-align: middle;"/><?php } ?></td>
	<td>
	<? for ($i=3;$i<count($arr_tpl_type)+1;$i++) { ?>
	<div class="display-type-wrap">
		<img src="../img/m_goodalign_style_<?=sprintf('%02d',$i)?>.jpg"  alt="<?=$arr_tpl_type[$i]?>" />
		<div class="noline">
			<input type="radio" name="tpl" value="tpl_<?=sprintf('%02d',$i)?>" <?=$checked['tpl']['tpl_'.sprintf('%02d',$i)]?> onClick="javascript:setTplType(this.value); "<?php if ($mobileGoodsDisplay) { ?> fld_esssential msgR="[디스플레이유형] 선택은 필수 입니다."<?php } ?> />
		</div>
	</div>
	<? } ?>
	</td>
</tr>
<tr id="line-cnt" style="display:none;">
	<td>출력 라인수</td>
	<td><input type="text" name="line_cnt" value="<?=$design_data['line_cnt']?>" class="rline" disabled /> 개 <font class="extext">메인페이지에 보여지는 라인수입니다</td>
</tr>
<tr id="disp-cnt" style="display:none;">
	<td>라인당 상품수</td>
	<td><input type="text" name="disp_cnt" value="<?=$design_data['disp_cnt']?>" class="rline" disabled /> 개 <font class="extext">한줄에 보여지는 상품수입니다</td>
</tr>
<tr id="banner-width" style="display:none;">
	<td>이미지 가로크기</td>
	<td><input type="text" name="banner_width" value="<?=$design_data['banner_width']?>" class="rline" disabled /> px <font class="extext">배너이미지의 가로크기를 설정합니다</td>
</tr>
<tr id="banner-height" style="display:none;">
	<td>이미지 세로크기</td>
	<td><input type="text" name="banner_height" value="<?=$design_data['banner_height']?>" class="rline" disabled /> px
	<span id="banner-desc" style="display:none"><font class="extext">배너이미지의 세로크기를 설정합니다</span>
	<span id="magazine-desc" style="display:none"><font class="extext" style="font-size:12px"><br>매거진형에서는 상품의 상세이미지를 이용하여 화면에 노출합니다.<br>가로는 스마트기기의 화면크기에 맞춥니다.<br>가로세로 비율대로 맞춘 후, 이미지의 세로크기가 지정된 세로크기를 벗어나는 영역은 감춤 처리됩니다.<br>  세로크기를 0으로 지정하는 경우, 세로크기에 제한을 두지 않습니다.</span>
	</td>
</tr>
<tr id="display-type" style="display:none;">
	<td>진열 방식 선택</td>
	<td class="noline"><label><input type="radio" name="display_type" value="1" <?=$checked['display_type']['1'] ?> onClick="javascript:setDisplayType(this.value);" disabled />상품진열</label>
		<label><input type="radio" name="display_type" value="2" <?=$checked['display_type']['2'] ?> onClick="javascript:setDisplayType(this.value);" disabled />카테고리 내 상품진열</label>
		<label><input type="radio" name="display_type" value="3" <?=$checked['display_type']['3'] ?> onClick="javascript:setDisplayType(this.value);" disabled />카테고리로 이동</label>
		<div id="display-type-goodslist" style="display:none;">
			<table class="tb">
			<col class="cellC"><col class="cellL">
			<tr>
				<td>상품진열<br />
					<a href="javascript:popup('http://guide.godo.co.kr/guide/php/ex_display.html',850,523)"><font class="extext_l">[상품순서변경 방법]</font></a>
				</td>
				<td>
					<div style="padding-top:5px;z-index:-10">
						<script>new categoryBox('step[]',4,'','disabled');</script>
						<input type=text name="search_step" onkeydown="return go_list_goods('step');">
						<a href="javascript:list_goods('step')"><img src="../img/i_search.gif" align="absmiddle" /></a>
						<a href="javascript:view_goods('step')"><img src="../img/i_openclose.gif" align="absmiddle" /></a>
					</div>
					<div style="position:relative;z-index:1000;">
						<div id="obj_step" class="box1">
							<iframe id="ifrm_step" style="width:100%;height:100%" frameborder="0"></iframe>
						</div>
						<div id="obj2_step" class="box2 scroll" onselectstart="return false;" onmousewheel="return iciScroll(this);">
						<div class="boxTitle">- 메인상품디스플레이 <font class="small1" style="color:#FFFFFF;">(삭제시 더블클릭)</font></div>
						<table id="tb_step" class="tb">
						<col width="50">
						<? if ($loop){ foreach ($loop as $v){ ?>
						<tr onclick="spoit('step',this);" ondblclick="remove('step',this);" class="hand">
							<td width="50" nowrap><a href="../../goods/goods_view.php?goodsno=<?=$v['goodsno']?>" target="_blank"><?=goodsimg($v['img_s'],40,'',1)?></a></td>
							<td width="100%">
							<div><?=$v['goodsnm']?></div>
							<b><?=number_format($v['price'])?></b>
							<input type="hidden" name="e_step[]" value="<?=$v['goodsno']?>" />
							</td>
						</tr>
						<? }} ?>
						</table>
						</div>
					</div>
					<div style="padding-top:2px;z-index:1;"></div>
					<div id="stepX" style="padding-top:3px"></div>
					<script type="text/javascript">react_goods('step');</script>
				</td>
			</tr>
			</table>
		</div>
		<div id="display-type-categoodslist" style="display:none;">
			<table class="tb" id="tb_categoods">
			<col class="cellC" /><col class="cellL" />
			<tr>
				<td>카테고리 내 상품진열</td>
				<td>
					<script>new categoryBox('step_categoods[]',4,'','disabled');</script>
					<a href="javascript:addCate('categoods');"><img src="../img/i_add.gif" align="absmiddle" /></a>
				</td>
			</tr>
			<?
			$i = 0;
			if(!empty($loop['categoods']) && is_array($loop['categoods'])){
				foreach($loop['categoods'] as $v) {
			?>
				<tr id="tr_categoods<?=$i?>">
					<td colspan="2" style="font-weight:normal;">
					<? if(strip_tags(currPosition($v['category']))) { ?>
						<?=strip_tags(currPosition($v['category']))?>
					<? } else { ?>
						삭제된 카테고리<span><font class=extext>(삭제버튼을 눌러 삭제하시기 바랍니다.)</font></span>
					<? } ?>
					<input type="hidden" name="categoods[]" value="<?=$v['category']?>" />&nbsp;&nbsp;&nbsp;
					<a href="javascript:delCate('categoods', 'tr_categoods<?=$i?>');"><img src="../img/i_del.gif" align=absmiddle /></a>
					</td>
				</tr>
			<?
				$i ++;
				}
			}
			?>
			</table>
		</div>
		<div id="display-type-catelist" style="display:none;">
			<table class="tb" id="tb_catelist">
			<col class="cellC" /><col class="cellL" />
			<tr>
				<td>카테고리로 이동</td>
				<td>
					<script>new categoryBox('step_catelist[]',4,'','disabled');</script>
					<a href="javascript:addCate('catelist');"><img src="../img/i_add.gif" align="absmiddle" /></a>
				</td>
			</tr>
			<?
			$i = 1;
			if(!empty($loop['catelist']) && is_array($loop['catelist'])){
				foreach($loop['catelist'] as $v) {
			?>
				<tr id="tr_catelist<?=$i?>">
					<td colspan="2" style="font-weight:normal;">
					<? if(strip_tags(currPosition($v['category']))) { ?>
						<?=strip_tags(currPosition($v['category']))?>
					<? } else { ?>
						삭제된 카테고리<span><font class=extext>(삭제버튼을 눌러 삭제하시기 바랍니다.)</font></span>
					<? } ?>
					<input type="hidden" name="catelist[]" value="<?=$v['category']?>" />&nbsp;&nbsp;&nbsp;
					<a href="javascript:delCate('catelist', 'tr_catelist<?=$i?>');"><img src="../img/i_del.gif" align=absmiddle /></a>
					<? if(strip_tags(currPosition($v['category']))) { ?>
					<div>
						<input type="file" name="cate_img[]" size="50" />
						<a href="javascript:webftpinfo( '<?=( $v['temp2'] != '' ? '/data/m/upload_img/'.$v['temp2'] : '' )?>' );"><img src="../img/codi/icon_imgview.gif" border="0" alt="이미지 보기" align="absmiddle"></a>
						<? if ( $v['temp2'] != '' ){ ?>&nbsp;&nbsp;<span class="noline"><input type="checkbox" name="del_cate_img[<?=$i?>]" value="Y">이미지 삭제</span><? } ?>
						<input type="hidden" name="cate_img_hidden[<?=$i?>]" value="<?=$v['temp2']?>" />
					</div>

					<? } ?>
					</td>
				</tr>
			<?
				$i ++;
				}

			}
			?>
			</table>
		</div>
	</td>
</tr>
<tr id="tab-config" style="display:none;">
	<td>탭설정</td>
	<td>
		<div>
			<table id="tab-config-tbl" class="tb">
			<col class="cellC" /><col class="cellL" />
			<tr>
				<th>탭 개수</th>
				<td class="noline">
				<select name="tab_num" id="tab_num" onChange="javascript:changeTabNum(this.value);" disabled >
					<? for($i = 1; $i < 5; $i++) { ?>
					<option value="<?=$i?>" <?if($tab_data['tab_num'] == $i){?> selected <?}?>><?=$i?></option>
					<? } ?>
				</select> 개
				<font class="extext">탭의 개수 입니다.</font>
				</td>
			</tr>
			<? for($i = 1; $i < 5; $i++) {?>
			<tr id="tab-name<?=$i?>" <? if($i != 1) { ?>style="display:none;" <? } ?>>
				<th><?=$i?>번탭 이름</th>
				<td>
					<input type="text" name="tab_name[]" value="<?=$tab_data['tab_name'][$i]?>" class="rline" disabled />
				</td>
			</tr>
			<tr id="tab-goods<?=$i?>" <? if($i != 1) { ?>style="display:none;" <? } ?>>
				<th><?=$i?>번탭 상품진열</th>
				<td>
					<div style="z-index:-10">
						<script>new categoryBox('tab_step<?=$i?>[]',4,'','disabled');</script>
						<input type=text name="search_tab_step<?=$i?>" onkeydown="return go_list_goods('tab_step<?=$i?>');">
						<a href="javascript:list_goods('tab_step<?=$i?>')"><img src="../img/i_search.gif" align="absmiddle" /></a>
						<a href="javascript:view_goods('tab_step<?=$i?>')"><img src="../img/i_openclose.gif" align="absmiddle" /></a>
					</div>
					<div style="position:relative;z-index:1000;">
						<div id="obj_tab_step<?=$i?>" class="box1">
							<iframe id="ifrm_tab_step<?=$i?>" style="width:100%;height:100%" frameborder="0"></iframe>
						</div>
						<div id="obj2_tab_step<?=$i?>" class="box2 scroll" onselectstart="return false;" onmousewheel="return iciScroll(this);" >

							<div class="boxTitle">- 메인상품디스플레이 <font class="small1" style="color:#FFFFFF;">(삭제시 더블클릭)</font></div>
							<table id="tb_tab_step<?=$i?>" class="tb">
							<col width="50">
							<? if ($loop[$i]){ foreach ($loop[$i] as $v){ ?>
							<tr onclick="spoit('tab_step<?=$i?>',this);" ondblclick="remove('tab_step<?=$i?>',this);" class="hand">
								<td width="50" nowrap><a href="../../goods/goods_view.php?goodsno=<?=$v['goodsno']?>" target="_blank"><?=goodsimg($v['img_s'],40,'',1)?></a></td>
								<td width="100%">
								<div><?=$v['goodsnm']?></div>
								<b><?=number_format($v['price'])?></b>
								<input type="hidden" name="e_tab_step<?=$i?>[]" value="<?=$v['goodsno']?>" />
								</td>
							</tr>
							<? }} ?>
							</table>
						</div>
						<div style="z-index:1;"></div>
						<div id="tab_step<?=$i?>X" style="padding-top:3px"></div>
						<script type="text/javascript">react_goods('tab_step<?=$i?>');</script>
					</div>
				</td>
			</tr>
			<? } ?>
			</table>
		</div>
	</td>
</tr>
<tr id="banner-config" style="display:none;">
	<td>배너설정</td>
	<td>
		<div>
			<table id="banner-config-tbl" class="tb">
			<col class="cellC" /><col class="cellL" />
			<tr>
				<th>배너 개수</th>
				<td class="noline">
				<select name="banner_num" id="banner_num" onChange="javascript:changeBannerNum(this.value);" disabled >
					<? for($i = 1; $i < 6; $i++) { ?>
					<option value="<?=$i?>" <?if($banner_data['banner_num'] == $i){?> selected <?}?> ><?=$i?></option>
					<? } ?>
				</select> 개
				<font class="extext">배너의 개수 입니다.  <div style="float:left;font-size:12px;">배너이미지가 없으면, 이벤트폴린형 상품진열이 노출되지 않습니다.</div></font>
				</td>
			</tr>
			<? for($i = 1; $i < 6; $i++) {?>
			<tr id="banner-img<?=$i?>" <? if($i != 1) { ?>style="display:none;" <? } ?>>
				<th><?=$i?>번배너 이미지</th>
				<td>
					<input type="file" name="banner_img[]" size="50" /> <img src="<?='../../data/m/upload_img/'.$banner_data['banner_img'][$i]?>" width=30px height=30px onerror="imgLoadErr(this)"/>
					<a href="javascript:webftpinfo( '<?=( $banner_data['banner_img'][$i] != '' ? '/data/m/upload_img/'.$banner_data['banner_img'][$i] : '' )?>' );"><img src="../img/codi/icon_imgview.gif" border="0" alt="이미지 보기" align="absmiddle"></a>
					<? if ( $banner_data['banner_img'][$i] != '' ){ ?>&nbsp;&nbsp;<span class="noline"><input type="checkbox" name="del_banner_img[<?=$i?>]" value="Y">삭제</span><? } ?>
					<input type="hidden" name="banner_img_hidden[<?=$i?>]" value="<?=$banner_data['banner_img'][$i]?>" />
				</td>
			</tr>
			<tr id="banner-link<?=$i?>" <? if($i != 1) { ?>style="display:none;" <? } ?>>
				<th><?=$i?>번배너 링크 URL</th>
				<td>
					<input type="text" name="banner_link[<?=$i?>]" value="<?=$loop[$i]?>" class="line" style="width:400px;" disabled />
					<font class="extext">링크URL의 앞에 프로토콜(http://)지시자는 제거해야 합니다.</font>
				</td>
			</tr>
			<? } ?>
			</table>
		</div>
	</td>
</tr>
</table>
</form>
