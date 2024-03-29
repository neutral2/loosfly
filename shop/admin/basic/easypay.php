<?php

### Easypay 기본 세팅값
$_pg		= array(
			'id'	=> '',
			'receipt'	=> 'N',
			);
$_escrow	= array(
			'use'		=> 'N',
			'min'		=> 50000,
			);

$location = "결제모듈연동 > 이지페이 PG설정";
include "../_header.popup.php";
include "../../conf/config.pay.php";
include "../../conf/pg.escrow.php";

if (is_file("../../conf/pg.easypay.php")){
	include "../../conf/pg.easypay.php";
}

$pg = @array_merge($_pg,$pg);
$escrow = @array_merge($_escrow,$escrow);

if ($cfg[settlePg]=="easypay") $spot = "<b style='color:#ff0000;padding-left:10px'>[사용중]</b>";
$checked[ssl][$pg[ssl]] = $checked[zerofee][$pg[zerofee]] = $checked[cert][$pg[cert]] = $checked[bonus][$pg[bonus]] = "checked";
$checked[escrow]['use'][$escrow['use']] = $checked[escrow][comp][$escrow[comp]] = $checked[escrow]['min'][$escrow['min']] = "checked";
$checked[receipt][$pg[receipt]] = "checked";

if ($set['use'][c]) $checked[c] = "checked";
if ($set['use'][o]) $checked[o] = "checked";
if ($set['use'][v]) $checked[v] = "checked";
if ($set['use'][h]) $checked[h] = "checked";

if ($escrow[c]) $checked[method][c] = "checked";
if ($escrow[o]) $checked[method][o] = "checked";
if ($escrow[v]) $checked[method][v] = "checked";
$checked[displayEgg][$cfg[displayEgg]+0] = "checked";
?>
<script language=javascript>
var arr=new Array('c','v','o','h');
function chkSettleKind(){
	var f = document.forms[0];

	var ret = false; var sk = false;
	for(var i=0;i < arr.length;i++)
	{
		sk = document.getElementsByName('set[use]['+arr[i]+']')[0].checked;
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
			obj.value = '';
		}
	}
}
function chkFormThis(f){

	var ret = false;
	var sk = false;
	var p_id = document.getElementsByName('pg[id]')[0];

	for(var i=0;i < arr.length;i++)
	{
		sk = document.getElementsByName('set[use]['+arr[i]+']')[0].checked;
		if(sk == true)ret=true;
	}

	if(!p_id.value && ret){
		p_id.focus();
		alert('이지페이 ID는 필수항목입니다.');
		return false;
	}

	if(!chkPgid()){
		alert('이지페이 ID가 올바르지 않습니다.');
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
		alert("정상적인 이지페이 ID입니다.\n개별 승인 신청이 필요 없습니다.\n창을 닫고 이지페이 ID를 입력하세요!");
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
		parameters: "mode=getPginfo&pgtype=easypay&pgid="+pgid,
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
	var pattern = /^(GD)/;
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
이지페이 PG 설정<span>신용카드 결제 및 기타결제방식은 반드시 전자결제서비스 업체와 계약을 맺으시기 바랍니다</span> <a href="javascript:manual('<?=$guideUrl?>board/view.php?id=basic&no=29')"><img src="../img/btn_q.gif" border=0 align=absmiddle></a>
</div>
<div id="easypay_banner"><script>panel('easypay_banner', 'pg');</script></div>
<form method=post action="indb.pg.php" enctype="multipart/form-data" onsubmit="return chkFormThis(this)">
<input type=hidden name=mode value="easypay">
<input type=hidden name=cfg[settlePg] value="easypay">

<div id=MSG01>
<table cellpadding=1 cellspacing=0 border=0 class=small_ex>
<tr><td>이지페이에서 제공하는 신용카드,계좌이체,가상계좌,핸드폰의 결제수단을 방문자(소비자)에게 제공하기 위해서<br/>
이지페이에서 <b>메일로 받으신 이지페이 ID를 입력</b> 하신 후 본 페이지 하단의 저장버튼을 클릭해 주세요. <br/>
아직 이지페이와 계약을 하지 않으셨다면, <br/>
①온라인신청 하신후 ②계약서류를 우편으로 이지페이에 보내주세요. <a href="/shop/admin/basic/pg.intro.php" target="_blank" class="extext"><b>[계약 상세안내]</b></a><br/>
</td></tr>
<!--<tr><td>KCP에서 <b>메일로 받으신 KCP Code와 KCP Key를 입력</b>하신후 본 페이지 하단의 저장버튼을 클릭해 주세요.</td></tr>
<tr><td>아직 KCP와 계약을 하지 않으셨다면</td></tr>
<tr><td style="padding-left:10">①<u>온라인신청 하신 후</u></td></tr>
<tr><td style="padding-left:10">②<u>계약서류를 우편으로 KCP에 보내</u>주세요 <a href="../basic/pg.intro.php" target="_blank"><font color="#ffffff"><b>[계약 상세안내]</b></font></a></td></tr>//-->
</table>
</div>
<script>cssRound('MSG01')</script>
<div style="padding-top:15px"></div>
<table border=1 bordercolor=#e1e1e1 style="border-collapse:collapse" width=100%>
<col class=cellC><col class=cellL>
<tr>
	<td>PG사</td>
	<td><b>이지페이 (Easypay V7.0 플러그인) <?=$spot?></b></td>
</tr>
<tr>
	<td>결제수단 설정</td>
	<td class=noline>
	<input type=checkbox name=set[use][c] <?=$checked[c]?> onclick="chkSettleKind()"> 신용카드
	<input type=checkbox name=set[use][o] <?=$checked[o]?> onclick="chkSettleKind()"> 계좌이체
	<input type=checkbox name=set[use][v] <?=$checked[v]?> onclick="chkSettleKind()"> 가상계좌
	<input type=checkbox name=set[use][h] <?=$checked[h]?> onclick="chkSettleKind()"> 휴대폰
	&nbsp;&nbsp;&nbsp;<font class=extext><b>(반드시 이지페이와 계약한 결제수단만 체크하세요)</b></font></td>
</tr>
<tr>
	<td class=ver8><b>이지페이 ID</td>
	<td>
	<div style="float:left"><input type=text name=pg[id] class=lline value="<?=$pg[id]?>" onkeyup="chkPgid()" onblur="chkPgid()" id="pgid"></div>
	<div style="clear:both" class="extext"><b>GD</b>로 시작되는 이지페이 ID만 직접 입력 가능합니다. </div>
	</td>
</tr>


<tr>
	<td>할부기간</td>
	<td>
	<input type=text name=pg[quota] value="<?=$pg[quota]?>" class=lline>
	<div class=extext style="padding-top:4">결제자가 할부 결제시 선택한 할부개월 수 입니다. 00 부터 12 의 값을 가집니다.ex) 00:02:03:04:05:06:07:08:09:10:11:12   </div>
	</td>
</tr>
<tr>
	<td>무이자 여부</td>
	<td class=noline>
	<input type=radio name=pg[zerofee] value="no" checked> 일반결제
	<input type=radio name=pg[zerofee] value="yes" <?=$checked[zerofee][yes]?>> 무이자결제 (아래 기간 입력)
	 <font class=extext><b>(무이자결제는 반드시 PG사와 계약체결 후에 사용해야 합니다!)</b></font></td>
</tr>
<tr>
	<td>무이자 기간</td>
	<td>
	<input type=text name=pg[zerofee_period] value="<?=$pg[zerofee_period]?>" class=lline style="width:500px">
	<a href="javascript:popupLayer('../basic/popup.easypay.php',500,470)" style="color:#616161;" class=ver8><img src="../img/btn_carddate.gif" align=absmiddle></a>
	<div class=extext  style="padding-top:4px">옆에 있는 '무이자기간코드생성' 버튼을 눌러 코드를 생성한후 복사하여 사용하세요</div>
	</td>
</tr>



</table>
</div>

<div style="padding-top:15px"></div>

<div id=MSG02>
<table cellpadding=1 cellspacing=0 border=0 class=small_ex>
<tr><td><img src="../img/icon_list.gif" align="absmiddle">PG사와 계약을 맺은 이후에는 메일로 받으신 실제 ID를 넣으시면 됩니다.</td></tr>
<tr><td><img src="../img/icon_list.gif" align="absmiddle">PG사의 결제정보 설정후 고객님께서 카드결제 테스트를 꼭 해보시기 바랍니다.</td></tr>
<tr><td><img src="../img/icon_list.gif" align="absmiddle">간혹 PG사를 통해 카드승인된 값을 받지못하여 주문관리페이지에서 입금확인으로 자동변경되지 않을수 있습니다.</td></tr>
<tr><td><img src="../img/icon_list.gif" align="absmiddle">반드시 주문관리페이지의 주문상태와 PG사에서 제공하는 관리자화면내의 카드승인내역도 동시에 확인해 주십시요.</font></td></tr>
</table>

<table cellpadding="1" cellspacing="0" border="0" class="small_ex">
<tr><td height=8></td></tr>
<tr><td><font class=def1 color=white>- 이지페이 PG사와 '가상계좌' 결제수단이 계약되어 있는 경우 -</font></td></tr>
<tr><td>① 이지페이 PG는 가상계좌 결제수단 사용 시 별도의 설정 없이 자동으로 입금통보를 쇼핑몰로 받을 수 있습니다. </td></tr>
</table>
</div>
<script>cssRound('MSG02')</script>

<div class=title>에스크로 설정 <span>현금성 결제시 의무적으로 에스크로결제를 허용해야 합니다. 에스크로란?</span> <a href="javascript:manual('<?=$guideUrl?>board/view.php?id=basic&no=29')"><img src="../img/btn_q.gif" border=0 align=absmiddle></a></div>
<input type=hidden name=escrow[comp] value="PG">	<!-- 에스크로 기관설정 -->
<div class=extext> - 아직 이지페이 에스크로를 신청하지 않으셨다면 신청서를 작성하여, 이지페이로 발송해주세요. &nbsp;&nbsp; <b><a href="http://godo.co.kr/service/EasyPay_godo.zip">[다운로드]</a></b> <br/>
- 작성서류 : 이지페이 전자결제 서비스 이용계약서 2부, 이지페이 전자결제서비스 이용신청서 1부 &nbsp;&nbsp;<b><a href="http://www.godo.co.kr/service/pg_service_kicc_info.php" target="_blank" >[자세히보기]</a></b>
</div>
<table border=1 bordercolor=#e1e1e1 style="border-collapse:collapse" width=100%>
<col class=cellC><col class=cellL>
<tr>
	<td>사용여부</td>
	<td class=noline>
	<input type=radio name=escrow[use] value="Y" <?=$checked[escrow]['use'][Y]?>> 사용
	<input type=radio name=escrow[use] value="N" <?=$checked[escrow]['use'][N]?>> 사용안함
	&nbsp;&nbsp;&nbsp;<font class=extext><b>(이지페이 에스크로를 신청하셨다면 사용으로 체크하세요)</b></font>
	</td>
</tr>
<tr>
	<td>결제 수단</td>
	<td class=noline>
	<input type=checkbox name=escrow[c] <?=$checked[method][c]?> disabled="disabled" > 신용카드
	<input type=checkbox name=escrow[o] <?=$checked[method][o]?>> 계좌이체
	<input type=checkbox name=escrow[v] <?=$checked[method][v]?>> 가상계좌
	</td>
</tr>
<tr>
	<td>사용 금액</td>
	<td>
	<input type="text" name="escrow[min]" value="<?=$escrow[min]?>" class="lline" onkeydown="onlynumber()" style="width:100px;">
	<div class="extext"  style="padding-top:4px">PG사마다 에스크로 결제가 모든 금액에 적용이 안될수도 있으므로, 반드시 계약맺은 PG사의 에스크로 계약내용을 꼭 확인하세요.</div>
	</td>
</tr>
<tr>
	<td>구매 안전 표시</td>
	<td class=noline>
	<input type=radio name=cfg[displayEgg] value=0 <?=$checked[displayEgg][0]?>> 메인하단과 결제수단 선택페이지에만 표시
	<input type=radio name=cfg[displayEgg] value=1 <?=$checked[displayEgg][1]?>> 전체페이지에 표시
	<input type=radio name=cfg[displayEgg] value=2 <?=$checked[displayEgg][2]?>> 표시하지 않음
	</td>
</tr>
</table>


<div style="padding-top:10"></div>

<table border=1 bordercolor=#e1e1e1 style="border-collapse:collapse" width=100%>
<tr><td>
<table cellpadding=15 cellspacing=0 border=0 bgcolor=white width=100%>
<tr><td>
<div style="padding:0 0 5 0">
<b>*스킨 디자인 수정 및 변경에 따른 수동으로 구매안전 서비스 표기 적용방법</b><br/>
- 스킨 소스를 변경하였거나, 스킨을 구매했을 경우, 또는 새로 스킨을 만든 경우를 위한 표기방법입니다.<br/>
- 스킨에 따라 하단소스의 Table구조가 다르니, 이부분 유의해서 원하는 위치에 치환코드를 넣어주세요.<br/>
- 위에서 구매안전표시를 체크하고, 아래 표기방법에 따라 반영하세요.
</div>
<table width=100% height=100 class=tb style='border:1px solid #cccccc;' bgcolor=white>
<tr>
<td width=30% style='border:1px solid #cccccc;padding-left:20'>① [메인페이지 하단] 표기방법</td>
<td align=center rowspan=2 style='border:1px solid #cccccc;padding:0 10 0 10'><a href="javascript:manual('<?=$guideUrl?>board/view.php?id=basic&no=30')"><img src="../img/icon_sample.gif" align=absmiddle></a></td>
<td width=70% style='border:1px solid #cccccc;padding-left:40'><font class=extext><a href='../design/codi.php?design_file=outline/footer/standard.htm' target=_blank><font class=extext><b>[디자인관리 > 전체레이아웃 디자인 > 하단디자인 > html소스 직접수정]</b></font></a> 을 눌러<br> 치환코드 <font class=ver8 color=000000><b>{=displayEggBanner()}</b></font> 를 삽입하세요. <a href='../design/codi.php?design_file=outline/footer/standard.htm' target=_blank><font class=extext_l>[바로가기]</font></a></font></td>
</tr>
<tr>
<td width=30% style='border:1px solid #cccccc;padding-left:20'>② [결제수단 선택페이지] 표기방법</td>
<td width=70% style='border:1px solid #cccccc;padding-left:40'>
<a href='../design/codi.php?design_file=order/order.htm' target=_blank><font class=extext><font class=extext_l>[디자인관리 > 기타페이지 디자인 > 주문하기 > order.htm]</font></a> 을 눌러<br> 치환코드 <font class=ver8 color=000000><b>{=displayEggBanner(1)}</b></font> 를 삽입하세요. <a href='../design/codi.php?design_file=order/order.htm' target=_blank><font class=extext_l>[바로가기]</font></a></font></td>
</tr>
</table>
</td></tr>
</table>

<div style="padding-top:15"></div>

<table cellpadding=1 cellspacing=0 border=0 class=small_tip>
<tr><td><img src="../img/icon_list.gif" align="absmiddle"><font class=extext><b>구매안전서비스 가입 표기 의무화 안내 (2007년 9월 1일 시행)</b></font></td></tr>
<tr><td style="padding-top:4px">&nbsp;&nbsp;<font class=extext>① 표시·광고 또는 고지의 위치를 사이버몰 초기화면과 소비자의 결제수단 선택화면 두 곳으로 정함.</font></td></tr>
<tr><td style="padding-left:16"><font class=extext>- 사이버몰 초기화면 상법 제10조제1항의 사업자의 신원 등 표기사항 게재부분의 바로 좌측 또는 우측에 구매안전서비스 관련 사항을 표시하도록 함.</font></td></tr>
<tr><td style="padding-left:16"><font class=extext>- 소비자가 정확한 이해를 바탕으로 구매안전서비스 이용을 선택할 수 있도록, 결제수단 선택부분의 바로 위에 구매안전서비스 관련사항을 알기 쉽게 고지하여야  함.</font></td></tr>
<tr><td style="padding-top:4px">&nbsp;&nbsp;<font class=extext>② 표시·광고 또는 고지 사항으로 다음의 세 가지를 규정함.</font></td></tr>
<tr><td style="padding-left:16"><font class=extext>- 현금 등으로 5만원 이상 결제시 소비자가 구매안전서비스의 이용을 선택할 수 있다는 사항</font></td></tr>
<tr><td style="padding-left:16"><font class=extext>- 통신판매업자 자신이 가입한 구매안전서비스의 제공사업자명 또는 상호</font></td></tr>
<tr><td style="padding-left:16"><font class=extext>- 소비자가 구매안전서비스 가입사실의 진위를 확인 또는 조회할 수 있다는 사항</font></td></tr>
<tr><td height=10></td></tr>
</table>

<table cellpadding=1 cellspacing=0 border=0 class=small_tip>
<tr><td><img src="../img/icon_list.gif" align="absmiddle"><font class=extext><b>구매안전서비스 적용 확대 (2011년 7월 29일 시행)</b></font></td></tr>
<tr><td style="padding-top:4px">&nbsp;&nbsp;<font class=extext>① 통신판매업자는 5만원 이상의 구매에 대해서도 구매안전서비스를 적용할 수 있도록 시스템을 변경하여야 함.</font></td></tr>
<tr><td style="padding-left:16"><font class=extext>- 사이버몰 초기화면 및 결제수단 선택창의 구매안전표시부에 ‘10만원 이상’→ ‘5만원 이상’으로 수정할 것.</font></td></tr>
<tr><td style="padding-top:4px">&nbsp;&nbsp;<font class=extext>② 통신판매업 관련 법률 개정에 따른 사업자 조치사항 안내.</font></td></tr>
<tr><td style="padding-left:16"><font class=extext>- 관련 법률</font></td></tr>
<tr><td style="padding-left:16"><font class=extext>&nbsp;&nbsp;: 전자상거래 등에서의 소비가보호에 관한 법률 : 시행령 제28조의 2</font></td></tr>
<tr><td style="padding-left:16"><font class=extext>&nbsp;&nbsp;: 전자상거래 등에서의 소비가보호에 관한 법률 : 시행규칙 제7조의 2(신설)</font></td></tr>
<tr><td style="padding-left:16"><font class=extext>- 구매안전서비스 적용 확대 : ‘10만원 이상’→ ‘5만원 이상’(1회 결제시)</font></td></tr>
<tr><td style="padding-left:16"><font class=extext>- 사이버몰 초기화면 및 결제수단 선택창 ‘5만원 이상’으로 수정</font></td></tr>
<tr><td height=10></td></tr>
</table>
</td></tr></table>


<div class=title>현금영수증 <a href="javascript:manual('<?=$guideUrl?>board/view.php?id=basic&no=29')"><img src="../img/btn_q.gif" border=0 align=absmiddle></a></div>
<table border=1 bordercolor=#e1e1e1 style="border-collapse:collapse" width=100%>
<col class=cellC><col class=cellL>
<tr>
	<td>현금영수증</td>
	<td class=noline>
	<input type=radio name=pg[receipt] value="N" <?=$checked[receipt][N]?>> 사용안함
	<input type=radio name=pg[receipt] value="Y" <?=$checked[receipt][Y]?>> 사용
	<BR><font class=extext style="padding-left:5px">이지페이 현금영수증 이용은 이지페이 현금영수증 안내를 확인하시기 바랍니다. <a class="extext" style="font-weight:bold" href="http://www.easypay.co.kr/service_receipt.jsp" target="_blank">[바로가기]</a></font>
	</td>
</tr>
</table><p>


<div id=MSG03>
<table cellpadding=1 cellspacing=0 border=0 class=small_ex>
<tr><td><img src="../img/icon_list.gif" align="absmiddle">구매안전서비스(에스크로 또는 전자보증)는 전자상거래소비자보호법 및 시행령 개정에 따라 2011년 7월 29일부터 5만원 이상 현금성 결제시 의무 시행됩니다.</td></tr>
<tr><td><img src="../img/icon_list.gif" align="absmiddle">에스크로 사용범위 및 사용금액에 대한것은 신청한 PG사나 은행에 따라 다를 수 있으므로 협의를 하셔야 합니다.</td></tr>
<tr><td><img src="../img/icon_list.gif" align="absmiddle">소비자는 2008. 7. 1일부터 현금영수증 발급대상금액이 5천원이상에서 1원이상으로 변경되어
5천원 미만의 현금거래도 현금영수증을 요청하여 발급 받을 수 있습니다.</td></tr>
</table>
</div>
<script>cssRound('MSG03','#F7F7F7')</script>



<div class=button>
<input type=image src="../img/btn_save.gif">
<a href="javascript:history.back()"><img src="../img/btn_cancel.gif"></a>
</div>

</form>
<script>chkSettleKind();</script>