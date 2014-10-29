<?php /* Template_ 2.2.7 2013/04/16 10:58:59 /www/loosfly_godo_co_kr/shop/data/skin/loosfly/setGoods/comment/comment.htm 000012474 */ 
if (is_array($TPL_VAR["obj"])) $TPL_obj_1=count($TPL_VAR["obj"]); else if (is_object($TPL_VAR["obj"]) && in_array("Countable", class_implements($TPL_VAR["obj"]))) $TPL_obj_1=$TPL_VAR["obj"]->count();else $TPL_obj_1=0;?>
<script type="text/javascript" src="/shop/setGoods/js/jquery.autogrowtextarea.js"></script>
<script>
function MemConfirm(){ 
	var confRet = window.confirm("회원전용 서비스 입니다. \r\n로그인/회원가입 페이지로 이동하시겠습니까?");
	if (confRet) {
		location.href="/shop/member/login.php?returnUrl=<?php echo urlencode($_SERVER["HTTP_REFERER"])?>";
		return false;
	}
	return true;
}

function check(form){

<?php if(($TPL_VAR["setGConfig"]["memo_permission"]=='user')&&(!$TPL_VAR["sess"]["m_no"])){?>
	if(MemConfirm()) return false;
	else return false;
<?php }?>

	var f1 = form;
	if (f1.memo.value == "") {
		alert("내용을 입력하세요");
		f1.memo.focus();
		return false;
	}
	if (f1.nickname !== undefined && f1.nickname.value == "") {
		alert("이름을 입력하세요");
		f1.nickname.focus();
		return false;
	}
	if (f1.password !== undefined && f1.password.value == "") {
		alert("비밀번호를 입력하세요");
		f1.password.focus();
		return false;
	}
}


function del_confirm(form){ 
	return confirm('등록하신 댓글을 삭제하시겠습니까?');
}

</script>

<!--댓글사용 : Y-->
<div class="codiComment">
	<div class="codiComment-title"><img src="/shop/data/skin/loosfly/setGoods/img/comment/subtitle_comment.gif"/></div>
	
	<!-- 댓글쓰기 : 전체허용 -->
<?php if($TPL_VAR["setGConfig"]["memo_permission"]=="all"){?>
		<!-- 비회원쓰기 -->
<?php if(!$TPL_VAR["sess"]["m_no"]){?>	
		<div class="codiComment-input">
			<form name="f1" method="post" action="<?php echo url("setGoods/comment/indb.php")?>&" onSubmit="return check(this)">
			<input type="hidden" name="cody_idx" value="<?php echo $TPL_VAR["cody_idx"]?>" />
			<input type="hidden" name="mode" value="register" />
				<div class="inputForm">
					<div style="float:left;">
						<input type="text" name="memo" style="width:478px" class="input" /> 
						<div style="margin-top:11px;text-align:right;">
							<span class="fieldFont"><b>이름</b>&nbsp;<input type="text" name="nickname" style="width:105px;" class="input"/>&nbsp;&nbsp;<b>비밀번호</b>&nbsp;<input type="password" name="password" style="width:136px;" class="input"/></span>
						</div>
					</div>
					<div>
						<input type="image" alt="등록" src="/shop/data/skin/loosfly/setGoods/img/comment/btn_comment.gif" style="margin-left:15px" />
					</div>
					<div class="clear"></div>
				</div>
			</form>
		</div>
		<!-- 회원쓰기 -->
<?php }else{?>
		<div class="codiComment-input">
			<form name="f1" method="post" action="<?php echo url("setGoods/comment/indb.php")?>&" onSubmit="return check(this)">
			<input type="hidden" name="cody_idx" value="<?php echo $TPL_VAR["cody_idx"]?>" />
			<input type="hidden" name="mode" value="register" />
				<div class="inputForm">
					<div style="float:left;">
						<input type="text" name="memo" style="width:478px" class="input" /> 
						<div style="margin-top:11px;text-align:right;">
							<span class="fieldFont"><b>이름</b>&nbsp;<input type="text" name="nickname" value="<?php echo $TPL_VAR["member"]["name"]?>" style="width:105px;" class="input" /></span>
						</div>
					</div>
					<div>
						<input type="image" alt="등록" src="/shop/data/skin/loosfly/setGoods/img/comment/btn_comment.gif" style="margin-left:15px" />
					</div>
					<div class="clear"></div>
				</div>
			</form>
		</div>
<?php }?>

	<!-- 댓글쓰기 : 회원허용 -->
<?php }else{?>
		<div class="codiComment-input">
			<form name="f1" method="post" action="<?php echo url("setGoods/comment/indb.php")?>&" onSubmit="return check(this)">
			<input type="hidden" name="cody_idx" value="<?php echo $TPL_VAR["cody_idx"]?>" />
			<input type="hidden" name="mode" value="register" />
				<div class="inputForm">
					<div style="float:left;">
						<input type="text" name="memo" style="width:478px" class="input" <?php if(!$TPL_VAR["sess"]["m_no"]){?> onclick="MemConfirm(this);" onkeypress="MemConfirm(this);"<?php }?> /> 
						<div style="margin-top:11px;text-align:right;">
							<span class="fieldFont"><b>이름</b>&nbsp;<input type="text" name="nickname" value="<?php echo $TPL_VAR["member"]["name"]?>" style="width:105px;" class="input" <?php if(!$TPL_VAR["sess"]["m_no"]){?> onclick="MemConfirm(this);" onkeypress="MemConfirm(this);"<?php }?> /></span>
						</div>
					</div>
					<div>
						<input type="image" alt="등록" src="/shop/data/skin/loosfly/setGoods/img/comment/btn_comment.gif" style="margin-left:15px" />
					</div>
					<div class="clear"></div>
				</div>
			</form>
		</div>
<?php }?>
	
	<!-- 댓글리스트 -->
<?php if($TPL_obj_1){foreach($TPL_VAR["obj"] as $TPL_V1){?>
	<div class="codiComment-box">		
		<table cellspacing=0 cellpadding=0 class="tbl-list" border=0>
		<tr id="memo_content_<?php echo $TPL_V1["idx"]?>">
			<td class="td1"><span class="fieldFont"><b><?php echo $TPL_V1["nickname"]?></b>님</span></td>
			<td class="td2"><span class="commentFont"><?php echo $TPL_V1["memo"]?></span></td>
			<!-- 비회원이라면 -->			
<?php if(!$TPL_VAR["sess"]["m_no"]){?>
				<!-- 비회원이 쓴 글만 수정/삭제버튼 보임 -->
<?php if($TPL_V1["m_no"]== 0){?>
				<td class="td3" align="right">
					<span class="b_modify" id="b_modify_<?php echo $TPL_V1["idx"]?>" data-value="<?php echo $TPL_V1["idx"]?>"><img src="/shop/data/skin/loosfly/setGoods/img/comment/btn_modify.gif" alt="수정" style="cursor:pointer" /></span>
					<span class="b_delete" id="b_delete_<?php echo $TPL_V1["idx"]?>" data-value="<?php echo $TPL_V1["idx"]?>"><img src="/shop/data/skin/loosfly/setGoods/img/comment/btn_delete.gif" alt="삭제" style="cursor:pointer" /></span>
				</td>
<?php }?>
			<!-- 회원이라면 -->
<?php }else{?>
				<!-- 내가 쓴 댓글에만 수정/삭제버튼 보임 (관리자는 다보임) -->
<?php if($TPL_VAR["sess"]["m_no"]==$TPL_V1["m_no"]||$TPL_VAR["sess"]["level"]>= 80){?>
				<td class="td3" align="right">
					<span class="b_modify" id="b_modify_<?php echo $TPL_V1["idx"]?>" data-value="<?php echo $TPL_V1["idx"]?>"><img src="/shop/data/skin/loosfly/setGoods/img/comment/btn_modify.gif" alt="수정" style="cursor:pointer" /></span>
					<span class ="b_modify_cancle" id="b_modify_cancle_<?php echo $TPL_V1["idx"]?>" style="display:none;" data-value="<?php echo $TPL_V1["idx"]?>"><img src="/shop/data/skin/loosfly/setGoods/img/comment/btn_modify.gif" alt="수정안함" style="cursor:pointer" /></span>
					<span><a href="javascript:" onClick="if (confirm('등록하신 댓글을 삭제하시겠습니까?')) { window.location.href='<?php echo url("setGoods/comment/indb.php?")?>&mode=delete&idx=<?php echo $TPL_V1["idx"]?>&cody_idx=<?php echo $TPL_VAR["cody_idx"]?>' } else { void('') }"><img src="/shop/data/skin/loosfly/setGoods/img/comment/btn_delete.gif" style="cursor:pointer" /></a></span>				
				</td>
<?php }?>
<?php }?>
		</tr>
		<tr id="mod_form_<?php echo $TPL_V1["idx"]?>" style="display:none;">
			<td>
				<!-- 댓글수정폼 -->
				<div class="codiComment-input">
					<form name="f1_<?php echo $TPL_V1["idx"]?>" method="post" action="<?php echo url("setGoods/comment/indb.php")?>&" onSubmit="return check(this)">
					<input type="hidden" name="cody_idx" value="<?php echo $TPL_VAR["cody_idx"]?>" />
					<input type="hidden" name="idx" value="<?php echo $TPL_V1["idx"]?>" />
					<input type="hidden" name="mode" value="modify" />					
						<div class="inputForm">
							<div style="float:left;">
								<div style="width:60px;float:left;">
									<span class="fieldFont" style="padding-right:6px;"><b><?php echo $TPL_V1["nickname"]?></b>님</span>
								</div>
								<input type="text" name="memo" value="<?php echo $TPL_V1["memo"]?>" style="width:413px" class="input" />
								<!-- 비회원이 쓴 댓글 -->
<?php if(!$TPL_VAR["sess"]){?>
								<input type="hidden" name="no_member" value="1" />
								<div style="margin-top:11px;text-align:right;">
									<span class="fieldFont"><b>비밀번호</b>&nbsp;<input type="password" name="password" style="width:136px;" class="input"/></span>
								</div>
<?php }?>
							</div>
							<div>								
								<input type="image" alt="수정" src="/shop/data/skin/loosfly/setGoods/img/comment/btn_modify.gif" style="margin-left:15px;cursor:pointer" />
								<span class ="b_modify_cancle" id="b_modify_cancle_<?php echo $TPL_V1["idx"]?>" data-value="<?php echo $TPL_V1["idx"]?>"><img src="/shop/data/skin/loosfly/setGoods/img/comment/btn_cancel.gif" alt="수정취소" style="cursor:pointer" /></span>
							</div>
							<div class="clear"></div>
						</div>
					</form>
				</div>
				<!-- 댓글수정폼 끝-->
			</td>
		</tr>
		<!-- 비회원일 경우 댓글 삭제 -->
<?php if(!$TPL_VAR["sess"]["m_no"]){?>
		<tr id="del_form_<?php echo $TPL_V1["idx"]?>" style="display:none;">
			<td>
				<!-- 댓글삭제폼 -->
				<div class="codiComment-input">
					<form name="f1" method="post" action="<?php echo url("setGoods/comment/indb.php")?>&" onSubmit="return check(this)">
					<input type="hidden" name="cody_idx" value="<?php echo $TPL_VAR["cody_idx"]?>" />
					<input type="hidden" name="idx" value="<?php echo $TPL_V1["idx"]?>" />
					<input type="hidden" name="mode" value="delete" />
					<input type="hidden" name="no_member" value="1" />
						<div class="inputForm">
							<div style="float:left;">
								<div style="width:60px;float:left;">
									<span class="fieldFont" style="padding-right:6px"><b><?php echo $TPL_V1["nickname"]?></b>님</span>
								</div>
								<input type="text" name="memo" value="<?php echo $TPL_V1["memo"]?>" style="width:413px;" class="input" disabled />
								<div style="margin-top:11px;text-align:right;">
									<span class="fieldFont"><b>비밀번호</b>&nbsp;<input type="password" name="password" style="width:136px;" class="input"/></span>
								</div>	
							</div>
							<div>
								<input type="image" alt="삭제" src="/shop/data/skin/loosfly/setGoods/img/comment/btn_delete.gif" style="margin-left:15px;cursor:pointer" onclick="return del_confirm(this);" />
								<span class ="b_delete_cancle" id="b_delete_cancle_<?php echo $TPL_V1["idx"]?>" data-value="<?php echo $TPL_V1["idx"]?>"><img src="/shop/data/skin/loosfly/setGoods/img/comment/btn_cancel.gif" alt="삭제취소" style="cursor:pointer" /></span>
							</div>
							<div class="clear"></div>
						</div>
					</form>
				</div>
				<!-- 댓글삭제폼 끝-->
			</td>
		</tr>
<?php }?>
		</table>		
	</div>	
<?php }}?>
	<!-- 댓글리스트 끝 -->
</div> 

<script>
//댓글수정박스 숨기기 보이기
jQuery(".b_modify").click(function () {
    jQuery("#memo_content_"+jQuery(this).attr("data-value")).css({"display":"none"});    
    jQuery("#mod_form_"+jQuery(this).attr("data-value")).css({"display":""});
    jQuery("#b_modify_"+jQuery(this).attr("data-value")).css({"display":"none"});
    jQuery("#b_modify_cancle_"+jQuery(this).attr("data-value")).css({"display":""});   
});	

jQuery(".b_modify_cancle").click(function () {
    jQuery("#memo_content_"+jQuery(this).attr("data-value")).css({"display":""});    
    jQuery("#mod_form_"+jQuery(this).attr("data-value")).css({"display":"none"});
    jQuery("#b_modify_"+jQuery(this).attr("data-value")).css({"display":""});
    jQuery("#b_modify_cancle_"+jQuery(this).attr("data-value")).css({"display":"none"});
});

//비회원댓글삭제박스 숨기기 보이기
jQuery(".b_delete").click(function () {
    jQuery("#memo_content_"+jQuery(this).attr("data-value")).css({"display":"none"});    
    jQuery("#del_form_"+jQuery(this).attr("data-value")).css({"display":""});
    jQuery("#b_delete_"+jQuery(this).attr("data-value")).css({"display":"none"});
    jQuery("#b_delete_cancle_"+jQuery(this).attr("data-value")).css({"display":""});
   
});	

jQuery(".b_delete_cancle").click(function () {
    jQuery("#memo_content_"+jQuery(this).attr("data-value")).css({"display":""});    
    jQuery("#del_form_"+jQuery(this).attr("data-value")).css({"display":"none"});
    jQuery("#b_delete_"+jQuery(this).attr("data-value")).css({"display":""});
    jQuery("#b_delete_cancle_"+jQuery(this).attr("data-value")).css({"display":"none"});
});
</script>