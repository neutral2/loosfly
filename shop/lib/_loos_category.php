<?
global $arr_category_name;
global $arr_collection_name;
global $arr_menu_items;

$arr_category_name = array(
	array("신상품","New Arrivals","goods_grp_01.php"),
	array("레오타드","Leotards","goods_list.php?category=003"),
	array("상의","Tops","goods_list.php?category=001"),
	array("하의","Bottoms","goods_list.php?category=002"),
	array("액세서리","Accessories","goods_list.php?category=010"),
	array("유니타드","Unitards","goods_list.php?category=004")
);

$arr_collection_name = array(
	array("2014 컬렉션","Collection 2014","goods_list.php?category=011"),
	array("루스플라이 인 미디어","in the MEDIA","goods_list.php?category=013"),
	array("여성을 위한 루스플라이","for Women","goods_list.php?category=005"),
	array("우아한 레이스와 망사","Romantic Lace & Mesh","goods_list.php?category=007"),
	array("편안한 바지","Fullness Pants","goods_list.php?category=008"),
	array("타이트한 바지","Tight Pants","goods_list.php?category=009"),
	array("남성을 위한 루스플라이","for Men","goods_list.php?category=006"),
	array("금주의 추천상품","Featured Products","goods_list.php?category=014"),
	array("단종임박 한정판매","Limited Sale","goods_list.php?category=015"),
	array("콜라보레이션","Collaboration","goods_list.php?category=012")
);

$arr_menu_items = array(
	array("홈","Home","/index.html"),									//0000
	array("쇼핑","Shop","/shop.php"),										//0100
	array("콜라보","Collabo","/shop/goods/goods_list.php?category=012"),	//0200
	array("스토리","Stories","/shop/board/list.php?id=stories"),			//0300
	array("블로그","Blog","/shop/board/list.php?id=blog"),		 		//0400	 Obsoleted
	array("판매점","Partners","/shop/partners/partners.php"),				//0500
	array("마이페이지","Account","/shop/mypage/accinfo.php"),				//0600
	array("장바구니","Cart","/shop/goods/goods_cart.php"),					//0700
	array("고객센터","Service","/shop/service/customer.php"),				//0800
	array("로그인","Login","/shop/member/login.php"),						//0900
	array("회원가입","Join Us","/shop/member/join.php"),					//1000
	array("로그아웃","Logout","/shop/member/logout.php"),					//1100
);
?>