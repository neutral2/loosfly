<?php /* Template_ 2.2.7 2013/07/25 11:10:29 /www/loosfly_godo_co_kr/shop/conf/email/tpl_20.php 000002742 */  $this->include_("dataBanner");?>
<div style="border:#cfcfcf 2px solid; width:800px">
	<table cellspacing="0" cellpadding="0" width="800" border="0">
	<tbody><tr>
		<!--���� ��� : Start -->
		<td><img src="http://www.loosfly.com/shop/data/skin/loosfly/img/mail/mail_bar_qna.gif"></td>
		<!--���� ��� : End -->
	</tr>
	<tr><td height="20"></td></tr>
	<tr>
<!--���� �κ� : Start -->
		<td style="FONT: 9pt/20px ����; COLOR: #585858; padding:0 10px" bgcolor="#f2f2f2">
			<table cellspacing="0" cellpadding="8" width="100%" border="0">
			<tbody><tr>
				<td style="font: 9pt/20px ����; color: #585858" valign="top" width="63"><b>�������� :</b></td>
				<td><?php echo $TPL_VAR["questiontitle"]?></td>
			</tr>
<?php if($TPL_VAR["question"]!=''){?>
			<tr>
				<td style="border-top: #e6e6e6 1px solid; font: 9pt/20px ����; color: #585858" valign="top"><b>�������� :</b></td>
				<td style="border-top: #e6e6e6 1px solid"><?php echo $TPL_VAR["question"]?></td>
			</tr>
<?php }?>
<?php if($TPL_VAR["answertitle"]!=''){?>
			<tr>
				<td style="border-top: #e6e6e6 1px solid; font: 9pt/20px ����; color: #585858" valign="top"><b>�亯���� :</b></td>
				<td style="border-top: #e6e6e6 1px solid"><?php echo $TPL_VAR["answertitle"]?></td>
			</tr>
<?php }?>
<?php if($TPL_VAR["answer"]!=''){?>
			<tr>
				<td style="border-top: #e6e6e6 1px solid; font: 9pt/20px ����; color: #585858" valign="top"><b>�亯 :</b></td>
				<td style="border-top: #e6e6e6 1px solid"><?php echo $TPL_VAR["answer"]?></td>
			</tr>
<?php }?>
			</tbody></table>
		</td>
	</tr>	
	<tr>
		<td style="FONT: 9pt/20px ����; COLOR: #585858; padding:0 10px" height="60">
			��Ÿ ���ǻ����� �����ø�, <a href="mailto:<?php echo $TPL_VAR["cfg"]["adminemail"]?>"><strong><font color="#585858"><?php echo $TPL_VAR["cfg"]["adminemail"]?></font></strong></a> �� �����ֽñ� �ٶ��ϴ�.<br>
			<?php echo $TPL_VAR["cfg"]["shopname"]?> ���θ��� �̿��� �ּż� �����մϴ�.
		</td>
	</tr>
	<tr><td height="20"></td></tr>
	<tr>
		<td style="padding:10px;" align="center">
			<table>
			<tbody>
			<tr>
				<td rowspan="2"><?php if(is_array($TPL_R1=dataBanner( 92))&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?><?php echo $TPL_V1["tag"]?><?php }}?></td>
				<td><img src="/shop/admin/img/mail/mail_bottom.gif"></td>
			</tr>
			<tr><td style="font:8pt tahoma" align="center">copyright(c) <strong><font color="#585858"><?php echo $TPL_VAR["cfg"]["shopname"]?> </font></strong>all right reserved.</td></tr>
			</tbody>
			</table>
		</td>
	</tr>
	<tr><td bgcolor="#71cbd2" height="20"></td></tr>
	</tbody>
	</table>
</div>