<?php /* Template_ 2.2.7 2012/10/04 18:27:50 /www/loosfly_godo_co_kr/shop/data/skin_today/today/todayshop/today_talk.htm 000011024 */ 
$TPL_talk_1=empty($TPL_VAR["talk"])||!is_array($TPL_VAR["talk"])?0:count($TPL_VAR["talk"]);?>
<html>
<head>
<style>
.input { font-size: 12px; color: #847f74; font-family: "����", "����", verdana; border-right: #d9d9d9 1px solid; border-top: #d9d9d9 1px solid; padding-left: 2px; border-left: #d9d9d9 1px solid; border-bottom: #d9d9d9 1px solid; background-color: #ffffff }

a {cursor:pointer;}
img { border:0px; }
.talkbox {width:871px; background-color:#FFFFFF; margin:0px; padding:0px;}
.talkbox .titleimg {text-align:left;}
.talkbox .newitembox {margin:0px 0px 10px 0px;}
.talkbox .newitembox .inner {background-image:url(/shop/data/skin_today/today/img/bg_box02.gif); width:100%; display:inline-block;}
.talkbox .newitembox .inner .comment {float:left; margin-left:10px;}
.talkbox .newitembox .inner .comment textarea {width:670px; height:74px; background-color:#FFFFFF;}
.talkbox .newitembox .inner .enter {float:right; margin-right:10px;}
.talkbox .warning {border-top:dashed 1px; border-bottom:dashed 1px; background-color:#F6F6F6; text-align:left; height:30px; padding-top:9px;}
.talkbox .itembox {border-bottom:solid 1px #E3E3E3;}
.talkbox .itembox a {cursor:pointer;}
.talkbox .itembox .item {display:inline-block; width:100%; padding:10px 0px 10px 0px;}
.talkbox .itembox .item .writer {float:left; text-align:left; width:150px; margin-left:25px; font-weight:bold; font-size:11px;}
.talkbox .itembox .item .comment {float:left; text-align:left; font-size:11px;}
.talkbox .itembox .item .comment .edit {display:none; vertical-align:bottom; margin-top:10px;}
.talkbox .itembox .item .comment .edit .text {float:left;}
.talkbox .itembox .item .comment .edit .text textarea {width:600px; height:47px;}
.talkbox .itembox .item .comment .edit .btn {float:left; margin-left:5px;}
.talkbox .itembox .item .remove {text-align:left; margin-left:25px; font-size:11px; text-decoration:line-through;}
.talkbox .itembox .reply {display:none; width:100%; padding:10px 0px 10px 0px; background-color:#F5F5F5;}
.talkbox .itembox .reply .writer {float:left; text-align:left; width:150px; margin-left:25px; font-weight:bold; font-size:11px;}
.talkbox .itembox .reply .comment {float:left; text-align:left; vertical-align:bottom;}
.talkbox .itembox .reply .comment .text {float:left;}
.talkbox .itembox .reply .comment .text textarea {width:600px; height:47px;}
.talkbox .itembox .reply .comment .btn {float:left; margin-left:5px;}
.talkbox .talkpager {text-align:center; font-size:11px; margin-top:10px; margin-bottom:10px;}
</style>
<script type="text/javascript">
Ttalk = {
	curReply: null,
	curEdit: null,
	setReply: function(ttsno) {
<?php if(!$TPL_VAR["member"]){?>
		if (confirm("�α��� �� ����� �����մϴ�. �α��� �������� �̵��Ͻðڽ��ϱ�?")) {
			parent.location.href = "../member/login.php";
		}
<?php }else{?>
		if (Ttalk.curReply) document.getElementById("reply"+Ttalk.curReply).style.display = "none";
		if (Ttalk.curReply != ttsno) {
			Ttalk.curReply = ttsno;
			document.getElementById("reply"+Ttalk.curReply).style.display = "inline-block";
		}
		else Ttalk.curReply = null;
		resizeFrame();
<?php }?>
	},
	setEdit: function(ttsno) {
<?php if(!$TPL_VAR["member"]){?>
		if (confirm("�α��� �� ����� �����մϴ�. �α��� �������� �̵��Ͻðڽ��ϱ�?")) {
			parent.location.href = "../member/login.php";
		}
<?php }else{?>
		if (Ttalk.curEdit) {
			document.getElementById("edit"+Ttalk.curEdit).style.display = "none";
			//document.getElementById("view"+Ttalk.curEdit).style.display = "block";
		}
		if (Ttalk.curEdit != ttsno) {
			Ttalk.curEdit = ttsno;
			document.getElementById("edit"+Ttalk.curEdit).style.display = "block";
			//document.getElementById("view"+Ttalk.curEdit).style.display = "none";
		}
		else Ttalk.curEdit = null;
		resizeFrame();
<?php }?>
	},
	write: function(mode, tgsno, ttsno) {
<?php if(!$TPL_VAR["member"]){?>
		if (confirm("�α��� �� ����� �����մϴ�. �α��� �������� �̵��Ͻðڽ��ϱ�?")) {
			parent.location.href = "../member/login.php";
		}
<?php }else{?>
		var frm = document.getElementById("frmTalk");
		frm.target = "hiddenIfrm";
		frm.mode.value = mode;
		frm.tgsno.value = tgsno;
		if (ttsno) {
			frm.ttsno.value = ttsno;
			switch(mode) {
				case "edit": {
					var cmt = document.getElementById("comment_e"+ttsno);
					if (!cmt.value.replace(/\s/g, "")) {
						alert("������ �Է��ϼ���.");
						cmt.focus();
						return;
					}
					if (!confirm("�����Ͻðڽ��ϱ�?")) return;
					frm.comment.value = cmt.value;
					break;
				}
				case "reply": {
					var cmt = document.getElementById("comment_r"+ttsno);
					if (!cmt.value.replace(/\s/g, "")) {
						alert("������ �Է��ϼ���.");
						cmt.focus();
						return;
					}
					frm.comment.value = cmt.value;
					break;
				}
			}
		}
		else {
			var cmt = document.getElementById("newcomment");
			if (!cmt.value.replace(/\s/g, "")) {
				alert("������ �Է��ϼ���.");
				cmt.focus();
				return;
			}
			frm.comment.value = document.getElementById("newcomment").value;
		}
		frm.submit();
<?php }?>
	},
	remove : function(ttsno) {
<?php if(!$TPL_VAR["member"]){?>
		if (confirm("�α��� �� ����� �����մϴ�. �α��� �������� �̵��Ͻðڽ��ϱ�?")) {
			parent.location.href = "../member/login.php";
		}
<?php }else{?>
		if (!confirm("�����Ͻðڽ��ϱ�?")) return;
		var frm = document.getElementById("frmTalk");
		frm.target = "hiddenIfrm";
		frm.mode.value = "remove";
		frm.ttsno.value = ttsno;
		frm.submit();
<?php }?>
	},
	goPage : function(tgsno, pagenum) {
		location.href = "../todayshop/today_talk.php?tgsno="+tgsno+"&page="+pagenum;
	}
}

function resizeFrame() { 
    var oBody = document.body;
    var oFrame = parent.document.getElementById("intalk");
    var i_height = oBody.scrollHeight + (oFrame.offsetHeight-oFrame.clientHeight);
    oFrame.style.height = i_height;
}

</script>

<body style="margin:0px;" onLoad="resizeFrame()">
<form name="frmTalk" method="post" action="<?php echo url("todayshop/indb.today_talk.php")?>&">
<input type="hidden" name="mode" />
<input type="hidden" name="tgsno" />
<input type="hidden" name="ttsno" />
<input type="hidden" name="comment" />
</form>
<div class="talkbox">
	<div class="titleimg"><img src="/shop/data/skin_today/today/img/title_talk01.gif" /></div>
	<div class="newitembox">
		<div><img src="/shop/data/skin_today/today/img/bg_box01.gif" /></div>
		<div class="inner">
			<div class="comment">
<?php if($TPL_VAR["member"]){?>
			<textarea name="newcomment" class="input"></textarea>
<?php }else{?>
			<textarea name="newcomment" class="input" disabled="disabled">�α��� �� ����� �����մϴ�.</textarea>
<?php }?>
			</div>
			<div class="enter"><a href="javascript:Ttalk.write('regist', <?php echo $TPL_VAR["tgsno"]?>)"><img src="/shop/data/skin_today/today/img/btn_enter01.gif" /></a></div>
		</div>
		<div><img src="/shop/data/skin_today/today/img/bg_box03.gif" /></div>
	</div>
	<div class="warning"><img src="/shop/data/skin_today/today/img/bn_warning.gif" /></div>
	<div id="talk">
<?php if($TPL_talk_1){foreach($TPL_VAR["talk"] as $TPL_V1){?>
		<div class="itembox">
<?php if($TPL_V1["remove"]=='n'){?>
			<div class="item" id="view<?php echo $TPL_VAR["ttsno"]?>">
				<div class="writer" <?php if($TPL_V1["step"]> 0){?>style="padding-left:<?php echo ($TPL_V1["step"]- 1)* 10?>px"<?php }?>><?php if($TPL_V1["step"]> 0){?><img src="/shop/data/skin_today/today/img/icon_reply_arrow.gif" /> <?php }?><?php if($TPL_V1["notice"]> 0){?><img src="/shop/data/skin_today/today/img/icon_notice.gif" /><?php }else{?><?php echo $TPL_V1["writer"]?><?php }?></div>
				<div id="view<?php echo $TPL_V1["ttsno"]?>" class="comment">
					<div <?php if($TPL_V1["step"]> 0){?>style="padding-left:<?php echo $TPL_V1["step"]* 10?>px"<?php }?>>
						<div><?php echo nl2br($TPL_V1["comment"])?><br/><br/><?php echo $TPL_V1["regdt"]?></div>
						<div>
<?php if($TPL_V1["notice"]== 0){?><a href="javascript:Ttalk.setReply(<?php echo $TPL_V1["ttsno"]?>)"><img src="/shop/data/skin_today/today/img/btn_talk_reply.gif" /></a><?php }?>
<?php if($TPL_V1["auth"]=='y'){?>
								<a href="javascript:Ttalk.setEdit(<?php echo $TPL_V1["ttsno"]?>)"><img src='/shop/data/skin_today/today/img/btn_talk_edit.gif' /></a>
								<a href="javascript:Ttalk.remove(<?php echo $TPL_V1["ttsno"]?>)"><img src="/shop/data/skin_today/today/img/btn_talk_del.gif" /></a>
<?php }?>
						</div>
					</div>
					<div id="edit<?php echo $TPL_V1["ttsno"]?>" class="edit">
						<div class="text"><textarea name="comment_e<?php echo $TPL_V1["ttsno"]?>" class="input"><?php echo $TPL_V1["comment"]?></textarea></div>
						<div class="btn"><a href="javascript:Ttalk.write('edit', <?php echo $TPL_V1["tgsno"]?>, <?php echo $TPL_V1["ttsno"]?>)"><img src="/shop/data/skin_today/today/img/btn_regist2.gif" /></a></div>
					</div>
				</div>
			</div>
<?php if($TPL_V1["notice"]== 0&&$TPL_VAR["member"]){?>
				<div id="reply<?php echo $TPL_V1["ttsno"]?>" class="reply">
					<div class="writer" style="padding-left:<?php echo $TPL_V1["step"]* 10?>px">
						<img src="/shop/data/skin_today/today/img/icon_reply_arrow.gif" /> <?php echo $TPL_VAR["member"]["name"]?>

					</div>
					<div class="comment">
						<div class="text"><textarea name="comment_r<?php echo $TPL_V1["ttsno"]?>" class="input" /></textarea></div>
						<div class="btn"><a href="javascript:Ttalk.write('reply', <?php echo $TPL_V1["tgsno"]?>, <?php echo $TPL_V1["ttsno"]?>)"><img src="/shop/data/skin_today/today/img/btn_regist.gif" /></a></div>
					</div>
				</div>
<?php }?>
<?php }else{?>
			<div class="item">
				<div class="remove" <?php if($TPL_V1["step"]> 0){?>style="padding-left:<?php echo ($TPL_V1["step"]- 1)* 10?>px"<?php }?>><?php if($TPL_V1["step"]> 0){?><img src="/shop/data/skin_today/today/img/icon_reply_arrow.gif" /> <?php }?>������ ���Դϴ�.</div>
			</div>
<?php }?>
		</div>
<?php }}?>
	</div>
	<div class="talkpager">
<?php if($TPL_VAR["talkpager"]["prevpage"]){?><a href="javascript:Ttalk.goPage(<?php echo $TPL_VAR["tgsno"]?>, <?php echo $TPL_VAR["talkpager"]["prevpage"]?>)"><</a><?php }?>
<?php if(is_array($TPL_R1=$TPL_VAR["talkpager"]["page"])&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?>
	<span><?php if($TPL_V1["curpage"]=='y'){?><b><?php echo $TPL_V1["pagenum"]?></b><?php }else{?><a href="javascript:Ttalk.goPage(<?php echo $TPL_VAR["tgsno"]?>, <?php echo $TPL_V1["pagenum"]?>)"><?php echo $TPL_V1["pagenum"]?></a><?php }?></span>
<?php }}?>
<?php if($TPL_VAR["talkpager"]["nextpage"]){?><a href="javascript:Ttalk.goPage(<?php echo $TPL_VAR["tgsno"]?>, <?php echo $TPL_VAR["talkpager"]["nextpage"]?>)" style="cursor:pointer">></a><?php }?>
	</div>
</div>
<iframe name="hiddenIfrm" style="display:none"></iframe>
</body>
</html>