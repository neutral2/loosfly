<?php
include dirname(__FILE__)."/../../lib/library.php";

$config = Core::loader('config');
$hpauthDreamCfg = $config->load('hpauthDream');

/* 드림시큐리티 ******************************************************************************************/

$sDevelopedData = $_REQUEST['sDevelopedData'];

$rtn = split("\\$", $sDevelopedData);

			$ci = $rtn[0];
			$di = $rtn[1];
			$phoneNo = $rtn[2];
			$phoneCorp = $rtn[3];
			$birthDay = $rtn[4];  //생년월일 예)860406
			$gender = $rtn[5];
			$nation = $rtn[6];
			$name = $rtn[7];
			$reqNum = $rtn[8];
			$reqdate = $rtn[9];


$ibirth		= $_REQUEST["ibirth"];		//생년월일 예)19860406
$clntReqNum	= $_REQUEST["clntReqNum"];	//요청번호 : $reqNum값과 같아야 정상인증 (위변조방지)
$result		= $_REQUEST["result"];		//성공시, success
$resultCd	= $_REQUEST["resultCd"];	//성공시, 인증성공

$_SESSION["sess_callType"]	= $_REQUEST["ssCallType"];	//분류값

/* 드림시큐리티 ******************************************************************************************/

if ($gender == 1 || $gender == 3) { //성별판별
	$gender = "M";
} else if ($gender == 2 || $gender == 4){
	$gender = "W";
} else {
	$gender = 0;
}

//만20세 부터 성인
$birthyear = substr($ibirth,0,4); //생년
$thisyear = date("Y", time()); //현재

$age = $thisyear - $birthyear; //나이

$ssCallType = $_SESSION["sess_callType"];

if($age >= 19) {
	$_SESSION['adult'] = 1;
}
else {
	unset($_SESSION['adult']);
}

if($ssCallType == "adultcheck" || $ssCallType == "adultcheckmobile") {//성인인증

	if($_SESSION['adult']) {
		msg("성인 인증되었습니다.");
		if($ssCallType == "adultcheckmobile"){
			$returnUrl = "http://".$_SERVER['HTTP_HOST']."/m/";
			echo "<script>opener.location.replace('$returnUrl')</script>";
			echo "<script>window.close();</script>";
		} else {
			$returnUrl = $_REQUEST["returnUrl"] ? $_REQUEST["returnUrl"] : "../../index.php";
			go($returnUrl, "parent");
		}
	} else {
		unset($_SESSION['adult']);
		msg("성인 인증에 실패했습니다.");
		if($ssCallType == "adultcheckmobile"){
			$returnUrl = "http://".$_SERVER['HTTP_HOST']."/m/";
			echo "<script>opener.location.replace('$returnUrl')</script>";
			echo "<script>window.close();</script>";
		} else {
			$returnUrl = $_REQUEST["returnUrl"] ? $_REQUEST["returnUrl"] : "../../index.php";
			go($returnUrl, "parent");
		}
	}
	exit();
}

list($chkCount) = $db->fetch($db->query("SELECT count(m_id) FROM ".GD_MEMBER." WHERE dupeinfo != '' and dupeinfo is not null and dupeinfo = '$di'")); // 가입된 횟수

?>

<html>
<? if($clntReqNum == $reqNum) { // 요청시 넘긴 요청번호(clntReqNum)와 결과에 포함된 요청번호(reqNum)가 일치해야 인증성공  ?>
<script type="text/javascript">
	function loadAction() {
		var strResult   = "<?=$result?>";		// 결과코드
		var di			= "<?=$di?>";			// 중복가입확인정보(DI)
		var reqNum		= "<?=$reqNum?>";		// 요청번호
		var reqdate		= "<?=$reqdate?>";		// 요청일시

		var strName		= "<?=$name?>";			// 이름
		var birthday	= "<?=$ibirth?>";		// 생년월일
		var phoneNo		= "<?=$phoneNo?>";		// 휴대폰번호
		var phoneCorp	= "<?=$phoneCorp?>";	// 이동통신사
		var foreigner	= "<?=$nation?>";		// 내외국인정보
		var sex			= "<?=$gender?>";		// 성별
		var ageInfo		= "<?=$age?>";			// 나이

		var dupeCount	= "<?=$chkCount?>";		// 가입된 횟수

		var callType = "<?=$ssCallType?>";		// 호출유형

		var minoryn = "<?=$hpauthDreamCfg[minoryn]; ?>"; //성인인증 사용여부

		// 아이디/비밀번호 찾기에서 호출한 경우, parent 에 callType 엘레먼트가 있다.
		if (callType == "findid" || callType == "findpwd") {
			parent.document.fm.action = '';
			parent.document.fm.target = '';
			parent.document.fm.rncheck.value = 'hpauthDream';
			parent.document.fm.dupeinfo.value = di;
			parent.document.fm.submit();

		} else { // default 회원가입

			if (dupeCount > 0) {
				alert( "이미 가입이 되어 있습니다.");
			} else {
				if ( minoryn == 'y' && ageInfo < 19 ) { // 실명인증성공 & 성인인증실패
					parent.document.frmAgree['name']. value = '';
					alert( '성인인증 실패' ); //결과 메시지 출력
				} else if ( strResult == "success" ) { // 휴대폰인증 성공
					alert( "휴대폰인증이 정상처리 되었습니다." ); //결과 메시지 출력
					parent.document.frmAgree.action = '';
					parent.document.frmAgree.target = '';
					parent.document.frmAgree.rncheck.value = 'hpauthDream';
					parent.document.frmAgree.nice_nm.value = strName;
					parent.document.frmAgree.mobile.value = phoneNo;
					parent.document.frmAgree.birthday.value = birthday;
					parent.document.frmAgree.sex.value = sex;
					parent.document.frmAgree.dupeinfo.value = di;
					parent.document.frmAgree.foreigner.value = foreigner;
					parent.document.frmAgree.submit();
				} else { // 휴대폰인증실패
					parent.document.frmAgree['name']. value = '';
					alert( '휴대폰인증이 실패했습니다.\n\n' + strMsg); //결과 메시지 출력
				}
			}

		}
		self.close();
	}
</script>
<? } else { ?>
<script type="text/javascript">
	alert("잘못된 접근입니다.");
</script>
<? } ?>

<body onLoad="javascript:loadAction();"></body>
</html>
