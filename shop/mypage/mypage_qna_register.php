<?

include "../_header.php"; chkMember();

### 변수할당
$mode		= $_GET[mode];
$sno		= $_GET[sno];

### 1:1 문의
if ( $mode == 'mod_qna' ){
	$query = "select b.m_id, a.itemcd, a.subject, a.contents, a.email, a.mobile, a.mailling, a.sms, a.ordno, a.parent from ".GD_MEMBER_QNA." a left join ".GD_MEMBER." b on a.m_no=b.m_no where a.sno='$sno'";
	$data = $db->fetch($query,1);
	$data[mobile]	= explode("-",$data[mobile]);
}
else {
	$data['m_id'] = $sess['m_id'];
}

if( $mode == 'reply_qna' || ( $sno != '' && $data['parent'] != '' && $sno != $data['parent'] ) ) $formtype = 'reply'; // 입력항목 제어


### 무료보안서버 회원처리url
$tpl->assign('myqnaActionUrl',$sitelink->link('mypage/indb.php','ssl'));

### 템플릿 출력
$tpl->print_('tpl');

?>