<?php /* Template_ 2.2.7 2012/11/20 16:29:25 /www/loosfly_godo_co_kr/shop/data/skin/apple_tree/outline/side/mypage.htm 000002831 */  $this->include_("dataBanner");?>
<div style="width:190px; margin-bottom:8px">
	<div><img src="/shop/data/skin/apple_tree/img/common/sid_tit_mypagetop.gif"></div>

	<!-- ���������ڽ� : START -->
	<div style="background-color:#F6FCFC; padding:18px 15px;border:solid 0 #39C1D7; border-width:0 2px;">
		<div class="eng" style="border-bottom:solid 1px #E8E8E8; padding:0 0 4px 3px;"><img src="/shop/data/skin/apple_tree/img/common/sid_icon04.gif" align=absmiddle> <B><?php echo $GLOBALS["member"]["name"]?></B> <img src="/shop/data/skin/apple_tree/img/common/sid_icon05.gif" align=absmiddle></div>
		<table cellpadding=0 cellspacing=0 border=0 style="padding:5px 0;">
		<tr><td><?php $this->print_("myBox",$TPL_SCP,1);?></td></tr>
		</table>
	</div>
	<!-- ���������ڽ� : END -->

	<!-- ���������� �޴� ���� -->
	<div><img src="/shop/data/skin/apple_tree/img/common/sid_line.gif"></div>
	<table cellpadding=0 cellspacing=0 border=0 class="lnbMyMenu">
	<tr>
		<th>��������</th>
	</tr>
	<tr>
		<td>
			<div><a href="<?php echo url("member/myinfo.php")?>&" class="lnbmenu">ȸ����������</a></div>
			<div><a href="<?php echo url("member/hack.php")?>&" class="lnbmenu">ȸ��Ż��</a></div>
		</td>
	</tr>
	<tr>
		<th>�� ��������</th>
	</tr>
	<tr>
		<td>
			<div><a href="<?php echo url("mypage/mypage_orderlist.php")?>&" class="lnbmenu">�ֹ�����/�����ȸ</a></div>
			<div><a href="<?php echo url("mypage/mypage_emoney.php")?>&" class="lnbmenu">�����ݳ���</a></div>
			<div><a href="<?php echo url("mypage/mypage_coupon.php")?>&" class="lnbmenu">������������</a></div>
			<div><a href="<?php echo url("mypage/mypage_wishlist.php")?>&" class="lnbmenu">��ǰ������</a></div>
		</td>
	</tr>
	<tr>
		<th><a href="<?php echo url("mypage/mypage_qna.php")?>&">1:1 ���ǰԽ���</a></th>
	</tr>
	<tr>
		<th><a href="<?php echo url("mypage/mypage_review.php")?>&">���� ��ǰ�ı�</a></th>
	</tr>
	<tr>
		<th><a href="<?php echo url("mypage/mypage_qna_goods.php")?>&">���� ��ǰ����</a></th>
	</tr>
	<tr>
		<th class="unline"><a href="<?php echo url("mypage/mypage_today.php")?>&">�ֱ� �� ��ǰ ���</a></th>
	</tr>
	</table>
	<!-- ���������� �޴� �� -->
</div>

<!-- ���ο��ʹ�� : Start -->
<table cellpadding="0" cellspacing="0" border="0"width=100%>
<tr><td align="left"><!-- (��ʰ������� ��������) --><?php if(is_array($TPL_R1=dataBanner( 4))&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?><?php echo $TPL_V1["tag"]?><?php }}?></td></tr>
<tr><td align="left"><!-- (��ʰ������� ��������) --><?php if(is_array($TPL_R1=dataBanner( 5))&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?><?php echo $TPL_V1["tag"]?><?php }}?></td></tr>
</table>
<!-- ���ο��ʹ�� : End -->