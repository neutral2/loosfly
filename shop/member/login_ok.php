<?php
include("../lib/library.php");
include "../lib/login_ok_manager.php";
@include "../conf/config.admin_access_ip.php";

if (get_magic_quotes_gpc()) {
	stripslashes_all($_POST);
	stripslashes_all($_GET);
}

if($_POST['adm_login']) { //관리자 로그인이라면...	
	//초기값 세팅
	if(!$set_ip_permit) $set_ip_permit = '0';

	$myip = $_SERVER['REMOTE_ADDR']; //현재접속IP
	$ex_myip = explode(".",$myip);
	$myip_ABC = $ex_myip[0].".".$ex_myip[1].".".$ex_myip[2].".";
	$myip_Dclass = $ex_myip[3]; //현재접속IP의 D클래스
	
	$set_ip_cnt = count($set_regist_ip);

	if ($set_ip_permit == "0") { //IP접속모두허용

	} else { //IP접속제한

		$m_cnt = count($m_ip);

		$exp=0;
		if(in_array($myip,$m_ip)) { //등록한IP 중에 접속한IP가있는지 검사
			$exp=1;
		} else { //없다면...			
			for($i=0; $i<$m_cnt; $i++) {
				$tmp = explode("~",$m_ip[$i]);	
				$regIP_Dclass_ = $tmp[1]; //추가대역대		

					if($regIP_Dclass_) { //대역대를 등록했을 경우...

						$ex_regip = explode(".",$tmp[0]);
						$regip_ABC = $ex_regip[0].".".$ex_regip[1].".".$ex_regip[2].".";
						$regip_Dclass = $ex_regip[3]; //등록된IP의 D클래스

						if ($exp == 0 ){
							if($myip_ABC == $regip_ABC) { //등록한IP와 접속한IP의 C클래스까지 같다면						
								if( ($regip_Dclass <= $myip_Dclass) && ($myip_Dclass <= $regIP_Dclass_) ) {
									$exp=1;								
								} 
							} 
						}

					}

			} 

			if($exp==0) {
				$k=0;
				if(in_array($myip,$set_regist_ip)) { //등록한IP 중에 접속한IP가있는지 검사
					$k=1;
				} else { //없다면...			
					for($i=0; $i<$set_ip_cnt; $i++) {
						$tmp = explode("~",$set_regist_ip[$i]);	
						$regIP_Dclass_ = $tmp[1]; //추가대역대		

							if($regIP_Dclass_) { //대역대를 등록했을 경우...

								$ex_regip = explode(".",$tmp[0]);
								$regip_ABC = $ex_regip[0].".".$ex_regip[1].".".$ex_regip[2].".";
								$regip_Dclass = $ex_regip[3]; //등록된IP의 D클래스

								if ($k == 0 ){
									if($myip_ABC == $regip_ABC) { //등록한IP와 접속한IP의 C클래스까지 같다면						
										if( ($regip_Dclass <= $myip_Dclass) && ($myip_Dclass <= $regIP_Dclass_) ) {
											$k=1;								
										} 
									} 
								}

							}

					} if($k==0) msg('현재 접속하신 IP는 admin 관리 접근이 불가합니다.\r\n등록된 IP로 접속하신 후 로그인 해주세요.',-1);			
				}
			}
		}		
		
	}
}

if ($_POST['mode']=="guest"){ // 비회원 주문목록보기
	$ordno = (string)$_POST['ordno'];
	$nameOrder = (string)$_POST['nameOrder'];

	// 변수 유효성 검증
	$validation_check = array(
		'ordno'=>array('require'=>true,'pattern'=>'/^[0-9]+$/'),
		'nameOrder'=>array('require'=>true),
	);
	$chk_result = array_value_cheking($validation_check,array('ordno'=>$ordno,'nameOrder'=>$nameOrder));

	if(count($chk_result)) {
		msg("주문자명과 주문번호가 일치하는 주문이 존재하지 않습니다",-1);
	}

	// 주문번호와 주문자명으로 조회
	$query = $db->_query_print("select ordno from gd_order where ordno=[s] and nameOrder=[s]",$ordno,$nameOrder);
	$result = $db->_select($query);
	if($result[0]['ordno']) {
		setcookie("guest_ordno",$ordno,0,'/');
		setcookie("guest_nameOrder",$nameOrder,0,'/');
		go('../mypage/mypage_orderlist.php');
	}
	else {
		msg("주문자명과 주문번호가 일치하는 주문이 존재하지 않습니다",-1);
	}
	exit;
}
else if ($_POST['mode']=="adult_guest") {

	include "../conf/fieldset.php";

	if ( $realname[useyn] == 'y' && !empty($realname[id]) ){

		// 인증 처리 및 페이지 이동은 아래 파일에서 처리 함.
		require_once( "./realname/RNCheckRequest.php" );
		exit;
	}
	else {
		msg("성인인증 서비스를 사용하고 있지 않습니다.",-1);
	}
}
else { // 회원 로그인 부분
	$m_id = (string)$_POST['m_id'];
	$password = (string)$_POST['password'];

	$result = $session->login($m_id,$password);

	if($result!==true) {
		if($result==='NOT_FOUND') {
			msg('아이디 또는 비밀번호 오류입니다',-1);
		}
		elseif($result==='NOT_ACCESS') {
			msg('고객님은 본 사이트에서 승인되지 않아 로그인이 제한됩니다.',-1);
		}
		if($result==='NOT_VALID') {
			msg('아이디 또는 비밀번호 입력 형식 오류입니다',-1);
		}
		exit;
	}


	//출석체크관련 처리
	if(!preg_match('/admin/',$_POST['returnUrl'])) {
		$attd = Core::loader('attendance');
		$result = $attd->login_check($session->m_no);
		if($result) {

			msg($attd->get_check_message($result));
		}
	}


	### ace카운터 처리 부분
	$Acecounter = Core::loader('Acecounter');
	$Acecounter->get_common_script();
	$Acecounter->member_login($session->m_id);
	if($Acecounter->scripts){
		echo $Acecounter->scripts;
	}

	## 로그인 내역 기록
	member_log( $session->m_id );

	## 운영 체크
	if ($session->level > 80) {
		include(SHOPROOT.'/proc/shop_warning_msg.php');
	}

	// 투데이샵 분류 설정
	$todayshop = Core::loader('todayshop');
	if ($todayshop->auth() && $todayshop->cfg['useTodayShop'] == 'y') {
		$ts_interest = unserialize(stripslashes($todayshop->cfg['interest']));
		if ($ts_interest['use'] == 'y') {
			// 관심 분류가 등록되어 있는가
			list($sc) = $db->fetch("SELECT category FROM ".GD_TODAYSHOP_SUBSCRIBE." WHERE m_id = '".$session->m_id."' AND category <> '' ");

			if (!$sc) $ext_param = '&interest=1';
			else	 {
				$ext_param = '&category='.$sc;
				$_POST['returnUrl'] = isset($_POST['returnUrl']) ? str_replace('today_goods.php','today_list.php',$_POST['returnUrl']) : str_replace('today_goods.php','today_list.php',$_SERVER['HTTP_REFERER']);
			}

		}
	}

	// 패스워드 변경 캠페인
	$info_cfg = $config->load('member_info');
	$_ref = parse_url($_SERVER['HTTP_REFERER']);
	if (( preg_match('/member\/login\.php$/',$_ref['path']) || preg_match('/main\/intro_adult\.php$/',$_ref['path']) || preg_match('/main\/intro_member\.php$/',$_ref['path']) )
		&&
		( $info_cfg['campaign_use'] && is_file('../data/skin/'.$cfg['tplSkin'].'/member/password_campaign.htm') )) {

		$show = true;

		// 다음에 변경하기
		if ($show && $_COOKIE['campaign_disregarded_date']) {

			$operate = sprintf('%+d day', $info_cfg['campaign_next_term']);
			$tmp = strtotime($_COOKIE['campaign_disregarded_date']);
			$tmp = strtotime($operate ,$tmp);

			if ($tmp > time()) {
				$show = false;
			}

		}

		if ($show && ($tmp = (int)strtotime($_SESSION['member']['password_moddt'])) > 0) {

			$operate = sprintf('%+d %s', $info_cfg['campaign_period_value'], ($info_cfg['campaign_period_type'] == 'd' ? 'day' : 'month'));
			$tmp = strtotime($operate ,$tmp);

			if ($tmp > time()) {
				$show = false;
			}

		}

		if ($show) {
			$ext_param .= '&ori_returnUrl='.($_POST['returnUrl'] ? urlencode($_POST['returnUrl']) : urlencode($_SERVER['HTTP_REFERER']));
			$_POST['returnUrl'] = '../member/password_campaign.php';
		}

	}
}

if(!$_POST['returnUrl']) { $_POST['returnUrl'] = $_SERVER['HTTP_REFERER']; }
$div = explode("/",$_POST['returnUrl']);
if (preg_match("/http/",$div[0]) && in_array($div[count($div)-2],array("member","mypage"))) $_POST['returnUrl'] = "../main/index.php";
$_POST['returnUrl'] = preg_match('/\?/',$_POST['returnUrl']) ? $_POST['returnUrl'].$ext_param : $_POST['returnUrl'].'?'.$ext_param;

if (preg_match('/(^\.\.\/)|(^\/shop\/)/',$_POST['returnUrl'])) {
	$_POST['returnUrl'] = preg_replace('/(^\.\.\/)|(^\/shop\/)/', '', $_POST['returnUrl']);
	$_POST['returnUrl'] = $sitelink->link($_POST['returnUrl'],'regular');
}

go($_POST['returnUrl']);

?>