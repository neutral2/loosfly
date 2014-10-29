<?

include "../_header.php";

if (!$_GET['returnUrl']) $returnUrl = $_SERVER['HTTP_REFERER'];
else $returnUrl = $_GET['returnUrl'];

### 투데이샵 전용샵 비회원 처리 시작
require "../lib/load.class.php";
// TodayShop class
$todayShop = Core::loader('todayshop');
if ($todayShop->cfg['shopMode'] == 'todayshop') {
	$tpl->assign('guest_disabled', 'y');
}
unset($todayShop);
### 투데이샵 전용샵 비회원 처리 끝

$tpl->print_('tpl');

?>
