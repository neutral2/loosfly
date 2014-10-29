<?php

/* Return Display Goods Data Function */

function dataDisplayGoods( $mode, $img='img_s', $limit=0 ){

	global $db, $cfg ,$lstcfg;
	include dirname(__FILE__) . "/../../conf/config.pay.php";

	if (is_file(dirname(__FILE__) . "/../../conf/config.soldout.php"))
		include dirname(__FILE__) . "/../../conf/config.soldout.php";

	$goods = array();

	if ($GLOBALS['tpl']->var_['']['connInterpark']) $where .= "and b.inpk_prdno!=''";
	if (isset($GLOBALS['tpl']->var_['']['id'])) $GLOBALS['tpl']->var_['']['id'] = '';

	$orderby = 'order by a.sort';

	/* 메인 페이지 상품 진열인 경우 스킨별 처리 */
	if ( strlen($mode) == 1 ){
		if( $cfg['shopMainGoodsConf'] == "E" ){
			$where .= " and tplSkin = '".$cfg['tplSkin']."'";
		}else{
			$where .= " and (tplSkin = '' OR tplSkin IS NULL)";
		}

		// 품절 상품 제외
		if ($cfg_soldout['exclude_main']) {
			$where .= " AND !( b.runout = 1 OR (b.usestock = 'o' AND b.usestock IS NOT NULL AND b.totstock < 1) ) ";
		}
		// 제외시키지 않는 다면, 맨 뒤로 보낼지를 결정
		else if ($cfg_soldout['back_main']) {
			$orderby = "order by `soldout` ASC, a.sort";
			$_add_field = ",IF (b.runout = 1 , 1, IF (b.usestock = 'o' AND b.totstock = 0, 1, 0)) as `soldout`";
		}
	}

	$query = "
	select
		*,b.$img img_s
		$_add_field
	from
		".GD_GOODS_DISPLAY." a
		left join ".GD_GOODS." b on a.goodsno=b.goodsno
		left join ".GD_GOODS_OPTION." c on a.goodsno=c.goodsno and link and go_is_deleted <> '1' and go_is_display = '1'
		left join ".GD_GOODS_BRAND." d on b.brandno=d.sno
	where
		a.mode = '$mode'
		and b.open
		{$where}
	{$orderby}
	";
	if ( $limit > 0 ) $query .= " limit " . $limit;
	$res = $db->query($query);
	while ( $data = $db->fetch( $res, 1 ) ){

		### 실재고에 따른 자동 품절 처리
		$data['stock'] = $data['totstock'];
		if ($data[usestock] && $data[stock]==0) $data[runout] = 1;

		### 쿠폰
		list($data['coupon'],$data['coupon_emoney']) = getCouponInfo($data['goodsno'],$data['price']);

		### 적립금 셋팅
		if(!$data['use_emoney']){
			if( !$set['emoney']['chk_goods_emoney'] ){
				if( $set['emoney']['goods_emoney'] ) $tmp['reserve'] = getDcprice($data['price'],$set['emoney']['goods_emoney'].'%');
			}else{
				$tmp['reserve'] = $set['emoney']['goods_emoney'];
			}
			$data['reserve'] = $tmp['reserve'];
		}

		$data['reserve'] += $data['coupon_emoney'];

		### 아이콘
		$data[icon] = setIcon($data[icon],$data[regdt]);

		$data['shortdesc'] = ($lstcfg[rtpl] == "tpl_10") ? htmlspecialchars($data['shortdesc']) : $data['shortdesc'];	// 짤은설명 툴팁 수정

		// 출력 제어
		$goods[] = setGoodsOuputVar($data);
	}

	return $goods;
}
?>