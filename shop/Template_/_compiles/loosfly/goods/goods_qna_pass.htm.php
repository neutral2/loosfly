<?php /* Template_ 2.2.7 2013/04/16 10:58:39 /www/loosfly_godo_co_kr/shop/data/skin/loosfly/goods/goods_qna_pass.htm 000001844 */ ?>
<html>
<head>
<title>상품문의인증</title>
<script src="/shop/data/skin/loosfly/common.js"></script>
<!-- 2013-01-16 dn 상품 QA 게시판 비회원 글 비밀번호 입력후 수정 폼 보여지게 수정 관련 입력창 resizing javascript 소스추가 -->
<script type="text/javascript">
function fitWin() {
	window.resizeTo(400,250);
}
</script>
<link rel="styleSheet" href="/shop/data/skin/loosfly/style.css">
</head>
<body onLoad="fitWin();">

<form method=post action="<?php echo url("goods/indb.php")?>&" onSubmit="return chkForm(this)">
<!-- 2013-01-16 dn 상품 QA 게시판 비회원 글 비밀번호 입력후 수정 폼 보여지게 수정 관련 mode element value 값 변수로 변경(기존 값 : auth_qna) -->
<input type=hidden name=mode value="<?php echo $GLOBALS["mode"]?>">
<input type=hidden name=sno value="<?php echo $GLOBALS["sno"]?>">

<table width=100% cellpadding=0 cellspacing=0 border=0>
<tr>
	<td height=200 style="border:10px solid #000000" valign=top>

	<div style="width:100%; background:#000000; border-bottom:2px solid #DDDDDD"><img src="/shop/data/skin/loosfly/img/common/title_auth.gif"></div>
	<div style="text-align:center;margin-top:20px;">비밀번호를 입력해주세요.</div>
	<div style="text-align:center;margin-top:10px;">

	<span class="input_txt">비밀번호</span> <span id=form><input type=password name=password style="width:100" required label="비밀번호"></span>
	<input type=image src="/shop/data/skin/loosfly/img/common/btn_auth2.gif" align="absmiddle">
	</div>

	<div style="width:100%; text-align:right; padding-top:20"><A HREF="javascript:this.close()" onFocus="blur()"><img src="/shop/data/skin/loosfly/img/common/popup_close.gif"></A></div>

	</td>
</tr>
</table>

</form>

</body>
</html>