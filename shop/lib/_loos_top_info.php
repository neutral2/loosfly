<?
include_once "_loos_category.php";

global $arr_pfile2info;
$arr_pfile2info = array(
			"/"=>array("0000","/",""),
			"index.php"=>array("0100","/shop.php",""),
			"goods_list.php"=>array("0110","/shop/goods/goods_list.php",""),
			"goods_view.php"=>array("0111","/shop/goods/goods_view.php",""),
			"goods_search.php"=>array("0120","/shop/goods/goods_search.php",""),
			"goods_grp_01.php"=>array("0130","/shop/goods/goods_grp_01.php","New Arrivals"),
			"goods_grp_02.php"=>array("0131","/shop/goods/goods_grp_02.php","Price-off Items"),
			"goods_grp_03.php"=>array("0132","/shop/goods/goods_grp_03.php","Best Seller"),
			"goods_grp_04.php"=>array("0133","/shop/goods/goods_grp_04.php","MD's Choice"),
			"goods_grp_05.php"=>array("0134","/shop/goods/goods_grp_05.php","New Arrivals"),
			"goods_grp_06.php"=>array("0135","/shop/goods/goods_grp_06.php","MD's Choice"),
			"order.php"=>array("0140","https://www.loosfly.com:14020/shop/order/order.php","order"),
/* psudo */	"collabo_list.php"=>array("0210","/shop/goods/goods_list.php",""),
/* psudo */	"collabo_view.php"=>array("0211","/shop/goods/goods_view.php",""),
/* psudo */	"stories_list.php"=>array("0300","/shop/board/list.php",""),
/* psudo */	"stories_view.php"=>array("0301","/shop/board/view.php",""),
/* psudo */	"stories_write.php"=>array("0302","/shop/board/write.php",""),
/* psudo */	"stories_edit.php"=>array("0303","/shop/board/write.php",""),
/* psudo */	"stories_delete.php"=>array("0304","/shop/board/delete.php",""),
/*  N/A  */	"blog_list.php"=>array("0400","/shop/board/list.php","Blog",""),
			"partners.php"=>array("0500","/shop/partners/partners.php",""),
			"accinfo.php"=>array("0600","/shop/mypage/accinfo.php",""),
			"myinfo.php"=>array("0610","https://www.loosfly.com:14020/shop/member/myinfo.php","Account Settings"),
			"mypage_orderlist.php"=>array("0612","/shop/mypage/mypage_orderlist.php","Order List"),
			"mypage_wishlist.php"=>array("0613","/shop/mypage/mypage_wishlist.php","Wish List"),
			"mypage_today.php"=>array("0614","/shop/mypage/mypage_today.php","Recent Views"),
			"mypage_coupon.php"=>array("0615","/shop/mypage/mypage_coupon.php","Coupons"),
			"mypage_qna_goods.php"=>array("0616","/shop/mypage/mypage_qna_goods.php","Enquiries About Goods"),
			"mypage_qna.php"=>array("0617","/shop/mypage/mypage_qna.php","General Enqiries"),
			"mypage_review.php"=>array("0618","/shop/mypage/mypage_review.php","My Reviews"),
			"goods_cart.php"=>array("0700","/shop/goods/goods_cart.php",""),
			"customer.php"=>array("0800","/shop/service/customer.php",""),
/* psudo */	"notice_list.php"=>array("0810","/shop/board/list.php","Notice"),
/* psudo */	"notice_view.php"=>array("0811","/shop/board/view.php","Notice"),
/* psudo */	"notice_write.php"=>array("0812","/shop/board/write.php","Notice"),
/* psudo */	"notice_edit.php"=>array("0813","/shop/board/write.php","Notice"),
/* psudo */	"notice_delete.php"=>array("0814","/shop/board/delete.php","Notice"),
/* psudo */	"event_list.php"=>array("0820","/shop/board/list.php","Event"),
/* psudo */	"event_view.php"=>array("0821","/shop/board/view.php","Event"),
/* psudo */	"event_write.php"=>array("0822","/shop/board/write.php","Event"),
/* psudo */	"event_edit.php"=>array("0823","/shop/board/write.php","Event"),
/* psudo */	"event_delete.php"=>array("0824","/shop/board/delete.php","Event"),
			"non-member.php"=>array("0830","/shop/service/non-member.php","Non-member Orders"),
			"find_id.php"=>array("0831","https://www.loosfly.com:14020/shop/member/find_id.php","Find My ID"),
			"find_pwd.php"=>array("0832","https://www.loosfly.com:14020/shop/member/find_pwd.php","Find My Password"),
/* psudo */	"sizing_guide_women.php"=>array("0840","/shop/service/sizing_guide.php","Sizing Guide for Women"),
/* psudo */	"sizing_guide_men.php"=>array("0841","/shop/service/sizing_guide.php","Sizing Guide for Men"),
			"guide.php"=>array("0842","/shop/service/guide.php","User's Guide"),
			"company.php"=>array("0850","/shop/service/company.php","About loosfly"),
/* psudo */	"path_finder.php"=>array("0851","/shop/service/company.php","How to get to our Showroom"),
/*  N/A  */	"faq.php"=>array("0860","/shop/service/faq.php","FAQ"),
			"agreement.php"=>array("0870","/shop/service/agreement.php","Agreement"),
			"private.php"=>array("0871","/shop/service/private.php","Privacy Policy"),
/*  N/A  */	"repair.php"=>array("0880","/shop/service/repair.php","Repair Service"),
/*  N/A  */	"returns.php"=>array("0881","/shop/service/returns.php","Returns"),
/*  N/A  */	"shipping.php"=>array("0882","/shop/service/shipping.php","Shipping"),
/*  N/A  */	"order_payment.php"=>array("0883","/shop/service/order_payment.php","Order and Payment"),
			"login.php"=>array("0900","https://www.loosfly.com:14020/shop/member/login.php",""),
			"logout.php"=>array("1100","/shop/member/logout.php",""),
			"join.php"=>array("1000","/shop/member/join.php",""),
);

function make_menu_item($idx, $class_name, $cart_count = 0) {
	global $arr_menu_items;
	
	$cart_info = $style = $menu_item = "";
	if( $cart_count > 0 ) $cart_info = "(".$cart_count.")";
	if( $idx == 10 ) {
		$menu_item = "<a href=\"".$arr_menu_items[$idx][2]."\"><div class=\"$class_name\" style=\"color:#f47d30\" onMouseOver=\"overM_1('".$arr_menu_items[$idx][0]."$cart_info', this);\" onMouseOut=\"outM_1('".$arr_menu_items[$idx][1]."$cart_info', this);\">".$arr_menu_items[$idx][1]."$cart_info</div></a>";
	}
	else { 
		$menu_item = "<a href=\"".$arr_menu_items[$idx][2]."\"><div class=\"$class_name\" onMouseOver=\"overM('".$arr_menu_items[$idx][0]."$cart_info', this);\" onMouseOut=\"outM('".$arr_menu_items[$idx][1]."$cart_info', this);\">".$arr_menu_items[$idx][1]."$cart_info</div></a>";
	}
	
	return $menu_item;
}

function get_indicator($pfile, $args) {
	return (int)((int)get_menu_index($pfile, $args)/100);
}

function get_menu_index($pfile, $args) {
	global $arr_pfile2info;
	
	$category = $id = $no = $tt = $size_type = "";
	$tfile = $pfile;
	parse_str($args);
	if( $tfile == "goods_list.php" ) {
		if( substr($category, 0, 3) == "012" )
			$tfile = "collabo_list.php";
	}
	else if( $tfile == "goods_view.php" ) { 
		if( substr($category, 0, 3) == "012" )
			$tfile = "collabo_view.php";
	}
	else if( $id != "" ) {
		if( $no != "" && $tfile == "write.php" )
			$tfile = $id."_edit.php";
		else
			$tfile = $id."_".$tfile;
	}
	else if( $tfile == "sizing_guide.php" ) { 
		if( $size_type == "men" )
			$tfile = "sizing_guide_men.php";
		else
			$tfile = "sizing_guide_women.php";
	}
	else if( $tt != "" && $tfile == "company.php" ) { 
		$tfile = "path_finder.php";
	}
	
	return $arr_pfile2info[$tfile][0];
}

function _get_path($pfile, $args, $curpos, $goodsnm) {
	global $arr_pfile2info;
	global $arr_menu_items;
	global $arr_category_name;
	global $arr_collection_name;

	$category = $id = $no = $tt = $size_type = "";
	$tfile = $pfile;
	parse_str($args);
	if( $tfile == "goods_list.php" ) {
		if( substr($category, 0, 3) == "012" )
			$tfile = "collabo_list.php";
	}
	else if( $tfile == "goods_view.php" ) { 
		if( substr($category, 0, 3) == "012" )
			$tfile = "collabo_view.php";
	}
	else if( $id != "" ) {
		if( $no != "" && $tfile == "write.php" )
			$tfile = $id."_edit.php";
		else
			$tfile = $id."_".$tfile;
	}
	else if( $tfile == "sizing_guide.php" ) { 
		if( $size_type == "men" )
			$tfile = "sizing_guide_men.php";
		else
			$tfile = "sizing_guide_women.php";
	}
	else if( $tt != "" && $tfile == "company.php" ) { 
		$tfile = "path_finder.php";
	}
	
	$path = "<a href=\"/\">home</a>";
	
	$ind = get_indicator($pfile, $args);
	if(  $ind == 1 || $ind == 2 ) {
		$path .= " > <a href=\"/shop/main/index.php\">Shop</a>";
		if( $curpos != "" ) {
			$cnt = count($arr_category_name);
			for( $i = 0; $i < $cnt; $i++ ) {
				if( strstr($curpos, $arr_category_name[$i][0]) )
					$curpos = str_replace($arr_category_name[$i][0], $arr_category_name[$i][1], $curpos);
			}
			$cnt = count($arr_collection_name);
			for( $i = 0; $i < $cnt; $i++ ) {
				if( strstr($curpos, $arr_collection_name[$i][0]) )
					$curpos = str_replace($arr_collection_name[$i][0], $arr_collection_name[$i][1], $curpos);
			}
	
			$path .= " > $curpos";
		}
		
		if( $goodsnm != "" ) {
			$path .= " > <a href=\"/shop/goods/goods_view.php?$args\">$goodsnm</a>";
		}
	}
	else{
		$path .= " > <a href=\"".$arr_menu_items[$ind][2]."\">".$arr_menu_items[$ind][1]."</a>";
		if( $arr_pfile2info[$tfile][2] != "" ) {
			$path .= " > <a href=\"".$arr_pfile2info[$tfile][1]."\">".$arr_pfile2info[$tfile][2]."</a>";
		}
	}
	
	return $path;
}

?>