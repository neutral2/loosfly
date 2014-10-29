<?php

include "../lib/library.php";
@include "../conf/natebasket.php";
include "../conf/config.php";
@include "../conf/coupon.php";

//사용여부 확인
if($natebasket['useYn'] != 'y') exit;

### 상품 데이타
$query = "
select a.goodsno, a.goodsnm, a.maker, d.brandnm, a.img_l, a.img_m, a.usestock, a.totstock, a.sales_range_start, a.sales_range_end from
        ".GD_GOODS." a
        left join ".GD_GOODS_BRAND." d on a.brandno=d.sno
";
$where[] = "a.open=1";
$where[] = "a.runout=0";

if ($where) $where = " where ".implode(" and ",$where);
$query .= $where;

$res = $db->query($query);

header("Cache-Control: no-cache, must-revalidate");
header("Content-Type: text/plain; charset=euc-kr");
?>
<<<eptime>>><?=date('Y-m-d H:i:s')."\n";?>
<?
$goodsModel = Clib_Application::getModelClass('goods');

while ($v=$db->fetch($res)){		// $res while Start

	// 판매 중지(기간 외 포함)인 경우 제외
	if (! $goodsModel->setData($v)->canSales()) continue;

	### 품절 체크
	if($v['usestock']=='o' && $v['totstock']==0)	continue;

	### 이미지 ( 기본으로 확대이미지 , 그 다음 상세이미지. 둘 다 없으면 전송 안됨. )
	if(!$v['img_l'] || $v['img_l'] == ''){
		if(!$v['img_m'] || $v['img_m'] == ''){
			continue;
		}else{
			$img_name = $v['img_m'];
		}
	}else{
		$img_name = $v['img_l'];
	}

	$query ="select price from ".GD_GOODS_OPTION." where goodsno='$v[goodsno]' and link and go_is_deleted <> '1' and go_is_display = '1'  limit 1";
	list($v[price]) = $db->fetch($query);

	### 상품명에 머릿말 조합
	if($natebasket['nb_goodshead'])$v['goodsnm'] = str_replace(array('{_maker}','{_brand}'),array($v['maker'],$v['brandnm']),$natebasket['nb_goodshead']).$v['goodsnm'];
	$v['goodsnm'] = substr(strip_tags($v['goodsnm']),0,250);	// 글자수 제한

	### 즉석할인쿠폰
	$coupon = 0;
	if($cfgCoupon['use_yn'] && $natebasket['uncoupon'] == 'N'){
		list($v[coupon],$v[coupon_emoney]) = getCouponInfo($v[goodsno],$v[price]);
		//$v[reserve] += $v[coupon_emoney];
		if($v[coupon])$coupon = getDcprice($v[price],$v[coupon]);
	}

	### 쿠폰 회원할인 중복 할인 체크
	if($coupon>0){
		if($cfgCoupon['range'] == 1)$coupon=0;
	}

	### 노출 가격
	$coupon += 0;
	$price = 0;
	$price = $v['price'] - $coupon;
?>
<<<begin>>>
<<<mapid>>><?=$v['goodsno']."\n"?>
<<<pname>>><?=$v['goodsnm']."\n"?>
<<<price>>><?=$price."\n"?>
<<<ftend>>>
<?
}
?>
