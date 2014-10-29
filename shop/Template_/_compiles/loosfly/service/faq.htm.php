<?php /* Template_ 2.2.7 2013/12/16 18:59:12 /www/loosfly_godo_co_kr/shop/data/skin/loosfly/service/faq.htm 000005214 */ 
if (is_array($GLOBALS["loop"])) $TPL__loop_1=count($GLOBALS["loop"]); else if (is_object($GLOBALS["loop"]) && in_array("Countable", class_implements($GLOBALS["loop"]))) $TPL__loop_1=$GLOBALS["loop"]->count();else $TPL__loop_1=0;?>
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
				<img src="/shop/data/skin/loosfly/img/jimmy/titles/faq_title_01.gif" border="0">
			</div>
			<div style="height:20px;"></div>
			<div class="divindiv"><!-- Start indiv -->

				<!-- 검색 : Start -->
				<form name="frmList" id="form">
					<div style="border:1px solid #DEDEDE;" class="hundred">
						<table width="100%" cellpadding="0" cellspacing="0" border="0">
						<tr>
							<td style="border:5px solid #F3F3F3;">
							<table cellpadding="0" cellspacing="0" border="0">
							<tr>
								<td height="40" style="padding-left:10px"><img src="/shop/data/skin/loosfly/img/common/faq_01.gif" align=absmiddle><input type="text" NAME="sword" value="<?php echo $_GET['sword']?>" size="32"></td>
								<td class=noline><input type="image" src="/shop/data/skin/loosfly/img/common/btn_search.gif"></td>
							</tr>
							</table>
							<TABLE width="100%" cellpadding="5" cellspacing="0" border="0">
							<TR>
								<TD bgcolor="#F3F3F3" class="input_txt" height="40" style="padding-top:10px; padding-left:10px">
<?php if((is_array($TPL_R1=codeitem('faq'))&&!empty($TPL_R1)) || (is_object($TPL_R1) && in_array("Countable", class_implements($TPL_R1)) && $TPL_R1->count() > 0)) {$TPL_S1=count($TPL_R1);$TPL_I1=-1;foreach($TPL_R1 as $TPL_K1=>$TPL_V1){$TPL_I1++;?>
									<a href="?sitemcd=<?php echo $TPL_K1?>"><font color="#757575"><?php echo $TPL_V1?></font></a>
<?php if($TPL_I1!=$TPL_S1- 1){?> <font color="#cccccc"> | </font> <?php }?>
<?php }}?>
								</TD>
							</TR>
							</TABLE>
							</td>
						</tr>
						</table>
					</div>
				</form>
				<!-- 검색 : End -->

				<table width="100%" border="0" cellspacing="0" cellpadding="0" style="clear:both;margin-top:15px;border-top-style:solid;border-top-color:#303030;border-top-width:2px;border-bottom-style:solid;border-bottom-color:#D6D6D6;border-bottom-width:1px;">
				<tr bgcolor="#F0F0F0" height="23">
					<th width="50" class="input_txt">번호</th>
					<th class="input_txt">제목</th>
				</tr>
				</table>

<?php if($TPL__loop_1){foreach($GLOBALS["loop"] as $TPL_V1){?>
				<div>
					<table width="100%" cellpadding="0" cellspacing="0" style="border-bottom-style:solid;border-bottom-color:#E6E6E6;border-bottom-width:1px;cursor:pointer;" onclick="view_content(this)" id="faq_<?php echo $TPL_V1["sno"]?>">
					<tr height="27" onmouseover="this.style.background='#F7F7F7'" onmouseout="this.style.background=''">
						<td width="50" align="center"><?php echo $TPL_V1["idx"]?></td>
						<td><font color="#007FC8">[<?php echo $TPL_V1["itemcd"]?>]</font> <?php echo $TPL_V1["question"]?></td>
					</tr>
					</table>
					<div style="display:none;padding:10px;border-bottom-style:solid;border-bottom-color:#E6E6E6;border-bottom-width:1px;">
<?php if($TPL_V1["descant"]!=''){?>
						<table cellpadding="0" cellspacing="0" border="0" style="margin-bottom:10px;">
						<tr valign="top">
							<th style="color:#bf0000;width:40px; padding-top:1px"><img src="/shop/data/skin/loosfly/img/common/faq_q.gif"></th>
							<td><?php echo $TPL_V1["descant"]?></td>
						</tr>
						</table>
<?php }?>
						<table cellpadding="0" cellspacing="0" border="0">
						<tr valign="top">
							<th style="color:#0000bf;width:40px; padding-top:1px"><img src="/shop/data/skin/loosfly/img/common/faq_a.gif"></th>
							<td><?php echo $TPL_V1["answer"]?></td>
						</tr>
						</table>
					</div>
<?php }}else{?>
					<div style="border-bottom-style:solid;border-bottom-color:#E6E6E6;border-bottom-width:1px;text-align:center;padding:15px;">
검색결과가 없습니다. 다시 검색하여 주세요.</div>
<?php }?>
				</div>
			</div><!-- End indiv -->
		</div>



<script language="javascript">
var preContent;

function view_content(obj)
{
	var div = obj.parentNode;

	for (var i=1, m=div.childNodes.length;i<m;i++) {
		if (div.childNodes[i].nodeType != 1) continue;	// text node.
		else if (obj == div.childNodes[ i ]) continue;

		obj = div.childNodes[ i ];
		break;
	}

	if (preContent && obj!=preContent){
		obj.style.display = "block";
		preContent.style.display = "none";
	}
	else if (preContent && obj==preContent) preContent.style.display = ( preContent.style.display == "none" ? "block" : "none" );
	else if (preContent == null ) obj.style.display = "block";

	preContent = obj;
}

{ // 초기출력
	var no = "faq_<?php echo $_GET['ssno']?>";
	if ( document.getElementById( no ) ) view_content( document.getElementById( no ) );
}
</script>

<?php $this->print_("footer",$TPL_SCP,1);?>