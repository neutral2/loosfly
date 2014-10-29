<?php /* Template_ 2.2.7 2014/10/23 19:55:33 /www/loosfly_godo_co_kr/shop/data/skin/loosfly/main/index.htm 000009207 */  $this->include_("dataDisplayGoods");?>
<?php $this->print_("header",$TPL_SCP,1);?>


<link rel="stylesheet" href="/shop/data/skin/loosfly/goods/goods_category.css" />
<style>
.bxCatNav ul li { position:relative;display:block;float:left;width:172px;text-align:center;font:normal 14px/25px "Ek Mukta";cursor:pointer; }
.bxCatNav ul li.middle { border:#000000 0 dotted;border-right-width:1px;width:171px; }
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
		<div class="listTitle">SHOP</div>
		<div style="height:5px;"></div>
		<div id="bxCatImg" class="bxCatImg">
			<div id="catimg_outline" class="catimg_outline">
				<span class="btn_catL"></span>
				<span class="btn_catR"></span>
				<div id="catimg_box" class="catimg_box">
					<div id="cat_div1" class="cat_div" style="left:0px; "><a href="/shop/goods/goods_search.php?searched=Y&log=1&skey=all&hid_pr_text=&hid_link_url=&edit=&sword=teruel&x=-1201&y=-32"><img src="/shop/data/skin/loosfly/img/jimmy/shop_photo/shop_teruel_01.jpg"></a></div>
					<div id="cat_div2" class="cat_div" style="left:860px; "><a href="/shop/goods/goods_search.php?searched=Y&log=1&skey=all&hid_pr_text=&hid_link_url=&edit=&sword=highneck+zipup+top&x=-1122&y=-32"><img src="/shop/data/skin/loosfly/img/jimmy/shop_photo/highneck_zipup_01.jpg"></a></div>
					<div id="cat_div3" class="cat_div" style="left:1720px; "><a href="/shop/goods/goods_search.php?disp_type=&hid_sword=&searched=Y&log=1&sort=a.sort&page_num=20&skey=all&sword=color+mesh&x=21&y=12"><img src="/shop/data/skin/loosfly/img/jimmy/shop_photo/color_mesh_leotard_01.jpg"></a></div>
					<div id="cat_div4" class="cat_div" style="left:2580px; "><a href="http://www.loosfly.com/shop/service/company.php?tt=1"><img src="/shop/data/skin/loosfly/img/jimmy/shop_photo/shop_showroom_01.jpg"></a></div>
					<div id="cat_div5" class="cat_div" style="left:3440px; "><a href="/shop/goods/goods_search.php?searched=Y&log=1&skey=all&hid_pr_text=&hid_link_url=&edit=&sword=capri&x=-1122&y=-32"><img src="/shop/data/skin/loosfly/img/jimmy/shop_photo/basic_capri_01.jpg"></a></div>
				</div>
			</div>
		</div>
		<div id="bxCatNav" class="bxCatNav">
			<ul>
				<li class="middle current" onclick="goto_pic(1)">Teruel Leotard</li>
				<li class="middle" onclick="goto_pic(2)">Highneck Zipup Tops</li>
				<li class="middle" onclick="goto_pic(3)">Color Mesh Leotards</li>
				<li class="middle" onclick="goto_pic(4)">loosfly showroom</li>
				<li onclick="goto_pic(5)">Capri Pants</li>
			</ul>
		</div>
	</div>
</div>
	
<?PHP 
	$lfy_goods_knames = array("leotards", "tops", "bottoms", "unitards", "MD's Choice"); 
	$lfy_goods_desc = array(
		"루스플라이의 레오타드는 오랜기간 무용의상을 제작하면서 축적된 인체에 대한 깊은 이해에서 출발했습니다. 입체적인 패턴으로 어떤 동작에서도 편안한 착용감을 자랑하며, 최고급 원단을 사용하여 높은 기능성을 제공합니다. 아름다운 레이스와 트렌디한 실루엣으로 세련되면서도 우아한 멋까지 더해줍니다.", 
		"루스플라이의 상의는 피트감이 뛰어나면서도 입체적인 패턴으로 상체동작에 편안함을 더해줍니다. ", 
		"루스플라이의 바지는 바디에 피트되는 세미타이트 라인과 편안하게 입을 수 있는 풀니스 라인으로 구성됩니다.", 
		"루스플라이의 유니타드는 준비중입니다.", 
		"루스플라이에서 자신있게 추천해드리는 제품입니다." 
	); 
?>

<div class="dsLists">
	<div style="height:50px;border:#cfcfcf 0 solid; border-bottom-width:1px;margin:0 30px 0 30px;"></div>
	<div class="blkLeftMenu">
		<div  style="margin:5px 0 0 30px">
			<div class="cat_title"><span class="emphasis" style="cursor:pointer" onclick="location.href='/shop/goods/goods_list.php?category=003'"><?PHP echo $lfy_goods_knames[0]; ?></span></div>
			<div style="height:10px;"></div>
			<div class="cat_notation"><?PHP echo $lfy_goods_desc[0]; ?></div>
		</div>
	</div>
	<div class="blkGoodsList">
		<div class="bxGoodsList" style="margin-top:5px">
			<!-- 상품 리스트 #1 -->
<?php if($GLOBALS["cfg_step"][ 0]["chk"]){?>
			<?php echo $this->assign('loop',dataDisplayGoods( 0,$GLOBALS["cfg_step"][ 2]["img"],$GLOBALS["cfg_step"][ 0]["page_num"]))?>

			<?php echo $this->assign('cols',$GLOBALS["cfg_step"][ 0]["cols"])?>

			<?php echo $this->assign('size',$GLOBALS["cfg"][$GLOBALS["cfg_step"][ 0]["img"]])?>

			<?php echo $this->assign('id',"main_list_01")?>

			<?php echo $this->assign('dpCfg',$GLOBALS["cfg_step"][ 0])?>

			<?php echo $this->define('tpl_include_file_1',"goods/list/".$GLOBALS["cfg_step"][ 0]["tpl"].".htm")?> <?php $this->print_("tpl_include_file_1",$TPL_SCP,1);?>

<?php }?>
		</div>
	</div>
</div>
<div class="dsLists">
	<div style="height:15px;border:#cfcfcf 0 solid; border-bottom-width:1px;margin:0 30px 0 30px;"></div>
	<div class="blkLeftMenu">
		<div  style="margin:5px 0 0 30px">
			<div class="cat_title"><span class="emphasis" style="cursor:pointer" onclick="location.href='/shop/goods/goods_list.php?category=001'"><?PHP echo $lfy_goods_knames[1]; ?></span></div>
			<div style="height:10px;"></div>
			<div class="cat_notation"><?PHP echo $lfy_goods_desc[1]; ?></div>
		</div>
	</div>
	<div class="blkGoodsList">
		<div class="bxGoodsList" style="margin-top:5px">
			<!-- 상품 리스트 #2 -->
<?php if($GLOBALS["cfg_step"][ 1]["chk"]){?>
			<?php echo $this->assign('loop',dataDisplayGoods( 1,$GLOBALS["cfg_step"][ 1]["img"],$GLOBALS["cfg_step"][ 1]["page_num"]))?>

			<?php echo $this->assign('cols',$GLOBALS["cfg_step"][ 1]["cols"])?>

			<?php echo $this->assign('size',$GLOBALS["cfg"][$GLOBALS["cfg_step"][ 1]["img"]])?>

			<?php echo $this->assign('id',"main_list_02")?>

			<?php echo $this->assign('dpCfg',$GLOBALS["cfg_step"][ 1])?>

			<?php echo $this->define('tpl_include_file_1',"goods/list/".$GLOBALS["cfg_step"][ 0]["tpl"].".htm")?> <?php $this->print_("tpl_include_file_1",$TPL_SCP,1);?>

<?php }?>
		</div>
	</div>
</div>
<div class="dsLists">
	<div style="height:15px;border:#cfcfcf 0 solid; border-bottom-width:1px;margin:0 30px 0 30px;"></div>
	<div class="blkLeftMenu">
		<div  style="margin:5px 0 0 30px">
			<div class="cat_title"><span class="emphasis" style="cursor:pointer" onclick="location.href='/shop/goods/goods_list.php?category=002'"><?PHP echo $lfy_goods_knames[2]; ?></span></div>
			<div style="height:10px;"></div>
			<div class="cat_notation"><?PHP echo $lfy_goods_desc[2]; ?></div>
		</div>
	</div>
	<div class="blkGoodsList">
		<div class="bxGoodsList" style="margin-top:5px">
			<!-- 상품 리스트 #3 -->
<?php if($GLOBALS["cfg_step"][ 2]["chk"]){?>
			<?php echo $this->assign('loop',dataDisplayGoods( 2,$GLOBALS["cfg_step"][ 2]["img"],$GLOBALS["cfg_step"][ 2]["page_num"]))?>

			<?php echo $this->assign('cols',$GLOBALS["cfg_step"][ 2]["cols"])?>

			<?php echo $this->assign('size',$GLOBALS["cfg"][$GLOBALS["cfg_step"][ 2]["img"]])?>

			<?php echo $this->assign('id',"main_list_03")?>

			<?php echo $this->assign('dpCfg',$GLOBALS["cfg_step"][ 2])?>

			<?php echo $this->define('tpl_include_file_1',"goods/list/".$GLOBALS["cfg_step"][ 0]["tpl"].".htm")?> <?php $this->print_("tpl_include_file_1",$TPL_SCP,1);?>

<?php }?>
		</div>
	</div>
</div>

<?PHP if ( false ) { ?>
<div class="dsLists">
	<div style="height:15px;border:#cfcfcf 0 solid; border-bottom-width:1px;margin:0 30px 0 30px;"></div>
	<div class="blkLeftMenu">
		<div  style="margin:5px 0 0 30px">
			<div class="cat_title"><span class="emphasis" style="cursor:pointer" onclick="location.href='/shop/goods/goods_grp_06.php'"><?PHP echo $lfy_goods_knames[4]; ?></span></div>
			<div style="height:10px;"></div>
			<div class="cat_notation"><?PHP echo $lfy_goods_desc[4]; ?></div>
		</div>
	</div>
	<div class="blkGoodsList">
		<div class="bxGoodsList" style="margin:5px 0 10px 0">
			<!-- 상품 리스트 #5 -->
<?php if($GLOBALS["cfg_step"][ 1371453101]["chk"]){?>
			<?php echo $this->assign('loop',dataDisplayGoods( 1371453101,$GLOBALS["cfg_step"][ 1371453101]["img"],$GLOBALS["cfg_step"][ 1371453101]["page_num"]))?>

			<?php echo $this->assign('dpCfg',$GLOBALS["cfg_step"][ 1371453101])?>

			<?php echo $this->assign('id','main_list_1371453101')?>

			<?php echo $this->assign('cols',$GLOBALS["cfg_step"][ 1371453101]["cols"])?>

			<?php echo $this->assign('size',$GLOBALS["cfg"][$GLOBALS["cfg_step"][ 1371453101]["img"]])?>

			<?php echo $this->define('tpl_include_file_4','goods/list/'.$GLOBALS["cfg_step"][ 0]["tpl"].'.htm')?> <?php $this->print_("tpl_include_file_4",$TPL_SCP,1);?>

<?php }?>
		</div>
	</div>
</div>
<?PHP } ?>
<!-- Unitards Here -->
<div class="dsLists">
	<div style="height:30px"> </div>
</div>
<?php $this->print_("footer",$TPL_SCP,1);?>