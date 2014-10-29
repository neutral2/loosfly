<?

include "../_header.php";

### 회원인증여부
if( $sess ){
	msg("고객님은 로그인 중입니다.",$code=-1 );
}

if (!$_GET['returnUrl']) $returnUrl = $_SERVER['HTTP_REFERER'];
else $returnUrl = $_GET['returnUrl'];

if(!$returnUrl) $returnUrl = $mobileRootDir;

$tpl->print_('tpl');

?>