<?php /* Template_ 2.2.7 2013/12/19 15:33:53 /www/loosfly_godo_co_kr/shop/data/skin/loosfly/member/_form.htm 000043550 */ 
if (is_array($TPL_VAR["ts_category_all"])) $TPL_ts_category_all_1=count($TPL_VAR["ts_category_all"]); else if (is_object($TPL_VAR["ts_category_all"]) && in_array("Countable", class_implements($TPL_VAR["ts_category_all"]))) $TPL_ts_category_all_1=$TPL_VAR["ts_category_all"]->count();else $TPL_ts_category_all_1=0;?>
<script src="/shop/data/skin/loosfly/godo.password_strength.js" type="text/javascript"></script>
				<style type="text/css">
					div.passwordStrenth {background-color:#FFFFFF; border:1px #CCCCCC solid; padding:10px; width:263px;display:none; position:absolute;}
					
					div.passwordStrenth p {margin:0;padding:5px 0 0 0; font-size:11px; font-family:dotum;color:#616161; }
					
					div.passwordStrenth dl {margin:0;padding:0 6px 0 0;color:#373737; font-weight:bold;font-size:11px; font-family:dotum; }
					div.passwordStrenth dl dt,
					div.passwordStrenth dl dd {display:inline;font-size:11px; font-family:dotum;margin:0;height:15px;line-height:15px;}
					
					div.passwordStrenth dl dt {color:#363636; font-weight:bold; width:95px;}
					
					div.passwordStrenth dl dd {text-indent:0px;font-size:12px; width:110px;background:url('/shop/data/skin/loosfly/img/common/password_level.gif') no-repeat top left;}
					div.passwordStrenth dl dd.lv0 {color:#F52D00;background-position:20px 0;}
					div.passwordStrenth dl dd.lv1 {color:#F52D00;background-position:20px -29px;}
					div.passwordStrenth dl dd.lv2 {color:#F52D00;background-position:20px -44px;}
					div.passwordStrenth dl dd.lv3 {color:#F52D00;background-position:20px -59px;}
					div.passwordStrenth dl dd.lv4 {color:#F52D00;background-position:20px -59px;}
				</style>

				<style>
					.memberCols1 { width:100px; height:30px; text-align:right; padding-right:10px; font-style:bold; font-size:8pt; color:#5D5D5D; letter-spacing:-1; }
					.memberCols2 { text-align:left; padding-left:10px; }
					.memberCols3 { width:85px; font-size:8pt; color:#5D5D5D; letter-spacing:-1; }
					.scroll	{
						scrollbar-face-color: #FFFFFF;
						scrollbar-shadow-color: #AFAFAF;
						scrollbar-highlight-color: #AFAFAF;
						scrollbar-3dlight-color: #FFFFFF;
						scrollbar-darkshadow-color: #FFFFFF;
						scrollbar-track-color: #F7F7F7;
						scrollbar-arrow-color: #838383;
						width:790px;
						height:250px;
						padding:10px; 
						background:#ffffff;
						margin:0 auto;
					}
					#boxScroll{overflow: auto; BACKGROUND: #ffffff; COLOR: #585858; font:9pt ����;border:1px #dddddd solid; overflow-x:hidden;text-align:left; }
					
					#pwdManual { border:2px solid #BFBFBF; display:none; position:absolute; width:410px; background:#ffffff;margin-top:10px; }
					#pwdManual p { background:#F1F1F1 url('/shop/data/skin/loosfly/img/common/blt_tip_gr.gif') no-repeat 10px center;margin:0;padding:12px 10px 12px 50px;color:#373737;font-weight:bold;}
					#pwdManual p.close { background:none;padding:0px 10px 5px 0;margin:0;text-align:right;}
					#pwdManual ul {list-style:none;margin:0;padding:15px;}
					#pwdManual ul li {color:#6E6E6E; font-size:11px; line-height:17px;letter-spacing:-1px;}
					
					#ipinManual { border:2px solid #BFBFBF; display:none; position:absolute; width:560px; z-index:999; }
					#ipinManual .ipinmTop { background-color:#F1F1F1; color:#373737; font-weight:bold; padding:7px; }
					#ipinManual .ipinmBottom { background-color:#FFFFFF; padding:10px 0px; }
					#ipinManual .ipinmBottom .ipinmbText { color:#6E6E6E; font-size:11px; line-height:17px; margin-left:20px; }
					#ipinManual .ipinmBottom .ipinmbText a { color:#6E6E6E; font-size:11px; font-weight:bold; line-height:17px; }
					#ipinManual .ipinmBottom .ipinmbDotted { border-top:1px dotted #C0C0C0; margin:10px 20px; }
					#ipinManual .ipinmBottom .ipinmbSolid { border-top:1px solid #C0C0C0; margin:10px 20px; }
					#ipinManual .ipinmBottom .ipinmbTerm { margin:10px 20px; }
					#ipinManual .ipinmBottom .ipinmbButton { margin:15px 10px 5px 10px; text-align:center; }
					
					#mform input { border-color:#cfcfcf; }
				</style>

				<form id="mform" name="frmMember" method="post" action="<?php echo $TPL_VAR["memActionUrl"]?>" onsubmit="return chkForm2(this)">
					<input type="hidden" name="mode" value="<?php echo $GLOBALS["mode"]?>">
					<input type="hidden" name="rncheck" value="<?php echo $TPL_VAR["rncheck"]?>">
					<input type="hidden" name="dupeinfo" value="<?php echo $TPL_VAR["dupeinfo"]?>">
					<input type="hidden" name="pakey" value="<?php echo $TPL_VAR["pakey"]?>">
					<input type="hidden" name="foreigner" value="<?php echo $TPL_VAR["foreigner"]?>">
<?php if($GLOBALS["sess"]){?>
					<input type="hidden" name="m_id" value="<?php echo $TPL_VAR["m_id"]?>">
<?php }?>
					<input type="hidden" name="private1" value="<?php echo $TPL_VAR["private1"]?>">
<?php if($GLOBALS["mode"]=="joinMember"){?>
					<input type="hidden" name="private2" value="<?php echo $TPL_VAR["private2"]?>">
					<input type="hidden" name="private3" value="<?php echo $TPL_VAR["private3"]?>">
<?php }else{?>
<?php if($GLOBALS["cfg"]['private2YN']=='Y'){?>
					<div style="padding-top:10px; background:#f1f1f1; text-align:center;">
						<div align="left" style="height:26px;padding:3px 0 0 10px;"><b>�� �������� ��3�� ���� ����</b></div>
						<div id="boxScroll" class="scroll"><?php echo $this->define('tpl_include_file_1',"/service/_private2.txt")?> <?php $this->print_("tpl_include_file_1",$TPL_SCP,1);?></div>
						<div align=center class="noline" style="height:30;margin-top:10px;" >
							<input type="radio" name="private2" value="y" <?php echo $GLOBALS["checked"]["private2"]["y"]?> required fld_esssential label="�������� ��3�� ���� ����" msgR="���� ���θ� üũ���ּ���."> �����մϴ� &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="radio" name="private2" value="n" <?php echo $GLOBALS["checked"]["private2"]["n"]?> required fld_esssential  label="�������� ��3�� ���� ����" msgR="���� ���θ� üũ���ּ���."> �������� �ʽ��ϴ�
						</div>
					</div>
					<p>
<?php }?>
<?php if($GLOBALS["cfg"]['private3YN']=='Y'){?>
					<div style="padding-top:10; background:#F1F1F1;  text-align:center;">
						<div align="left" style="height:26;padding:3px 0 0 10px;"><b>�� ����������� ��Ź ����</b></div>
						<div id="boxScroll" class="scroll"><?php echo $this->define('tpl_include_file_2',"/service/_private3.txt")?> <?php $this->print_("tpl_include_file_2",$TPL_SCP,1);?></div>
						<div align=center class="noline" style="height:30;margin-top:10px;" >
							<input type="radio" name="private3" value="y" <?php echo $GLOBALS["checked"]["private3"]["y"]?> required fld_esssential label="����������� ��Ź ����" msgR="���� ���θ� üũ���ּ���."> �����մϴ� &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="radio" name="private3" value="n" <?php echo $GLOBALS["checked"]["private3"]["n"]?> required fld_esssential label="����������� ��Ź ����" msgR="���� ���θ� üũ���ּ���."> �������� �ʽ��ϴ�
						</div>
					</div>
					<p>
<?php }?>
<?php }?>

<!-- ���̹�üũ�ƿ�(ȸ������) -->
<?php echo $TPL_VAR["naverCheckout_oneclickStep"]?>

					<div><div style="color:#ff6000;float:left;width:415px;height:30px">����ȸ������</div><div style="float:right;width:415px;text-align:right;"><font color="#ff6000">��</font><font class="small"><b>�ʼ��Է»���</b></font></div></div>
					<div style="border:1px solid #dedede;clear:both;" class="hundred">
						<table width="100%" cellpadding="0" cellspacing="0" border="0">
						<tr>
							<td style="border:5px solid #f3f3f3;">
								<table width="100%" cellpadding="0" cellspacing="0">
								<tr>
									<td style="padding:10px 0" align="center">
										<table width="97%" cellpadding="5" cellspacing="0" border="0">
										<tr>
											<td class="memberCols1"><font color="#ff6000">��</font> ���̵�</td>
											<td class="memberCols2">
<?php if(!$GLOBALS["sess"]){?>
												<input type=text name=m_id value="<?php echo $TPL_VAR["m_id"]?>" maxlength=16 required fld_esssential option=regId label="���̵�">
												<input type=hidden name=chk_id required fld_esssential label="���̵��ߺ�üũ">
												<a href="javascript:chkId()"><img src="/shop/data/skin/loosfly/img/common/btn_idcheck.gif" border="0" align="absmiddle"></a>
<?php }else{?>
												<span class=eng><b><?php echo $TPL_VAR["m_id"]?></b></span>
<?php }?>
											</td>
										</tr>
										<tr><td colspan="2" height="1" bgcolor="#efefef" style="padding:0px;"></td></tr>
<?php if($GLOBALS["mode"]=='modMember'){?>
										<tr>
											<td class="memberCols1"><font color="#ff6000">��</font> ��й�ȣ</td>
											<!-- ��й�ȣ ��ư -->
											<td class="memberCols2">
												<a href="javascript:void(0);" onclick="openPasswordField()"><img src="/shop/data/skin/loosfly/img/common/btn_change_pwd.gif" align="absmiddle" alt="��й�ȣ ����" /></a>
												<a href="javascript:void(0);" onclick="_ID('pwdManual').style.display='block';"><img src="/shop/data/skin/loosfly/img/common/btn_help_pwd.gif" align="absmiddle" alt="��й�ȣ ����" /></a><br />
												<!-- ��й�ȣ ���� -->
												<div id="pwdManual">
													<p>��й�ȣ�� ���� ��ҹ���, ����, Ư�����ڸ� �����Ͻø� ��й�ȣ �������� ������ ������ ������ �پ��ϴ�.</p>
													<ul>
														<li>���� ��ҹ��ڴ� ������ �Ǹ�, �Ѱ��� ���ڷθ� �Է��� �����մϴ�.</li>
														<li>��밡���� Ư������ : ! " @ # $ % ^ & ' ( ) * + = , - _ . : ; < > ? /  ` ~ | { } </li>
														<li>ID, �ֹι�ȣ , ����, ��ȭ��ȣ ���� ���������� ��� ��� ��������� 3�� �̻� ���� ����� �����ּ���.</li>
														<li>��й�ȣ�� �ֱ������� �ٲپ� ����Ͻô� ���� �����մϴ�.</li>
													</ul>
													<p class="close"><a href="javascript:void(0);" onclick="_ID('pwdManual').style.display='none';"><img src="/shop/data/skin/loosfly/img/common/close_x.gif" /></a></p>
												</div>
											</td>
										</tr>
										<tr id="pwLayer01" style="display:none;"><td colspan="2" height="1" bgcolor="#efefef" style="padding:0px;"></td></tr>
										<tr id="pwLayer02" style="display:none;">
											<td class="memberCols1">&nbsp;</td>
											<!-- ��й�ȣ ��ư -->
											<td class="memberCols2">
												<table cellpadding="0" cellspacing="0" border="0">
												<tr>
													<td class="memberCols3">���� ��й�ȣ</td>
													<td>
														<input type="password" name="originalPassword" id="originalPassword" />
														<span style="font-size::8pt;color:#007FC8">���� ��й�ȣ�� �Է��� �ּ���.</span>
													</td>
												</tr>
												<tr>
													<td class="memberCols3">�� ��й�ȣ</td>
													<td>
														<input type="password" name="newPassword" id="newPassword" onfocus="checkPassword(this)" onkeyup="checkPassword(this)" onblur="emptyPwState()" />
														<div class="passwordStrenth" id="el-password-strength-indicator">
															<dl>
																<dt>��й�ȣ ������</dt>
																<dd id="el-password-strength-indicator-level"></dd>
															</dl>
															<p id="el-password-strength-indicator-msg"></p>
														</div>
														<span style="font-size:8pt;color:#007FC8">���� ������ ��й�ȣ�� �Է��� �ּ���.</span>
													</td>
												</tr>
												<tr>
													<td class="memberCols3">�� ��й�ȣ Ȯ��</td>
													<td>
														<input type="password" name="confirmPassword" id="confirmPassword" />
														<span style="font-size:8pt;color:#007FC8">���� ������ ��й�ȣ�� �ٽ� �ѹ� �Է��� �ּ���.</span>
													</td>
												</tr>
												</table>
											</td>
										</tr>
<?php }else{?>
										<tr>
											<td class="memberCols1"><font color="#ff6000">��</font> ��й�ȣ</td>
											<td class="memberCols2">
												<input type=password name=password required fld_esssential option=regPass label="��й�ȣ" onfocus="checkPassword(this)" onkeyup="checkPassword(this)" onblur="emptyPwState()">
												<div class="passwordStrenth" id="el-password-strength-indicator">
													<dl>
														<dt>��й�ȣ ������</dt>
														<dd id="el-password-strength-indicator-level"></dd>
													</dl>
													<p id="el-password-strength-indicator-msg"></p>
												</div>
											</td>
										</tr>
										<tr><td colspan="2" height="1" bgcolor="#efefef" style="padding:0px;"></td></tr>
										<tr>
											<td class="memberCols1"><font color="#ff6000">��</font> ��й�ȣȮ��</td>
											<td class="memberCols2">
												<input type=password name=password2 required fld_esssential option=regPass label="��й�ȣ">
											</td>
										</tr>
<?php }?>
										<tr><td colspan="2" height="1" bgcolor="#efefef" style="padding:0px;"></td></tr>
										<tr>
											<td class="memberCols1"><font color="#ff6000">��</font> �̸�</td>
											<td class="memberCols2">
<?php if($GLOBALS["mode"]=="joinMember"&&$TPL_VAR["name"]){?>
											<input type="hidden" name="name" value="<?php echo $TPL_VAR["name"]?>"><?php echo $TPL_VAR["name"]?>

<?php }else{?>
											<input type=text name=name value="<?php echo $TPL_VAR["name"]?>" required fld_esssential label="�̸�">
<?php }?>
											</td>
										</tr>
										<tr><td colspan="2" height="1" bgcolor="#efefef" style="padding:0px;"></td></tr>
<?php if($GLOBALS["checked"]["useField"]["nickname"]){?>
										<tr>
											<td class="memberCols1"><?php if($GLOBALS["required"]["nickname"]){?><font color="#ff6000">��</font> <?php }?> �г���</td>
											<td class="memberCols2">
												<input type="text" name="nickname" value="<?php echo $TPL_VAR["nickname"]?>" <?php echo $GLOBALS["required"]["nickname"]?> label="�г���">
												<input type=hidden name=chk_nickname <?php if($GLOBALS["required"]["nickname"]&&!$GLOBALS["sess"]){?>required fld_esssential<?php }?> label="�г����ߺ�üũ">
												<a href="javascript:chkNickname()"><img src="/shop/data/skin/loosfly/img/common/btn_nickcheck.gif" border="0" align="absmiddle"></a>
											</td>
										</tr>
										<tr><td colspan="2" height="1" bgcolor="#efefef" style="padding:0px;"></td></tr>
<?php }?>
<?php if($GLOBALS["checked"]["useField"]["resno"]){?>
										<tr>
<?php if($TPL_VAR["rncheck"]=='ipin'){?>
											<td class="memberCols1"><?php if($GLOBALS["required"]["resno"]){?><font color="#ff6000">��</font> <?php }?>�ֹε�Ϲ�ȣ</td>
											<td class="memberCols2">
												<font color="#ff6000">������(����������)</font>
												<input type="hidden" name="resno[]" value="">
												<input type="hidden" name="resno[]" value="">
											</td>
<?php }else{?>
											<td class="memberCols1"><?php if($GLOBALS["required"]["resno"]){?><font color="#ff6000">��</font> <?php }?>�ֹε�Ϲ�ȣ</td>
											<td class="memberCols2">
<?php if($GLOBALS["sess"]){?>
<?php if($TPL_VAR["resno1"]&&$TPL_VAR["resno2"]){?>
												<font color="#ff6000">128bit ��ȣȭ �Ǿ�����</font>
<?php }?>
<?php }elseif($TPL_VAR["resno"]){?>
												<input type="hidden" name=resno[] value="<?php echo $TPL_VAR["resno"][ 0]?>">
												<input type="hidden" name=resno[] value="<?php echo $TPL_VAR["resno"][ 1]?>">
												<?php echo $TPL_VAR["resno"][ 0]?> - *******
<?php }else{?>
												<input type="text" name=resno[] value="<?php echo $TPL_VAR["resno"][ 0]?>" <?php echo $GLOBALS["required"]["resno"]?> label="�ֹε�Ϲ�ȣ" size=8 maxlength=6 onKeyPress="onlynumber()"> -
												<input type=password name=resno[] value="<?php echo $TPL_VAR["resno"][ 1]?>" <?php echo $GLOBALS["required"]["resno"]?> label="�ֹε�Ϲ�ȣ" size=8 maxlength=7 onKeyPress="onlynumber()" <?php if($GLOBALS["checked"]["useField"]["sex"]||$GLOBALS["checked"]["useField"]["birth"]){?>onblur="<?php if($GLOBALS["checked"]["useField"]["sex"]){?>chkSex(this);<?php }?><?php if($GLOBALS["checked"]["useField"]["birth"]){?>chkBirth(this);<?php }?>"<?php }?>>
<?php }?>
<?php if($GLOBALS["ipin"]['nice_useyn']=='y'||$GLOBALS["ipin"]['useyn']=='y'){?>
												<a href="javascript:void(0);" onclick="_ID('ipinManual').style.display='block';"><img src="/shop/data/skin/loosfly/img/common/btn_jumin_to_ipin.gif" align="absmiddle" /></a><br />
<?php }?>
												<!-- ������ ���� -->
												<div id="ipinManual">
													<div class="ipinmTop">������(i-PIN) ��ȯ</div>
													<div class="ipinmBottom">
														<div class="ipinmbText">ȸ������ ���� ��ȣ�� ���Ͽ� �ֹε�� ��ȣ�� ������ �������� ��ȯ�ϱ� ���� ������ �Դϴ�.<br />������ ��ȯ�� ���Ͻø� <a href="javascript:goIDCheckIpin();">[���������� ��ȯ�ϱ�]</a> ��ư�� ���� �ּ���.</div>
														<div class="ipinmbDotted"></div>
														<div class="ipinmbText">������(i-PIN)�� ����������ȸ���� �ְ��ϴ� �ֹε�Ϲ�ȣ ��ü�������� ȸ������ �ֹε�Ϲ�ȣ ���<br />������ ID�� NICE�ſ�������(��) �κ��� �߱޹޾� ����Ȯ���� �ϴ� �����Դϴ�.</div>
														<div class="ipinmbTerm"></div>
														<div class="ipinmbText">������ �������� ���Խ� ������ ��������� ���� �Ǹ������� �ްԵǹǷ� <?php echo $GLOBALS["cfg"]['shopName']?>����<br />ȸ������ �ֹε�Ϲ�ȣ�� ������� �ʽ��ϴ�.</div>
														<div class="ipinmbSolid"></div>
														<div class="ipinmbButton">
															<a href="javascript:goIDCheckIpin();"><img src="/shop/data/skin/loosfly/img/common/btn_change_ipin.gif" align="absmiddle" /></a>
															<a href="javascript:void(0);" onclick="_ID('ipinManual').style.display='none';"><img src="/shop/data/skin/loosfly/img/common/btn_cancle_ipin.gif" align="absmiddle" /></a>
														</div>
													</div>
												</div>
											</td>
<?php }?>
										</tr>
										<tr><td colspan="2" height="1" bgcolor="#efefef" style="padding:0px;"></td></tr>
<?php }?>
<?php if($GLOBALS["checked"]["useField"]["sex"]){?>
										<tr>
											<td class="memberCols1"><?php if($GLOBALS["required"]["sex"]){?><font color="#ff6000">��</font> <?php }?>����</td>
											<td class="memberCols2">
												<span class="noline">
													<input type="radio" name="sex" <?php echo $GLOBALS["required"]["sex"]?> label="����" value="m" <?php echo $GLOBALS["checked"]["sex"]["m"]?>> ����
													<input type="radio" name="sex" <?php echo $GLOBALS["required"]["sex"]?> label="����" value="w" <?php echo $GLOBALS["checked"]["sex"]["w"]?>> ����
												</span>
											</td>
										</tr>
										<tr><td colspan="2" height="1" bgcolor="#efefef" style="padding:0px;"></td></tr>
<?php }?>
<?php if($GLOBALS["checked"]["useField"]["birth"]){?>
										<tr>
											<td class="memberCols1"><?php if($GLOBALS["required"]["birth"]){?><font color="#ff6000">��</font> <?php }?>�������</td>
											<td class="memberCols2">
												<input type="text" name="birth_year" value="<?php echo $TPL_VAR["birth_year"]?>" <?php echo $GLOBALS["required"]["birth"]?> label="�������" size="4" maxlength="4">��
												<input type="text" name="birth[]" value="<?php echo $TPL_VAR["birth"][ 0]?>" <?php echo $GLOBALS["required"]["birth"]?> label="�������" size="2" maxlength="2">��
												<input type="text" name="birth[]" value="<?php echo $TPL_VAR["birth"][ 1]?>" <?php echo $GLOBALS["required"]["birth"]?> label="�������" size="2" maxlength="2">��
										
<?php if($GLOBALS["checked"]["useField"]["calendar"]){?>
												<span class="noline" style="padding-left:10px">
													<input type="radio" name="calendar" value="s" checked> ���
													<input type="radio" name="calendar" value="l" <?php echo $GLOBALS["checked"]["calendar"]["l"]?>> ����
												</span>
<?php }?>
											</td>
										</tr>
										<tr><td colspan="2" height="1" bgcolor="#efefef" style="padding:0px;"></td></tr>
<?php }?>
<?php if($GLOBALS["checked"]["useField"]["marriyn"]){?>
										<tr>
											<td class="memberCols1"><?php if($GLOBALS["required"]["marriyn"]){?><font color="#ff6000">��</font> <?php }?>��ȥ����</td>
											<td class="memberCols2">
												<span class="noline">
													<input type="radio" name=marriyn value="n" <?php echo $GLOBALS["required"]["marriyn"]?> label="��ȥ����" <?php echo $GLOBALS["checked"]["marriyn"]["n"]?>> ��ȥ
													<input type="radio" name=marriyn value="y" <?php echo $GLOBALS["required"]["marriyn"]?> label="��ȥ����" <?php echo $GLOBALS["checked"]["marriyn"]["y"]?>> ��ȥ
												</span>
											</td>
										</tr>
										<tr><td colspan="2" height="1" bgcolor="#efefef" style="padding:0px;"></td></tr>
<?php }?>
<?php if($GLOBALS["checked"]["useField"]["marridate"]){?>
										<tr>
											<td class="memberCols1"><?php if($GLOBALS["required"]["marridate"]){?><font color="#ff6000">��</font> <?php }?>��ȥ�����</td>
											<td class="memberCols2">
												<input type="text" name="marridate[]" value="<?php echo $TPL_VAR["marridate"][ 0]?>" <?php echo $GLOBALS["required"]["marridate"]?> label="��ȥ�����" size="4" maxlength="4">��
												<input type="text" name="marridate[]" value="<?php echo $TPL_VAR["marridate"][ 1]?>" <?php echo $GLOBALS["required"]["marridate"]?> label="��ȥ�����" size="2" maxlength="2">��
												<input type="text" name="marridate[]" value="<?php echo $TPL_VAR["marridate"][ 2]?>" <?php echo $GLOBALS["required"]["marridate"]?> label="��ȥ�����" size="2" maxlength="2">��
											</td>
										</tr>
										<tr><td colspan="2" height="1" bgcolor="#efefef" style="padding:0px;"></td></tr>
<?php }?>
<?php if($GLOBALS["checked"]["useField"]["email"]){?>
										<tr>
											<td class="memberCols1"><?php if($GLOBALS["required"]["email"]){?><font color="#ff6000">��</font> <?php }?>�̸���</td>
											<td class="memberCols2">
												<input type="text" name="email" value="<?php echo $TPL_VAR["email"]?>" size="30" <?php echo $GLOBALS["required"]["email"]?> option="regEmail" label="�̸���">
<?php if(!$GLOBALS["sess"]){?>
												<input type="hidden" name="chk_email" <?php echo $GLOBALS["required"]["email"]?> label="�̸����ߺ�üũ">
<?php }?>
												<a href="javascript:void(0)" onClick="chkEmail()"><img src="/shop/data/skin/loosfly/img/common/btn_mailcheck.gif" border="0" align="absmiddle"></a>
<?php if($GLOBALS["checked"]["useField"]["mailling"]){?>
												<span class="noline" style="padding-left:10px"><input type=checkbox name=mailling <?php echo $GLOBALS["checked"]["mailling"]?>><span style="font-size:8pt;color:#007FC8" >�������ϼ���</span></span>
<?php }?>
											</td>
										</tr>
										<tr><td colspan="2" height="1" bgcolor="#efefef" style="padding:0px;"></td></tr>
<?php }?>
<?php if($GLOBALS["checked"]["useField"]["address"]){?>
										<tr>
											<td class="memberCols1"><?php if($GLOBALS["required"]["address"]){?><font color="#ff6000">��</font> <?php }?>�ּ�</td>
											<td class="memberCols2">
												<table>
												<tr>
													<td>
														<input type=text name=zipcode[] id="zipcode0" size=3 class=line readonly value="<?php echo $TPL_VAR["zipcode"][ 0]?>" <?php echo $GLOBALS["required"]["address"]?> label="������ȣ"> -
														<input type=text name=zipcode[] id="zipcode1" size=3 class=line readonly value="<?php echo $TPL_VAR["zipcode"][ 1]?>" <?php echo $GLOBALS["required"]["address"]?> label="������ȣ">
														<a href="javascript:popup('../proc/popup_address.php',500,432)"><img src="/shop/data/skin/loosfly/img/common/btn_zipcode.gif" border=0 align=absmiddle></a>
													</td>
												</tr>
												<tr>
													<td>
														<input type=text name=address id="address" value="<?php echo $TPL_VAR["address"]?>" readonlY size=30 <?php echo $GLOBALS["required"]["address"]?> label="�ּ�">
														<input type=text name=address_sub id="address_sub" value="<?php echo $TPL_VAR["address_sub"]?>" size=30 onkeyup="SameAddressSub(this)" oninput="SameAddressSub(this)" label="�����ּ�"><br />
														<input type="hidden" name="road_address" id="road_address" value="<?php echo $TPL_VAR["road_address"]?>">
														<div style="padding:5px 5px 0 1px;font:12px dotum;color:#999;float:left;" id="div_road_address"><?php echo $TPL_VAR["road_address"]?></div>
														<div style="padding:5px 0 0 1px;font:12px dotum;color:#999;" id="div_road_address_sub"><?php if($TPL_VAR["road_address"]){?><?php echo $TPL_VAR["address_sub"]?><?php }?></div>
													</td>
												</tr>
												</table>
											</td>
										</tr>
										<tr><td colspan="2" height="1" bgcolor="#efefef" style="padding:0px;"></td></tr>
<?php }?>
<?php if($GLOBALS["checked"]["useField"]["mobile"]){?>
										<tr>
											<td class="memberCols1"><?php if($GLOBALS["required"]["mobile"]){?><font color="#ff6000">��</font> <?php }?>�ڵ���</td>
											<td class="memberCols2">
												<input type="text" name="mobile[]" value="<?php echo $TPL_VAR["mobile"][ 0]?>" size="4" maxlength="4" <?php echo $GLOBALS["required"]["mobile"]?> option="regNum" label="�ڵ���"> -
												<input type="text" name="mobile[]" value="<?php echo $TPL_VAR["mobile"][ 1]?>" size="4" maxlength="4" <?php echo $GLOBALS["required"]["mobile"]?> option="regNum" label="�ڵ���"> -
												<input type="text" name="mobile[]" value="<?php echo $TPL_VAR["mobile"][ 2]?>" size="4" maxlength="4" <?php echo $GLOBALS["required"]["mobile"]?> option="regNum" label="�ڵ���">
<?php if($GLOBALS["checked"]["useField"]["sms"]){?>
												<span class="noline" style="padding-left:10px"><input type="checkbox" name="sms" <?php echo $GLOBALS["checked"]["sms"]?>><span style="font-size:8pt;color:#007FC8" >���ڼ��񽺼���</span></span>
<?php }?>
											</td>
										</tr>
										<tr><td colspan="2" height="1" bgcolor="#efefef" style="padding:0px;"></td></tr>
<?php }?>
<?php if($GLOBALS["checked"]["useField"]["phone"]){?>
										<tr>
											<td class="memberCols1"><?php if($GLOBALS["required"]["phone"]){?><font color="#ff6000">��</font> <?php }?>��ȭ��ȣ</td>
											<td class="memberCols2">
												<input type="text" name="phone[]" value="<?php echo $TPL_VAR["phone"][ 0]?>" size="4" maxlength="4" <?php echo $GLOBALS["required"]["phone"]?> option="regNum" label="��ȭ��ȣ"> -
												<input type="text" name="phone[]" value="<?php echo $TPL_VAR["phone"][ 1]?>" size="4" maxlength="4" <?php echo $GLOBALS["required"]["phone"]?> option="regNum" label="��ȭ��ȣ"> -
												<input type="text" name="phone[]" value="<?php echo $TPL_VAR["phone"][ 2]?>" size="4" maxlength="4" <?php echo $GLOBALS["required"]["phone"]?> option="regNum" label="��ȭ��ȣ">
											</td>
										</tr>
										<tr><td colspan="2" height="1" bgcolor="#efefef" style="padding:0px;"></td></tr>
<?php }?>
<?php if($GLOBALS["checked"]["useField"]["fax"]){?>
										<tr>
											<td class="memberCols1"><?php if($GLOBALS["required"]["fax"]){?><font color="#ff6000">��</font> <?php }?>�ѽ�</td>
											<td class="memberCols2">
												<input type="text" name="fax[]" value="<?php echo $TPL_VAR["fax"][ 0]?>" size="4" maxlength="4" <?php echo $GLOBALS["required"]["fax"]?> option="regNum" label="�ѽ�"> -
												<input type="text" name="fax[]" value="<?php echo $TPL_VAR["fax"][ 1]?>" size="4" maxlength="4" <?php echo $GLOBALS["required"]["fax"]?> option="regNum" label="�ѽ�"> -
												<input type="text" name="fax[]" value="<?php echo $TPL_VAR["fax"][ 2]?>" size="4" maxlength="4" <?php echo $GLOBALS["required"]["fax"]?> option="regNum" label="�ѽ�">
											</td>
										</tr>
										<tr><td colspan="2" height="1" bgcolor="#efefef" style="padding:0px;"></td></tr>
<?php }?>
<?php if($GLOBALS["checked"]["useField"]["company"]){?>
										<tr>
											<td class="memberCols1"><?php if($GLOBALS["required"]["company"]){?><font color="#ff6000">��</font> <?php }?>ȸ��</td>
											<td class="memberCols2">
												<input type="text" name="company" <?php echo $GLOBALS["required"]["company"]?> value="<?php echo $TPL_VAR["company"]?>" style="width:300px">
											</td>
										</tr>
										<tr><td colspan="2" height="1" bgcolor="#efefef" style="padding:0px;"></td></tr>
<?php }?>
<?php if($GLOBALS["checked"]["useField"]["service"]){?>
										<tr>
											<td class="memberCols1"><?php if($GLOBALS["required"]["service"]){?><font color="#ff6000">��</font> <?php }?>����</td>
											<td class="memberCols2"><input type="text" name="service" <?php echo $GLOBALS["required"]["service"]?> value="<?php echo $TPL_VAR["service"]?>"></td>
										</tr>
										<tr><td colspan="2" height="1" bgcolor="#efefef" style="padding:0px;"></td></tr>
<?php }?>
<?php if($GLOBALS["checked"]["useField"]["item"]){?>
										<tr>
											<td class="memberCols1"><?php if($GLOBALS["required"]["item"]){?><font color="#ff6000">��</font> <?php }?>����</td>
											<td class="memberCols2"><input type="text" name="item" <?php echo $GLOBALS["required"]["item"]?> value="<?php echo $TPL_VAR["item"]?>"></td>
										</tr>
										<tr><td colspan="2" height="1" bgcolor="#efefef" style="padding:0px;"></td></tr>
<?php }?>
<?php if($GLOBALS["checked"]["useField"]["busino"]){?>
										<tr>
											<td class="memberCols1"><?php if($GLOBALS["required"]["busino"]){?><font color="#ff6000">��</font> <?php }?>����ڹ�ȣ</td>
											<td class="memberCols2">
												<input type="text" name="busino" <?php echo $GLOBALS["required"]["busino"]?> value="<?php echo $TPL_VAR["busino"]?>" style="width:300px">
											</td>
										</tr>
										<tr><td colspan="2" height="1" bgcolor="#efefef" style="padding:0px;"></td></tr>
<?php }?>
<?php if($GLOBALS["checked"]["useField"]["job"]){?>
										<tr>
											<td class="memberCols1"><?php if($GLOBALS["required"]["job"]){?><font color="#ff6000">��</font> <?php }?>����</td>
											<td class="memberCols2">
												<select name="job" class="select">
													<option value="">==�����ϼ���==
<?php if((is_array($TPL_R1=codeitem('job'))&&!empty($TPL_R1)) || (is_object($TPL_R1) && in_array("Countable", class_implements($TPL_R1)) && $TPL_R1->count() > 0)) {foreach($TPL_R1 as $TPL_K1=>$TPL_V1){?>
													<option value="<?php echo $TPL_K1?>" <?php echo $GLOBALS["selected"]["job"][$TPL_K1]?>><?php echo $TPL_V1?>

<?php }}?>
												</select>
											</td>
										</tr>
										<tr><td colspan="2" height="1" bgcolor="#efefef" style="padding:0px;"></td></tr>
<?php }?>
<?php if($GLOBALS["checked"]["useField"]["interest"]){?>
										<tr>
											<td class="memberCols1"><?php if($GLOBALS["required"]["interest"]){?><font color="#ff6000">��</font> <?php }?>���ɺо�</td>
											<td class="memberCols2">
												<table><tr>
<?php if((is_array($TPL_R1=codeitem('like'))&&!empty($TPL_R1)) || (is_object($TPL_R1) && in_array("Countable", class_implements($TPL_R1)) && $TPL_R1->count() > 0)) {$TPL_I1=-1;foreach($TPL_R1 as $TPL_K1=>$TPL_V1){$TPL_I1++;?>
												<td class="noline"><input type="checkbox" name="interest[]" value="<?php echo pow( 2,$TPL_K1+ 0)?>" <?php if($TPL_VAR["interest"]&pow( 2,$TPL_K1+ 0)){?>checked<?php }?>><?php echo $TPL_V1?></td>
<?php if($TPL_I1% 4== 3){?></tr><tr><?php }?>
<?php }}?>
												</tr></table>
											</td>
										</tr>
										<tr><td colspan="2" height="1" bgcolor="#efefef" style="padding:0px;"></td></tr>
<?php }?>
<?php if($GLOBALS["checked"]["useField"]["ex1"]){?>
										<tr>
											<td class="memberCols1"><?php if($GLOBALS["required"]["ex1"]){?><font color="#ff6000">��</font> <?php }?><?php echo $GLOBALS["joinset"]["ex1"]?></td>
											<td class="memberCols2"><input type="text" name="ex1" <?php echo $GLOBALS["required"]["ex1"]?> value="<?php echo $TPL_VAR["ex1"]?>" style="width:300px"></td>
										</tr>
										<tr><td colspan="2" height="1" bgcolor="#efefef" style="padding:0px;"></td></tr>
<?php }?>
<?php if($GLOBALS["checked"]["useField"]["ex2"]){?>
										<tr>
											<td class="memberCols1"><?php if($GLOBALS["required"]["ex2"]){?><font color="#ff6000">��</font> <?php }?><?php echo $GLOBALS["joinset"]["ex2"]?></td>
											<td class="memberCols2"><input type="text" name="ex2" <?php echo $GLOBALS["required"]["ex2"]?> value="<?php echo $TPL_VAR["ex2"]?>" style="width:300px"></td>
										</tr>
										<tr><td colspan="2" height="1" bgcolor="#efefef" style="padding:0px;"></td></tr>
<?php }?>
<?php if($GLOBALS["checked"]["useField"]["ex3"]){?>
										<tr>
											<td class="memberCols1"><?php if($GLOBALS["required"]["ex3"]){?><font color="#ff6000">��</font> <?php }?><?php echo $GLOBALS["joinset"]["ex3"]?></td>
											<td class="memberCols2"><input type="text" name="ex3" <?php echo $GLOBALS["required"]["ex3"]?> value="<?php echo $TPL_VAR["ex3"]?>" style="width:300px"></td>
										</tr>
										<tr><td colspan="2" height="1" bgcolor="#efefef" style="padding:0px;"></td></tr>
<?php }?>
<?php if($GLOBALS["checked"]["useField"]["ex4"]){?>
										<tr>
											<td class="memberCols1"><?php if($GLOBALS["required"]["ex4"]){?><font color="#ff6000">��</font> <?php }?><?php echo $GLOBALS["joinset"]["ex4"]?></td>
											<td class="memberCols2"><input type="text" name="ex4" <?php echo $GLOBALS["required"]["ex4"]?> value="<?php echo $TPL_VAR["ex4"]?>" style="width:300px"></td>
										</tr>
										<tr><td colspan="2" height="1" bgcolor="#efefef" style="padding:0px;"></td></tr>
<?php }?>
<?php if($GLOBALS["checked"]["useField"]["ex5"]){?>
										<tr>
											<td class="memberCols1"><?php if($GLOBALS["required"]["ex5"]){?><font color="#ff6000">��</font> <?php }?><?php echo $GLOBALS["joinset"]["ex5"]?></td>
											<td class="memberCols2"><input type="text" name="ex5" <?php echo $GLOBALS["required"]["ex5"]?> value="<?php echo $TPL_VAR["ex5"]?>" style="width:300px"></td>
										</tr>
										<tr><td colspan="2" height="1" bgcolor="#efefef" style="padding:0px;"></td></tr>
<?php }?>
<?php if($GLOBALS["checked"]["useField"]["ex6"]){?>
										<tr>
											<td class="memberCols1"><?php if($GLOBALS["required"]["ex6"]){?><font color="#ff6000">��</font> <?php }?><?php echo $GLOBALS["joinset"]["ex6"]?></td>
											<td class="memberCols2"><input type="text" name="ex6" <?php echo $GLOBALS["required"]["ex6"]?> value="<?php echo $TPL_VAR["ex6"]?>" style="width:300px"></td>
										</tr>
										<tr><td colspan="2" height="1" bgcolor="#efefef" style="padding:0px;"></td></tr>
<?php }?>
<?php if($GLOBALS["checked"]["useField"]["recommid"]){?>
										<tr>
											<td class="memberCols1"><?php if($GLOBALS["required"]["recommid"]){?><font color="#ff6000">��</font> <?php }?>��õ�ξ��̵�</td>
											<td class="memberCols2">
<?php if($GLOBALS["sess"]){?>
												<input type="hidden" name="recommid" value="<?php echo $TPL_VAR["recommid"]?>"><?php echo $TPL_VAR["recommid"]?>

<?php }else{?>
												<input type="text" name="recommid" value="<?php echo $TPL_VAR["recommid"]?>" <?php echo $GLOBALS["required"]["recommid"]?> label="��õ�ξ��̵�">
<?php }?>
											</td>
										</tr>
										<tr><td colspan="2" height="1" bgcolor="#efefef" style="padding:0px;"></td></tr>
<?php }?>
<?php if($GLOBALS["checked"]["useField"]["interest"]){?>
										<tr>
											<td class="memberCols1"><?php if($GLOBALS["required"]["interest"]){?><font color="#ff6000">��</font> <?php }?>���ɺз�</td>
											<td class="memberCols2">
												<select name="interest_category" class="select">
													<option value="">==�����ϼ���==
<?php if($TPL_ts_category_all_1){foreach($TPL_VAR["ts_category_all"] as $TPL_V1){?>
													<option value="<?php echo $TPL_V1["category"]?>" <?php echo $GLOBALS["selected"]["interest"][$TPL_V1["category"]]?>><?php echo $TPL_V1["catnm"]?>

<?php }}?>
												</select>
											</td>
										</tr>
										<tr><td colspan="2" height="1" bgcolor="#efefef" style="padding:0px;"></td></tr>
<?php }?>
<?php if($GLOBALS["checked"]["useField"]["memo"]){?>
										<tr>
											<td class="memberCols1"><?php if($GLOBALS["required"]["memo"]){?><font color="#ff6000">��</font> <?php }?>����� ����</td>
											<td class="memberCols2"><textarea name="memo" <?php echo $GLOBALS["required"]["memo"]?> style="width:100%;height:80"><?php echo $TPL_VAR["memo"]?></textarea></td>
										</tr>
<?php }?>
<?php if($TPL_VAR["linked_naverCheckout"]=="y"){?>
										<tr><td colspan="2" height="1" bgcolor="#efefef" style="padding:0px;"></td></tr>
										<tr>
											<td class="memberCols1">��������<br />�������� öȸ</td>
											<td class="memberCols2" >
												<div style="padding:6px 0px 5px 4px; font-size:11px;">
													���̹� üũ�ƿ� "���θ� ȸ�� ����" ���� �̿��� ���� �������� �������Ǹ� öȸ�Ͻðڽ��ϱ�?<br />
													�������� �������� öȸ�� �Ͻô� ��� ���̹� üũ�ƿ� "���θ� ȸ�� ����" ���� �̿��<br />
													"���θ� ȸ�� Ȯ��"�� �ٽ� �ϼž� �մϴ�.
												</div>
												<div style="padding-left:4px;" class="noline">
													<input type="radio" name="ncCancelAgreement" value="y" />��
													<input type="radio" name="ncCancelAgreement" value="n" checked />�ƴϿ�
												</div>
											</td>
										</tr>
<?php }?>
										</table>
									</td>
								</tr>
								</table>
							</td>
						</tr>
						</table>
					</div>
<?php if(!$GLOBALS["sess"]){?>
					<table width=100% cellpadding=0 cellspacing=0 border=0>
					<tr>
						<td id=avoidDbl align=center height=100>
							<div style="width:100%" class="noline"><input type="image" src="/shop/data/skin/loosfly/img/common/btn_join.gif">
							<img src="/shop/data/skin/loosfly/img/common/btn_back.gif" border="0" onClick="history.back()" style="cursor:pointer;"></div>
						</td>
					</tr>
					</table>
<?php }else{?>
					<table width=100% cellpadding=0 cellspacing=0 border=0>
					<tr>
						<td id=avoidDbl align=center height=100>
							<div style="width:100%" class="noline"><input type="image" src="/shop/data/skin/loosfly/img/common/btn_modify_info.gif">
							<img src="/shop/data/skin/loosfly/img/common/btn_back.gif" border="0" onClick="history.back()" style="cursor:pointer;"></div>
						</td>
					</tr>
					</table>
<?php }?>
				</form>
				<iframe id="ifrmRnCheck" name="ifrmRnCheck" style="width:500px;height:500px;display:none;"></iframe>

				<script>
				function chkId() {
					var form = document.frmMember;
					if (!chkText(form.m_id,form.m_id.value,"���̵� �Է����ּ���")) return;
					if (!chkPatten(form.m_id,form.m_id.getAttribute('option'),"���̵�� 4�� �̻� 16�� ������ ������,���� ���ո� �����մϴ�")) return;
					ifrmHidden.location.href = "indb.php?mode=chkId&m_id=" + form.m_id.value;
				}
				
				function chkEmail() {
					var form = document.frmMember;
					if (!chkText(form.email,form.email.value,"�̸����� �Է����ּ���")) return;
					if (!chkPatten(form.email,form.email.getAttribute('option'),"�������� �̸��� �ּҸ� �Է����ּ���")) return;
					ifrmHidden.location.href = "indb.php?mode=chkEmail&email=" + form.email.value + "&m_id=" + form.m_id.value;
				}
				
				function chkNickname() {
					var form = document.frmMember;
					if (!chkText(form.nickname,form.nickname.value,"�г����� �Է����ּ���")) return;
					ifrmHidden.location.href = "indb.php?mode=chkNickname&nickname=" + form.nickname.value + "&m_id=" + form.m_id.value;
				}
				
				function chkBirth(obj) {
					var birth = document.getElementsByName(obj.name)[0].value;
					var di = document.getElementsByName(obj.name)[1].value;
					var objBirth = document.getElementsByName('birth[]');
					
					if(di.substring(0,1) == 1 || di.substring(0,1) == 2) var dy="19";
					else var dy="20";
					
					obj.form.birth_year.value = (birth) ? dy + birth.substring(0,2) : "";
					objBirth[0].value = birth.substring(2,4);
					objBirth[1].value = birth.substring(4,6);
				}
				
				function chkSex(obj) {
					var resno = obj.value;
					if (resno) obj.form.sex[1-resno.substring(0,1)%2].checked = true;
				}
				
				function openPasswordField() {
					if(navigator.appName.indexOf("Microsoft") > -1) {
						_ID('pwLayer01').style.display='block';
						_ID('pwLayer02').style.display='block';
					}
					else {
						_ID('pwLayer01').style.display='table-row';
						_ID('pwLayer02').style.display='table-row';
					}
				}
				
				function checkPassword(el) {
					if(el.value) {
						var param = {
							form : document.frmMember,
							fields : ['m_id', 'birth_year', 'phone[]', 'birth[]', 'mobile[]', 'email']
						}
				
						nsGodo_PasswordStrength.appendBlacklist(param);
						nsGodo_PasswordStrength.appendBlacklist(param);
				
						var result = nsGodo_PasswordStrength.check( el );
				
						_ID('el-password-strength-indicator-msg').innerText = result.msg;
						_ID('el-password-strength-indicator-level').className = 'lv'+result.level;
						_ID('el-password-strength-indicator-level').innerText = result.levelText;
						_ID('el-password-strength-indicator').style.display = 'block';
					}
					else {
						emptyPwState();
					}
				}
				
				function emptyPwState() {
					_ID('el-password-strength-indicator').style.display = "none";
				}
				
				function chkForm2(f) {
<?php if($GLOBALS["mode"]=="modMember"){?>
					if(_ID('pwLayer01').style.display != "none") {
						if(!_ID('originalPassword').value) {
							alert("���� ��й�ȣ�� �Է��� �ּ���.");
							_ID('originalPassword').focus();
							return false;
						}
						if(!_ID('newPassword').value) {
							alert("�� ��й�ȣ�� �Է��� �ּ���.");
							_ID('newPassword').focus();
							return false;
						}
						if(!_ID('confirmPassword').value) {
							alert("�� ��й�ȣ Ȯ���� �Է��� �ּ���.");
							_ID('confirmPassword').focus();
							return false;
						}
						if(_ID('newPassword').value != _ID('confirmPassword').value) {
							alert("�� ��й�ȣ�� �����ȣ Ȯ���� ��ġ���� �ʽ��ϴ�.");
							_ID('confirmPassword').focus();
							return false;
						}
					}
<?php }?>
					return chkForm(f);
				}
				
				function goIDCheckIpin() {
<?php if($GLOBALS["ipin"]['nice_useyn']=='y'){?>
					var popupWindow = window.open( "", "popupCertKey", "width=450, height=550, top=100, left=100, fullscreen=no, menubar=no, status=no, toolbar=no, titlebar=yes, location=no, scrollbar=no" );
					ifrmRnCheck.location.href="<?php echo url("member/ipin/IPINMain.php?")?>&callType=applyipin";
<?php }elseif($GLOBALS["ipin"]['useyn']=='y'){?>
					var popupWindow = window.open( "", "popupCertKey", "top=100, left=200, status=0, width=417, height=490" );
					ifrmRnCheck.location.href="<?php echo url("member/ipin/IPINCheckRequest.php?")?>&callType=applyipin";
<?php }?>
					return;
				}
				</script>