<?php /* Template_ 2.2.7 2013/04/16 10:58:56 /www/loosfly_godo_co_kr/shop/data/skin/loosfly/member/join_ok.htm 000000896 */ ?>
<?php $this->print_("header",$TPL_SCP,1);?>


<!-- 상단이미지 || 현재위치 -->
<TABLE width=100% cellpadding=0 cellspacing=0 border=0>
<tr>
	<td><img src="/shop/data/skin/loosfly/img/common/title_join.gif" border=0></td>
</tr>
<TR>
	<td class="path">HOME > 회원가입 > <B>가입완료</B></td>
</TR>
</TABLE>


<div class="indiv"><!-- Start indiv -->

<!-- 네이버체크아웃(회원연동) -->
<?php echo $TPL_VAR["naverCheckout_oneclickStep"]?>


<TABLE width=100% cellpadding=0 cellspacing=0 border=0>
<tr>
	<td align=center><img src="/shop/data/skin/loosfly/img/common/join_ok.gif" border=0></td>
</tr>
</table>
<!-- <?php echo $TPL_VAR["name"]?>님의 회원가입을 축하드립니다. -->

</div><!-- End indiv -->

<?php $this->print_("footer",$TPL_SCP,1);?>