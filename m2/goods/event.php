<?
/*********************************************************
* ���ϸ�     :  event.php
* ���α׷��� :	event ������
* �ۼ���     :  dn
* ������     :  2012.08.17
**********************************************************/	

$rtm[] = microtime();
include dirname(__FILE__) . "/../_header.php";
@include $shopRootDir . "/lib/page.class.php";
@include $shopRootDir . "/conf/config.pay.php";
$rtm[] = microtime();

$mevent_no = $_GET['mevent_no'];

if(!$mevent_no) {
	msg('�߸��� �����Դϴ�', -1);
}

$select_query = $db->_query_print('SELECT event_title, start_date, event_body, end_date FROM '.GD_MOBILE_EVENT.' WHERE mevent_no=[i]', $mevent_no);
$res_select = $db->_select($select_query);

$page_title = $res_select[0]['event_title'];
$event_body = str_replace("'", '', str_replace("\\", "", $res_select[0]['event_body']));
$start_date = $res_select[0]['start_date'];
$end_date = $res_select[0]['end_date'];

$now_date = date('Y-m-d H:i:s');

if($start_date > $now_date || $end_date < $now_date) {
	msg('�̺�Ʈ �Ⱓ�� �ƴմϴ�', -1);
}

$tpl->assign(array(
			page_title	=> $page_title,
			event_body => $event_body,
			mevent_no	=> $mevent_no,
			));
$tpl->print_('tpl');
