<?php /* Template_ 2.2.7 2012/10/04 18:27:50 /www/loosfly_godo_co_kr/shop/data/skin_mobile/default/index.htm 000002193 */  $this->include_("dataDisplayGoodsMobile");?>
<?php $this->print_("header",$TPL_SCP,1);?>


<?php if($GLOBALS["cfgMobileShop"]["mobileShopMainBanner"]){?>
<div class="main_banner"><img src="<?php echo $GLOBALS["cfg"]["rootDir"]?>/data/skin_mobile/<?php echo $GLOBALS["cfgMobileShop"]["tplSkinMobile"]?>/<?php echo $GLOBALS["cfgMobileShop"]["mobileShopMainBanner"]?>" alt="메인배너이미지" /></div>
<hr class="hidden" />
<?php }?>



<!-- 상품 리스트 #1 -->
<?php if($GLOBALS["cfg_mobile_step"][ 0]["chk"]){?>
<section id="main_goods_display_1" class="goods_display">
<div class="title"><img src="/shop/data/skin_mobile/default/common/img/main_newitem.gif"></div>
<!--<h4><?php echo $GLOBALS["cfg_mobile_step"][ 0]["title"]?></h4>-->
<?php echo $this->assign('loop',dataDisplayGoodsMobile( 0,$GLOBALS["cfg_mobile_step"][ 0]["img"],$GLOBALS["cfg_mobile_step"][ 0]["page_num"]))?>

<?php echo $this->assign('size',$GLOBALS["cfg"][$GLOBALS["cfg_mobile_step"][ 0]["img"]])?>

<?php echo $this->assign('id',"main_list_01")?>

<?php echo $this->define('tpl_include_file_1',"goods/list/".$GLOBALS["cfg_mobile_step"][ 0]["tpl"].".htm")?> <?php $this->print_("tpl_include_file_1",$TPL_SCP,1);?>

</section>
<?php }?>

<!-- 상품 리스트 #2 -->
<?php if($GLOBALS["cfg_mobile_step"][ 1]["chk"]){?>
<section id="main_goods_display_2" class="goods_display">
<div class="title"><img src="/shop/data/skin_mobile/default/common/img/main_bestitem.gif"></div>
<!--<h4><?php echo $GLOBALS["cfg_mobile_step"][ 1]["title"]?></h4>-->
<?php echo $this->assign('loop',dataDisplayGoodsMobile( 1,$GLOBALS["cfg_mobile_step"][ 1]["img"],$GLOBALS["cfg_mobile_step"][ 1]["page_num"]))?>

<?php echo $this->assign('size',$GLOBALS["cfg"][$GLOBALS["cfg_mobile_step"][ 1]["img"]])?>

<?php echo $this->assign('id',"main_list_02")?>

<?php echo $this->define('tpl_include_file_2',"goods/list/".$GLOBALS["cfg_mobile_step"][ 1]["tpl"].".htm")?> <?php $this->print_("tpl_include_file_2",$TPL_SCP,1);?>

</section>
<?php }?>


<?php $this->print_("footer",$TPL_SCP,1);?>