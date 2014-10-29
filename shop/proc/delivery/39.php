<?
 # 경동택배 http://www.kdexp.com/sub3_shipping.asp?stype=1&p_item=
 	$out = split_betweenStr($out,'<div id="printme">','</DIV></div>');
	$out = str_replace('<a href="javascript:goprint();"><img src="/insu/btn_print.gif"></a>', '', $out[0]);
	$out = str_replace('<a href="javascript:goprint1();"><img src="/insu/btn_insu.gif"></a>', '', $out);
?>
<table width="100%">
	<tr>
		<td>
			<?=$out;?>
		</td>
	</tr>
</table>