<?php
include dirname(__FILE__)."/../../lib/library.php";

$config = Core::loader('config');
$hpauthDreamCfg = $config->load('hpauthDream');

/* �帲��ť��Ƽ ******************************************************************************************/

$sDevelopedData = $_REQUEST['sDevelopedData'];

$rtn = split("\\$", $sDevelopedData);

			$ci = $rtn[0];
			$di = $rtn[1];
			$phoneNo = $rtn[2];
			$phoneCorp = $rtn[3];
			$birthDay = $rtn[4];  //������� ��)860406
			$gender = $rtn[5];
			$nation = $rtn[6];
			$name = $rtn[7];
			$reqNum = $rtn[8];
			$reqdate = $rtn[9];


$ibirth		= $_REQUEST["ibirth"];		//������� ��)19860406
$clntReqNum	= $_REQUEST["clntReqNum"];	//��û��ȣ : $reqNum���� ���ƾ� �������� (����������)
$result		= $_REQUEST["result"];		//������, success
$resultCd	= $_REQUEST["resultCd"];	//������, ��������

$_SESSION["sess_callType"]	= $_REQUEST["ssCallType"];	//�з���

/* �帲��ť��Ƽ ******************************************************************************************/

if ($gender == 1 || $gender == 3) { //�����Ǻ�
	$gender = "M";
} else if ($gender == 2 || $gender == 4){
	$gender = "W";
} else {
	$gender = 0;
}

//��20�� ���� ����
$birthyear = substr($ibirth,0,4); //����
$thisyear = date("Y", time()); //����

$age = $thisyear - $birthyear; //����

$ssCallType = $_SESSION["sess_callType"];

if($age >= 19) {
	$_SESSION['adult'] = 1;
}
else {
	unset($_SESSION['adult']);
}

if($ssCallType == "adultcheck" || $ssCallType == "adultcheckmobile") {//��������

	if($_SESSION['adult']) {
		msg("���� �����Ǿ����ϴ�.");
		if($ssCallType == "adultcheckmobile"){
			$returnUrl = "http://".$_SERVER['HTTP_HOST']."/m/";
			echo "<script>opener.location.replace('$returnUrl')</script>";
			echo "<script>window.close();</script>";
		} else {
			$returnUrl = $_REQUEST["returnUrl"] ? $_REQUEST["returnUrl"] : "../../index.php";
			go($returnUrl, "parent");
		}
	} else {
		unset($_SESSION['adult']);
		msg("���� ������ �����߽��ϴ�.");
		if($ssCallType == "adultcheckmobile"){
			$returnUrl = "http://".$_SERVER['HTTP_HOST']."/m/";
			echo "<script>opener.location.replace('$returnUrl')</script>";
			echo "<script>window.close();</script>";
		} else {
			$returnUrl = $_REQUEST["returnUrl"] ? $_REQUEST["returnUrl"] : "../../index.php";
			go($returnUrl, "parent");
		}
	}
	exit();
}

list($chkCount) = $db->fetch($db->query("SELECT count(m_id) FROM ".GD_MEMBER." WHERE dupeinfo != '' and dupeinfo is not null and dupeinfo = '$di'")); // ���Ե� Ƚ��

?>

<html>
<? if($clntReqNum == $reqNum) { // ��û�� �ѱ� ��û��ȣ(clntReqNum)�� ����� ���Ե� ��û��ȣ(reqNum)�� ��ġ�ؾ� ��������  ?>
<script type="text/javascript">
	function loadAction() {
		var strResult   = "<?=$result?>";		// ����ڵ�
		var di			= "<?=$di?>";			// �ߺ�����Ȯ������(DI)
		var reqNum		= "<?=$reqNum?>";		// ��û��ȣ
		var reqdate		= "<?=$reqdate?>";		// ��û�Ͻ�

		var strName		= "<?=$name?>";			// �̸�
		var birthday	= "<?=$ibirth?>";		// �������
		var phoneNo		= "<?=$phoneNo?>";		// �޴�����ȣ
		var phoneCorp	= "<?=$phoneCorp?>";	// �̵���Ż�
		var foreigner	= "<?=$nation?>";		// ���ܱ�������
		var sex			= "<?=$gender?>";		// ����
		var ageInfo		= "<?=$age?>";			// ����

		var dupeCount	= "<?=$chkCount?>";		// ���Ե� Ƚ��

		var callType = "<?=$ssCallType?>";		// ȣ������

		var minoryn = "<?=$hpauthDreamCfg[minoryn]; ?>"; //�������� ��뿩��

		// ���̵�/��й�ȣ ã�⿡�� ȣ���� ���, parent �� callType ������Ʈ�� �ִ�.
		if (callType == "findid" || callType == "findpwd") {
			parent.document.fm.action = '';
			parent.document.fm.target = '';
			parent.document.fm.rncheck.value = 'hpauthDream';
			parent.document.fm.dupeinfo.value = di;
			parent.document.fm.submit();

		} else { // default ȸ������

			if (dupeCount > 0) {
				alert( "�̹� ������ �Ǿ� �ֽ��ϴ�.");
			} else {
				if ( minoryn == 'y' && ageInfo < 19 ) { // �Ǹ��������� & ������������
					parent.document.frmAgree['name']. value = '';
					alert( '�������� ����' ); //��� �޽��� ���
				} else if ( strResult == "success" ) { // �޴������� ����
					alert( "�޴��������� ����ó�� �Ǿ����ϴ�." ); //��� �޽��� ���
					parent.document.frmAgree.action = '';
					parent.document.frmAgree.target = '';
					parent.document.frmAgree.rncheck.value = 'hpauthDream';
					parent.document.frmAgree.nice_nm.value = strName;
					parent.document.frmAgree.mobile.value = phoneNo;
					parent.document.frmAgree.birthday.value = birthday;
					parent.document.frmAgree.sex.value = sex;
					parent.document.frmAgree.dupeinfo.value = di;
					parent.document.frmAgree.foreigner.value = foreigner;
					parent.document.frmAgree.submit();
				} else { // �޴�����������
					parent.document.frmAgree['name']. value = '';
					alert( '�޴��������� �����߽��ϴ�.\n\n' + strMsg); //��� �޽��� ���
				}
			}

		}
		self.close();
	}
</script>
<? } else { ?>
<script type="text/javascript">
	alert("�߸��� �����Դϴ�.");
</script>
<? } ?>

<body onLoad="javascript:loadAction();"></body>
</html>
