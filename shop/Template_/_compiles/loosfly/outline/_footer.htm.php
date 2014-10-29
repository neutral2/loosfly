<?php /* Template_ 2.2.7 2014/04/22 13:29:36 /www/loosfly_godo_co_kr/shop/data/skin/loosfly/outline/_footer.htm 000001080 */ ?>
</div>
	<div id="dsFooter">
<?php $this->print_("footer_inc",$TPL_SCP,1);?>

	</div>
</div>
<!-- 절대! 지우지마세요 : Start -->
<iframe name="ifrmHidden" src='<?php echo $GLOBALS["cfg"]["rootDir"]?>/blank.php' style="display:none;width:100%;height:600"></iframe>
<!-- 절대! 지우지마세요 : End -->

<script>
	if (typeof nsGodo_cartTab == 'object' && '<?php echo $GLOBALS["cfg"]["cartTabUse"]?>' == 'y' && '<?php echo $TPL_VAR["todayshop_cfg"]['shopMode']?>' != 'todayshop') {
		nsGodo_cartTab.init({	logged: <?php if(!$GLOBALS["sess"]){?>false<?php }else{?>true<?php }?>, skin  : '<?php echo $GLOBALS["cfg"]["tplSkin"]?>', tpl  : '<?php echo $GLOBALS["cfg"]["cartTabTpl"]?>', dir	: 'horizon',	/* horizon or vertical */ width:'<?php echo $GLOBALS["cfg"]["shopSize"]?>' });
	}
<?php if($GLOBALS["cfg"]["preventContentsCopy"]=='1'){?>
							//		addOnloadEvent(function(){ preventContentsCopy() });
<?php }?>
</script>

</body>
</html>