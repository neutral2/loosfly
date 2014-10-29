<?php /* Template_ 2.2.7 2013/04/16 10:58:57 /www/loosfly_godo_co_kr/shop/data/skin/loosfly/order/cash_receipt/inipay.htm 000009620 */ ?>
<script language="javascript">
// 영수증 선택에 따른 분류
function RCP1(){
	document.ini.useopt.value="0";	// 소득공제용
	_ID('cert_0').style.display = "block";
	_ID('cert_1').style.display = "none";
}
function RCP2(){
	document.ini.useopt.value="1";	// 지출증빙용
	_ID('cert_0').style.display = "none";
	_ID('cert_1').style.display = "block";
}
function pay()
{
	// 필수항목 체크 (영수증 발행 용도에 따른 사업자번호 길이와 오류 체크)
	// 사업자등록번호의 정상적인 입력여부 확인을 위해 아래의 자바스크립트는 반드시 사용하여야 하며,
	// 사용하지 않을경우 발생된 문제에 대한 책임은 상점에 있습니다.
	// 이니시스에서는 실명확인 서비스를 제공하지 않으니, 실명확인 업체를 이용하시기 바랍니다.
	// 필수항목 체크 (영수증 발행 용도에 따른 사업자번호 길이와 오류 체크)
	// 사업자등록번호의 정상적인 입력여부 확인을 위해 아래의 자바스크립트는 반드시 사용하여야 하며,
	// 사용하지 않을경우 발생된 문제에 대한 책임은 상점에 있습니다.
	// 이니시스에서는 실명확인 서비스를 제공하지 않으니, 실명확인 업체를 이용하시기 바랍니다.
	if(document.ini.useopt.value == "")
	{
		alert("현금영수증 발행용도를 선택하세요. 필수항목입니다.");
		return false;
	}
	else if(document.ini.useopt.value == "0")
	{
		alert("소득공제용 영수증을 선택하셨습니다.");
		if(document.ini.reg_num.value.length !=10 && document.ini.reg_num.value.length !=11)
		{
			alert("올바른 휴대폰 번호 11자리(10자리)를 입력하세요.");
			return false;
		}
		else if(document.ini.reg_num.value.length == 11 ||document.ini.reg_num.value.length == 10 )
		{
			var obj = document.ini.reg_num.value;
			if (obj.substring(0,3)!= "011" && obj.substring(0,3)!= "017" && obj.substring(0,3)!= "016" && obj.substring(0,3)!= "018" && obj.substring(0,3)!= "019" && obj.substring(0,3)!= "010")
			{
				alert("휴대폰 번호가 아니거나, 휴대폰 번호에 오류가 있습니다. 다시 확인 하십시오. ");
				return false;
			}
			var chr;
			for(var i=0; i<obj.length; i++){
				chr = obj.substr(i, 1);
				if( chr < '0' || chr > '9') {
					alert("숫자가 아닌 문자가 휴대폰 번호에 추가되어 오류가 있습니다, 다시 확인 하십시오. ");
					return false;
				}
			}
		}
	}
	else if(document.ini.useopt.value == "1")
	{
		alert("지출증빙용 영수증을 선택하셨습니다.");
		var obj = document.ini.reg_num.value;
		if(document.ini.reg_num.value.length !=10  && document.ini.reg_num.value.length !=11 )
		{
			alert("사업자등록번호 10자리 또는 휴대폰 번호 11 자리(10자리) 를 입력하세요.");
			return false;
		}
		else if(document.ini.reg_num.value.length == 10 && obj.substring(0,1)!= "0"){
   			var vencod = document.ini.reg_num.value;
   			var sum = 0;
   			var getlist =new Array(10);
   			var chkvalue =new Array("1","3","7","1","3","7","1","3","5");
   			for(var i=0; i<10; i++) { getlist[i] = vencod.substring(i, i+1); }
   			for(var i=0; i<9; i++) { sum += getlist[i]*chkvalue[i]; }
   			sum = sum + parseInt((getlist[8]*5)/10);
   			sidliy = sum % 10;
   			sidchk = 0;
   			if(sidliy != 0) { sidchk = 10 - sidliy; }
   			else { sidchk = 0; }
   			if(sidchk != getlist[9]) {
   				alert("사업자등록번호에 오류가 있습니다. 다시 확인하십시오.");
   			    return false;
   			}
   			else return true;
		}
		else if(document.ini.reg_num.value.length == 11 ||document.ini.reg_num.value.length == 10 )
	        {
	        	var obj = document.ini.reg_num.value;
	        	if (obj.substring(0,3)!= "011" && obj.substring(0,3)!= "017" && obj.substring(0,3)!= "016" && obj.substring(0,3)!= "018" && obj.substring(0,3)!= "019" && obj.substring(0,3)!= "010")
	        	{
	        		alert("휴대폰 번호에 오류가 있습니다. 다시 확인 하십시오. ");
	        		return false;
	        	}
	        	var chr;
			for(var i=0; i<obj.length; i++){
	        		chr = obj.substr(i, 1);
	        		if( chr < '0' || chr > '9') {
   					alert("숫자가 아닌 문자가 휴대폰 번호에 추가되어 오류가 있습니다, 다시 확인 하십시오. ");
   					return false;
  				}
			}
	       }
	}
	// 필수항목 체크 (상품명, 현금결제금액, 공급가액, 부가세, 봉사료, 구매자명, 사업자번호(휴대폰번호), 구매자 이메일주소, 구매자 전화번호, )
	if(document.ini.goodname.value == "")
	{
		alert("상품명이 빠졌습니다. 필수항목입니다.");
		return false;
	}
	else if(document.ini.cr_price.value == "")
	{
		alert("현금결제금액이 빠졌습니다. 필수항목입니다.");
		return false;
	}
	else if(document.ini.sup_price.value == "")
	{
		alert("공급가액이 빠졌습니다. 필수항목입니다.");
		return false;
	}
	else if(document.ini.tax.value == "")
	{
		alert("부가세가 빠졌습니다. 필수항목입니다.");
		return false;
	}
	else if(document.ini.srvc_price.value == "")
	{
		alert("봉사료가 빠졌습니다. 필수항목입니다.");
		return false;
	}
	else if(document.ini.buyername.value == "")
	{
		alert("구매자명이 빠졌습니다. 필수항목입니다.");
		return false;
	}
	else if(document.ini.reg_num.value == "")
	{
		alert("사업자번호(휴대폰번호)가 빠졌습니다. 필수항목입니다.");
		return false;
	}
	else if(document.ini.buyeremail.value == "")
	{
		alert("구매자 이메일주소가 빠졌습니다. 필수항목입니다.");
		return false;
	}
	else if(document.ini.buyertel.value == "")
	{
		alert("구매자 전화번호가 빠졌습니다. 필수항목입니다.");
		return false;
	}
	// 현금결제금액 합산 체크
	// 현금결제금액 합산은 아래의 자바스크립트를 통해 반드시 확인 하도록 하시기 바라며,
	// 아래의 자바스크립트를 사용하지 않아 발생된 문제는 상점에 책임이 있습니다.
	var sump = eval(document.ini.sup_price.value) + eval(document.ini.tax.value) + eval(document.ini.srvc_price.value);
	if(document.ini.cr_price.value != sump)
	{
		alert("총결제금액 합이 맞지 않습니다.");
		return false;
	}
	// 더블클릭으로 인한 중복요청을 방지하려면 반드시 confirm()을
	// 사용하십시오.
	if(confirm("현금영수증을 발행하시겠습니까?"))
	{
		disable_click();
		return true;
	}
	else
	{
		return false;
	}
}
function enable_click()
{
	if (document.ini) document.ini.clickcontrol.value = "enable"
}
window.onload = enable_click;
function disable_click()
{
	document.ini.clickcontrol.value = "disable"
}
function popup_receipt()
{
	var showreceiptUrl = "https://iniweb.inicis.com/DefaultWebApp/mall/cr/cm/Cash_mCmReceipt.jsp?noTid=<?php echo $TPL_VAR["cashreceipt"]?>&clpaymethod=22";
	window.open(showreceiptUrl,"showreceipt","width=380,height=540, scrollbars=no,resizable=no");
}
</script>
<table width="100%" style="border:1px solid #DEDEDE" cellpadding="0" cellspacing="0">
<tr>
	<td width="150" valign="top" align="right" bgcolor="#F3F3F3"></td>
	<td id="orderbox">
	<table>
	<col width="100">
	<tr>
		<td>현금영수증</td>
		<td>
<?php if($TPL_VAR["cashreceipt"]){?>
		<a href="javascript:popup_receipt()">현금영수증출력</a>
<?php }elseif($TPL_VAR["cashreceipt"]==''&&$TPL_VAR["step"]== 0){?>
		입금하셔야 현금영수증을 발급하실 수 있습니다.
<?php }elseif($TPL_VAR["cashreceipt"]==''&&$TPL_VAR["step2"]){?>
		취소중이거나 취소된 주문은 현금영수증을 발급하실 수 없습니다.
<?php }elseif($TPL_VAR["cashreceipt"]==''&&$TPL_VAR["step"]&&!$TPL_VAR["step2"]&&$GLOBALS["set"]["receipt"]["period"]&&$TPL_VAR["orddt"]&&(strtotime($TPL_VAR["orddt"])+( 86400*$GLOBALS["set"]["receipt"]["period"]))<time()){?>
		주문일로부터 <?php echo $GLOBALS["set"]["receipt"]["period"]?>일이 경과하여 발행할 수 없습니다. (<?php echo date('y-m-d H:i',(strtotime($TPL_VAR["orddt"])+( 86400*$GLOBALS["set"]["receipt"]["period"])))?>)
<?php }elseif($TPL_VAR["cashreceipt"]==''&&$TPL_VAR["step"]&&!$TPL_VAR["step2"]){?>
		<form name="ini" method="post" action="<?php echo url("order/card/inipay/INIreceipt.php")?>&" onSubmit="return pay(this)" target="ifrmHidden">
		<input type="hidden" name="ordno"			value="<?php echo $TPL_VAR["ordno"]?>" />					<!-- 주문 번호 - PG 처리와는 전혀 상관이 없는 옵션임 -->
		<input type="hidden" name="goodname"		value="<?php echo $GLOBALS["item"][ 0]['goodsnm']?>" />	<!-- 상품명 -->
		<input type="hidden" name="cr_price"		value="<?php echo $TPL_VAR["settleprice"]?>" />			<!-- 결제금액 -->
		<input type="hidden" name="sup_price"		value="<?php echo $GLOBALS["cashReceipt"]["supply"]?>" />	<!-- 공급가액 -->
		<input type="hidden" name="tax"				value="<?php echo $GLOBALS["cashReceipt"]["vat"]?>" />		<!-- 부가세 -->
		<input type="hidden" name="srvc_price"		value="0" />						<!-- 봉사료 -->
		<input type="hidden" name="buyername"		value="<?php echo $TPL_VAR["nameOrder"]?>" />				<!-- 구매자명 -->
		<input type="hidden" name="buyeremail"		value="<?php echo $TPL_VAR["email"]?>" />					<!-- 전자우편 -->
		<input type="hidden" name="buyertel"		value="<?php echo $TPL_VAR["mobileOrder"]?>" />			<!-- 이동전화 -->
		<input type="hidden" name="companynumber"	value="" />							<!-- 서브몰사업자번호 -->
		<!-- 삭제/수정 불가 -->
		<input type="hidden" name="clickcontrol"	value="" />
		<input type="hidden" name="useopt"			value="0" />						<!-- 소득공제용(0) 또는 지출증빙용(1) -->
		<table>
		<tr>
			<td width="100">발행용도</td>
			<td>
			<input type="radio" name="choose" value="1" Onclick= "javascript:RCP1()" checked="checked" />소득공제용
			<input type="radio" name="choose" value="1" Onclick= "javascript:RCP2()" />지출증빙용
			</td>
		</tr>
		<tr>
			<td>
			<span id="cert_0" style="display:block;">휴대폰번호</span>
			<span id="cert_1" style="display:none;">사업자번호</span>
			</td>
			<td><input type="text" name="reg_num" value="<?php echo str_replace('-','',$TPL_VAR["mobileOrder"])?>" class="line" /> <span class="small">("-" 생략)</span></td>
		</tr>
		</table>
		</form>
		<input type="button" value="현금영수증발급요청" name="app_btn" onClick="javascript:if (pay(document.ini)) document.ini.submit();" />
<?php }?>
		</td>
	</tr>
	</table>
	</td>
</tr>
</table>