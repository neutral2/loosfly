<? ### CJGLS(HTHÅëÇÕ) 

$out=iconv("UTF-8", "euc-kr",$out);
$out = split_betweenStr($out,"</div><!-- //contAreaCont -->","<div class=\"contAreaCont\">");
$out[0] = str_replace('../../images/','http://www.cjgls.co.kr/kor/images/',$out[0]);

?>
<link href="http://www.cjgls.co.kr/kor/css/common.css" rel="stylesheet" type="text/css">

<SCRIPT type="text/javascript">
 <!--
 function tracking_sm(sm) {
  var url = 'http://nexs.cjgls.com/web/tracking_hth_sm.jsp?sm=' + sm;
  window.open(url, '', 'top=60, left=120, width=376, height=240, toolbar=no, status=no, menubar=no, scrollbars=no, resizable=no, directories=no');
 } function tracking_bran(bran) {
  var url = 'http://nexs.cjgls.com/web/tracking_hth_bran.jsp?bran=' + bran;
  window.open(url, '', 'top=60, left=120, width=376, height=216, toolbar=no, status=no, menubar=no, scrollbars=no, resizable=no, directories=no');
 }
 -->
</script>

<?=$out[0]?>