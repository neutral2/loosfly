<?
include "../lib/library.php";
include "../conf/config.php";

if($_POST[resno][0])$resno1 = md5($_POST[resno][0]);
if($_POST[resno][1])$resno2 = md5($_POST[resno][1]);

### 실명 인증 체크
if ($_POST[mode]=="chkRealName"){

	header ("Cache-Control: no-cache, must-revalidate");
	header ("Pragma: no-cache");

	include "../conf/fieldset.php";

	if ( $realname[useyn] == 'y' && !empty($realname[id]) ){
		if ($_POST[resno][0] && $_POST[resno][1]){
			list ($chk) = $db->fetch("select * from ".GD_MEMBER." where resno1='$resno1' and resno2='$resno2'");
			if ($chk) msg("동일한 주민등록번호로 이미 가입이 되어 있습니다",0);
		}

		require_once( "./realname/RNCheckRequest.php" );
		exit;
	}

	echo "
	<script>
	parent.document.frmAgree.action = '';
	parent.document.frmAgree.target = '';
	parent.document.frmAgree.submit();
	</script>
	";
	exit;
}

### 아이디 체크
if ($_GET[mode]=="chkId"){
	include "../conf/fieldset.php";

	### 아이디 입력형식
	if (preg_match('/^[\xa1-\xfea-zA-Z0-9_-]{4,20}$/',$_GET['m_id']) == 0) {
		msg('아이디 입력 형식 오류입니다');
		exit;
	}

	### 거부 아이디 필터링
	if (find_in_set(strtoupper($_GET[m_id]),strtoupper($joinset[unableid]))){
		msg("사용 불가능한 아이디입니다");
		exit;
	}

	list ($chk) = $db->fetch("select m_id from ".GD_MEMBER." where m_id='$_GET[m_id]'");
	if ($chk) msg("이미 등록된 아이디입니다");
	else {
		echo "<script>parent.document.frmMember.chk_id.value = 1;</script>";
		msg("사용이 가능합니다");
	}
	exit;
}

### 닉네임 체크
if ($_GET[mode]=="chkNickname"){
	list ($chk) = $db->fetch("select nickname from ".GD_MEMBER." where nickname='".$_GET['nickname']."' and m_id != '".$_GET['m_id']."'");
	if ($chk){
		echo "<script>parent.document.frmMember.chk_nickname.value = '';</script>";
		msg("이미 등록된 닉네임입니다. 다시 작성해 주십시요!");
	} else {
		echo "<script>parent.document.frmMember.chk_nickname.value = 1;</script>";
		msg("사용이 가능합니다");
	}
	exit;
}

### 이메일 체크
if ($_GET[mode]=="chkEmail"){
	list ($chk) = $db->fetch("select email from ".GD_MEMBER." where email='$_GET[email]' and m_id != '".$_GET['m_id']."'");
	if ($chk){
		echo "<script>parent.document.frmMember.chk_email.value = '';</script>";
		msg("이미 등록된 이메일입니다. 다시 작성해 주십시요!");
	} else {
		echo "<script>parent.document.frmMember.chk_email.value = 1;</script>";
		msg("사용이 가능합니다");
	}
	exit;
}

### 변수 재설정
if ($_POST[birth]) $birth = trim(sprintf("%02d%02d",$_POST[birth][0],$_POST[birth][1]));
$zipcode  = @implode("-",$_POST[zipcode]);
$phone	  = @implode("-",$_POST[phone]);
$mobile   = @implode("-",$_POST[mobile]);
$fax	  = @implode("-",$_POST[fax]);
$_POST[busino] = preg_replace("/[^0-9-]+/","",$_POST[busino]);
if (is_array($_POST[interest])) $interest = array_sum($_POST[interest]);
if ($_POST[marridate]) $_POST[marridate] = trim(sprintf("%4d%02d%02d",$_POST[marridate][0],$_POST[marridate][1],$_POST[marridate][2]));
$mailling  = ($_POST[mailling]) ? "y" : "n";
$sms	   = ($_POST[sms]) ? "y" : "n";
$private1  = ($_POST[private1]) ? "y" : "n";
$private2  = ($_POST[private2]) ? "y" : "n";
$private3  = ($_POST[private3]) ? "y" : "n";

$qr = "
name		= '$_POST[name]',
nickname	= '$_POST[nickname]',
sex			= '$_POST[sex]',
birth_year	= '$_POST[birth_year]',
birth		= '$birth',
calendar	= '$_POST[calendar]',
email		= '$_POST[email]',
zipcode		= '$zipcode',
address		= '$_POST[address]',
road_address= '$_POST[road_address]',
address_sub	= '$_POST[address_sub]',
phone		= '$phone',
mobile		= '$mobile',
fax			= '$fax',
company		= '$_POST[company]',
service		= '$_POST[service]',
item		= '$_POST[item]',
busino		= '$_POST[busino]',
mailling	= '$mailling',
sms			= '$sms',
marriyn		= '$_POST[marriyn]',
marridate	= '$_POST[marridate]',
job			= '$_POST[job]',
interest	= '$interest',
memo		= '$_POST[memo]',
ex1			= '$_POST[ex1]',
ex2			= '$_POST[ex2]',
ex3			= '$_POST[ex3]',
ex4			= '$_POST[ex4]',
ex5			= '$_POST[ex5]',
ex6			= '$_POST[ex6]',
private1	= '$_POST[private1]',
private2	= '$_POST[private2]',
private3	= '$_POST[private3]'
";

switch ($_POST[mode]){

	case "modMember":

		### 중복 로그인 세션 체크
		if ($_POST['m_id'] != $sess[m_id]) msg("로그인 세션 정보가 중복되었습니다. 다시 로그인하여 주십시오.","./logout.php");

		### 닉네임 중복여부 체크
		list ($chk) = $db->fetch("select nickname from ".GD_MEMBER." where nickname='".$_POST['nickname']."' and m_id != '".$_POST['m_id']."'");
		if ($chk) msg("이미 등록된 닉네임입니다",-1);

		if ($_POST['rncheck'] != "ipin") {
			### 주민등록번호 중복여부 체크
			list ($chk) = $db->fetch("select resno1 from ".GD_MEMBER." where resno1='$resno1' and resno2='$resno2'");
			if ($resno1 && $resno2 && $chk) msg("이미 등록된 주민등록번호입니다",'join.php');
			else if ($resno1 && $resno2) $qr .= ", resno1 = '$resno1', resno2 = '$resno2'";

			### 주민번호와 성별 체크
			if ($_POST[resno][1] && $_POST[sex]) {
				$resno_01 = substr($_POST[resno][1], 0, 1);
				if ( ( ($resno_01 == "2" || $resno_01 == "4") && $_POST[sex]=="m") || ( ($resno_01 == "1" || $resno_01 == "3") && $_POST[sex]=="w") ){
					msg("주민등록번호와 성별이 일치하지 않습니다.", -1);
					exit;
				}
			}
		}

		### 비밀번호 검사
		if($_POST['newPassword']) {

			list ($chk) = $db->fetch("SELECT COUNT(m_id) FROM ".GD_MEMBER." WHERE m_id = '".$_POST['m_id']."' AND password in (PASSWORD('".$_POST['originalPassword']."'),OLD_PASSWORD('".$_POST['originalPassword']."'),MD5('".$_POST['originalPassword']."'))");
			if (!$chk) msg("현재 비밀번호를 정확하게 입력하여 주세요.", -1);

			// 사용 가능 여부 (6자 이상 21~7E 까지 ascii)
			if (!preg_match('/^[\x21-\x7E]{6,}$/',$_POST['newPassword'])) msg("사용이 불가능한 비밀번호 입니다.", -1);

			$password_query = " ,password = password('".$_POST['newPassword']."'), password_moddt = NOW() ";
		}
		else {
			$password_query = "";
		}


		### 이메일 중복여부 체크
		list ($chk) = $db->fetch("select email from ".GD_MEMBER." where email='".$_POST['email']."' and m_id != '".$_POST['m_id']."'");
		if ($chk) msg("이미 등록된 이메일입니다",-1);

		$query = " update ".GD_MEMBER." set ";
		if($_POST['dupeinfo']) $query .= " dupeinfo	= '".$_POST['dupeinfo']."', rncheck = 'ipin', ";
		$query .= $qr;
		$query .= $password_query;
		$query .= " where m_no = '$sess[m_no]' ";

		if($db->query($query)){

			### 투데이샵 구독신청 관심 분류
			if (isset($_POST['interest_category'])) {
				// 구독 신청 정보가 있는가?
				if (($subscribe = $db->fetch("SELECT sno FROM ".GD_TODAYSHOP_SUBSCRIBE." WHERE m_id = '".$sess['m_id']."'",1)) != false) {
					// update
					$query = "
					UPDATE ".GD_TODAYSHOP_SUBSCRIBE." SET
						category = '".$_POST['interest_category']."'
					WHERE m_id = '".$sess['m_id']."'
					";
				}
				else {
					// insert
					$query = "
					INSERT INTO ".GD_TODAYSHOP_SUBSCRIBE." SET
						m_id = '".$sess['m_id']."',
						category = '".$_POST['interest_category']."'
					";
				}
				$db->query($query);
			}

			### 네이버 체크아웃 회원연동 - 개인정보 제공동의 철회
			@include "../conf/naverCheckout.cfg.php";
			if($checkoutCfg['useYn']=='y'):
				if (isset($_POST['ncCancelAgreement']) && $_POST['ncCancelAgreement'] == 'y') {
					naverCheckoutHack($sess['m_no']);
				}
			endif;

			$_SESSION['sess']['endConfirm'] = 'y';

			// 회원정보 수정 이벤트
			$info_cfg = $config->load('member_info');

			if ($info_cfg['event_use'] && (int)$info_cfg['event_emoney'] > 0) {
				$now = date('Y-m-d H:i:s');
				if ( $now >= $info_cfg['event_start_date'] && $now <= $info_cfg['event_end_date'] ) {

					// 지급 내역
					$query = sprintf("SELECT count(sno) from ".GD_LOG_EMONEY." where m_no = %d and memo = '회원정보 수정 이벤트' and regdt between '%s' and '%s'",$sess['m_no'], $info_cfg['event_start_date'], $info_cfg['event_end_date'] );
					list($history) = $db->fetch($query);
					if ($history < 1) {

						$query = sprintf("update ".GD_MEMBER." set emoney = emoney + %d where m_no = %d", $info_cfg['event_emoney'], $sess['m_no']);
						$db->query($query);


						$query = sprintf("insert into ".GD_LOG_EMONEY." set m_no = %d, ordno = '', emoney = %d, memo = '회원정보 수정 이벤트', regdt = '%s'", $sess['m_no'], $info_cfg['event_emoney'], $now);
						$db->query($query);

						msg('"회원정보수정 이벤트"\n\n적립금 '.number_format($info_cfg['event_emoney']).'원이 지급되었습니다.');
						break(1);	// break case "modMember"
					}
				}
			}

			msg("회원정보가 수정되었습니다.");

		}
		break;

	case "joinMember":

		include "../conf/fieldset.php";
		if (!$joinset[grp]) $joinset[grp] = 1;

		### 아이디 입력형식
		if (preg_match('/^[\xa1-\xfea-zA-Z0-9_-]{4,20}$/',$_POST['m_id']) == 0) msg('아이디 입력 형식 오류입니다','join.php');

		### 거부 아이디 필터링
		if (find_in_set(strtoupper($_POST[m_id]),strtoupper($joinset[unableid]))) msg("사용 불가능한 아이디입니다",-1);

		### 아이디 중복여부 체크
		list ($chk) = $db->fetch("select m_id from ".GD_MEMBER." where m_id='$_POST[m_id]'");
		if ($chk) msg("이미 등록된 아이디입니다",'join.php');

		# 아이핀 추가
		if ($_POST[rncheck] == "ipin") {
			### dupeinfo 를 필드 dupeinfo 값과 비교한다.
			list ($chk) = $db->fetch("select count(*) as cnt from ".GD_MEMBER." where dupeinfo = '".$_POST['dupeinfo']."'");
			if ($chk > 0) {
				msg("이미 회원등록한 고객입니다.", 'join.php');
			}
		} else if ($_POST[rncheck] == "hpauthDream") {
			### dupeinfo 를 필드 dupeinfo 값과 비교한다.
			list ($chk) = $db->fetch("select count(*) as cnt from ".GD_MEMBER." where dupeinfo = '".$_POST['dupeinfo']."'");
			if ($chk > 0) {
				msg("이미 회원등록한 고객입니다.", 'join.php');
			}
		} else {
			### 주민등록번호 중복여부 체크
			list ($chk) = $db->fetch("select resno1 from ".GD_MEMBER." where resno1='$resno1' and resno2='$resno2'");
			if ($resno1 && $resno2 && $chk){
				msg("이미 등록된 주민등록번호입니다",'join.php');
			}
			### dupeinfo 값으로도 체크한다.
			if ($_POST['dupeinfo']) {
				list ($chk) = $db->fetch("select count(*) as cnt from ".GD_MEMBER." where dupeinfo = '".$_POST['dupeinfo']."'");
				if ($chk > 0) {
					msg("이미 회원등록한 고객입니다.", 'join.php');
				}
			}
		}

		### 회원재가입기간 체크
		if ( $joinset[rejoin] > 0 ){
			$rejoindt = date('Ymd', time() - (($joinset[rejoin]-1)*86400));
			list ($chk) = $db->fetch("select regdt from ".GD_LOG_HACK." where resno1='$resno1' and resno2='$resno2' and date_format( regdt, '%Y%m%d' ) >={$rejoindt} order by regdt desc limit 1");
			if($resno1 && $resno2 && $chk) msg("회원탈퇴 후 {$joinset[rejoin]}일 동안 재가입할 수 없습니다.\\n회원님은 {$chk}에 탈퇴하셨습니다.",-1);

			if ($_POST['dupeinfo']) {
				list ($chk) = $db->fetch("select regdt from ".GD_LOG_HACK." where dupeinfo='".$_POST['dupeinfo']."' and date_format( regdt, '%Y%m%d' ) >={$rejoindt} order by regdt desc limit 1");
				if($_POST['dupeinfo'] && $chk) msg("회원탈퇴 후 {$joinset[rejoin]}일 동안 재가입할 수 없습니다.\\n회원님은 {$chk}에 탈퇴하셨습니다.",-1);
			}
		}

		if ($_POST[rncheck] != "ipin") {
			### 주민번호와 성별 체크
			if ($_POST[resno][1] && $_POST[sex]) {
				$resno_01 = substr($_POST[resno][1], 0, 1);
				if ( ( ($resno_01 == "2" || $resno_01 == "4") && $_POST[sex]=="m") || ( ($resno_01 == "1" || $resno_01 == "3") && $_POST[sex]=="w") ){
					msg("주민등록번호와 성별이 일치하지 않습니다.", -1);
					exit;
				}
			}
		}

		if ($_SESSION['adult'] == 1) {
			$m_adult = 1;
		}
		else {
			$m_adult = 0;
		}

		### 데이타 입력
		$query = "
		insert into ".GD_MEMBER." set
			m_id		= '$_POST[m_id]',
			password	= password('$_POST[password]'),
			password_moddt = now(),
			status		= '$joinset[status]',
			resno1		= '$resno1',
			resno2		= '$resno2',
			emoney		= '$joinset[emoney]',
			level		= '$joinset[grp]',
			regdt		= now(),
			recommid	= '$_POST[recommid]',
			LPINFO		= '$_COOKIE[LPINFO]',
			dupeinfo	= '$_POST[dupeinfo]',
			foreigner	= '$_POST[foreigner]',
			pakey		= '$_POST[pakey]',
			rncheck		= '$_POST[rncheck]',
			m_adult		= '$m_adult',
			$qr
		";
		$db->query($query);
		$m_no = $db->lastID();

		### 네이버 체크아웃(회원연동)
		@include "../conf/naverCheckout.cfg.php";
		if($checkoutCfg['useYn']=='y' && $checkoutCfg['ncMemberYn']=='y'):
			if ($_POST['join_inflow'] == 'NCOneClick' && isset($_SESSION['NCOneClickInfo']) && $_SESSION['NCOneClickInfo']['NCUserNo'] == $_POST['NCUserNo']) {
				$naverCheckoutAPI = Core::loader('naverCheckoutAPI');
				$res = $naverCheckoutAPI->JoinComplete($_POST[m_id], $m_no, $_SESSION['NCOneClickInfo']['NCUserNo'], $_SESSION['NCOneClickInfo']['Timestamp']);
				if ($res === true) {
					$strSQL = "UPDATE ".GD_MEMBER." SET inflow = 'naverCheckout' WHERE m_no = '".$m_no."'";
					$db->query($strSQL);
					unset($_SESSION['NCOneClickInfo']);
					$returnPath = 'member/join_ok.php?mode=nc';
				} else {
					$strSQL = "DELETE FROM ".GD_MEMBER." WHERE m_no = '".$m_no."'";
					$db->query($strSQL);
					msg('네이버체크아웃 가맹점 회원 가입 완료가 실패되어 가입할 수 없습니다.\n(부가서비스를 이용중인 가맹점이 아니거나 승인 상태가 아닙니다.)', 'join.php');
				}
			}
		endif;

		### 적립금 내역 입력
		$code = codeitem('point');
		$query = "
		insert into ".GD_LOG_EMONEY." set
			m_no	= '$m_no',
			emoney	= '$joinset[emoney]',
			memo	= '" . $code['01'] . "',
			regdt	= now()
		";
		$db->query($query);

		### 추천인 적립금 체크
		if($checked['useField']['recommid'] == "checked" && $_POST['recommid']){

			# 자기 자신은 추천을 못하게 처리
			if( $_POST['recommid'] != $_POST['m_id'] ){

				list ($recomm_m_id,$recomm_m_no) = $db->fetch("select m_id,m_no from ".GD_MEMBER." where m_id='".$_POST['recommid']."'");

				# 추천인이 있는경우
				if($recomm_m_id){

					# 추천인에게 적립금 적립
					if($joinset['recomm_emoney'] > 0){
						$query = "
						insert into ".GD_LOG_EMONEY." set
							m_no	= '".$recomm_m_no."',
							emoney	= '".$joinset['recomm_emoney']."',
							memo	= '".$_POST['m_id']." 회원의 추천으로 포인트 적립',
							regdt	= now()
						";
						$db->query($query);

						$strSQL = "UPDATE ".GD_MEMBER." SET emoney = emoney + '".$joinset['recomm_emoney']."' WHERE m_no = '".$recomm_m_no."'";
						$db->query($strSQL);
					}

					# 추천한사람(가입자) 적립금 적립
					if($joinset['recomm_add_emoney'] > 0){
						$query = "
						insert into ".GD_LOG_EMONEY." set
							m_no	= '".$m_no."',
							emoney	= '".$joinset['recomm_add_emoney']."',
							memo	= '".$_POST['recommid']." 회원을 추천하여 포인트 적립',
							regdt	= now()
						";
						$db->query($query);

						$strSQL = "UPDATE ".GD_MEMBER." SET emoney = emoney + '".$joinset['recomm_add_emoney']."' WHERE m_no = '".$m_no."'";
						$db->query($strSQL);
					}

				# 추천인이 없는경우
				} else {
					$query = "
					insert into ".GD_LOG_EMONEY." set
						m_no	= '".$m_no."',
						emoney	= '0',
						memo	= '추천인아이디의 오류로 적립안됨',
						regdt	= now()
					";
					$db->query($query);
				}
			}
		}

		### 회원가입메일
		if ( $_POST[email] && $cfg[mailyn_10] == 'y' )
		{
			$modeMail = 10;
			include "../lib/automail.class.php";
			$automail = new automail();
			$automail->_set($modeMail,$_POST[email],$cfg);
			$automail->_assign($_POST);
			$automail->_send();
		}

		### 회원가입SMS
		sendSmsCase('join',$mobile);

		### 회원가입쿠폰 발급
		$date = date('Y-m-d H:i:s');
		$query = "select * from ".GD_COUPON." where coupontype = 2 and (( priodtype = 1 ) or ( priodtype = 0 and sdate <= '$date' and edate >= '$date' ))";
		$res = $db->query($query);
		$couponCnt=0;
		while($data = $db->fetch($res)){

			$query = "select count(a.sno) from ".GD_COUPON_APPLY." a left join ".GD_COUPON_APPLY."member b on a.sno=b.applysno where a.couponcd='$data[couponcd]' and b.m_no = '$m_no'";
			list($cnt) = $db->fetch($query);
			if(!$cnt){
				$newapplysno = new_uniq_id('sno',GD_COUPON_APPLY);
				$query = "insert into ".GD_COUPON_APPLY." set
							sno				= '$newapplysno',
							couponcd		= '$data[couponcd]',
							membertype		= '2',
							member_grp_sno  = '',
							regdt			= now()";
				$db->query($query);

				$query = "insert into ".GD_COUPON_APPLY."member set m_no='$m_no', applysno ='$newapplysno'";
				$db->query($query);
				$couponCnt++;
			}
		}

		### 투데이샵 구독신청 관심 분류
		if (isset($_POST['interest_category'])) {
			// 구독 신청 정보가 있는가?
			if (($subscribe = $db->fetch("SELECT sno FROM ".GD_TODAYSHOP_SUBSCRIBE." WHERE m_id = '".$sess['m_id']."'",1)) != false) {
				// update
				$query = "
				UPDATE ".GD_TODAYSHOP_SUBSCRIBE." SET
					category = '".$_POST['interest_category']."'
				WHERE m_id = '".$sess['m_id']."'
				";
			}
			else {
				// insert
				$query = "
				INSERT INTO ".GD_TODAYSHOP_SUBSCRIBE." SET
					m_id = '".$sess['m_id']."',
					category = '".$_POST['interest_category']."'
				";
			}
			$db->query($query);
		}

		### 승인 후 가입 처리
		if($joinset['status']=='0') {
			msg("관리자 승인후 가입처리됩니다");
			go($sitelink->link('index.php'));
		}

		### 회원 로그인
		$result = $session->login($_POST['m_id'],$_POST['password']);
		member_log( $session->m_id );

		### 쿠폰 발급 메시지
		if($couponCnt){
			msg('회원 가입 쿠폰이 발급 되었습니다!');
		}

		if ($returnPath != '') {
			go($sitelink->link($returnPath));
		} else {
			go($sitelink->link('member/join_ok.php'));
		}

}

go($_SERVER[HTTP_REFERER]);

?>
