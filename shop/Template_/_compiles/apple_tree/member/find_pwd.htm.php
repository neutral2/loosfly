<?php /* Template_ 2.2.7 2012/11/14 15:07:40 /www/loosfly_godo_co_kr/shop/data/skin/apple_tree/member/find_pwd.htm 000004641 */ ?>
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

</script>

<!-- ����̹��� || ������ġ -->
<TABLE width=100% cellpadding=0 cellspacing=0 border=0>
<tr>
	<td><img src="/shop/data/skin/apple_tree/img/common/title_pwsearch.gif" border=0></td>
</tr>
<TR>
	<td class="path">HOME > �������� > <B>��й�ȣã��</B></td>
</TR>
</TABLE>


<div class="indiv"><!-- Start indiv -->

<form method=post name=fm action="" onsubmit="return chkForm( this );" id=form>
<input type="hidden" name="act" value="Y">
<input type="hidden" name=rncheck value="none">
<input type="hidden" name=dupeinfo value="">

<div><img src="/shop/data/skin/apple_tree/img/common/pw_01.gif" border=0></div>
<div style="border:1px solid #DEDEDE;" class="hundred">
<table width=100% cellpadding=0 cellspacing=0 border=0>
<tr>
	<td style="border:5px solid #F3F3F3;padding:10;">

	<div style="float:left; width:130"><img src="/shop/data/skin/apple_tree/img/common/pw_02.gif" border=0></div>

	<div style="float:right; width:480">
	<table cellpadding=2 cellspacing=0 border=0>
	<tr>
		<td style="text-align:right;padding-right:10;width:80;" class="input_txt">���̵�</td>
		<td><input name="srch_id" type="text" size="29" required label="���̵�" tabindex=1></td>
		<td rowspan=4 class=noline><input type="image" src="/shop/data/skin/apple_tree/img/common/pw_btn.gif" tabindex=6></td>
	</tr>
	<tr>
		<td style="text-align:right;padding-right:10;width:80;" class="input_txt">�̸�</td>
		<td><input name="srch_name" type="text" size="29" required label="�̸�" tabindex=2></td>
	</tr>
<?php if($GLOBALS["checked"]["useField"]["resno"]){?>
	<tr>
		<td style="text-align:right;padding-right:10;width:80;" class="input_txt">�ֹε�Ϲ�ȣ</td>
		<td><input name="srch_num1" type="text" size="11" maxlength=6 required label="�ֹε�Ϲ�ȣ" onkeyup="if (this.value.length==6) this.nextSibling.nextSibling.focus()" onkeydown="onlynumber()" tabindex=3> - <input maxlength=7 name="srch_num2" type="password" size="11" required label="�ֹε�Ϲ�ȣ" onkeydown="onlynumber()" tabindex=4></td>
	</tr>
<?php }?>
<?php if($GLOBALS["checked"]["useField"]["email"]){?>
	<tr>
		<td style="text-align:right;padding-right:10;width:80;" class="input_txt">���� �����ּ�</td>
		<td><input name="srch_mail" type="text" size="29" required label="�����ּ�" tabindex=5></td>
	</tr>
<?php }?>
	</table>
	</div>


	</td>
</tr>
</table>
</div>

<?php if($TPL_VAR["ipinyn"]=='y'||$TPL_VAR["niceipinyn"]=='y'){?>
<div style="border:0px solid #DEDEDE; padding-top:20px;" class="hundred">
<table width=100% cellpadding=0 cellspacing=0 border=0>
<tr>
	<td style="border:5px solid #F3F3F3;padding:10;">
		<div style="float:left; width:130"><img src="/shop/data/skin/apple_tree/img/common/pw_02.gif" border=0></div>

		<div style="float:right; width:480">
		<table cellpadding=2 cellspacing=0 border=0 style="float:left;">
		<tr>
			<td><br>
			<img src="/shop/data/skin/apple_tree/img/ipin/Regist_box_icon.gif"/> <font color='5d5d5d'>ȸ�����Խÿ� ���������� �����ϼ̰ų�, ������ ��ȯ�� �Ͻ� ȸ���Բ�����<br />���������� �����Ͽ� �ּ���.</font>
		</td>
		</tr>
		<tr>
			<td style="text-align:center;"  class=noline><img src="/shop/data/skin/apple_tree/img/ipin/ipin_btn.gif" onclick="goIDCheckIpin();" style="cursor:pointer;">
				<iframe id="ifrmRnCheck" name="ifrmRnCheck" style="width:500px;height:500px;display:none;"></iframe>
			</td>
		</tr>
		</table>
		</div>
	</td>
</tr>
</table>
</div>
<?php }?>

</form>

<div align="center" style="padding-top:15">
<a href="<?php echo url("member/login.php")?>&"><img src="/shop/data/skin/apple_tree/img/common/id_btn_login.gif"></a>&nbsp;
<a href="<?php echo url("member/find_id.php")?>&"><img src="/shop/data/skin/apple_tree/img/common/pw_btn_id.gif"></a>
</div>

</div><!-- End indiv -->

<?php $this->print_("footer",$TPL_SCP,1);?>