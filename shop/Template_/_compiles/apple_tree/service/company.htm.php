<?php /* Template_ 2.2.7 2012/11/14 15:07:40 /www/loosfly_godo_co_kr/shop/data/skin/apple_tree/service/company.htm 000001884 */  $this->include_("dataBanner");?>
<?php $this->print_("header",$TPL_SCP,1);?>


<!-- ����̹��� || ������ġ -->
<TABLE width=100% cellpadding=0 cellspacing=0 border=0>
<tr>
<td><img src="/shop/data/skin/apple_tree/img/common/title_company.gif" border=0></td>
</tr>
<TR>
<td class="path">HOME > <B>ȸ��Ұ�</B></td>
</TR>
</TABLE>


<div class="indiv"><!-- Start indiv -->

<br>

<table width=100% cellSpacing=0 cellPadding=0 border=0>
<tr>
<td><!-- ȸ��Ұ� �ΰ� (��ʰ������� ��������) --><?php if(is_array($TPL_R1=dataBanner( 23))&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?><?php echo $TPL_V1["tag"]?><?php }}?></td>
<td style="padding-left:10">���ͳ� �����Ͻ��� ���� �츮 ��� ���� �߿���
���� �Ű�ü�� �ڸ���ҽ��ϴ�.<br>
���� �ٳⰣ ���� �ѱ�, ���ڻ�ŷ� �ַ�Ǹ��� ����������
����/��Ͽ� �Խ��ϴ�.<br><br>

���� �������Ͻ��� ���ຸ�� ���İ�����
���� �߿��ϰ� �����մϴ�. ��������� �� ū ������ �ǰ���
����մϴ�.<br><br>

���� ġ���� ����ô뿡�� �ռ����� �� �ֵ��� �����ϰ�
���͵帮�� ���� ����� �����ڰ� �� ���Դϴ�.<br>
������ �ƴ� �������� �ַ�� ���߰� ������Ƽ �� ����Ʈ ����
���������� �� �������Ǹ� �����ϰڽ��ϴ�.<br><br>

���� ���� �긮�� ���� �η������� �ʴ� ������ �����
�� ���� ��ӵ帳�ϴ�.<br><br>

���� ���� �������в� �׻� �����ֽ��ϴ�.<br><br>
�Ѻ� �Ѻ� ���Ե�� ���� Ŀ���� ���� �ǰڽ��ϴ�.<br><br>
�����մϴ�
</td>
</tr>
<tr>
<td height=10></td>
</tr>
<tr>
<td align=middle colspan=2><!-- ȸ��൵ (��ʰ������� ��������) --><?php if(is_array($TPL_R1=dataBanner( 22))&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?><?php echo $TPL_V1["tag"]?><?php }}?></td>
</tr>
</table>

</div><!-- End indiv -->

<?php $this->print_("footer",$TPL_SCP,1);?>