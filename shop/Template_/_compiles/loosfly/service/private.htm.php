<?php /* Template_ 2.2.7 2013/07/29 16:47:51 /www/loosfly_godo_co_kr/shop/data/skin/loosfly/service/private.htm 000001527 */ ?>
<?php $this->print_("header",$TPL_SCP,1);?>


<style><!--
.billbox { BORDER-RIGHT: #f0f0f0 6px solid; BORDER-TOP: #f0f0f0 6px solid; BORDER-LEFT: #f0f0f0 6px solid; BORDER-BOTTOM: #f0f0f0 6px solid; padding:12px; }
#listbox { BORDER-TOP: #dddddd 1px solid; BORDER-BOTTOM: #dddddd 1px solid; padding:7px; margin-top:16px; }
#listbox td td { PADDING-TOP: 3px; }
.content_title { float:left; font-weight:bold; }
.content_top { float:right; margin-top:5px}
#contentbox {  margin-top:16px; }
#contentbox th { padding:6px; background-color:#F1F1F1; border-bottom:1px solid #E1E1E1;}
#contentbox td { padding:10px; }
--></style>

<!-- 상단이미지 || 현재위치 -->
<?php if($this->tpl_['side_inc']){?>
		<div class="blkLeftMenu">
<?php $this->print_("side_inc",$TPL_SCP,1);?>

		</div>
<?php }?>
	<div id="blkContents">
		<div style="height:7px;"></div>
		<!-- 상단이미지 -->
		<div id="bxBodyTitle">
			<img src="/shop/data/skin/loosfly/img/jimmy/titles/privacy_title_01.gif" border="0">			
		</div>
		<div style="height:20px;"></div>
		<div class="divindiv"><!-- Start indiv -->
			<A name="ptop"></A>
			<div style="border:1px solid #DEDEDE;" class="hundred">
			<?php echo $this->define('tpl_include_file_1',"/service/_private.txt")?> <?php $this->print_("tpl_include_file_1",$TPL_SCP,1);?>

			</div>

		</div>
	</div>


<?php $this->print_("footer",$TPL_SCP,1);?>