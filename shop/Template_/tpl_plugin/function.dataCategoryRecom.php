<?php

/* Return Category Recom Goods Data Function */

function dataCategoryRecom( $category, $limit=0 ){

	global $db;

	$goods = array();

	$query = "
	select
		distinct a.goodsno,b.goodsnm,b.img_s,c.price
	from
		".GD_GOODS_LINK." a
		left join ".GD_GOODS." b on a.goodsno=b.goodsno
		left join ".GD_GOODS_OPTION." c on a.goodsno=c.goodsno and link and go_is_deleted <> '1' and go_is_display = '1'
	where
		category like '$category%'
		and icon&2";
	if ( $limit > 0 ) $query .= " limit " . $limit;
	$res = $db->query($query);
	while ( $data = $db->fetch( $res, 1 ) ) $goods[] = $data;

	return $goods;
}
?>