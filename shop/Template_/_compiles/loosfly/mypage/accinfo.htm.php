<?php /* Template_ 2.2.7 2013/12/16 18:59:11 /www/loosfly_godo_co_kr/shop/data/skin/loosfly/mypage/accinfo.htm 000002728 */ ?>
<?php $this->print_("header",$TPL_SCP,1);?>

<?php if($this->tpl_['side_inc']){?>
		<div class="blkLeftMenu">
<?php $this->print_("side_inc",$TPL_SCP,1);?>

		</div>
<?php }?>
		<div id="blkContents">
			<div style="height:7px;"></div>
			<!-- ����̹��� -->
			<div style="height:7px;"></div>
			<div class="divindiv"><!-- Start indiv -->
<?php if($GLOBALS["sess"]){?>
				<table border="0" cellpadding="0" cellspacing="0" style="width:860px;">
				<tr>
					<td>
						<table border="0" cellpadding="0" cellspacing="0" style="width:600px;">
						<tr><td colspan="2" class="myinfo_title">ACCOUNT INFORMATION</td></tr>
						<tr><td class="myinfo_tag">�̸� :</td><td class="myinfo_info"><?php echo $TPL_VAR["name"]?></td></tr>
						<tr><td class="myinfo_tag2">�ּ� :</td><td class="myinfo_info"><?php echo $TPL_VAR["zipcode"][ 0]?>-<?php echo $TPL_VAR["zipcode"][ 1]?></td></tr>
						<tr><td class="myinfo_tag2"> </td><td class="myinfo_info"><?php echo $TPL_VAR["address"]?> <?php echo $TPL_VAR["address_sub"]?></td></tr>
						<tr><td class="myinfo_tag">��ȭ :</td><td class="myinfo_info"><?php echo $TPL_VAR["phone"][ 0]?>-<?php echo $TPL_VAR["phone"][ 1]?>-<?php echo $TPL_VAR["phone"][ 2]?></td></tr>
						<tr><td class="myinfo_tag">�޴��� :</td><td class="myinfo_info"><?php echo $TPL_VAR["mobile"][ 0]?>-<?php echo $TPL_VAR["mobile"][ 1]?>-<?php echo $TPL_VAR["mobile"][ 2]?></td></tr>
						<tr><td class="myinfo_tag">�̸��� :</td><td class="myinfo_info"><?php echo $TPL_VAR["email"]?></td></tr>
						<tr><td class="myinfo_tag">�̸��ϼ��� :</td><td class="myinfo_info"><?php if($GLOBALS["checked"]["mailling"]){?> �� <?php }else{?> �ƴϿ� <?php }?></td></tr>
						<tr><td class="myinfo_tag">SMS���� :</td><td class="myinfo_info"><?php if($GLOBALS["checked"]["sms"]){?> �� <?php }else{?> �ƴϿ� <?php }?></td></tr>
						<tr><td colspan="2" class="myinfo_tag"> </td></tr>
						<tr><td colspan="2" class="myinfo_info"><div class="body_menu"><a href="/shop/member/myinfo.php?&">ȸ������ ���� >></a></div></td></tr>
						</table>
					</td>
					<td valign="top">
						<table border="0" cellpadding="0" cellspacing="0" style="width:250px;">
						<tr><td class="myinfo_title">WISH LIST</td></tr>
						<tr><td><div class="myinfo_info"><a href="/shop/mypage/mypage_wishlist.php?&" class="body_menu">���� ���� ��ǰ��� ���� >></a></div></td></tr>
						</table>
					</td>
				</tr>
				</table>
<?php }else{?>
�α��κ��� �ؾ� �̰� �����ٵ� �̻��ϳ�...?
<?php }?>
			</div><!-- End indiv -->		
		</div>
<?php $this->print_("footer",$TPL_SCP,1);?>