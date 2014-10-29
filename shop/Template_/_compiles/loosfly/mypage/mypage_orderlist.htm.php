<?php /* Template_ 2.2.7 2013/10/31 17:23:28 /www/loosfly_godo_co_kr/shop/data/skin/loosfly/mypage/mypage_orderlist.htm 000003207 */ 
$TPL_loop_1=empty($TPL_VAR["loop"])||!is_array($TPL_VAR["loop"])?0:count($TPL_VAR["loop"]);?>
<?php $this->print_("header",$TPL_SCP,1);?>

<?php if($this->tpl_['side_inc']){?>
		<div class="blkLeftMenu">
<?php $this->print_("side_inc",$TPL_SCP,1);?>

		</div>
<?php }?>
		<div id="blkContents">
			<div style="height:7px;"></div>
			<!-- 상단이미지 -->
			<div id="bxBodyTitle">
				<img src="/shop/data/skin/loosfly/img/jimmy/titles/tracking_title_01.gif" border="0">			
			</div>
			<div class="divindiv"><!-- Start indiv -->
			<script>
				function order_confirm(ordno) {
					var fm = document.frmOrderList;
					fm.mode.value = "confirm";
					fm.ordno.value = ordno;
					fm.action = "indb.php";
					if (confirm('주문하신 상품을 수령하셨습니까?')) fm.submit();
				}
			</script>
			
			<form name=frmOrderList method=post>
			<input type=hidden name=mode>
			<input type=hidden name=ordno>			
			<div style="height:20px;"></div>
			<table width="860" cellpadding="0" cellspacing="0" border="0">
				<tr><td height="2" bgcolor="#303030" colspan="10"></td></tr>
				<tr bgcolor="#F0F0F0" height="23" class="input_txt" align="center">
					<th>번호</th>
					<th>구분</th>
					<th>주문일시</th>
					<th>주문번호</th>
					<th>결제방법</th>
					<th>주문금액</th>
					<th>취소금액</th>
					<th>주문상태</th>
					<th>수령확인</th>
					<th>상세보기</th>
				</tr>
				<tr><td height=1 bgcolor="#D6D6D6" colspan=10></td></tr>
<?php if($TPL_loop_1){$TPL_I1=-1;foreach($TPL_VAR["loop"] as $TPL_V1){$TPL_I1++;?>
				<tr>
					<td height=30 align=center><?php echo $TPL_VAR["pg"]->idx-$TPL_I1?></td>
					<td align=center><?php echo $TPL_V1["ordertypestr"]?></td>
					<td align=center><?php echo $TPL_V1["orddt"]?></td>
					<td align=center><a href="<?php echo url("mypage/mypage_orderview.php?")?>&ordno=<?php echo $TPL_V1["ordno"]?>"><?php echo $TPL_V1["ordno"]?></a></td>
					<td align=center><?php echo $TPL_V1["str_settlekind"]?></td>
					<td align=right style="padding-right:20">\<?php echo number_format($TPL_V1["settleprice"])?></td>
					<td align=right style="padding-right:20"><?php echo number_format($TPL_V1["canceled_price"])?></td>
					<td align=center class=stxt><FONT COLOR="#007FC8"><?php echo $TPL_V1["str_step"]?></FONT></td>
					<td align=center>
<?php if($TPL_V1["step"]== 3&&!$TPL_V1["step2"]){?>
						<a href="javascript:order_confirm(<?php echo $TPL_V1["ordno"]?>)"><img src="/shop/data/skin/loosfly/img/common/btn_receive.gif"></a>
<?php }elseif($TPL_V1["escrowconfirm"]== 2){?>수령
<?php }?>
					</td>
					<td align=center><a href="<?php echo url("mypage/mypage_orderview.php?")?>&ordno=<?php echo $TPL_V1["ordno"]?>"><img src="/shop/data/skin/loosfly/img/common/btn_detailview.gif"></a></td>
				</tr>
				<tr><td colspan=10 height=1 bgcolor="#ECECEC"></td></tr>
<?php }}?>
			</table>
			
			<div class="pagediv"><?php echo $TPL_VAR["pg"]->page['navi']?></div>
			
			</form>
			</div><!-- End indiv -->		
		</div>
<?php $this->print_("footer",$TPL_SCP,1);?>