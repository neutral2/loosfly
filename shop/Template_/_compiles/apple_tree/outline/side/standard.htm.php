<?php /* Template_ 2.2.7 2013/04/16 11:27:20 /www/loosfly_godo_co_kr/shop/data/skin/apple_tree/outline/side/standard.htm 000003160 */  $this->include_("dataBank","dataBanner");?>
<?php if($TPL_VAR["todayshop_cfg"]['shopMode']!='todayshop'){?>
<!-- ī�װ� �޴� ���� -->
<!-- ���� ���μҽ��� '��Ÿ/�߰�������(proc) > ī�װ��޴�- menuCategory.htm' �ȿ� �ֽ��ϴ� -->
<?php $this->print_("menuCategory",$TPL_SCP,1);?>

<!-- ī�װ� �޴� �� -->
<?php }?>

<?php if($TPL_VAR["smartSearch_useyn"]=='y'){?>
<?php $this->print_("smartSearch",$TPL_SCP,1);?>

<?php }?>

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

<!-- �������Ա� : Start -->
<div style="width:190px;">
	<div><img src="/shop/data/skin/apple_tree/img/main/sid_tit_bank.gif"></div>
	<div style="border-style:solid; border-width: 0 1px; border-color:#D1D1D1; padding-bottom:15px">
<?php if(is_array($TPL_R1=dataBank())&&!empty($TPL_R1)){$TPL_S1=count($TPL_R1);$TPL_I1=-1;foreach($TPL_R1 as $TPL_V1){$TPL_I1++;?>
	<table cellpadding="0" cellspacing="0" style="margin-left:20px; color:#3E3E3E; font-weight:bold; line-height:16px;">
	<col width="45">
	<tr>
		<td><img src="/shop/data/skin/apple_tree/img/main/sid_btn_bank.gif"></td>
		<td><?php echo $TPL_V1["bank"]?></td>
	</tr>
	<tr>
		<td><img src="/shop/data/skin/apple_tree/img/main/sid_btn_name.gif"></td>
		<td><?php echo $TPL_V1["name"]?></td>
	</tr>
	<tr>
		<td><img src="/shop/data/skin/apple_tree/img/main/sid_btn_account.gif"></td>
		<td><?php echo $TPL_V1["account"]?></td>
	</tr>
	</table>
<?php if($TPL_I1!=$TPL_S1- 1){?>
	<div style="border-top:solid 1px #EBEBEB;height:1px;font-size:0px; margin:7px 0 6px"></div>
<?php }?>
<?php }}?>
	</div>
</div>
<!-- �������Ա� : End -->

<!-- ���ο��ʹ�� : Start -->
<table cellpadding="0" cellspacing="0" border="0"width=100%>
<tr><td align="left"><!-- (��ʰ������� ��������) --><?php if(is_array($TPL_R1=dataBanner( 4))&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?><?php echo $TPL_V1["tag"]?><?php }}?></td></tr>
<tr><td align="left"><!-- (��ʰ������� ��������) --><?php if(is_array($TPL_R1=dataBanner( 5))&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?><?php echo $TPL_V1["tag"]?><?php }}?></td></tr>
</table>
<!-- ���ο��ʹ�� : End -->

<div style="padding-top:30px"></div>

<!-- SNS �ǽð����� ����Ʈ : Start-->
<table cellpadding=0 cellspacing=0 border=0 width=100%>
<tr><td align=center><?php echo snsPosts( 1)?></td></tr>
</table>
<!-- SNS �ǽð����� ����Ʈ : End-->