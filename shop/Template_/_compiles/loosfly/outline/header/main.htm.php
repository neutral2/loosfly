<?php /* Template_ 2.2.7 2013/06/18 16:47:18 /www/loosfly_godo_co_kr/shop/data/skin/loosfly/outline/header/main.htm 000004851 */ ?>
<?PHP 
include_once ("indicator.php");
$idx = lfy_get_idx( $TPL_VAR["pfile"]);
if(  $TPL_VAR["id"] == "notice" ) $idx=3;
$idx = (int)($idx/10);
$cart = new Cart(null,array("chkRunoutDel"=>true ,"chkKeepPeriod"=>true ) );
?>
		<div id="blkHeaderLayer01">
			<div id="bxTopLogo"><a href="/"><div id="top_logo"></div></a></div>
			<div id="bxSearch">
				<form action="<?php echo url("goods/goods_search.php")?>&" onsubmit="return chkForm(this)">
				<input type="hidden" name="searched" value="Y">
				<input type="hidden" name="log" value="1">
				<input type="hidden" name="skey" value="all">
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
				<table id="search_tbl" cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse">
				<tr>
					<td rowspan="3" style="width:52px;" valign="bottom"><?PHP if( count($cart->item) > 0 ) { ?><img src="/shop/data/skin/loosfly/img/jimmy/loos_icon_01.gif"><?PHP } ?></td>
					<td colspan="2" style="height:7px;"></td>

				</tr>
				<tr>
					<td style="height:20px;"><input name="sword" type="text" id="search_input" required label="search"></td>
					<td style="padding-left:3px;"><input id="search_btn" type="image" src="/shop/data/skin/loosfly/img/jimmy/search_bt_01.gif"></td>
				</tr>
				<tr>
					<td colspan="2" style="height:29px"></td>
				</tr>
				</table>
				</form>		
			</div>
		</div>
		<div id="blkTopMenu">
			<ul style="float:left">
				<li class="home<?PHP echo ($idx==0) ? ' current' : ''; ?>"><a href="/index.html"><div class="menu_item" onMouseOver="overM('Ȩ', this);" onMouseOut="outM('home', this);">home</div></a></li>
				<li class="shop<?PHP echo ($idx==1) ? ' current' : ''; ?>"><a href="/shop.php"><div class="menu_item" onMouseOver="overM('����', this);" onMouseOut="outM('shop', this);">shop</div></a></li>
				<li style="width:3px;height:10px;"></li>
				<li class="stories<?PHP echo ($idx==10) ? ' current' : ''; ?>"><a href="/shop/stories/stories.php"><div class="menu_item" onMouseOver="overM('���丮', this);" onMouseOut="outM('stories', this);">stories</div></a></li>
				<li style="width:3px;height:10px;"></li>
				<li class="blog<?PHP echo ($idx==2) ? ' current' : ''; ?>"><a href="/shop/board/list.php?id=blog"><div class="menu_item" onMouseOver="overM('��α�', this);" onMouseOut="outM('blog', this);">blog</div></a></li>
			</ul>
			<ul style="float:right">
<?php if($GLOBALS["sess"]){?>
				<li class="account<?PHP echo ($idx==3 || $idx==4) ? ' current' : ''; ?>"><a href="/shop/mypage/accinfo.php?"><div class="menu_item" onMouseOver="overM('����������', this);" onMouseOut="outM('my page', this);">my page</div></a></li>
				<li class="cart<?PHP echo ($idx==7) ? ' current' : ''; ?>"><a href="/shop/goods/goods_cart.php"><div class="menu_item" onMouseOver="overM('��ٱ���', this);" onMouseOut="outM('cart', this);">cart</div></a></li>
				<li class="service<?PHP echo ($idx==5 || $idx==6) ? ' current' : ''; ?>"><a href="/shop/service/customer.php"><div class="menu_item" onMouseOver="overM('������', this);" onMouseOut="outM('service', this);">service</div></a></li>
				<li class="logout<?PHP echo ($idx==9) ? ' current2' : ''; ?>"><a href="/shop/member/logout.php"><div class="last_item" onMouseOver="overM('�α׾ƿ�', this);" onMouseOut="outM('logout', this);">logout</div></a></li>
<?php }else{?>
				<li class="cart<?PHP echo ($idx==7) ? ' current' : ''; ?>"><a href="/shop/goods/goods_cart.php"><div class="menu_item" onMouseOver="overM('��ٱ���', this);" onMouseOut="outM('cart', this);">cart</div></a></li>
				<li class="service<?PHP echo ($idx==5 || $idx==6) ? ' current' : ''; ?>"><a href="/shop/service/customer.php"><div class="menu_item" onMouseOver="overM('������', this);" onMouseOut="outM('service', this);">service</div></a></li>
				<li class="login<?PHP echo ($idx==8) ? ' current2' : ''; ?>"><a href="/shop/member/login.php"><div class="last_item" onMouseOver="overM('�α���', this);" onMouseOut="outM('login', this);">login</div></a></li>
<?php }?>
			</ul>
		</div>