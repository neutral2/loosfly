<?php /* Template_ 2.2.7 2014/10/23 19:58:34 /www/loosfly_godo_co_kr/shop/data/skin/loosfly/goods/goods_list.htm 000020311 */ ?>
<?php $this->print_("header",$TPL_SCP,1);?>


<link rel="stylesheet" href="/shop/data/skin/loosfly/goods/goods_category.css" />
<style>
.bxCatNav ul li { position:relative;display:block;float:left;text-align:center;font:normal 14px/25px "Ek Mukta";cursor:pointer; }
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
<?PHP 
$lfy_goods_knames = array(
		"001"=>"Tops",
		"002"=>"Bottoms",
		"003"=>"Leotards",
		"004"=>"Unitards",
		"005"=>"for Women",
		"006"=>"for Men",
		"007"=>"Romantic Lace & Mesh",
		"008"=>"Fullness Pants",
		"009"=>"Tight Pants",
		"010"=>"Accessories",
		"011"=>"2014 F/W Collection",
		"012"=>"Collaboration",
		"013"=>"in the MEDIA",
		"014"=>"Featured Products",
		"015"=>"Limited Sale"
	);
	
	$lfy_goods_desc = array(
"001"=>"�罺�ö����� ���Ǵ� ��Ʈ���� �پ�鼭�� ��ü���� �������� ��ü���ۿ� ������� �����ݴϴ�.", 
"002"=>"�罺�ö����� ������ �ٵ� ��Ʈ�Ǵ� ����Ÿ��Ʈ ���ΰ� ����ϰ� ���� �� �ִ� Ǯ�Ͻ� �������� �����˴ϴ�.", 
"003"=>"�罺�ö����� ����Ÿ��� �����Ⱓ �����ǻ��� �����ϸ鼭 ������ ��ü�� ���� ���� ���ؿ��� ����߽��ϴ�. ��ü���� �������� � ���ۿ����� ����� ���밨�� �ڶ��ϸ�, �ְ�� ������ ����Ͽ� ���� ��ɼ��� �����մϴ�. �Ƹ��ٿ� ���̽��� Ʈ������ �Ƿ翧���� ���õǸ鼭�� ����� �ڱ��� �����ݴϴ�.", 
"004"=>"�罺�ö����� ����Ÿ�� ��ǰ��.", 
"005"=>"������ ���� �罺�ö��� ��ǰ��", 
"006"=>"������ ���� �罺�ö��� ��ǰ��", 
"007"=>"�罺�ö��̴� ���̽��� ���縦 ������ ����Ͽ� ����� ���� ���ص帳�ϴ�.", 
"008"=>"�罺�ö����� ����� ������", 
"009"=>"Ÿ��Ʈ�� ���� ���ϽŴٸ�...", 
"010"=>"�罺�ö��̴� Ȱ������ ����� ���� �پ��� �׼��������� �����մϴ�.",
"011"=>"�罺�ö��̰� 2014�� F/W���� ���Ӱ� �����̴� �÷����Դϴ�. ���̽��� �÷������� �������� ����� ������ �����̸�, ��ɼ��� ���� ��ȭ�Ǿ����ϴ�.",
"013"=>"����̳� ������ �Ž��̵� ���� �Ǵ� ����� �罺�ö����� ��ǰ���� �Ұ��� �帳�ϴ�.", 
"014"=>"<b>����Ÿ��Ʈ �����Ʈ</b><br>�ʹ� Ÿ��Ʈ���� �ʰ� ���� �����ִ� ���밨. ���ο� ������ ������� ��ɼ��� ���� ���Ǿ����ϴ�.", 
"015"=>"�α⸮�� �ǸŵǴ� �罺�ö����� 4���� ��ǰ�� ���� �������� ���Ͽ� �űԻ����� ����Ǿ����ϴ�. �ش� ��ǰ�� �¶��ν����� �罺�ö��� ���������忡�� ���� �����ϸ�, �������� ���Ͽ� �����Ǹŵ˴ϴ�.", 
"012"=>"�罺�ö��̴� �پ��� �о� ����������� ������ ���Ͽ� �����ϰ� �������� �õ��� �����ν�, �Һ����� �پ��� �䱸�� �����ϵ��� ����ϰ� �ֽ��ϴ�.", 
"012001"=>"WHY JAY�� �����̳� �������� �� �Ӹ����� Y,J���� ���, �뷮����� �н�Ʈ �м��� �翬�� �ǰ� ����� �������θ�Ƽ���� �������� ���������ϴ� ���� �мǿ� \"WHY?\"��� ������ ������ ö���� ���� �귣������Դϴ�. SPA�� ���ųκ귣�忡�� �� �� ���� �ո��� ����, �����̳ʿ� �Һ��ڿ��� �Ÿ��� ���� ������ �ϵ��� �մϴ�. �������� �м����õ��� ������ ������Ű�� ������μ��� ���� '��������'�� ���Դϴ�. ������ �����̳ʸ� �������� 3�뿡 ��ģ �м��йи��� ���� �ظ�Ƽ���� �������� �� ���� ���ο� ������ ����, �����Ͽ� �����Դϴ�."); 

if(  $GLOBALS["category"] == "012001" ) {
?>
		<div class="listTitle">WHY JAY</div>
		<div style="height:5px"></div>
<?PHP	} else { 	?>
		<div class="listTitle"><?=$lfy_goods_knames[ $GLOBALS["category"]]?></div>
		<div style="height:5px"></div>
<?PHP 
}
if(  $GLOBALS["category"] == "001" ) { /***	TOPS 	***/
?>
<style>
.bxCatNav ul li { width:429px; }
.bxCatNav ul li.middle { width:430px; }
</style>
	<div id="bxCatImg" class="bxCatImg">
		<div id="catimg_outline" class="catimg_outline">
			<span class="btn_catL"></span>
			<span class="btn_catR"></span>
			<div id="catimg_box" class="catimg_box">
				<div id="cat_div1" class="cat_div" style="left:0px; "><a href="/shop/goods/goods_view.php?goodsno=13&category=001"><img src="/shop/data/skin/loosfly/img/jimmy/shop_photo/tops/shop_tops_01.jpg"></a></div>
				<div id="cat_div2" class="cat_div" style="left:860px; "><a href="/shop/goods/goods_view.php?goodsno=14&category=001"><img src="/shop/data/skin/loosfly/img/jimmy/shop_photo/tops/shop_tops_02.jpg"></a></div>
			</div>
		</div>
	</div>
	<div id="bxCatNav" class="bxCatNav">
		<ul>
			<li class="middle current" onclick="goto_pic(1)">Slitneck Top</li>
			<li onclick="goto_pic(2)">Zipup Lace Top</li>
		</ul>
	</div>
<?PHP } else if(  $GLOBALS["category"] == "002" ) { /***	BOTTOMS  	***/?>
<style>
.bxCatNav ul li { width:860px; }
</style>
	<div id="bxCatImg" class="bxCatImg">
		<div id="catimg_outline" class="catimg_outline">
			<span class="btn_catL"></span>
			<span class="btn_catR"></span>
			<div id="catimg_box" class="catimg_box">
				<div id="cat_div1" class="cat_div" style="left:0px; "><a href="/shop/goods/goods_view.php?goodsno=15&category=002"><img src="/shop/data/skin/loosfly/img/jimmy/shop_photo/bottoms/shop_bottoms_01.jpg"></a></div>
			</div>
		</div>
	</div>
	<div id="bxCatNav" class="bxCatNav">
		<ul>
			<li class="middle current" onclick="goto_pic(1)">Shorts</li>
		</ul>
	</div>
<?PHP } else if(  $GLOBALS["category"] == "003" ) { /***	LEOTARDS 	***/?>
<style>
.bxCatNav ul li { width:286px; }
</style>
	<div id="bxCatImg" class="bxCatImg">
		<div id="catimg_outline" class="catimg_outline">
			<span class="btn_catL"></span>
			<span class="btn_catR"></span>
			<div id="catimg_box" class="catimg_box">
				<div id="cat_div1" class="cat_div" style="left:0px; "><img src="/shop/data/skin/loosfly/img/jimmy/shop_photo/leotards/shop_leotards_01.jpg"></div>
				<div id="cat_div2" class="cat_div" style="left:860px; "><img src="/shop/data/skin/loosfly/img/jimmy/shop_photo/leotards/shop_leotards_02.jpg"></div>
				<div id="cat_div3" class="cat_div" style="left:1720px; "><img src="/shop/data/skin/loosfly/img/jimmy/shop_photo/leotards/shop_leotards_03.jpg"></div>
			</div>
		</div>
	</div>
	<div id="bxCatNav" class="bxCatNav">
		<ul>
			<li class="middle current" onclick="goto_pic(1)">Basic Lace Leotard</li>
			<li class="middle" onclick="goto_pic(2)">Highneck Zipup Leotard</li>
			<li onclick="goto_pic(3)">Black Marble Leotard</li>
		</ul>
	</div>
<?PHP } else if(  $GLOBALS["category"] == "004" ) { /***	UNITARDS  	***/?>
<style>
.bxCatNav ul li { position:relative;display:block;float:left;width:860px;text-align:center;font:normal 14px/25px "Ek Mukta";cursor:pointer; }
</style>
	<div id="bxCatImg" class="bxCatImg">
		<div id="catimg_outline" class="catimg_outline">
			<span class="btn_catL"></span>
			<span class="btn_catR"></span>
			<div id="catimg_box" class="catimg_box">
				<div id="cat_div1" class="cat_div" style="left:0px; "><a href="#"><img src="/shop/data/skin/loosfly/img/jimmy/shop_photo/unitards/unitard_shop_01.jpg"></a></div>
			</div>
		</div>
	</div>
	<div id="bxCatNav" class="bxCatNav">
		<ul>
			<li class="middle current" onclick="goto_pic(1)">Unitards</li>
		</ul>
	</div>
<?PHP } else if(  $GLOBALS["category"] == "005" ) { /***	WOMEN 	***/?>
<style>
.bxCatNav ul li { width:860px; }
</style>
	<div id="bxCatImg" class="bxCatImg">
		<div id="catimg_outline" class="catimg_outline">
			<span class="btn_catL"></span>
			<span class="btn_catR"></span>
			<div id="catimg_box" class="catimg_box">
				<div id="cat_div1" class="cat_div" style="left:0px; "><a href="/shop/goods/goods_list.php?category=005"><img src="/shop/data/skin/loosfly/img/jimmy/shop_photo/women/women_shop_01.jpg"></a></div>
			</div>
		</div>
	</div>
	<div id="bxCatNav" class="bxCatNav">
		<ul>
			<li class="middle current" onclick="goto_pic(1)">Women in loosfly</li>
		</ul>
	</div>
<?PHP } else if(  $GLOBALS["category"] == "006" ) { /***	MEN  	***/?>
<style>
.bxCatNav ul li { width:860px; }
</style>
	<div id="bxCatImg" class="bxCatImg">
		<div id="catimg_outline" class="catimg_outline">
			<span class="btn_catL"></span>
			<span class="btn_catR"></span>
			<div id="catimg_box" class="catimg_box">
				<div id="cat_div1" class="cat_div" style="left:0px; "><a href="/shop/goods/goods_list.php?category=006"><img src="/shop/data/skin/loosfly/img/jimmy/shop_photo/men/shop_men_01.jpg"></a></div>
			</div>
		</div>
	</div>
	<div id="bxCatNav" class="bxCatNav">
		<ul>
			<li class="middle current" onclick="goto_pic(1)">Men in loosfly</li>
		</ul>
	</div>
<?PHP } else if(  $GLOBALS["category"] == "007" ) { /***	LACE/MESH 	***/?>
<style>
.bxCatNav ul li { width:860px; }
</style>
	<div id="bxCatImg" class="bxCatImg">
		<div id="catimg_outline" class="catimg_outline">
			<span class="btn_catL"></span>
			<span class="btn_catR"></span>
			<div id="catimg_box" class="catimg_box">
				<div id="cat_div1" class="cat_div" style="left:0px; "><a href="/shop/goods/goods_list.php?category=007"><img src="/shop/data/skin/loosfly/img/jimmy/shop_photo/lace_mesh/shop_lacenmesh_01.jpg"></a></div>
			</div>
		</div>
	</div>
	<div id="bxCatNav" class="bxCatNav">
		<ul>
			<li class="middle current" onclick="goto_pic(1)">elegant lace, classy mesh</li>
		</ul>
	</div>
<?PHP } else if(  $GLOBALS["category"] == "008" ) { /***	FULLNESS 	***/?>
<style>
.bxCatNav ul li { width:860px; }
</style>
	<div id="bxCatImg" class="bxCatImg">
		<div id="catimg_outline" class="catimg_outline">
			<span class="btn_catL"></span>
			<span class="btn_catR"></span>
			<div id="catimg_box" class="catimg_box">
				<div id="cat_div1" class="cat_div" style="left:0px; "><a href="/shop/goods/goods_view.php?goodsno=28&category=008"><img src="/shop/data/skin/loosfly/img/jimmy/shop_photo/fullness/shop_fullness_01.jpg"></a></div>
			</div>
		</div>
	</div>
	<div id="bxCatNav" class="bxCatNav">
		<ul>
			<li class="middle current" onclick="goto_pic(1)">Fullness pants - releave your stress</li>
		</ul>
	</div>
<?PHP } else if(  $GLOBALS["category"] == "009" ) { /***	TIGHTS 	***/?>
<style>
.bxCatNav ul li { width:429px; }
</style>
	<div id="bxCatImg" class="bxCatImg">
		<div id="catimg_outline" class="catimg_outline">
			<span class="btn_catL"></span>
			<span class="btn_catR"></span>
			<div id="catimg_box" class="catimg_box">
				<div id="cat_div1" class="cat_div" style="left:0px; "><a href="/shop/goods/goods_list.php?category=009"><img src="/shop/data/skin/loosfly/img/jimmy/shop_photo/tights/shop_tights_01.jpg"></a></div>
				<div id="cat_div2" class="cat_div" style="left:860px; "><a href="/shop/goods/goods_list.php?category=009"><img src="/shop/data/skin/loosfly/img/jimmy/shop_photo/tights/shop_tights_02.jpg"></a></div>
			</div>
		</div>
	</div>
	<div id="bxCatNav" class="bxCatNav">
		<ul>
			<li class="middle current" onclick="goto_pic(1)">Tight pants hold you tight.</li>
			<li onclick="goto_pic(2)">Tights.</li>
		</ul>
	</div>
<?PHP } else if(  $GLOBALS["category"] == "010" ) { /***	accessories 	***/?>
<style>
.bxCatNav ul li { width:429px; }
</style>
	<div id="bxCatImg" class="bxCatImg">
		<div id="catimg_outline" class="catimg_outline">
			<span class="btn_catL"></span>
			<span class="btn_catR"></span>
			<div id="catimg_box" class="catimg_box">
				<div id="cat_div1" class="cat_div" style="left:0px; "><a href="/shop/goods/goods_view.php?goodsno=113&category=010"><img src="/shop/data/skin/loosfly/img/jimmy/shop_photo/accessories/estrobag_shop_01.jpg"></a></div>
				<div id="cat_div2" class="cat_div" style="left:0px; "><a href="/shop/goods/goods_view.php?goodsno=23&category=010"><img src="/shop/data/skin/loosfly/img/jimmy/shop_photo/accessories/shirring_shop_01.jpg"></a></div>
			</div>
		</div>
	</div>
	<div id="bxCatNav" class="bxCatNav">
		<ul>
			<li class="middle current" onclick="goto_pic(1)">Estro Bag</li>
			<li onclick="goto_pic(2)">Shirring Headband</li>
		</ul>
	</div>
<?PHP } else if(  $GLOBALS["category"] == "011" ) { /***	2014 collection 	***/?>
<style>
.bxCatNav ul li { width:429px; }
</style>
	<div id="bxCatImg" class="bxCatImg">
		<div id="catimg_outline" class="catimg_outline">
			<span class="btn_catL"></span>
			<span class="btn_catR"></span>
			<div id="catimg_box" class="catimg_box">
				<div id="cat_div1" class="cat_div" style="left:0px;"><a href="/shop/goods/goods_view.php?goodsno=122&category=011"><img src="/shop/data/skin/loosfly/img/jimmy/shop_photo/sc2014/openback_shop_01.jpg"></a></div>
				<div id="cat_div2" class="cat_div" style="left:0px;"><a href="/shop/goods/goods_view.php?goodsno=85&category=011"><img src="/shop/data/skin/loosfly/img/jimmy/shop_photo/sc2014/astral_shop_01.jpg"></a></div>
			</div>
		</div>
	</div>
	<div id="bxCatNav" class="bxCatNav">
		<ul>
			<li class="middle current" onclick="goto_pic(1)">Open-back Zipup Leotard</li>
			<li onclick="goto_pic(2)">Astral Leotard</li>
		</ul>
	</div>
<?PHP } else if(  $GLOBALS["category"] == "012" ) { /***	collaboration 	***/?>
<style>
.bxCatNav ul li { width:860px; }
</style>
	<div id="bxCatImg" class="bxCatImg">
		<div id="catimg_outline" class="catimg_outline">
			<span class="btn_catL"></span>
			<span class="btn_catR"></span>
			<div id="catimg_box" class="catimg_box">
				<div id="cat_div1" class="cat_div" style="left:0px; "><a href="/shop/goods/goods_list.php?category=012001"><img src="/shop/data/skin/loosfly/img/jimmy/shop_photo/collaboration/shop_whyjay_01.jpg"></a></div>
			</div>
		</div>
	</div>
	<div id="bxCatNav" class="bxCatNav">
		<ul>
			<li class="middle current" onclick="goto_pic(1)">WHY JAY</li>
		</ul>
	</div>
<?PHP } else if(  $GLOBALS["category"] == "012001" ) { /***	WHY JAY 	***/?>
<style>
.bxCatNav ul li { width:286px; }
</style>
	<div id="bxCatImg" class="bxCatImg">
		<div id="catimg_outline" class="catimg_outline">
			<span class="btn_catL"></span>
			<span class="btn_catR"></span>
			<div id="catimg_box" class="catimg_box">
				<div id="cat_div1" class="cat_div" style="left:0px; "><a href="#"><img src="/shop/data/skin/loosfly/img/jimmy/shop_photo/whyjay/whyjay_intro_00.jpg"></a></div>
				<div id="cat_div2" class="cat_div" style="left:860px; "><a href="#"><img src="/shop/data/skin/loosfly/img/jimmy/shop_photo/whyjay/whyjay_intro_01.jpg"></a></div>
				<div id="cat_div3" class="cat_div" style="left:1720px; "><a href="#"><img src="/shop/data/skin/loosfly/img/jimmy/shop_photo/whyjay/whyjay_intro_02.jpg"></a></div>
			</div>
		</div>
	</div>
	<div id="bxCatNav" class="bxCatNav">
		<ul>
			<li class="middle current" onclick="goto_pic(1)">JAY + loosfly collaboration</li>
			<li class="middle" onclick="goto_pic(2)">VACK YUUNZUNG</li>
			<li onclick="goto_pic(3)">KYONGSOOL BAE</li>
		</ul>
	</div>
<?PHP } else if(  $GLOBALS["category"] == "013" ) { /***	Media 	***/?>
<style>
.bxCatNav ul li { width:860px; }
</style>
	<div id="bxCatImg" class="bxCatImg">
		<div id="catimg_outline" class="catimg_outline">
			<span class="btn_catL"></span>
			<span class="btn_catR"></span>
			<div id="catimg_box" class="catimg_box">
				<div id="cat_div1" class="cat_div" style="left:0px; "><a href="#"><img src="/shop/data/skin/loosfly/img/jimmy/shop_photo/media/media_photo_01.jpg"></a></div>
			</div>
		</div>
	</div>
	<div id="bxCatNav" class="bxCatNav">
		<ul>
			<li class="middle current" onclick="goto_pic(1)">loosfly on media</li>
		</ul>
	</div>
<?PHP } else if(  $GLOBALS["category"] == "014" ) { /***	featured products 	***/?>
<style>
.bxCatNav ul li { width:860px; }
</style>
	<div id="bxCatImg" class="bxCatImg">
		<div id="catimg_outline" class="catimg_outline">
			<span class="btn_catL"></span>
			<span class="btn_catR"></span>
			<div id="catimg_box" class="catimg_box">
				<div id="cat_div1" class="cat_div" style="left:0px; "><a href="/shop/goods/goods_list.php?category=014"><img src="/shop/data/skin/loosfly/img/jimmy/shop_photo/featured/contrast_shop_01.jpg"></a></div>
			</div>
		</div>
	</div>
	<div id="bxCatNav" class="bxCatNav">
		<ul>
			<li class="middle current" onclick="goto_pic(1)">NEW Semi-tight Contrast Pants</li>
		</ul>
	</div>
<?PHP } else if(  $GLOBALS["category"] == "015" ) { /***	limited sale 	***/?>
<style>
.bxCatNav ul li { width:860px; }
</style>
	<div id="bxCatImg" class="bxCatImg">
		<div id="catimg_outline" class="catimg_outline">
			<span class="btn_catL"></span>
			<span class="btn_catR"></span>
			<div id="catimg_box" class="catimg_box">
				<div id="cat_div1" class="cat_div" style="left:0px; "><a href="/shop/goods/goods_list.php?category=015"><img src="/shop/data/skin/loosfly/img/jimmy/shop_photo/limited/limited_01.jpg"></a></div>
			</div>
		</div>
	</div>
	<div id="bxCatNav" class="bxCatNav">
		<ul>
			<li class="middle current" onclick="goto_pic(1)">limited sale</li>
		</ul>
	</div>
<?PHP } else { /***	NOT ASSIGNED 	***/?>
<style>
.bxCatNav ul li { width:860px; }
</style>
	<div id="bxCatImg" class="bxCatImg">
		<div id="catimg_outline" class="catimg_outline">
			<span class="btn_catL"></span>
			<span class="btn_catR"></span>
			<div id="catimg_box" class="catimg_box">
				<div id="cat_div1" class="cat_div" style="left:0px; "><a href="/shop/goods/goods_list.php?category=014"><img src="/shop/data/skin/loosfly/img/jimmy/shop_photo/featured/carmen_lace_01f.jpg"></a></div>
			</div>
		</div>
	</div>
	<div id="bxCatNav" class="bxCatNav">
		<ul>
			<li class="middle current" onclick="goto_pic(1)">Carmen Lace Leotard</li>
		</ul>
	</div>
<?PHP } ?>
	</div>
</div>
<div class="dsLists">
	<div style="height:50px;border:#cfcfcf 0 solid; border-bottom-width:1px;margin:0 30px 0 30px;"></div>
	<div class="blkLeftMenu">
		<div  style="margin:0 0 0 30px">
			<div class="cat_title"><span class="emphasis"><?PHP echo $lfy_goods_knames[ $GLOBALS["category"]]; ?></span></div>
			<div style="height:15px;"></div>
			<div class="cat_notation"><?PHP echo $lfy_goods_desc[ $GLOBALS["category"]]; ?></div>
		</div>
	</div>
	<div class="blkGoodsList">
		<div class="bxGoodsList">
			<table border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td>
					<?php echo $this->assign('loop',$TPL_VAR["loopM"])?>

					<?php echo $this->assign('slevel',$TPL_VAR["slevel"])?>

					<?php echo $this->assign('clevel',$TPL_VAR["clevel"])?>

					<?php echo $this->assign('clevel_auth',$TPL_VAR["clevel_auth"])?>

					<?php echo $this->assign('auth_step',$TPL_VAR["auth_step"])?>

					<?php echo $this->assign('dpCfg',$GLOBALS["dpCfg"]["tpl"])?>

					<?php echo $this->assign('cols',$TPL_VAR["lstcfg"]["cols"])?>

					<?php echo $this->assign('size',$TPL_VAR["lstcfg"]["size"])?>

					<?php echo $this->define('tpl_include_file_1',"goods/list/".$TPL_VAR["lstcfg"]["tpl"].".htm")?> <?php $this->print_("tpl_include_file_1",$TPL_SCP,1);?>

				</td>
			</tr>
			<tr><td height="10"></td></tr>
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
if(typeof(document.sSearch) != "undefined") fm = document.sSearch;
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

<?php $this->print_("footer",$TPL_SCP,1);?>