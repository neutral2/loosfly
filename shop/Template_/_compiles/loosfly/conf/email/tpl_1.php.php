<?php /* Template_ 2.2.7 2013/07/19 15:09:52 /www/loosfly_godo_co_kr/shop/conf/email/tpl_1.php 000001870 */  $this->include_("dataBanner");?>
<div style="border:#cfcfcf 2px solid;width:800px;">
	<table cellspacing="0" cellpadding="0" width="800" border="0">
	<tbody><tr>
		<!--���� ��� : Start -->
		<td><img src="http://www.loosfly.com/shop/data/skin/loosfly/img/mail/mail_bar_payment.gif"></td>
		<!--���� ��� : End -->
	</tr>
	<tr><td height="20"></td></tr>
	<tr>
		<!--���� �κ� : Start -->
		<td style="font: 9pt/20px ����; color: #585858; padding-left:10px">
			<strong><?php echo $TPL_VAR["nameOrder"]?> ������ �Ա��� Ȯ���Ͽ����ϴ�.</strong><br><br>
			�������ϳ��� �ֹ��Ͻ� ��ǰ�� �޾ƺ��� �� �ֵ��� ����ϰڽ��ϴ�.<br>
			���� ���θ��� �̿����ּż� ����帮��, ������ �������� ������ �Ͻ� �� �ֵ���<br>
			�ּ��� ���ϴ� <?php echo $TPL_VAR["cfg"]["shopName"]?><font color="#585858">( <a href="http://<?php echo $TPL_VAR["cfg"]["shopUrl"]?>)/"><strong>http://<?php echo $TPL_VAR["cfg"]["shopUrl"]?></strong></a>)</font> �� �ǰڽ��ϴ�.<br><br>
			�����մϴ�.
		</td>
	</tr>
		<!--���� �κ� : End -->
	<tr><td height="20"></td></tr>
<!--���� �ϴ� : Start -->
	<tr><td bgcolor="#cfcfcf" height="1"></td></tr>
	<tr>
		<td style="padding:10px;" align="center">
			<table>
			<tbody><tr>
				<td rowspan="2"><?php if(is_array($TPL_R1=dataBanner( 92))&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?><?php echo $TPL_V1["tag"]?><?php }}?></td>
				<td><img src="/shop/admin/img/mail/mail_bottom.gif"></td>
			</tr>
			<tr><td style="font:8pt tahoma" align="center">copyright(c) <strong><font color="#585858"><?php echo $TPL_VAR["cfg"]["shopname"]?> </font></strong>all right reserved.</td></tr>
			</tbody></table>
		</td>
	</tr>
<!--���� �ϴ� : End -->
	<tr><td bgcolor="#71cbd2" height="20"></td></tr>
	</tbody></table>
</div>