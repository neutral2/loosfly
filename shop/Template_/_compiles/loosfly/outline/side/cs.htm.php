<?php /* Template_ 2.2.7 2014/10/24 01:33:01 /www/loosfly_godo_co_kr/shop/data/skin/loosfly/outline/side/cs.htm 000003709 */ ?>
<!-- 고객센터 메뉴 시작 -->
			<div id="left_title">s<span class="emphasis">e</span>rvice.</div>
			<div style="height:20px;"></div>
			<div id="left_menu">
				<!-- 고객센터메뉴박스 : START -->
				<div id="bxServiceMenu">
					<div id="service_title"><B>루스플라이 고객센터</B></div>
					<div style="height:10px;"></div>
					<a href="/shop/board/list.php?id=notice"><div style="width:150px"><b>ㆍ&nbsp;&nbsp;공지사항</b></div></a>
					<div style="height:5px;"></div>
					<a href="/shop/board/list.php?id=event"><div style="width:150px"><b>ㆍ&nbsp;&nbsp;이벤트 안내</b></div></a>
					<div style="height:5px;"></div>
					<a href="/shop/service/non-member.php"><div style="width:150px"><b>ㆍ&nbsp;&nbsp;비회원 주문조회</b></div></a>
<?php if(!$GLOBALS["sess"]){?>
					<div style="height:5px;"></div>
					<a href="/shop/member/find_id.php"><div style="width:150px">ㆍ&nbsp;&nbsp;아이디 찾기</div></a>
<?php }?>
					<div style="height:5px;"></div>
					<a href="/shop/service/sizing_guide.php"><div style="width:150px">ㆍ&nbsp;&nbsp;여성의류 사이즈 안내</div></a>
					<div style="height:5px;"></div>
					<a href="/shop/service/sizing_guide.php?size_type=men"><div style="width:150px">ㆍ&nbsp;&nbsp;남성의류 사이즈 안내</div></a>
					<div style="height:5px;"></div>
					<a href="/shop/service/guide.php"><div style="width:150px">ㆍ&nbsp;&nbsp;이용안내</div></a>
					<div style="height:5px;"></div>
					<!--a href="#"><div style="width:150px">ㆍ&nbsp;&nbsp;판매점 안내</div></a>
					<div style="height:5px;"></div>
					<a href="/shop/service/faq.php"><div style="width:150px">ㆍ&nbsp;&nbsp;FAQ</div></a>
					<div style="height:5px;"></div-->
					<a href="/shop/service/company.php"><div style="width:150px">ㆍ&nbsp;&nbsp;루스플라이에 대하여</div></a>
					<div style="height:5px;"></div>
					<a href="/shop/service/company.php?tt=1"><div style="width:150px;color:#F47D30"><b>ㆍ&nbsp;&nbsp;쇼룸(Show Room)안내</b></div></a>
					<div style="height:5px;"></div>
				</div>
				<!-- 고객센터메뉴박스 : END -->
				<div style="height:40px"></div>
				<!-- 메인왼쪽 고객센터 01 : Start -->
				<div id="cs_center_box">
					<div id="service_title" style="background:#efefef;"><B>고객센터 안내</B></div>
					<div style="height:18px;padding:5px 0 0 10px;"><span style="font-size:13px;color:#3f3f3f;"> </span></div>
					<div style="height:40px;text-align:center;font:bold 24px arial;color:#71cbd2;"><span style="font:bold 18px arial;color:#afafaf">02)</span> 549 9003</span></div>
					<dl style="margin:0; padding:5px 0 15px; color:#616161; line-height:17px;">
						<dt style="font-weight:bold;text-align:center;height:20px;">◆ 고객센터 운영시간 ◆</dt>
						<dd style="padding-left:10px;height:20px;">월~금 오전<span style="color:#71cbd2">10시</span> - 오후<span style="color:#71cbd2">6시</span></dd>
						<dd style="padding-left:10px;height:20px;">(점심시간 12:00 - 13:00)</dd>
						<dd style="padding-left:10px;height:20px;">토요일, 공휴일 휴무</dd>
					</dl>
				</div>
				<!-- 메인왼쪽 고객센터 01 : End -->
			</div>
			<div style="height:30px;"></div>


<!-- 관리자에게 SMS보내기 기능 : 관련파일은 '디자인관리 > 기타페이지디자인 > 기타/추가페이지(proc) > 관리자에게 SMS상담문의하기 - ccsms.htm' 에 있습니다. -->
<!-- 아래 기능은 기본적으로 회원들만 보이도록 되어있는 소스입니다.
만약 비회원들도 이 기능을 사용하게 하려면 아래 소스중에,  \{ # ccsms \}  요부분만 남겨놓고 아래위 소스를 삭제하시면 됩니다.
또한 이기능을 사용하려면 '회원관리 > SMS포인트충전' 에서 포인트충전이 되어있어야만 가능합니다. -->