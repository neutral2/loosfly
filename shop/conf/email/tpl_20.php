<div style="border:#cfcfcf 2px solid; width:800px">
	<table cellspacing="0" cellpadding="0" width="800" border="0">
	<tbody><tr>
		<!--메일 상단 : Start -->
		<td><img src="http://www.loosfly.com/shop/data/skin/loosfly/img/mail/mail_bar_qna.gif"></td>
		<!--메일 상단 : End -->
	</tr>
	<tr><td height="20"></td></tr>
	<tr>
<!--본문 부분 : Start -->
		<td style="FONT: 9pt/20px 돋움; COLOR: #585858; padding:0 10px" bgcolor="#f2f2f2">
			<table cellspacing="0" cellpadding="8" width="100%" border="0">
			<tbody><tr>
				<td style="font: 9pt/20px 돋움; color: #585858" valign="top" width="63"><b>질문제목 :</b></td>
				<td>{questiontitle}</td>
			</tr>
<!--{ ? question != '' }-->
			<tr>
				<td style="border-top: #e6e6e6 1px solid; font: 9pt/20px 돋움; color: #585858" valign="top"><b>질문내용 :</b></td>
				<td style="border-top: #e6e6e6 1px solid">{question}</td>
			</tr>
<!--{ / }-->
<!--{ ? answertitle != '' }-->
			<tr>
				<td style="border-top: #e6e6e6 1px solid; font: 9pt/20px 돋움; color: #585858" valign="top"><b>답변제목 :</b></td>
				<td style="border-top: #e6e6e6 1px solid">{answertitle}</td>
			</tr>
<!--{ / }-->
<!--{ ? answer != '' }-->
			<tr>
				<td style="border-top: #e6e6e6 1px solid; font: 9pt/20px 돋움; color: #585858" valign="top"><b>답변 :</b></td>
				<td style="border-top: #e6e6e6 1px solid">{answer}</td>
			</tr>
<!--{ / }-->
			</tbody></table>
		</td>
	</tr>	
	<tr>
		<td style="FONT: 9pt/20px 돋움; COLOR: #585858; padding:0 10px" height="60">
			기타 문의사항이 있으시면, <a href="mailto:{cfg.adminemail}"><strong><font color="#585858">{cfg.adminemail}</font></strong></a> 로 연락주시기 바랍니다.<br>
			{cfg.shopname} 쇼핑몰을 이용해 주셔서 감사합니다.
		</td>
	</tr>
	<tr><td height="20"></td></tr>
	<tr>
		<td style="padding:10px;" align="center">
			<table>
			<tbody>
			<tr>
				<td rowspan="2"><!--{ @ dataBanner( 92 ) }-->{.tag}<!--{ / }--></td>
				<td><img src="/shop/admin/img/mail/mail_bottom.gif"></td>
			</tr>
			<tr><td style="font:8pt tahoma" align="center">copyright(c) <strong><font color="#585858">{cfg.shopname} </font></strong>all right reserved.</td></tr>
			</tbody>
			</table>
		</td>
	</tr>
	<tr><td bgcolor="#71cbd2" height="20"></td></tr>
	</tbody>
	</table>
</div>
