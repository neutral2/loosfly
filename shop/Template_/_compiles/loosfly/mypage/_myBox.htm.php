<?php /* Template_ 2.2.7 2013/12/16 18:59:11 /www/loosfly_godo_co_kr/shop/data/skin/loosfly/mypage/_myBox.htm 000002847 */ ?>
<table width="160" cellpadding="2" cellspacing="0" border="0" align="center">
<!--	<tr align="left"> -->
<!--		<td class="menu_item" width="80"> ȸ���׷� -->
<?php if($GLOBALS["sess"]["dc_type"]!='N'||$GLOBALS["sess"]["add_emoney_type"]!='N'||$GLOBALS["sess"]["free_deliveryfee"]!='N'){?>
<!--			<br/> -->
<!--			&nbsp;&nbsp;&nbsp;<a href="javascript: member_grp_pop();"><img src="/shop/data/skin/loosfly/img/common/btn_benefit.gif"></a> -->
<?php }?>
<!--		</td> -->
<!--		<td> -->
<!--			<?php if($GLOBALS["sess"]["grpnm_disp_type"]=='icon'){?><img src="../data/member/icon/<?php echo $GLOBALS["sess"]["grpnm_icon"]?>"><?php }?> : <?php echo $GLOBALS["sess"]["grpnm"]?> -->
<!--		</td> -->
<!--	</tr> -->
	<tr align="left">
		<td class="menu_item" style="width:80px;"> �ѱ��ž�</td>
		<td>: <font class=v71 color=#f47d30><?php echo number_format($GLOBALS["sess"]["sum_sale"])?></font> ��</td>
	</tr>
	<tr align="left">
		<td class="menu_item"> ������</td>
		<td>: <font class=v71 color=#f47d30><?php echo number_format($GLOBALS["sess"]["emoney"])?></font> ��</td>
	</tr>
	<tr align="left">
		<td class="menu_item"> ��������</td>
		<td>: <font class=v71 color=#f47d30><?php echo number_format($GLOBALS["sess"]["cnt_coupon"])?></font> ��</td>
	</tr>
	<tr align="left">
		<td class="menu_item"> ��ٱ���</td>
		<td>: <a href="<?php echo url("goods/goods_cart.php")?>&"><font class=v71 color=#f47d30><?php echo number_format($GLOBALS["sess"]["cart_count"])?></font></a> ��</td>
	</tr>
	<tr align="left">
		<td class="menu_item"> ���ø���Ʈ</td>
		<td>: <a href="<?php echo url("mypage/mypage_wishlist.php")?>&"><font class=v71 color=#f47d30><?php echo number_format($GLOBALS["sess"]["wish_count"])?></font></a> ��</td>
	</tr>
</table>



<script type="text/javascript">
	function member_grp_pop (grp_sno){
		fnMyMemberGrpBpxPosition(296, 200);
	}
	
	function fnMyMemberGrpBpxPosition(w,h) {	// ����, ����
		var _doc_size = {
			width : document.body.scrollWidth || document.documentElement.scrollWidth,
			height: document.body.scrollHeight || document.documentElement.scrollHeight
		}
	
		var _win_size = {
			width : window.innerWidth	|| (window.document.documentElement.clientWidth	|| window.document.body.clientWidth),
			height: window.innerHeight	|| (window.document.documentElement.clientHeight|| window.document.body.clientHeight)
		}
		
		with (document.getElementById('MyMemberGrpBpx').style) {
			position = "absolute";
			width = w + 'px';
			height = h + 'px';
			zIndex = 10000;
			left = (_win_size.width + w) / 2.7 - w  + 'px';
			top = ((_win_size.height + h) / 2.7 - h) + document.body.scrollTop + 'px'
			display = "block";
		};
	}
</script>