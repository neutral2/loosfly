<?php
@require "../lib.php";
@require "../../lib/load.class.php";
@require "../../lib/sns.class.php";
@require "../../lib/qfile.class.php";
@require "../../conf/config.php";

$mode = $_POST['mode'];
unset($_POST['x'], $_POST['y'], $_POST['mode']);

$sns = new SNS();
switch($mode) {
	case 'reg': {
		$sns->postconfig_write($_POST);
		msg("������ �Ϸ� �Ǿ����ϴ�.");
		break;
	}
	case 'del': {
		$sns->postconfig_delete($_POST);
		msg("�����Ǿ����ϴ�.");
		break;
	}
}

?>
<script type="text/javascript">parent.location.reload();</script>