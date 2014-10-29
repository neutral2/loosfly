<?
@include "../../conf/partner.php";
$location = "싸이월드 C 공감(법인) > 공감 버튼(법인) 설정";
include "../_header.php";
$clog = "../../conf/clog.cfg.php";
if(file_exists($clog)) require $clog;


?>
<div style="height:20"></div>
<input type="hidden" name="copy" id="copy" value=""/>
<form method="post" action="indb.php" target="ifrmHidden">

<div class="title title_top">싸이월드 법인 C 공감 버튼 사용 설정 <a href="javascript:manual('<?=$guideUrl?>board/view.php?id=marketing&no=17')"><img src="../img/btn_q.gif" border=0 align=absmiddle hspace=2></a></div>
<table border="1" bordercolor="#e1e1e1" style="border-collapse:collapse" width="100%">
<col class="cellC"><col class="cellL">
<tr>
	<td>법인 공감 버튼 사용</td>
	<td class="noline">
	<div style="padding:2 0 0 0">
	<input type="radio" name="useBrandCLog" value="y" <? if($clogCfg['useBrandCLog'] == "y")echo "checked"; ?>/> 사용
	<input type="radio" name="useBrandCLog" value="n" <? if($clogCfg['useBrandCLog'] == "n")echo "checked"; ?>/> 사용 안함
	</div>
	</td>
</tr>
<tr>
	<td>법인 C로그 ID</td>
	<td>
	<div style="padding:2 0 0 0">
	<input type="text" name="useBrandCLogID" style="width:150px" maxlength="20" value="<?=$clogCfg['useBrandCLogID']?>"/> <span>싸이월드에 가입된 법인 C로그 ID를 입력하여 주십시오.</span>
	</div>
	</td>
</tr>

</table>
<div class=button>
<input type="image" src="../img/btn_save.gif">
<a href="javascript:history.back()"><img src="../img/btn_cancel.gif"></a>
</div>
</form>
<div id=MSG02>
<table cellpadding=1 cellspacing=0 border=0 class=small_ex>
<tr><td>법인 C공감 버튼은 싸이월드 법인 회원 가입 후 법인 C로그가 개설되어야만 적용할 수 있습니다.</td></tr>
</table>
</div>
<script>cssRound('MSG02')</script>

</div>
<? include "../_footer.php"; ?>