<?PHP
	$btn_bgcolor = "";
	$btn_color = "";
	$btn_text = "";
	$btn_path = "/shop/skin/loosfly/img/jimmy/btn_img_01_";
	$btn_margin = array(0, 0, 0, 0);
	if( $_GET ) {
		$btn_bgcolor = $_GET['bgcolor'];
		$btn_color = $_GET['color'];
		$btn_text = $_GET['text'];
		$btn_width = $_GET['width'];
		$btn_float = $_GET['float'];
		$tmp = $_GET['margin'];
		$btn_margin = explode(' ', $tmp);
		$btn_aoptions = $_GET['options'];
	}
	
	if( $btn_bgcolor == "dark_grey" ) {
		$btn_bgcolor = "717074";
		$btn_path = "/shop/skin/loosfly/img/jimmy/btn_img_02_";
	}
	else if( $btn_bgcolor == "light_grey" ) {
		$btn_bgcolor = "efefef";
		$btn_path = "/shop/skin/loosfly/img/jimmy/btn_img_03_";
	}
	else {
		$btn_bgcolor = "71cbd2";
		$btn_path = "/shop/skin/loosfly/img/jimmy/btn_img_01_";
	}
?>
<style>
.btn_hl {background:url(<?PHP echo $btn_path."hl.gif"; ?>);width:5px;height:5px;}
.btn_hc {background:url(<?PHP echo $btn_path."edge.gif"; ?>);height:5px;}
.btn_hr {background:url(<?PHP echo $btn_path."hr.gif"; ?>);width:5px;height:5px;}
.btn_fl {background:url(<?PHP echo $btn_path."fl.gif"; ?>);width:5px;height:5px;}
.btn_fc {background:url(<?PHP echo $btn_path."edge.gif"; ?>);height:5px;}
.btn_fr {background:url(<?PHP echo $btn_path."fr.gif"; ?>);width:5px;height:5px;}
.btn_bl {background:url(<?PHP echo $btn_path."edge.gif"; ?>);width:5px;}
.btn_bc {background:<?PHP echo "#$btn_bgcolor"; ?>;color:<?PHP echo "#$btn_color"; ?>;font-size:11px; line-height:15px;}
.btn_br {background:url(<?PHP echo $btn_path."edge.gif"; ?>);width:5px;}
.btn_head, .btn_footer, .btn_body, .btn_top {width:100%; border-collapse:collapse; table-layout:fixed;}
</style>

<a <?PHP echo "$btn_aoptions"; ?>>
<div style="<?PHP echo "width:".$btn_width."px;float:".$btn_float.";margin:".$btn_margin[0]."px ".$btn_margin[1]."px ".$btn_margin[2]."px ".$btn_margin[3]."px;";?>">
	<table class="btn_head" cellspacing="0" cellpadding="0"><tr><td class="btn_hl" nowrap="nowrap"></td><td class="btn_hc"></td><td class="btn_hr" nowrap="nowrap"></td></tr></table>
	<table class="btn_body" cellspacing="0" cellpadding="0">
	<tr>
		<td class="btn_bl" nowrap="nowrap"></td>
		<td class="btn_bc">
			<table width="100%" cellpadding="2" cellspacing="0" border="0">
			<tr><td align="center"><?PHP echo $btn_text; ?></td></tr>
			</table>
		</td>
		<td class="btn_br" nowrap="nowrap"></td>
	</tr>
	</table>
	<table class="btn_footer" cellspacing="0" cellpadding="0"><tr><td class="btn_fl" nowrap="nowrap"></td><td class="btn_fc"></td><td class="btn_fr" nowrap="nowrap"></td></tr></table>
</div>
</a>