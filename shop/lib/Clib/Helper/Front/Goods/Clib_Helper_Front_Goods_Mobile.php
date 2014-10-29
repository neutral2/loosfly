<?php
/**
 * Clib_Helper_Front_Goods_Mobile
 * @author extacy @ godosoft development team.
 */
class Clib_Helper_Front_Goods_Mobile extends Clib_Helper_Front_Goods_Abstract
{
	protected function setGoodsCollectionAttributes($collection)
	{
		// 네이버 마일리지
		$naverNcash = Core::loader('naverNcash');
		if ($naverNcash->canUseMobile() === false)
			$naverNcash->useyn = "N";
		if ($naverNcash->useyn == 'Y' && $naverNcash->baseAccumRate)
			$naverMileageDisplay = true;
		else
			$naverMileageDisplay = false;

		if (method_exists($category, 'getConfig')) {
			$lstcfg = $category->getConfig();
		}
		else {
			global $lstcfg;
		}
		
		if (!$category instanceof Clib_Model_Category_Category) {
		
			$category_collection = Clib_Application::getCollectionClass('category');
			$category_collection->addExpressionFilter("level <> 0");
			$category_collection->load();
		}
		
		foreach ($collection as $item) {
			// 성인 전용 상품일때 이미지 교체
			if ($item['use_only_adult'] && ! Clib_Application::session()->canAccessAdult()) {
				if($GLOBALS['cfgMobileShop']['mobileShopRootDir'] == "/m2"){
					$skin_folder = "/skin_mobileV2";	
				} else {
					$skin_folder = "/skin_mobile";	
				}
				$item['img_i'] = 'http://' . $_SERVER['HTTP_HOST'] . $GLOBALS['cfg']['rootDir'] . "/data" . $skin_folder . "/" . $GLOBALS['cfg']['tplSkinMobile'] . '/common/img/19.gif';
				$item['img_s'] = 'http://' . $_SERVER['HTTP_HOST'] . $GLOBALS['cfg']['rootDir'] . "/data" . $skin_folder . "/" . $GLOBALS['cfg']['tplSkinMobile'] . '/common/img/19.gif';
				$item['img_m'] = 'http://' . $_SERVER['HTTP_HOST'] . $GLOBALS['cfg']['rootDir'] . "/data" . $skin_folder . "/" . $GLOBALS['cfg']['tplSkinMobile'] . '/common/img/19.gif';
				$item['img_l'] = 'http://' . $_SERVER['HTTP_HOST'] . $GLOBALS['cfg']['rootDir'] . "/data" . $skin_folder . "/" . $GLOBALS['cfg']['tplSkinMobile'] . '/common/img/19.gif';
			}
			if (is_file('../../shop/data/goods/' . $item['img_s'])) {
				$item['img_html'] = goodsimgMobile($item['img_s'], 100);
				$item['goodsImage'] = goodsimgMobile($item['img_s'], 100);
			}
			else if (is_file('../../shop/data/goods/' . $item['img_mobile'])) {
				$item['img_html'] = goodsimgMobile($item['img_mobile'], 100);
				$item['goodsImage'] = goodsimgMobile($item['img_mobile'], 100);
			}
			else {
				$img_l_arr = explode("|", $item['img_l']);
				$item['img_html'] = goodsimgMobile($img_l_arr[0], 100);
				$item['goodsImage'] = goodsimgMobile($img_l_arr[0], 100);
			}

			if ($naverMileageDisplay) {
				$exceptionYN = $naverNcash->exception_goods(array( array('goodsno' => $item['goodsno'])));
				if ($exceptionYN == 'N') {
					$item['NaverMileageAccum'] = true;
				}
			}

			### 적립금 정책적용
			$item['reserve'] = $item->getReserve();

			$item['price'] = $item->getPrice();
			$item['consumer'] = $item->getGoodsConsumer();
			$item['reserve'] = $item->getReserve();

			$tmp_category = null;
			
			if (!$category instanceof Clib_Model_Category_Category) {
				$goods_link_collection = $item->getCategory();
			
				foreach($category_collection as $category_model) {
					foreach($goods_link_collection as $goods_link) {
			
						if($category_model->getData('category') == $goods_link->getData('category')) {
							$category = $category_model;
							break;
						}
					}
			
					if($category instanceof Clib_Model_Category_Category) {
						break;
					}
				}
			
				$tmp_category = $category;
				unset($category);
			}
			else {
				$tmp_category = $category;
			}
			
			if ($tmp_category instanceof Clib_Model_Category_Category) {
				$item['auth_step'] = $tmp_category->getAuthStep();
				$item['level'] = $tmp_category->getLevel();
			}
			
			
			// 가격, 상품명, 기타정보(쿠폰, 아이콘, 적립금 등) 출력 여부
			$item['is_open_price'] = (($item['level'] == 0 || Clib_Application::session()->getMemberLevel() >= $item['level']) || $item['auth_step'][2] == 'Y') ? true : false;
			$item['is_open_extra'] = ($item['level'] == 0 || Clib_Application::session()->getMemberLevel() >= $item['level']) ? true : false;
			$item['is_open_name'] = (($item['level'] == 0 || Clib_Application::session()->getMemberLevel() >= $item['level']) || $item['auth_step'][1] == 'Y') ? true : false;
			
			
			// 각 출력 여부에 따른 처리
			if ($item['is_open_extra'] === false) {
				$item['icon'] = '';
				$item['coupon'] = '';
			}
			else {
				if ($item['runout'] && $cfg_soldout['icon'] == '0')
					$item['icon'] = '';
				if ($item['runout'] && $cfg_soldout['coupon'] == '0')
					$item['coupon'] = '';
			}
			
			// 품절상품 제어
			if ($item['runout']) {
			
				if ($cfg_soldout['display'] == 'icon')
					$item['soldout_icon'] = ($cfg_soldout['display_icon'] == 'custom') ? 'custom' : 'skin';
				elseif ($cfg_soldout['display'] == 'overlay') {
					$item['soldout_overlay'] = ($cfg_soldout['display_overlay'] == 'custom') ? '../data/goods/icon/custom/soldout_overlay' : '../data/goods/icon/icon_soldout' . $cfg_soldout['display_overlay'];
					$item['css_selector'] = 'el-goods-soldout-image';
				}
				else
					$item['soldout_icon'] = 'skin';
			
				if ($cfg_soldout['display'] == 'none') {
					$item['soldout_icon'] = $item['css_selector'] = "";
				}
			
				if ($cfg_soldout['goodsnm'] == '0')
					$item['goodsnm'] = '';
			
				if ($cfg_soldout['price'] == '0') {
			
				}
				elseif ($cfg_soldout['price'] == 'string') {// 대체문구
					$item['price'] = '';
					$item['soldout_price_string'] = $cfg_soldout['price_string'];
				}
				elseif ($cfg_soldout['price'] == 'image') {// 대체문구
					$item['price'] = '';
					$item['soldout_price_image'] = '<img src="../data/goods/icon/custom/soldout_price">';
				}
				else {
					$item['price'] = $item['price'];
				}
			
			}
			
			if ($item['is_open_name'] === false || ($item['runout'] && $cfg_soldout['goodsnm'] == '0')) {
				$item['goodsnm'] = '';
			}
			
			if ($item['is_open_price'] === false) {
				$item['price'] = '';
			}
		}

		return $collection;
	}

}
