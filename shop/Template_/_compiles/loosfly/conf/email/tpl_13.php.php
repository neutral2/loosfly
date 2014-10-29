<?php /* Template_ 2.2.7 2013/07/25 10:41:38 /www/loosfly_godo_co_kr/shop/conf/email/tpl_13.php 000001497 */ ?>
<div style="border:#cfcfcf 2px solid; width:800px">
	<table cellSpacing="0" cellPadding="0" width="800" border="0">
	<tr>
		<!--메일 상단 : Start -->
		<td><img src="http://www.loosfly.com/shop/data/skin/loosfly/img/mail/mail_certification_number.gif"></td>
		<!--메일 상단 : End -->
	</tr>
	<tr><td height="20"></td></tr>
	<tr>
<!--본문 부분 : Start -->
		<td style="FONT: 9pt/20px 돋움; COLOR: #585858; padding:0 10px">
			<DIV>인증번호를 안내 드립니다.<BR><BR>
			<B><?php echo $TPL_VAR["name"]?></B>님 안녕하세요.<B><?php echo $TPL_VAR["cfg"]["shopName"]?></B> 입니다.<BR>
			요청하신 비밀번호찾기 인증번호를 안내 드립니다.<BR>아래번호를 인증번호 입력란에 입력해 주세요.</DIV>
			<DIV STYLE="MARGIN:10px;PADDING:10px;TEXT-ALIGN:CENTER;BACKGROUND-COLOR:#FDEADA;COLOR:#FF0000;FONT-WEIGHT:BOLD;">인증번호 : <?php echo $TPL_VAR["authNum"]?></DIV>
		</td>
	</tr>
		<!--본문 부분 : End -->
	<tr><td height="20"></td></tr>
<!--메일 하단 : Start -->
	<tr><td bgColor="#cfcfcf" height="1"></td></tr>
	<tr>
		<td style="padding:10px;" align="center">
			<table>
			<tr><td style="font:8pt tahoma" align="center">copyright(c) <strong><font color="#585858"><?php echo $TPL_VAR["cfg"]["shopname"]?> </font></strong>all right reserved.</td></tr>
			</table>
		</td>
	</tr>
<!--메일 하단 : End -->
	<tr><td bgcolor="#71cbd2" height="20"></td></tr>
	</table>
</div>