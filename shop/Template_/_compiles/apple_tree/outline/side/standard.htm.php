<?php /* Template_ 2.2.7 2013/04/16 11:27:20 /www/loosfly_godo_co_kr/shop/data/skin/apple_tree/outline/side/standard.htm 000003160 */  $this->include_("dataBank","dataBanner");?>
<?php if($TPL_VAR["todayshop_cfg"]['shopMode']!='todayshop'){?>
<!-- 카테고리 메뉴 시작 -->
<!-- 관련 세부소스는 '기타/추가페이지(proc) > 카테고리메뉴- menuCategory.htm' 안에 있습니다 -->
<?php $this->print_("menuCategory",$TPL_SCP,1);?>

<!-- 카테고리 메뉴 끝 -->
<?php }?>

<?php if($TPL_VAR["smartSearch_useyn"]=='y'){?>
<?php $this->print_("smartSearch",$TPL_SCP,1);?>

<?php }?>

<!-- 메인왼쪽 고객센터 01 : Start -->
<div style="width:190px;">
	<div style="margin-top:10px;"><img src="/shop/data/skin/apple_tree/img/main/sid_tit_cscenter.gif"></div>
	<div><img src="/shop/data/skin/apple_tree/img/main/sid_ban_cscenter.gif"></div>
	<dl style="border-style:solid; border-width: 0 1px; border-color:#D1D1D1; margin:0; padding:5px 0 15px; color:#616161; line-height:17px;">
		<dt style="font-weight:bold; margin-left:20px">고객센터 운영시간안내</dt>
		<dd style="margin-left:20px">평일 am10:00 - pm18:00</dd>
		<dd style="margin-left:20px">토요일 am10:00 - pm13:00</dd>
		<dd style="margin-left:20px">일요일, 공휴일 휴무</dd>
	</dl>
</div>
<!-- 메인왼쪽 고객센터 01 : End -->

<!-- 무통장입금 : Start -->
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
<!-- 무통장입금 : End -->

<!-- 메인왼쪽배너 : Start -->
<table cellpadding="0" cellspacing="0" border="0"width=100%>
<tr><td align="left"><!-- (배너관리에서 수정가능) --><?php if(is_array($TPL_R1=dataBanner( 4))&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?><?php echo $TPL_V1["tag"]?><?php }}?></td></tr>
<tr><td align="left"><!-- (배너관리에서 수정가능) --><?php if(is_array($TPL_R1=dataBanner( 5))&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?><?php echo $TPL_V1["tag"]?><?php }}?></td></tr>
</table>
<!-- 메인왼쪽배너 : End -->

<div style="padding-top:30px"></div>

<!-- SNS 실시간연동 리스트 : Start-->
<table cellpadding=0 cellspacing=0 border=0 width=100%>
<tr><td align=center><?php echo snsPosts( 1)?></td></tr>
</table>
<!-- SNS 실시간연동 리스트 : End-->