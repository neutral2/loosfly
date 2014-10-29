<?php /* Template_ 2.2.7 2012/10/04 18:27:50 /www/loosfly_godo_co_kr/shop/data/skin_mobile/default/goods/list.htm 000003142 */  $this->include_("dataSubCategory");?>
<?php $this->print_("header",$TPL_SCP,1);?>


<?php if($TPL_VAR["page_title"]){?>
<?php $this->print_("sub_header",$TPL_SCP,1);?>

<?php }?>

<script>
function sort(sort)
{
	document.location.href="?category=<?php echo $GLOBALS["category"]?>&sort="+encodeURI(sort);
}
</script>

<section id="goods">
	<div class="list_header">
<?php if($GLOBALS["cntSubCategory"]){?>
		<ul class="sub_category">
<?php if(is_array($TPL_R1=dataSubCategory($GLOBALS["category"],true))&&!empty($TPL_R1)){$TPL_S1=count($TPL_R1);$TPL_I1=-1;foreach($TPL_R1 as $TPL_V1){$TPL_I1++;?>
			<li <?php if($TPL_I1!=$TPL_S1- 1){?>class="bar"<?php }?>><a href="?category=<?php echo $TPL_V1["category"]?>"><?php echo $TPL_V1["catnm"]?> (<?php echo $TPL_V1["gcnt"]+ 0?>)</a>
<?php }}?>
		</ul>
<?php }?>

		<div class="list_sort">
			<select name="sort" onchange="sort(this.options[this.selectedIndex].value)">
				<option value="b.regdt desc" <?php if($GLOBALS["sort"]=="b.regdt desc"){?>selected="selected"<?php }?>>최근등록순</option>
				<option value="c.price" <?php if($GLOBALS["sort"]=="c.price"){?>selected="selected"<?php }?>>낮은가격순</option>
				<option value="c.price desc" <?php if($GLOBALS["sort"]=="c.price desc"){?>selected="selected"<?php }?>>높은가격순</option>
				<option value="c.reserve desc" <?php if($GLOBALS["sort"]=="c.reserve desc"){?>selected="selected"<?php }?>>적립금순</option>
				<option value="b.goodsnm" <?php if($GLOBALS["sort"]=="b.goodsnm"){?>selected="selected"<?php }?>>상품명순</option>
				<option value="b.maker" <?php if($GLOBALS["sort"]=="b.maker"){?>selected="selected"<?php }?>>제조사순</option>
			</select>
		</div>
	</div>

	<div class="list">
		<h4 class="hidden">상품 리스트</h4>
		<?php echo $this->assign('loop',$TPL_VAR["loopM"])?>

		<?php echo $this->assign('cols',$TPL_VAR["lstcfg"]["cols"])?>

		<?php echo $this->assign('size',$TPL_VAR["lstcfg"]["size"])?>

		<?php echo $this->assign('id',"goods_list")?>

		<?php echo $this->define('tpl_include_file_1',"goods/list/tpl_02.htm")?> <?php $this->print_("tpl_include_file_1",$TPL_SCP,1);?>

	</div>
</section>

<div class="indicator"></div>

<script>
var listingCnt = <?php echo count($TPL_VAR["loopM"])?>;
var listingEnd = false;
var listPage = 1;
var listLoading = false;
var listID = '<?php echo $TPL_VAR["id"]?>'
var listCategory = '<?php echo $_GET["category"]?>';
var listSort = '<?php echo $_GET["sort"]?>';
var listKW = '<?php echo $_GET["kw"]?>';

if(window.addEventListener) window.addEventListener("pageshow", goodsListPageShown, false);
else if(window.attachEvent) window.attachEvent("pageshow", goodsListPageShown, false);

</script>

<div onclick="javascript:goodsListScrollEvent();" style="border:solid 1px #9b9b9b;padding:5px 5px 5px 5px;width:97%;background-color:#ededed;color:#003c87;font:bold 12pt Dotum;text-align:center;margin:0 auto;cursor:pointer;">더보기</div>

<?php $this->print_("footer",$TPL_SCP,1);?>