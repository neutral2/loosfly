<?php /* Template_ 2.2.7 2013/04/16 10:58:58 /www/loosfly_godo_co_kr/shop/data/skin/loosfly/proc/_captcha.htm 000002062 */ ?>
<table cellpadding=0 cellspacing=0>
<tr>
<td>
	<IMG src="../proc/captcha.php" align="absmiddle" id="el-captcha-text">
</td>
<td width=10></td>
<td><div class=stxt>보이는 순서대로 숫자 및 문자를 모두 입력해 주세요. <a href="javascript:void(0);" onClick="fnRefreshCaptchaText();"><img src="/shop/data/skin/loosfly/img/common/btn_img_click.gif" align="absmiddle"></a></div>
<div><input name=captcha_key style="width:120;" maxlength=5 style="ime-mode:disabled;text-transform:uppercase;" onKeyUp="javascript:this.value=this.value.toUpperCase();" onfocus="this.select()" label="자동등록방지문자" class=linebg required></div></td>
</tr></table>

<script type="text/javascript">
var chkFormSubExist = false;
if (typeof(chkFormSub) == 'function') {
	chkFormSubExist = true;
}
if (chkFormSubExist === false) {
	var funStr = chkForm.toString().replace('chkForm','chkFormSub');
	eval(funStr);
}
</script>
<script type="text/javascript">
if (chkFormSubExist === false) {
	function chkForm(form)
	{
		if (typeof(form['captcha_key']) == 'object') {
			if (form['captcha_key'].value == '') {
				alert('[자동등록방지] 필수입력사항');
				return false;
			}

			// 자동등록방지 검증
			if (window.XMLHttpRequest)
				xmlHttp = new XMLHttpRequest();
			else if (window.ActiveXObject)
				xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");

			var url = "../proc/captcha_indb.php";
			xmlHttp.open("POST", url, false);
			xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlHttp.send("mode=chkBoardCaptcha&id=" + form['id'].value+"&captcha_key=" + form['captcha_key'].value);
			if (xmlHttp.responseText != 'true') {
				alert(xmlHttp.responseText);
				return false;
			}
		}

		return chkFormSub(form);
	}
}

function fnRefreshCaptchaText() {
	var img = document.getElementById('el-captcha-text');
	img.src = "../proc/captcha.php?" + new Date().getTime();
}
</script>