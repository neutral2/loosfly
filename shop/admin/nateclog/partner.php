<?
@include "../../conf/partner.php";
$location = "���̿��� C ����(����) > ���� ��ư(����) ����";
include "../_header.php";
$clog = "../../conf/clog.cfg.php";
if(file_exists($clog)) require $clog;


?>
<div style="height:20"></div>
<input type="hidden" name="copy" id="copy" value=""/>
<form method="post" action="indb.php" target="ifrmHidden">

<div class="title title_top">���̿��� ���� C ���� ��ư ��� ���� <a href="javascript:manual('<?=$guideUrl?>board/view.php?id=marketing&no=17')"><img src="../img/btn_q.gif" border=0 align=absmiddle hspace=2></a></div>
<table border="1" bordercolor="#e1e1e1" style="border-collapse:collapse" width="100%">
<col class="cellC"><col class="cellL">
<tr>
	<td>���� ���� ��ư ���</td>
	<td class="noline">
	<div style="padding:2 0 0 0">
	<input type="radio" name="useBrandCLog" value="y" <? if($clogCfg['useBrandCLog'] == "y")echo "checked"; ?>/> ���
	<input type="radio" name="useBrandCLog" value="n" <? if($clogCfg['useBrandCLog'] == "n")echo "checked"; ?>/> ��� ����
	</div>
	</td>
</tr>
<tr>
	<td>���� C�α� ID</td>
	<td>
	<div style="padding:2 0 0 0">
	<input type="text" name="useBrandCLogID" style="width:150px" maxlength="20" value="<?=$clogCfg['useBrandCLogID']?>"/> <span>���̿��忡 ���Ե� ���� C�α� ID�� �Է��Ͽ� �ֽʽÿ�.</span>
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
<tr><td>���� C���� ��ư�� ���̿��� ���� ȸ�� ���� �� ���� C�αװ� �����Ǿ�߸� ������ �� �ֽ��ϴ�.</td></tr>
</table>
</div>
<script>cssRound('MSG02')</script>

</div>
<? include "../_footer.php"; ?>