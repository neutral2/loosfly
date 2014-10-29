<?php /* Template_ 2.2.7 2013/06/27 18:34:48 /www/loosfly_godo_co_kr/shop/data/skin/loosfly/board/photo/list.htm 000009289 */ 
$TPL_list_1=empty($TPL_VAR["list"])||!is_array($TPL_VAR["list"])?0:count($TPL_VAR["list"]);?>
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
				<img src="/shop/data/skin/loosfly/img/jimmy/titles/main_event_title_01.gif" border="0">			
			</div>
			<div style="height:20px;"></div>
			<div class="divindiv"><!-- Start indiv -->
<?php if(!$GLOBALS["pageView"]){?>
				<?php echo $GLOBALS["bdHeader"]?>

<?php }?>
				<table width="100%" align="center" cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td>
						<form name="frmList" action="<?php echo url("board/list.php")?>&" onsubmit="return chkFormList(this)">
							<input type="hidden" name="id" value="<?php echo $TPL_VAR["id"]?>">
							<table width="100%" cellpadding="0" cellspacing="0">
							<tr>
								<td colspan="10" align="right" class="eng" height="20">
<?php if(!$TPL_VAR["search"]["word"]){?> Total <?php echo $TPL_VAR["recode"]["total"]?> Articles, <?php echo $TPL_VAR["page"]["now"]?> of <?php echo $TPL_VAR["page"]["total"]?> Pages
<?php }else{?>	Search Mode <?php echo $TPL_VAR["page"]["now"]?> Page
<?php }?>
								</td>
							</tr>
							<tr>
<?php if(!($GLOBALS["bdField"]& 1)){?><td align="center" height="30" background="/shop/data/skin/loosfly/board/photo/img/board_bg.gif"><?php echo $TPL_VAR["link"]["chk"]?><img src="/shop/data/skin/loosfly/board/photo/img/board_field_01.gif"><?php echo $TPL_VAR["link"]["end"]?></td><?php }?>
<?php if(!($GLOBALS["bdField"]& 2)){?><td align="center" background="/shop/data/skin/loosfly/board/photo/img/board_bg.gif"><font color="#ffffff" class="small1"><b>번호</td><?php }?>
<?php if(!($GLOBALS["bdField"]& 4)){?>
<?php if($GLOBALS["bdUseSubSpeech"]){?><td align="center" background="/shop/data/skin/loosfly/board/photo/img/board_bg.gif"><?php echo $TPL_VAR["speechBox"]?></td><?php }?>
								<td align="center" colspan="2" background="/shop/data/skin/loosfly/board/photo/img/board_bg.gif"><font color="#ffffff" class="small1"><b>제목</td>
<?php }?>
<?php if(!($GLOBALS["bdField"]& 8)){?><td align="center" background="/shop/data/skin/loosfly/board/photo/img/board_bg.gif"><font color="#ffffff" class="small1"><b>글쓴이</td><?php }?>
<?php if(!($GLOBALS["bdField"]& 16)){?><td align="center" background="/shop/data/skin/loosfly/board/photo/img/board_bg.gif"><font color="#ffffff" class="small1"><b>날짜</td><?php }?>
<?php if(!($GLOBALS["bdField"]& 32)){?><td align="center" background="/shop/data/skin/loosfly/board/photo/img/board_bg.gif"><font color="#ffffff" class="small1"><b>조회</td><?php }?>
							</tr>

<?php if($TPL_list_1){foreach($TPL_VAR["list"] as $TPL_V1){?>
							<tr height="30" onmouseover="this.style.backgroundColor='#FAFAFA'" onmouseout="this.style.backgroundColor=''" <?php if($GLOBALS["checked"]['chk'][$TPL_V1["no"]]){?>bgcolor="#F7F7F7"<?php }elseif($TPL_V1["notice"]){?>bgcolor="#FAFAFA"<?php }?>>
<?php if(!($GLOBALS["bdField"]& 1)){?>
								<td width="20" nowrap align="center"><input type="checkbox" name="sel[]" value="<?php echo $TPL_V1["no"]?>" <?php echo $GLOBALS["checked"]['chk'][$TPL_V1["no"]]?>></td>
<?php }?>
<?php if(!($GLOBALS["bdField"]& 2)){?>
								<td width="50" nowrap align="center" class="eng">
<?php if($TPL_V1["notice"]){?><img src="/shop/data/skin/loosfly/board/photo/img/board_notice.gif" align="absmiddle"><?php }else{?><?php echo $TPL_V1["num"]?><?php }?>
								</td>
<?php }?>
<?php if(!($GLOBALS["bdField"]& 4)){?>
<?php if($GLOBALS["bdUseSubSpeech"]){?><td width="50" nowrap><?php if($TPL_V1["category"]){?>[<?php echo $TPL_V1["category"]?>]<?php }?></td><?php }?>
								<td>
								<!--td width="<?php echo ($GLOBALS["bdListImgSizeW"]+ 2)?>" height="<?php echo ($GLOBALS["bdListImgSizeH"]+ 2)?>"-->
<?php if($GLOBALS["bdListImg"]== 2){?>
									<?php echo $TPL_V1["link"]["view"]?>

<?php }elseif($TPL_V1["imgContents"]){?>
									<!--a href="javascript:popupImg('<?php echo $TPL_V1["imgContents"]?>')"><img src="<?php echo $TPL_V1["imgContents"]?>" width="<?php echo $TPL_V1["imgSizeW"]?>" height="<?php echo $TPL_V1["imgSizeH"]?>" onerror="this.src='/shop/data/skin/loosfly/board/photo/img/noimg.gif'" style="border:1px solid #efefef;padding:1px"></a-->
<?php }elseif($TPL_V1["imgnm"]){?>
									<!--a href="javascript:popupImg('../data/board/<?php echo $TPL_VAR["id"]?>/<?php echo $TPL_V1["imgnm"]?>')"><img src="../data/board/<?php echo $TPL_VAR["id"]?>/t/<?php echo $TPL_V1["imgnm"]?>" width="<?php echo $TPL_V1["imgSizeW"]?>" height="<?php echo $TPL_V1["imgSizeH"]?>" onerror="this.src='/shop/data/skin/loosfly/board/photo/img/noimg.gif'" style="border:1px solid #efefef;padding:1px"></a-->
<?php }else{?>
									<!--img src="/shop/data/skin/loosfly/board/photo/img/noimg.gif" width="<?php echo $TPL_V1["imgSizeW"]?>" height="<?php echo $TPL_V1["imgSizeH"]?>" style="border:1px solid #efefef;padding:1px"-->
<?php }?>
								</td>
								<td width="100%" style="padding-left:10px">
								<?php echo $TPL_V1["gapReply"]?><?php if($TPL_V1["sub"]){?><img src="/shop/data/skin/loosfly/board/photo/img/board_re.gif" align="absmiddle"><?php }?>
								<?php echo $TPL_V1["link"]["view"]?><?php if($TPL_V1["notice"]){?><b style="color:#FE8300"><?php }?><?php echo $TPL_V1["subject"]?><?php echo $TPL_VAR["link"]["end"]?>

<?php if($GLOBALS["bdUseComment"]&&$TPL_V1["comment"]){?>&nbsp;<span class="engs"><FONT COLOR="#007FC8">[<?php echo $TPL_V1["comment"]?>]</FONT></span><?php }?>
<?php if($TPL_V1["secret"]){?><img src="/shop/data/skin/loosfly/board/photo/img/icn_secret.gif" align="absmiddle"><?php }?>
<?php if($TPL_V1["new"]){?><img src="/shop/data/skin/loosfly/board/photo/img/board_new.gif" align="absmiddle"><?php }?>
<?php if($TPL_V1["hot"]){?><img src="/shop/data/skin/loosfly/board/photo/img/board_hot.gif" align="absmiddle"><?php }?>
								<?php echo $TPL_V1["xx"]?>

								</td>
<?php }?>
<?php if(!($GLOBALS["bdField"]& 8)){?>
								<td width="100" nowrap align="center">
<?php if($TPL_V1["m_no"]){?><b><?php }?><?php echo $TPL_V1["name"]?>

								</td>
<?php }?>
<?php if(!($GLOBALS["bdField"]& 16)){?>
								<td width="100" nowrap align="center" class="eng"><?php echo substr($TPL_V1["regdt"], 0, 10)?></td>
<?php }?>
<?php if(!($GLOBALS["bdField"]& 32)){?>
								<td width="30" nowrap align="center" class="eng"><?php if($TPL_V1["hot"]){?><font color="#FF6C68"><?php }?><?php echo $TPL_V1["hit"]?></td>
<?php }?>
							</tr>
							<tr><td colspan="10" height=1 bgcolor="#E0DFDF"></td></tr>
<?php }}?>
							</table>

							<div style="padding-top:20px"></div>

							<table width="100%">
							<tr>
								<td class="eng">
								<?php echo $TPL_VAR["page"]["navi"]?>

<?php if($TPL_VAR["link"]["prev"]){?><?php echo $TPL_VAR["link"]["prev"]?>이전<?php echo $TPL_VAR["link"]["end"]?> <?php }?>
<?php if($TPL_VAR["link"]["next"]){?><?php echo $TPL_VAR["link"]["next"]?>다음<?php echo $TPL_VAR["link"]["end"]?><?php }?>
								</td>
								<td align="right">
									<table cellpadding=0 cellspacing=0>
									<tr>
										<td class=stxt>
<?php if(!($GLOBALS["bdField"]& 8)){?>
										<input type=checkbox name="search[name]" <?php echo $TPL_VAR["checked"]['search']['name']?>>이름
<?php }?>
										<input type=checkbox name="search[subject]" <?php echo $TPL_VAR["checked"]['search']['subject']?>>제목
										<input type=checkbox name="search[contents]" <?php echo $TPL_VAR["checked"]['search']['contents']?>>내용&nbsp;
										</td>
										<td><input name="search[word]" value="<?php echo $TPL_VAR["search"]["word"]?>" style="background-color:#FFFFFF;border:1px solid #DFDFDF;width:140" required></td>
										<td><a href="javascript:document.frmList.submit()"><img src="/shop/data/skin/loosfly/board/photo/img/board_btn_search.gif"></a></td>
										<td><a href="<?php echo url("board/list.php?")?>&id=<?php echo $TPL_VAR["id"]?>"><img src="/shop/data/skin/loosfly/board/photo/img/board_btn_cancel.gif"></a></td>
									</tr>
									</table>
								</td>
							</tr>
							</table>
<?PHP if(  $GLOBALS["sess"]["m_id"] == "loosshop" ) { ?>
<?php if($TPL_VAR["link"]["delete"]){?><?php echo $TPL_VAR["link"]["delete"]?><img src="/shop/data/skin/loosfly/board/photo/img/board_btn_delete.gif"><?php echo $TPL_VAR["link"]["end"]?> <?php }?>
							<?php echo $TPL_VAR["link"]["list"]?><img src="/shop/data/skin/loosfly/board/photo/img/board_btn_list.gif"><?php echo $TPL_VAR["link"]["end"]?>

<?php if($TPL_VAR["link"]["write"]){?><?php echo $TPL_VAR["link"]["write"]?><img src="/shop/data/skin/loosfly/board/photo/img/board_btn_write.gif"><?php echo $TPL_VAR["link"]["end"]?><?php }?>
<?PHP } ?>
						</form>
					</td>
				</tr>
				</table>
<?php if(!$GLOBALS["pageView"]){?>
				<?php echo $GLOBALS["bdFooter"]?>

<?php }?>
			</div>
		</div>

<?php $this->print_("footer",$TPL_SCP,1);?>