<?

$location = "��ǰ���� > �˻������� ��ǰ����";
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
			htmltxt = "<div style='padding-top:4px;' id='"+objNm+"'><table style='border:solid 1px #DEDEDE; padding:0;width:100%'><col class='cellC'><col class='cellL'><tr><th>ȫ������ ���</th><td><input type='text' name='pr_text[]' class='lline' style='width:200px' value=''/> <font class='extext'>( ���� ���ڼ�: �ѱ� 5�� ���� 10���� )</font></td></tr><tr><th>��ũ������</th><td><input type='text' name='link_url[]' class='lline' style='width:400px' value=''/> <a href=javascript:inputbox_remove('"+objNm+"')><img src='../img/btn_del2.gif'></a></td></tr></table></div>";
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
<div class="title" style="margin-top:0">�˻� ������ ��ǰ ���� <a href="javascript:manual('<?=$guideUrl?>board/view.php?id=product&no=36')"><img src="../img/btn_q.gif" border="0" align="absmiddle"></a></div>
<?=$strMainGoodsTitle?>

<div class="title" style="margin-top:0">
	��ǰ �˻� Ű���� ���� <span>������ ��ǰ�˻� �Է� â�� ȫ�������� ����Ͽ� ���������� Ȱ���� �� �ֽ��ϴ�.</font>
</div>
<table class="tb">
<col class="cellC"><col class="cellL">
<tr>
	<th>��뿩��</th>
	<td>
		<label><input type="radio" name="keyword_chk" value="on" style="border=0;" <?=$checked['keyword_chk']['on']?>/>�����</label>
		<label><input type="radio" name="keyword_chk" value="off" style="border=0;" <?=$checked['keyword_chk']['off']?>/>������</label>
	</td>
</tr>
<tr>
	<th>Ű���� ���� ���</th>
	<td>
		<label><input type="radio" name="disp_sort" value="rand" style="border=0;" checked/>��������</label>
	</td>
</tr>
<tr>
	<th>Ű���� ���</th>
	<td>
		<div style="padding:4px,0,4px,0;"><font class="extext">������ ����ϰ� �˻�â�� ����� ������ �˻����� �� ����Ǵ� ���� ������ ��ũ������ �Է��� �ּ���.<br/>�߰� ��ư�� Ŭ���ϸ� ȫ�������� ���� �� ����Ͻ� �� ��
		���ϴ�.<font></div>
		<div id="keywords">
<?
		for($i=0; $i<(is_array($pr_text) ? count($pr_text) : 1); $i++){
?>
			<div style="padding-top:4px;" id="keywords_<?=$i?>">
				<table class="tb">
				<col class="cellC"><col class="cellL">
				<tr>
					<th>ȫ������ ���</th>
					<td><input type="text" name="pr_text[]" class="lline" style="width:200px" value="<?= $pr_text[$i]?>"/> <font class="extext">( ���� ���ڼ�: �ѱ� 5�� ���� 10���� )</font></td>
				</tr>
				<tr>
					<th>��ũ������</th>
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
	�α� �˻��� ���� <span>�α� �˻�� ����Ͽ� ȫ���������� Ȱ���մϴ�.</span>
</div>
<table class="tb">
<col class="cellC"><col class="cellL">
<tr>
	<th>�α� �˻��� ���</th>
	<td>
		<div style="padding:4px,0,4px,0;"><font class="extext">�������� �ַ��ϴ� ��ǰ�� ȫ���ϴ� �������� Ȱ���� �� �ֽ��ϴ�.<br/>
�˻��� ������ �˻���� ��ǰ��Ͻÿ� ����� ��ǰ��, ������, �귣��, ����˻�� ����� �ܾ �˻��� �����մϴ�.
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
	�󼼰˻� ���� <span>�˻� ��� ���������� ���� ���ϴ� ������ �� �� ��Ȯ�ϰ� �˻��� �� �ֵ��� �󼼰˻� ��� ������ �����մϴ�.</span>
</div>
<table class="tb">
<col class="cellC"><col class="cellL">
<tr>
	<th>�󼼰˻� ���� ����</th>
	<td>
		<div style="padding:4px,0,4px,0;"><font class="extext">���ǰ��� �ϳ��� �������� ���� ��� ������������ ������� �ʽ��ϴ�.</font></div>
		<label><input type="checkbox" name="detail_type[]" value="category" style="border:0;" <?= $checked['detail_type']['category']?>/>��ǰ�з��˻�</label><br/>
		<label><input type="checkbox" name="detail_type[]" value="price" style="border:0;" <?= $checked['detail_type']['price']?>/>���ݰ˻�</label><br/>
		<label><input type="checkbox" name="detail_type[]" value="add" style="border:0;" <?= $checked['detail_type']['add']?> onclick="display_add(this)"/>���ü��� �˻�</label>
			<font class="extext">( ���ü��� �˻��� �����ϰ��� �ϴ� ��� ������ ���� �˻� ������ �������ּ��� )</font>
		<div id="benefit_box" style="padding:5px,0,0,20px;display:none;">
			<label><input type="checkbox" name="detail_add_type[]" value="free_deliveryfee" style="border:0;" <?= $checked['detail_add_type']['free_deliveryfee']?>/>������</label>
			<label><input type="checkbox" name="detail_add_type[]" value="dc" style="border:0;" <?= $checked['detail_add_type']['dc']?>/>��������</label>
			<label><input type="checkbox" name="detail_add_type[]" value="save" style="border:0;" <?= $checked['detail_add_type']['save']?>/>��������</label>
			<label><input type="checkbox" name="detail_add_type[]" value="new" style="border:0;" <?= $checked['detail_add_type']['new']?>/>�Ż�ǰ</label>
			<label><input type="checkbox" name="detail_add_type[]" value="event" style="border:0;" <?= $checked['detail_add_type']['event']?>/>�̺�Ʈ��ǰ</label>
		</div>

		<br><label><input type="checkbox" name="detail_type[]" value="color" style="border:0;" <?= $checked['detail_type']['color']?> />����˻�</label>
		<div style="padding:4px,0,4px,0;">
		<font class="extext">
		���� �˻��� ��ǰ��� ������������ ��ǥ���� ���� ����� ��ǰ�� ���Ͽ� �˻��Ǿ� ���ϴ�.<br/>
		<a href="./goods_color.php"><font class=extext_l>[ ��ǰ�ϰ����� > ���� ��ǥ���� ���� ]</font></a> �� ���Ͽ� ���� ��ǰ�� ��ǥ������ �ϰ��� ���� �Ͻ� �� �ֽ��ϴ�.
		</font>
		</div>
	</td>
</tr>
</table>
<script>
<? if(count($detail_add_type) >= 1 && $detail_add_type[0] != '') { ?> document.getElementById("benefit_box").style.display = "block";<? } ?>
</script>

<div class="title">
	���÷��� ���� <span>�˻� ��� �������� ����Ǵ� ��ǰ ������ �����մϴ�.</span>
</div>
<table class="tb">
<col class="cellC"><col class="cellL">
<tr>
	<th>���÷��� ����</th>
	<td>
		<div style="padding:4px,0,4px,0;"><font class="extext">�˻���� �������� �̹��� �������� �����Ǵ� ���������� ����Ʈ���� �����Ͽ� ������ �� �ֽ��ϴ�.</font></div>
		<div class="display-type-wrap">
			<img src="../img/goodalign_style_01.gif">
			<div class="noline"><input type="radio" name="disp_type" value="gallery" <?= $checked['disp_type']['gallery']?>/></div>
		</div>
		<div class="display-type-wrap">
			<img src="../img/goodalign_style_02.gif">
			<div class="noline"><input type="radio" name="disp_type" value="list" <?= $checked['disp_type']['list']?>/></div>
		</div>
		<div style="width:100%; height:110px"></div>
		<div style="padding-top:4px;"><font class="extext">���θ� �˻���� ����Ʈ�������� �⺻ ������ ����� ���÷��� ������ �����մϴ�.<br/>������� ������������ üũ�� ��� ����Ʈ ���� ����� ������ ������ ���� ����Ǹ�, ���θ� ���� ���ϴ� ���������� �����Ͽ� ����� �� �ֽ��ϴ�.</font></div>
	</td>
</tr>
</table>

<div class="button">
<input type="image" src="../img/btn_register.gif" />
<a href="javascript:history.back();"><img src="../img/btn_cancel.gif" /></a>
</div>


</form>
<? include "../_footer.php"; ?>