<?
if ( $_GET['design_file'] == 'default' || substr( $_GET['design_file'], 0, 8 ) == 'outline/' ) $location = "디자인관리 > 전체레이아웃 디자인";
else if ( $_GET['design_file'] == 'main/index.htm' ) $location = "디자인관리 > 메인페이지 디자인";
else $location = "디자인관리 > 기타페이지 디자인";

$scriptLoad='<script src="../design/codi/_codi.js"></script>';
include "../_header.popup.php";

## 개인정보취급약관 제어
if($_GET[design_file] == "service/_private.txt" && !file_exists("../../data/skin/".$cfg['tplSkinWork']."/service/_private.txt")) $_GET[design_file] = "service/private.htm";
?>

<? if ( $_GET['design_file'] == 'default' || $_GET['design_file'] == 'main/index.htm' || substr( $_GET['design_file'], 0, 8 ) == 'outline/' ){ ?>
	<? if ( $_GET['design_file'] == 'default' || substr( $_GET['design_file'], 0, 8 ) == 'outline/' ){ ?>
	<div class="title title_top">전체레이아웃 설정<span>내 쇼핑몰의 전체레이아웃을 설정합니다</span></div>
	<? } else if ( $_GET['design_file'] == 'main/index.htm' ){ ?>
	<div class="title title_top">메인페이지 디자인<span>메인페이지 디자인을 수정합니다</span>  <a href="javascript:manual('<?=$guideUrl?>board/view.php?id=design&no=9')"><img src="../img/btn_q.gif" border=0 align=absmiddle hspace=2></a></div>
	<? } ?>
<? } else { ?>
<div class="title title_top">서브페이지 디자인<span>서브페이지들의 디자인을 수정합니다</span>  <a href="javascript:manual('<?=$guideUrl?>board/view.php?id=design&no=10')"><img src="../img/btn_q.gif" border=0 align=absmiddle hspace=2></a></div>
<? } ?>
<?=$workSkinStr?>
<?
	// 레이아웃 형태 알림 이미지
	$todayshop = Core::loader('todayshop');
	if ($todayshop->cfg['shopMode'] == "todayshop") {
?>
	<img src="../img/todayshop/bn_ly01.gif" style="margin-top:5px; margin-bottom:10px;" />
<?
	} //
{ // Design Codi 메인
	@include_once dirname(__FILE__) . "/codi/main.php";
}
?>

<script>
table_design_load();
setHeight_ifrmCodi();
</script>
