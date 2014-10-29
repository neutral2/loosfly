<?

$location = "구매안전 서비스 > 쇼핑몰 보증보험 신청";
include "../_header.php";

?>
<script src="../basic/egg.request.js"></script>

<form name=form onsubmit="return ( usafeRequest(this) ? false : false );">

<div class="title title_top">쇼핑몰 보증보험 신청 <span>쇼핑몰 보증보험 서비스를 신청합니다.</span></div>

<div style="border:solid 3px #dce1e1; padding:7px 0 10px 10px">
	㈜고도소프트 개인정보 제 3자 제공동의<br/>
	상품 서비스 및 본인 사용 확인을 위해 ㈜고도소프트와 서비스 제휴 업체간 회원의 구매정보를 제공하고 있습니다.<br/>
	제공 받는자 : 서울보증보험㈜, ㈜유세이프<br/>
	제공 목적 : 쇼핑몰보증보험 가입 및 보험가입 제반사항<br/>
	제공 항목 : 구매자명, 구매자 생년월일, 구매자 성별, 전화번호(일반전화 및 핸드폰), 이메일, 주문번호, 배송지정보, 주문금액등 서비스 이행을 위한 필수적인 항목<br/>
	개인정보 보유 및 이용기간 : 개별서비스 제공기간(단, 상법 등 법령의 규정에 의하여 더 보존할 필요성이 있는
	경우에는 법령에서 규정한 보존기간 동안 거래내역과 최소한의 기본정보를 보유합니다.)
</div>
<div class="noline" style="padding:5px 0 20px 10px;">
	<input type="checkbox" name="thirdAgree" value="y" required label="개인정보 제3자 제공에 동의"> 위 개인정보 제3자 제공에 동의합니다.
</div>

<table class=tb>
<col class=cellC><col class=cellL><col class=cellC><col class=cellL>
<tr>
	<td>상점아이디</td>
	<td colspan=3><?=sprintf("GODO%05d", $godo[sno])?></td>
</tr>
<tr>
	<td>상호명</td>
	<td><input type=text name=compName required label="상호명"></td>
	<td>도메인</td>
	<td colspan=3>http://<input type=text name=domain style="width:80%" required label="도메인"></td>
</tr>
<tr>
	<td>사업자구분</td>
	<td class=noline>
	<input type=radio name=compType value=0 required label="사업자구분"> 개인사업자
	<input type=radio name=compType value=1 required label="사업자구분"> 법인사업자
	</td>
	<td>사업자번호</td>
	<td><input type=text name=compSerial onKeyDown=onlynumber() required label="사업자번호"> <span class=small><font color=#5B5B5B>("-" 표시없이 입력)</font></span></td>
</tr>
<tr>
	<td>대표자명</td>
	<td><input type=text name=ceoName required label="대표자명"></td>
</tr>
<tr>
	<td>업태</td>
	<td><input type=text name=service required label="업태"></td>
	<td>종목</td>
	<td><input type=text name=item required label="종목"></td>
</tr>
<tr>
	<td>전화</td>
	<td><input type=text name=compPhone[] style="width:40px;" required label="전화" onkeydown="onlynumber()">―<input type=text name=compPhone[] style="width:40px;" required label="전화" onkeydown="onlynumber()">―<input type=text name=compPhone[] style="width:40px;" required label="전화" onkeydown="onlynumber()"></td>
	<td>팩스</td>
	<td><input type=text name=compFax[] style="width:40px;" onkeydown="onlynumber()">―<input type=text name=compFax[] style="width:40px;" onkeydown="onlynumber()">―<input type=text name=compFax[] style="width:40px;" onkeydown="onlynumber()"></td>
</tr>
<tr>
	<td>사업자등록증주소지</td>
	<td colspan=3>

	<div class=def>
		<input type=text name=zipcode[] id="zipcode0" size=3 readonly value=""> -
		<input type=text name=zipcode[] id="zipcode1" size=3 readonly value="">
		<a href="javascript:popup('../../proc/popup_address.php',500,432)"><img src="../img/btn_zipcode.gif" align=absmiddle></a>
	</div>
	<div class=def>
		지번	　: <input type=text name=address id="address" style="width:60%" value="" required label="주소"> <br />
		도로명	 : <input type="text" name="road_address" id="road_address" style="width:60%" value="">
	</div>

	</td>
</tr>
</table>

<div class=title>문의사항</div>
<table class=tb>
<col class=cellC><col class=cellL>
<tr>
	<td>문의사항</td>
	<td><textarea name="inquiry" rows=3 cols=85></textarea></td>
</tr>
</table>

<div class=title>운영자정보</div>
<table class=tb>
<col class=cellC><col class=cellL><col class=cellC><col class=cellL>
<tr>
	<td>운영자명</td>
	<td><input type=text name=adminName required label="운영자명"></td>
	<td>전화</td>
	<td><input type=text name=adminPhone[] style="width:40px;" required label="운영자전화" onkeydown="onlynumber()">―<input type=text name=adminPhone[] style="width:40px;" required label="운영자전화" onkeydown="onlynumber()">―<input type=text name=adminPhone[] style="width:40px;" required label="운영자전화" onkeydown="onlynumber()"></td>
</tr>
<tr>
	<td>핸드폰</td>
	<td><input type=text name=adminMobile[] style="width:40px;" required label="운영자핸드폰" onkeydown="onlynumber()">―<input type=text name=adminMobile[] style="width:40px;" required label="운영자핸드폰" onkeydown="onlynumber()">―<input type=text name=adminMobile[] style="width:40px;" required label="운영자핸드폰" onkeydown="onlynumber()"></td>
	<td>이메일</td>
	<td><input type=text name=adminEmail class=lline required label="운영자이메일"></td>
</tr>
</table>

<div class="button" id="avoidSubmit">
<input type=image src="../img/btn_confirm.gif">
<a href="javascript:history.back()"><img src="../img/btn_cancel.gif"></a>
</div>

</form>


<div id=MSG01>
<table cellpadding=1 cellspacing=0 border=0 class=small_tip>
<tr><td><img src="../img/icon_list.gif" align="absmiddle">위 기재된 항목을 빠짐없이 기재해 주세요.</td></tr>
</table>
</div>
<script>cssRound('MSG01','#F7F7F7')</script>


<script language="javascript"><!--
function init_set()
{
	var fobj = document.forms['form'];
	fobj['compName'].value = '<?=$cfg[compName]?>';
	fobj['domain'].value = '<?=$cfg[shopUrl]?>';
	fobj['ceoName'].value = '<?=$cfg[ceoName]?>';
	fobj['compSerial'].value = '<?=str_replace("-","",$cfg[compSerial])?>';
	fobj['service'].value = '<?=$cfg[service]?>';
	fobj['item'].value = '<?=$cfg[item]?>';
	fobj['compPhone[]'][0].value = '<?$tmp = explode("-",$cfg[compPhone]); echo $tmp[ (count($tmp) - 3) ]?>';
	fobj['compPhone[]'][1].value = '<?=$tmp[ (count($tmp) - 2) ]?>';
	fobj['compPhone[]'][2].value = '<?=$tmp[ (count($tmp) - 1) ]?>';
	fobj['compFax[]'][0].value = '<?$tmp = explode("-",$cfg[compFax]); echo $tmp[ (count($tmp) - 3) ]?>';
	fobj['compFax[]'][1].value = '<?=$tmp[ (count($tmp) - 2) ]?>';
	fobj['compFax[]'][2].value = '<?=$tmp[ (count($tmp) - 1) ]?>';
	fobj['zipcode[]'][0].value = '<?=substr($cfg[zipcode],0,3)?>';
	fobj['zipcode[]'][1].value = '<?=substr($cfg[zipcode],3)?>';
	fobj['address'].value = '<?=$cfg[address]?>';
	fobj['road_address'].value = '<?=$cfg[road_address]?>';

	fobj['adminName'].value = '<?=$cfg[adminName]?>';
	fobj['adminPhone[]'][0].value = '<?=$tmp[ (count($tmp) - 3) ]?>';
	fobj['adminPhone[]'][1].value = '<?=$tmp[ (count($tmp) - 2) ]?>';
	fobj['adminPhone[]'][2].value = '<?=$tmp[ (count($tmp) - 1) ]?>';
	fobj['adminEmail'].value = '<?=$cfg[adminEmail]?>';
}

init_set();
--></script>


<? include "../_footer.php"; ?>