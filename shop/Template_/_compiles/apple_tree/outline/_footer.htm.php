<?php /* Template_ 2.2.7 2013/04/16 11:27:25 /www/loosfly_godo_co_kr/shop/data/skin/apple_tree/outline/_footer.htm 000004449 */  $this->include_("dataBanner");
$TPL__todayGoodsList_1=empty($GLOBALS["todayGoodsList"])||!is_array($GLOBALS["todayGoodsList"])?0:count($GLOBALS["todayGoodsList"]);?>
<div style="width:0;height:0;font-size:0"></div></td>
<?php if($this->tpl_['side_inc']&&$GLOBALS["cfg"]['outline_sidefloat']=='right'){?>
<td valign=top width=<?php echo $GLOBALS["cfg"]['shopSideSize']?> nowrap><?php $this->print_("side_inc",$TPL_SCP,1);?></td>
<?php }?>
<?php if($TPL_VAR["todayshop_cfg"]['shopMode']!='todayshop'&&!$TPL_VAR["todayshop_cfg"]['isTodayShopPage']){?>
<td width=0 id=pos_scroll valign=top>

<!-- ��ũ�� ��� -->

<div id=scroll style="position:absolute; padding-top:0; padding-left:10px;">
<?php if($TPL_VAR["setState"]=='Y'&&$TPL_VAR["Banner"]!=''){?>
<div style="text-align:left;"><?php echo $TPL_VAR["Banner"]?></div>
<?php }else{?>
<div><!-- �ǿ�����_��ũ�ѹ�� (��ʰ������� ��������) --><?php if(is_array($TPL_R1=dataBanner( 17))&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?><?php echo $TPL_V1["tag"]?><?php }}?></div>
<?php }?>
<?php if($GLOBALS["viewPageMoveList"]){?>
<script src="/shop/lib/js/prototype.js"></script>
<script language="JavaScript">
addOnloadEvent(function() { scrollCateList_ajax('<?php echo $GLOBALS["_SERVER"]['QUERY_STRING']?>') });
</script>
<div id="scrollMoveList"></div>
<div style="height:4px;"><!-- ���� --></div>
<?php }?>

<div style="width:90px;">
	<div><img src="/shop/data/skin/apple_tree/img/common/sky_btn_todayview.gif" border=0></div>
	<table width=100% border=0 cellpadding=0 cellspacing=0 style="border-style:solid;border-color:#E3E3E3;border-width:0 1px;">
	<tr><td style="text-align:center;padding:5px 0"><a href="javascript:gdscroll(-73)" onfocus=blur()><img src="/shop/data/skin/apple_tree/img/common/sky_btn_up.gif" border=0></a></td></tr>
	<tr>
		<td align=center>
		<div id=gdscroll style="height:216px;overflow:hidden">
<?php if($TPL__todayGoodsList_1){$TPL_I1=-1;foreach($GLOBALS["todayGoodsList"] as $TPL_V1){$TPL_I1++;?>
		<div><a href="<?php echo url("goods/goods_view.php?")?>&goodsno=<?php echo $TPL_V1["goodsno"]?>"><?php echo goodsimg($TPL_V1["img"], 70)?></a></div>
<?php if($TPL_I1!=$TPL__todayGoodsList_1- 1){?><div style="height:3px;font-size:0"></div><?php }?>
<?php }}?>
		</div>
		</td>
	</tr>
	<tr><td style="text-align:center;padding:5px 0"><a href="javascript:gdscroll(73)" onfocus=blur()><img src="/shop/data/skin/apple_tree/img/common/sky_btn_down.gif" border='0'></a></td></tr>
	</table>
</div>
<div style="margin-bottom:5px;">
	<table cellpadding=0 cellspacing=0>
	<tr>
		<td><!-- �ǿ�����_��ũ�ѹ��_top (��ʰ������� ��������) --><?php if(is_array($TPL_R1=dataBanner( 28))&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?><?php echo $TPL_V1["tag"]?><?php }}?></td>
		<td><!-- �ǿ�����_��ũ�ѹ��_back (��ʰ������� ��������) --><?php if(is_array($TPL_R1=dataBanner( 29))&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?><?php echo $TPL_V1["tag"]?><?php }}?></td>
	</tr>
	</table>
</div>

<div><!-- �ǿ�����_��ũ�ѹ�� (��ʰ������� ��������) --><?php if(is_array($TPL_R1=dataBanner( 18))&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?><?php echo $TPL_V1["tag"]?><?php }}?></div>
</div>

<!-- ��ũ�� ��� Ȱ��ȭ -->
<script>scrollBanner();</script>

</td>
<?php }?>
</tr>
</table>

</td>
</tr>
<?php if($this->tpl_['footer_inc']){?>
<tr>
<td><?php $this->print_("footer_inc",$TPL_SCP,1);?></td>
</tr>
<?php }?>
</table>

<!-- ����! ������������ : Start -->
<iframe name="ifrmHidden" src='<?php echo $GLOBALS["cfg"]["rootDir"]?>/blank.php' style="display:none;width:100%;height:600"></iframe>
<!-- ����! ������������ : End -->

<script>
if (typeof nsGodo_cartTab == 'object' && '<?php echo $GLOBALS["cfg"]["cartTabUse"]?>' == 'y' && '<?php echo $TPL_VAR["todayshop_cfg"]['shopMode']?>' != 'todayshop') {
	nsGodo_cartTab.init({
		logged: <?php if(!$GLOBALS["sess"]){?>false<?php }else{?>true<?php }?>,
		skin  : '<?php echo $GLOBALS["cfg"]["tplSkin"]?>',
		tpl  : '<?php echo $GLOBALS["cfg"]["cartTabTpl"]?>',
		dir	: 'horizon',	// horizon or vertical
		width:'<?php echo $GLOBALS["cfg"]["shopSize"]?>'
	});
}
<?php if($GLOBALS["cfg"]["preventContentsCopy"]=='1'){?>
addOnloadEvent(function(){ preventContentsCopy() });
<?php }?>
</script>
</body>
</html>