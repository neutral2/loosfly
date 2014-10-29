<?

$location = "상품관리 > 메인페이지 상품진열";
include "../_header.php";
include "../../conf/design.main.php";
@include "../../conf/design_main.".$cfg['tplSkinWork'].".php";

$query = "
select
	distinct a.mode,a.goodsno,b.goodsnm,b.img_s,c.price
from
	".GD_GOODS_DISPLAY." a,
	".GD_GOODS." b,
	".GD_GOODS_OPTION." c
where
	a.goodsno=b.goodsno
	and a.goodsno=c.goodsno and link and go_is_deleted <> '1' and go_is_display = '1'
	".$strSQLWhere."
order by sort
";
$res = $db->query($query);
while ($data=$db->fetch($res)) $loop[$data[mode]][] = $data;

$ar_display_type = array(1 => '갤러리형');
$ar_display_type[] = '리스트형';
$ar_display_type[] = '리스트 그룹형';
$ar_display_type[] = '상품이동형';
$ar_display_type[] = '롤링';
$ar_display_type[] = '스크롤';
$ar_display_type[] = '탭';
$ar_display_type[] = '선택강조';
$ar_display_type[] = '이미지';
$ar_display_type[] = '말풍선';
$ar_display_type[] = '장바구니';

// 기본 설정값 지정
foreach ($cfg_step as $k => $v) {
	if (empty($cfg_step[$k]['alphaRate'])) $cfg_step[$k]['alphaRate'] = 70;
foreach($ar_display_type as $_k => $_v) {
	if (empty($cfg_step[$k]['dOpt'.$_k])) $cfg_step[$k]['dOpt'.$_k] = 1;
}}
?>
<script src="../../lib/js/categoryBox.js"></script>
<script>

	var r_list = new Array('step0','step1','step2','step3','step4');

<?
	$cfg_step_keys = array_keys($cfg_step);
	for ($i=5,$max=sizeof($cfg_step_keys);$i<$max;$i++) {
		echo "r_list.push('step".$cfg_step_keys[$i]."');\n";
	}
?>

	function open_box(name,isopen)
	{
		show_elements("select", eval("obj2_"+name));
		var mode, el;
		var isopen = (isopen || document.getElementById('obj_'+name).style.display!="block") ? true : false;
		for (i=0;i<r_list.length;i++){
			mode = (r_list[i]==name && isopen) ? "block" : "none";
			el = document.getElementById('obj_'+r_list[i]);
			if (el)
			{
				el.style.display = document.getElementById('obj2_'+r_list[i]).style.display = mode;
			}
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
			tmp[tmp.length] = "<div style='z-index:100;float:left;width:40px;border:1 solid #cccccc;margin:1px;' title='" + obj.rows[i].cells[1].getElementsByTagName('div')[0].innerText + "'>" + obj.rows[i].cells[0].innerHTML + "</div>";
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


	// 진열 타입 추가/삭제 관련
	var setted_idx = [];


	function fnGenerateFormKey() {

		var key = Math.floor(new Date().getTime() / 1000);	// timestamp

        for (k in setted_idx) {
            if (setted_idx[k] === key) {
				return fnGenerateFormKey();
            }
        }

		setted_idx.push(key);

		return key;
	}

	function fnAddDisplayForm() {

		var tpl = new Template( $('extra-display-form-src').innerHTML.unescapeHTML() );

		var idx = fnGenerateFormKey();	// 중복되지 않는 폼 키를 구함(=timestamp 에 근거)

		var data = {
			i : idx
		};

		$('extra-display-form-wrap').insert({ bottom: tpl.evaluate(data) });

		r_list.push('step'+idx);

		table_design_load();

		return false;
	}

	function fnDelDisplayForm(idx) {

		if (confirm('상품 진열 폼을 삭제 하시겠습니까?'))
		{
			$('extra-display-form-' + idx).remove();
		}
	}

	function fnCopyDisplayFormSrc(idx) {

		if (!document.all){
			alert('코드복사는 인터넷 익스플로러에서만 지원되는 기능입니다.');
			return false;
		}
		window.clipboardData.setData('Text', $('extra-display-form-tplsrc-'+idx).innerText );
		alert( '코드를 복사하였습니다. \n원하는 곳에 붙여넣기(Ctrl+V)를 하시면 됩니다~' );

	}

	// 디스플레이 유형 관련

	var cfg_step_data = <?=$cfg_step ? gd_json_encode($cfg_step) : '{}'?>;
	var _default = {};

	function fnSetExtraOption(gid, tid) {	// 진열 그룹 순번, 진열 타입 번호
		var oTpl = $(tid);

		var data = cfg_step_data[gid] || {};
		data.i = gid;

		data.checked = {};
		$H(data).each(function(pair){
			if (pair.key.indexOf('dOpt') > -1 && pair.value) {
				eval('data.checked.'+ pair.key +' = ["",""];');
				eval('data.checked.'+ pair.key +'['+pair.value+'] = "checked";');
			}
		});

		if (oTpl != null) {
			var tpl = new Template( oTpl.innerHTML.unescapeHTML() );

			if (tid == '탭') {

				data.tab = fnInitTab(gid, data);
				var html = tpl.evaluate(data);

				$('gList_' + gid).style.display = 'none';

			}
			else {

				var html = tpl.evaluate(data);
				$('gList_' + gid).style.display = '';

			}

			$('extra-config-wrap-display-type-' + gid).update( html );
			$('extra-config-display-type-' + gid).style.display = '';

			if (tid == '탭') {
				$('tabNum_'+gid).selectedIndex = parseInt(data.tabNum) - 1;
				var m = $('tabNum_'+gid).getValue();
				var tb;

				for (tb=1;tb<=m ;tb++ )
				{
					// 상품 가져오기
					fnGetTabsGoods(gid, tb);
					react_goods('step'+gid+'_'+tb);
				}
			}
		}
		else {
			$('extra-config-wrap-display-type-' + gid).update('');
			$('extra-config-display-type-' + gid).style.display = 'none';
		}
	}

	function fnChangeTab(gid, obj) {
		cfg_step_data[gid] = cfg_step_data[gid] || {};
		cfg_step_data[gid].tabNum = obj.value;
		fnSetExtraOption(gid, '탭');
	}

	function fnInitTab(gid, data, obj) {

		var tpl = new Template( $('탭쓰').innerHTML.unescapeHTML() );

		if (obj != undefined) {
			var m = obj.value;
			data = cfg_step_data[gid] || {};
			data.i = gid;
		}
		else
			var m = data.tabNum || 1;

		var tab = '';

		for (var tb=1;tb<=m ;tb++)
		{
			data.tb = tb;
			data.tabName = eval('data.tabName'+tb);
			tab += tpl.evaluate(data);

			var exist = false;

			for (key in r_list) {
				if (r_list[key] == 'step'+gid+'_'+tb) exist = true;
			}

			if (exist == false) r_list.push('step'+gid+'_'+tb);

		}

		return tab;
	}



	function fnGetTabsGoods(gid, tb) {

		var html = '\
		<tr onclick="spoit(\'step#{gid}_#{tb}\',this)" ondblclick=remove(\'step#{gid}_#{tb}\',this) class=hand>\
			<td width=50 nowrap><a href="../../goods/goods_view.php?goodsno=#{goodsno}" target=_blank>#{goodsimg}</a></td>\
			<td width=100%>\
			<div>#{goodsnm}</div>\
			<b>#{price}</b>\
			<input type=hidden name=e_step#{gid}_#{tb}[] value="#{goodsno}">\
			</td>\
		</tr>\
		';

		var mode = tb+'_'+gid;

		var ajax = new Ajax.Request('./disp_main_get_goods.php', {
			method: "post",
			parameters: 'mode='+mode,
			asynchronous: false,
			onComplete: function(response) { if (response.status == 200) {

				var json = response.responseText.evalJSON(true);

				var tpl = new Template(html);

				var i, row;
				var json_len = json.length;

				var _html = '';

				for (i=0;i < json_len ;i++ )
				{
					row = json[i];
					row.gid = gid;
					row.tb = tb;
					_html += tpl.evaluate(row);
				}

				$('tb_step'+gid+'_'+tb).insert(_html);
			}}
		});
	}

</script>

<style>
#extra-display-form-wrap {}
.display-type-config-tpl {display:none;}
.display-type-wrap {width:94px;float:left;margin:3px;}
.display-type-wrap img {border:none;width:94px;height:72px;}
.display-type-wrap div {text-align:center;}

.display-type-config {width:100%;background:#e6e6e6;border:2px dotted #f54c01;}
.display-type-config  th, .display-type-config  td {font-weight:normal;text-align:left;}
.display-type-config  th {width:100px;background:#f6f6f6;}
.display-type-config  td {background:#ffffff;}
xmp.extra-display-form-tplsrc {margin:0;font-size:11px;}
</style>

<!-- 세부설정 소스 -->
	<textarea id="상품이동형" class="display-type-config-tpl"><table class="display-type-config">
	<tr>
		<th>이동 방향</th>
		<td class="noline">
		<label><input type="radio" name="dOpt4[#{i}]" value="1" #{checked.dOpt4[1]}  />오른쪽에서 왼쪽으로</label>
		<label><input type="radio" name="dOpt4[#{i}]" value="2" #{checked.dOpt4[2]}  />왼쪽에서 오른쪽으로 </label>
		</td>
	</tr>
	</table></textarea>

	<textarea id="롤링" class="display-type-config-tpl"><table class="display-type-config">
	<tr>
		<th>이동 방향</th>
		<td class="noline">
		<label><input type="radio" name="dOpt5[#{i}]" value="1" #{checked.dOpt5[1]}  />위에서 아래로</label>
		<label><input type="radio" name="dOpt5[#{i}]" value="2" #{checked.dOpt5[2]}  />아래에서 위로</label>
		</td>
	</tr>
	</table></textarea>

	<textarea id="스크롤" class="display-type-config-tpl"><table class="display-type-config">
	<tr>
		<th>이동 방향</th>
		<td class="noline">
		<label><input type="radio" name="dOpt6[#{i}]" value="1" #{checked.dOpt6[1]}  />가로형</label>
		<label><input type="radio" name="dOpt6[#{i}]" value="2" #{checked.dOpt6[2]}  />세로형</label>
		</td>
	</tr>
	</table></textarea>

	<textarea id="탭" class="display-type-config-tpl"><table class="display-type-config">
	<tr>
		<th>탭 개수</th>
		<td class="noline">
		<select name="tabNum[#{i}]" id="tabNum_#{i}" onchange="fnChangeTab('#{i}',this);">
		<? for($j = 1; $j <= 7; $j++) { ?>
		<option value="<?=$j?>"><?=$j?></option>
		<? } ?>
		</select> 개
		<font class="extext">탭의 개수 입니다.</font>
		</td>
	</tr>
	<tr>
		<th>탭 방향</th>
		<td class="noline">
		<label><input type="radio" name="dOpt3[#{i}]" value="1" #{checked.dOpt3[1]}  />가로형</label>
		<label><input type="radio" name="dOpt3[#{i}]" value="2" #{checked.dOpt3[2]}  />세로형</label>
		</td>
	</tr>
	#{tab}
	</table></textarea>

	<!-- 탭에 끼워들어 가는 부분이므로, table 로 감싸지 않음. -->
	<textarea id="탭쓰" class="display-type-config-tpl">
	<tr>
		<th>#{tb}번 탭이름</th>
		<td>
		<input type="text" name="tabName#{tb}[#{i}]" value="#{tabName}" class="rline">
		</td>
	</tr>
	<tr>
		<th>진열할 상품선정</th>
		<td>
		<div style="padding-top:5px;">
			<div id="category-box-#{i}_#{tb}" style="display:inline;"></div>
			<script>new categoryBox('step#{i}_#{tb}[]',4,'','','','category-box-#{i}_#{tb}');</script>

			<input type=text name=search_step#{i}_#{tb} onkeydown="return go_list_goods('step#{i}_#{tb}')">
			<a href="javascript:list_goods('step#{i}_#{tb}')"><img src="../img/i_search.gif" border=0></a>
			<a href="javascript:view_goods('step#{i}_#{tb}')"><img src="../img/i_openclose.gif" border=0></a>
		</div>
		<div style="position:relative;">
			<div id=obj_step#{i}_#{tb} class=box1><iframe id=ifrm_step#{i}_#{tb} style="width:100%;height:100%" frameborder=0></iframe></div>
			<div id=obj2_step#{i}_#{tb} class="box2 scroll" onselectstart="return false" onmousewheel="return iciScroll(this)">
				<div class=boxTitle>- 메인상품디스플레이 <font class=small1 color=white>(삭제시 더블클릭)</font></div>
				<table id=tb_step#{i}_#{tb} class=tb>
				<col width=50>

				</table>
			</div>
		</div>

		<div style="clear:both;padding-top:2px"></div>
		<font class=extext>진열할 상품을 많이 선정해놓으세요! 선정한 상품들은 메인에서도 보여지고 해당페이지에서도 보여집니다! <a href="javascript:popup('http://guide.godo.co.kr/guide/php/ex_display.html',850,523)"><img src="../img/icon_sample.gif" border="0" align=absmiddle hspace=2></a><!--상품이미지를 클릭하면 해당상품 화면을 볼 수 있습니다--></font>

		<div id=step#{i}_#{tb}X style="padding-top:3px"></div>
		<script>react_goods('step#{i}_#{tb}');</script>

		</td>
	</tr>
	</textarea>

	<textarea id="선택강조" class="display-type-config-tpl"><table class="display-type-config">
	<tr>
		<th>효과 대상</th>
		<td class="noline">
		<label><input type="radio" name="dOpt8[#{i}]" value="1" #{checked.dOpt8[1]}  />선택한 상품만 흐리게</label>
		<label><input type="radio" name="dOpt8[#{i}]" value="2" #{checked.dOpt8[2]}  />선택한 나머지 상품 흐리게</label>
		</td>
	</tr>
	<tr>
		<th>투명도</th>
		<td>
		<input type="text" name="alphaRate[#{i}]" value="#{alphaRate}" class="rline"> <font class="extext">0%에 가까울수록 투명해 집니다.</font>
		</td>
	</tr>
	</table></textarea>

	<textarea id="말풍선" class="display-type-config-tpl"><table class="display-type-config">
	<tr>
		<th>배경색</th>
		<td class="noline">
		<label><input type="radio" name="dOpt10[#{i}]" value="1" #{checked.dOpt10[1]}  />타입1(Black)</label>
		<label><input type="radio" name="dOpt10[#{i}]" value="2" #{checked.dOpt10[2]}  />타입2(white)</label>
		</td>
	</tr>
	<tr>
		<th>투명도</th>
		<td>
		<input type="text" name="alphaRate[#{i}]" value="#{alphaRate}" class="rline"> <font class="extext">0%에 가까울수록 투명해 집니다.</font>
		</td>
	</tr>
	</table></textarea>
<!-- 세부설정-->


<!-- 진열 타입 소스 -->
	<textarea id="extra-display-form-src" style="display:none;width:100%;height:300px;">
	<div id="extra-display-form-#{i}" class="extra-display-form">
	<div class=title>메인페이지 상품진열 <a href="javascript:manual('<?=$guideUrl?>board/view.php?id=product&no=7')"><img src="../img/btn_q.gif" border=0 align=absmiddle hspace=2></a> <span><a href="../../main/index.php" target=_blank><font color=0074BA>[메인화면보기]</font></a></span></div>
	<?=$strMainGoodsTitle?>
	<table class=tb>
	<col class=cellC><col class=cellL>
	<tr>
		<td>설명</td>
		<td><input type=text name=title[#{i}] value="#{title}" class=lline>
		<div style="padding-top:4px"><font class=extext>관련 타이틀이미지는 <a href="../design/codi.php" target=_blank><font class=extext_l>[디자인관리 > 메인페이지디자인 > 본문영역]</font></a> 에서 작성하세요</font></div></td>
	</tr>
	<tr>
		<td>사용유무 <a href="javascript:void(0);" onClick="fnDelDisplayForm(#{i});"><img src="../img/i_del.gif" align="absmiddle"></a></td>
		<td class=noline>
		<input type=checkbox name=chk[#{i}]> 체크시 메인페이지에 출력이됩니다
		</td>
	</tr>
	<tr>
		<td>템플릿 소스코드<div style="padding-top:3px"></div><a href="javascript:void(0);" onClick="fnCopyDisplayFormSrc('#{i}')"><img src="../img/btn_codecopy.gif" align="absmiddle"></a></td>
		<td>
			<xmp id="extra-display-form-tplsrc-#{i}">{ ? _cfg_step[#{i}].chk }
			{ = this->assign( 'loop', dataDisplayGoods( #{i}, _cfg_step[#{i}].img, _cfg_step[#{i}].page_num ) ) }
			{ = this->assign( 'dpCfg', _cfg_step[#{i}] ) }
			{ = this->assign( 'id', 'main_list_#{i}' ) }
			{ = this->assign( 'cols', _cfg_step[#{i}].cols ) }
			{ = this->assign( 'size', _cfg[_cfg_step[#{i}].img] ) }
			{ = include_file( 'goods/list/' + _cfg_step[#{i}].tpl + '.htm' ) }
			{ / }</xmp>
		</td>
	</tr>
	<tr>
		<td>디스플레이유형</td>
		<td>
		<? for ($t=1,$m=sizeof($ar_display_type);$t<=$m;$t++) { ?>
		<div class="display-type-wrap">
			<img src="../img/goodalign_style_<?=sprintf('%02d',$t)?>.gif"  alt="<?=$ar_display_type[$t]?>">
			<div class="noline">
			<input type=radio name=tpl[#{i}] value="tpl_<?=sprintf('%02d',$t)?>" onclick="fnSetExtraOption(#{i},'<?=$ar_display_type[$t]?>')">
			</div>
		</div>
		<? } ?>
		</td>
	</tr>
	<tr id="extra-config-display-type-#{i}" style="display:none;">
		<td>세부 설정</td>
		<td id="extra-config-wrap-display-type-#{i}"></td>
	</tr>
	<tr>
		<td>이미지 선택</td>
		<td>
		<select name=img[#{i}]>
		<option value="img_s"> 리스트이미지 (<?=$cfg[img_s]?>px)
		<option value="img_i"> 메인이미지 (<?=$cfg[img_i]?>px)
		</select>
		<font class=extext>적당한 사이즈의 이미지를 고르세요
		</td>
	</tr>
	<tr>
		<td>메인출력 상품수</td>
		<td><input type=text name=page_num[#{i}] value="" class="rline"> 개 <font class=extext>메인페이지에 보여지는 총 상품수입니다</td>
	</tr>
	<tr>
		<td>라인당 상품수</td>
		<td><input type=text name=cols[#{i}] value="" class="rline"> 개 <font class=extext>한줄에 보여지는 상품수입니다</td>
	</tr>
	<tr id="gList_#{i}">
		<td>진열할 상품선정<div style="padding-top:3px"></div>
		<a href="javascript:popup('http://guide.godo.co.kr/guide/php/ex_display.html',850,523)"><font class=extext_l>[상품순서변경 방법]</font></a>
		<div style="padding-top:3px"></div>
		<a href="javascript:popup('http://guide.godo.co.kr/guide/php/ex_display.html',850,523)"><img src="../img/icon_sample.gif" border="0" align=absmiddle hspace=2></a>
		</td>
		<td>

		<div style="padding-top:5px;z-index:-10">
		<div id="category-box-#{i}" style="display:inline;"></div>
		<script>new categoryBox('step#{i}[]',4,'','','','category-box-#{i}');</script>
		<input type=text name=search_step#{i} onkeydown="return go_list_goods('step#{i}')">
		<a href="javascript:list_goods('step#{i}')"><img src="../img/i_search.gif" border=0></a>
		<a href="javascript:view_goods('step#{i}')"><img src="../img/i_openclose.gif" border=0></a>
		</div>
		<div style="position:relative;">
		<div id=obj_step#{i} class=box1><iframe id=ifrm_step#{i} style="width:100%;height:100%" frameborder=0></iframe></div>
		<div id=obj2_step#{i} class="box2 scroll" onselectstart="return false" onmousewheel="return iciScroll(this)">
			<div class=boxTitle>- 메인상품디스플레이 <font class=small1 color=white>(삭제시 더블클릭)</font></div>
			<table id=tb_step#{i} class=tb>
			<col width=50>
			</table>
			</div>
		</div>
		<div style="padding-top:2px"></div>
		<font class=extext>진열할 상품을 많이 선정해놓으세요! 선정한 상품들은 메인에서도 보여지고 해당페이지에서도 보여집니다! <a href="javascript:popup('http://guide.godo.co.kr/guide/php/ex_display.html',850,523)"><img src="../img/icon_sample.gif" border="0" align=absmiddle hspace=2></a><!--상품이미지를 클릭하면 해당상품 화면을 볼 수 있습니다--></font>
		<div id=step#{i}X style="padding-top:3px"></div>
		<script>react_goods('step#{i}');</script>
		</td>
	</tr>
	</table>
	</div>
	</textarea>
<!-- 진열 타입 소스 -->


<form id=form action="indb.php" method=post>
<input type=hidden name=mode value="disp_main">
<input type="hidden" name="tplSkinWork" value="<?=$cfg['tplSkinWork']?>">

<?
for ($i=0;$i<5;$i++){
	$checked[tpl][$i][$cfg_step[$i][tpl]] = "checked";
	$selected[img][$i][$cfg_step[$i][img]] = "selected";
?>
<div class=title <?if(!$i){?>style="margin-top:0"<?}?>>메인페이지 상품진열 <?=$i+1?> <a href="javascript:manual('<?=$guideUrl?>board/view.php?id=product&no=7')"><img src="../img/btn_q.gif" border=0 align=absmiddle hspace=2></a> <span><a href="../../main/index.php" target=_blank><font color=0074BA>[메인화면보기]</font></a></span></div>
<?=$strMainGoodsTitle?>
<table class=tb>
<col class=cellC><col class=cellL>
<tr>
	<td>설명</td>
	<td><input type=text name=title[] value="<?=$cfg_step[$i][title]?>" class=lline>
	<div style="padding-top:4px"><font class=extext>관련 타이틀이미지는 <a href="../design/codi.php" target=_blank><font class=extext_l>[디자인관리 > 메인페이지디자인 > 본문영역]</font></a> 에서 작성하세요</font></div></td>
</tr>
<tr>
	<td>사용유무</td>
	<td class=noline>
	<input type=checkbox name=chk[<?=$i?>] <? if ($cfg_step[$i][chk]){ ?>checked<?}?>> 체크시 메인페이지에 출력이됩니다
	</td>
</tr>
<tr>
	<td>디스플레이유형</td>
	<td>
	<? for ($t=1,$m=sizeof($ar_display_type);$t<=$m;$t++) { ?>
	<div class="display-type-wrap">
		<img src="../img/goodalign_style_<?=sprintf('%02d',$t)?>.gif"  alt="<?=$ar_display_type[$t]?>">
		<div class="noline">
		<input type=radio name=tpl[<?=$i?>] value="tpl_<?=sprintf('%02d',$t)?>" <?=$checked[tpl][$i]['tpl_'.sprintf('%02d',$t)]?>  onclick="fnSetExtraOption(<?=$i?>,'<?=$ar_display_type[$t]?>')">
		</div>
	</div>
	<? } ?>
	</td>
</tr>
<tr id="extra-config-display-type-<?=$i?>" style="display:none;">
	<td>세부 설정</td>
	<td id="extra-config-wrap-display-type-<?=$i?>"></td>
</tr>
<tr>
	<td>이미지 선택</td>
	<td>
	<select name=img[]>
	<option value="img_s" <?=$selected[img][$i][img_s]?>> 리스트이미지 (<?=$cfg[img_s]?>px)
	<option value="img_i" <?=$selected[img][$i][img_i]?>> 메인이미지 (<?=$cfg[img_i]?>px)
	</select>
	<font class=extext>적당한 사이즈의 이미지를 고르세요
	</td>
</tr>
<tr>
	<td>메인출력 상품수</td>
	<td><input type=text name=page_num[] value="<?=$cfg_step[$i][page_num]?>" class="rline"> 개 <font class=extext>메인페이지에 보여지는 총 상품수입니다</td>
</tr>
<tr>
	<td>라인당 상품수</td>
	<td><input type=text name=cols[] value="<?=$cfg_step[$i][cols]?>" class="rline"> 개 <font class=extext>한줄에 보여지는 상품수입니다</td>
</tr>
<tr id="gList_<?=$i?>">
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
	<div style="position:relative;z-index:1000;">
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
	</div>
	<div style="padding-top:2px;z-index:1;"></div>
	<font class=extext>진열할 상품을 많이 선정해놓으세요! 선정한 상품들은 메인에서도 보여지고 해당페이지에서도 보여집니다! <a href="javascript:popup('http://guide.godo.co.kr/guide/php/ex_display.html',850,523)"><img src="../img/icon_sample.gif" border="0" align=absmiddle hspace=2></a><!--상품이미지를 클릭하면 해당상품 화면을 볼 수 있습니다--></font>
	<div id=step<?=$i?>X style="padding-top:3px"></div>
	<script>react_goods('step<?=$i?>');</script>
	</td>
</tr>
</table>
<? $t = (int)(array_pop(explode('_',$cfg_step[$i][tpl]))); ?>
<script language="JavaScript">fnSetExtraOption(<?=$i?>,'<?=$ar_display_type[$t]?>')</script>
<? } ?>

<!-- 노출 영역 추가 확장 -->
<div id="extra-display-form-wrap">
	<?
	$_cfg_step = $cfg_step;
	unset($_cfg_step[0], $_cfg_step[1], $_cfg_step[2], $_cfg_step[3], $_cfg_step[4]);

	foreach($_cfg_step as $i => $_foo) {

		$checked[tpl][$i][$cfg_step[$i][tpl]] = "checked";
		$selected[img][$i][$cfg_step[$i][img]] = "selected";?>

	<div id="extra-display-form-<?=$i?>">
		<div class=title>메인페이지 상품진열 <a href="javascript:manual('<?=$guideUrl?>board/view.php?id=product&no=7')"><img src="../img/btn_q.gif" border=0 align=absmiddle hspace=2></a> <span><a href="../../main/index.php" target=_blank><font color=0074BA>[메인화면보기]</font></a></span></div>
		<?=$strMainGoodsTitle?>
		<table class=tb>
		<col class=cellC><col class=cellL>
		<tr>
			<td>설명</td>
			<td><input type=text name=title[<?=$i?>] value="<?=$cfg_step[$i][title]?>" class=lline>
			<div style="padding-top:4px"><font class=extext>관련 타이틀이미지는 <a href="../design/codi.php" target=_blank><font class=extext_l>[디자인관리 > 메인페이지디자인 > 본문영역]</font></a> 에서 작성하세요</font></div></td>
		</tr>
		<tr>
			<td>사용유무 <a href="javascript:void(0);" onClick="fnDelDisplayForm(<?=$i?>);"><img src="../img/i_del.gif" align="absmiddle"></a></td>
			<td class=noline>
			<input type=checkbox name=chk[<?=$i?>] <? if ($cfg_step[$i][chk]){ ?>checked<?}?>> 체크시 메인페이지에 출력이됩니다
			</td>
		</tr>
		<tr>

			<td>템플릿 소스코드<div style="padding-top:3px"></div><a href="javascript:void(0);" onClick="fnCopyDisplayFormSrc('<?=$i?>')"><img src="../img/btn_codecopy.gif" align="absmiddle"></a></td>
			<td>
				<xmp class="extra-display-form-tplsrc" id="extra-display-form-tplsrc-<?=$i?>">{ ? _cfg_step[<?=$i?>].chk }
				{ = this->assign( 'loop', dataDisplayGoods( <?=$i?>, _cfg_step[<?=$i?>].img, _cfg_step[<?=$i?>].page_num ) ) }
				{ = this->assign( 'dpCfg', _cfg_step[<?=$i?>] ) }
				{ = this->assign( 'id', 'main_list_<?=$i?>' ) }
				{ = this->assign( 'cols', _cfg_step[<?=$i?>].cols ) }
				{ = this->assign( 'size', _cfg[_cfg_step[<?=$i?>].img] ) }
				{ = include_file( 'goods/list/' + _cfg_step[<?=$i?>].tpl + '.htm' ) }
				{ / }</xmp>
			</td>
		</tr>
		<tr>
			<td>디스플레이유형</td>
			<td>

			<? for ($t=1,$m=sizeof($ar_display_type);$t<=$m;$t++) { ?>
			<div class="display-type-wrap">
				<img src="../img/goodalign_style_<?=sprintf('%02d',$t)?>.gif"  alt="<?=$ar_display_type[$t]?>">
				<div class="noline">
				<input type=radio name=tpl[<?=$i?>] value="tpl_<?=sprintf('%02d',$t)?>" <?=$checked[tpl][$i]['tpl_'.sprintf('%02d',$t)]?>  onclick="fnSetExtraOption(<?=$i?>,'<?=$ar_display_type[$t]?>')">
				</div>
			</div>
			<? } ?>

			</td>
		</tr>
		<tr id="extra-config-display-type-<?=$i?>" style="display:none;">
			<td>세부 설정</td>
			<td id="extra-config-wrap-display-type-<?=$i?>"></td>
		</tr>
		<tr>
			<td>이미지 선택</td>
			<td>
			<select name=img[<?=$i?>]>
			<option value="img_s" <?=$selected[img][$i][img_s]?>> 리스트이미지 (<?=$cfg[img_s]?>px)
			<option value="img_i" <?=$selected[img][$i][img_i]?>> 메인이미지 (<?=$cfg[img_i]?>px)
			</select>
			<font class=extext>적당한 사이즈의 이미지를 고르세요
			</td>
		</tr>
		<tr>
			<td>메인출력 상품수</td>
			<td><input type=text name=page_num[<?=$i?>] value="<?=$cfg_step[$i][page_num]?>" class="rline"> 개 <font class=extext>메인페이지에 보여지는 총 상품수입니다</td>
		</tr>
		<tr>
			<td>라인당 상품수</td>
			<td><input type=text name=cols[<?=$i?>] value="<?=$cfg_step[$i][cols]?>" class="rline"> 개 <font class=extext>한줄에 보여지는 상품수입니다</td>
		</tr>
		<tr id="gList_<?=$i?>">
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
			<font class=extext>진열할 상품을 많이 선정해놓으세요! 선정한 상품들은 메인에서도 보여지고 해당페이지에서도 보여집니다! <a href="javascript:popup('http://guide.godo.co.kr/guide/php/ex_display.html',850,523)"><img src="../img/icon_sample.gif" border="0" align=absmiddle hspace=2></a><!--상품이미지를 클릭하면 해당상품 화면을 볼 수 있습니다--></font>
			<div id=step<?=$i?>X style="padding-top:3px"></div>
			<script>react_goods('step<?=$i?>');</script>
			</div>

			</td>
		</tr>
		</table>
	</div>
	<? $t = (int)(array_pop(explode('_',$cfg_step[$i][tpl]))); ?>
	<script language="JavaScript">fnSetExtraOption(<?=$i?>,'<?=$ar_display_type[$t]?>')</script>
	<? } ?>
</div>
<div class=button>
	<input type=image src="../img/btn_save.gif">
	<a href="list.php"><img src='../img/btn_list.gif'></a>
</div>
</form>

<a href="javascript:void(0);" onClick="fnAddDisplayForm();"><img src="../img/btn_goodsadd.gif"></a>


<div id=MSG01>
<table cellpadding=2 cellspacing=0 border=0 class=small_ex>
<tr><td><img src="../img/icon_list.gif" align=absmiddle>분류를 선택하고 검색버튼을 누르세요. 또는 검색어를 입력후 검색버튼을 누르세요.</td></tr>
<tr><td><img src="../img/icon_list.gif" align=absmiddle>검색된 상품을 더블클릭하면 진열되며, 선정된 상품을 더블클릭하면 삭제됩니다.</td></tr>
<tr><td><img src="../img/icon_list.gif" align=absmiddle>상품진열 순서를 변경하시려면 변경할 상품을 선택한 후 키보드의 이동키 Up/Down키로 이동하시면 됩니다.</td></tr>
<tr><td><img src="../img/icon_list.gif" align=absmiddle>펼쳐진 창을 닫고 아래의 저장버튼을 누르셔야 최종 저장됩니다.</td></tr>
<tr><td><img src="../img/icon_list.gif" align=absmiddle>진열할 수 있는 상품의 갯수는 무제한입니다.</td></tr>
</table>

</div>
<script>cssRound('MSG01')</script>


<? include "../_footer.php"; ?>