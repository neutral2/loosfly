<?php /* Template_ 2.2.7 2014/02/26 17:16:52 /www/loosfly_godo_co_kr/shop/data/skin/loosfly/outline/footer/standard.htm 000010296 */  $this->include_("dataCategory","displaySSLSeal");?>
<?PHP $lfy_goods_knames = array("ī�װ���"=>"by category", "�Ż�ǰ"=>"new arrivals", "��õ��ǰ"=>"MD's choice", "����"=>"tops", "����"=>"bottoms", "����Ÿ��"=>"leotards", "����Ÿ��"=>"unitards", "�׼�����"=>"accessories", "�ݷ���"=>"by collection", "������"=>"women's", "������"=>"men's", "���̽��� ����"=>"lace & mesh", "������ ����"=>"fullness pants", "Ÿ����"=>"tights", "2014 �÷���"=>"2014 Collection", "�����"=>"reserved"); ?>

	<div id="dsFooter">
		<div style="height:20px;"></div>
		<div id="blkFooterMenu">
			<div class="footer_spacer01"> </div>
			<div id="bxShop">
				<div class="footer_title">shop.</div>
				<div style="height:10px;"></div>
				<div class="shop_menu">
					<div class="footer_subtitle"><div onMouseOver="overM('ī�װ���', this);" onMouseOut="outM('by category', this);">by category</div></div>
<?php if((is_array($TPL_R1=dataCategory($GLOBALS["cfg"]["subCategory"], 1))&&!empty($TPL_R1)) || (is_object($TPL_R1) && in_array("Countable", class_implements($TPL_R1)) && $TPL_R1->count() > 0)) {foreach($TPL_R1 as $TPL_V1){?>
<?PHP if (  $TPL_V1["category"] == "005" ) { ?>
				</div>
				<div style="position:relative;float:left;width:5px;height:50px;"></div>
				<div class="shop_menu">
					<div class="footer_subtitle"><div onMouseOver="overM('�ݷ���', this);" onMouseOut="outM('by collection', this);">by collection</div></div>
<?PHP } ?>
					<div class="menu_item"><a href="<?php echo url("goods/goods_list.php?")?>&category=<?php echo $TPL_V1["category"]?>"><div onMouseOver="overS('<?php echo $TPL_V1["catnm"]?>', this);" onMouseOut="outS('<?PHP echo str_replace("'", "\'", $lfy_goods_knames[ $TPL_V1["catnm"]]); ?>', this);"><?PHP echo $lfy_goods_knames[ $TPL_V1["catnm"]]; ?></div></a></div>
<?php }}?>
				</div>
			</div>
			<div class="footer_spacer02"> </div>
			<div id="bxService">
				<div class="footer_title">service.</div>
				<div style="height:10px;"></div>
				<div class="menu_item"><a href="/shop/board/list.php?id=notice"><div onMouseOver="overS('��������', this);" onMouseOut="outS('notice', this);">notice</div></a></div>
				<div class="menu_item"><a href="/shop/board/list.php?id=event"><div onMouseOver="overS('�̺�Ʈ �ȳ�', this);" onMouseOut="outS('event', this);">event</div></a></div>
				<div class="menu_item"><a href="/shop/service/non-member.php"><div onMouseOver="overS('��ȸ�� �ֹ���ȸ', this);" onMouseOut="outS('non-member Orders', this);">non-member orders</div></a></div>
				<div class="menu_item"><a href="/shop/member/find_id.php"><div onMouseOver="overS('���̵� ã��', this);" onMouseOut="outS('fild my ID', this);">find my ID</div></a></div>
				<div class="menu_item"><a href="#"><div onMouseOver="overS('�����Ƿ� ������ �ȳ�', this);" onMouseOut="outS('women\'s sizing guide', this);">women's sizing guide</div></a></div>
				<div class="menu_item"><a href="#"><div onMouseOver="overS('�����Ƿ� ������ �ȳ�', this);" onMouseOut="outS('men\'s sizing guide', this);">men's sizing guide</div></a></div>
				<div class="menu_item"><a href="/shop/service/guide.php"><div onMouseOver="overS('�̿�ȳ�', this);" onMouseOut="outS('user\'s guide', this);">user's guide</div></a></div>
				<!--div class="menu_item"><a href="#"><div onMouseOver="overS('���޸��� �ȳ�', this);" onMouseOut="outS('retail partners', this);">retail partners</div></a></div-->
				<div class="menu_item"><a href="/shop/service/faq.php"><div onMouseOver="overS('���� ���� ������', this);" onMouseOut="outS('FAQ', this);">FAQ</div></a></div>
				<div class="menu_item"><a href="/shop/service/company.php"><div onMouseOver="overS('�罺�ö��̿� ���Ͽ�', this);" onMouseOut="outS('about loosfly', this);">about loosfly</div></a></div>
			</div>
			<div class="footer_spacer02"> </div>
			<div id="bxContactUs">
				<div class="footer_title">contact us.</div>
				<div style="height:10px;"> </div>
				<div id="notation" onMouseOver="overS('��ǰ�ȳ�, �ֹ�, ����Ʈ �̿� ��� ���� �Ϲ����� ���ǻ��׵��� �Ʒ��� �����Ͻø� ������ ģ���ϰ� �亯�� �帳�ϴ�.', this);" onMouseOut="outS('for all questions about<BR>order or general enquiries<BR>please contact :', this);">for all questions about<BR>order or general enquiries<BR>please contact :</div>
				<div style="height:10px;"> </div>
				<div class="menu_item">email :</div>
				<div class="menu_item"><a href="javascript:popup('../proc/popup_email.php?to=<?php echo $GLOBALS["cfg"]['adminEmail']?>&hidden=1',650,600)"><?php echo $GLOBALS["cfg"]['adminEmail']?></a></div>
				<div style="height:10px;"></div>
				<div class="menu_item">telephone :</div>
				<div class="menu_item">+82 (2) 549 9003</div>
				<div style="height:10px;"></div>
				<div class="menu_item">office hour: </div>
				<div class="menu_item">9:00am - 6:00pm </div>
			</div>
			<div class="footer_spacer02"> </div>
			<div id="bxFollowUs">
				<div class="footer_title">follow us.</div>
				<div style="height:20px;"></div>
				<div id="bxSNSicons">
					<div style="position:relative;float:left;width:12px;height:22px;"></div>
					<div class="sns_icon"><a href="#"><img src="/shop/skin/loosfly/img/jimmy/fbook_01.gif" onmouseover="this.src='/shop/skin/loosfly/img/jimmy/fbook_02.gif'" onmouseout="this.src='/shop/skin/loosfly/img/jimmy/fbook_01.gif'" /></a></div>
					<div style="position:relative;float:left;width:10px;height:22px;"></div>
					<div class="sns_icon"><a href="#"><img src="/shop/skin/loosfly/img/jimmy/twitter_01.gif" onmouseover="this.src='/shop/skin/loosfly/img/jimmy/twitter_02.gif'" onmouseout="this.src='/shop/skin/loosfly/img/jimmy/twitter_01.gif'" /></a></div>
					<div style="position:relative;float:left;width:10px;height:22px;"></div>
					<div class="sns_icon"><a href="#"><img src="/shop/skin/loosfly/img/jimmy/flickr_01.gif" onmouseover="this.src='/shop/skin/loosfly/img/jimmy/flickr_02.gif'" onmouseout="this.src='/shop/skin/loosfly/img/jimmy/flickr_01.gif'" /></a></div>
					<div style="position:relative;float:left;width:10px;height:22px;"></div>
					<div class="sns_icon"><a href="#"><img src="/shop/skin/loosfly/img/jimmy/vimeo_01.gif" onmouseover="this.src='/shop/skin/loosfly/img/jimmy/vimeo_02.gif'" onmouseout="this.src='/shop/skin/loosfly/img/jimmy/vimeo_01.gif'" /></a></div>
					<div style="position:relative;float:left;width:10px;height:22px;"></div>
					<div class="sns_icon"><a href="#"><img src="/shop/skin/loosfly/img/jimmy/google_01.gif" onmouseover="this.src='/shop/skin/loosfly/img/jimmy/google_02.gif'" onmouseout="this.src='/shop/skin/loosfly/img/jimmy/google_01.gif'" /></a></div>
					<div style="position:relative;float:left;width:13px;height:22px;"></div>
				</div>
				<div style="height:30px;"></div>
				<div id="bxLoos">
					<div id="loos"><a href="http://www.loosfly.com/shop/service/company.php?tt=1"><img src="/shop/skin/loosfly/img/jimmy/loos_02.gif"></a></div>
					<div id="balloon"><div style="padding:5px 0 0 5px;line-height:14px">loosfly<br>���ȳ�</div></div>
				</div>
			</div>
			<div class="footer_spacer01"> </div>
		</div>
		<div id="blkObligation">
			<fieldset id="obligation_field">
			<legend ><span><b>[</b>����ǸŻ�� ���� ���ɿ� ���� �ǹ�ǥ�û���<b>]</b></span></legend>
				<table width="100%" height="63"  cellpadding="0" cellspacing="0" border="0" align="center">
				<tr>
					<td>ȸ��� : <?php echo $GLOBALS["cfg"]['compName']?></td>
					<td>��ȭ��ȣ : <?php echo $GLOBALS["cfg"]['compPhone']?></td>
					<td>����ڵ�Ϲ�ȣ : <?php echo $GLOBALS["cfg"]['compSerial']?> <a href="http://www.ftc.go.kr/info/bizinfo/communicationList.jsp" target="_blank"> [Ȯ��]</a></td>
					<td>������������ å���� : <?php echo $GLOBALS["cfg"]['adminName']?></td>
				</tr>
				<tr>
					<td>��ǥ�̻� : <?php echo $GLOBALS["cfg"]['ceoName']?></td>
					<td>�ѽ���ȣ : <?php echo $GLOBALS["cfg"]['compFax']?></td>
					<td>����Ǹž��Ű���ȣ : <?php echo $GLOBALS["cfg"]['orderSerial']?></td>
					<td class="ob_link"><a href="/shop/service/private.php">[����������޹�ħ]</a></td>
				</tr>
				<tr>
					<td colspan="2" style="line-height:15px;">�ּ� : [����] 135-819 <?php echo $GLOBALS["cfg"]['address']?><br><a href="http://www.loosfly.com/shop/service/company.php?tt=1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[������] 135-819 ����� ������ ����2�� 99-22 �������� 4��</a></td>
					<td>�̸��� : <a href="javascript:popup('../proc/popup_email.php?to=<?php echo $GLOBALS["cfg"]['adminEmail']?>&hidden=1',650,600)"><?php echo $GLOBALS["cfg"]['adminEmail']?></a></td>
					<td class="ob_link"><a href="/shop/service/agreement.php">[����Ʈ�̿���]</a></td>
				</tr>
				</table>
			</fieldset>
			<div style="position:relative;float:left;width:20px;height:100px"></div>
			<div style="position:relative;float:left;background-color:#ffffff;border:#3f3f3f 1px solid;width:150px;height:97px;margin-top:8px;">
			<!-- SSL seal -->
				<div style="position:relative;float:left;width:10px;height:100px;"></div>
				<!--div class="cert_label" style="position:relative;float:left;line-height:100px;padding-top:12px"><?php echo displaySSLSeal()?></div-->
				<div style="position:relative;float:left;line-height:10px;padding-top:12px"><a href="http://www.instantssl.com" target="_blank"><img src="/shop/lib/ssl/Comodo/standard_logo/comodo_seal_52x63.png" alt="SSL Certificates" width="52" height="63" style="border: 0px;"><br><span style="font-weight:bold; font-size:9px">SSL Certificates</span></a></div>
				<div style="position:relative;float:left;width:10px;height:100px;"></div>
			<!-- ���ž������� ǥ�� -->
				<div style="position:relative;float:left;padding-top:8px;cursor:pointer;"><img src="https://mark.inicis.com/img/mark_escrow/inipoint/mark_square_black_s.gif" border="0" alt="Ŭ���Ͻø� �̴Ͻý� �����ý����� ��ȿ���� Ȯ���Ͻ� �� �ֽ��ϴ�." style="cursor:hand" Onclick=javascript:window.open("https://mark.inicis.com/mark/escrow_popup.php?no=39840&st=1371721644","mark","scrollbars=no,resizable=no,width=530,height=670");></div>
			</div>
		</div>
		<div style="height:20px;"></div>
		<div id="bottom_logo"></div>
	</div>