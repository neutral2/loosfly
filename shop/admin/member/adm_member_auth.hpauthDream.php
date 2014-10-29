<?
$location = '회원관리 > 본인확인 인증서비스 > 휴대폰본인확인 관리';
include '../_header.php';


$config = Core::loader('config');
$dreamsecurity = Core::loader('Dreamsecurity');

$shopConfig = $config->load('config');
$hpauthDreamCfg = $config->load('hpauthDream');
$dreamsecurityPrefix = $dreamsecurity->lookupPrefix();

$checked = array(
    'useyn' => array($hpauthDreamCfg['useyn'] => ' checked="checked"'),
    'minoryn' => array($hpauthDreamCfg['minoryn'] => ' checked="checked"'),
);

?>

<form name="frmField" method="post" action="adm_member_auth.hpauthDream.indb.php" onsubmit="return checkForm()">
<form action="<?php echo $shopConfig['rootDir']; ?>/admin/basic/adm_member_auth.hpauthDream.indb.php" method="post" onsubmit="return checkForm();">


<div class="title title_top">휴대폰본인확인 관리<span>휴대폰 본인확인 서비스에 필요한 정보를 설정 합니다. </span> <a href="javascript:manual('<?=$guideUrl?>board/view.php?id=member&no=21')"><img src="../img/btn_q.gif" border="0" align="absmiddle"></a></div>

<table border="4" bordercolor="#dce1e1" style="border-collapse:collapse" width="730">
<tr><td style="padding:7px 0px 10px 10px">
<div style="padding-top:5px; color:#666666; font-weight:bold;" class="g9"><b>※ 휴대폰 본인확인에 대한 안내입니다. 꼭 읽어보세요.</b></div>
<div style="padding-top:10px; color:#666666;" class="g9">① 휴대폰 본인확인 서비스를 제공하는 (주)드림시큐리티의 신청서를 작성합니다.</div>
<div style="padding-top:3px; color:#666666;" class="g9">② (주)드림시큐리티의 주소는 "서울시 송파구 문정동 150-28 서결빌딩 5층 (주)드림시큐리티 고도몰 서비스 담당자 앞" 입니다.</div>
<div style="padding-top:3px; color:#666666;" class="g9">③ 접수 및 승인 후 상담원이 가입 및 상품결제에 대한 안내 전화를 드립니다.</div>
<div style="padding-top:3px; color:#666666;" class="g9">④ (주)드림시큐리티에서 발급 받으신 코드를 아래 기입란에 입력하고 등록버튼을 누릅니다.</div>
<div style="padding-top:3px; color:#666666;" class="g9">⑤ 적용 후 쇼핑몰에서 본인확인이 정상 작동 하는지 확인 하세요.</div>
<div style="padding-top:3px; color:#666666;" class="g9">⑥ ※ 가입 및 이용 문의 : 1899-4134 (주)드림시큐리티 </div>
<div style="padding-top:3px; color:#666666;" class="g9">[신청서는 본인확인 인증서비스 안내 > 휴대폰 본인확인 안내에서  신청서  다운로드 해주시면 됩니다.]</div>
</td></tr>
</table>

<div style="padding-top:10"></div>

<table class="tb">
<col class="cellC"><col class="cellL">
<tr height="28">
	<td>회원사 Code</td>
	<td><input type=text name="cpid" id="cpid" class="line" value="<?=$hpauthDreamCfg['cpid']?>"> 
	<span class="extext">드림시큐리티에서 상점별로 발급되는 아이디 입니다.(<?php echo implode(',', $dreamsecurityPrefix); ?>로 시작되어야 함)</span></td>
</tr>
<tr height="28">
	<td style="width:150;">휴대폰 본인 확인 사용 여부</td>
	<td class="noline">
		<input type="radio" name="useyn" id="use_y" value="y" <?=$checked['useyn']['y']?> onclick="setDisabled()"> 사용
		<input type="radio" name="useyn" id="use_n" value="n" <?=$checked['useyn']['n']?> onclick="setDisabled()"> 사용안함
	</td>
</tr>
<tr height="28">
	<td>성인 인증 여부</td>
	<td class="noline">
	<input type="radio" name="minoryn" value="y" <?=$checked['minoryn']['y']?>> 사용 <font class="extext">(19세 미만 회원가입 불가)</font>
	&nbsp;&nbsp;<input type="radio" name="minoryn" value="n" <?=$checked['minoryn']['n']?>> 사용안함
	</td>
</tr>
</table>

<div class="button"><input type="image" src="../img/btn_register.gif"> <a href="javascript:history.back()"><img src="../img/btn_cancel.gif"></a></div>

</form>


<div id="MSG01">
<table cellpadding="1" cellspacing="0" border="0" class="small_ex">
<tr><td><img src="../img/icon_list.gif" align="absmiddle">휴대폰 본인확인서비스가 될 수 있도록 프로그램이 기본탑재 되어 있습니다. </td></tr>
<tr><td><img src="../img/icon_list.gif" align="absmiddle">휴대폰 본인확인서비스를 하기 위해서는 (주)드림시큐리티와 계약만 진행하시면 됩니다. </td></tr>
<tr><td><img src="../img/icon_list.gif" align="absmiddle">휴대폰 본인확인서비스 제공업체: <a href="http://www.dreamsecurity.com/" target="_new"><font color="white">(주)드림시큐리티 <font class="ver7">(http://www.dreamsecurity.com)</font></a>
</font></td></tr>
</table>

<table cellpadding="1" cellspacing="0" border="0" class="small_ex">
<tr><td height="20"></td></tr>
<tr><td><font class="def1" color="white">[필독] 휴대폰 본인확인서비스 절차 </b></font></td></tr>
<tr><td><font class="def1" color="white">①</font> 휴대폰 본인확인 서비스를 제공하는 (주)드림시큐리티의 신청서를 작성하여 발송합니다.</td></tr>
<tr><td>(주)드림시큐리티의 주소 "서울시 송파구 문정동 150-28 서경빌딩 5층 (주)드림시큐리티 고도몰 서비스 담당자 앞"</td></tr>
<tr><td><font class="def1" color="white">②</font> (주)드림시큐리티의 담당자로부터 회원사Code를 발급 받으시게 됩니다.</td></tr>
<tr><td><font class="def1" color="white">③</font> 발급 받으신 회원사Code를 본 페이지에 입력하세요.</td></tr>
<tr><td><font class="def1" color="white">④</font> 쇼핑몰에서 본인확인이 정상 작동 하는지 확인 하세요.</td></tr>
</table>
</div>

<script>
	function setDisabled() {
		var fm = document.frmField;
	}

	function checkForm(f) {
		if($('use_y').checked) {
			if(!$('cpid').value) {
				alert("회원사 Id를 입력하셔야 사용 가능한 서비스입니다.");
				return false;
			}
		}

		return true;
	}

	window.onload = function() {
		cssRound('MSG01');
		setDisabled();
	}
</script>

<? include "../_footer.php"; ?>