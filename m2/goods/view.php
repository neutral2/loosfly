<?php
	include dirname(__FILE__) . "/../_header.php";
	@include $shopRootDir . "/conf/config.pay.php";
	@include $shopRootDir . "/conf/sns.cfg.php";
	@include $shopRootDir . "/conf/coupon.php";
	@include $shopRootDir."/lib/goods_qna.lib.php";
	@include $shopRootDir . '/lib/Lib_Robot.php';

try {

	$goodsHelper   = Clib_Application::getHelperClass('front_goods');

	$goodsModel    = $goodsHelper->getGoodsModel(Clib_Application::request()->get('goodsno'));
	if (!$goodsModel->hasLoaded()) {
		throw new Clib_Exception('상품정보가 없습니다.');
	}
	else if (!$goodsModel->getOpenMobile()) {
		throw new Clib_Exception('해당상품은 진열이 허용된 상품이 아닙니다.');
	}

	$categoryModel = $goodsHelper->getCategoryModel(Clib_Application::request()->get('category'), $goodsModel);

	// 성인 인증이 필요한 상품일 경우
	if ($goodsModel->getUseOnlyAdult() && !Clib_Application::session()->canAccessAdult()) {
		Clib_Application::response()->redirect(
			$goodsHelper->getGoodsViewUrlMobile($goodsModel)
		);
	}

	$goodsno = $goodsModel->getId();

	// 카테고리 정보 설정, 접근 권한 체크
	if (!$goodsHelper->canAccessLinkedCategory($goodsModel)) {
		throw new Clib_Exception('이용 권한이 없습니다.\\n회원등급이 낮거나 회원가입이 필요합니다.');
	}

	// 페이지뷰 카운팅
	if (Lib_Robot::isRobotAccess() === false) {
		$db->silent(true);
		$db->query("INSERT INTO ".GD_GOODS_PAGEVIEW." SET date = CURDATE(), goodsno = $goodsno, cnt = 1 ON DUPLICATE KEY UPDATE cnt = cnt + 1");
		$db->silent();
	}

	$data = $goodsHelper->getGoodsDataArray($goodsModel, $categoryModel);

	// 상품 후기 가져오기
	$review_where[] = "a.goodsno = '$goodsno'";
	$review_where[] = "a.sno = a.parent";

	$pg = new Page(1,10);
	$pg->field = "a.sno, a.goodsno, a.subject, a.contents, a.point, a.regdt, a.name, b.m_no, b.m_id, a.attach, a.parent";
	$db_table = "".GD_GOODS_REVIEW." a left join ".GD_MEMBER." b on a.m_no=b.m_no";

	$pg->setQuery($db_table,$review_where,$sort="a.sno desc, a.regdt desc");
	$pg->exec();

	$res = $db->query($pg->query);

	$review_cnt = 0;
	while ($review_data=$db->fetch($res)){

		$review_data['idx'] = $pg->idx--;
		$review_data[contents] = nl2br(htmlspecialchars($review_data[contents]));
		$review_data[point] = sprintf( "%0d", $review_data[point]);

		$query = "select b.goodsnm,b.img_s,c.price
		from
			".GD_GOODS." b
			left join ".GD_GOODS_OPTION." c on b.goodsno=c.goodsno and link and go_is_deleted <> '1' and go_is_display = '1'
		where
			b.goodsno = '" . $data[goodsno] . "'";
		list( $review_data[goodsnm], $review_data[img_s], $review_data[price] ) = $db->fetch($query);

		$reply_query = "SELECT subject, contents, regdt FROM ".GD_GOODS_REVIEW." WHERE parent='".$review_data[sno]."' AND sno != parent";

		$reply_res = $db->_select($reply_query);

		$review_data['reply'] =$reply_res;

		$review_data['reply_cnt'] = count($reply_res);


		if ($review_data[attach] == 1) {
			$review_data[image] = '<img src="../../shop/data/review/'.'RV'.sprintf("%010s", $review_data[sno]).'">';
		}
		else $review_data[image] = '';

		$review_data['review_name'] = '';

		/* encoding 고려하여 수정 해야 함 */
		if($review_data['name']) {
			$tmp_name = $review_data['name'];
		}
		else {
			$tmp_name = $review_data['m_id'];
		}

		if(!preg_match('/[0-9A-Za-z]/', substr($tmp_name, 0, 1))) {
			$division_num = 2;
		}
		else {
			$division_num = 1;
		}

		$review_data['review_name'] = substr($tmp_name, 0, $division_num).implode('', array_fill(0, intval((strlen($tmp_name) -1)/$division_num), '*'));


		for($i=0; $i<5; $i++) {

			if($i < $review_data['point']) {
				$review_data['point_star'] .= '<span class="active">★</span>';
			}
			else {
				$review_data['point_star'] .= '★';
			}
		}

		$review_loop[] = $review_data;

	}

	$data['review_cnt'] = $pg->recode['total'];

	unset($pg);
	unset($where);
	// 상품 문의 가져오기


	$pg = new Page(1,10);
	$pg -> field = "b.m_no, b.m_id,b.name as m_name,a.*";

	$where[] = "a.goodsno = '$goodsno'";
	$where[] = "a.parent = a.sno";

	$where[]="notice!='1'";
	$pg->setQuery($db_table=GD_GOODS_QNA." a left join ".GD_MEMBER." b on a.m_no=b.m_no",$where,$sort="parent desc, ( case when parent=a.sno then 0 else 1 end ) asc, regdt desc");
	$pg->exec();

	$res = $db->query($pg->query);
	while ($qna_data=$db->fetch($res)){

		### 원글 체크
		list($qna_data['parent_m_no'],$qna_data['secret'],$qna_data['type']) = goods_qna_answer($qna_data['sno'],$qna_data['parent'],$qna_data['secret']);

		$reply_query = "SELECT subject, contents, regdt FROM ".GD_GOODS_QNA." WHERE parent='".$qna_data[sno]."' AND sno != parent";
		$reply_res = $db->_select($reply_query);

		$qna_data['reply'] =$reply_res;
		$qna_data['reply_cnt'] = count($reply_res);

		### 권한체크
		if(!$cfg['qnaSecret']) $qna_data['secret'] = 0;
		list($qna_data['authmodify'],$qna_data['authdelete'],$qna_data['authview']) = goods_qna_chkAuth($qna_data);

		### 비밀글 아이콘
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

	$data['qna_cnt'] = $pg->recode['total'];

	unset($pg);

	if($cfgMobileShop['vtype_goods_view_skin'] == 1 || $cfgMobileShop['vtype_goods_view_skin'] == '') {

		$key_file = preg_replace( "'^.*$mobileRootDir/'si", "", $_SERVER['SCRIPT_NAME'] );
		$key_file = preg_replace( "'\.php$'si", "2.htm", $key_file );

		if(is_file($tpl->template_dir.'/'.$key_file)) {
			$tpl->define( array(
				'tpl'			=> $key_file,
			) );
		}
	}

	if($_GET['view_area']) {
		$tpl->assign('view_area', $_GET['view_area']);
	}

	// 페이지뷰 카운팅
	if (Lib_Robot::isRobotAccess() === false) {
		$db->silent(true);
		$db->query("INSERT INTO ".GD_GOODS_PAGEVIEW." SET date = CURDATE(), goodsno = $goodsno, cnt = 1 ON DUPLICATE KEY UPDATE cnt = cnt + 1");
		$db->silent();
	}

	### 템플릿 출력
	$tpl->assign($data);
	$tpl->assign('kw', Clib_Application::request()->get('kw'));
	$tpl->assign('category', $categoryModel->getId());
	$tpl->assign('referer', $_SERVER['HTTP_REFERER']);
	$tpl->assign('review_loop', $review_loop);
	$tpl->assign('qna_loop', $qna_loop);
	$tpl->assign('coupon_cnt', count($data[a_coupon]));
	$tpl->assign('customHeader', $customHeader);

	### 템플릿 출력
	Clib_Application::storage()->toGlobal();

	$tpl->assign(array(
		'clevel'	=> $categoryModel->getLevel(),
		'slevel'=> Clib_Application::session()->getMemberLevel(),
		'level_auth'=> $categoryModel->getLevelAuth()
	));

	$tpl->print_('tpl');

}
catch (Clib_Exception $e) {
	Clib_Application::response()->jsAlert($e)->historyBack();
}
?>