<?php /* Template_ 2.2.7 2012/11/14 15:07:40 /www/loosfly_godo_co_kr/shop/data/skin/apple_tree/member/agreement.htm 000008774 */ ?>
<?php $this->print_("header",$TPL_SCP,1);?>


<style>
.scroll	{
scrollbar-face-color: #FFFFFF;
scrollbar-shadow-color: #AFAFAF;
scrollbar-highlight-color: #AFAFAF;
scrollbar-3dlight-color: #FFFFFF;
scrollbar-darkshadow-color: #FFFFFF;
scrollbar-track-color: #F7F7F7;
scrollbar-arrow-color: #838383;
}
#boxScroll{width:96%; height:130px; overflow: auto; BACKGROUND: #ffffff; COLOR: #585858; font:9pt ����;border:1px #dddddd solid; overflow-x:hidden;text-align:left; }
</style>

<script language="javascript">

var CertMember = '<?php echo $TPL_VAR["realnameyn"]?>'+'<?php echo $TPL_VAR["ipinStatus"]?>';

function selectRnCheckType(val){

	var div_jumin = document.getElementById("div_RnCheck_jumin");
	var div_ipin  = document.getElementById("div_RnCheck_ipin");

	if(val=='jumin'){
		div_jumin.style.display='';
		div_ipin.style.display='none';
	}
	if(val=='ipin'){
		div_jumin.style.display='none';
		div_ipin.style.display='';
	}
}

function checkSubmit() {
	var oForm = document.getElementById("form");

	if (CertMember == "nn" || CertMember == "yn") {		// �Ǹ������� �ְų�, �ƹ��͵� ���� ��
		if (chkForm2(oForm)) 	oForm.submit();
	}
	else if (CertMember == "ny") {						// ������ ������ ���� ��
		goIDCheckIpin();
	}
	else if (CertMember == "yy") {
		var rdo_jumin = document.getElementById("RnCheckType_jumin");
		var rdo_ipin  = document.getElementById("RnCheckType_ipin");

		//if (rdo_jumin != null && rdo_jumin != undefined) alert(rdo_jumin.checked);
		//if (rdo_ipin != null && rdo_ipin != undefined) alert(rdo_ipin.checked);

		if (rdo_jumin.checked) {
			if (chkForm2(oForm)) 	oForm.submit();
		} else {
			goIDCheckIpin();
		}
	}
	else {
		if (chkForm2(oForm)) 	oForm.submit();
	}
}

</script>

<!-- ����̹��� || ������ġ -->
<TABLE width=100% cellpadding=0 cellspacing=0 border=0>
<tr>
	<td><img src="/shop/data/skin/apple_tree/img/common/title_join.gif" border=0></td>
</tr>
<TR>
	<td class="path">HOME > ȸ������ > <B>�̿���</B></td>
</TR>
</TABLE>


<div class="indiv"><!-- Start indiv -->

<form id=form name=frmAgree method=post action="<?php echo url("member/indb.php")?>&" target="ifrmHidden" onSubmit="return chkForm2(this)">
<input type=hidden name=mode value="chkRealName">
<input type=hidden name=rncheck value="none">
<input type=hidden name=nice_nm value="">
<input type=hidden name=pakey value="">
<input type=hidden name=birthday value="">
<input type=hidden name=sex value="">
<input type=hidden name=dupeinfo value="">
<input type=hidden name=foreigner value="">
<input type=hidden name=type>

<!-- ���̹�üũ�ƿ�(ȸ������) -->
<?php echo $TPL_VAR["naverCheckout_oneclickStep"]?>


<!-- �̿��� -->
<div><img src="/shop/data/skin/apple_tree/img/common/join_txt_01.gif" border=0></div>
<div style="background:#F1F1F1; text-align:center; padding:10 10 0 10;">
<textarea style="width:100%; height:190; padding:10; background:#FFFFFF" class=scroll readonly><?php echo $this->define('tpl_include_file_1',"proc/_agreement.txt")?> <?php $this->print_("tpl_include_file_1",$TPL_SCP,1);?></textarea>
<div align=center class=noline style="height:30;margin-top:10px;" >
<input type="radio" name="agree" value="y"> �����մϴ� &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="agree" value="n"> �������� �ʽ��ϴ�
</div>
</div>
<p>

<!-- ����������޹�ħ -->
<div style="padding-left:7"><font color=f7443f><b>����������޹�ħ</b></font></div>
<div style="padding-top:10; background:#F1F1F1;  text-align:center;">
<div align="left" style="height:26;padding:3px 0 0 10px;">
<b>�� ����������ȣ�� ���� �̿��� ���ǻ���</b> (�ڼ��� ������ ��<a href="<?php echo url("service/private.php")?>&">����������޹�ħ</a>���� Ȯ���Ͻñ� �ٶ��ϴ�)
</div>
<div id="boxScroll" class="scroll">
<?php echo $this->define('tpl_include_file_2',"/service/_private1.txt")?> <?php $this->print_("tpl_include_file_2",$TPL_SCP,1);?>

</div>
<div align=center class=noline style="height:30;margin-top:10px;" >
<input type="radio" name="private1" value="y"> �����մϴ� &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="private1" value="n"> �������� �ʽ��ϴ�
</div>
</div>
<p>
<?php if($GLOBALS["cfg"]['private2YN']=='Y'){?>
<div style="padding-top:10; background:#F1F1F1;  text-align:center;">
<div align="left" style="height:26;padding:3px 0 0 10px;">
<b>�� �������� ��3�� ���� ����</b>
</div>
<div id="boxScroll" class="scroll">
<?php echo $this->define('tpl_include_file_3',"/service/_private2.txt")?> <?php $this->print_("tpl_include_file_3",$TPL_SCP,1);?>

</div>
<div align=center class=noline style="height:30;margin-top:10px;" >
<input type="radio" name="private2" value="y" required label="�������� ��3�� ���� ����" msgR="���� ���θ� üũ���ּ���."> �����մϴ� &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="private2" value="n" required label="�������� ��3�� ���� ����" msgR="���� ���θ� üũ���ּ���."> �������� �ʽ��ϴ�
</div>
</div>
<p>
<?php }?>
<?php if($GLOBALS["cfg"]['private3YN']=='Y'){?>
<div style="padding-top:10; background:#F1F1F1;  text-align:center;">
<div align="left" style="height:26;padding:3px 0 0 10px;">
<b>�� ����������� ��Ź ����</b>
</div>
<div id="boxScroll" class="scroll">
<?php echo $this->define('tpl_include_file_4',"/service/_private3.txt")?> <?php $this->print_("tpl_include_file_4",$TPL_SCP,1);?>

</div>
<div align=center class=noline style="height:30;margin-top:10px;" >
<input type="radio" name="private3" value="y" required label="����������� ��Ź ����" msgR="���� ���θ� üũ���ּ���."> �����մϴ� &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="private3" value="n" required label="����������� ��Ź ����" msgR="���� ���θ� üũ���ּ���."> �������� �ʽ��ϴ�
</div>
</div>
<?php }?>
<?php if($TPL_VAR["realnameyn"]=='y'&&($TPL_VAR["ipinyn"]=='y'||$TPL_VAR["niceipinyn"]=='y')){?>
	<table height="35">
	<tr>
		<td class="noline">
		<label for="RnCheckType_jumin" style="width:150px;height:20px;display:inline-block;background:url('/shop/data/skin/apple_tree/img/ipin/Regist_realName_title_1.gif') no-repeat 17px 3px;">
		<input type="radio" name="RnCheckType" value="jumin" id="RnCheckType_jumin" onclick="selectRnCheckType(this.value)" checked style="display:block">
		</label>
		</td>
		<td width="5">&nbsp;</td>
		<td class="noline">
		<label for="RnCheckType_ipin" style="width:150px;height:20px;display:inline-block;background:url('/shop/data/skin/apple_tree/img/ipin/Regist_realName_title_2.gif') no-repeat 17px 3px;">
		<input type="radio" name="RnCheckType" value="ipin" id="RnCheckType_ipin" onclick="selectRnCheckType(this.value)">
		</label>
	</tr>
	</table>
<?php }elseif($TPL_VAR["realnameyn"]=='y'&&($TPL_VAR["ipinyn"]=='n'&&$TPL_VAR["niceipinyn"]=='n')){?>
	<table height="35">
		<tr>
			<td><img src="/shop/data/skin/apple_tree/img/ipin/Regist_realName_title_1.gif" style="width:98px;height:16px;cursor:hand;" /></td>
		</tr>
	</table>
<?php }elseif($TPL_VAR["realnameyn"]=='n'&&($TPL_VAR["ipinyn"]=='y'||$TPL_VAR["niceipinyn"]=='y')){?>
	<table height="35">
		<tr>
			<td><img src="/shop/data/skin/apple_tree/img/ipin/Regist_realName_title_2.gif" style="width:124px;height:16px;cursor:hand;" /></td>
		</tr>
	</table>
<?php }?>

<?php if($TPL_VAR["realnameyn"]=='y'){?>
<?php echo $this->define('tpl_include_file_5',"member/NiceCheck.htm")?> <?php $this->print_("tpl_include_file_5",$TPL_SCP,1);?>

<?php }?>

<?php if($TPL_VAR["ipinyn"]=='y'){?>
<?php echo $this->define('tpl_include_file_6',"member/NiceIpin.htm")?> <?php $this->print_("tpl_include_file_6",$TPL_SCP,1);?>

<?php }?>

<?php if($TPL_VAR["niceipinyn"]=='y'){?>
<?php echo $this->define('tpl_include_file_7',"member/NewNiceIpin.htm")?> <?php $this->print_("tpl_include_file_7",$TPL_SCP,1);?>

<?php }?>

<?php if($TPL_VAR["realnameyn"]=='y'&&($TPL_VAR["ipinyn"]=='y'||$TPL_VAR["niceipinyn"]=='y')){?>
	<script>selectRnCheckType("jumin");</script>
<?php }?>

<!-- �ϴܹ�ư -->
<div align=center style="padding:50px 0 20px 0" class=noline>
<a href="javascript:checkSubmit();"><img src="/shop/data/skin/apple_tree/img/common/btn_join.gif"></a>
<a href="javascript:history.back()"><img src="/shop/data/skin/apple_tree/img/common/btn_back.gif" border=0></a>
</div>

</form>

</div><!-- End indiv -->

<script>
function chkForm2(fm)
{
	if (chkRadioSelect(fm,'agree','y','[ȸ������ �̿���]�� ���Ǹ� �ϼž� ȸ�������� �����մϴ�.') === false) return false;
	if (chkRadioSelect(fm,'private1','y','[����������ȣ�� ���� �̿��� ���ǻ���]�� ���Ǹ� �ϼž� ȸ�������� �����մϴ�.') === false) return false;
	if (typeof(goIDCheck) != "undefined"){
		if (goIDCheck(fm) === false) return false;
	}

	return chkForm(fm);
}
</script>

<?php $this->print_("footer",$TPL_SCP,1);?>