<?php
// INIpay 기본 세팅값
$_pg		= array(
			'zerofee'	=> 'no',
			'receipt'	=> 'N',
			'quota'		=> '선택:일시불:2개월:3개월:4개월:5개월:6개월:7개월:8개월:9개월:10개월:11개월:12개월',
			'skin'		=> 'ORIGINAL',
			);
$_escrow	= array(
			'use'		=> 'N',
			'min'		=> 50000,
			);

$location	= "결제모듈연동 > 이니시스PG 설정";
include "../_header.popup.php";
include "../../conf/config.pay.php";

// PHP 버전 체크
if (substr(phpversion(),0,1) < 5) {
	$msg = "INIPay TX5 모듈은 PHP 버전 5 이상에서 동작을 합니다.\\n고도에 문의 하시거나, 독립형의 경우 호스팅업체에 문의 하십시요.\\nPHP 버전이 4인 경우 INIPay TX4 모듈 방식으로 설정 됩니다.";
	echo("<script>alert('".$msg."');parent.chgifrm('inicis.php',3);</script>");
}

// INIpay 설정값 처리
if ($cfg['settlePg']=="inipay"){
	include "../../conf/pg.".$cfg['settlePg'].".php";
	include "../../conf/pg.escrow.php";
} else {
	if (is_file("../../conf/pg.inipay.php")) {
		include "../../conf/pg.inipay.php";
	}
}

// 설정값 통합
$pg		= array_merge($_pg, (array)$pg);
$escrow	= array_merge($_escrow, (array)$escrow);

// 사용중 체크
if ($cfg['settlePg']=="inipay" && $pg['id']) {
	$spot	= "<b style=\"color:#ff0000;padding-left:10px\"><img src=\"../img/btn_on_func.gif\" align=\"absmiddle\" alt=\"사용중\" /></b>";
}

// 기본 설정값 체크
$checked['zerofee'][$pg['zerofee']]				= "checked";
$checked['receipt'][$pg['receipt']]				= "checked";
$checked['skin'][$pg['skin']]					= "checked";
$checked['escrow']['use'][$escrow['use']]		= "checked";
$checked['escrow']['min'][$escrow['min']]		= "checked";

// 결제수단 설정 체크
if ($set['use']['c']) $checked['c']				= "checked";
if ($set['use']['o']) $checked['o']				= "checked";
if ($set['use']['v']) $checked['v']				= "checked";
if ($set['use']['h']) $checked['h']				= "checked";
if ($pg['id']=='' || $set['use']['y']) $checked['y'] = "checked"; //옐로페이 2013-04 추가 

// 에스크로 결제수단 설정 체크
if ($escrow['c']) $checked['method']['c']		= "checked";
if ($escrow['o']) $checked['method']['o']		= "checked";
if ($escrow['v']) $checked['method']['v']		= "checked";
$checked['displayEgg'][$cfg['displayEgg']+0]	= "checked";

// 프리픽스값(패키지 or 무료체험)
$prefix = 'GODO|GDP|GDFP|GDF';

// INIpay 키화일 여부
if ($cfg['settlePg']=="inipay" || is_file("../../conf/pg.inipay.php")){
	$dir = "../../order/card/inipay/key/";

	if (is_dir($dir.$pg['id']) && empty($pg['id']) === false){
		$od = opendir($dir.$pg['id']);
		while ($rd=readdir($od)){
			if (!ereg("\.$",$rd)) $fls['pg'][] = $rd;
		}
	}
	if (is_dir($dir.$escrow['id']) && empty($escrow['id']) === false){
		$od = opendir($dir.$escrow['id']);
		while ($rd=readdir($od)){
			if (!ereg("\.$",$rd)) $fls['escrow'][] = $rd;
		}
	}
}

// 에스크로 인증마크 처리
$escrow['eggDisplayLogo']	= stripslashes(html_entity_decode($escrow['eggDisplayLogo'], ENT_QUOTES));
?>
<script language=javascript>
var prefix = '<? echo $prefix;?>';
var arr=new Array('c','v','o','h');

function chkSettleKind(){
	var f = document.forms[0];

	var ret = false;
	for(var i=0;i < arr.length;i++)
	{
		var sk = document.getElementsByName('set[use]['+arr[i]+']')[0].checked;
		if(sk == true)ret=true;
	}
	var robj =  new Array('pg[id]');

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

function chkEscrow(){

	var obj = document.getElementsByName('escrow[id]')[0];

	if(document.getElementsByName('escrow[use]')[0].checked){
		obj.style.background = "#ffffff";
		obj.readOnly = false;
		return true;
	}else{
		obj.style.background = "#e3e3e3";
		obj.readOnly = true;
		return false;
	}

}

function chkFormThis(f){

	var ret = false;
	var sk = false;
	var p_id = document.getElementsByName('pg[id]')[0];
	var s_id =  document.getElementsByName('escrow[id]')[0];

	for(var i=0;i < arr.length;i++)
	{
		sk = document.getElementsByName('set[use]['+arr[i]+']')[0].checked;
		if(sk == true)ret=true;
	}

	if(!p_id.value && ret){
		p_id.focus();
		alert('INIPay ID는 필수항목입니다.');
		return false;
	}

	if( chkEscrow() && !s_id.value ){
		s_id.focus();
		alert('Escrow ID는 필수항목입니다.');
		return false;
	}

	if(!chkPgid()){
		alert('INIPay ID가 올바르지 않습니다.');
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

var oldId = "<?php echo $pg['id'];?>";
function openPrefix(){
	if(chkPgid()){
		alert("정상적인 INIPay ID입니다.\n개별 승인 신청이 필요 없습니다.\n창을 닫고 INIPay ID를 입력하세요!");
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
		parameters: "mode=getPginfo&pgtype=inipay&pgid="+pgid,
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
	var pattern = new RegExp('^('+prefix+')');
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

<div class="title title_top">
	이니시스PG 설정<span>신용카드 결제 및 기타결제방식은 반드시 전자결제서비스 업체와 계약을 맺으시기 바랍니다</span> <a href="javascript:manual('<?=$guideUrl?>board/view.php?id=basic&no=7')"><img src="../img/btn_q.gif" border="0" align="absmiddle" /></a>
</div>
<div id="inicis_banner"><script>panel('inicis_banner', 'pg');</script></div>

<form method="post" action="indb.pg.php" enctype="multipart/form-data" onsubmit="return chkFormThis(this)">
<input type="hidden" name="mode" value="inipay" />
<input type="hidden" name="cfg[settlePg]" value="inipay" />

<div id="MSG01">
	<table cellpadding="1" cellspacing="0" border="0" class="small_ex">
	<tr>
		<td colspan="2">
		이니시스에서 제공하는 신용카드,계좌이체,가상계좌,핸드폰의 결제수단을 방문자(소비자)에게 제공하기 위해서<br />
		이니시스에서 <b>메일로 받으신 압축파일을 풀어서 INIPay ID와 Key File 3개를 입력</b>하신후 본 페이지 하단의 저장버튼을 클릭해 주세요.<br />
		아직 이니시스와 계약을 하지 않으셨다면 ①<u>온라인신청 하신후</u> ②<u>계약서류를 우편으로 이니시스에 보내</u>주세요 <a href="../basic/pg.intro.php" target="_blank"><font color="#ffffff"><b>[계약 상세안내]<b/></font></a>
		</td>
	</tr>
	</table>
</div>
<script>cssRound('MSG01')</script>

<div style="font:0;height:5"></div>
<table border="1" bordercolor="#e1e1e1" style="border-collapse:collapse" width="100%">
<col class="cellC"><col class="cellL">
<tr>
	<td><b>PG사 모듈 버전</b></td>
	<td><b>INIpay V5.0 - 오픈웹 (V 0.1.1 - 20120302) <?php echo $spot;?></b></td>
</tr>
<tr>
	<td>결제수단 설정</td>
	<td class="noline">
		<input type="checkbox" name="set[use][c]" <?php echo $checked['c'];?> onclick="chkSettleKind();" /> 신용카드
		<input type="checkbox" name="set[use][o]" <?php echo $checked['o'];?> onclick="chkSettleKind();" /> 계좌이체
		<input type="checkbox" name="set[use][v]" <?php echo $checked['v'];?> onclick="chkSettleKind();" /> 가상계좌
		<input type="checkbox" name="set[use][h]" <?php echo $checked['h'];?> onclick="chkSettleKind();" /> 핸드폰
		<input type="checkbox" name="set[use][y]" <?php echo $checked['y'];?> onclick="chkSettleKind();" /> 옐로페이
		&nbsp;&nbsp;&nbsp;<font class="extext"><b>(반드시 이니시스와 계약한 결제수단만 체크하세요)</b></font>
		<div class="extext">
			서비스 신청 간소화를 위해 옐로페이 결제수단 사용 설정 시 KG이니시스로의 지불수단 추가신청서 접수와 동일한 효력이 발생하며, <br />
			옐로페이 지불수단 이용에 동의 하신 것으로 간주됩니다. [단, 옐로페이 서비스 신청서가 미 접수된 2013년 5월 8일 이전 계약된 업체에 한함.]<br />
			<a href="https://www.inicis.com/ini_19_4.jsp" class="extext" target="_blank"><strong>[ KG이니시스 옐로페이란? ]</strong></a>
		</div>		
	</td>
</tr>
<tr>
	<td class="ver8"><b>INIPay ID</b></td>
	<td>
		<div style="float:left"><input type="text" name="pg[id]" class="lline" value="<?php echo $pg['id'];?>" onkeyup="chkPgid();" onblur="chkPgid();" id="pgid" /></div>
		<div style="float:left;padding:0 0 0 5px" id="btPgId"><a href="javascript:openPrefix();"><img src="../img/pginfo.gif" alt="개별 승인 신청" /></a></div>
		<div style="clear:both" class="extext"><? echo str_replace('|',',', $prefix);?>로 시작되는 INIPay ID만 직접 입력 가능합니다. (단, 기존 입력값은 무방합니다)</div>
		<div class="extext">고도몰 솔루션 이용자중 이전 버전을 사용하고 있어 위의 아이디로 시작하지 않는 경우에는 개별 승인 신청을 하셔야 합니다.</div>
	</td>
</tr>
<?php for ($i=1; $i<=3; $i++){ ?>
<tr>
	<td class="ver8"><b>INIPay Key File #<?php echo $i;?></b></td>
	<td class="ver8"><input type="file" name="pg[file_0<?php echo $i;?>]" class="lline" /> <?php echo $fls['pg'][$i-1];?></td>
</tr>
<?php } ?>
<tr>
	<td height="50">일반할부기간</td>
	<td>
		<input type="text" name="pg[quota]" value="<?php echo $pg['quota'];?>" class="lline" style="width:500px" />
		<div class="extext" style="padding-top:5px">ex) <?php echo $_pg['quota'];?></div>
	</td>
</tr>
<tr>
	<td>무이자 여부</td>
	<td class="noline">
		<input type="radio" name="pg[zerofee]" value="no" <?php echo $checked['zerofee']['no'];?> /> 일반결제
		<input type="radio" name="pg[zerofee]" value="yes" <?php echo $checked['zerofee']['yes'];?> /> 무이자결제
		<font class="extext"><b>(무이자결제는 반드시 PG사와 계약체결 후에 사용해야 합니다!)</b> (아래 '무이자 기간' 사용시 체크)</font>
	</td>
</tr>
<tr>
	<td height="92">무이자 기간</td>
	<td>
		<input type="text" name=pg[zerofee_period] value="<?php echo $pg[zerofee_period];?>" class="lline" style="width:500px" />
		<div style="padding-top:7px"><font class="extext" >* 카드사코드 :  01 (외환), 03 (롯데), 04 (현대), 06 (국민), 11 (BC), 12 (삼성), 14 (신한), 34 (하나 SK), 41 (NH(농협))</div>
		<div style="padding-top:3px">ex) 비씨카드 3개월 / 6개월 할부와 삼성카드 3개월 무이자 적용시 ⇒ 11-3:6,12-3 라고 입력</div>
		<div style="padding-top:3px">ex) 모든카드에 대해서 3개월 / 6개월 무이자 적용시 ⇒ ALL-3:6 라고 입력</div>
		<div style="padding:3px 0 7px 0">* 무이자 기간을 사용하려면 반드시 위의 무이자결제를 체크하세요!</div>
	</td>
</tr>
<tr>
	<td>결제창 스킨</td>
	<td class="noline">
		<input type="radio" name="pg[skin]" value="ORIGINAL" <?php echo $checked['skin']['ORIGINAL'];?> /> 기본
		<input type="radio" name="pg[skin]" value="GREEN" <?php echo $checked['skin']['GREEN'];?> /> 녹색
		<input type="radio" name="pg[skin]" value="ORANGE" <?php echo $checked['skin']['ORANGE'];?> /> 오렌지
		<input type="radio" name="pg[skin]" value="BLUE" <?php echo $checked['skin']['BLUE'];?> /> 파랑
		<input type="radio" name="pg[skin]" value="KAKKI" <?php echo $checked['skin']['KAKKI'];?> /> 카키
		<input type="radio" name="pg[skin]" value="GRAY" <?php echo $checked['skin']['GRAY'];?> /> 회색
	</td>
</tr>
</table>
<div id="MSG02">
<table cellpadding="1" cellspacing="0" border="0" class="small_ex">
<tr><td><img src="../img/icon_list.gif" align="absmiddle" />PG사의 결제정보 설정후 고객님께서 카드결제 테스트를 꼭 해보시기 바랍니다.</td></tr>
<tr><td><img src="../img/icon_list.gif" align="absmiddle" />간혹 PG사를 통해 카드승인된 값을 받지못하여 주문관리페이지에서 입금확인으로 자동변경되지 않을수 있습니다.</td></tr>
<tr><td><img src="../img/icon_list.gif" align="absmiddle" />반드시 주문관리페이지의 주문상태와 PG사에서 제공하는 관리자화면내의 카드승인내역도 동시에 확인해 주십시요.</font></td></tr>
<tr><td height="8"></td></tr>
<tr><td><font class="def1" color="white"><b>- 이니시스 PG사와 "가상계좌" 결제수단이 계약되어 있는 경우 (필독!) -</b></font></td></tr>
<tr><td>① 이니시스PG사와 "가상계좌" 결제수단이 계약되어 있는 상점이라면 "가상계좌입금내역 실시간 통보" 서비스를 통해 편리하게 입금내역을 확인하실 수 있습니다.</td></tr>
<tr><td>② "가상계좌입금내역 실시간통보" 란  고객이 가상계좌로 입금을 하게 되어 승인이 된 경우  입금내역승인결과값을 e나무 관리자페이지로 보내어  해당주문건에 대하여 자동으로 "입금확인" 처리가 되도록 할 수 있는 것입니다. </td></tr>
<tr><td>③ 먼저 "가상계좌입금내역 실시간 통보"와 관련하여 이니시스 PG사에 신청을 하신 상태인지 확인을 해보시기 바랍니다. <a href="javascript:popup('http://guide.godo.co.kr/guide/php/ex_inisis_pg.html#01',1113,420)"><img src="../img/btn_dacompg_sample.gif" align=absmiddle></a></td></tr>
<tr><td>④ 신청을 하신 상태라면 그림에서 설명되어 있는 사항,   "입금내역통보URL"은 http://도메인/shop/order/card/inipay/vacctinput.php 으로 입력을 해주시기 바랍니다. <a href="javascript:popup('http://guide.godo.co.kr/guide/php/ex_inisis_pg.html#02',1113,420)"><img src="../img/btn_dacompg_sample.gif" align=absmiddle></a></td></tr>
<tr><td>⑤ 가상계좌와 관련하여 "입금내역 통보 방법" / "통보방식선택" / "입금내역통보URL" 설정사항을 모두 마치신 상태라면 가상계좌 주문 테스트 후 가상계좌로 입금한 후에</td></tr>
<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;이니시스 PG사에서의 승인여부와 e나무 관리자페이지에서의 주문처리상태가 "입금확인"으로 변경되었는지 확인해 주시면 됩니다.</td></tr>
<tr><td>⑥ 정상적으로 입금통보 결과값을 받지 못해 e나무 관리자페이지의 주문리스트에서 해당주문건의 (가상계좌에 한함)   주문처리상태가 입금확인이 되지 않았을 시 그 오류결과값을 확인해 주시기 바랍니다. <a href="javascript:popup('http://guide.godo.co.kr/guide/php/ex_inisis_pg.html#03',1113,420)"><img src="../img/btn_dacompg_sample.gif" align=absmiddle></a></td></tr>
<tr><td height="8"></td></tr>
<tr><td><font class="def1" color="white"><b>- 옐로페이 이용안내  <a href="https://www.yelopay.com/home/home_policy.jsf" target="_blank">&nbsp;&nbsp;<font color="white">[ 바로가기 ]</font></a></b></font></td></tr>
<tr><td>① 옐로페이는 이니시스PG를 이용하여야 서비스가 가능 합니다. 타PG이용시 서비스 불가.</td></tr>
<tr><td>② 2013. 5. 8 부터 이니시스PG를 신청하시면 기본적으로 옐로페이 서비스가 포함되어 신청됩니다. 계약 후, 사용을 원하시는 경우 결제수단에서 옐로페이를 체크 해주세요.</td></tr>
<tr><td>③ 주문하기 페이지에서 옐로페이 결제수단이 노출되지 않으면 스킨패치를 체크하여 적용하세요. <b><a href="http://www.godo.co.kr/customer_center/patch.php?sno=1620" target="_blank">&nbsp;&nbsp;<font color="white">[옐로페이 업그레이드 바로가기]</font></a></b></td></tr>
<tr><td>④ 옐로페이는 모바일샵에서는 서비스를 지원하지 않습니다.</td></tr>
<tr><td>⑤ 옐로페이는 휴대폰과 통장을 등록하고 휴대폰 번호만으로 쇼핑몰에서 결제가 가능하도록 지원하는 서비스 입니다.</td></tr>
<tr><td>⑥ 구매자가 옐로페이로 결제를 할 경우 옐로페이에 먼저 가입하고 잔고를 충전해야 결제가 가능하며 일부 은행은 충전 없이 바로 결제가 가능합니다.</td></tr>
</table>
</div>
<script>cssRound('MSG02');</script>

<div style="display:block">
<div class="title">
	에스크로 설정 <span>현금성 결제시 의무적으로 에스크로결제를 허용해야 합니다.</span> <a href="javascript:manual('<?=$guideUrl?>board/view.php?id=basic&no=7')"><img src="../img/btn_q.gif" border="0" align="absmiddle" /></a>
</div>

<div id="MSG03">
<table border=0 cellpadding=1 cellspacing=0 border=0 class="small_ex">
<tr><td>이니시스에서 제공하는 이니 에스크로 결제수단을 방문자(소비자)에게 제공하기 위해서</td></tr>
<tr><td>이니시스에서 <b>메일로 받으신 압축파일을 풀어서 Escrow ID와 Escrow Key File 3개를 입력</b>하신후 본 페이지 하단의 저장버튼을 클릭해 주세요.</td></tr>
<tr><td>아직 이니시스 이니 에스크로를 계약 하지 않으셨다면</td></tr>
<tr><td style="padding-left:10">①계약서류를 우편으로 이니시스에 접수하시면 됩니다.</td></tr>
</table>
</div>
<script>cssRound('MSG03')</script>

<div style="padding-top:5px"></div>
<table border="1" bordercolor="#e1e1e1" style="border-collapse:collapse" width="100%">
<col class="cellC"><col class="cellL">
<tr>
	<td>사용여부</td>
	<td class="noline">
		<input type="radio" name="escrow[use]" value="Y" <?php echo $checked['escrow']['use']['Y'];?> onclick="chkEscrow();" /> 사용
		<input type="radio" name="escrow[use]" value="N" <?php echo $checked['escrow']['use']['N'];?> onclick="chkEscrow();" /> 사용안함
		<span style="padding-left:15"><font class="extext"><b>(이니시스의 이니 에스크로를 계약하셨다면 사용으로 체크하세요.)</b></font></span><br />
		<span style="padding-left:15"><font class="extext"><b>※ '하나에스크로'가 아닙니다. 반드시 "이니에스크로"를 계약하셔야 합니다.</b></font></span>
	</td>
</tr>
<input type="hidden" name="escrow[comp]" value="PG" />	<!-- 에스크로 기관설정 -->
<tr>
	<td>결제 수단</td>
	<td class="noline">
		<input type="checkbox" name="escrow[c]" <?php echo $checked['method']['c'];?> disabled="disabled" /> 신용카드
		<input type="checkbox" name="escrow[o]" <?php echo $checked['method']['o'];?> /> 계좌이체
		<input type="checkbox" name="escrow[v]" <?php echo $checked['method']['v'];?> /> 가상계좌
	</td>
</tr>
<tr>
	<td>사용 금액</td>
	<td>
		<input type="text" name="escrow[min]" value="<?php echo $escrow['min'];?>" class="lline" onkeydown="onlynumber();" style="width:100px;" />
		<div class="extext" style="padding-top:4px">PG사마다 에스크로 결제가 모든 금액에 적용이 안될수도 있으므로, 반드시 계약맺은 PG사의 에스크로 계약내용을 꼭 확인하세요.</div>
	</td>
</tr>
<!--
<tr>
	<td>고객 수수료 부담</td>
	<td>
		<input type="text" name="escrow[fee]" value="<?php echo $escrow['fee']+0;?>" size="5" class="right" /> %
	</td>
</tr>
-->
<tr>
	<td>Escrow ID</td>
	<td>
	<input type="text" name=escrow[id] class="lline" value="<?php echo $escrow['id'];?>" />
	</td>
</tr>
<?php for ($i=1;$i<=3;$i++){ ?>
<tr>
	<td class="ver8"><b>Escrow Key File #<?php echo $i;?></b></td>
	<td class="ver8"><input type="file" name="escrow[file_0<?php echo $i;?>]" class="lline" /> <?php echo $fls['escrow'][$i-1];?></td>
</tr>
<?php } ?>
<tr>
	<td>구매 안전 표시<div style="padding-top:3"><a href="javascript:manual('<?=$guideUrl?>board/view.php?id=basic&no=10')"><font class="extext_l">[표시이미지 보기]</font></a></div></td>
	<td class="noline">
		<input type="radio" name="cfg[displayEgg]" value="0" <?php echo $checked['displayEgg'][0];?> /> 메인하단과 결제수단 선택페이지에만 표시
		<input type="radio" name="cfg[displayEgg]" value="1" <?php echo $checked['displayEgg'][1];?> /> 전체페이지에 표시
		<input type="radio" name="cfg[displayEgg]" value="2" <?php echo $checked['displayEgg'][2];?> /> 표시하지 않음
	</td>
</tr>
<tr>
	<td>에스크로 인증 마크</td>
	<td class="noline">
		<textarea name="escrow[eggDisplayLogo]" style="width:100%;height:80px" class="tline"><?php echo $escrow['eggDisplayLogo'];?></textarea><br />
		<font class="extext"><b>※ <a href="http://mark.inicis.com/certi2/certi_escrow.php" class="extext_l" target="_blank">[KG 이니시스 인증센터]</a>에서 제공 받은 내용을 넣으세요.</b></font>
	</td>
</tr>
</table>

<div style="padding-top:10"></div>

<table border="1" bordercolor="#e1e1e1" style="border-collapse:collapse" width="100%">
<tr>
	<td>
		<table cellpadding="15" cellspacing="0" border="0" bgcolor="white" width="100%">
		<tr>
			<td>
				<div style="padding:0 0 5px 0">* 구매안전서비스 표기 적용방법 (에스크로 사용시 위에서 구매안전표시를 체크하고, 아래 표기방법에 따라 반영하세요)</div>
				<table width="100%" height="100" class="tb" style='border:1px solid #cccccc;' bgcolor="white">
				<tr>
					<td width="30%" style='border:1px solid #cccccc;padding-left:20'>① [메인페이지 하단] 표기방법</td>
					<td align="center" rowspan="2" style='border:1px solid #cccccc;padding:0 10 0 10'><a href="javascript:manual('<?=$guideUrl?>board/view.php?id=basic&no=10')"><img src="../img/icon_sample.gif" align=absmiddle></a></td>
					<td width="70%" style='border:1px solid #cccccc;padding-left:40'><font class="extext"><a href='../design/codi.php?design_file=outline/footer/standard.htm' target=_blank><font class="extext"><b>[디자인관리 > 전체레이아웃 디자인 > 하단디자인 > html소스 직접수정]</b></font></a> 을 눌러<br /> 치환코드 <font class="ver8" color=000000><b>{=displayEggBanner()}</b></font> 를 삽입하세요. <a href='../design/codi.php?design_file=outline/footer/standard.htm' target=_blank><font class="extext_l">[바로가기]</font></a></font></td>
				</tr>
				<tr>
					<td width="30%" style='border:1px solid #cccccc;padding-left:20'>② [결제수단 선택페이지] 표기방법</td>
					<td width="70%" style='border:1px solid #cccccc;padding-left:40'>
						<a href='../design/codi.php?design_file=order/order.htm' target="_blank"><font class="extext"><font class="extext_l">[디자인관리 > 기타페이지 디자인 > 주문하기 > order.htm]</font></a> 을 눌러<br /> 치환코드 <font class="ver8" color=000000><b>{=displayEggBanner(1)}</b></font> 를 삽입하세요. <a href='../design/codi.php?design_file=order/order.htm' target=_blank><font class="extext_l">[바로가기]</font></a></font>
					</td>
				</tr>
				</table>
			</td>
		</tr>
		</table>

		<div style="padding-top:15"></div>

		<table cellpadding=1 cellspacing=0 border=0 class=small_tip>
		<tr><td><img src="../img/icon_list.gif" align="absmiddle" /><font class="extext"><b>구매안전서비스 가입 표기 의무화 안내 (2007년 9월 1일 시행)</b></font></td></tr>
		<tr><td style="padding-top:4px">&nbsp;&nbsp;<font class="extext">① 표시·광고 또는 고지의 위치를 사이버몰 초기화면과 소비자의 결제수단 선택화면 두 곳으로 정함.</font></td></tr>
		<tr><td style="padding-left:16"><font class="extext">- 사이버몰 초기화면 상법 제10조제1항의 사업자의 신원 등 표기사항 게재부분의 바로 좌측 또는 우측에 구매안전서비스 관련 사항을 표시하도록 함.</font></td></tr>
		<tr><td style="padding-left:16"><font class="extext">- 소비자가 정확한 이해를 바탕으로 구매안전서비스 이용을 선택할 수 있도록, 결제수단 선택부분의 바로 위에 구매안전서비스 관련사항을 알기 쉽게 고지하여야  함.</font></td></tr>
		<tr><td style="padding-top:4px">&nbsp;&nbsp;<font class="extext">② 표시·광고 또는 고지 사항으로 다음의 세 가지를 규정함.</font></td></tr>
		<tr><td style="padding-left:16"><font class="extext">- 현금 등으로 5만원 이상 결제시 소비자가 구매안전서비스의 이용을 선택할 수 있다는 사항</font></td></tr>
		<tr><td style="padding-left:16"><font class="extext">- 통신판매업자 자신이 가입한 구매안전서비스의 제공사업자명 또는 상호</font></td></tr>
		<tr><td style="padding-left:16"><font class="extext">- 소비자가 구매안전서비스 가입사실의 진위를 확인 또는 조회할 수 있다는 사항</font></td></tr>
		<tr><td height=10></td></tr>
		</table>

		<table cellpadding=1 cellspacing=0 border=0 class=small_tip>
		<tr><td><img src="../img/icon_list.gif" align="absmiddle" /><font class="extext"><b>구매안전서비스 적용 확대 (2011년 7월 29일 시행)</b></font></td></tr>
		<tr><td style="padding-top:4px">&nbsp;&nbsp;<font class="extext">① 통신판매업자는 5만원 이상의 구매에 대해서도 구매안전서비스를 적용할 수 있도록 시스템을 변경하여야 함.</font></td></tr>
		<tr><td style="padding-left:16"><font class="extext">- 사이버몰 초기화면 및 결제수단 선택창의 구매안전표시부에 ‘10만원 이상’→ ‘5만원 이상’으로 수정할 것.</font></td></tr>
		<tr><td style="padding-top:4px">&nbsp;&nbsp;<font class="extext">② 통신판매업 관련 법률 개정에 따른 사업자 조치사항 안내.</font></td></tr>
		<tr><td style="padding-left:16"><font class="extext">- 관련 법률</font></td></tr>
		<tr><td style="padding-left:16"><font class="extext">&nbsp;&nbsp;: 전자상거래 등에서의 소비가보호에 관한 법률 : 시행령 제28조의 2</font></td></tr>
		<tr><td style="padding-left:16"><font class="extext">&nbsp;&nbsp;: 전자상거래 등에서의 소비가보호에 관한 법률 : 시행규칙 제7조의 2(신설)</font></td></tr>
		<tr><td style="padding-left:16"><font class="extext">- 구매안전서비스 적용 확대 : ‘10만원 이상’→ ‘5만원 이상’(1회 결제시)</font></td></tr>
		<tr><td style="padding-left:16"><font class="extext">- 사이버몰 초기화면 및 결제수단 선택창 ‘5만원 이상’으로 수정</font></td></tr>
		<tr><td height=10></td></tr>
		</table>
	</td>
</tr>
</table>

<div class="title">
	현금영수증 <a href="javascript:manual('<?=$guideUrl?>board/view.php?id=basic&no=7')"><img src="../img/btn_q.gif" border="0" align="absmiddle" /></a>
</div>
<table border="1" bordercolor="#e1e1e1" style="border-collapse:collapse" width="100%">
<col class="cellC"><col class="cellL">
<tr>
	<td>현금영수증</td>
	<td class="noline">
		<input type="radio" name="pg[receipt]" value="N" <?php echo $checked['receipt']['N'];?> /> 사용안함
		<input type="radio" name="pg[receipt]" value="Y" <?php echo $checked['receipt']['Y'];?> /> 사용
		<br /><font class="extext" style="padding-left:5px">이니시스 현금영수증 이용은 이니시스 현금영수증 안내를 확인하시기 바랍니다. <a class="extext" style="font-weight:bold" href="https://www.inicis.com/ini_21_1.jsp" target="_blank">[바로가기]</a></font>
	</td>
</tr>
</table><p>
</div>

<div id="MSG04">
<table cellpadding="1" cellspacing="0" border="0" class="small_ex">
<tr><td><img src="../img/icon_list.gif" align="absmiddle" />구매안전서비스(에스크로 또는 전자보증)는 전자상거래소비자보호법 및 시행령 개정에 따라 2011년 7월 29일부터 5만원 이상 현금성 결제시 의무 시행됩니다.</td></tr>
<tr><td><img src="../img/icon_list.gif" align="absmiddle" />에스크로 사용범위 및 사용금액에 대한것은 신청한 PG사나 은행에 따라 다를 수 있으므로 협의를 하셔야 합니다.</td></tr>
<tr><td><img src="../img/icon_list.gif" align="absmiddle" />소비자는 2008.7.1일부터 현금영수증 발급대상금액이 5천원이상에서 1원이상으로 변경되어 5천원 미만의 현금거래도 현금영수증을 요청하여 발급 받을 수 있습니다.</td></tr>
</table>
</div>
<script>cssRound('MSG04')</script>

<div class="button">
	<input type="image" src="../img/btn_save.gif" />
	<a href="javascript:history.back();"><img src="../img/btn_cancel.gif" /></a>
</div>

</form>
<script>chkSettleKind();chkEscrow();</script>