<?
/*********************************************************
* 파일명     :  /mem/login.php
* 프로그램명 :	모바일샵 로그인
* 작성자     :  dn
* 생성일     :  2012.07.10
**********************************************************/	
include "../_header.php";

### 회원인증여부
if( $sess ){
	go("../index.php");
}

if (!$_GET['returnUrl']) $returnUrl = $_SERVER['HTTP_REFERER'];
else $returnUrl = $_GET['returnUrl'];

if(!$returnUrl) $returnUrl = $mobileRootDir;

$tpl->print_('tpl');

?>