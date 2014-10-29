<?
$design_skin = array();

$design_skin['default'] = array(
'outline_header'			=> 'outline/header/standard.htm',
'outline_side'			=> 'outline/side/standard.htm',
'outline_footer'			=> 'outline/footer/standard.htm',
'outline_sidefloat'			=> 'left',
'outbg_color'			=> '3f3f3f',
);

$design_skin['popup/layer.htm'] = array(
'text'			=> '레이어팝업',
'popup_use'			=> 'N',
'popup_spotw'			=> '100',
'popup_spoth'			=> '100',
'popup_sizew'			=> '325',
'popup_sizeh'			=> '445',
'popup_type'			=> 'layer',
'linkurl'			=> 'main/html.php?htmid=popup/layer.htm',
);

$design_skin['popup/move.htm'] = array(
'text'			=> '이동레이어',
'popup_use'			=> 'N',
'popup_spotw'			=> '130',
'popup_spoth'			=> '130',
'popup_sizew'			=> '325',
'popup_sizeh'			=> '445',
'popup_type'			=> 'layerMove',
'linkurl'			=> 'main/html.php?htmid=popup/move.htm',
);

$design_skin['popup/standard.htm'] = array(
'text'			=> '기본팝업',
'popup_use'			=> 'N',
'popup_spotw'			=> '0',
'popup_spoth'			=> '0',
'popup_sizew'			=> '300',
'popup_sizeh'			=> '400',
'linkurl'			=> 'main/html.php?htmid=popup/standard.htm',
);

$design_skin['main/intro.htm'] = array(
'text'			=> '인트로',
'linkurl'			=> 'intro.php',
);

$design_skin['outline/_header.htm'] = array(
'linkurl'			=> 'main/index.php',
'text'			=> '상단레이아웃',
'_et'			=> 'codemirror',
);

$design_skin['outline/_footer.htm'] = array(
'linkurl'			=> 'main/index.php',
'text'			=> '하단레이아웃',
'_et'			=> 'codemirror',
);

$design_skin['outline/header/main.htm'] = array(
'linkurl'			=> 'outline/header/main.php',
'text'			=> '샵 메인용 상단파일',
'inbg_img'			=> 'outline.header.main_inbg.gif',
'_et'			=> 'codemirror',
);

$design_skin['outline/header/standard.htm'] = array(
'linkurl'			=> 'main/index.php',
'text'			=> '상단 기본파일',
'inbg_img'			=> 'outline.header.standard_inbg.gif',
'_et'			=> 'codemirror',
);

$design_skin['outline/footer/main_footer.htm'] = array(
'linkurl'			=> 'main/index.php',
'text'			=> '샵 메인용 하단파일',
);

$design_skin['outline/footer/standard.htm'] = array(
'linkurl'			=> 'main/index.php',
'text'			=> '하단 기본타입',
'_et'			=> 'codemirror',
);

$design_skin['outline/side/cs.htm'] = array(
'linkurl'			=> 'main/index.php',
'text'			=> '고객센터용 왼쪽메뉴',
);

$design_skin['outline/side/goodsleft.htm'] = array(
'linkurl'			=> 'goods/goods_list.php',
'text'			=> '쇼핑관련 왼쪽메뉴',
'_et'			=> 'codemirror',
);

$design_skin['outline/side/mainleft.htm'] = array(
'linkurl'			=> 'goods/goods_list.php',
'text'			=> '샵 메인용 왼쪽메뉴',
'_et'			=> 'codemirror',
);

$design_skin['outline/side/mypage.htm'] = array(
'linkurl'			=> 'mypage/accinfo.php',
'text'			=> '마이페이지용 왼쪽메뉴',
);

$design_skin['outline/side/standard.htm'] = array(
'linkurl'			=> 'main/index.php',
'text'			=> '기본 왼쪽메뉴',
);

$design_skin['main/index.htm'] = array(
'linkurl'			=> 'index.php',
'outline_side'			=> 'outline/side/mainleft.htm',
'text'			=> '쇼핑몰 메인본문',
'_et'			=> 'codemirror',
);

$design_skin['goods/list/tpl_01.htm'] = array(
'linkurl'			=> 'goods/goods_list.php',
'text'			=> '갤러리형',
'_et'			=> 'codemirror',
);

$design_skin['goods/list/tpl_02.htm'] = array(
'linkurl'			=> 'goods/goods_list.php',
'text'			=> '리스트형',
);

$design_skin['goods/list/tpl_03.htm'] = array(
'text'			=> '리스트 그룹형',
'outline_side'			=> 'outline/side/mainleft.htm',
'linkurl'			=> 'goods/goods_list.php',
);

$design_skin['goods/list/tpl_04.htm'] = array(
'linkurl'			=> 'goods/goods_list.php',
'text'			=> '상품 이동형',
);

$design_skin['goods/list/tpl_05.htm'] = array(
'linkurl'			=> 'goods/goods_list.php',
'text'			=> '상품 세로이동형',
);

$design_skin['goods/list/tpl_06.htm'] = array(
'linkurl'			=> 'goods/goods_list.php',
'text'			=> '가로 스크롤바형',
);

$design_skin['goods/list/tpl_07.htm'] = array(
'linkurl'			=> 'goods/goods_list.php',
'text'			=> '탭형',
);

$design_skin['goods/list/tpl_08.htm'] = array(
'linkurl'			=> 'goods/goods_list.php',
'text'			=> '선택강조형',
);

$design_skin['goods/list/tpl_09.htm'] = array(
'linkurl'			=> 'goods/goods_list.php',
'text'			=> '이미지 갤러리형',
);

$design_skin['goods/list/tpl_10.htm'] = array(
'linkurl'			=> 'goods/goods_list.php',
'text'			=> '말풍선형',
);

$design_skin['goods/list/tpl_11.htm'] = array(
'linkurl'			=> 'goods/goods_list.php',
'text'			=> '장바구니형',
);

$design_skin['goods/goods_cart.htm'] = array(
'linkurl'			=> 'goods/goods_cart.php',
'outline_side'			=> 'noprint',
'text'			=> '장바구니',
);

$design_skin['goods/goods_event.htm'] = array(
'text'			=> '이벤트',
'linkurl'			=> 'goods/goods_event.php',
'outline_side'			=> 'noprint',
);

$design_skin['goods/goods_grp_01.htm'] = array(
'linkurl'			=> 'goods/goods_grp_01.php',
'outline_side'			=> 'outline/side/mainleft.htm',
'text'			=> '메인상품그룹(레오타드)',
);

$design_skin['goods/goods_grp_02.htm'] = array(
'linkurl'			=> 'goods/goods_grp_02.php',
'outline_side'			=> 'outline/side/mainleft.htm',
'text'			=> '메인상품그룹(상의)',
);

$design_skin['goods/goods_grp_03.htm'] = array(
'linkurl'			=> 'goods/goods_grp_03.php',
'outline_side'			=> 'outline/side/mainleft.htm',
'text'			=> '메인상품그룹(하의)',
);

$design_skin['goods/goods_grp_04.htm'] = array(
'linkurl'			=> 'goods/goods_grp_04.php',
'outline_side'			=> 'outline/side/mainleft.htm',
'text'			=> '메인상품그룹(유니타드)',
);

$design_skin['goods/goods_grp_05.htm'] = array(
'linkurl'			=> 'goods/goods_grp_05.php',
'outline_side'			=> 'outline/side/mainleft.htm',
'text'			=> '메인상품그룹(신상품)',
);

$design_skin['goods/goods_grp_06.htm'] = array(
'linkurl'			=> 'goods/goods_grp_06.php',
'outline_side'			=> 'outline/side/mainleft.htm',
'text'			=> '메인상품그룹(추천상품)',
);

$design_skin['goods/goods_list.htm'] = array(
'linkurl'			=> 'goods/goods_list.php',
'outline_side'			=> 'outline/side/mainleft.htm',
'text'			=> '_____분류화면_____',
'_et'			=> 'codemirror',
);

$design_skin['goods/goods_popup_large.htm'] = array(
'linkurl'			=> 'goods/goods_popup_large.php',
'text'			=> '상품확대보기',
'_et'			=> 'textarea',
);

$design_skin['goods/goods_qna.htm'] = array(
'linkurl'			=> 'goods/goods_qna.php',
'text'			=> '상품문의 메인',
'_et'			=> 'codemirror',
);

$design_skin['goods/goods_qna_view.htm'] = array(
'linkurl'			=> 'goods/goods_qna_view.php',
'text'			=> '상품문의 상세',
'_et'			=> 'codemirror',
);

$design_skin['goods/goods_qna_del.htm'] = array(
'text'			=> '상품문의 삭제',
'linkurl'			=> 'goods/goods_qna_del.php',
'outline_header'			=> 'noprint',
'outline_side'			=> 'noprint',
'outline_footer'			=> 'noprint',
);

$design_skin['goods/goods_qna_list.htm'] = array(
'linkurl'			=> 'goods/goods_view.php',
'text'			=> '상품문의 목록',
'_et'			=> 'codemirror',
);

$design_skin['goods/goods_qna_register.htm'] = array(
'linkurl'			=> 'goods/goods_qna_register.php',
'text'			=> '상품문의 작성',
);

$design_skin['goods/goods_review.htm'] = array(
'linkurl'			=> 'goods/goods_review.php',
'text'			=> '이용후기 메인',
'_et'			=> 'codemirror',
);

$design_skin['goods/goods_review_del.htm'] = array(
'text'			=> '이용후기 삭제',
'linkurl'			=> 'goods/goods_review_del.php',
'outline_header'			=> 'noprint',
'outline_side'			=> 'noprint',
'outline_footer'			=> 'noprint',
);

$design_skin['goods/goods_review_list.htm'] = array(
'linkurl'			=> 'goods/goods_view.php',
'text'			=> '이용후기 목록',
'_et'			=> 'codemirror',
);

$design_skin['goods/goods_review_register.htm'] = array(
'linkurl'			=> 'goods/goods_review_register.php',
'text'			=> '이용후기 작성',
);

$design_skin['goods/goods_search.htm'] = array(
'linkurl'			=> 'goods/goods_search.php',
'outline_side'			=> 'outline/side/mainleft.htm',
'text'			=> '상세검색화면',
);

$design_skin['goods/goods_view.htm'] = array(
'linkurl'			=> 'goods/goods_view.php',
'outline_side'			=> 'outline/side/goodsleft.htm',
'text'			=> '상품상세화면',
'_et'			=> 'codemirror',
);

$design_skin['order/order.htm'] = array(
'linkurl'			=> 'order/order.php',
'text'			=> '주문하기(주문서작성)',
'_et'			=> 'codemirror',
);

$design_skin['order/order_end.htm'] = array(
'linkurl'			=> 'order/order_end.php',
'text'			=> '주문완료',
);

$design_skin['order/settle.htm'] = array(
'linkurl'			=> 'order/settle.php',
'text'			=> '결제하기(카드/무통장)',
);

$design_skin['member/_form.htm'] = array(
'linkurl'			=> 'member/join.php',
'text'			=> '회원가입/수정 폼',
);

$design_skin['member/agreement.htm'] = array(
'linkurl'			=> 'member/join.php',
'text'			=> '회원가입 이용약관',
);

$design_skin['member/confirm_password.htm'] = array(
'linkurl'			=> 'member/join.php',
'text'			=> '비밀번호 재확인',
);

$design_skin['member/find_id.htm'] = array(
'linkurl'			=> 'member/find_id.php',
'outline_side'			=> 'outline/side/cs.htm',
'text'			=> '아이디 찾기',
);

$design_skin['member/find_pwd.htm'] = array(
'linkurl'			=> 'member/find_pwd.php',
'outline_side'			=> 'outline/side/cs.htm',
'text'			=> '비밀번호 찾기',
);

$design_skin['member/find_pwd_choice.htm'] = array(
'linkurl'			=> 'member/find_pwd.php',
'text'			=> '비밀번호 찾기 인증수단 선택',
);

$design_skin['member/hack.htm'] = array(
'linkurl'			=> 'member/hack.php',
'outline_side'			=> 'outline/side/mypage.htm',
'text'			=> '회원탈퇴',
);

$design_skin['member/join.htm'] = array(
'linkurl'			=> 'member/join.php',
'outline_side'			=> 'outline/side/cs.htm',
'text'			=> '회원가입',
);

$design_skin['member/join_ok.htm'] = array(
'text'			=> '회원가입 완료',
'linkurl'			=> 'member/join_ok.php',
);

$design_skin['member/login.htm'] = array(
'linkurl'			=> 'member/login.php',
'outline_side'			=> 'noprint',
'text'			=> '로그인',
);

$design_skin['member/myinfo.htm'] = array(
'linkurl'			=> 'member/myinfo.php',
'outline_side'			=> 'outline/side/mypage.htm',
'text'			=> '회원정보수정',
);

$design_skin['mypage/_myBox.htm'] = array(
'linkurl'			=> 'mypage/_myBox.php',
);

$design_skin['mypage/accinfo.htm'] = array(
'linkurl'			=> 'mypage/accinfo.php',
'outline_side'			=> 'outline/side/mypage.htm',
'text'			=> '회원정보',
);

$design_skin['mypage/orderlist.htm'] = array(
'outline_side'			=> 'outline/side/mypage.htm',
);

$design_skin['mypage/mypage_coupon.htm'] = array(
'linkurl'			=> 'mypage/mypage_coupon.php',
'outline_side'			=> 'outline/side/mypage.htm',
'text'			=> '할인쿠폰내역',
);

$design_skin['mypage/mypage_emoney.htm'] = array(
'linkurl'			=> 'mypage/mypage_emoney.php',
'outline_side'			=> 'outline/side/mypage.htm',
'text'			=> '적립금내역',
);

$design_skin['mypage/mypage_orderlist.htm'] = array(
'linkurl'			=> 'mypage/mypage_orderlist.php',
'outline_side'			=> 'outline/side/mypage.htm',
'text'			=> '주문내역/배송조회',
);

$design_skin['mypage/mypage_orderview.htm'] = array(
'linkurl'			=> 'mypage/mypage_orderview.php',
'outline_side'			=> 'outline/side/mypage.htm',
'text'			=> '주문내역상세페이지',
'_et'			=> 'codemirror',
);

$design_skin['mypage/mypage_qna.htm'] = array(
'linkurl'			=> 'mypage/mypage_qna.php',
'outline_side'			=> 'outline/side/mypage.htm',
'text'			=> '1:1문의',
);

$design_skin['mypage/mypage_qna_del.htm'] = array(
'text'			=> '1:1문의 삭제',
'linkurl'			=> 'mypage/mypage_qna_del.php',
'outline_side'			=> 'outline/side/mypage.htm',
);

$design_skin['mypage/mypage_qna_goods.htm'] = array(
'linkurl'			=> 'mypage/mypage_qna_goods.php',
'outline_side'			=> 'outline/side/mypage.htm',
'text'			=> '나의 상품문의',
);

$design_skin['mypage/mypage_qna_order.htm'] = array(
'text'			=> '1:1문의 주문번호검색창',
'linkurl'			=> 'mypage/mypage_qna_order.php',
'outline_side'			=> 'outline/side/mypage.htm',
);

$design_skin['mypage/mypage_qna_register.htm'] = array(
'linkurl'			=> 'mypage/mypage_qna_register.php',
'text'			=> '1:1문의 등록',
);

$design_skin['mypage/mypage_review.htm'] = array(
'linkurl'			=> 'mypage/mypage_review.php',
'outline_side'			=> 'outline/side/mypage.htm',
'text'			=> '나의 상품후기',
'_et'			=> 'codemirror',
);

$design_skin['mypage/mypage_today.htm'] = array(
'linkurl'			=> 'mypage/mypage_today.php',
'outline_side'			=> 'outline/side/mypage.htm',
'text'			=> '최근본상품목록',
);

$design_skin['mypage/mypage_wishlist.htm'] = array(
'linkurl'			=> 'mypage/mypage_wishlist.php',
'outline_side'			=> 'outline/side/mypage.htm',
'text'			=> '상품보관함',
);

$design_skin['mypage/settle.htm'] = array(
'linkurl'			=> 'order/settle.php',
'text'			=> '재결제하기(카드/무통장)',
);

$design_skin['board/default/list.htm'] = array(
'linkurl'			=> 'board/list.php',
'outline_side'			=> 'outline/side/cs.htm',
'text'			=> '목록',
);

$design_skin['board/webzine/list.htm'] = array(
'linkurl'			=> 'board/list.php',
'text'			=> '목록',
);

$design_skin['board/webzine/write.htm'] = array(
'linkurl'			=> 'board/write.php',
'text'			=> '작성',
);

$design_skin['board/gallery/list.htm'] = array(
'linkurl'			=> 'board/list.php',
'text'			=> '목록',
'_et'			=> 'codemirror',
);

$design_skin['board/test/list.htm'] = array(
'text'			=> '목록',
'linkurl'			=> 'board/test/list.php',
);

$design_skin['service/_private.htm'] = array(
'text'			=> '개인정보취급방침 (회원가입내 프레임)',
'outline_side'			=> 'outline/side/cs.htm',
'linkurl'			=> 'service/_private.php',
);

$design_skin['service/_private.txt'] = array(
'linkurl'			=> 'service/private.php',
'outline_side'			=> 'outline/side/cs.htm',
'text'			=> '개인정보취급방침 내용',
);

$design_skin['service/agreement.htm'] = array(
'linkurl'			=> 'service/agreement.php',
'outline_side'			=> 'outline/side/cs.htm',
'text'			=> '이용약관',
);

$design_skin['service/company.htm'] = array(
'linkurl'			=> 'service/company.php',
'outline_side'			=> 'outline/side/cs.htm',
'text'			=> '회사소개',
'_et'			=> 'codemirror',
);

$design_skin['service/cooperation.htm'] = array(
'linkurl'			=> 'service/cooperation.php',
'text'			=> '광고제휴문의',
);

$design_skin['service/customer.htm'] = array(
'linkurl'			=> 'service/customer.php',
'outline_side'			=> 'outline/side/cs.htm',
'text'			=> '고객센터',
);

$design_skin['service/faq.htm'] = array(
'linkurl'			=> 'service/faq.php',
'outline_side'			=> 'outline/side/cs.htm',
'text'			=> 'FAQ',
);

$design_skin['service/guide.htm'] = array(
'linkurl'			=> 'service/guide.php',
'outline_side'			=> 'outline/side/cs.htm',
'text'			=> '이용안내',
'_et'			=> 'codemirror',
);

$design_skin['service/non-member.htm'] = array(
'linkurl'			=> 'service/non-member.php',
'outline_side'			=> 'outline/side/cs.htm',
'text'			=> '비회원 주문조회',
);

$design_skin['service/private.htm'] = array(
'linkurl'			=> 'service/private.php',
'outline_side'			=> 'outline/side/cs.htm',
'text'			=> '개인정보취급방침',
);

$design_skin['service/sitemap.htm'] = array(
'text'			=> '사이트맵',
'linkurl'			=> 'service/sitemap.php',
);

$design_skin['proc/ccsms.htm'] = array(
'linkurl'			=> 'proc/ccsms.php',
'text'			=> '관리자에게 SMS상담문의하기',
);

$design_skin['proc/menuCategory.htm'] = array(
'linkurl'			=> 'proc/menuCategory.php',
'text'			=> '카테고리메뉴',
);

$design_skin['proc/orderitem.htm'] = array(
'linkurl'			=> 'goods/goods_cart.php',
'text'			=> '장바구니 상품목록',
);

$design_skin['proc/popup_coupon.htm'] = array(
'text'			=> '할인쿠폰적용하기',
'linkurl'			=> 'proc/popup_coupon.php',
);

$design_skin['proc/popup_email.htm'] = array(
'linkurl'			=> 'proc/popup_email.php',
'text'			=> '관리자에게 메일보내기',
);

$design_skin['proc/popup_zipcode.htm'] = array(
'text'			=> '우편번호검색',
'linkurl'			=> 'proc/popup_zipcode.php',
);

$design_skin['proc/scroll.js'] = array(
'text'			=> '스크롤배너 스크립트',
'linkurl'			=> 'proc/scroll.js',
);

$design_skin['proc/_agreement.txt'] = array(
'linkurl'			=> 'service/agreement.php',
'text'			=> '이용약관 내용',
);

$design_skin['proc/test_include.htm'] = array(
'text'			=> '테스트_인쿠르트',
'linkurl'			=> 'main/html.php?htmid=proc/test_include.htm',
);

$design_skin['setGoods/content.htm'] = array(
'linkurl'			=> 'setGoods/content.php',
'outline_side'			=> 'noprint',
'text'			=> '코디상세페이지',
);

$design_skin['setGoods/index.htm'] = array(
'linkurl'			=> 'setGoods/index.php',
'outline_side'			=> 'noprint',
'text'			=> '코디진열페이지',
);

$design_skin['stories/stories.htm'] = array(
'linkurl'			=> 'stories/stories.php',
'text'			=> '루스플라이 스토리 메인',
);

$design_skin['partners/partners.htm'] = array(
'linkurl'			=> 'main/html.php?htmid=partners/partners.htm',
'text'			=> '루스플라이 파트너 소개',
'_et'			=> 'codemirror',
);

$design_skin['service/sizing_guide.htm'] = array(
'linkurl'			=> 'service/sizing_guide.php',
'outline_side'			=> 'outline/side/cs.htm',
'text'			=> '사이징 가이드',
);

$design_skin['board/photo/list.htm'] = array(
'linkurl'			=> 'board/list.php',
'outline_side'			=> 'outline/side/cs.htm',
'text'			=> '목록__',
);

$design_skin['board/photo/view.htm'] = array(
'linkurl'			=> 'board/view.php',
'outline_side'			=> 'outline/side/cs.htm',
'text'			=> '상세',
);

$design_skin['goods/popup_cart_add.htm'] = array(
'linkurl'			=> 'goods/popup_cart_add.php',
'text'			=> '장바구니담기 팝업',
);

$design_skin['order/order_fail.htm'] = array(
'linkurl'			=> 'order/order_fail.php',
'text'			=> '주문실패',
);

$design_skin['goods/detail/UA1LT05A.html'] = array(
'linkurl'			=> 'goods/detail/UA1LT05A.phpl',
);

$design_skin['order/card/inipay.htm'] = array(
'linkurl'			=> 'order/card/inipay.php',
);

$design_skin['board/webzine/view.htm'] = array(
'linkurl'			=> 'board/view.php',
'text'			=> '상세',
);

$design_skin['goods/goods_qna_contents.htm'] = array(
'linkurl'			=> 'goods/goods_qna_contents.php',
'text'			=> '상품문의 상세',
'_et'			=> 'codemirror',
);

$design_skin['member/hpauthDream.htm'] = array(
'text'			=> '휴대폰인증',
'linkurl'			=> 'main/html.php?htmid=member/hpauthDream.htm',
);

$design_skin['proc/intro_auth.htm'] = array(
'linkurl'			=> 'main/html.php?htmid=proc/intro_auth.htm',
'text'			=> '인트로 본인확인',
'_et'			=> 'codemirror',
);

$design_skin['proc/member_join_auth.htm'] = array(
'linkurl'			=> 'main/html.php?htmid=proc/member_join_auth.htm',
'text'			=> '회원가입 본인확인',
'_et'			=> 'codemirror',
);

$design_skin['order/card/settlebank.htm'] = array(
'text'			=> 'settlebank',
'linkurl'			=> 'main/html.php?htmid=order/card/settlebank.htm',
);

$design_skin['order/cash_receipt/settlebank.htm'] = array(
'text'			=> 'settlebank',
'linkurl'			=> 'main/html.php?htmid=order/cash_receipt/settlebank.htm',
);

$design_skin['order/nscreen_settle.htm'] = array(
'text'			=> 'n스크린 결제하기(카드/무통장)',
'linkurl'			=> 'main/html.php?htmid=order/nscreen_settle.htm',
);

$design_skin['main/intro_member.htm'] = array(
'linkurl'			=> 'main/intro_member.php',
'_et'			=> 'codemirror',
);

$design_skin['order/card/easypay.htm'] = array(
'linkurl'			=> 'order/card/easypay.php',
'_et'			=> 'codemirror',
);

$design_skin['goods/goods_brand.htm'] = array(
'linkurl'			=> 'goods/goods_brand.php',
'outline_side'			=> 'outline/side/mainleft.htm',
'text'			=> '브랜드화면',
'_et'			=> 'codemirror',
);

$design_skin['goods/popup_goods_qna.htm'] = array(
'linkurl'			=> 'goods/popup_goods_qna.php',
'text'			=> '상품문의 상세',
'_et'			=> 'codemirror',
);

$design_skin['goods/goods_category.css'] = array(
'_et'			=> 'codemirror',
);

$design_skin['board/default/view.htm'] = array(
'linkurl'			=> 'board/view.php',
'outline_side'			=> 'outline/side/cs.htm',
'text'			=> '상세',
'_et'			=> 'codemirror',
);

?>