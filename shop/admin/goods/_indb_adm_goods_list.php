<?php
include "../lib.php";

// @todo : �Լ� ���� �� �� ���ο��� ó�� �����ϵ��� ����
$Goods = Core::loader('Goods');

function delGoodsImg($str)
{
	$_dir	= "../../data/goods/";
	$_dirT	= "../../data/goods/t/";

	$div = explode("|",$str);
	foreach ($div as $v){
		if ($v == '') continue;

		if (is_file($_dir.$v)) @unlink($_dir.$v);
		if (is_file($_dirT.$v)) @unlink($_dirT.$v);
	}
}

function delGoods($goodsno){
	global $db;
	$data = $db->fetch("select * from ".GD_GOODS." where goodsno='{$goodsno}'");

	foreach (array('img_i','img_l','img_m','img_s','img_mobile') as $key) {
		delGoodsImg($data[$key]);
	}

	$db->query("delete from ".GD_GOODS." where goodsno='{$goodsno}'");
	$db->query("delete from ".GD_GOODS_ADD." where goodsno='{$goodsno}'");
	$db->query("delete from ".GD_GOODS_DISPLAY." where goodsno='{$goodsno}'");
	$db->query("delete from ".GD_GOODS_LINK." where goodsno='{$goodsno}'");
	$db->query("delete from ".GD_GOODS_OPTION." where goodsno='{$goodsno}'");
	$db->query("delete from ".GD_GOODS_DISCOUNT." where goodsno='{$goodsno}'");
	$db->query("delete from ".GD_MEMBER_WISHLIST." where goodsno='{$goodsno}'");
	$db->query("delete from ".GD_SHOPTOUCH_GOODS." where goodsno='{$goodsno}'");

	### ���̹� ���ļ��� ��ǰ����
	naver_goods_runout($goodsno);

	### ��α׼� ��ǰ����
	include_once("../../lib/blogshop.class.php");
	$blogshop = new blogshop();
	$blogshop->delete_goods($goodsno);

	### �����뷮 ���
	setDu('goods');
}

function copyGoods($goodsno){

	global $db,$Goods;
	static $imgIdx = 0;
	$goodsSort = Core::loader('GoodsSort');

	$_dir	= "../../data/goods/";
	$_dirT	= "../../data/goods/t/";

	$data = $db->fetch("select * from ".GD_GOODS." where goodsno='{$goodsno}'",1);

	### �̹��� ����
	$time = time() . sprintf("%03d", $imgIdx++);

	### �̹��� ����
	$ar_images = array(
		'i' => 'img_i',
		's' => 'img_s',
		'm' => 'img_m',
		'l' => 'img_l',
		'e' => 'img_mobile',
	);

	$image_separator = '|';
	$image_qr = array();

	foreach ($ar_images as $key => $image_field) {

		$images = explode($image_separator , $data[$image_field]);
		$images_nums = sizeof($images);
		$images_seq = 0;

		${$image_field} = array();

		if (sizeof($images) > 0) {
			foreach($images as $image_name) {
				if (empty($image_name)) continue;

				if (! preg_match('/^http(s)?:\/\/.+$/', $image_name)) {
					$image_ext = strrpos($image_name,'.') ? substr($image_name, strrpos($image_name,'.')) : '';

					$_image_name  = $time.'_'.$key.( $images_nums > 1 ? '_'.$images_seq++ : '' );
					$_image_name .= $image_ext ? $image_ext : '';

					// ���� ����
					if (is_file($_dir .$image_name)) @copy($_dir .$image_name, $_dir .$_image_name);
					if (is_file($_dirT.$image_name)) @copy($_dirT.$image_name, $_dirT.$_image_name);

					$image_name = $_image_name;
				}

				${$image_field}[] = $image_name;
			}
		}

		$image_qr[] = "$image_field = '".mysql_real_escape_string(implode($image_separator, ${$image_field}))."'";
	}

	### ��ǰ����
	$except = array_merge( array("goodsno","regdt","inpk_dispno","inpk_prdno","inpk_regdt","inpk_moddt","goodscd") , array_values($ar_images) );

	foreach ($data as $k=>$v){
		if (!in_array($k,$except)){
			$qr[] = "$k='".addslashes($v)."'";
		}
	}
	$query = "
	INSERT INTO ".GD_GOODS." SET
		".implode(",",$qr).",
		".implode(",",$image_qr).",
		regdt	= now()
	";
	$db->query($query);
	$cGoodsno = $db->lastID();

	### �߰��ɼ�
	$except = array("sno","goodsno");
	$res = $db->query("select * from ".GD_GOODS_ADD." where goodsno='{$goodsno}' order by sno asc ");
	while ($data=$db->fetch($res,1)){
		if ($data){ unset($qr);
			foreach ($data as $k=>$v){
				if (!in_array($k,$except)) $qr[] = "$k='".addslashes($v)."'";
			}
			$query = "insert into ".GD_GOODS_ADD." set goodsno='{$cGoodsno}',".implode(",",$qr);
			$db->query($query);
		}
	}

	### ����/���/�ɼ�
	$res = $db->query("select * from ".GD_GOODS_OPTION." where goodsno='{$goodsno}' and go_is_deleted <> '1' order by sno asc");
	while ($data=$db->fetch($res,1)){ unset($qr);
		if ($data){
			foreach ($data as $k=>$v){
				if (!in_array($k,$except)) $qr[] = "$k='".addslashes($v)."'";
			}
			$query = "insert into ".GD_GOODS_OPTION." set goodsno='{$cGoodsno}',".implode(",",$qr);
			$db->query($query);
		}
	}

	### ��ǰ, ī�װ� ��������
	$maxSortIncrease = array();
	$res = $db->query("select * from ".GD_GOODS_LINK." where goodsno='{$goodsno}' order by category");
	while ($data=$db->fetch($res,1)){ unset($qr);
		if ($data){
			unset($data['sort1'], $data['sort2'], $data['sort3'], $data['sort4']);
			foreach ($goodsSort->getManualSortInfoHierarchy($data['category']) as $categorySortSet) {
				if (strlen($data['category'])/3 >= $categorySortSet['depth']) {
					if ($categorySortSet['manual_sort_on_link_goods_position'] === 'FIRST') {
						if (isset($linkSortIncrease[$categorySortSet['category']]) === false) {
							$goodsSort->increaseCategorySort($categorySortSet['category'], $categorySortSet['sort_field']);
							$linkSortIncrease[$categorySortSet['category']] = true;
						}
						$data[$categorySortSet['sort_field']] = 1;
					}
					else {
						$data[$categorySortSet['sort_field']] = ((int)$categorySortSet['sort_max']+1);
					}
					$maxSortIncrease[$categorySortSet['category']] = true;
				}
			}
			foreach ($data as $k=>$v){
				if($k=='sort')$v = -(time());
				if (!in_array($k,$except)) $qr[] = "$k='".addslashes($v)."'";
			}
			$query = "insert into ".GD_GOODS_LINK." set goodsno='{$cGoodsno}',".implode(",",$qr);
			$db->query($query);
		}
	}
	foreach (array_keys($maxSortIncrease) as $category) $goodsSort->increaseSortMax($category);

	### �����뷮 ���
	setDu('goods');

	return $cGoodsno;
}

$return = null;

switch (Clib_Application::request()->get('action')) {
	case 'toggleOpen' :

		$goods = Clib_Application::getModelClass('goods');
		$goods->load(Clib_Application::request()->get('goodsno'));
		$goods->setData('open', Clib_Application::request()->get('value'));

		// ����ϼ� ��ǰ ���� ���� ��������
		$cfgMobileShop = Clib_Application::getLoadConfig('config.mobileShop');
	
		if($cfgMobileShop['vtype_goods'] != 1) {
			$goods->setData('open_mobile', Clib_Application::request()->get('value'));
		}

		$goods->save();

		$return = true;
		break;

	case 'unlinkCategory':
		$query = sprintf("delete from gd_goods_link where sno = '%d'", Clib_Application::request()->get('sno'));
		if ($db->query($query)) {
			$return = true;
		}
		else {
			$return = false;
		}
		break;
	case 'setSoldout':
		$query = sprintf("update gd_goods set runout = 1 where goodsno IN (%s)", implode(',', Clib_Application::request()->get('goodsno')));
		if ($db->query($query)) {
			$return = true;
		}
		else {
			$return = false;
		}
		break;
	case 'delete':

		// transaction;
		Clib_Application::database()->begin();

		try {

			foreach((array) Clib_Application::request()->get('goodsno') as $goodsno) {
				delGoods($goodsno);
			}

			Clib_Application::database()->commit();
			$return = true;
		}
		catch (Clib_Exception $e) {
			Clib_Application::database()->rollback();
			$return = false;
		}
		break;
	case 'copy':

		// transaction;
		Clib_Application::database()->begin();

		try {

			$goods = Clib_Application::getModelClass('goods');

			foreach((array) Clib_Application::request()->get('goodsno') as $goodsno) {
				copyGoods($goodsno);
			}

			Clib_Application::database()->commit();
			$return = true;
		}
		catch (Clib_Exception $e) {
			Clib_Application::database()->rollback();
			$return = false;
		}
		break;
}

echo gd_json_encode($return);
