<?php /* Template_ 2.2.7 2013/04/16 10:58:59 /www/loosfly_godo_co_kr/shop/data/skin/loosfly/setGoods/content.htm 000004855 */ 
if (is_array($TPL_VAR["Iobj"])) $TPL_Iobj_1=count($TPL_VAR["Iobj"]); else if (is_object($TPL_VAR["Iobj"]) && in_array("Countable", class_implements($TPL_VAR["Iobj"]))) $TPL_Iobj_1=$TPL_VAR["Iobj"]->count();else $TPL_Iobj_1=0;?>
<?php if($TPL_VAR["state"]=='N'){?>
	<script>alert('진열되지 않은 코디상품 입니다.'); location.href="../setGoods/";</script>
<?php }?>
<!-- 절대! 지우지마세요 : Start -->
<?php $this->print_("h_include_item",$TPL_SCP,1);?>

<!-- 절대! 지우지마세요 : End -->
<?php $this->print_("header",$TPL_SCP,1);?>

<link rel="styleSheet" href="/shop/data/skin/loosfly/setGoods/css/content.css">
<script type="text/javascript" src="/shop/setGoods/js/content.js"></script>
<!--container -->
<div id="container">
	<div class="title"><img src="/shop/data/skin/loosfly/setGoods/img/front/title_cody.gif" /></div>
	<div class="path" style="float:right;margin:30px 28px 0 0;vertical-align:text-bottom;">HOME > <a href="../setGoods/">코디상품 리스트</a> > <B>코디상품 상세페이지</B></div>
	<div class="clear"></div>

	<div class="codi-left">
		<div class="codi-bg">
			<div class="codi-area">
				<?php echo html_entity_decode($TPL_VAR["obj"][ 0]["CD_content"])?>

			</div>
		</div>
		<div class="codi-info"><?php echo nl2br($TPL_VAR["obj"][ 0]["memo"])?></div>
		
		<div class="codiSymbol">
			<div style="float:left;">
				<span class="icon"><img src='/shop/data/skin/loosfly/setGoods/img/front/icon_comment.gif' style="vertical-align:middle;"/><?php echo $TPL_VAR["obj"][ 0]["recody_cnt"]?></span>
				<span class="icon"><img src='/shop/data/skin/loosfly/setGoods/img/front/icon_likeit.gif' style="vertical-align:middle;"/><?php echo $TPL_VAR["obj"][ 0]["like_cnt"]?></span>
			</div>
			<div class="likeBtn"><a href="javascript:" onclick="like_cnt('<?php echo $TPL_VAR["obj"][ 0]["idx"]?>')" ><img src="/shop/data/skin/loosfly/setGoods/img/front/btn_likeit.gif" /></a></div>
			<div class="clear"></div>
		</div>
		
<?php if($TPL_VAR["setGConfig"]["means"]!= 4){?>
			<div id="relationCody" class="relationCody"></div>
<?php }?>
		
<?php if($TPL_VAR["setGConfig"]["memo"]=='Y'){?>
			<div id="comment" name="comment"></div>
<?php }?>
		 
	</div>

	<div class="codi-right">
		<div class="codi-right-top-bg">
			<div class="setName">
				<?php echo $TPL_VAR["obj"][ 0]["cody_name"]?>

			</div>
			<div class="setitemTotal"><b><?php echo count($TPL_VAR["Iobj"])?></b> items</div>
		</div>
		<div class="orderList">
<?php if($TPL_Iobj_1){foreach($TPL_VAR["Iobj"] as $TPL_V1){?>
			<div class="orderList-item" id="image-info<?php echo $TPL_V1["tem_index"]?>" onmouseover="image_highlight('<?php echo $TPL_V1["tem_index"]?>')" onmouseout="UN_image_highlight('<?php echo $TPL_V1["tem_index"]?>')">
				<div class="orderList-item-txt">
					<a href="/shop/goods/goods_view.php?goodsno=<?php echo $TPL_V1["goods_idx"]?>" target="_new"><div class="orderList-item-name"><?php echo strCut(html_entity_decode($TPL_V1["name"]), 50)?></div></a>
					<div class="orderList-item-price" >￦<?php echo number_format($TPL_VAR["price"][$TPL_V1["goods_idx"]])?></div>
				</div>
				<div class="clear"></div>
				<div class="orderList-menuBtn"><a href="javascript:" onclick="Load_popup.one_action('<?php echo $TPL_V1["goods_idx"]?>')"><img src="/shop/data/skin/loosfly/setGoods/img/front/btn_order.gif"/></a>&nbsp;<a href="../setGoods/?cody=<?php echo $TPL_V1["goods_idx"]?>"><img src="/shop/data/skin/loosfly/setGoods/img/front/btn_codymore.gif"/></a></div>
			</div>
<?php }}?>

<?php if($TPL_Iobj_1> 1){?>
			<div class="orderList-totalCost">
				<div class="orderList-total">Total</div>
				<div class="orderList-cost">￦<?php echo number_format($TPL_VAR["price"]['total'])?></div>
			</div>
			<div class="orderList-buyBtn"><a href="javascript:" onclick="Load_popup.action()"><img src="/shop/data/skin/loosfly/setGoods/img/front/btn_orderall.gif" /></a></div>
<?php }?>
		</div>
		
		<div><img src="/shop/data/skin/loosfly/setGoods/img/front/subright_boxbottom.gif" /></div>
		
		
		<div class="sns">
		<?php echo $TPL_VAR["snsBtn"]?>

		</div>
		
	</div>


	<div class="clear"></div>


</div>
<!--//container -->

<script type="text/javascript">

var idx = '<?php echo $TPL_VAR["idx"]?>';
<?php if($TPL_Iobj_1){foreach($TPL_VAR["Iobj"] as $TPL_V1){?>
	inURL('../goods/goods_view.php?goodsno=<?php echo $TPL_V1["goods_idx"]?>','<?php echo $TPL_V1["tem_index"]?>');
	Load_popup.set('<?php echo $TPL_V1["goods_idx"]?>');	
<?php }}?>

jQuery(window).load(function() {
	load_comment(idx);
<?php if($TPL_VAR["setGConfig"]["means"]!= 4){?>
	relationCody(idx);
<?php }?>
});

</script>
<?php $this->print_("footer",$TPL_SCP,1);?>