<?php /* Template_ 2.2.7 2013/04/16 10:58:56 /www/loosfly_godo_co_kr/shop/data/skin/loosfly/member/auth_by_mb_email.htm 000002743 */ ?>
<html>
<head>
<title>이메일 인증</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<script src="/shop/data/skin/loosfly/common.js"></script>
<link rel="styleSheet" href="/shop/data/skin/loosfly/style.css">
</head>

<script language="JavaScript">
function chkForm2(f) {
	if(!f.certKey.value || f.certKey.value.length < 8) {
		alert("인증번호를 정확히 입력해 주세요.");
		f.certKey.focus();
		return false;
	}

	parent.nsGodo_PasswordFinder.compareOTP(f.certKey.value, '<?php echo $TPL_VAR["m_id"]?>', '<?php echo $TPL_VAR["token"]?>');

	return false;
}

addOnloadEvent(function() {_ID('certKey').focus();});
</script>

<style type="text/css">
body {background:#ffffff;margin:0;}

.password-auth-form-wrapper {border:2px solid #c7c7c7;width:100%;height:100%;}
.password-auth-form-wrapper h1 {width:100%;height:43px;margin:0;background:url('/shop/data/skin/loosfly/img/common/h_email_authentication.gif') no-repeat top left;text-indent:-1000px;}

.password-auth-form-wrapper .contents {margin:20px 30px;color:#6E6E6E; font-family:dotum; font-size:12px; }
.password-auth-form-wrapper .contents p {margin:0;line-height:130%;}

.password-auth-form-wrapper .contents .form {background:#f1f1f1; border:1px solid #dbdbdb;height:40px;width:100%;margin:20px 0 20px 0;text-align:center;}
	#certKey { border:1px solid #dedede; height:20px; margin-top:10px; width:164px; }

.password-auth-form-wrapper .contents .buttons {text-align:center;}

</style>

<body>

<div class="password-auth-form-wrapper">
	<h1>e-mail 주소 인증</h1>

	<div class="contents">

		<p>
		회원정보상에 등록되어 있는 고객님의 e-mail 주소로 인증번호가 전송되었습니다.
		전송된 인증번호를 입력하여 주세요.
		전송량이 많을 경우 지연될 수 있습니다.
		</p>

		<form name="certForm" method="post" action="" onsubmit="return chkForm2(this)">

			<div class="form">
				<img src="/shop/data/skin/loosfly/img/common/h1_authentication.gif" alt="인증번호" />
				<input type="text" name="certKey" id="certKey" maxlength="8" onkeydown="onlynumber()" />
				<a href="javascript:parent.resend_certKey(<?php echo $GLOBALS["_GET"]["type"]?>);"><img src="/shop/data/skin/loosfly/img/common/btn_re_send.gif" align="absbottom" /></a>
			</div>

			<div class="buttons">
				<input type="image" src="/shop/data/skin/loosfly/img/common/btn_confirm.gif" align="absmiddle" />
				<a href="javascript:parent.closeAuthLayer();"><img src="/shop/data/skin/loosfly/img/common/btn_cancel2.gif" align="absmiddle" /></a>
			</div>

		</form>


	</div>

</div>

</body>
</html>