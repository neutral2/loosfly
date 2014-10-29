<?
$location = "기본관리 > 장바구니 관련설정";
include "../_header.php";

include  "../../lib/cart.class.php";
$cart = new Cart;

if($cart->keepPeriod>0)
	$checked[keepPeriod][1]='checked';
else
	$checked[keepPeriod][0]='checked';

$checked[runoutDel][$cart->runoutDel]='checked';
$checked[redirectType][0]=($cart->redirectType=='Direct')?'checked':'';
$checked[redirectType][1]=($cart->redirectType=='Confirm')?'checked':'';
$checked[redirectType][2]=($cart->redirectType=='Keep')?'checked':'';
?>

<form method="post" action="indb.php">
<input type="hidden" name="mode" value="cartSet">
<div class="title title_top">고객 장바구니 상품 보관 설정  <span>고객 장바구니에 담긴 상품의 보관기간을 설정합니다.</span>
<a href="javascript:manual('<?=$guideUrl?>board/view.php?id=basic&no=28')"><img src="../img/btn_q.gif" border=0 align=absmiddle></a></div>
<table class=tb>
<col class=cellC><col class=cellL>
<tr>
	<td>상품 보관 기간 설정</td>
	<td class=noline>
	<input type=radio name=keepPeriodYn value="Y" <?=$checked[keepPeriod][0]?>>고객이 삭제 시 까지 보관&nbsp;&nbsp;
	<input type=radio name=keepPeriodYn value="N" <?=$checked[keepPeriod][1]?>>
	<select name="keepPeriod">
	<? 
	if($cart->keepPeriod>0)
		$tmp[keepPeriod]=$cart->keepPeriod;
	else 
		$tmp[keepPeriod]='7';

	for($i=1; $i<=30; $i++){
		$selected[keepPeriod]="";
		if($i==$tmp[keepPeriod])
			$selected[keepPeriod]="selected";
	echo "<option value='".$i."' ".$selected[keepPeriod].">".$i."</option>";
	}?>
	</select>
	
	일 까지 보관 후 자동삭제
	</td>
</tr>

<tr>
	<td>품절상품 보관설정</td>
	<td class=noline>
		<input type=radio name="runoutDel" value="1" <?=$checked[runoutDel][1]?>>보관상품 품절 시 자동삭제&nbsp;&nbsp;
		<input type=radio name="runoutDel" value="0" <?=$checked[runoutDel][0]?>>보관상품 품절 시 남겨둠
	</td>
</tr>

</table>
<div class="extext" style="padding: 5px 0 0 5px;line-height:140%;">
※회원 장바구니에만 보관설정이 적용되며, 비회원일 경우 보관설정이 적용되지 않습니다.<br/>
※고객 장바구니 상품보관 개수는 최대 300개 까지 제공되며, 초과시 안내 멘트가 출력 됩니다.
</div>

<div class=title>장바구니 페이지 이동 설정 <span>장바구니담기 실행시 장바구니 페이지로의 화면 이동여부를 설정합니다.  </span> <a href="javascript:manual('<?=$guideUrl?>board/view.php?id=basic&no=28')"><img src="../img/btn_q.gif" border=0 align=absmiddle></a></div>
<table class=tb>
<col class=cellC><col class=cellL>
<tr>
	<td rowspan="2">장바구니 담기<br/>페이지 이동여부 <br/>설정</td>
	<td class="noline">
		<label><input type="radio" name="redirectType" value="Direct" <?=$checked[redirectType][0]?> >장바구니 페이지 바로 이동</label>
		<div class="extext" style="padding: 5px 0 0 5px;line-height:140%;">장바구니 담기 버튼 클릭시 장바구니 페이지로 바로 이동됩니다.</div>
	</td>
</tr>
<tr>
	<td class="noline">
		<label><input type="radio" name="redirectType" value="Confirm" <?=$checked[redirectType][1]?>>장바구니 페이지 이동여부 선택</label>
		<div class="extext" style="padding: 5px 0 0 5px;line-height:140%;">장바구니 담기 버튼 클릭시 확인 팝업이 뜨며, 장바구니 페이지 이동여부를 선택할 수 
    있습니다.<br/>
    “장바구니에 담았습니다. 지금 확인 하시겠습니까? [장바구니보기] [계속쇼핑하기]” <br/>
     [장바구니보기] -> 장바구니 페이지로 이동합니다.<br/>
     [계속쇼핑하기] -> 현재페이지 유지상태에서 옵션선택 부분이 초기화 됩니다.<br/>
</div>
	</td>
</tr>
	</td>
</tr>

</table>
<div class=button><input type=image src="../img/btn_save.gif"></div>
</form>

<p>
<div id=MSG01>
<table cellpadding=1 cellspacing=0 border=0 class=small_ex>
<tr><td><img src="../img/icon_list.gif" align="absmiddle">※ 장바구니담기 확인 팝업 디자인 수정</font></td></tr>
<tr><td><img src="../img/icon_list.gif" align="absmiddle">위의 장바구니 페이지 이동설정에서 ‘장바구니 페이지로 이동여부 선택’으로 설정시 열리는 ‘장바구니 담기 확인 </td></tr>
<tr><td><img src="../img/icon_list.gif" align="absmiddle">팝업’ 디자인은 디자인관리 좌측 트리 항목의 <a href="../design/codi.php?design_file=goods/popup_cart_add.htm"><font color=white><b>[ 상품 > 장바구니담기 팝업 ]</b></font></a> 에서 디자인 수정이 가능합니다. 

</td></tr>
 
</table>
</div>
<script>cssRound('MSG01')</script>
 


<? include "../_footer.php"; ?>