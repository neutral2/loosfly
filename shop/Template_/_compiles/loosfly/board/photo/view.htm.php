<?php /* Template_ 2.2.7 2013/06/27 17:43:21 /www/loosfly_godo_co_kr/shop/data/skin/loosfly/board/photo/view.htm 000003333 */ 
$TPL_loop_1=empty($TPL_VAR["loop"])||!is_array($TPL_VAR["loop"])?0:count($TPL_VAR["loop"]);?>
<?php $this->print_("header",$TPL_SCP,1);?>

<?php if($this->tpl_['side_inc']){?>
		<div class="blkLeftMenu">
<?php $this->print_("side_inc",$TPL_SCP,1);?>

		</div>
<?php }?>
	
		<div id="blkContents">
			<div style="height:5px;"></div>
			<div class="divindiv"><!-- Start indiv -->
<?php if(!$GLOBALS["pageView"]){?>
				<?php echo $GLOBALS["bdHeader"]?>

<?php }?>
				<table width="100%" align="center" cellpadding=0 cellspacing=0>
				<tr>
					<td>
<?php if($TPL_loop_1){foreach($TPL_VAR["loop"] as $TPL_V1){?>
						<table width=100% cellpadding=0 cellspacing=0>
						<tr>
							<td align=right class=eng style="padding:5">
							Posted at <?php echo $TPL_V1["regdt"]?>

							</td>
						</tr>
						<tr>
							<td style="padding:10" height=300 valign=top>
						
							<table width=100% style="table-layout:fixed">
							<tr>
								<td style="word-wrap:break-word;word-break:break-all" id=contents_<?php echo $TPL_V1["no"]?>></td>
							</tr>
							</table>
						
							</td>
						</tr>
						<tr><td height=10 style="font-size:0;padding:0px;"></td></tr>
						<tr><td height=1 bgcolor="#E0DFDF" colspan=2 style="font-size:0;padding:0px;"></td></tr>
						<tr><td height=3 bgcolor="#F7F7F7" colspan=2 style="font-size:0;padding:0px;"></td></tr>
						</table><br>

						<table width=100% style="table-layout:fixed" cellpadding=0 cellspacing=0>
						<tr>
							<td align=center style="padding-top:10">
								<table width=100%>
								<tr>
<?PHP if(  $GLOBALS["sess"]["m_id"] == "loosshop" ) { ?>
									<td>
<?php if($TPL_V1["link"]["modify"]){?><?php echo $TPL_V1["link"]["modify"]?><img src="/shop/data/skin/loosfly/board/photo/img/board_btn_modify.gif"><?php echo $TPL_VAR["link"]["end"]?> <?php }?>
<?php if($TPL_V1["link"]["delete"]){?><?php echo $TPL_V1["link"]["delete"]?><img src="/shop/data/skin/loosfly/board/photo/img/board_btn_delete.gif"><?php echo $TPL_VAR["link"]["end"]?> <?php }?>
<?php if($TPL_VAR["link"]["write"]){?><?php echo $TPL_V1["link"]["reply"]?><img src="/shop/data/skin/loosfly/board/photo/img/board_btn_reply.gif"><?php echo $TPL_VAR["link"]["end"]?><?php }?>
<?php if($TPL_VAR["link"]["write"]){?><?php echo $TPL_VAR["link"]["write"]?><img src="/shop/data/skin/loosfly/board/photo/img/board_btn_write.gif"><?php echo $TPL_VAR["link"]["end"]?><?php }?>
									</td>
<?PHP } ?>
									<td align=right>
									<?php echo $TPL_VAR["link"]["list"]?><img src="/shop/data/skin/loosfly/board/photo/img/board_btn_list.gif"><?php echo $TPL_VAR["link"]["end"]?>

									</td>
								</tr>
								</table>
							</td>
						</tr>
						</table>
<br>
						<textarea id=examC_<?php echo $TPL_V1["no"]?> style="display:none"><?php echo htmlspecialchars($TPL_V1["contents"])?></textarea>
<?php }}?>
					</td>
				</tr>
				</table>

<?php if($GLOBALS["bdTypeView"]== 2){?><?php $this->print_("list",$TPL_SCP,1);?><?php }?>

<?php if(!$GLOBALS["pageView"]){?>
				<?php echo $GLOBALS["bdFooter"]?>

<?php }?>
			</div>
		</div>

<?php $this->print_("footer",$TPL_SCP,1);?>