<?php /* Template_ 2.2.7 2013/12/16 18:54:19 /www/loosfly_godo_co_kr/shop/data/skin/loosfly/goods/goods_grp_04.htm 000003905 */ ?>
<?php $this->print_("header",$TPL_SCP,1);?>

<link rel="stylesheet" href="/shop/data/skin/loosfly/goods/goods_category.css" />
<script type="text/javascript" language="javascript" src="/shop/data/skin/loosfly/goods/goods_category.js"></script>
<?php if($this->tpl_['side_inc']){?>
		<div class="blkLeftMenu">
<?php $this->print_("side_inc",$TPL_SCP,1);?>

		</div>
<?php }?>
	<div id="blkContents">
		<div style="height:7px;"></div>
		<div style="height:15px;"></div>
		<div style="text-align:center;font-size:16px;font-family:'Courier New';letter-spacing:3px;">MD's Choice</div>
		<div style="height:5px;"></div>
<style>
.bxCatNav ul li { position:relative;display:block;float:left;width:860px;text-align:center;font:normal 13px/25px "Courier New";cursor:pointer;letter-spacing:-1px }
.bxCatNav ul li.middle { border:#000000 0 dotted;border-right-width:1px; }
</style>
		<div id="bxCatImg" class="bxCatImg">
			<div id="catimg_outline" class="catimg_outline">
				<span class="btn_catL"></span>
				<span class="btn_catR"></span>
				<div id="catimg_box" class="catimg_box">
					<div id="cat_div1" class="cat_div" style="left:0px; "><a href="/shop/goods/goods_view.php?goodsno=1&category="><img src="/shop/data/skin/loosfly/img/jimmy/shop_photo/MD_choice/shop_choice_01.jpg"></a></div>
				</div>
			</div>
		</div>
		<div id="bxCatNav" class="bxCatNav">
			<ul>
				<li class="middle current" onclick="goto_pic(1)">loosfly's golden choice</li>
			</ul>
		</div>
	</div>
</div>
<div class="dsLists">
	<div style="height:50px;border:#cfcfcf 0 solid; border-bottom-width:1px;margin:0 30px 0 30px;"></div>
	<div class="blkLeftMenu">
		<div  style="margin:0 0 0 30px">
			<div class="cat_title"><span class="emphasis">MD's Choice</span></div>
			<div style="height:15px;"></div>
			<div class="cat_notation">Ό³Έν»πΐΤ</div>
		</div>
	</div>
	<div class="blkGoodsList">
		<div class="bxGoodsList">
			<table border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td>
					<?php echo $this->assign('loop',$TPL_VAR["loop"])?>

					<?php echo $this->assign('slevel',$TPL_VAR["slevel"])?>

					<?php echo $this->assign('clevel',$TPL_VAR["clevel"])?>

					<?php echo $this->assign('clevel_auth',$TPL_VAR["clevel_auth"])?>

					<?php echo $this->assign('auth_step',$TPL_VAR["auth_step"])?>

					<?php echo $this->assign('dpCfg',$GLOBALS["dpCfg"]["tpl"])?>

					<?php echo $this->assign('cols',$TPL_VAR["lstcfg"]["cols"])?>

					<?php echo $this->assign('size',$TPL_VAR["lstcfg"]["size"])?>

					<?php echo $this->define('tpl_include_file_1',"goods/list/tpl_01.htm")?> <?php $this->print_("tpl_include_file_1",$TPL_SCP,1);?>

				</td>
			</tr>
			<tr><td height="1" bgcolor="#DDDDDD"></td></tr>
			<tr><td align="center" height="50"><?php echo $TPL_VAR["pg"]->page['navi']?></td></tr>
			</table>
		</div>
	</div>
</div>

<script>
function act(target,goodsno,opt1,opt2)
{
	var form = document.frmCharge;

	form.mode.value = "addItem";
	form.goodsno.value = goodsno;

	if(opt2) opt1 += opt2;
	document.getElementById("opt").value=opt1;

	form.action = target + ".php";
	form.submit();
}
function sort(sort)
{
	var fm = document.frmList;
	fm.sort.value = sort;
	fm.submit();
}
function sort_chk(sort)
{
	if (!sort) return;
	sort = sort.replace(" ","_");
	var obj = document.getElementsByName('sort_'+sort);
	if (obj.length){
		div = obj[0].src.split('list_');
		for (i=0;i<obj.length;i++){
			chg = (div[1]=="up_off.gif") ? "up_on.gif" : "down_on.gif";
			obj[i].src = div[0] + "list_" + chg;
		}
	}
}
<?php if($_GET['sort']){?>
sort_chk('<?php echo $_GET['sort']?>');
<?php }?>
</script>

</div><!-- End indiv -->

<?php $this->print_("footer",$TPL_SCP,1);?>