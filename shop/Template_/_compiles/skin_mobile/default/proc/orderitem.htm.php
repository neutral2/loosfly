<?php /* Template_ 2.2.7 2012/10/04 18:27:50 /www/loosfly_godo_co_kr/shop/data/skin_mobile/default/proc/orderitem.htm 000003428 */ ?>
<ul class="order_item_list">
<?php if(is_array($TPL_R1=$TPL_VAR["cart"]->item)&&!empty($TPL_R1)){$TPL_I1=-1;foreach($TPL_R1 as $TPL_V1){$TPL_I1++;?>
	<li>
		<dl>
<?php if($GLOBALS["orderitem_mode"]=="cart"){?>
			<dt class="hidden">����</dt>
			<dd class="oil_chk"><input type=checkbox name=idx[] value="<?php echo $TPL_I1?>" /></dd>
<?php }?>
			<dt class="hidden">��ǰ�̹���</dt>
			<dd class="oil_img"><a href="../goods/view.php?goodsno=<?php echo $TPL_V1["goodsno"]?>"><?php echo goodsimgMobile($TPL_V1["img"], 60)?></a></dd>
			<dt class="hidden">��ǰ��</dt>
			<dd class="oil_name"><a href="../goods/view.php?goodsno=<?php echo $TPL_V1["goodsno"]?>"><?php echo strcut($TPL_V1["goodsnm"], 100)?></a></dd>
			<dt class="hidden">�ɼ�</dt>
			<dd class="oil_option">
<?php if($TPL_V1["opt"]){?><div>[<?php echo implode("/",$TPL_V1["opt"])?>]</div><?php }?>
<?php if(is_array($TPL_R2=$TPL_V1["addopt"])&&!empty($TPL_R2)){foreach($TPL_R2 as $TPL_V2){?><div>[<?php echo $TPL_V2["optnm"]?>:<?php echo $TPL_V2["opt"]?>]</div><?php }}?>
			</dd>
<?php if($TPL_V1["delivery_type"]){?>
			<dt class="oil_delivery_title blt">��ۺ� : </dt>
			<dd class="oil_delivery">
<?php if($TPL_V1["delivery_type"]== 1){?>
				<div>(������)</div>
<?php }elseif($TPL_V1["delivery_type"]== 2&&$TPL_V1["goods_delivery"]){?>
				<div>(������� : <?php echo number_format($TPL_V1["goods_delivery"])?>�� )</div>
<?php }elseif($TPL_V1["delivery_type"]== 3&&$TPL_V1["goods_delivery"]){?>
				<div>(���ҹ�� : <?php echo number_format($TPL_V1["goods_delivery"])?>�� )</div>
<?php }?>
			</dd>
<?php }?>
			<dt class="oil_price_title blt">�ǸŰ� : </dt>
			<dd class="oil_price"><?php echo number_format($TPL_V1["price"]+$TPL_V1["addprice"])?>��</dd>
			<dt class="oil_reserve_title blt">������ : </dt>
			<dd class="oil_reserve"><?php echo number_format($TPL_V1["reserve"])?>��</dd>
			<dt class="oil_ea_title blt">���� : </dt>
			<dd class="oil_ea">
<?php if($GLOBALS["orderitem_mode"]=="cart"){?>
				<table cellpadding=0 cellspacing=0 border=0>
				<tr>
					<td><input type=text name=ea[] size=2 value="<?php echo $TPL_V1["ea"]?>" class=line style="text-align:right;" onkeydown="onlynumber()"></td>
					<td>&nbsp;<input type=image src="/shop/data/skin_mobile/default/common/img/sbtn_mod.gif"></td>
				</tr>
				</table>
<?php }else{?>
				<?php echo $TPL_V1["ea"]?>��
<?php }?>
			</dd>
			<dt class="oil_total_title blt">�հ� : </dt>
			<dd class="oil_total"><?php echo number_format(($TPL_V1["price"]+$TPL_V1["addprice"])*$TPL_V1["ea"])?>��</dd>
		</dl>
	</li>
<?php }}?>
</ul>

<?php if($GLOBALS["orderitem_mode"]=="cart"){?>
<ul class="button">
	<li><a href="javascript:chkBox('idx[]','rev')" class="chkall"><span>��ü����</span></a></li>
	<li><a href="javascript:act('delItem')" class="chkdel"><span>���û���</span></a></li>
	<li><a href="cart.php?mode=empty" class="cartclear"><span>����</span></a></li>
</ul>
<?php }?>

<div class="order_item_total">
	<table>
	<tr>
		<th>��ǰ�հ�ݾ� :</th>
		<td class="price"><?php echo number_format($TPL_VAR["cart"]->goodsprice)?>��</td>
	</tr>
	<tr>
		<th>������������ :</th>
		<td><?php echo number_format($TPL_VAR["cart"]->bonus)?>��</td>
	</tr>
	</table>
	<div class="clearb"></div>
</div>