<?php
include "../../../../lib/library.php";
include "../../../../conf/config.mobileShop.php";
include "../../../../conf/config.php";
include "../../../../conf/pg_mobile.lgdacom.php";

error_reporting(0);
 
// ���̹� ���ϸ��� ���� ���� API
include dirname(__FILE__)."/../../../../lib/naverNcash.class.php";
$naverNcash = new naverNcash(true);
if ($naverNcash->useyn == 'Y') {
	if ($_POST['LGD_PAYTYPE'] == "SC0040") $ncashResult = $naverNcash->payment_approval($_POST['LGD_OID'], false);
	else $ncashResult = $naverNcash->payment_approval($_POST['LGD_OID'], true);
	if ($ncashResult === false) {
		msg('���̹� ���ϸ��� ��뿡 �����Ͽ����ϴ�.', $cfgMobileShop['mobileShopRootDir'].'/ord/order_fail.php?ordno='.$_POST['LGD_OID'], 'parent');
		exit();
	}
}

//�α�����
$logPath= '../../../../log/lgdacom/mobile/';
$logFilename='lgdacom_log_'.date('Ymd').'.log';

if (!is_dir($logPath)) {
	@mkdir($logPath, 0707);
	@chmod($logPath, 0707);
}
$logfile		= fopen($logPath.$logFilename, 'a+' );
$logInfo	 = '------------------------------------------------------------------------------'.chr(10);
$logInfo	.= 'INFO	['.date('Y-m-d H:i:s').']	START Order log'.chr(10);
foreach ($_POST as $key => $val) {
	$logInfo	.= 'DEBUG	['.date('Y-m-d H:i:s').']	'.$key.'	: '.$val.chr(10);
}
$logInfo	.= 'DEBUG	['.date('Y-m-d H:i:s').']	IP	: '.$_SERVER['REMOTE_ADDR'].chr(10);
$logInfo	.= 'INFO	['.date('Y-m-d H:i:s').']	END Order log'.chr(10);
$logInfo	.= '------------------------------------------------------------------------------'.chr(10).chr(10);
fwrite( $logfile, $logInfo);
fclose( $logfile );

// PG���� ������ üũ �� ��ȿ�� üũ
if (forge_order_check($HTTP_POST_VARS['LGD_OID'],$HTTP_POST_VARS['LGD_AMOUNT']) === false) {
	msg('�ֹ� ������ ���� ������ ���� �ʽ��ϴ�. �ٽ� ���� �ٶ��ϴ�.','../../order_fail.php?ordno='.$HTTP_POST_VARS['LGD_OID'],'parent');
	exit();
}


$isAsync = $HTTP_GET_VARS['isAsync'];	//�����Ŀ��� :�񵿱�(ISP) , �׿� ����
$isSuccess=false;	//������������

if($isAsync=='Y') {	//�񵿱� ISP
	//�񵿱�� ���������� �ȵ�. get���� uid �� m_id�� �޾Ƽ� ���Ǽ���
	$uid=$HTTP_GET_VARS['uid'];
	$m_id=$HTTP_GET_VARS['m_id'];
	$_SESSION['uid']=$uid;
	$sess['m_id']=$m_id;
	
	/*
     * ���������� ���� 
     */
    $LGD_RESPCODE = "";           			// �����ڵ�: 0000(����) �׿� ����
    $LGD_RESPMSG = "";            			// ����޼���
    $LGD_MID = "";                			// �������̵� 
    $LGD_OID = "";                			// �ֹ���ȣ
    $LGD_AMOUNT = "";             			// �ŷ��ݾ�
    $LGD_TID = "";                			// LG���÷������� �ο��� �ŷ���ȣ
    $LGD_PAYTYPE = "";            			// ���������ڵ�
    $LGD_PAYDATE = "";            			// �ŷ��Ͻ�(�����Ͻ�/��ü�Ͻ�)
    $LGD_HASHDATA = "";           			// �ؽ���
    $LGD_FINANCECODE = "";        			// ��������ڵ�(ī������/�����ڵ�/������ڵ�)
    $LGD_FINANCENAME = "";        			// ��������̸�(ī���̸�/�����̸�/������̸�)
    $LGD_ESCROWYN = "";           			// ����ũ�� ���뿩��
    $LGD_TIMESTAMP = "";          			// Ÿ�ӽ�����
    $LGD_FINANCEAUTHNUM = "";     			// ������� ���ι�ȣ(�ſ�ī��, ������ü, ��ǰ��)
	
    /*
     * �ſ�ī�� ������� ����
     */
    $LGD_CARDNUM = "";            			// ī���ȣ(�ſ�ī��)
    $LGD_CARDINSTALLMONTH = "";   			// �Һΰ�����(�ſ�ī��) 
    $LGD_CARDNOINTYN = "";        			// �������Һο���(�ſ�ī��) - '1'�̸� �������Һ� '0'�̸� �Ϲ��Һ�
    $LGD_TRANSAMOUNT = "";        			// ȯ������ݾ�(�ſ�ī��)
    $LGD_EXCHANGERATE = "";       			// ȯ��(�ſ�ī��)

    /*
     * �޴���
     */
    $LGD_PAYTELNUM = "";          			// ������ �̿����ȭ��ȣ

    /*
     * ������ü, ������
     */
    $LGD_ACCOUNTNUM = "";         			// ���¹�ȣ(������ü, �������Ա�) 
    $LGD_CASTAMOUNT = "";         			// �Ա��Ѿ�(�������Ա�)
    $LGD_CASCAMOUNT = "";         			// ���Աݾ�(�������Ա�)
    $LGD_CASFLAG = "";            			// �������Ա� �÷���(�������Ա�) - 'R':�����Ҵ�, 'I':�Ա�, 'C':�Ա���� 
    $LGD_CASSEQNO = "";           			// �Աݼ���(�������Ա�)
    $LGD_CASHRECEIPTNUM = "";     			// ���ݿ����� ���ι�ȣ
    $LGD_CASHRECEIPTSELFYN = "";  			// ���ݿ����������߱������� Y: �����߱��� ����, �׿� : ������
    $LGD_CASHRECEIPTKIND = "";    			// ���ݿ����� ���� 0: �ҵ������ , 1: ����������

    /*
     * OKĳ����
     */
    $LGD_OCBSAVEPOINT = "";       			// OKĳ���� ��������Ʈ
    $LGD_OCBTOTALPOINT = "";      			// OKĳ���� ��������Ʈ
    $LGD_OCBUSABLEPOINT = "";     			// OKĳ���� ��밡�� ����Ʈ

    /*
     * ��������
     */
    $LGD_BUYER = "";              			// ������
    $LGD_PRODUCTINFO = "";        			// ��ǰ��
    $LGD_BUYERID = "";            			// ������ ID
    $LGD_BUYERADDRESS = "";       			// ������ �ּ�
    $LGD_BUYERPHONE = "";         			// ������ ��ȭ��ȣ
    $LGD_BUYEREMAIL = "";         			// ������ �̸���
    $LGD_BUYERSSN = "";           			// ������ �ֹι�ȣ
    $LGD_PRODUCTCODE = "";        			// ��ǰ�ڵ�
    $LGD_RECEIVER = "";           			// ������
    $LGD_RECEIVERPHONE = "";      			// ������ ��ȭ��ȣ
    $LGD_DELIVERYINFO = "";       			// �����
    

    $LGD_RESPCODE            = $HTTP_POST_VARS["LGD_RESPCODE"];
    $LGD_RESPMSG             = $HTTP_POST_VARS["LGD_RESPMSG"];
    $LGD_MID                 = $HTTP_POST_VARS["LGD_MID"];
    $LGD_OID                 = $HTTP_POST_VARS["LGD_OID"];
    $LGD_AMOUNT              = $HTTP_POST_VARS["LGD_AMOUNT"];
    $LGD_TID                 = $HTTP_POST_VARS["LGD_TID"];
    $LGD_PAYTYPE             = $HTTP_POST_VARS["LGD_PAYTYPE"];
    $LGD_PAYDATE             = $HTTP_POST_VARS["LGD_PAYDATE"];
    $LGD_HASHDATA            = $HTTP_POST_VARS["LGD_HASHDATA"];
    $LGD_FINANCECODE         = $HTTP_POST_VARS["LGD_FINANCECODE"];
    $LGD_FINANCENAME         = $HTTP_POST_VARS["LGD_FINANCENAME"];
    $LGD_ESCROWYN            = $HTTP_POST_VARS["LGD_ESCROWYN"];
    $LGD_TRANSAMOUNT         = $HTTP_POST_VARS["LGD_TRANSAMOUNT"];
    $LGD_EXCHANGERATE        = $HTTP_POST_VARS["LGD_EXCHANGERATE"];
    $LGD_CARDNUM             = $HTTP_POST_VARS["LGD_CARDNUM"];
    $LGD_CARDINSTALLMONTH    = $HTTP_POST_VARS["LGD_CARDINSTALLMONTH"];
    $LGD_CARDNOINTYN         = $HTTP_POST_VARS["LGD_CARDNOINTYN"];
    $LGD_TIMESTAMP           = $HTTP_POST_VARS["LGD_TIMESTAMP"];
    $LGD_FINANCEAUTHNUM      = $HTTP_POST_VARS["LGD_FINANCEAUTHNUM"];
    $LGD_PAYTELNUM           = $HTTP_POST_VARS["LGD_PAYTELNUM"];
    $LGD_ACCOUNTNUM          = $HTTP_POST_VARS["LGD_ACCOUNTNUM"];
    $LGD_CASTAMOUNT          = $HTTP_POST_VARS["LGD_CASTAMOUNT"];
    $LGD_CASCAMOUNT          = $HTTP_POST_VARS["LGD_CASCAMOUNT"];
    $LGD_CASFLAG             = $HTTP_POST_VARS["LGD_CASFLAG"];
    $LGD_CASSEQNO            = $HTTP_POST_VARS["LGD_CASSEQNO"];
    $LGD_CASHRECEIPTNUM      = $HTTP_POST_VARS["LGD_CASHRECEIPTNUM"];
    $LGD_CASHRECEIPTSELFYN   = $HTTP_POST_VARS["LGD_CASHRECEIPTSELFYN"];
    $LGD_CASHRECEIPTKIND     = $HTTP_POST_VARS["LGD_CASHRECEIPTKIND"];
    $LGD_OCBSAVEPOINT        = $HTTP_POST_VARS["LGD_OCBSAVEPOINT"];
    $LGD_OCBTOTALPOINT       = $HTTP_POST_VARS["LGD_OCBTOTALPOINT"];
    $LGD_OCBUSABLEPOINT      = $HTTP_POST_VARS["LGD_OCBUSABLEPOINT"];

    $LGD_BUYER               = $HTTP_POST_VARS["LGD_BUYER"];
    $LGD_PRODUCTINFO         = $HTTP_POST_VARS["LGD_PRODUCTINFO"];
    $LGD_BUYERID             = $HTTP_POST_VARS["LGD_BUYERID"];
    $LGD_BUYERADDRESS        = $HTTP_POST_VARS["LGD_BUYERADDRESS"];
    $LGD_BUYERPHONE          = $HTTP_POST_VARS["LGD_BUYERPHONE"];
    $LGD_BUYEREMAIL          = $HTTP_POST_VARS["LGD_BUYEREMAIL"];
    $LGD_BUYERSSN            = $HTTP_POST_VARS["LGD_BUYERSSN"];
    $LGD_PRODUCTCODE         = $HTTP_POST_VARS["LGD_PRODUCTCODE"];
    $LGD_RECEIVER            = $HTTP_POST_VARS["LGD_RECEIVER"];
    $LGD_RECEIVERPHONE       = $HTTP_POST_VARS["LGD_RECEIVERPHONE"];
    $LGD_DELIVERYINFO        = $HTTP_POST_VARS["LGD_DELIVERYINFO"];

    $LGD_MERTKEY = $pg_mobile['mertkey'];  //LG���÷������� �߱��� ����Ű�� ������ �ֽñ� �ٶ��ϴ�.
       
    $LGD_HASHDATA2 = md5($LGD_MID.$LGD_OID.$LGD_AMOUNT.$LGD_RESPCODE.$LGD_TIMESTAMP.$LGD_MERTKEY); 

    /*
     * ���� ó����� ���ϸ޼���
     *
     * OK   : ���� ó����� ����
     * �׿� : ���� ó����� ����
     *
     * �� ���ǻ��� : ������ 'OK' �����̿��� �ٸ����ڿ��� ���ԵǸ� ����ó�� �ǿ��� �����Ͻñ� �ٶ��ϴ�.
     */    
    $resultMSG = "������� ���� DBó��(NOTE_URL) ������� �Է��� �ֽñ� �ٶ��ϴ�.";

	if ($LGD_HASHDATA2 == $LGD_HASHDATA) {      //�ؽ��� ������ �����ϸ�
        if($LGD_RESPCODE == "0000"){            //������ �����̸�
			$isSuccess=true;
            /*
             * �ŷ����� ��� ���� ó��(DB) �κ�
             * ���� ��� ó���� �����̸� "OK"
             */    
            //if( �������� ����ó����� ���� ) 
            $resultMSG = "OK";   
        }else {                                 //������ �����̸�
            /*
             * �ŷ����� ��� ���� ó��(DB) �κ�
             * ������� ó���� �����̸� "OK"
             */  
           //if( �������� ����ó����� ���� ) 
           $resultMSG = $LGD_RESPMSG;
        }
	} else {                                    //�ؽ��� ������ �����̸�
        /*
         * hashdata���� ���� �α׸� ó���Ͻñ� �ٶ��ϴ�. 
         */  
		$resultMSG = "������� ���� DBó��(NOTE_URL) �ؽ��� ������ �����Ͽ����ϴ�.";         
    }
}
else{	//�� ��
	
	/*
     * [����������û ������(STEP2-2)]
     *
     * LG���÷������� ���� �������� LGD_PAYKEY(����Key)�� ������ ���� ������û.(�Ķ���� ���޽� POST�� ����ϼ���)
     */

	$configPath = $_SERVER['DOCUMENT_ROOT'].$cfg['rootDir']."/conf/lgdacom_mobile"; //LG���÷������� ������ ȯ������("/conf/lgdacom.conf,/conf/mall.conf") ��ġ ����. 

    /*
     *************************************************
     * 1.�������� ��û - BEGIN
     *  (��, ���� �ݾ�üũ�� ���Ͻô� ��� �ݾ�üũ �κ� �ּ��� ���� �Ͻø� �˴ϴ�.)
     *************************************************
     */
	$CST_PLATFORM               = $pg_mobile['serviceType'];
    $CST_MID                    = $pg_mobile['id'];

    $LGD_MID                    = (("test" == $CST_PLATFORM)?"t":"").$CST_MID;
    $LGD_PAYKEY                 = $HTTP_POST_VARS["LGD_PAYKEY"];

    require_once("./XPayClient.php");
    $xpay = &new XPayClient($configPath, $CST_PLATFORM);
    $xpay->Init_TX($LGD_MID);    
    
    $xpay->Set("LGD_TXNAME", "PaymentByKey");
    $xpay->Set("LGD_PAYKEY", $LGD_PAYKEY);
  
    /*
     *************************************************
     * 1.�������� ��û(�������� ������) - END
     *************************************************
     */

    /*
     * 2. �������� ��û ���ó��
     *
     * ���� ������û ��� ���� �Ķ���ʹ� �����޴����� �����Ͻñ� �ٶ��ϴ�.
     */
	$LGD_OID	= $_POST['LGD_OID'];
	
	if ($xpay->TX()) {
		$LGD_TID= $xpay->Response("LGD_TID",0);
		$LGD_ACCOUNTNUM= $xpay->Response("LGD_ACCOUNTNUM",0);
		$LGD_PAYER= $xpay->Response("LGD_PAYER",0);
		$LGD_CASHRECEIPTNUM= $xpay->Response("LGD_CASHRECEIPTNUM",0);
		$LGD_PAYTYPE= $xpay->Response("LGD_PAYTYPE",0);
		$LGD_FINANCENAME= $xpay->Response("LGD_FINANCENAME",0);
		$LGD_ESCROWYN=$xpay->Response("LGD_ESCROWYN",0);
		$LGD_RESPCODE=$xpay->Response("LGD_RESPCODE",0);
		$LGD_RESPMSG=$xpay->Response("LGD_RESPMSG",0);
		$LGD_HASHDATA=$xpay->Response("LGD_HASHDATA",0);
		$LGD_AMOUNT=$xpay->Response("LGD_AMOUNT",0);
		$LGD_PAYDATE=$xpay->Response("LGD_PAYDATE",0);
		$Response_Code=$xpay->Response_Code();
		$Response_Msg=$xpay->Response_Msg();

        if( "0000" == $xpay->Response_Code() ) {
			$isSuccess=true;
        }else{
          	$resultMSG="��������";
        }
    }else {
        //2)API ��û���� ȭ��ó��
		$resultMSG="��������";
        $resultMSG.= "������û�� �����Ͽ����ϴ�.  <br>";
        $resultMSG.= "TX Response_code = " . $xpay->Response_Code() . "<br>";
        $resultMSG.= "TX Response_msg = " . $xpay->Response_Msg() . "<p>";
    }
}

$ordno	= $LGD_OID;
$card_nm=$LGD_FINANCENAME;

if($LGD_PAYTYPE=='SC0010') $payTypeStr = "�ſ�ī��";
if($LGD_PAYTYPE=='SC0030') $payTypeStr = "������ü";
if($LGD_PAYTYPE=='SC0040') $payTypeStr = "�������";
if($LGD_PAYTYPE=='SC0060') $payTypeStr = "�ڵ���";

$tmp_log[] = "LGU+ SmartXPay ������û�� ���� ���";
if($Response_Code) $tmp_log[] = "TX Response_code : ".$Response_Code;
if($Response_Msg) $tmp_log[] = "TX Response_msg : ".$Response_Msg;
$tmp_log[] = "����ڵ� : ".$LGD_RESPCODE." (0000(����) �׿� ����)";
$tmp_log[] = "������� : ".$LGD_RESPMSG."\n".$resultMSG;
$tmp_log[] = "�ؽ�����Ÿ : ".$LGD_HASHDATA;
$tmp_log[] = "�����ݾ� : ".$LGD_AMOUNT;
$tmp_log[] = "�������̵� : ".$LGD_MID;
$tmp_log[] = "�ŷ���ȣ : ".$LGD_TID;
$tmp_log[] = "�ֹ���ȣ : ".$LGD_OID;
$tmp_log[] = "������� : ".$payTypeStr;
$tmp_log[] = "�����Ͻ� : ".$LGD_PAYDATE;



//�����α׻���
$tmp_log[] = "�ŷ���ȣ : ".$LGD_TID;
$tmp_log[] = "����ũ�� ���� ���� : ".$LGD_ESCROWYN;
$tmp_log[] = "��������ڵ� : ".$LGD_FINANCECODE;
$tmp_log[] = "��������� : ".$LGD_FINANCENAME;

switch ($LGD_PAYTYPE){
	case "SC0010":	// �ſ�ī��
		$tmp_log[] = "����������ι�ȣ : ".$LGD_FINANCEAUTHNUM;
		$tmp_log[] = "�ſ�ī���ȣ : ".$LGD_CARDNUM." (�Ϲ� �������� *ó����)";
		$tmp_log[] = "�ſ�ī���Һΰ��� : ".$LGD_CARDINSTALLMONTH;
		$tmp_log[] = "�ſ�ī�幫���ڿ��� : ".$LGD_CARDNOINTYN." (1:������, 0:�Ϲ�)";
		break;
	case "SC0030":	// ������ü
		$tmp_log[] = "���ݿ��������ι�ȣ : ".$LGD_CASHRECEIPTNUM;
		$tmp_log[] = "���ݿ����������߱������� : ".$LGD_CASHRECEIPTSELFYN." Y: �����߱�";
		$tmp_log[] = "���ݿ��������� : ".$LGD_CASHRECEIPTKIND." 0:�ҵ����, 1:��������";
		$tmp_log[] = "���¼������̸� : ".$LGD_ACCOUNTOWNER;
		break;
	case "SC0040":	// �������
		$tmp_log[] = "���ݿ��������ι�ȣ : ".$LGD_CASHRECEIPTNUM;
		$tmp_log[] = "���ݿ����������߱������� : ".$LGD_CASHRECEIPTSELFYN." Y: �����߱�";
		$tmp_log[] = "���ݿ��������� : ".$LGD_CASHRECEIPTKIND." 0:�ҵ����, 1:��������";
		$tmp_log[] = "������¹߱޹�ȣ : ".$LGD_ACCOUNTNUM;
		$tmp_log[] = "��������Ա��ڸ� : ".$LGD_PAYER;
		$tmp_log[] = "�Աݴ����ݾ� : ".$LGD_CASTAMOUNT;
		$tmp_log[] = "���Աݱݾ� : ".$LGD_CASCAMOUNT;
		$tmp_log[] = "�ŷ����� : ".$LGD_CASFLAG." (R:�Ҵ�,I:�Ա�,C:���)";
		$tmp_log[] = "��������Ϸù�ȣ : ".$LGD_CASSEQNO;
		break;
	case "SC0060":	// �ڵ���
		break;
}
$settlelog = "{$ordno} (" . date('Y:m:d H:i:s') . ")\n-----------------------------------\n" . implode( "\n", $tmp_log ) . "\n-----------------------------------\n";
	
// DB ó��
	$oData = $db->fetch("select step, vAccount from ".GD_ORDER." where ordno='$ordno'");
	
	if($oData['step'] > 0 || $oData['vAccount'] != '' || !strcmp($LGD_RESPCODE,"S007")){		// �ߺ�����
		### �α� ����
		$db->query("update ".GD_ORDER." set settlelog=concat(ifnull(settlelog,''),'$settlelog') where ordno='$ordno'");
		$goUrl=$cfgMobileShop['mobileShopRootDir']."/ord/order_fail.php?ordno=$ordno";
	} else if($isSuccess) {	//��������
		$query = "
		select * from
			".GD_ORDER." a
			left join ".GD_LIST_BANK." b on a.bankAccount = b.sno
		where
			a.ordno='$ordno'
		";
		$data = $db->fetch($query);
		
		### ����ũ�� ���� Ȯ��
		if($LGD_ESCROWYN == 'Y'){
			$escrowyn = "y";
			$escrowno = $LGD_TID;
		}else{
			$escrowyn = "n";
			$escrowno = "";
		}

		### ���� ���� ����
		$step = 1;
		$qrc1 = "cyn='y', cdt=now(), cardtno='".$LGD_TID."',";
		$qrc2 = "cyn='y',";

		### ������� ������ �������� ����
		if ($LGD_PAYTYPE == 'SC0040'){
			$vAccount = $LGD_FINANCENAME." ".$LGD_ACCOUNTNUM." ".$LGD_PAYER;
			$step = 0; $qrc1 = $qrc2 = "";
		}

		### ���ݿ����� ����
		if ($LGD_CASHRECEIPTNUM){
			$qrc1 .= "cashreceipt='".$LGD_CASHRECEIPTNUM."',";
		}

		### �ǵ���Ÿ ����
		$db->query("
		update ".GD_ORDER." set $qrc1
			step		= '$step',
			step2		= '',
			escrowyn	= '$escrowyn',
			escrowno	= '$escrowno',
			vAccount	= '$vAccount',
			settlelog	= concat(ifnull(settlelog,''),'$settlelog')
		where ordno='$ordno'"
		);
		$db->query("update ".GD_ORDER_ITEM." set $qrc2 istep='$step' where ordno='$ordno'");

		### �ֹ��α� ����
		orderLog($ordno,$r_step2[$data[step2]]." > ".$r_step[$step]);

		### ��� ó��
		setStock($ordno);

		### ��ǰ���Խ� ������ ���
		if ($sess['m_id'] && $data['m_no'] && $data['emoney']){
			setEmoney($data['m_no'],-$data['emoney'],"��ǰ���Խ� ������ ���� ���",$ordno);
		}

		### �ֹ�Ȯ�θ���
		if(function_exists('getMailOrderData')){
			sendMailCase($data['email'],0,getMailOrderData($ordno));
		}

		### SMS ���� ����
		$dataSms = $data;

		if ($LGD_PAYTYPE != "SC0040"){
			sendMailCase($data[email],1,$data);			### �Ա�Ȯ�θ���
			sendSmsCase('incash',$data[mobileOrder]);	### �Ա�Ȯ��SMS
		} else {
			sendSmsCase('order',$data[mobileOrder]);	### �ֹ�Ȯ��SMS
		}
		
		$goUrl=$cfgMobileShop['mobileShopRootDir']."/ord/order_end.php?ordno=$ordno&card_nm=$card_nm";
	}else{	//��������
		// ���̹� ���ϸ��� ���� ���� ��� API ȣ��
		if ($naverNcash->useyn == 'Y') $naverNcash->payment_approval_cancel($ordno);

		$db->query("update ".GD_ORDER." set step2=54, settlelog=concat(ifnull(settlelog,''),'$settlelog') where ordno='$ordno' and step2=50");
		$db->query("update ".GD_ORDER_ITEM." set istep=54 where ordno='$ordno' and istep=50");
		$goUrl=$cfgMobileShop['mobileShopRootDir']."/ord/order_fail.php?ordno=$ordno";
	}

if($isAsync=='Y'){	//�񵿱��� ���(ISP����)
	echo $resultMSG;	//OK�� �ƴѰ�� ROLLBACKó�� ��. �ַ��α״� ������ �����ڿ��� ����������ȸ>��ü�ŷ�������ȸ>���۽��г�����ȸ  ���� Ȯ�� ����
}
else{	//�׿�
	go($goUrl,"parent");
}
?>