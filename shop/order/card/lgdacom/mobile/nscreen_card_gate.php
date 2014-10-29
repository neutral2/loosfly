<?php

	include dirname(__FILE__)."/../../../../conf/config.mobileShop.php";
	@include dirname(__FILE__)."/../../../../conf/pg_mobile.lgdacom.php";
	@include dirname(__FILE__)."/../../../../conf/pg.lgdacom.php";

	if(is_array($pg_mobile)) {
		$pg_mobile = array_merge($pg_mobile, $pg);
	}
	else {
		$pg_mobile = $pg;
	}

	$page_type = $_GET['page_type'];

	// ������ ����
	$pg_mobile['zerofee']	= ( $pg_mobile['zerofee'] == "yes" ? '1' : '0' );			// ������ ���� (Y:1 / N:0)

	// ��ǰ ����
	if(!preg_match('/mypage/',$_SERVER['SCRIPT_NAME'])){
		$item = $cart -> item;
	}
	foreach($item as $v){
		$i++;
		if($i == 1) $ordnm = $v['goodsnm'];
	}
	if($i > 1)$ordnm .= " ��".($i-1)."��";

    /*
     * [���� ������û ������(STEP2-1)]
     *
     * ���������������� �⺻ �Ķ���͸� ���õǾ� ������, ������ �ʿ��Ͻ� �Ķ���ʹ� �����޴����� �����Ͻþ� �߰� �Ͻñ� �ٶ��ϴ�.
     */

    /*
     * 1. �⺻���� ������û ���� ����
     *
     * �⺻������ �����Ͽ� �ֽñ� �ٶ��ϴ�.(�Ķ���� ���޽� POST�� ����ϼ���)
     */
    $CST_PLATFORM               = $pg_mobile['serviceType'];					//LG�ڷ��� ���� ���� ����(test:�׽�Ʈ, service:����)
    $CST_MID                    = $pg_mobile['id'];							//�������̵�(LG�ڷ������� ���� �߱޹����� �������̵� �Է��ϼ���)
                                                                        //�׽�Ʈ ���̵�� 't'�� �ݵ�� �����ϰ� �Է��ϼ���.
    $LGD_MID                    = (("test" == $CST_PLATFORM)?"t":"").$pg_mobile['id'];  //�������̵�(�ڵ�����)
    $LGD_OID                    = $_POST['ordno'];						//�ֹ���ȣ(�������� ����ũ�� �ֹ���ȣ�� �Է��ϼ���)
    $LGD_AMOUNT                 = $_POST['settleprice'];				//�����ݾ�("," �� ������ �����ݾ��� �Է��ϼ���)
    $LGD_BUYER                  = $_POST["nameOrder"];					//�����ڸ�
    $LGD_PRODUCTINFO            = $ordnm;								//��ǰ��
    $LGD_BUYEREMAIL             = $_POST["email"];						//������ �̸���
    $LGD_TIMESTAMP              = date(YmdHms);                         //Ÿ�ӽ�����
    $LGD_CUSTOM_SKIN            = $pg_mobile['skin']?$pg_mobile['skin']:"blue";		//�������� ����â ��Ų (red, blue, cyan, green, yellow)
	$LGD_NOINTINF				= $pg_mobile['zerofee'] == '1' ? $pg_mobile['zerofee_period'] : '' ;		// Ư��ī��/Ư�����������ڼ���
	$LGD_INSTALLRANGE			= $pg_mobile['quota'];							// �Ϲ��ҺαⰣ
	$CASHRECEIPTYN				= $pg_mobile['receipt'] == 'Y' ? 'Y' : 'N';	// ���ݿ����� ��뿩�� Y/N

	$LGD_ESCROW_USEYN			= $_POST['escrow'];	// ����ũ�� ��뿩�� Y/N
	$LGD_ESCROW_ZIPCODE			= implode("-",$_POST['zipcode']);
	$LGD_ESCROW_ADDRESS1		= $_POST['address'];
	$LGD_ESCROW_ADDRESS2		= $_POST['address_sub'];
	$LGD_ESCROW_BUYERPHONE		= implode("-",$_POST['mobileOrder']);

	switch ($_POST[settlekind]){
		case "c":	// �ſ�ī��
			$LGD_CUSTOM_USABLEPAY		= "SC0010";
			break;
//		case "o":	// ������ü
//			$LGD_CUSTOM_USABLEPAY		= "SC0030";
//			break;
		case "v":	// �������
			$LGD_CUSTOM_USABLEPAY		= "SC0040";
			break;
		case "h":	// �ڵ���
			$LGD_CUSTOM_USABLEPAY		= "SC0060";
			break;
	}

	$configPath 				= $_SERVER['DOCUMENT_ROOT'].$cfg['rootDir']."/conf/lgdacom"; 						//LG�ڷ��޿��� ������ ȯ������("/conf/lgdacom.conf") ��ġ ����.

	//ssl ���ȼ��� ���� �߰�
	if($_SERVER['SERVER_PORT'] == 80) {
		$Port = "";
	} elseif($_SERVER['SERVER_PORT'] == 443) {
		$Port = "";
	} else {
		$Port = $_SERVER['SERVER_PORT'];
	}

	if (strlen($Port)>0) $Port = ":".$Port;

	$Protocol = $_SERVER['HTTPS']=='on'?'https://':'http://';
	$host = parse_url($_SERVER['HTTP_HOST']);

	if ($host['path']) {
		$Host = $host['path'];
	} else {
		$Host = $host['host'];
	}

    /*
     * �������(������) ���� ������ �Ͻô� ��� �Ʒ� LGD_CASNOTEURL �� �����Ͽ� �ֽñ� �ٶ��ϴ�.
     */
    $LGD_CASNOTEURL				= $Protocol.$Host.$Port.$cfg['rootDir']."/order/card/lgdacom/cas_noteurl.php";

    /*
     * LGD_RETURNURL �� �����Ͽ� �ֽñ� �ٶ��ϴ�. �ݵ�� ���� �������� ������ ����Ʈ�� ��  ȣ��Ʈ�̾�� �մϴ�. �Ʒ� �κ��� �ݵ�� �����Ͻʽÿ�.
     */
    $LGD_RETURNURL				= $Protocol.$Host.$Port.$cfg['rootDir']."/order/card/lgdacom/mobile/nscreen_card_return.php?page_type=".$page_type;

	  /*
     * ISP ī����� ������ �����ISP���(�������� ���������ʴ� �񵿱���)�� ���, LGD_KVPMISPNOTEURL/LGD_KVPMISPWAPURL/LGD_KVPMISPCANCELURL�� �����Ͽ� �ֽñ� �ٶ��ϴ�.
     */
    $LGD_KVPMISPNOTEURL       	=$Protocol.$Host.$Port.$cfg['rootDir']."/order/card/lgdacom/mobile/nscreen_card_return.php?isAsync=Y&uid=".$_SESSION['uid'].'&m_id='.$_SESSION['sess']['m_id'].'&page_type='.$page_type;
    $LGD_KVPMISPWAPURL			=$Protocol.$Host.$Port.$cfg['rootDir']."/order/card/lgdacom/mobile/nscreen_mispwapurl.php?LGD_OID=".$LGD_OID;//ISP ī�� ������, URL ��� �۸� �Է½�, ��ȣ����
    $LGD_KVPMISPCANCELURL     	=$Protocol.$Host.$Port.$cfg['rootDir']."/order/card/lgdacom/mobile/nscreen_Cancel.php?isAsync=Y&page_type=".$page_type;

    /*
     *************************************************
     * 2. MD5 �ؽ���ȣȭ (�������� ������) - BEGIN
     *
     * MD5 �ؽ���ȣȭ�� �ŷ� �������� �������� ����Դϴ�.
     *************************************************
     *
     * �ؽ� ��ȣȭ ����( LGD_MID + LGD_OID + LGD_AMOUNT + LGD_TIMESTAMP + LGD_MERTKEY )
     * LGD_MID          : �������̵�
     * LGD_OID          : �ֹ���ȣ
     * LGD_AMOUNT       : �ݾ�
     * LGD_TIMESTAMP    : Ÿ�ӽ�����
     * LGD_MERTKEY      : ����MertKey (mertkey�� ���������� -> ������� -> ���������������� Ȯ���ϽǼ� �ֽ��ϴ�)
     *
     * MD5 �ؽ������� ��ȣȭ ������ ����
     * LG�ڷ��޿��� �߱��� ����Ű(MertKey)�� ȯ�漳�� ����(lgdacom/conf/mall.conf)�� �ݵ�� �Է��Ͽ� �ֽñ� �ٶ��ϴ�.
     */
    require_once(dirname(__FILE__)."/nscreen_XPayClient.php");
    $xpay = &new XPayClient($configPath, $LGD_PLATFORM);

	$xpay->Init_TX($LGD_MID);

    $LGD_HASHDATA = md5($LGD_MID.$LGD_OID.$LGD_AMOUNT.$LGD_TIMESTAMP.$xpay->config[$LGD_MID]);
    $LGD_CUSTOM_PROCESSTYPE = "TWOTR";
    /*
     *************************************************
     * 2. MD5 �ؽ���ȣȭ (�������� ������) - END
     *************************************************
     */
?>


<script language="javascript" src="http://xpay.uplus.co.kr/xpay/js/xpay_crossplatform.js" type="text/javascript"></script>
<script type="text/javascript">

/*
* iframe���� ����â�� ȣ���Ͻñ⸦ ���Ͻø� iframe���� ���� (������ ���� �Ұ�)
*/
	var LGD_window_type = "submit";
/*
* �����Ұ�
*/
function launchCrossPlatform(){
      lgdwin = open_paymentwindow(document.getElementById('LGD_PAYINFO'), '<?= $CST_PLATFORM ?>', LGD_window_type);
}
/*
* FORM ��  ���� ����
*/
function getFormObject() {
        return document.getElementById("LGD_PAYINFO");
}
/*
* �Ϲݿ� ��������(�Լ����� ���� �Ұ�)
*/
function setLGDResult(){
	if( LGD_window_type == 'iframe' ){
		document.getElementById('LGD_PAYMENTWINDOW').style.display = "none";
		document.getElementById('LGD_RESPCODE').value = lgdwin.contentWindow.document.getElementById('LGD_RESPCODE').value;
		document.getElementById('LGD_RESPMSG').value = lgdwin.contentWindow.document.getElementById('LGD_RESPMSG').value;
		if(lgdwin.contentWindow.document.getElementById('LGD_PAYKEY') != null){
			document.getElementById('LGD_PAYKEY').value = lgdwin.contentWindow.document.getElementById('LGD_PAYKEY').value;
		}
	}  else {
		document.getElementById('LGD_RESPCODE').value = lgdwin.document.getElementById('LGD_RESPCODE').value;
		document.getElementById('LGD_RESPMSG').value = lgdwin.document.getElementById('LGD_RESPMSG').value;
		if(lgdwin.document.getElementById('LGD_PAYKEY') != null){
			document.getElementById('LGD_PAYKEY').value = lgdwin.document.getElementById('LGD_PAYKEY').value;
		}
	}

	if(document.getElementById('LGD_RESPCODE').value == '0000' ){
		getFormObject().target = "_self";
		getFormObject().action = "cart_return.php";
		getFormObject().submit();
	} else {
		alert(document.getElementById('LGD_RESPMSG').value);
	}

}
/*
* ����Ʈ���� ��������(�Լ����� ���� �Ұ�)
*/

function doSmartXpay(){

        var LGD_RESPCODE        = dpop.getData('LGD_RESPCODE');       //����ڵ�
        var LGD_RESPMSG         = dpop.getData('LGD_RESPMSG');        //����޼���

        if( "0000" == LGD_RESPCODE ) { //��������
            var LGD_PAYKEY      = dpop.getData('LGD_PAYKEY');         //LG�ڷ��� ����KEY
            document.getElementById('LGD_PAYKEY').value = LGD_PAYKEY;
            getFormObject().submit();
        } else { //��������
            alert("������ �����Ͽ����ϴ�. " + LGD_RESPMSG);
        }

}

</script>
<!--  ���� �Ұ�(IFRAME ��Ľ� ���)   -->
<div id="LGD_PAYMENTWINDOW" style="display:none; width:100%;">
     <iframe id="LGD_PAYMENTWINDOW_IFRAME" name="LGD_PAYMENTWINDOW_IFRAME" width="100%" height="100%" scrolling="no" frameborder="0">
     </iframe>
</div>

<form method="post" id="LGD_PAYINFO" action="cart_return.php">

<input type="hidden" name="CST_PLATFORM"                value="<?= $CST_PLATFORM ?>">                   <!-- �׽�Ʈ, ���� ���� -->
<input type="hidden" name="CST_MID"                     value="<?= $CST_MID ?>">                        <!-- �������̵� -->
<input type="hidden" name="LGD_MID"                     value="<?= $LGD_MID ?>">                        <!-- �������̵� -->
<input type="hidden" name="LGD_OID"                     value="<?= $LGD_OID ?>">                        <!-- �ֹ���ȣ -->
<input type="hidden" name="LGD_BUYER"                   value="<?= $LGD_BUYER ?>">           			<!-- ������ -->
<input type="hidden" name="LGD_PRODUCTINFO"             value="<?= $LGD_PRODUCTINFO ?>">     			<!-- ��ǰ���� -->
<input type="hidden" name="LGD_AMOUNT"                  value="<?= $LGD_AMOUNT ?>">                     <!-- �����ݾ� -->
<input type="hidden" name="LGD_BUYEREMAIL"              value="<?= $LGD_BUYEREMAIL ?>">                 <!-- ������ �̸��� -->
<input type="hidden" name="LGD_CUSTOM_SKIN"             value="<?= $LGD_CUSTOM_SKIN ?>">                <!-- ����â SKIN -->
<input type="hidden" name="LGD_CUSTOM_PROCESSTYPE"      value="<?= $LGD_CUSTOM_PROCESSTYPE ?>">         <!-- Ʈ����� ó����� -->
<input type="hidden" name="LGD_TIMESTAMP"               value="<?= $LGD_TIMESTAMP ?>">                  <!-- Ÿ�ӽ����� -->
<input type="hidden" name="LGD_HASHDATA"                value="<?= $LGD_HASHDATA ?>">                   <!-- MD5 �ؽ���ȣ�� -->
<input type="hidden" name="LGD_VERSION"         		value="PHP_SmartXPay_1.0">				   	    <!-- �������� (�������� ������) -->
<input type="hidden" name="LGD_USABLECARD"  			value="">							<!-- ��밡���� �ſ�ī��  -->

<!-- �������(������) ���������� �Ͻô� ���  �Ҵ�/�Ա� ����� �뺸�ޱ� ���� �ݵ�� LGD_CASNOTEURL ������ LG �ڷ��޿� �����ؾ� �մϴ� . -->
<!-- input type="hidden" name="LGD_CASNOTEURL"          	value="<?= $LGD_CASNOTEURL ?>"-->			<!-- ������� NOTEURL -->
<input type="hidden" name="LGD_RETURNURL"   			value="<?= $LGD_RETURNURL ?>">      			<!-- �������������-->
<input type="hidden" name="LGD_CUSTOM_USABLEPAY"   		value="<?= $LGD_CUSTOM_USABLEPAY ?>">			<!-- ��밡�ɰ�������-->

<? if( $_POST[settlekind] == 'c') { ?>
<!-- �Һΰ��� ����â ��� ���� �������� hidden���� -->
<input type="hidden" name="LGD_INSTALLRANGE"			value="<?= $LGD_INSTALLRANGE ?>">				<!-- �Һΰ��� ����-->
<!-- ������ �Һ�(������ �����δ�) ���θ� �����ϴ� hidden���� -->
<input type="hidden" name="LGD_NOINTINF"				value="<?= $LGD_NOINTINF ?>">					<!-- �ſ�ī�� ������ �Һ� �����ϱ� -->
<? } ?>

<? if( $_POST[settlekind] == 'o' || $_POST[settlekind] == 'v' ) { ?>
<!--������ü|�������Ա�(�������)-->
<input type="hidden" name="LGD_CASHRECEIPTYN"			value="<?= $CASHRECEIPTYN ?>">					<!-- ���ݿ����� �̻�뿩��(Y:�̻��,N:���) -->
<? } ?>

<? if( $_POST[settlekind] == 'v'){ ?>
<!-- �������(������) ���������� �Ͻô� ���  �Ҵ�/�Ա� ����� �뺸�ޱ� ���� �ݵ�� LGD_CASNOTEURL ������ LG �����޿� �����ؾ� �մϴ� . -->
<input type="hidden" name="LGD_CASNOTEURL"          	value="<?= $LGD_CASNOTEURL ?>">			<!-- ������� NOTEURL -->
<? } ?>

<input type="hidden" name="LGD_ESCROW_USEYN"			value="<?= $LGD_ESCROW_USEYN; ?>">					<!-- ����ũ�� ���� : ����(Y),������(N)-->
<? if($LGD_ESCROW_USEYN == 'Y'){ ?>
	<? foreach($cart->item as $row) { ?>
	<input type="hidden" name="LGD_ESCROW_GOODID"			value="<?=$row['goodsno']?>">						<!-- ����ũ�λ�ǰ��ȣ -->
	<input type="hidden" name="LGD_ESCROW_GOODNAME"			value="<?=$row['goodsnm']?>">						<!-- ����ũ�λ�ǰ�� -->
	<input type="hidden" name="LGD_ESCROW_GOODCODE"			value="">								<!-- ����ũ�λ�ǰ�ڵ� -->
	<input type="hidden" name="LGD_ESCROW_UNITPRICE"		value="<?=$row['price']+$row['addprice']?>">			<!-- ����ũ�λ�ǰ���� -->
	<input type="hidden" name="LGD_ESCROW_QUANTITY"			value="<?=$row['ea']?>">							<!-- ����ũ�λ�ǰ���� -->
	<?}?>
<input type="hidden" name="LGD_ESCROW_ZIPCODE" value="<?= $LGD_ESCROW_ZIPCODE ?>">		<!-- ����ũ�ι���������ȣ -->
<input type="hidden" name="LGD_ESCROW_ADDRESS1"	value="<?= $LGD_ESCROW_ADDRESS1 ?>">						<!-- ����ũ�ι�����ּҵ����� -->
<input type="hidden" name="LGD_ESCROW_ADDRESS2"	value="<?= $LGD_ESCROW_ADDRESS2 ?>">					<!-- ����ũ�ι�����ּһ� -->
<input type="hidden" name="LGD_ESCROW_BUYERPHONE" value="<?= $LGD_ESCROW_BUYERPHONE ?>">	<!-- ����ũ�α������޴�����ȣ -->
<? } ?>


<!--
****************************************************
* �ȵ���̵��� �ſ�ī�� ISP(����/BC)�������� ���� (����)*
****************************************************

(����)LGD_CUSTOM_ROLLBACK �� ����  "Y"�� �ѱ� ���, LG U+ ���ڰ������� ���� ISP(����/��) ���������� �������� note_url���� ���Ž�  "OK" ������ �ȵǸ�  �ش� Ʈ�������  ������ �ѹ�(�ڵ����)ó���ǰ�,
LGD_CUSTOM_ROLLBACK �� �� �� "C"�� �ѱ� ���, �������� note_url���� "ROLLBACK" ������ �� ���� �ش� Ʈ�������  �ѹ�ó���Ǹ�  �׿��� ���� ���ϵǸ� ���� ���οϷ� ó���˴ϴ�.
����, LGD_CUSTOM_ROLLBACK �� ���� "N" �̰ų� null �� ���, �������� note_url����  "OK" ������  �ȵɽ�, "OK" ������ �� ������ 3�а������� 2�ð�����  ���ΰ���� �������մϴ�.
-->

<input type="hidden" name="LGD_CUSTOM_ROLLBACK"         value="Y">				   	   				   <!-- �񵿱� ISP���� Ʈ����� ó������ -->
<input type="hidden" name="LGD_KVPMISPNOTEURL"  		value="<?= $LGD_KVPMISPNOTEURL ?>">			   <!-- �񵿱� ISP(ex. �ȵ���̵�) ���ΰ���� �޴� URL -->
<input type="hidden" name="LGD_KVPMISPWAPURL"  			value="<?= $LGD_KVPMISPWAPURL ?>">			   <!-- �񵿱� ISP(ex. �ȵ���̵�) ���οϷ��� ����ڿ��� �������� ���οϷ� URL -->
<input type="hidden" name="LGD_KVPMISPCANCELURL"  		value="<?= $LGD_KVPMISPCANCELURL ?>">		   <!-- ISP �ۿ��� ��ҽ� ����ڿ��� �������� ��� URL -->

<!--
****************************************************
* �ȵ���̵��� �ſ�ī�� ISP(����/BC)�������� ����    (��) *
****************************************************
-->

<input type="hidden" name="LGD_KVPMISPAUTOAPPYN"         value="Y">
<!-- Y: ���������� ISP�ſ�ī�� ������, ���翡�� 'App To App' ������� ����, BCī��翡�� ���� ���� ������ �ް� ������ ���� �����ϰ��� �Ҷ� ���-->

<!-- ���� �Ұ� ( ���� �� �ڵ� ���� ) -->
<input type="hidden" name="LGD_RESPCODE" id="LGD_RESPCODE">
<input type="hidden" name="LGD_RESPMSG" id="LGD_RESPMSG">
<input type="hidden" name="LGD_PAYKEY"  id="LGD_PAYKEY">
</form>

<script>
$('#LGD_PAYMENTWINDOW_IFRAME').resize(function(){
	if(parseInt($('#LGD_PAYMENTWINDOW_IFRAME').css('width'))>parseInt($('#wrap').css('width'))){
		$('#wrap').css('width',$('#LGD_PAYMENTWINDOW_IFRAME').css('width'));
	}
	setTimeout(scrollTo, 0, 0, 0);
});
</script>