<?php /* Template_ 2.2.7 2012/11/20 16:29:25 /www/loosfly_godo_co_kr/shop/data/skin/apple_tree/outline/footer/standard.htm 000004380 */  $this->include_("dataBanner","displaySSLSeal","displayEggBanner");?>
<table  cellpadding='0' cellspacing='0' border='0' width='100%' style="background-image:url('/shop/data/skin/apple_tree/img/main/bg_foot.gif');background-repeat:repeat-x; margin-top:50">
<tr><td>


<table border='0' cellpadding='0' width="<?php echo $GLOBALS["cfg"]['shopSize']?>" align="<?php echo $GLOBALS["cfg"]['shopAlign']?>" cellspacing='0' >
<tr>
<td>

	<!------------ �ϴ� ��ư (ȸ��Ұ� ��) ���� --------------->
	<table border='0' cellpadding='0' cellspacing='0'>
	<tr>
	<td><a href="<?php echo url("service/company.php")?>&"><img src="/shop/data/skin/apple_tree/img/main/fnb_company.gif"></a></td>
	<td><a href="<?php echo url("service/private.php")?>&"><img src="/shop/data/skin/apple_tree/img/main/fnb_personal.gif"></a></td>
	<td><a href="<?php echo url("service/agreement.php")?>&"><img src="/shop/data/skin/apple_tree/img/main/fnb_use.gif"></a></td>
	<td><a href="<?php echo url("service/customer.php")?>&"><img src="/shop/data/skin/apple_tree/img/main/fnb_cs.gif"></a></td>
	<td><a href="<?php echo url("service/cooperation.php")?>&"><img src="/shop/data/skin/apple_tree/img/main/fnb_partner.gif"></a></td>
	<td><a href="<?php echo url("member/find_id.php")?>&"><img src="/shop/data/skin/apple_tree/img/main/fnb_lost.gif"></a></td>
	<td><a href="<?php echo url("service/guide.php")?>&"><img src="/shop/data/skin/apple_tree/img/main/bn_foots01.gif"></a></td>
	<td><a href="<?php echo url("service/sitemap.php")?>&"><img src="/shop/data/skin/apple_tree/img/main/bn_foots02.gif"></a></td>
	</tr>
	</table>
	<!------------ �ϴ� ��ư (ȸ��Ұ� ��) �� --------------->
</td>
</tr>
<tr>
<td class="outline_both" style="padding:20px 10px 10px 0px;">
	<!------------ �ϴ� ī�Ƕ���Ʈ  ���� --------------->
	<table width='100%' border='0'>
	<tr>
	<!------------------ �ϴܷΰ� ���� ------------------->
	<td width='230'><!-- ��ʰ������� �������� --><?php if(is_array($TPL_R1=dataBanner( 91))&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?><?php echo $TPL_V1["tag"]?><?php }}?></td>
	<!------------------ �ϴܷΰ� �� ------------------->
	<td>
		<div style="padding-bottom:5px"><font color='666666'>�ּ� : <?php echo $GLOBALS["cfg"]['address']?> <font color=#CECECE>|</font> ����ڵ�Ϲ�ȣ : <?php echo $GLOBALS["cfg"]['compSerial']?> <a href="http://www.ftc.go.kr/info/bizinfo/communicationList.jsp" target="_blank"><img src="/shop/data/skin/apple_tree/img/common/btn_c_view.gif" align="absmiddle"></a></div>
		<div style="padding-bottom:5px">����Ǹž��Ű��ȣ : <?php echo $GLOBALS["cfg"]['orderSerial']?> <font color=#CECECE>|</font> �������������� : <?php echo $GLOBALS["cfg"]['adminName']?> <font color=#CECECE>|</font> ��ǥ : <?php echo $GLOBALS["cfg"]['ceoName']?> <font color=#CECECE>|</font> ��ȣ�� : <?php echo $GLOBALS["cfg"]['compName']?></div>
		<div style="padding-bottom:5px">��ȭ��ȣ : <?php echo $GLOBALS["cfg"]['compPhone']?> <font color=#CECECE>|</font> �ѽ���ȣ : <?php echo $GLOBALS["cfg"]['compFax']?> <font color=#CECECE>|</font> ���� : <a href="javascript:popup('../proc/popup_email.php?to=<?php echo $GLOBALS["cfg"]['adminEmail']?>&hidden=1',650,600)"><?php echo $GLOBALS["cfg"]['adminEmail']?></a>
			<font color=#CECECE>|</font> ȣ�������� : <a href="http://godo.co.kr" target="_blank">(��)������Ʈ</a>
		</div>
		<!------------ �ϴ� ī�Ƕ���Ʈ  �� --------------->

		<table cellpadding='0' cellspacing='0' class='float'>
		<tr>
		<td class=eng>Copyright �� <b><?php echo $GLOBALS["cfg"]['shopUrl']?></b> All right reserved</td>
		</tr>
		</table>

	</td>
	<!------------------ SSL seal ���� ------------------->
	<td><?php echo displaySSLSeal()?></td>
	<!------------------ SSL seal �� ------------------->

	<!------------------ ���ž������� ǥ�� ���� ------------------->
	<td><?php echo displayEggBanner()?></td>
	<!------------------ ���ž������� ǥ�� �� ------------------->

	<!------------------ ���� iPay Logo ǥ�� ���� ------------------->
	<td><?php echo auctionIpayLogo()?></td>
	<!------------------ ���� iPay Logo ǥ�� �� ------------------->

	</tr>
	<tr><td colspan='20' height='20'></td></tr>
	</table>
</td>
</tr>
</table>

</td>
</tr>
</table>