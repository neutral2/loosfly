<?php /* Template_ 2.2.7 2013/02/22 10:14:38 /www/loosfly_godo_co_kr/shop/data/skin_mobile/default/ord/order.htm 000015727 */ 
$TPL__r_deli_1=empty($GLOBALS["r_deli"])||!is_array($GLOBALS["r_deli"])?0:count($GLOBALS["r_deli"]);?>
<?php $this->print_("header",$TPL_SCP,1);?>


<?php  $TPL_VAR["page_title"] = "�ֹ��ϱ�";?>
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

<!-- 01 �ֹ������� -->
<fieldset>
<legend>1. �ֹ�������</legend>
	<dl>
		<dt>�ֹ��ڸ�</dt>
		<dd>
			<input type="text" name="nameOrder" value="<?php echo $TPL_VAR["name"]?>" <?php echo $GLOBALS["style_member"]?> required msgR="�ֹ��Ͻôº��� �̸��� �����ּ���">
		</dd>
<?php if($GLOBALS["sess"]){?>
		<dt>�ּ�</dt>
		<dd>
			<span><?php echo $TPL_VAR["address"]?>&nbsp;<?php echo $TPL_VAR["address_sub"]?></span>
		</dd>
<?php }?>
		<dt>��ȭ��ȣ</dt>
		<dd>
			<input type="text" name="phoneOrder[]" value="<?php echo $TPL_VAR["phone"][ 0]?>" size="3" maxlength="3" required /> -
			<input type="text" name="phoneOrder[]" value="<?php echo $TPL_VAR["phone"][ 1]?>" size="4" maxlength="4" required /> -
			<input type="text" name="phoneOrder[]" value="<?php echo $TPL_VAR["phone"][ 2]?>" size="4" maxlength="4" required />
		</dd>
		<dt>�ڵ���</dt>
		<dd>
			<input type="text" name="mobileOrder[]" value="<?php echo $TPL_VAR["mobile"][ 0]?>" size="3" maxlength="3" required /> -
			<input type="text" name="mobileOrder[]" value="<?php echo $TPL_VAR["mobile"][ 1]?>" size="4" maxlength="4" required /> -
			<input type="text" name="mobileOrder[]" value="<?php echo $TPL_VAR["mobile"][ 2]?>" size="4" maxlength="4" required />
		</dd>
		<dt>�̸���</dt>
		<dd><input type="text" name="email" value="<?php echo $TPL_VAR["email"]?>" required option=regEmail /></dd>
	</dl>
</fieldset>

<hr class="wline" />

<!-- 02 ������� -->
<fieldset>
<legend>2. �������</legend>
	<dl>
		<dt>�����</dt>
		<dd>
			<input type="checkbox" onclick="ctrl_field(this.checked)" <?php if($GLOBALS["sess"]){?>checked<?php }?> /> �ֹ��� ������ �����մϴ�
		</dd>
		<dt>�����Ǻ�</dt>
		<dd><input type="text" name="nameReceiver" value="<?php echo $TPL_VAR["name"]?>" required /></dd>
		<dt>�����ȣ</dt>
		<dd>
			<ul class="ul_zipcode">
				<li><input type="text" name="dong" size="9" /></li>
				<li><a href="javascript:search_zipcode();" class="btn_zipcode_search"></a></li>
			</ul>
			<div class="clearb"></div>
			<div id="zipcode_list"></div>
			<div class="zipcode_desc">ã���ô� ��/��/���� �Է��� �ּ���</div>
			<span>
			<input type="text" name="zipcode[]" size=3 readonly value="<?php echo $TPL_VAR["zipcode"][ 0]?>" required /> -
			<input type="text" name="zipcode[]" size=3 readonly value="<?php echo $TPL_VAR["zipcode"][ 1]?>" required />
			</span>
		</dd>
		<dt>�ּ�</dt>
		<dd>
			<input type="text" name="address" readonly value="<?php echo $TPL_VAR["address"]?>" required />
		</dd>
		<dt>�����ּ�</dt>
		<dd>
			<input type="text" name="address_sub" value="<?php echo $TPL_VAR["address_sub"]?>" required label="�����ּ�" />
		</dd>
		<dt>��ȭ��ȣ</dt>
		<dd>
			<input type="text" name="phoneReceiver[]" value="<?php echo $TPL_VAR["phone"][ 0]?>" size="3" maxlength="3" /> -
			<input type="text" name="phoneReceiver[]" value="<?php echo $TPL_VAR["phone"][ 1]?>" size="4" maxlength="4" /> -
			<input type="text" name="phoneReceiver[]" value="<?php echo $TPL_VAR["phone"][ 2]?>" size="4" maxlength="4" />
		</dd>
		<dt>�ڵ���</dt>
		<dd>
			<input type="text" name="mobileReceiver[]" value="<?php echo $TPL_VAR["mobile"][ 0]?>" size="3" maxlength="3" required /> -
			<input type="text" name="mobileReceiver[]" value="<?php echo $TPL_VAR["mobile"][ 1]?>" size="4" maxlength="4" required /> -
			<input type="text" name="mobileReceiver[]" value="<?php echo $TPL_VAR["mobile"][ 2]?>" size="4" maxlength="4" required />
		</dd>
		<dt>����Ǹ���</dt>
		<dd><input type="text" name="memo" size="25" /></dd>
		<dt>��ۼ���</dt>
		<dd>
			<div id="paper_delivery_menu">
				<div><input type="radio" name="deliPoli" value="0" checked onclick="getDelivery()" onblur="chk_emoney(document.frmOrder.emoney)" /> �⺻���</div>
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

<!-- 03 �����ݾ� -->
<fieldset>
<legend>3. �����ݾ�</legend>
	<dl>
		<dt>�հ�ݾ�</dt>
		<dd><span id="paper_goodsprice"><?php echo number_format($TPL_VAR["cart"]->goodsprice)?></span> ��</dd>
		<dt>��ۺ�</dt>
		<dd>
			<div id="paper_delivery_msg1"><span id="paper_delivery"></span> ��</div>
			<div id="paper_delivery_msg2"></div>
		</dd>
<?php if($GLOBALS["sess"]){?>
		<dt>ȸ������</dt>
		<dd><span id='memberdc'><?php echo number_format($TPL_VAR["cart"]->dcprice)?></span> ��</dd>
		<dt>���� ����</dt>
		<dd>
			<ul>
				<li>
					<label>���� : </label>
					<span><input type="text" name="coupon" size="6" style="text-align:right" value="0" readonly> ��
					<a href="javascript:coupon();" class="apply_coupon"><span class="hidden">������ȸ������</span></a></span>
				</li>
				<li>
					<label>���� : </label>
					<span><input type="text" name="coupon_emoney" size="6" style="text-align:right" value="0" readonly> ��</span>
				</li>
			</ul>
			<div id="coupon_list"></div>
		</dd>
		<dt <?php if(!$GLOBALS["member"]["emoney"]){?>class="hidden"<?php }?>>������ ����</dt>
		<dd <?php if(!$GLOBALS["member"]["emoney"]){?>class="hidden"<?php }?>>

			<label>������ :</label>
			<span>
				<input type="text" name="emoney"  size="7" style="text-align:right" value="0" onblur="chk_emoney(this);" onkeyup="calcu_settle();" onkeydown="if (event.keyCode == 13) {return false;}"> ��<br />
				(���������� : <?php echo number_format($GLOBALS["member"]["emoney"])?>��)
			</span>
			<div>
<?php if($GLOBALS["member"]["emoney"]<$GLOBALS["set"]["emoney"]["hold"]){?>
				������������ <?php echo number_format($GLOBALS["set"]["emoney"]["hold"])?>���̻� �� ��� ����Ͻ� �� �ֽ��ϴ�.
<?php }else{?>
<?php if($GLOBALS["emoney_max"]&&$GLOBALS["emoney_max"]>=$GLOBALS["set"]["emoney"]["min"]){?>
					�������� <?php echo number_format($GLOBALS["set"]["emoney"]["min"])?>������ <span id=print_emoney_max><?php echo number_format($GLOBALS["emoney_max"])?></span>������ ����� �����մϴ�.
<?php }elseif($GLOBALS["emoney_max"]&&$GLOBALS["emoney_max"]<$GLOBALS["set"]["emoney"]["min"]){?>
					�������� �ּ� <?php echo number_format($GLOBALS["set"]["emoney"]["min"])?>�� �̻� ����Ͽ��� �մϴ�.
<?php }?>
<?php }?>
				<input type="hidden" name="emoney_max" value="<?php echo $GLOBALS["emoney_max"]?>">
			</div>
		</dd>
<?php }?>

		<?php echo $TPL_VAR["NaverMileageForm"]?>


		<dt>�� �����ݾ�</dt>
		<dd><span id=paper_settlement style="width:146px;text-align:right;font:bold 14px tahoma; color:FF6C68;"><?php echo number_format($TPL_VAR["cart"]->totalprice-$TPL_VAR["cart"]->dcprice)?></span> ��</dd>
	</dl>
</fieldset>

<hr class="wline" />

<!-- 04 �������� -->
<fieldset>
<legend>4. ��������</legend>
	<dl>
		<dt>�Ϲݰ���</dt>
		<dd>
			<input type="hidden" name="escrow" value="N" />
<?php if($GLOBALS["set"]["use"]["a"]){?>
			<div><input type=radio name=settlekind value="a" onclick="input_escrow(this,'N')" />�������Ա�</div>
<?php }?>
<?php if($GLOBALS["set"]["use_mobile"]["c"]){?>
			<div><input type=radio name=settlekind value="c" onclick="input_escrow(this,'N')" />�ſ�ī��</div>
<?php }?>
<?php if($GLOBALS["set"]["use_mobile"]["v"]){?>
			<div><input type=radio name=settlekind value="v" onclick="input_escrow(this,'N')" />�������</div>
<?php }?>
<?php if($GLOBALS["set"]["use_mobile"]["h"]){?>
			<div><input type=radio name=settlekind value="h" onclick="input_escrow(this,'N')" />�ڵ���</div>
<?php }?>
		</dd>

	</dl>
</fieldset>

<?php if($GLOBALS["pg_mobile"]["receipt"]=='Y'&&$GLOBALS["set"]["receipt"]["order"]=='Y'){?>
<!-- 05 ���ݿ��������� -->
<div  id="cash">
<hr class="wline" />

<fieldset>
<legend>5. ���ݿ���������</legend>
	<?php echo $this->define('tpl_include_file_1',"proc/_cashreceiptOrder.htm")?> <?php $this->print_("tpl_include_file_1",$TPL_SCP,1);?>

</fieldset>
</div>
<?php }?>


<div class="btn center">
	<ul>
		<li><button type="submit" class="submit"><span class="hidden">�����ϱ�</span></button></li>
		<li><button type="button" class="cancel" onclick="history.back();"><span class="hidden">����ϱ�</span></button></li>
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
		alert("���������� Ȱ��ȭ�� �� �Ǿ����ϴ�. �����ڿ��� �����ϼ���.");
		return false;
	}

	var obj = document.getElementsByName('settlekind');
	if (obj[0].getAttribute('required') == undefined){
		obj[0].setAttribute('required', '');
		obj[0].setAttribute('label', '��������');
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
		alert("������������ "+ comma(hold) + "�� �̻� �� ��쿡�� ����Ͻ� �� �ֽ��ϴ�.");
		emoney = 0;
	}
	if (min && emoney > 0 && emoney < min){
		alert("�������� " + comma(min) + "�� ���� " + comma(max) + "�� ������ ����� �����մϴ�");
		emoney = 0;
	} else if (max && emoney > max && emoney > 0){
		if(emoney_max < min){
			alert("�ֹ� ��ǰ �ݾ��� �ּ� ��� ������ " + comma(min) + "�� ����  �۽��ϴ�.");
			emoney = 0;
		}else{
			alert("�������� " + comma(min) + "�� ���� " + comma(max) + "�� ������ ����� �����մϴ�");
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

/*** �������� ù��° ��ü �ڵ� ���� ***/
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