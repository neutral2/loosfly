<?php /* Template_ 2.2.7 2013/12/16 18:59:11 /www/loosfly_godo_co_kr/shop/data/skin/loosfly/outline/side/standard.htm 000000715 */ ?>
<?php if($TPL_VAR["todayshop_cfg"]['shopMode']!='todayshop'){?>
<!-- ī�װ� �޴� ���� -->
<!-- ���� ���μҽ��� '��Ÿ/�߰�������(proc) > ī�װ��޴�- menuCategory.htm' �ȿ� �ֽ��ϴ� -->
<!-- ī�װ� �޴� �� -->
<?php }?>

<div id="side_menu_block"></div>

<?php if($TPL_VAR["smartSearch_useyn"]=='y'){?>
<?php $this->print_("smartSearch",$TPL_SCP,1);?>

<?php }?>

<!-- SNS �ǽð����� ����Ʈ : Start-->
<table cellpadding=0 cellspacing=0 border=0 width=100%>
<tr><td align=center><?php echo snsPosts( 1)?></td></tr>
</table>
<!-- SNS �ǽð����� ����Ʈ : End-->