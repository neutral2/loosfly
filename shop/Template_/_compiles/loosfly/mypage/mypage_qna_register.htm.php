<?php /* Template_ 2.2.7 2013/11/05 10:49:08 /www/loosfly_godo_co_kr/shop/data/skin/loosfly/mypage/mypage_qna_register.htm 000006472 */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=EUC-KR" />
<title>1:1 �����ۼ�</title>
<script src="/shop/data/skin/loosfly/common.js"></script>
<style>
	body{ font-family:"��������", "Nanum Gothic", "AppleGothic", "��������", "Malgun Gothic", "����", "Dotum", "Sans-serif"; background-color:#ffffff; }
	table { font:normal 12px/20px "��������", "Nanum Gothic", "AppleGothic", "��������", "Malgun Gothic", "����", "Dotum", "Sans-serif"; }
</style>
</head>
<body>

<form name=fm method=post action="<?php echo $TPL_VAR["myqnaActionUrl"]?>" onSubmit="return chkForm(this)">
<input type=hidden name=mode value="<?php echo $GLOBALS["mode"]?>">
<input type=hidden name=itemcd value="<?php echo $GLOBALS["itemcd"]?>">
<input type=hidden name=sno value="<?php echo $GLOBALS["sno"]?>">

	<table width="100%" cellpadding="0" cellspacing="0" style="border:#71cbd2 3px solid;" align="left">
	<tr>
		<td height="75" valign="middle" style="background-color:#71cbd2;padding-left:20px">
			<span style="font-size:18px;color:#ffffff">1:1���� �ۼ��ϱ� / </span><span style="color:#ffffff;font:normal 16px 'Courier New', Courier, monospace"> Personal Inquiry</span>
		</td>
	</tr>
	<tr>
		<td style="margin:0 20px;border:#dedede 1px solid;">
			<table width="100%" cellpadding="0" cellspacing="0" border="0">
			<tr>
				<td style="border:#f3f3f3 3px solid; padding:5px">
					<table width="100%" id=form cellpadding="5" cellspacing="0" border="0">
					<col width=14% align=right>
					<tr>
						<td class="input_txt">���̵�</td>
						<td><?php echo $GLOBALS["data"]["m_id"]?></td>
					</tr>
					<tr><td colspan=2 height=1 bgcolor="#DEDEDE" style="padding:0px;"></td></tr>
		
<?php if($GLOBALS["formtype"]!='reply'){?>
					<tr>
						<td class="input_txt">��������</td>
						<td><select name="itemcd" required fld_esssential label="��������" class=select>
								<option value="">���㳻���� �����ϼ���.</option>
<?php if((is_array($TPL_R1=codeitem('question'))&&!empty($TPL_R1)) || (is_object($TPL_R1) && in_array("Countable", class_implements($TPL_R1)) && $TPL_R1->count() > 0)) {foreach($TPL_R1 as $TPL_K1=>$TPL_V1){?>
								<option value="<?php echo $TPL_K1?>" <?php if($GLOBALS["data"]["itemcd"]==$TPL_K1){?>selected<?php }?>><?php echo $TPL_V1?></option>
<?php }}?>
							</select>
						</td>
					</tr>
					<tr><td colspan=2 height=1 bgcolor="#DEDEDE" style="padding:0px;"></td></tr>
					<tr>
						<td class="input_txt">�ֹ���ȣ</td>
						<td>
							<input type=text name=ordno style="width:25%" value="<?php echo $GLOBALS["data"]["ordno"]?>"> <a href="javascript:order_open();"><img src="/shop/data/skin/loosfly/img/common/btn_inquiry_order.gif" align=absmiddle></a>
						</td>
					</tr>
					<tr><td colspan=2 height=1 bgcolor="#DEDEDE" style="padding:0px;"></td></tr>
					<tr>
						<td class="input_txt">�̸���</td>
						<td>
							<input type=text name=email value="<?php echo $GLOBALS["data"]["email"]?>" size=26>
							<span class=noline style="padding-left:10px">
								<input type=checkbox name=mailling <?php if($GLOBALS["data"]["mailling"]=='y'){?>checked<?php }?>><span style="font:8pt ����;color:#007FC8" >�޽��ϴ�</span>
							</span>
						</td>
					</tr>
					<tr><td colspan=2 height=1 bgcolor="#DEDEDE" style="padding:0px;"></td></tr>
					<tr>
						<td class="input_txt">���ڸ޽���</td>
						<td>
							<input type=text name=mobile[] value="<?php echo $GLOBALS["data"]["mobile"][ 0]?>" size=4 maxlength=4> -
							<input type=text name=mobile[] value="<?php echo $GLOBALS["data"]["mobile"][ 1]?>" size=4 maxlength=4> -
							<input type=text name=mobile[] value="<?php echo $GLOBALS["data"]["mobile"][ 2]?>" size=4 maxlength=4>
							<span class=noline style="padding-left:10px"><input type=checkbox name=sms <?php if($GLOBALS["data"]["sms"]=='y'){?>checked<?php }?>><span style="font:8pt ����;color:#007FC8" >�޽��ϴ�</span></span>
						</td>
					</tr>
					<tr><td colspan=2 height=1 bgcolor="#DEDEDE" style="padding:0px;"></td></tr>
<?php }?>
					<tr>
						<td class="input_txt">����</td>
						<td><input type=text name=subject style="width:100%" required fld_esssential label="����" value="<?php echo $GLOBALS["data"]["subject"]?>"></td>
					</tr>
					<tr><td colspan=2 height=1 bgcolor="#DEDEDE" style="padding:0px;"></td></tr>
					<tr>
						<td class="input_txt">����</td>
						<td>
		
<?php if($GLOBALS["formtype"]!='reply'){?>
							<textarea name=contents style="width:100%;height:140" required fld_esssential label="����"><?php echo $GLOBALS["data"]["contents"]?></textarea>
<?php }else{?>
							<textarea name=contents style="width:100%;height:260" required fld_esssential label="����"><?php echo $GLOBALS["data"]["contents"]?></textarea>
<?php }?>
						</td>
					</tr>
					</table>
				</td>
			</tr>
			</table>
		</td>
	</tr>
	</table>

	<TABLE width=100% height="50" cellpadding=0 cellspacing=0 border=0>
	<tr>
		<td align=center style="padding-top:5"><input type="image" src="/shop/data/skin/loosfly/img/jimmy/buttons/apply_01.gif"></td>
	</tr>
	</TABLE>
	<TABLE width=100% cellpadding=0 cellspacing=0 border=0>
	<TR>
		<TD align=right><A HREF="javascript:this.close()" onFocus="blur()"><img src="/shop/data/skin/loosfly/img/common/popup_close.gif"></A></TD>
	</TR>
	</TABLE>


	</td>
</tr>
</table>

</form>


<iframe id=ifm_order frameborder=0 scrolling=no style="display:none; background-color:#ffffff; border-style:solid; border-width:1; border-color:#000000;"></iframe>
<script language="javascript">
function order_open(){
	var divEl = document.getElementById('ifm_order');
	divEl.style.display = "block";
	divEl.style.left = 20;
	divEl.style.top = 165;
	divEl.style.width = 560;
	divEl.style.height = 280;
	divEl.style.position = "absolute";
	if( divEl.src == '' ) divEl.src = "mypage_qna_order.php";
}

function order_close(){
	var divEl = document.getElementById('ifm_order');
	divEl.style.display = "none";
}

function order_put( ordno ){
	document.fm.ordno.value = ordno;
	order_close();
}
</script>


</body>
</html>