<?php /* Template_ 2.2.7 2013/04/16 10:58:57 /www/loosfly_godo_co_kr/shop/data/skin/loosfly/mypage/mypage_qna_order.htm 000002562 */ 
$TPL__loop_1=empty($GLOBALS["loop"])||!is_array($GLOBALS["loop"])?0:count($GLOBALS["loop"]);?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<title>++ GODOMALL ++</title>
<script src="/shop/data/skin/loosfly/common.js"></script>
<link rel="styleSheet" href="/shop/data/skin/loosfly/style.css">
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width=100% height=100% cellpadding=0 cellspacing=0 border=0>
<tr>
	<td height=260 style="border:10px solid #000000" valign=top>

	<table height=100% width=95% cellpadding=0 cellspacing=0 border=0 align=center>
	<tr>
		<td height=100% valign=top>

		<TABLE cellpadding=3 cellspacing=0 border=0>
		<tr><td class=stxt style="padding-top:10">문의하실 주문번호를 선택하세요.</td></tr>
		</TABLE>

		<table width=100% cellpadding=0 cellspacing=0 border=0 style="margin-top:10px;">
		<col width=20%>
		<col width=12%>
		<col width=36%>
		<col width=10%>
		<col width=15%>
		<col width=7%>
		<tr height=19 bgcolor="#A8A8A8">
			<th style="font:bold 8pt 돋움; color:#FFFFFF">주문번호</th>
			<th style="font:bold 8pt 돋움; color:#FFFFFF">주문일자</th>
			<th style="font:bold 8pt 돋움; color:#FFFFFF">상품명</th>
			<th style="font:bold 8pt 돋움; color:#FFFFFF">수량</th>
			<th style="font:bold 8pt 돋움; color:#FFFFFF">주문금액</th>
			<th style="font:bold 8pt 돋움; color:#FFFFFF">선택</th>
		</tr>
<?php if($TPL__loop_1){$TPL_I1=-1;foreach($GLOBALS["loop"] as $TPL_V1){$TPL_I1++;?>
		<tr <?php if($TPL_I1% 2){?>bgcolor="#f7f7f7"<?php }?> height=25 align=center>
			<td><?php echo $TPL_V1["ordno"]?></td>
			<td><?php echo $TPL_V1["orddt"]?></td>
			<td><?php echo $TPL_V1["goodsnm"]?></td>
			<td align=right><?php echo number_format($TPL_V1["ea"])?> 개</td>
			<td align=right><?php echo number_format($TPL_V1["settleprice"])?> 원</td>
			<td><input type="radio" name="" onclick="parent.order_put('<?php echo $TPL_V1["ordno"]?>')"></td>
		</tr>
		<tr><td colspan=6 height=1 bgcolor="E5E5E5"></td></tr>
<?php }}?>
		</table>

		<div style="padding:10px" align=center><?php echo $TPL_VAR["pg"]->page['navi']?></div>


		</td>
	</tr>
	<TR>
		<TD height="19" align=right><A HREF="javascript:parent.order_close()" onFocus="blur()"><img src="/shop/data/skin/loosfly/img/common/popup_close.gif"></A></TD>
	</TR>
	</table>

	</td>
</tr>
</table>
</body>
</html>