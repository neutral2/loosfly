<?
/**
	2011-01-18 by x-ta-c
	��ǰ�� ����� ��ȸ�Ͽ� ǰ�� ���ι� ����� ������ �� �ִ�.
*/

$location = "��ǰ�ϰ����� > ���� ������";
include "../_header.php";
include "../../lib/page.class.php";
@include "../../conf/design_main.$cfg[tplSkin].php";
@include_once "../../conf/config.purchase.php";


// ���� �ޱ� �� �⺻�� ����
	$_GET['minQuantity'] = isset($_GET['minQuantity']) ? $_GET['minQuantity'] : '';
	$_GET['cate'] = isset($_GET['cate']) ? $_GET['cate'] : array();
	$_GET['skey'] = isset($_GET['skey']) ? $_GET['skey'] : '';
	$_GET['sword'] = isset($_GET['sword']) ? $_GET['sword'] : '';
	$_GET['page_num'] = isset($_GET['page_num']) ? $_GET['page_num'] : 10;

// ���� �����
/**
	gd_goods as a			// ��ǰ
	gd_goods_option as b	// ��ǰ �ɼ�(����, ����)
*/
	$db_table = "
	".GD_GOODS." a
	left join ".GD_GOODS_OPTION." b on a.goodsno=b.goodsno and b.go_is_deleted <> '1'
	";


	if (!empty($_GET[cate])) {
		$category = array_notnull($_GET[cate]);
		$category = $category[count($category)-1];

		/// ī�װ��� �ִ� ��� ��� ���̺� ������
		if ($category) {
			$db_table .= "left join ".GD_GOODS_LINK." c on a.goodsno=c.goodsno";
			$where[] = "category like '$category%'";
			$groupby = "group by b.sno";
		}
	}


	if ($_GET[sword]) $where[] = "$_GET[skey] like '%$_GET[sword]%'";
	if (is_numeric($_GET[minQuantity])) {

		$where[] = "b.stock <= ".$_GET[minQuantity];
	}

// ��ü ��ǰ�� (ǰ���Ǹ�)
	list ($total) = $db->fetch("select count(*) from ".$db_table);


	$orderby = "a.goodsno desc";


// ���ڵ� ��������
	$pg = new Page($_GET[page],$_GET[page_num]);
	$pg->field = "a.goodsno,a.img_s,a.goodsnm,a.open,a.usestock,a.runout,b.*";
	$pg->setQuery($db_table,$where,$orderby,$groupby);
	$pg->exec();
	$res = $db->query($pg->query);
?>
<script><!--

function fnSetStock() {

	var stocks  = document.getElementsByName('stock[]');	// ��� �ʵ�
	var checks  = document.getElementsByName('chk[]');	// üũ �ʵ�
	var mod  = document.getElementsByName('stock_modifier')[0].value;	// ������
	var stock_new  = parseInt(document.getElementsByName('stock_new')[0].value);	// �ű� ���

	for (var i=0;i<stocks.length ;i++ )
	{
		if (checks[i].checked != true) continue;

		stocks[i].value = uncomma(stocks[i].value);

		switch (mod)
		{
		case 'equal':
			stocks[i].value = stock_new;
			break;
		case 'plus':
			stocks[i].value = parseInt(stocks[i].value) + stock_new;
			break;
		case 'minus':
			stocks[i].value = parseInt(stocks[i].value) - stock_new;
			break;
		}

		if (stocks[i].value < 0)
		{
			stocks[i].value = 0;
		}

		stocks[i].value = comma(stocks[i].value);
	}
}

function fnDeleteCheckedRow() {

	// üũ�Ȱ� Ȯ��
	var cnt=0,i,chk = document.getElementsByName('chk[]');
	for ( i =0;i<chk.length ;i++)
		if (chk[i].checked == true) cnt++;

	if (cnt == 0) {
		alert('�����Ͻ� ��ǰ�� ������ �ּ���.');
		return;
	}


	if (confirm('����°� Ȯ�� �޽��� ��Ź�����.'))
	{
		var f = document.fmList;
		f.mode.value = 'quickdeleteopt';
		f.submit();
	}

}

function fnToggleGoodsStat(o) {

	var indicator, css = 'hide';

	if (o.checked == true)
		css = 'show';

	for (indicator=o.parentNode.firstChild; indicator.nodeType !== 1; indicator=indicator.nextSibling);
	indicator.className = css;

	return;
}

function iciSelect(obj)
{
	var row = obj.parentNode.parentNode;
	row.style.background = (obj.checked) ? "#F0F4FF" :"#FFFFFF";
}
--></script>

<style>
div.goods_stat {}
div.goods_stat input {border:none;}
div.goods_stat span {display:block;width:30px;height:12px;}
div.goods_stat span.show {background:url(../img/icn_1.gif) no-repeat 50% 50%;}
div.goods_stat span.hide {background:url(../img/icn_0.gif) no-repeat 50% 50%;}

</style>

<div class="title title_top">���� ������<span>��ϵ� ��ǰ�� ����� �ϰ������� ������ �� �ֽ��ϴ�.</span> <a href="javascript:manual('<?=$guideUrl?>board/view.php?id=product&no=19')"><img src="../img/btn_q.gif" border=0 align=absmiddle hspace=2></a></div>
<? if($purchaseSet['usePurchase'] == "Y") { ?><div style="margin-bottom:7px; font-weight:bold; color:#EA0095;">����ó ���� �� ����� [�԰� �̷� ���] ����� �̿��Ͽ� ��� �Ͻ� �� �ֽ��ϴ�.</div><? } ?>

<!-- ��ǰ������� : start -->
<form name=frmList onsubmit="return chkForm(this)">

<table class=tb>
<col class=cellC><col class=cellL>
<tr>
	<td><font class=small1>�з�����</td>
	<td><script>new categoryBox('cate[]',4,'<?=$category?>');</script></td>
</tr>
<tr>
	<td><font class=small1>�˻���</td>
	<td>
	<select name=skey>
	<? foreach ( array('goodsnm'=>'��ǰ��','a.goodsno'=>'������ȣ','goodscd'=>'��ǰ�ڵ�','keyword'=>'����˻���') as $k => $v) { ?>
		<option value="<?=$k?>" <?=($k == $_GET['skey']) ? 'selected' : ''?>><?=$v?></option>
	<? } ?>
	<? unset($k,$v) ?>
	</select>
	<input type=text name=sword class=lline value="<?=$_GET[sword]?>" class="line">
	</td>
</tr>
<tr>
	<td><font class=small1>���</td>
	<td>
	<input type="text" name="minQuantity" class="line" value="<?=$_GET['minQuantity']?>" style="width:50px;"> �� ���� (�Է°��� ������ ��ü ���ڵ带 ��ȸ�մϴ�)
	</td>
</tr>
</table>


<div class=button_top><input type=image src="../img/btn_search2.gif"></div>

<table width=100% cellpadding=0 cellspacing=0>
<tr>
	<td class=pageInfo><font class=ver8>
	�� <b><?=$total?></b>��, �˻� <b><?=$pg->recode[total]?></b>��, <b><?=$pg->page[now]?></b> of <?=$pg->page[total]?> Pages
	</td>
	<td align=right>

	<table cellpadding=0 cellspacing=0 border=0>
	<tr>
		<td style="padding-left:20px">
		<img src="../img/sname_output.gif" align=absmiddle>
		<select name=page_num onchange="this.form.submit()">
		<?
		$r_pagenum = array(10,20,40,60,100);
		foreach ($r_pagenum as $v){
		?>
		<option value="<?=$v?>" <?=($v == $_GET['page_num']) ? 'selected' : ''?>><?=$v?>�� ���
		<? } ?>
		</select>
		</td>
	</tr>
	</table>

	</td>
</tr>
</table>
</form>
<!-- ��ǰ������� : end -->

<form name="fmList" method="post" action="./indb.php" target="_self">
<input type=hidden name=mode value="quickstock">



<table width=100% cellpadding=0 cellspacing=0 border=0>
<tr><td class=rnd colspan=12></td></tr>
<tr class=rndbg>
	<th width=60><a href="javascript:chkBox(document.getElementsByName('chk[]'),'rev')" class=white><font class=small1><b>��ü����</a></th>
	<th><font class=small1><b>��ȣ</th>
	<th><font class=small1><b></th>
	<th><font class=small1><b>��ǰ��</th>
	<th><font class=small1><b>�ɼ�1</th>
	<th><font class=small1><b>�ɼ�2</th>

	<th><font class=small1><b>���</th>
</tr>
<tr><td class=rnd colspan=12></td></tr>
<col width=35><col width=50><col width=50><col><col width=70 span=5><col width=60><col width=35>
<?
while (is_resource($res) && $data=$db->fetch($res)){
	$disabledStock = ($purchaseSet['usePurchase'] == "Y") ? "disabled" : "";
?>
<tr><td height=4 colspan=12></td></tr>
<tr>
	<td align=center class="noline"><input type=checkbox name=chk[] value="<?=$data[sno]?>" onclick="iciSelect(this)"></td>

	<td align=center><font class="ver8" color="#616161"><?=$pg->idx--?></td>
	<td><a href="../../goods/goods_view.php?goodsno=<?=$data[goodsno]?>" target=_blank><?=goodsimg($data[img_s],40,'',1)?></a></td>
	<td><a href="javascript:popup('popup.register.php?mode=modify&goodsno=<?=$data[goodsno]?>',825,600)"><font class=small1 color=0074BA><?=$data[goodsnm]?></font></a></td>

	<td align=center><font class=small color=555555><?=$data[opt1]?></td>
	<td align=center><font class=small color=555555><?=$data[opt2]?></td>

	<td align=center>
	<input type="hidden" name="target[]" value="<?=$data['sno']?>">
	<input type="text" name="stock[]" value="<?=number_format($data['stock'])?>" <?=$disabledStock?> class=lline style="text-align:center;width:60px" tabindex="6">
	</td>

</tr>
<tr><td height=4></td></tr>
<tr><td colspan=12 class=rndline></td></tr>
<? } ?>
</table>

<table width=100% cellpadding=0 cellspacing=0 border=0>
<tr><td width=6% style="padding-left:12">
	<a href="javascript:chkBox(document.getElementsByName('chk[]'),'rev')"><img src="../img/btn_allchoice.gif"></a>
	<!--a href="javascript:fnDeleteCheckedRow();"><img src="../img/btn_all_delet.gif"></a-->
</td>
<td width=88% align=center><div class=pageNavi><font class=ver8><?=$pg->page[navi]?></font></div></td>
<td width=6%></td>
</tr></table>


<table class=tb style="margin:30px 0;">
<col class=cellC><col class=cellL>



<tr height=35>

	<td>
	���� ��ǰ�� ���
	<select name="stock_modifier">
	<option value="equal">=</option>
	<option value="plus">+</option>
	<option value="minus">-</option>
	</select>
	<input type="text" name="stock_new" value="<?=number_format($data[stock])?>" class=lline style="text-align:center;width:60px" tabindex="6"> ���� <img src="../img/btn_enter02.gif" class="hand" onClick="fnSetStock();" align="absmiddle">

	</td>
</tr>

</table>








<div class=button_top><input type=image src="../img/btn_modify.gif"></div>

</form>

<div id=MSG01>
<table cellpadding=1 cellspacing=0 border=0 class=small_ex>
<tr><td><img src="../img/icon_list.gif" align="absmiddle">�ҷ��� ��� ���� ��ǰ�� ����Ʈ�� Ȯ���Ͽ� ���� �� �� �ֽ��ϴ�.</td></tr>
<tr><td><img src="../img/icon_list.gif" align="absmiddle">������ �Է� �� �� �˻� �ϸ� �Է��� �� ��ŭ ���� ��ǰ�� ����Ʈ�� ���ĵ˴ϴ�.</td></tr>
<tr><td><img src="../img/icon_list.gif" align="absmiddle">�� ��ǰ���� ����� ������ �� ������, ���� ���� ��ǰ�� ������ �� ������ ������ �����Ͽ� ������ ���� �ֽ��ϴ�.</td></tr>
<tr><td><img src="../img/icon_list.gif" align="absmiddle">���û�ǰ�� ��� ������ ��ǰ�� ��� ������ �Է��Ͻð� ���Է¡���ư�� Ŭ���ϸ� ������ ��ǰ�� ����� ����˴ϴ�.</td></tr>
<tr><td><img src="../img/icon_list.gif" align="absmiddle">����������ư�� ������ ���°� ���θ� �������� �ݿ��˴ϴ�.</td></tr>

</table>
</div>
<script>cssRound('MSG01')</script>











<? include "../_footer.php"; ?>
