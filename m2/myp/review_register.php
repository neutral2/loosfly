<?
include dirname(__FILE__) . "/../_header.php";
/* 2013.04.03 dn 상품후기 작성 페이지 추가 */
### 접근체크
if ($_GET['mode'] == "add_review" && $cfg['reviewAuth_W'] && $cfg['reviewAuth_W'] > $sess['level']) msg("이용후기 작성 권한이 없습니다", -1);
if ($_GET['mode'] == "reply_review" && $cfg['reviewAuth_P'] && $cfg['reviewAuth_P'] > $sess['level']) msg("이용후기 답변 권한이 없습니다", -1);

### 변수할당
$mode		= $_GET[mode];
$goodsno	= $_GET[goodsno];
$sno		= $_GET[sno];

### 상품 데이타
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
	msg('해당 상품이 삭제되어 이용 후기를 작성 할 수 없습니다.', -1);
	exit;
}

### 회원정보
if($mode != 'mod_review' && $sess['m_no']){
	list($data['name'],$data['nickname']) = $db-> fetch("select name,nickname from ".GD_MEMBER." where m_no='".$sess['m_no']."' limit 1");
	if($data['nickname'])$data['name'] = $data['nickname'];
} //end if

### 상품 사용기
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

// 받은 데이터 처리
$data['subject'] = ($_POST['subject']) ? $_POST['subject'] : $data['subject'];
$data['contents'] = ($_POST['contents']) ? $_POST['contents'] : $data['contents'];
if($_POST['point']) $data['point'] = array( $_POST['point'] => 'selected' );

### 템플릿 출력
$tpl->print_('tpl');

?>