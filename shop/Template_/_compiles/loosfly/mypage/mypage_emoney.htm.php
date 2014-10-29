<?php /* Template_ 2.2.7 2013/05/16 18:47:08 /www/loosfly_godo_co_kr/shop/data/skin/loosfly/mypage/mypage_emoney.htm 000002858 */ 
$TPL__loop_1=empty($GLOBALS["loop"])||!is_array($GLOBALS["loop"])?0:count($GLOBALS["loop"]);?>
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
				<img src="/shop/data/skin/loosfly/img/common/title_point.gif" border="0">			
			</div>
			<div style="height:20px;"></div>
			<div class="divindiv"><!-- Start indiv -->
				<div style="width:100%; text-align:left"><img src="/shop/data/skin/loosfly/img/common/mypoint_01.gif"></div>
				<div style="width:100%; border:1px solid #DEDEDE;">
					<div style="height:30px; border:5px solid #F3F3F3; text-align:center;top:5px;">
						현재 <strong><?php echo $GLOBALS["name"]?></strong>님의 적립금은 <strong><FONT COLOR="#007FC8"><?php echo number_format($GLOBALS["emoney"])?> point</font></strong>입니다
					</div>
				</div>
				<div style="height:10px;"></div>
				<div style="width:100%; text-align:left; padding-top:20"><img src="/shop/data/skin/loosfly/img/common/mypoint_02.gif"></div>
				<table width="100%" border="0" cellspacing="0" cellpadding="5" style="clear:both;border-top-style:solid;border-top-color:#303030;border-top-width:2;border-bottom-style:solid;border-bottom-color:#D6D6D6;border-bottom-width:1;">
				<tr height="23" bgcolor="#F0F0F0" class=input_txt>
					<th width=10%>번호</th>
					<th width=15%>발생일시</th>
					<th>상세내역</th>
					<th width=15%>적립금액</th>
					<th width=15%>사용금액</th>
				</tr>
				<tr><td colspan=5 height=1 bgcolor="#D6D6D6" style="padding:0px;"></td></tr>
<?php if($TPL__loop_1){foreach($GLOBALS["loop"] as $TPL_V1){?>
				<tr height=25 onmouseover=this.style.background="#F7F7F7" onmouseout=this.style.background="" style="border-bottom-style:solid;border-bottom-color:#E6E6E6;border-bottom-width:1;">
					<td align="center"><?php echo $TPL_V1["idx"]?></td>
					<td align="center"><?php echo $TPL_V1["regdts"]?></td>
					<td><?php echo $TPL_V1["memo"]?></td>
					<td align="center"><?php if($TPL_V1["emoney"]> 0){?><?php echo number_format($TPL_V1["emoney"])?><?php }else{?>―<?php }?></td>
					<td align="center"><?php if($TPL_V1["emoney"]< 0){?><?php echo number_format($TPL_V1["emoney"])?><?php }else{?>―<?php }?></td>
				</tr>
				<tr><td colspan=5 height=1 bgcolor="#EEEEEE" style="padding:0px;"></td></tr>
<?php }}?>
				</table>
				<div class="pagediv"><?php echo $TPL_VAR["pg"]->page['navi']?></div>
			</div><!-- End indiv -->
			<div style="height:30px;"></div>
		</div>
<?php $this->print_("footer",$TPL_SCP,1);?>