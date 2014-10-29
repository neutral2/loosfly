<?php /* Template_ 2.2.7 2013/12/16 18:59:11 /www/loosfly_godo_co_kr/shop/data/skin/loosfly/member/myinfo.htm 000000786 */ ?>
<?php $this->print_("header",$TPL_SCP,1);?>


<?php if($this->tpl_['side_inc']){?>
		<div class="blkLeftMenu">
<?php $this->print_("side_inc",$TPL_SCP,1);?>

		</div>
<?php }?>
		<div id="blkContents">
			<div style="height:7px;"></div>
			<!-- 상단이미지 -->
			<div id="bxBodyTitle">
				<img src="/shop/data/skin/loosfly/img/jimmy/titles/a_settings_title_01.gif" border="0">			
			</div>
			<div style="height:20px;"></div>
			<div class="divindiv"><!-- Start indiv -->
<?php $this->print_("frmMember",$TPL_SCP,1);?>

			</div><!-- End indiv -->
			<div style="height:30px;"></div>
		</div>
<?php $this->print_("footer",$TPL_SCP,1);?>