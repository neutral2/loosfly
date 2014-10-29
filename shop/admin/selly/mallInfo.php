<?
/*********************************************************
* 파일명     :  mallInfo.php
* 프로그램명 :  마켓 등록/수정
* 작성자     :  이훈
* 생성일     :  2012.05.24
**********************************************************/
/*********************************************************
* 수정일     :  
* 수정내용   :  
**********************************************************/
$location = "셀리 > 마켓 등록";
$minfo_idx = $_GET['minfo_idx'];

if($minfo_idx) {
	include "../_header.popup.php";
	$reload = 'self.close();';
}
else {
	include "../_header.php";
	$reload = 'location.reload()';
}
include "../../lib/sAPI.class.php";

$sAPI = new sAPI();
$grp_cd = Array("grp_cd"=>"MALL_CD");
$arr_mall_cd = $sAPI->getCode($grp_cd, 'hash');

$checked['status']['Y'] = 'checked';

if($minfo_idx) {//마켓 수정
	$arr_mall_info_data = Array('minfo_idx' => $minfo_idx);
	$arr_mall_info = $sAPI->getMallInfo($arr_mall_info_data);
	$mall_info = $arr_mall_info[0];

	$selected['mall_cd'][$mall_info['mall_cd']] = 'selected';
	if($mall_info['mall_cd'] != 'mall0001') $display['mall0001'] = 'style="display:none"';
	if($mall_info['mall_cd'] != 'mall0007')  $display['mall0007'] = 'style="display:none"';
	$checked['status'][$mall_info['status']] = 'checked';
	$mode = 'modify';

	### 마켓 비밀번호 복호화 ###
	$mall_pwd = rawurldecode($mall_info['mall_login_pwd']);

	$cust_cd_query = $db->_query_print('SELECT * FROM gd_env WHERE category=[s] AND name=[s]', 'selly', 'cust_cd');
	$res_cust_cd = $db->_select($cust_cd_query);
	$cust_cd = $res_cust_cd[0]['value'];

	$mall_login_pwd = $sAPI->xcryptare($mall_pwd, $cust_cd, false);
}



if($_POST['ticket']) {
	$ticket = $_POST['ticket'];
	$data['mall_cd'] = 'mall0001';
}
else {
	$ticket = $mall_info['etc2'];
}

if(!$mode) $mode = 'register';

?>

<script src="js/selly.js"></script>

<script>

function settingForm(mall_cd) {
	if(mall_cd == 'mall0001') {
		document.getElementById('security_ticket').style.display = '';
	}
	else {
		document.getElementById('security_ticket').style.display = 'none';
	}

	if(mall_cd == 'mall0007') {
		document.getElementById('api_id').style.display = '';
	}
	else {
		document.getElementById('api_id').style.display = 'none';
	}
}

function auctionTicket() {
	var fm = document.frm_ticket;
		fm.target = "_self";
		fm.action = "https://memberssl.auction.co.kr/API/Login/WebServiceLogin2.aspx";
		fm.submit();
		return;
}

function scmLoginTest() {
	var mall_cd = document.getElementsByName('mall_cd')[0].value;
	var mall_login_id = document.getElementsByName('mall_login_id')[0].value;
	var mall_login_pwd = document.getElementsByName('mall_login_pwd')[0].value;
	var security_ticket = document.getElementsByName('etc2')[0].value;
	var api_id = document.getElementsByName('etc5')[0].value;
	
	if(!mall_cd || !mall_login_id || !mall_login_pwd) {
		alert('로그인정보를 입력해 주세요.');
		return;
	}

	if(mall_cd == 'mall0001' && !security_ticket) {
		alert('인증티켓을 받으신 후 다시 시도해 주세요.');
		return;
	}

	if(mall_cd == 'mall0007' && !api_id) {
		alert('API ID를 입력해 주세요.');
		return;
	}

	if(mall_cd != 'mall0007') api_id = '';


	if(mall_cd != 'mall0001') {
		security_ticket = '';
	}

	sellyLink.checkMallLogin(mall_cd, mall_login_id, mall_login_pwd, security_ticket, api_id);
}

function successAjax(data) {//결과처리
	var json_data = eval( '(' + data + ')' );

	if(json_data['code'] == '000') {//링크상태별 처리성공
		alert(json_data['msg']);
		document.getElementsByName('check_mall_login')[0].value = 'Y';
		if(json_data['reload'] == 'Y') <?=$reload?>;
		return;
	}
	else {
		alert(json_data['msg']);
		document.getElementsByName('check_mall_login')[0].value = 'N';
		return;
	}
}

function submitForm() {
	var check_mall_login = document.getElementsByName('check_mall_login')[0].value;
	if(check_mall_login != 'Y') {
		alert('SCM 로그인 테스트가 성공하지 않았습니다.');
		return;
	}

	var mall_cd = document.getElementsByName('mall_cd')[0].value;
	var mall_login_id = document.getElementsByName('mall_login_id')[0].value;
	var mall_login_pwd = document.getElementsByName('mall_login_pwd')[0].value;
	var status = document.getElementsByName('status')[0].value;
	var security_ticket = document.getElementsByName('etc2')[0].value;
	var type = document.getElementsByName('type')[0].value;
	var minfo_idx = document.getElementsByName('minfo_idx')[0].value;
	var api_id = document.getElementsByName('etc5')[0].value;

	if(!mall_cd || !mall_login_id || !mall_login_pwd) {
		alert('로그인정보를 입력해 주세요.');
		return;
	}

	if(mall_cd != 'mall0001') {
		security_ticket = '';
	}

	if(mall_cd != 'mall0007') api_id = '';

	sellyLink.insMall(mall_cd, mall_login_id, mall_login_pwd, security_ticket, status, type, minfo_idx, api_id);
}

function mallList() {
	location.replace("mallList.php");
}

window.onload = function(){
	table_design_load();
	if(document.getElementsByName('mall_cd')[0].value != 'mall0007') document.getElementById('api_id').style.display = 'none';
}

</script>

<form name="frmList">
	<input type="hidden" name="check_mall_login" value="N">
	<input type="hidden" name="type" value="<?=$mode?>">
	<input type="hidden" name="minfo_idx" value="<?=$minfo_idx?>">
	<div class="title title_top">마켓 등록<span>SELLY에서 링크 서비스가 가능한 마켓 로그인 정보를 등록하실 수 있습니다.</span> <a href="javascript:manual('<?=$guideUrl?>board/view.php?id=product&no=2')"><img src="../img/btn_q.gif" border="0" align="absmiddle" hspace="2"></a></div>

	<table class="tb">
		<col class="cellC" style="width:100px;"><col class="cellL">
		<tr>
			<td>마켓</td>
			<td>
				<select name="mall_cd" onchange="settingForm(this.value);">
				<? foreach($arr_mall_cd as $key => $val) { ?>
					<? if($key == 'mall0005') continue; ?>
					<option value="<?=$key?>" <?=$selected['mall_cd'][$key]?>><?=$val?></option>
				<? } ?>
				</select>
			</td>
		</tr>
		<tr id="security_ticket" <?=$display['mall0001']?>>
			<td>인증티켓</td>
			<td>
				<input type="text" id="etc2" name="etc2" value="<?=$ticket?>" class="line" readonly style="height:22px; width:300px;">
				<img src="../img/btn_ticket.gif" align="absbottom" onclick="auctionTicket();" style="cursor:pointer;" alt="인증티켓 받기">
			</td>
		</tr>
		<tr id="api_id" <?=$display['mall0007']?>>
			<td>API ID</td>
			<td>
				<input type="text" id="etc5" name="etc5" value="<?=$mall_info['etc5']?>" class="line" style="height:22px; width:300px;">
			</td>
		</tr>
		<tr>
			<td>로그인ID</td>
			<td>
				<input type="text" name="mall_login_id" value="<?=$mall_info['mall_login_id']?>" class="line" style="height:22px">
			</td>
		</tr>
		<tr>
			<td>로그인 비밀번호</td>
			<td>
				<input type="password" name="mall_login_pwd" value="<?=$mall_login_pwd?>" class="line" style="height:22px">
				<img src="../img/btn_scmlogin_test.gif" align="absbottom" onclick="scmLoginTest();" style="cursor:pointer;" alt="SCM 로그인 테스트">
			</td>
		</tr>
		<tr>
			<td>사용여부</td>
			<td class=noline>
				<label><input type="radio" name="status" value="Y" <?=$checked['status']['Y']?>>사용</label>
				<label><input type="radio" name="status" value="N" <?=$checked['status']['N']?>>미사용</label>
			</td>
		</tr>
	</table>
	<div class="button_top">
		<input type="image" src="../img/btn_<?=$mode?>.gif" alt="등록/수정" onclick="submitForm();return false;" />
		<? if(!$minfo_idx) { ?>
			<input type="image" src="../img/btn_list.gif" alt="목록" onclick="mallList();return false;" />
		<? } ?>
	</div>
</form>

<?
	$return_url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];

	if($minfo_idx) $return_url = $return_url.'?minfo_idx='.$minfo_idx;
?>
<form name="frm_ticket" action="https://memberssl.auction.co.kr/API/Login/WebServiceLogin2.aspx" method="post" target="_self">
	<input type="hidden" value="godomall" name="DevID" />
	<input type="hidden" value="godoselly" name="AppID" />
	<input type="hidden" value="rhehahf" name="AppPassword" />
	<input type="hidden" value="<?=$return_url?>" name="ReturnUrl" size=100>
</form>
<? if(!$minfo_idx) {?>
<div id="MSG01">
<table cellpadding="1" cellspacing="0" border="0" class="small_ex">
<tr><td height="5"></td></tr>
<tr><td>
SELLY에서 링크 서비스가 가능한 마켓 로그인 정보를 등록해 주세요.<br/>
SCM 로그인 테스트가 성공 되어야 등록이 가능합니다.<br/>
로그인 비밀번호는 SELLY의 자체 암호화를 통해 저장 되오니 안심하시고 사용하시기 바랍니다.<br/><br/><br/>

옥션 SCM로그인 테스트 실패시 옥션에서 출하지와 판매자 묶음배송비가 설정되었는지 확인해 보세요.<br/>
확인방법 : 옥션 판매관리 > 고정가 물품관리 > 신규물품등록 > 상품등록페이지<br/>
등록하려는 마켓에서 휴대폰인증 및 비밀번호변경을 요구하는 페이지가 나오면 SCM로그인테스트시 실패되니 인증 및 변경을 하신 후 SCM로그인테스트를 시도하시면 됩니다.<br/><br/><br/>

네이버샵N API ID 발급방법 : API ID는 [네이버 샵N 판매자센터 > 내정보관리 > 정보 조회/수정]에서 발급받으실 수 있으며 발급받으신 API ID를 입력해 주시면 됩니다.<br/>
API ID를 미입력시 SCM 로그인 테스트가 실패됩니다.
</td></tr>
</table>
</div>
<script>cssRound('MSG01')</script>
<? } ?>
<? if(!$minfo_idx) include "../_footer.php"; ?>