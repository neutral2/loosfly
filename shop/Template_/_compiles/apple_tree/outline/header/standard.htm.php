<?php /* Template_ 2.2.7 2013/04/16 11:27:13 /www/loosfly_godo_co_kr/shop/data/skin/apple_tree/outline/header/standard.htm 000005468 */  $this->include_("dataBanner");?>
<a name="top"></a>

<div style="background:url(/shop/data/skin/apple_tree/img/main/gnb_bg.gif) repeat-x;height:156px;">
	<table width=100% cellpadding=0 cellspacing=0 border=0>
	<tr>
		<td>
		<table width="<?php echo $GLOBALS["cfg"]['shopSize']?>" height=114 align="<?php echo $GLOBALS["cfg"]['shopAlign']?>" cellpadding=0 cellspacing=0 border=0>
		<tr>
			<td style="vertical-align:bottom; padding-bottom:23px;"><!-- 배너관리에서 수정가능 --><?php if(is_array($TPL_R1=dataBanner( 2))&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?><?php echo $TPL_V1["tag"]?><?php }}?></td>
			<!------------------ 상단로고 시작 ------------------->
			<td align="center"><!-- 배너관리에서 수정가능 --><?php if(is_array($TPL_R1=dataBanner( 90))&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?><?php echo $TPL_V1["tag"]?><?php }}?></td>
			<!------------------ 상단로고 끝 ------------------->
			<td align="right" valign="top" style="padding-top:6px;">
				<!-- 로그인/회원정보/위시리스/아이디찾기 시작---->
				<table cellpadding="5" cellspacing="0" border="0">
				<tr>
<?php if(!$GLOBALS["sess"]){?>
					<td><a href="<?php echo url("member/login.php")?>&"><img src="/shop/data/skin/apple_tree/img/main/header_btn_login.gif"></a></td>
					<td><a href="<?php echo url("member/join.php")?>&"><img src="/shop/data/skin/apple_tree/img/main/header_btn_joinus.gif"></a></td>
<?php }else{?>
					<td><a href="<?php echo url("member/logout.php")?>&"><img src="/shop/data/skin/apple_tree/img/main/header_btn_logout.gif"></a></td>
					<td><a href="<?php echo url("member/myinfo.php")?>&" <?php if($TPL_VAR["useMypageLayerBox"]=='y'){?>onClick="return fnMypageLayerBox(<?php if($GLOBALS["sess"]){?>true<?php }?>);"<?php }?>><img src="/shop/data/skin/apple_tree/img/main/header_btn_mypage.gif"></a></td>
<?php }?>
					<td><a href="<?php echo url("service/faq.php")?>&"><img src="/shop/data/skin/apple_tree/img/main/header_btn_qna.gif"></a></td>
				</tr>
				</table>
				<!-- 로그인/회원정보/위시리스/아이디찾기 끝------>

				<!-- 검색 시작----------------------------------->
				<form action="<?php echo url("goods/goods_search.php")?>&" onsubmit="return chkForm(this)">
				<input type=hidden name=searched value="Y">
				<input type=hidden name=log value="1">
				<input type=hidden name=skey value="all">
				<input type="hidden" name="hid_pr_text" value="<?php echo $GLOBALS["s_type"]['pr_text']?>" />
				<input type="hidden" name="hid_link_url" value="<?php echo $GLOBALS["s_type"]['link_url']?>" />
				<input type="hidden" id="edit" name="edit" value=""/>
<?php if($GLOBALS["s_type"]['keyword_chk']=='on'&&$GLOBALS["s_type"]['pr_text']&&!$_GET['sword']){?>
				<?php
					 $TPL_VAR["id"] = "sword";
					 $TPL_VAR["onkeyup"] = "document.getElementById('edit').value='Y'";
					 $TPL_VAR["onclick"] = "document.getElementById('sword').value=''";
					 $TPL_VAR["value"] =  $GLOBALS["s_type"]['pr_text'];
				?>
<?php }else{?>
				<?php
					 $TPL_VAR["value"] =  $_GET['sword'];
				?>
<?php }?>
				<table cellpadding="0" cellspacing="0" border="0" style="margin-top:40px;line-height:0;">
				<tr>
					<td><input name=sword type=text class=line style="width:152px;height:21px;_height:25px;" id="<?php echo $TPL_VAR["id"]?>" onkeyup="<?php echo $TPL_VAR["onkeyup"]?>" onclick="<?php echo $TPL_VAR["onclick"]?>" value="<?php echo $TPL_VAR["value"]?>" required label="검색어"></td>
					<td><input type=image src="/shop/data/skin/apple_tree/img/main/header_btn_search.gif"></td>
				</tr>
				</table>
				</form>
				<!-- 검색 끝-------------------------------------->
			</td>
		</tr>
		</table>
		</td>
	</tr>

	<tr>
		<td height="32">
		<table width="<?php echo $GLOBALS["cfg"]['shopSize']?>" align="<?php echo $GLOBALS["cfg"]['shopAlign']?>" cellpadding="0" cellspacing="0">
		<tr>
			<td>
			<!------------  상단메뉴 시작 -------------------------------------------------------->
			<table cellpadding="0" cellspacing="0" border="0">
			<tr>
				<td><a href="<?php echo url("goods/goods_cart.php")?>&"><img src="/shop/data/skin/apple_tree/img/main/gnb_menu_cart.jpg"></a></td>
				<td><a href="<?php echo url("mypage/mypage_orderlist.php")?>&"><img src="/shop/data/skin/apple_tree/img/main/gnb_menu_order.jpg"></a></td>
				<td><a href="<?php echo url("member/myinfo.php?")?>&&" <?php if($TPL_VAR["useMypageLayerBox"]=='y'){?>onClick="return fnMypageLayerBox(<?php if($GLOBALS["sess"]){?>true<?php }?>);"<?php }?>><img src="/shop/data/skin/apple_tree/img/main/gnb_menu_my.jpg"></a></td>
				<td><a href="<?php echo url("mypage/mypage_wishlist.php")?>&"><img src="/shop/data/skin/apple_tree/img/main/gnb_menu_wish.jpg"></a></td>
				<td><a href="<?php echo url("goods/goods_review.php")?>&"><img src="/shop/data/skin/apple_tree/img/main/gnb_menu_review.jpg"></a></td>
				<td><a href="<?php echo url("service/customer.php")?>&"><img src="/shop/data/skin/apple_tree/img/main/gnb_menu_cs.jpg"></a></td>
				<td><a href="<?php echo url("board/list.php?")?>&&id=notice"><img src="/shop/data/skin/apple_tree/img/main/gnb_menu_community.jpg"></a></td>
			</tr>
			</table>
			<!------------  상단메뉴 끝 ---------------------------------------------------------->
			</td>
		</tr>
		</table>
		</td>
	</tr>
	</table>
</div>