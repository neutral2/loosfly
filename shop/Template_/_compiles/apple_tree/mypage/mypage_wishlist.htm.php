<?php /* Template_ 2.2.7 2012/11/14 15:07:40 /www/loosfly_godo_co_kr/shop/data/skin/apple_tree/mypage/mypage_wishlist.htm 000003088 */ 
$TPL_loop_1=empty($TPL_VAR["loop"])||!is_array($TPL_VAR["loop"])?0:count($TPL_VAR["loop"]);?>
<?php $this->print_("header",$TPL_SCP,1);?>


<!-- ����̹��� || ������ġ -->
<TABLE width=100% cellpadding=0 cellspacing=0 border=0>
<tr>
	<td><img src="/shop/data/skin/apple_tree/img/common/title_wishlist.gif" border=0></td>
</tr>
<TR>
	<td class="path">HOME > ���������� > <B>��ǰ������</B></td>
</TR>
</TABLE>


<div class="indiv"><!-- Start indiv -->

<script>
function act(mode)
{
	var fm = document.frmWish;
	if (isChked('sno[]')){
		fm.mode.value = mode;
		fm.submit();
	}
}
</script>


<form name=frmWish method=post>
<input type=hidden name=mode>

<table width=100% cellpadding=0 cellspacing=0 border=0>
<tr><td height=2 bgcolor="#303030" colspan=10></td></tr>
<tr bgcolor=#F0F0F0 height=23 class=input_txt>
	<th><a href="javascript:chkBox('sno[]','rev')">����</a></th>
	<th colspan=2>��ǰ����</th>
	<th>������</th>
	<th>�ǸŰ�</th>
	<th>������¥</th>
</tr>
<tr><td height=1 bgcolor="#D6D6D6" colspan=10></td></tr>
<col width=30 align=center><col width=60 align=center><col><col width=60 align=center>
<col width=80 align=right style="padding-right:10"><col width=100 align=center>
<?php if($TPL_loop_1){foreach($TPL_VAR["loop"] as $TPL_V1){?>
<input type=hidden name=goodsno[<?php echo $TPL_V1["sno"]?>] value="<?php echo $TPL_V1["goodsno"]?>">
<input type=hidden name=opt[<?php echo $TPL_V1["sno"]?>][] value="<?php echo implode('|',$TPL_V1["opt"])?>">
<?php if(is_array($TPL_R2=$TPL_V1["r_addopt"])&&!empty($TPL_R2)){foreach($TPL_R2 as $TPL_V2){?><input type=hidden name=addopt[<?php echo $TPL_V1["sno"]?>][] value="<?php echo $TPL_V2?>"><?php }}?>
<tr>
	<td><input type=checkbox name=sno[] value="<?php echo $TPL_V1["sno"]?>">
	<td height=60>
	<a href="<?php echo url("goods/goods_view.php?")?>&goodsno=<?php echo $TPL_V1["goodsno"]?>"><?php echo goodsimg($TPL_V1["img_s"], 40)?></a>
	</td>
	<td>
	<div><a href="<?php echo url("goods/goods_view.php?")?>&goodsno=<?php echo $TPL_V1["goodsno"]?>"><?php echo $TPL_V1["goodsnm"]?></a> <?php if($TPL_V1["opt"]){?>[<?php echo implode("/",$TPL_V1["opt"])?>]<?php }?></div>
<?php if(is_array($TPL_R2=$TPL_V1["addopt"])&&!empty($TPL_R2)){foreach($TPL_R2 as $TPL_V2){?>[<?php echo $TPL_V2["optnm"]?>:<?php echo $TPL_V2["opt"]?>]<?php }}?>
	</td>
	<td><?php echo number_format($TPL_V1["reserve"])?>��</td>
	<td><?php echo number_format($TPL_V1["price"]+$TPL_V1["addprice"])?>��</td>
	<td><?php echo substr($TPL_V1["regdt"], 0, 10)?></td>
</tr>
<tr><td colspan=10 height=1 bgcolor=#DEDEDE></td></tr>
<?php }}?>
</table><p>

<center>
<a href="javascript:act('delItem')"><img src="/shop/data/skin/apple_tree/img/common/btn_select_delete.gif"></a>
<a href="javascript:act('cart')"><img src="/shop/data/skin/apple_tree/img/common/btn_cartin.gif"></a>
</center>

</form>

<div class="pagediv"><?php echo $TPL_VAR["pg"]->page['navi']?></div>

</div><!-- End indiv -->

<?php $this->print_("footer",$TPL_SCP,1);?>