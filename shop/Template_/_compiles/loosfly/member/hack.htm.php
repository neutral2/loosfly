<?php /* Template_ 2.2.7 2013/05/16 18:43:19 /www/loosfly_godo_co_kr/shop/data/skin/loosfly/member/hack.htm 000004992 */ ?>
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
				<img src="/shop/data/skin/loosfly/img/jimmy/titles/m_withdrawal_title_01.gif" border="0">			
			</div>
			<div style="height:20px;"></div>
			<div class="divindiv"><!-- Start indiv -->
				<form method=post action="" onsubmit="return chk_hackfm( this );" id=form>
					<input type="hidden" name="act" value="Y">
					<div style="border:1px solid #DEDEDE;" class="hundred">
						<table width=100% cellpadding=0 cellspacing=0 border=0>
						<tr>
							<td style="border:5px solid #F3F3F3;">
								<table width="100%" border="0" cellspacing="0" cellpadding="13">
								<tr>
									<td width=150 valign=top bgcolor="#F3F3F3" align=right><img src="/shop/data/skin/loosfly/img/common/memberout_01.gif"></td>
									<td>
										고객님께서 회원 탈퇴를 원하신다니 저희 쇼핑몰의 서비스가 많이 부족하고 미흡했나 봅니다.<br>
										불편하셨던 점이나 불만사항을 알려주시면 적극 반영해서 고객님의 불편함을 해결해 드리도록 노력하겠습니다.<br>
										아울러 회원 탈퇴시의 아래 사항을 숙지하시기 바랍니다.<br><br>
										1. 회원 탈퇴 시 고객님의 정보는 상품 반품 및 A/S를 위해 전자상거래 등에서의 소비자 보호에 관한 법률에 의거한 고객정보 보호정책에따라 관리 됩니다.<br>
										2. 탈퇴 시 고객님께서 보유하셨던 적립금은 삭제 됩니다.
									</td>
								</tr>
								</table>
							</td>
						</tr>
						</table>
					</div>
					<div style="height:10; font-size:0"></div>
					<div style="border:1px solid #DEDEDE;" class="hundred">
						<table width=100% cellpadding=0 cellspacing=0 border=0>
						<tr>
							<td style="border:5px solid #F3F3F3;">
								<table width="100%" border="0" cellspacing="0" cellpadding="13">
								<tr>
									<td width=150 valign=top bgcolor="#F3F3F3" align=right><img src="/shop/data/skin/loosfly/img/common/memberout_02.gif"></td>
									<td>
										<div><img src="/shop/data/skin/loosfly/img/common/icon_arrow.gif" align=absmiddle><strong>비밀번호가 어떻게 되세요?</strong> <input type="password" name="password" size="20"></div>
										<div style="clear:both;margin-top:10px;"><img src="/shop/data/skin/loosfly/img/common/icon_arrow.gif" align=absmiddle><strong>무엇이 불편하셨나요?</strong></div>
										<div style="float:left;padding-right:10px;" class=noline>
<?php if(is_array($TPL_R1=codeitem('hack'))&&!empty($TPL_R1)){$TPL_S1=count($TPL_R1);$TPL_I1=-1;foreach($TPL_R1 as $TPL_K1=>$TPL_V1){$TPL_I1++;?>
<?php if($TPL_I1%ceil($TPL_S1/ 2)== 0&&$TPL_I1!= 0){?>
										</div><div style="float:left;padding-right:10px;" class=noline>
<?php }?>
										<div><input type="checkbox" name="outComplain[]" value="<?php echo $TPL_K1?>">&nbsp;<?php echo $TPL_V1?></div>
<?php }}?>
										</div>
										<div style="clear:both;margin-top:10px;"><img src="/shop/data/skin/loosfly/img/common/icon_arrow.gif" align=absmiddle><strong>고객님의 진심어린 충고 부탁드립니다.</strong></div>
										<div><textarea name="outComplain_text" cols="70" rows="8" class="box"></textarea></div>
									</td>
								</tr>
								</table>
							</td>
						</tr>
						</table>
					</div>
					<div style="width:100%; text-align:center; padding-top:10; padding-bottom:20" class=noline><input type="image" src="/shop/data/skin/loosfly/img/common/btn_memberout.gif" border=0>&nbsp;<a href="javascript:history.back();" onfocus="this.blur();"><img src="/shop/data/skin/loosfly/img/common/btn_cancel2.gif" border="0" alt="취소"></a></div>
				</form>

				<SCRIPT LANGUAGE="JavaScript">
					/*-------------------------------------
						 탈퇴신청 체크
					-------------------------------------*/
					function chk_hackfm( fobj ){
						if ( fobj.password.value == '' ) {
							alert('비밀번호를 입력하여 주십시요.');
							fobj.password.focus();
							return false;
						}

						var outComp = fobj["outComplain[]"].length;
						var cont = fobj.outComplain_text;
						var ckS = 0;

						for ( i = 0; i < outComp; i++ ) {
							if ( fobj["outComplain[]"][i].checked == true ) break;
							else ckS++;
						}

						if ( ckS == outComp ) {
							alert('서비스불편사항을 1개이상 체크하여 주십시요. \n\n 해당사항은 개선사항에 반영되어집니다.');
							return false;
						}

						if ( !confirm ( '회원탈퇴를 하시면 회원님의 모든 데이타( 개인정보, 포인트 등 )가 삭제 되어집니다. \n 그래도 회원을 탈퇴하시겠습니까?' ) ) {
							return false;
						}

						return true;
					}
				</SCRIPT>
			</div><!-- End indiv -->
			<div style="height:30px;"></div>
		</div>

<?php $this->print_("footer",$TPL_SCP,1);?>