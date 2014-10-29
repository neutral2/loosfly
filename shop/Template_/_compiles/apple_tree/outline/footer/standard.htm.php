<?php /* Template_ 2.2.7 2012/11/20 16:29:25 /www/loosfly_godo_co_kr/shop/data/skin/apple_tree/outline/footer/standard.htm 000004380 */  $this->include_("dataBanner","displaySSLSeal","displayEggBanner");?>
<table  cellpadding='0' cellspacing='0' border='0' width='100%' style="background-image:url('/shop/data/skin/apple_tree/img/main/bg_foot.gif');background-repeat:repeat-x; margin-top:50">
<tr><td>


<table border='0' cellpadding='0' width="<?php echo $GLOBALS["cfg"]['shopSize']?>" align="<?php echo $GLOBALS["cfg"]['shopAlign']?>" cellspacing='0' >
<tr>
<td>

	<!------------ 하단 버튼 (회사소개 등) 시작 --------------->
	<table border='0' cellpadding='0' cellspacing='0'>
	<tr>
	<td><a href="<?php echo url("service/company.php")?>&"><img src="/shop/data/skin/apple_tree/img/main/fnb_company.gif"></a></td>
	<td><a href="<?php echo url("service/private.php")?>&"><img src="/shop/data/skin/apple_tree/img/main/fnb_personal.gif"></a></td>
	<td><a href="<?php echo url("service/agreement.php")?>&"><img src="/shop/data/skin/apple_tree/img/main/fnb_use.gif"></a></td>
	<td><a href="<?php echo url("service/customer.php")?>&"><img src="/shop/data/skin/apple_tree/img/main/fnb_cs.gif"></a></td>
	<td><a href="<?php echo url("service/cooperation.php")?>&"><img src="/shop/data/skin/apple_tree/img/main/fnb_partner.gif"></a></td>
	<td><a href="<?php echo url("member/find_id.php")?>&"><img src="/shop/data/skin/apple_tree/img/main/fnb_lost.gif"></a></td>
	<td><a href="<?php echo url("service/guide.php")?>&"><img src="/shop/data/skin/apple_tree/img/main/bn_foots01.gif"></a></td>
	<td><a href="<?php echo url("service/sitemap.php")?>&"><img src="/shop/data/skin/apple_tree/img/main/bn_foots02.gif"></a></td>
	</tr>
	</table>
	<!------------ 하단 버튼 (회사소개 등) 끝 --------------->
</td>
</tr>
<tr>
<td class="outline_both" style="padding:20px 10px 10px 0px;">
	<!------------ 하단 카피라이트  시작 --------------->
	<table width='100%' border='0'>
	<tr>
	<!------------------ 하단로고 시작 ------------------->
	<td width='230'><!-- 배너관리에서 수정가능 --><?php if(is_array($TPL_R1=dataBanner( 91))&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?><?php echo $TPL_V1["tag"]?><?php }}?></td>
	<!------------------ 하단로고 끝 ------------------->
	<td>
		<div style="padding-bottom:5px"><font color='666666'>주소 : <?php echo $GLOBALS["cfg"]['address']?> <font color=#CECECE>|</font> 사업자등록번호 : <?php echo $GLOBALS["cfg"]['compSerial']?> <a href="http://www.ftc.go.kr/info/bizinfo/communicationList.jsp" target="_blank"><img src="/shop/data/skin/apple_tree/img/common/btn_c_view.gif" align="absmiddle"></a></div>
		<div style="padding-bottom:5px">통신판매업신고번호 : <?php echo $GLOBALS["cfg"]['orderSerial']?> <font color=#CECECE>|</font> 개인정보관리자 : <?php echo $GLOBALS["cfg"]['adminName']?> <font color=#CECECE>|</font> 대표 : <?php echo $GLOBALS["cfg"]['ceoName']?> <font color=#CECECE>|</font> 상호명 : <?php echo $GLOBALS["cfg"]['compName']?></div>
		<div style="padding-bottom:5px">전화번호 : <?php echo $GLOBALS["cfg"]['compPhone']?> <font color=#CECECE>|</font> 팩스번호 : <?php echo $GLOBALS["cfg"]['compFax']?> <font color=#CECECE>|</font> 메일 : <a href="javascript:popup('../proc/popup_email.php?to=<?php echo $GLOBALS["cfg"]['adminEmail']?>&hidden=1',650,600)"><?php echo $GLOBALS["cfg"]['adminEmail']?></a>
			<font color=#CECECE>|</font> 호스팅제공 : <a href="http://godo.co.kr" target="_blank">(주)고도소프트</a>
		</div>
		<!------------ 하단 카피라이트  끝 --------------->

		<table cellpadding='0' cellspacing='0' class='float'>
		<tr>
		<td class=eng>Copyright ⓒ <b><?php echo $GLOBALS["cfg"]['shopUrl']?></b> All right reserved</td>
		</tr>
		</table>

	</td>
	<!------------------ SSL seal 시작 ------------------->
	<td><?php echo displaySSLSeal()?></td>
	<!------------------ SSL seal 끝 ------------------->

	<!------------------ 구매안전서비스 표시 시작 ------------------->
	<td><?php echo displayEggBanner()?></td>
	<!------------------ 구매안전서비스 표시 끝 ------------------->

	<!------------------ 옥션 iPay Logo 표시 시작 ------------------->
	<td><?php echo auctionIpayLogo()?></td>
	<!------------------ 옥션 iPay Logo 표시 끝 ------------------->

	</tr>
	<tr><td colspan='20' height='20'></td></tr>
	</table>
</td>
</tr>
</table>

</td>
</tr>
</table>