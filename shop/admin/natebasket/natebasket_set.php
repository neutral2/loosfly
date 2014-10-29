<?php

$location = "네이트 바스켓 > 네이트 바스켓 설정";
include "../_header.php";
@include "../../conf/natebasket.php";

if (get_magic_quotes_gpc()) {
	stripslashes_all($_POST);
	stripslashes_all($_GET);
}

// 설정 값 적용
$incoupon = ($natebasket['uncoupon'] == 'Y' ? 'N' : 'Y');
$useYn = $natebasket['useYn'];
$nb_pcard = $natebasket['nb_pcard'];
$nb_goodshead = $natebasket['nb_goodshead'];
$checked['incoupon'][$incoupon] = "checked";
$checked['useYn'][$useYn] = "checked";
?>

<div class="title title_top">네이트 바스켓 설정<span> <a href="javascript:manual('<?=$guideUrl?>board/view.php?id=marketing&no=29')"><img src="../img/btn_q.gif" border=0 align=absmiddle hspace=2></a></div>

<div style="padding-top:10"></div>

<form name=form method=post action="indb.php">
<input type=hidden name=mode value="natebasket">

<table class=tb border=0>
<col class=cellC><col class=cellL>
<tr>
	<td>사용여부</td>
	<td class="noline">
	<label><input type="radio" name="useYn" value="y" <?php echo $checked['useYn']['y'];?>/>사용</label><label><input type="radio" name="useYn" value="n" <?php echo $checked['useYn']['n'];?> <?php echo $checked['useYn'][''];?> />사용안함</label>
	</td>
</tr>
<tr>
	<td>상품가격 설정</td>
	<td class="noline">
	<div class="extext" style="padding-bottom:5px;">네이트 바스켓에 노출되는 가격정보를 설정합니다.</div>
	<div>
		<span class="noline"><input type="checkbox" name="incoupon" value="Y" <?=$checked['incoupon']['Y']?>/></span> 쿠폰 적용
		<div style="padding:3px 0px 0px 25px;">
			<div class="extext">쿠폰은 <a href="../event/coupon.php" class="extext" style="font-weight:bold">프로모션/SNS > 쿠폰리스트 </a>에서 관리 가능합니다.</div>
		</div>
	</div>
	</td>
</tr>
<tr>
	<td>네이트 바스켓<br />무이자할부정보</td>
	<td><input type=text name="nb_pcard" value="<?=$nb_pcard?>" class=lline></td>
</tr>
<tr>
	<td>네이트 바스켓<br />상품명 머릿말 설정</td>
	<td>
	<div><input type=text name="nb_goodshead" value="<?=$nb_goodshead?>" class=lline>&nbsp;<a href="javascript:document.form.submit();"><img src="../img/btn_naver_install.gif" align=absmiddle></a></div>
	<div class="extext">* 상품명 머리말 설정을 위한 치환코드</div>
	<div class="extext">- 머리말 상품에 입력된 "제조사"를 넣고 싶을 때 : {_maker}</div>
	<div class="extext">- 머리말 상품에 입력된 "브랜드"를 넣고 싶을 때 : {_brand}</div>
	</td>
</tr>
</table>
</form>

<div id=MSG02>
<table cellpadding=1 cellspacing=0 border=0 class=small_ex>
<tr><td><img src="../img/icon_list.gif" align=absmiddle>네이트 바스켓 무이자할부정보란?: 각 카드사별 무이자정보를 입력하실 수 있습니다. 예) 삼성2~3/롯데3/현대6</td></tr>
<tr><td><img src="../img/icon_list.gif" align=absmiddle>변경된 무이자할부정보는 네이트 바스켓 업데이트 주기에 따라 네이트 바스켓에 반영되어집니다.</td></tr>
<tr><td><img src="../img/icon_list.gif" align=absmiddle>네이트 바스켓에 노출되는 상품정보는 다시 등록하시는 것이 아닙니다.</td></tr>
<tr><td style="padding-left:8">현재 운영중인 쇼핑몰의 상품정보를 네이트 바스켓이 1일 1회이상(보통 1 ~ 3회) 자동으로 가져갑니다.</td></tr>
</table>
<br/>
<table cellpadding=1 cellspacing=0 border=0 class=small_ex>
<tr><td><img src="../img/icon_list.gif" align=absmiddle>네이트 바스켓에서 상품검색이 많이 될 수 있도록 상품명 머리말 설정을 활용하세요!</td></tr>
<tr><td><img src="../img/icon_list.gif" align=absmiddle>예시 1) 상품명 머리말 설정 : 공란</td></tr>
<tr>
	<td style="padding-left:10">
	<table style='border:1px solid #ffffff;width:400' class=small_ex>
	<col align="center" width="60"><col align="center" width="50"><col align="center" width="50"><col>
	<tr>
		<td>상품명</td>
		<td>제조사</td>
		<td>브랜드</td>
		<td>네이버 노출 상품명</td>
	</tr>
	<tr>
		<td>여자청바지</td>
		<td>스웨덴</td>
		<td>폴로</td>
		<td>여자청바지</td>
	</tr>
	</table>
	</td>
</tr>
<tr><td><img src="../img/icon_list.gif" align=absmiddle>예시 2) 상품명 머리말 설정 : [무료배송 / {_maker} / {_brand}]</td></tr>
<tr>
	<td style="padding-left:10">
	<table style='border:1px solid #ffffff;width:400' class=small_ex>
	<col align="center" width="60"><col align="center" width="50"><col align="center" width="50"><col>
	<tr>
		<td>상품명</td>
		<td>제조사</td>
		<td>브랜드</td>
		<td>네이버 노출 상품명</td>
	</tr>
	<tr>
		<td>여자청바지</td>
		<td>스웨덴</td>
		<td>폴로</td>
		<td>[무료배송 / 수에덴 / 폴로] 여자청바지</td>
	</tr>
	</table>
	</td>
</tr>
</table>
<script>cssRound('MSG02')</script>
</div>

<div style="padding-top:10"></div>

<table width=100% cellpadding=0 cellspacing=0>
<col class=cellC><col style="padding:5px 10px;line-height:140%">
<tr class=rndbg>
	<th>업체</th>
	<th>상품 DB URL [페이지 미리보기]</th>
</tr>
<tr><td class=rnd colspan=10></td></tr>
<tr>
	<td>네이트 바스켓<br>상품DB URL페이지</td>
	<td>
	<font color="57a300">[전체상품]</font> <a href="../../partner/natebasket_all.php" target=_blank>
	<font class=ver8>http://<?=$_SERVER['HTTP_HOST'].$cfg[rootDir]?>/partner/natebasket_all.php</font>
	<img src="../img/btn_naver_view.gif" align=absmiddle></a><br>
	<font color="57a300">[요약상품]</font> <a href="../../partner/natebasket_summary.php" target=_blank>
	<font class=ver8>http://<?=$_SERVER['HTTP_HOST'].$cfg[rootDir]?>/partner/natebasket_summary.php</font>
	<img src="../img/btn_naver_view.gif" align=absmiddle></a>
	</td>
</tr>
<tr><td colspan=12 class=rndline></td></tr>
</table>

<?include "../_footer.php"; ?>