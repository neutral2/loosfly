<?php /* Template_ 2.2.7 2013/04/16 10:58:59 /www/loosfly_godo_co_kr/shop/data/skin/loosfly/setGoods/main/relationCody.htm 000000843 */ 
if (is_array($TPL_VAR["obj"])) $TPL_obj_1=count($TPL_VAR["obj"]); else if (is_object($TPL_VAR["obj"]) && in_array("Countable", class_implements($TPL_VAR["obj"]))) $TPL_obj_1=$TPL_VAR["obj"]->count();else $TPL_obj_1=0;?>
<div style="text-align:left;margin:20px 0px 26px 28px;"><img src="/shop/data/skin/loosfly/setGoods/img/front/subtitle_othercody.gif"/></div>
	<!-- 다른코디보기 -->
	<ul class="relationCody-list">
<?php if($TPL_obj_1){foreach($TPL_VAR["obj"] as $TPL_V1){?>
		<li><a href="<?php echo url("setGoods/content.php?")?>&idx=<?php echo $TPL_V1["idx"]?>" ><img class="Image" src="../setGoods/data/Tnail/100/100_<?php echo $TPL_V1["thumnail_name"]?>" border=0/></a></li>
<?php }}?>
	</ul>