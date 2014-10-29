<?php /* Template_ 2.2.7 2013/02/22 10:14:38 /www/loosfly_godo_co_kr/shop/data/skin_mobile/default/ord/order.htm 000015727 */ 
$TPL__r_deli_1=empty($GLOBALS["r_deli"])||!is_array($GLOBALS["r_deli"])?0:count($GLOBALS["r_deli"]);?>
<?php $this->print_("header",$TPL_SCP,1);?>


<?php  $TPL_VAR["page_title"] = "주문하기";?>
<?php $this->print_("sub_header",$TPL_SCP,1);?>

<?php echo $TPL_VAR["NaverMileageScript"]?>

<script id="delivery"></script>

<section id="order">

<form id="form" name="frmOrder" action="settle.php" method="post" onsubmit="return chkForm2(this)">
<input type="hidden" name="ordno" value="<?php echo $TPL_VAR["ordno"]?>">
<?php if(is_array($TPL_R1=$TPL_VAR["cart"]->item)&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?>
<input type="hidden" name=item_apply_coupon[]>
<?php }}?>

<div id="apply_coupon"></div>

<!-- 01 주문자정보 -->
<fieldset>
<legend>1. 주문자정보</legend>
	<dl>
		<dt>주문자명</dt>
		<dd>
			<input type="text" name="nameOrder" value="<?php echo $TPL_VAR["name"]?>" <?php echo $GLOBALS["style_member"]?> required msgR="주문하시는분의 이름을 적어주세요">
		</dd>
<?php if($GLOBALS["sess"]){?>
		<dt>주소</dt>
		<dd>
			<span><?php echo $TPL_VAR["address"]?>&nbsp;<?php echo $TPL_VAR["address_sub"]?></span>
		</dd>
<?php }?>
		<dt>전화번호</dt>
		<dd>
			<input type="text" name="phoneOrder[]" value="<?php echo $TPL_VAR["phone"][ 0]?>" size="3" maxlength="3" required /> -
			<input type="text" name="phoneOrder[]" value="<?php echo $TPL_VAR["phone"][ 1]?>" size="4" maxlength="4" required /> -
			<input type="text" name="phoneOrder[]" value="<?php echo $TPL_VAR["phone"][ 2]?>" size="4" maxlength="4" required />
		</dd>
		<dt>핸드폰</dt>
		<dd>
			<input type="text" name="mobileOrder[]" value="<?php echo $TPL_VAR["mobile"][ 0]?>" size="3" maxlength="3" required /> -
			<input type="text" name="mobileOrder[]" value="<?php echo $TPL_VAR["mobile"][ 1]?>" size="4" maxlength="4" required /> -
			<input type="text" name="mobileOrder[]" value="<?php echo $TPL_VAR["mobile"][ 2]?>" size="4" maxlength="4" required />
		</dd>
		<dt>이메일</dt>
		<dd><input type="text" name="email" value="<?php echo $TPL_VAR["email"]?>" required option=regEmail /></dd>
	</dl>
</fieldset>

<hr class="wline" />

<!-- 02 배송정보 -->
<fieldset>
<legend>2. 배송정보</legend>
	<dl>
		<dt>배송지</dt>
		<dd>
			<input type="checkbox" onclick="ctrl_field(this.checked)" <?php if($GLOBALS["sess"]){?>checked<?php }?> /> 주문고객 정보와 동일합니다
		</dd>
		<dt>받으실분</dt>
		<dd><input type="text" name="nameReceiver" value="<?php echo $TPL_VAR["name"]?>" required /></dd>
		<dt>우편번호</dt>
		<dd>
			<ul class="ul_zipcode">
				<li><input type="text" name="dong" size="9" /></li>
				<li><a href="javascript:search_zipcode();" class="btn_zipcode_search"></a></li>
			</ul>
			<div class="clearb"></div>
			<div id="zipcode_list"></div>
			<div class="zipcode_desc">찾으시는 읍/면/동을 입력해 주세요</div>
			<span>
			<input type="text" name="zipcode[]" size=3 readonly value="<?php echo $TPL_VAR["zipcode"][ 0]?>" required /> -
			<input type="text" name="zipcode[]" size=3 readonly value="<?php echo $TPL_VAR["zipcode"][ 1]?>" required />
			</span>
		</dd>
		<dt>주소</dt>
		<dd>
			<input type="text" name="address" readonly value="<?php echo $TPL_VAR["address"]?>" required />
		</dd>
		<dt>세부주소</dt>
		<dd>
			<input type="text" name="address_sub" value="<?php echo $TPL_VAR["address_sub"]?>" required label="세부주소" />
		</dd>
		<dt>전화번호</dt>
		<dd>
			<input type="text" name="phoneReceiver[]" value="<?php echo $TPL_VAR["phone"][ 0]?>" size="3" maxlength="3" /> -
			<input type="text" name="phoneReceiver[]" value="<?php echo $TPL_VAR["phone"][ 1]?>" size="4" maxlength="4" /> -
			<input type="text" name="phoneReceiver[]" value="<?php echo $TPL_VAR["phone"][ 2]?>" size="4" maxlength="4" />
		</dd>
		<dt>핸드폰</dt>
		<dd>
			<input type="text" name="mobileReceiver[]" value="<?php echo $TPL_VAR["mobile"][ 0]?>" size="3" maxlength="3" required /> -
			<input type="text" name="mobileReceiver[]" value="<?php echo $TPL_VAR["mobile"][ 1]?>" size="4" maxlength="4" required /> -
			<input type="text" name="mobileReceiver[]" value="<?php echo $TPL_VAR["mobile"][ 2]?>" size="4" maxlength="4" required />
		</dd>
		<dt>남기실말씀</dt>
		<dd><input type="text" name="memo" size="25" /></dd>
		<dt>배송선택</dt>
		<dd>
			<div id="paper_delivery_menu">
				<div><input type="radio" name="deliPoli" value="0" checked onclick="getDelivery()" onblur="chk_emoney(document.frmOrder.emoney)" /> 기본배송</div>
<?php if($TPL__r_deli_1){$TPL_I1=-1;foreach($GLOBALS["r_deli"] as $TPL_V1){$TPL_I1++;?>
<?php if($TPL_V1){?>
				<div><input type="radio" name="deliPoli" value="<?php echo $TPL_I1+ 1?>" onclick="getDelivery()" onblur="chk_emoney(document.frmOrder.emoney)" /> <?php echo $TPL_V1?></div>
<?php }?>
<?php }}?>
			</div>
		</dd>
	</dl>
</fieldset>

<hr class="wline" />

<!-- 03 결제금액 -->
<fieldset>
<legend>3. 결제금액</legend>
	<dl>
		<dt>합계금액</dt>
		<dd><span id="paper_goodsprice"><?php echo number_format($TPL_VAR["cart"]->goodsprice)?></span> 원</dd>
		<dt>배송비</dt>
		<dd>
			<div id="paper_delivery_msg1"><span id="paper_delivery"></span> 원</div>
			<div id="paper_delivery_msg2"></div>
		</dd>
<?php if($GLOBALS["sess"]){?>
		<dt>회원할인</dt>
		<dd><span id='memberdc'><?php echo number_format($TPL_VAR["cart"]->dcprice)?></span> 원</dd>
		<dt>쿠폰 적용</dt>
		<dd>
			<ul>
				<li>
					<label>할인 : </label>
					<span><input type="text" name="coupon" size="6" style="text-align:right" value="0" readonly> 원
					<a href="javascript:coupon();" class="apply_coupon"><span class="hidden">쿠폰조회및적용</span></a></span>
				</li>
				<li>
					<label>적립 : </label>
					<span><input type="text" name="coupon_emoney" size="6" style="text-align:right" value="0" readonly> 원</span>
				</li>
			</ul>
			<div id="coupon_list"></div>
		</dd>
		<dt <?php if(!$GLOBALS["member"]["emoney"]){?>class="hidden"<?php }?>>적립금 적용</dt>
		<dd <?php if(!$GLOBALS["member"]["emoney"]){?>class="hidden"<?php }?>>

			<label>적립금 :</label>
			<span>
				<input type="text" name="emoney"  size="7" style="text-align:right" value="0" onblur="chk_emoney(this);" onkeyup="calcu_settle();" onkeydown="if (event.keyCode == 13) {return false;}"> 원<br />
				(보유적립금 : <?php echo number_format($GLOBALS["member"]["emoney"])?>원)
			</span>
			<div>
<?php if($GLOBALS["member"]["emoney"]<$GLOBALS["set"]["emoney"]["hold"]){?>
				보유적립금이 <?php echo number_format($GLOBALS["set"]["emoney"]["hold"])?>원이상 일 경우 사용하실 수 있습니다.
<?php }else{?>
<?php if($GLOBALS["emoney_max"]&&$GLOBALS["emoney_max"]>=$GLOBALS["set"]["emoney"]["min"]){?>
					적립금은 <?php echo number_format($GLOBALS["set"]["emoney"]["min"])?>원부터 <span id=print_emoney_max><?php echo number_format($GLOBALS["emoney_max"])?></span>원까지 사용이 가능합니다.
<?php }elseif($GLOBALS["emoney_max"]&&$GLOBALS["emoney_max"]<$GLOBALS["set"]["emoney"]["min"]){?>
					적립금은 최소 <?php echo number_format($GLOBALS["set"]["emoney"]["min"])?>원 이상 사용하여야 합니다.
<?php }?>
<?php }?>
				<input type="hidden" name="emoney_max" value="<?php echo $GLOBALS["emoney_max"]?>">
			</div>
		</dd>
<?php }?>

		<?php echo $TPL_VAR["NaverMileageForm"]?>


		<dt>총 결제금액</dt>
		<dd><span id=paper_settlement style="width:146px;text-align:right;font:bold 14px tahoma; color:FF6C68;"><?php echo number_format($TPL_VAR["cart"]->totalprice-$TPL_VAR["cart"]->dcprice)?></span> 원</dd>
	</dl>
</fieldset>

<hr class="wline" />

<!-- 04 결제수단 -->
<fieldset>
<legend>4. 결제수단</legend>
	<dl>
		<dt>일반결제</dt>
		<dd>
			<input type="hidden" name="escrow" value="N" />
<?php if($GLOBALS["set"]["use"]["a"]){?>
			<div><input type=radio name=settlekind value="a" onclick="input_escrow(this,'N')" />무통장입금</div>
<?php }?>
<?php if($GLOBALS["set"]["use_mobile"]["c"]){?>
			<div><input type=radio name=settlekind value="c" onclick="input_escrow(this,'N')" />신용카드</div>
<?php }?>
<?php if($GLOBALS["set"]["use_mobile"]["v"]){?>
			<div><input type=radio name=settlekind value="v" onclick="input_escrow(this,'N')" />가상계좌</div>
<?php }?>
<?php if($GLOBALS["set"]["use_mobile"]["h"]){?>
			<div><input type=radio name=settlekind value="h" onclick="input_escrow(this,'N')" />핸드폰</div>
<?php }?>
		</dd>

	</dl>
</fieldset>

<?php if($GLOBALS["pg_mobile"]["receipt"]=='Y'&&$GLOBALS["set"]["receipt"]["order"]=='Y'){?>
<!-- 05 현금영수증발행 -->
<div  id="cash">
<hr class="wline" />

<fieldset>
<legend>5. 현금영수증발행</legend>
	<?php echo $this->define('tpl_include_file_1',"proc/_cashreceiptOrder.htm")?> <?php $this->print_("tpl_include_file_1",$TPL_SCP,1);?>

</fieldset>
</div>
<?php }?>


<div class="btn center">
	<ul>
		<li><button type="submit" class="submit"><span class="hidden">결제하기</span></button></li>
		<li><button type="button" class="cancel" onclick="history.back();"><span class="hidden">취소하기</span></button></li>
	</ul>
</div>

</form>

</section>

<div id=dynamic></div>

<script>
var emoney_max = <?php echo $GLOBALS["emoney_max"]?>;
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

	return chkForm(fm);
}

function input_escrow(obj,val)
{
	obj.form.escrow.value = val;
	if (typeof(cash_required) == 'function') cash_required();
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

	var delivery	= uncomma(document.getElementById('paper_delivery').innerHTML);
	var goodsprice = uncomma(document.getElementById('paper_goodsprice').innerText);
<?php if($GLOBALS["set"]["emoney"]["emoney_use_range"]){?>
	var erangeprice = goodsprice + delivery;
<?php }else{?>
	var erangeprice = goodsprice;
<?php }?>
	var max_base = erangeprice - uncomma(_ID('memberdc').innerHTML) - uncomma(document.getElementsByName('coupon')[0].value);
	if( form.coupon ){
		 var coupon = uncomma(form.coupon.value);
	}
	max = getDcprice(max_base,max,<?php echo $GLOBALS["set"]["emoney"]["base"]?>);
	min = parseInt(min);

	if (max > max_base)  max = max_base;
	if( _ID('print_emoney_max') && _ID('print_emoney_max').innerHTML != comma(max)  )_ID('print_emoney_max').innerHTML = comma(max);

	var emoney = uncomma(obj.value);
	if (emoney>my_emoney) emoney = my_emoney;

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
	<?php echo $TPL_VAR["NaverMileageCalc"]?>

	document.getElementById('paper_settlement').innerHTML = comma(settlement);
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

	$.ajax({
		url : '<?php echo $GLOBALS["cfg"]["rootDir"]?>/proc/getdelivery.php',
		type : 'get',
		data : "zipcode="+zipcode+"&deliPoli="+deliPoli+"&coupon="+coupon+"&emoney="+emoney+"&mode="+mode,
		success : function(data) {
			eval(data);
		}
	});
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

function coupon(){
	$('#coupon_list').show();
	$.ajax({
		url : '../proc/coupon_list.php',
		dataType : 'html',
		success : function(result){
			$('#coupon_list').html(result);
		},
		error: function(){
			alert('error');
		}
	});
}
</script>

<?php $this->print_("footer",$TPL_SCP,1);?>