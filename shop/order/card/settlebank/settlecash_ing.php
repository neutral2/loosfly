<?php
if (isset($_GET['crno']) === false)
{
	include dirname(__FILE__).'/../../../lib/library.php';
	include dirname(__FILE__).'/../../../conf/config.pay.php';

	$ordno = $_POST['Order_no'];

	### �ݾ� ����Ÿ ��ȿ�� üũ
	$data = $db->fetch("select * from gd_order where ordno='$ordno'",1);
	if ($set['receipt']['compType'] == '1'){ // �鼼/���̻����
		$data['supply'] = $data['prn_settleprice'];
		$data['vat'] = 0;
	}
	else { // ���������
		$data['supply'] = round($data['prn_settleprice'] / 1.1);
		$data['vat'] = $data['prn_settleprice'] - $data['supply'];
	}
	if ($data['supply']!=$_POST['deal_won'] || $data['vat']!=$_POST['Amttex']) msg('�ݾ��� ��ġ���� �ʽ��ϴ�',-1);
}
else {
	$ordno = $crdata['ordno'];
}

include dirname(__FILE__).'/../../../conf/pg.settlebank.php';

/****************************************************************************
*
* $IsDebug : 1:����,���� �޼��� Print 0:������
* $ENCRYPT : "C" ���ݿ�����
*
****************************************************************************/

$IsDebug = 0;
$ENCTYPE = 0;

/****************************************************************************
*
* �Ѱܹ��� ����Ÿ
*
****************************************************************************/

$Retailer_id = trim($pg['id']); //�������̵�
$Ord_No = trim($ordno); //�ֹ���ȣ

if ($_POST['Pay_kind'] == 'cash-appr' && isset($_GET['crno']) === false)
{
	$Pay_kind = 'cash-appr'; //��������
	$Pay_type = trim($_POST['Pay_type']); //������� 1.�������ӱ�, 2.������ü
	$Cust_no = trim($_POST['Cust_no']); //ȸ�����̵�
	$Amtcash = trim($_POST['Amtcash']); //�ŷ��ݾ�
	$deal_won = trim($_POST['deal_won']); //���ް���
	$Amttex = trim($_POST['Amttex']); //�ΰ���ġ��
	$Amtadd = '0'; //�����
	$prod_nm = trim($_POST['prod_nm']); //��ǰ��
	$prod_set = ''; //��ǰ����
	$Gubun_cd = trim($_POST['Gubun_cd']); //�ŷ��ڱ���
	$Confirm_no = trim($_POST['Confirm_no']); //�ź�Ȯ�ι�ȣ

	// �߱޻���üũ(�����ý��۰��)
	if ($data['cashreceipt'] != '' && file_exists(dirname(__FILE__).'/../../../lib/cashreceipt.class.php') === false) {
		msg('���ݿ����� �����û����!! \\n['.$ordno.'] �ֹ��� �̹� ����Ǿ����ϴ�.');
		exit;
	}

	### ���ݿ�������û���� �߰�
	@include dirname(__FILE__).'/../../../lib/cashreceipt.class.php';
	if (class_exists('cashreceipt'))
	{
		// �߱޻���üũ
		list($crno) = $db->fetch("select crno from gd_cashreceipt where ordno='{$ordno}' and status='ACK' order by crno desc limit 1");
		if ($crno != '') {
			msg('���ݿ����� �����û����!! \\n['.$ordno.'] �ֹ��� �̹� ����Ǿ����ϴ�.');
			exit;
		}

		$indata = array();
		$indata['ordno'] = $ordno;
		$indata['goodsnm'] = $prod_nm;
		$indata['buyername'] = $Cust_no;
		$indata['useopt'] = ($Gubun_cd == '01' ? '0' : '1');
		$indata['certno'] = $Confirm_no;
		$indata['amount'] = $Amtcash;
		$indata['supply'] = $deal_won;
		$indata['surtax'] = $Amttex;

		$cashreceipt = new cashreceipt();
		$crno = $cashreceipt->putReceipt($indata);
	}
}
else if ($crdata['Pay_kind'] == 'cash-appr')
{
	$Pay_kind = 'cash-appr'; //��������
	$Pay_type = '1'; //������� 1.�������ӱ�, 2.������ü
	$Amtcash = trim($crdata['amount']); //�ŷ��ݾ�
	$prod_nm = trim($crdata['goodsnm']); //��ǰ��
	$prod_set = ''; //��ǰ����
	$Gubun_cd = ($crdata['useopt'] == '0' ? '01' : '02'); //�ŷ��ڱ���
	$Confirm_no = trim($crdata['certno']); //�ź�Ȯ�ι�ȣ
	$crno = $_GET['crno'];
}
else if ($crdata['Pay_kind'] == 'cash-cncl')
{
	$Pay_kind = 'cash-cncl'; //��������
	$Pay_type = '1'; //������� 1.�������ӱ�, 2.������ü
	$Amtcash = trim($crdata['amount']); //�ŷ��ݾ�
	$Gubun_cd = ($crdata['useopt'] == '0' ? '01' : '02'); //�ŷ��ڱ���
	$Confirm_no = trim($crdata['certno']); //�ź�Ȯ�ι�ȣ
	$Org_adm_no = trim($crdata['receiptnumber']); //��ҽ� ���ι�ȣ
}

/*******************************************************************************************
*
* Pay_kind = cash-appr" ���ݿ����� ���ο�û��
*
******************************************************************************************/

if( strcmp( $Pay_kind, "cash-appr" ) == 0 )
{

	/**************************************************************
	* ���ο�û��
	**************************************************************/

	$ENCTYPE = "0";

	/****************************************************************************
	*
	* ���� ���� Make
	*
	****************************************************************************/
	if ($Gubun_cd == "01"){
		$purpose = "0";
		$identityGb = "4";
	}else{
		$purpose = "1";
		$identityGb = "3";
	}
	
	if($data['settlekind'] == 'a') {
		$transNo = $data['ordno'];
	} else {
		$transNo = $crdata['ordno'];
	}
	
	$sDataMsg  = "&mid=".$Retailer_id ;
	$sDataMsg .= "&assort=".$ENCTYPE;
	$sDataMsg .= "&trDt=".date('YmdHis',strtotime( $data['orddt'] ));
	$sDataMsg .= "&trAmt=".$Amtcash;
	$sDataMsg .= "&purpose=".$purpose;
	$sDataMsg .= "&identityGb=".$identityGb;
	$sDataMsg .= "&identity=".$Confirm_no;
	$sDataMsg .= "&transNo=".$transNo;

	/****************************************************************************
	*
	* ���� �޼��� ����Ʈ
	*
	****************************************************************************/

	$url="http://www.settlebank.co.kr/pgtrans/CashReceiptMultiAction.do?_method=insertReceiptInfo".$sDataMsg;

	if( $IsDebug == 1 )
	{
		echo $url."<br>";
	}

	/****************************************************************************
	*
	* ���ݿ����� �߱� �۾� 
	*
	****************************************************************************/

	$ch = curl_init();
	if(!$ch) {
		/****���� ���� ***/
		$Success = "n";
		$rResMsg = "���� ���з� ���� ����";
	} else {
		/****���� ���� ***/
		$rResMsg = "���ῡ �����Ͽ����Ƿ� �����͸� �޴´�.";

		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER,  0);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		//���� ��ȸ
		$ret = curl_exec($ch);

		//���� ó��
		if( curl_error($ch)){
			$Success = "n";
			$rResMsg = "���ݿ����� �۾��� ������ �߻��Ͽ����ϴ�. �����ڿ��� �����ϼ���.";
		}
		
		//curl ���Ǵݱ�
		curl_close($ch);
		
	}	

	/****************************************************************************
	*
	* ���� �޼��� ����Ʈ
	*
	****************************************************************************/

	if( $IsDebug == 1 )
	{
		print $sRecvMsg."<br>";
	}

	$json = new Services_JSON();
	$sRecvMsg = get_object_vars($json->decode(stripslashes($ret)));

	if( $sRecvMsg['resultCd'] == '0000' )
	{
		/** ���� ������(����) üũ ���� **/

		$RecvValArray = array();
		$RecvValArray = explode( "|", $sRecvMsg );

		$rRetailer_id = $Retailer_id;
		$rDealno = $transNo;
		$rAdm_no = $sRecvMsg['authNo'];
		$rSuccess = $sRecvMsg['resultCd'];
		$rResMsg = iconv('utf-8','euc-kr',$sRecvMsg['resultMsg']);
	}
	else
	{
		/** ���� ������(����) üũ ������ ��ſ����� ���� ���� ���з� ���� **/

		$rSuccess = $sRecvMsg['resultCd'];
		$rResMsg = iconv('utf-8','euc-kr',$sRecvMsg['resultMsg']);

	}

	/****************************************************************************
	*
	* ���� ��� ���� ,tid='{$rAdm_no}'
	*
	****************************************************************************/
	if( !strcmp($rSuccess,"0000")) // rSuccess "0000" �϶��� ����
	{
		$settlelog = $ordno.' ('.date('Y:m:d H:i:s').')'."\n";
		$settlelog .= '-----------------------------------'."\n";
		$settlelog .= '���ݿ����� �߱� ����'."\n";
		$settlelog .= '����ڵ� : '.$rSuccess."\n";
		$settlelog .= '������� : '.$rResMsg."\n";
		$settlelog .= '��üID   : '.$rRetailer_id."\n";
		$settlelog .= '�ֹ���ȣ : '.$rDealno."\n";
		$settlelog .= '���ι�ȣ : '.$rAdm_no."\n";
		$settlelog .= '-----------------------------------'."\n";
//		echo nl2br($settlelog);

		if (empty($crno) === true)
		{
			$db->query("update gd_order set cashreceipt='{$rAdm_no}',settlelog=concat(if(settlelog is null,'',settlelog),'\n{$settlelog}') where ordno='{$ordno}'");
		}
		else {
			# ���ݿ�������û���� ����
			$db->query("update gd_cashreceipt set pg='settlebank',cashreceipt='{$rAdm_no}',receiptnumber='{$rAdm_no}',moddt=now(),status='ACK',errmsg='',receiptlog=concat(if(receiptlog is null,'',receiptlog),'\n{$settlelog}') where crno='{$crno}'");
			$db->query("update gd_order set cashreceipt='{$rAdm_no}' where ordno='{$ordno}'");
		}

		if (isset($_GET['crno']) === false)
		{
			msg('���ݿ������� ����߱޵Ǿ����ϴ�');
			echo '<script>parent.location.reload();</script>';
		}
		else {
			echo '<script>if(parent.opener == null) window.onload = function (){ parent.parent.location.reload(); }</script>';
		}
	}
	else { // rSuccess �� "0000" �ƴҶ��� ����, rResMsg �� ���п� ���� �޼���
		$settlelog = $ordno.' ('.date('Y:m:d H:i:s').')'."\n";
		$settlelog .= '-----------------------------------'."\n";
		$settlelog .= '���ݿ����� �߱� ����'."\n";
		$settlelog .= '����ڵ� : '.$rSuccess."\n";
		$settlelog .= '������� : '.$rResMsg."\n";
		$settlelog .= '-----------------------------------'."\n";
//		echo nl2br($settlelog);

		if (empty($crno) === true)
		{
			$db->query("update gd_order set settlelog=concat(if(settlelog is null,'',settlelog),'\n{$settlelog}') where ordno='{$ordno}'");
		}
		else {
			# ���ݿ�������û���� ����
			$db->query("update gd_cashreceipt set pg='settlebank',errmsg='{$rSuccess}:{$rResMsg}',moddt=now(),receiptlog=concat(if(receiptlog is null,'',receiptlog),'\n{$settlelog}') where crno='{$crno}'");
		}

		if (isset($_GET['crno']) === false)
		{
			msg($rResMsg);
			exit;
		}
		else {
			echo '<script>if(parent.opener == null) window.onload = function (){ parent.parent.location.reload(); }</script>';
		}
	}
}

/*******************************************************************************************
*
* Pay_kind = "cash-cncl" ���ݿ����� ��ҿ�û��
*
******************************************************************************************/

if( strcmp( $Pay_kind, "cash-cncl" ) == 0 )
{
	/**************************************************************
	* ��ҿ�û��
	**************************************************************/
	$ENCTYPE = "1";

	if ($Gubun_cd == "01"){
		$purpose = "0";
		$identityGb = "4";
	}else{
		$purpose = "1";
		$identityGb = "3";
	}
	
	if($data['settlekind'] == 'a') {
		$transNo = $data['ordno'];
	} else {
		$transNo = $data['cardtno'];
	}
	
	$sDataMsg  = "&mid=".$Retailer_id ;
	$sDataMsg .= "&assort=".$ENCTYPE;
	$sDataMsg .= "&trDt=".date('YmdHis',strtotime( $data['orddt'] ));
	$sDataMsg .= "&trAmt=".$Amtcash;
	$sDataMsg .= "&purpose=".$purpose;
	$sDataMsg .= "&identityGb=".$identityGb;
	$sDataMsg .= "&identity=".$Confirm_no;
	$sDataMsg .= "&transNo=".$transNo;

	/****************************************************************************
	*
	* ���� �޼��� ����Ʈ
	*
	****************************************************************************/

	$url="http://www.settlebank.co.kr/pgtrans/CashReceiptMultiAction.do?_method=insertReceiptInfo".$sDataMsg;


	if( $IsDebug == 1 )
	{
		print $url."<br>";
	}

	$ch = curl_init();
	if(!$ch) {
		/****���� ���� ***/
		$Success = "n";
		$rResMsg = "���� ���з� ���� ����";
	} else {
		/****���� ���� ***/
		$rResMsg = "���ῡ ����.";

		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER,  0);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);

		//���� ��ȸ
		$sRecvMsg = curl_exec($ch);
		//���� ó��
		if( curl_error($ch)){
			$Success = "n";
			$rResMsg = "���ݿ����� �۾��� ������ �߻��Ͽ����ϴ�. �����ڿ��� �����ϼ���.";
		}
		
		//curl ���Ǵݱ�
		curl_close($ch);
		
	}

	/****************************************************************************
	*
	* ���� �޼��� ����Ʈ
	*
	****************************************************************************/

	if( $IsDebug == 1 )
	{
		print $sRecvMsg."<br>";
	}

	if( strlen( $sRecvMsg ) == $sRecvLen )
	{
		/** ���� ������(����) üũ ���� **/

		$RecvValArray = array();
		$RecvValArray = explode( "|", $sRecvMsg );

		$rRetailer_id = $Retailer_id;
		$rDealno = $transNo;
		$rAdm_no = $sRecvMsg['authNo'];
		$rSuccess = $sRecvMsg['resultCd'];
		$rResMsg = iconv('utf-8','euc-kr',$sRecvMsg['resultMsg']);

	}
	else
	{
		/** ���� ������(����) üũ ������ ��ſ����� ���� ���� ���з� ���� **/

		$rSuccess = $sRecvMsg['resultCd'];
		$rResMsg = iconv('utf-8','euc-kr',$sRecvMsg['resultMsg']);

	}

	/****************************************************************************
	*
	* ���� ��� ����
	*
	****************************************************************************/
	if( !strcmp($rSuccess,"y") && strcmp($Success,"n") ) // rSuccess "y" �϶��� ����
	{
		$settlelog = $ordno.' ('.date('Y:m:d H:i:s').')'."\n";
		$settlelog .= '-----------------------------------'."\n";
		$settlelog .= '���ݿ����� ��� ����'."\n";
		$settlelog .= '����ڵ� : '.$rSuccess."\n";
		$settlelog .= '������� : '.$rResMsg."\n";
		$settlelog .= '��üID   : '.$rRetailer_id."\n";
		$settlelog .= '�ֹ���ȣ : '.$rDealno."\n";
		$settlelog .= '���ι�ȣ : '.$rAdm_no."(".$Org_adm_no.")\n";
		$settlelog .= '-----------------------------------'."\n";
		//echo nl2br($settlelog);

		$db->query("update gd_cashreceipt set moddt=now(),status='CCR',errmsg='',receiptlog=concat(if(receiptlog is null,'',receiptlog),'{$settlelog}') where crno='{$_GET['crno']}'");
		echo '<script>if(parent.opener == null) window.onload = function (){ parent.parent.location.reload(); }</script>';
	}
	else { // rSuccess �� "y" �ƴҶ��� ����, rResMsg �� ���п� ���� �޼���
		$settlelog = $ordno.' ('.date('Y:m:d H:i:s').')'."\n";
		$settlelog .= '-----------------------------------'."\n";
		$settlelog .= '���ݿ����� ��� ����'."\n";
		$settlelog .= '����ڵ� : '.$rSuccess."\n";
		$settlelog .= '������� : '.$rResMsg."\n";
		$settlelog .= '-----------------------------------'."\n";
		//echo nl2br($settlelog);

		$db->query("update gd_cashreceipt set errmsg='{$rSuccess}:{$rResMsg}',moddt=now(),receiptlog=concat(if(receiptlog is null,'',receiptlog),'\n{$settlelog}') where crno='{$_GET['crno']}'");
		echo '<script>if(parent.opener == null) window.onload = function (){ parent.parent.location.reload(); }</script>';
	}
}

?>