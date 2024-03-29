<?php /* Template_ 2.2.7 2012/12/12 18:23:00 /www/loosfly_godo_co_kr/shop/data/skin_mobile/default/mem/login.htm 000002356 */ ?>
<?php $this->print_("header",$TPL_SCP,1);?>


<?php  $TPL_VAR["page_title"] = "로그인";?>
<?php $this->print_("sub_header",$TPL_SCP,1);?>


<section id="login">
	<form name="login_form" action="<?php echo $GLOBALS["cfg"]["rootDir"]?>/member/login_ok.php" method="post" onSubmit="chk_save(this);return chkForm(this);">
	<input type=hidden name=returnUrl value="<?php echo $GLOBALS["returnUrl"]?>">
		<fieldset>
			<legend class="hidden">로그인 폼</legend>
			<div class="login_b">
				<div class="login_l">
				<label class="input_id">
					<span>아이디</span>
					<input type="text" class="m_id" name="m_id" value="" maxlength="12" title="아이디" required="required" msgR="아이디를 입력하세요." onfocus="if(this.value=='회원아이디'){this.value='';}" tabindex="1" />
				</label>
				<label class="input_pw">
					<span>비밀번호</span>
					<input type="password" name="password" maxlength="34" title="비밀번호" required="required" msgR="비밀번호를 입력하세요." tabindex="2" />
				</label>
				</div>
				<div class="login_btn"><button type="submit" tabindex="5"><span class="hidden">로그인</span></button></div>
			</div>
			
			<h3 class="hidden">로그인 옵션</h3>
			<ul class="login_option">
				<li><label><input type="checkbox" name="save_id" value="y" onclick="chk_save_id(this.checked);" tabindex="3" />아이디 저장</label></li>
				<li><label><input type="checkbox" name="save_pw" value="y" onclick="chk_save_pw(this.checked);" tabindex="4" />비밀번호 저장</label></li>
				
			</ul>		
		</fieldset>
	</form>

	<div class="non_member">
		<a href="<?php echo $GLOBALS["mobileRootDir"]?>/ord/order.php?non_member=true">비회원으로 구매하기</a>
	</div>

	<div class="login_desc">
		<h4 class="hidden">도움말</h4>
		<ul>
			<li>회원로그인을 하시면 각종 혜택 및 정보를 제공받으실 수 있습니다.</li>
			<li>회원가입은 온라인 쇼핑몰을 통해서 가능하십니다.</li>
		</ul>
	</div>
</section>

<script language="javascript">var shop_key = "<?php echo $_SERVER['HTTP_HOST'];?>";</script>
<script src="/shop/data/skin_mobile/default/common/js/base64.js"></script>
<script src="/shop/data/skin_mobile/default/common/js/login.js"></script>

<?php $this->print_("footer",$TPL_SCP,1);?>