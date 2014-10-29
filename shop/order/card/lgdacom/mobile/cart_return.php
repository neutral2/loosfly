<?php
include "../../../../lib/library.php";
include "../../../../conf/config.mobileShop.php";
include "../../../../conf/config.php";
include "../../../../conf/pg_mobile.lgdacom.php";

error_reporting(0);
 
// 네이버 마일리지 결제 승인 API
include dirname(__FILE__)."/../../../../lib/naverNcash.class.php";
$naverNcash = new naverNcash(true);
if ($naverNcash->useyn == 'Y') {
	if ($_POST['LGD_PAYTYPE'] == "SC0040") $ncashResult = $naverNcash->payment_approval($_POST['LGD_OID'], false);
	else $ncashResult = $naverNcash->payment_approval($_POST['LGD_OID'], true);
	if ($ncashResult === false) {
		msg('네이버 마일리지 사용에 실패하였습니다.', $cfgMobileShop['mobileShopRootDir'].'/ord/order_fail.php?ordno='.$_POST['LGD_OID'], 'parent');
		exit();
	}
}

//로그저장
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

// PG결제 위변조 체크 및 유효성 체크
if (forge_order_check($HTTP_POST_VARS['LGD_OID'],$HTTP_POST_VARS['LGD_AMOUNT']) === false) {
	msg('주문 정보와 결제 정보가 맞질 않습니다. 다시 결제 바랍니다.','../../order_fail.php?ordno='.$HTTP_POST_VARS['LGD_OID'],'parent');
	exit();
}


$isAsync = $HTTP_GET_VARS['isAsync'];	//동기방식여부 :비동기(ISP) , 그외 동기
$isSuccess=false;	//결제성공여부

if($isAsync=='Y') {	//비동기 ISP
	//비동기라 세션유지가 안됨. get으로 uid 랑 m_id값 받아서 세션설정
	$uid=$HTTP_GET_VARS['uid'];
	$m_id=$HTTP_GET_VARS['m_id'];
	$_SESSION['uid']=$uid;
	$sess['m_id']=$m_id;
	
	/*
     * 공통결제결과 정보 
     */
    $LGD_RESPCODE = "";           			// 응답코드: 0000(성공) 그외 실패
    $LGD_RESPMSG = "";            			// 응답메세지
    $LGD_MID = "";                			// 상점아이디 
    $LGD_OID = "";                			// 주문번호
    $LGD_AMOUNT = "";             			// 거래금액
    $LGD_TID = "";                			// LG유플러스에서 부여한 거래번호
    $LGD_PAYTYPE = "";            			// 결제수단코드
    $LGD_PAYDATE = "";            			// 거래일시(승인일시/이체일시)
    $LGD_HASHDATA = "";           			// 해쉬값
    $LGD_FINANCECODE = "";        			// 결제기관코드(카드종류/은행코드/이통사코드)
    $LGD_FINANCENAME = "";        			// 결제기관이름(카드이름/은행이름/이통사이름)
    $LGD_ESCROWYN = "";           			// 에스크로 적용여부
    $LGD_TIMESTAMP = "";          			// 타임스탬프
    $LGD_FINANCEAUTHNUM = "";     			// 결제기관 승인번호(신용카드, 계좌이체, 상품권)
	
    /*
     * 신용카드 결제결과 정보
     */
    $LGD_CARDNUM = "";            			// 카드번호(신용카드)
    $LGD_CARDINSTALLMONTH = "";   			// 할부개월수(신용카드) 
    $LGD_CARDNOINTYN = "";        			// 무이자할부여부(신용카드) - '1'이면 무이자할부 '0'이면 일반할부
    $LGD_TRANSAMOUNT = "";        			// 환율적용금액(신용카드)
    $LGD_EXCHANGERATE = "";       			// 환율(신용카드)

    /*
     * 휴대폰
     */
    $LGD_PAYTELNUM = "";          			// 결제에 이용된전화번호

    /*
     * 계좌이체, 무통장
     */
    $LGD_ACCOUNTNUM = "";         			// 계좌번호(계좌이체, 무통장입금) 
    $LGD_CASTAMOUNT = "";         			// 입금총액(무통장입금)
    $LGD_CASCAMOUNT = "";         			// 현입금액(무통장입금)
    $LGD_CASFLAG = "";            			// 무통장입금 플래그(무통장입금) - 'R':계좌할당, 'I':입금, 'C':입금취소 
    $LGD_CASSEQNO = "";           			// 입금순서(무통장입금)
    $LGD_CASHRECEIPTNUM = "";     			// 현금영수증 승인번호
    $LGD_CASHRECEIPTSELFYN = "";  			// 현금영수증자진발급제유무 Y: 자진발급제 적용, 그외 : 미적용
    $LGD_CASHRECEIPTKIND = "";    			// 현금영수증 종류 0: 소득공제용 , 1: 지출증빙용

    /*
     * OK캐쉬백
     */
    $LGD_OCBSAVEPOINT = "";       			// OK캐쉬백 적립포인트
    $LGD_OCBTOTALPOINT = "";      			// OK캐쉬백 누적포인트
    $LGD_OCBUSABLEPOINT = "";     			// OK캐쉬백 사용가능 포인트

    /*
     * 구매정보
     */
    $LGD_BUYER = "";              			// 구매자
    $LGD_PRODUCTINFO = "";        			// 상품명
    $LGD_BUYERID = "";            			// 구매자 ID
    $LGD_BUYERADDRESS = "";       			// 구매자 주소
    $LGD_BUYERPHONE = "";         			// 구매자 전화번호
    $LGD_BUYEREMAIL = "";         			// 구매자 이메일
    $LGD_BUYERSSN = "";           			// 구매자 주민번호
    $LGD_PRODUCTCODE = "";        			// 상품코드
    $LGD_RECEIVER = "";           			// 수취인
    $LGD_RECEIVERPHONE = "";      			// 수취인 전화번호
    $LGD_DELIVERYINFO = "";       			// 배송지
    

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

    $LGD_MERTKEY = $pg_mobile['mertkey'];  //LG유플러스에서 발급한 상점키로 변경해 주시기 바랍니다.
       
    $LGD_HASHDATA2 = md5($LGD_MID.$LGD_OID.$LGD_AMOUNT.$LGD_RESPCODE.$LGD_TIMESTAMP.$LGD_MERTKEY); 

    /*
     * 상점 처리결과 리턴메세지
     *
     * OK   : 상점 처리결과 성공
     * 그외 : 상점 처리결과 실패
     *
     * ※ 주의사항 : 성공시 'OK' 문자이외의 다른문자열이 포함되면 실패처리 되오니 주의하시기 바랍니다.
     */    
    $resultMSG = "결제결과 상점 DB처리(NOTE_URL) 결과값을 입력해 주시기 바랍니다.";

	if ($LGD_HASHDATA2 == $LGD_HASHDATA) {      //해쉬값 검증이 성공하면
        if($LGD_RESPCODE == "0000"){            //결제가 성공이면
			$isSuccess=true;
            /*
             * 거래성공 결과 상점 처리(DB) 부분
             * 상점 결과 처리가 정상이면 "OK"
             */    
            //if( 결제성공 상점처리결과 성공 ) 
            $resultMSG = "OK";   
        }else {                                 //결제가 실패이면
            /*
             * 거래실패 결과 상점 처리(DB) 부분
             * 상점결과 처리가 정상이면 "OK"
             */  
           //if( 결제실패 상점처리결과 성공 ) 
           $resultMSG = $LGD_RESPMSG;
        }
	} else {                                    //해쉬값 검증이 실패이면
        /*
         * hashdata검증 실패 로그를 처리하시기 바랍니다. 
         */  
		$resultMSG = "결제결과 상점 DB처리(NOTE_URL) 해쉬값 검증이 실패하였습니다.";         
    }
}
else{	//그 외
	
	/*
     * [최종결제요청 페이지(STEP2-2)]
     *
     * LG유플러스으로 부터 내려받은 LGD_PAYKEY(인증Key)를 가지고 최종 결제요청.(파라미터 전달시 POST를 사용하세요)
     */

	$configPath = $_SERVER['DOCUMENT_ROOT'].$cfg['rootDir']."/conf/lgdacom_mobile"; //LG유플러스에서 제공한 환경파일("/conf/lgdacom.conf,/conf/mall.conf") 위치 지정. 

    /*
     *************************************************
     * 1.최종결제 요청 - BEGIN
     *  (단, 최종 금액체크를 원하시는 경우 금액체크 부분 주석을 제거 하시면 됩니다.)
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
     * 1.최종결제 요청(수정하지 마세요) - END
     *************************************************
     */

    /*
     * 2. 최종결제 요청 결과처리
     *
     * 최종 결제요청 결과 리턴 파라미터는 연동메뉴얼을 참고하시기 바랍니다.
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
          	$resultMSG="결제실패";
        }
    }else {
        //2)API 요청실패 화면처리
		$resultMSG="결제실패";
        $resultMSG.= "결제요청이 실패하였습니다.  <br>";
        $resultMSG.= "TX Response_code = " . $xpay->Response_Code() . "<br>";
        $resultMSG.= "TX Response_msg = " . $xpay->Response_Msg() . "<p>";
    }
}

$ordno	= $LGD_OID;
$card_nm=$LGD_FINANCENAME;

if($LGD_PAYTYPE=='SC0010') $payTypeStr = "신용카드";
if($LGD_PAYTYPE=='SC0030') $payTypeStr = "계좌이체";
if($LGD_PAYTYPE=='SC0040') $payTypeStr = "가상계좌";
if($LGD_PAYTYPE=='SC0060') $payTypeStr = "핸드폰";

$tmp_log[] = "LGU+ SmartXPay 결제요청에 대한 결과";
if($Response_Code) $tmp_log[] = "TX Response_code : ".$Response_Code;
if($Response_Msg) $tmp_log[] = "TX Response_msg : ".$Response_Msg;
$tmp_log[] = "결과코드 : ".$LGD_RESPCODE." (0000(성공) 그외 실패)";
$tmp_log[] = "결과내용 : ".$LGD_RESPMSG."\n".$resultMSG;
$tmp_log[] = "해쉬데이타 : ".$LGD_HASHDATA;
$tmp_log[] = "결제금액 : ".$LGD_AMOUNT;
$tmp_log[] = "상점아이디 : ".$LGD_MID;
$tmp_log[] = "거래번호 : ".$LGD_TID;
$tmp_log[] = "주문번호 : ".$LGD_OID;
$tmp_log[] = "결제방법 : ".$payTypeStr;
$tmp_log[] = "결제일시 : ".$LGD_PAYDATE;



//결제로그생성
$tmp_log[] = "거래번호 : ".$LGD_TID;
$tmp_log[] = "에스크로 적용 여부 : ".$LGD_ESCROWYN;
$tmp_log[] = "결제기관코드 : ".$LGD_FINANCECODE;
$tmp_log[] = "결제기관명 : ".$LGD_FINANCENAME;

switch ($LGD_PAYTYPE){
	case "SC0010":	// 신용카드
		$tmp_log[] = "결제기관승인번호 : ".$LGD_FINANCEAUTHNUM;
		$tmp_log[] = "신용카드번호 : ".$LGD_CARDNUM." (일반 가맹점은 *처리됨)";
		$tmp_log[] = "신용카드할부개월 : ".$LGD_CARDINSTALLMONTH;
		$tmp_log[] = "신용카드무이자여부 : ".$LGD_CARDNOINTYN." (1:무이자, 0:일반)";
		break;
	case "SC0030":	// 계좌이체
		$tmp_log[] = "현금영수증승인번호 : ".$LGD_CASHRECEIPTNUM;
		$tmp_log[] = "현금영수증자진발급제유무 : ".$LGD_CASHRECEIPTSELFYN." Y: 자진발급";
		$tmp_log[] = "현금영수증종류 : ".$LGD_CASHRECEIPTKIND." 0:소득공제, 1:지출증빙";
		$tmp_log[] = "계좌소유주이름 : ".$LGD_ACCOUNTOWNER;
		break;
	case "SC0040":	// 가상계좌
		$tmp_log[] = "현금영수증승인번호 : ".$LGD_CASHRECEIPTNUM;
		$tmp_log[] = "현금영수증자진발급제유무 : ".$LGD_CASHRECEIPTSELFYN." Y: 자진발급";
		$tmp_log[] = "현금영수증종류 : ".$LGD_CASHRECEIPTKIND." 0:소득공제, 1:지출증빙";
		$tmp_log[] = "가상계좌발급번호 : ".$LGD_ACCOUNTNUM;
		$tmp_log[] = "가상계좌입금자명 : ".$LGD_PAYER;
		$tmp_log[] = "입금누적금액 : ".$LGD_CASTAMOUNT;
		$tmp_log[] = "현입금금액 : ".$LGD_CASCAMOUNT;
		$tmp_log[] = "거래종류 : ".$LGD_CASFLAG." (R:할당,I:입금,C:취소)";
		$tmp_log[] = "가상계좌일련번호 : ".$LGD_CASSEQNO;
		break;
	case "SC0060":	// 핸드폰
		break;
}
$settlelog = "{$ordno} (" . date('Y:m:d H:i:s') . ")\n-----------------------------------\n" . implode( "\n", $tmp_log ) . "\n-----------------------------------\n";
	
// DB 처리
	$oData = $db->fetch("select step, vAccount from ".GD_ORDER." where ordno='$ordno'");
	
	if($oData['step'] > 0 || $oData['vAccount'] != '' || !strcmp($LGD_RESPCODE,"S007")){		// 중복결제
		### 로그 저장
		$db->query("update ".GD_ORDER." set settlelog=concat(ifnull(settlelog,''),'$settlelog') where ordno='$ordno'");
		$goUrl=$cfgMobileShop['mobileShopRootDir']."/ord/order_fail.php?ordno=$ordno";
	} else if($isSuccess) {	//결제성공
		$query = "
		select * from
			".GD_ORDER." a
			left join ".GD_LIST_BANK." b on a.bankAccount = b.sno
		where
			a.ordno='$ordno'
		";
		$data = $db->fetch($query);
		
		### 에스크로 여부 확인
		if($LGD_ESCROWYN == 'Y'){
			$escrowyn = "y";
			$escrowno = $LGD_TID;
		}else{
			$escrowyn = "n";
			$escrowno = "";
		}

		### 결제 정보 저장
		$step = 1;
		$qrc1 = "cyn='y', cdt=now(), cardtno='".$LGD_TID."',";
		$qrc2 = "cyn='y',";

		### 가상계좌 결제시 계좌정보 저장
		if ($LGD_PAYTYPE == 'SC0040'){
			$vAccount = $LGD_FINANCENAME." ".$LGD_ACCOUNTNUM." ".$LGD_PAYER;
			$step = 0; $qrc1 = $qrc2 = "";
		}

		### 현금영수증 저장
		if ($LGD_CASHRECEIPTNUM){
			$qrc1 .= "cashreceipt='".$LGD_CASHRECEIPTNUM."',";
		}

		### 실데이타 저장
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

		### 주문로그 저장
		orderLog($ordno,$r_step2[$data[step2]]." > ".$r_step[$step]);

		### 재고 처리
		setStock($ordno);

		### 상품구입시 적립금 사용
		if ($sess['m_id'] && $data['m_no'] && $data['emoney']){
			setEmoney($data['m_no'],-$data['emoney'],"상품구입시 적립금 결제 사용",$ordno);
		}

		### 주문확인메일
		if(function_exists('getMailOrderData')){
			sendMailCase($data['email'],0,getMailOrderData($ordno));
		}

		### SMS 변수 설정
		$dataSms = $data;

		if ($LGD_PAYTYPE != "SC0040"){
			sendMailCase($data[email],1,$data);			### 입금확인메일
			sendSmsCase('incash',$data[mobileOrder]);	### 입금확인SMS
		} else {
			sendSmsCase('order',$data[mobileOrder]);	### 주문확인SMS
		}
		
		$goUrl=$cfgMobileShop['mobileShopRootDir']."/ord/order_end.php?ordno=$ordno&card_nm=$card_nm";
	}else{	//결제실패
		// 네이버 마일리지 결제 승인 취소 API 호출
		if ($naverNcash->useyn == 'Y') $naverNcash->payment_approval_cancel($ordno);

		$db->query("update ".GD_ORDER." set step2=54, settlelog=concat(ifnull(settlelog,''),'$settlelog') where ordno='$ordno' and step2=50");
		$db->query("update ".GD_ORDER_ITEM." set istep=54 where ordno='$ordno' and istep=50");
		$goUrl=$cfgMobileShop['mobileShopRootDir']."/ord/order_fail.php?ordno=$ordno";
	}

if($isAsync=='Y'){	//비동기일 경우(ISP결제)
	echo $resultMSG;	//OK가 아닌경우 ROLLBACK처리 됨. 애러로그는 가맹점 관리자에서 결제내역조회>전체거래내역조회>전송실패내역조회  에서 확인 가능
}
else{	//그외
	go($goUrl,"parent");
}
?>