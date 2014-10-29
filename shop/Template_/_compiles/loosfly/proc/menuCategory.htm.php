<?php /* Template_ 2.2.7 2013/04/25 16:39:45 /www/loosfly_godo_co_kr/shop/data/skin/loosfly/proc/menuCategory.htm 000003316 */  $this->include_("dataCategory");?>
<div id="side_menu_block">
	<!--div><img src="/shop/data/skin/loosfly/img/main/sid_title.gif"></div-->

	<div style="padding:20px 0px 20px 38px;text-align:left;font:bold 36px 'Courier New'; letter-spacing:-2">sh<font color="#71cbd2">o</font>p.</div>

<?php if($GLOBALS["cfg"]["subCategory"]!= 1){?>
	<table width="100%" cellpadding=0 cellspacing=0 border=0 id="menuLayer">
<?php if(is_array($TPL_R1=dataCategory($GLOBALS["cfg"]["subCategory"], 2))&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?>
	<tr>
		<td class="catebar"><a href="<?php echo url("goods/goods_list.php?")?>&category=<?php echo $TPL_V1["category"]?>"><?php echo $TPL_V1["catnm"]?></a></td>
		<td style="z-index:100">
<?php if($TPL_V1["sub"]){?>
		<div style="position:relative"><div class=subLayer><table width=100% cellspacing=1>
<?php if(is_array($TPL_R2=$TPL_V1["sub"])&&!empty($TPL_R2)){$TPL_S2=count($TPL_R2);$TPL_I2=-1;foreach($TPL_R2 as $TPL_V2){$TPL_I2++;?>
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
	<table width=100% cellpadding=0 cellspacing=0 class="shop_side">
	<?PHP $num_row=0;  ?>
<?php if(is_array($TPL_R1=dataCategory($GLOBALS["cfg"]["subCategory"], 1))&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?>
	<?PHP $num_row+=3; ?>
<?php if($TPL_V1["sub"]){?><?PHP $num_row+=2; ?><?php }?>
<?php }}?>

	<?PHP $num_menus = 0; ?>
	<tr><td width="38" rowspan="<?PHP echo $num_row; ?>"></td><td></td></tr>
<?php if(is_array($TPL_R1=dataCategory($GLOBALS["cfg"]["subCategory"], 1))&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?>
	<tr><td class="vspace15"></td></tr>
	<tr>
		<td class="menu01" valign="top"><a href="<?php echo url("goods/goods_list.php?")?>&category=<?php echo $TPL_V1["category"]?>"><div onMouseOver="menu_action(true, 2, <?PHP echo $num_menus; ?>, this);" onMouseOut="menu_action(false, 2, <?PHP echo $num_menus++; ?>, this);"><script> document.write( get_emenu("<?php echo $TPL_V1["catnm"]?>") ); </script></div></a></td>
	</tr>
	<tr><td><div class="separator" style="width:170px;background-color:#cfcfcf; float:left;"></div></td></tr>
<?php if($TPL_V1["sub"]){?>
	<tr>
		<td class="menu02">
		<table width="100%">
<?php if(is_array($TPL_R2=$TPL_V1["sub"])&&!empty($TPL_R2)){foreach($TPL_R2 as $TPL_V2){?>
		<tr><td class="menu_item"><a href="<?php echo url("goods/goods_list.php?")?>&category=<?php echo $TPL_V2["category"]?>"><div onMouseOver="menu_action(true, 2, <?PHP echo $num_menus; ?>, this);" onMouseOut="menu_action(false, 2, <?PHP echo $num_menus++; ?>, this);"><script> document.write( get_emenu("<?php echo $TPL_V2["catnm"]?>"));</script></div></a></td></tr>
<?php }}?>
		</table>
		</td>
	</tr>
	<tr><td class="vspace20"></td></tr>
<?php }?>
<?php }}?>
	</table>
<?php }?>

</div>