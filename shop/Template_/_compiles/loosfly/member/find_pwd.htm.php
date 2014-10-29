<?php /* Template_ 2.2.7 2013/12/19 14:00:42 /www/loosfly_godo_co_kr/shop/data/skin/loosfly/member/find_pwd.htm 000007821 */ ?>
<?php $this->print_("header",$TPL_SCP,1);?>


<script language="javascript">
	function goIDCheckIpin()
	{
		var fm ;
		fm = document.getElementById("form");
		var popupWindow = window.open( "", "popupCertKey", "width=450, height=550, top=100, left=100, fullscreen=no, menubar=no, status=no, toolbar=no, titlebar=yes, location=no, scrollbar=no" );
<?php if($TPL_VAR["ipinyn"]=='y'){?>
			ifrmRnCheck.location.href="<?php echo url("member/ipin/IPINCheckRequest.php?")?>&callType=findpwd";
<?php }elseif($TPL_VAR["niceipinyn"]=='y'){?>
			ifrmRnCheck.location.href="<?php echo url("member/ipin/IPINMain.php?")?>&callType=findpwd";
<?php }?>
		return;
	}
	
	function gohpauthDream(){ //휴대폰본인인증
		var protocol = location.protocol;
		var callbackUrl = "<?php echo ProtocolPortDomain()?><?php echo $GLOBALS["cfg"]["rootDir"]?>/member/hpauthDream/hpauthDream_Result.php";
		ifrmHpauth.location.href=protocol+"//hpauthdream.godo.co.kr/module/NEW_hpauthDream_Main.php?callType=findpwd&shopUrl="+callbackUrl+"&cpid=<?php echo $TPL_VAR["hpauthDreamcpid"]?>";
		return;
	}
	$(window).load(function() {  document.fm.srch_id.focus(); });
</script>

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
			<div style="width:420px;margin:0 auto;">
				<table class="post_head" cellspacing="0" cellpadding="0"><tr><td class="htl" nowrap="nowrap"></td><td class="htc"></td><td class="htr" nowrap="nowrap"></td></tr></table>
				<form method="post" name="fm" action="" onsubmit="return chkForm( this );" id="form">
					<input type="hidden" name="act" value="Y">
					<input type="hidden" name=rncheck value="none">
					<input type="hidden" name=dupeinfo value="">
<?PHP 
$h = 30;$r = 3;
if( $GLOBALS["checked"]["useField"]["resno"]) { $r = 4; }
?>
					<table id="printPost1" class="post_body" cellspacing="0" cellpadding="0">
					<tr>
						<td class="bcl" nowrap="nowrap"></td>
						<td class="bcc">
							<div id="box01" style="">
								<div style="height:25px;"></div>
								<div id="row01" style="">
									<div id="col0101" style="position:relative;float:left;width:120px;height:<?PHP echo $h."px"; ?>;padding-right:10px;text-align:right;">아이디 : </div>
									<div id="col0201" style="position:relative;float:left;width:140px;height:<?PHP echo $h."px"; ?>;padding-right:10px;text-align:left;"><input name="srch_id" type="text" size="50" required label="아이디" tabindex="1" style="width:140px;"></div>
								</div>
								<div id="row02" style="clear:both">
									<div id="col0102" style="position:relative;float:left;width:120px;height:<?PHP echo $h."px"; ?>;padding-right:10px;text-align:right;">이름 : </div>
									<div id="col0202" style="position:relative;float:left;width:140px;height:<?PHP echo $h."px"; ?>;padding-right:10px;text-align:left;"><input name="srch_name" type="text" size="50" required label="이름" tabindex="2" style="width:140px;"></div>
								</div>
<?php if($GLOBALS["checked"]["useField"]["resno"]){?>
								<div id="row03" style="clear:both">
									<div id="col0103" style="position:relative;float:left;width:120px;height:<?PHP echo $h."px"; ?>;padding-right:10px;text-align:right;">주민등록번호 : </div>
									<div id="col0203" style="position:relative;float:left;width:140px;height:<?PHP echo $h."px"; ?>;padding-right:10px;text-align:left;"><input name="srch_num1" type="text" size="9" maxlength="6" required label="주민등록번호" onkeyup="if (this.value.length==6) this.nextSibling.nextSibling.focus()" onkeydown="onlynumber()" tabindex="3"> - <input maxlength="7" name="srch_num2" type="password" size="9" required label="주민등록번호" onkeydown="onlynumber()" tabindex="4"></div>
								</div>
<?php }?>
<?php if($GLOBALS["checked"]["useField"]["email"]){?>
								<div id="row04" style="clear:both">
									<div id="col0104" style="position:relative;float:left;width:120px;height:<?PHP echo $h."px"; ?>;padding-right:10px;text-align:right;">메일주소 : </div>
									<div id="col0204" style="position:relative;float:left;width:140px;height:<?PHP echo $h."px"; ?>;padding-right:10px;text-align:left;"><input name="srch_mail" type="text" size="50" required label="메일주소" tabindex="5" style="width:140px;"></div>
									<div id="col0304" style="position:relative;float:left;width:90px;height:<?PHP echo $h."px"; ?>;padding-bottom:4px;text-align:left;"><input type="image" src="/shop/data/skin/loosfly/img/jimmy/buttons/findpw_01.gif" tabindex="3"></div>
								</div>
<?php }?>
<?php if($TPL_VAR["ipinyn"]=='y'||$TPL_VAR["niceipinyn"]=='y'||$TPL_VAR["hpauthDreamyn"]=='y'){?>
								<div id="row05" style="clear:both">
									<div style="height:30px;font:normal 13px/20px;padding:5px 0 5px 0;"><img src="/shop/data/skin/loosfly/img/ipin/Regist_box_icon.gif"/> <font color='5d5d5d'>회원 가입시 사용 하신 본인확인 인증 수단을 선택하시고 필요한 사항을 입력하세요.</font></div>
									<div style="text-align:center;">
<?php if($TPL_VAR["ipinyn"]=='y'||$TPL_VAR["niceipinyn"]=='y'){?>
										<span style="padding-right:10px;">
										<img src="/shop/data/skin/loosfly/img/ipin/ipin_btn.gif" onclick="goIDCheckIpin();" style="cursor:pointer;">
										<iframe id="ifrmRnCheck" name="ifrmRnCheck" style="width:500px;height:500px;display:none;"></iframe>
										</span>
<?php }?>
<?php if($TPL_VAR["hpauthDreamyn"]=='y'){?>
										<span>
										<img src="/shop/data/skin/loosfly/img/auth/hp_btn.gif" alt="휴대폰본인인증" onclick="gohpauthDream();" style="cursor:pointer;">
										<iframe id="ifrmHpauth" name="ifrmHpauth" style="width:500px;height:500px;display:none;"></iframe>
										</span>
<?php }?>
									</div>
								</div>
<?php }?>
								<div id="row06" style="clear:both">
									<div style="height:40px;border:#c2c2c2 0 solid;border-bottom-width:1px;"></div>
										<div style="padding-top:25px;">
											<span style="position:relative;left:130px;"><a href="<?php echo url("member/login.php")?>&"><img src="/shop/data/skin/loosfly/img/jimmy/buttons/login_01.gif"></a></span>
											<span style="position:relative;left:180px;"><a href="<?php echo url("member/find_id.php")?>&"><img src="/shop/data/skin/loosfly/img/jimmy/buttons/findid_01.gif"></a></span>
										</div>
									</div>
									<div style="height:40px;"></div>
									<div style="text-align:center; padding:10px 5px;background-color:#efefef">
										<div style="text-align:left;border:#ffffff 0 solid;border-bottom-width:1px;line-height:20px;height:20px;">언제든 연락 주세요.</div>
										<div style="text-align:left;line-height:15px;color:#515151;padding-top:10px;">
											루스플라이는 언제나 여러분을 환영합니다. 사이트 이용중 궁금하신 점이나 제안하실 점 또는 개선할 점이 있을 때는 언제든 아래 연락처로 문의하시기 바랍니다. 
										</div>
									</div>
								</div>
								<div style="height:10px;"></div>
							</div>
						</td>
						<td class="bcr" nowrap="nowrap"></td>
					</tr>
					</table>
				</form>
				<table class="post_footer" cellspacing="0" cellpadding="0"><tbody><tr><td class="ftl" nowrap="nowrap"></td><td class="ftc"></td><td class="ftr" nowrap="nowrap"></td></tr></tbody></table>
			</div>
		</div><!-- End indiv -->
	</div>	

<?php $this->print_("footer",$TPL_SCP,1);?>