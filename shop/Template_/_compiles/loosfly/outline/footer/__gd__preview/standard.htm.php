<?php /* Template_ 2.2.7 2014/02/26 17:16:52 /www/loosfly_godo_co_kr/shop/data/skin/loosfly/outline/footer/standard.htm 000010296 */  $this->include_("dataCategory","displaySSLSeal");?>
<?PHP $lfy_goods_knames = array("카테고리"=>"by category", "신상품"=>"new arrivals", "추천상품"=>"MD's choice", "상의"=>"tops", "하의"=>"bottoms", "레오타드"=>"leotards", "유니타드"=>"unitards", "액세서리"=>"accessories", "콜렉션"=>"by collection", "여성용"=>"women's", "남성용"=>"men's", "레이스와 망사"=>"lace & mesh", "편안한 바지"=>"fullness pants", "타이츠"=>"tights", "2014 컬렉션"=>"2014 Collection", "예비용"=>"reserved"); ?>

	<div id="dsFooter">
		<div style="height:20px;"></div>
		<div id="blkFooterMenu">
			<div class="footer_spacer01"> </div>
			<div id="bxShop">
				<div class="footer_title">shop.</div>
				<div style="height:10px;"></div>
				<div class="shop_menu">
					<div class="footer_subtitle"><div onMouseOver="overM('카테고리', this);" onMouseOut="outM('by category', this);">by category</div></div>
<?php if((is_array($TPL_R1=dataCategory($GLOBALS["cfg"]["subCategory"], 1))&&!empty($TPL_R1)) || (is_object($TPL_R1) && in_array("Countable", class_implements($TPL_R1)) && $TPL_R1->count() > 0)) {foreach($TPL_R1 as $TPL_V1){?>
<?PHP if (  $TPL_V1["category"] == "005" ) { ?>
				</div>
				<div style="position:relative;float:left;width:5px;height:50px;"></div>
				<div class="shop_menu">
					<div class="footer_subtitle"><div onMouseOver="overM('콜렉션', this);" onMouseOut="outM('by collection', this);">by collection</div></div>
<?PHP } ?>
					<div class="menu_item"><a href="<?php echo url("goods/goods_list.php?")?>&category=<?php echo $TPL_V1["category"]?>"><div onMouseOver="overS('<?php echo $TPL_V1["catnm"]?>', this);" onMouseOut="outS('<?PHP echo str_replace("'", "\'", $lfy_goods_knames[ $TPL_V1["catnm"]]); ?>', this);"><?PHP echo $lfy_goods_knames[ $TPL_V1["catnm"]]; ?></div></a></div>
<?php }}?>
				</div>
			</div>
			<div class="footer_spacer02"> </div>
			<div id="bxService">
				<div class="footer_title">service.</div>
				<div style="height:10px;"></div>
				<div class="menu_item"><a href="/shop/board/list.php?id=notice"><div onMouseOver="overS('공지사항', this);" onMouseOut="outS('notice', this);">notice</div></a></div>
				<div class="menu_item"><a href="/shop/board/list.php?id=event"><div onMouseOver="overS('이벤트 안내', this);" onMouseOut="outS('event', this);">event</div></a></div>
				<div class="menu_item"><a href="/shop/service/non-member.php"><div onMouseOver="overS('비회원 주문조회', this);" onMouseOut="outS('non-member Orders', this);">non-member orders</div></a></div>
				<div class="menu_item"><a href="/shop/member/find_id.php"><div onMouseOver="overS('아이디 찾기', this);" onMouseOut="outS('fild my ID', this);">find my ID</div></a></div>
				<div class="menu_item"><a href="#"><div onMouseOver="overS('여성의류 사이즈 안내', this);" onMouseOut="outS('women\'s sizing guide', this);">women's sizing guide</div></a></div>
				<div class="menu_item"><a href="#"><div onMouseOver="overS('남성의류 사이즈 안내', this);" onMouseOut="outS('men\'s sizing guide', this);">men's sizing guide</div></a></div>
				<div class="menu_item"><a href="/shop/service/guide.php"><div onMouseOver="overS('이용안내', this);" onMouseOut="outS('user\'s guide', this);">user's guide</div></a></div>
				<!--div class="menu_item"><a href="#"><div onMouseOver="overS('제휴매장 안내', this);" onMouseOut="outS('retail partners', this);">retail partners</div></a></div-->
				<div class="menu_item"><a href="/shop/service/faq.php"><div onMouseOver="overS('자주 묻는 질문들', this);" onMouseOut="outS('FAQ', this);">FAQ</div></a></div>
				<div class="menu_item"><a href="/shop/service/company.php"><div onMouseOver="overS('루스플라이에 대하여', this);" onMouseOut="outS('about loosfly', this);">about loosfly</div></a></div>
			</div>
			<div class="footer_spacer02"> </div>
			<div id="bxContactUs">
				<div class="footer_title">contact us.</div>
				<div style="height:10px;"> </div>
				<div id="notation" onMouseOver="overS('상품안내, 주문, 사이트 이용 등과 같은 일반적인 문의사항들은 아래로 문의하시면 빠르고 친절하게 답변해 드립니다.', this);" onMouseOut="outS('for all questions about<BR>order or general enquiries<BR>please contact :', this);">for all questions about<BR>order or general enquiries<BR>please contact :</div>
				<div style="height:10px;"> </div>
				<div class="menu_item">email :</div>
				<div class="menu_item"><a href="javascript:popup('../proc/popup_email.php?to=<?php echo $GLOBALS["cfg"]['adminEmail']?>&hidden=1',650,600)"><?php echo $GLOBALS["cfg"]['adminEmail']?></a></div>
				<div style="height:10px;"></div>
				<div class="menu_item">telephone :</div>
				<div class="menu_item">+82 (2) 549 9003</div>
				<div style="height:10px;"></div>
				<div class="menu_item">office hour: </div>
				<div class="menu_item">9:00am - 6:00pm </div>
			</div>
			<div class="footer_spacer02"> </div>
			<div id="bxFollowUs">
				<div class="footer_title">follow us.</div>
				<div style="height:20px;"></div>
				<div id="bxSNSicons">
					<div style="position:relative;float:left;width:12px;height:22px;"></div>
					<div class="sns_icon"><a href="#"><img src="/shop/skin/loosfly/img/jimmy/fbook_01.gif" onmouseover="this.src='/shop/skin/loosfly/img/jimmy/fbook_02.gif'" onmouseout="this.src='/shop/skin/loosfly/img/jimmy/fbook_01.gif'" /></a></div>
					<div style="position:relative;float:left;width:10px;height:22px;"></div>
					<div class="sns_icon"><a href="#"><img src="/shop/skin/loosfly/img/jimmy/twitter_01.gif" onmouseover="this.src='/shop/skin/loosfly/img/jimmy/twitter_02.gif'" onmouseout="this.src='/shop/skin/loosfly/img/jimmy/twitter_01.gif'" /></a></div>
					<div style="position:relative;float:left;width:10px;height:22px;"></div>
					<div class="sns_icon"><a href="#"><img src="/shop/skin/loosfly/img/jimmy/flickr_01.gif" onmouseover="this.src='/shop/skin/loosfly/img/jimmy/flickr_02.gif'" onmouseout="this.src='/shop/skin/loosfly/img/jimmy/flickr_01.gif'" /></a></div>
					<div style="position:relative;float:left;width:10px;height:22px;"></div>
					<div class="sns_icon"><a href="#"><img src="/shop/skin/loosfly/img/jimmy/vimeo_01.gif" onmouseover="this.src='/shop/skin/loosfly/img/jimmy/vimeo_02.gif'" onmouseout="this.src='/shop/skin/loosfly/img/jimmy/vimeo_01.gif'" /></a></div>
					<div style="position:relative;float:left;width:10px;height:22px;"></div>
					<div class="sns_icon"><a href="#"><img src="/shop/skin/loosfly/img/jimmy/google_01.gif" onmouseover="this.src='/shop/skin/loosfly/img/jimmy/google_02.gif'" onmouseout="this.src='/shop/skin/loosfly/img/jimmy/google_01.gif'" /></a></div>
					<div style="position:relative;float:left;width:13px;height:22px;"></div>
				</div>
				<div style="height:30px;"></div>
				<div id="bxLoos">
					<div id="loos"><a href="http://www.loosfly.com/shop/service/company.php?tt=1"><img src="/shop/skin/loosfly/img/jimmy/loos_02.gif"></a></div>
					<div id="balloon"><div style="padding:5px 0 0 5px;line-height:14px">loosfly<br>쇼룸안내</div></div>
				</div>
			</div>
			<div class="footer_spacer01"> </div>
		</div>
		<div id="blkObligation">
			<fieldset id="obligation_field">
			<legend ><span><b>[</b>통신판매사업 관련 법령에 따른 의무표시사항<b>]</b></span></legend>
				<table width="100%" height="63"  cellpadding="0" cellspacing="0" border="0" align="center">
				<tr>
					<td>회사명 : <?php echo $GLOBALS["cfg"]['compName']?></td>
					<td>전화번호 : <?php echo $GLOBALS["cfg"]['compPhone']?></td>
					<td>사업자등록번호 : <?php echo $GLOBALS["cfg"]['compSerial']?> <a href="http://www.ftc.go.kr/info/bizinfo/communicationList.jsp" target="_blank"> [확인]</a></td>
					<td>개인정보관리 책임자 : <?php echo $GLOBALS["cfg"]['adminName']?></td>
				</tr>
				<tr>
					<td>대표이사 : <?php echo $GLOBALS["cfg"]['ceoName']?></td>
					<td>팩스번호 : <?php echo $GLOBALS["cfg"]['compFax']?></td>
					<td>통신판매업신고번호 : <?php echo $GLOBALS["cfg"]['orderSerial']?></td>
					<td class="ob_link"><a href="/shop/service/private.php">[개인정보취급방침]</a></td>
				</tr>
				<tr>
					<td colspan="2" style="line-height:15px;">주소 : [본사] 135-819 <?php echo $GLOBALS["cfg"]['address']?><br><a href="http://www.loosfly.com/shop/service/company.php?tt=1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[전시장] 135-819 서울시 강남구 논현2동 99-22 예랑빌딩 4층</a></td>
					<td>이메일 : <a href="javascript:popup('../proc/popup_email.php?to=<?php echo $GLOBALS["cfg"]['adminEmail']?>&hidden=1',650,600)"><?php echo $GLOBALS["cfg"]['adminEmail']?></a></td>
					<td class="ob_link"><a href="/shop/service/agreement.php">[사이트이용약관]</a></td>
				</tr>
				</table>
			</fieldset>
			<div style="position:relative;float:left;width:20px;height:100px"></div>
			<div style="position:relative;float:left;background-color:#ffffff;border:#3f3f3f 1px solid;width:150px;height:97px;margin-top:8px;">
			<!-- SSL seal -->
				<div style="position:relative;float:left;width:10px;height:100px;"></div>
				<!--div class="cert_label" style="position:relative;float:left;line-height:100px;padding-top:12px"><?php echo displaySSLSeal()?></div-->
				<div style="position:relative;float:left;line-height:10px;padding-top:12px"><a href="http://www.instantssl.com" target="_blank"><img src="/shop/lib/ssl/Comodo/standard_logo/comodo_seal_52x63.png" alt="SSL Certificates" width="52" height="63" style="border: 0px;"><br><span style="font-weight:bold; font-size:9px">SSL Certificates</span></a></div>
				<div style="position:relative;float:left;width:10px;height:100px;"></div>
			<!-- 구매안전서비스 표시 -->
				<div style="position:relative;float:left;padding-top:8px;cursor:pointer;"><img src="https://mark.inicis.com/img/mark_escrow/inipoint/mark_square_black_s.gif" border="0" alt="클릭하시면 이니시스 결제시스템의 유효성을 확인하실 수 있습니다." style="cursor:hand" Onclick=javascript:window.open("https://mark.inicis.com/mark/escrow_popup.php?no=39840&st=1371721644","mark","scrollbars=no,resizable=no,width=530,height=670");></div>
			</div>
		</div>
		<div style="height:20px;"></div>
		<div id="bottom_logo"></div>
	</div>