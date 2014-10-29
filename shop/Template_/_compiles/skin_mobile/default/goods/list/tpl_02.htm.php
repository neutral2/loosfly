<?php /* Template_ 2.2.7 2012/10/04 18:27:50 /www/loosfly_godo_co_kr/shop/data/skin_mobile/default/goods/list/tpl_02.htm 000001881 */ 
$TPL_loop_1=empty($TPL_VAR["loop"])||!is_array($TPL_VAR["loop"])?0:count($TPL_VAR["loop"]);?>
<!-- 상품 리스트 -->
<ul id="<?php echo $TPL_VAR["id"]?>" class="gl_type_02">
<?php if($TPL_loop_1){foreach($TPL_VAR["loop"] as $TPL_V1){?><li>
		<dl>
			<dt class="hidden">상품이미지</dt>
			<dd class="gl_img"><a href="<?php echo $GLOBALS["cfgMobileShop"]["mobileShopRootDir"]?>/goods/view.php?goodsno=<?php echo $TPL_V1["goodsno"]?>&amp;category=<?php echo $_GET["category"]?>"><?php echo goodsimgMobile(array($TPL_V1["img_mobile"],$TPL_V1["img_i"],$TPL_V1["img_s"],$TPL_V1["img_m"]), 74)?></a></dd>
			<dt class="hidden">상품명</dt>
			<dd class="gl_name"><a href="<?php echo $GLOBALS["cfgMobileShop"]["mobileShopRootDir"]?>/goods/view.php?goodsno=<?php echo $TPL_V1["goodsno"]?>&amp;category=<?php echo $_GET["category"]?>"><?php echo strcut($TPL_V1["goodsnm"], 80)?></a></dd>
			<dt class="hidden">짧은설명</dt>
			<dd class="gl_shordesc"><?php echo strcut($TPL_V1["shortdesc"], 80)?></dd>
			<dt class="gl_price_title blt">상품가격 : </dt>
			<dd class="gl_price"><?php echo number_format($TPL_V1["price"])?>원</dd>
<?php if($TPL_V1["reserve"]){?>
			<dt class="gl_reserve_title blt">적립금 : </dt>
			<dd class="gl_reserve"><?php echo number_format($TPL_V1["reserve"])?>원</dd>
<?php }?>
			<dt class="hidden">상세페이지</dt>
			<dd class="gl_detail"><a href="<?php echo $GLOBALS["cfgMobileShop"]["mobileShopRootDir"]?>/goods/view.php?goodsno=<?php echo $TPL_V1["goodsno"]?>&amp;category=<?php echo $_GET["category"]?>"><span class="hidden">상품 상세페이지로 가기</span></a></dd>
		</dl>
	</li><?php }}?>
<?php if(count($TPL_VAR["loop"])== 0){?>
	<li class="noGoods">
		상품이 존재하지 않습니다.
	</li>
<?php }?>
</ul>