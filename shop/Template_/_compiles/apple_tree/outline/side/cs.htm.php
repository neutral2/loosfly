<?php /* Template_ 2.2.7 2012/11/20 16:29:25 /www/loosfly_godo_co_kr/shop/data/skin/apple_tree/outline/side/cs.htm 000002908 */  $this->include_("dataBanner");?>
<!-- ������ �޴� ���� -->
<div style="width:190px;">
	<div><img src="/shop/data/skin/apple_tree/img/common/sid_tit_cscentertop.gif"></div>
	<div style="border:solid 0 #39C1D7; border-width:0 2px 2px 2px; padding:10px 0 3px 8px;">
	<table cellpadding=0 cellspacing=7 border=0>
	<tr>
		<td><a href="<?php echo url("service/faq.php")?>&" class="lnbmenu">FAQ</a></td>
	</tr>
	<tr>
		<td><a href="<?php echo url("service/guide.php")?>&" class="lnbmenu">�̿�ȳ�</a></td>
	</tr>
	<tr>
		<td><a href="<?php echo url("mypage/mypage_qna.php")?>&" class="lnbmenu">1:1���ǰԽ���</a></td>
	</tr>
	<tr>
		<td><a href="<?php echo url("member/find_id.php")?>&" class="lnbmenu">IDã��</a></td>
	</tr>
	<tr>
		<td><a href="<?php echo url("member/find_pwd.php")?>&" class="lnbmenu">��й�ȣã��</a></td>
	</tr>
	<tr>
		<td><a href="<?php echo url("member/myinfo.php")?>&" class="lnbmenu">����������</a></td>
	</tr>
	</table>
	</div>
</div>
<!-- ������ �޴� �� -->

<!-- ���ο��� ������ 01 : Start -->
<div style="width:190px;">
	<div style="margin-top:10px;"><img src="/shop/data/skin/apple_tree/img/main/sid_tit_cscenter.gif"></div>
	<div><img src="/shop/data/skin/apple_tree/img/main/sid_ban_cscenter.gif"></div>
	<dl style="border-style:solid; border-width: 0 1px; border-color:#D1D1D1; margin:0; padding:5px 0 15px; color:#616161; line-height:17px;">
		<dt style="font-weight:bold; margin-left:20px">������ ��ð��ȳ�</dt>
		<dd style="margin-left:20px">���� am10:00 - pm18:00</dd>
		<dd style="margin-left:20px">����� am10:00 - pm13:00</dd>
		<dd style="margin-left:20px">�Ͽ���, ������ �޹�</dd>
	</dl>
</div>
<!-- ���ο��� ������ 01 : End -->

<!-- �����ڿ��� SMS������ ��� : ���������� '�����ΰ��� > ��Ÿ������������ > ��Ÿ/�߰�������(proc) > �����ڿ��� SMS��㹮���ϱ� - ccsms.htm' �� �ֽ��ϴ�. -->
<!-- �Ʒ� ����� �⺻������ ȸ���鸸 ���̵��� �Ǿ��ִ� �ҽ��Դϴ�.
���� ��ȸ���鵵 �� ����� ����ϰ� �Ϸ��� �Ʒ� �ҽ��߿�,  \{ # ccsms \}  ��κи� ���ܳ��� �Ʒ��� �ҽ��� �����Ͻø� �˴ϴ�.
���� �̱���� ����Ϸ��� 'ȸ������ > SMS����Ʈ����' ���� ����Ʈ������ �Ǿ��־�߸� �����մϴ�. -->

<?php if($GLOBALS["sess"]){?>
<?php $this->print_("ccsms",$TPL_SCP,1);?>

<?php }?>

<!-- ���ο��ʹ�� : Start -->
<table cellpadding="0" cellspacing="0" border="0"width=100%>
<tr><td align="left"><!-- (��ʰ������� ��������) --><?php if(is_array($TPL_R1=dataBanner( 4))&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?><?php echo $TPL_V1["tag"]?><?php }}?></td></tr>
<tr><td align="left"><!-- (��ʰ������� ��������) --><?php if(is_array($TPL_R1=dataBanner( 5))&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?><?php echo $TPL_V1["tag"]?><?php }}?></td></tr>
</table>
<!-- ���ο��ʹ�� : End -->