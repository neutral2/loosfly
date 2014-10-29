<?php /* Template_ 2.2.7 2012/11/20 16:29:25 /www/loosfly_godo_co_kr/shop/data/skin/apple_tree/outline/side/mypage.htm 000002831 */  $this->include_("dataBanner");?>
<div style="width:190px; margin-bottom:8px">
	<div><img src="/shop/data/skin/apple_tree/img/common/sid_tit_mypagetop.gif"></div>

	<!-- 쇼핑정보박스 : START -->
	<div style="background-color:#F6FCFC; padding:18px 15px;border:solid 0 #39C1D7; border-width:0 2px;">
		<div class="eng" style="border-bottom:solid 1px #E8E8E8; padding:0 0 4px 3px;"><img src="/shop/data/skin/apple_tree/img/common/sid_icon04.gif" align=absmiddle> <B><?php echo $GLOBALS["member"]["name"]?></B> <img src="/shop/data/skin/apple_tree/img/common/sid_icon05.gif" align=absmiddle></div>
		<table cellpadding=0 cellspacing=0 border=0 style="padding:5px 0;">
		<tr><td><?php $this->print_("myBox",$TPL_SCP,1);?></td></tr>
		</table>
	</div>
	<!-- 쇼핑정보박스 : END -->

	<!-- 마이페이지 메뉴 시작 -->
	<div><img src="/shop/data/skin/apple_tree/img/common/sid_line.gif"></div>
	<table cellpadding=0 cellspacing=0 border=0 class="lnbMyMenu">
	<tr>
		<th>개인정보</th>
	</tr>
	<tr>
		<td>
			<div><a href="<?php echo url("member/myinfo.php")?>&" class="lnbmenu">회원정보수정</a></div>
			<div><a href="<?php echo url("member/hack.php")?>&" class="lnbmenu">회원탈퇴</a></div>
		</td>
	</tr>
	<tr>
		<th>내 쇼핑정보</th>
	</tr>
	<tr>
		<td>
			<div><a href="<?php echo url("mypage/mypage_orderlist.php")?>&" class="lnbmenu">주문내역/배송조회</a></div>
			<div><a href="<?php echo url("mypage/mypage_emoney.php")?>&" class="lnbmenu">적립금내역</a></div>
			<div><a href="<?php echo url("mypage/mypage_coupon.php")?>&" class="lnbmenu">할인쿠폰내역</a></div>
			<div><a href="<?php echo url("mypage/mypage_wishlist.php")?>&" class="lnbmenu">상품보관함</a></div>
		</td>
	</tr>
	<tr>
		<th><a href="<?php echo url("mypage/mypage_qna.php")?>&">1:1 문의게시판</a></th>
	</tr>
	<tr>
		<th><a href="<?php echo url("mypage/mypage_review.php")?>&">나의 상품후기</a></th>
	</tr>
	<tr>
		<th><a href="<?php echo url("mypage/mypage_qna_goods.php")?>&">나의 상품문의</a></th>
	</tr>
	<tr>
		<th class="unline"><a href="<?php echo url("mypage/mypage_today.php")?>&">최근 본 상품 목록</a></th>
	</tr>
	</table>
	<!-- 마이페이지 메뉴 끝 -->
</div>

<!-- 메인왼쪽배너 : Start -->
<table cellpadding="0" cellspacing="0" border="0"width=100%>
<tr><td align="left"><!-- (배너관리에서 수정가능) --><?php if(is_array($TPL_R1=dataBanner( 4))&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?><?php echo $TPL_V1["tag"]?><?php }}?></td></tr>
<tr><td align="left"><!-- (배너관리에서 수정가능) --><?php if(is_array($TPL_R1=dataBanner( 5))&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?><?php echo $TPL_V1["tag"]?><?php }}?></td></tr>
</table>
<!-- 메인왼쪽배너 : End -->