<?php

/* Return Goods Relation Data Function */

function dataGoodsRelation( $goodsno, $limit=0 ){

	global $db, $cfg_related;

	$goods = array();

	list ($category, $relationis, $relation) = $db->fetch("select category, relationis, relation from
		".GD_GOODS." a
		left join ".GD_GOODS_LINK." b on a.goodsno=b.goodsno
	where
		a.goodsno='$goodsno'
		and open
	limit 1
	"); # 총 레코드수

	### 관련상품 리스트
	if (!$relationis){
		$query = "
		select a.goodsno,b.goodsnm,b.img_s,c.price,b.strprice,b.shortdesc,b.icon,b.regdt from
			".GD_GOODS_LINK." a,
			".GD_GOODS." b
			left join ".GD_GOODS_OPTION." c on b.goodsno=c.goodsno and link and go_is_deleted <> '1' and go_is_display = '1'
		where
			a.goodsno=b.goodsno
			and a.category like '$category%'
			and a.goodsno!='$goodsno'
			and open
		";

		// 품절 상품 제외시
		if ($cfg_related['exclude_soldout']) {
			$query .= "
			AND !(
					b.runout = 1
				OR
					(b.usestock = 'o' AND b.usestock IS NOT NULL AND b.totstock < 1)
				)
			";
		}

		$query .= " order by rand() ";

	} else {
		if (!$relation) return false;

		// 데이터 미수정 호환 코드
		if ($relation == 'new_type') {

			$query = "
			SELECT

				G.goodsno,G.goodsnm,G.img_s,O.price,G.strprice,G.shortdesc,G.icon,G.regdt

			FROM ".GD_GOODS_RELATED." AS R

			INNER JOIN ".GD_GOODS." AS G
			ON R.r_goodsno = G.goodsno
			INNER JOIN ".GD_GOODS_OPTION." AS O
			ON G.goodsno = O.goodsno AND O.link = 1 and go_is_deleted <> '1' and go_is_display = '1'

			WHERE
				R.goodsno = $goodsno
			AND G.open
			AND (
					(R.r_start IS NULL OR R.r_start <= CURDATE())
				AND
					(R.r_end IS NULL OR R.r_end >= CURDATE())
				)
			";

			// 품절 상품 제외시
			if ($cfg_related['exclude_soldout']) {
				$query .= "
				AND !(
						G.runout = 1
					OR
						(G.usestock = 'o' AND G.usestock IS NOT NULL AND G.totstock < 1)
					)
				";
			}

			$query .= "
				ORDER BY R.sort ASC
			";

			// 구 데이터와 호환 처리를 위해 자동 모드처럼 동작하도록 함.
			$relationis = 0;

		}
		else {
			$query = "
			select a.goodsno,a.goodsnm,a.img_s,b.price,a.strprice,a.shortdesc,a.icon,a.regdt from
				".GD_GOODS." a,
				".GD_GOODS_OPTION." b
			where
				a.goodsno=b.goodsno and link and go_is_deleted <> '1' and go_is_display = '1'
				and a.goodsno in ($relation)
				and open
			";

			// 품절 상품 제외시
			if ($cfg_related['exclude_soldout']) {
				$query .= "
				AND !(
						a.runout = 1
					OR
						(a.usestock = 'o' AND a.usestock IS NOT NULL AND a.totstock < 1)
					)
				";
			}
		}
	}
	if ( $limit > 0 ) $query .= " limit " . $limit;
	$res = $db->query($query);
	while ( $data = $db->fetch( $res, 1 ) ) {
		$data[icon] = setIcon($data[icon],$data[regdt]);
		$arr_relation[] = $data;
	}

	if($relationis){
		$arr  = explode(',',$relation);
		foreach($arr as $k2 => $v2)if($arr_relation)foreach($arr_relation as $k => $v)if($v2 == $v[goodsno])$goods[] = $v;
	}else $goods = $arr_relation;

	return $goods;
}
?>