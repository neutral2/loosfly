<?php /* Template_ 2.2.7 2013/04/16 10:58:56 /www/loosfly_godo_co_kr/shop/data/skin/loosfly/member/change_pwd.htm 000006692 */ ?>
<html>
<head>
<title>비밀번호 변경/등록</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<script src="/shop/data/skin/loosfly/common.js"></script>
<link rel="styleSheet" href="/shop/data/skin/loosfly/style.css">
</head>
<script src="/shop/data/skin/loosfly/godo.password_strength.js" type="text/javascript"></script>
<script language="JavaScript">

function checkPassword() {

	if(_ID('newPassword').value) {

		var param = {
			form : document.frmMember,
			fields : ['m_id', 'birth_year', 'phone[]', 'birth[]', 'mobile[]', 'email']
		}

		nsGodo_PasswordStrength.appendBlacklist(param);
		nsGodo_PasswordStrength.appendBlacklist(param);


		var result = nsGodo_PasswordStrength.check( _ID('newPassword') );

		_ID('el-password-strength-indicator-msg').innerText = result.msg;
		_ID('el-password-strength-indicator-level').className = 'lv'+result.level;
		_ID('el-password-strength-indicator-level').innerText = result.levelText;
		_ID('el-password-strength-indicator').style.display = 'block';


	}
	else {
		emptyPwState();
	}

}

function emptyPwState() {
	_ID('el-password-strength-indicator').style.display = "none";
}

function chkForm2(f) {

	if(!_ID('newPassword').value) {
		alert("새 비밀번호를 입력해 주세요.");
		_ID('newPassword').focus();
		return false;
	}
	if(!_ID('confirmPassword').value) {
		alert("새 비밀번호 확인을 입력해 주세요.");
		_ID('confirmPassword').focus();
		return false;
	}
	if(_ID('newPassword').value != _ID('confirmPassword').value) {
		alert("새 비밀번호와 비빌번호 확인이 일치하지 않습니다.");
		_ID('confirmPassword').focus();
		return false;
	}

	parent.nsGodo_PasswordFinder.changePwd(_ID('newPassword').value, '<?php echo $TPL_VAR["m_id"]?>', '<?php echo $TPL_VAR["token"]?>');

	return false;

}
</script>

<style type="text/css">

body {background:#F1F1F1;margin:0;}

.password-auth-form-wrapper {border:2px solid #c7c7c7;width:100%;height:100%;background:url('/shop/data/skin/loosfly/img/common/h_change_pass.gif') no-repeat top left;}
.password-auth-form-wrapper h1 {width:100%;height:43px;margin:0;background:url('/shop/data/skin/loosfly/img/common/h_change_pass.gif') no-repeat top left;text-indent:-1000px;}

.password-auth-form-wrapper .contents {background:#ffffff;padding:20px 30px;color:#6E6E6E; font-family:dotum; font-size:12px; }
.password-auth-form-wrapper .contents p {margin:0;line-height:130%;}

.password-auth-form-wrapper .contents .form {background:#f1f1f1; border:1px solid #dbdbdb;width:100%;margin:20px 0 20px 0;text-align:center;padding:10px 0 10px 0;}
.password-auth-form-wrapper .contents .form input.password {border:1px solid #dedede; height:20px; width:164px;}
.password-auth-form-wrapper .contents .form table th {text-align:left;}

.password-auth-form-wrapper .contents .buttons {text-align:center;}


#pwManual {border-top:1px solid #C7C7C7;background:#F1F1F1;}
#pwManual p { background:url('/shop/data/skin/loosfly/img/common/blt_tip_gr.gif') no-repeat 10px center;margin:0;padding:12px 10px 12px 50px;color:#373737;font-weight:bold;}
#pwManual p.close { background:none;padding:0px 10px 5px 0;margin:0;text-align:right;}
#pwManual ul {list-style:none;margin:0;padding:15px;}
#pwManual ul li {color:#6E6E6E; font-size:11px; line-height:17px;letter-spacing:-1px;}

div.passwordStrenth {background-color:#FFFFFF; border:1px #CCCCCC solid; padding:10px; width:263px;display:none; position:absolute;left:-95px;top:26px;}

div.passwordStrenth p {margin:0;padding:5px 0 0 0; font-size:11px; font-family:dotum;color:#616161; }

div.passwordStrenth dl {margin:0;padding:0 6px 0 0;color:#373737; font-weight:bold;font-size:11px; font-family:dotum; }
div.passwordStrenth dl dt,
div.passwordStrenth dl dd {display:inline;font-size:11px; font-family:dotum;margin:0;height:15px;line-height:15px;}

div.passwordStrenth dl dt {color:#363636; font-weight:bold; width:95px;}

div.passwordStrenth dl dd {text-indent:0px;font-size:12px; width:110px;background:url('/shop/data/skin/loosfly/img/common/password_level.gif') no-repeat top left;}
div.passwordStrenth dl dd.lv0 {color:#F52D00;background-position:20px 0;}
div.passwordStrenth dl dd.lv1 {color:#F52D00;background-position:20px -29px;}
div.passwordStrenth dl dd.lv2 {color:#F52D00;background-position:20px -44px;}
div.passwordStrenth dl dd.lv3 {color:#F52D00;background-position:20px -59px;}
div.passwordStrenth dl dd.lv4 {color:#F52D00;background-position:20px -59px;}

</style>

<body>

<div class="password-auth-form-wrapper">
	<h1>비밀번호 변경/등록</h1>

	<div class="contents">

		<p>
		인증이 정상적으로 완료되었습니다.
		새로운 비밀번호를 등록하여 주세요.
		</p>

		<form name="certForm" method="post" onsubmit="return chkForm2(this)">


			<div class="form">
				<table border="0">
				<tr>
					<th><img src="/shop/data/skin/loosfly/img/common/h1_n_pass.gif" alt="새 비밀번호" /><th>
					<td style="position:relative;">
						<input type="password" name="newPassword" id="newPassword" class="password" onfocus="checkPassword()" onkeyup="checkPassword()" onblur="emptyPwState()" />
						<div class="passwordStrenth" id="el-password-strength-indicator">
						<dl>
							<dt>비밀번호 안전도</dt>
							<dd id="el-password-strength-indicator-level"></dd>
						</dl>
						<p id="el-password-strength-indicator-msg"></p>
						</div>
					</td>
				</tr>
				<tr>
					<th><img src="/shop/data/skin/loosfly/img/common/h1_n_pass01.gif" alt="새 비밀번호 확인" /><th>
					<td><input type="password" name="confirmPassword" class="password" id="confirmPassword" /></td>
				</tr>
				</table>
			</div>

			<div class="buttons">
				<input type="image" src="/shop/data/skin/loosfly/img/common/btn_confirm.gif" align="absmiddle" />
				<a href="javascript:parent.closeAuthLayer();"><img src="/shop/data/skin/loosfly/img/common/btn_cancel2.gif" align="absmiddle" /></a>
			</div>

		</form>

	</div>

	<div id="pwManual">
		<p>
			비밀번호에 영문 대소문자, 숫자, 특수문자를 조합하시면 비밀번호 안전도가 높아져 도용의 위험이 줄어듭니다.
		</p>
		<ul>
			<li>영문 대소문자는 구분이 되며, 한가지 문자로만 입력은 위험합니다.</li>
			<li>사용가능한 특수문자 : ! " @ # $ % ^ & ' ( ) * + = , - _ . : ; < > ? /  ` ~ | { } </li>
			<li>ID, 주민번호 , 생일, 전화번호 등의 개인정보와 통상 사용 순서대로의 3자 이상 연속 사용은 피해주세요.</li>
			<li>비밀번호는 주기적으로 바꾸어 사용하시는 것이 안전합니다.</li>
		</ul>
	</div>

</div>

</body>
</html>