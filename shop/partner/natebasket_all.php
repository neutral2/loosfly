<?php

include "../lib/library.php";
@include "../conf/natebasket.php";
include "../conf/config.php";
@include "../conf/coupon.php";

### 사용여부 확인
if($natebasket['useYn'] != 'y') exit;

### 가맹점 URL
$url = "http://".$_SERVER['HTTP_HOST'].$cfg[rootDir];

### 카테고리명 배열
$query = "select catnm,category from ".GD_CATEGORY;
$result = $db->query($query);
$ar_category=array();
while($row = $db->fetch($result))
{
	$ar_category[$row['category']]=$row['catnm'];
}

### 브랜드명 배열
$query = "select sno,brandnm from ".GD_GOODS_BRAND;
$result = $db->query($query);
$ar_brand=array();
while($row = $db->fetch($result))
{
	$ar_brand[$row['sno']]=$row['brandnm'];
}

### 상품 데이타
$query = "
select * from
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

	$query ="select price,reserve from ".GD_GOODS_OPTION." where goodsno='$v[goodsno]' and link and go_is_deleted <> '1' and go_is_display = '1'  limit 1";
	list($v['price'],$v['reserve']) = $db->fetch($query);

	### 상품명에 머릿말 조합
	if($natebasket['nb_goodshead'])$v['goodsnm'] = str_replace(array('{_maker}','{_brand}'),array($v['maker'],$v['brandnm']),$natebasket['nb_goodshead']).$v['goodsnm'];

	$query = "select * from ".GD_GOODS_LINK." where goodsno='$v[goodsno]' limit 1";
	$res2 = $db->query($query);
	while ($w=$db->fetch($res2)){	// $res2 while Start

		### 즉석할인쿠폰
		$coupon = 0;
		if($cfgCoupon['use_yn'] && $natebasket['uncoupon'] == 'N'){
			list($v['coupon'],$v['coupon_emoney']) = getCouponInfo($v['goodsno'],$v['price']);
			$v['reserve'] += $v['coupon_emoney'];
			if($v['coupon'])$coupon = getDcprice($v['price'],$v['coupon']);
		}

		### 쿠폰 회원할인 중복 할인 체크
		if($coupon>0){
			if($cfgCoupon['range'] == 1)$coupon=0;
		}

		### 노출 가격
		$coupon += 0;
		$price = $v['price'] - $coupon;

		### 배송료
		$param = array(
			'mode' => '1',
			'deliPoli' => 0,
			'price' => $price,
			'goodsno' => $v['goodsno'],
			'goods_delivery' => $v['goods_delivery'],
			'delivery_type' => $v['delivery_type']
		);
		$tmp = getDeliveryMode($param);
		$deli=0;
		if ($tmp['type'] == '후불' || $tmp['msg'] == '개별 착불 배송비') {
			$deli = -1;
		} else {
			$deli = $tmp['price']+0;
		}

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

		$tmp = explode("|",$img_name);
		while ($v['img'] = array_shift($tmp)) {
			if ( preg_match('/^http(s)?:\/\//',$v['img']) ) {
				break;
			}
			elseif ($v['img']) {
				$v['img'] = $url.'/data/goods/'.$v['img'];
				break;
			}
		}

		$v['goodsnm'] = substr(strip_tags($v['goodsnm']),0,250);	// 글자수 제한

		### 카테고리
		$length = strlen($w['category'])/3;
		for($i=1;$i<=4;$i++)
		{
			$tmp=substr($w['category'],0,$i*3);
			$v['cate'.$i]=($i<=$length) ? $ar_category[$tmp] : '';
			$v['caid'.$i]=($i<=$length) ? $tmp : '';
		}

		### 상품 리뷰 갯수
		$query ="select count(sno) as cnt from ".GD_GOODS_REVIEW." where goodsno ='".$v['goodsno']."';";
		list($v[review]) = $db->fetch($query);

		if($v['brand']) $v['brand']=substr($ar_brand[$v['brand']],0,250);	// 브랜드명
		if($v['maker']) $v['maker']=substr($v['maker'],0,250);	// 제조사
		if($v['origin']) $v['origi']=substr($v['origin'],0,250);	// 원산지
		if($v['launchdt']) $v['launchdt']=str_replace('-','',$v['launchdt']);	// 출시일 ( - 제거 )

?>
<<<begin>>>
<<<mapid>>><?=$v['goodsno']."\n"?>
<<<pname>>><?=$v['goodsnm']."\n"?>
<<<price>>><?=$price."\n"?>
<<<pgurl>>><?=$url?>/goods/goods_view.php?goodsno=<?=$v['goodsno']."\n"?>
<<<igurl>>><?=$v['img']."\n"?>
<?
	for($j=1;$j<=4;$j++){
		if($v['cate'.$j]) echo "<<<cate".$j.">>>".$v['cate'.$j]."\n";
	}
	for($k=1;$k<=4;$k++){
		if($v['caid'.$k]) echo "<<<caid".$k.">>>".$v['caid'.$k]."\n";
	}
?>
<<<brand>>><?=$v['brandnm']."\n"?>
<<<maker>>><?=$v['maker']."\n"?>
<<<origi>>><?=$v['origin']."\n"?>
<<<pdate>>><?=$v['launchdt']."\n"?>
<<<deliv>>><?=$deli."\n"?>
<<<dterm>>><?="\n"?>
<<<review>>><?=$v[review]."\n"?>
<<<event>>><?="\n"?>
<? if ($coupon){ ?><<<coupo>>><? echo $coupon."\n"; }?>
<? if ($natebasket[nb_pcard]){ ?><<<pcard>>><?=substr($natebasket[nb_pcard],0,250)."\n"?><? } ?>
<<<point>>><?=$v[reserve]."\n"?>
<<<ftend>>>
<?
	}	// $res2 while End
}	// $res while End
?>
