<?php /* Template_ 2.2.7 2013/08/13 18:44:46 /www/loosfly_godo_co_kr/shop/data/skin/loosfly/order/card/inipay.htm 000007792 */ ?>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<meta http-equiv="Cache-Control" content="no-cache"/>
<meta http-equiv="Expires" content="0"/>
<meta http-equiv="Pragma" content="no-cache"/>

<?php if($_SERVER["HTTPS"]=='on'){?>
<script language=javascript src="https://plugin.inicis.com/pay61_secunissl_cross.js"></script>
<?php }else{?>
<script language=javascript src="http://plugin.inicis.com/pay61_secuni_cross.js"></script>
<?php }?>

<script language="javascript">
<!--
StartSmartUpdate();

var openwin;
function pay(frm)
{
	// MakePayMessage()�� ȣ�������ν� �÷������� ȭ�鿡 ��Ÿ����, Hidden Field
	// �� ������ ä������ �˴ϴ�. �Ϲ����� ���, �÷������� ����ó���� �����ϴ� ����
	// �ƴ϶�, �߿��� ������ ��ȣȭ �Ͽ� Hidden Field�� ������ ä��� �����ϸ�,
	// ���� �������� �����Ͱ� ����Ʈ �Ǿ� ���� ó������ �����Ͻñ� �ٶ��ϴ�.
	if(document.ini.clickcontrol.value == "enable")
	{
		if(document.ini.goodname.value == "")	// �ʼ��׸� üũ (��ǰ��, ��ǰ����, �����ڸ�, ������ �̸����ּ�, ������ ��ȭ��ȣ)
		{
			alert("��ǰ���� �������ϴ�. �ʼ��׸��Դϴ�.");
			return false;
		}
		else if(document.ini.buyername.value == "")
		{
			alert("�����ڸ��� �������ϴ�. �ʼ��׸��Դϴ�.");
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
		else if( ( navigator.userAgent.indexOf("MSIE") >= 0 || navigator.appName == 'Microsoft Internet Explorer' ) && (document.INIpay == null || document.INIpay.object == null))	// �÷����� ��ġ���� üũ
		{
			alert("\n�̴����� �÷����� 128�� ��ġ���� �ʾҽ��ϴ�. \n\n������ ������ ���Ͽ� �̴����� �÷����� 128�� ��ġ�� �ʿ��մϴ�. \n\n�ٽ� ��ġ�Ͻ÷��� Ctrl + F5Ű�� �����ðų� �޴��� [����/���ΰ�ħ]�� �����Ͽ� �ֽʽÿ�.");
			return false;
		}
		else
		{
			/******
			 * �÷������� �����ϴ� ���� �����ɼ��� �̰����� ������ �� �ֽ��ϴ�.
			 * (�ڹٽ�ũ��Ʈ�� �̿��� ���� �ɼ�ó��)
			 */

			if (MakePayMessage(frm))
			{
				disable_click();
				return true;
			}
			else
			{
				if( IsPluginModule() ) //pluginŸ�� üũ
				{
					alert("������ ����ϼ̽��ϴ�.");
				}
				return false;
			}
		}
	}
	else
	{
		return false;
	}
}

function enable_click()
{
	document.ini.clickcontrol.value = "enable"
}

function disable_click()
{
	document.ini.clickcontrol.value = "disable"
}

function focus_control()
{
//	if(document.ini.clickcontrol.value == "disable")
//		openwin.focus();
}

// �÷����� ��ġ�� �ùٸ��� Ȯ��
function chkPgFlag(){
	if( ( navigator.userAgent.indexOf("MSIE") >= 0 || navigator.appName == 'Microsoft Internet Explorer' ) && (document.INIpay == null || document.INIpay.object == null)){
		alert('�̴Ͻý� ���ڰ����� ���� �÷����� ��ġ �� �ٽ� �õ� �Ͻʽÿ�.');
		return false;
	}
	return true;
}
//-->
</script>

<body onload="javascript:enable_click()" onFocus="javascript:focus_control()">
<form name="ini" method="post" action="../order/card/inipay/card_return.php" onSubmit="return pay(this)">
<input type="hidden" name="INISettlePrice"	value="<?php echo $TPL_VAR["settleprice"]?>" />				<!-- �����ݾ� - PG ó���ʹ� ���� ����� ���� �ɼ��� indb ���� 1�� üũ �� -->
<input type="hidden" name="ordno"			value="<?php echo $TPL_VAR["ordno"]?>" />						<!-- �ֹ� ��ȣ - PG ó���ʹ� ���� ����� ���� �ɼ��� -->
<input type="hidden" name="escrow"			value="<?php echo $_POST["escrow"]?>" />				<!-- ����ũ�� ���� - PG ó���ʹ� ���� ����� ���� �ɼ��� -->

<input type="hidden" name="gopaymethod"		value="<?php echo $GLOBALS["settlekindCode"]?>" />			<!-- ������� -->
<input type="hidden" name="goodname"		value="<?php echo $GLOBALS["ordnm"]?>" />					<!-- ��ǰ�� -->
<input type="hidden" name="oid"				value="<?php echo $TPL_VAR["ordno"]?>" />						<!-- ���� �ֹ���ȣ -->

<!-- �ֹ��� ���� -->
<input type="hidden" name="buyername"		value="<?php echo $TPL_VAR["nameOrder"]?>" />					<!-- �ֹ��ڸ� -->
<input type="hidden" name="buyertel"		value="<?php if(is_array($TPL_VAR["mobileOrder"])){?><?php echo implode('-',$TPL_VAR["mobileOrder"])?><?php }?>" />			<!-- ������ ����ó -->
<input type="hidden" name="buyeremail"		value="<?php echo $TPL_VAR["email"]?>" />						<!-- ���ڿ��� -->
<input type="hidden" name="parentemail"		value="<?php echo $TPL_VAR["email"]?>" />						<!-- ��ȣ�� ���ڿ��� -->

<!-- ������ ���� -->
<input type="hidden" name="recvname"		value="<?php echo $TPL_VAR["nameReceiver"]?>" />				<!-- ������ �� -->
<input type="hidden" name="recvtel"			value="<?php if(is_array($TPL_VAR["mobileReceiver"])){?><?php echo implode('-',$TPL_VAR["mobileReceiver"])?><?php }?>" />	<!-- ������ ����ó -->
<input type="hidden" name="recvaddr"		value="<?php echo $TPL_VAR["address"]?> <?php echo $TPL_VAR["address_sub"]?>" />	<!-- ������ �ּ� -->
<input type="hidden" name="recvpostnum"		value="<?php if(is_array($TPL_VAR["zipcode"])){?><?php echo implode('-',$TPL_VAR["zipcode"])?><?php }?>" />					<!-- ������ �����ȣ -->
<input type="hidden" name="recvmsg"			value="<?php echo $TPL_VAR["memo"]?>" />						<!-- ���� �޼��� -->

<!-- ��Ÿ���� -->
<input type="hidden" name="currency"		value="WON" />												<!-- ��ȭ�ڵ� -->
<!--input type="hidden" name="ini_logoimage_url" value="http://[����� �̹����ּ�]" /-->				<!-- ���� �ΰ� (�̹����� ũ�� : 90 X 34 pixel) -->
<!--input type="hidden" name="ini_menuarea_url" value="http://[����� �̹����ּ�]" /-->					<!-- ���� �����޴� ��ġ�� �̹��� �߰� (�̹����� ũ�� : ���� ���� ���� - 91 X 148 pixels, �ſ�ī��/ISP/������ü/������� - 91 X 96 pixels, �߰� ��� �ʿ�) -->

<!--
SKIN : �÷����� ��Ų Į�� ���� ��� - 6���� Į��(ORIGINAL, GREEN, ORANGE, BLUE, KAKKI, GRAY)
HPP : ������ �Ǵ� �ǹ� ���� ���ο� ���� HPP(1)�� HPP(2)�� ���� ����(HPP(1):������, HPP(2):�ǹ�).
Card(0): �ſ�ī�� ���ҽÿ� �̴Ͻý� ��ǥ �������� ��쿡 �ʼ������� ���� �ʿ� ( ��ü �������� ��쿡�� ī����� ��࿡ ���� ����) - �ڼ��� ������ �޴��� ����.
OCB : OK CASH BAG ���������� �ſ�ī�� �����ÿ� OK CASH BAG ������ �����Ͻñ� ���Ͻø� "OCB" ���� �ʿ� �� �ܿ� ��쿡�� �����ؾ� �������� ���� �̷����.
no_receipt : ���������ü�� ���ݿ����� ���࿩�� üũ�ڽ� ��Ȱ��ȭ (���ݿ����� �߱� ����� �Ǿ� �־�� ��밡��)
-->
<input type="hidden" name="acceptmethod"	value="SKIN(<?php echo $GLOBALS["pg"]["skin"]?>):HPP(2):Card(0):OCB:<?php if($TPL_VAR["pg"]["receipt"]=="Y"){?>receipt:va_receipt<?php }else{?>no_receipt<?php }?>:cardpoint" />

<!-- �÷����ο� ���ؼ� ���� ä�����ų�, �÷������� �����ϴ� �ʵ� -->
<input type="hidden" name="ini_encfield"	value="<?php echo $TPL_VAR["INIConfEncfield"]?>" />
<input type="hidden" name="ini_certid"		value="<?php echo $TPL_VAR["INIConfCertid"]?>" />
<input type="hidden" name="quotainterest"	value="" />
<input type="hidden" name="paymethod"		value="" />
<input type="hidden" name="cardcode"		value="" />
<input type="hidden" name="cardquota"		value="" />
<input type="hidden" name="rbankcode"		value="" />
<input type="hidden" name="reqsign"			value="DONE" />
<input type="hidden" name="encrypted"		value="" />
<input type="hidden" name="sessionkey"		value="" />
<input type="hidden" name="uid"				value="" />
<input type="hidden" name="sid"				value="" />
<input type="hidden" name="version"			value="4000" />
<input type="hidden" name="clickcontrol"	value="" />
</form>

<!-- �ڵ� ���� -->
<script type="text/javascript" language="javascript">
<!--
enable_click();
focus_control();
//-->
</script>
</body>