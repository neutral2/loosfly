<?php /* Template_ 2.2.7 2013/04/16 09:20:55 /www/loosfly_godo_co_kr/shop/data/skin/apple_tree/main/index.htm 000008144 */  $this->include_("dataPopup","dataBanner","dataBoardArticle","dataDisplayGoods");?>
<?php $this->print_("header",$TPL_SCP,1);?>


<!-- 메인팝업창 -->
<?php if(is_array($TPL_R1=dataPopup())&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?>

<?php if($TPL_V1["type"]=='layer'&&isset($_COOKIE['blnCookie_'.$TPL_V1["code"]])===false){?>
<div id="<?php echo 'blnCookie_'.$TPL_V1["code"]?>" STYLE="position:absolute; width:<?php echo $TPL_V1["width"]?>; height:<?php echo $TPL_V1["height"]?>; left:<?php echo $TPL_V1["left"]?>; top:<?php echo $TPL_V1["top"]?>; z-index:200;">
<?php echo eval("\$_GET[code]='blnCookie_".$TPL_V1["code"]."';")?>

<?php echo $this->define('tpl_include_file_1',$TPL_V1["file"])?> <?php $this->print_("tpl_include_file_1",$TPL_SCP,1);?>

</div>
<?php }?>

<?php if($TPL_V1["type"]=='layerMove'&&isset($_COOKIE['blnCookie_'.$TPL_V1["code"]])===false){?>
<!-- 이동레이어 팝업창 시작 -->
<div id="<?php echo 'blnCookie_'.$TPL_V1["code"]?>" STYLE="position:absolute; width:<?php echo $TPL_V1["width"]?>; height:<?php echo $TPL_V1["height"]?>; left:<?php echo $TPL_V1["left"]?>; top:<?php echo $TPL_V1["top"]?>; z-index:200;">
<div onmousedown="Start_move(event,'<?php echo 'blnCookie_'.$TPL_V1["code"]?>');" onmouseup="Moveing_stop();" style='cursor:move;'>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
<td>
<?php echo eval("\$_GET[code]='blnCookie_".$TPL_V1["code"]."';")?>

<?php echo $this->define('tpl_include_file_1',$TPL_V1["file"])?> <?php $this->print_("tpl_include_file_1",$TPL_SCP,1);?>

</td>
</tr>
</table>
</div>
</div>
<!-- 이동레이어 팝업창 끝 -->
<?php }?>

<?php }}?>

<script language="JavaScript"><!--
<?php if(is_array($TPL_R1=dataPopup())&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?>
<?php if($TPL_V1["type"]==''){?>
if ( !getCookie( "blnCookie_<?php echo $TPL_V1["code"]?>" ) ) { // <?php echo $TPL_V1["name"]?> 팝업호출
var property = 'width=<?php echo $TPL_V1["width"]?>, height=<?php echo $TPL_V1["height"]?>, top=<?php echo $TPL_V1["top"]?>, left=<?php echo $TPL_V1["left"]?>, scrollbars=no, toolbar=no';
var win=window.open( './html.php?htmid=<?php echo $TPL_V1["file"]?>&code=blnCookie_<?php echo $TPL_V1["code"]?>', '<?php echo $TPL_V1["code"]?>', property );
if(win) win.focus();
}
<?php }?>
<?php }}?>
//--></script>

<table border="0" cellpadding="0" cellspacing="0">
<tr>
	<td colspan="3"><!-- 메인 이미지 배너 (배너관리에서 수정가능) --><?php if(is_array($TPL_R1=dataBanner( 1))&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?><?php echo $TPL_V1["tag"]?><?php }}?></td>
</tr>
<tr>
	<td height="11"></td>
</tr>
<tr>
	<td width="359" valign="top" style="border:solid 1px #ECECEC; background-color:#FCFBF9; padding:20px 0'">
	<table width="310" align="center" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td><img src="/shop/data/skin/apple_tree/img/main/tit_notice.gif"></td>
		<td align="right"><a href="<?php echo url("board/list.php?")?>&id=notice"><img src="/shop/data/skin/apple_tree/img/main/btn_more.gif"></a></td>
	</tr>
	<tr>
		<td height="18"></td>
	</tr>
<?php if(is_array($TPL_R1=dataBoardArticle('notice', 3))&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?>
	<tr>
		<td colspan="2" style="padding:3px 0"><a href="<?php echo url("board/view.php?")?>&id=<?php echo $TPL_V1["id"]?>&no=<?php echo $TPL_V1["no"]?>" style="color:#7D7D7B">&#149; <?php echo strcut($TPL_V1["subject"], 50)?></a></td>
	</tr>
<?php }}?>
	</table>
	</td>
	<td width="7"></td>
	<td width="333"><!-- 본문배너 (배너관리에서 수정가능) --><?php if(is_array($TPL_R1=dataBanner( 7))&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?><?php echo $TPL_V1["tag"]?><?php }}?></td>
</tr>
</table>


<!-- 아래 상품리스트에 쓰이는 세부소스는 '디자인관리 > 상품(goods) > 상품목록 > 갤러리형,리스트형,리스트그룹형,상품이동형' 에 있습니다  -->

<!-- 상품 리스트 #1 -->
<?php if($GLOBALS["cfg_step"][ 0]["chk"]){?>
<div><a href="<?php echo url("goods/goods_grp_02.php")?>&"><img src="/shop/data/skin/apple_tree/img/main/main_mdchoice_tit.jpg"></a></div>
<?php echo $this->assign('loop',dataDisplayGoods( 0,$GLOBALS["cfg_step"][ 0]["img"],$GLOBALS["cfg_step"][ 0]["page_num"]))?>

<?php echo $this->assign('cols',$GLOBALS["cfg_step"][ 0]["cols"])?>

<?php echo $this->assign('size',$GLOBALS["cfg"][$GLOBALS["cfg_step"][ 0]["img"]])?>

<?php echo $this->assign('id',"main_list_01")?>

<?php echo $this->assign('dpCfg',$GLOBALS["cfg_step"][ 0])?>

<?php echo $this->define('tpl_include_file_3',"goods/list/".$GLOBALS["cfg_step"][ 0]["tpl"].".htm")?> <?php $this->print_("tpl_include_file_3",$TPL_SCP,1);?>

<?php }?>

<div style="padding-top:15px"></div>

<!-- 상품 리스트 #2 -->
<?php if($GLOBALS["cfg_step"][ 1]["chk"]){?>
<div><a href="<?php echo url("goods/goods_grp_01.php")?>&"><img src="/shop/data/skin/apple_tree/img/main/main_new_tit.jpg"></a></div>
<?php echo $this->assign('loop',dataDisplayGoods( 1,$GLOBALS["cfg_step"][ 1]["img"],$GLOBALS["cfg_step"][ 1]["page_num"]))?>

<?php echo $this->assign('cols',$GLOBALS["cfg_step"][ 1]["cols"])?>

<?php echo $this->assign('size',$GLOBALS["cfg"][$GLOBALS["cfg_step"][ 1]["img"]])?>

<?php echo $this->assign('id',"main_list_02")?>

<?php echo $this->assign('dpCfg',$GLOBALS["cfg_step"][ 1])?>

<?php echo $this->define('tpl_include_file_4',"goods/list/".$GLOBALS["cfg_step"][ 1]["tpl"].".htm")?> <?php $this->print_("tpl_include_file_4",$TPL_SCP,1);?>

<?php }?>

<div style="padding-top:15px"></div>

<!-- 상품 리스트 #3 -->
<?php if($GLOBALS["cfg_step"][ 2]["chk"]){?>
<div><a href="<?php echo url("goods/goods_grp_03.php")?>&"><img src="/shop/data/skin/apple_tree/img/main/main_best_tit.jpg"></a></div>
<?php echo $this->assign('loop',dataDisplayGoods( 2,$GLOBALS["cfg_step"][ 2]["img"],$GLOBALS["cfg_step"][ 2]["page_num"]))?>

<?php echo $this->assign('cols',$GLOBALS["cfg_step"][ 2]["cols"])?>

<?php echo $this->assign('size',$GLOBALS["cfg"][$GLOBALS["cfg_step"][ 2]["img"]])?>

<?php echo $this->assign('id',"main_list_03")?>

<?php echo $this->assign('dpCfg',$GLOBALS["cfg_step"][ 2])?>

<?php echo $this->define('tpl_include_file_5',"goods/list/".$GLOBALS["cfg_step"][ 2]["tpl"].".htm")?> <?php $this->print_("tpl_include_file_5",$TPL_SCP,1);?>

<?php }?>

<div style="padding-top:15px"></div>

<!-- 상품 리스트 #4 -->
<?php if($GLOBALS["cfg_step"][ 3]["chk"]){?>
<div><a href="<?php echo url("goods/goods_grp_04.php")?>&"><img src="/shop/data/skin/apple_tree/img/main/main_rec_tit.jpg"></a></div>
<?php echo $this->assign('loop',dataDisplayGoods( 3,$GLOBALS["cfg_step"][ 3]["img"],$GLOBALS["cfg_step"][ 3]["page_num"]))?>

<?php echo $this->assign('cols',$GLOBALS["cfg_step"][ 3]["cols"])?>

<?php echo $this->assign('size',$GLOBALS["cfg"][$GLOBALS["cfg_step"][ 3]["img"]])?>

<?php echo $this->assign('id',"main_list_04")?>

<?php echo $this->assign('dpCfg',$GLOBALS["cfg_step"][ 3])?>

<?php echo $this->define('tpl_include_file_6',"goods/list/".$GLOBALS["cfg_step"][ 3]["tpl"].".htm")?> <?php $this->print_("tpl_include_file_6",$TPL_SCP,1);?>

<?php }?>

<div style="padding-top:15px"></div>

<!-- 상품 리스트 #5 -->
<?php if($GLOBALS["cfg_step"][ 4]["chk"]){?>
<div><a href="<?php echo url("goods/goods_grp_05.php")?>&"><img src="/shop/data/skin/apple_tree/img/main/main_special_tit.jpg"></a></div>
<?php echo $this->assign('loop',dataDisplayGoods( 4,$GLOBALS["cfg_step"][ 4]["img"],$GLOBALS["cfg_step"][ 4]["page_num"]))?>

<?php echo $this->assign('cols',$GLOBALS["cfg_step"][ 4]["cols"])?>

<?php echo $this->assign('size',$GLOBALS["cfg"][$GLOBALS["cfg_step"][ 4]["img"]])?>

<?php echo $this->assign('id',"main_list_05")?>

<?php echo $this->assign('dpCfg',$GLOBALS["cfg_step"][ 4])?>

<?php echo $this->define('tpl_include_file_7',"goods/list/".$GLOBALS["cfg_step"][ 4]["tpl"].".htm")?> <?php $this->print_("tpl_include_file_7",$TPL_SCP,1);?>

<?php }?>

<div style="padding-top:15px"></div>

<?php $this->print_("footer",$TPL_SCP,1);?>