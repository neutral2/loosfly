<?php /* Template_ 2.2.7 2013/12/16 18:59:11 /www/loosfly_godo_co_kr/shop/data/skin/loosfly/member/login.htm 000004092 */ ?>
<?php $this->print_("header",$TPL_SCP,1);?>


<script>
window.onload = function(){ getid(document.frm_login); document.form.m_id.focus(); }
</script>


<div style="height:15px;"></div>
<div id="blkContentsNoMenu">
	<div id="bxLogin">
		<table class="post_head" cellspacing="0" cellpadding="0"><tr><td class="htl" nowrap="nowrap"></td><td class="htc"></td><td class="htr" nowrap="nowrap"></td></tr></table>
		<table id="printPost1" class="post_body" cellspacing="0" cellpadding="0">
		<tr>
			<td class="bcl" nowrap="nowrap"></td>
			<td class="bcc">
				<div id="login_section">
					<div id="body_title">log<span class="emphasis">i</span>n.</div>
					<div style="height:15px"></div>
					<div id="login_box">
						<form method="post" action="<?php echo $TPL_VAR["loginActionUrl"]?>" id="login_form" name="frm_login">
						<input type="hidden" name="returnUrl" value="<?php echo $GLOBALS["returnUrl"]?>">
						<table width="100%" cellpadding="0" cellspacing="0" border="0">
							<tr><td style="height:15px"></td></tr>
							<tr>
								<td class="login_tag">아이디:</td>
								<td class="login_input"><input type="text"  name="m_id" size="20" tabindex="1" style="width:130px"></td>
								<td>
<?php if($GLOBALS["cfg"]["ssl"]=="1"){?>				
									<font style="font-size:11;">보안로그인:</font><font style="font-family:'Arial';font-size:9;color:#4499fa;font-weight:bold;">ON</font>
<?php }?>
								</td>
							</tr>
							<tr>
								<td class="login_tag">비밀번호:</td>
								<td class="login_input"><input type="password" name="password" size="20" tabindex="2" style="width:130px"></td>
								<td><input type="image" id="login_btn" src="http://www.loosfly.com/shop/data/skin/loosfly/img/jimmy/buttons/login_01.gif" tabindex="3"></td>
							</tr>
							<tr>
								<td> </td>
								<td height="30"><input type="checkbox" name="save_id" id="save_id" onClick="saveid(this.form)">아이디 기억하기</td>
								<td> </td>
							</tr>
							<tr><td colspan="3" style="height:15px"></td></tr>
							<tr>
								<td colspan="3">
									- 회원 로그인 시, 모든 SNS 계정에도 로그인 할 수 있습니다.<br>
									- 첫 로그인 할 때만 자주 쓰는 여러 SNS 계정을 설정하면<br>&nbsp;&nbsp;다음 접속부터 대표계정 하나만으로 자동 로그인 됩니다.<br>
									- 회원이 아니어도 SNS를 통해 댓글을 남길 수 있습니다.<br>
								</td>
							</tr>
							<tr><td colspan="3" style="height:15px"> </td></tr>
						</table>
						</form>
					</div>
					<div style="height:35px"></div>
					<div class="btn_box">
						<span><a href="/shop/member/join.php?&"><img src="http://www.loosfly.com/shop/data/skin/loosfly/img/jimmy/buttons/signup_01.gif" alt="회원가입"></a></span>
						<span id="btn_02"><a href="/shop/member/find_id.php"><img src="http://www.loosfly.com/shop/data/skin/loosfly/img/jimmy/buttons/findid_01.gif" alt="아이디찾기"></a></span>
						<span id="btn_03"><a href="/shop/member/find_pwd.php?&"><img src="http://www.loosfly.com/shop/data/skin/loosfly/img/jimmy/buttons/findpw_01.gif" alt="비밀번호찾기"></a></span>
					</div>
<?php if($_GET["guest"]){?>
					<div style="height:40px"></div>
					<div class="btn_box" align="right"><a href="<?php echo url("order/order.php?")?>&guest=1">비회원으로 구매하기 >></a></div>
<?php }?>
				</div>
		<?PHP
			$num = rand(1, 5);
			$filename = "http://www.loosfly.com/shop/data/skin/loosfly/img/jimmy/login_photo/login_photo_0".$num.".jpg";
		?>
				<div id="photo_section">
					<img src="<?PHP echo $filename; ?>" alt="login_photo">
				</div>
			</td>
			<td class="bcr" nowrap="nowrap"></td>
		</tr>
		</table>
		<table class="post_footer" cellspacing="0" cellpadding="0"><tbody><tr><td class="ftl" nowrap="nowrap"></td><td class="ftc"></td><td class="ftr" nowrap="nowrap"></td></tr></tbody></table>
	</div>
</div>
<div style="height:30px;"></div>

<!-- End indiv -->

<?php $this->print_("footer",$TPL_SCP,1);?>