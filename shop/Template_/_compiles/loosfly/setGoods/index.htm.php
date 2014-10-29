<?php /* Template_ 2.2.7 2013/04/16 10:58:59 /www/loosfly_godo_co_kr/shop/data/skin/loosfly/setGoods/index.htm 000002715 */ ?>
<!-- 절대! 지우지마세요 : Start -->
<?php $this->print_("h_include_item",$TPL_SCP,1);?>

<!-- 절대! 지우지마세요 : End -->
<?php $this->print_("header",$TPL_SCP,1);?>

<link rel="stylesheet" type="text/css" href="/shop/data/skin/loosfly/setGoods/css/front.css" />
<script type="text/javascript" src="/shop/setGoods/js/list_main.js"></script>
<script type="text/javascript">
var loadHeight = 100;
var listImgWidth = 285;
var listImgMargin = 10;
var pg = <?php echo $TPL_VAR["pg"]?>;
var sh = '<?php echo $TPL_VAR["sh"]?>'; 
var sp = '<?php echo $TPL_VAR["sp"]?>';
var cody = '<?php echo $TPL_VAR["cody"]?>';
var ll = '<?php echo $TPL_VAR["ll"]?>';

jQuery(function(){
	scrollsort();
	
	window.onresize = function(){ 
		
        Align.set(jQuery('#Wrapper')[0].offsetWidth);
    }
});
//스크롤을 제어한다.
jQuery(window).scroll(function(){
	var scrollHeight = jQuery(window).scrollTop() + jQuery(window).height();
    var documentHeight = jQuery(document).height();
	if(scrollHeight > documentHeight-loadHeight){
		pg++;
		this.LoadPage(pg, sh, sp, cody);
		
	}
});

jQuery(window).load(function(){	
	this.LoadPage(pg, sh, sp, cody);
});

</script>

<div id="wrap">
<!--container -->
	<div id="container">
		<div class="title"><img src="/shop/data/skin/loosfly/setGoods/img/front/title_cody.gif" /></div>
		<div class="orderBtn">
			<a href="./?ll=D&cody=<?php echo $TPL_VAR["cody"]?>"><img src="/shop/data/skin/loosfly/setGoods/img/front/btn_new_<?php if($TPL_VAR["ll"]=='D'){?>on<?php }else{?>off<?php }?>.gif" /></a>
			<a href="./?ll=L&cody=<?php echo $TPL_VAR["cody"]?>"><img src="/shop/data/skin/loosfly/setGoods/img/front/btn_popular_<?php if($TPL_VAR["ll"]=='L'){?>on<?php }else{?>off<?php }?>.gif"/></a>
			<br/>
<?php if($TPL_VAR["cody"]> 0){?>
			<div class="path" style="float:right;padding:20px 0 0 0;vertical-align:text-bottom;">HOME > <a href="../setGoods/">코디상품 리스트</a> > <a href="<?php echo $_SERVER['HTTP_REFERER']?>">코디상품 상세페이지</a> > <b>관련코디 보기</b></div>
<?php }else{?>
			<div class="path" style="float:right;padding:20px 0 0 0;vertical-align:text-bottom;">HOME > <b>코디상품 리스트</b></div>
<?php }?>
		</div>
		<div class="clear"></div>

		<div id="Wrapper">    
			<div id="Images">		
			</div>
		</div>

		<!--//clear -->
		<div class="clear"></div>
		<!--//clear -->
 
		<div class="btnGotop"><a href="#top"><img src="/shop/data/skin/loosfly/setGoods/img/front/btn_gotop.gif" /></a></div>
	</div>
<!--//container -->
</div>

<?php $this->print_("footer",$TPL_SCP,1);?>