<?php /* Template_ 2.2.7 2014/10/21 13:34:26 /www/loosfly_godo_co_kr/shop/data/skin/loosfly/goods/list/tpl_01-test.htm 000003206 */ 
if (is_array($TPL_VAR["loop"])) $TPL_loop_1=count($TPL_VAR["loop"]); else if (is_object($TPL_VAR["loop"]) && in_array("Countable", class_implements($TPL_VAR["loop"]))) $TPL_loop_1=$TPL_VAR["loop"]->count();else $TPL_loop_1=0;?>
<?php if(!$TPL_VAR["id"]){?><?  $TPL_VAR["id"] = "es_".md5(crypt('')); ?><?php }?>
<!-- 상품 리스트 -->
		<div style="height:10px"></div>
		<div class="bxGalaryStyle">
<?PHP $cnt=0; ?>
			<table width="100%" cellpadding="0" cellspacing="0" border="0">
			<tr>
<?php if($TPL_loop_1){foreach($TPL_VAR["loop"] as $TPL_V1){?>	
				<td width="20%" valign="top" align="center">
<?PHP 
	$kr_name =  $TPL_V1["shortdesc"];
	parse_str($kr_name);
	$en_name =  $TPL_V1["goodsnm"];
	$id = "nm". $TPL_V1["goodscd"];
?>
					<div class="galary_item" onclick="location.href='<?php echo $TPL_V1["goods_view_url"]?>'" onmouseover="document.getElementById('<?=$id?>').innerHTML='<?=$kr_name?>'" onmouseout="document.getElementById('<?=$id?>').innerHTML='<?=$en_name?>'">
					<?php echo goodsimg($TPL_V1["img_s"],$TPL_VAR["size"],'class="'.$TPL_V1["css_selector"].'"')?>

<?php if($TPL_V1["soldout_icon"]){?>
					<div class="sold_out">out of stock</div>
<?php }elseif($TPL_V1["icon"]){?>
		<?PHP $pos = strpos( $TPL_V1["icon"], "icon_new"); if( $pos != false )  { ?>
					<span class="new_arrival">NEW</span>
		<?PHP } ?>
<?php }?>
					<div style="height:5px"></div>
<?php if($TPL_V1["goodsnm"]){?><div class="galary_name" id="<?=$id?>"><?php echo $TPL_V1["goodsnm"]?></div><?php }?>
<?php if(!$TPL_V1["strprice"]){?>
<?php if($TPL_V1["price"]){?>
						<!--div class="galary_price"><?php echo number_format($TPL_V1["price"])?>원<?php if($TPL_V1["special_discount_amount"]){?><img src="/shop/data/skin/loosfly/img/icon/goods_special_discount.gif"><?php }?></div-->
						<div class="galary_price"><b><span id=price><?php echo number_format($TPL_V1["price"])?></span>원</b><?php if($TPL_V1["consumer"]&&($TPL_V1["consumer"]-$TPL_V1["price"])> 0){?>&nbsp;(<span style="color:#ff4c5d"><?PHP echo intval(( $TPL_V1["consumer"] -  $TPL_V1["price"])/ $TPL_V1["consumer"]*100); ?>%↓</span>)<?php }?></div>
<?php }?>
<?php }else{?>
					<div class="galary_price"><?php echo $TPL_V1["strprice"]?></div>
<?php }?>
<?php if($TPL_V1["coupon"]){?><div class="galary_coupon"><?php echo $TPL_V1["coupon"]?><font class=small>원</font><img src="/shop/data/skin/loosfly/img/icon/good_icon_coupon.gif" align=absmiddle></div><?php }?>	
					</div>
				</td>
<?PHP 
$cnt++;
	if ($cnt%5 == 0) { 
?>
				</tr>
				<tr>
<?PHP  } ?>
<?php }}?>
				</tr>
			</table>
		</div>

<!-- 품절상품 마스크 -->
<div id="el-goods-soldout-image-mask" style="display:none;position:absolute;top:0;left:0;background:url(<?php if($GLOBALS["cfg_soldout"]["display_overlay"]=='custom'){?>../data/goods/icon/custom/soldout_overlay<?php }else{?>../data/goods/icon/icon_soldout<?php echo $GLOBALS["cfg_soldout"]["display_overlay"]?><?php }?>) no-repeat center center;"></div>
<script>
addOnloadEvent(function(){ setGoodsImageSoldoutMask() });
</script>