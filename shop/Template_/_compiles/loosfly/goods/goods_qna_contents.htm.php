<?php /* Template_ 2.2.7 2014/06/30 18:20:09 /www/loosfly_godo_co_kr/shop/data/skin/loosfly/goods/goods_qna_contents.htm 000001984 */ ?>
<?php if($TPL_VAR["authview"]=='Y'){?>
<table id=contents width=100% cellpadding=0 cellspacing=0 style="border-top-style:solid;border-top-color:#303030;border-top-width:0px;" onmouseover=this.style.background="#F7F7F7" onmouseout=this.style.background="">
<tr>
	<td style="font-size:12px;line-height:20px;padding-left:17px;text-align:left">
	<div><?php echo $TPL_VAR["contents"]?></div>
	<div style="float:right;">
<?php if($TPL_VAR["parent"]==$TPL_VAR["sno"]&&!$TPL_VAR["notice"]){?>
	<a href="javascript:;" onclick="popup_register( 'reply_qna', '<?php echo $TPL_VAR["goodsno"]?>', '<?php echo $TPL_VAR["sno"]?>' );"><img src="/shop/data/skin/loosfly/img/common/btn_reply.gif" border="0" align="absmiddle"></a>
<?php }?>
<?php if($TPL_VAR["authmodify"]=='Y'){?>
	<a href="javascript:;" onclick="popup_register( 'mod_qna', '<?php echo $TPL_VAR["goodsno"]?>', '<?php echo $TPL_VAR["sno"]?>' );"><img src="/shop/data/skin/loosfly/img/common/btn_modify2.gif" border="0" align="absmiddle"></a>
<?php }?>
<?php if($TPL_VAR["authdelete"]=='Y'){?>
	<a href="javascript:;" onclick="popup_register( 'del_qna', '<?php echo $TPL_VAR["goodsno"]?>', '<?php echo $TPL_VAR["sno"]?>' );"><img src="/shop/data/skin/loosfly/img/common/btn_delete.gif" border="0" align="absmiddle"></a>
<?php }?>
	</div>
	</td>
</tr>
<tr><td height=1 bgcolor="#E6E6E6" style="padding:0px;"></td></tr>
</table>
<?php }else{?>
<table width=100% cellpadding=0 cellspacing=0 style="border-top-style:solid;border-top-color:#303030;border-top-width:2px;" onmouseover=this.style.background="#F7F7F7" onmouseout=this.style.background="">
<tr height=30>
	<td style="border-top-style:solid;border-top-color:#E6E6E6;border-top-width:1px" align="center">비밀글 입니다.</td>
</tr>
<tr><td height="1" bgcolor="#E6E6E6" style="padding:0px;"></td></tr>
</table>
<?php }?>