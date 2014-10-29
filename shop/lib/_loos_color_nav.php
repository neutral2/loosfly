<?PHP
function set_array($memo) {	
	global $arr_colornm;
	global $arr_colorcd;
	global $arr_family;
	
	$color_name = $color_code = $family_number = "";
	
	parse_str($memo);
	if( isset($color_name) && $color_name != "" ) {
		$arr_colornm = explode('|', $color_name);
	}
	if( isset($color_code) && $color_code != "" ) {
		$arr_colorcd = explode('|', $color_code);
	}
	if( isset($family_number) && $family_number != "" ) {
		$arr_family = explode('|', $family_number);
	}
}

function get_color_name($goodscd) {	
	global $arr_colornm;
	$goods_vr = ord(substr($goodscd, -1)) - ord('A');
	$cn = explode(',', $arr_colornm[$goods_vr]);
	
	$name = "";
	$name = $cn[0];
	$name .= $cn[1] ? " / ".$cn[1] : "";
	
	return $name;
}

function set_color_tiles($goodscd) {
	global $arr_colornm;
	global $arr_colorcd;
	global $arr_family;
	
	$w = "25px";$w1 = "15px";$w2 = "10px";
	$h = "12px";

	if( isset($goodscd) && $goodscd != "" ) {
		$goods_vr = ord(substr($goodscd, -1)) - ord('A');
		
		$cn = explode(',', $arr_colornm[$goods_vr]);
		$sel_name = "";
		$sel_name = $cn[0];
		$sel_name .= $cn[1] ? " / ".$cn[1] : "";

		$cnt = count( $arr_colornm );
		if( $cnt > 0 ) {
			echo "<div style=\"padding-left:25px\">\r\n";
			echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"\">\r\n";
			echo "<tr>\r\n";
			for($i = 0,$j = 0; $i < $cnt; $i++) {
				$item_name = explode(',', $arr_colornm[$i]);
				if( isset($item_name[0]) && $item_name[0] != "" ) {
					$name = "";
					$name = $item_name[0];
					$name .= $item_name[1] ? " / ".$item_name[1] : "";
					
					$item_code = explode(',', $arr_colorcd[$i]);
					
					$border = "border:#cfcfcf 1px solid";
					if($i == $goods_vr)
						$border = "border:#3f3f3f 1px solid";
						
					$m_over = "onmouseover=\"document.getElementById('colour').innerHTML='$name'\"";
					$m_out = "onmouseout=\"document.getElementById('colour').innerHTML='$sel_name'\"";
					$on_click = "onclick=\"location.replace('/shop/goods/goods_view.php?goodsno=$arr_family[$i]');\"";
					$sq = "width:$w;height:$h";
					$sq1 = "width:$w1;height:$h";
					$sq2 = "width:$w2;height:$h";

					$bg1 = "background:#$item_code[0]";
					$bg2 = "background:#$item_code[1]";
					
					if( $j++ > 0 )
						echo "	<td style=\"width:10px;height:$h;\"> </td>\r\n";
						
					echo "	<td style=\"$sq;$border;cursor:pointer;\" $m_over $m_out $on_click>\r\n";
					if( $item_code[1] == "" ) {
						echo "		<div style=\"$sq;$bg1;\"> </div>\r\n";
					}
					else {
						echo "		<div style=\"position:relative;float:left;$sq1;$bg1;\"> </div>\r\n";
						echo "		<div style=\"position:relative;float:left;$sq2;$bg2\"> </div>\r\n";
					}
					echo "	</td>\r\n";
					
					if( $j == 7 ) {
						$j = 0;
						echo "</tr>\r\n<tr>	<td colspan=\"13\" style=\"width:10px;height:5px;\"> </td>\r\n</tr>\r\n<tr>\r\n";
					}
				}
			}
			echo "</tr>\r\n";
			echo "</table>\r\n";
			echo "</div>\r\n";
		}
	}
};
?>