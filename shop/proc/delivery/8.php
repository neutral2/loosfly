<? ### �ٷο�ĸ(22222222222)
$out = iconv('UTF-8', 'EUC-KR', $out);
$out = split_betweenStr($out, '<section class="layerPop">', '</section>');
$out = str_replace('<h1 class="title">�����ȸ ���</h1>','',$out[0]);
$out = str_replace('<a href="#" class="bt-basic" onClick="parent.jQuery.fancybox.close();return false;">�ݱ�</a>','',$out);
?>
<link rel="stylesheet" href="http://www.yellowcap.co.kr/css/style.css">
<table width="100%" border=0>
<?=$out?>
</table>