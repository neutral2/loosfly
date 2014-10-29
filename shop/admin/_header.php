<?

include dirname(__FILE__)."/../conf/config.php";
include dirname(__FILE__)."/lib.php";
include dirname(__FILE__)."/lib.skin.php";
include dirname(__FILE__)."/../lib/menu.class.php";
include dirname(__FILE__)."/../lib/blogshop.class.php";

$blogshop = new blogshop();
$mn = new Menu();
$section = $mn->cmKey;
if($mn->section!='etc'){
	$menu = $mn->getMenu();
}else{
	$section = $mn->section;
}

if (!$mainpage)
{
	$over[$section] = "_on";
	if($section=='mobileShop2') $over['mobileShop'] = '_on';
}

### 로그인 세션 시간
setCookie('Xtime',time(),0,'/');

### PG 사용 현황
if($cfg['settlePg']){
	@include_once dirname(__FILE__)."/../conf/pg.".$cfg['settlePg'].".php";
	if($pg['id'] != '') $use_pg = true;
	else $use_pg = false;
}else $use_pg = false;

### 투데이샵 PG 사용현황
$todayShop = Core::loader('todayshop');
$tsCfg = $todayShop->cfg;
$tsPG = ($tsCfg['pg'] != '') ? unserialize($tsCfg['pg']) : array();
if ($tsPG['cfg'][settlePg] && !empty($tsPG['set'])) {
	$use_todayshop_pg = true;
} else $use_todayshop_pg = false;

### 블로그샵 url
if($blogshop->linked && $blogshop->config['iframe_url']){
	$blogshop_url = str_replace('/admin_iframe','',$blogshop->config['iframe_url']);
}

### 적용된 모바일버전 (1.0, 2.0) 을 확인하고, 네이게이션 메뉴의 URL 경로를 지정해준다.
$version2_apply_file_name = ".htaccess";
 ## 현재 적용버전을 확인하다
if ( file_exists(dirname(__FILE__)."/../../m/".$version2_apply_file_name) ) {

	$aFileContent = file(dirname(__FILE__)."/../../m/".$version2_apply_file_name);

	for ($i=0; $i<count($aFileContent); $i++) {
		if (preg_match("/RewriteRule/i", $aFileContent[$i])) {
			break;
		}
	}
	if ($i < count($aFileContent)) {
		$mobileShop = "mobileShop2";
	} else {
		$mobileShop = "mobileShop";
	}
} else {
	$mobileShop = "mobileShop";
}

// 디자인관리일때 SET_HTML_DEFINE 선언, SET_HTML5 선언
if ((preg_match('/\/admin\/design$/', dirname($_SERVER['PHP_SELF'])) || preg_match('/\/admin\/mobileShop(2|)$/', dirname($_SERVER['PHP_SELF']))) && (strpos(basename($_SERVER['PHP_SELF']), 'iframe.') === 0) || basename($_SERVER['PHP_SELF']) == 'codi.php') {
	$SET_HTML_DEFINE = true;
	$SET_HTML5 = true;
}

// SET_HTML_DEFINE이 선언된 페이지나 신규 생성된 페이지(adm_*.php) 에서는 DTD(xhtml)를 선언
if ($SET_HTML_DEFINE || strpos(basename($_SERVER['PHP_SELF']), 'adm_') === 0) {
	if ($SET_HTML5) {
		$DEFINE_DOCTYPE = '<!DOCTYPE html>';
		$scriptLoad .= '<style>img { vertical-align:top; }</style>';
	}
	else $DEFINE_DOCTYPE = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
	$DEFINE_HTML = $DEFINE_DOCTYPE.'<html xmlns="http://www.w3.org/1999/xhtml" lang="ko" xml:lang="ko">';
	$DEFINE_EXTRA_TAGS = '<meta http-equiv="X-UA-Compatible" content="IE=edge" />';
	$DEFINE_EXTRA_TAGS.= '<script type="text/javascript" src="'.$cfg['rootDir'].'/lib/js/jquery-1.10.1.min.js"></script>';
	$DEFINE_EXTRA_TAGS.= '<script type="text/javascript" src="'.$cfg['rootDir'].'/lib/js/jquery-ui.js"></script>';
	$DEFINE_EXTRA_TAGS.= '<script type="text/javascript">jQuery.noConflict();</script>';
}
else {
	$DEFINE_HTML = '<html>';
	$DEFINE_EXTRA_TAGS = '';
}
?>
<?php echo $DEFINE_HTML; ?>
<head>
<title>'Godo Shoppingmall e나무 Season4 관리자모드'</title>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$_CFG['global']['charset']?>">
<?php echo $DEFINE_EXTRA_TAGS; ?>
<link rel="styleSheet" href="../style.css">
<link rel="styleSheet" href="../_contextmenu/contextmenu.css?<?=time()?>">
<style>
/*** 어드민 레이아웃 설정 ***/
body {margin:0 0 0 0px}
</style>
<script type="text/javascript" src="../common.js"></script>
<script type="text/javascript" src="../prototype.js"></script>
<script type="text/javascript" src="../prototype_ext.js"></script>
<script type="text/javascript" src="../_contextmenu/contextmenu.js"></script>
<script type="text/javascript" src="../godo.form_helper.js"></script>
<script type="text/javascript" src="../../lib/js/json/json2.min.js"></script>
<?=$scriptLoad?>
<div id="dynamic"></div>
<iframe name="ifrmHidden" src="../../blank.php" style="display:none;width:100%;height:500px;"></iframe>
<div id="jsmotion"></div>
<?
$query = "SELECT name, url, target FROM ".GD_CONTEXTMENU." WHERE m_no = '".$sess['m_no']."'";
$rs = $db->query($query);
$context_menu = array();
while ($row = $db->fetch($rs,1)) {
	$context_menu[] = $row;
}

?>
<script type="text/javascript">
function godo_context_menu() {
	if (getCookie('_TOGGLE_CONTEXT_MENU_') == 1) $('el-use-context-menu').checked = true;

	nsGodoContextMenu.init({
		option  : {
					contextWidth : 180,
					zIndex		 : 999999
		}
		<? if (sizeof($context_menu) > 0) echo ',menu : '.gd_json_encode($context_menu); ?>
	});

}

function godo_folding_menu() {
	var h4s =  $H($$('.admin-left-menu > h4'));
	var uls =  $H($$('.admin-left-menu > ul'));

	var el;
	var today = new Date();
	var expire_date = new Date(today.getTime() + 31536000);
	var loc = window.location.pathname.split('/');
	loc.pop();
	loc = loc.join('_');

	h4s.each(function(pair) {

		if (typeof pair.value != 'object') return;

		var el = uls.get(pair.key);

		if (getCookie(loc + '_' + pair.key) == 'none') {
			pair.value.addClassName('fold');
			el.setStyle({display:'none'});
		}

		try
		{
			Event.observe(pair.value, 'click', function(event) {

				if (el.getStyle('display') != 'none') {
					if (!pair.value.hasClassName('fold')) pair.value.addClassName('fold');
					el.setStyle({display:'none'});
					setCookie( loc + '_' + pair.key, 'none', expire_date, '/');
				}
				else {
					if (pair.value.hasClassName('fold')) pair.value.removeClassName('fold');
					el.setStyle({display:'block'});
					setCookie( loc + '_' + pair.key, 'block', expire_date, '/');
				}
			});
		}
		catch (e) { }
	});
}

Event.observe(document, 'dom:loaded', godo_context_menu, false);
Event.observe(document, 'dom:loaded', godo_folding_menu);

</script>

<body class="scroll">
<p>&nbsp;</p>
<table width="100%" height="89" cellpadding="0" cellspacing="0" border="0" style="background:url('../img/top_main_back.gif') repeat-x;">
<tr>
	<td valign="top">

	<!--- 로고, 서비스 메뉴 ---------------->
	<table width="100%" height=100% cellpadding="0" cellspacing="0" border="0">
	<tr>

		<td width="100%" valign="top">

		<table width="816" cellpadding="0" cellspacing="0" border="0">
		<tr>
			<td nowrap align="left" valign="top"><div style="position:relative;width:139px"><div style="position:absolute"><a href="../index.php"><img src="../img/godo_logo.gif" /></a></div></div></td>
			<td height="34" align="right">

			<!--------------- 메뉴검색 및 GNB 시작 --------------------->
			<table cellpadding="0" cellspacing="0" border="0">
			<tr>
				<td valign="top">

				<!--------------- 네비게이션, 회원CRM 시작 --------------------->
				<script language="JavaScript" type="text/JavaScript">
				/*** 관리자 CRM or 메뉴 검색 ***/
				var nsQuickSearch = function() {
					return {
						currentMenu : null,
						currentSeq : 0,
						menuData : null,
						menuSet: function(idx) {

							if (!this.menuData) return false;

							this.currentMenu = this.menuData[idx];

							$('el-quick-search-keyword').value = this.currentMenu.title;
							$('el-quick-search-keyword').focus();

							this.currentSeq = idx;
							this.highlight(false);

						},
						changeMode : function(mode) {

							this.menuData = null;
							this.currentMenu = null;
							this.currentSeq = 0;
							$('el-quick-search-keyword').value = '';
							$('el-quick-search-keyword-suggest').hide();

							//changeMode
							/*/
							var today = new Date();
							var expire_date = new Date(today.getTime() + 31536000);
							/*/
							var expire_date = 0;
							/**/
							setCookie( '_admin_quick_search_mode', mode , expire_date, '/');

						},
						isMenuSearch : function() {
							return $('el-quick-search-menu').checked ? true : false;
						},
						suggest : function() {

							// 메뉴 검색
							if (this.isMenuSearch()) {

								var keyword = $('el-quick-search-keyword').value;

								var self = this;

								self.currentSeq = 0;
								self.menuData = null;
								self.currentMenu = null;

								var ajax = new Ajax.Request('../proc/ax.menu_finder.php', {
									method: "post",
									parameters: 'keyword='+keyword,
									asynchronous: true,
									onComplete: function(response) { if (response.status == 200) {

										self.menuData = response.responseText.evalJSON(true);

										if (self.menuData.size() > 0) {
											var html = '<ul>';

											self.menuData.each(function(row, idx){

												html += '<li onclick="nsQuickSearch.menuSet('+idx+');"';
												if (idx == 0) html += ' class="on"';
												html += '>';

												html += row.title;
												html += '</li>';

											});

											html += '</ul>';

											$('el-quick-search-keyword-suggest').update(html);
											$('el-quick-search-keyword-suggest').show();

										}
										else {
											$('el-quick-search-keyword-suggest').hide();
										}

									}}
								});
							}
							// crm 검색
							else {
								return;
							}
						},
						go : function () {

							// 검색어
							var keyword = $('el-quick-search-keyword').value;

							// 메뉴 검색
							if (this.isMenuSearch()) {

								if( !keyword ){
									alert('검색할 메뉴명을 넣어주세요.');
									return false;
								}

								if (this.currentMenu) {
									var url = this.currentMenu.url;
									window.location.replace(url);
								}
								else {
									alert('찾으시는 메뉴가 없습니다.');
									return false;
								}

							}
							// crm 검색
							else {

								if( !keyword ){
									alert('검색할 회원정보(아이디 or 이름)를 넣어주세요.');
									return false;
								}
								window.open('../member/popup.list.php?skey=all&sword='+keyword,'crmAdminPopUp','width=800,height=600,scrollbars=1');
							}

						},
						highlight : function(scroll) {

							var self = this;

							var div  = $('el-quick-search-keyword-suggest');
							var ul	 = div.down();
							var lis	 = ul.childElements();
							var _height = div.getHeight();

							lis.each(function(li,idx){
								if (idx == self.currentSeq) {

									li.addClassName('on');

									if (scroll)
									{
										var __height = li.getHeight() * (idx + 1) + 10;

										if (_height < __height) {
											div.scrollTop = __height - _height;
										}
										else if (_height > __height) {
											div.scrollTop = 0;
										}
									}

								}
								else {
									li.removeClassName('on');
								}
							});

						},
						suggestMove : function(direction) {

							if (!this.menuData) return false;

							var self = this;
							var lis  = $('el-quick-search-keyword-suggest').down().childElements();

							self.currentMenu = null;
							self.currentSeq = parseInt(self.currentSeq) + parseInt(direction);

							if (self.currentSeq < 0) {
								self.currentSeq = lis.size() - 1;
							}
							else if (self.currentSeq >= lis.size()) {
								self.currentSeq = 0;
							}

							self.highlight(true);


						},
						start : function() {

							if (event.keyCode == 40) {	// 아래
								if (this.isMenuSearch()) {
									this.suggestMove(1);
								}
							}
							else if (event.keyCode == 38) {// 위
								if (this.isMenuSearch()) {
									this.suggestMove(-1);
								}
							}
							else if (event.keyCode == 13) {
								if (!this.isMenuSearch()) {
									this.go();
								}
								else {
									if (this.currentMenu == null) {
										this.menuSet( this.currentSeq );
									}
									else {
										this.go();
									}

								}
							}
							else {
								this.suggest();
							}

						}
					}
				}();

				</script>
				<style type="text/css">
				fieldset.admin-top-quick-search {height:17px;border:0;margin:0 20px 0 0;padding:0;}
				fieldset.admin-top-quick-search label {display:block;float:left;}

				fieldset.admin-top-quick-search div.input-field-wrap {position:relative;display:block;float:left;margin:2px 0 0 10px;}
				fieldset.admin-top-quick-search div.input-field-wrap span.input-field {display:block;position: relative;float:left;border:1px solid #485164;height:17px;width:140px;background:#ffffff url('../img/top_search_b.gif') no-repeat right;overflow:hidden;}
				fieldset.admin-top-quick-search div.input-field-wrap span.input-field input.text {background:transparent;position: absolute;border:0;width:122px;height:15px;font:11px 돋움;}

				fieldset.admin-top-quick-search div.input-field-wrap div.input-suggest-wrap {position:absolute;top:20px;left:0;height:100px;width:170px;overflow:auto;background:#fff;z-index:10;border:1px solid #485062;/*display:none;*/}
				fieldset.admin-top-quick-search div.input-field-wrap div.input-suggest-wrap ul {margin:0;padding:3px;list-style:none;}
				fieldset.admin-top-quick-search div.input-field-wrap div.input-suggest-wrap ul li {cursor:pointer;text-align:left;font-size:11px;font-family:돋움, 돋움체;letter-spacing:-1px;color:#575860;padding:2px 0 0 0;}
				fieldset.admin-top-quick-search div.input-field-wrap div.input-suggest-wrap ul li.on {color:#1C9BF1}
				</style>
				<table cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td class="topArea" style="padding:0;">
						<fieldset class="admin-top-quick-search">
							<label><input type="radio" name="quick-search" id="el-quick-search-menu" onClick="nsQuickSearch.changeMode('menu');" value="menu" <?=($_COOKIE['_admin_quick_search_mode'] == 'menu') ? 'checked' : ''?>>관리자 메뉴검색</label>
							<label><input type="radio" name="quick-search" id="el-quick-search-crm" onClick="nsQuickSearch.changeMode('crm');" value="crm" <?=($_COOKIE['_admin_quick_search_mode'] != 'menu') ? 'checked' : ''?>>회원검색</label>
							<div class="input-field-wrap">
								<span class="input-field">
									<input type="text" name="el-quick-search-keyword" id="el-quick-search-keyword" value="" class="text" onKeyUp="nsQuickSearch.start();"/>
								</span>
								<div id="el-quick-search-keyword-suggest" class="input-suggest-wrap" style="display:none;">
								</div>
							</div>
							<img src="../img/top_search_icon.gif" style="cursor:pointer;" onClick="nsQuickSearch.go();" align="absmiddle"/></a>
							<input type="checkbox" id="el-use-context-menu" onClick="nsGodoContextMenu.toggle();"><a href="javascript:popup('http://www.godo.co.kr/main/newservice_view.php?postNo=25',660,550)"><img src="../img/tnb_menu.gif" align="absmiddle" /></a>
						</fieldset>
					</td>
				</tr>
				</table>
				<!--------------- 네비게이션, 회원CRM 끝 --------------------->

				</td>
				<td valign="middle">

				<table cellpadding="0" cellspacing="2" border="0">
				<tr>
					<? if($godo['shople'] == 'y'): ?>
					<td><a href="../shople/index.php"><img src="../img/go_shople.gif" /></a></td>
					<? endif; ?>
					<td><a href="http://www.godo.co.kr" target="_blank"><img src="../img/go_mygodo.gif" /></a></td>
					<td><a href="../../../index.php" target="_blank"><img src="../img/goshop.gif" /></a></td>
					<? if($blogshop->linked): ?>
					<td><a href="<?=$blogshop->config['iframe_url']?>/../" target="_blank"><img src="../img/go_blog.gif" /></a></td>
					<td><a href="../blog/index.php"><img src="../img/go_blog_admin.gif" /></a></td>
					<? endif; ?>
					<td><a href="../../member/logout.php?referer=../admin/login/login.php"><img src="../img/logout.gif" /></a></td>
					<td width="5"></td>
				</tr>
				</table>

				</td>
			</tr>
			</table>
			<!--------------- 메뉴검색 및 GNB 끝 --------------------->

			</td>
		</tr>
		<tr>
			<td valign="top" colspan="2">

            <!--------------- 기본관리,디자인관리 등 관리메뉴 이미지 시작 --------------------->
			<table cellpadding="0" cellspacing="0" width="100%" border="0">
			<tr>
				<td valign="top">

				<table border="0" cellpadding="0" cellspacing="0" class="gnb">
				<tr valign="top">
					<td><a href="<?=$sitelink->link('admin/basic/default.php', 'regular')?>"><img src="../img/top_basic_title<?=$over['basic']?>.gif" /></a></td>
					<td><a href="<?=$sitelink->link('admin/design/codi.php', 'regular')?>"><img src="../img/top_design_title<?=$over['design']?>.gif" /></a></td>
					<td><a href="<?=$sitelink->link('admin/goods/list.php', 'regular')?>"><img src="../img/top_product_title<?=$over['goods']?>.gif" /></a></td>
					<td><a href="<?=$sitelink->link('admin/order/list.php?mode=group&period=0&first=1', 'regular')?>"><img src="../img/top_order_title<?=$over['order']?>.gif" /></a></td>
					<td><a href="<?=$sitelink->link('admin/member/list.php', 'regular')?>"><img src="../img/top_member_title<?=$over['member']?>.gif" /></a></td>
					<td><a href="<?=$sitelink->link('admin/board/list_management.php', 'regular')?>"><img src="../img/top_board_title<?=$over['board']?>.gif" /></a></td>
					<td><a href="<?=$sitelink->link('admin/event/list.php', 'regular')?>"><img src="../img/top_promotion_title<?=$over['promotion']?>.gif" /></a></td>
					<td><a href="<?=$sitelink->link('admin/marketing/main.php', 'regular')?>"><img src="../img/top_marketing_title<?=$over['marketing']?>.gif" /></a></td>
					<td><a href="<?=$sitelink->link('admin/log/index.php', 'regular')?>"><img src="../img/top_count_title<?=$over['log']?>.gif" /></a></td>
					<td><a href="<?=$sitelink->link('admin/selly/index.php', 'regular')?>"><img src="../img/top_selly_title<?=$over['selly']?>.gif" /></a></td>
					<td><a href="<?=$sitelink->link('admin/todayshop/index.php', 'regular')?>"><img src="../img/top_todayshop_title<?=$over['todayshop']?>.gif" /></a></td>
					<td><a href="<?=$sitelink->link('admin/gogl/index.php', 'regular')?>"><img src="../img/top_overseas_title<?=$over['overseas']?>.gif" /></a></td>
					<td><a href="<?=$sitelink->link('admin/'.$mobileShop.'/index.php', 'regular')?>"><img src="../img/top_mobileShop_title<?=$over[$mobileShop]?>.gif" /></a></td>
					<td><a href="<?=$sitelink->link('admin/etc/index.php', 'regular')?>"><img src="../img/top_etc_title<?=$over['etc']?>.gif" /></a></td>
				</tr>
				</table>

				</td>
			</tr>
			</table>
            <!--------------- 기본관리,디자인관리 등 관리메뉴 이미지 끝 --------------------->

			<!--------------- 탭패널 시작 --------------------->
			<?
			// 탭메뉴 파일정의
			$tabMenu = array(
			'basic/default.php'
			, 'design/codi.php'
			, 'goods/list.php'
			, 'order/list.php'
			, 'member/list.php'
			, 'board/list.php'
			, 'event/list.php'
			, 'marketing/main.php'
			, 'log/index.php'
			, 'mobileShop/index.php'
			, 'mobileShop2/index.php'
			, 'todayshop/index.php'
			, 'etc/index.php'
			, 'blog/index.php'
			, 'shople/index.php'
			, 'selly/index.php'
			);
			preg_match('/[a-z]*\/[a-z]*\.[a-z]*$/i', $_SERVER['SCRIPT_FILENAME'], $tmp);
			if (in_array($tmp[0],$tabMenu) === true) {
				$cookieTab = 'maxtab_'.$section;
				if (isset($_COOKIE[$cookieTab]) === false) {
					echo '<span id="maxtab"><script>panel("maxtab", "'.$section.'");</script></span>';
				}
			}
			?>
			<!--------------- 탭패널 끝 --------------------->
			</td>
		</tr>
		</table>

		</td>
	</tr>
	</table>

	</td>
</tr>
<!-------------------- 로고, 서비스 메뉴 끝 --------------------->

<!-------------------- 측면, 관리타이틀이미지, 메뉴닫힘 시작 ------------------------------->
<? if (!$mainpage && !$noleft){ 	// 메인이외의 경우 ?>
</table>
<table cellpadding="0" cellspacing="0" border="0">
<tr>
	<td valign="top" id="leftMenu" width="200" style="background:url('../img/sub_leftmenu_back.gif') repeat-y;">

	<table height="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td><img src="../img/left_<?=$section?>_title.gif" class="hand" onClick="hiddenLeft();" /></td>
	</tr>

	<!-------------------- 측면 관리타이틀이미지 시작 ------------------------------->
	<tr>
		<td height="100%" valign="top">

		<div class="admin-left-menu">
		<?
		$__loc = str_replace('/','_',dirname($_SERVER['PHP_SELF']));

		for ($i=0,$m=sizeof($menu['title']);$i<$m;$i++) {
			$cntSubject = count($menu['subject'][$i]);
			if($menu['title'][$i] && $cntSubject){
		?>
		<h4><?=$menu['title'][$i]?></h4>
		<ul style="display:<?=$_COOKIE[$__loc.'_'.$i] == 'none' ? 'none' : 'block'?>">
			<? for ($j=0;$j<$cntSubject;$j++){
			if($menu['subject'][$i][$j]){
			?>
			<!-------------------- 측면 작은메뉴 시작 ------------------------------->
			<li <?=($j+1==$cntSubject ? 'class="noborder"' : '')?>>
				<?if(trim($menu['value'][$i][$j])){?>
				<!--메뉴 타겟 추가 2010.12.29 by slowj-->
				<a href="<?=$menu['value'][$i][$j]?>" name="navi" <?if(isset($menu['target'][$i][$j])) {?>target="<?=$menu['target'][$i][$j]?>"<?}?>
				<?
				list($script_filename,$query_string)=explode('?',$menu['value'][$i][$j]);
				if (str_replace(DIRECTORY_SEPARATOR,'/',realpath($script_filename)) == $_SERVER['SCRIPT_FILENAME']) {
					$c = true;

					parse_str($query_string, $tmp1);
					parse_str($_SERVER['QUERY_STRING'], $tmp2);

					foreach ($tmp1 as $k => $v) {
						if (!array_key_exists($k, $tmp2)) {
							$c = false;
							break(1);
						}
					}

					if ($c) {
						echo ' style="font-weight:bold;"';
					}

				}
				?>>
				<?}?>
				<?=trim($menu['subject'][$i][$j])?>
				<?if(trim($menu['value'][$i][$j])){?></a><?}?>
				<?	/**
						2011-02-01 by x-ta-c
						pg 사용 여부 체크 하여 미사용중 아이콘 출력 부 변경
						※정규식을 이용한 패턴 테스트가 아닐 때에는 preg_match 는 쓰지 말것.
					 */
					if ( (strpos($menu['value'][$i][$j],'todayshop/config.pg.php') !== false) || (strpos($menu['value'][$i][$j],'todayshop/config.pg.free.php') !== false) ) {
						if (!$use_todayshop_pg) echo '<img src="../img/btn_nouse.gif" align="absmiddle" />';
					}
					else if (strpos($menu['value'][$i][$j],'pg.php') !== false) {
						if (!$use_pg) echo '<img src="../img/btn_nouse.gif" align="absmiddle" />';
					}
				?>
				<?if(preg_match('/etax.php/',$menu['value'][$i][$j]) && !$godo[tax]){?>
				<img src="../img/btn_nouse.gif" align="absmiddle" />
				<?}?>
				</li>
			<? }} ?>
		</ul>
		<?}}?>
		</div>

		<?if($_SERVER['HTTPS'] != 'on'){?>
		<div id="panelside" style="padding-left:7px"><script>panel('panelside', '<?=$section?>');</script></div>
		<?}?>

		</td>
	</tr>
	</table>

	</td>

	<!-------------------- 전체 보기 용 ------------------------------->
	<td width="19" style="background:url('../img/icon_menuon_bg.gif') repeat-y;" valign="top" id="sub_left_menu" style="display:none">
		<img id="btn_menu" src="../img/icon_menuon.gif" class="hand" onClick="hiddenLeft();" style="display:none;" />
	</td>
	<!------------------------------------------------------------------>
	<!-------------------- 서브 본문 맨상단시작, 네비, 배너 ------------------------------->
	<td valign="top" height="100%" width="100%" style="background:url('../img/sub_topback.gif') repeat-x;">

	<!--------------  Location 시작 ------------------->
	<div style="padding:16px 0 3px 0; margin:0 0 6px 6px; border-bottom:solid 1px #e6e6e6;">
		<img src="../img/b_home.gif"/><span id="location" style="font-family:Dotum; font-size:11px; color:#444444;"><span style="color:#888888">HOME</span> > <?=$location?></span>
	</div>
	<!--------------  Location 끝 ------------------->

	<!-------------------- 서브 본문 본격적으로 시작  ------------------------------->
	<table width="100%" cellpadding="0" cellspacing="0" bgcolor="white" border="0">
	<tr>
		<td valign="top" style="padding-left:6px; padding-right:6px;">

<? } else { # 메인인경우 ?>
<tr>
	<td height="100%" valign="top" style="padding-left:0;background:url('../img/bg_right_memo_top.gif') repeat-x #f5f5f5;">

	<table width="100%" height="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td valign="top">
<? } ?>

<?
### 페이지접근 제어
if ($mn->isAccess() === false){
?>
<table cellpadding="0" cellspacing="0" border="0" id="errBox" background="http://www.godo.co.kr/userinterface/img/trans_guide_back.gif" width="394" height="201">
<tr>
	<td valign="middle" align="center">
	<div style="padding-top:3px;"><font color="#444444">이 기능은 현재 사용하고 계신<br /> [<font color="green"><b><?=$godo['ecName']?></b></font>] 에서는 지원하지 않습니다.</div>
	<div style="padding-top:7px;"><a href="http://www.godo.co.kr/service/sub_06_marketing.php" target="_new"><font color="#0074ba"><b>[고도몰 부가서비스 살펴보기]</b></font></a></div>
	</td>
</tr>
</table>
<?
	include "../_footer.php";
	exit;
}

?>
