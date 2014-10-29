<?php /* Template_ 2.2.7 2013/07/19 15:09:52 /www/loosfly_godo_co_kr/shop/conf/email/tpl_1.php 000001870 */  $this->include_("dataBanner");?>
<div style="border:#cfcfcf 2px solid;width:800px;">
	<table cellspacing="0" cellpadding="0" width="800" border="0">
	<tbody><tr>
		<!--메일 상단 : Start -->
		<td><img src="http://www.loosfly.com/shop/data/skin/loosfly/img/mail/mail_bar_payment.gif"></td>
		<!--메일 상단 : End -->
	</tr>
	<tr><td height="20"></td></tr>
	<tr>
		<!--본문 부분 : Start -->
		<td style="font: 9pt/20px 돋움; color: #585858; padding-left:10px">
			<strong><?php echo $TPL_VAR["nameOrder"]?> 고객님의 입금을 확인하였습니다.</strong><br><br>
			빠른시일내에 주문하신 상품을 받아보실 수 있도록 노력하겠습니다.<br>
			저희 쇼핑몰을 이용해주셔서 감사드리며, 언제나 만족스런 쇼핑을 하실 수 있도록<br>
			최선을 다하는 <?php echo $TPL_VAR["cfg"]["shopName"]?><font color="#585858">( <a href="http://<?php echo $TPL_VAR["cfg"]["shopUrl"]?>)/"><strong>http://<?php echo $TPL_VAR["cfg"]["shopUrl"]?></strong></a>)</font> 가 되겠습니다.<br><br>
			감사합니다.
		</td>
	</tr>
		<!--본문 부분 : End -->
	<tr><td height="20"></td></tr>
<!--메일 하단 : Start -->
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
<!--메일 하단 : End -->
	<tr><td bgcolor="#71cbd2" height="20"></td></tr>
	</tbody></table>
</div>