<?php /* Template_ 2.2.7 2013/11/05 10:46:20 /www/loosfly_godo_co_kr/shop/data/skin/loosfly/goods/goods_qna_register.htm 000009708 */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=EUC-KR" />
<title>��ǰ�����ۼ�</title>
<style>
	body{ font-family:"�������", "Nanum Gothic", "AppleGothic", "�������", "Malgun Gothic", "����", "Dotum", "Sans-serif"; background-color:#ffffff; }
	table { font:normal 12px/16px "�������", "Nanum Gothic", "AppleGothic", "�������", "Malgun Gothic", "����", "Dotum", "Sans-serif"; }
</style>
<script src="/shop/data/skin/loosfly/common.js"></script>
<script>
function fitwin()
{
	window.resizeTo(750,150);
	var borderY = document.body.clientHeight;

	width	= 750;
	height	= document.body.scrollHeight + borderY + 10;

	windowX = (window.screen.width-width)/2;
	windowY = (window.screen.height-height)/2;

	if(width>screen.width){
		width = screen.width;
		windowX = 0;
	}
	if(height>screen.height){
		height = screen.height;
		windowY = 0;
	}

	window.moveTo(windowX,windowY);
	window.resizeTo(width,height);
}

function chkForm2(form) {
	if (form.rcv_email.checked == true && form.email.value =='') {
		alert('�̸��� �ּҸ� �Է��� �ּ���.');
		return false;
	}

	if (form.rcv_sms.checked == true && form.phone.value =='') {
		alert('���ڸ޽����� ������ �޴��� ��ȣ�� �Է��� �ּ���.');
		return false;
	}

	form.subject.value = encodeURIComponent(form.subject.value);
	form.contents.value = encodeURIComponent(form.contents.value);
	form.encode.value = 'y';

	return chkForm(form);
}
/*------------------------------ Ư�� �ѱ� ȣȯ 2013-05-08 �߰� ------------------------------*/
function htmlspecialchars (string) {
	return string.replace(/&/g, "&amp;").replace(/\"/g,'&quot;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
}

function htmlEncodeContent(form) {

	if (form.rcv_email.checked == true && form.email.value =='') {
		alert('�̸��� �ּҸ� �Է��� �ּ���.');
		return false;
	}

	if (form.rcv_sms.checked == true && form.phone.value =='') {
		alert('���ڸ޽����� ������ �޴��� ��ȣ�� �Է��� �ּ���.');
		return false;
	}

	form.subject.value = htmlspecialchars(form.subject.value);
	form.contents.value = htmlspecialchars(form.contents.value);
	form.encode.value = 'htmlencode';
	return chkForm(form);
}
/*--------------------------------------------------------------------------------------------*/
</script>
</head>

<body onload="fitwin()">
<form name="frmQna" method=post action="<?php echo $TPL_VAR["goodsQNAActionUrl"]?>" onSubmit="return htmlEncodeContent(this)">
	<input type=hidden name=mode value="<?php echo $GLOBALS["mode"]?>">
	<input type=hidden name=goodsno value="<?php echo $GLOBALS["goodsno"]?>">
	<input type=hidden name=sno value="<?php echo $GLOBALS["sno"]?>">
	<input type=hidden name=encode value="">
	<input type=hidden name=agree value="" required fld_esssential msgR="�������� ���� �� �̿뿡 ���� �ȳ��� ���� �ϼž� �ۼ��� �����մϴ�.">

	<table width="100%" cellpadding="0" cellspacing="0" style="border:#71cbd2 3px solid;" align="left">
	<tr>
		<td height="75" valign="middle" style="background-color:#71cbd2;padding-left:20px">
			<span style="font-size:18px;color:#ffffff">��ǰ���� �ۼ��ϱ� / </span><span style="color:#ffffff;font:normal 16px 'Courier New', Courier, monospace"> Write Inquiry</span>
		</td>
	</tr>
	<tr>
		<td style="margin:0 20px;border:#efefef 5px solid;">
			<table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin:5px 0;font-size:14px;">
			<tr>
				<td width="50"><?php echo goodsimg($GLOBALS["goods"]["img_s"], 50)?></td>
				<td style="line-height:20px;padding-left:10px">
				<b><?php echo $GLOBALS["goods"]["goodsnm"]?></b><br>
				<?php echo number_format($GLOBALS["goods"]["price"])?>��
				</td>
			</tr>
			</table>
		</td>
	</tr>
	<tr><td height="5"></td></tr>
	<tr>
		<td style="margin:0 20px;border:#dedede 1px solid;">
			<table width="100%" cellpadding="0" cellspacing="0" border="0">
			<tr>
				<td style="border:#f3f3f3 3px solid; padding:5px">
					<table width="100%" id=form cellpadding="5" cellspacing="0" border="0">
					<col width="80">
					<tr>
						<td class="input_txt" align="right">�ۼ���</td>
						<td>
						<div style="float:left; width:50%;"><input type=text name=name style="width:100" required fld_esssential label="�ۼ���" value="<?php echo $GLOBALS["data"]["name"]?>"></div>
<?php if(!$GLOBALS["sess"]&&empty($GLOBALS["data"]['m_no'])){?>
						<div style="float:left;"><span class="input_txt">��й�ȣ</span> <input type=password name=password style="width:100" required fld_esssential label="��й�ȣ"></div>
<?php }?>
						</td>
					</tr>
					<tr><td colspan=2 height=1 bgcolor="#DEDEDE" style="padding:0"></td></tr>
					<tr>
						<td class="input_txt" align="right">�̸���</td>
						<td><input type=text name=email style="width:200px" label="�̸���" value="<?php echo $GLOBALS["data"]["email"]?>"> <label class="noline"><input type="checkbox" name="rcv_email" value="1"<?php if($GLOBALS["data"]["rcv_email"]){?> checked<?php }?>> �޽��ϴ�.</label></td>
					</tr>
					<tr><td colspan=2 height=1 bgcolor="#DEDEDE" style="padding:0"></td></tr>
					<tr>
						<td class="input_txt" align="right">���ڸ޽���</td>
						<td><input type=text name=phone style="width:200px" label="���ڸ޽���" value="<?php echo $GLOBALS["data"]["phone"]?>">  <label class="noline"><input type="checkbox" name="rcv_sms" value="1"<?php if($GLOBALS["data"]["rcv_sms"]){?> checked<?php }?>> �޽��ϴ�.</label></td>
					</tr>
<?php if($GLOBALS["cfg"]["qnaSecret"]=='secret'){?>
					<tr><td colspan=2 height=1 bgcolor="#DEDEDE" style="padding:0"></td></tr>
					<tr>
						<td class="input_txt" align="right">��б�</td>
						<td class="noline"><input type="checkbox" name="secret" value="1"<?php echo $GLOBALS["data"]["chksecret"]?>> ��б�</td>
					</tr>
<?php }?>
					<tr><td colspan=2 height=1 bgcolor="#DEDEDE" style="padding:0"></td></tr>
					<tr>
						<td class="input_txt" align="right">����</td>
						<td><input type=text name=subject style="width:100%" required fld_esssential label="����" value="<?php echo $GLOBALS["data"]["subject"]?>"></td>
					</tr>
					<tr><td colspan=2 height=1 bgcolor="#DEDEDE" style="padding:0"></td></tr>
					<tr>
						<td class="input_txt" align=right>����</td>
						<td>
						<div style="height:400px;padding-top:5px;position:relative;z-index:99">
						<!-- mini editor -->
						<textarea name=contents style="width:500px;height:350px" type=editor fld_esssential label="����"><?php echo htmlspecialchars($GLOBALS["data"]["contents"])?></textarea>
						<script src=../lib/meditor/mini_editor.js></script>
						<script>mini_editor("../lib/meditor/")</script>
						</div>
						</td>
					</tr>
<?php if($GLOBALS["cfg"]["qnaSpamBoard"]& 2){?>
					<tr>
						<td align=right class=input_txt>�ڵ���Ϲ���</td>
						<td class=cell_L><?php echo $this->define('tpl_include_file_1',"proc/_captcha.htm")?> <?php $this->print_("tpl_include_file_1",$TPL_SCP,1);?></td>
					</tr>
<?php }?>
					</table>
		</td>
	</tr>
	<tr><td height="5"></td></tr>
	<tr>
		<td style="margin:0 20px;border:#dedede 1px solid;">
			<table width="100%" cellpadding="0" cellspacing="0" border="0">
			<tr>
				<td style="border:#f3f3f3 3px solid; padding:5px">
					<table width="100%" id=form cellpadding="5" cellspacing="0" border="0">
					<col width="80">
					<col width="">
					<tr>
						<td colspan="2" style="padding-left:10px;" class="b_cate blue">�������� ���� �� �̿뿡 ���� �ȳ�</td>
					</tr>
					<tr>
						<td class="input_txt" align="right">�����׸� :</td>
						<td class="stxt">
							�̸�, ��ȭ��ȣ, �̸����ּ�
						</td>
					</tr>
					<tr>
						<td class="input_txt" align="right">�������� :</td>
						<td class="stxt">
							��ǰ���� ���� �� ��� ȸ��
						</td>
					</tr>
					<tr>
						<td class="input_txt" align="right" valign="top">�̿�Ⱓ :</td>
						<td class="stxt">
							��Ģ������ �������� ���� �� �̿������ �޼��� �Ŀ��� �ش� ������ ��ü ���� �ı��մϴ�.<br>
							��, ��������� ������ ���Ͽ� ������ �ʿ䰡 �ִ� ��� �����Ⱓ ���� ���������� ������ �� �ֽ��ϴ�.
						</td>
					</tr>
					<tr>
						<td class="stxt" colspan="2" style="padding-left:30px;">
						�� ���� ������ <strong><?php echo $GLOBALS["cfg"]["shopName"]?> <a href="<?php echo url("service/private.php")?>&" class="blue" target="_blank">����������޹�ħ</a></strong>�� �ؼ��մϴ�.
						</td>
					</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td align="center" style="padding:8px;">
					<label><input type="radio" name="_agree" value="y" onClick="document.frmQna.agree.value='y';"> �����մϴ�</label>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<label><input type="radio" name="_agree" value="n" onClick="document.frmQna.agree.value='';"> �������� �ʽ��ϴ�</label>
					</td>
			</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>
			<table width="100%" height="70" cellpadding="0" cellspacing="0" border="0">
			<tr>
				<td align="center" valign="middle"><input type="image" src="/shop/data/skin/loosfly/img/jimmy/buttons/apply_01.gif"></td>
				<td align="center" valign="middle"><A HREF="javascript:this.close()" onFocus="blur()"><img src="/shop/data/skin/loosfly/img/jimmy/buttons/cancel_01.gif" border="0"></A></td>
			</tr>
			</table>
		</td>
	</tr>
	</table>
</form>

</body>
</html>