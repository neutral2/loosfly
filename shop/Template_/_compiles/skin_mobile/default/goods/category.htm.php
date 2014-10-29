<?php /* Template_ 2.2.7 2012/10/04 18:27:50 /www/loosfly_godo_co_kr/shop/data/skin_mobile/default/goods/category.htm 000000699 */  $this->include_("dataCategory");?>
<?php $this->print_("header",$TPL_SCP,1);?>


<?php  $TPL_VAR["page_title"] = "카테고리";?>
<?php $this->print_("sub_header",$TPL_SCP,1);?>


<section id="category">
	<ul>
<?php if(is_array($TPL_R1=dataCategory( 0, 1, 1))&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?>
		<li><a href="<?php echo $GLOBALS["cfgMobileShop"]["mobileShopRootDir"]?>/goods/list.php?category=<?php echo $TPL_V1["category"]?>"><?php echo $TPL_V1["catnm"]?></a></li>
<?php }}?>
	</ul>
</section>

<?php $this->print_("footer",$TPL_SCP,1);?>