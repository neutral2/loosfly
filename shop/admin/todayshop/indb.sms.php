<?php
@require "../lib.php";
include "../../conf/config.php";

set_time_limit(0);

$sms = & load_class('Sms','Sms');


// 발송 대상
if ($_POST['type'] == 'ts_query') {	// 검색 결과 전체
	$query = get_magic_quotes_gpc() ? stripslashes($_POST['query']) : $_POST['query'];
	$type = 14;
}
else {								// 선택
	$query = "
	SELECT
		SC.*, MB.name
	from ".GD_TODAYSHOP_SUBSCRIBE." AS SC	/* php4 */
	LEFT JOIN ".GD_MEMBER." AS MB
	ON SC.m_id = MB.m_id
	WHERE SC.sno IN (".(implode(',',$_POST['chk'])).")
	";
	$type = 15;
}

$to_tran = $r_smsType[$type];


// 발송 가능 여부 체크
list($total) = $db->fetch( "select count(*) ".substr($query,strpos($query, 'from'),strlen($query)) );

// SMS 발송 가능 건수
if ($total > $sms->smsPt){
	msg("SMS 발송예정인 ".number_format($total)."건이 잔여콜수인 ".number_format($sms->smsPt)."건보다 많습니다");
	exit;
}

// 발송 메시지 템플릿
$msg_body = get_magic_quotes_gpc() ? stripslashes($_POST['msg']) : $_POST['msg'];


// 예약 발송
if ($_POST['reserve'] == 1) {
	$time = strtotime($_POST['reserve_date'].sprintf('%02d',$_POST['reserve_hour']).sprintf('%02d',$_POST['reserve_minute']).'00');

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



// 발송, graph 출력

$idx = $pre_perc = $ici_perc = 0;
$num = array();

$rs = $db->query($query);
while ($row = $db->fetch($rs,1)) {

	$msg = parseCode($msg_body);

	if ($sms->send($msg,$row['phone'],$_POST['callback'],$reserve, $reserve_etc,$send_type)) $num['success']++;
	else $num['fail']++;

	// graph 출력;
	$ici_perc = floor(++$idx / $total * 100);
	if ($pre_perc!=$ici_perc){
		echo "<script>parent.document.getElementById('sms_bar').style.width = '".($ici_perc)."%';</script>";
		flush();
		$pre_perc = $ici_perc;
	}

}

$sms->update();
$sms->log($msg_body,$to_tran,$type,$total,$reserve);

// 처리 결과
$msg = "SMS 발송건수 : ".number_format(array_sum($num))."건 \\n ------------------- \\n 성공 : ".number_format($num[success])." / 실패 : ".number_format($num[fail]);
msg($msg);
echo "<script>parent.document.getElementById('span_sms').innerHTML = '".number_format($sms->smsPt)."'; parent.document.getElementById('sms_bar').style.width = 0;</script>";
?>