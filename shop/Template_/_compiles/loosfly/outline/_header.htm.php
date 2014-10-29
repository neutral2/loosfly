<?php /* Template_ 2.2.7 2014/10/24 19:32:32 /www/loosfly_godo_co_kr/shop/data/skin/loosfly/outline/_header.htm 000004859 */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php echo $TPL_VAR["systemHeadTagStart"]?>

<link rel="shortcut icon" href="/shop/data/skin/loosfly/img/jimmy/loos_icon.ico">
<meta http-equiv="Content-Type" content="text/html; charset=EUC-KR" />
<meta name="description" content="<?php echo $GLOBALS["meta_title"]?>" />
<meta name="keywords" content="<?php echo $GLOBALS["meta_keywords"]?>" />
<title><?php echo $GLOBALS["meta_title"]?></title>

<script type="text/javascript" src="https://www.google.com/jsapi"></script>


<?php if($_POST){?>
<script>
	history.back = function() {
		var step = (document.location.protocol == 'https:' ? 2 : 1) * -1;
		history.go( step );
	}
</script>
<?php }?>

<?php if($TPL_VAR["connInterpark"]=='ok'){?>
<script type="text/javascript">var entr_nm = "<a href='/'><?php echo $GLOBALS["cfg"]["shopName"]?></a>"; // 상점명</script>
<script type="text/javascript" src="http://www.interpark.com/gate/minm/topnav_shopplus_soho.js"></script>
<?php }?>

<?php if($_COOKIE['cc_inflow']=='yahoo_fss'||$_GET['ref']=='yahoo_fss'){?>
<script language="javascript" src="http://kr.ysp.shopping.yahoo.com/ysp/ysp_fss.js"></script>
<script> ykfss_bar();</script>
<?php }?>

<script type="text/javascript" src="/shop/data/skin/loosfly/common.js"></script>
<script type="text/javascript" src="/shop/data/skin/loosfly/cart_tab/godo.cart_tab.js"></script>

<link rel="styleSheet" href="/shop/data/skin/loosfly/cart_tab/style.css" />
<link rel="styleSheet" href="/shop/data/skin/loosfly/style.css" />
<style type="text/css">
	.outline_both {
	border-left-style:solid;
	border-right-style:solid;
	border-left-width:<?php echo $GLOBALS["cfg"]['shopLineWidthL']?>;
	border-right-width:<?php echo $GLOBALS["cfg"]['shopLineWidthR']?>;
	border-left-color:<?php echo $GLOBALS["cfg"]['shopLineColorL']?>;
	border-right-color:<?php echo $GLOBALS["cfg"]['shopLineColorR']?>;
}

<?php if($this->tpl_['side_inc']&&$GLOBALS["cfg"]['outline_sidefloat']=='left'){?> <!-- 측면위치가 좌측인 경우 -->

.outline_side {
	border-left-style:solid;
	border-left-width:<?php echo $GLOBALS["cfg"]['shopLineWidthC']?>;
	border-left-color:<?php echo $GLOBALS["cfg"]['shopLineColorC']?>;
}

<?php }elseif($this->tpl_['side_inc']&&$GLOBALS["cfg"]['outline_sidefloat']=='right'){?> <!-- 측면위치가 우측인 경우 -->

.outline_side {
	border-right-style:solid;
	border-right-width:<?php echo $GLOBALS["cfg"]['shopLineWidthC']?>;
	border-right-color:<?php echo $GLOBALS["cfg"]['shopLineColorC']?>;
<?php }?>
</style>

<?php if($GLOBALS["overture_cc"]){?><?php $this->print_("overture_cc",$TPL_SCP,1);?><?php }?>
<?php echo $TPL_VAR["customHeader"]?>


<!-- Skitter Styles -->
<link href="/shop/data/skin/loosfly/skitter/css/skitter.css" type="text/css" media="all" rel="stylesheet" />
<script type="text/javascript">google.load("jquery", "1.7.1");</script>	

<!-- Skitter JS -->
<script type="text/javascript" language="javascript" src="/shop/data/skin/loosfly/skitter/js/jquery.easing.1.3.js"></script>
<script type="text/javascript" language="javascript" src="/shop/data/skin/loosfly/skitter/js/jquery.animate-colors-min.js"></script>
<script type="text/javascript" language="javascript" src="/shop/data/skin/loosfly/skitter/js/jquery.skitter.min.js"></script>

<script type="text/javascript" language="javascript">	
</script>
<script language="JavaScript">
	function onopen()
	{
		var url =
		"http://www.ftc.go.kr/info/bizinfo/communicationViewPopup.jsp?wrkr_no=2118890304";
		window.open(url, "communicationViewPopup", "width=750, height=700;");
	}
</script>

<?php echo $TPL_VAR["systemHeadTagEnd"]?>

</head>
<?php echo copyProtect(true)?>

<body oncontextmenu="return false" onselectstart="return false" ondragstart="return false">
<?php $this->print_("myBoxLayer",$TPL_SCP,1);?>

<?php if($TPL_VAR["useMyLevelLayerBox"]=='y'){?>
<?php $this->print_("myLevelLayer",$TPL_SCP,1);?>

<?php }?>

<?php if($TPL_VAR["alertCoupon"]==true){?>
<?php $this->print_("myCouponLayer",$TPL_SCP,1);?>

<?php }?>

<div id="dsWrapping">
	<a name="top"></a>
	<div id="dsHeader">
<?php $this->print_("header_inc",$TPL_SCP,1);?>

	</div>	
<?PHP 
	include_once ("_loos_top_info.php");
	$fname =  $TPL_VAR["pfile"];
	$op1 =  currPosition($GLOBALS["category"]);
	$options = "";
	foreach( $_GET as $key=>$data ) {
		$options .= $key."=".$data."&";
	}

	$path = _get_path( $TPL_VAR["pfile"], $options, $op1,  $TPL_VAR["goodsnm"]);
?>
	<div id="dsPath"><div id="blkPathIndicator"><?=$path?></div></div>
	<div id="dsBody">