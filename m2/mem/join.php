<?
/*********************************************************
* ���ϸ�     :  /mem/nomember_order.php
* ���α׷��� :	����ϼ� ȸ�� ����
* �ۼ���     :  dn
* ������     :  2012.08.14
**********************************************************/
include "../_header.php";
include $shopRootDir ."/conf/fieldset.php";
include $shopRootDir ."/conf/mobile_fieldset.php";

### ȸ����������
if($_GET['mode'] != 'addinfo' && $_GET['mode'] != 'endjoin' ) {
	if( $sess ){
		msg("������ �α��� ���Դϴ�.", $code=-1 );
	}
}
else {
	if(!$sess && !$_SESSION['tmp_m_no']) {
		msg("�߸��� ���԰�� �Դϴ�.", $code=-1);
	}
}

$mode = "joinMember";
$checked[sex][m] = $checked[calendar][s] = $checked[sex][m] = "checked";
$checked[mailling] = $checked[sms] = "checked";
if ($_POST[resno][1] && $_POST[resno][1][0]%2==0) $checked[sex][w] = "checked";
foreach ($checked[reqField] as $k => $v) $required[$k] = "required";

if ($_POST[resno][0]){
	$_POST[birth_year] = 1900 + substr($_POST[resno][0],0,2) + floor((substr($_POST[resno][1],0,1)-1)/2) * 1000;
	$_POST[birth][0] = substr($_POST[resno][0],2,2);
	$_POST[birth][1] = substr($_POST[resno][0],4,2);
}

$tplfile = (strpos($_SERVER[HTTP_REFERER],$_SERVER[PHP_SELF]) && isset($_POST[type])) ? "mem/join.htm" : "mem/agreement.htm";

if($_GET['mode'] == 'addinfo' && ($sess || $_SESSION['tmp_m_no'])) {
	$tplfile = "mem/addinfo.htm";
}

if($_GET['mode'] == 'endjoin' && ($sess || $_SESSION['tmp_m_no'])) {
	$tplfile = "mem/endjoin.htm";
}

// ������
if ($_POST['rncheck'] == 'ipin') {
	if ($_POST['sex'] == "M") 	$checked[sex][m] = "checked";
	else 						$checked[sex][w] = "checked";

	if (strlen($_POST['birthday']) == 8) {
		$_POST[birth_year] = substr($_POST['birthday'], 0, 4);
		$_POST[birth][0] = substr($_POST['birthday'],4,2);
		$_POST[birth][1] = substr($_POST['birthday'],6,2);
	}

	$_POST['name'] = $_POST['nice_nm'];

}

$ipinyn = (empty($ipin['id']) ? 'n' : empty($ipin['useyn']) ? 'n': $ipin['useyn']);
$niceipinyn = (empty($ipin['code']) ? 'n' : empty($ipin['nice_useyn'])? 'n': $ipin['nice_useyn']);
$ipinStatus = ($ipinyn == 'y' || $niceipinyn == 'y') ? 'y' : 'n';

$res = $db->query("select category, catnm from ".GD_CATEGORY." where hidden='0' and length(category)=3");
while ( $category_one = $db->fetch( $res, 1 ) ) $category[] = $category_one;

$tpl->assign($_POST);
$tpl->assign('ipinyn', $ipinyn);
$tpl->assign('niceipinyn', $niceipinyn);
$tpl->assign('ipinStatus', $ipinStatus);
$tpl->assign('shopName', $cfg['shopName']);
$tpl->assign('ts_category_all', $category);
$tpl->define(array(
			'frmMember'		=> 'mem/_form.htm',
			'tpl'			=> $tplfile,
			));

### ���Ẹ�ȼ��� ȸ��ó��url
$tpl->assign('memActionUrl',$sitelink->link('mem/indb.php','free'));

$tpl->print_('tpl');

?>