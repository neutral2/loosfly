<?php /* Template_ 2.2.7 2013/05/10 18:42:43 /www/loosfly_godo_co_kr/shop/data/skin/loosfly/proc/ccsms.htm 000003192 */ ?>
<div style="width:170px;">
	<div align="center">SMS ��� �����ϱ�.</div>

	<form id="form" onsubmit="return ccsms.send(this);">
	<div style="border-style:solid; border-width: 0 1px; border-color:#D1D1D1; margin:0; padding:5px 0 15px; text-align:center;">
		<div><textarea name=msg onkeydown="ccsms.chkLen(this)" onkeyup="ccsms.chkLen(this)" onchange="ccsms.chkLen(this)" style="width:153px; height:132px; border:solid 1px #A0E3EC; background-color:#F6FCFC;"
			required msgR="�޽����� �Է����ּ���" style="font:9pt ����ü;overflow:hidden;"></textarea>
		</div>
		<div class="noline"><font class=small color=555555><input name=vLength type=text style="width:20px;text-align:right;font-size:8pt;font-style:����;color:e65100" value=0>/80 Bytes</font></div>

		<div style="padding-right:10"><font color=444444>��</font>  <input type=text name=callback size=15 required msgR="�������� ��ȣ�� �Է����ּ���" option="regNum" msgO="���ڸ� �Է����ּ���" style="border:solid 1px #A0E3EC; background-color:#F6FCFC;"></div>

		<div style="padding-top:3" class="noline" id="avoidSubmit"><input type="image" src="/shop/data/skin/loosfly/img/common/sid_btn_sms.gif" alt="������"></div>
	</div>
	</form>
</div>

<script src="/shop/lib/js/prototype.js"></script>
<script>
/*** SMS ���� ***/
ccsms =  {
	init: function ()
	{
		document.getElementsByName('msg')[0].value = '';
		document.getElementsByName('callback')[0].value = '';
		document.getElementsByName('vLength')[0].value = '0';
	},

	chkLen: function (obj)
	{
		str = obj.value;
		if (chkByte(str)>80){
			alert("80byte������ �Է��� �����մϴ�");
			obj.value = strCut(str,80);
		}
		document.getElementsByName('vLength')[0].value = chkByte(obj.value);
	},

	send: function (fobj)
	{
		if (typeof(Ajax) == 'undefined') return false;
		if (chkForm(fobj) === false) return false;

		if (document.getElementById('avoidSubmit') && !document.getElementById('avoidMsg'))
		{
			sendDiv = document.getElementById('avoidSubmit');
			msgDiv = sendDiv.parentNode.insertBefore( sendDiv.cloneNode(true), sendDiv );
			msgDiv.id = 'avoidMsg';
			msgDiv.innerHTML = '������ ...';
		}
		if (typeof(sendDiv) != 'undefined') sendDiv.style.display = 'none';
		if (typeof(msgDiv) != 'undefined') msgDiv.style.display = 'block';

		var result = function(){
			var req = ajax.transport;
			if (req.status == 200){
				ccsms.init();
				alert('���������� ���ڰ� �߼۵Ǿ����ϴ�');
			}
			else {
				var msg = req.getResponseHeader("Status");
				if ( msg == null || msg.length == null || msg.length <= 0 ) msg = 'Error! Request status is ' + req.status;
				alert(msg);
			}
			if (typeof(sendDiv) != 'undefined') sendDiv.style.display = 'block';
			if (typeof(msgDiv) != 'undefined') msgDiv.style.display = 'none';
		}

		var urlStr = "../proc/indb.php?mode=send_sms&" + decodeURIComponent( Form.serialize(fobj) ) + "&dummy=" + new Date().getTime();
		var ajax = new Ajax.Request( urlStr, { method: "get", onComplete: result } );
		return false;
	}
}
ccsms.init();
</script>