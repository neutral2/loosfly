<?php /* Template_ 2.2.7 2013/04/16 10:58:32 /www/loosfly_godo_co_kr/shop/data/skin/loosfly/board/gallery/secret.htm 000002107 */ ?>
<?php $this->print_("header",$TPL_SCP,1);?><?php echo $GLOBALS["bdHeader"]?>


<body onLoad="if (document.frmSecret.password) document.frmSecret.password.focus()">

<table width=<?php echo $GLOBALS["bdWidth"]?> align=<?php echo $GLOBALS["bdAlign"]?> cellpadding=0 cellspacing=0><tr><td>

<form name=frmSecret method=post>
<input type=hidden name=returnUrl value="<?php echo $TPL_VAR["returnUrl"]?>">

<div style="height:20; font-size:0pt"></div>
<?php if($TPL_VAR["m_no"]){?>

<div style="width:100%; border:1px solid #DEDEDE;">
<table width=100% cellpadding=0 cellspacing=0 border=0>
<tr>
	<td style="border:5px solid #F3F3F3;" align=center>
		<table>
		<tr height=50>
			<td class=input_txt>접근 권한이 없습니다</td>
		</tr>
		</table>
	</td>
</tr>
</table>
</div>

<div align=center style="padding:50px 0 20px 0" class=noline>
<a href="javascript:history.back()"><img src="/shop/data/skin/loosfly/board/gallery/img/btn_board_confirm.gif"></a>
</div>

<?php }else{?>



<div class="hundred" style="text-align:left; padding-left:20; height:20"><div class="input_txt">↓ 비밀글입니다. 글을 작성하실때 입력한 비밀번호를 입력하세요.</div></div>
<div class="hundred" style="border:1px solid #DEDEDE;">
<table width=100% cellpadding=0 cellspacing=0 border=0>
<tr>
	<td style="border:5px solid #F3F3F3;" align=center>
		<table>
		<tr height=50>
			<td class=input_txt align=right>비밀번호</td>
			<td><input type=password name=password class=line size=30></td>
		</tr>
		</table>
	</td>
</tr>
</table>
</div>

<div align=center style="padding:50px 0 20px 0" class=noline>
<a href="javascript:document.frmSecret.submit()"><img src="/shop/data/skin/loosfly/board/gallery/img/btn_board_confirm.gif"></a>
<a href="<?php echo $TPL_VAR["returnUrl"]?>"><img src="/shop/data/skin/loosfly/board/gallery/img/btn_board_back.gif"></a>
</div>


<?php }?>

</form>

</td></tr></table>

<?php $this->print_("footer",$TPL_SCP,1);?>