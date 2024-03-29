<?

### 데이콤 기본 세팅값
$_pg_mobile		= array(
			'id'	=> '',
			'zerofee'	=> 'no',
			'receipt'	=> 'N',
			'quota'		=> '0:2:3:4:5:6:7:8:9:10:11:12',
			);

$location = "결제모듈연동 > LG U+PG 설정";
include "../_header.popup.php";
include "../../conf/config.pay.php";
if ($cfg[settlePg]=="lgdacom"){
	@include "../../conf/pg_mobile.".$cfg['settlePg'].".php";
	@include "../../conf/pg.".$cfg['settlePg'].".php";
}

if (!function_exists('curl_init')) {
	$msg = "LG U+ XPay은 서버에 CURL Library가 설치되어 있어야 가능합니다.\\n고도에 문의 하시거나, 독립형의 경우 호스팅업체에 문의 하십시요.\\nCURL Library가 없는경우 데이콤 Noteurl 방식으로 설정 됩니다. ";
	echo("<script>alert('".$msg."');</script>");
	exit;
}

$pg_mobile = @array_merge($_pg_mobile,$pg_mobile);

if($cfg['settlePg']!="lgdacom") $pg_mobile = array(); //pg타입체크

if ($cfg['settlePg']=="lgdacom") $spot = "<b style='color:#ff0000;padding-left:10px'>[사용중]</b>";
$checked['ssl'][$pg_mobile['ssl']] = $checked['zerofee'][$pg_mobile['zerofee']] = $checked['cert'][$pg_mobile['cert']] = $checked['bonus'][$pg_mobile['bonus']] = "checked";
$checked['receipt'][$pg_mobile['receipt']] = "checked";
$checked['skin'][$pg_mobile['skin']] = "checked";
$checked['serviceType'][$pg_mobile['serviceType']] = "checked";

if ($set['use_mobile']['c']) $checked['c'] = "checked";
if ($set['use_mobile']['v']) $checked['v'] = "checked";
if ($set['use_mobile']['h']) $checked['h'] = "checked";

?>
<script language=javascript>

var arr=new Array('c','v','h');

function chkSettleKind(){
	var f = document.forms[0];

	var ret = false;
	for(var i=0;i < arr.length;i++)
	{
		var sk = document.getElementsByName('set[use_mobile]['+arr[i]+']')[0].checked;
		if(sk == true)ret=true;
	}
	var robj =  new Array('pg[id]','pg[mertkey]','pg[quota]');

	for(var i=0;i < robj.length;i++){
		var obj = document.getElementsByName(robj[i])[0];
		if(ret){
			obj.style.background = "#ffffff";
			obj.readOnly = false;
		}else{
			obj.style.background = "#e3e3e3";
			obj.readOnly = true;
		}
	}
}

function chkFormThis(f){

	var ret = false;
	var sk = false;
	var p_id = document.getElementsByName('pg[id]')[0];
	var p_key =  document.getElementsByName('pg[mertkey]')[0];
	var p_quota = document.getElementsByName('pg[quota]')[0];
	for(var i=0;i < arr.length;i++)
	{
		sk = document.getElementsByName('set[use_mobile]['+arr[i]+']')[0].checked;
		if(sk == true)ret=true;
	}

	if(!p_id.value && ret){
		p_id.focus();
		alert('LG U+ ID는 필수항목입니다.');
		return false;
	}
	if(!p_key.value && ret){
		p_key.focus();
		alert('LG U+ mertkey는 필수항목입니다.');
		return false;
	}
	if(!p_quota.value && ret){
		p_quota.focus();
		alert('일반할부기간은 필수항목입니다.');
		return false;
	}
	if(!chkPgid()){
		alert('LG U+ ID가 올바르지 않습니다.');
		return false;
	}
	return chkForm(f);
}
var IntervarId;

function resizeFrame()
{

	var oBody = document.body;
	var oFrame = parent.document.getElementById("pgifrm");
	var i_height = oBody.scrollHeight + (oFrame.offsetHeight-oFrame.clientHeight);
	oFrame.style.height = i_height;

	if ( IntervarId ) clearInterval( IntervarId );
}

var oldId = "<?php echo $pg_mobile['id'];?>";
function openPrefix(){
	if(chkPgid()){
		alert("정상적인 LG U+ ID입니다.\n개별 승인 신청이 필요 없습니다.\n창을 닫고 LG U+ ID를 입력하세요!");
		return;
	}
	var obj = document.getElementById('prefix');
	var pgid = document.getElementById('pgid').value;
	var ifrm = document.getElementById('pgifrm');
	get_pginfo(pgid);
	obj.className = 'show';
}
function closePrefix(){
	var obj = document.getElementById('prefix');
	document.getElementById('pgid').value='';
	obj.className = 'hide';
}
function get_pginfo(pgid){
	var ajax = new Ajax.Request( "../../proc/pginfo.indb.php",
	{
		method: "post",
		parameters: "mode=getPginfo&pgtype=lgdacom&mobilepg=y&pgid="+pgid,
		onComplete: function ()
		{
			var req = ajax.transport;
			if (req.status != 200) return;
			if (req.responseText =='') return;
			var ifrm = document.getElementById('pgifrm');
			ifrm.src = req.responseText;
		}
	} );
}
function chkPgid(){
	var obj = document.getElementById('pgid');
	var pattern = /^(go_|fp_|fd_)/;
	if(pattern.test(obj.value) || (oldId == obj.value && oldId)){
		return true;
	}else if(obj.value){
		return false;
	}
	return true;
}

window.onload = function(){
	resizeFrame();
	chkPgid();
}
</script>
<style>
.show {display:block}
.hide {display:none}
</style>
<div style="postion:relative">
<div id="prefix" style="position:absolute;" class="hide">
<iframe id="pgifrm" frameborder="0" width="554" height="366"></iframe>
</div>
</div>

<div id="MSG01">
<table cellpadding="1" cellspacing="0" border="0" class="small_ex">
<tr><td>LG U+ 모바일결제수단을 구매자에게 제공하기 위해서는 쇼핑몰(상점)의 LG U+ 아이디를 추가로 발급 받으셔야 합니다.</td></tr>
<tr><td>모바일결제용 아이디 발급 순서는 아래와 같습니다.  [모바일결제 아이디 신청 상세안내]</td></tr>
<tr><td>신규 가맹점 : ①신규계약 진행 ②모바일결제용 아이디 추가 온라인 신청 ③모바일결제용 아이디 추가 신청서 제출</td></tr>
<tr><td>기존 가맹점 : ①모바일결제용 아이디 추가 온라인 신청 ②모바일결제용 아이디 추가 신청서 제출</td></tr>
</table>
</div>
<script>cssRound('MSG01')</script>

<div style="padding-top:15px"></div>

<div class="title title_top">
LG U+ 모바일결제 설정<span>전자결제(PG)사로부터 제공받은 모바일결제 정보를 설정하여 구매자에게 신용카드 등의 모바일 결제수단을 제공할 수 있습니다.</span><a href="javascript:manual('<?=$guideUrl?>board/view.php?id=basic&no=8')"><img src="../img/btn_q.gif" border=0 align="absmiddle"></a>
</div>

<form method="post" action="indb.pg.php" enctype="multipart/form-data" onsubmit="return chkFormThis(this);">
<input type="hidden" name="mode" value="setPg">
<input type="hidden" name="cfg[settlePg]" value="lgdacom">

<table border="1" bordercolor="#e1e1e1" style="border-collapse:collapse" width="100%">
<col class="cellC"><col class="cellL">
<tr>
	<td>PG사</td>
	<td><b>LG U+ (XPay 1.0 - 결제창2.0) <?=$spot?></b></td>
</tr>
<tr>
	<td>모바일샵용<br/>결제수단 설정</td>
	<td class="noline">
	<input type="checkbox" name="set[use_mobile][c]" <?=$checked['c']?> onclick="chkSettleKind();"> 신용카드
	<input type="checkbox" name="set[use_mobile][v]" <?=$checked['v']?> onclick="chkSettleKind();"> 가상계좌
	<input type="checkbox" name="set[use_mobile][h]" <?=$checked['h']?> onclick="chkSettleKind();"> 휴대폰
	&nbsp;&nbsp;&nbsp;<font class="extext"><b>(반드시 LG U+PG사와 계약한 결제수단만 체크하세요)</b></font></td>
</tr>
<tr>
	<td class="ver8"><b>모바일샵용<br/>LG U+ ID</td>
	<td>
	<div style="float:left"><input type="text" name="pg[id]" class="lline" value="<?=$pg_mobile[id]?>" onkeyup="chkPgid()" onblur="chkPgid()" id="pgid"></div>
	<div style="float:left;padding:0 0 0 5" id="btPgId"><a href="javascript:openPrefix();"><img src="../img/pginfo.gif" alt="개별 승인 신청" /></a></div>
	<div style="clear:both" class="extext">LG U+ ID는 ‘go, fp, fd’로 시작되는 아이디만 입력 가능합니다. (단, 기존 입력값은 무방합니다)</div>
	<div class="extext">고도몰 솔루션 이용자중 이전 버전을 사용하고 있어 위의 아이디로 시작하지 않는 경우에는 개별 승인 신청을 하셔야 합니다.</div>
	</td>
</tr>
<tr>
	<td class="ver8"><b>모바일샵용<br/>LG U+ mertkey</td>
	<td>
	<input type="text" name="pg[mertkey]" class="lline" value="<?=$pg_mobile['mertkey']?>">
	</td>
</tr>
<tr>
	<td>일반할부기간</td>
	<td>
	<input type="text" name="pg[quota]" value="<?=$pg_mobile['quota']?>" class="lline">
	<span class="extext">ex) <?=$_pg_mobile['quota']?></span>
	</td>
</tr>
<tr>
	<td>무이자 여부</td>
	<td class="noline">
	<input type="radio" name="pg[zerofee]" value="no" checked> 일반결제
	<input type="radio" name="pg[zerofee]" value="yes" <?=$checked['zerofee']['yes']?>> 무이자결제 <font class="extext"><b>(무이자결제는 반드시 PG사와 계약체결 후에 사용해야 합니다!)</b></font>
	</td>
</tr>
<tr>
	<td>무이자 기간</td>
	<td>
	<input type="text" name="pg[zerofee_period]" value="<?=$pg_mobile['zerofee_period']?>" class="lline" style="width:500px">
	<a href="javascript:popupLayer('../basic/popup.dacom.php',500,470)" style="color:#616161;" class="ver8"><img src="../img/btn_carddate.gif" align="absmiddle"></a>
	<div class="extext" style="padding-top:4px">오른쪽에 있는 '무이자기간코드생성' 버튼을 눌러 코드를 생성한후 복사하여 사용하세요</div>
	</td>
</tr>
<tr>
	<td>결제창 색상</td>
	<td class="noline">
	<input type="radio" name="pg[skin]" value="red" <?=$checked['skin']['red']?>> Red
	<input type="radio" name="pg[skin]" value="blue" <?=$checked['skin']['blue']?>> Blue
	<input type="radio" name="pg[skin]" value="cyan" <?=$checked['skin']['cyan']?>> Cyan
	<input type="radio" name="pg[skin]" value="green" <?=$checked['skin']['green']?>> Green
	<input type="radio" name="pg[skin]" value="yellow" <?=$checked['skin']['yellow']?>> Yellow
	</td>
</tr>
<input type="hidden" name="pg[serviceType]" value="service">
<!--<tr>
	<td>서비스 타입</td>
	<td class="noline">
	<input type="radio" name="pg[serviceType]" value="service" <?=$checked['serviceType']['service']?>> service
	<input type="radio" name="pg[serviceType]" value="test" <?=$checked['serviceType']['test']?>> test
	</td>
</tr>-->
</table>

<div style="padding-top:15px"></div>

<div id="MSG02">
<div class="small_ex">LG U+에 신청한 모바일결제수단 중 모바일샵에서 이용하고자하는 모바일결제수단을 체크 한 후</div>
<div class="small_ex">LG U+로부터 제공받은 모바일결제용 ID와 KEY 정보를 입력하고 저장하세요.</div>
<div class="small_ex">설정 후 반드시 모바일샵에서 신용카드 등의 결제수단으로 정상적으로 결제가 이루어지는 테스트 해 주세요.</div>
<div style="font:0;height:5px;"></div>
<div class="small_ex">※ LG U+ PG사에서 제공하는 상점관리자 설정 유의사항 - <a href="javascript:popup('http://guide.godo.co.kr/guide/php/ex_dacom_pg.html',830,680)"><img src="../img/btn_dacompg_sample.gif" align="absmiddle"></a></div>
<div class="small_ex">① LG U+ 상점관리자에서 '승인결과전송여부'와 '서버OS타입'을 아래와 같이 수정하세요. </div>
<div class="small_ex">'승인결과전송여부' 설정은 '전송(결제창2.0)' 으로 설정하시고, '서버OS타입'은 'LINUX계열'로 설정을 수정해 주시기 바랍니다. </div>
<div class="small_ex">② 위 사항을 모두 수정하고 1시간 후에 쇼핑몰에서 신용카드결제 테스트를 해보셔야 수정된 결과가 반영되어 정상적으로 결제가 이루어집니다.</div>
</div>
<script>cssRound('MSG02')</script>

<div class="title">현금영수증 <!--span>설정된 PG사의 현금영수증을 사용하며, 별도 계약 필요없음</span--> <a href="javascript:manual('<?=$guideUrl?>board/view.php?id=basic&no=8')"><img src="../img/btn_q.gif" border=0 align="absmiddle"></a></div>
<table border="1" bordercolor="#e1e1e1" style="border-collapse:collapse" width="100%">
<col class="cellC"><col class="cellL">
<tr>
	<td>현금영수증</td>
	<td class="noline">
	<div>
	<?if($pg['receipt']=='N'):?>
	미사용
	<?else:?>
	사용
	<?endif;?>
	<input type="hidden" name="pg[receipt]" value="<?=$pg[receipt]?>">
	</div>
	<div class="extext">모바일샵에서 구매한 고객에게 현금영수증 제공 여부입니다.</div>
	<div class="extext">쇼핑몰 기본관리 > 통합 전자결제 설정 > LG U+에서 설정한</div>
	<div class="extext">현금영수증 사용여부 설정과 동일합니다. <a class="extext" style="font-weight:bold" href="http://ecredit.lgdacom.net/renewal/html/AddiService/addser03.htm" target="_blank">[바로가기]</a></font></div>
	</td>
</tr>
</table><p>


<div id="MSG03">
<table cellpadding="1" cellspacing="0" border="0" class="small_ex">
<tr><td><img src="../img/icon_list.gif" align="absmiddle">현금영수증</font>
<tr><td><img src="../img/icon_list.gif" align="absmiddle">소비자는 2008. 7. 1일부터 현금영수증 발급대상금액이 5천원이상에서 1원이상으로 변경되어
5천원 미만의 현금거래도 현금영수증을 요청하여 발급 받을 수 있습니다.</td></tr>
<tr><td><img src="../img/icon_list.gif" align="absmiddle">현금영수증 사용 체크시 무통장, 가상계좌 결제에 대해서 소비자가 신청한 현금영수증이 발급 됩니다</td></tr>
</table>
</div>
<script>cssRound('MSG03')</script>

<div class="button">
<input type=image src="../img/btn_save.gif">
<a href="javascript:history.back()"><img src="../img/btn_cancel.gif"></a>
</div>

</form>

<script>chkSettleKind();</script>