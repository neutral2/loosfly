<?php
@require "../lib.php";
@require "../../lib/load.class.php";
@require "../../lib/sns.class.php";
@require "../../lib/qfile.class.php";
@require "../../conf/config.php";

unset($_POST['x'], $_POST['y']);
if ($_POST['boxWidth'] && $_POST['boxHeight']) {
	$_POST['postHeight'] = 50;
	$_POST['postCount'] = floor(($_POST['boxHeight'] - 80) / $_POST['postHeight']);
	if ($_POST['postCount'] == 0) $_POST['postCount'] = 1;
	elseif ($_POST['postCount'] > 50) $_POST['postCount'] = 50;
}

$sns = new SNS();
$_POST['use_kakao']		= ($_POST['use_kakao'] == 'y')		? $_POST['use_kakao']		: 'n';
$_POST['use_twitter']	= ($_POST['use_twitter'] == 'y')	? $_POST['use_twitter']		: 'n';
$_POST['use_me2day']	= ($_POST['use_me2day'] == 'y')		? $_POST['use_me2day']		: 'n';
$_POST['use_facebook']	= ($_POST['use_facebook'] == 'y')	? $_POST['use_facebook']	: 'n';
$_POST['use_cchoice']	= ($_POST['use_cchoice'] == 'y')	? $_POST['use_cchoice']		: 'n';
$sns->config_write($_POST);

msg("������ �Ϸ� �Ǿ����ϴ�.");
?>
<script type="text/javascript">parent.location.reload();</script>