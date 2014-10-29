<?php

// C1. ���̺귯�� ��Ŭ���
include dirname(__FILE__).'/../lib.php';

// C2. ���� �� ���ε�
$shopConfig = Core::loader('config')->load('config');
$dreamsecurity = Core::loader('Dreamsecurity');

//debug($dreamsecurity->checkPrefix($cpid));

// C3. ��������
$cpid		= $_POST['cpid'];
$useyn		= $_POST['useyn'];
$minoryn	= $_POST['minoryn'];

// C6. ȸ���� cpid Ȯ��
if (strlen(trim($cpid)) < 1) {
	msg('ȸ���� Code�� �Էµ��� �ʾҽ��ϴ�.', -1);
	exit;
}

// C7. ��뿩�� Ȯ��
else if (strlen(trim($useyn)) < 1) {
	msg('��뿩�ΰ� ���õ��� �ʾҽ��ϴ�.', -1);
	exit;
}

// C7. �������� ��뿩�� Ȯ��
else if (strlen(trim($useyn)) < 1) {
	msg('�������� ��뿩�ΰ� ���õ��� �ʾҽ��ϴ�.', -1);
	exit;
}

// C8. ���񽺾��̵� prefix Ȯ��
else if ($dreamsecurity->checkPrefix($cpid) !== true) {
	msg('ȸ���� �ڵ尡 ��Ȯ���� �ʽ��ϴ�. �߱޹��� �ڵ带 Ȯ���ϼ���.', -1);
	exit;
}

// C9. ���� ����
else {
	$hpauthDreamCfg = array();
	$hpauthDreamCfg[cpid] = $cpid;
	$hpauthDreamCfg[useyn] = $useyn;
	$hpauthDreamCfg[minoryn] = $minoryn;

	Core::loader('config')->save('hpauthDream', $hpauthDreamCfg);

	$dreamsecurity->saveConfig($cpid);
}

?>
<script type="text/javascript">
alert("���������� ����Ǿ����ϴ�.");
location.replace('./adm_member_auth.hpauthDream.php');
</script>