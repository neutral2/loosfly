<?php /* Template_ 2.2.7 2013/11/05 10:47:11 /www/loosfly_godo_co_kr/shop/data/skin/loosfly/goods/goods_review_register.htm 000006129 */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=EUC-KR" />
<title>��ǰ�����ۼ�</title>
<script src="/shop/data/skin/loosfly/common.js"></script>
<style>
	body{ font-family:"�������", "Nanum Gothic", "AppleGothic", "�������", "Malgun Gothic", "����", "Dotum", "Sans-serif"; background-color:#ffffff; }
	table { font:normal 12px/20px "�������", "Nanum Gothic", "AppleGothic", "�������", "Malgun Gothic", "����", "Dotum", "Sans-serif"; }
</style>
<script type="text/javascript">
window.onresize = function() 
{
    window.resizeTo(600,560);
}
window.onclick = function() 
{
    window.resizeTo(600,560);
}
</script>
</head>

<body>
<form method=post action="<?php echo url("goods/indb.php")?>&" enctype="multipart/form-data" onSubmit="return chkForm(this)">
	<input type=hidden name=mode value="<?php echo $GLOBALS["mode"]?>">
	<input type=hidden name=goodsno value="<?php echo $GLOBALS["goodsno"]?>">
	<input type=hidden name=sno value="<?php echo $GLOBALS["sno"]?>">
	<input type=hidden name=referer value="<?php echo $GLOBALS["referer"]?>">

	<table width="100%" cellpadding="0" cellspacing="0" style="border:#71cbd2 3px solid;" align="left">
	<tr>
		<td height="75" valign="middle" style="background-color:#71cbd2;padding-left:20px">
			<span style="font-size:18px;color:#ffffff">�̿��ı� �ۼ��ϱ� / </span><span style="color:#ffffff;font:normal 16px 'Courier New', Courier, monospace"> Write Review</span>
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
					<col width="50" align="right">
<?php if($GLOBALS["mode"]!='reply_review'){?>
					<tr>
						<td class="input_txt" align="right" height="20">��</td>
						<td class="noline" style="color:#71cbd2;font-size:14px;line-height:20px">
							<input type=radio name=point value=5 class=noline <?php echo $GLOBALS["data"]["point"]['5']?>> �ڡڡڡڡ�
							&nbsp;<input type=radio name=point value=4 class=noline <?php echo $GLOBALS["data"]["point"]['4']?>> �ڡڡڡڡ�
							&nbsp;<input type=radio name=point value=3 class=noline <?php echo $GLOBALS["data"]["point"]['3']?>> �ڡڡڡ١�
							&nbsp;<input type=radio name=point value=2 class=noline <?php echo $GLOBALS["data"]["point"]['2']?>> �ڡڡ١١�
							&nbsp;<input type=radio name=point value=1 class=noline <?php echo $GLOBALS["data"]["point"]['1']?>> �ڡ١١١�
						</td>
					</tr>
<?php }?>
					<tr><td colspan=2 height=1 bgcolor="#DEDEDE" style="padding:0px;"></td></tr>
					<tr>
						<td class="input_txt" align="right" height="20">�ۼ���</td>
						<td align="left">
						<div style="float:left; width:50%;"><input type=text name=name style="width:100" required fld_esssential label="�ۼ���" value="<?php echo $GLOBALS["data"]["name"]?>"></div>
<?php if(!$GLOBALS["sess"]&&empty($GLOBALS["data"]['m_no'])){?>
						<div style="float:left; width:50%;"><span class="input_txt">��й�ȣ</span> <input type=password name=password style="width:100" required fld_esssential label="��й�ȣ"></div>
<?php }?>
						</td>
					</tr>
					<tr><td colspan=2 height=1 bgcolor="#DEDEDE" style="padding:0px;"></td></tr>
					<tr>
						<td class="input_txt" align="right" height="20">����</td>
						<td><input type=text name=subject style="width:95%" required fld_esssential label="����" value="<?php echo $GLOBALS["data"]["subject"]?>"></td>
					</tr>
					<tr><td colspan=2 height=1 bgcolor="#DEDEDE" style="padding:0px;"></td></tr>
					<tr>
						<td class="input_txt" align="right" height="20">����</td>
						<td><textarea name=contents style="width:95%;height:120" required fld_esssential label="����"><?php echo $GLOBALS["data"]["contents"]?></textarea></td>
					</tr>
<?php if($GLOBALS["cfg"]["reviewSpamBoard"]& 2){?>
					<tr>
						<td align=right class=input_txt>�ڵ���Ϲ���</td>
						<td class=cell_L><?php echo $this->define('tpl_include_file_1',"proc/_captcha.htm")?> <?php $this->print_("tpl_include_file_1",$TPL_SCP,1);?></td>
					</tr>
<?php }?>
					<tr><td colspan=2 height=1 bgcolor="#DEDEDE" style="padding:0px;"></td></tr>
					<tr>
						<td class="input_txt" align="right" height="20">�̹���</td>
						<td>
						<input type=file name=attach style="width:95%"  label="�̹���" value="">
<?php if($GLOBALS["data"]["attach"]== 1){?>
						<div style="padding-top:3px;">
						<input type="checkbox" name="remove_attach" value="1" style="border:none;">÷�� �̹��� ���� (<?php echo $GLOBALS["data"]["image"]?>)
						</div>
<?php }?>
						</td>
					</tr>
					</table>
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