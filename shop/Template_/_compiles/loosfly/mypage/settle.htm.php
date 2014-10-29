<?php /* Template_ 2.2.7 2013/12/19 15:44:10 /www/loosfly_godo_co_kr/shop/data/skin/loosfly/mypage/settle.htm 000011420 */ 
if (is_array($TPL_VAR["item"])) $TPL_item_1=count($TPL_VAR["item"]); else if (is_object($TPL_VAR["item"]) && in_array("Countable", class_implements($TPL_VAR["item"]))) $TPL_item_1=$TPL_VAR["item"]->count();else $TPL_item_1=0;
if (is_array($_POST)) $TPL__POST_1=count($_POST); else if (is_object($_POST) && in_array("Countable", class_implements($_POST))) $TPL__POST_1=$_POST->count();else $TPL__POST_1=0;
if (is_array($GLOBALS["bank"])) $TPL__bank_1=count($GLOBALS["bank"]); else if (is_object($GLOBALS["bank"]) && in_array("Countable", class_implements($GLOBALS["bank"]))) $TPL__bank_1=$GLOBALS["bank"]->count();else $TPL__bank_1=0;?>
<?php $this->print_("header",$TPL_SCP,1);?>


<style>
#orderbox {border:5px solid #F3F3F3; padding:5px 10px;}
#orderbox table th {width:100;}
</style>

<!-- 상단이미지 || 현재위치 -->
<table width=100% cellpadding=0 cellspacing=0 border=0>
<tr><td><img src="/shop/data/skin/loosfly/img/common/title_payment.gif" border=0></td></tr>
<tr><td class="path">home > <b>결제하기</b></td></tr>
</table>


<div class="indiv"><!-- Start indiv -->

<table width=100% cellpadding=0 cellspacing=0 border=0>
<tr><td height=2 bgcolor="#303030" colspan=10></td></tr>
<tr bgcolor=#F0F0F0 height=23>
	<th colspan=2 class="input_txt">상품정보</th>
	<th class="input_txt">적립금</th>
	<th class="input_txt">판매가</th>
	<th class="input_txt">수량</th>
	<th class="input_txt">합계</th>
</tr>
<tr><td height=1 bgcolor="#D6D6D6" colspan=10></td></tr>
<?php if($TPL_item_1){foreach($TPL_VAR["item"] as $TPL_V1){?>
<tr>
	<td align=center width=60 height=60><?php echo goodsimg($TPL_V1["img_s"], 50)?></td>
	<td>
	<?php echo $TPL_V1["goodsnm"]?>

<?php if($TPL_V1["opt1"]){?>[<?php echo $TPL_V1["opt1"]?><?php if($TPL_V1["opt2"]){?>/<?php echo $TPL_V1["opt2"]?><?php }?>]<?php }?>
<?php if($TPL_V1["addopt"]){?><div>[<?php echo str_replace("^","] [",$TPL_V1["addopt"])?>]</div><?php }?>
	</td>
	<td align=center><?php echo number_format($TPL_V1["reserve"])?>원</td>
	<td align=center><?php echo number_format($TPL_V1["price"])?>원</td>
	<td align=center><?php echo number_format($TPL_V1["ea"])?>개</td>
	<td align=center><?php echo number_format($TPL_V1["price"]*$TPL_V1["ea"])?>원</td>
</tr>
<tr><td colspan=10 height=1 bgcolor=#DEDEDE></td></tr>
<?php }}?>
</table>

<p>

<form name="frmSettle" method="post" action="<?php echo $TPL_VAR["action_url"]?>" target="ifrmHidden">
<?php if($TPL__POST_1){foreach($_POST as $TPL_K1=>$TPL_V1){?>
<?php if(is_array($TPL_V1)){?>
<?php if((is_array($TPL_R2=$TPL_V1)&&!empty($TPL_R2)) || (is_object($TPL_R2) && in_array("Countable", class_implements($TPL_R2)) && $TPL_R2->count() > 0)) {foreach($TPL_R2 as $TPL_V2){?>
	<input type=hidden name="<?php echo $TPL_K1?>[]" value="<?php echo $TPL_V2?>">
<?php }}?>
<?php }else{?>
	<input type=hidden name="<?php echo $TPL_K1?>" value="<?php echo $TPL_V1?>">
<?php }?>
<?php }}?>

<img src="/shop/data/skin/loosfly/img/common/payment_txt_01.gif" border=0>
<!-- 01 주문자정보 -->
<table width=100% style="border:1px solid #DEDEDE" cellpadding=0 cellspacing=0>
<tr>
	<td width=150 valign=top align=right bgcolor="#F3F3F3"><img src="/shop/data/skin/loosfly/img/common/order_step_01.gif"></td>
	<td id="orderbox">

	<table>
	<col width=100>
	<tr>
		<td>주문자명</td>
		<td><?php echo $TPL_VAR["nameOrder"]?></td>
	</tr>
	<tr>
		<td>주문자 전화</td>
		<td><?php echo implode("-",$TPL_VAR["phoneOrder"])?></td>
	</tr>
	<tr>
		<td>주문자 핸드폰</td>
		<td><?php echo implode("-",$TPL_VAR["mobileOrder"])?></td>
	</tr>
	<tr>
		<td>이메일</td>
		<td><?php echo $TPL_VAR["email"]?></td>
	</tr>
	</table>

	</td>
</tr>
</table><div style="font-size:0;height:5px"></div>

<!-- 02 배송정보 -->
<table width=100% style="border:1px solid #DEDEDE" cellpadding=0 cellspacing=0>
<tr>
	<td width=150 valign=top align=right bgcolor="#F3F3F3"><img src="/shop/data/skin/loosfly/img/common/order_step_02.gif"></td>
	<td id="orderbox">

	<table>
	<col width=100>
	<tr>
		<td>받는자명</td>
		<td><?php echo $TPL_VAR["nameReceiver"]?></td>
	</tr>
	<tr>
		<td>받는자 전화</td>
		<td><?php echo implode("-",$TPL_VAR["phoneReceiver"])?></td>
	</tr>
	<tr>
		<td>받는자 핸드폰</td>
		<td><?php echo implode("-",$TPL_VAR["mobileReceiver"])?></td>
	</tr>
	<tr>
		<td>우편번호</td>
		<td><?php echo $TPL_VAR["zipcode"]?></td>
	</tr>
	<tr>
		<td>주소</td>
		<td><?php echo $TPL_VAR["address"]?> <?php echo $TPL_VAR["address_sub"]?><div style="padding-top:5px;font:12px dotum;color:#999;"><?php echo $TPL_VAR["road_address"]?> <?php echo $TPL_VAR["address_sub"]?></div></td>
	</tr>
	</table>

	</td>
</tr>
</table><div style="font-size:0;height:5px"></div>

<!-- 03 결제금액 -->
<table width=100% style="border:1px solid #DEDEDE" cellpadding=0 cellspacing=0>
<tr>
	<td width=150 valign=top align=right bgcolor="#F3F3F3"><img src="/shop/data/skin/loosfly/img/common/order_step_03.gif"></td>
	<td id="orderbox">

	<table>
	<col width=100><col align="right">
	<tr>
		<td>총주문금액</td>
		<td><?php echo number_format($TPL_VAR["goodsprice"])?>원</td>
	</tr>
<?php if($TPL_VAR["deli_title"]){?>
	<tr>
		<td>배송선택</td>
		<td>
		<?php echo $TPL_VAR["deli_title"]?>

		</td>
	</tr>
<?php }?>
	<tr>
		<td>배송비</td>
		<td>
<?php if(!$TPL_VAR["deli_msg"]){?><?php echo number_format($TPL_VAR["delivery"])?><?php }else{?><?php echo $TPL_VAR["deli_msg"]?><?php }?>
		원</td>
	</tr>
	<tr>
		<td>회원할인</td>
		<td>- <?php echo number_format($TPL_VAR["memberdc"])?>원</td>
	</tr>
<?php if($TPL_VAR["coupon"]){?>
	<tr>
		<td>쿠폰할인</td>
		<td>- <?php echo number_format($TPL_VAR["coupon"])?>원</td>
	</tr>
<?php }?>
<?php if($TPL_VAR["coupon_emoney"]){?>
	<tr>
		<td>쿠폰적립</td>
		<td><?php echo number_format($TPL_VAR["coupon_emoney"])?>원</td>
	</tr>
<?php }?>
	<tr>
		<td>적립금 사용</td>
		<td>- <?php echo number_format($TPL_VAR["emoney"])?>원</td>
	</tr>
<?php if($GLOBALS["data"]["ncash_emoney"]){?>
	<tr>
		<td>네이버마일리지</td>
		<td>- <span id="paper_emoney"><?php echo number_format($TPL_VAR["ncash_emoney"])?></span>원</td>
	</tr>
<?php }?>
<?php if($GLOBALS["data"]["ncash_cash"]){?>
	<tr>
		<td>네이버캐쉬</td>
		<td>- <span id="paper_emoney"><?php echo number_format($TPL_VAR["ncash_cash"])?></span>원</td>
	</tr>
<?php }?>
<?php if($TPL_VAR["eggFee"]){?>
	<tr>
		<td>보증보험 수수료</td>
		<td><?php echo number_format($TPL_VAR["eggFee"])?>원</td>
	</tr>
<?php }?>
	<tr>
		<td>결제금액</td>
		<td><b><?php echo number_format($TPL_VAR["settleprice"])?>원</b></td>
	</tr>
	</table>

	</td>
</tr>
</table><div style="font-size:0;height:5px"></div>

<!-- 04-1 무통장입금 --><?php if($TPL_VAR["settlekind"]=="a"){?>
<table width=100% style="border:1px solid #DEDEDE" cellpadding=0 cellspacing=0>
<tr>
	<td width=150 valign=top align=right bgcolor="#F3F3F3"><img src="/shop/data/skin/loosfly/img/common/order_step_04.gif"></td>
	<td id="orderbox">

	<table>
	<col width=100>
	<tr>
		<td>입금계좌선택</td>
		<td>
		<select name=bankAccount required label="입금계좌">
		<option value="">== 입금계좌를 선택해주세요 ==
<?php if($TPL__bank_1){foreach($GLOBALS["bank"] as $TPL_V1){?>
		<option value="<?php echo $TPL_V1["sno"]?>"><?php echo $TPL_V1["bank"]?> <?php echo $TPL_V1["account"]?> <?php echo $TPL_V1["name"]?>

<?php }}?>
		</select>
		</td>
	</tr>
	<tr>
		<td>입금자명</td>
		<td>
		<input type=text name=bankSender class=line value="<?php echo $TPL_VAR["nameOrder"]?>" required  label="입금자명">
		</td>
	</tr>
	<tr>
		<td>입금금액</td>
		<td><b class=red><?php echo number_format($TPL_VAR["settleprice"])?>원</b></td>
	</tr>
	</table>

	</td>
</tr>
</table><div style="font-size:0;height:5px"></div>
<?php }?>

</form>

<!-- 04-2 신용카드 --><?php if($TPL_VAR["settlekind"]=="c"){?>
<table width=100% style="border:1px solid #DEDEDE" cellpadding=0 cellspacing=0>
<tr>
	<td width=150 valign=top align=right bgcolor="#F3F3F3"><img src="/shop/data/skin/loosfly/img/common/order_step_04.gif"></td>
	<td id="orderbox">

	<table width=100%>
	<col width=100>
	<tr>
		<td>카드결제</td>
		<td>신용카드</td>
	</tr>
	<tr>
		<td>결제금액</td>
		<td><b class=red><?php echo number_format($TPL_VAR["settleprice"])?>원</b></td>
	</tr>
	</table>

<?php $this->print_("card_gate",$TPL_SCP,1);?>


	</td>
</tr>
</table><div style="font-size:0;height:5px"></div>

<!-- 04-3 계좌이체 --><?php }elseif($TPL_VAR["settlekind"]=="o"){?>
<table width=100% style="border:1px solid #DEDEDE" cellpadding=0 cellspacing=0>
<tr>
	<td width=150 valign=top align=right bgcolor="#F3F3F3"><img src="/shop/data/skin/loosfly/img/common/order_step_04.gif"></td>
	<td id="orderbox">

	<table width=100%>
	<col width=100>
	<tr>
		<td>결제방법</td>
		<td>계좌이체</td>
	</tr>
	<tr>
		<td>결제금액</td>
		<td><b class=red><?php echo number_format($TPL_VAR["settleprice"])?>원</b></td>
	</tr>
	</table>

<?php $this->print_("card_gate",$TPL_SCP,1);?>


	</td>
</tr>
</table><div style="font-size:0;height:5px"></div>

<!-- 04-4 가상계좌 --><?php }elseif($TPL_VAR["settlekind"]=="v"){?>
<table width=100% style="border:1px solid #DEDEDE" cellpadding=0 cellspacing=0>
<tr>
	<td width=150 valign=top align=right bgcolor="#F3F3F3"><img src="/shop/data/skin/loosfly/img/common/order_step_04.gif"></td>
	<td id="orderbox">

	<table width=100%>
	<col width=100>
	<tr>
		<td>결제방법</td>
		<td>가상계좌</td>
	</tr>
	<tr>
		<td>결제금액</td>
		<td><b class=red><?php echo number_format($TPL_VAR["settleprice"])?>원</b></td>
	</tr>
	</table>

<?php $this->print_("card_gate",$TPL_SCP,1);?>


	</td>
</tr>
</table><div style="font-size:0;height:5px"></div>

<!-- 04-5 핸드폰 --><?php }elseif($TPL_VAR["settlekind"]=="h"){?>
<table width=100% style="border:1px solid #DEDEDE" cellpadding=0 cellspacing=0>
<tr>
	<td width=150 valign=top align=right bgcolor="#F3F3F3"><img src="/shop/data/skin/loosfly/img/common/order_step_04.gif"></td>
	<td id="orderbox">

	<table width=100%>
	<col width=100>
	<tr>
		<td>결제방법</td>
		<td>핸드폰</td>
	</tr>
	<tr>
		<td>결제금액</td>
		<td><b class=red><?php echo number_format($TPL_VAR["settleprice"])?>원</b></td>
	</tr>
	</table>

<?php $this->print_("card_gate",$TPL_SCP,1);?>


	</td>
</tr>
</table><div style="font-size:0;height:5px"></div>
<?php }?>

<div style="padding:20px" align=center id="avoidDblPay">
<a href="javascript:submitSettleForm()"><img src="/shop/data/skin/loosfly/img/common/btn_payment.gif"></a>
<a href="javascript:history.back();"><img src="/shop/data/skin/loosfly/img/common/btn_back.gif"></a>
</div>

</div><!-- End indiv -->


<script>
function submitSettleForm()
{
	var fm = document.frmSettle;

	if (!chkForm(fm)) return;

	/*** 주문필수정보 체크 ***/

	if (document.getElementById('avoidDblPay')) document.getElementById('avoidDblPay').innerHTML = "--- 현재 결제처리중입니다. 잠시만 기다려주세요. ---";

<?php if($GLOBALS["cfg"]["settlePg"]=='dacom'){?>
	window.open("","Window","width=330, height=430, status=yes, scrollbars=no,resizable=yes, menubar=no");
<?php }?>

	fm.submit();
}
</script>

<?php $this->print_("footer",$TPL_SCP,1);?>