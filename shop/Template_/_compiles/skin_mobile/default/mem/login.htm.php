<?php /* Template_ 2.2.7 2012/12/12 18:23:00 /www/loosfly_godo_co_kr/shop/data/skin_mobile/default/mem/login.htm 000002356 */ ?>
<?php $this->print_("header",$TPL_SCP,1);?>


<?php  $TPL_VAR["page_title"] = "�α���";?>
<?php $this->print_("sub_header",$TPL_SCP,1);?>


<section id="login">
	<form name="login_form" action="<?php echo $GLOBALS["cfg"]["rootDir"]?>/member/login_ok.php" method="post" onSubmit="chk_save(this);return chkForm(this);">
	<input type=hidden name=returnUrl value="<?php echo $GLOBALS["returnUrl"]?>">
		<fieldset>
			<legend class="hidden">�α��� ��</legend>
			<div class="login_b">
				<div class="login_l">
				<label class="input_id">
					<span>���̵�</span>
					<input type="text" class="m_id" name="m_id" value="" maxlength="12" title="���̵�" required="required" msgR="���̵� �Է��ϼ���." onfocus="if(this.value=='ȸ�����̵�'){this.value='';}" tabindex="1" />
				</label>
				<label class="input_pw">
					<span>��й�ȣ</span>
					<input type="password" name="password" maxlength="34" title="��й�ȣ" required="required" msgR="��й�ȣ�� �Է��ϼ���." tabindex="2" />
				</label>
				</div>
				<div class="login_btn"><button type="submit" tabindex="5"><span class="hidden">�α���</span></button></div>
			</div>
			
			<h3 class="hidden">�α��� �ɼ�</h3>
			<ul class="login_option">
				<li><label><input type="checkbox" name="save_id" value="y" onclick="chk_save_id(this.checked);" tabindex="3" />���̵� ����</label></li>
				<li><label><input type="checkbox" name="save_pw" value="y" onclick="chk_save_pw(this.checked);" tabindex="4" />��й�ȣ ����</label></li>
				
			</ul>		
		</fieldset>
	</form>

	<div class="non_member">
		<a href="<?php echo $GLOBALS["mobileRootDir"]?>/ord/order.php?non_member=true">��ȸ������ �����ϱ�</a>
	</div>

	<div class="login_desc">
		<h4 class="hidden">����</h4>
		<ul>
			<li>ȸ���α����� �Ͻø� ���� ���� �� ������ ���������� �� �ֽ��ϴ�.</li>
			<li>ȸ�������� �¶��� ���θ��� ���ؼ� �����Ͻʴϴ�.</li>
		</ul>
	</div>
</section>

<script language="javascript">var shop_key = "<?php echo $_SERVER['HTTP_HOST'];?>";</script>
<script src="/shop/data/skin_mobile/default/common/js/base64.js"></script>
<script src="/shop/data/skin_mobile/default/common/js/login.js"></script>

<?php $this->print_("footer",$TPL_SCP,1);?>