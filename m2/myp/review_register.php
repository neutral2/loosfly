<?
include dirname(__FILE__) . "/../_header.php";
/* 2013.04.03 dn ��ǰ�ı� �ۼ� ������ �߰� */
### ����üũ
if ($_GET['mode'] == "add_review" && $cfg['reviewAuth_W'] && $cfg['reviewAuth_W'] > $sess['level']) msg("�̿��ı� �ۼ� ������ �����ϴ�", -1);
if ($_GET['mode'] == "reply_review" && $cfg['reviewAuth_P'] && $cfg['reviewAuth_P'] > $sess['level']) msg("�̿��ı� �亯 ������ �����ϴ�", -1);

### �����Ҵ�
$mode		= $_GET[mode];
$goodsno	= $_GET[goodsno];
$sno		= $_GET[sno];

### ��ǰ ����Ÿ
$query = "
select
	goodsnm,img_s,price
from
	".GD_GOODS." a
	left join ".GD_GOODS_OPTION." b on a.goodsno=b.goodsno and go_is_deleted <> '1' and go_is_display = '1'
where
	a.goodsno='$goodsno'
";
if (($goods = $db->fetch($query,1)) == false && ($sess['level'] < 80) ) {
	msg('�ش� ��ǰ�� �����Ǿ� �̿� �ı⸦ �ۼ� �� �� �����ϴ�.', -1);
	exit;
}

### ȸ������
if($mode != 'mod_review' && $sess['m_no']){
	list($data['name'],$data['nickname']) = $db-> fetch("select name,nickname from ".GD_MEMBER." where m_no='".$sess['m_no']."' limit 1");
	if($data['nickname'])$data['name'] = $data['nickname'];
} //end if

### ��ǰ ����
if ( $mode == 'mod_review' ){
	$query = "select a.sno, b.m_no, b.m_id, a.subject, a.contents, a.point, a.name, a.attach from ".GD_GOODS_REVIEW." a left join ".GD_MEMBER." b on a.m_no=b.m_no where a.sno='$sno'";
	$data = $db->fetch($query,1);

	$data['point'] = array( $data['point'] => 'checked' );

	if ($data[attach] == 1) {
		$data[image] = '<img src="../data/review/'.'RV'.sprintf("%010s", $data[sno]).'" width="20" style="border:1 solid #cccccc" onclick=popupImg("../data/review/'.'RV'.sprintf("%010s", $data[sno]).'","../") class=hand>';
	}
	else $data[image] = '';

}
else {
	$data['m_id'] = $sess['m_id'];
}

// ���� ������ ó��
$data['subject'] = ($_POST['subject']) ? $_POST['subject'] : $data['subject'];
$data['contents'] = ($_POST['contents']) ? $_POST['contents'] : $data['contents'];
if($_POST['point']) $data['point'] = array( $_POST['point'] => 'selected' );

### ���ø� ���
$tpl->print_('tpl');

?>