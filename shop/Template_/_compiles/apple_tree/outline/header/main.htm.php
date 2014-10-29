<?php /* Template_ 2.2.7 2013/04/15 18:29:11 /www/loosfly_godo_co_kr/shop/data/skin/apple_tree/outline/header/main.htm 000002053 */  $this->include_("dataBanner");?>
<a name="top"></a>

<div id="block01">
	<table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse">
		<tr><td class="vspace10" colspan="2"></td></tr>
		<tr>
			<td id="logo_td">
				<div id="div_logo"><a href="../../index.html"><!-- 배너관리에서 수정가능 --><?php if(is_array($TPL_R1=dataBanner( 90))&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?><?php echo $TPL_V1["tag"]?><?php }}?></a></div>
			</td>
			<td id="search_td">
				<div id="div_search">
					<form action="" method="post" name="search_frm" enctype="multipart/form-data">
						<label for="search_input" id="search_label">Search</label>
						<input type="text" id="search_input" name="search_string" required="required" title="search" />
						<input type="button" name="search_btn" value="go" style="display:none" />
					</form>
				</div>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<table id="menu_table" cellpadding="0" cellspacing="0" border="0">
					<tr valign="bottom" align="left">
						<td width="22" height="27"> </td>
						<td width="70"><a href="/index.html">home</a></td>
						<td width="53"><a href="/shop.php">shop</a></td>
						<td width="89"><a href="#">blog</a></td>
						<td width="100"><a href="/shop/service/customer.php">service</a></td>
						<td width="561"> </td>
						<td width="53"><a href="/shop/member/login.php">login</a></td>
						<td width="73"><a href="/shop/goods/goods_cart.php">cart</a></td>
						<td width="79"><a href="/shop/member/myinfo.php">my page</a></td>
					</td></tr>
					<tr>
						<td height="3"> </td>
						<td></td>
						<td><div id="ind1" class="div_indicator" style="position:relative; left:1px;"></div></td>
						<td></td>
						<td></td>
						<td> </td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</div>