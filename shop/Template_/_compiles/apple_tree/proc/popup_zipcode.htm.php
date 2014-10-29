<?php /* Template_ 2.2.7 2012/11/14 15:07:40 /www/loosfly_godo_co_kr/shop/data/skin/apple_tree/proc/popup_zipcode.htm 000003044 */ 
$TPL__loop_1=empty($GLOBALS["loop"])||!is_array($GLOBALS["loop"])?0:count($GLOBALS["loop"]);?>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<title>++ GODOMALL ++</title>
<div id=dynamic></div>
<script src="/shop/data/skin/apple_tree/common.js"></script>
<link rel="styleSheet" href="/shop/data/skin/apple_tree/style.css">

<script>

function zipcode(zipcode,address)
{
	var form = <?php echo $GLOBALS["form"]?>;
	var r_zipcode = zipcode.split("-");
	form['zipcode[]'][0].value = r_zipcode[0];
	form['zipcode[]'][1].value = r_zipcode[1];
	form.address.value = address;
	form.address_sub.value = "";
	form.address_sub.focus();

	if(form.deliPoli != undefined){
		opener.getDelivery();
	}

	self.close();
}
window.onload = function(){document.forms[0].dong.focus();}

</script>

</head>

<body bgcolor="#000000" style="padding:10px;">

<table height=100% width=100% cellpadding=0 cellspacing=0 border=0 bgcolor="#FFFFFF">
<tr>
	<td style="background:#000000; border-bottom:2px solid #DDDDDD"><img src="/shop/data/skin/apple_tree/img/common/title_zipcode.gif"></td>
</tr>
<tr>
	<td height=100% align=center valign=top>

	<form onsubmit="return chkForm(this)" id=form>
	<input type=hidden name=form value="<?php echo $GLOBALS["form"]?>">

	<TABLE cellpadding=3 cellspacing=0 border=0>
	<tr><td align=center class=stxt style="padding-top:10">찾고자 하는 주소의 동(읍/면) 이름을 입력하세요<br>[예]삼성동,수서동,역삼동</td></tr>
	<TR>
		<TD class=input_txt>지역명 <input type=text name=dong value="<?php echo $GLOBALS["dong"]?>" required label="지역명" size=30><span class=noline><input type=image src="/shop/data/skin/apple_tree/img/common/btn_search.gif" align=absmiddle></span></TD>
	</TR>
	</TABLE>
	</form>

	<div style="height:15; font-size:0pt"></div>
	<table width=95% cellpadding=0 cellspacing=0>
	<col width=80 align=center>
	<tr height=19 bgcolor="#A8A8A8">
		<th style="font:bold 8pt 돋움; color:#FFFFFF">우편번호</th>
		<th style="font:bold 8pt 돋움; color:#FFFFFF">주소</th>
	</tr>
<?php if($TPL__loop_1){$TPL_I1=-1;foreach($GLOBALS["loop"] as $TPL_V1){$TPL_I1++;?>
	<tr <?php if($TPL_I1% 2){?>bgcolor="#f7f7f7"<?php }?> height=25>
		<td><?php echo $TPL_V1["zipcode"]?></td>
		<td><a href="javascript:zipcode('<?php echo $TPL_V1["zipcode"]?>','<?php echo $TPL_V1["sido"]?> <?php echo $TPL_V1["gugun"]?> <?php echo $TPL_V1["dong"]?>')"><?php echo $TPL_V1["sido"]?> <?php echo $TPL_V1["gugun"]?> <?php echo $TPL_V1["dong"]?> <?php echo $TPL_V1["bunji"]?></a></td>
	</tr>
	<tr><td colspan=2 height=1 bgcolor="E5E5E5"></td></tr>
<?php }}?>
	</table>

	<div style="padding:10px" align=center><?php echo $TPL_VAR["pg"]->page['navi']?></div>

	</td>
</tr>
<tr>
	<td valign=bottom align=right style="padding:0 14 6 0;"><A HREF="javascript:this.close()" onFocus="blur()"><img src="/shop/data/skin/apple_tree/img/common/popup_close.gif"></A></td>
</tr>
</table>
</body>
</html>