<?
require_once "../../lib/lms.class.php";

set_time_limit(0);

$lms = new Lms(true);

$idx = $pre_perc = $ici_perc = 0;

# LMS 내용 처리
$_POST['subject'] = $_POST['lms_subject'];
$_POST['msg'] = $_POST['lms_msg'];
$subject = parseCode($_POST['subject']);
$msg = parseCode($_POST['msg']);

$msg_size = 3;

# 예약 발송
if ($_POST['reserve'] == 1) {
	$time = strtotime($_POST['reserve_date']) + (int)$_POST['reserve_hour'] * 3600 + (int)$_POST['reserve_minute'] * 60;

	if ($time <= time()) {
		msg("예약발송 일시를 현재 이후로 설정해 주세요.");
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
# 개별 발송
if ($_POST['type']==1) {
	$num = array();
	foreach ($div as $v){		
		if ($lms->send($msg,$v,$_POST['callback'],$reserve, $reserve_etc,$send_type,$subject)) $num['success']++;
		else $num['fail']++;

		$ici_perc = floor(++$idx / $total * 100);
		if ($pre_perc!=$ici_perc){
			echo "<script>parent.document.getElementById('sms_bar').style.width = '".($ici_perc)."%';</script>";
			$pre_perc = $ici_perc;
		}
	}
# SMS 회원 주소록 검색 / 선택회원
} else if ($_POST['type']==2 || $_POST['type']==3 || $_POST['type']=="query" || $_POST['type']=="select") {

	while ($v=$db->fetch($res)){
		$dataSms['name'] = $v['name'];
			if ($lms->send($msg,$v['mobile'],$_POST['callback'],$reserve, $reserve_etc,$send_type,$subject)) $num['success']++;
			else $num['fail']++;
		
		$ici_perc = floor(++$idx / $total * 100);
		if ($pre_perc!=$ici_perc){
			echo "<script>parent.document.getElementById('sms_bar').style.width = '".($ici_perc)."%';</script>";
			flush();
			$pre_perc = $ici_perc;
		}
	}
# SMS 일반 주소록 검색 / 선택회원
} else if ($_POST['type']==4 || $_POST['type']==5) {
	
	while ($v=$db->fetch($res)){
		if ($lms->send($msg,$v['sms_mobile'],$_POST['callback'],$reserve, $reserve_etc,$send_type,$subject)) $num['success']++;
		else $num['fail']++;
		
		$ici_perc = floor(++$idx / $total * 100);
		if ($pre_perc!=$ici_perc){
			echo "<script>parent.document.getElementById('sms_bar').style.width = '".($ici_perc)."%';</script>";
			flush();
			$pre_perc = $ici_perc;
		}
	}
# SMS 회원 주소록 전체
} else if ($_POST['type']==6) {

	while ($v=$db->fetch($res)){
		if ($lms->send($msg,$v['mobile'],$_POST['callback'],$reserve, $reserve_etc,$send_type,$subject)) $num['success']++;
		else $num['fail']++;

		$ici_perc = floor(++$idx / $total * 100);
		if ($pre_perc!=$ici_perc){
			echo "<script>parent.document.getElementById('sms_bar').style.width = '".($ici_perc)."%';</script>";
			flush();
			$pre_perc = $ici_perc;
		}
	}
# SMS 일반 주소록 전체
} else if ($_POST['type']==7) {

	while ($v=$db->fetch($res)){
		if ($lms->send($msg,$v['sms_mobile'],$_POST['callback'],$reserve, $reserve_etc,$send_type,$subject)) $num['success']++;
		else $num['fail']++;

		$ici_perc = floor(++$idx / $total * 100);
		if ($pre_perc!=$ici_perc){
			echo "<script>parent.document.getElementById('sms_bar').style.width = '".($ici_perc)."%';</script>";
			flush();
			$pre_perc = $ici_perc;
		}
	}
}

$lms->update_ok_eNamoo = true;
$lms->update();
$lms->log($_POST['msg'],$to_tran,$_POST['type'],$total,$reserve,$_POST['subject']);
unset($lms->update_ok_eNamoo);
?>