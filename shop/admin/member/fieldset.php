<?

$location = "회원관리 > 회원가입관리";
include "../_header.php";
include "../../conf/fieldset.php";
@include "../../conf/mobile_fieldset.php";

$fld	= array(
	'def'	=> array(
		"m_id"			=> "아이디",
		"password"		=> "비밀번호",
		"name"			=> "이름",
	),
	'per'	=> array(
		"nickname"		=> "닉네임",
		"email"			=> "이메일",
		"resno"			=> "주민등록번호",
		"sex"			=> "성별",
		"birth"			=> "생년월일",
		"calendar"		=> "양/음력",
		"address"		=> "주소",
		"phone"			=> "전화번호",
		"mobile"		=> "핸드폰",
		"fax"			=> "팩스번호",
		"company"		=> "회사명",
		"service"		=> "업태",
		"item"			=> "종목",
		"busino"		=> "사업자번호",
		"mailling"		=> "메일링",
		"sms"			=> "SMS 수신",
		"marriyn"		=> "결혼여부",
		"marridate"		=> "결혼기념일",
		"job"			=> "직업",
		"interest"		=> "관심분야",
		"memo"			=> "남기는말씀",
		"recommid"		=> "추천인",
		"ex1"			=> "추가1",
		"ex2"			=> "추가2",
		"ex3"			=> "추가3",
		"ex4"			=> "추가4",
		"ex5"			=> "추가5",
		"ex6"			=> "추가6",
	),
);
?>

<script>

function chkBox2(El,mode,mode2)
{
	if (!El) return;
	for (i=0;i<El.length;i++){
		El[i].checked = (mode=='rev') ? !El[i].checked : mode;
		chk(El[i].key,mode2);
	}
}

function chk(obj,mode)
{
	var objUse = document.frmField["useField["+obj+"]"];
	var objReq = document.frmField["reqField["+obj+"]"];
	if (objReq.checked && mode=='req') objUse.checked = true;
	else if (objUse.checked==false && mode=='use') objReq.checked = false;
}

function chkBox2_mobile(El,mode,mode2)
{
	if (!El) return;
	for (i=0;i<El.length;i++){
		El[i].checked = (mode=='rev') ? !El[i].checked : mode;
		chk_mobile(El[i].key,mode2);
	}
}

function chk_mobile(obj,mode)
{
	var objUse = document.frmField["useMobileField["+obj+"]"];
	var objReq = document.frmField["reqMobileField["+obj+"]"];
	if (objReq.checked && mode=='req') objUse.checked = true;
	else if (objUse.checked==false && mode=='use') objReq.checked = false;
}
</script>

<form name="frmField" method="post" action="indb.php">
<input type="hidden" name="mode" value="fieldset" />

<div class="title title_top">회원가입 정책관리<span>회원가입에 필요한 각종 정책을 정합니다</span> <a href="javascript:manual('<?=$guideUrl?>board/view.php?id=member&no=3')"><img src="../img/btn_q.gif" border="0" hspace="2" align="absmiddle" /></a></div>
<table class="tb">
<col class="cellC"><col class="cellL">
<tr>
	<td>회원인증절차</td>
	<td class="noline">

	<div style="margin:5px 0px">
	<input type="radio" name="status" value="1" <?=( $joinset['status'] == '1' ? 'checked' : '' )?> />인증절차없음&nbsp;
	<input type="radio" name="status" value="0" <?=( $joinset['status'] != '1' ? 'checked' : '' )?> />관리자 인증 후 가입	<font class="extext">(관리자 승인 후 가입처리할 수 있습니다)</font>
	</div>

	<div style="margin:5px 2px">
	<span class="extext">* 네이버 체크아웃 부가서비스를 이용중일 경우 회원인증절차를 사용하실 수 없습니다.</span>
	</div>

	</td>
</tr>
<tr>
	<td>회원재가입기간</td>
	<td>
	<div style="padding-top:5"></div>
	회원탈퇴 및 회원삭제 후 <input type="text" name="rejoin" value="<?=$joinset['rejoin']?>" size="4" class="rline" /> 일 동안 재가입할 수 없습니다

	<div style="padding-top:5"></div>

	<table cellpadding="0" cellspacing="0" border="0">
	<tr><td height="5"></td></tr>
	<tr><td><font class="extext">아래 회원가입 항목 중에서 '주민등록번호'를 체크해야만 재가입 기간을 적용할 수 있습니다</font></td></tr>
	<tr><td style="padding: 2px 0px 0px 0px"><font class="extext">'회원탈퇴/삭제내역'에서 재가입여부를 확인할 수 있습니다.</td></tr>
	<tr><td height="5"></td></tr>
	</table>

	<div style="padding-top:5"></div>
	</td>
</tr>
<tr>
	<td>가입불가 ID</td>
	<td>
	<textarea name="unableid" style="width:100%;height:60px" class="tline"><?=$joinset['unableid']?></textarea>

	<table cellpadding="0" cellspacing="0" border="0">
	<tr><td height="5"></td></tr>
	<tr><td><img src="../img/icon_list.gif" align="absmiddle" /><font class="extext">회원가입을 제한할 ID를 입력하세요. 컴마로 구분합니다</font></td></tr>
	<tr><td><img src="../img/icon_list.gif" align="absmiddle" /><font class="extext">주요 제한 ID : </font><font class=ver7 color=627dce>admin,administration,administrator,master,webmaster,manage,manager</font></td></tr>
	<tr><td height="5"></td></tr>
	</table>

	</td>
</tr>
<tr>
	<td width=125>회원가입시 적립금지급</td>
	<td><input type="text" name="emoney" value="<?=$joinset['emoney']?>" size="10" class="rline" onkeydown="onlynumber();" /> 원 <font class="extext">(미적용시 0 원을 입력)</font></td>
</tr>
<tr>
	<td>회원가입시 쿠폰지급</td>
	<td>회원가입쿠폰을 제공하고 싶다면 <a href="../event/coupon_register.php" target=_blank><font class=extext_l>[쿠폰만들기]</font></a> 에서 쿠폰을 발행하세요. '회원가입자동발급' 방식으로 발급하세요</td>
</tr>
<tr>
	<td>가입시 회원그룹</td>
	<td>회원가입 후 바로 <select name="grp">
<?
foreach( member_grp() as $v ){
	echo '<option value="' . $v['level'] . '"' . ( $joinset['grp'] == $v['level'] ? 'selected' : '' ) . '>' . $v['grpnm'] . ' - lv[' . $v['level'] . ']</option>' . "\n";
}
?>
	</select> 그룹에 속하도록 합니다. <font class="extext">('회원그룹관리'에서 그룹을 만드세요) &nbsp;<a href="../member/group.php" target="_new"><font class="extext_l">[그룹관리바로가기]</font></a></td>
</tr>
<tr>
	<td>추천인 설정</td>
	<td>
	  <div>신규가입고객이 기입한 추천인에게 적립금 <input type="text" name="recomm_emoney" value="<?=$joinset['recomm_emoney']?>" size="10" class="rline" onkeydown="onlynumber();" /> 원 지급 <font class="extext">(미적용시 0 원을 입력)</font></div>
	  <div>신규가입시 추천인을 기입하면 적립금 <input type="text" name="recomm_add_emoney" value="<?=$joinset['recomm_add_emoney']?>" size="10" class="rline" onkeydown="onlynumber();" /> 원 추가 지급 <font class="extext">(미적용시 0 원을 입력)</font></div>

	</td>
</tr>
</table>




<div class="title">회원가입 항목관리<span>회원가입에 필요한 각종 항목 및 옵션을 정합니다</span> <a href="javascript:manual('<?=$guideUrl?>board/view.php?id=member&no=3')"><img src="../img/btn_q.gif" border="0" hspace="2" align="absmiddle" /></a></div>

<table border="4" bordercolor="#dce1e1" style="border-collapse:collapse;margin-bottom:20px;" width="100%">
<tr><td style="padding:7px 0 10px 10px; color:#666666;">
<div style="padding-top:5px;"><font class="g9" color="#0074BA"><b>※ 주민등록번호 수집 금지 안내</b></font></div>
<div style="padding-top:7px;"><b>정보통신망법 개정에 따라서 신규 주민등록번호 수집이 금지됩니다.(시행일자 : 2012년 8월 18일)</b></div>
<ol style="margin:7px 0 0 25px;">
<li>회원가입 항목 중 ‘주민등록번호(resno)’ 사용여부가 사용으로 체크되어 있으실 경우,  체크를 해지하시고 미사용으로 등록/저장하여 주셔야 합니다.</li>
<li>아이디/비밀번호 찾기시 주민등록번호 대체확인 수단인 ‘이메일(email)’ 항목은 반드시 사용 및 필수사항으로 선택하여 등록/저장하여 주세요!!</li>
</ol>
<div style="padding-top:10px;"><a href="http://www.godo.co.kr/news/notice_view.php?board_idx=725" target="_blank"><font class="small1" color="#0074BA"><b><u>[주민등록번호 미수집관련 안내 및 조치사항 자세히 보기]</u></b></font></a></div>
</table>

<table width="100%" border="1" bordercolor="#efefef" style="border-collapse:collapse">
<col width=200px><col width=150px><col width=150px><col width=150px><col width=150px>
<tr height="25" bgcolor="#f7f7f7">
	<th rowspan=2>필드명</th>
	<th colspan=2>PC용</th>
	<th colspan=2>모바일샵용<div><font class="g9" color="#0074BA"><b>모바일샵 회원가입시에는 회원인증을 제공하지 않습니다.</b></div></th>
</tr>
<tr height="25" bgcolor="#f7f7f7">
	
	<th width=130px><a href="javascript:void(0)" onclick="chkBox2(document.frmField.elements['chkUse[]'],'rev','use');">사용여부</a></th>
	<th width=130px><a href="javascript:void(0)" onclick="chkBox2(document.frmField.elements['chkReq[]'],'rev','req');">필수사항</a></th>
	<th width=130px><a href="javascript:void(0)" onclick="chkBox2_mobile(document.frmField.elements['chkMobileUse[]'],'rev','use');">사용여부</a></th>
	<th width=130px><a href="javascript:void(0)" onclick="chkBox2_mobile(document.frmField.elements['chkMobileReq[]'],'rev','req');">필수사항</a></th>
</tr>

<col align="center" width="20%" bgcolor="#f7f7f7"><col align="center" width="15%" span="2">

<tbody style="height:25">

<? while (list($key,$value)=each($fld['def'])){ ?>
<tr class=noline>
<!-- 	<? if ($key=="m_id"){ ?><td rowspan=<?=count($fld['def'])?> valign="top" style="padding-top:4px;">필수사항</td><? } ?> -->
	<td align=left style="padding-left:10px"><?=$value?></td>
	<td><input type="checkbox" name="useField[<?=$key?>]" checked disabled /> 사용</td>
	<td><input type="checkbox" name="reqField[<?=$key?>]" checked disabled /> 필수</td>
	<td><input type="checkbox" name="useMobileField[<?=$key?>]" checked disabled /> 사용</td>
	<td><input type="checkbox" name="reqMobileField[<?=$key?>]" checked disabled /> 필수</td>
</tr>
<? } ?>

<tr>
	<? $idx=0; while (list($key,$value)=each($fld['per'])){ ?>
	<? if (in_array( $key, array( 'ex1', 'ex2', 'ex3', 'ex4', 'ex5', 'ex6' ) ) ){?>
	<td><?=$value?> <input type="text" name="<?=$key?>" value="<?=$joinset[ $key ]?>" size="10" style="cline" /> <font class=ver7 color='3853a5'>(<?=$key?>)</font></td>
	<? } else { ?>
	<td align=left style="padding-left:10px"><?=$value?> (<font class=ver7 color='3853a5'><?=$key?></font>)</td>
	<? } ?>
	<td class="noline" width=130px><font class="def"><input type="checkbox" id="chkUse[]" name="useField[<?=$key?>]" <?=$checked['useField'][$key]?> key="<?=$key?>" onClick="chk('<?=$key?>','use');" /> 사용</td>
	<td class="noline" width=130px><font class="def"><input type="checkbox" id="chkReq[]" name="reqField[<?=$key?>]" <?=$checked['reqField'][$key]?> key="<?=$key?>" onClick="chk('<?=$key?>','req');" /> 필수</td>
	<td class="noline" width=130px><font class="def"><input type="checkbox" id="chkMobileUse[]" name="useMobileField[<?=$key?>]" <?=$checked_mobile['useField'][$key]?> key="<?=$key?>" onClick="chk_mobile('<?=$key?>','use');" /> 사용</td>
	<td class="noline" width=130px><font class="def"><input type="checkbox" id="chkMobileReq[]" name="reqMobileField[<?=$key?>]" <?=$checked_mobile['reqField'][$key]?> key="<?=$key?>" onClick="chk_mobile('<?=$key?>','req');" /> 필수</td>	
	</tr><tr>
	<? } ?>
</tr>
</table>

<div class="button">
<input type="image" src="../img/btn_register.gif" />
<a href="javascript:history.back();"><img src="../img/btn_cancel.gif" /></a>
</div>

</form>

	<div id="MSG02">
	<table cellpadding="1" cellspacing="0" border="0" class="small_ex">
	<tr><td><img src="../img/icon_list.gif" align="absmiddle" />회원가입시 입력하는 항목들을 정하는 곳입니다.</td></tr>
	<tr><td><img src="../img/icon_list.gif" align="absmiddle" />원하는 필드항목을 체크하고, 필수사항인지의 여부를 체크하시면 됩니다. 추가로 항목을 만드실 수도 있습니다.</td></tr>
	</table>
	</div>
	<script>cssRound('MSG02');</script>

<? include "../_footer.php"; ?>