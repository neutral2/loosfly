<?php /* Template_ 2.2.7 2014/08/21 16:35:29 /www/loosfly_godo_co_kr/shop/data/skin/loosfly/order/order.htm 000045752 */  $this->include_("displayEggBanner");
if (is_array($GLOBALS["r_deli"])) $TPL__r_deli_1=count($GLOBALS["r_deli"]); else if (is_object($GLOBALS["r_deli"]) && in_array("Countable", class_implements($GLOBALS["r_deli"]))) $TPL__r_deli_1=$GLOBALS["r_deli"]->count();else $TPL__r_deli_1=0;?>
<?php $this->print_("header",$TPL_SCP,1);?>


<style>
#orderbox {border:5px solid #F3F3F3; height:100%;}
#orderbox div {float:left; width:150; height:100%; background-color:#F3F3F3; text-align:right;}
#orderbox table {float:left; margin:10px 0px 10px 20px; }
#orderbox table th {width:100; text-align:left; font-weight:normal; height:25;}
#orderbox table td {padding-left:10px}
.scroll {
scrollbar-face-color: #FFFFFF;
scrollbar-shadow-color: #AFAFAF;
scrollbar-highlight-color: #AFAFAF;
scrollbar-3dlight-color: #FFFFFF;
scrollbar-darkshadow-color: #FFFFFF;
scrollbar-track-color: #F7F7F7;
scrollbar-arrow-color: #838383;
}
#boxScroll{width:96%; height:130px; overflow: auto; BACKGROUND: #ffffff; COLOR: #585858; font:9pt 돋움;border:1px #dddddd solid; overflow-x:hidden;text-align:left; }
.n_mileage{
	cursor: pointer;
	vertical-align: middle;
}
.mileage_button{
	cursor: pointer;
	vertical-align: middle;
}
#save_button, #ncash_view{
	margin: 4px 0 0 24px;
}
#ncash_view{
	display: none;
}

.step_table { border:#dedede 1px solid; }
.step_table td { height:25px;line-height:20px; }
.step_table.select { border:#3f3f3f 1px solid; }
.step_table .header{ background-color:#f3f3f3; }
.step_table .header.sel { background-color:#71cbd2; }
</style>
<script id="delivery"></script>

		<div id="blkContentsNoMenu">
			<div style="font-size:0;height:10px"></div>
			<!-- 상단이미지 -->
			<div style="text-align:center"><img src="/shop/data/skin/loosfly/img/jimmy/payment/top_img/payment_top_img_01.jpg"></div>
			<div style="font-size:0;height:30px"></div>
			<div style="color:#f47d30">주문상세내역</div>

<?php echo $this->define('tpl_include_file_1',"proc/orderitem.htm")?> <?php $this->print_("tpl_include_file_1",$TPL_SCP,1);?>


<?php if(!$GLOBALS["sess"]&&is_file(sprintf("../skin/%s/service/_private_non.txt",$GLOBALS["cfg"]["tplSkin"]))){?>
		<!-- 비회원 개인정보 취급방침 내용 -->
			<div style="margin-top:20;"><img src="/shop/data/skin/loosfly/img/common/order_txt_non.gif" border=0></div>
			<div style="padding-top:10; background:#F1F1F1;text-align:center;">
				<div align="left" style="height:26;padding:3px 0 0 10px;">
					<b>● 비회원 주문에 대한 개인정보 수집에 대한 동의</b> (자세한 내용은 “<a href="<?php echo url("service/private.php")?>&">개인정보취급방침</a>”을 확인하시기 바랍니다)
				</div>
				<div id="boxScroll" class="scroll">
					<?php echo $this->define('tpl_include_file_2',"/service/_private_non.txt")?> <?php $this->print_("tpl_include_file_2",$TPL_SCP,1);?>

				</div>
				<div align=center class=noline style="height:30;margin-top:10px;" >
					<input type="radio" name="private" value="y" onclick="javascript:document.frmOrder.private.value='y';"> 동의합니다 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="radio" name="private" value="n" onclick="javascript:document.frmOrder.private.value='';"> 동의하지 않습니다
				</div>
			</div>
			<div style="font-size:0;height:5px"></div>
<?php }?>

			<div style="color:#f47d30;margin-top:20px">주문서 작성</div>
			<form id=form name=frmOrder action="<?php echo $TPL_VAR["orderActionUrl"]?>" method=post onsubmit="return chkForm2(this)">
				<input type=hidden name=ordno value="<?php echo $TPL_VAR["ordno"]?>">
<?php if(!$GLOBALS["sess"]&&is_file(sprintf("../skin/%s/service/_private_non.txt",$GLOBALS["cfg"]["tplSkin"]))){?>
				<input type=hidden name=private value="" required msgR="비회원 개인정보 수집에 동의를 하셔야만 주문이 가능합니다.">
<?php }?>
<?php if((is_array($TPL_R1=$TPL_VAR["cart"]->item)&&!empty($TPL_R1)) || (is_object($TPL_R1) && in_array("Countable", class_implements($TPL_R1)) && $TPL_R1->count() > 0)) {foreach($TPL_R1 as $TPL_V1){?>
				<input type=hidden name=item_apply_coupon[]>
<?php }}?>

				<div id=apply_coupon></div>

<!-- 01 주문자정보 -->
				<table width="100%"  class="step_table select" id="step01" cellpadding="0" cellspacing="0">
				<tr>
					<td width="150" valign="top" align="right" class="header sel"><img src="/shop/data/skin/loosfly/img/jimmy/payment/step_header01_on.gif"></td>
					<td style="padding:10px">
						<table width="800">
						<col width="100">
						<tr>
							<td>주문하시는분</td>
							<td><input type=text name=nameOrder value="<?php echo $TPL_VAR["name"]?>" style="font-weight:bold;width:200px;height:20px" <?php echo $GLOBALS["style_member"]?> required msgR="주문하시는분의 이름을 적어주세요" onfocus="set_step(1)"></td>
						</tr>
<?php if($GLOBALS["sess"]){?>
						<tr>
							<td>주소</td>
							<td>
								<?php echo $TPL_VAR["address"]?> <?php echo $TPL_VAR["address_sub"]?>

<?php if($TPL_VAR["road_address"]){?><div style="padding-top:5px;font:12px dotum;color:#999;"><?php echo $TPL_VAR["road_address"]?> <?php echo $TPL_VAR["address_sub"]?></div><?php }?>
							</td>
						</tr>
<?php }?>
						<tr>
							<td>전화번호</td>
							<td>
							<input type=text name=phoneOrder[] value="<?php echo $TPL_VAR["phone"][ 0]?>" size=3 maxlength=3 onfocus="set_step(1)" style="width:35px;height:20px" option="regNum" required label="주문자 전화번호"> -
							<input type=text name=phoneOrder[] value="<?php echo $TPL_VAR["phone"][ 1]?>" size=4 maxlength=4 onfocus="set_step(1)" style="width:70px;height:20px" option="regNum" required label="주문자 전화번호"> -
							<input type=text name=phoneOrder[] value="<?php echo $TPL_VAR["phone"][ 2]?>" size=4 maxlength=4 onfocus="set_step(1)" style="width:70px;height:20px" option="regNum" required label="주문자 전화번호">
							</td>
						</tr>
						<tr>
							<td>핸드폰번호</td>
							<td>
							<input type=text name=mobileOrder[] value="<?php echo $TPL_VAR["mobile"][ 0]?>" size=3 maxlength=3 onfocus="set_step(1)" style="width:35px;height:20px" option="regNum" required label="주문자 핸드폰번호"> -
							<input type=text name=mobileOrder[] value="<?php echo $TPL_VAR["mobile"][ 1]?>" size=4 maxlength=4 onfocus="set_step(1)" style="width:70px;height:20px" option="regNum" required label="주문자 핸드폰번호"> -
							<input type=text name=mobileOrder[] value="<?php echo $TPL_VAR["mobile"][ 2]?>" size=4 maxlength=4 onfocus="set_step(1)" style="width:70px;height:20px" option="regNum" required label="주문자 핸드폰번호">
							</td>
						</tr>
						<tr>
							<td>이메일</td>
							<td><input type=text name=email value="<?php echo $TPL_VAR["email"]?>" required option=regEmail onfocus="set_step(1)" style="width:200px;height:20px"></td>
						</tr>
						</table>
					</td>
				</tr>
				</table>
				
				<div style="font-size:0;height:5px"></div>

<!-- 02 배송정보 -->
				<table width=100% class="step_table" id="step02" cellpadding=0 cellspacing=0>
				<tr>
					<td width="150" valign="top" align="right" class="header"><img src="/shop/data/skin/loosfly/img/jimmy/payment/step_header02_off.gif"></td>
					<td style="padding:10px">
						<table width="800">
						<col width="100">
						<tr>
							<td>배송지 확인</td>
							<td class=noline>
								<input type=checkbox onclick="ctrl_field(this.checked);set_step(2);"> 주문고객 정보와 동일합니다
							</td>
						</tr>
						<tr>
							<td>받으실분</td>
							<td><input type=text name=nameReceiver onfocus="set_step(2)" style="width:200px;height:20px" required></td>
						</tr>
						<tr>
							<td>받으실곳</td>
							<td>
							<input type=text name=zipcode[] id="zipcode0" size=3 class=line readonly value="<?php echo $TPL_VAR["zipcode"][ 0]?>" required onfocus="set_step(2)" style="width:50px;height:20px"> -
							<input type=text name=zipcode[] id="zipcode1" size=3 class=line readonly value="<?php echo $TPL_VAR["zipcode"][ 1]?>" required onfocus="set_step(2)" style="width:50px;height:20px">
							<a href="javascript:popup('../proc/popup_address.php',500,432)"><img src="/shop/data/skin/loosfly/img/common/btn_zipcode.gif" align=absmiddle></a>
							</td>
						</tr>
						<tr>
							<td></td>
							<td><input type=text name=address id="address" class=lineBig readonly value="<?php echo $TPL_VAR["address"]?>" onfocus="set_step(2)" style="width:200px;height:20px" required></td>
						</tr>
						<tr>
							<td></td>
							<td>
								<input type=text name=address_sub id="address_sub" class=lineBig value="<?php echo $TPL_VAR["address_sub"]?>" onkeyup="SameAddressSub(this)" oninput="SameAddressSub(this)" onfocus="set_step(2)" style="width:200px;height:20px" label="세부주소">
								<input type="hidden" name="road_address" id="road_address" style="width:100%" value="<?php echo $TPL_VAR["road_address"]?>" class="line">
								<div style="padding:5px 5px 0 1px;font:12px dotum;color:#999;" id="div_road_address"><?php echo $TPL_VAR["road_address"]?></div>
								<div style="padding:5px 0 0 1px;font:12px dotum;color:#999;" id="div_road_address_sub"><?php if($TPL_VAR["road_address"]){?><?php echo $TPL_VAR["address_sub"]?><?php }?></div>
							</td>
						</tr>
						<tr>
							<td>전화번호</td>
							<td>
							<input type=text name=phoneReceiver[] size=3 maxlength=3 onfocus="set_step(2)" style="width:35px;height:20px" option="regNum" required label="주문자 전화번호"> -
							<input type=text name=phoneReceiver[] size=4 maxlength=4 onfocus="set_step(2)" style="width:70px;height:20px" option="regNum" required label="주문자 전화번호"> -
							<input type=text name=phoneReceiver[] size=4 maxlength=4 onfocus="set_step(2)" style="width:70px;height:20px" option="regNum" required label="주문자 전화번호">
							</td>
						</tr>
						<tr>
							<td>핸드폰번호</td>
							<td>
							<input type=text name=mobileReceiver[] size=3 maxlength=3 onfocus="set_step(2)" style="width:35px;height:20px" option="regNum" required label="주문자 핸드폰번호"> -
							<input type=text name=mobileReceiver[] size=4 maxlength=4 onfocus="set_step(2)" style="width:70px;height:20px" option="regNum" required label="주문자 핸드폰번호"> -
							<input type=text name=mobileReceiver[] size=4 maxlength=4 onfocus="set_step(2)" style="width:70px;height:20px" option="regNum" required label="주문자 핸드폰번호">
							</td>
						</tr>
						<tr>
							<td style="height:65px;">남기실 말씀</td>
							<td><textarea name=memo style="width:100%;height:60px;overflow:auto" onfocus="set_step(2)"></textarea><!--input type=text name=memo style="width:100%;height:20px" onfocus="set_step(2)"--></td>
						</tr>
						<tr><td colspan=2>&nbsp;</td></tr>
						<tr id="paper_delivery_menu">
							<td>배송선택</td>
							<td class="noline">
							<div style='float:left'><input type="radio" name="deliPoli" value="0" checked onclick="getDelivery();set_step(2);" onblur="chk_emoney(document.frmOrder.emoney)"> 기본배송</div>
<?php if($TPL__r_deli_1){$TPL_I1=-1;foreach($GLOBALS["r_deli"] as $TPL_V1){$TPL_I1++;?>
<?php if($TPL_V1){?>
							<div style='float:left;padding-left:10'><input type="radio" name="deliPoli" value="<?php echo $TPL_I1+ 1?>" onclick="getDelivery();set_step(2);" onblur="chk_emoney(document.frmOrder.emoney)"> <?php echo $TPL_V1?></div>
<?php }?>
<?php }}?>
							</td>
						</tr>
						</table>
					</td>
				</tr>
				</table><div style="font-size:0;height:5px"></div>

<!-- 03 결제금액 -->
				<table width=100% class="step_table" id="step03" cellpadding=0 cellspacing=0>
				<tr>
					<td width="150" valign="top" align="right" class="header"><img src="/shop/data/skin/loosfly/img/jimmy/payment/step_header03_off.gif"></td>
					<td style="padding:10px">
						<table width="800">
						<col width="100">
						<tr>
							<td>상품합계금액</td>
							<td><p id="paper_goodsprice" style="width:146px;text-align:right;font-weight:bold;float:left;margin:0"><?php echo number_format($TPL_VAR["cart"]->goodsprice)?></p> 원</td>
						</tr>
						<tr>
							<td>배송비</td>
							<td>
								<div id="paper_delivery_msg1"><div id="paper_delivery" style="width:146px;text-align:right;font-weight:bold;float:left;margin:0"></div>원</div>
								<div id="paper_delivery_msg2" style="display:none;width:160;text-align:right"></div>
								<div id="paper_delivery_msg_extra"  class="small red" style="display:none;"></div>
							</td>
						</tr>
<?php if($TPL_VAR["view_aboutdc"]){?>
						<tr>
							<td>어바웃 쿠폰</td>
							<td><p style="width:146px;text-align:righ;float:left;margin:0t"><?php echo number_format($TPL_VAR["about_coupon"])?></p> 원</td>
						</tr>
<?php }?>
<?php if($GLOBALS["sess"]){?>
						<tr>
							<td><?php if($TPL_VAR["cart"]->dc){?>우수회원할인(<?php echo $TPL_VAR["cart"]->dc?>)<?php }else{?>회원할인<?php }?></td>
							<td><p id='memberdc' style="width:146px;text-align:right;float:left;margin:0"><?php echo number_format($TPL_VAR["cart"]->dcprice)?></p> 원</td>
						</tr>
						<tr>
							<td>쿠폰 적용</td>
							<td>
								<table cellpadding=0 cellspacing=0>
								<tr>
									<td width=60 align=right>할인 :</td>
									<td style="padding-left:3px">
									<input type=text name=coupon size=12 style="text-align:right" value=0 onfocus="set_step(3)" readonly> 원
									<a href="javascript:popup('../proc/popup_coupon.php',600,700)"><img src="/shop/data/skin/loosfly/img/common/btn_coupon.gif" align=absmiddle hspace=2></a><span id="del_coupon" style="visibility:hidden"><a href='javascript:del_coupon();'><img src="/shop/data/skin/loosfly/img/common/btn_coupon_del.gif" align=absmiddle hspace=2></a></span>
									</td>
								</tr>
								<!--tr>
									<td width=60 align=right>적립 :</td>
									<td style="padding-left:3px">
										<input type=text name=coupon_emoney size=12 style="text-align:right" value="0" onfocus="set_step(3)" readonly> 원
									</td>
								</tr-->
								</table>
							</td>
						</tr>
						<tr>
							<td valign=top style="padding-top:4px">적립금 적용</td>
							<td>
								<table cellpadding=0 cellspacing=0>
								<div style="display:<?php if($GLOBALS["member"]["emoney"]){?>block;<?php }else{?>none;<?php }?>}">
								<tr>
									<td width=60 align=right>적립금 :</td>
									<td style="padding-left:3px">
										<input type=text name=emoney id="emoney" size=12 style="text-align:right" value="0"  onfocus="set_step(3)" onblur="chk_emoney(this);" onkeyup="calcu_settle();" onkeydown="if (event.keyCode == 13) {return false;}"  <?php if($GLOBALS["set"]["emoney"]["totallimit"]>$TPL_VAR["cart"]->goodsprice){?>disabled<?php }?>> 원
<?php if($GLOBALS["set"]["emoney"]["totallimit"]>$TPL_VAR["cart"]->goodsprice){?>
										<span class="small red"><?php echo number_format($GLOBALS["set"]["emoney"]["totallimit"])?>원 이상 주문시 적립금 사용 가능.</span>
<?php }else{?>
										(보유적립금 : <?php echo number_format($GLOBALS["member"]["emoney"])?>원)
<?php }?>
									</td>
								</tr>
								</div>
								<tr>
									<td colspan=2 class="small red">
<?php if($GLOBALS["member"]["emoney"]<$GLOBALS["set"]["emoney"]["hold"]){?>
										<div>보유적립금이 <?php echo number_format($GLOBALS["set"]["emoney"]["hold"])?>원이상 일 경우 사용하실 수 있습니다.</div>
<?php }else{?>
<?php if($GLOBALS["emoney_max"]&&$GLOBALS["emoney_max"]>=$GLOBALS["set"]["emoney"]["min"]){?>
										적립금은 <?php echo number_format($GLOBALS["set"]["emoney"]["min"])?>원부터 <span id=print_emoney_max><?php echo number_format($GLOBALS["emoney_max"])?></span>원까지 사용이 가능합니다.
<?php }elseif($GLOBALS["emoney_max"]&&$GLOBALS["emoney_max"]<$GLOBALS["set"]["emoney"]["min"]){?>
										적립금은 최소 <?php echo number_format($GLOBALS["set"]["emoney"]["min"])?>원 이상 사용하여야 합니다.
<?php }?>
<?php }?>
										<input type=hidden name=emoney_max value="<?php echo $GLOBALS["emoney_max"]?>">
									</td>
								</tr>
								</table>
							</td>
						</tr>
<?php }?>
<?php if($TPL_VAR["ncash"]["useyn"]=='Y'){?>
						<tr id="naver-mileage-accum" style="display: none;">
							<td>적립금 선택</td>
							<td class="noline">
<?php if($GLOBALS["sess"]&&$TPL_VAR["ncash"]["save_mode"]=='choice'){?>
								<input type="radio" name="save_mode" value="" onclick="naver_mileage_initialize(this);"> 쇼핑몰 적립금<br/>
								<input type="radio" name="save_mode" value="ncash"> 네이버 마일리지 <img src="<?php echo $GLOBALS["cfg"]["rootDir"]?>/proc/naver_mileage/images/n_mileage_on.png"/><br/>
<?php }elseif($GLOBALS["sess"]&&$TPL_VAR["ncash"]["save_mode"]=='both'){?>
								<input type="radio" name="save_mode" value="" onclick="naver_mileage_initialize(this);"> 쇼핑몰 적립금만 적립<br/>
								<input type="radio" name="save_mode" value="both" checked> 쇼핑몰 적립금 과 네이버 마일리지 <img src="<?php echo $GLOBALS["cfg"]["rootDir"]?>/proc/naver_mileage/images/n_mileage_on.png"/> 동시 적립<br/>
<?php }else{?>
								<input type="radio" name="save_mode" value="unused" onclick="naver_mileage_initialize(this);"> 네이버 마일리지 사용/적립 안함<br/>
								<input type="radio" name="save_mode" value="ncash"> 네이버 마일리지 <img src="<?php echo $GLOBALS["cfg"]["rootDir"]?>/proc/naver_mileage/images/n_mileage_on.png"/><br/>
<?php }?>
								<div id="save_button"><img src="/shop/data/skin/loosfly/img/nmileage/n_mileage_use.gif" onClick="javascript:cash_save_use();" class="mileage_button"> 버튼을 클릭해서 <span id="naver-mileage-accum-rate" style="color: #1ec228; font-weight: bold;"></span> 적립받고 사용하세요 <img class="n_mileage" src="/shop/data/skin/loosfly/img/nmileage/n_mileage_info2.gif" onclick="mileage_info();"></div>
								<div id="ncash_view"></div>
								<input type="hidden" id="exception_price" name="exception_price" value="<?php echo $TPL_VAR["ncash"]["exception_price"]?>">
								<input type="hidden" id="reqTxId<?php echo $TPL_VAR["ncash"]["api_id"]?>" name="reqTxId<?php echo $TPL_VAR["ncash"]["api_id"]?>" value="">
								<input type="hidden" id="mileageUseAmount<?php echo $TPL_VAR["ncash"]["api_id"]?>" name="mileageUseAmount<?php echo $TPL_VAR["ncash"]["api_id"]?>" value="">
								<input type="hidden" id="cashUseAmount<?php echo $TPL_VAR["ncash"]["api_id"]?>" name="cashUseAmount<?php echo $TPL_VAR["ncash"]["api_id"]?>" value="">
								<input type="hidden" id="totalUseAmount<?php echo $TPL_VAR["ncash"]["api_id"]?>" name="totalUseAmount<?php echo $TPL_VAR["ncash"]["api_id"]?>" value="">
								<input type="hidden" id="baseAccumRate" name="baseAccumRate" value="">
								<input type="hidden" id="addAccumRate" name="addAccumRate" value="">
							</td>
						</tr>
<?php }?>
<?php if($GLOBALS["egg"]["use"]=="Y"&&($GLOBALS["egg"]["scope"]=="A"||($GLOBALS["egg"]["scope"]=="P"&&$TPL_VAR["cart"]->totalprice-$TPL_VAR["cart"]->dcprice>=$GLOBALS["egg"]["min"]))&&$GLOBALS["egg"]["feepayer"]=="B"){?>
						<tr>
							<td>보증보험 수수료</td>
							<td><p id=paper_eggFee style="width:146px;text-align:right;font-weight:bold;float:left;margin:0">0</p> 원</td>
						</tr>
<?php }?>
					
						<tr>
							<td>총 결제금액</td>
							<td><p id=paper_settlement style="width:146px;text-align:right;font:bold 18px tahoma; color:#f47d30;float:left;"><?php echo number_format($TPL_VAR["cart"]->totalprice-$TPL_VAR["cart"]->dcprice)?></p> 원</td>
						</tr>
						</table>
						</td>
					</tr>
				</table>
				<div style="font-size:0;height:5px"></div>
	<!-- 구매안전표시 start --><?php echo displayEggBanner( 1)?><!-- 구매안전표시 end -->

<!-- 04 결제수단 -->
				<table width=100% class="step_table" id="step04" cellpadding=0 cellspacing=0>
				<tr >
					<td width="150" valign="top" align="right" class="header"><img src="/shop/data/skin/loosfly/img/jimmy/payment/step_header02_off.gif"></td>
					<td style="padding:10px">

	<input type=hidden name=escrow value="N">
						<table width="800">
						<col width="100">
						<tr>
							<td>일반결제</td>
							<td class=noline>
<?php if($GLOBALS["set"]["use"]["a"]){?>
								<input type=radio name=settlekind value="a" onclick="input_escrow(this,'N');set_step(4);"> 무통장입금
<?php }?>
<?php if($GLOBALS["set"]["use"]["c"]){?>
								<input type=radio name=settlekind value="c" onclick="input_escrow(this,'N');set_step(4);"> 신용카드
<?php }?>
<?php if($GLOBALS["set"]["use"]["o"]){?>
								<input type=radio name=settlekind value="o" onclick="input_escrow(this,'N');set_step(4);"> 계좌이체
<?php }?>
<?php if($GLOBALS["set"]["use"]["v"]){?>
								<input type=radio name=settlekind value="v" onclick="input_escrow(this,'N');set_step(4);"> 가상계좌
<?php }?>
<?php if($GLOBALS["set"]["use"]["h"]){?>
								<input type=radio name=settlekind value="h" onclick="input_escrow(this,'N');set_step(4);"> 핸드폰
<?php }?>
<?php if($GLOBALS["set"]["use"]["p"]){?>
								<input type=radio name=settlekind value="p" onclick="input_escrow(this,'N');set_step(4);"> 포인트
<?php }?>
<?php if($GLOBALS["set"]["use"]["u"]){?>
								<input type=radio name=settlekind value="u" onclick="input_escrow(this,'N');set_step(4);"> CUP (중국카드)
<?php }?>
<?php if($GLOBALS["set"]["use"]["y"]){?>
								<input type=radio name=settlekind value="y" onclick="input_escrow(this,'N');set_step(4);"> 옐로페이
<?php }?>
							</td>
							<td rowspan="5"><a href="http://www.inicis.com/blog/archives/16302" target="_blank" title="새 창"><img src="http://www.inicis.com/promo/20140405_banner/01_121_162.gif" width="121" height="162" alt="카드사무이자 할부안내" border="0"></a></td>
						</tr>

<?php if($GLOBALS["escrow"]["use"]=="Y"&&$TPL_VAR["cart"]->totalprice-$TPL_VAR["cart"]->dcprice>=$GLOBALS["escrow"]["min"]){?>
						<tr>
							<td>에스크로결제</td>
							<td class=noline>
<?php if($GLOBALS["escrow"]["c"]){?>
							<input type=radio name=settlekind value="c" onclick="input_escrow(this,'Y');set_step(4);"> 신용카드
<?php }?>
<?php if($GLOBALS["escrow"]["o"]){?>
							<input type=radio name=settlekind value="o" onclick="input_escrow(this,'Y');set_step(4);"> 계좌이체
<?php }?>
<?php if($GLOBALS["escrow"]["v"]){?>
							<input type=radio name=settlekind value="v" onclick="input_escrow(this,'Y');set_step(4);"> 가상계좌
<?php }?>
							</td>
						</tr>
<?php }?>

<?php if($TPL_VAR["useIpayPg"]===true){?>
						<tr>
							<td>옥션 iPay</td>
							<td class="noline">
								<input type=radio name=settlekind value="i" onclick="input_escrow(this,'Y');set_step(4);"> 아이페이 안전결제
								<div class="small" style="padding-left:25px;">
									- 결제수단은 iPay 결제창에서 선택합니다.<br>
									- iPay 결제창에서 상품가격은 쇼핑몰 할인혜택이 적용된 가격입니다.
								</div>
							</td>
						</tr>
<?php }?>

<?php if($GLOBALS["set"]["use"]["a"]){?>
						<tr>
							<th></th>
							<td>※ <span style="color:#f47d30;font-weight:bold">계좌이체, 가상계좌</span>는 실시간으로 이체가 이루어집니다.<br> 주문완료후 은행이나 온라인으로 직접이체를 원하시는 경우 <span style ="color:#f47d30;font-weight:bold">무통장입금</span>을 선택하시기 바랍니다.</td>
						</tr>
						<tr>
							<th></th>
							<td class="small red">(무통장입금의 경우 입금확인 후부터 배송단계가 진행됩니다)</td>
						</tr>
<?php }?>
						<tr>
							<th></th>
							<td class="small red"><div id="coupon_typinfo" style="display:none">무통장입금에서만 사용가능한 쿠폰을 선택하였습니다. <br>다른 결제 수단을 선택하시려면 쿠폰을 제거 하여 주십시오.</div></td>
						</tr>
						</table>

<?php if($GLOBALS["egg"]["use"]=="Y"&&($GLOBALS["egg"]["scope"]=="A"||($GLOBALS["egg"]["scope"]=="P"&&$TPL_VAR["cart"]->totalprice-$TPL_VAR["cart"]->dcprice>=$GLOBALS["egg"]["min"]))){?>
						<table id="egg" style="display:none; margin-top:10px;">
						<col width=100>
						<tr>
							<td valign=top style="padding-top:4px">전자보증보험</td>
							<td>
<?php if($GLOBALS["egg"]["scope"]=="P"){?>
								<div>구매 시 안전거래(매매보호) 사용유무를 직접 선택하실 수 있습니다.</div>
<?php }?>
								<div style="color:#FF6C68; font-weight:bold; margin-bottom:5px;">아래의 주의사항을 꼭 확인하세요!</div>

<?php if($GLOBALS["egg"]["scope"]=="P"){?>
								<div class=noline>&#149; 전자보증보험 발급여부 : <input type=radio name=eggIssue value="Y" onclick="egg_required();set_step(4);"> 발급 <input type=radio name=eggIssue value="N" onclick="egg_required();set_step(4);"> 미발급</div>
<?php }?>

								<div>&#149; <font color=444444>전자보증보험 안내 (100% 매매보호 안전결제)<br>
								물품대금결제시 구매자의 피해보호를 위해 '(주)서울보증보험'의 보증보험증권이 발급됩니다. 증권이 발급되는 것의 의미는,
								물품대금 결제시에 소비자에게 서울보증보험의 쇼핑몰보증보험 계약체결서를 인터넷상으로 자동 발급하여,
								피해발생시 쇼핑몰보증보험으로써 완벽하게 보호받을 수 있습니다.<br>
								또한, <span class='red'>입력하신 개인정보는 증권발급을 위한 정보로 사용되며 다른 용도로는 사용되지 않습니다.</span>
								</font></div>

<?php if($GLOBALS["egg"]["feepayer"]!="B"){?>
								<div>&#149; <font color=444444>보증보험 발행으로 구매시 별도의 수수료가 부과되지 않습니다.</font></div>
<?php }elseif($GLOBALS["egg"]["feepayer"]=="B"&&$GLOBALS["egg"]["feerate"]> 0){?>
								<div>&#149; <font color=444444>보증보험 발행으로 구매시 <span style="color:#FF6C68; font-weight:bold;">보증보험증권 발급수수료는 구매자께서 부담</span>하시게 됩니다.<br>
								보증보험 발급수수료(총 결제금액의 <?php echo $GLOBALS["egg"]["feerate"]?>%) : <span id=infor_eggFee></span></font>
								</div>
								<input type=hidden name=eggFee>
								<input type=hidden name=eggFeeRateYn value=Y>
<?php }?>

								<div style="padding-top:10px;">&#149; 생년월일 :
									<input type="text"t name="eggBirthYear" size=4 maxlength=4  onfocus="set_step(4)">년
									<select name="eggBirthMon" onfocus="set_step(4)">
									<option value="">선택</option>
									<? for ($i = 1; $i <= 12; $i++ ){ echo '<option value="'.$i.'">'.$i.'</option>'; } ?>
									</select>월
									<select name="eggBirthDay" onfocus="set_step(4)">
									<option value="">선택</option>
									<? for ($i = 1; $i <= 31; $i++ ){ echo '<option value="'.$i.'">'.$i.'</option>'; } ?>
									</select>일
								</div>
								<div class=noline>&#149; 성별 : <input type=radio name=eggSex value="1" onclick="set_step(4)"> 남성 <input type=radio name=eggSex value="2" onclick="set_step(4)"> 여성</div>
								<div style="text-align:center;" class=noline><input type=checkbox name=eggAgree value="Y" onclick="set_step(4)"> 개인정보 이용에 동의합니다</div>
							</td>
						</tr>
						</table>
<?php }?>

<?php if($GLOBALS["pg"]["receipt"]=='Y'&&$GLOBALS["set"]["receipt"]["order"]=='Y'){?>
	<?php echo $this->define('tpl_include_file_3',"proc/_cashreceiptOrder.htm")?> <?php $this->print_("tpl_include_file_3",$TPL_SCP,1);?>

<?php }?>
					</td>
				</tr>
				</table>
				<div style="font-size:0;height:5px"></div>

				<div style="padding:20px" align="right" class="noline">
					<input type="image" src="/shop/data/skin/loosfly/img/jimmy/buttons/payment_01.gif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<img src="/shop/data/skin/loosfly/img/jimmy/buttons/cancel_01.gif" onclick="history.back()" style="cursor:pointer">
				</div>
			</form>
			<div style="font-size:0;height:30px"></div>
		</div><!-- End indiv -->
		<div id=dynamic></div>

<script>
var emoney_max = <?php echo $GLOBALS["emoney_max"]?>;

function set_step(step_num) {
	$('#step01').removeClass('select');
	$('#step02').removeClass('select');
	$('#step03').removeClass('select');
	$('#step04').removeClass('select');
	$('#step01 .header').removeClass('sel');
	$('#step02 .header').removeClass('sel');
	$('#step03 .header').removeClass('sel');
	$('#step04 .header').removeClass('sel');
	$('#step01 .header > img').attr('src','/shop/data/skin/loosfly/img/jimmy/payment/step_header01_off.gif');
	$('#step02 .header > img').attr('src','/shop/data/skin/loosfly/img/jimmy/payment/step_header02_off.gif');
	$('#step03 .header > img').attr('src','/shop/data/skin/loosfly/img/jimmy/payment/step_header03_off.gif');
	$('#step04 .header > img').attr('src','/shop/data/skin/loosfly/img/jimmy/payment/step_header04_off.gif');

	if(step_num == 1) {
		$('#step01').addClass('select');
		$('#step01 .header').addClass('sel');
		$('#step01 .header > img').attr('src','/shop/data/skin/loosfly/img/jimmy/payment/step_header01_on.gif');
	}
	else if(step_num == 2) {
		$('#step02').addClass('select');
		$('#step02 .header').addClass('sel');
		$('#step02 .header > img').attr('src','/shop/data/skin/loosfly/img/jimmy/payment/step_header02_on.gif');
	}
	else if(step_num == 3) {
		$('#step03').addClass('select');
		$('#step03 .header').addClass('sel');
		$('#step03 .header > img').attr('src','/shop/data/skin/loosfly/img/jimmy/payment/step_header03_on.gif');
	}
	else if(step_num == 4) {
		$('#step04').addClass('select');
		$('#step04 .header').addClass('sel');
		$('#step04 .header > img').attr('src','/shop/data/skin/loosfly/img/jimmy/payment/step_header04_on.gif');
	}
}

function chkForm2(fm)
{
	if (typeof(fm.settlekind)=="undefined"){
		alert("결제수단이 활성화가 안 되었습니다. 관리자에게 문의하세요.");
		return false;
	}

	var obj = document.getElementsByName('settlekind');
	if (obj[0].getAttribute('required') == undefined){
		obj[0].setAttribute('required', '');
		obj[0].setAttribute('label', '결제수단');
	}

	var obj = document.getElementsByName('save_mode');
	if (obj.length > 0 && obj[0].getAttribute('required') == undefined){
		obj[0].setAttribute('required', '');
		obj[0].setAttribute('label', '적립 위치');
	}

	var save_mode = "";

	for(var i=0;i<obj.length;i++){
		if(obj[i].checked){
			save_mode = obj[i].value;
		}
	}

	if( (save_mode == 'ncash' || save_mode == 'both') && document.getElementById('reqTxId<?php echo $TPL_VAR["ncash"]["api_id"]?>').value == ''){
		alert("네이버 마일리지 적립 시 네이버 마일리지 적립 및 사용 버튼을 클릭해주세요.");
		return false;
	}

<?php if($TPL_VAR["Mobilians_PaymentLimitPrice"]){?>
	var mobilians_paymentLimitPrice = parseInt("<?php echo $TPL_VAR["Mobilians_PaymentLimitPrice"]?>"), settleprice = parseInt(uncomma(_ID('paper_settlement').innerHTML)), checkedSettlekind;
	for (var i = 0; i < fm.settlekind.length; i++) {
		if (fm.settlekind[i].checked && fm.settlekind[i].value == "h") {
			mobilians_paymentLimitPrice = (isNaN(mobilians_paymentLimitPrice) ? 0 : mobilians_paymentLimitPrice);
			settleprice = (isNaN(settleprice) ? 0 : settleprice);
			if (mobilians_paymentLimitPrice > 0 && mobilians_paymentLimitPrice < settleprice) {
				alert('휴대폰 결제 가능 금액은 <?php echo number_format($TPL_VAR["Mobilians_PaymentLimitPrice"])?>원 이하 입니다.\r\n(한도금액은 본인 설정 또는 통신사별로 금액 차이가 있습니다.)');
				return false;
			}
		}
	}
<?php }?>

	return chkForm(fm);
}
function input_escrow(obj,val)
{
	obj.form.escrow.value = val;
	if (typeof(egg_required) == 'function') egg_required();
	if (typeof(cash_required) == 'function') cash_required();
}
function popup_zipcode(form)
{
	window.open("../proc/popup_zipcode.php?form="+form,"","width=400,height=500");
}
function ctrl_field(val)
{
	if (val) copy_field();
	else clear_field();
}
function copy_field()
{
	var form = document.frmOrder;
	form.nameReceiver.value = form.nameOrder.value;
	form['zipcode[]'][0].value = "<?php echo $TPL_VAR["zipcode"][ 0]?>";
	form['zipcode[]'][1].value = "<?php echo $TPL_VAR["zipcode"][ 1]?>";
	form.address.value = "<?php echo $TPL_VAR["address"]?>";
	form.address_sub.value = "<?php echo $TPL_VAR["address_sub"]?>";
	form.road_address.value = "<?php echo $TPL_VAR["road_address"]?>";
	document.getElementById("div_road_address").innerHTML =  "<?php echo $TPL_VAR["road_address"]?>";	
	document.getElementById("div_road_address_sub").innerHTML =  form.road_address.value ? "<?php echo $TPL_VAR["address_sub"]?>" : "";
	form['phoneReceiver[]'][0].value = form['phoneOrder[]'][0].value;
	form['phoneReceiver[]'][1].value = form['phoneOrder[]'][1].value;
	form['phoneReceiver[]'][2].value = form['phoneOrder[]'][2].value;
	form['mobileReceiver[]'][0].value = form['mobileOrder[]'][0].value;
	form['mobileReceiver[]'][1].value = form['mobileOrder[]'][1].value;
	form['mobileReceiver[]'][2].value = form['mobileOrder[]'][2].value;

	getDelivery();
}
function clear_field()
{
	var form = document.frmOrder;
	form.nameReceiver.value = "";
	form['zipcode[]'][0].value = "";
	form['zipcode[]'][1].value = "";
	form.address.value = "";
	form.address_sub.value = "";
	form.road_address.value = "";
	document.getElementById("div_road_address").innerHTML =  "";	
	document.getElementById("div_road_address_sub").innerHTML =  "";
	form['phoneReceiver[]'][0].value = "";
	form['phoneReceiver[]'][1].value = "";
	form['phoneReceiver[]'][2].value = "";
	form['mobileReceiver[]'][0].value = "";
	form['mobileReceiver[]'][1].value = "";
	form['mobileReceiver[]'][2].value = "";
}
function cutting(emoney)
{
	var chk_emoney = new String(emoney);
	reg = /(<?php echo substr($GLOBALS["set"]["emoney"]["base"], 1)?>)$/g;
	if (emoney && !chk_emoney.match(reg)){
		emoney = Math.floor(emoney/<?php echo $GLOBALS["set"]["emoney"]["base"]?>) * <?php echo $GLOBALS["set"]["emoney"]["base"]?>;
	}
	return emoney;
}
function chk_emoney(obj)
{
	var form = document.frmOrder;
	var my_emoney = <?php echo $TPL_VAR["emoney"]+ 0?>;
	var max = '<?php echo $GLOBALS["set"]["emoney"]["max"]?>';
	var min = '<?php echo $GLOBALS["set"]["emoney"]["min"]?>';
	var hold = '<?php echo $GLOBALS["set"]["emoney"]["hold"]?>';
	var limit = '<?php echo $GLOBALS["set"]["emoney"]["totallimit"]?>';

	var delivery	= uncomma(document.getElementById('paper_delivery').innerHTML);
	var goodsprice = uncomma(document.getElementById('paper_goodsprice').innerHTML);
<?php if($GLOBALS["set"]["emoney"]["emoney_use_range"]){?>
	var erangeprice = goodsprice + delivery;
<?php }else{?>
	var erangeprice = goodsprice;
<?php }?>
	var max_base = erangeprice - uncomma(_ID('memberdc').innerHTML) - uncomma(document.getElementsByName('coupon')[0].value);
	var coupon = coupon_emoney = 0;
	if( form.coupon ){
		 coupon = uncomma(form.coupon.value);
	}
	if( form.coupon_emoney ){
		 coupon_emoney = uncomma(form.coupon_emoney.value);
	}
	max = getDcprice(max_base,max,<?php echo $GLOBALS["set"]["emoney"]["base"]?>);
	min = parseInt(min);

	if (max > max_base)  max = max_base;
	if( _ID('print_emoney_max') && _ID('print_emoney_max').innerHTML != comma(max)  )_ID('print_emoney_max').innerHTML = comma(max);

	var emoney = uncomma(obj.value);
	if (emoney>my_emoney) emoney = my_emoney;

	// 중복 사용 체크
	var dup = <?php if($GLOBALS["set"]["emoney"]["useduplicate"]=='1'){?>true<?php }else{?>false<?php }?>;
	if (my_emoney > 0 && emoney > 0 && (parseInt(coupon) > 0 || parseInt(coupon_emoney)) > 0 && !dup) {
		alert('적립금과 쿠폰 사용이 중복적용되지 않습니다.');
		emoney = 0;
	}
	if(my_emoney > 0 && emoney > 0 && limit > goodsprice){
		alert("상품 주문 합계액이 "+ comma(limit) + "원 이상 일 경우 사용하실 수 있습니다.");
		emoney = 0;
	}
	if(my_emoney > 0 && emoney > 0 && my_emoney < hold){
		alert("보유적립금이 "+ comma(hold) + "원 이상 일 경우에만 사용하실 수 있습니다.");
		emoney = 0;
	}
	if (min && emoney > 0 && emoney < min){
		alert("적립금은 " + comma(min) + "원 부터 " + comma(max) + "원 까지만 사용이 가능합니다");
		emoney = 0;
	} else if (max && emoney > max && emoney > 0){
		if(emoney_max < min){
			alert("주문 상품 금액이 최소 사용 적립금 " + comma(min) + "원 보다  작습니다.");
			emoney = 0;
		}else{
			alert("적립금은 " + comma(min) + "원 부터 " + comma(max) + "원 까지만 사용이 가능합니다");
			emoney = max;
		}
	}

	obj.value = comma(cutting(emoney));
	calcu_settle();
}
function calcu_settle()
{
	var dc=0;
	var coupon = settleprice = 0;
	var goodsprice	= uncomma(document.getElementById('paper_goodsprice').innerHTML);
	var delivery	= uncomma(document.getElementById('paper_delivery').innerHTML);
	if(_ID('memberdc')) dc = uncomma(_ID('memberdc').innerHTML);
	var emoney = (document.frmOrder.emoney) ? uncomma(document.frmOrder.emoney.value) : 0;
	if (document.frmOrder.coupon){
		coupon = uncomma(document.frmOrder.coupon.value);
		if (coupon >= (goodsprice + delivery - dc)) coupon = goodsprice + delivery - dc;
		if (goodsprice + delivery - dc - coupon - emoney < 0){
<?php if($GLOBALS["set"]["emoney"]["emoney_use_range"]){?>
			emoney = goodsprice + delivery - dc - coupon;
<?php }else{?>
			emoney = goodsprice - dc - coupon;
<?php }?>
			document.frmOrder.emoney.value = comma(cutting(emoney));
		}
		dc += coupon + emoney;
	}
	var settlement = (goodsprice + delivery - dc);

<?php if($TPL_VAR["view_aboutdc"]){?>
	settlement = settlement - <?php echo $TPL_VAR["about_coupon"]?>;
<?php }?>

<?php if($TPL_VAR["ncash"]["useyn"]=='Y'){?>
	if (document.getElementById('totalUseAmount<?php echo $TPL_VAR["ncash"]["api_id"]?>')) settlement = settlement - document.getElementById('totalUseAmount<?php echo $TPL_VAR["ncash"]["api_id"]?>').value;
<?php }?>

	settlement += calcu_eggFee(settlement); // 전자보증보험 발급수수료 계산
	document.getElementById('paper_settlement').innerHTML = comma(settlement);
}
function egg_required()
{
	egg_display();
	calcu_settle();
}
function calcu_eggFee(settlement)
{
	egg_display(settlement);
	var eggFee = 0;
	if (typeof(document.getElementsByName('eggFee')[0]) != "undefined"){
		var feerate = (<?php echo $GLOBALS["egg"]["feerate"]?> / 100);
		if (document.getElementsByName('eggFee')[0].disabled == false) eggFee = parseInt(settlement * feerate);
		document.getElementsByName('eggFee')[0].value = eggFee;
	}
	if (_ID('paper_eggFee') != null) _ID('paper_eggFee').innerHTML = comma(eggFee);
	if (_ID('infor_eggFee') != null){
		_ID('infor_eggFee').innerHTML = '<b>' + comma(eggFee) + '</b> 원';
		if (eggFee) _ID('infor_eggFee').innerHTML += ' (총 결제금액에 포함되었습니다.)';
	}
	return eggFee;
}
function egg_display(settlement)
{
	var min = parseInt('<?php echo $GLOBALS["egg"]["min"]?>');
	var display = 'block';
	if (_ID('egg') == null) return;
	if (typeof(settlement) != "undefined"){
		if (settlement < min && typeof(document.getElementsByName('eggIssue')[0]) != "undefined") display = 'none';
		else if (settlement <= 0) display = 'none';
		else if (_ID('egg').style.display != 'none') return;
	}
	if (display != 'none'){
		var obj = document.getElementsByName('settlekind');
		for (var i = 0; i < obj.length; i++){
			if (obj[i].checked != true) continue;
			var settlekind = obj[i];
			break;
		}
		if (settlekind == null) display = 'none';
		else if (settlekind.value == 'h') display = 'none';
		else if (document.getElementsByName('escrow')[0].value == 'Y') display = 'none';
		else if (typeof(document.getElementsByName('eggIssue')[0]) != "undefined"){
			if (settlekind.value != 'a') display = 'none';
			else if(typeof(settlement) == "undefined"){
				settlement = uncomma(_ID('paper_settlement').innerHTML);
				if (typeof(document.getElementsByName('eggFee')[0]) != "undefined") settlement -= document.getElementsByName('eggFee')[0].value;
				if (settlement < min) display = 'none';
			}
		}
	}
	if (_ID('egg').style.display == display && display =='none') return;
	_ID('egg').style.display = display;

	items = new Array();
	items.push( {name : "eggIssue", label : "전자보증보험 발급여부", msgR : ""} );
	items.push( {name : "eggBirthYear", label : "생년월일(년)", msgR : "전자보증보험을 발급받으시려면, 생년월일(년)을 입력하셔야 결제가 가능합니다."} );
	items.push( {name : "eggBirthMon", label : "생년월일(월)", msgR : "전자보증보험을 발급받으시려면, 생년월일(월)을 입력하셔야 결제가 가능합니다."} );
	items.push( {name : "eggBirthDay", label : "생년월일(일)", msgR : "전자보증보험을 발급받으시려면, 생년월일(일)을 입력하셔야 결제가 가능합니다."} );
	items.push( {name : "eggSex", label : "성별", msgR : "전자보증보험을 발급받으시려면, 성별을 입력하셔야 결제가 가능합니다."} );
	items.push( {name : "eggAgree", label : "개인정보 이용동의", msgR : "전자보증보험을 발급받으시려면, 개인정보 이용동의가 필요합니다."} );
	items.push( {name : "eggFee", label : "발급수수료", msgR : ""} );
	for (var i = 0; i < items.length; i++){
		var obj = document.getElementsByName(items[i].name);
		if (display == 'block' && items[i].name != 'eggIssue' && typeof(document.getElementsByName('eggIssue')[0]) != "undefined")
			state = (document.getElementsByName('eggIssue')[0].checked ? 'block' : 'none');
		else state = display;
		for (var j = 0; j < obj.length; j++){
			if (state == 'block'){
				obj[j].setAttribute('required', '');
				obj[j].setAttribute('label', items[i].label);
				obj[j].setAttribute('msgR', items[i].msgR);
				obj[j].disabled = false;
			}
			else {
				obj[j].removeAttribute('required');
				obj[j].removeAttribute('label');
				obj[j].removeAttribute('msgR');
				obj[j].disabled = true;
			}
		}
	}
}

function getDelivery(){
	var form = document.frmOrder;
	var obj = form.deliPoli;
	var coupon = 0;
	var emoney = 0;

	var deliPoli = 0;
	for(var i=0;i<obj.length;i++){
		if(obj[i].checked){
			deliPoli = i;
		}
	}
	if( form.coupon ) coupon = form.coupon.value;
	if( form.emoney ) emoney = form.emoney.value;
	var zipcode = form['zipcode[]'][0].value + '-' + form['zipcode[]'][1].value;
	var mode = 'order';

	gd_ajax({
		url : '../proc/getdelivery.php',
		type : 'get',
		param : "zipcode="+zipcode+"&deliPoli="+deliPoli+"&coupon="+coupon+"&emoney="+emoney+"&mode="+mode,
		success : function(data) {
			eval(data);
		}
	});
}

function del_coupon(){
	var apply_coupon = document.getElementById('apply_coupon');
	apply_coupon.innerHTML = '';

	document.frmOrder.coupon.value = '0';
	document.frmOrder.coupon_emoney.value = '0';
	chk_emoney(document.frmOrder.emoney);
	getDelivery();
	calcu_settle();

	var settlekind = document.getElementsByName('settlekind');
	for(var j=0;j<settlekind.length;j++){
		settlekind[j].disabled = false;
	}

	var coupon_typinfo = document.getElementById('coupon_typinfo');
	coupon_typinfo.style.display = "none";
}

/*** 결제수단 첫번째 객체 자동 선택 ***/
window.onload = function (){
	var obj = document.getElementsByName('settlekind');
	for (var i = 0; i < obj.length; i++){
		if (obj[i].checked != true) continue;
		obj[i].onclick();
		var idx = i;
		break;
	}
	if (obj[0] && idx == null){ obj[0].checked = true; obj[0].onclick(); }

	getDelivery();
}

function cash_save_use(){
	var
	goodsprice = uncomma(document.getElementById('paper_goodsprice')[document.getElementById('paper_goodsprice').innerHTML?"innerHTML":"textContent"]),
	delivery_price = uncomma(document.getElementById('paper_delivery')[document.getElementById('paper_delivery').innerHTML?"innerHTML":"textContent"]),
	member_dc = _ID('memberdc') ? uncomma(_ID('memberdc').innerHTML) : 0,
	coupon = document.frmOrder.coupon ? uncomma(document.frmOrder.coupon.value) : 0,
	emoney = document.frmOrder.emoney ? uncomma(document.frmOrder.emoney.value) : 0,
	exception_price = uncomma(document.getElementById('exception_price').value),
	max_ncash_use = (goodsprice + delivery_price) - exception_price - member_dc - coupon - emoney;
	var r_save_mode = document.getElementsByName('save_mode');
	var save_mode = '';
	for( var i = 0 ; i < r_save_mode.length; i++ ){
		if(r_save_mode[i].checked){
			save_mode = r_save_mode[i].value;
		}
	}
	if(save_mode != 'ncash' && save_mode != 'both'){ alert('네이버 마일리지 적립을 선택해주세요.'); return; }
	var reqTxId = document.getElementById('reqTxId<?php echo $TPL_VAR["ncash"]["api_id"]?>').value;
	window.open('../proc/naverNcash_use.php?reqTxId='+reqTxId+"&maxUseAmount="+max_ncash_use,'cashPopup<?php echo $TPL_VAR["ncash"]["api_id"]?>','width=496,height=434,status=no,resizeable=no');
}
function mileage_info() {
	window.open("http://static.mileage.naver.net/static/20130708/ext/intro.html", "mileageIntroPopup", "width=404, height=412, status=no, resizable=no");
}
function naver_mileage_initialize(radiobox)
{
	if(document.getElementById('reqTxId<?php echo $TPL_VAR["ncash"]["api_id"]?>').value.trim().length)
	{
		if(radiobox.checked && confirm("쇼핑몰 적립금으로 변경하시면 네이버 마일리지의\r\n사용 및 적립이 취소됩니다.\r\n계속하시겠습니까?"))
		{
			document.getElementById('reqTxId<?php echo $TPL_VAR["ncash"]["api_id"]?>').value = "";
			document.getElementById('mileageUseAmount<?php echo $TPL_VAR["ncash"]["api_id"]?>').value = "";
			document.getElementById('cashUseAmount<?php echo $TPL_VAR["ncash"]["api_id"]?>').value = "";
			document.getElementById('totalUseAmount<?php echo $TPL_VAR["ncash"]["api_id"]?>').value = "";
			document.getElementById('baseAccumRate').value = "";
			document.getElementById('addAccumRate').value = "";
			document.getElementById('ncash_view').style.display = "none";
			document.getElementById('save_button').style.display = "block";
			calcu_settle();
		}
		else
		{
			var save_mode = document.getElementsByName('save_mode');
			for(var i=0; i<save_mode.length; i++)
			{
				if(/^(ncash|both)$/.test(save_mode[i].value)) save_mode[i].checked = true;
			}
		}
	}
}
</script>

<?php $this->print_("footer",$TPL_SCP,1);?>