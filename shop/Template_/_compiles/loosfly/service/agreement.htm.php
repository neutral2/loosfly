<?php /* Template_ 2.2.7 2013/07/29 18:56:38 /www/loosfly_godo_co_kr/shop/data/skin/loosfly/service/agreement.htm 000001305 */ ?>
<?php $this->print_("header",$TPL_SCP,1);?>

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
			<img src="/shop/data/skin/loosfly/img/jimmy/titles/agreement_title_01.gif" border="0">			
		</div>
		<div style="height:20px;"></div>
		<div class="divindiv"><!-- Start indiv -->
			<div id="agreePaste" style="text-align:left;" class="hundred"></div>
		</div><!-- End indiv -->


<!-- 지우지 마세요 - agreePaste로 Text 약관을 붙여넣는 소스임 : start -->
<textarea style="width:0; height:0; display:none;" id="agreeCopy"><?php echo $this->define('tpl_include_file_1',"proc/_agreement.txt")?> <?php $this->print_("tpl_include_file_1",$TPL_SCP,1);?></textarea>
<script language="javascript">document.getElementById('agreePaste').innerHTML = document.getElementById('agreeCopy').value.replace( /\n/ig, "<br>");</script>
<!-- 지우지 마세요 : end -->
		<div style="height:30px;"></div>
	</div>
<?php $this->print_("footer",$TPL_SCP,1);?>