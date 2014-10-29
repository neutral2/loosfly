<?php /* Template_ 2.2.7 2014/10/24 18:27:05 /www/loosfly_godo_co_kr/shop/data/skin/loosfly/outline/header/standard.htm 000003782 */ ?>
<?PHP 
include_once ("_loos_top_info.php");
$options = "";
foreach( $_GET as $key=>$data ) {
	$options .= $key."=".$data."&";
}
$idx = get_indicator( $TPL_VAR["pfile"], $options);

$cart = new Cart(null,array("chkRunoutDel"=>true ,"chkKeepPeriod"=>true ) );
$cart_count = count($cart->item);
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
					<td rowspan="3" style="width:52px;" valign="bottom"></td>
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
				<li class="home<?=($idx==0) ? ' current' : ''?>"><?=make_menu_item(0, "menu_item")?></li>
				<li class="shop<?=($idx==1) ? ' current' : ''?>"><?=make_menu_item(1, "menu_item")?></li>
				<li class="collabo<?=($idx==2) ? ' current' : ''?>"><?=make_menu_item(2, "menu_item")?></li>
				<li class="blank"><div style="font-size:8px">&nbsp;</div></li>
				<li class="stories<?=($idx==3) ? ' current' : ''?>"><?=make_menu_item(3, "menu_item")?></li>
				<!--li class="blog<?=($idx==4) ? ' current' : ''?>"><?=make_menu_item(4, "menu_item")?></li-->
				<li class="partners<?=($idx==5) ? ' current' : ''?>"><?=make_menu_item(5, "menu_item")?></li>
			</ul>
			<ul style="float:right">
<?php if($GLOBALS["sess"]){?>
				<li class="account<?=($idx==6) ? ' current' : ''?>"><?=make_menu_item(6, "menu_item")?></li>
				<li class="cart<?=($idx==7) ? ' current' : ''?>"><?=make_menu_item(7, "menu_item", $cart_count)?></li>
				<li class="service<?=($idx==8) ? ' current' : ''?>"><?=make_menu_item(8, "menu_item")?></li>
				<li class="logout<?=($idx==11) ? ' current2' : ''?>"><?=make_menu_item(11, "last_item")?></li>
<?php }else{?>
				<li class="cart<?=($idx==7) ? ' current' : ''?>"><?=make_menu_item(7, "menu_item")?></li>
				<li class="service<?=($idx==8) ? ' current' : ''?>"><?=make_menu_item(8, "menu_item", $cart_count)?></li>
				<li class="login<?=($idx==9) ? ' current' : ''?>"><?=make_menu_item(9, "menu_item")?></li>
				<li class="joinus<?=($idx==10) ? ' current2' : ''?>"><?=make_menu_item(10, "last_item")?></li>
<?php }?>
			</ul>
		</div>