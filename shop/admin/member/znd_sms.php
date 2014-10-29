<?
require_once "../../lib/sms.class.php";

set_time_limit(0);

$sms = new Sms(true);

$idx = $pre_perc = $ici_perc = 0;

# SMS ���� ó��
$msg = parseCode($_POST['msg']);

# SMS ���� �߼� ����
$msg = gd_str_split($msg,80);
$msg_size = $_POST['msg_split'] ? sizeof($msg) : 1;

# ���� �߼�
if ($_POST['reserve'] == 1) {
	$time = strtotime($_POST['reserve_date']) + (int)$_POST['reserve_hour'] * 3600 + (int)$_POST['reserve_minute'] * 60;

	if ($time <= time()) {
		msg("����߼� �Ͻø� ���� ���ķ� ������ �ּ���.");
		exit;
	}

	$reserve = date('Y-m-d H:i:s', $time);
	$reserve_etc = date('Ymd', $time);
	$send_type = 'res_send';
}
else {
	$reserve = '';
	$reserve_etc = '';
	$send_type = 'send';
}

# ���� �߼�
if ($_POST['type']==1) {
	$num = array();
	foreach ($div as $v){
		for ($i=0;$i<$msg_size;$i++) {
			if ($sms->send($msg[$i],$v,$_POST['callback'],$reserve, $reserve_etc,$send_type)) $num['success']++;
			else $num['fail']++;
		}

		$ici_perc = floor(++$idx / $total * 100);
		if ($pre_perc!=$ici_perc){
			echo "<script>parent.document.getElementById('sms_bar').style.width = '".($ici_perc)."%';</script>";
			$pre_perc = $ici_perc;
		}
	}
# SMS ȸ�� �ּҷ� �˻� / ����ȸ��
} else if ($_POST['type']==2 || $_POST['type']==3 || $_POST['type']=="query" || $_POST['type']=="select") {

	while ($v=$db->fetch($res)){
		$dataSms['name'] = $v['name'];
		for ($i=0;$i<$msg_size;$i++) {
			if ($sms->send($msg[$i],$v['mobile'],$_POST['callback'],$reserve, $reserve_etc,$send_type)) $num['success']++;
			else $num['fail']++;
		}
		
		$ici_perc = floor(++$idx / $total * 100);
		if ($pre_perc!=$ici_perc){
			echo "<script>parent.document.getElementById('sms_bar').style.width = '".($ici_perc)."%';</script>";
			flush();
			$pre_perc = $ici_perc;
		}
	}
# SMS �Ϲ� �ּҷ� �˻� / ����ȸ��
} else if ($_POST['type']==4 || $_POST['type']==5) {
	
	while ($v=$db->fetch($res)){
		for ($i=0;$i<$msg_size;$i++) {
			if ($sms->send($msg[$i],$v['sms_mobile'],$_POST['callback'],$reserve, $reserve_etc,$send_type)) $num['success']++;
			else $num['fail']++;
		}
		
		$ici_perc = floor(++$idx / $total * 100);
		if ($pre_perc!=$ici_perc){
			echo "<script>parent.document.getElementById('sms_bar').style.width = '".($ici_perc)."%';</script>";
			flush();
			$pre_perc = $ici_perc;
		}
	}
# SMS ȸ�� �ּҷ� ��ü
} else if ($_POST['type']==6) {

	while ($v=$db->fetch($res)){
		for ($i=0;$i<$msg_size;$i++) {
		if ($sms->send($msg[$i],$v['mobile'],$_POST['callback'],$reserve, $reserve_etc,$send_type)) $num['success']++;
		else $num['fail']++;
		}

		$ici_perc = floor(++$idx / $total * 100);
		if ($pre_perc!=$ici_perc){
			echo "<script>parent.document.getElementById('sms_bar').style.width = '".($ici_perc)."%';</script>";
			flush();
			$pre_perc = $ici_perc;
		}
	}
# SMS �Ϲ� �ּҷ� ��ü
} else if ($_POST['type']==7) {

	while ($v=$db->fetch($res)){
		for ($i=0;$i<$msg_size;$i++) {
		if ($sms->send($msg[$i],$v['sms_mobile'],$_POST['callback'],$reserve, $reserve_etc,$send_type)) $num['success']++;
		else $num['fail']++;
		}

		$ici_perc = floor(++$idx / $total * 100);
		if ($pre_perc!=$ici_perc){
			echo "<script>parent.document.getElementById('sms_bar').style.width = '".($ici_perc)."%';</script>";
			flush();
			$pre_perc = $ici_perc;
		}
	}
}

$sms->update_ok_eNamoo = true;
$sms->update();
$sms->log($_POST['msg'],$to_tran,$_POST['type'],$total,$reserve);
unset($sms->update_ok_eNamoo);
?>