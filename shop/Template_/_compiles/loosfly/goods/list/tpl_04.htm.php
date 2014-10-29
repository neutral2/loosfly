<?php /* Template_ 2.2.7 2013/04/16 10:58:39 /www/loosfly_godo_co_kr/shop/data/skin/loosfly/goods/list/tpl_04.htm 000003374 */ 
$TPL_loop_1=empty($TPL_VAR["loop"])||!is_array($TPL_VAR["loop"])?0:count($TPL_VAR["loop"]);?>
<?php if(!$TPL_VAR["id"]){?><?  $TPL_VAR["id"] = "es_".md5(crypt('')); ?><?php }?>
<script>
var <?php echo $TPL_VAR["id"]?> = new eScroll;
<?php echo $TPL_VAR["id"]?>.id = "scrolling_<?php echo $TPL_VAR["id"]?>";
<?php echo $TPL_VAR["id"]?>.mode = "left";
<?php echo $TPL_VAR["id"]?>.line = <?php echo $TPL_VAR["cols"]+ 0?>;
<?php echo $TPL_VAR["id"]?>.width = 160;
<?php echo $TPL_VAR["id"]?>.height = 220;
<?php echo $TPL_VAR["id"]?>.align = "center";
<?php echo $TPL_VAR["id"]?>.valign = "top";
<?php echo $TPL_VAR["id"]?>.direction = ("<?php echo $TPL_VAR["dpCfg"]["dOpt4"]?>" === "1") ? 1 : -1;
<?php if($TPL_loop_1){foreach($TPL_VAR["loop"] as $TPL_V1){?>
var tmp = "\
<div><a href='<?php echo $TPL_V1["goods_view_url"]?>' target=_parent><?php echo goodsimg($TPL_V1["img_s"],$TPL_VAR["size"],addslashes('class="'.$TPL_V1["css_selector"].'"'." style='border:1 solid #dfdfdf'"))?></a></div>\
<?php if($TPL_V1["goodsnm"]){?><div style='padding:5'><a href='<?php echo $TPL_V1["goods_view_url"]?>' target=_parent><?php echo addslashes($TPL_V1["goodsnm"])?></a></div><?php }?>\
<?php if(!$TPL_V1["strprice"]){?><?php if($TPL_V1["price"]){?><div><b><?php echo number_format($TPL_V1["price"])?>원</b></div><?php }?><?php if($TPL_V1["soldout_price_string"]){?>-><?php echo addslashes($TPL_V1["soldout_price_string"])?><?php }?><?php if($TPL_V1["soldout_price_image"]){?><?php echo addslashes($TPL_V1["soldout_price_image"])?><?php }?><?php }else{?><?php echo $TPL_V1["strprice"]?><?php }?>\
<?php if($TPL_V1["icon"]){?><div style='padding:5'><?php echo $TPL_V1["icon"]?></div><?php }?>\
<?php if($TPL_V1["coupon"]){?><div class=eng><b style='color:red'><?php echo $TPL_V1["coupon"]?><font class=small><b>원</b></font></b> <img src='/shop/data/skin/loosfly/img/icon/good_icon_coupon.gif' align=absmiddle></div><?php }?>\
";
<?php echo $TPL_VAR["id"]?>.add(tmp);
<?php }}?>
</script>

<table width='100%' cellpadding='0' cellspacing='0' border='0' style="padding:10px 0">
<tr align='center'>
<td valign="top" ><div style="position:relative;"><div style="position:absolute;left:0;top:100;z-index:10"><img src="/shop/data/skin/loosfly/img/main/btn_prev.gif" onmouseover="<?php echo $TPL_VAR["id"]?>.direct(-1)" onclick="<?php echo $TPL_VAR["id"]?>.go()" class=hand></div></div></td>
<td valign="top">
<script><?php echo $TPL_VAR["id"]?>.exec();</script>
</td>
<td valign="top"><div style="position:relative;"><div style="position:absolute;left:-15;top:100;z-index:10"><img src="/shop/data/skin/loosfly/img/main/btn_next.gif" onmouseover="<?php echo $TPL_VAR["id"]?>.direct(1)" onclick="<?php echo $TPL_VAR["id"]?>.go()" class=hand></div></div></td>
</tr>
</table>

<!-- 품절상품 마스크 -->
<div id="el-goods-soldout-image-mask" style="display:none;position:absolute;top:0;left:0;background:url(<?php if($GLOBALS["cfg_soldout"]["display_overlay"]=='custom'){?>../data/goods/icon/custom/soldout_overlay<?php }else{?>../data/goods/icon/icon_soldout<?php echo $GLOBALS["cfg_soldout"]["display_overlay"]?><?php }?>) no-repeat center center;"></div>
<script>
addOnloadEvent(function(){ setGoodsImageSoldoutMask() });
</script>