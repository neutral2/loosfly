<?php
$channel = preg_replace('/_form\.([a-z]+)\.php/','$1',basename(__FILE__));
// 외부 주문건이므로 중계서버의 데이터를 동기화 한후 보여준다.

/*
$integrate_order = Core::loader('integrate_order');
$integrate_order -> doSync();
*/


// 주문정보
$orderInfo = $db->fetch("SELECT * FROM ".GD_INTEGRATE_ORDER." WHERE channel = '$channel' AND ordno = '".$_GET['ordno']."'",1);

if (!$orderInfo) {
	msg('주문정보가 존재하지 않습니다.',-1);
	exit;
}

// 주문상품정보
$orderItems = array();

$query = "
SELECT
	OI.*
FROM ".GD_INTEGRATE_ORDER." AS O
INNER JOIN ".GD_INTEGRATE_ORDER_ITEM." AS OI
ON O.channel = OI.channel AND O.ordno = OI.ordno
WHERE O.channel = '$channel' AND O.ordno = '".$_GET['ordno']."'
";
$rs = $db->query($query);
while ($item = $db->fetch($rs,1)) {
	$orderItems[] = $item;
}


?>
<div class="title title_top">주문상세내역</div>
<table class="tb" cellpadding="4" cellspacing="0">
<tr height="25" bgcolor="#2E2B29" class="small4" style="padding-top:8px">
	<th><font color="white">번호</font></th>
	<th><font color="white">상품명</font></th>
	<th><font color="white">옵션</font></th>
	<th><font color="white">수량</font></th>
	<th><font color="white">상품가격</font></th>
</tr>
<col align=center>
<col>
<col align=center span=4>
<? for ($i=0,$m=sizeof($orderItems);$i<$m;$i++) { ?>
<? $item = $orderItems[$i]; ?>
<tr>
	<td width=70 nowrap><?=($i+1)?></td>
	<td width=100%><?=htmlspecialchars($item['goodsnm'])?></td>
	<td width=200 nowrap><?=htmlspecialchars($item['option'])?></td>
	<td width=80 nowrap><?=number_format($item['ea'])?></td>
	<td width=150 nowrap><?=number_format($item['price'])?>원</td>
</tr>
<? } ?>
</table>
<br><br>

<div class="title2" style="margin:0px 0px 5px 0px">&nbsp;<img src="../img/icon_process.gif" align="absmiddle"><font color="508900"><b>주문정보</b></font></div>
<table class="tb">
<col class="cellC"><col class="cellL">
<tr>
	<td>주문 일시</td>
	<td><?=($orderInfo['ord_date'])?></td>
</tr>
<tr>
	<td>주문 상태</td>
	<td><?=$integrate_cfg['step'][$orderInfo['ord_status']]?></td>
</tr>
<tr>
	<td>판매 완료 일시</td>
	<td><?=($orderInfo['fin_date'])?></td>
</tr>
</table>
<br><br>

<!-- 주문접수(발주확인) -->
<? if($orderInfo['ord_status'] == 1) { ?>
<form name="frmPlaceOrder" id="frmPlaceOrder" action="./indb.php" target="_self" method="post">
<input type="hidden" name="mode" value="integrate_action">
<input type="hidden" name="ord_status" value="2">
<input type="hidden" name="ordno" value="<?=$orderInfo['ordno']?>">
<input type="hidden" name="channel" value="<?=$orderInfo['channel']?>"><table class="tb">
<col class="cellC"><col class="cellL">
<tr>
	<td>주문접수처리</td>
	<td><input type="button" value="주문접수하기" onclick="document.frmPlaceOrder.submit()"></td>
</tr>
</table>
</form>
<br>
<? } ?>

<!-- 발송처리 -->
<? if($orderInfo['ord_status'] == 2) { ?>
<form name="frmShipOrder" id="frmShipOrder" action="./indb.php" target="_self" method="post">
<input type="hidden" name="mode" value="integrate_action">
<input type="hidden" name="ord_status" value="3">
<input type="hidden" name="ordno" value="<?=$orderInfo['ordno']?>">
<input type="hidden" name="channel" value="<?=$orderInfo['channel']?>">
<table class="tb">
<col class="cellC"><col class="cellL">
<tr>
	<td>발송처리</td>
	<td>
		<table cellpadding="0">
		<td>배송방법 :</td>
		<td>
		<select name="dlv_company">
		<option value="">(선택)</option>
		<? foreach ($integrate_cfg['dlv_company']['ipay'] as $code => $name) { ?>
		<option value="<?=$code?>"><?=$name?></option>
		<? } ?>
		</select>
		</td>
		</tr>
		<tr>
		<td>송장번호 :</td>
		<td><input type="text" name="dlv_no" style="width:300px" class="iptTrackingNumber"></td>
		</tr>
		<tr>
		<td></td>
		<td> <input type="button" value="발송처리하기" onclick="document.frmShipOrder,submit();"></td>
		</tr>
		</table>
	</td>
</tr>
</table></form>
<br>
<? } ?>

<!-- 판매 거부 처리 -->
<? if($orderInfo['ord_status'] == 1) { ?>
<form name="frmCancelSale" id="frmCancelSale" action="./indb.php" target="_self" method="post">
<input type="hidden" name="mode" value="integrate_action">
<input type="hidden" name="ord_status" value="11">
<input type="hidden" name="ordno" value="<?=$orderInfo['ordno']?>">
<input type="hidden" name="channel" value="<?=$orderInfo['channel']?>">
<input type="hidden" name="reject" value="1"><!-- 취소승인 처리와 결과 코드가 같으나 액션이 달라, 판매 거부 임을 알리기 위함. -->
<table class="tb">
<col class="cellC"><col class="cellL">
<tr>
	<td>판매불가처리</td>
	<td>
		<table cellpadding="0">
		<tr>
		<td>판매불가 사유 :</td>
		<td>
		<select name="cs_reason_code" style="width:150px">
		<? foreach($integrate_cfg['claim_code']['ipay'] as $code => $name) { ?>
		<? if ($code > 100) continue; ?>
		<option value="<?=$code?>"><?=$name?></option>
		<? } ?>
		</select>
		</td>
		<tr>
		<td>판매불가 메세지 :</td>
		<td><input type="text" name="cs_reason" style="width:300px"></td>
		</tr>
		<tr>
		<td></td>
		<td> <input type="button" value="판매취소하기 " onclick="document.frmCancelSale.submit()"></td>
		</tr>
		</table>
	</td>
</tr>
</table></form>
<br>
<? } ?>

<!-- 주문취소(취소승인) -->
<? if($orderInfo['ord_status'] == 10) { ?>
<form name="frmCancelOrder" id="frmCancelOrder" action="./indb.php" target="_self" method="post">
<input type="hidden" name="mode" value="integrate_action">
<input type="hidden" name="ord_status" value="11">
<input type="hidden" name="ordno" value="<?=$orderInfo['ordno']?>">
<input type="hidden" name="channel" value="<?=$orderInfo['channel']?>">
<table class="tb">
<col class="cellC"><col class="cellL">
<tr>
	<td>주문취소처리</td>
	<td>
		<table cellpadding="0">
		<tr>
		<td>주문취소 사유 :</td>
		<td>
		<select name="cs_reason_code">
		<? foreach($integrate_cfg['claim_code']['ipay'] as $code => $name) { ?>
		<option value="<?=$code?>"><?=$name?></option>
		<? } ?>
		</select>
		</td>
		<!--tr>
		<td>주문취소 메세지 :</td>
		<td><input type="text" name="cs_reason" style="width:300px"></td>
		</tr-->
		<tr>
		<td></td>
		<td> <input type="button" value="주문취소하기 " onclick="document.frmCancelOrder.submit()"></td>
		</tr>
		</table>
	</td>
</tr>
</table></form>
<br>
<? } ?>


<div class="title2" style="margin:0px 0px 5px 0px">&nbsp;<img src="../img/icon_process.gif" align="absmiddle"><font color="508900"><b>결제정보</b></font></div>
<table class="tb">
<col class="cellC"><col class="cellL">
<tr>
	<td>주문 금액</td>
	<td><?=number_format($orderInfo['ord_amount'])?>원</td>
</tr>
<tr>
	<td>배송비</td>
	<td><?=number_format($orderInfo['dlv_amount'])?>원</td>
</tr>
<tr>
	<td>결제 금액</td>
	<td><?=number_format($orderInfo['pay_amount'])?>원</td>
</tr>
<tr>
	<td>결제 방법</td>
	<td>-</td>
</tr>
<tr>
	<td>결제 일시</td>
	<td><?=($orderInfo['pay_date'])?></td>
</tr>

<tr>
	<td>배송비 종류</td>
	<td><?=htmlspecialchars($orderInfo['dlv_type'])?></td>
</tr>
</table>


<br><br>
<table border="0" width="100%">
<tr>
<td width="50%"  valign="top">
	<div class="title2" style="margin:0px 0px 5px 0px">&nbsp;<img src="../img/icon_process.gif" align="absmiddle"><font color="508900"><b>주문자정보</b></font></div>
	<table class="tb">
	<col class="cellC"><col class="cellL">
	<tr>
		<td>이름</td>
		<td><?=htmlspecialchars($orderInfo['ord_name'])?></td>
	</tr>
	<tr>
		<td>아이디(옥션)</td>
		<td><?=htmlspecialchars($orderInfo['m_id_out'])?></td>
	</tr>
	<tr>
		<td>연락처</td>
		<td><?=htmlspecialchars($orderInfo['ord_mobile'])?></td>
	</tr>
	<tr>
		<td>메일 주소</td>
		<td><?=htmlspecialchars($orderInfo['ord_email'])?></td>
	</tr>
	</table>
</td>
<td width="50%" valign="top">
	<div class="title2" style="margin:0px 0px 5px 0px">&nbsp;<img src="../img/icon_process.gif" align="absmiddle"><font color="508900"><b>수령자 정보</b></font></div>
	<table class="tb">
	<col class="cellC"><col class="cellL">
	<tr>
		<td>이름</td>
		<td><?=htmlspecialchars($orderInfo['rcv_name'])?></td>
	</tr>
	<tr>
		<td>배송지 주소</td>
		<td>(<?=substr($orderInfo['rcv_zipcode'],0,3)?>-<?=substr($orderInfo['rcv_zipcode'],3,3)?>) <br>
		<?=$orderInfo['rcv_address']?> </td>
	</tr>
	<tr>
		<td>연락처1</td>
		<td><?=htmlspecialchars($orderInfo['rcv_phone'])?></td>
	</tr>
	<tr>
		<td>연락처2</td>
		<td><?=htmlspecialchars($orderInfo['rcv_mobile'])?></td>
	</tr>
	<tr>
		<td>배송 메세지</td>
		<td><?=htmlspecialchars($orderInfo['dlv_message'])?></td>
	</tr>
	</table>
</td>
</table>

<br><br>


<table border="0" width="100%">
<tr>
<td width="50%"  valign="top">
	<div class="title2" style="margin:0px 0px 5px 0px">&nbsp;<img src="../img/icon_process.gif" align="absmiddle"><font color="508900"><b>배송정보</b></font></div>
	<table class="tb">
	<col class="cellC"><col class="cellL">
	<tr>
		<td>배송 일시</td>
		<td><?=($orderInfo['dlv_date'])?></td>
	</tr>
	<tr>
		<td>배송 방법</td>
		<td><?=$orderInfo['dlv_method']?></td>
	</tr>
	<tr>
		<td>배송사</td>
		<td><?=$integrate_cfg['dlv_company']['shople'][$orderInfo['dlv_company']]?></td>
	</tr>
	<tr>
		<td>송장 번호</td>
		<td><?=htmlspecialchars($orderInfo['dlv_no'])?></td>
	</tr>
	<tr>
		<td>배송 완료 일시</td>
		<td><?=($orderInfo['fin_date'])?></td>
	</tr>
	</table>
</td>
<td width="50%" valign="top">
	<div class="title2" style="margin:0px 0px 5px 0px">&nbsp;<img src="../img/icon_process.gif" align="absmiddle"><font color="508900"><b>취소/반품/교환 정보</b></font></div>
	<?
	$cs_type = null;
	switch (floor($orderInfo['ord_status'] / 10) * 10) {	// x 번대
		case 10 :
			$cs_type = '취소';
			break;
		case 20 :
			$cs_type = '환불';
			break;

		case 30 :
			$cs_type = '반품';
			break;
		case 40 :
			$cs_type = '교환';
			break;
	}
	?>
	<? if ($cs_type !== null) { ?>
	<table class="tb">
	<col class="cellC"><col class="cellL">
	<tr>
		<td><?=$cs_type?> 신청 일시</td>
		<td><?=($orderInfo['cs_regdt'])?></td>
	</tr>
	<tr>
		<td><?=$cs_type?> 처리 일시</td>
		<td><?=($orderInfo['cs_confirmdt'])?></td>
	</tr>
	<tr>
		<td><?=$cs_type?> 사유</td>
		<td><?=($orderInfo['cs_reason_type'])?></td>
	</tr>
	<tr>
		<td><?=$cs_type?> 사유 (자세히)</td>
		<td><?=htmlspecialchars($orderInfo['cs_reason'])?></td>
	</tr>
	</table>
	<? } ?>
</td>
</table>

<br><br>