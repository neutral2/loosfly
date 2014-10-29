<?

include "../_header.php";
include "../lib/page.class.php";
include "../conf/config.pay.php";

include "../conf/design.main.php";
@include "../conf/design_main.$cfg[tplSkin].php";
if (is_file(dirname(__FILE__) . "/../conf/config.soldout.php"))
	include dirname(__FILE__) . "/../conf/config.soldout.php";

try {

	$goodsHelper   = Clib_Application::getHelperClass('front_goods');
	$r_page_num = array(20,40,60,80);

	// 파라미터 설정
	$params = array(
		'page' => Clib_Application::request()->get('page', 1),
		'page_num' => Clib_Application::request()->get('page_num', $r_page_num[0]),
		'sort' => Clib_Application::request()->get('sort', 'goods_display.sort asc'),
		'mode' => 0,	// 0 번 그룹
		'tplSkin' => $cfg['shopMainGoodsConf'] == "E" ? $cfg['tplSkin'] : '',
	);

	if ($tpl->var_['']['connInterpark']) {
		$params['inpk_prdno'] = true;
	}

	// 상품 목록
	$goodsCollection = $goodsHelper->getGoodsCollection($params);

	$selected['page_num'][Clib_Application::request()->get('page_num')] = "selected";

	$tpl->assign(array(
				'loop'	=> $goodsHelper->getGoodsCollectionArray($goodsCollection),
				'pg'	=> $goodsCollection->getPaging(),
				'slevel' =>  Clib_Application::session()->getMemberLevel(),
				));
	$tpl->print_('tpl');
}
catch (Clib_Exception $e) {
	Clib_Application::response()->jsAlert($e)->historyBack();
}
