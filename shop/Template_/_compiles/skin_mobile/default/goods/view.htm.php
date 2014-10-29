<?php /* Template_ 2.2.7 2013/02/22 10:14:38 /www/loosfly_godo_co_kr/shop/data/skin_mobile/default/goods/view.htm 000019011 */ 
$TPL__opt_1=empty($GLOBALS["opt"])||!is_array($GLOBALS["opt"])?0:count($GLOBALS["opt"]);
$TPL__optnm_1=empty($GLOBALS["optnm"])||!is_array($GLOBALS["optnm"])?0:count($GLOBALS["optnm"]);
$TPL__addopt_1=empty($GLOBALS["addopt"])||!is_array($GLOBALS["addopt"])?0:count($GLOBALS["addopt"]);
$TPL_extra_info_1=empty($TPL_VAR["extra_info"])||!is_array($TPL_VAR["extra_info"])?0:count($TPL_VAR["extra_info"]);
$TPL_ex_1=empty($TPL_VAR["ex"])||!is_array($TPL_VAR["ex"])?0:count($TPL_VAR["ex"]);
$TPL_a_coupon_1=empty($TPL_VAR["a_coupon"])||!is_array($TPL_VAR["a_coupon"])?0:count($TPL_VAR["a_coupon"]);?>
<?php $this->print_("header",$TPL_SCP,1);?>


<script>

var oReviewGetter;
var price = new Array();
var reserve = new Array();
var consumer = new Array();
var memberdc = new Array();
var realprice = new Array();
var couponprice = new Array();
var coupon = new Array();
var cemoney = new Array();
<?php if($TPL__opt_1){$TPL_I1=-1;foreach($GLOBALS["opt"] as $TPL_V1){$TPL_I1++;?><?php if(is_array($TPL_R2=$TPL_V1)&&!empty($TPL_R2)){$TPL_I2=-1;foreach($TPL_R2 as $TPL_V2){$TPL_I2++;?>
<?php if($TPL_I1== 0&&$TPL_I2== 0){?>
var fkey = '<?php echo $TPL_V2["opt1"]?><?php if($TPL_V2["opt2"]){?>|<?php echo $TPL_V2["opt2"]?><?php }?>';
<?php }?>
price['<?php echo $TPL_V2["opt1"]?><?php if($TPL_V2["opt2"]){?>|<?php echo $TPL_V2["opt2"]?><?php }?>'] = <?php echo $TPL_V2["price"]?>;
reserve['<?php echo $TPL_V2["opt1"]?><?php if($TPL_V2["opt2"]){?>|<?php echo $TPL_V2["opt2"]?><?php }?>'] = <?php echo $TPL_V2["reserve"]?>;
consumer['<?php echo $TPL_V2["opt1"]?><?php if($TPL_V2["opt2"]){?>|<?php echo $TPL_V2["opt2"]?><?php }?>'] = <?php echo $TPL_V2["consumer"]?>;
memberdc['<?php echo $TPL_V2["opt1"]?><?php if($TPL_V2["opt2"]){?>|<?php echo $TPL_V2["opt2"]?><?php }?>'] = <?php echo $TPL_V2["memberdc"]?>;
realprice['<?php echo $TPL_V2["opt1"]?><?php if($TPL_V2["opt2"]){?>|<?php echo $TPL_V2["opt2"]?><?php }?>'] = <?php echo $TPL_V2["realprice"]?>;
coupon['<?php echo $TPL_V2["opt1"]?><?php if($TPL_V2["opt2"]){?>|<?php echo $TPL_V2["opt2"]?><?php }?>'] = <?php echo $TPL_V2["coupon"]?>;
couponprice['<?php echo $TPL_V2["opt1"]?><?php if($TPL_V2["opt2"]){?>|<?php echo $TPL_V2["opt2"]?><?php }?>'] = <?php echo $TPL_V2["couponprice"]?>;
cemoney['<?php echo $TPL_V2["opt1"]?><?php if($TPL_V2["opt2"]){?>|<?php echo $TPL_V2["opt2"]?><?php }?>'] = <?php echo $TPL_V2["coupon_emoney"]?>;
<?php }}?><?php }}?>

/* 필수 옵션 분리형 스크립트 start */
var opt = new Array();
opt[0] = new Array("('1차옵션을 먼저 선택해주세요','')");
<?php if($TPL__opt_1){$TPL_I1=-1;foreach($GLOBALS["opt"] as $TPL_V1){$TPL_I1++;?>
opt['<?php echo $TPL_I1+ 1?>'] = new Array("('== 옵션선택 ==','')",<?php if(is_array($TPL_R2=$TPL_V1)&&!empty($TPL_R2)){$TPL_S2=count($TPL_R2);$TPL_I2=-1;foreach($TPL_R2 as $TPL_V2){$TPL_I2++;?>"('<?php echo $TPL_V2["opt2"]?><?php if($TPL_V2["price"]!=$TPL_VAR["price"]){?> (<?php echo number_format($TPL_V2["price"])?>원)<?php }?><?php if($TPL_VAR["usestock"]&&!$TPL_V2["stock"]){?> [품절]<?php }?>','<?php echo $TPL_V2["opt2"]?>','<?php if($TPL_VAR["usestock"]&&!$TPL_V2["stock"]){?>soldout<?php }?>')"<?php if($TPL_I2!=$TPL_S2- 1){?>,<?php }?><?php }}?>);
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
}
/* 필수 옵션 분리형 스크립트 end */

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
		document.getElementById('price').innerHTML = comma(price[key]);
		document.getElementById('reserve').innerHTML = comma(reserve[key]);
		if (document.getElementById('obj_realprice'))document.getElementById('obj_realprice').innerHTML = comma(realprice[key]) +'원&nbsp;(-'+comma(memberdc[key])+'원)';
		if (document.getElementById('obj_coupon'))document.getElementById('obj_coupon').innerHTML = comma( couponprice[key]) +'원&nbsp;(-'+comma(coupon[key])+'원)';
		if (document.getElementById('obj_coupon_emoney'))document.getElementById('obj_coupon_emoney').innerHTML = comma(cemoney[key]);
	}
}

function act(target)
{
	var form = document.frmView;
	form.mode.value='addItem';
	if(!(form.ea.value>0))
	{
		alert("구매수량은 1개 이상만 가능합니다");
		return;
	}
	form.action = target + ".php";
	if (chkForm(form)) form.submit();
}

function ajaxAction(mode){
	var form = document.frmView;
	form.mode.value=mode;
	if(!(form.ea.value>0))
	{
		alert("수량은 1개 이상만 가능합니다");
		return;
	}

	var serializedData = $("form[name='frmView']").serialize();
	if (chkForm(form)){
		$.ajax({
			type:"post",
			url:"ajaxAction.php",
			dataType:"json",
			data: serializedData,
			success:function(result){
				if(result.msg) alert(result.msg);
				if(result.exeCode) eval(result.exeCode);
			},
			error:function(){
				alert('일시적인 에러가 발생하였습니다.\n다시 시도하여주시기 바랍니다.');
			}
		});
	}
}

function chgImg(obj)
{
	var objImg = document.getElementById('objImg');
	objImg.src = obj.src.replace("/t/","/");
}

function chg_information_tab(chgId,obj){
	var arr = new Array('goods_info','goods_detail','goods_review');
	var arrTab = new Array('tab_info','tab_detail','tab_review');

	for(var i=0;i<arr.length;i++){
		var cn = _ID(arrTab[i]).className.replace('_on','');
		if(chgId == arr[i]) {
			_ID(arr[i]).style.display='block';
			_ID(arrTab[i]).className = cn+'_on';
		}
		else {
			_ID(arr[i]).style.display='none';
			_ID(arrTab[i]).className = cn;
		}
	}
	return false;
}

function review_li_toggle(obj){
	var divObj = $(obj).parents('.gr_li').find('>div');
	if(divObj.css('display')=='none') divObj.slideDown();
	else divObj.slideUp();
}

ReviewGetter = function(goodsno,pageNum){
	this.goodsno = goodsno;
	this.pageNum = pageNum;

	$listID = 'review_list_container';
	$listingEnd = false;
	$listingPage = 1;
	$listingCnt = 0;

	var ul = document.createElement("ul"); ul.id = $listID;
	$('#'+$listID).append(ul);

	$('#'+$listID).append('<div id="review_more_button"><a href="javascript:;" onclick="oReviewGetter.get();"><span class="hidden">[더보기]</span></a></div>');
	this.get($listingPage);
}

ReviewGetter.prototype.get = function(){
	if($listingEnd==false){
		$.ajax({
			type:'get',
			dataType:'json',
			url:'../goods/view.review.get.php',
			data:({goodsno:this.goodsno, pageNum:this.pageNum, page:$listingPage, listingCnt:$listingCnt}),
			success:function(result){
				
				$listingPage = $listingPage + 1;
				$listingCnt = $listingCnt + result.listingCnt;
				$listingEnd = result.listingEnd;

				if(result.list!=null){
					$.each(result.list, function(i, item){
						var _data = new StringBuffer();
						_data.append('<li class="gr_li">');
						_data.append('<dl>');
						_data.append('	<dt class="hidden">작성자</dt>');
						_data.append('	<dd class="gr_name">'+item.name+'</dd>');
						_data.append('	<dt class="hidden">제목</dt>');
						_data.append('	<dd class="gr_subject">'+(item.parent!=item.sno?'Re:':'')+item.subject+'</dd>');
						_data.append('	<dt class="hidden">내용</dt>');
						_data.append("	<dd class='gr_detail'><a onclick=\"review_li_toggle(this);\"><span class='hidden'>내용보기</span></a></dd>");
						_data.append('</dl>');
						_data.append('<div class="gr_contents hidden">'+item.contents+'</div>');
						_data.append('</li>');
						$('#'+$listID+' ul').append(_data.toString());
					});
				}

				if($listingEnd){
					$('#review_more_button').hide();
				}
				else{
					$('#review_more_button').show();
				}
				
			},
			error:function(){
				alert('일시적인 오류 발생하였습니다. \n다시 시도해보시기 바랍니다.');
			}
		});
	}
}

$(window).load(function () {
	oReviewGetter = new ReviewGetter('<?php echo $GLOBALS["goodsno"]?>',10);
	
	// 메인이미지 세로길이에 따른 조정
	if($(".gs_img img").height() > $('#goods_spec').height() + $('#goods_control').height()){
		$('#goods_spec').css('height',$(".gs_img img").height() - $('#goods_control').height());
	}
});

<?php if($GLOBALS["snsCfg"]['use_kakao']=='y'){?>
$(function() { 
	var msg = "<?php echo $TPL_VAR["msg_kakao2"]?>";
	var url = "<?php echo $TPL_VAR["msg_kakao3"]?>";
	var appname = "<?php echo $TPL_VAR["msg_kakao1"]?>";
	var link = new com.kakao.talk.KakaoLink("<?php echo $GLOBALS["_SERVER"]['HTTP_HOST']?>", "1.0", url, msg, appname);

	$("#kakao").click(function() {// button click event
		link.execute();
	});
});
<?php }?>
</script>

<section id="goods_view">

	<div id="goods_spec">
		<dl>
			<dt class="hidden">상품이미지</dt>
			<dd class="gs_img"><?php echo goodsimgMobile($TPL_VAR["r_img"][ 0], 140)?></dd>
			<dt class="hidden">상품명</dt>
			<dd class="gs_name"><?php echo $TPL_VAR["goodsnm"]?></dd>
<?php if(!$TPL_VAR["strprice"]){?>
			
			<dt class="gs_price_title blt">상품가격 : </dt>
			<dd class="gs_price"><span id="price"><?php echo number_format($TPL_VAR["price"])?></span>원</dd>
<?php if($TPL_VAR["memberdc"]){?>
			<dt class="gs_memberdc_title blt">회원할인가 : </dt>
			<dd class="gs_memberdc"><span id="obj_realprice"><?php echo number_format($TPL_VAR["realprice"])?>원</span></dd>
<?php }?>
<?php if($TPL_VAR["coupon"]){?>
			<dt class="gs_couponprice_title blt">쿠폰적용가 : </dt>
			<dd class="gs_couponprice"><span id="obj_coupon"><?php echo number_format($TPL_VAR["couponprice"])?>원</span></dd>
<?php }?>
<?php if($TPL_VAR["coupon_emoney"]){?>
			<dt class="gs_couponemoney_title blt">쿠폰적립금 : </dt>
			<dd class="gs_couponemoney"><span id="obj_coupon_emoney"></span> &nbsp;<?php echo number_format($TPL_VAR["coupon_emoney"])?>원</dd>
<?php }?>
		
<?php if($TPL_VAR["reserve"]){?>
			<dt class="gs_reserve_title blt">적립금 : </dt>
			<dd class="gs_reserve"><span id=reserve><?php echo number_format($TPL_VAR["reserve"])?></span>원</dd>
<?php }?>

			<?php echo $TPL_VAR["NaverMileageAccum"]?>


<?php }else{?>
			<dt class="gs_strprice_title blt">판매가격 : </dt>
			<dd class="gs_strprice"><?php echo $TPL_VAR["strprice"]?></dd>
<?php }?>
		</dl>
		<hr class="hidden" />
	</div>

	<div id="goods_control">
		<ul>
<?php if(!$TPL_VAR["strprice"]&&!$TPL_VAR["runout"]){?>
			<li class="gc_btn_order"><a href="javascript:act('../ord/order')"><span class="hidden">구매하기</span></a></li>
			<li class="gc_btn_cart"><a href="javascript:ajaxAction('addCart')"><span class="hidden">장바구니담기</span></a></li>
			<li class="gc_btn_wish"><a href="javascript:ajaxAction('addWishlist')"><span class="hidden">찜하기</span></a></li>
<?php }?>
		</ul>
		<div class="clearb"></div>
		<hr class="hidden" />
	</div>

	<div id="sns_area">
		<?php echo $TPL_VAR["snsBtn"]?>

	</div>

	<?php echo $TPL_VAR["naverCheckout"]?>


	<div id="goods_tabs">
		<h4 class="hidden">상품상세 탭메뉴</h4>
		<ul>
			<li><a href="#tab_1" id="tab_info" onclick="return chg_information_tab('goods_info',this);" class="btn_info_on"><span>상품정보</span></a>
			<li><a href="#tab_2" id="tab_detail" onclick="return chg_information_tab('goods_detail',this);" class="btn_desc"><span>상세설명</span></a>
			<li><a href="#tab_3" id="tab_review" onclick="return chg_information_tab('goods_review',this);" class="btn_review"><span>구매후기</span></a>
		</ul>
		<div class="clearb"></div>
		<hr class="hidden" />
	</div>

	<a name="tab_1"></a>
	<div id="goods_info">
		<h4 class="hidden">상품정보</h4>
		<form name="frmView" method="post" onsubmit="return false">
		<input type="hidden" name="mode" value="">
		<input type="hidden" name="goodsno" value="<?php echo $TPL_VAR["goodsno"]?>">
		<input type="hidden" name="goodsCoupon" value="<?php echo $TPL_VAR["coupon"]?>">
		<dl>
<?php if(!$TPL_VAR["strprice"]){?>
		<!-- 필수 옵션 일체형 -->
<?php if($GLOBALS["opt"]&&$GLOBALS["typeOption"]=="single"){?>
			<dt><?php echo $TPL_VAR["optnm"]?> :</dt>
			<dd>
				<select name="opt[]" onchange="chkOption(this)" required="required" msgR="<?php echo $TPL_VAR["optnm"]?> 선택을 해주세요">
				<option value="">== 옵션선택 ==
<?php if($TPL__opt_1){foreach($GLOBALS["opt"] as $TPL_V1){?><?php if(is_array($TPL_R2=$TPL_V1)&&!empty($TPL_R2)){foreach($TPL_R2 as $TPL_V2){?>
				<option value="<?php echo $TPL_V2["opt1"]?><?php if($TPL_V2["opt2"]){?>|<?php echo $TPL_V2["opt2"]?><?php }?>" <?php if($TPL_VAR["usestock"]&&!$TPL_V2["stock"]){?> disabled class=disabled<?php }?>><?php echo $TPL_V2["opt1"]?><?php if($TPL_V2["opt2"]){?>/<?php echo $TPL_V2["opt2"]?><?php }?> <?php if($TPL_V2["price"]!=$TPL_VAR["price"]){?>(<?php echo number_format($TPL_V2["price"])?>원)<?php }?>
<?php if($TPL_VAR["usestock"]&&!$TPL_V2["stock"]){?> [품절]<?php }?>
<?php }}?><?php }}?>
				</select>
			</dd>
<?php }?>

		<!-- 필수 옵션 분리형 -->
<?php if($GLOBALS["opt"]&&$GLOBALS["typeOption"]=="double"){?>
<?php if($TPL__optnm_1){$TPL_I1=-1;foreach($GLOBALS["optnm"] as $TPL_V1){$TPL_I1++;?>
			<dt><?php echo $TPL_V1?> :</dt>
			<dd>
<?php if(!$TPL_I1){?>
				<select name="opt[]" onchange="subOption(this)" required="required" msgR="<?php echo $TPL_V1?> 선택을 해주세요">
				<option value="">== 옵션선택 ==
<?php if(is_array($TPL_R2=($GLOBALS["opt"]))&&!empty($TPL_R2)){foreach($TPL_R2 as $TPL_K2=>$TPL_V2){?><option value="<?php echo $TPL_K2?>"><?php echo $TPL_K2?><?php }}?>
				</select>
<?php }else{?>
				<select name="opt[]" onchange="chkOption(this)" required msgR="<?php echo $TPL_V1?> 선택을 해주세요"><option value="">==선택==</select>
<?php }?>
			</dd>
<?php }}?>
			<script>subOption(document.getElementsByName('opt[]')[0])</script>
<?php }?>

		<!-- 추가 옵션 -->
<?php if($TPL__addopt_1){$TPL_I1=-1;foreach($GLOBALS["addopt"] as $TPL_K1=>$TPL_V1){$TPL_I1++;?>
			<dt><?php echo $TPL_K1?> :</dt>
			<dd>
				<select name="addopt[]"<?php if($GLOBALS["addoptreq"][$TPL_I1]){?> required="required" label="<?php echo $TPL_K1?>"<?php }?>>
				<option value="">==<?php echo $TPL_K1?> 선택==
<?php if(is_array($TPL_R2=$TPL_V1)&&!empty($TPL_R2)){foreach($TPL_R2 as $TPL_V2){?>
				<option value="<?php echo $TPL_V2["sno"]?>^<?php echo $TPL_K1?>^<?php echo $TPL_V2["opt"]?>^<?php echo $TPL_V2["addprice"]?>"><?php echo $TPL_V2["opt"]?>

<?php if($TPL_V2["addprice"]){?>(<?php echo number_format($TPL_V2["addprice"])?>원 추가)<?php }?>
<?php }}?>
				</select>
			</dd>
<?php }}?>
<?php }?>

<?php if($TPL_extra_info_1){?>
			<style>
			table.extra-information {background:#e0e0e0;margin:10px 0 20px 0;}
			table.extra-information th,
			table.extra-information td {font-weight:normal;text-align:left;padding-left:15px;background:#ffffff;font-family:Dotum;font-size:11px;height:28px;}
	
			table.extra-information th {width:15%;background:#f5f5f5;color:#515151;}
			table.extra-information td {width:35%;color:#666666;}
	
			</style>
			<table width=100% border=0 cellpadding=0 cellspacing=1 class="extra-information">
			<tr>
<?php if($TPL_extra_info_1){foreach($TPL_VAR["extra_info"] as $TPL_K1=>$TPL_V1){?>
				<th><?php echo $TPL_V1["title"]?></th>
				<td <?php if($TPL_V1["colspan"]> 1){?>colspan="<?php echo $TPL_V1["colspan"]?>"<?php }?>><?php echo $TPL_V1["desc"]?></td>
<?php if($TPL_V1["nkey"]&&(!$GLOBALS["extra_info"][$TPL_V1["nkey"]]||$TPL_K1% 2== 0)){?>
				</tr><tr>
<?php }?>
<?php }}?>
			</tr>
			</table>
<?php }?>		

<?php if($TPL_VAR["goodscd"]){?><dt>제품코드 :</dt><dd><?php echo $TPL_VAR["goodscd"]?></dd><?php }?>
<?php if($TPL_VAR["origin"]){?><dt>원산지 :</dt><dd><?php echo $TPL_VAR["origin"]?></dd><?php }?>
<?php if($TPL_VAR["maker"]){?><dt>제조사 :</dt><dd><?php echo $TPL_VAR["maker"]?></dd><?php }?>
<?php if($TPL_VAR["brand"]){?><dt>브랜드 :</dt><dd><?php echo $TPL_VAR["brand"]?></dd><?php }?>
<?php if($TPL_VAR["launchdt"]){?><dt>출시일 :</dt><dd><?php echo $TPL_VAR["launchdt"]?></dd><?php }?>
<?php if($TPL_ex_1){foreach($TPL_VAR["ex"] as $TPL_K1=>$TPL_V1){?><dt><?php echo $TPL_K1?> :</dt><dd><?php echo $TPL_V1?></dd><?php }}?>
		<dt>구매수량 :</dt>
		<dd>
<?php if(!$TPL_VAR["runout"]){?>
			<input type=text name="ea" size="2" maxlength="65535" value=1 />개
<?php }else{?>
			품절된 상품입니다
<?php }?>
<?php if($TPL_VAR["min_ea"]> 1){?><div>최소구매수량 : <?php echo $TPL_VAR["min_ea"]?>개</div><?php }?>
<?php if($TPL_VAR["max_ea"]!='0'){?><div>최대구매수량 : <?php echo $TPL_VAR["max_ea"]?>개</div><?php }?>
		</dd>
<?php if($TPL_VAR["chk_point"]){?>
		<dt>고객선호도 :</dt><dd><?php if(is_array($TPL_R1=array_fill( 0,$TPL_VAR["chk_point"],''))&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?>★<?php }}?></dd>
<?php }?>
		</dl>
		</form>
		<hr class="hidden" />

<?php if($TPL_VAR["coupon"]||$TPL_VAR["coupon_emoney"]){?>
		<div id="goods_coupon">
			<!-- 할인쿠폰 다운받기 -->
			<h4 class="hidden">할인쿠폰 다운받기</h4>
			<ul>
				<li><img src="/shop/data/skin_mobile/default/common/img/coupon_txt.gif" alt="할인쿠폰 다운받기" /></li>
<?php if($TPL_a_coupon_1){foreach($TPL_VAR["a_coupon"] as $TPL_V1){?>
				<li>
					<a class="coupon_img type_0<?php echo ($TPL_V1["coupon_img"]+ 1)?>" href="<?php echo $GLOBALS["cfg"]["rootDir"]?>/proc/dn_coupon_goods.php?goodsno=<?php echo $TPL_VAR["goodsno"]?>&couponcd=<?php echo $TPL_V1["couponcd"]?>'" target="ifrmHidden">
					<?php echo $GLOBALS["r_couponAbility"][$TPL_V1["ability"]]?><?php if(substr($TPL_V1["price"], - 1)!="%"){?><?php echo number_format($TPL_V1["price"])?>원<?php }else{?><?php echo $TPL_V1["price"]?><?php }?>
					</a>
				</li>
<?php }}?>
			</ul>
			<hr class="hidden" />
		</div>
<?php }?>

	</div>

	<a name="tab_2"></a>
	<div id="goods_detail">
		<h4 class="hidden">상품상세설명</h4>
<?php if($GLOBALS["cfgMobileShop"]['vtype_mlongdesc']=='1'){?>
<?php if($TPL_VAR["mlongdesc"]){?><?php echo $TPL_VAR["mlongdesc"]?><?php }else{?><?php echo $TPL_VAR["longdesc"]?><?php }?>
<?php }else{?>
		<?php echo $TPL_VAR["longdesc"]?>

<?php }?>
		<hr class="hidden" />
	</div>

	<a name="tab_3"></a>
	<div id="goods_review">
		<h4 class="hidden">상품후기</h4>
		<div id="review_list_container"></div>
		<div class="clearb"></div>
	</div>
</section>


<?php $this->print_("footer",$TPL_SCP,1);?>