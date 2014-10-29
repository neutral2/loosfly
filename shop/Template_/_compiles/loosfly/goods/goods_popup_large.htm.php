<?php /* Template_ 2.2.7 2014/05/15 16:38:31 /www/loosfly_godo_co_kr/shop/data/skin/loosfly/goods/goods_popup_large.htm 000003554 */ 
if (is_array($TPL_VAR["t_img"])) $TPL_t_img_1=count($TPL_VAR["t_img"]); else if (is_object($TPL_VAR["t_img"]) && in_array("Countable", class_implements($TPL_VAR["t_img"]))) $TPL_t_img_1=$TPL_VAR["t_img"]->count();else $TPL_t_img_1=0;?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<meta name="description" content="<?php echo $GLOBALS["meta_title"]?>">
<meta name="keywords" content="<?php echo $GLOBALS["meta_keywords"]?>">
<title><?php echo $TPL_VAR["shortdesc"]?> / <?php echo $TPL_VAR["goodsnm"]?></title>
<link rel="styleSheet" href="/shop/data/skin/loosfly/style.css" />
<script type="text/javascript" src="/shop/data/skin/loosfly/common.js"></script>
<script>
function chgImg(obj)
{
	var objImg = document.getElementById('objImg');
	objImg.src = obj.src.replace("/t/","/");
}

function fitwin()
{
	var margin_x = 0;
	var margin_y = 30;
	if( navigator.userAgent.indexOf("MSIE") != -1 ) margin_x = 30;
	else if( navigator.userAgent.indexOf("Chrome") != -1 ) margin_x = 10;
	else if( navigator.userAgent.indexOf("FireFox") != -1 ) margin_x = 630;
	else margin_x = 10;
	
	window.resizeTo(150,150);
	
	var borderX = 150 - document.body.clientWidth;
	var borderY = 150 - document.body.clientHeight;

	if(document.body.clientWidth > 150)borderX = margin_x;
	if(document.body.clientHeight > 150)borderY = margin_y;
	
	width	= document.body.scrollWidth + borderX;
	height	= document.body.scrollHeight + borderY;
	windowX = (window.screen.width-width)/2;
	windowY = (window.screen.height-height)/2;

	if( width > ( screen.width - margin_x ) ){
		width = screen.width - margin_x;
		windowX = 0;
	}
	if( height > ( screen.height - margin_y ) ){
		height = screen.height - margin_y;
		windowY = 0;
	}

	window.moveTo(windowX,windowY);
	window.resizeTo(width,height);
}
</script>
<style>
body { background-color:#ffffff; }
</style>
</head>

<?php echo copyProtect()?>

<body style="margin:0 auto" onLoad="fitwin()" <?php echo copyProtect(true)?>>

<table width="100%" height="100%" cellpadding="0" cellspacing="0" border="0">
<tr>
	<td height="100%" style="border:#cfcfcf solid 3px;padding:5px" valign="top">
		<table width="100%" height="100%" cellpadding="0" cellspacing="0" border="0">
		<tr>
			<td align="center">
				<table width="100%" cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td width="<?php echo $GLOBALS["cfg"]["img_l"]+ 2?>"><?php echo goodsimg($TPL_VAR["r_img"][ 0],$GLOBALS["cfg"]["img_l"]+ 0,"id='objImg' style='border:#3f3f3f 1px solid'")?></td>
					<td width="105" nowrap height="100%" valign="top" align="right">
						<table width="100%" height="100%" cellpadding="0" cellspacing="0" border="0">
<?php if($TPL_t_img_1){foreach($TPL_VAR["t_img"] as $TPL_V1){?>
						<tr><td valign=bottom align=right><?php echo goodsimg($TPL_V1, 100,"onclick='chgImg(this)' style='border:#3f3f3f 1px solid;cursor:pointer;'")?></td></tr>
						<tr><td colspan="2" height="5" style="padding:0px"></td></tr>
<?php }}?>
						<tr><td colspan="2" height="20" style="padding:0px"></td></tr>
						<tr height="100%" ><td align="right" valign="bottom" colspan="2"><A HREF="javascript:this.close()" onFocus="blur()"><img src="/shop/data/skin/loosfly/img/common/popup_close.gif"></A></td></tr>
						</table>
					</td>
				</tr>
				</table>
			</td>
		</tr>
		</table>
	</td>
</tr>
</table>