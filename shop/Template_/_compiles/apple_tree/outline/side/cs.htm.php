<?php /* Template_ 2.2.7 2012/11/20 16:29:25 /www/loosfly_godo_co_kr/shop/data/skin/apple_tree/outline/side/cs.htm 000002908 */  $this->include_("dataBanner");?>
<!-- 고객센터 메뉴 시작 -->
<div style="width:190px;">
	<div><img src="/shop/data/skin/apple_tree/img/common/sid_tit_cscentertop.gif"></div>
	<div style="border:solid 0 #39C1D7; border-width:0 2px 2px 2px; padding:10px 0 3px 8px;">
	<table cellpadding=0 cellspacing=7 border=0>
	<tr>
		<td><a href="<?php echo url("service/faq.php")?>&" class="lnbmenu">FAQ</a></td>
	</tr>
	<tr>
		<td><a href="<?php echo url("service/guide.php")?>&" class="lnbmenu">이용안내</a></td>
	</tr>
	<tr>
		<td><a href="<?php echo url("mypage/mypage_qna.php")?>&" class="lnbmenu">1:1문의게시판</a></td>
	</tr>
	<tr>
		<td><a href="<?php echo url("member/find_id.php")?>&" class="lnbmenu">ID찾기</a></td>
	</tr>
	<tr>
		<td><a href="<?php echo url("member/find_pwd.php")?>&" class="lnbmenu">비밀번호찾기</a></td>
	</tr>
	<tr>
		<td><a href="<?php echo url("member/myinfo.php")?>&" class="lnbmenu">마이페이지</a></td>
	</tr>
	</table>
	</div>
</div>
<!-- 고객센터 메뉴 끝 -->

<!-- 메인왼쪽 고객센터 01 : Start -->
<div style="width:190px;">
	<div style="margin-top:10px;"><img src="/shop/data/skin/apple_tree/img/main/sid_tit_cscenter.gif"></div>
	<div><img src="/shop/data/skin/apple_tree/img/main/sid_ban_cscenter.gif"></div>
	<dl style="border-style:solid; border-width: 0 1px; border-color:#D1D1D1; margin:0; padding:5px 0 15px; color:#616161; line-height:17px;">
		<dt style="font-weight:bold; margin-left:20px">고객센터 운영시간안내</dt>
		<dd style="margin-left:20px">평일 am10:00 - pm18:00</dd>
		<dd style="margin-left:20px">토요일 am10:00 - pm13:00</dd>
		<dd style="margin-left:20px">일요일, 공휴일 휴무</dd>
	</dl>
</div>
<!-- 메인왼쪽 고객센터 01 : End -->

<!-- 관리자에게 SMS보내기 기능 : 관련파일은 '디자인관리 > 기타페이지디자인 > 기타/추가페이지(proc) > 관리자에게 SMS상담문의하기 - ccsms.htm' 에 있습니다. -->
<!-- 아래 기능은 기본적으로 회원들만 보이도록 되어있는 소스입니다.
만약 비회원들도 이 기능을 사용하게 하려면 아래 소스중에,  \{ # ccsms \}  요부분만 남겨놓고 아래위 소스를 삭제하시면 됩니다.
또한 이기능을 사용하려면 '회원관리 > SMS포인트충전' 에서 포인트충전이 되어있어야만 가능합니다. -->

<?php if($GLOBALS["sess"]){?>
<?php $this->print_("ccsms",$TPL_SCP,1);?>

<?php }?>

<!-- 메인왼쪽배너 : Start -->
<table cellpadding="0" cellspacing="0" border="0"width=100%>
<tr><td align="left"><!-- (배너관리에서 수정가능) --><?php if(is_array($TPL_R1=dataBanner( 4))&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?><?php echo $TPL_V1["tag"]?><?php }}?></td></tr>
<tr><td align="left"><!-- (배너관리에서 수정가능) --><?php if(is_array($TPL_R1=dataBanner( 5))&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?><?php echo $TPL_V1["tag"]?><?php }}?></td></tr>
</table>
<!-- 메인왼쪽배너 : End -->