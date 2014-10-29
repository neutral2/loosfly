<?PHP
	$arr_goods_colornm = array(
		'L040' => array( 
			array('Blue',''), 
			array('White',''), 
			array('Pink',''), 
			array('Black','Red'), 
			array('Black','Chestnut') 
		)
	);

	$arr_goods_colorcd = array(
		'L040' => array(
			array('25314b', '027496'), 
			array('ffffff', 'f2e6e8'), 
			array('f2e6e8', 'f2e6e8'), 
			array('000000', '762931'), 
			array('000000', '3f3130')
		)
	);

function get_color_name($goodscd) {
	$goods_gr = substr($goodcs, 0, 4);
	$goods_vr = ord(substr($goodcs, -1)) - ord('A');
	
	$item_name = $arr_goods_colornm[$goods_gr][$goods_vr];
	
	$name = "";
	$name = $item_name[0];
	$name .= $item_name[1] ? " / ".$item_name[1] : "";
	
	return $name;
}

function set_color_tiles($goodscd) {
	$goods_gr = substr($goodcs, 0, 4);
	$goods_vr = ord(substr($goodcs, -1)) - ord('A');
	
	$cnt = count( $arr_colornm );
	if( $cnt > 0 ) {
		for($i = 0; $i < $cnt; $i++) {
			$item_name = $arr_goods_colornm[$goods_gr][$goods_vr];
			$name = "";
			$name = $item_name[0];
			$name .= $item_name[1] ? " / ".$item_name[1] : "";
			
			$item_code = $arr_goods_colorcd[$goods_gr][$goods_vr];
			
		}
	}
};
?>