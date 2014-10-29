<?php /* Template_ 2.2.7 2013/12/16 18:59:10 /www/loosfly_godo_co_kr/shop/data/skin/loosfly/member/find_pwd_choice.htm 000009356 */ ?>
<?php $this->print_("header",$TPL_SCP,1);?>


<script language="JavaScript">
var nsGodo_PasswordFinder = function() {
	return {
		raiseError : function(code) {
			switch (code) {
				case '0001':
					alert('사용자 정보가 존재하지 않습니다.');
					window.location.replace('../member/find_pwd.php');
					break;
				case '0002':
					alert('잘못된 접근입니다. 다시 시도해 주세요.');
					window.location.replace('../member/find_pwd.php');
					break;
				case '0003':
					alert('유효기간이 만료되었습니다. 다시 시도해 주세요.');
					window.location.replace('../member/find_pwd.php');
					break;
				case '0004':
					alert('전송이 불가능한 이메일 주소 입니다.');
					break;
				case '0005':
					alert('전송이 불가능한 휴대폰 번호 입니다.');
					break;
				case '0006':
					alert('인증번호를 정확히 입력해 주세요.');
					break;
				case '0007':
					alert('비밀번호 변경이 정상적으로 완료되지 않았습니다.\n\n다시 시도해 주세요.');
					break;
				case '0008':
					alert('비빌번호찾기 휴대폰번호 인증 후 재발급 서비스 사용중 장애가 발생하였습니다.\n\n다른 서비스로 비빌번호찾기를 진행하여 주세요.');
					break;
				case '0009':
					alert('사용이 불가능한 비밀번호 입니다.');
					break;
				default:
					alert('기타 오류');
					break;

			}

			return false;
		},

		changePwd : function(pwd,m_id,token) {

			gd_ajax({
				url : '../member/indb.find_pwd.php',
				type : 'POST',
				param : '&mode=change&pwd='+pwd+'&m_id='+m_id+'&token='+token,
				success : function(rst) {
					if (rst == '0000') {
						alert('비밀번호 변경이 완료되었습니다.');
						window.location.replace('../member/login.php');
					}
					else {
						return nsGodo_PasswordFinder.raiseError(rst);
					}

				}

			});
		},
		sendOTP : function(type,m_id,token,cb) {

			gd_ajax({
				url : '../member/indb.find_pwd.php?type='+type,
				type : 'POST',
				param : '&mode=send&m_id='+m_id+'&token='+token,
				success : function(rst) {

					if (rst == '0000') {
						cb();
					}
					else {
						return nsGodo_PasswordFinder.raiseError(rst);
					}

				}
			});
		},
		compareOTP : function(otp,m_id,token) {

			gd_ajax({
				url : '../member/indb.find_pwd.php',
				type : 'POST',
				param : '&mode=compare&otp='+otp+'&m_id='+m_id+'&token='+token,
				success : function(rst) {

					/*
					결과 코드

					0000 : 인증성공
					0006 : 인증키 불일치
					*/
					if (rst == '0000') {

						// 비번 변경창
						nsGodo_PasswordFinder.dialog.open('', 374, 460);

						document.certForm.action = '../member/change_pwd.php';
						document.certForm.target = _ID('certFrame').name;
						document.certForm.submit();

					}
					else {
						return nsGodo_PasswordFinder.raiseError(rst);
					}

				}
			});

		},
		dialog : {
			open : function(url, w_width, w_height) {

				this.close();

				var c_width = document.body.clientWidth;
				var c_height = document.body.clientHeight;

				var s_width = document.body.scrollLeft;
				var s_height = document.body.scrollTop;

				_ID('certPopLayer').style.width = _ID('certPopLayerBG').style.width = (c_width + s_width) + 'px';
				_ID('certPopLayer').style.height = _ID('certPopLayerBG').style.height = (c_height + s_height) + 'px';

				with(_ID('certFrameLayer').style) {
					width = w_width + 'px';
					height = w_height + 'px';
					left = ((c_width - w_width) / 2 + s_width) + 'px';
					top = ((c_height - w_height) / 2 + s_height) + 'px';
				}

				_ID('certPopLayer').style.display = "block";

				if (url) {
					_ID('certFrame').src = url;
				}

			},
			close : function() {
				_ID('certPopLayer').style.display = "none";
				_ID('certFrame').src = 'about:blank';
			}
		}


	}
}();



function closeAuthLayer() {
	nsGodo_PasswordFinder.dialog.close();
}

function openAuthLayer(type) {

	// 인증번호 입력창
	switch (parseInt(type)) {
		case 1:	// 이메일 인증
		case 2:	// 휴대폰 인증
		case 3:	// 나신평 휴대폰 인증
		case 4:	// 나신평 범용 공인인증서 인증
			var url = '../member/find_pwd_auth.php?type='+type;
			break;
		default:
			return;
			break;
	}

	nsGodo_PasswordFinder.dialog.open('', 374, 260);

	document.certForm.action = url;
	document.certForm.target = _ID('certFrame').name;
	document.certForm.submit();
}

function selectOption(type, cb) {
	if (!cb) {
		cb = function(){
			switch (parseInt(type)) {
				case 1:	// 이메일 인증
					alert('인증번호가 고객님의 메일주소로 전송 되었습니다.');
					break;
				case 2:	// 휴대폰 인증
					alert('인증번호가 고객님의 핸드폰 번호로 전송 되었습니다.');
					break;
			}
			openAuthLayer(type)
		};
	}
	nsGodo_PasswordFinder.sendOTP(type, '<?php echo $TPL_VAR["m_id"]?>', '<?php echo $TPL_VAR["token"]?>', cb);
}

function resend_certKey(type) {
	if(confirm("인증번호를 재전송 하시겠습니까?\n\n※ 인증번호를 재전송하시면\n이전에 전송되었던 인증번호는 사용하실 수 없습니다.")) {
		selectOption(type, function(){alert('인증번호가 재전송 되었습니다.')});
	}
}
</script>

<style type="text/css">
	.method-wrap {display:inline-block;_display:inline;margin:0 0 5px 0;padding:0;width:325px;height:135px;z-index:999;}
	.method-wrap .method {background-position:center center;background-repeat:no-repeat;height:100%;width:100%;margin:0;position:relative;z-index:10;}
	.method-wrap .method .cont { color:#373737; font-family:dotum; font-size:12px;text-align:center; position:absolute;top:105px;left:0;width:100%;z-index:11;}

	#certPopLayer { display:none; position:absolute; left:0px; top:0px;  z-index:110; }
	#certPopLayer #certFrameLayer { position:absolute; z-index:110; }
	#certPopLayer #certFrameLayer #certFrame { width:100%; height:100%; }
	#certPopLayer #certPopLayerBG { background:#000; opacity:.70; filter:alpha(opacity=70); height:500px; left:0px; position:absolute; top:0px; width:500px; z-index:100; }
</style>

<!-- 인증 레이어 팝업 -->
<div id="certPopLayer"><div id="certFrameLayer"><iframe id="certFrame" name="certFrame" src="about:blank" scrolling="no" frameborder="0"></iframe></div><div id="certPopLayerBG"></div></div>

<?php if($this->tpl_['side_inc']){?>
		<div class="blkLeftMenu">
<?php $this->print_("side_inc",$TPL_SCP,1);?>

		</div>
<?php }?>
	<div id="blkContents">
		<div style="height:7px;"></div>
		<div class="divindiv"><!-- Start indiv -->
			<!-- 상단이미지 -->
			<div id="bxBodyTitle">
				<img src="/shop/data/skin/loosfly/img/jimmy/titles/find_pw_title_01.gif" border=0>
			</div>

			<div style="height:75px;"></div>

			<div style="width:450px;padding:0 230px 0 230px;">
				<table class="post_head" cellspacing="0" cellpadding="0"><tr><td class="htl" nowrap="nowrap"></td><td class="htc"></td><td class="htr" nowrap="nowrap"></td></tr></table>
				<form name="certForm" method="post" action="">
					<input type="hidden" name="token" value="<?php echo $TPL_VAR["token"]?>" />
					<input type="hidden" name="m_id" value="<?php echo $TPL_VAR["m_id"]?>" />
					<table id="printPost1" class="post_body" cellspacing="0" cellpadding="0">
					<tr>
						<td class="bcl" nowrap="nowrap"></td>
						<td class="bcc">
							<table  cellpadding="0" cellspacing="0" border="0">
							<tr>
								<td><div style="background:url(/shop/data/skin/loosfly/img/common/img_c_re_pass.gif) center no-repeat;width:420px;height:111px;" /></div></td>
							</tr>
							<tr align="center" valign="middle">
								<td>
<?php if($TPL_VAR["temp_email"]){?>
									<div class="method-wrap">
										<div class="method" style="background-image:url(/shop/data/skin/loosfly/img/common/img_re_email.gif);">
											<div class="cont">
												<?php echo $TPL_VAR["temp_email"]?>

												<a href="javascript:void(0);" onClick="<?php if($TPL_VAR["temp_email"]){?>selectOption(1);<?php }else{?>alert('이메일 주소가 올바르지 않아, 전송할 수 없습니다.');<?php }?>"><img src="/shop/data/skin/loosfly/img/common/btn_get_authnum.gif" align="absmiddle" /></a>
											</div>
										</div>
									</div>
<?php }?>
<?php if($TPL_VAR["temp_mobile"]){?>
									<div class="method-wrap">
										<div class="method" style="background-image:url(/shop/data/skin/loosfly/img/common/img_re_phone.gif);">
											<div class="cont">
												<?php echo $TPL_VAR["temp_mobile"]?>

												<a href="javascript:void(0);" onClick="<?php if($TPL_VAR["temp_mobile"]){?>selectOption(2);<?php }else{?>alert('휴대폰 번호가 올바르지 않아, 전송할 수 없습니다.');<?php }?>"><img src="/shop/data/skin/loosfly/img/common/btn_get_authnum.gif" align="absmiddle" /></a>
											</div>
										</div>
									</div>
<?php }?>
								</td>
							</tr>
							<tr><td style="height:10px;" colspan="3"></td></tr>
							</table>
						</td>
						<td class="bcr" nowrap="nowrap"></td>
					</tr>
					</table>
				</form>
				<table class="post_footer" cellspacing="0" cellpadding="0"><tbody><tr><td class="ftl" nowrap="nowrap"></td><td class="ftc"></td><td class="ftr" nowrap="nowrap"></td></tr></tbody></table>
			</div>
		</div><!-- End indiv -->


<?php $this->print_("footer",$TPL_SCP,1);?>