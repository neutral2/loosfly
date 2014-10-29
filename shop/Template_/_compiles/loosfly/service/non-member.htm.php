<?php /* Template_ 2.2.7 2013/12/16 18:59:12 /www/loosfly_godo_co_kr/shop/data/skin/loosfly/service/non-member.htm 000003586 */ ?>
<?php $this->print_("header",$TPL_SCP,1);?>


<?php if($this->tpl_['side_inc']){?>
		<div class="blkLeftMenu">
<?php $this->print_("side_inc",$TPL_SCP,1);?>

		</div>
<?php }?>
	<div id="blkContents">
		<div style="height:7px;"></div>
		<div class="divindiv"><!-- Start indiv -->
			<!-- 상단이미지 -->
			<div id="bxBodyTitle">
				<img src="/shop/data/skin/loosfly/img/jimmy/titles/nonmember_inquiry_01.gif" border=0>
			</div>

			<div style="height:75px;"></div>
<?php if($TPL_VAR["guest_disabled"]!='y'){?>
			<div style="width:400px;padding:0 230px 0 230px;">
				<table class="post_head" cellspacing="0" cellpadding="0"><tr><td class="htl" nowrap="nowrap"></td><td class="htc"></td><td class="htr" nowrap="nowrap"></td></tr></table>
				<form id=form method=post action="<?php echo url("member/login_ok.php")?>&" onSubmit="return chkForm(this)">
					<input type=hidden name=mode value="guest">
					<input type=hidden name=returnUrl value="<?php echo $GLOBALS["returnUrl"]?>">
					<table id="printPost1" class="post_body" cellspacing="0" cellpadding="0">
					<tr>
						<td class="bcl" nowrap="nowrap"></td>
						<td class="bcc">
							<div id="box01" style="">
								<div style="height:25px;"></div>
								<div id="row01" style="">
									<div id="col0101" style="position:relative;float:left;width:120px;height:30px;padding-right:10px;text-align:right;">주문자명 :</div>
									<div id="col0201" style="position:relative;float:left;width:140px;height:30px;padding-right:10px;text-align:left;"><input type="text" name="nameOrder" size="20" required label="주문자명" style="width:140px;"></div>
								</div>
								<div id="row02" style="clear:both">
									<div id="col0102" style="position:relative;float:left;width:120px;height:30px;padding-right:10px;text-align:right;">주문번호 :</div>
									<div id="col0202" style="position:relative;float:left;width:140px;height:30px;padding-right:10px;text-align:left;"><input type="text" name="ordno" size="20" required label="주문번호" style="width:140px;"></div>
									<div id="col0302" style="position:relative;float:left;width:90px;height:30px;padding-bottom:4px;text-align:left;"><input type="image" src="/shop/data/skin/loosfly/img/jimmy/buttons/ok_01.gif" border="0"></div>
								</div>
								<div id="row03" style="clear:both">
									<div style="height:40px;border:#c2c2c2 0 solid;border-bottom-width:1px;"></div>
									<div style="height:25px;"></div>
									<div style="text-align:center; padding:10px 5px;background-color:#efefef">
										<div style="text-align:left;border:#ffffff 0 solid;border-bottom-width:1px;line-height:20px;height:20px;">언제든 연락 주세요.</div>
										<div style="text-align:left;line-height:15px;color:#515151;padding-top:10px;">
											루스플라이는 언제나 여러분을 환영합니다. 사이트 이용중 궁금하신 점이나 제안하실 점 또는 개선할 점이 있을 때는 언제든 아래 연락처로 문의하시기 바랍니다. 
										</div>
									</div>
								</div>
								<div style="height:10px;"></div>
							</div>
						</td>
						<td class="bcr" nowrap="nowrap"></td>
					</tr>
					</table>
				</form>
				<table class="post_footer" cellspacing="0" cellpadding="0"><tbody><tr><td class="ftl" nowrap="nowrap"></td><td class="ftc"></td><td class="ftr" nowrap="nowrap"></td></tr></tbody></table>
			</div>
<?php }?>
		</div>
	</div>

<?php $this->print_("footer",$TPL_SCP,1);?>