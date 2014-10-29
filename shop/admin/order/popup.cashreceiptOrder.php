<?
include '../_header.popup.php';
list($cnt) = $db->fetch("select count(*) from ".GD_CASHRECEIPT." where ordno='{$_GET['ordno']}' and status in ('RDY', 'ACK')");
?>

<div class="title title_top">현금영수증 요청</div>

<? if ($cnt){ ?>
<div style="border:solid 1px #BDBDBD; padding:1px;">
	<div style="border:solid 1px #DBDBDB; padding:20px; background-color:#F9F9F9;">
		이미 현금영수증 발급을 요청하셨습니다.
	</div>
</div>
<? } else { ?>
<? include './cashreceipt._form.php'; ?>
<? } ?>

<div id="MSG01">
<table cellpadding=1 cellspacing=0 border=0 class=small_ex>
<tr><td><img src="../img/icon_list.gif" align="absmiddle">현금영수증 발급시 국세청에 통보되기 때문에 정확한 자료를 입력합니다.</td></tr>
<tr><td><img src="../img/icon_list.gif" align="absmiddle">발급요청 후 <a onclick="parent.location.href='../order/cashreceipt.list.php';" style="cursor:pointer;">[현금영수증 발급/조회]</a> 에서 발급하여야 합니다.</font></td></tr>
</table>
</div>
<script>cssRound('MSG01')</script>

<script>table_design_load();</script>