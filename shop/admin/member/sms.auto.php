<?

$location = "SMS설정 > SMS 자동발송/설정";
include "../_header.php";

$r_deny = array(
		'join'			=> '000',
		'id_pass'		=> '011',
		'order'			=> '000',
		'incash'		=> '000',
		'account'		=> '011',
		'delivery'		=> '011',
		'dcode'			=> '011',
		'cancel'		=> '011',
		'repay'			=> '011',
		'runout'		=> '100',
		'birth'			=> '011',
		'qna'			=> '011',
		'member'		=> '011',
		);

$r_code = array(
		'join'			=> '회원가입시 발송',
		'id_pass'		=> '비밀번호찾기시 발송',
		'order'			=> '주문접수시 발송 <font class="small1">(무통장주문만 해당, 카드결제주문은 발송이 안됩니다)',
		'incash'		=> '입금확인시 발송 <font class="small1">(무통장입금확인, 카드결제승인시 발송됩니다)',
		'account'		=> '입금요청 발송 <font class="small1">(무통장주문만 해당, 주문접수시 발송됩니다)',
		'delivery'		=> '상품배송시 발송 <font class="small1">(배송중 상태로 바뀌었을 때 발송됩니다)',
		'dcode'			=> '송장번호 발송 <font class="small1">(배송중 상태로 바뀌었을 때 발송됩니다)',
		'cancel'		=> '주문취소시 발송 <font class="small1">(주문취소 상태로 바뀌었을 때 발송됩니다)',
		'repay'			=> '환불완료시 발송',
		'runout'		=> '상품품절시 발송 <font class="small1">(주문후 상품이 품절되었을때 관리자에게 발송됩니다)',
		'birth'			=> '생일회원 자동발송 <font class="small1">(당일 생일자가 있는경우 관리자메인에서 확인)',
		'qna'			=> '1:1문의 답변등록시 발송'
		);

$smsRecall	= explode("-",$cfg['smsRecall']);
$smsAdmin	= explode("-",$cfg['smsAdmin']);

# 추가관리자 설정
$smsAddAdminArr	= explode("|",$cfg['smsAddAdmin']);
$smsAddAdmin[0]	= explode("-",$smsAddAdminArr[0]);

if(!$cfg['smsPass'])$cfg['smsPass']="1111";

$info_cfg = $config->load('member_info');
?>
<script Language=javascript>
/*** 추가관리자 ***/
function addfld(obj)
{
	var tb = document.getElementById(obj);
	oTr = tb.insertRow();
	oTd = oTr.insertCell();
	oTd.innerHTML = "<span>" + tb.rows[0].cells[0].getElementsByTagName('span')[0].innerHTML + "</span> <a href='javascript:void(0);' onClick='delfld(this)'><img src='../img/i_del.gif' align='absmiddle' /></a>";
	oTd = oTr.insertCell();
	oTd = oTr.insertCell();
}

function delfld(obj)
{
	var tb = obj.parentNode.parentNode.parentNode.parentNode;
	tb.deleteRow(obj.parentNode.parentNode.rowIndex);
}
</script>
<form method="post" action="indb.php">
<input type="hidden" name="mode" value="sms_auto" />

<div class="title title_top"><font face="굴림" color="black"><b>SMS</b></font> 관리자정보 입력<span>SMS 관리자정보를 입력하세요</span> <a href="javascript:manual('<?=$guideUrl?>board/view.php?id=member&no=8')"><img src="../img/btn_q.gif" border="0" align="absmiddle" hspace="2" /></a></div>

<table class="tb">
<col class="cellC"><col class="cellL">
<tr>
	<td>SMS 비밀번호 인증</td>
	<td><input type="password" name="smsPass" value="<?=$cfg['smsPass']?>" maxlength="4" onkeydown="onlynumber();"  class="line"/>
	<font class="extext"><a href="https://www.godo.co.kr/mygodo/login.php?returnURL=<?=$returnURL?>" target="_blank"><font class=extext_l>[마이고도 > 나의 쇼핑몰]</font></a> 에서 비밀번호를 먼저 등록하고, 동일한 비밀번호를 입력하세요</font></td>
</tr>
<tr>
	<td>회신전화번호</td>
	<td>
	<input type="text" name="smsRecall[]" size="4" maxlength="3" value="<?=$smsRecall[0]?>" onkeydown="onlynumber();" class="line" /> -
	<input type="text" name="smsRecall[]" size="4" maxlength="4" value="<?=$smsRecall[1]?>" onkeydown="onlynumber();"  class="line"/> -
	<input type="text" name="smsRecall[]" size="4" maxlength="4" value="<?=$smsRecall[2]?>" onkeydown="onlynumber();"  class="line"/>
	<font class="extext">고객이 받는 메세지에 회신번호로 찍히는 전화번호 (샵 고객센터 전화번호)</font></td>
</tr>
<tr>
	<td>관리자 핸드폰</td>
	<td>
	<input type="text" name="smsAdmin[]" size="4" maxlength="3" value="<?=$smsAdmin[0]?>" onkeydown="onlynumber();"  class="line"/> -
	<input type="text" name="smsAdmin[]" size="4" maxlength="4" value="<?=$smsAdmin[1]?>" onkeydown="onlynumber();"  class="line"/> -
	<input type="text" name="smsAdmin[]" size="4" maxlength="4" value="<?=$smsAdmin[2]?>" onkeydown="onlynumber();"  class="line"/>
	<font class="extext">관리자에게도 메세지를 통보할 때 필요한 전화번호 (관리자 핸드폰 번호)</td>
</tr>
<tr>
	<td>추가 관리자</td>
	<td>

	<table id="addadminField" cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse">
	<tr>
		<td>
		<span>
		<input type="text" name="smsAddAdmin1[]" size="4" maxlength="3" value="<?=$smsAddAdmin[0][0]?>" onkeydown="onlynumber();" class="line" /> -
		<input type="text" name="smsAddAdmin2[]" size="4" maxlength="4" value="<?=$smsAddAdmin[0][1]?>" onkeydown="onlynumber();" class="line" /> -
		<input type="text" name="smsAddAdmin3[]" size="4" maxlength="4" value="<?=$smsAddAdmin[0][2]?>" onkeydown="onlynumber();" class="line" />
		</span>
				<a href="javascript:addfld('addadminField');"><img src="../img/i_add.gif" align="absmiddle" /></a>
		<font class="extext">관리자 이외의 추가로 받아야 할 담당자가 있을때 필요한 전화번호</td>

		</td>
	</tr>
	</table>
<?
	for($i = 1; $i < sizeof($smsAddAdminArr); $i++){
		$smsAddAdmin[$i]	= explode("-",$smsAddAdminArr[$i]);
?>
	<table id="addadminField<?=$i?>" cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse">
	<tr>
		<td>
		<a href="javascript:void(0);" onClick="delfld(this)"><img src="../img/i_del.gif" align="absmiddle" /></a>
		<span>
		<input type="text" name="smsAddAdmin1[]" size="4" maxlength="3" value="<?=$smsAddAdmin[$i][0]?>" onkeydown="onlynumber();" /> -
		<input type="text" name="smsAddAdmin2[]" size="4" maxlength="4" value="<?=$smsAddAdmin[$i][1]?>" onkeydown="onlynumber();" /> -
		<input type="text" name="smsAddAdmin3[]" size="4" maxlength="4" value="<?=$smsAddAdmin[$i][2]?>" onkeydown="onlynumber();" />
		<font class="extext">관리자이외 추가로 받아야 할 담당자가 있을때 필요한 전화번호</td>
		</span>
		</td>
	</tr>
	</table>
<?
	}
?>
	</td>
</tr>
</table>


<div id="MSG01">
<table cellpadding="1" cellspacing="0" border="0" class="small_ex">
<tr><td><img src="../img/icon_list.gif" align="absmiddle" />회신번호란 고객에게 메세지를 발송시 회신번호로 찍히는 전화번호입니다. 상점전화번호 또는 핸드폰번호를 입력하세요</td></tr>
<tr><td><img src="../img/icon_list.gif" align="absmiddle" />관리자핸드폰은 아래 자동발송기능에서 관리자가 메세지를 받고자 할 때 필요합니다</td></tr>
<tr><td><img src="../img/icon_list.gif" align="absmiddle" />추가관리자는 관리자이외 추가로 받아야 할 담당자가 있을때 사용을 하실수 있습니다.</td></tr>
<tr><td><img src="../img/icon_list.gif" align="absmiddle" />SMS 포인트가 충전되어 있어야 발송이 가능합니다. <a href="sms.pay.php"><font color=white><u>[SMS 포인트 충전하기]</u></font></a> 에서 충전하세요</td></tr>
</table>
</div>
<script>cssRound('MSG01');</script>

<div style="padding-top:20px"></div>

<div class="title title_top"><font face="굴림" color="black"><b>SMS</b></font> 자동발송/문구설정 <span>아래 사항을 체크하시면 메세지가 자동발송됩니다. 내용을 수정한 후 등록버튼을 누르세요.</span> <a href="javascript:manual('<?=$guideUrl?>board/view.php?id=member&no=8')"><img src="../img/btn_q.gif" border="0" align="absmiddle" hspace="2" /></a></div>

<table width="800">
<tr>
	<?
	$idx=0;
	foreach ($r_code as $k=>$v){
		unset($checked);
		unset($sms_auto);
		@include "../../conf/sms/$k.php";
		if ($sms_auto['send_c']) $checked['send_c'] = "checked";
		if ($sms_auto['send_a']) $checked['send_a'] = "checked";
		if ($sms_auto['send_m']) $checked['send_m'] = "checked";

		$deny['member']	= substr($r_deny[$k],0,1);
		$deny['admin']	= substr($r_deny[$k],1,1);
		$deny['madmin']	= substr($r_deny[$k],2,1);

		$disabled['member']	= ($deny['member']) ? "disabled" : "";
		$disabled['admin']	= ($deny['admin']) ? "disabled" : "";
		$disabled['madmin']	= ($deny['madmin']) ? "disabled" : "";

		if ($k == 'id_pass' && isset($info_cfg['finder_use_mobile'])) {
			$disabled['member']	= "disabled";
			$disabled['admin']	= "disabled";
			$disabled['madmin']	= "disabled";
			$checked['send_c'] = "";
			$checked['send_a'] = "";
			$checked['send_m'] = "";
		}
	?>
	<td>

	<table border="1" bordercolor="#cccccc" style="border-collapse:collapse;">
	<tr>
		<td colspan="2" class="noline" width="350" height="25">&nbsp;&nbsp;<font color="#0074ba"><b><?=$v?></b></font></td>
	</tr>
	<tr>
		<td align="center" style="padding-bottom:5px" valign="top">

		<? if (!$deny['member']){ ?>
		<table cellpadding="0" cellspacing="0">
		<tr><td><img src="../img/sms_top.gif" /></td></tr>
		<tr>
			<td background="../img/sms_bg.gif" align="center" height="81" align="center">
			<textarea name="auto[<?=$k?>]['msg_c']" cols="16" rows="5" style="font:9pt 굴림체;overflow:hidden;border:0;background-color:transparent;" onkeydown="return chkLength(this)"><?=$sms_auto['msg_c']?></textarea>
			</td>
		</tr>
		<tr><td><img src="../img/sms_bottom.gif" /></td></tr>
		<tr><td height=3></td></tr>
		</table>
		<? } else {?>
		<img src="../img/sms_only_admin.gif" />
		<? } ?>
		<div><input type="checkbox" name="auto[<?=$k?>]['send_c']" <?=$checked['send_c']?> <?=$disabled['member']?> class="null" />고객에게 자동발송</div>

		</td>
		<td align="center" style="padding-bottom:5px" valign="top">

		<? if (!$deny['admin']){ ?>
		<table cellpadding="0" cellspacing="0">
		<tr><td><img src="../img/sms_top.gif" /></td></tr>
		<tr>
			<td background="../img/sms_bg.gif" align="center" height="81" align="center">
			<textarea name="auto[<?=$k?>]['msg_a']" cols="16" rows="5" style="font:9pt 굴림체;overflow:hidden;border:0;background-color:transparent;" onkeydown="return chkLength(this)"><?=$sms_auto['msg_a']?></textarea>
			</td>
		</tr>
		<tr><td><img src="../img/sms_bottom.gif" /></td></tr>
		<tr><td height=3></td></tr>
		</table>
		<? } else {?>
		<img src="../img/sms_only_user.gif" />
		<? } ?>
		<div style="text-align:left;padding-left:13px;"><input type="checkbox" name="auto[<?=$k?>]['send_a']" <?=$checked['send_a']?> <?=$disabled['admin']?> class="null" />관리자에게도 발송</div>
		<div style="text-align:left;padding-left:13px;"><input type="checkbox" name="auto[<?=$k?>]['send_m']" <?=$checked['send_m']?> <?=$disabled['madmin']?> class="null" />추가관리자에게도 발송</div>
		</td>
	</tr>
	</table>

	</td>
	<? if ($idx++%2){ ?></tr><tr><? } ?>
	<? } ?>
</tr>
</table>

<div class="button">
<table width="800" border="0" align="left">
<tr><td width="343" align="right"><input type="image" src="../img/btn_register.gif" /></td>
<td width="5"></td>
<td width="452" align="left"><a href="javascript:history.back();"><img src="../img/btn_cancel.gif" /></a></td>
</tr></table>
</div>

</form>

<? include "../_footer.php"; ?>