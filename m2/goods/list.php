<? /*********************************************************
 * 파일명     :  list.php
 * 프로그램명 :	상품리스트 페이지
 * 작성자     :  dn
 * 생성일     :  2012.05.31
 **********************************************************/

include dirname(__FILE__) . "/../_header.php";
@include dirname(__FILE__). "/../../shop/conf/config.soldout.php";

try {

	$goodsHelper   = Clib_Application::getHelperClass('front_goods_mobile');

	// 카테고리
	$categoryModel = $goodsHelper->getCategoryModel(Clib_Application::request()->get('category'));
	if (!$categoryModel->hasLoaded()) {
		throw new Clib_Exception('분류페이지에 카테고리가 지정되지 않았습니다.');
	}

	// 권한 체크
	if (!$categoryModel->checkPermission(Clib_Application::session()->getMemberLevel())) {
		throw new Clib_Exception('이용 권한이 없습니다.\\n회원등급이 낮거나 회원가입이 필요합니다.');
	}

	// 카테고리 진열 허용 여부 체크
	if (!Clib_Application::session()->isAdmin() && getCateHideCnt($categoryModel->getId()) > 0) {
		throw new Clib_Exception('해당분류는 진열이 허용된 분류가 아닙니다.');
	}

	// 페이지 제목
	$page_title = $categoryModel->getCatnm();

	// 카테고리 상품 목록 설정
	$lstcfg = $categoryModel->getConfig();

	// 파라미터 설정
	if(Clib_Application::request()->get('kw')) {
		$params = array(
			'page' => Clib_Application::request()->get('page', 1),
			'page_num' => Clib_Application::request()->get('page_num', $lstcfg['page_num'][0]),
			'keyword' => Clib_Application::request()->get('kw'),
			'sort' => Clib_Application::request()->get('sort', $categoryModel->getSortColumnName()),
		);
	}
	else {
		$params = array(
			'page' => Clib_Application::request()->get('page', 1),
			'page_num' => Clib_Application::request()->get('page_num', $lstcfg['page_num'][0]),
			'keyword' => Clib_Application::request()->get('kw'),
			'sort' => Clib_Application::request()->get('sort', $categoryModel->getSortColumnName()),
			'category' => $categoryModel->getId(),
		);
	}

	// 상품 목록
	$goodsCollection = $goodsHelper->getGoodsCollection($params);

	if (Clib_Application::request()->get('kw')) {
		$pg = $goodsCollection->getPaging();

		$page_title = "<span class=\"sky_hilight\">'" . Clib_Application::request()->get('kw') . "'</span> 의 검색결과";
		$page_title .= "(" . $pg->recode['total'] . ")";
	}

	$tpl->assign(array(
		'page_title' => $page_title,
		'category' => $categoryModel->getId(),
		'kw' => Clib_Application::request()->get('kw'),
	));
	$tpl->print_('tpl');

} catch (Clib_Exception $e) {
	Clib_Application::response()->jsAlert($e)->historyBack();
}
?>
