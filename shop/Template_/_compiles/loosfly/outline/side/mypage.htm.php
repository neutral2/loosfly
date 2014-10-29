<?php /* Template_ 2.2.7 2013/11/20 14:49:46 /www/loosfly_godo_co_kr/shop/data/skin/loosfly/outline/side/mypage.htm 000001907 */ ?>
<!--000030000-->
			<div id="left_title">my<span class="emphasis">p</span>age.</div>
			<div style="height:20px;"></div>
			<div id="left_menu">
				<!-- 쇼핑정보박스 : START -->
				<div id="bxShoppingInfo">
					<div id="shoppinginfo_title"><B><?php echo $GLOBALS["member"]["name"]?></B>님의 쇼핑정보</div>
					<div><?php $this->print_("myBox",$TPL_SCP,1);?></div>
				</div>
				<!-- 쇼핑정보박스 : END -->
				<div style="height:30px;"></div>
				<a href="<?php echo url("member/myinfo.php")?>&"><div style="width:150px"><b>ㆍ&nbsp;&nbsp;회원정보수정</b></div></a>
				<div style="height:5px;"></div>
				<a href="<?php echo url("mypage/mypage_orderlist.php")?>&"><div style="width:150px"><b>ㆍ&nbsp;&nbsp;주문내역/배송조회</b></div></a>
				<div style="height:5px;"></div>
				<a href="<?php echo url("mypage/mypage_wishlist.php")?>&"><div style="width:150px">ㆍ&nbsp;&nbsp;찜 상품 목록</div></a>
				<div style="height:5px;"></div>
				<a href="<?php echo url("mypage/mypage_today.php")?>&"><div style="width:150px">ㆍ&nbsp;&nbsp;최근 본 상품 목록</div></a>
				<div style="height:5px;"></div>
				<a href="<?php echo url("mypage/mypage_coupon.php")?>&"><div style="width:150px">ㆍ&nbsp;&nbsp;나의 쿠폰내역</div></a>
				<div style="height:5px;"></div>
				<a href="<?php echo url("mypage/mypage_qna_goods.php")?>&"><div style="width:150px">ㆍ&nbsp;&nbsp;나의 상품문의</div></a>
				<div style="height:5px;"></div>
				<a href="<?php echo url("mypage/mypage_qna.php")?>&"><div style="width:150px">ㆍ&nbsp;&nbsp;1:1 문의게시판</div></a>
				<div style="height:5px;"></div>
				<a href="<?php echo url("mypage/mypage_review.php")?>&"><div style="width:150px">ㆍ&nbsp;&nbsp;나의 상품후기</div></a>
			</div>
			<div style="height:30px;"></div>