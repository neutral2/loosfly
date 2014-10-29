<?

include "../conf/config.php";
include "../_header.php"; chkMember();
include "../conf/fieldset.php";

$mode = "modMember";
$data = $db->fetch("select MB.*, SC.category from ".GD_MEMBER." AS MB LEFT JOIN ".GD_TODAYSHOP_SUBSCRIBE." AS SC ON MB.m_id = SC.m_id where MB.m_id='$sess[m_id]'");

$checked[sex][$data[sex]] = "checked";
$checked[marriyn][$data[marriyn]] = "checked";
$checked[calendar][$data[calendar]] = "checked";
$checked[private2][$data[private2]] = "checked";
$checked[private3][$data[private3]] = "checked";
if ($data[mailling]=="y") $checked[mailling] = "checked";
if ($data[sms]=="y") $checked[sms] = "checked";

$selected[job][$data[job]] = "selected";

$data[phone]	= explode("-",$data[phone]);
$data[mobile]	= explode("-",$data[mobile]);
$data[fax]		= explode("-",$data[fax]);
$data[zipcode]	= explode("-",$data[zipcode]);
$data[birth]	= array(
				substr($data[birth],0,2),
				substr($data[birth],2),
				);
$data[marridate]= array(
				substr($data[marridate],0,4),
				substr($data[marridate],4,2),
				substr($data[marridate],6,2),
				);
$data[resno]	= array(
				$data[resno1],
				$data[resno2],
				);
$data['linked_naverCheckout']	= (preg_match("/\|naverCheckout\|/", $data['outlink'])) ? "y" : "n";

foreach ($checked[reqField] as $k => $v) $required[$k] = "required";

// 투데이샵
$_ts_interest = $todayShop->interest();
if ($_ts_interest['use'] == 'y' && $_ts_interest['member'] == 1) {
	$checked['useField']['interest'] = 'checked';
	$selected['interest'][$data['category']] = "selected";
	$tpl->assign('ts_category_all', $ts_category_all);	// 값은 _header.php 에서 불러옵니다.
}

$tpl->assign($data);

// 스킨 패치를 한 경우에만 패스워드 인증 절차를 거침
if(!$_SESSION['sess']['confirm_password'] && is_file($tpl->template_dir.'/member/confirm_password.htm')) {
	$tpl->define(array(
		'frmMember' => 'member/confirm_password.htm'
	));
}
else {
	$tpl->define(array(
		'frmMember'	=> 'member/_form.htm',
	));
}

// 인증정보 제거
if($_SESSION['sess']['endConfirm'] == "y") {
	unset($_SESSION['sess']['confirm_password']);
	unset($_SESSION['sess']['endConfirm']);
}

### 무료보안서버 회원처리url
$tpl->assign('memActionUrl',$sitelink->link('member/indb.php','ssl'));

$tpl->print_('tpl');

?>