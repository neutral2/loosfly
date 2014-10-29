<?php
	include dirname(__FILE__)."/../../lib/library.php";
	include_once( dirname(__FILE__)."/../../conf/config.php" );
	include_once( dirname(__FILE__)."/../../conf/fieldset.php" );

	/********************************************************************************************************************************************
		NICE�ſ������� Copyright(c) KOREA INFOMATION SERVICE INC. ALL RIGHTS RESERVED
		
		���񽺸� : �����ֹι�ȣ���� (IPIN) ����
		�������� : �����ֹι�ȣ���� (IPIN) ����� ���� ���� ó�� ������
		
				   ���Ź��� ������(�������)�� ����ȭ������ �ǵ����ְ�, close�� �ϴ� ��Ȱ�� �մϴ�.
	*********************************************************************************************************************************************/
	
	// ����� ���� �� CP ��û��ȣ�� ��ȣȭ�� ����Ÿ�Դϴ�. (ipin_main.php ���������� ��ȣȭ�� ����Ÿ�ʹ� �ٸ��ϴ�.)
	$sResponseData = $_POST['enc_data'];
	
	// ipin_main.php ���������� ������ ����Ÿ�� �ִٸ�, �Ʒ��� ���� Ȯ�ΰ����մϴ�.
	$sReservedParam1  = $_POST['param_r1'];
	$sReservedParam2  = $_POST['param_r2'];
	$sReservedParam3  = $_POST['param_r3'];
	
	
	
	// ��ȣȭ�� ����� ������ �����ϴ� ���
	if ($sResponseData != "") {

?>

<html>
<head>
	<title>NICE�ſ������� �����ֹι�ȣ ����</title>
	<script language='javascript'>
		function fnLoad()
		{
			// ��翡���� �ֻ����� �����ϱ� ���� 'parent.opener.parent.document.'�� �����Ͽ����ϴ�.
			// ���� �ͻ翡 ���μ����� �°� �����Ͻñ� �ٶ��ϴ�.
			opener.document.getElementById('ifrmRnCheck').contentWindow.document.vnoform.enc_data.value = "<?= $sResponseData ?>";
			
			opener.document.getElementById('ifrmRnCheck').contentWindow.document.vnoform.param_r1.value = "<?= $sReservedParam1 ?>";
			opener.document.getElementById('ifrmRnCheck').contentWindow.document.vnoform.param_r2.value = "<?= $sReservedParam2 ?>";
			opener.document.getElementById('ifrmRnCheck').contentWindow.document.vnoform.param_r3.value = "<?= $sReservedParam3 ?>";
			
			opener.document.getElementById('ifrmRnCheck').contentWindow.document.vnoform.target = "Parent_window";
			
			// ���� �Ϸ�ÿ� ��������� �����ϰ� �Ǵ� �ͻ� Ŭ���̾�Ʈ ��� ������ URL
			opener.document.getElementById('ifrmRnCheck').contentWindow.document.vnoform.action = "IPINResult.php";
			opener.document.getElementById('ifrmRnCheck').contentWindow.document.vnoform.submit();
			
			self.close();
		}
	</script>
</head>
<body onLoad="fnLoad()">

<?
	} else {
?>

<html>
<head>
	<title>NICE�ſ������� �����ֹι�ȣ ����</title>
	<body onLoad="self.close()">

<?
	}
?>

</body>
</html>