<?php

include "../_header.popup.php";

$config = Core::loader('config');
$mobilians = Core::loader('Mobilians');

$shopConfig = $config->load('config');
$mobiliansCfg = $config->load('mobilians');
$mobiliansPrefix = $mobilians->lookupPrefix();

$checked = array(
    'serviceType' => array($mobiliansCfg['serviceType'] => ' checked="checked"'),
);

?>
<script type="text/javascript">
window.onload = function()
{
	resizeFrame();
};

function mobiliansConfigFormSubmit(frm)
{
	var
	originEnv = "<?php echo $mobiliansCfg['serviceType']; ?>",
	selectRealEnv = null,
	warningMsg = "서비스환경을 실거래 환경으로 선택하셨습니다.\r\n"
		   + "모빌리언스 담당자와 협의없이 실거래 환경으로 전환 시\r\n"
		   + "결제가 되지않아 클레임이 발생할 수 있습니다.\r\n"
		   + "계속하시겠습니까?";
	for (var serviceTypeIndex = 0, selectedServiceType = frm.serviceType[0]; selectedServiceType; selectedServiceType = frm.serviceType[++serviceTypeIndex]) {
		if(frm.serviceType[serviceTypeIndex].value === "10" && frm.serviceType[serviceTypeIndex].checked === true) selectRealEnv = true;
	}
	// 실거래를 선택했는데 확인창에 동의 하지 않은경우는 false
	if (originEnv !== "10" && selectRealEnv === true && confirm(warningMsg) === false) {
		return false;
	}
	else {
		return chkForm(frm);
	}
}

var IntervarId;
function resizeFrame()
{

    var oBody = document.body;
    var oFrame = parent.document.getElementById("pgifrm");
    var i_height = oBody.scrollHeight + (oFrame.offsetHeight-oFrame.clientHeight);
    oFrame.style.height = i_height;
	oFrame.height = i_height;

    if ( IntervarId ) clearInterval( IntervarId );
}
</script>
<div class="title title_top">
모빌리언스 설정 <a href="javascript:manual('<?php echo $guideUrl; ?>board/view.php?id=basic&no=38')"><img src="../img/btn_q.gif" border=0 align=absmiddle></a>
</div>
<form action="<?php echo $shopConfig['rootDir']; ?>/admin/basic/adm_basic_pgCell.mobilians.indb.php" method="post" onsubmit="return mobiliansConfigFormSubmit(this);">
	<table border="1" bordercolor="#e1e1e1" style="border-collapse:collapse" width="100%">
		<col class="cellC"><col class="cellL">
		<tr>
			<td height="40">서비스환경</td>
			<td class="noline">
				<div style="margin: 8px 0; padding-left: 10px;" class="red">
					<strong>※주의사항</strong>
					<ol style="padding: 0 0 0 20px; margin: 5px 0 0 0;">
						<li style="margin-bottom: 5px;">
							모빌리언스 서비스 사용을 위해서는 먼저 서비스 ID 입력 후 서비스환경을 "테스트"로 설정 하여, 결제 테스트를 진행해주셔야 합니다.<br/>
							테스트 후 모빌리언스 담당자와 협의 후 서비스환경을 "실거래"로 변경해주셔야 합니다.<br/>
							※ 모빌리언스 담당자와 협의 없이 실거래로 변경하여 발생하는 문제에 대해서는 모빌리언스 및 고도소프트 에서는 책임을 지지 않습니다. 
						</li>
						<li style="margin-bottom: 5px;">
							서비스환경에서 "테스트", "실거래" 설정 시 스킨패치를 진행하셨는지 확인하여주시기 바라며, 스킨패치 방법은 메뉴얼을 참고하여주시기 바랍니다.<br/>
							※ 2013년 06월 07일 이전 구매자만 스킨패치를 적용해주시면 됩니다.
							<a href="javascript:manual('<?php echo $guideUrl; ?>board/view.php?id=basic&no=38')"><img src="../img/btn_q.gif" border="0" align="absmiddle"/></a>
						</li>
						<li>
							결제취소 가능시간 : 결제 월 말일까지만 취소 처리 가능하므로 결제 월 이후에는 쇼핑몰(관리자)이 구매자에게 다른 수단(무통장, 적립금 등)으로<br/>
							환불 처리해야 합니다.<br/>
							Ex1) 2013년 5월 01일 승인 > 5월 31일 24시까지만 결제 취소 가능<br/>
							Ex2) 2013년 5월 31일 승인 > 6월 1일 결제 취소 요청 할 경우 결제 취소 처리 불가 > 구매자에게 다른수단(무통장,적립금 등)으로 환불처리만 가능
						</li>
					</ol>
				</div>
				<div style="margin: 8px 0;">
					<input id="svc-type-10" type="radio" name="serviceType" value="10"<?php echo $checked['serviceType']['10']; ?> required label="서비스환경"/>
					<label for="svc-type-10">실거래</label>
					<input id="svc-type-00" type="radio" name="serviceType" value="00"<?php echo $checked['serviceType']['00']; ?>/>
					<label for="svc-type-00">테스트</label>
					<input id="svc-type-no" type="radio" name="serviceType" value="no"<?php echo $checked['serviceType']['no']; ?>/>
					<label for="svc-type-no">사용안함</label>
					<span class="extext">모빌리언스 서비스의 거래상태로, 항목별 자세한 내용은 하단, "궁금증해결!"코너를 참조하세요</span>
				</div>
			</td>
		</tr>
		<tr>
			<td height="40">서비스ID</td>
			<td>
				<input type="text" name="serviceId" value="<?php echo $mobiliansCfg['serviceId']; ?>" required label="서비스ID"/>
				<span class="extext">모빌리언스에서 상점별로 발급되는 아이디 입니다.(숫자 12자리이며, <?php echo implode(',', $mobiliansPrefix); ?>로 시작되어야 함)</span>
			</td>
		</tr>
	</table>

	<div class="button">
		<input type="image" src="../img/btn_save.gif">
		<a href="javascript:history.back()"><img src="../img/btn_cancel.gif"></a>
	</div>
</form>
<!-- 궁금증 해결 : Start -->
<div id="MSG01">
	<table cellpadding="1" cellspacing="0" border="0" class="small_ex">
		<tr>
			<td>
				<img src="../img/icon_list.gif" align="absmiddle">
				<div style="margin-bottom: 7px;">
					<span style="font-weight: bold;">서비스환경</span>
					<div>
						실거래 : 쇼핑몰에 접속한 모든 사용자들이 모빌리언스 서비스를 사용할 수 있으며, 실제로 결제가 이루어집니다.<br/>
						테스트 : 관리자급 회원만 모빌리언스 서비스를 사용할 수 있으며, 결제과정은 동일하되 실제로 결제가 이루어지지는 않습니다.<br/>
						사용안함 : 모빌리언스 서비스를 비활성화 시켜 모빌리언스 결제가 노출되지 않습니다.
					</div>
				</div>
				<div>
					<span style="font-weight: bold;">모빌리언스 서비스 정보</span>
					<div>
						모빌리언스와 계약을 맺은 이후 메일로 받는 정보입니다.<br/>
						서비스ID : 결제서비스 사용을 위해 상점으로 발급되는 아이디 입니다.(숫자 12자리)<br/>
						MasterID : 모빌리언스 관리아이디로 <a href="https://www.mcash.co.kr/cpmgr" target="_blank">[모빌리언스 관리자]</a> 접속 시에 사용됩니다.
					</div>
				</div>
			</td>
		</tr>
	</table>
</div>
<script type="text/javascript">cssRound('MSG01');</script>