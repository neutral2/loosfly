<?php /* Template_ 2.2.7 2013/05/16 18:43:19 /www/loosfly_godo_co_kr/shop/data/skin/loosfly/member/hack.htm 000004992 */ ?>
<?php $this->print_("header",$TPL_SCP,1);?>

<?php if($this->tpl_['side_inc']){?>
		<div class="blkLeftMenu">
<?php $this->print_("side_inc",$TPL_SCP,1);?>

		</div>
<?php }?>
		<div id="blkContents">
			<div style="height:7px;"></div>
			<!-- ����̹��� -->
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
										���Բ��� ȸ�� Ż�� ���ϽŴٴ� ���� ���θ��� ���񽺰� ���� �����ϰ� �����߳� ���ϴ�.<br>
										�����ϼ̴� ���̳� �Ҹ������� �˷��ֽø� ���� �ݿ��ؼ� ������ �������� �ذ��� �帮���� ����ϰڽ��ϴ�.<br>
										�ƿ﷯ ȸ�� Ż����� �Ʒ� ������ �����Ͻñ� �ٶ��ϴ�.<br><br>
										1. ȸ�� Ż�� �� ������ ������ ��ǰ ��ǰ �� A/S�� ���� ���ڻ�ŷ� ����� �Һ��� ��ȣ�� ���� ������ �ǰ��� ������ ��ȣ��å������ ���� �˴ϴ�.<br>
										2. Ż�� �� ���Բ��� �����ϼ̴� �������� ���� �˴ϴ�.
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
										<div><img src="/shop/data/skin/loosfly/img/common/icon_arrow.gif" align=absmiddle><strong>��й�ȣ�� ��� �Ǽ���?</strong> <input type="password" name="password" size="20"></div>
										<div style="clear:both;margin-top:10px;"><img src="/shop/data/skin/loosfly/img/common/icon_arrow.gif" align=absmiddle><strong>������ �����ϼ̳���?</strong></div>
										<div style="float:left;padding-right:10px;" class=noline>
<?php if(is_array($TPL_R1=codeitem('hack'))&&!empty($TPL_R1)){$TPL_S1=count($TPL_R1);$TPL_I1=-1;foreach($TPL_R1 as $TPL_K1=>$TPL_V1){$TPL_I1++;?>
<?php if($TPL_I1%ceil($TPL_S1/ 2)== 0&&$TPL_I1!= 0){?>
										</div><div style="float:left;padding-right:10px;" class=noline>
<?php }?>
										<div><input type="checkbox" name="outComplain[]" value="<?php echo $TPL_K1?>">&nbsp;<?php echo $TPL_V1?></div>
<?php }}?>
										</div>
										<div style="clear:both;margin-top:10px;"><img src="/shop/data/skin/loosfly/img/common/icon_arrow.gif" align=absmiddle><strong>������ ���ɾ ��� ��Ź�帳�ϴ�.</strong></div>
										<div><textarea name="outComplain_text" cols="70" rows="8" class="box"></textarea></div>
									</td>
								</tr>
								</table>
							</td>
						</tr>
						</table>
					</div>
					<div style="width:100%; text-align:center; padding-top:10; padding-bottom:20" class=noline><input type="image" src="/shop/data/skin/loosfly/img/common/btn_memberout.gif" border=0>&nbsp;<a href="javascript:history.back();" onfocus="this.blur();"><img src="/shop/data/skin/loosfly/img/common/btn_cancel2.gif" border="0" alt="���"></a></div>
				</form>

				<SCRIPT LANGUAGE="JavaScript">
					/*-------------------------------------
						 Ż���û üũ
					-------------------------------------*/
					function chk_hackfm( fobj ){
						if ( fobj.password.value == '' ) {
							alert('��й�ȣ�� �Է��Ͽ� �ֽʽÿ�.');
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
							alert('���񽺺�������� 1���̻� üũ�Ͽ� �ֽʽÿ�. \n\n �ش������ �������׿� �ݿ��Ǿ����ϴ�.');
							return false;
						}

						if ( !confirm ( 'ȸ��Ż�� �Ͻø� ȸ������ ��� ����Ÿ( ��������, ����Ʈ �� )�� ���� �Ǿ����ϴ�. \n �׷��� ȸ���� Ż���Ͻðڽ��ϱ�?' ) ) {
							return false;
						}

						return true;
					}
				</SCRIPT>
			</div><!-- End indiv -->
			<div style="height:30px;"></div>
		</div>

<?php $this->print_("footer",$TPL_SCP,1);?>