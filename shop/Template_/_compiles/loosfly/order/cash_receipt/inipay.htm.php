<?php /* Template_ 2.2.7 2013/04/16 10:58:57 /www/loosfly_godo_co_kr/shop/data/skin/loosfly/order/cash_receipt/inipay.htm 000009620 */ ?>
<script language="javascript">
// ������ ���ÿ� ���� �з�
function RCP1(){
	document.ini.useopt.value="0";	// �ҵ������
	_ID('cert_0').style.display = "block";
	_ID('cert_1').style.display = "none";
}
function RCP2(){
	document.ini.useopt.value="1";	// ����������
	_ID('cert_0').style.display = "none";
	_ID('cert_1').style.display = "block";
}
function pay()
{
	// �ʼ��׸� üũ (������ ���� �뵵�� ���� ����ڹ�ȣ ���̿� ���� üũ)
	// ����ڵ�Ϲ�ȣ�� �������� �Է¿��� Ȯ���� ���� �Ʒ��� �ڹٽ�ũ��Ʈ�� �ݵ�� ����Ͽ��� �ϸ�,
	// ������� ������� �߻��� ������ ���� å���� ������ �ֽ��ϴ�.
	// �̴Ͻý������� �Ǹ�Ȯ�� ���񽺸� �������� ������, �Ǹ�Ȯ�� ��ü�� �̿��Ͻñ� �ٶ��ϴ�.
	// �ʼ��׸� üũ (������ ���� �뵵�� ���� ����ڹ�ȣ ���̿� ���� üũ)
	// ����ڵ�Ϲ�ȣ�� �������� �Է¿��� Ȯ���� ���� �Ʒ��� �ڹٽ�ũ��Ʈ�� �ݵ�� ����Ͽ��� �ϸ�,
	// ������� ������� �߻��� ������ ���� å���� ������ �ֽ��ϴ�.
	// �̴Ͻý������� �Ǹ�Ȯ�� ���񽺸� �������� ������, �Ǹ�Ȯ�� ��ü�� �̿��Ͻñ� �ٶ��ϴ�.
	if(document.ini.useopt.value == "")
	{
		alert("���ݿ����� ����뵵�� �����ϼ���. �ʼ��׸��Դϴ�.");
		return false;
	}
	else if(document.ini.useopt.value == "0")
	{
		alert("�ҵ������ �������� �����ϼ̽��ϴ�.");
		if(document.ini.reg_num.value.length !=10 && document.ini.reg_num.value.length !=11)
		{
			alert("�ùٸ� �޴��� ��ȣ 11�ڸ�(10�ڸ�)�� �Է��ϼ���.");
			return false;
		}
		else if(document.ini.reg_num.value.length == 11 ||document.ini.reg_num.value.length == 10 )
		{
			var obj = document.ini.reg_num.value;
			if (obj.substring(0,3)!= "011" && obj.substring(0,3)!= "017" && obj.substring(0,3)!= "016" && obj.substring(0,3)!= "018" && obj.substring(0,3)!= "019" && obj.substring(0,3)!= "010")
			{
				alert("�޴��� ��ȣ�� �ƴϰų�, �޴��� ��ȣ�� ������ �ֽ��ϴ�. �ٽ� Ȯ�� �Ͻʽÿ�. ");
				return false;
			}
			var chr;
			for(var i=0; i<obj.length; i++){
				chr = obj.substr(i, 1);
				if( chr < '0' || chr > '9') {
					alert("���ڰ� �ƴ� ���ڰ� �޴��� ��ȣ�� �߰��Ǿ� ������ �ֽ��ϴ�, �ٽ� Ȯ�� �Ͻʽÿ�. ");
					return false;
				}
			}
		}
	}
	else if(document.ini.useopt.value == "1")
	{
		alert("���������� �������� �����ϼ̽��ϴ�.");
		var obj = document.ini.reg_num.value;
		if(document.ini.reg_num.value.length !=10  && document.ini.reg_num.value.length !=11 )
		{
			alert("����ڵ�Ϲ�ȣ 10�ڸ� �Ǵ� �޴��� ��ȣ 11 �ڸ�(10�ڸ�) �� �Է��ϼ���.");
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
   				alert("����ڵ�Ϲ�ȣ�� ������ �ֽ��ϴ�. �ٽ� Ȯ���Ͻʽÿ�.");
   			    return false;
   			}
   			else return true;
		}
		else if(document.ini.reg_num.value.length == 11 ||document.ini.reg_num.value.length == 10 )
	        {
	        	var obj = document.ini.reg_num.value;
	        	if (obj.substring(0,3)!= "011" && obj.substring(0,3)!= "017" && obj.substring(0,3)!= "016" && obj.substring(0,3)!= "018" && obj.substring(0,3)!= "019" && obj.substring(0,3)!= "010")
	        	{
	        		alert("�޴��� ��ȣ�� ������ �ֽ��ϴ�. �ٽ� Ȯ�� �Ͻʽÿ�. ");
	        		return false;
	        	}
	        	var chr;
			for(var i=0; i<obj.length; i++){
	        		chr = obj.substr(i, 1);
	        		if( chr < '0' || chr > '9') {
   					alert("���ڰ� �ƴ� ���ڰ� �޴��� ��ȣ�� �߰��Ǿ� ������ �ֽ��ϴ�, �ٽ� Ȯ�� �Ͻʽÿ�. ");
   					return false;
  				}
			}
	       }
	}
	// �ʼ��׸� üũ (��ǰ��, ���ݰ����ݾ�, ���ް���, �ΰ���, �����, �����ڸ�, ����ڹ�ȣ(�޴�����ȣ), ������ �̸����ּ�, ������ ��ȭ��ȣ, )
	if(document.ini.goodname.value == "")
	{
		alert("��ǰ���� �������ϴ�. �ʼ��׸��Դϴ�.");
		return false;
	}
	else if(document.ini.cr_price.value == "")
	{
		alert("���ݰ����ݾ��� �������ϴ�. �ʼ��׸��Դϴ�.");
		return false;
	}
	else if(document.ini.sup_price.value == "")
	{
		alert("���ް����� �������ϴ�. �ʼ��׸��Դϴ�.");
		return false;
	}
	else if(document.ini.tax.value == "")
	{
		alert("�ΰ����� �������ϴ�. �ʼ��׸��Դϴ�.");
		return false;
	}
	else if(document.ini.srvc_price.value == "")
	{
		alert("����ᰡ �������ϴ�. �ʼ��׸��Դϴ�.");
		return false;
	}
	else if(document.ini.buyername.value == "")
	{
		alert("�����ڸ��� �������ϴ�. �ʼ��׸��Դϴ�.");
		return false;
	}
	else if(document.ini.reg_num.value == "")
	{
		alert("����ڹ�ȣ(�޴�����ȣ)�� �������ϴ�. �ʼ��׸��Դϴ�.");
		return false;
	}
	else if(document.ini.buyeremail.value == "")
	{
		alert("������ �̸����ּҰ� �������ϴ�. �ʼ��׸��Դϴ�.");
		return false;
	}
	else if(document.ini.buyertel.value == "")
	{
		alert("������ ��ȭ��ȣ�� �������ϴ�. �ʼ��׸��Դϴ�.");
		return false;
	}
	// ���ݰ����ݾ� �ջ� üũ
	// ���ݰ����ݾ� �ջ��� �Ʒ��� �ڹٽ�ũ��Ʈ�� ���� �ݵ�� Ȯ�� �ϵ��� �Ͻñ� �ٶ��,
	// �Ʒ��� �ڹٽ�ũ��Ʈ�� ������� �ʾ� �߻��� ������ ������ å���� �ֽ��ϴ�.
	var sump = eval(document.ini.sup_price.value) + eval(document.ini.tax.value) + eval(document.ini.srvc_price.value);
	if(document.ini.cr_price.value != sump)
	{
		alert("�Ѱ����ݾ� ���� ���� �ʽ��ϴ�.");
		return false;
	}
	// ����Ŭ������ ���� �ߺ���û�� �����Ϸ��� �ݵ�� confirm()��
	// ����Ͻʽÿ�.
	if(confirm("���ݿ������� �����Ͻðڽ��ϱ�?"))
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
		<td>���ݿ�����</td>
		<td>
<?php if($TPL_VAR["cashreceipt"]){?>
		<a href="javascript:popup_receipt()">���ݿ��������</a>
<?php }elseif($TPL_VAR["cashreceipt"]==''&&$TPL_VAR["step"]== 0){?>
		�Ա��ϼž� ���ݿ������� �߱��Ͻ� �� �ֽ��ϴ�.
<?php }elseif($TPL_VAR["cashreceipt"]==''&&$TPL_VAR["step2"]){?>
		������̰ų� ��ҵ� �ֹ��� ���ݿ������� �߱��Ͻ� �� �����ϴ�.
<?php }elseif($TPL_VAR["cashreceipt"]==''&&$TPL_VAR["step"]&&!$TPL_VAR["step2"]&&$GLOBALS["set"]["receipt"]["period"]&&$TPL_VAR["orddt"]&&(strtotime($TPL_VAR["orddt"])+( 86400*$GLOBALS["set"]["receipt"]["period"]))<time()){?>
		�ֹ��Ϸκ��� <?php echo $GLOBALS["set"]["receipt"]["period"]?>���� ����Ͽ� ������ �� �����ϴ�. (<?php echo date('y-m-d H:i',(strtotime($TPL_VAR["orddt"])+( 86400*$GLOBALS["set"]["receipt"]["period"])))?>)
<?php }elseif($TPL_VAR["cashreceipt"]==''&&$TPL_VAR["step"]&&!$TPL_VAR["step2"]){?>
		<form name="ini" method="post" action="<?php echo url("order/card/inipay/INIreceipt.php")?>&" onSubmit="return pay(this)" target="ifrmHidden">
		<input type="hidden" name="ordno"			value="<?php echo $TPL_VAR["ordno"]?>" />					<!-- �ֹ� ��ȣ - PG ó���ʹ� ���� ����� ���� �ɼ��� -->
		<input type="hidden" name="goodname"		value="<?php echo $GLOBALS["item"][ 0]['goodsnm']?>" />	<!-- ��ǰ�� -->
		<input type="hidden" name="cr_price"		value="<?php echo $TPL_VAR["settleprice"]?>" />			<!-- �����ݾ� -->
		<input type="hidden" name="sup_price"		value="<?php echo $GLOBALS["cashReceipt"]["supply"]?>" />	<!-- ���ް��� -->
		<input type="hidden" name="tax"				value="<?php echo $GLOBALS["cashReceipt"]["vat"]?>" />		<!-- �ΰ��� -->
		<input type="hidden" name="srvc_price"		value="0" />						<!-- ����� -->
		<input type="hidden" name="buyername"		value="<?php echo $TPL_VAR["nameOrder"]?>" />				<!-- �����ڸ� -->
		<input type="hidden" name="buyeremail"		value="<?php echo $TPL_VAR["email"]?>" />					<!-- ���ڿ��� -->
		<input type="hidden" name="buyertel"		value="<?php echo $TPL_VAR["mobileOrder"]?>" />			<!-- �̵���ȭ -->
		<input type="hidden" name="companynumber"	value="" />							<!-- ���������ڹ�ȣ -->
		<!-- ����/���� �Ұ� -->
		<input type="hidden" name="clickcontrol"	value="" />
		<input type="hidden" name="useopt"			value="0" />						<!-- �ҵ������(0) �Ǵ� ����������(1) -->
		<table>
		<tr>
			<td width="100">����뵵</td>
			<td>
			<input type="radio" name="choose" value="1" Onclick= "javascript:RCP1()" checked="checked" />�ҵ������
			<input type="radio" name="choose" value="1" Onclick= "javascript:RCP2()" />����������
			</td>
		</tr>
		<tr>
			<td>
			<span id="cert_0" style="display:block;">�޴�����ȣ</span>
			<span id="cert_1" style="display:none;">����ڹ�ȣ</span>
			</td>
			<td><input type="text" name="reg_num" value="<?php echo str_replace('-','',$TPL_VAR["mobileOrder"])?>" class="line" /> <span class="small">("-" ����)</span></td>
		</tr>
		</table>
		</form>
		<input type="button" value="���ݿ������߱޿�û" name="app_btn" onClick="javascript:if (pay(document.ini)) document.ini.submit();" />
<?php }?>
		</td>
	</tr>
	</table>
	</td>
</tr>
</table>