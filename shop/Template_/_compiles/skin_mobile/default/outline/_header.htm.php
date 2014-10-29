<?php /* Template_ 2.2.7 2012/11/23 14:53:54 /www/loosfly_godo_co_kr/shop/data/skin_mobile/default/outline/_header.htm 000004104 */  $this->include_("dataBanner");?>
<!DOCTYPE html>
<head>
<meta name="description" content="<?php echo $GLOBALS["meta_title"]?>">
<meta name="keywords" content="<?php echo $GLOBALS["meta_keywords"]?>">
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<meta name="viewport" content="user-scalable=yes, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, width=device-width" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />

<title><?php echo $GLOBALS["meta_title"]?></title>

<script src="/shop/data/skin_mobile/default/common/js/common.js"></script>
<script src="/shop/data/skin_mobile/default/common/js/goods_list_action.js"></script>
<script src="/shop/data/skin_mobile/default/common/js/jquery-1.4.2.min.js"></script>
<script src="/shop/lib/js/kakaoLink.js"></script>
<link rel="styleSheet" href="/shop/data/skin_mobile/default/common/css/reset.css" />
<link rel="stylesheet" href="/shop/data/skin_mobile/default/common/css/style.css" />
<!--<link rel="stylesheet" href="/shop/data/skin_mobile/default/style_screen.css" type="text/css" media="screen and (min-width: 321px)"  />-->

<?php if($GLOBALS["cfgMobileShop"]["mobileShopIcon"]){?><link rel="apple-touch-icon-precomposed" href="<?php echo $GLOBALS["cfg"]["rootDir"]?>/data/skin_mobile/<?php echo $GLOBALS["cfgMobileShop"]["tplSkinMobile"]?>/<?php echo $GLOBALS["cfgMobileShop"]["mobileShopIcon"]?>" /><?php }?>

<?php echo $TPL_VAR["naverCommonInflowScript"]?>

</head>

<body>

<div id="dynamic"></div>

<div id="wrap">

<header>
	<div id="logo">
<?php if($GLOBALS["cfgMobileShop"]["mobileShopLogo"]){?>
		<a href="<?php echo $GLOBALS["cfgMobileShop"]["mobileShopRootDir"]?>"><img src="<?php echo $GLOBALS["cfg"]["rootDir"]?>/data/skin_mobile/<?php echo $GLOBALS["cfgMobileShop"]["tplSkinMobile"]?>/<?php echo $GLOBALS["cfgMobileShop"]["mobileShopLogo"]?>" alt="<?php echo $GLOBALS["cfg"]["shopName"]?>" title="<?php echo $GLOBALS["cfg"]["shopName"]?>" /></a>
<?php }else{?><?php if(is_array($TPL_R1=dataBanner( 90))&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?><?php echo $TPL_V1["tag"]?><?php }}?><?php }?>
	</div>

	<div id="mnb">
		<ul>
<?php if($GLOBALS["sess"]){?>
				<li><a href="<?php echo $GLOBALS["cfg"]["rootDir"]?>/member/logout.php" class="btn logout"><span>로그아웃</span></a></li>
<?php }else{?>
				<li><a href="<?php echo $GLOBALS["cfgMobileShop"]["mobileShopRootDir"]?>/mem/login.php" class="btn login"><span>로그인</span></a></li>
<?php }?>
			<li><a href="<?php echo $GLOBALS["cfgMobileShop"]["mobileShopRootDir"]?>/myp" class="btn mypage"><span>마이페이지</span></a></li>
		</ul>
	</div>

	<div class="clearb"></div>
	
<?php if($GLOBALS["_view_search_form"]){?>
	<hr class="hidden" />
	<div id="search">
		<form name="search_form" method="get" action="<?php echo $GLOBALS["cfgMobileShop"]["mobileShopRootDir"]?>/goods/list.php">
			<fieldset>
				<legend>상품검색</legend>
				<div class="kw"><div class="kw_ico"><input type="text" id="kw" name="kw" value="" /></div></div>
				<div class="btn"><button type="submit"><span>검색</span></button></div>
			</fieldset>
		</form>
	</div>
<?php }?>

	<hr class="hidden" />
	<div id="gnb">
		<ul>
			<li><a href="<?php echo $GLOBALS["cfgMobileShop"]["mobileShopRootDir"]?>/goods/category.php" class="category<?php if($GLOBALS["categorypage"]){?>_on<?php }?>"><span>카테고리</span></a>
			<li class="lb"><a href="<?php echo $GLOBALS["cfgMobileShop"]["mobileShopRootDir"]?>/myp/wishlist.php" class="wishlist<?php if($GLOBALS["wishlistpage"]){?>_on<?php }?>"><span>찜리스트</span></a>
			<li class="lb"><a href="<?php echo $GLOBALS["cfgMobileShop"]["mobileShopRootDir"]?>/goods/cart.php" class="cart<?php if($GLOBALS["cartpage"]){?>_on<?php }?>"><span>장바구니</span></a>
		</ul>
	</div>

</header>

<div class="clearb"></div>
<hr class="hidden" />