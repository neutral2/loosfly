
<style>
.title2 {
	font-weight:bold;
	padding-bottom:5px;
}
</style>

<div class="title title_top">회원DB다운로드<span>회원검색다운로드, 항목체크다운로드 등 두가지 방법으로 회원DB를 다운로드 받으실 수 있습니다</span> <a href="javascript:popup('<?=$guideUrl?>board/view.php?id=data&no=5')"><img src="../img/btn_q.gif" border=0 align=absmiddle></a></div>

<div style="padding-top:15;"></div>

<form name=fm method=post action="../data/data_memberxls_indb.php" onsubmit="return chkForm(this)">

<div class=title2>&nbsp;&nbsp;&nbsp;<img src="../img/icon_process.gif" align=absmiddle><font class=def1 color=000000><b>회원검색으로 다운로드 받기</b></font> <font class=extext>(검색결과에 해당하는 회원만(기본항목) 다운로드합니다)</font></div>

<?
### 회원 검색폼
include "../member/_listForm.php";
?>

<div style="padding-top:7;"></div>

<div class=noline>
<table border=0 cellpadding=0 cellspacing=0>
<tr>
<!--<td><img src="../img/icon_list.gif" align=absmiddle><font color=0074BA>위 검색결과에 해당하는 상품만 다운로드 받을 수 있습니다.</font><br>
	- 다운받고자하는 상품을 검색조건에 입력하세요.<br>
	- 다운로드버튼을 누른 후 저장하시면 됩니다</td>
	<td widht=20></td>-->
<td width=127></td>
<td><input type="image" src="../img/btn_gooddown.gif" alt="회원DB다운로드"></td>
</tr></table>
</div>


<div style="padding-top:40;"></div>

<div class=title2>&nbsp;&nbsp;&nbsp;<img src="../img/icon_process.gif" align=absmiddle><font class=def1 color=000000><b>원하는 항목체크 후 다운로드 받기</b></font> <font class=extext>(원하는 항목을 체크한 후 다운로드합니다)</font></div>


<table class=tb>
<col class=cellC><col class=cellL>
<tr>
	<td>파일명</td>
	<td>
	<input type="text" name="filename" value="[<?=strftime( '%y년%m월%d일' )?>] 회원" size=40 required label="파일명"> <span class=small_tip>확장자(xls)를 제외한 파일명을 입력합니다.</span></td>
</tr>
<tr>
	<td>회원정렬방식</td>
	<td>
	<select name="sort">
	<option value="regdt desc" selected>- 가입일 정렬↑</option>
	<option value="regdt asc">- 가입일 정렬↓</option>
	<option value="last_login desc">- 최종로그인 정렬↑</option>
	<option value="last_login asc">- 최종로그인 정렬↓</option>
	<option value="cnt_login desc">- 방문수 정렬↑</option>
	<option value="cnt_login asc">- 방문수 정렬↓</option>
    <optgroup label="------------"></optgroup>
	<option value="name desc">- 이름 정렬↑</option>
	<option value="name asc">- 이름 정렬↓</option>
	<option value="m_id desc">- 아이디 정렬↑</option>
	<option value="m_id asc">- 아이디 정렬↓</option>
    <optgroup label="------------"></optgroup>
	<option value="emoney desc">- 적립금 정렬↑</option>
	<option value="emoney asc">- 적립금 정렬↓</option>
	<option value="sum_sale desc">- 구매금액 정렬↑</option>
	<option value="sum_sale asc">- 구매금액 정렬↓</option>
	</select>
	</td>
</tr>
<tr>
	<td>다운로드범위</td>
	<td>
	<div style="float:left;" class=noline><input type="radio" name="limitmethod" value="all" onclick="document.getElementById('part').style.display='none';"> 전체다운 &nbsp;&nbsp;&nbsp;
	<input type="radio" name="limitmethod" value="part" onclick="document.getElementById('part').style.display='block';" checked> 부분다운</div>
	<div style="float:left;margin-left:10;" id="part"><input type="text" name="limit[]" value="1" size="5" style="text-align:right;"> 명 ∼ <input type="text" name="limit[]" value="100" size="5" style="text-align:right;"> 명
	<font class=extext>회원이 너무 많을 경우에 사용</div>
	</td>
</tr>
<tr>
	<td valign="top" style="padding-top:4px;">항목(필드)체크</td>
	<td style="padding:5px;">
	<div style="padding-top:5;"></div>
	&nbsp;&nbsp;<font class=extext>아래 체크된 항목들은 기본항목입니다</font>
	<div style="padding-top:7;"></div>
	<style>
	#field_table { border-collapse:collapse; float:left; margin-right:10px; }
	#field_table th { padding:4; }
	#field_table td { border-style:solid;border-width:1;border-color:#EBEBEB;color:#4c4c4c;padding:4; }
	#field_table i { color:green; font:8pt dotum; }
	</style>
<?
$fields = parse_ini_file("../../conf/data_memberddl.ini", true);
$subcnt = ceil( count( $fields ) / 3 );

for ( $i = 0; $i < 3; $i++ ){

	$idx = 0;
	while( list ($key, $arr) = each ( $fields ) ){
		$idx++;

		if ( $idx == 1 ){?>
	<table id="field_table">
	<tr bgcolor="#eeeeee">
		<th bgcolor=F4F4F4><font class=small1 color=444444><b>한글필드명</b></th>
		<th bgcolor=F4F4F4><font class=small1 color=444444><b>영문필드명</th>
	</tr>
		<?}?>
	<tr bgcolor="<?=( $idx % 2 == 0 ? '#ffffff' : '#ffffff' )?>">
		<td><span class=noline><font class=def1 color=444444><input type="checkbox" name="field[]" value="<?=$key?>" <?=( $arr['down'] == 'Y' ? 'checked' : '' )?>></span> <?=$arr['text']?></td>
		<td width=80><font class=ver81><?=$key?></td>
	</tr>
		<?
		if ( $idx == $subcnt || current( $fields ) == null  ){
			echo '</table>';
			break;
		}
	}
}
?>
	</td>
</tr>
</table>

<div style="padding-top:7px"></div>
<div class=noline style="padding-left:127px;text-align:left;"><input type="image" src="../img/btn_gooddown.gif" alt="회원DB다운로드"></div>
</form>


<div style="padding-top:15px"></div>

<div id=MSG01>
<table cellpadding=2 cellspacing=0 border=0 class=small_ex>
<tr>
	<td><img src="../img/icon_list.gif" align=absmiddle>엑셀다운 사용순서</font>
	<ol style="margin-top:0px;margin-bottom:0px;">
	<li>확장자(xls)를 제외한 파일명을 입력합니다.</li>
	<li>다운로드범위에서 부분다운 할 경우 상품명수를 꼭! 입력</font>합니다.</li>
	<li>다운받을 항목(필드)을 선택합니다.</li>
	<li>[다운로드] 버튼 클릭</li>
	</ol>
	</td>
</tr>
</table>
</div>
<script>cssRound('MSG01')</script>
