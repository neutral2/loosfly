<?php /* Template_ 2.2.7 2013/07/09 18:43:47 /www/loosfly_godo_co_kr/shop/data/skin/loosfly/board/webzine/list.htm 000008284 */ 
$TPL_list_1=empty($TPL_VAR["list"])||!is_array($TPL_VAR["list"])?0:count($TPL_VAR["list"]);?>
<?php if(!$GLOBALS["pageView"]){?>
<?php $this->print_("header",$TPL_SCP,1);?> <?php echo $GLOBALS["bdHeader"]?>

<?php }?>
<script language="javascript">
	function comment_stat(tbl, ind) {
		cmnt_tbl = document.getElementById(tbl);
		cmnt_ind = document.getElementById(ind);

		if( cmnt_tbl.style.display != "none" ) {
			cmnt_tbl.style.display = "none";
			cmnt_ind.innerHTML = "댓글보이기 ^";
		}
		else {
			cmnt_tbl.style.display = "block";
			cmnt_ind.innerHTML = "댓글감추기 v";
		}
	};
</script>

		<div id="blkContentsNoMenu">
			<div style="height:15px"></div>
			<div id="bxBlog">
<?php if($TPL_list_1){foreach($TPL_VAR["list"] as $TPL_V1){?>
				<table class="post_head" cellspacing="0" cellpadding="0"><tr><td class="htl" nowrap="nowrap"></td><td class="htc"></td><td class="htr" nowrap="nowrap"></td></tr></table>
				<table id="printPost1" class="post_body" cellspacing="0" cellpadding="0">
				<tr>
					<td class="bcl" nowrap="nowrap"></td>
					<td class="bcc">
						<table class="post_top">
						<tr>
							<td valign="bottom">
								<div class="htitle" id="title_<?php echo $TPL_V1["no"]?>">
									<span class="pcol1"><?php echo $TPL_V1["subject"]?></span>
								</div>
								<p class="date">
									<span class="r _postAddDate"><?php echo $TPL_V1["regdt"]?>

<?php if($TPL_V1["link"]["modify"]){?>&nbsp;&nbsp;|&nbsp;&nbsp;<?php echo $TPL_V1["link"]["modify"]?>수정<?php echo $TPL_VAR["link"]["end"]?><?php }?>
<?php if($TPL_V1["link"]["delete"]){?>&nbsp;&nbsp;|&nbsp;&nbsp;<?php echo $TPL_V1["link"]["delete"]?>삭제<?php echo $TPL_VAR["link"]["end"]?> </span><?php }?>
								</p>
								<p class="dline"></p>
							</td>
						</tr>
						<tr>
							<td valign="bottom">
<?php if($TPL_V1["urlLink"]){?><p class="link">LINK : <a href="<?php echo $TPL_V1["urlLink"]?>" target=_blank><?php echo $TPL_V1["urlLink"]?></a></p><?php }?>
<?php if($TPL_V1["uploadedFile"]){?><p class="file">FILE : <?php echo $TPL_V1["uploadedFile"]?></p><?php }?>
							</td>
						</tr>
						</table>
						<div style="height:30px"></div>
						<div style="margin:0 auto;width:950px;">
							<table width="100%" style="table-layout:fixed" align="center">
							<tr>
								<td style="word-wrap:break-word;word-break:break-all"  valign=top  id=contents_<?php echo $TPL_V1["no"]?> align="center"><?php echo $TPL_V1["contents"]?></td>
							</tr>
							</table>
						</div>
						<div style="height:20px"></div>
						<div style="margin:0 auto;width:940px;">
						<?PHP $cnt=0; ?>
							<table width="100%" style="table-layout:fixed" cellpadding="0" cellspacing="0">
							<tr>
								<td valign="bottom">
									<div class="htitle">
										<a id="comment_ind_<?php echo $TPL_V1["no"]?>" class="pcol1" href="javascript:comment_stat('tbl_comment_<?php echo $TPL_V1["no"]?>', 'comment_ind_<?php echo $TPL_V1["no"]?>');">댓글보이기 ^</a>
									</div>
									<p class="date">
										<span class="r _postAddDate">
<?php if($TPL_V1["link"]["modify"]){?>&nbsp;&nbsp;|&nbsp;&nbsp;<?php echo $TPL_V1["link"]["modify"]?>수정<?php echo $TPL_VAR["link"]["end"]?><?php }?>
<?php if($TPL_V1["link"]["delete"]){?>&nbsp;&nbsp;|&nbsp;&nbsp;<?php echo $TPL_V1["link"]["delete"]?>삭제<?php echo $TPL_VAR["link"]["end"]?> </span><?php }?>
									</p>
									<p class="dline"></p>
								</td>
							</tr>
							<tr>
								<td>
<?php if($GLOBALS["bdUseComment"]){?>
									<table id="tbl_comment_<?php echo $TPL_V1["no"]?>" width="100%" cellpadding="0" cellspacing="0" style="display:none;">
									<tr>
										<td>
											<table width="100%" cellpadding="0" cellspacing="0" bgcolor="#F6F5F4">
<?php if(is_array($TPL_R2=$TPL_V1["loopComment"])&&!empty($TPL_R2)){foreach($TPL_R2 as $TPL_V2){?>
											<?PHP if ( $cnt++ > 0 ) { ?>
											<tr><td colspan="2" valign="middle" style="padding:0 10px 0 10px;"><p class="dline"></p></td></tr>
											<?PHP } ?>
											<tr><td colspan="2" height="5"> </td></tr>
											<tr height="22">
												<td width="50%" style="padding-left:10px;" align="left"><?php echo $TPL_V2["name"]?></td>
												<td style="padding-right:10px" nowrap><div class="comment_date"><?php echo $TPL_V2["regdt"]?><?php if($TPL_V2["link"]["modify"]){?><?php echo $TPL_V2["link"]["modify"]?>&nbsp;&nbsp;|&nbsp;&nbsp;수정<?php echo $TPL_VAR["link"]["end"]?><?php }else{?> <?php }?><?php if($TPL_V2["link"]["delete"]){?><?php echo $TPL_V2["link"]["delete"]?>&nbsp;&nbsp;|&nbsp;&nbsp;삭제<?php echo $TPL_VAR["link"]["end"]?><?php }else{?> <?php }?></div></td>
											</tr>
											<tr><td colspan="2" height="5"> </td></tr>
											<tr>
												<td colspan="2" style="padding-left:10px; word-wrap:break-word; word-break:break-all;" align="left"><?php echo $TPL_V2["comment"]?></td>
											</tr>
											<tr><td colspan="2" height="5"> </td></tr>
<?php }}?>
											</table>
										</td>
									</tr>
									<tr><td height="20"> </td></tr>
									<tr>
										<td>
				
<?php if(!$GLOBALS["bdDenyComment"]){?>
										<form name="frmComment_<?php echo $TPL_V1["no"]?>" method="post" enctype="multipart/form-data" action="<?php echo url("board/comment_ok.php")?>&" onsubmit="return chkForm(this)">
										<input type=hidden name=id value="<?php echo $TPL_VAR["id"]?>">
										<input type=hidden name=no value="<?php echo $TPL_V1["no"]?>">
										<input type=hidden name=mode value="write">
										<input type=hidden name=returnUrl value="<?php echo $_SERVER["REQUEST_URI"]?>">
										<table width="100%" align="left">
										<tr>
											<td align="left" valign="middle" height="20" width="300" nowrap>
<?php if($TPL_VAR["readonly"]["name"]){?>
												<?php echo $GLOBALS["member"]["name"]?>님의 코멘트
<?php }?>
											</td>
											<td width="550"></td>
											<td></td>
										</tr>
										<tr>
											<td colspan="3" height="60" align="left">
<?php if($TPL_VAR["readonly"]["name"]){?>
											<textarea name=memo style="width:850px;height:60px;resize:none;overflow:hidden" class=linebg required msgR="코멘트를 입력해주세요"></textarea>
<?php }else{?>
											<textarea name=memo style="width:850px;height:60px;resize:none;overflow:hidden" class=linebg required msgR="코멘트를 입력해주세요" onkeyup="commentLoginAlert(this);" onclick="commentLoginAlert(this);"></textarea>
<?php }?>
											</td>
											<td valign="middle">
											<input type="image" src="/shop/data/skin/loosfly/img/jimmy/blog_button_01.gif" style="border:0 none;">
											</td>
										</tr>
										</table>
										</form>
<?php }?>
										</td>
									</tr>
									</table>
								</td>
							</tr>
<?php }?>
							</table>
						</div>
					</td>
					<td class="bcr" nowrap="nowrap"></td>
				</tr>
				</table>
				<table class="post_footer" cellspacing="0" cellpadding="0"><tbody><tr><td class="ftl" nowrap="nowrap"></td><td class="ftc"></td><td class="ftr" nowrap="nowrap"></td></tr></tbody></table>
				<div style="height:20px"></div>
<?php }}?>
				<table width="100%" cellspacing="0" cellpadding="0" border="0">
				<tr>
					<td width="30%"></td>
					<td align="center">
					<?php echo $TPL_VAR["page"]["navi"]?>

<?php if($TPL_VAR["link"]["prev"]){?><?php echo $TPL_VAR["link"]["prev"]?>이전<?php echo $TPL_VAR["link"]["end"]?> <?php }?>
<?php if($TPL_VAR["link"]["next"]){?><?php echo $TPL_VAR["link"]["next"]?>다음<?php echo $TPL_VAR["link"]["end"]?><?php }?>
					</td>
					<td width="30%" style="padding-right:31px;"><?php if($TPL_VAR["link"]["write"]){?><?php echo $TPL_VAR["link"]["write"]?><img src="/shop/data/skin/loosfly/img/jimmy/write_button_01.gif"><?php echo $TPL_VAR["link"]["end"]?><?php }?></td>
				</tr>
				</table>
			</div>
		</div>
		<div style="height:30px;"></div>

<?php if(!$GLOBALS["pageView"]){?><?php echo $GLOBALS["bdFooter"]?> <?php $this->print_("footer",$TPL_SCP,1);?><?php }?>