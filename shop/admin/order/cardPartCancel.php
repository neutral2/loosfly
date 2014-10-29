<?php
include "../lib.php";
include "../../conf/config.php";
include_once '../../conf/pg.'.$cfg['settlePg'].'.php';
include "../../lib/cardCancel.class.php";

if($_POST[mode] == "repay" ){
	$partCancel = new cardCancel();

	$partCancel->price = $_POST['price']; // 취소금액
	$partCancel->repay = $_POST['repay']; // 환불접수 된 금액 ( 전체주문건에서 환불접수된 상품금액의 합 )

	$res = $partCancel->partCancel_pg($_POST[ordno],$_POST['sno']);

	if($res){
		msg('결제승인취소완료');
		echo("<script>parent.location.reload();</script>");
	}
}

if($_GET['ordno']){

	$query = "select a.cardtno, a.settleprice from ".GD_ORDER." a left join ".GD_ORDER_CANCEL." b on a.ordno=b.ordno where b.sno='".$_GET['sno']."' limit 1 ";
	$res = $db->fetch($query);
?>
<link rel="styleSheet" href="../style.css">
<script src="../common.js"></script>
<form name="frmIni" method="post" action="cardPartCancel.php">
<input type="hidden" name="mode" value="" />
<input type="hidden" name="ordno" value="<?=$_GET['ordno']?>" /> <!-- 주문번호 -->
<input type="hidden" name="sno" value="<?=$_GET['sno']?>" /> <!-- 환불접수번호 -->
<input type="hidden" name="repay" value="<?=$_GET['repay']?>" /> <!-- 환불접수된 금액 -->
	<div class="subtitle">
		<div class="title title_top">카드 결제 부분 취소<span></span></div>
	</div>
	<div class="input_wrap">
		<table class=tb>
		<col class="cellC">
		<col class="cellL">
		<tr>
			<th class="input_title r_space">취소할 금액</th>
			<td class="input_area"><input type="text" name="price" value="<?=$_GET['lastRepay']?>" onblur="price_calculate();" class="input_text width_small" /> 원</td>
		</tr>
		</table>
		<div style="padding-top:10px;" align="center">
			<input type="button" onClick="javascript:formChk();" value="카드 부분 취소" id="subBtn" /></a>
		</div>
	</div>
</form>

<script>
	function formChk(){
		if(price_calculate()){
			document.getElementById("subBtn").disabled=true;
			document.getElementsByName('mode')[0].value = "repay";
			frmIni.submit();
		}
	}

	function price_calculate(){
		// 취소할 금액
		var cancelPrice = document.getElementsByName('price')[0].value;

		// 취소할 금액 체크
		if (cancelPrice < 0 || cancelPrice == '') {
			alert('취소할 금액은 0원 이상이여야 합니다.');
			document.getElementsByName('price')[0].value = "";
			return false;
		}

		// 승인요청 금액
		var check_price	= parseInt(<?php echo $_GET[repay];?>) - parseInt(cancelPrice);

		// 최종 환불금액 체크
		if (check_price < 0) {
			alert('승인요청 금액오류! (최대 <?php echo number_format($_GET[repay]);?>원)');
			document.getElementsByName('price')[0].value = "";
			return false;
		}

		return true;
	}
	table_design_load();
</script>

<?
}
?>
