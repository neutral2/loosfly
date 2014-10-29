<?
$design_skin = array();

$design_skin['default'] = array(
'outline_header'			=> 'outline/_header.htm ',
'outline_footer'			=> 'outline/_footer.htm',
);

$design_skin['outline/_header.htm'] = array(
'linkurl'			=> 'main/index.php',
'text'			=> '상단레이아웃',
);

$design_skin['outline/_footer.htm'] = array(
'linkurl'			=> 'outline/_footer.php',
'outline_header'			=> 'outline/_header.htm ',
'outline_footer'			=> 'outline/_footer.htm',
'text'			=> '하단레이아웃',
'_et'			=> 'codemirror',
);

$design_skin['outline/_sub_header.htm'] = array(
'linkurl'			=> 'main/index.php',
'text'			=> '서브 상단 디자인',
);

$design_skin['index.htm'] = array(
'linkurl'			=> 'index.php',
'outline_header'			=> 'outline/_header.htm ',
'outline_footer'			=> 'outline/_footer.htm',
'text'			=> '모바일 메인페이지',
);

$design_skin['goods/list.htm'] = array(
'linkurl'			=> 'goods/list.php',
'text'			=> '분류화면',
);

$design_skin['goods/view.htm'] = array(
'linkurl'			=> 'goods/view.php',
'outline_header'			=> 'outline/_header.htm ',
'outline_footer'			=> 'outline/_footer.htm',
'text'			=> '상품상세화면',
);

$design_skin['goods/cart.htm'] = array(
'linkurl'			=> 'goods/cart.php',
'outline_header'			=> 'outline/_header.htm ',
'outline_footer'			=> 'outline/_footer.htm',
'text'			=> '장바구니',
);

$design_skin['goods/category.htm'] = array(
'text'			=> '카테고리',
'linkurl'			=> 'goods/category.php',
);

$design_skin['ord/order.htm'] = array(
'linkurl'			=> 'ord/order.php',
'outline_header'			=> 'outline/_header.htm ',
'outline_footer'			=> 'outline/_footer.htm',
'text'			=> '주문하기(주문서작성)',
);

$design_skin['ord/order_end.htm'] = array(
'text'			=> '주문완료',
'linkurl'			=> 'ord/order_end.php',
);

$design_skin['ord/order_fail.htm'] = array(
'text'			=> '주문실패',
'linkurl'			=> 'ord/order_fail.php',
);

$design_skin['ord/settle.htm'] = array(
'linkurl'			=> 'ord/settle.php',
'outline_header'			=> 'outline/_header.htm ',
'outline_footer'			=> 'outline/_footer.htm',
'text'			=> '결제하기(무통장)',
);

$design_skin['mem/login.htm'] = array(
'text'			=> '로그인',
'linkurl'			=> 'mem/login.php',
);

$design_skin['myp/couponlist.htm'] = array(
'text'			=> '할인쿠폰내역',
'linkurl'			=> 'myp/couponlist.php',
);

$design_skin['myp/emoneylist.htm'] = array(
'linkurl'			=> 'myp/emoneylist.php',
'outline_header'			=> 'outline/_header.htm ',
'outline_footer'			=> 'outline/_footer.htm',
'text'			=> '적립금내역',
);

$design_skin['myp/index.htm'] = array(
'text'			=> '마이페이지',
'linkurl'			=> 'myp/index.php',
);

$design_skin['myp/orderlist.htm'] = array(
'text'			=> '주문내역/배송조회',
'linkurl'			=> 'myp/orderlist.php',
);

$design_skin['myp/orderview.htm'] = array(
'text'			=> '주문내역상세보기',
'linkurl'			=> 'myp/orderview.php',
);

$design_skin['myp/wishlist.htm'] = array(
'text'			=> '상품보관함',
'linkurl'			=> 'myp/wishlist.php',
);

$design_skin['proc/_cashreceiptOrder.htm'] = array(
'text'			=> '주문하기_현금영수증발급',
'linkurl'			=> 'proc/_cashreceiptOrder.php',
);

$design_skin['proc/coupon_list.htm'] = array(
'text'			=> '할인쿠폰적용하기',
'linkurl'			=> 'proc/coupon_list.php',
);

$design_skin['proc/orderitem.htm'] = array(
'linkurl'			=> 'proc/orderitem.php',
'text'			=> '주문상품',
);

$design_skin['goods/list/tpl_02.htm'] = array(
'linkurl'			=> 'goods/goods_list.php',
'text'			=> '리스트형',
);

$design_skin['myp/review_register.htm'] = array(
'linkurl'			=> 'main/html.php?htmid=myp/review_register.htm',
'outline_header'			=> 'outline/_header.htm ',
'outline_footer'			=> 'outline/_footer.htm',
'text'			=> '이용후기 작성',
);

$design_skin['mem/NewNiceIpin.htm'] = array(
'linkurl'			=> 'mem/NewNiceIpin.php',
'text'			=> '아이핀 인증',
);

$design_skin['mem/NiceIpin.htm'] = array(
'linkurl'			=> 'main/html.php?htmid=mem/NiceIpin.htm',
'outline_header'			=> 'outline/_header.htm ',
'outline_footer'			=> 'outline/_footer.htm',
'text'			=> '아이핀 인증',
);

$design_skin['intro/intro.htm'] = array(
'text'			=> '일반 인트로',
'linkurl'			=> 'main/html.php?htmid=intro/intro.htm',
);

$design_skin['intro/intro_adult.htm'] = array(
'text'			=> '성인인증 인트로',
'linkurl'			=> 'main/html.php?htmid=intro/intro_adult.htm',
);

$design_skin['intro/intro_member.htm'] = array(
'text'			=> '회원인증 인트로',
'linkurl'			=> 'main/html.php?htmid=intro/intro_member.htm',
);

$design_skin['service/_private1.txt'] = array(
'text'			=> '개인정보취급방침 내용',
'linkurl'			=> 'main/html.php?htmid=service/_private1.txt',
);

$design_skin['service/private.htm'] = array(
'text'			=> '개인정보취급방침',
'linkurl'			=> 'main/html.php?htmid=service/private.htm',
);

?>