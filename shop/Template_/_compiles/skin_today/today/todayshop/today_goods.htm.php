<?php /* Template_ 2.2.7 2013/01/25 15:00:45 /www/loosfly_godo_co_kr/shop/data/skin_today/today/todayshop/today_goods.htm 000049060 */  $this->include_("dataTodayshopPopup","dataBanner");
$TPL_ts_category_1=empty($TPL_VAR["ts_category"])||!is_array($TPL_VAR["ts_category"])?0:count($TPL_VAR["ts_category"]);
$TPL_ts_category_all_1=empty($TPL_VAR["ts_category_all"])||!is_array($TPL_VAR["ts_category_all"])?0:count($TPL_VAR["ts_category_all"]);
$TPL_r_img_1=empty($TPL_VAR["r_img"])||!is_array($TPL_VAR["r_img"])?0:count($TPL_VAR["r_img"]);
$TPL__addopt_1=empty($GLOBALS["addopt"])||!is_array($GLOBALS["addopt"])?0:count($GLOBALS["addopt"]);?>
<!--header start-->
<!--삭제하지마세요.-->
<?php $this->print_("header",$TPL_SCP,1);?>

<!--header end-->

<style>
a {cursor:pointer;}
.won { font-family: "돋움", "굴림"; font-size: 12px; color: #898989; }
ul { list-style-type:none; }

/* 상단 타이틀 */
.today_title { margin-bottom:15px; text-align:center; width:890px; height:44px;}
.today_title div { float:left; }
.today_title .image { width:216px; }
.today_title .date { width:303px; text-align:left; padding-top:23px;}
.today_title .date img { vertical-align:text-bottom;}

.today_title .calbtn { float:right; width:83px; padding-top:20px; }
.today_title .allbtn { float:right; width:83px; padding-top:20px; }

/* 상품썸네일 */
.thumbBlock { vertical-align:top; position:absolute; margin-left:900px; width:80px; display:<?php if($TPL_VAR["todayshop_cfg"]["shopMode"]!='todayshop'){?>none<?php }?>;}
.thumbBlock iframe { width:100%; height:420px; }

/* 추가 헤더 */
.extra_header {width:890px;overflow:hidden;}	/* .goodsBlock 과 동일 넓이 지정*/

/* 상품정보 */
.goodsBlock { width:890px; vertical-align:top; border:5px solid #3f3f3f; }
.goodsBlock .imageBlock { position:relative; display:block; width:573px; vertical-align:top; background:#E3E3E3; }
.goodsBlock .imageBlock .mainImgOuter { position:relative; }
.goodsBlock .imageBlock .mainImgOuter #goodsMainImgNum { position:absolute; top:10px; left:10px;}
.goodsBlock .imageBlock .mainImgOuter #goodsMainImgNum span { cursor:pointer; text-align:center; }
.goodsBlock .imageBlock #timerBlock { background-color:#e3e3e3; height:46px; text-align:right; padding-top:6px; position:absolute; bottom:0; right:0; }
.goodsBlock .imageBlock #timerBlock div { padding-right:7px; }

/* 상품구매정보 */
.goodsBlock .infoBlock { width:317px; padding:0px 10px; text-align:center; vertical-align:middle; } /* 상품정보 로딩 전엔 세로중앙 정렬, 로딩 후 상단정렬로 변경(script) */
.goodsBlock .infoBlock .splitbar { height:1px; font-size:1px; border-bottom:solid 1px #d7d7d7; margin:3px 0px; overflow:hidden;}
.goodsBlock .infoBlock ul { width:100%; display:inline-block; margin:5px 0px; padding:0px; }
.goodsBlock .infoBlock ul li { float:left; }
.goodsBlock .infoBlock form { display:none; } /* 상품정보 로딩 전 정보안보이기 */

.goodsBlock .infoBlock ul.goodsnm li { padding:20px 0px 10px 0px; text-align:center; width:100%; font-family:"돋움", "굴림"; font-size:16px; font-weight:bold; color:#101010; }

.goodsBlock .infoBlock ul.consumer li.lbox { width:63px; }
.goodsBlock .infoBlock ul.consumer li.rbox { width:222px; text-align:left; font-family:"Arial", "굴림"; font-size:16px; font-weight:bold; color: #a09f9f; text-decoration:line-through; }

.goodsBlock .infoBlock ul.price { background:url(/shop/data/skin_today/today/img/point_bg.gif) left top no-repeat;}
.goodsBlock .infoBlock ul.price li { height:40px; margin:2px 0px;}
.goodsBlock .infoBlock ul.price li.lbox { width:63px; padding-top:10px;}
.goodsBlock .infoBlock ul.price li.rbox { width:222px;  text-align:left; position:relative; font-family:"Arial", "Vernada"; font-size:24px; font-weight:bold; color:#ee151d; }
.goodsBlock .infoBlock ul.price li.rbox .salepct { position:absolute; z-index:100; background:url(/shop/data/skin_today/today/img/pointbg_count.png) no-repeat; width:59px; height:70px; margin-top:-70px; margin-left:120px; text-align:center; padding-top:15px; }
.goodsBlock .infoBlock ul.price li.rbox .salepct .num { font-family:"Arial", "Vernada"; font-size:23px; font-weight:bold; color:#ffffff;  }
.goodsBlock .infoBlock ul.price li.rbox .salepct .unit { font-family:"Arial", "Vernada"; font-size:12px; color:#ffffff;  }

.goodsBlock .infoBlock #stockBlock li.lbox { width:63px; }
.goodsBlock .infoBlock #stockBlock li.rbox { width:222px; text-align:left; font-family: "돋움", "굴림"; font-size: 14px; font-weight: bold; color:#ee151d; }

.goodsBlock .infoBlock #optBlock li.lbox { width:63px; }
.goodsBlock .infoBlock #optBlock li.rbox { width:222px; text-align:left; }

.goodsBlock .infoBlock #eaBlock li.lbox { width:63px; }
.goodsBlock .infoBlock #eaBlock li.rbox { width:222px; text-align:left; }
.goodsBlock .infoBlock #eaBlock li.rbox .eaBox { float:left; }
.goodsBlock .infoBlock #eaBlock li.rbox .eaBox input { text-align:right;height:18px; }
.goodsBlock .infoBlock #eaBlock li.rbox .eaBtn { float:left; padding-left:3px; }
.goodsBlock .infoBlock #eaBlock li.rbox .eaBtn .upBtn { padding:1px 0px 2px 0px; }
.goodsBlock .infoBlock #eaBlock li.rbox .eaBtn img { cursor:pointer; }
.goodsBlock .infoBlock #eaBlock li.rbox .eaLabel { padding-top:3px; float:left; }

.goodsBlock .infoBlock #limitBlock {  padding-left:10px; }
.goodsBlock .infoBlock #limitBlock .buyercntBox { text-align:center; }
.goodsBlock .infoBlock #limitBlock #buyercnt { color:#FF0000; font-weight:bold; font-size:22px; font-family:verdana; }
.goodsBlock .infoBlock #limitBlock .buyerbarBox { width:100%; text-align:left; }
.goodsBlock .infoBlock #limitBlock .buyerbarBox #buyericon { margin-left:0px;}
.goodsBlock .infoBlock #limitBlock .buyerbarBox .buyerbarbg { background:url(/shop/data/skin_today/today/img/today_baroff.gif) no-repeat; width:100%; overflow:hidden; }
.goodsBlock .infoBlock #limitBlock .buyerbarBox .buyerbarbg div { background:url(/shop/data/skin_today/today/img/today_baroff.gif) no-repeat; width:100%; overflow:hidden; }
.goodsBlock .infoBlock #limitBlock .buyerbarBox .buyerbarbg #buyerbar {width:0%; overflow:hidden;}
.goodsBlock .infoBlock #limitBlock .buyerbarBox .buyernumBox {display:inline-block; padding-right:10px; color:#B0B0B0; font-weight:bold; width:100%;}
.goodsBlock .infoBlock #limitBlock .buyerbarBox .buyernumBox .leftnum { float:left; }
.goodsBlock .infoBlock #limitBlock .buyerbarBox .buyernumBox #limitEa { float:right; }

.goodsBlock .infoBlock #buybtnBlock { text-align:center; padding-top:18px; }

.goodsBlock .infoBlock .snsbtnrow .snsbtn #smsBlock { display:none; }

p.agree {font-size:11px; letter-spacing:-1px;;text-align:left;margin-left:37px;line-height:150%;}
p.agree label {display:block;margin-left:-24px;}

/* 상품상세설명 */
.desc { width:890px; padding-top:15px; text-align:center; }
.desc .descBox { width:890px; margin:0px auto;}
.desc .descBox .menutab { width:100%; background: url('/shop/data/skin_today/today/img/tep_bg.gif') repeat-x; text-align:left; }
.desc .descBox #desc { width:890px; padding-top:15px; text-align:center; }
.desc .descBox #desc2 { width:890px; overflow:hidden; }
.desc .descBox #desc2 div { margin-top:10px; }
.desc .descBox #desc2 ul { display:block; width:100%; margin:0 0 70px 7px; margin-bottom:70px; padding:0px;}
.desc .descBox #desc2 ul li { background:url('/shop/data/skin_today/today/img/dot.gif') no-repeat; padding-left:15px; text-align:left; margin-bottom:5px;}
.desc .descBox #todaytalkBlock { display:none; padding-top:15px; }
.desc .descBox #intalk { width:871px; padding:0px; margin:0px;}
</style>
<script type="text/javascript" src="/shop/lib/js/prototype.js"></script>
<script type="text/javascript" src="/shop/lib/js/todayshop.js"></script>
<script type="text/javascript">
/* 상품페이지 초기화 script */
<?php if($TPL_VAR["category"]){?>
// 해당 상품의 카테고리 헤더에 출력
if (typeof(setCategory) != "undefined") setCategory('<?php echo $TPL_VAR["category"]["category"]?>', '<?php echo $TPL_VAR["category"]["catnm"]?>');
<?php }?>

var imgs = new Array();
imgs[0] = "/shop/data/skin_today/today/img/today_count0.gif";
imgs[1] = "/shop/data/skin_today/today/img/today_count1.gif";
imgs[2] = "/shop/data/skin_today/today/img/today_count2.gif";
imgs[3] = "/shop/data/skin_today/today/img/today_count3.gif";
imgs[4] = "/shop/data/skin_today/today/img/today_count4.gif";
imgs[5] = "/shop/data/skin_today/today/img/today_count5.gif";
imgs[6] = "/shop/data/skin_today/today/img/today_count6.gif";
imgs[7] = "/shop/data/skin_today/today/img/today_count7.gif";
imgs[8] = "/shop/data/skin_today/today/img/today_count8.gif";
imgs[9] = "/shop/data/skin_today/today/img/today_count9.gif";

Timer.initImg(imgs);
imgs = null;

var imgs = new Array();
imgs[1] = {def:"/shop/data/skin_today/today/img/no_btn1.gif", over:"/shop/data/skin_today/today/img/no_onbtn1.gif"};
imgs[2] = {def:"/shop/data/skin_today/today/img/no_btn2.gif", over:"/shop/data/skin_today/today/img/no_onbtn2.gif"};
imgs[3] = {def:"/shop/data/skin_today/today/img/no_btn3.gif", over:"/shop/data/skin_today/today/img/no_onbtn3.gif"};
imgs[4] = {def:"/shop/data/skin_today/today/img/no_btn4.gif", over:"/shop/data/skin_today/today/img/no_onbtn4.gif"};
imgs[5] = {def:"/shop/data/skin_today/today/img/no_btn5.gif", over:"/shop/data/skin_today/today/img/no_onbtn5.gif"};
imgs[6] = {def:"/shop/data/skin_today/today/img/no_btn6.gif", over:"/shop/data/skin_today/today/img/no_onbtn6.gif"};
imgs[7] = {def:"/shop/data/skin_today/today/img/no_btn7.gif", over:"/shop/data/skin_today/today/img/no_onbtn7.gif"};
imgs[8] = {def:"/shop/data/skin_today/today/img/no_btn8.gif", over:"/shop/data/skin_today/today/img/no_onbtn8.gif"};
imgs[9] = {def:"/shop/data/skin_today/today/img/no_btn9.gif", over:"/shop/data/skin_today/today/img/no_onbtn9.gif"};
imgs[10] = {def:"/shop/data/skin_today/today/img/no_btn10.gif", over:"/shop/data/skin_today/today/img/no_onbtn10.gif"};

MainImage.initImg(imgs);
imgs = null;

var price = new Array();
var consumer = new Array();
var stock = new Array();
var fkey = null;
var member = null;
var useEncor = null;
var useSMS = null;
var useGoodsTalk = null;
var runout = null;
var goodsStatus = null;

function initGoods() {
	TodayShop.getGoodsData(<?php echo $TPL_VAR["tgsno"]?>, setGoodsData);

<?php if(($TPL_VAR["startdt"][ 0]&&$TPL_VAR["startdt"][ 1])||($TPL_VAR["enddt"][ 0]&&$TPL_VAR["enddt"][ 1])){?>
	Timer.getTimer(0, "<?php echo $TPL_VAR["startdt"][ 0]?>", "<?php echo $TPL_VAR["startdt"][ 1]?>", "<?php echo $TPL_VAR["enddt"][ 0]?>", "<?php echo $TPL_VAR["enddt"][ 1]?>", timerCallback)
<?php }else{?>
	timerCallback(0, 'noperiod');
<?php }?>
}

function timerCallback(idx, status) {
	goodsStatus = status;
	setGoodsStatus();
}

// 상품 정보 초기화
function setGoodsData(res) {
	loadingComplete();
	try
	{
		if (res.member == "y") member=true;
		else throw null;
	}
	catch (e) {
		member=false;
	}

	try
	{
		if (res.data.length == 0) return;
	}
	catch (e) {
		return;
	}

	// SMS 사용여부
	var smsobj = document.getElementById("smsBlock");
	try
	{
		if (smsobj && res.useSMS == "y" && <?php echo $TPL_VAR["smsCnt"]?> <= parseInt(res.smsCnt)) smsobj.style.display = "";
		else throw null;
	}
	catch (e) {
		if (smsobj) smsobj.style.display = "none";
	}

	// 상품토크 사용여부
	var talktabobj = document.getElementById("todaytalkTab");
	var talkblockobj = document.getElementById("todaytalkBlock");
	try
	{
		if (talktabobj && res.useGoodsTalk == "y") talktabobj.style.display = "";
		else throw null;
	}
	catch (e) {
		if (talktabobj) talktabobj.style.display = "none";
	}

	// 앵콜 사용여부
	try
	{
		useEncor = res.useEncor;
	}
	catch (e) {
	}

	var optobj = document.getElementById("option");
	var priceobj = document.getElementById("price");
	var consumerobj = document.getElementById("consumer");
	var stockobj = document.getElementById("stock");
	var salepctobj = document.getElementById("salepct");
	var totstock = 0;

	// 옵션 셀렉트박스 생성
	var opthtml = "";
	for(var i = 0; i < res.data.length; i++) {
		var val = (res.data[i].opt1);
		var html = (res.data[i].opt1);
		var disabled = "";
		if (res.data[i].opt2) {
			val += "|"+res.data[i].opt2;
			html += "/"+res.data[i].opt2;
		}
		if (res.data[i].price != res.data[0].price) html += " "+comma(res.data[i].price)+"원";
<?php if($TPL_VAR["usestock"]){?>
		var _stock = parseInt(res.data[i].stock);
		if (! _stock) {
			disabled = "disabled='disabled' class='disabled'";
			html += " [품절]";
		}
		else {
			html += ' (수량 : '+ _stock +'개)';
		}
<?php }?>
		if (res.data[i].opt1 || res.data[i].opt2) opthtml += "<option value='"+val+"' "+disabled+">"+html+"</option>";
		if (i == 0) {
			fkey = val;
			if (priceobj) priceobj.innerHTML = comma(res.data[i].price);
			if (consumerobj) consumerobj.innerHTML = comma(res.data[i].consumer);
<?php if($TPL_VAR["showpercent"]=='y'){?>
			// 할인률 출력
			if (salepctobj) {
				if (res.data[i].consumer == 0) salepctobj.innerHTML = "0";
				else salepctobj.innerHTML = (Math.round(100 - (parseInt(res.data[i].price) / parseInt(res.data[i].consumer) * 100)));
			}
<?php }?>
		}
		price[val] = res.data[i].price;
		consumer[val] = res.data[i].consumer;
		stock[val] = res.data[i].stock;
		totstock += parseInt(res.data[i].stock);
	}
	if (opthtml) {
		var selecthtml = "<select name='opt[]' onchange='chkOption(this)' required msgR='옵션을 선택해주세요'>";
		selecthtml += "<option value=''>*옵션을선택해주세요</option>";
		selecthtml += opthtml;
		selecthtml += "</select>";
		document.getElementById("optBlock").style.display = "";
		if (optobj) optobj.innerHTML = selecthtml;
	}

	// 품절여부
	try
	{
		runout = (res.data[0].runout == "1") ? "y" : "n";
	}
	catch (e) {
		runout = "n";
	}

<?php if($TPL_VAR["showstock"]=='y'){?>
	// 상품수량 출력
	if (stockobj) stockobj.innerHTML = comma(totstock);
<?php }?>

	// 상품수량 출력
	// 현재 구매인원 표시(text)
<?php if($TPL_VAR["limit_ea"]> 0||$TPL_VAR["showbuyercnt"]=='y'){?>
	var buyerobj = document.getElementById("buyercnt");
	if (buyerobj) buyerobj.innerHTML = parseInt(res.data[0].fakestock)+parseInt(res.data[0].buyercnt);
<?php if($TPL_VAR["limit_ea"]> 0){?>
	var buyerval = (parseInt(res.data[0].fakestock)+parseInt(res.data[0].buyercnt)) / <?php echo $TPL_VAR["limit_ea"]?>;

	// 현재 구매인원 표시(bar)
	var buyerbarobj = document.getElementById("buyerbar");
	if (buyerbarobj) {
		buyerbarval = (buyerval * 100 > 100)? 100 : buyerval * 100;
		buyerbarobj.style.width = buyerbarval + "%";
	}

	// 현재 구매인원 표시(icon)
	var buyericonobj = document.getElementById("buyericon");
	if (buyericonobj) {
		try
		{
			var barwidth = buyerbarobj.getElementsByTagName("IMG")[0].width - buyericonobj.width;
			buyericonval = (buyerval * barwidth > barwidth)? barwidth : buyerval * barwidth;
			buyericonobj.style.marginLeft = buyericonval + "px";
		}
		catch (e)
		{ }
	}
<?php }?>
<?php }?>

	setGoodsStatus();
}

function setGoodsStatus() {
	if (goodsStatus === null || runout === null) return;
	var tobj = document.getElementById("timerBlock");
	var bobj = document.getElementById("buybtnBlock");

	if (runout == "y") goodsStatus = "closed";
	switch(goodsStatus) {
		case 'cart' :
		case 'ing' : {
			if (tobj) tobj.innerHTML = "<div><img src='/shop/data/skin_today/today/img/count_title.gif' border='0'><span id='rTime_d0'><img src='/shop/data/skin_today/today/img/today_count.gif' /></span><img src='/shop/data/skin_today/today/img/bn_day.gif' border='0'><span id='rTime_h0'><img src='/shop/data/skin_today/today/img/today_count.gif' /><img src='/shop/data/skin_today/today/img/today_count.gif' /></span><img src='/shop/data/skin_today/today/img/bn_sp.gif' border='0'><span id='rTime_m0'><img src='/shop/data/skin_today/today/img/today_count.gif' /><img src='/shop/data/skin_today/today/img/today_count.gif' /></span><img src='/shop/data/skin_today/today/img/bn_sp.gif' border='0'><span id='rTime_s0'><img src='/shop/data/skin_today/today/img/today_count.gif' /><img src='/shop/data/skin_today/today/img/today_count.gif' /></span></div>";
<?php if($TPL_VAR["use_cart"]=='y'){?>
				if (bobj) bobj.innerHTML = "<a href=\"javascript:act('../todayshop/order')\"><img src='/shop/data/skin_today/today/img/btn_buy01.gif' border='0'></a><a href=\"javascript:void(0);\" onClick=\"add_cart()\"><img src='/shop/data/skin_today/today/img/btn_basket01.gif' border='0'></a>";
<?php }else{?>
				if (bobj) bobj.innerHTML = "<a href=\"javascript:act('../todayshop/order')\"><img src='/shop/data/skin_today/today/img/btn_buy.gif' border='0'></a>";
<?php }?>
			break;
		}
		case 'closed': {
			Timer.stopTimer(0);
			if (tobj) tobj.innerHTML = "<img src='/shop/data/skin_today/today/img/bn_end.gif' />";
			if (useEncor == 'y') {
				if (bobj) bobj.innerHTML = "<a href=\"javascript:encor(<?php echo $TPL_VAR["tgsno"]?>)\"><img src='/shop/data/skin_today/today/img/btn_encor.gif' /></a>";
			}
			else {
				if (bobj) bobj.innerHTML = "<img src='/shop/data/skin_today/today/img/btn_end.gif' />";
			}
			if (document.getElementById("stockBlock")) document.getElementById("stockBlock").style.display = "none";
			if (document.getElementById("optBlock")) document.getElementById("optBlock").style.display = "none";
			if (document.getElementById("eaBlock")) document.getElementById("eaBlock").style.display = "none";
			if (document.getElementById("limitBlock")) document.getElementById("limitBlock").style.display = "none";
			break;
		}
		case 'noperiod': {
			if (tobj) tobj.style.display = "none";
<?php if($TPL_VAR["use_cart"]=='y'){?>
				if (bobj) bobj.innerHTML = "<a href=\"javascript:act('../todayshop/order')\"><img src='/shop/data/skin_today/today/img/btn_buy01.gif' border='0'></a><a href=\"javascript:void(0);\" onClick=\"add_cart()\"><img src='/shop/data/skin_today/today/img/btn_basket01.gif' border='0'></a>";
<?php }else{?>
				if (bobj) bobj.innerHTML = "<a href=\"javascript:act('../todayshop/order')\"><img src='/shop/data/skin_today/today/img/btn_buy.gif' border='0'></a>";
<?php }?>
		}
	}
}

function loadingComplete() {
	document.getElementById("loadingInfo").style.display = "none";
	document.getElementById("infoBlock").style.verticalAlign = "top";
	document.getElementsByName("frmView")[0].style.display = "block";
<?php if($TPL_VAR["subscribe"]["use"]=='y'){?>document.getElementsByName("frmSubscribe")[0].style.display = "block";<?php }?>
}
</script>
<script type="text/javascript">
// 상품페이지 script
function chkOption(obj)
{
	if (!selectDisabled(obj)) return false;

	var opt = document.getElementsByName('opt[]');
	var opt1 = opt[0].value; var opt2 = '';
	if (typeof(opt[1])!="undefined") opt2 = "|" + opt[1].value;
	var key = opt1 + opt2;
	if (opt[0].selectedIndex == 0) key = fkey;
	key = key.replace('"','&quot;');
	if (typeof(price[key])!="undefined"){
		var salepct = (Math.round(100 - (parseInt(price[key]) / parseInt(consumer[key]) * 100)));
		if (document.getElementById('price')) document.getElementById('price').innerHTML = comma(price[key]);
		if (document.getElementById('consumer')) document.getElementById('consumer').innerHTML = comma(consumer[key]);
		if (document.getElementById('salepct')) document.getElementById('salepct').innerHTML = (!isNaN(salepct)) ?  salepct : '0';
		if (document.getElementById('stock')) document.getElementById('stock').innerHTML = comma(stock[key]);
	}
}

function act(target)
{
	var form = document.frmView;
	if(!(form.ea.value>0)) {
		alert("구매수량은 1개 이상만 가능합니다");
		return;
	}

<?php if($TPL_VAR["usestock"]){?>
	var optobj = document.getElementsByName("opt[]");
	var key = '';
	if (optobj.length > 0) key = optobj[0][optobj[0].selectedIndex].value;
	if (parseInt(stock[key]) == 0) {
		alert("품절입니다.");
		return;
	}
	if (parseInt(stock[key]) < parseInt(form.ea.value)) {
		alert("해당 상품의 남은 수량은 "+stock[key]+"개입니다.");
		return;
	}
<?php }?>
	form.action = target + ".php";
	if (chkForm(form)) form.submit();
}

function add_cart() {

	var form = document.frmView;

	if(!(form.ea.value>0)) {
		alert("구매수량은 1개 이상만 가능합니다");
		return false;
	}

<?php if($TPL_VAR["usestock"]){?>
	var optobj = document.getElementsByName("opt[]");
	var key = '';
	if (optobj.length > 0) key = optobj[0][optobj[0].selectedIndex].value;
	if (parseInt(stock[key]) == 0) {
		alert("품절입니다.");
		return false;
	}
	if (parseInt(stock[key]) < parseInt(form.ea.value)) {
		alert("해당 상품의 남은 수량은 "+stock[key]+"개입니다.");
		return false;
	}
<?php }?>
	if (! chkForm(form)) return false;

	var el = event.srcElement;

	var rn = 1301;
	new Ajax.Request("./indb.cart.php", { method: "post", parameters: Form.serialize(form)+'&rn='+rn,
		onSuccess: function(req) {
			var resCode = '';
			if (rn >= 1301 && req.responseText.substr(2,3) == 'xml' && typeof(createXMLFromString) != 'undefined') {
				var xml = createXMLFromString(req.responseText);
				var result = xml.getElementsByTagName('result');
				var code = result[0].getElementsByTagName('code')[0].firstChild.nodeValue;
				var aceScript = result[0].getElementsByTagName('aceScript')[0].firstChild.nodeValue;
				resCode = code; // ok or error
				if (aceScript !='') {
					eval(aceScript);
				}
			} else {
				resCode = req.responseText; // ok or error
			}

			if (resCode == 'ok')
			{
				var box = document.getElementById('todayshopCartNoti');

				if (box != undefined) {

					if (box.style.display != 'block') {

						var pos = offset(el);

						box.style.position = "absolute";
						box.style.top = 10 + pos.top + el.offsetHeight + "px";
						box.style.left = parseInt(pos.left + el.offsetWidth / 2 - parseInt(box.style.width.replace('px','')) / 2) + "px";

						box.style.display = 'block';
					}
					else {
						box.style.display = 'none';
					}
				}
			}
		},
		onFailure: function() { }
}	);
}

function chgImg(obj)
{
	var objImg = document.getElementById('objImg');
	objImg.src = obj.src.replace("/t/","/");
}

function innerImgResize(width)	// 본문 이미지 크기 리사이징
{
	var objContents = document.getElementById('desc');
	var innerWidth = width;
	var img = objContents.getElementsByTagName('img');
	for (var i=0;i<img.length;i++){
		if (img[i].width>innerWidth) img[i].width = innerWidth;
		img[i].onload = function(){
			if (this.width>innerWidth) this.width = innerWidth;
		};
	}
}

function chk_ea() {
	var obj = document.getElementById("ea");
<?php if($TPL_VAR["min_ea"]!= 0){?>
	if (obj.value < <?php echo $TPL_VAR["min_ea"]?>) {
		obj.value = <?php echo $TPL_VAR["min_ea"]?>;
		alert("최소 구매수량은 <?php echo $TPL_VAR["min_ea"]?>개입니다.");
	}
<?php }?>
<?php if($TPL_VAR["max_ea"]!= 0){?>
	if (<?php echo $TPL_VAR["max_ea"]?> != 0 && obj.value > <?php echo $TPL_VAR["max_ea"]?>) {
		obj.value = <?php echo $TPL_VAR["max_ea"]?>;
		alert("최대 구매수량은 <?php echo $TPL_VAR["max_ea"]?>개입니다.");
	}
<?php }?>
}
</script>
<script type="text/javascript">
// 투데이샵 script
function showTab(n) {
	if (n == 1) {
		document.getElementById("tab1").src = "/shop/data/skin_today/today/img/tep_detailon.gif";
		document.getElementById("tab2").src = "/shop/data/skin_today/today/img/tep_talkoff.gif";
		document.getElementById("desc").style.display = "block";
		document.getElementById("desc2").style.display = "block";
		document.getElementById("todaytalkBlock").style.display = "none";
	}
	else {
		document.getElementById("tab1").src = "/shop/data/skin_today/today/img/tep_detailoff.gif";
		document.getElementById("tab2").src = "/shop/data/skin_today/today/img/tep_talkon.gif";
		document.getElementById("desc").style.display = "none";
		document.getElementById("desc2").style.display = "none";
		document.getElementById("todaytalkBlock").style.display = "block";
		document.getElementById("intalk").contentWindow.resizeFrame();
	}
}
</script>
<script type="text/javascript">
// 로그인여부가 필요한 script
function encor(tgsno) {
	if (member === null) {
		alert("잠시만 기다리세요.");
		return;
	}
	if (member !== true) {
		if(confirm("앵콜추천 참여는 회원만이 참여할 수 있습니다. 로그인하시겠습니까?")) {
			location.href="<?php echo url("member/login.php")?>&";
		}
	}
	else {
		if(confirm("선택하신 상품을 앵콜 추천하시겠습니까?")) {
			var fobj = document.frmEncor;
			fobj.tgsno.value = tgsno;
			fobj.submit();
		}
	}
}

function sendSms(tgsno) {
	if (member === null) {
		alert("잠시만 기다리세요.");
		return;
	}
	if (member === true) window.open('../todayshop/today_sms.php?tgsno='+tgsno, 'todaysms', 'width=490, height=360');
	else if(confirm("로그인후에 사용이 가능합니다. 로그인페이지로 이동하시겠습니까?")) location.href = "../member/login.php";
}

function fnToggleTodayshopSubscribe() {

	var el = event.srcElement;

	var box = document.getElementById('todayshopSubscribe');

	if (box != undefined) {

		if (box.style.display != 'block') {

			var el = event.srcElement;

			var pos = offset(el);

			box.style.position = "absolute";
			box.style.top = 10 + pos.top + el.offsetHeight + "px";
			box.style.left = parseInt(pos.left + el.offsetWidth / 2 - parseInt(box.style.width.replace('px','')) / 2) + "px";

			box.style.display = 'block';
		}
		else {
			box.style.display = 'none';
		}

		return false;
	}
}

function fnCheckSubscribe(f) {

	if (f.subscribe_agree.checked == false)
	{
		alert('이메일/핸드폰 수집에 동의하셔야 합니다.');
		return false;
	}

	var v = 0;

	for (var i=0;i<f.elements.length ;i++ ) {
		var el = f.elements[i];
		if (el.getAttribute('type') == 'text' && el.value != '') return true;
	}

	alert('이메일/핸드폰 번호를 입력해 주세요.');
	return false;
}
</script>

<!-- 카테고리 노출 시작 (헤더에 카테고리가 노출되지 않을때에만 노출)-->
<style>
#page_cate { display:none; margin-bottom:20px; }
#page_cate .topbg img { width:100%; height:13px; }

#page_cate #ccg_closed #curCCateOuter { background-color:#49494A; }
#page_cate #ccg_closed #curCCateOuter div { padding-left:23px; }
#page_cate #ccg_closed #curCCateOuter div #curCCateBlock { color:#FFFFFF; }
#page_cate #ccg_closed .togglebtn { background:url(/shop/data/skin_today/today/img/today_footbg.gif) top repeat-x; text-align:center; cursor:pointer; }

#page_cate #ccg_opened .list { background-color:#49494A; }
#page_cate #ccg_opened .catenm { width:195px; height:25px; }
#page_cate #ccg_opened .catenm span { padding-left:30px; }
#page_cate #ccg_opened .catenm span a { color:#FFFFFF; }
#page_cate #ccg_opened .split { text-align:center; }
#page_cate #ccg_opened .hei1 { height:1px; }
#page_cate #ccg_opened .togglebtn { background:url(/shop/data/skin_today/today/img/today_footbg.gif) top repeat-x; text-align:center; padding-top:8px; cursor:pointer; }
</style>

<!-- 메인팝업창 -->
<?php if(is_array($TPL_R1=dataTodayshopPopup())&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?>

<?php if($TPL_V1["type"]=='layer'){?>
<div id="<?php echo 'blnCookie_'.$TPL_V1["code"]?>" STYLE="display:none;position:absolute; width:<?php echo $TPL_V1["width"]?>; height:<?php echo $TPL_V1["height"]?>; left:<?php echo $TPL_V1["left"]?>; top:<?php echo $TPL_V1["top"]?>; z-index:200;">
<?php echo eval("\$_GET[code]='blnCookie_".$TPL_V1["code"]."';")?>

<?php echo $this->define('tpl_include_file_1',$TPL_V1["file"])?> <?php $this->print_("tpl_include_file_1",$TPL_SCP,1);?>

</div>
<?php }?>

<?php if($TPL_V1["type"]=='layerMove'){?>
<!-- 이동레이어 팝업창 시작 -->
<div id="<?php echo 'blnCookie_'.$TPL_V1["code"]?>" STYLE="display:none;position:absolute; width:<?php echo $TPL_V1["width"]?>; height:<?php echo $TPL_V1["height"]?>; left:<?php echo $TPL_V1["left"]?>; top:<?php echo $TPL_V1["top"]?>; z-index:200;">
<div onmousedown="Start_move(event,'<?php echo 'blnCookie_'.$TPL_V1["code"]?>');" onmouseup="Moveing_stop();" style='cursor:move;'>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
<td>
<?php echo eval("\$_GET[code]='blnCookie_".$TPL_V1["code"]."';")?>

<?php echo $this->define('tpl_include_file_1',$TPL_V1["file"])?> <?php $this->print_("tpl_include_file_1",$TPL_SCP,1);?>

</td>
</tr>
</table>
</div>
</div>
<!-- 이동레이어 팝업창 끝 -->
<?php }?>

<?php }}?>

<script language="JavaScript"><!--
<?php if(is_array($TPL_R1=dataTodayshopPopup())&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?>
<?php if($TPL_V1["type"]==''){?>
if ( !getCookie( "blnCookie_<?php echo $TPL_V1["code"]?>" ) ) { // <?php echo $TPL_V1["name"]?> 팝업호출
var property = 'width=<?php echo $TPL_V1["width"]?>, height=<?php echo $TPL_V1["height"]?>, top=<?php echo $TPL_V1["top"]?>, left=<?php echo $TPL_V1["left"]?>, scrollbars=no, toolbar=no';
var win=window.open( './html.php?htmid=<?php echo $TPL_V1["file"]?>&code=blnCookie_<?php echo $TPL_V1["code"]?>', '<?php echo $TPL_V1["code"]?>', property );
if(win) win.focus();
}
<?php }elseif($TPL_V1["type"]=='layer'||$TPL_V1["type"]=='layerMove'){?>
if ( !getCookie( "blnCookie_<?php echo $TPL_V1["code"]?>" ) ) {
document.getElementById('blnCookie_<?php echo $TPL_V1["code"]?>').style.display = 'block';
}
<?php }?>
<?php }}?>
//--></script>

<div id="page_cate">
	<div class="topbg"><img src="/shop/data/skin_today/today/img/today_topbgsh.gif" /></div>
	<div id="ccg_closed" style="display:none;">
		<div id="curCCateOuter" style="<?php if(!$TPL_VAR["ts_curcate"]){?>display:none;<?php }?>">
			<div><img src="/shop/data/skin_today/today/img/bullet_category.gif" /> <span id="curCCateBlock"></span></div>
		</div>
		<div onclick="showCCate()">
			<div class="togglebtn"><img src="/shop/data/skin_today/today/img/today_btnopen.gif" /></div>
		</div>
	</div>
	<div id="ccg_opened">
		<div class="list">
			<table width="100%" cellpadding=0 cellspacing=0 border=0>
			<tr><td class="catenm hei1"></td><td class="split hei1"></td><td class="catenm hei1"></td><td class="split hei1"></td><td class="catenm hei1"></td><td class="split hei1"></td><td class="catenm hei1"></td></tr>
			<tr>
<?php if($TPL_ts_category_1){$TPL_I1=-1;foreach($TPL_VAR["ts_category"] as $TPL_V1){$TPL_I1++;?>
				<td class="catenm" id="tsCCate<?php echo $TPL_V1["category"]?>"><span><a href="<?php echo url("todayshop/today_list.php?")?>&category=<?php echo $TPL_V1["category"]?>" onmouseover="this.style.color='#F9B000'" onmouseout="this.style.color='#FFFFFF'"><?php echo $TPL_V1["catnm"]?></a></span></td>
<?php if($TPL_I1!= 0&&($TPL_I1+ 1)% 4== 0){?></tr><tr><?php }else{?><td class="split"><img src="/shop/data/skin_today/today/img/today_split.gif" /></td><?php }?>
<?php }}?>
			</tr>
			</table>
		</div>
		<div onclick="showCCate()">
			<div class="togglebtn"><img src="/shop/data/skin_today/today/img/today_btnclose.gif" /></div>
		</div>
	</div>
</div>
<script type="text/javascript">
function showCCate() {
	var objc = document.getElementById("ccg_closed");
	var objo = document.getElementById("ccg_opened");
	if (objc.style.display == "none") {
		objc.style.display = "block";
		objo.style.display = "none";
	}
	else {
		objc.style.display = "none";
		objo.style.display = "block";
	}
}

// 해당 상품의 카테고리 출력
try
{
	if (!document.getElementById("header_cate")) {
		document.getElementById("page_cate").style.display = "block";

		var regexp = /category=([0-9]*)/g;
		var res = regexp.exec(location.href);

		var cbobj = document.getElementById("curCCateBlock");

		if (res && res.length > 1) {
			var cateobj = document.getElementById("tsCCate" + res[1]);
			if (cateobj) {
				cateobj.style.background = "url(/shop/data/skin_today/today/img/today_pointbox.gif)";
				var catenm = cateobj.getElementsByTagName("A")[0].innerHTML;
				if (cbobj) cbobj.innerHTML = catenm;

				var coobj = document.getElementById("curCCateOuter");
				if (coobj) coobj.style.display = "block";
			}
		}
<?php if($TPL_VAR["category"]){?>
		else {
			if (cbobj.innerHTML == "") {
				if (cbobj) cbobj.innerHTML = "<?php echo $TPL_VAR["category"]["catnm"]?>";
				var coobj = document.getElementById("curCCateOuter");
				if (coobj) coobj.style.display = "block";

				var cateobj = document.getElementById("tsCCate<?php echo $TPL_VAR["category"]["category"]?>");
				if (cateobj) cateobj.style.background = "url(/shop/data/skin_today/today/img/today_pointbox.gif)";
			}
		}
<?php }?>
	}
}
catch (e)
{
	try
	{
		document.getElementById("page_cate").style.display = "block";
	}
	catch (e)
	{
	}
}
</script>
<!-- 카테고리 노출 끝(헤더에 카테고리가 노출되지 않을때에만 노출)-->

<!-- 오늘의 상품타이틀/날짜 시작--------------------------------->
<div class="today_title">
	<div class="image"><img src='/shop/data/skin_today/today/img/today_title.gif' border="0"></div>
	<div class="date">
<?php if($TPL_VAR["opendt"]){?>
		<img src='/shop/data/skin_today/today/img/count_g<?php echo $TPL_VAR["opendt"][ 0]?>.gif' border="0"><img src='/shop/data/skin_today/today/img/count_g<?php echo $TPL_VAR["opendt"][ 1]?>.gif' border="0"><img src='/shop/data/skin_today/today/img/count_g<?php echo $TPL_VAR["opendt"][ 2]?>.gif' border="0"><img src='/shop/data/skin_today/today/img/count_g<?php echo $TPL_VAR["opendt"][ 3]?>.gif' border="0"><img src='/shop/data/skin_today/today/img/count_gsp.gif' border="0"><img src='/shop/data/skin_today/today/img/count_r<?php echo $TPL_VAR["opendt"][ 5]?>.gif' border="0"><img src='/shop/data/skin_today/today/img/count_r<?php echo $TPL_VAR["opendt"][ 6]?>.gif' border="0"><img src='/shop/data/skin_today/today/img/count_rsp.gif' border="0"><img src='/shop/data/skin_today/today/img/count_r<?php echo $TPL_VAR["opendt"][ 8]?>.gif' border="0"><img src='/shop/data/skin_today/today/img/count_r<?php echo $TPL_VAR["opendt"][ 9]?>.gif' border="0">
<?php }?>
<?php if($TPL_VAR["closedt"]){?>
		~
		<img src='/shop/data/skin_today/today/img/count_g<?php echo $TPL_VAR["closedt"][ 0]?>.gif' border="0"><img src='/shop/data/skin_today/today/img/count_g<?php echo $TPL_VAR["closedt"][ 1]?>.gif' border="0"><img src='/shop/data/skin_today/today/img/count_g<?php echo $TPL_VAR["closedt"][ 2]?>.gif' border="0"><img src='/shop/data/skin_today/today/img/count_g<?php echo $TPL_VAR["closedt"][ 3]?>.gif' border="0"><img src='/shop/data/skin_today/today/img/count_gsp.gif' border="0"><img src='/shop/data/skin_today/today/img/count_r<?php echo $TPL_VAR["closedt"][ 5]?>.gif' border="0"><img src='/shop/data/skin_today/today/img/count_r<?php echo $TPL_VAR["closedt"][ 6]?>.gif' border="0"><img src='/shop/data/skin_today/today/img/count_rsp.gif' border="0"><img src='/shop/data/skin_today/today/img/count_r<?php echo $TPL_VAR["closedt"][ 8]?>.gif' border="0"><img src='/shop/data/skin_today/today/img/count_r<?php echo $TPL_VAR["closedt"][ 9]?>.gif' border="0">
<?php }?>
	</div>
	<div class="allbtn"><a href='<?php echo url("todayshop/list.php")?>&'><img src='/shop/data/skin_today/today/img/btn_list_01.gif' border="0"></a></div>
	<div class="calbtn"><a href='<?php echo url("todayshop/calendar.php")?>&'><img src='/shop/data/skin_today/today/img/btn_calendar_01.gif' border="0"></a></div>
</div>
<!-- 오늘의 상품타이틀/날짜  끝---------------------------------->

<!-- -->
<div id="todayshopCartNoti" style="z-index:1000;position:absolute;border:5px solid #3F3F3F;background:#FFFFFF;width:286px;height:180px;display:none;text-align:left;">
	<table cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td><img src="/shop/data/skin_today/today/img/today_basket_top_sh01.gif"></td>
		<td><a href="javascript:void(0)" onClick="document.getElementById('todayshopCartNoti').style.display='none';"><img src="/shop/data/skin_today/today/img/today_basket_top_shclose.gif"></a></td>
	</tr>
	<tr>
		<td colspan="2"><img src="/shop/data/skin_today/today/img/today_basket_img.gif"></td>
	</tr>
	<tr>
		<td colspan="2" style="text-align:center;">
		<div style="margin: 10px 0 15px 0;">
		<a href="<?php echo url("todayshop/today_cart.php")?>&"><img src="/shop/data/skin_today/today/img/today_basket_btn01.gif" /></a>
		<a href="javascript:void(0)" onClick="document.getElementById('todayshopCartNoti').style.display='none';"><img src="/shop/data/skin_today/today/img/today_basket_btn02.gif" /></a>
		</div>
		</td>
	</tr>
	</table>
</div>
<!-- -->

<!-- 상품이미지 / 내용 / 결재 시작------------------------------------>
<div>
	<!-- 썸네일 나오는 부분시작-------------->
	<div class="thumbBlock">
		<iframe src="../todayshop/today_thumb.php?tgsno=<?php echo $TPL_VAR["tgsno"]?>" frameborder="0" scrolling="n"></iframe>
<?php if(is_array($TPL_R1=dataBanner( 17))&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?><?php echo $TPL_V1["tag"]?><?php }}?>

		<!-- 정기구독 -->
<?php if($GLOBALS["subscribe"]["use"]=='y'){?>
		<a href="javascript:void(0)" onClick="fnToggleTodayshopSubscribe();"><img src="/shop/data/skin_today/today/img/today_side_btn.gif"></a>
<?php }?>
		<!-- 정기구독 -->
	</div>
	<!-- 썸네일 나오는 부분끝 --------------->

	<!-- 정기구독 폼 -->
	<div id="todayshopSubscribe" style="z-index:1000;position:absolute;border:5px solid #3F3F3F;background:#FFFFFF;width:350px;height:270px;display:none;text-align:left;">
	<form name="frmSubscribe" method="post" action="<?php echo url("todayshop/indb.subscribe.php")?>&" target="ifrmHidden" onsubmit="return fnCheckSubscribe(this);">

		<table cellpadding="0" cellspacing="0" border="0">
		<tr>
			<td><img src="/shop/data/skin_today/today/img/img_today_email_pop_01.gif"></td>
			<td><a href="javascript:void(0)" onClick="fnToggleTodayshopSubscribe();"><img src="/shop/data/skin_today/today/img/img_today_email_pop_02.gif"></a></td>
		</tr>
		<tr>
			<td colspan="2"><img src="/shop/data/skin_today/today/img/img_today_email_pop_03.gif"></td>
		</tr>
		<tr>
			<td colspan="2" style="text-align:center;">

			<table width="320" style="background:#F5F5F5;width:320px;">
<?php if($GLOBALS["interest"]["use"]=='y'){?>

<?php if($GLOBALS["interest"]["subscribe"]== 1){?>
				<tr height="30">
					<td>관심분류</td>
					<td>
					<select name="interest_category">
					<option value=""> - 분류를 선택해 주세요 - </option>
<?php if($TPL_ts_category_all_1){foreach($TPL_VAR["ts_category_all"] as $TPL_V1){?>
					<option value="<?php echo $TPL_V1["category"]?>"><?php echo $TPL_V1["catnm"]?></option>
<?php }}?>
					</select>
					</td>
				</tr>
<?php }?>

<?php }?>

<?php if($GLOBALS["subscribe"]["email"]=='1'){?>
			<tr height="30">
				<td><input type="checkbox" name="ts_subscribe_email" value="1"/><img src="/shop/data/skin_today/today/img/img_today_email_pop_04.gif" align="absmiddle"></td>
				<td><input type="text" name="ts_subscribe_email_val" value="" style="border:1px solid #999999;height:20px;width:225px;" /></td>
			</tr>
<?php }?>

<?php if($GLOBALS["subscribe"]["sms"]=='1'){?>
			<tr height="30">
				<td><input type="checkbox" name="ts_subscribe_sms" value="1"/><img src="/shop/data/skin_today/today/img/img_today_email_pop_05.gif" align="absmiddle"></td>
				<td><input type="text" name="ts_subscribe_sms_val" value="" style="border:1px solid #999999;height:20px;width:225px;" /></td>
			</tr>
<?php }?>
			</table>

			<p class="agree">
				<label><input type="checkbox" name="subscribe_agree" value="1"> 구독 신청 하는 이메일/핸드폰 정보를 수집하는데 동의 합니다.</label>
				수집되는 이메일/ 핸드폰 정보는 상품정보 발송시 사용됩니다.
			</p>


			<div style="margin: 10px 0 15px 0;">
			<input type="image" src="/shop/data/skin_today/today/img/img_today_email_pop_06.gif" />
			</div>

			</td>
		</tr>
		</table>
	</form>
	</div>
	<!-- 정기구독 폼 -->

<?php if($TPL_VAR["extra_header"]!=''){?>
	<div class="extra_header">
	<?php echo $TPL_VAR["extra_header"]?>

	</div>
<?php }?>

	<table cellpadding=0 cellspacing=0 border=0 class="goodsBlock">
	<tr>
		<!--- 이미지 나오는 부분시작------------->
		<td class="imageBlock">
			<div class="mainImgOuter" <?php if($TPL_VAR["showtimer"]=='y'){?>style="margin-bottom;"<?php }?>>
				<div id="goodsMainImg">
<?php if($TPL_r_img_1){$TPL_I1=-1;foreach($TPL_VAR["r_img"] as $TPL_V1){$TPL_I1++;?>
<?php if($TPL_I1== 0){?><?php echo goodsimgTS($TPL_V1, 573)?>

<?php }else{?><?php echo goodsimgTS($TPL_V1, 573,'style="display:none;"')?>

<?php }?>
<?php }}?>
				</div>
<?php if(count($TPL_VAR["r_img"])> 1){?>
				<div id="goodsMainImgNum">
<?php if($TPL_r_img_1){$TPL_I1=-1;foreach($TPL_VAR["r_img"] as $TPL_V1){$TPL_I1++;?>
					<span onmouseover="MainImage.show(<?php echo $TPL_I1?>)">
<?php if($TPL_I1== 0){?><img src="/shop/data/skin_today/today/img/no_onbtn<?php echo $TPL_I1+ 1?>.gif" />
<?php }else{?><img src="/shop/data/skin_today/today/img/no_btn<?php echo $TPL_I1+ 1?>.gif" />
<?php }?>
					</span>
<?php }}?>
				</div>
<?php }?>
			</div>
<?php if($TPL_VAR["showtimer"]=='y'){?><div id="timerBlock"></div><?php }?>
		</td>
		<!--- 이미지 나오는 부분  끝------------->
		<!--- 가격 나오는 부분 시작-------------->
		<td class="infoBlock" id="infoBlock">
			<div id="loadingInfo"><img src="/shop/data/skin_today/today/img/throbber.gif" /></div>
			<form name=frmView method=post onsubmit="return false">
			<input type=hidden name=mode value="addItem">
			<input type=hidden name=goodsno value="<?php echo $TPL_VAR["goodsno"]?>">
			<ul class="goodsnm">
				<li><?php echo $TPL_VAR["goodsnm"]?></li>
			</ul>
			<div class="splitbar"></div>
			<ul class="consumer">
				<li class="lbox"><img src="/shop/data/skin_today/today/img/pro_01.gif" border="0"></li>
				<li class="rbox"><span id="consumer"></span><span class="won">원</span></li>
			</ul>
			<ul class="price">
				<li class="lbox"><img src='/shop/data/skin_today/today/img/pro_02.gif' border="0"></li>
				<li class="rbox">
					<div><span id="price"></span><span class="won">원</span></div>
<?php if($TPL_VAR["showpercent"]=='y'){?>
					<div class="salepct"><span id="salepct" class="num"></span><span class="unit">%</span></div>
<?php }?>
				</li>
			</ul>
<?php if($TPL_VAR["showstock"]=='y'){?>
			<ul id="stockBlock">
				<li class="lbox"><img src='/shop/data/skin_today/today/img/pro_03.gif' border="0"></li>
				<li class='rbox'><span id="stock"></span>개</li>
			</ul>
<?php }?>
			<!-- 옵션 일체형 && 추가옵션 -->
			<ul id="optBlock" <?php if(!$GLOBALS["addopt"]){?>style="display:none;"<?php }?>>
				<li class="lbox"><img src='/shop/data/skin_today/today/img/pro_04.gif' border="0"></li>
				<li class="rbox">
					<div id="option"></div>
<?php if($TPL__addopt_1){$TPL_I1=-1;foreach($GLOBALS["addopt"] as $TPL_K1=>$TPL_V1){$TPL_I1++;?>
					<div>
						<select name="addopt[]" <?php if($GLOBALS["addoptreq"][$TPL_I1]){?> required label="<?php echo $TPL_K1?>"<?php }?>>
							<option value="">==<?php echo $TPL_K1?> 선택==</option>
<?php if(is_array($TPL_R2=$TPL_V1)&&!empty($TPL_R2)){foreach($TPL_R2 as $TPL_V2){?>
							<option value="<?php echo $TPL_V2["sno"]?>^<?php echo $TPL_K1?>^<?php echo $TPL_V2["opt"]?>^<?php echo $TPL_V2["addprice"]?>^<?php echo $TPL_V2["addno"]?>"><?php echo $TPL_V2["opt"]?>

<?php if($TPL_V2["addprice"]){?>(<?php echo number_format($TPL_V2["addprice"])?>원 추가)<?php }?>
							</option>
<?php }}?>
						</select>
					</div>
<?php }}?>
				</li>
			</ul>
			<!-- 옵션 일체형 && 추가옵션 -->
			<!--구매수량-->
			<ul id="eaBlock">
				<li class="lbox"><img src='/shop/data/skin_today/today/img/pro_05.gif' border="0"></li>
				<li class="rbox">
					<div class="eaBox"><input type="text" name="ea" size="2" value="<?php echo $TPL_VAR["default_ea"]?>" class="line" onchange="chk_ea()"></div>
					<div class="eaBtn">
						<div class="upBtn"><img src="/shop/data/skin_today/today/img/btn_plus.gif" onClick="chg_cart_ea(frmView.ea,'up'); chk_ea();"></div>
						<div><img src="/shop/data/skin_today/today/img/btn_minus.gif" onClick="chg_cart_ea(frmView.ea,'dn'); chk_ea();"></div>
					</div>
					<div class="eaLabel">개</div>
				</li>
			</ul>
			<!--구매수량-->
			<div class="splitbar"></div>
<?php if($TPL_VAR["limit_ea"]> 0||$TPL_VAR["showbuyercnt"]=='y'){?>
			<div id="limitBlock">
				<div class="buyercntBox"><span id="buyercnt"></span>명 구매</div>
<?php if($TPL_VAR["limit_ea"]> 0){?>
				<div class="buyerbarBox">
					<div><img id="buyericon" src="/shop/data/skin_today/today/img/today_people.gif" /></div>
					<div class="buyerbarbg">
						<div id="buyerbar"><img src="/shop/data/skin_today/today/img/today_baron.gif" /></div>
					</div>
					<div class="buyernumBox"><div class="leftnum">0</div><div id="limitEa"><?php echo $TPL_VAR["limit_ea"]?></div></div>
				</div>
<?php }?>
			</div>
			<div class="splitbar"></div>
<?php }?>
			<!--구매하기 버튼-->
			<div id="buybtnBlock"></div>
			<!--구매하기 버튼-->
			<!--소셜 버튼-->
			<ul>
				<li>
					<img src='/shop/data/skin_today/today/img/bn_friend.gif' border="0" style="margin-left:10px;">
					<a href='<?php echo $TPL_VAR["snspost"]["twitter"]?>' target="_blank"><img src='/shop/data/skin_today/today/img/bn_t.gif' border="0"></a>
					<a href='<?php echo $TPL_VAR["snspost"]["facebook"]?>' target="_blank"><img src='/shop/data/skin_today/today/img/bn_f.gif' border="0"></a>
					<a href='<?php echo $TPL_VAR["snspost"]["me2day"]?>' target="_blank"><img src='/shop/data/skin_today/today/img/bn_t-26.gif' border="0"></a>
					<span id="smsBlock"><a onclick="sendSms(<?php echo $TPL_VAR["tgsno"]?>)"><img src='/shop/data/skin_today/today/img/bn_sms.gif' border="0"></a></span>
				</li>
			</ul>
			<!--소셜 버튼-->
			</form>
		</td>
		<!--- 가격 나오는 부분 끝-------------->
	</tr>
	</table>
</div>

<!-- 상품이미지 / 내용 / 결재 끝-------------------------------------->

<div class="desc">
	<div class="descBox">
		<div class="menutab">
			<a onclick="showTab(1)"><img id="tab1" src='/shop/data/skin_today/today/img/tep_detailon.gif' border="0"></a><span id="todaytalkTab"><a onclick="showTab(2)"><img id="tab2" src='/shop/data/skin_today/today/img/tep_talkoff.gif' border="0"></a></span>
		</div>
		<div id="desc">
			<?php echo $TPL_VAR["longdesc"]?>

		</div>
		<div id="desc2">
			<!-- 배송안내 -->
			<div><img src="/shop/data/skin_today/today/img/title_bntek.gif" /></div>
			<ul>
				<li>배송비 : 기본배송료는 <?php if($GLOBALS["set"]["delivery"]["default"]){?><?php echo number_format($GLOBALS["set"]["delivery"]["default"])?>원<?php }else{?>무료<?php }?> 입니다. (도서,산간,오지 일부지역은 배송비가 추가될 수 있습니다) <?php if($GLOBALS["set"]["delivery"]["free"]){?>&nbsp;<?php echo number_format($GLOBALS["set"]["delivery"]["free"])?>원 이상 구매시 무료배송입니다.<?php }?></li>
				<li>본 상품의 평균 배송일은 일입니다.(입금 확인 후) 설치 상품의 경우 다소 늦어질수 있습니다.[배송예정일은 주문시점(주문순서)에 따른 유동성이 발생하므로 평균 배송일과는 차이가 발생할 수 있습니다.]</li>
				<li>본 상품의 배송 가능일은 일 입니다. 배송 가능일이란 본 상품을 주문 하신 고객님들께 상품 배송이 가능한 기간을 의미합니다. (단, 연휴 및 공휴일은 기간 계산시 제외하며 현금 주문일 경우 입금일 기준 입니다.)</li>
			</ul>

			<!-- 교환및반품안내 -->
			<div><img src="/shop/data/skin_today/today/img/title_bnexchange.gif" /></div>
			<ul>
				<li>상품 청약철회 가능기간은 상품 수령일로 부터 일 이내 입니다.</li>
				<li>상품 택(tag)제거 또는 개봉으로 상품 가치 훼손 시에는 일 이내라도 교환 및 반품이 불가능합니다.</li>
				<li>저단가 상품, 일부 특가 상품은 고객 변심에 의한 교환, 반품은 고객께서 배송비를 부담하셔야 합니다(제품의 하자,배송오류는 제외)</li>
				<li>일부 상품은 신모델 출시, 부품가격 변동 등 제조사 사정으로 가격이 변동될 수 있습니다.</li>
				<li>신발의 경우, 실외에서 착화하였거나 사용흔적이 있는 경우에는 교환/반품 기간내라도 교환 및 반품이 불가능 합니다.</li>
				<li>수제화 중 개별 주문제작상품(굽높이,발볼,사이즈 변경)의 경우에는 제작완료, 인수 후에는 교환/반품기간내라도 교환 및 반품이 불가능 합니다. </li>
				<li>수입,명품 제품의 경우, 제품 및 본 상품의 박스 훼손, 분실 등으로 인한 상품 가치 훼손 시 교환 및 반품이 불가능 하오니, 양해 바랍니다.</li>
				<li>일부 특가 상품의 경우, 인수 후에는 제품 하자나 오배송의 경우를 제외한 고객님의 단순변심에 의한 교환, 반품이 불가능할 수 있사오니, 각 상품의 상품상세정보를 꼭 참조하십시오. </li>
			</ul>
		</div>
		<div id="todaytalkBlock">
			<iframe id="intalk" src="../todayshop/today_talk.php?tgsno=<?php echo $TPL_VAR["tgsno"]?>"scrolling="no" frameborder="0"></iframe>
		</div>
	</div>
</div>
<form name="frmEncor" action="<?php echo url("todayshop/indb.calendar.php")?>&" method="post" target="ifrmHidden">
<input type="hidden" name="tgsno" />
</form>
<script type="text/javascript">initGoods(); innerImgResize(890);</script>

<!--footer start-->
<!--삭제하지마세요.-->
<?php $this->print_("footer",$TPL_SCP,1);?>

<!--footer end-->