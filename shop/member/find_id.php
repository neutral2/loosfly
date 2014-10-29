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

if( $_POST['act'] == 'Y' && $_POST['rncheck'] != 'ipin' && $_POST['rncheck'] != 'hpauthDream' ){
	$where = array();
	$where[] = "name='" . $_POST['srch_name'] . "'";
	if ( $checked['useField']['resno'] ) $where[] = "resno1='".md5($_POST['srch_num1'])."' and resno2='".md5($_POST['srch_num2'])."'";
	if ( $checked['useField']['email'] ) $where[] = "email='" . $_POST['srch_mail'] . "'";

	list( $m_id, $name ) = $db->fetch("select m_id, name from ".GD_MEMBER." where " . implode( " and ", $where ));
} else if ( $_POST['act'] == 'Y' && ($_POST['rncheck'] == 'ipin' || $_POST['rncheck'] == 'hpauthDream')) {

	list( $m_id, $name ) = $db->fetch("select m_id, name from ".GD_MEMBER." where dupeinfo = '$_POST[dupeinfo]'");
}
$tpl->assign('ipinyn', (empty($ipin[id]) ? 'n' : empty($ipin[useyn])? 'n': $ipin[useyn]));
$tpl->assign('niceipinyn', empty($ipin[nice_useyn])? 'n': $ipin[nice_useyn]);
$tpl->assign('hpauthDreamyn', (empty($hpauthDreamCfg['cpid']) ? 'n' : empty($hpauthDreamCfg['useyn'])? 'n': $hpauthDreamCfg['useyn']));
$tpl->assign('hpauthDreamcpid', $hpauthDreamCfg['cpid']);
$tpl->print_('tpl');
?>