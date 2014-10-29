<?php /* Template_ 2.2.7 2013/07/09 18:46:04 /www/loosfly_godo_co_kr/shop/data/skin/loosfly/goods/goods_grp_06.htm 000004000 */  $this->include_("dataDisplayGoods");?>
<?php $this->print_("header",$TPL_SCP,1);?>

<link rel="stylesheet" href="/shop/data/skin/loosfly/goods/goods_category.css" />
<script type="text/javascript" language="javascript" src="/shop/data/skin/loosfly/goods/goods_category.js"></script>
<?php if($this->tpl_['side_inc']){?>
		<div class="blkLeftMenu">
<?php $this->print_("side_inc",$TPL_SCP,1);?>

		</div>
<?php }?>
	<div id="blkContents">
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
					<div id="cat_div1" class="cat_div" style="left:0px; "><a href="/shop/goods/goods_view.php?goodsno=15&category="><img src="/shop/data/skin/loosfly/img/jimmy/shop_photo/MD_choice/shop_choice_01.jpg"></a></div>
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
			<div class="cat_notation">루스플라이가 자신있게 추천해 드리는 제품들입니다.</div>
		</div>
	</div>
	<div class="blkGoodsList">
		<div class="bxGoodsList">
			<table border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td>
<?php if($GLOBALS["cfg_step"][ 1371453101]["chk"]){?>
					<?php echo $this->assign('loop',dataDisplayGoods( 1371453101,$GLOBALS["cfg_step"][ 1371453101]["img"],$GLOBALS["cfg_step"][ 1371453101]["page_num"]))?>

					<?php echo $this->assign('dpCfg',$GLOBALS["cfg_step"][ 1371453101])?>

					<?php echo $this->assign('id','main_list_1371453101')?>

					<?php echo $this->assign('cols',$GLOBALS["cfg_step"][ 1371453101]["cols"])?>

					<?php echo $this->assign('size',$GLOBALS["cfg"][$GLOBALS["cfg_step"][ 1371453101]["img"]])?>

					<?php echo $this->define('tpl_include_file_1','goods/list/'.$GLOBALS["cfg_step"][ 1371453101]["tpl"].'.htm')?> <?php $this->print_("tpl_include_file_1",$TPL_SCP,1);?>

<?php }?>
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