<?

include "../_header.php";
include "../conf/fieldset.php";

$config = Core::loader('config');
$shopConfig = $config->load('config');
$hpauthDreamCfg = $config->load('hpauthDream');

### 회원인증여부
if( $sess ){
	msg("고객님은 로그인 중입니다.",$code=-1 );
}

$mode = "joinMember";
$checked[sex][m] = $checked[calendar][s] = "checked";
$checked[mailling] = $checked[sms] = "checked";
if ($_POST[resno][1] && $_POST[resno][1][0]%2==0) $checked[sex][w] = "checked";
foreach ($checked[reqField] as $k => $v) $required[$k] = 'required fld_esssential';

if ($_POST[resno][0]){
	$_POST[birth_year] = 1900 + substr($_POST[resno][0],0,2) + floor((substr($_POST[resno][1],0,1)-1)/2) * 1000;
	$_POST[birth][0] = substr($_POST[resno][0],2,2);
	$_POST[birth][1] = substr($_POST[resno][0],4,2);
}

$tplfile = (strpos($_SERVER[HTTP_REFERER],$_SERVER[PHP_SELF]) && isset($_POST[type])) ? "member/join.htm" : "member/agreement.htm";

if ($_POST['rncheck'] == 'ipin' || $_POST['rncheck'] == 'hpauthDream') {
	if ($_POST['sex'] == "M") 	$checked[sex][m] = "checked";
	else 						$checked[sex][w] = "checked";

	if (strlen($_POST['birthday']) == 8) {
		$_POST[birth_year] = substr($_POST['birthday'], 0, 4);
		$_POST[birth][0] = substr($_POST['birthday'],4,2);
		$_POST[birth][1] = substr($_POST['birthday'],6,2);
	}

	$_POST['name'] = $_POST['nice_nm'];

	if (strlen($_POST['mobile']) == 11) { //휴대폰자리가 11자리이면
		$mobile[0] = substr($_POST['mobile'],0,3);
		$mobile[1] = substr($_POST['mobile'],3,4);
		$mobile[2] = substr($_POST['mobile'],7,4);
	} else if (strlen($_POST['mobile']) == 10) { //휴대폰자리가 10자리이면
		$mobile[0] = substr($_POST['mobile'],0,3);
		$mobile[1] = substr($_POST['mobile'],3,3);
		$mobile[2] = substr($_POST['mobile'],6,4);
	}
	$_POST['mobile'] = $mobile;
}

### 네이버 체크아웃(회원연동)
@include "../conf/naverCheckout.cfg.php";
if($checkoutCfg['useYn']=='y' && $checkoutCfg['ncMemberYn']=='y'):
	require "../lib/naverCheckout.class.php";
	$NaverCheckout = Core::loader('NaverCheckout');
	$ncResData = $NaverCheckout->get_oneclickJoin($_POST);

	if ($ncResData['mode'] == 'agreement') { // 이용약관
		$tpl->assign('naverCheckout_oneclickStep',$ncResData['stepHtml']);
		$realname[useyn] = $ipin[useyn] = ''; // 실명확인/아이핀 미사용처리
	} else if ($ncResData['mode'] == 'form') { // 가입폼작성
		$tpl->assign('naverCheckout_oneclickStep',$ncResData['stepHtml']);
		$tpl->assign($ncResData['data']);
		if (substr($ncResData['data']['resno'][1],0,1)%2 == 1) $checked[sex][m] = "checked";
		else $checked[sex][w] = "checked";
	}
endif;

$ipinyn = (empty($ipin['id']) ? 'n' : empty($ipin['useyn']) ? 'n': $ipin['useyn']);
$niceipinyn = (empty($ipin['code']) ? 'n' : empty($ipin['nice_useyn'])? 'n': $ipin['nice_useyn']);
$ipinStatus = ($ipinyn == 'y' || $niceipinyn == 'y') ? 'y' : 'n';

//휴대폰인증
$hpauthDreamyn = (empty($hpauthDreamCfg['cpid']) ? 'n' : empty($hpauthDreamCfg['useyn'])? 'n': $hpauthDreamCfg['useyn']);

$tpl->assign($_POST);
$tpl->assign('realnameyn', (empty($realname[id]) ? 'n' : empty($realname[useyn])? 'n': $realname[useyn] ));
$tpl->assign('ipinyn', $ipinyn);
$tpl->assign('niceipinyn', $niceipinyn);
$tpl->assign('ipinStatus', $ipinStatus);
$tpl->assign('hpauthDreamyn', $hpauthDreamyn);
$tpl->assign('hpauthDreamcpid', $hpauthDreamCfg['cpid']);
$tpl->assign('shopName', $cfg['shopName']);
$tpl->define(array(
			'frmMember'		=> 'member/_form.htm',
			'tpl'			=> $tplfile,
			));
$tpl->define('member_join_auth', 'proc/member_join_auth.htm');

### 무료보안서버 회원처리url
$tpl->assign('memActionUrl',$sitelink->link('member/indb.php','ssl'));

$tpl->print_('tpl');

?>
