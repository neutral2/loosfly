<?
$noDemoMsg = $indexLog = 1;
include "../_header.php";
@include $shopRootDir."/lib/page.class.php";
@include $shopRootDir."/lib/goods_qna.lib.php";

### �����Ҵ�
$goodsno = $_GET[goodsno];
if ( file_exists( dirname(__FILE__) . '/../data/skin/' . $cfg['tplSkin'] . '/admin.gif' ) ) $adminicon = 'admin.gif';
if(!$cfg['qnaWriteAuth']) $cfg['qnaWriteAuth'] = (isset($cfg['qnaAuth_W']) && !$cfg['qnaAuth_W']) ? "free" : ""; // �۾��� ����

### ������ ����
if(!$cfg['qnaListCnt']) $cfg['qnaListCnt'] = 5;

### ��ǰ �������亯
$pg = new Page($_GET[page],$cfg['qnaListCnt']);
$pg -> field = "b.m_no, b.m_id,b.name as m_name,a.*";

if($_GET['goodsno']) {
	$where[] = "a.goodsno = '$_GET[goodsno]'";

	$qna_where[] = "a.goodsno = '$goodsno'";
	$qna_where[] = "a.parent = a.sno";
}
else {
	chkMemberMobile();
	### ȸ�������� ���ô�� & ȸ����۰� �������� �� �⺻Ű
	$qna_sno = array();

	$res = $db->query( "select sno, parent from ".GD_GOODS_QNA." where m_no='$sess[m_no]'" );
	while ( $row = $db->fetch( $res ) ) {
		if ( $row['sno'] == $row['parent'] ) {
			$res_s = $db->query( "select sno from ".GD_GOODS_QNA." where parent='$row[sno]'" );
			while ( $row_s = $db->fetch( $res_s ) ) $qna_sno[] = $row_s['sno'];
		}
		else if ( $row['sno'] != $row['parent'] ){
			$qna_sno[] = $row['sno'];
			$qna_sno[] = $row['parent'];
		}
	}

	if ( count( $qna_sno ) ) $where[] = "a.sno in ('" . implode( "','", $qna_sno ) . "')";
	else $where[] = "0";

	$qna_where[] = "a.m_no = '$sess[m_no]'";
	$qna_where[] = "a.parent = a.sno";
}

$where[]="notice!='1'";
$pg->setQuery($db_table=GD_GOODS_QNA." a left join ".GD_MEMBER." b on a.m_no=b.m_no",$where,$sort="parent desc, ( case when parent=a.sno then 0 else 1 end ) asc, regdt desc");
$pg->exec();

$res = $db->query($pg->query);

while ($data=$db->fetch($res)){

	### ���� üũ
	list($data['parent_m_no'],$data['secret'],$data['type']) = goods_qna_answer($data['sno'],$data['parent'],$data['secret']);
	list($data['answer_yn']) = goods_qna_answer_yn($data['sno']);
	
	### ����üũ
	if(!$cfg['qnaSecret']) $data['secret'] = 0;
	list($data['authmodify'],$data['authdelete'],$data['authview']) = goods_qna_chkAuth($data);

	### ��б� ������
	$data['secretIcon'] = 0;
	if($data['secret'] == '1') $data['secretIcon'] = 1;

	$query = "select b.goodsnm,b.img_s,c.price
			from
				".GD_GOODS." b
				left join ".GD_GOODS_OPTION." c on b.goodsno=c.goodsno and link and go_is_deleted <> '1' and go_is_display = '1'
			where
				b.goodsno = '" . $data[goodsno] . "'";
	list( $data[goodsnm], $data[img_s], $data[price] ) = $db->fetch($query);
	
	$data['img_html'] = goodsimgMobile($data[img_s],100);

	### ����ó��
	$data['idx'] = $pg->idx--;

	### ������ ������ ���
	list( $level ) = $db->fetch("select level from ".GD_MEMBER." where m_no!='' and m_no='".$data['m_no']."'");
	if ( $level == '100' && $adminicon ) $data['m_id'] = $data['name'] = "<img src='../data/skin/".$cfg['tplSkin']."/".$adminicon."' border=0>";
	
	if ($ici_admin) $data['accessable'] = true;
	else if ($data['secret'] != '1') $data['accessable'] = true;
	else if ($data['m_no'] > 0 && $sess['m_no'] == $data['m_no']) $data['accessable'] = true;
	else $data['accessable'] = false;
	
	$loop[] = $data;
}

/* ��ǰ ���Ǳ� �ۼ� ���� �߰� ���� */
if($_GET['goodsno']) {
	$tpl->assign('goodsno', $_GET['goodsno']);
}
/* ��ǰ ���Ǳ� �ۼ� ���� �߰� �� */

// ��ǰ ���� ��������
	

	$pg_qna = new Page(1,10);
	$pg_qna -> field = "b.m_no, b.m_id,b.name as m_name,a.*";
	
	$where[]="notice!='1'";
	$pg_qna->setQuery($db_table=GD_GOODS_QNA." a left join ".GD_MEMBER." b on a.m_no=b.m_no",$qna_where,$sort="parent desc, ( case when parent=a.sno then 0 else 1 end ) asc, regdt desc");
	$pg_qna->exec();

	$res = $db->query($pg_qna->query);
	while ($qna_data=$db->fetch($res)){
		
		$qna_data['idx'] = $pg_qna->idx--;
		### ���� üũ
		list($qna_data['parent_m_no'],$qna_data['secret'],$qna_data['type']) = goods_qna_answer($qna_data['sno'],$qna_data['parent'],$qna_data['secret']);

		$reply_query = "SELECT subject, contents, regdt FROM ".GD_GOODS_QNA." WHERE parent='".$qna_data[sno]."' AND sno != parent";
		$reply_res = $db->_select($reply_query);

		$qna_data['reply'] =$reply_res;	
		$qna_data['reply_cnt'] = count($reply_res);

		### ����üũ
		if(!$cfg['qnaSecret']) $qna_data['secret'] = 0;
		list($qna_data['authmodify'],$qna_data['authdelete'],$qna_data['authview']) = goods_qna_chkAuth($qna_data);

		$query = "select b.goodsnm,b.img_s,c.price
			from
				".GD_GOODS." b
				left join ".GD_GOODS_OPTION." c on b.goodsno=c.goodsno and link and go_is_deleted <> '1' and go_is_display = '1'
			where
				b.goodsno = '" . $qna_data[goodsno] . "'";
		list( $qna_data[goodsnm], $qna_data[img_s], $qna_data[price] ) = $db->fetch($query);
		

		### ��б� ������
		$qna_data['secretIcon'] = 0;
		if($qna_data['secret'] == '1') $qna_data['secretIcon'] = 1;

		if($qna_data['name']) {
			$tmp_name = $qna_data['name'];
		}
		else {
			$tmp_name = $qna_data['m_id'];
		}

		if(!preg_match('/[0-9A-Za-z]/', substr($tmp_name, 0, 1))) {
			$division_num = 2;
		}
		else {
			$division_num = 1;
		}

		$qna_data['qna_name'] = substr($tmp_name, 0, $division_num).implode('', array_fill(0, intval((strlen($tmp_name) -1)/$division_num), '*'));

		if ($ici_admin) $qna_data['accessable'] = true;
		else if ($qna_data['secret'] != '1') $qna_data['accessable'] = true;
		else if ($qna_data['m_no'] > 0 && $sess['m_no'] == $qna_data['m_no']) $qna_data['accessable'] = true;
		else $qna_data['accessable'] = false;

		$qna_loop[] = $qna_data;
	}

$tpl->assign('qna_cnt', $pg_qna->recode['total']);
$tpl->assign('qna_loop', $qna_loop);
$tpl->assign( 'pg', $pg );

### ���ø� ���
$tpl->print_('tpl');
?>