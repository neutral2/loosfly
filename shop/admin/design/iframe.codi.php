<?
if ( $_GET['design_file'] == 'default' || substr( $_GET['design_file'], 0, 8 ) == 'outline/' ) $location = "�����ΰ��� > ��ü���̾ƿ� ������";
else if ( $_GET['design_file'] == 'main/index.htm' ) $location = "�����ΰ��� > ���������� ������";
else $location = "�����ΰ��� > ��Ÿ������ ������";

$scriptLoad='<script src="../design/codi/_codi.js"></script>';
include "../_header.popup.php";

## ����������޾�� ����
if($_GET[design_file] == "service/_private.txt" && !file_exists("../../data/skin/".$cfg['tplSkinWork']."/service/_private.txt")) $_GET[design_file] = "service/private.htm";
?>

<? if ( $_GET['design_file'] == 'default' || $_GET['design_file'] == 'main/index.htm' || substr( $_GET['design_file'], 0, 8 ) == 'outline/' ){ ?>
	<? if ( $_GET['design_file'] == 'default' || substr( $_GET['design_file'], 0, 8 ) == 'outline/' ){ ?>
	<div class="title title_top">��ü���̾ƿ� ����<span>�� ���θ��� ��ü���̾ƿ��� �����մϴ�</span></div>
	<? } else if ( $_GET['design_file'] == 'main/index.htm' ){ ?>
	<div class="title title_top">���������� ������<span>���������� �������� �����մϴ�</span>  <a href="javascript:manual('<?=$guideUrl?>board/view.php?id=design&no=9')"><img src="../img/btn_q.gif" border=0 align=absmiddle hspace=2></a></div>
	<? } ?>
<? } else { ?>
<div class="title title_top">���������� ������<span>�������������� �������� �����մϴ�</span>  <a href="javascript:manual('<?=$guideUrl?>board/view.php?id=design&no=10')"><img src="../img/btn_q.gif" border=0 align=absmiddle hspace=2></a></div>
<? } ?>
<?=$workSkinStr?>
<?
	// ���̾ƿ� ���� �˸� �̹���
	$todayshop = Core::loader('todayshop');
	if ($todayshop->cfg['shopMode'] == "todayshop") {
?>
	<img src="../img/todayshop/bn_ly01.gif" style="margin-top:5px; margin-bottom:10px;" />
<?
	} //
{ // Design Codi ����
	@include_once dirname(__FILE__) . "/codi/main.php";
}
?>

<script>
table_design_load();
setHeight_ifrmCodi();
</script>
