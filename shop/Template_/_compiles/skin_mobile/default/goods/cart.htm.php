<?php /* Template_ 2.2.7 2012/11/24 14:41:56 /www/loosfly_godo_co_kr/shop/data/skin_mobile/default/goods/cart.htm 000000978 */ ?>
<?php $this->print_("header",$TPL_SCP,1);?>


<?php  $TPL_VAR["page_title"] = "장바구니";?>
<?php $this->print_("sub_header",$TPL_SCP,1);?>


<script>
function act(mode)
{
	var fm = document.frmCart;
	if (isChked('idx[]')){
		fm.mode.value = mode;
		fm.submit();
	}
}
</script>

<section id="cart">
	<form name="frmCart" method="post">
	<input type="hidden" name="mode" value="modItem" />
	<?php echo $this->define('tpl_include_file_1',"proc/orderitem.htm")?> <?php $this->print_("tpl_include_file_1",$TPL_SCP,1);?>


<?php if(count($TPL_VAR["cart"]->item)){?>
	<div class="button clearb center">
		<a href="../ord/order.php" class="allorder"><span class="hidden">주문하기</span></a>
	</div>
<?php }?>

	</form>

	<?php echo $TPL_VAR["naverCheckout"]?>


</section>

<?php $this->print_("footer",$TPL_SCP,1);?>