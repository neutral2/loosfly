<? /*********************************************************
 * ���ϸ�     :  list.php
 * ���α׷��� :	��ǰ����Ʈ ������
 * �ۼ���     :  dn
 * ������     :  2012.05.31
 **********************************************************/

include dirname(__FILE__) . "/../_header.php";
@include dirname(__FILE__). "/../../shop/conf/config.soldout.php";

try {

	$goodsHelper   = Clib_Application::getHelperClass('front_goods_mobile');

	// ī�װ�
	$categoryModel = $goodsHelper->getCategoryModel(Clib_Application::request()->get('category'));
	if (!$categoryModel->hasLoaded()) {
		throw new Clib_Exception('�з��������� ī�װ��� �������� �ʾҽ��ϴ�.');
	}

	// ���� üũ
	if (!$categoryModel->checkPermission(Clib_Application::session()->getMemberLevel())) {
		throw new Clib_Exception('�̿� ������ �����ϴ�.\\nȸ������� ���ų� ȸ�������� �ʿ��մϴ�.');
	}

	// ī�װ� ���� ��� ���� üũ
	if (!Clib_Application::session()->isAdmin() && getCateHideCnt($categoryModel->getId()) > 0) {
		throw new Clib_Exception('�ش�з��� ������ ���� �з��� �ƴմϴ�.');
	}

	// ������ ����
	$page_title = $categoryModel->getCatnm();

	// ī�װ� ��ǰ ��� ����
	$lstcfg = $categoryModel->getConfig();

	// �Ķ���� ����
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

	// ��ǰ ���
	$goodsCollection = $goodsHelper->getGoodsCollection($params);

	if (Clib_Application::request()->get('kw')) {
		$pg = $goodsCollection->getPaging();

		$page_title = "<span class=\"sky_hilight\">'" . Clib_Application::request()->get('kw') . "'</span> �� �˻����";
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
