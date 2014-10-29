<?

$location = "상품관리 > 검색페이지 상품진열";
include "../_header.php";
@include "../../conf/design.search.php";
@include "../../conf/design_search.".$cfg['tplSkinWork'].".php";

//0
$checked['keyword_chk'][$cfg_search[0]['keyword_chk']] = 'checked="checked"';
$checked['disp_sort'][$cfg_search[0]['disp_sort']] = 'checked="checked"';
$pr_text = explode(',', $cfg_search[0]['pr_text']);
$link_url = explode(',', $cfg_search[0]['link_url']);

//1
$keyword = explode(',', $cfg_search[1]['keyword']);

//2
$detail_type = explode(',', $cfg_search[2]['detail_type']);
foreach($detail_type as $val){
	$checked['detail_type'][$val] = 'checked="checked"';
}
$detail_add_type = explode(',', $cfg_search[2]['detail_add_type']);

foreach($detail_add_type as $val){
	$checked['detail_add_type'][$val] = 'checked="checked"';
}

//3
$disp_type = explode(',', $cfg_search[3]['disp_type']);
foreach($disp_type as $val){
	$checked['disp_type'][$val] = 'checked="checked"';
}
?>

<style>
.display-type-wrap {width:94px;float:left;margin:3px;}
.display-type-wrap img {border:none;width:94px;height:72px;}
.display-type-wrap div {text-align:center;}
</style>
<script type="text/javascript">
function display_add(obj){
	if( obj.checked ) document.getElementById("benefit_box").style.display = 'block';
	else document.getElementById("benefit_box").style.display = 'none';
}

function appendHTML(node, html){
    var dummy = document.createElement('div');
    dummy.innerHTML = html;
    var items = dummy.children;
	for(var i=items.length - 1; i>=0; i--){
        node.appendChild(items[i]);
    }
}


function inputbox_clone( obj ){
	var divObj = document.getElementById(obj);
	var objNm = obj+"_"+document.getElementById(obj).childNodes.length;
	var htmltxt = "";
	switch(obj){
		case 'keywords':
			htmltxt = "<div style='padding-top:4px;' id='"+objNm+"'><table style='border:solid 1px #DEDEDE; padding:0;width:100%'><col class='cellC'><col class='cellL'><tr><th>홍보내용 등록</th><td><input type='text' name='pr_text[]' class='lline' style='width:200px' value=''/> <font class='extext'>( 권장 글자수: 한글 5자 에서 10글자 )</font></td></tr><tr><th>링크페이지</th><td><input type='text' name='link_url[]' class='lline' style='width:400px' value=''/> <a href=javascript:inputbox_remove('"+objNm+"')><img src='../img/btn_del2.gif'></a></td></tr></table></div>";
			appendHTML(divObj, htmltxt);
			break;
		case 'best_keywords':
			htmltxt = "<div style='padding-bottom:4px;' id='"+objNm+"' ><input type='text' name='keyword[]' class='lline' style='width:150px;' value=''/> <a href=javascript:inputbox_remove('"+objNm+"')><img src='../img/btn_del2.gif'></a></div>";
			appendHTML(divObj, htmltxt);
			break;
	}
}
function inputbox_remove(obj){
	var chk_len = 0;
	if( obj.indexOf("best_keywords") == 0){
		chk_len = document.getElementById("best_keywords").childNodes.length;
	}else{
		chk_len = document.getElementById("keywords").childNodes.length;
	}

	if(chk_len == 1) return;

	var srcNode = document.getElementById(obj);
	srcNode.removeNode(true);
}
</script>
<form name="frm" method="post" action="indb.php">
<input type="hidden" name="mode" value="disp_search" />
<input type="hidden" name="tplSkinWork" value="<?=$cfg['tplSkinWork']?>">
<div class="title" style="margin-top:0">검색 페이지 상품 진열 <a href="javascript:manual('<?=$guideUrl?>board/view.php?id=product&no=36')"><img src="../img/btn_q.gif" border="0" align="absmiddle"></a></div>
<?=$strMainGoodsTitle?>

<div class="title" style="margin-top:0">
	상품 검색 키워드 설정 <span>상점의 상품검색 입력 창에 홍보문구를 등록하여 전략적으로 활용할 수 있습니다.</font>
</div>
<table class="tb">
<col class="cellC"><col class="cellL">
<tr>
	<th>사용여부</th>
	<td>
		<label><input type="radio" name="keyword_chk" value="on" style="border=0;" <?=$checked['keyword_chk']['on']?>/>사용함</label>
		<label><input type="radio" name="keyword_chk" value="off" style="border=0;" <?=$checked['keyword_chk']['off']?>/>사용안함</label>
	</td>
</tr>
<tr>
	<th>키워드 노출 방식</th>
	<td>
		<label><input type="radio" name="disp_sort" value="rand" style="border=0;" checked/>랜덤노출</label>
	</td>
</tr>
<tr>
	<th>키워드 등록</th>
	<td>
		<div style="padding:4px,0,4px,0;"><font class="extext">문구를 등록하고 검색창에 노출된 문구를 검색했을 때 연결되는 상점 페이지 링크정보를 입력해 주세요.<br/>추가 버튼을 클릭하면 홍보문구를 여러 개 등록하실 수 있
		습니다.<font></div>
		<div id="keywords">
<?
		for($i=0; $i<(is_array($pr_text) ? count($pr_text) : 1); $i++){
?>
			<div style="padding-top:4px;" id="keywords_<?=$i?>">
				<table class="tb">
				<col class="cellC"><col class="cellL">
				<tr>
					<th>홍보내용 등록</th>
					<td><input type="text" name="pr_text[]" class="lline" style="width:200px" value="<?= $pr_text[$i]?>"/> <font class="extext">( 권장 글자수: 한글 5자 에서 10글자 )</font></td>
				</tr>
				<tr>
					<th>링크페이지</th>
					<td><input type="text" name="link_url[]" class="lline" style="width:400px" value="<?= $link_url[$i]?>"/>
					<a href="javascript:inputbox_remove('keywords_<?=$i?>')"><img src="../img/btn_del2.gif"></a></td>
				</tr>
				</table>
			</div>
<?	} ?>
		</div>
		<div style="float:right;">
			<a href="javascript:inputbox_clone('keywords')"><img src="../img/btn_add2.gif"></a>
		</div>
	</td>
</tr>
</table>

<div class="title">
	인기 검색어 설정 <span>인기 검색어를 등록하여 홍보수단으로 활용합니다.</span>
</div>
<table class="tb">
<col class="cellC"><col class="cellL">
<tr>
	<th>인기 검색어 등록</th>
	<td>
		<div style="padding:4px,0,4px,0;"><font class="extext">상점에서 주력하는 상품을 홍보하는 수단으로 활용할 수 있습니다.<br/>
검색이 가능한 검색어는 상품등록시에 등록한 상품명, 제조사, 브랜드, 유사검색어에 적용된 단어만 검색이 가능합니다.
</font></div>
		<div id="best_keywords" style="padding-top:4px;display:inline-block;" >
<?
	if(!$keyword) $il = 1;
	else $il = count($keyword);

	for($i=0; $i<$il; $i++){?>

			<div style="padding-bottom:4px;" id="best_keywords_<?=$i?>" ><input type="text" name="keyword[]" class="lline" style="width:150px;" value="<?=$keyword[$i]?>"/> <a href="javascript:inputbox_remove('best_keywords_<?=$i?>')"><img src="../img/btn_del2.gif"></a></div>

<?	} ?>
		</div>
		<a href="javascript:inputbox_clone('best_keywords')"><img src="../img/btn_add2.gif"></a>
	</td>
</tr>
</table>

<div class="title">
	상세검색 설정 <span>검색 결과 페이지에서 고객이 원하는 정보를 좀 더 정확하게 검색할 수 있도록 상세검색 기능 조건을 선택합니다.</span>
</div>
<table class="tb">
<col class="cellC"><col class="cellL">
<tr>
	<th>상세검색 조건 선택</th>
	<td>
		<div style="padding:4px,0,4px,0;"><font class="extext">조건값을 하나도 선택하지 않은 경우 상점페이지에 노출되지 않습니다.</font></div>
		<label><input type="checkbox" name="detail_type[]" value="category" style="border:0;" <?= $checked['detail_type']['category']?>/>상품분류검색</label><br/>
		<label><input type="checkbox" name="detail_type[]" value="price" style="border:0;" <?= $checked['detail_type']['price']?>/>가격검색</label><br/>
		<label><input type="checkbox" name="detail_type[]" value="add" style="border:0;" <?= $checked['detail_type']['add']?> onclick="display_add(this)"/>혜택선택 검색</label>
			<font class="extext">( 혜택선택 검색을 제공하고자 하는 경우 제공할 세부 검색 조건을 선택해주세요 )</font>
		<div id="benefit_box" style="padding:5px,0,0,20px;display:none;">
			<label><input type="checkbox" name="detail_add_type[]" value="free_deliveryfee" style="border:0;" <?= $checked['detail_add_type']['free_deliveryfee']?>/>무료배송</label>
			<label><input type="checkbox" name="detail_add_type[]" value="dc" style="border:0;" <?= $checked['detail_add_type']['dc']?>/>할인쿠폰</label>
			<label><input type="checkbox" name="detail_add_type[]" value="save" style="border:0;" <?= $checked['detail_add_type']['save']?>/>적립쿠폰</label>
			<label><input type="checkbox" name="detail_add_type[]" value="new" style="border:0;" <?= $checked['detail_add_type']['new']?>/>신상품</label>
			<label><input type="checkbox" name="detail_add_type[]" value="event" style="border:0;" <?= $checked['detail_add_type']['event']?>/>이벤트상품</label>
		</div>

		<br><label><input type="checkbox" name="detail_type[]" value="color" style="border:0;" <?= $checked['detail_type']['color']?> />색상검색</label>
		<div style="padding:4px,0,4px,0;">
		<font class="extext">
		색상 검색은 상품등록 상세페이지에서 대표색상 설정 저장된 상품에 한하여 검색되어 집니다.<br/>
		<a href="./goods_color.php"><font class=extext_l>[ 상품일괄관리 > 빠른 대표색상 수정 ]</font></a> 를 통하여 기존 상품의 대표색상을 일괄로 설정 하실 수 있습니다.
		</font>
		</div>
	</td>
</tr>
</table>
<script>
<? if(count($detail_add_type) >= 1 && $detail_add_type[0] != '') { ?> document.getElementById("benefit_box").style.display = "block";<? } ?>
</script>

<div class="title">
	디스플레이 유형 <span>검색 결과 페이지에 노출되는 상품 유형을 설정합니다.</span>
</div>
<table class="tb">
<col class="cellC"><col class="cellL">
<tr>
	<th>디스플레이 유형</th>
	<td>
		<div style="padding:4px,0,4px,0;"><font class="extext">검색결과 페이지는 이미지 형식으로 지원되는 갤러리형과 리스트형을 설정하여 노출할 수 있습니다.</font></div>
		<div class="display-type-wrap">
			<img src="../img/goodalign_style_01.gif">
			<div class="noline"><input type="radio" name="disp_type" value="gallery" <?= $checked['disp_type']['gallery']?>/></div>
		</div>
		<div class="display-type-wrap">
			<img src="../img/goodalign_style_02.gif">
			<div class="noline"><input type="radio" name="disp_type" value="list" <?= $checked['disp_type']['list']?>/></div>
		</div>
		<div style="width:100%; height:110px"></div>
		<div style="padding-top:4px;"><font class="extext">쇼핑몰 검색결과 리스트페이지에 기본 값으로 노출될 디스플레이 유형을 선택합니다.<br/>예를들어 갤러리형으로 체크할 경우 리스트 보기 방식이 갤러리 형으로 먼저 노출되며, 쇼핑몰 고객이 원하는 보기방식으로 선택하여 사용할 수 있습니다.</font></div>
	</td>
</tr>
</table>

<div class="button">
<input type="image" src="../img/btn_register.gif" />
<a href="javascript:history.back();"><img src="../img/btn_cancel.gif" /></a>
</div>


</form>
<? include "../_footer.php"; ?>