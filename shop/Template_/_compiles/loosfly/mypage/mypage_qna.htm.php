<?php /* Template_ 2.2.7 2013/12/16 18:59:11 /www/loosfly_godo_co_kr/shop/data/skin/loosfly/mypage/mypage_qna.htm 000005740 */ 
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
				<img src="/shop/data/skin/loosfly/img/jimmy/titles/qna_title_01.gif" border="0">
			</div>
			<div style="height:20px;"></div>
			<div class="divindiv"><!-- Start indiv -->
				<table width="100%" border="0" cellspacing="0" cellpadding="5" style="border-top-style:solid;border-top-color:#303030;border-top-width:2px;border-bottom-style:solid;border-bottom-color:#D6D6D6;border-bottom-width:1px;">
				<tr height="23" bgcolor="#F0F0F0" class="input_txt">
					<th width="8%">번호</th>
					<th width="15%">질문유형</th>
					<th>제목</th>
					<th width="12%">작성자</th>
					<th width="12%">작성일</th>
				</tr>
				</table>
<?php if($TPL__loop_1){foreach($GLOBALS["loop"] as $TPL_V1){?>
				<div>
<?php if($TPL_V1["sno"]==$TPL_V1["parent"]){?>
					<table width="100%" cellpadding="3" cellspacing="0" style="border-bottom-style:solid;border-bottom-color:#E6E6E6;border-bottom-width:1px;cursor:pointer;" onclick="view_content(this, event)">
					<tr height="25" onmouseover="this.style.background='#F7F7F7'" onmouseout="this.style.background=''">
						<td width="8%" align="center"><?php echo $TPL_V1["idx"]?></td>
						<td width="15%" align="left"  class=stxt><B>[<?php echo $TPL_V1["itemcd"]?>]</B></td>
						<td style="padding-top:5px; padding-bottom:5px"><?php echo $TPL_V1["subject"]?> <span style="color:#007FC8;"  class="stxt">[<?php echo $TPL_V1["replecnt"]?>]</span></td>
						<td width="12%" align="center"><?php echo $TPL_V1["m_id"]?></td>
						<td width="12%" align="center"><?php echo substr($TPL_V1["regdt"], 0, 10)?></td>
					</tr>
					</table>
<?php }elseif($TPL_V1["sno"]!=$TPL_V1["parent"]){?>
					<table width="100%" cellpadding="3" cellspacing="0" style="border-bottom-style:solid;border-bottom-color:#E6E6E6;border-bottom-width:1px;cursor:pointer;" onclick="view_content(this, event)">
					<tr height="25" onmouseover="this.style.background='#F7F7F7'" onmouseout="this.style.background=''">
						<td width="8%" align="center"><?php echo $TPL_V1["idx"]?></td>
						<td width="15%" align="left"><img src="/shop/data/skin/loosfly/img/common/myqna_answer.gif"></td>
						<td style="padding-top:5px; padding-bottom:5px" class=stxt><?php echo $TPL_V1["subject"]?></td>
						<td width="12%" align="center"><?php echo $TPL_V1["m_id"]?></td>
						<td width="12%" align="center"><?php echo substr($TPL_V1["regdt"], 0, 10)?></td>
					</tr>
					</table>
<?php }?>
					<div style="display:none;padding:10px;border-bottom-style:solid;border-bottom-color:#E6E6E6;border-bottom-width:1px;">
<?php if($TPL_V1["ordno"]!='0'){?>
						<div width="100%" style="padding-left:55px">[ 주문번호 <?php echo $TPL_V1["ordno"]?> 문의 ]</div>
<?php }?>
						<div width="100%" style="padding-left:55px"><?php echo $TPL_V1["contents"]?></div>
						<div style="text-align:right;">
<?php if($TPL_V1["authreply"]=='Y'){?>
							<a href="javascript:;" onclick="popup_register( 'reply_qna', '<?php echo $TPL_V1["sno"]?>' );"><img src="/shop/data/skin/loosfly/img/common/btn_reply.gif" border="0" align="absmiddle"></a>
<?php }?>
<?php if($TPL_V1["authmodify"]=='Y'){?>
							<a href="javascript:;" onclick="popup_register( 'mod_qna', '<?php echo $TPL_V1["sno"]?>' );"><img src="/shop/data/skin/loosfly/img/common/btn_modify2.gif" border="0" align="absmiddle"></a>
<?php }?>
<?php if($TPL_V1["authdelete"]=='Y'){?>
							<a href="javascript:;" onclick="popup_register( 'del_qna', '<?php echo $TPL_V1["sno"]?>' );"><img src="/shop/data/skin/loosfly/img/common/btn_delete.gif" border="0" align="absmiddle"></a>
<?php }?>
						</div>
					</div>
				</div>
<?php }}?>
				<div style="float:right;padding:10px 5px">
					<a href="javascript:;" onclick="popup_register( 'add_qna' )"><img src="/shop/data/skin/loosfly/img/jimmy/buttons/write_01.gif"></a>
				</div>

				<div class="pagediv"><?php echo $TPL_VAR["pg"]->page['navi']?></div>
					<div style="height:30px;"></div>
				</div>
			</div><!-- End indiv -->
		</div>

<script language="javascript">

function popup_register( mode, sno )
{
	if ( mode == 'del_qna' ) var win = window.open("../mypage/mypage_qna_del.php?mode=" + mode + "&sno=" + sno,"qna_register","width=400,height=200");
	else var win = window.open("../mypage/mypage_qna_register.php?mode=" + mode + "&sno=" + sno,"qna_register","width=600,height=500");
	win.focus();
}

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
</script>

</div><!-- End indiv -->

<?php $this->print_("footer",$TPL_SCP,1);?>