<?php /* Template_ 2.2.7 2012/10/04 18:27:50 /www/loosfly_godo_co_kr/shop/data/skin_today/today/todayshop/today_thumb.htm 000002987 */ 
$TPL_todayThumb_1=empty($TPL_VAR["todayThumb"])||!is_array($TPL_VAR["todayThumb"])?0:count($TPL_VAR["todayThumb"]);?>
<html>
<style>
a {cursor:pointer;}
ul { list-style-type:none; }
img { border:0px; }

/* ��ǰ����� */
.thumbBlock { width:80px; }
.thumbBlock .btns { height:16px; overflow:hidden; }
.thumbBlock .imageBlock { overflow:hidden; width:80px; height:380px; background-image:url(/shop/data/skin_today/today/img/btn_s_bg.gif); text-align:center;}
.thumbBlock .imageBlock .imgBox { overflow:hidden; width:72px; height:72px; margin:0px auto; }
.thumbBlock .imageBlock .curgoods { border:solid 1px #c4040d; }
.thumbBlock .imageBlock .others { border:solid 1px #D9D9D9; }
.thumbBlock .imageBlock .space { height:5px; overflow:hidden; }
</style>
<script type="text/javascript">
// ��ǰ����
function selectGoods(tgsno) {
	try
	{
		var regexp = /tgsno=([0-9]*)/g;
		var res = regexp.exec(location.href);
		
		if (res && res.length > 1) {
			var obj = document.getElementById("thumbGoods"+res[1]);
			if (obj) {
				obj.className = obj.className.replace(/others/g, "curgoods");
			}			
		}
	}
	catch (e)
	{}
}

function upTodayGoods() {
	var obj = document.getElementById("thumbList");
	var top = parseInt(obj.style.marginTop);
	if (isNaN(top)) top = 0;
	top += 77;
	if (top > 0) top = 0;
	obj.style.marginTop = top;
}

function downTodayGoods() {
	var obj = document.getElementById("thumbList");
	var top = parseInt(obj.style.marginTop);
	if (isNaN(top)) top = 0;
	top -= 77;
	if (top < -obj.scrollHeight + 380) top = -obj.scrollHeight + 380;
	obj.style.marginTop = top + "px";
}
</script>

<body style="margin:0px;" scroll="no">
<!-- ����� ������ �κн���-------------->
<div class="thumbBlock">
<?php if(count($TPL_VAR["todayThumb"])> 4){?><div class="btns"><a onclick="upTodayGoods()"><img src="/shop/data/skin_today/today/img/btn_s_up.gif" /></a></div>
<?php }else{?><div class="btns"><img src="/shop/data/skin_today/today/img/btn_s_up.gif" /></div>
<?php }?>
	<div class="imageBlock"><div id="thumbList">
<?php if($TPL_todayThumb_1){foreach($TPL_VAR["todayThumb"] as $TPL_V1){?>
			<div class="imgBox others" id="thumbGoods<?php echo $TPL_V1["tgsno"]?>"><a href="<?php echo url("todayshop/today_goods.php?")?>&tgsno=<?php echo $TPL_V1["tgsno"]?>" target="_parent"><?php echo goodsimgTS($TPL_V1["img_s"], 70)?></a></div>
			<div class="space"></div><?php }}?>
		</div>
	</div>
<?php if(count($TPL_VAR["todayThumb"])> 4){?><div class="btns"><a onclick="downTodayGoods()"><img src="/shop/data/skin_today/today/img/btn_s_down.gif" /></a></div>
<?php }else{?><div class="btns"><img src="/shop/data/skin_today/today/img/btn_s_down.gif" /></div>
<?php }?>
</div>
<!-- ����� ������ �κг� --------------->
<script type="text/javascript">selectGoods()</script>
</body>
</html>