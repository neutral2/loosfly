<?php /* Template_ 2.2.7 2013/04/16 10:58:39 /www/loosfly_godo_co_kr/shop/data/skin/loosfly/goods/list/tpl_03.htm 000002746 */ 
$TPL_loop_1=empty($TPL_VAR["loop"])||!is_array($TPL_VAR["loop"])?0:count($TPL_VAR["loop"]);?>
<!-- 상품 리스트 -->
<table width=100% border=0 cellpadding=0 cellspacing=0>
<tr>
<?php if($TPL_loop_1){$TPL_I1=-1;foreach($TPL_VAR["loop"] as $TPL_V1){$TPL_I1++;?>
<?php if($TPL_I1&&$TPL_I1%$TPL_VAR["cols"]== 0){?></tr><tr><td height=10></td></tr><tr><td colspan=<?php echo $TPL_VAR["cols"]?> bgcolor=#E6E6E6 height=1></td></tr><tr><td height=10></td></tr><tr><?php }?>
	<td valign=top width="<?php echo  100/$TPL_VAR["cols"]?>%">

	<table>
	<tr>
		<td valign=top><a href="<?php echo $TPL_V1["goods_view_url"]?>"><?php echo goodsimg($TPL_V1["img_s"],$TPL_VAR["size"],'class="'.$TPL_V1["css_selector"].'"')?></a></td>
		<td style="padding-left:5px">
<?php if($TPL_V1["soldout_icon"]){?><div style="padding:3px"><?php if($TPL_V1["soldout_icon"]=='custom'){?><img src="../data/goods/icon/custom/soldout_icon"><?php }else{?><img src="/shop/data/skin/loosfly/img/icon/good_icon_soldout.gif"><?php }?></div><?php }?>
<?php if($TPL_V1["goodsnm"]){?><div style="padding:5px 0"><a href="<?php echo $TPL_V1["goods_view_url"]?>"><?php echo $TPL_V1["goodsnm"]?></a></div><?php }?>
<?php if(!$TPL_V1["strprice"]){?>
<?php if($TPL_V1["price"]){?>
			<div>
<?php if($TPL_V1["consumer"]){?><span style="color:gray"><strike><?php echo number_format($TPL_V1["consumer"])?></strike> →</span><?php }?>
			<b style="color:#C94C00"><?php echo number_format($TPL_V1["price"])?>원</b>
			</div>
<?php }?>
<?php if($TPL_V1["soldout_price_string"]){?><?php echo $TPL_V1["soldout_price_string"]?><?php }?>
<?php if($TPL_V1["soldout_price_image"]){?><?php echo $TPL_V1["soldout_price_image"]?><?php }?>
<?php }else{?><?php echo $TPL_V1["strprice"]?>

<?php }?>
<?php if($TPL_V1["icon"]){?><div style="padding:5px 0"><?php echo $TPL_V1["icon"]?></div><?php }?>
<?php if($TPL_V1["coupon"]){?><div class=eng><b style="color:red"><?php echo $TPL_V1["coupon"]?></b><font class=small><b>원</b></font> <img src="/shop/data/skin/loosfly/img/icon/good_icon_coupon.gif" align=absmiddle></div><?php }?>
		</td>
	</tr>
	</table>
	
	</td>
<?php }}?>
</tr>
</table>

<!-- 품절상품 마스크 -->
<div id="el-goods-soldout-image-mask" style="display:none;position:absolute;top:0;left:0;background:url(<?php if($GLOBALS["cfg_soldout"]["display_overlay"]=='custom'){?>../data/goods/icon/custom/soldout_overlay<?php }else{?>../data/goods/icon/icon_soldout<?php echo $GLOBALS["cfg_soldout"]["display_overlay"]?><?php }?>) no-repeat center center;"></div>
<script>
addOnloadEvent(function(){ setGoodsImageSoldoutMask() });
</script>