<?php /* Template_ 2.2.7 2014/10/23 19:40:45 /www/loosfly_godo_co_kr/shop/data/skin/loosfly/goods/goods_grp_01.htm 000004249 */ ?>
<?php $this->print_("header",$TPL_SCP,1);?>


<link rel="stylesheet" href="/shop/data/skin/loosfly/goods/goods_category.css" />
<style>
.bxCatNav ul li { position:relative;display:block;float:left;width:860px;text-align:center;font:normal 14px/25px "Ek Mukta";cursor:pointer; }
.bxCatNav ul li.middle { border:#000000 0 dotted;border-right-width:1px; }
.listTitle { margin-left:10px;width:862px;height:35px;background:#f7f7f7;color:#7f7f7f;text-align:center;font:normal 18px/40px 'Ek Mukta', sans-serif;letter-spacing:5px; }
</style>
<script type="text/javascript" language="javascript" src="/shop/data/skin/loosfly/goods/goods_category.js"></script>
<?php if($this->tpl_['side_inc']){?>
		<div class="blkLeftMenu">
<?php $this->print_("side_inc",$TPL_SCP,1);?>

		</div>
<?php }?>
	<div id="blkContents">
		<div style="height:15px;"></div>
		<div class="listTitle">New Arrivals</div>
		<div style="height:5px;"></div>
		<div id="bxCatImg" class="bxCatImg">
			<div id="catimg_outline" class="catimg_outline">
				<span class="btn_catL"></span>
				<span class="btn_catR"></span>
				<div id="catimg_box" class="catimg_box">
					<div id="cat_div1" class="cat_div" style="left:0px; "><a href="/shop/goods/goods_view.php?goodsno=1&category="><img src="/shop/data/skin/loosfly/img/jimmy/shop_photo/new_arrivals/shop_arrivals_01.jpg"></a></div>
				</div>
			</div>
		</div>
		<div id="bxCatNav" class="bxCatNav">
			<ul>
				<li class="middle current" onclick="goto_pic(1)">Brand new leotard - THE LACEHOLICS</li>
			</ul>
		</div>
	</div>
</div>
<div class="dsLists">
	<div style="height:50px;border:#cfcfcf 0 solid; border-bottom-width:1px;margin:0 30px 0 30px;"></div>
	<div class="blkLeftMenu">
		<div  style="margin:0 0 0 30px">
			<div class="cat_title"><span class="emphasis">new arrivals</span></div>
			<div style="height:15px;"></div>
			<div class="cat_notation">루스플라이의 레오타드는 오랜기간 무용의상을 제작하면서 축적된 인체에 대한 깊은 이해에서 출발했습니다. 입체적인 패턴으로 어떤 동작에서도 편안한 착용감을 자랑하며, 최고급 원단을 사용하여 높은 기능성을 제공합니다. 아름다운 레이스와 트렌디한 실루엣으로 세련되면서도 우아한 멋까지 더해줍니다.</div>
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