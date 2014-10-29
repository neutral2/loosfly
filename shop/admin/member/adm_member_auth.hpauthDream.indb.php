<?php

// C1. 라이브러리 인클루드
include dirname(__FILE__).'/../lib.php';

// C2. 설정 및 모듈로드
$shopConfig = Core::loader('config')->load('config');
$dreamsecurity = Core::loader('Dreamsecurity');

//debug($dreamsecurity->checkPrefix($cpid));

// C3. 변수설정
$cpid		= $_POST['cpid'];
$useyn		= $_POST['useyn'];
$minoryn	= $_POST['minoryn'];

// C6. 회원사 cpid 확인
if (strlen(trim($cpid)) < 1) {
	msg('회원사 Code가 입력되지 않았습니다.', -1);
	exit;
}

// C7. 사용여부 확인
else if (strlen(trim($useyn)) < 1) {
	msg('사용여부가 선택되지 않았습니다.', -1);
	exit;
}

// C7. 성인인증 사용여부 확인
else if (strlen(trim($useyn)) < 1) {
	msg('성인인증 사용여부가 선택되지 않았습니다.', -1);
	exit;
}

// C8. 서비스아이디 prefix 확인
else if ($dreamsecurity->checkPrefix($cpid) !== true) {
	msg('회원사 코드가 정확하지 않습니다. 발급받은 코드를 확인하세요.', -1);
	exit;
}

// C9. 설정 저장
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
alert("정상적으로 저장되었습니다.");
location.replace('./adm_member_auth.hpauthDream.php');
</script>