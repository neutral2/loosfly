<?php /* Template_ 2.2.7 2014/10/24 18:24:53 /www/loosfly_godo_co_kr/shop/data/skin/loosfly/goods/goods_view.htm 000057886 */  $this->include_("dataGoodsRelation");
if (is_array($GLOBALS["opt"])) $TPL__opt_1=count($GLOBALS["opt"]); else if (is_object($GLOBALS["opt"]) && in_array("Countable", class_implements($GLOBALS["opt"]))) $TPL__opt_1=$GLOBALS["opt"]->count();else $TPL__opt_1=0;
if (is_array($GLOBALS["opt1img"])) $TPL__opt1img_1=count($GLOBALS["opt1img"]); else if (is_object($GLOBALS["opt1img"]) && in_array("Countable", class_implements($GLOBALS["opt1img"]))) $TPL__opt1img_1=$GLOBALS["opt1img"]->count();else $TPL__opt1img_1=0;
if (is_array($TPL_VAR["t_img"])) $TPL_t_img_1=count($TPL_VAR["t_img"]); else if (is_object($TPL_VAR["t_img"]) && in_array("Countable", class_implements($TPL_VAR["t_img"]))) $TPL_t_img_1=$TPL_VAR["t_img"]->count();else $TPL_t_img_1=0;
if (is_array($TPL_VAR["ex"])) $TPL_ex_1=count($TPL_VAR["ex"]); else if (is_object($TPL_VAR["ex"]) && in_array("Countable", class_implements($TPL_VAR["ex"]))) $TPL_ex_1=$TPL_VAR["ex"]->count();else $TPL_ex_1=0;
if (is_array($GLOBALS["addopt_inputable"])) $TPL__addopt_inputable_1=count($GLOBALS["addopt_inputable"]); else if (is_object($GLOBALS["addopt_inputable"]) && in_array("Countable", class_implements($GLOBALS["addopt_inputable"]))) $TPL__addopt_inputable_1=$GLOBALS["addopt_inputable"]->count();else $TPL__addopt_inputable_1=0;
if (is_array($GLOBALS["optnm"])) $TPL__optnm_1=count($GLOBALS["optnm"]); else if (is_object($GLOBALS["optnm"]) && in_array("Countable", class_implements($GLOBALS["optnm"]))) $TPL__optnm_1=$GLOBALS["optnm"]->count();else $TPL__optnm_1=0;
if (is_array($GLOBALS["addopt"])) $TPL__addopt_1=count($GLOBALS["addopt"]); else if (is_object($GLOBALS["addopt"]) && in_array("Countable", class_implements($GLOBALS["addopt"]))) $TPL__addopt_1=$GLOBALS["addopt"]->count();else $TPL__addopt_1=0;?>
<?php $this->print_("header",$TPL_SCP,1);?>

<script src="/shop/lib/js/countdown.js"></script>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ko_KR/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<script>
	function resizeFrameHeight(onm,height) {
		document.getElementById(onm).height = height;
	}
	
	function resizeFrameWidth(onm,width) {
		document.getElementById(onm).width = width;
	}

	var price = new Array();
	var reserve = new Array();
	var consumer = new Array();
	var memberdc = new Array();
	var realprice = new Array();
	var couponprice = new Array();
	var special_discount_amount = new Array();
	var coupon = new Array();
	var cemoney = new Array();
	var opt1img = new Array();
	var opt2icon = new Array();
	var opt2kind = "<?php echo $TPL_VAR["optkind"][ 1]?>";
	var oldborder = "";
<?php if($TPL__opt_1){$TPL_I1=-1;foreach($GLOBALS["opt"] as $TPL_V1){$TPL_I1++;?>
<?php if((is_array($TPL_R2=$TPL_V1)&&!empty($TPL_R2)) || (is_object($TPL_R2) && in_array("Countable", class_implements($TPL_R2)) && $TPL_R2->count() > 0)) {$TPL_I2=-1;foreach($TPL_R2 as $TPL_V2){$TPL_I2++;?>
<?php if($TPL_I1== 0&&$TPL_I2== 0){?>
			var fkey = '<?php echo get_js_compatible_key($TPL_V2["opt1"])?><?php if($TPL_V2["opt2"]){?>|<?php echo get_js_compatible_key($TPL_V2["opt2"])?><?php }?>';
<?php }?>
			price['<?php echo get_js_compatible_key($TPL_V2["opt1"])?><?php if($TPL_V2["opt2"]){?>|<?php echo get_js_compatible_key($TPL_V2["opt2"])?><?php }?>'] = <?php echo $TPL_V2["price"]?>;
			reserve['<?php echo get_js_compatible_key($TPL_V2["opt1"])?><?php if($TPL_V2["opt2"]){?>|<?php echo get_js_compatible_key($TPL_V2["opt2"])?><?php }?>'] = <?php echo $TPL_V2["reserve"]?>;
			consumer['<?php echo get_js_compatible_key($TPL_V2["opt1"])?><?php if($TPL_V2["opt2"]){?>|<?php echo get_js_compatible_key($TPL_V2["opt2"])?><?php }?>'] = <?php echo $TPL_V2["consumer"]?>;
			memberdc['<?php echo get_js_compatible_key($TPL_V2["opt1"])?><?php if($TPL_V2["opt2"]){?>|<?php echo get_js_compatible_key($TPL_V2["opt2"])?><?php }?>'] = <?php echo $TPL_V2["memberdc"]?>;
			realprice['<?php echo get_js_compatible_key($TPL_V2["opt1"])?><?php if($TPL_V2["opt2"]){?>|<?php echo get_js_compatible_key($TPL_V2["opt2"])?><?php }?>'] = <?php echo $TPL_V2["realprice"]?>;
			coupon['<?php echo get_js_compatible_key($TPL_V2["opt1"])?><?php if($TPL_V2["opt2"]){?>|<?php echo get_js_compatible_key($TPL_V2["opt2"])?><?php }?>'] = <?php echo $TPL_V2["coupon"]?>;
			couponprice['<?php echo get_js_compatible_key($TPL_V2["opt1"])?><?php if($TPL_V2["opt2"]){?>|<?php echo get_js_compatible_key($TPL_V2["opt2"])?><?php }?>'] = <?php echo $TPL_V2["couponprice"]?>;
			cemoney['<?php echo get_js_compatible_key($TPL_V2["opt1"])?><?php if($TPL_V2["opt2"]){?>|<?php echo get_js_compatible_key($TPL_V2["opt2"])?><?php }?>'] = <?php echo $TPL_V2["coupon_emoney"]?>;
			special_discount_amount['<?php echo get_js_compatible_key($TPL_V2["opt1"])?><?php if($TPL_V2["opt2"]){?>|<?php echo get_js_compatible_key($TPL_V2["opt2"])?><?php }?>'] = <?php echo $TPL_V2["special_discount_amount"]?>;
<?php }}?>
<?php }}?>

<?php if($TPL__opt1img_1){foreach($GLOBALS["opt1img"] as $TPL_K1=>$TPL_V1){?>
	opt1img['<?php echo $TPL_K1?>'] = "<?php echo $TPL_V1?>";
<?php }}?>

<?php if((is_array($TPL_R1=$GLOBALS["opticon"][ 1])&&!empty($TPL_R1)) || (is_object($TPL_R1) && in_array("Countable", class_implements($TPL_R1)) && $TPL_R1->count() > 0)) {foreach($TPL_R1 as $TPL_K1=>$TPL_V1){?>
	opt2icon['<?php echo $TPL_K1?>'] = "<?php echo $TPL_V1?>";
<?php }}?>



/* 필수 옵션 분리형 스크립트 start */
	var opt = new Array();
	opt[0] = new Array("('1차옵션을 먼저 선택해주세요','')");
<?php if($TPL__opt_1){$TPL_I1=-1;foreach($GLOBALS["opt"] as $TPL_V1){$TPL_I1++;?>
	opt['<?php echo $TPL_I1+ 1?>'] = new Array("('== 옵션선택 ==','')",<?php if((is_array($TPL_R2=$TPL_V1)&&!empty($TPL_R2)) || (is_object($TPL_R2) && in_array("Countable", class_implements($TPL_R2)) && $TPL_R2->count() > 0)) {$TPL_S2=count($TPL_R2);$TPL_I2=-1;foreach($TPL_R2 as $TPL_V2){$TPL_I2++;?>"('<?php echo $TPL_V2["opt2"]?><?php if($TPL_V2["price"]!=$TPL_VAR["price"]){?> (<?php echo number_format($TPL_V2["price"])?>원)<?php }?><?php if($TPL_VAR["usestock"]&&!$TPL_V2["stock"]){?> [품절]<?php }?>','<?php echo $TPL_V2["opt2"]?>','<?php if($TPL_VAR["usestock"]&&!$TPL_V2["stock"]){?>soldout<?php }?>')"<?php if($TPL_I2!=$TPL_S2- 1){?>,<?php }?><?php }}?>);
<?php }}?>

	function subOption(obj)
	{
		var el = document.getElementsByName('opt[]');
		var sub = opt[obj.selectedIndex];
		while (el[1].length>0) el[1].options[el[1].options.length-1] = null;
		for (i=0;i<sub.length;i++){
			var div = sub[i].replace("')","").split("','");
			eval("el[1].options[i] = new Option" + sub[i]);
			if (div[2]=="soldout"){
				el[1].options[i].style.color = "#808080";
				el[1].options[i].setAttribute('disabled','disabled');
			}
		}
		el[1].selectedIndex = el[1].preSelIndex = 0;
		if (el[0].selectedIndex == 0) chkOption(el[1]);
	
		if(el[0].selectedIndex != '0'){
			var txt = document.getElementsByName('opt_txt[]');
			var vidx = el[0].selectedIndex - 1;
			var v = el[0][el[0].selectedIndex].value;
			txt[0].value = v + '|' + vidx;
			subOption_fashion();
		}
	}
/* 필수 옵션 분리형 스크립트 end */

	function chkOptimg(){
		var opt = document.getElementsByName('opt[]');
		var key = opt[0].selectedIndex;
		var opt1 = opt[0][key].value;
		var ropt = opt1.split('|');
		chgOptimg(ropt[0])
	}
	
	function chgOptimg(opt1){
		if(opt1img[opt1]){
			objImg.src = (/^http(s)?:\/\//.test(opt1img[opt1])) ? opt1img[opt1] : "../data/goods/"+opt1img[opt1];
		}else{
			objImg.src = (/^http(s)?:\/\//.test('<?php echo $TPL_VAR["r_img"][ 0]?>')) ? '<?php echo $TPL_VAR["r_img"][ 0]?>' : "../data/goods/<?php echo $TPL_VAR["r_img"][ 0]?>";
		}
	}

	function chkOption(obj){
		if (!selectDisabled(obj)) return false;
	}
	
	function act(target){
		var form = document.frmView;
		form.action = target + ".php";
	
		var opt_cnt = 0, data;
	
		nsGodo_MultiOption.clearField();
	
		for (var k in nsGodo_MultiOption.data) {
			data = nsGodo_MultiOption.data[k];
			if (data && typeof data == 'object') {
				nsGodo_MultiOption.addField(data, opt_cnt);
				opt_cnt++;
			}
		}
	
		if (opt_cnt > 0) {
	
			form.submit();
		}
		else {
			if (chkGoodsForm(form)) form.submit();
		}
	
		return;
	}

	function chgImg(obj){
		var objImg = document.getElementById('objImg');
		if (obj.getAttribute("ssrc")) objImg.src = obj.src.replace(/\/t\/[^$]*$/g, '/')+obj.getAttribute("ssrc");
		else objImg.src = obj.src.replace("/t/","/");
<?php if($TPL_VAR["detailView"]=='y'){?>
		// 디테일뷰 추가내용 2010.11.09
		if (obj.getAttribute("lsrc")) objImg.setAttribute("lsrc", obj.src.replace(/\/t\/[^$]*$/g, '/')+obj.getAttribute("lsrc"));
		else objImg.setAttribute("lsrc", obj.getAttribute("src").replace("/t/", "/").replace("_sc.", '.'));
		ImageScope.setImage(objImg, beforeScope, afterScope);
		// 디테일뷰 추가내용 2010.11.09
<?php }?>
	}

	function innerImgResize()	{ // 본문 이미지 크기 리사이징
		var objContents = document.getElementById('contents');
		var innerWidth = 645;
		var img = objContents.getElementsByTagName('img');
		for (var i=0;i<img.length;i++){
			img[i].onload = function(){
				if (this.width>innerWidth) this.width = innerWidth;
			};
		}
	}

<?php if($TPL_VAR["detailView"]=='y'){?>
	// 디테일뷰 추가내용 2010.11.09
	function beforeScope() {
		document.getElementsByName("frmView")[0].style.visibility = "hidden";
	}
	
	function afterScope() {
		document.getElementsByName("frmView")[0].style.visibility = "visible";
	}
	// 디테일뷰 추가내용 2010.11.09
<?php }?>

<?php if($TPL_VAR["naverNcash"]=='Y'){?>
	function mileage_info() {
	window.open("http://static.mileage.naver.net/static/20130708/ext/intro.html", "mileageIntroPopup", "width=404, height=412, status=no, resizable=no");
	}
<?php }?>

	function qr_explain(){
		var qrExplainObj = document.getElementById("qrExplain");
	
		qrExplainObj.style.top = event.clientY + document.body.scrollTop - 15;
		qrExplainObj.style.left = event.clientX + document.body.scrollLeft + 40;
		qrExplainObj.style.display = "block";
	}
	
	function qrExplain_close(){
		var qrExplainObj = document.getElementById("qrExplain");
		qrExplainObj.style.display = "none";
	}
</script>

<script language="javascript">
// 패션 기능관련 스크립트
	function click_opt_fastion(idx,vidx,v){
		var el = document.getElementsByName('opt_txt[]');
		el[idx].value = v + '|' + vidx;
	
		if(idx == 0){
			var obj = document.getElementsByName('opt[]')[0];
			obj.selectedIndex = parseInt(vidx)+1 ;
			subOption(obj);
			chkOptimg();
		}else if(idx == 1){
			var obj = document.getElementsByName('opt[]')[1];
			obj.selectedIndex = vidx;
			chkOption(obj);
		}
	}

	function subOption_fashion(){
		var el = document.getElementsByName('opt_txt[]');
		var el2 = document.getElementById('dtdopt2');
		var idx = el[0].value.split("|");
		var vidx = parseInt(idx[1])+1;
		var sub = opt[vidx];
		if(el2)el2.innerHTML = '';
		var n = 1;
		for (i=0;i<sub.length;i++){
			var div = sub[i].replace("')","").split("','");
			if(div[1]){
				if(opt2kind == 'img'){
					if(el2)el2.innerHTML += "<div style='width:43px;float:left;padding:5 0 5 0'><a href=\"javascript:click_opt_fastion('1','"+i+"','"+div[1]+"');nsGodo_MultiOption.set();\" name='icon2[]'><img id='opticon1_"+i+"' width='40' src='../data/goods/"+opt2icon[div[1]]+"' style='border:1px #cccccc solid' onmouseover=\"onicon(this);\" onmouseout=\"outicon(this)\" onclick=\"clicon(this)\"></a></div>";
				}else{
					if(el2)el2.innerHTML += "<div style='width:18px;float:left;padding-top:5px'><a href=\"javascript:click_opt_fastion('1','"+i+"','"+div[1]+"');subOption_fashion();nsGodo_MultiOption.set();\" name='icon2[]'><span style=\"float:left;width:15;height:15;border:1px #cccccc solid;background-color:#"+opt2icon[div[1]]+"\" onmouseover=\"onicon(this);\" onmouseout=\"outicon(this)\" onclick=\"clicon(this)\"></span></a></div>";
				}
			}else n++;
		}
	}

	function onicon(obj){
		oldborder = obj.style.border;
		obj.style.border="1 #333333 solid";
	}
	function outicon(obj){
		obj.style.border = oldborder;
	}

	function clicon(obj){
		var p = obj.parentNode.name;
		var ac = document.getElementsByName(p);
		if(ac){
			for(var i=0;i<ac.length;i++){
				ac[i].childNodes[0].style.border = "1 #cccccc solid";
			}
			obj.style.border="1 #333333 solid";
			oldborder="1 #333333 solid";
		}
	}

	function selicon(obj){
		var el = document.getElementsByName('opt[]');
		var idx = obj.selectedIndex - 1;
		if(obj == el[0]){
			var v = document.getElementsByName('icon[]');
			if (v.length > 0) {
				v = v[idx].childNodes[0];
				clicon(v);
			}
	
		}else{
			var v = document.getElementsByName('icon2[]');
			if (v.length > 0) {
				v = v[idx].childNodes[0];
				clicon(v);
			}
		}
	}

	function cp_explain(obj){
		var cp_explainObj = document.getElementById("cp_explain" + obj);
		cp_explainObj.style.top = event.clientY + document.body.scrollTop;
		cp_explainObj.style.left = event.clientX + document.body.scrollLeft ;
		cp_explainObj.style.display = "block";
	}
	
	function cp_explain_close(obj){
		var cp_explainObj = document.getElementById("cp_explain"+ obj);
		cp_explainObj.style.display = "none";
	}
	
	function fnRequestStockedNoti(goodsno) {
		window.open('./popup_request_stocked_noti.php?goodsno='+goodsno,360,230, 'scrollbars=no');
	}
	
	function fnPreviewGoods_(goodsno) {
		popup('../goods/goods_view.php?goodsno='+goodsno+'&preview=y','800','450');
	}
	
	function fnGodoTooltipShow_(obj) {
	
		var tooltip = document.getElementById('el-godo-tooltip-related');
		tooltip.innerText = obj.getAttribute('tooltip');
	
		var pos_x = event.clientX + document.body.scrollLeft + document.documentElement.scrollLeft;
		var pos_y = event.clientY + document.body.scrollTop + document.documentElement.scrollTop;
	
		tooltip.style.top = (pos_y + 10) + 'px';
		tooltip.style.left = (pos_x + 10) + 'px';
		tooltip.style.display = 'block';
	}

	function fnGodoTooltipHide_(obj) {
		var tooltip = document.getElementById('el-godo-tooltip-related');
		tooltip.innerText = '';
		tooltip.style.display = 'none';
	}

var nsGodo_MultiOption = function() {
	function size(e) {

		var cnt = 0;
		var type = '';

		for (var i in e) {
			cnt++;
		}

		return cnt;
	}

	return {
		_soldout : <?php if($TPL_VAR["runout"]){?>true<?php }else{?>false<?php }?>,
		data : [],
		data_size : 0,
		_optJoin : function(opt) {

			var a = [];

			for (var i=0,m=opt.length;i<m ;i++) {
				if (typeof opt[i] != 'undefined' && opt[i] != '') {
					a.push(opt[i]);
				}
			}

			return a.join(' / ');

		},
		getFieldTag : function (name, value) {
			var el = document.createElement('input');
			el.type = "hidden";
			el.name = name;
			el.value = value;

			return el;

		},
		clearField : function() {

			var form = document.getElementsByName('frmView')[0];

			var el;

			for (var i=0,m=form.elements.length;i<m ;i++) {
				el = form.elements[i];

				if (typeof el == 'undefined' || el.tagName == "FIELDSET") continue;

				if (/^multi\_.+/.test(el.name)) {
					el.parentNode.removeChild(el);
					i--;
				}

			}

		},
		addField : function(obj, idx) {

			var _tag;
			var form = document.getElementsByName('frmView')[0];

			for(var k in obj) {

				if (typeof obj[k] == 'undefined' || typeof obj[k] == 'function' || (k != 'opt' && k != 'addopt' && k != 'ea' && k != 'addopt_inputable')) continue;

				switch (k) {
					case 'ea':
						_tag = this.getFieldTag('multi_'+ k +'['+idx+']', obj[k]);
						form.appendChild(_tag);

						break;
					case 'addopt_inputable':
					case 'opt':
					case 'addopt':
						//hasOwnProperty
						for(var k2 in obj[k]) {
							if (typeof obj[k][k2] == 'function') continue;
							_tag = this.getFieldTag('multi_'+ k +'['+idx+'][]', obj[k][k2]);
							form.appendChild(_tag);
						}

						break;
					default :
						continue;
						break;
				}
			}
		},
		set : function() {

			var add = true;

			// 선택 옵션
			var opt = document.getElementsByName('opt[]');
			for (var i=0,m=opt.length;i<m ;i++ ) {
				if (typeof(opt[i])!="undefined") {
					if (opt[i].value == '') add = false;
				}
			}

			// 추가 옵션?
			var addopt = document.getElementsByName('addopt[]');
			for (var i=0,m=addopt.length;i<m ;i++ ) {
				if (typeof(addopt[i])!="undefined") {
					if (addopt[i].value == '' /*&& addopt[i].getAttribute('required') != null*/) add = false;
				}
			}

			// 입력 옵션은 이곳에서 체크 하지 않는다.
			if (add == true) {
				this.add();
			}
		},
		del : function(key) {

			this.data[key] = null;
			var tr = document.getElementById(key);
			tr.parentNode.removeChild(tr);
			this.data_size--;

			// 총 금액
			this.totPrice();
			move_banner();
		},
		add : function() {

			var self = this;

			if (self._soldout) {
				alert("품절된 상품입니다.");
				return;
			}

			var form = document.frmView;
			if(!(form.ea.value>0)) {
				alert("구매수량은 1개 이상만 가능합니다");
				return;
			}
			else
			{
				try
				{
					var step = form.ea.getAttribute('step');
					if (form.ea.value % step > 0) {
						alert('구매수량은 '+ step +'개 단위로만 가능합니다.');
						return;
					}
				}
				catch (e)
				{}
			}

			if (chkGoodsForm(form)) {

				var _data = {};

				_data.ea = document.frmView.ea.value;
				_data.sales_unit = document.frmView.ea.getAttribute('step') || 1;
				_data.opt = new Array;
				_data.addopt = new Array;
				_data.addopt_inputable = new Array;

				// 기본 옵션
				var opt = document.getElementsByName('opt[]');
				
				if (opt.length > 0) {

					_data.opt[0] = opt[0].value;
					_data.opt[1] = '';
					if (typeof(opt[1]) != "undefined") _data.opt[1] = opt[1].value;

					var key = _data.opt[0] + (_data.opt[1] != '' ? '|' + _data.opt[1] : '');

					// 가격
					if (opt[0].selectedIndex == 0) key = fkey;
					key = self.get_key(key);	// get_js_compatible_key 참고
				
					if (typeof(price[key])!="undefined") {

						_data.price = price[key];
						_data.reserve = reserve[key];
						_data.consumer = consumer[key];
						_data.realprice = realprice[key];
						_data.couponprice = couponprice[key];
						_data.coupon = coupon[key];
						_data.cemoney = cemoney[key];
						_data.memberdc = memberdc[key];
						_data.special_discount_amount = special_discount_amount[key];
					}
					else {
						// @todo : 메시지 정리
						alert('추가할 수 없음.');
						return;
					}

				}
				else {
					// 옵션이 없는 경우(or 추가 옵션만 있는 경우) 이므로 멀티 옵션 선택은 불가.
					return;
				}

				// 추가 옵션
				var addopt = document.getElementsByName('addopt[]');
				for (var i=0,m=addopt.length;i<m ;i++ ) {

					if (typeof addopt[i] == 'object') {
						_data.addopt.push(addopt[i].value);
					}

				}

				// 입력 옵션
				var addopt_inputable = document.getElementsByName('addopt_inputable[]');
				for (var i=0,m=addopt_inputable.length;i<m ;i++ ) {

					if (typeof addopt_inputable[i] == 'object') {
						var v = addopt_inputable[i].value.trim();
						if (v) {
							var tmp = addopt_inputable[i].getAttribute("option-value").split('^');
							tmp[2] = v;
							_data.addopt_inputable.push(tmp.join('^'));
						}

						// 필드값 초기화
						addopt_inputable[i].value = '';

					}

				}

				// 이미 추가된 옵션인지
				if (self.data[key] != null) {
					alert('이미 추가된 옵션입니다.');
					return false;
				}

				// 옵션 박스 초기화
				for (var i=0,m=addopt.length;i<m ;i++ ) {
					if (typeof addopt[i] == 'object') {
						addopt[i].selectedIndex = 0;
					}
				}
				//opt[0].selectedIndex = 0;
				//subOption(opt[0]);

				document.getElementById('el-multi-option-display').style.display = 'block';

				// 행 추가
				var childs = document.getElementById('el-multi-option-display').childNodes;
				for (var k in childs) {
					if (childs[k].tagName == 'TABLE') {
						var table = childs[k];
						break;
					}
				}

				var td, tr = table.insertRow(0);
				var html = '';

				tr.id = key;

				// 입력 옵션명
				td = tr.insertCell(-1);
				html = '<div style="font-size:11px;color:#010101;padding:3px 0 0 8px;">';
				var tmp,tmp_addopt = [];
				for (var i=0,m=_data.addopt_inputable.length;i<m ;i++ )
				{
					tmp = _data.addopt_inputable[i].split('^');
					if (tmp[2]) tmp_addopt.push(tmp[2]);
				}
				html += self._optJoin(tmp_addopt);
				html += '</div>';

				// 옵션명
				html += '<div style="font-size:11px;color:#010101;padding:3px 0 0 8px;">';
				td.style.cssText = 'padding-left:25px;text-align:left;width:100px;';
				html = '<div style="font-size:11px;color:#010101;">';
				html += self._optJoin(_data.opt);
				html += '</div>';

				// 추가 옵션명
				html += '<div style="font-size:11px;color:#A0A0A0;">';
				var tmp,tmp_addopt = [];
				for (var i=0,m=_data.addopt.length;i<m ;i++ )
				{
					tmp = _data.addopt[i].split('^');
					if (tmp[2]) tmp_addopt.push(tmp[2]);
				}
				html += self._optJoin(tmp_addopt);
				html += '</div>';
				td.innerHTML = html;

				// 수량
				td = tr.insertCell(-1);
				td.style.cssText = 'text-align:left;width:80px;';
				html = '';
				html += '<div style="float:left;"><input type=text name=_multi_ea[] id="el-ea-'+key+'" size=2 value='+ _data.ea +' style="border:1px solid #D3D3D3;width:30px;text-align:right;height:20px" onblur="nsGodo_MultiOption.ea(\'set\',\''+key+'\',this.value);"></div>';
				html += '<div style="float:left;padding-left:3px">';
				html += '<div style="padding:1px 0 2px 0"><img src="/shop/data/skin/loosfly/img/common/btn_multioption_ea_up.gif" onClick="nsGodo_MultiOption.ea(\'up\',\''+key+'\');" style="cursor:pointer"></div>';
				html += '<div><img src="/shop/data/skin/loosfly/img/common/btn_multioption_ea_down.gif" onClick="nsGodo_MultiOption.ea(\'down\',\''+key+'\');" style="cursor:pointer"></div>';
				html += '</div>';
				td.innerHTML = html;

				// 옵션가격
				_data.opt_price = _data.price;
				for (var i=0,m=_data.addopt.length;i<m ;i++ )
				{
					tmp = _data.addopt[i].split('^');
					if (tmp[3]) _data.opt_price = _data.opt_price + parseInt(tmp[3]);
				}
				for (var i=0,m=_data.addopt_inputable.length;i<m ;i++ )
				{
					tmp = _data.addopt_inputable[i].split('^');
					if (tmp[3]) _data.opt_price = _data.opt_price + parseInt(tmp[3]);
				}
				td = tr.insertCell(-1);
				td.style.cssText = 'padding-right:10px;width:110px;text-align:right;font-weight:bold;color:#6A6A6A;vertical-align:middle;';
				html = '';
				html += '<span id="el-price-'+key+'">'+comma( _data.opt_price *  _data.ea) + '원</span>';
				html += '<a href="javascript:void(0);" onClick="nsGodo_MultiOption.del(\''+key+'\');return false;"><img src="/shop/data/skin/loosfly/img/common/btn_multioption_del.gif"></a>';
				td.innerHTML = html;

				self.data[key] = _data;
				self.data_size++;

				// 총 금액
				self.totPrice();

			}
			move_banner();
		},
		ea : function(dir, key,val) {	// up, down

			var min_ea = 0, max_ea = 0, remainder = 0;

			if (document.frmView.min_ea) min_ea = parseInt(document.frmView.min_ea.value);
			if (document.frmView.max_ea) max_ea = parseInt(document.frmView.max_ea.value);

			if (dir == 'up') {
				this.data[key].ea = (max_ea != 0 && max_ea <= this.data[key].ea) ? max_ea : parseInt(this.data[key].ea) + parseInt(this.data[key].sales_unit);
			}
			else if (dir == 'down')
			{
				if ((parseInt(this.data[key].ea) - 1) > 0)
				{
					this.data[key].ea = (min_ea != 0 && min_ea >= this.data[key].ea) ? min_ea : parseInt(this.data[key].ea) - parseInt(this.data[key].sales_unit);
				}

			}
			else if (dir == 'set') {

				if (val && !isNaN(val))
				{
					val = parseInt(val);

					if (max_ea != 0 && val > max_ea)
					{
						val = max_ea;
					}
					else if (min_ea != 0 && val < min_ea) {
						val = min_ea;
					}
					else if (val < 1)
					{
						val = parseInt(this.data[key].sales_unit);
					}

					remainder = val % parseInt(this.data[key].sales_unit);

					if (remainder > 0) {
						val = val - remainder;
					}

					this.data[key].ea = val;

				}
				else {
					alert('수량은 1 이상의 숫자로만 입력해 주세요.');
					return;
				}
			}

			document.getElementById('el-ea-'+key).value = this.data[key].ea;
			document.getElementById('el-price-'+key).innerText = comma(this.data[key].ea * this.data[key].opt_price) + '원';

			// 총금액
			this.totPrice();

		},
		totPrice : function() {
			var self = this;
			var totprice = 0;
			for (var i in self.data)
			{
				if (self.data[i] !== null && typeof self.data[i] == 'object') totprice += self.data[i].opt_price * self.data[i].ea;
			}
			if( totprice == 0 ) document.getElementById('el-multi-option-display').style.display = 'none';
			document.getElementById('el-multi-option-total-price').innerText = comma(totprice) + '원';
		},
		get_key : function(str) {

			str = str.replace(/&/g, "&amp;").replace(/\"/g,'&quot;').replace(/</g,'&lt;').replace(/>/g,'&gt;');

			var _key = "";

			for (var i=0,m=str.length;i<m;i++) {
				_key += str.charAt(i) != '|' ? str.charCodeAt(i) : '|';
			}

			return _key.toUpperCase();
		}
	}
}();

function chkGoodsForm(form) {

	if (form.min_ea)
	{
		if (parseInt(form.ea.value) < parseInt(form.min_ea.value))
		{
			alert('최소구매수량은 ' + form.min_ea.value+'개 입니다.');
			return false;
		}
	}

	if (form.max_ea)
	{
		if (parseInt(form.ea.value) > parseInt(form.max_ea.value))
		{
			alert('최대구매수량은 ' + form.max_ea.value+'개 입니다.');
			return false;
		}
	}

	try
	{
		var step = form.ea.getAttribute('step');
		if (form.ea.value % step > 0) {
			alert('구매수량은 '+ step +'개 단위만 가능합니다.');
			return false;
		}
	}
	catch (e)
	{}

	var res = chkForm(form);

	// 입력옵션 필드값 설정
	if (res)
	{
		var addopt_inputable = document.getElementsByName('addopt_inputable[]');
		for (var i=0,m=addopt_inputable.length;i<m ;i++ ) {

			if (typeof addopt_inputable[i] == 'object') {
				var v = addopt_inputable[i].value.trim();
				if (v) {
					var tmp = addopt_inputable[i].getAttribute("option-value").split('^');
					tmp[2] = v;
					v = tmp.join('^');
				}
				else {
					v = '';
				}
				document.getElementsByName('_addopt_inputable[]')[i].value = v;
			}
		}
	}

	return res;

}
</script>

<script type="text/javascript" language="javascript">
	$(document).ready(function() {
		/* 사이트 슬라이드 - 2 set */
		var site_max = $('.thumbnail_box > div').length;
		var site_num = 1;
		if(site_num == 1){
			$('.site_set1').css('top','0px');
			$('.site_set2').css('top','680px');
		}else if(site_num == 2){
			$('.site_set1').css('top','-680px');
			$('.site_set2').css('top','0px');
		}
	
		po_top1 = parseFloat($('.site_set1').css('top'));
		po_top2 = parseFloat($('.site_set2').css('top'));
	
		$('.btn_siteD').bind('click', function() {
			ani_speed = 1000;
			if(!$('*').is(':animated')){
				site_num++;
				if(site_num > site_max){
					site_num = 1;
				}
	
				po_top1 += -680;
				po_top2 += -680;
	
				if(po_top1 < -680) { po_top1 = 0; }
				if(po_top2 < -680) { po_top2 = 0; }
			
				if(site_num == 1){
					$('.site_set1').css({top:'680px'});
				}else if(site_num == 2){
					$('.site_set2').css({top:'680px'});
				}
					
				$('.site_set1').animate({top:po_top1 + 'px'}, ani_speed);
				$('.site_set2').animate({top:po_top2 + 'px'}, ani_speed);
			}
			return false;
		});
	
		$('.btn_siteU').bind('click', function() {
			if(!$('*').is(':animated')){
				site_num--;
				if(site_num < 1){
					site_num = site_max;
				}
	
				po_top1 += 680;
				po_top2 += 680;
	
				if(po_top1 > 680) { po_top1 = 0; }
				if(po_top2 > 680) { po_top2 = 0; }
			
				if(site_num == 1){
					$('.site_set1').css({top:'-680px'});
				}else if(site_num == 2){
					$('.site_set2').css({top:'-680px'});
				}
	
				$('.site_set1').animate({top:po_top1 + 'px'}, 1000);
				$('.site_set2').animate({top:po_top2 + 'px'}, 1000);
			}
			return false;
		});
	
		/* 사이트 버튼 */
		$('.btn_siteU').hover(function() {
			$(this).css({'background-color':'#cfcfcf'});
		}, function() {
			$(this).css({'background-color':'#ffffff'});
		});
	
		$('.btn_siteD').hover(function() {
			$(this).css({'background-color':'#cfcfcf'});
		}, function() {
			$(this).css({'background-color':'#ffffff'});
		});
	});
	
	character_action=function(element, isOver) {
		element.src = (isOver) ? "/shop/skin/loosfly/img/jimmy/loos_02.gif" : "/shop/skin/loosfly/img/jimmy/loos_01.gif";
		document.getElementById("balloon").style.display = (isOver) ? "block" : "none";
	};	
</script>

<!-- 상품 이미지 -->
	<div style="height:15px;"></div>
	<div id="blkShopDetail">
		<div id="blkShopImage" onclick="popup('goods_popup_large.php?goodsno=<?php echo $TPL_VAR["goodsno"]?>',800,600,'menubar=no,location=no,toolbar=no, scrollbars=yes, status=no, resizable=no')" style="cursor:pointer">
			<span><?php echo goodsimg($TPL_VAR["r_img"][ 0], 560,'id=objImg')?></span>
			<span id="mglass"><img src="/shop/data/skin/loosfly/img/jimmy/zoom_01.png"></span>
		</div>
		<div id="blkShopThumbnail">
			<div id="thumbnail_outline" class="thumbnail_outline" style="">
				<div id="thumbnail_box" class="thumbnail_box">
					<div class="site_set1" style="top:0px;">
<?PHP $cnt = 0;$basic_reserve_rate = 0.02;?>
<?php if($TPL_t_img_1){foreach($TPL_VAR["t_img"] as $TPL_V1){?>
<?PHP if( $cnt > 0 && $cnt%5 == 0 ) { ?>
					</div>
					<div class="site_set<?PHP echo ( (int)($cnt/5) + 1 ); ?>" style="top:680px; ">
<?PHP } ?>
						<dl<?PHP if( $cnt > 0 && $cnt%5 == 0 ) echo " class=\"no_mar\""?>>
							<dd><?php echo goodsimg($TPL_V1, 100,"onmouseover='chgImg(this)' class='pointer' style='border:#3f3f3f 1px solid'")?><?PHP $cnt++; ?></dd>
						</dl>
<?php }}?>
					</div>
				</div>
<?PHP if( $cnt > 5) { ?>
				<span class="btn_siteU">▲</span>
				<span class="btn_siteD">▼</span>
<?PHP } ?>
			</div>
		</div>

<!-- 상품 스펙 리스트 -->
		<div id="blkShopMenu">
<!--디테일뷰수정--><?php if($TPL_VAR["detailView"]=='y'){?><div id="zoom_view" style="display:none; position:absolute; width:340px; height:370px;"></div><?php }?><!--디테일뷰수정-->
			<form name=frmView method=post onsubmit="return false">
			<input type=hidden name=mode value="addItem">
			<input type=hidden name=goodsno value="<?php echo $TPL_VAR["goodsno"]?>">
			<input type=hidden name=goodsCoupon value="<?php echo $TPL_VAR["coupon"]?>">
<?php if($TPL_VAR["min_ea"]> 1){?><input type="hidden" name="min_ea" value="<?php echo $TPL_VAR["min_ea"]?>"><?php }?>
<?php if($TPL_VAR["max_ea"]!='0'){?><input type="hidden" name="max_ea" value="<?php echo $TPL_VAR["max_ea"]?>"><?php }?>
			<div id="bxShopTitle">
<?PHP
	include_once "_loos_color_nav.php";
	set_array(  $TPL_VAR["memo"] );
	$en_name = $en_color = $kr_name = $kr_color = $alert = "";
	parse_str( $TPL_VAR["shortdesc"]);
	if( $en_name == "" ) $en_name =  $TPL_VAR["goodsnm"];
	if( $en_color != "" ) $en_color = " (".$en_color.")";
	if( $kr_name == "" ) $kr_name =  $TPL_VAR["shortdesc"];
	if( $kr_color != "" ) $kr_color = " (".$kr_color.")";
?>			
<?php if($TPL_VAR["clevel"]=='0'||$TPL_VAR["slevel"]>=$TPL_VAR["clevel"]){?>
				<?=$en_name.$en_color?>
<?php }elseif($TPL_VAR["slevel"]<$TPL_VAR["clevel"]&&$TPL_VAR["auth_step"][ 1]=='Y'){?>
				<?=$en_name.$en_color?>
<?php }?>
			</div>
			<div style="height:7px;"></div>
			<div id="bxShopSubtitle">
				<span class="goodnm_kr">
					<?=$kr_name.$kr_color?>
					<font style="color:#ff0000;font-size:11px"><?=$alert?></font>
				</span>
			</div>
			<div style="height:10px;"></div>
<?php if($TPL_VAR["sales_status"]=='ing'){?>
				<!--span style="padding-bottom:5px; padding-left:14px; color:#EF1C21">절찬리 판매중!!</span-->
<?php }elseif($TPL_VAR["sales_status"]=='range'){?>
			<div style="height:30px;padding-left:15px;font-size:16px;line-height:30px">판매종료까지 <span id="el-countdown-1" style="color:#f47d30;"></span>남았습니다.</div>
				<script type="text/javascript">
					Countdown.init('<?php echo date('Y-m-d H:i:s',$TPL_VAR["sales_range_end"])?>', 'el-countdown-1');
				</script>
<?php }elseif($TPL_VAR["sales_status"]=='before'){?>
			<div style="height:30px;padding-left:20px;font-size:16px;line-height:30px;color:#afafaf;"><span style="color:#f47d30"><?php echo date('m월d일 H:i:s',$TPL_VAR["sales_range_start"])?></span>에 판매시작합니다.</div>
<?php }elseif($TPL_VAR["sales_status"]=='end'){?>
			<div style="height:30px;padding-left:20px;font-size:16px;color:#f47d30;line-height:30px">판매가 종료되었습니다.</div>
<?php }?>
			<div style="height:10px;"></div>
			<div id="bxGoodsInfo">
			<fieldset style="padding:5px;border:#cfcfcf 1px solid;border-radius:10px;background:#f3f3f3;">
				<div style="height:10px;"></div>
<?php if($TPL_VAR["clevel"]=='0'||$TPL_VAR["slevel"]>=$TPL_VAR["clevel"]||($TPL_VAR["slevel"]<$TPL_VAR["clevel"]&&$TPL_VAR["auth_step"][ 2]=='Y')){?>
				<table class="goods_info" border="0" cellpadding="0" cellspacing="0">
<?php if( get_color_name(  $TPL_VAR["goodscd"] ) ) { ?>				
				<tr>
					<th>다른 색상보기 :</th>
					<td id="colour"><?PHP echo get_color_name(  $TPL_VAR["goodscd"] ); ?></td>
				</tr>
				<tr>
					<td colspan="2"><?php set_color_tiles(  $TPL_VAR["goodscd"] ); ?></td>
				</tr>
<?PHP } ?>
<?php if($TPL_VAR["runout"]&&$GLOBALS["cfg_soldout"]["price"]=='image'){?>
				<tr>
					<th>판매가격 :</th>
					<td><img src="../data/goods/icon/custom/soldout_price"></td>
				</tr>
<?php }elseif($TPL_VAR["runout"]&&$GLOBALS["cfg_soldout"]["price"]=='string'){?>
				<tr>
					<th>판매가격 :</th>
					<td><b><?php echo $GLOBALS["cfg_soldout"]["price_string"]?></b></td>
				</tr>
<?php }elseif(!$TPL_VAR["strprice"]){?>
				<tr>
					<th valign="bottom">판매가격 :</th>
					<td valign="bottom"><span id=price><?php echo number_format($TPL_VAR["price"]-$TPL_VAR["special_discount_amount"])?></span>원<?php if($TPL_VAR["consumer"]&&($TPL_VAR["consumer"]-$TPL_VAR["price"])> 0){?>&nbsp;(<span style="color:#ff4c5d"><?PHP echo intval(( $TPL_VAR["consumer"] -  $TPL_VAR["price"])/ $TPL_VAR["consumer"]*100); ?>%↓</span>)<?php }?></td>
				</tr>
<?php if($TPL_VAR["special_discount_amount"]){?>
				<tr>
					<th>상품할인금액 :</th>
					<td>-<?php echo number_format($TPL_VAR["special_discount_amount"])?>원&nbsp;(<span style="color:#ff4c5d"><?PHP echo intval( $TPL_VAR["special_discount_amount"]/ $TPL_VAR["price"]*100); ?>%↓</span>)</td>
				</tr>
<?php }?>
<?php 	$dc_rate = 0; 	$mem_reserve = intval( $TPL_VAR["realprice"]*$basic_reserve_rate);  ?>
<?php if($TPL_VAR["memberdc"]){?>
<?php
		$dc_rate = intval( $TPL_VAR["memberdc"]/ $TPL_VAR["price"]*100); 
		if( $dc_rate > 20 ) $mem_reserve =  0;
?>
				<tr>
					<th>우수회원할인가 :</th>
					<td style="font-weight:bold"><span id=obj_realprice><?php echo number_format($TPL_VAR["realprice"])?>원&nbsp;(-<?php echo number_format($TPL_VAR["memberdc"])?>원) &nbsp;<span style="color:#ff4c5d"><?PHP echo  $dc_rate; ?>%↓</span></td>
				</tr>
<?php }else{?>
<?php
		$dc_rate = intval(( $TPL_VAR["consumer"] -  $TPL_VAR["price"])/ $TPL_VAR["consumer"]*100); 
		if( $dc_rate > 20 ) $mem_reserve =  0;
?>
<?php }?>
<?php if($TPL_VAR["coupon"]){?>
				<tr>
					<th>쿠폰적용가 :</th>
					<td><span id=obj_coupon style="font-weight:bold;color:#EF1C21"><?php echo number_format($TPL_VAR["couponprice"])?>원&nbsp;(-<?php echo number_format($TPL_VAR["coupon"])?>원)</span><div><?php echo $TPL_VAR["about_coupon"]?></div></td>
				</tr>
<?php }?>
<?php if($TPL_VAR["consumer"]&& 0){?>
				<tr>
					<th>소비자가격 :</th>
					<td>
					<span id=consumer><?php echo number_format($TPL_VAR["consumer"])?></span>원
					</td>
				</tr>
<?php }?>
					<tr><th>적립금 :</th><td><span id=reserve><?php echo number_format($mem_reserve); ?></span>원 <!--span style="color:#64291b">(추석이벤트 10%적립)</span--></td></tr>
<?php if($TPL_VAR["naverNcash"]=='Y'){?>
				<tr id="naver-mileage-accum" style="display: none;">
					<th>네이버&nbsp;&nbsp;<br/>마일리지 :</th>
					<td>
<?php if($TPL_VAR["exception"]){?>
						<?php echo $TPL_VAR["exception"]?>

<?php }else{?>
						<span id="naver-mileage-accum-rate" style="font-weight:bold;color:#1ec228;"></span> 적립
<?php }?>
						<img src="<?php echo $GLOBALS["cfg"]["rootDir"]?>/proc/naver_mileage/images/n_mileage_info4.png" onclick="javascript:mileage_info();" style="cursor: pointer; vertical-align: middle;">
					</td>
				</tr>
<?php }?>
<?php if($TPL_VAR["coupon_emoney"]){?>
				<tr>
					<th>쿠폰적립금 :</th>
					<td><span id=obj_coupon_emoney style="font-weight:bold;color:#EF1C21"></span> &nbsp;<span style="font:bold 9pt tahoma; color:#FF0000" ><?php echo number_format($TPL_VAR["coupon_emoney"])?>원</span></td>
				</tr>
<?php }?>
<?php if($TPL_VAR["delivery_type"]== 1){?>
				<tr><th>배송비 :</th><td>무료배송</td></tr>
<?php }elseif($TPL_VAR["delivery_type"]== 2){?>
				<tr><th>개별배송비 :</th><td><?php echo number_format($TPL_VAR["goods_delivery"])?>원</td></tr>
<?php }elseif($TPL_VAR["delivery_type"]== 3){?>
				<tr><th>착불배송비 :</th><td><?php echo number_format($TPL_VAR["goods_delivery"])?>원</td></tr>
<?php }elseif($TPL_VAR["delivery_type"]== 4){?>
				<tr><th>고정배송비 :</th><td><?php echo number_format($TPL_VAR["goods_delivery"])?>원</td></tr>
<?php }elseif($TPL_VAR["delivery_type"]== 5){?>
				<tr><th>수량별배송비 :</th><td><?php echo number_format($TPL_VAR["goods_delivery"])?>원 (수량에 따라 배송비가 추가됩니다.)</td></tr>
<?php }?>
<?php }else{?>
				<tr><th>판매가격 :</th><td><b><?php echo $TPL_VAR["strprice"]?></b></td></tr>
<?php }?>
				</table>
<?php }?>

				<table class="goods_info" border="0" cellpadding="0" cellspacing="0">
<?php if($TPL_VAR["goods_status"]&& 0){?><tr height><th>상품상태 :</th><td><?php echo $TPL_VAR["goods_status"]?></td></tr><?php }?>
<?php if($TPL_VAR["manufacture_date"]){?><tr height><th>제조일자 :</th><td><?php echo $TPL_VAR["manufacture_date"]?></td></tr><?php }?>
<?php if($TPL_VAR["effective_date_start"]){?><tr height><th>유효일자 :</th><td><?php echo $TPL_VAR["effective_date_start"]?> ~ <?php echo $TPL_VAR["effective_date_end"]?></td></tr><?php }?>
<?php if($TPL_VAR["delivery_method"]){?><tr height><th>배송방법 :</th><td><?php echo $TPL_VAR["delivery_method"]?></td></tr><?php }?>
<?php if($TPL_VAR["delivery_area"]){?><tr height><th>배송지역 :</th><td><?php echo $TPL_VAR["delivery_area"]?></td></tr><?php }?>
<?php if($TPL_VAR["goodscd"]){?><tr><th>제품코드 :</th><td><?php echo $TPL_VAR["goodscd"]?></td></tr><?php }?>
<?php if($TPL_VAR["origin"]){?><tr><th>원산지 :</th><td><?php echo $TPL_VAR["origin"]?></td></tr><?php }?>
<?php if($TPL_VAR["maker"]){?><tr><th>제조사 :</th><td><?php echo $TPL_VAR["maker"]?></td></tr><?php }?>
<?php if($TPL_VAR["brand"]&& 0){?><tr><th>브랜드 :</th><td><?php echo $TPL_VAR["brand"]?> <a href="<?php echo url("goods/goods_brand.php?")?>&brand=<?php echo $TPL_VAR["brandno"]?>">[브랜드바로가기]</a></td></tr><?php }?>
<?php if($TPL_VAR["launchdt"]){?><tr><th>출시일 :</th><td><?php echo $TPL_VAR["launchdt"]?></td></tr><?php }?>
<?php if($TPL_ex_1){foreach($TPL_VAR["ex"] as $TPL_K1=>$TPL_V1){?><tr><th><?php echo $TPL_K1?> :</th><td><?php echo $TPL_V1?></td></tr><?php }}?>

<?php if(!$GLOBALS["opt"]){?>
				<tr>
					<th>구매수량 :</th>
					<td>
<?php if(!$TPL_VAR["runout"]){?>
						<div style="float:left;"><input type=text name=ea size=2 value=<?php if($TPL_VAR["min_ea"]){?><?php echo $TPL_VAR["min_ea"]?><?php }else{?>1<?php }?> class=line style="text-align:right;height:18px" step="<?php if($TPL_VAR["sales_unit"]){?><?php echo $TPL_VAR["sales_unit"]?><?php }else{?>1<?php }?>" min="<?php if($TPL_VAR["min_ea"]){?><?php echo $TPL_VAR["min_ea"]?><?php }else{?>1<?php }?>" max="<?php if($TPL_VAR["max_ea"]){?><?php echo $TPL_VAR["max_ea"]?><?php }else{?>0<?php }?>" onblur="chg_cart_ea(frmView.ea,'set');"></div>
						<div style="float:left;padding-left:3">
							<div style="padding:1 0 2 0"><img src="/shop/data/skin/loosfly/img/common/btn_plus.gif" onClick="chg_cart_ea(frmView.ea,'up')" style="cursor:pointer"></div>
							<div><img src="/shop/data/skin/loosfly/img/common/btn_minus.gif" onClick="chg_cart_ea(frmView.ea,'dn')" style="cursor:pointer"></div>
						</div>
						<div style="padding-top:3; float:left">개</div>
						<div style="padding-left:10px;float:left" class="stxt">
<?php if($TPL_VAR["min_ea"]> 1){?><div>최소구매수량 : <?php echo $TPL_VAR["min_ea"]?>개</div><?php }?>
<?php if($TPL_VAR["max_ea"]!='0'){?><div>최대구매수량 : <?php echo $TPL_VAR["max_ea"]?>개</div><?php }?>
<?php if($TPL_VAR["sales_unit"]> 1){?><div>묶음주문단위 : <?php echo $TPL_VAR["sales_unit"]?>개</div><?php }?>
						</div>
<?php }else{?>
						품절된 상품입니다
<?php }?>
					</td>
				</tr>
<?php }else{?>
				<input type=hidden name=ea step="<?php if($TPL_VAR["sales_unit"]){?><?php echo $TPL_VAR["sales_unit"]?><?php }else{?>1<?php }?>" min="<?php if($TPL_VAR["min_ea"]){?><?php echo $TPL_VAR["min_ea"]?><?php }else{?>1<?php }?>" max="<?php if($TPL_VAR["max_ea"]){?><?php echo $TPL_VAR["max_ea"]?><?php }else{?>0<?php }?>" value=<?php if($TPL_VAR["min_ea"]){?><?php echo $TPL_VAR["min_ea"]?><?php }else{?>1<?php }?>>
<?php }?>

<?php if($TPL_VAR["chk_point"]){?>
				<tr><th>고객선호도 :</th><td><?php if((is_array($TPL_R1=array_fill( 0,$TPL_VAR["chk_point"],''))&&!empty($TPL_R1)) || (is_object($TPL_R1) && in_array("Countable", class_implements($TPL_R1)) && $TPL_R1->count() > 0)) {foreach($TPL_R1 as $TPL_V1){?>★<?php }}?></td></tr>
<?php }?>
<?php if($TPL_VAR["icon"]){?><tr><th>제품상태 :</th><td><?php echo $TPL_VAR["icon"]?></td></tr><?php }?>
				</table>

<?php if(!$TPL_VAR["strprice"]){?>

	<!-- 추가 옵션 입력형 -->
<?php if($GLOBALS["addopt_inputable"]){?>
				<table border=0 cellpadding=0 cellspacing=0 class=top>
<?php if($TPL__addopt_inputable_1){$TPL_I1=-1;foreach($GLOBALS["addopt_inputable"] as $TPL_K1=>$TPL_V1){$TPL_I1++;?>
					<tr><th><?php echo $TPL_K1?> :</th>
					<td>
						<input type="hidden" name="_addopt_inputable[]" value="">
						<input type="text" name="addopt_inputable[]" label="<?php echo $TPL_K1?>" option-value="<?php echo $TPL_V1["sno"]?>^<?php echo $TPL_K1?>^<?php echo $TPL_V1["opt"]?>^<?php echo $TPL_V1["addprice"]?>" value="" <?php if($GLOBALS["addopt_inputable_req"][$TPL_I1]){?>required fld_esssential<?php }?> maxlength="<?php echo $TPL_V1["opt"]?>">
					</td></tr>
<?php }}?>
				</table>
<?php }?>

	<!-- 필수 옵션 일체형 -->
<?php if($GLOBALS["opt"]&&$GLOBALS["typeOption"]=="single"){?>
				<table class="goods_info" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<th><?php echo $TPL_VAR["optnm"]?> :</th>
					<td>
						<div>
							<select name="opt[]" onchange="chkOption(this);chkOptimg();nsGodo_MultiOption.set();" required fld_esssential msgR="<?php echo $TPL_VAR["optnm"]?> 선택을 해주세요">
								<option value="">== 옵션선택 ==
<?php if($TPL__opt_1){foreach($GLOBALS["opt"] as $TPL_V1){?>
<?php if((is_array($TPL_R2=$TPL_V1)&&!empty($TPL_R2)) || (is_object($TPL_R2) && in_array("Countable", class_implements($TPL_R2)) && $TPL_R2->count() > 0)) {foreach($TPL_R2 as $TPL_V2){?>
								<option value="<?php echo $TPL_V2["opt1"]?><?php if($TPL_V2["opt2"]){?>|<?php echo $TPL_V2["opt2"]?><?php }?>" <?php if($TPL_VAR["usestock"]&&!$TPL_V2["stock"]){?> disabled class=disabled<?php }?>><?php echo $TPL_V2["opt1"]?><?php if($TPL_V2["opt2"]){?>/<?php echo $TPL_V2["opt2"]?><?php }?> <?php if($TPL_V2["price"]!=$TPL_VAR["price"]){?>(<?php echo number_format($TPL_V2["price"])?>원)<?php }?>
<?php if($TPL_VAR["usestock"]&&!$TPL_V2["stock"]){?> [품절]<?php }?>
<?php }}?>
<?php }}?>
							</select>
						</div>
					</td>
				</tr>
				</table>
<?php }?>

<?php if($GLOBALS["opt"]&&$GLOBALS["typeOption"]=="double"){?>
				<!-- 필수 옵션 분리형 -->
				<table class="goods_info" border="0" cellpadding="0" cellspacing="0">
<?php if($TPL__optnm_1){$TPL_I1=-1;foreach($GLOBALS["optnm"] as $TPL_V1){$TPL_I1++;?>
				<tr>
					<th valign="top" ><?php echo $TPL_V1?> :</th>
					<td>
					<!-- 옵션 선택 -->
						<div>
<?php if(!$TPL_I1){?>
							<div>
								<select name="opt[]" onchange="subOption(this);chkOptimg();selicon(this);nsGodo_MultiOption.set();" required fld_esssential msgR="<?php echo $TPL_V1?> 선택을 해주세요">
									<option value="">== 옵션선택 ==
<?php if((is_array($TPL_R2=($GLOBALS["opt"]))&&!empty($TPL_R2)) || (is_object($TPL_R2) && in_array("Countable", class_implements($TPL_R2)) && $TPL_R2->count() > 0)) {foreach($TPL_R2 as $TPL_K2=>$TPL_V2){?>
									<option value="<?php echo $TPL_K2?>"><?php echo $TPL_K2?>

<?php }}?>
								</select>
							</div>
<?php }else{?>
								<select name="opt[]" onchange="chkOption(this);selicon(this);nsGodo_MultiOption.set();" required fld_esssential msgR="<?php echo $TPL_V1?> 선택을 해주세요"><option value="">==선택==</select>
<?php }?>
						</div>
<?php if($TPL_VAR["optkind"][$TPL_I1]=='img'){?>
<?php if(!$TPL_I1){?>
<?php if((is_array($TPL_R2=$GLOBALS["opticon"][$TPL_I1])&&!empty($TPL_R2)) || (is_object($TPL_R2) && in_array("Countable", class_implements($TPL_R2)) && $TPL_R2->count() > 0)) {$TPL_I2=-1;foreach($TPL_R2 as $TPL_K2=>$TPL_V2){$TPL_I2++;?>
						<!-- 옵션 이미지 아이콘 -->
						<div style='width:43px;float:left;padding:5 0 5 0'><a href="javascript:click_opt_fastion('<?php echo $TPL_I1?>','<?php echo $TPL_I2?>','<?php echo $GLOBALS["opt"][$TPL_K2][$TPL_I2]["opt1"]?>');" name="icon[]"><img width="40" id="opticon0_<?php echo $TPL_I2?>" id="opticon_<?php echo $TPL_I1?>_<?php echo $TPL_I2?>" style="border:1px #cccccc solid" src='../data/goods/<?php echo $TPL_V2?>'  onmouseover="onicon(this);chgOptimg('<?php echo $TPL_K2?>');" onmouseout="outicon(this)" onclick="clicon(this)"></a></div>
<?php }}?>
<?php }else{?>
						<div id="dtdopt2"></div>
<?php }?>
<?php }?>

<?php if($TPL_VAR["optkind"][$TPL_I1]=='color'){?>
<?php if(!$TPL_I1){?>
<?php if((is_array($TPL_R2=$GLOBALS["opticon"][$TPL_I1])&&!empty($TPL_R2)) || (is_object($TPL_R2) && in_array("Countable", class_implements($TPL_R2)) && $TPL_R2->count() > 0)) {$TPL_I2=-1;foreach($TPL_R2 as $TPL_K2=>$TPL_V2){$TPL_I2++;?>
						<!-- 옵션 색상타입 아이콘 -->
						<div style='width:18px;float:left;padding-top:5px ' ><a href="javascript:click_opt_fastion('<?php echo $TPL_I1?>','<?php echo $TPL_I2?>','<?php echo $TPL_K2?>');" style="cursor:hand;"  name="icon[]"><span  style="float:left;width:15px;height:15px;border:1px #cccccc solid;background-color:#<?php echo $TPL_V2?>" onmouseover="onicon(this);chgOptimg('<?php echo $TPL_K2?>');" onmouseout="outicon(this)" onclick="clicon(this)"></span></a></div>
<?php }}?>
<?php }else{?>
						<div id="dtdopt2"></div>
<?php }?>
<?php }?>

						<input type="hidden" name="opt_txt[]" value="">
					</td>
				</tr>
<?php }}?>
				</table>
				<script>subOption(document.getElementsByName('opt[]')[0])</script>
<?php }?>

				<!-- 추가 옵션 -->
				<table class="goods_info" border="0" cellpadding="0" cellspacing="0">
<?php if($TPL__addopt_1){$TPL_I1=-1;foreach($GLOBALS["addopt"] as $TPL_K1=>$TPL_V1){$TPL_I1++;?>
				<tr>
					<th><?php echo $TPL_K1?> :</th>
					<td>
<?php if($GLOBALS["addoptreq"][$TPL_I1]){?>
						<select name="addopt[]" required fld_esssential label="<?php echo $TPL_K1?>" onchange="nsGodo_MultiOption.set();">
							<option value="">==<?php echo $TPL_K1?> 선택==
<?php }else{?>
						<select name="addopt[]" label="<?php echo $TPL_K1?>" onchange="nsGodo_MultiOption.set();">
							<option value="">==<?php echo $TPL_K1?> 선택==
							<option value="-1">선택안함
<?php }?>
<?php if((is_array($TPL_R2=$TPL_V1)&&!empty($TPL_R2)) || (is_object($TPL_R2) && in_array("Countable", class_implements($TPL_R2)) && $TPL_R2->count() > 0)) {foreach($TPL_R2 as $TPL_V2){?>
							<option value="<?php echo $TPL_V2["sno"]?>^<?php echo $TPL_K1?>^<?php echo $TPL_V2["opt"]?>^<?php echo $TPL_V2["addprice"]?>"><?php echo $TPL_V2["opt"]?><?php if($TPL_V2["addprice"]){?>(<?php echo number_format($TPL_V2["addprice"])?>원 추가)<?php }?>
<?php }}?>
						</select>
					</td>
				</tr>
<?php }}?>
				</table>
<style type="text/css">
	.goods-multi-option {display:none;}
</style>
				<div style="height:10px;"></div>
				<div id="el-multi-option-display" class="goods-multi-option">
					<table border="0" cellpadding="0" cellspacing="0">
					</table>
					<div style="height:5px;"></div>
					<div style="font-size:12px;text-align:right;padding:5px 20px 5px 0;border-top:1px solid #D3D3D3;">
						ㆍ&nbsp;&nbsp;총 금액 : <span style="color:#E70103;font-weight:bold;" id="el-multi-option-total-price"></span>
					</div>
				</div>
<?php }?>
			</fieldset>
			</div>
			<div style="height:25px;"></div>
			<div id="bxShopBtn">
<?php if($TPL_VAR["stocked_noti"]){?>
				<div style="margin-bottom: 7px">품절된 옵션상품은 재입고 알림 신청을 통해서 입고 시 알림 서비스를 받으실 수 있습니다.</div>
<?php }?>
<?php if(!$TPL_VAR["strprice"]&&!$TPL_VAR["runout"]&&($TPL_VAR["sales_status"]=='ing'||$TPL_VAR["sales_status"]=='range')){?>
<?php if($TPL_VAR["clevel"]=='0'||$TPL_VAR["slevel"]>=$TPL_VAR["clevel"]){?>
				<div>
					<div style="position:relative;float:left"><a href="javascript:act('/shop/order/order')"><img src="/shop/data/skin/loosfly/img/jimmy/buttons/buy_01.gif"></a></div>
					<div style="position:relative;float:left;width:5px;height:10px;"> </div>
					<div style="position:relative;float:left"><a href="javascript:cartAdd(frmView,'<?php echo $TPL_VAR["cartCfg"]->redirectType?>')"><img src="/shop/data/skin/loosfly/img/jimmy/buttons/cart_01.gif"></a></div>
					<div style="position:relative;float:right"><a href="javascript:act('/shop/mypage/mypage_wishlist')"><img src="/shop/data/skin/loosfly/img/jimmy/buttons/wishlist_01.gif"></a></div>
					<div style="clear:both"></div>
				</div>
<?php }?>
<?php }?>
<?php if($TPL_VAR["stocked_noti"]){?>
				<a href="javascript:fnRequestStockedNoti('<?php echo $TPL_VAR["goodsno"]?>');"><img src="/shop/data/skin/loosfly/img/stocked_noti/btn_alarm_2.gif"></a>
<?php }?>
			</div>
			</form>
<?PHP 
	function getURL(){
		$server=getenv("SERVER_NAME");
		$file=getenv("SCRIPT-x_NAME");
		$query=getenv("QUERY_STRING");
		$url="http://$server$file";
		if($query) $url.="?$query";
		return $url;
	}
?>
<script type="text/javascript">
	function get_img_path() {
		
	};
</script>
			<div id="bxSNS">
				<div style="height:15px;"> </div>
				<div style="float:left;line-height:30px">Share this :&nbsp;</div>
				<div style="line-height:30px"><?php echo $TPL_VAR["snsBtn"]?><a href="//kr.pinterest.com/pin/create/button/?url=http%3A%2F%2Fwww.loosfly.com%2Fshop%2Fgoods%2Fgoods_view.php%3Fgoodsno%3D<?php echo $TPL_VAR["goodsno"]?>%26category%3D&media=http%3A%2F%2Fwww.loosfly.com%2Fshop%2Fdata%2Fgoods%2F<?php echo $TPL_VAR["r_img"][ 0]?>&description=<?php echo $TPL_VAR["goodsnm"]?>" data-pin-do="buttonPin" data-pin-config="none" data-pin-height="28"><img src="//assets.pinterest.com/images/pidgets/pinit_fg_en_rect_gray_28.png" /></a></div>
<!-- Please call pinit.js only once per page -->
<script type="text/javascript" async src="//assets.pinterest.com/js/pinit.js"></script>
			</div>
<script type="text/javascript" language="javascript">
	function move_banner() {
		document.getElementById('tmp_banner').style.top = "0px";
		var btmp = $('#blkShopMenu').offset();
		var ttmp = $('#tmp_banner').offset();
		var tt = btmp.top + 630 - ttmp.top;

		document.getElementById('tmp_banner').style.top = tt + "px";
	}
	
	$(document).ready(function() {
		move_banner();
	});
</script>
			<div id="tmp_banner" style="position:relative"><!--a href="/shop/board/view.php?id=event&no=9"><img src="/shop/data/skin/loosfly/img/jimmy/chooseok_banner_01.jpg"></a--></div>
		</div>
	</div>
	<div style="height:25px;"></div>
<?php if($TPL_VAR["use_external_video"]){?>
	<div style="padding:10px 0" id="external-video">
		<?php echo youtubePlayer($TPL_VAR["external_video_url"],$TPL_VAR["external_video_size_type"],$TPL_VAR["external_video_width"],$TPL_VAR["external_video_height"])?>

	</div>
	<div style="height:25px;"></div>
<?php }?>

	<div id="blkGoodsDescription">
<?php if($this->tpl_['side_inc']){?>
		<div class="blkLeftMenu">
<?php $this->print_("side_inc",$TPL_SCP,1);?>

		</div>
<?php }?>
		<div id="blkContents">
			<?php echo $TPL_VAR["longdesc"]?>


			<!-- 관련상품 -->
			<!--table border="0" cellpadding="0" cellspacing="0" style="width:840px;margin-left:30px">
			<tr>
				<TD style="background: URL(/shop/data/skin/loosfly/img/common/bar_detail_02.gif) no-repeat;" nowrap width="137" height="24"></TD>
				<TD style="background: URL(/shop/data/skin/loosfly/img/common/bar_detail_02_bg.gif) repeat-x;" width="693"></TD>
				<TD style="background: URL(/shop/data/skin/loosfly/img/common/bar_detail_02_right.gif) no-repeat;" nowrap width="10" height="24"></TD>
			</tr>
			</table-->
			<div style="height:30px"></div>
			<div style="height:30px;width:840px;background:#efefef;line-height:30px;margin-left:30px"><span style="margin-left:15px">관련상품 (Related Products)</span></div>
			<div style="width:840px;margin:0 auto;padding:10px;overflow:hidden">
				<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr><td height="10"></td></tr>
				<tr>
<?php if((is_array($TPL_R1=dataGoodsRelation($TPL_VAR["goodsno"],$GLOBALS["cfg_related"]["max"]))&&!empty($TPL_R1)) || (is_object($TPL_R1) && in_array("Countable", class_implements($TPL_R1)) && $TPL_R1->count() > 0)) {$TPL_I1=-1;foreach($TPL_R1 as $TPL_V1){$TPL_I1++;?>
<?php if($TPL_I1&&$TPL_I1%$GLOBALS["cfg_related"]["horizontal"]== 0){?></tr><tr><td height="10"></td></tr><tr><?php }?>
<?PHP 
	$en_name = $en_color = $kr_name = $kr_color = $alert = "";
	$delim = "";
	parse_str( $TPL_V1["shortdesc"]);
	if( $en_name == "" ) $en_name =  $TPL_V1["goodsnm"];
	$delim = (strlen($en_name) > 25) ? " " : "<br>";
	if( $en_color != "" ) $en_color = $delim."(".$en_color.")";
	if( $kr_name == "" ) $kr_name =  $TPL_V1["shortdesc"];
	$delim = (strlen($kr_name) > 25) ? " " : "<br>";
	if( $kr_color != "" ) $kr_color = $delim."(".$kr_color.")";
	$id = "nm". $TPL_V1["goodsno"];
?>
					<td width="<?php echo  100/$GLOBALS["cfg_related"]["horizontal"]?>%" valign="top" align="center"> 
						<div class="related_item" onclick="location.href='<?php echo url("goods/goods_view.php?")?>&goodsno=<?php echo $TPL_V1["goodsno"]?>'" onmouseover="document.getElementById('<?=$id?>').innerHTML='<?=$kr_name.$kr_color?>'" onmouseout="document.getElementById('<?=$id?>').innerHTML='<?=$en_name.$en_color?>'">
<?php if($GLOBALS["cfg_related"]["dp_image"]){?>
								<?php echo goodsimg($TPL_V1["img_s"],$GLOBALS["cfg_related"]["size"])?>

<?php }?>
<?php if($TPL_V1["soldout_icon"]){?>
							<div class="sold_out">out of stock</div>
<?php }elseif($TPL_V1["icon"]){?>
				<?PHP $pos = strpos( $TPL_V1["icon"], "icon_new"); if( $pos != false )  { ?>
							<span class="new_arrival">NEW</span>
				<?PHP } ?>
<?php }?>
							<div style="height:5px"></div>
<?php if($GLOBALS["cfg_related"]["dp_goodsnm"]){?><div class="galary_name" id="<?=$id?>"><?=$en_name.$en_color?></div><?php }?>
<?php if($GLOBALS["cfg_related"]["dp_price"]){?><div class="galary_price"><span style="color:#f47d30;"><?php if($TPL_V1["strprice"]){?><?php echo $TPL_V1["strprice"]?><?php }else{?> <?php echo number_format($TPL_V1["price"])?>원</span><?php }?> <?php if($GLOBALS["cfg_related"]["use_cart"]){?><a href="javascript:void(0);" onClick="fnPreviewGoods_(<?php echo $TPL_V1["goodsno"]?>);"><img src="<?php echo $GLOBALS["cfg_related"]["cart_icon"]?>"></a><?php }?></div><?php }?>
<?php if($TPL_V1["coupon"]){?><div class="galary_coupon"><?php echo $TPL_V1["coupon"]?><font class=small>원</font><img src="/shop/data/skin/img/icon/good_icon_coupon.gif" align=absmiddle></div><?php }?>	
						</div>
					</td>
<?php }}?>
				</tr>
				</table>
			</div>
			<!-- 상품 사용기 -->
			<div style="height:30px"></div>
			<iframe id="inreview" src="./goods_review_list.php?goodsno=<?php echo $TPL_VAR["goodsno"]?>" frameborder="0" marginwidth="0" marginheight="0" height="" scrolling="no" style="width:840px;margin:0 30px"></iframe>

			<!-- 상품 질문과답변 -->
			<div style="height:30px"></div>
			<iframe id="inqna" src="./goods_qna_list.php?goodsno=<?php echo $TPL_VAR["goodsno"]?>" frameborder="0" marginwidth="0" marginheight="0" height="" scrolling="no" style="width:840px;margin:0 30px"></iframe>
		</div>
	</div>
<?php $this->print_("footer",$TPL_SCP,1);?>

<!--디테일뷰수정-->
<?php if($TPL_VAR["detailView"]=='y'){?>
<script type="text/javascript">
var objImg = document.getElementById("objImg");
objImg.setAttribute("lsrc", objImg.getAttribute("src").replace("/t/", "/").replace("_sc.", '.'));
ImageScope.setImage(objImg, beforeScope, afterScope);
</script>
<?php }?>
<!--디테일뷰수정-->