<? ### µ¿ºÎÀÍ½ºÇÁ·¹½º http://www.dongbups.com/newHtml/delivery/dvsearch_View.jsp?item_no=
$out = split_betweenStr($out,"<!--  ½Ç ÄÁÅÙÃ÷ ¿µ¿ª -->","<!-- //½Ç ÄÁÅÙÃ÷ ¿µ¿ª -->");
$out[0] = str_replace('/newHtml/','http://www.dongbups.com/newHtml/',$out[0]);
$out[0] = str_replace('<script type="text/javascript" src="http://www.logii.com/interface/delvprom/delv_link.asp?comp_code=dongex&inv_no=303478225890" charset="euc-kr"></script>','',$out[0]);
$out[0] = str_replace('<a href="javascript:history.go(-1);" class="bt"><img src="http://www.dongbups.com/newHtml/images/btn/btn_list.gif" alt="¸ñ·Ï" /></a>','',$out[0]);
?>
<link rel="stylesheet" type="text/css" href="http://www.dongbups.com/newHtml/common/css/layout.css" charset="euc-kr" />
<style> body {background-image: none;}</style>
<div><?=$out[0]?></div>