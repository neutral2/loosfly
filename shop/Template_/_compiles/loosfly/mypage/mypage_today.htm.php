<?php /* Template_ 2.2.7 2013/06/29 11:07:52 /www/loosfly_godo_co_kr/shop/data/skin/loosfly/mypage/mypage_today.htm 000006743 */ ?>
<?php $this->print_("header",$TPL_SCP,1);?>


<?php if($this->tpl_['side_inc']){?>
		<div class="blkLeftMenu">
<?php $this->print_("side_inc",$TPL_SCP,1);?>

		</div>
<?php }?>
	<div id="blkContents">
		<div style="height:15px;"></div>
		<!-- 상단이미지 || 현재위치 -->
		<TABLE width=100% cellpadding=0 cellspacing=0 border=0>
		<tr><td><img src="/shop/data/skin/loosfly/img/jimmy/titles/saw_list_title_01.gif" border=0></td></tr>
		</TABLE>

		<div style="height:15px;"></div>
		<div class="divindiv"><!-- Start indiv -->
			<form name=frmList>
				<input type=hidden name=searched value="Y">
				<input type=hidden name=sort value="<?php echo $_GET['sort']?>">
				<input type=hidden name=page_num value="<?php echo $_GET['page_num']?>">
		
				<table width=100% border=0 cellpadding=0 cellspacing=0>
				<tr><td height=18></td></tr>
				<tr>
					<td bgcolor=9e9e9e class=small height=27 style="padding:0 0 0 5">
						<table width=100% border=0 cellpadding=0 cellspacing=0>
						<tr>
							<td id="b_white"><img src="/shop/data/skin/loosfly/img/common/icon_goodalign2.gif" align=absmiddle>
							<FONT COLOR="#FFFFFF">총 <b><?php echo $TPL_VAR["pg"]->recode['total']?></b>개의 상품이 있습니다.</FONT>
							</td>
						</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<!-- capture_start("list_top") -->
						<table width=100% cellpadding=0 cellspacing=0>
						<tr>
							<td><img src="/shop/data/skin/loosfly/img/common/goodlist_txt_01.gif"><a href="javascript:sort('maker')"><img name=sort_maker src="/shop/data/skin/loosfly/img/common/list_up_off.gif"></a><a href="javascript:sort('maker desc')"><img name=sort_maker_desc src="/shop/data/skin/loosfly/img/common/list_down_off.gif"></a><img src="/shop/data/skin/loosfly/img/common/goodlist_txt_03.gif"><a href="javascript:sort('goodsnm')"><img name=sort_goodsnm src="/shop/data/skin/loosfly/img/common/list_up_off.gif"></a><a href="javascript:sort('goodsnm desc')"><img name=sort_goodsnm_desc src="/shop/data/skin/loosfly/img/common/list_down_off.gif"></a><img src="/shop/data/skin/loosfly/img/common/goodlist_txt_04.gif"><a href="javascript:sort('price')"><img name=sort_price src="/shop/data/skin/loosfly/img/common/list_up_off.gif"></a><a href="javascript:sort('price desc')"><img name=sort_price_desc src="/shop/data/skin/loosfly/img/common/list_down_off.gif"></a></td>
							<td align=right><img src="/shop/data/skin/loosfly/img/common/goodlist_txt_06.gif" align=absmiddle><select onchange="this.form.page_num.value=this.value;this.form.submit()" style="font:8pt 돋움"><?php if(is_array($TPL_R1=$TPL_VAR["lstcfg"]["page_num"])&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?><option value="<?php echo $TPL_V1?>" <?php echo $GLOBALS["selected"]["page_num"][$TPL_V1]?>><?php echo $TPL_V1?>개씩 정렬<?php }}?></select></td>
						</tr>
						</table>
		
		<script>
		function sort(sort){
			var fm = document.frmList;
			fm.sort.value = sort;
			fm.submit();
		}
		function sort_chk(sort){
			if (!sort) return;
			sort = sort.replace(" ","_");
			var obj = document.getElementsByName('sort_'+sort);
			if (obj.length){
				div = obj[0].src.split('list_');
				for (i=0;i<obj.length;i++){
					chg = (div[1]=="up_off.gif") ? "up_on.gif" : "down_on.gif";
					obj[i].src = div[0] + "list_" + chg;
				}
			}
		}
<?php if($_GET['sort']){?>
		if (is_sort) sort_chk('<?php echo $_GET['sort']?>');
<?php }?>
		var is_sort = 1;
		</script>
					<!-- capture_end ("list_top") -->
					</td>
				</tr>
				<tr><td height="1" bgcolor=#DDDDDD style="padding:0px"></td></tr>
				<tr>
					<td style="padding:15px 0">
					<?php echo $this->assign('cols',$TPL_VAR["lstcfg"]["cols"])?>

					<?php echo $this->assign('size',$TPL_VAR["lstcfg"]["size"])?>

					<?php echo $this->define('tpl_include_file_1',"goods/list/".$TPL_VAR["lstcfg"]["tpl"].".htm")?> <?php $this->print_("tpl_include_file_1",$TPL_SCP,1);?>

					</td>
				</tr>
				<tr><td height=1 bgcolor=#DDDDDD style="padding:0px"></td></tr>
				<tr>
					<td>
					<!-- capture_start("list_top") -->
						<table width=100% cellpadding=0 cellspacing=0>
						<tr>
							<td><img src="/shop/data/skin/loosfly/img/common/goodlist_txt_01.gif"><a href="javascript:sort('maker')"><img name=sort_maker src="/shop/data/skin/loosfly/img/common/list_up_off.gif"></a><a href="javascript:sort('maker desc')"><img name=sort_maker_desc src="/shop/data/skin/loosfly/img/common/list_down_off.gif"></a><img src="/shop/data/skin/loosfly/img/common/goodlist_txt_03.gif"><a href="javascript:sort('goodsnm')"><img name=sort_goodsnm src="/shop/data/skin/loosfly/img/common/list_up_off.gif"></a><a href="javascript:sort('goodsnm desc')"><img name=sort_goodsnm_desc src="/shop/data/skin/loosfly/img/common/list_down_off.gif"></a><img src="/shop/data/skin/loosfly/img/common/goodlist_txt_04.gif"><a href="javascript:sort('price')"><img name=sort_price src="/shop/data/skin/loosfly/img/common/list_up_off.gif"></a><a href="javascript:sort('price desc')"><img name=sort_price_desc src="/shop/data/skin/loosfly/img/common/list_down_off.gif"></a></td>
							<td align=right><img src="/shop/data/skin/loosfly/img/common/goodlist_txt_06.gif" align=absmiddle><select onchange="this.form.page_num.value=this.value;this.form.submit()" style="font:8pt 돋움"><?php if(is_array($TPL_R1=$TPL_VAR["lstcfg"]["page_num"])&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?><option value="<?php echo $TPL_V1?>" <?php echo $GLOBALS["selected"]["page_num"][$TPL_V1]?>><?php echo $TPL_V1?>개씩 정렬<?php }}?></select></td>
						</tr>
						</table>
		
		<script>
		function sort(sort){
			var fm = document.frmList;
			fm.sort.value = sort;
			fm.submit();
		}
		function sort_chk(sort){
			if (!sort) return;
			sort = sort.replace(" ","_");
			var obj = document.getElementsByName('sort_'+sort);
			if (obj.length){
				div = obj[0].src.split('list_');
				for (i=0;i<obj.length;i++){
					chg = (div[1]=="up_off.gif") ? "up_on.gif" : "down_on.gif";
					obj[i].src = div[0] + "list_" + chg;
				}
			}
		}
<?php if($_GET['sort']){?>
		if (is_sort) sort_chk('<?php echo $_GET['sort']?>');
<?php }?>
		var is_sort = 1;
		</script>
					<!-- capture_end ("list_top") -->
					</td>
				</tr>
				<tr><td height=2 bgcolor=#DDDDDD></td></tr>
				<tr><td align=center height=30 bgcolor="#F3F3F3"><?php echo $TPL_VAR["pg"]->page['navi']?></td></tr>
				</table>
			</form>
			<br><br>
		</div><!-- End indiv -->
		<div style="height:30px;"></div>
	</div>
<?php $this->print_("footer",$TPL_SCP,1);?>