<?php /* Template_ 2.2.7 2014/10/24 19:37:27 /www/loosfly_godo_co_kr/shop/data/skin/loosfly/outline/side/goodsleft.htm 000003955 */  $this->include_("dataCategory");?>
<?php if($GLOBALS["cfg"]["subCategory"]!= 1){?>
	<table width="100%" cellpadding=0 cellspacing=0 border=0 id="menuLayer">
<?php if((is_array($TPL_R1=dataCategory($GLOBALS["cfg"]["subCategory"], 2))&&!empty($TPL_R1)) || (is_object($TPL_R1) && in_array("Countable", class_implements($TPL_R1)) && $TPL_R1->count() > 0)) {foreach($TPL_R1 as $TPL_V1){?>
	<tr>
		<td class="catebar"><a href="<?php echo url("goods/goods_list.php?")?>&category=<?php echo $TPL_V1["category"]?>"><?php echo $TPL_V1["catnm"]?></a></td>
		<td style="z-index:100">
<?php if($TPL_V1["sub"]){?>
		<div style="position:relative"><div class=subLayer><table width=100% cellspacing=1>
<?php if((is_array($TPL_R2=$TPL_V1["sub"])&&!empty($TPL_R2)) || (is_object($TPL_R2) && in_array("Countable", class_implements($TPL_R2)) && $TPL_R2->count() > 0)) {$TPL_S2=count($TPL_R2);$TPL_I2=-1;foreach($TPL_R2 as $TPL_V2){$TPL_I2++;?>
		<tr><td nowrap class="cate"><a href="<?php echo url("goods/goods_list.php?")?>&category=<?php echo $TPL_V2["category"]?>"><?php echo $TPL_V2["catnm"]?></a></td></tr>
<?php if($TPL_I2!=$TPL_S2- 1){?><tr><td height=1 bgcolor=#F3F2F0></td></tr><?php }?>
<?php }}?>
		</table>
		</div>
		</div>
<?php }?>
		</td>
	</tr>
<?php }}?>
	</table>
<?php if($GLOBALS["cfg"]["subCategory"]){?>
	<script>execSubLayer();</script>
<?php }?>

<?php }else{?>
<?PHP 
	include_once "_loos_category.php";
	global $arr_category_name;
	global $arr_collection_name;
?>

	<div id="left_menu">
		<div style="height:15px;"></div>
		<div class="cat00"><div onMouseOver="overL('��ǰī�װ�', this);" onMouseOut="outL('by category', this);">by Category</div></div>
		<div class="separator"></div>
		<div style="height:10px;"></div>
<?PHP 
	$cnt = count($arr_category_name);
	for( $i = 0; $i < $cnt; $i++ ) {
?>
		<div class="cat01"><a href="/shop/goods/<?=$arr_category_name[$i][2]?>"><div onMouseOver="overS('<?=$arr_category_name[$i][0]?>', this);" onMouseOut="outS('<?=$arr_category_name[$i][1]?>', this);"><?=$arr_category_name[$i][1]?></div></a></div>
		<div style="height:5px;"></div>
<?PHP } ?>
		<div style="height:15px;"></div>
		<div class="cat00"><div onMouseOver="overL('�׸��� �з�', this);" onMouseOut="outL('by collection', this);">by Collection</div></div>
		<div class="separator"></div>
		<div style="height:10px;"></div>
<?PHP 
	$cnt = count($arr_collection_name);
	for( $i = 0; $i < $cnt; $i++ ) {
?>
		<div class="cat01"><a href="/shop/goods/<?=$arr_collection_name[$i][2]?>"><div onMouseOver="overS('<?=$arr_collection_name[$i][0]?>', this);" onMouseOut="outS('<?=$arr_collection_name[$i][1]?>', this);"><?=$arr_collection_name[$i][1]?></div></a></div>
		<div style="height:5px;"></div>
<?PHP } ?>


<?php if((is_array($TPL_R1=dataCategory($GLOBALS["cfg"]["subCategory"], 1))&&!empty($TPL_R1)) || (is_object($TPL_R1) && in_array("Countable", class_implements($TPL_R1)) && $TPL_R1->count() > 0)) {foreach($TPL_R1 as $TPL_V1){?>
<?PHP if ( false ) { // if(  $TPL_V1["category"] == "005") { ?>
		<div style="height:15px;"></div>
		<div class="cat00"><div onMouseOver="overL('�׸��� �з�', this);" onMouseOut="outL('by collection', this);">by Collection</div></div>
		<div class="separator"></div>
		<div style="height:10px;"></div>
<?PHP
//	 }
//	if(  $TPL_V1["category"] != "011") { 
?>
		<div class="cat01"><a href="/shop/goods/goods_list.php?category=<?php echo $TPL_V1["category"]?>"><div onMouseOver="overS('<?php echo $TPL_V1["catnm"]?>', this);" onMouseOut="outS('<?PHP echo str_replace("'", "\'", $lfy_goods_knames[ $TPL_V1["catnm"]]); ?>', this);"><?PHP echo $lfy_goods_knames[ $TPL_V1["catnm"]]; ?></div></a></div>
		<div style="height:5px;"></div>
<?PHP } ?>
<?php }}?>
		<div style="height:20px;"></div>
<?php }?>
	</div>