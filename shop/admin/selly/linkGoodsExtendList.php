<?
/*********************************************************
* 파일명     :  linkGoodsSalesExtendList.php
* 프로그램명 :  판매기간 관리
* 작성자     :  이훈
* 생성일     :  2012.05.24
**********************************************************/
/*********************************************************
* 수정일     :
* 수정내용   :
**********************************************************/
$location = "셀리 > 판매기간 관리";
include "../_header.php";
include "../../lib/page.class.php";
include "../../conf/config.pay.php";
include "../../lib/sAPI.class.php";

list($cust_seq) = $db->fetch("SELECT value FROM gd_env WHERE category = 'selly' AND name = 'cust_seq'");
list($cust_cd) = $db->fetch("SELECT value FROM gd_env WHERE category = 'selly' AND name = 'cust_cd'");

if(!$cust_seq || !$cust_seq) {
	msg("셀리를 신청하고 상점 인증 등록 후에 사용가능한 서비스입니다.");
	go("./setting.php");
}

$base_delivery = $set['delivery']['default'];
$base_delivery_type = $set['delivery']['deliveryType'];

//선/착불|기본배송비|~원이상무료|착불배송메세지
$sAPI = new sAPI();

$grp_cd = Array('grp_cd'=>'MALL_CD');
$arr_mall_cd = $sAPI->getCode($grp_cd, 'hash');

$grp_cd = Array('grp_cd'=>'SALE_STATUS');
$arr_mall_status = $sAPI->getCode($grp_cd, 'hash');

$tmp_mall_set = $sAPI->getSetList();
$arr_mall_set = array();

if(is_array($tmp_mall_set) && !empty($tmp_mall_set)) {
	foreach($tmp_mall_set as $row_mall_set) {
		$arr_mall_set[$row_mall_set['mall_cd']][$row_mall_set['mall_login_in']][] = $row_mall_set;
	}
}

$arr_mall_goods_cd = $sAPI->getMallGoodsUrl();//마켓 url
$arr_mall_goods_cd = $arr_mall_goods_cd[0];

if(!$_GET['mall']) $_GET['mall'] = Array('mall0001');//페이지 로드시 옥션 기본검색

$grp_cd = Array('grp_cd' => $_GET['mall'][0]);
$arr_extend_data = $sAPI->getMallGoodsExtend($grp_cd);//마켓별 기간연장 선택
$mode = $arr_extend_data[0]['mode'];
unset($arr_extend_data[0]);

### 공백 제거
$_GET[sword] = trim($_GET[sword]);

list ($total) = $db->fetch("select count(*) from ".GD_MARKET_GOODS." WHERE link_yn='y'");

if (!$_GET[page_num]) $_GET[page_num] = 10;
$selected[page_num][$_GET[page_num]] = "selected";
$selected[skey][$_GET[skey]] = "selected";
$selected[brandno][$_GET[brandno]] = "selected";
$checked[open][$_GET[open]] = "checked";

$mall_status = $_GET['status'];
if($mall_status) {
	foreach($mall_status as $mall) {
		$checked['status'][$mall] = 'checked';
	}
}

$mall_cd = $_GET['mall'];
if($mall_cd) {
	foreach($mall_cd as $mall) {
		$selected['mall'][$mall] = 'selected';
	}
}
$mall_cd = $mall_cd[0];

$order_by = ($_GET['sort']) ? $_GET['sort'] : "-a.link_date";
$div = explode(" ",$order_by);
$flag['sort'][$div[0]] = (!preg_match("/desc$/i",$order_by)) ? "▲" : "▼";

if ($_GET[cate]){
	$category = array_notnull($_GET[cate]);
	$category = $category[count($category)-1];
}

$db_table = GD_MARKET_GOODS.' a ';
$db_table .= 'left join '.GD_GOODS.' b on a.goodsno=b.goodsno ';
$db_table .= 'left join '.GD_GOODS_OPTION.' o on a.goodsno=o.goodsno AND o.link=1 and go_is_deleted <> \'1\' ';

if ($category){//분류선택
	$db_table .= "left join ".GD_GOODS_LINK." c on a.goodsno=c.goodsno";
	$where[] = $db->_query_print('c.category like [s]', $category.'%');
}

if($_GET['brandno']) $where[] = $db->_query_print('b.brandno = [i]', $_GET['brandno']);//브랜드
if($_GET['sword']) $where[] = $db->_query_print('b.'.$_GET['skey'].' like [s]', '%'.$_GET['sword'].'%');//검색어

if($_GET['regdt'][0] && $_GET['regdt'][1]) {//상품등록일
	$tmp_sdate = substr($_GET['regdt'][0], 0, 4).'-'.substr($_GET['regdt'][0], 4, 2).'-'.substr($_GET['regdt'][0], 6, 2);
	$tmp_edate = substr($_GET['regdt'][1], 0, 4).'-'.substr($_GET['regdt'][1], 4, 2).'-'.substr($_GET['regdt'][1], 6, 2);
	$where[] = $db->_query_print('b.regdt >= [s] AND b.regdt <= [s]', $tmp_sdate.' 00:00:00', $tmp_edate.' 23:59:59');
}

if($_GET['mall']) {
	$where[] = $db->_query_print(' a.mall_cd in [v] ',$_GET['mall']);
}

if($_GET['status']) {
	$where[] = $db->_query_print(' a.sale_status in [v] ',$_GET['status']);
}

$where[] = " a.link_yn='y'";

$pg = new Page($_GET[page],$_GET[page_num]);
$pg->field = 'DISTINCT a.mall_goods_cd, a.goodsno,a.glink_idx,a.mall_cd,a.set_cd,a.sale_start_date,a.sale_end_date,a.sale_status,a.link_date,b.goodsnm,b.delivery_type,b.goods_delivery,b.updatedt,b.img_l, o.price';//검색필드

$pg->setQuery($db_table,$where,$order_by);
$pg->exec();

$res = $db->query($pg->query);

$arr_delivery_type = array(
	0 => '기본배송정책',
	1 => '무료배송',
	2 => '상품별 배송비',
	3 => '착불 배송비',
	4 => '고정 배송비',
	5 => '수량별 배송비',
);
?>

<script>

function sort(sort)
{
	var fm = document.frmList;
	fm.sort.value = sort;
	fm.submit();
}

function sort_chk(sort)
{
	if (!sort) return;
	sort = sort.replace(" ","_");
	var obj = document.getElementsByName('sort_'+sort);
	if (obj.length){
		div = obj[0].src.split('list_');
		for (i=0;i<obj.length;i++){
			chg = (div[1]=="up_off.gif") ? "up_on.gif" : "down_on.gif";
			obj[i].src = div[0] + "list_" + chg;
		}
	}
}

function all_check(name) {//마켓 링크여부 전체선택
	var obj = document.getElementsByName(name);
	chkBox(document.getElementsByName(name),obj[0].checked);
}

var popup_no = 0;
function frm_check(mode) {
	if(!mode) {
		alert('기간연장을 지원하지 않는 마켓입니다..');
		return;
	}

	popup_return('_blank.php', 'elink_pop'+popup_no, 800, 700, '', '', 1);//, left, top, scrollbars )
	var fm = document.frmGoodsList;
		fm.target = "elink_pop"+popup_no;
		fm.action = "goodsLinkPop.php";
		fm.submit();
	popup_no ++;
}

function extendSetShow(val) {
	switch(val) {
		case "none": {
			document.getElementById('sale_term_start').disabled = true;
			document.getElementById('sale_term_end').disabled = true;

			break;
		}
		case "set" : {
			document.getElementById('sale_term_start').disabled = false;
			document.getElementById('sale_term_end').disabled = false;
			break;
		}
	}
}

window.onload = function(){ sort_chk('<?=$_GET[sort]?>'); }

</script>

<form name="frmList">
	<input type="hidden" name="sort" value="<?=$_GET['sort']?>">
	<div class="title title_top">판매기간 관리<span>판매종료된 상품의 판매기간을 연장할 수 있는 리스트 입니다.</span> <a href="javascript:manual('<?=$guideUrl?>board/view.php?id=selly&no=10')"><img src="../img/btn_q.gif" border="0" align="absmiddle" hspace="2"></a></div>

	<table class="tb">
		<col class="cellC"><col class="cellL" style="width:500px">
		<col class="cellC"><col class="cellL">
		<tr>
			<td>분류선택</td>
			<td colspan="3"><script>new categoryBox('cate[]',4,'<?=$category?>');</script></td>
		</tr>
		<tr>
			<td>검색어</td>
			<td colspan="3">
			<select name="skey">
				<option value="goodsnm" <?=$selected['skey']['goodsnm']?>>상품명
				<option value="a.goodsno" <?=$selected['skey']['a.goodsno']?>>고유번호
				<option value="goodscd" <?=$selected['skey']['goodscd']?>>상품코드
				<option value="keyword" <?=$selected['skey']['keyword']?>>유사검색어
			</select>
			<input type=text name="sword" value="<?=$_GET['sword']?>" class="line" style="height:22px">
			</td>
		</tr>
		<tr>
			<td>상품등록일</td>
			<td>
				<input type=text name="regdt[]" value="<?=$_GET['regdt'][0]?>" onclick="calendar(event)" onkeydown="onlynumber()" class="cline"> -
				<input type=text name="regdt[]" value="<?=$_GET['regdt'][1]?>" onclick="calendar(event)" onkeydown="onlynumber()" class="cline">
				<a href="javascript:setDate('regdt[]',<?=date('Ymd')?>,<?=date('Ymd')?>)"><img src="../img/sicon_today.gif" align=absmiddle></a>
				<a href="javascript:setDate('regdt[]',<?=date('Ymd',strtotime('-7 day'))?>,<?=date('Ymd')?>)"><img src="../img/sicon_week.gif" align="absmiddle"></a>
				<a href="javascript:setDate('regdt[]',<?=date('Ymd',strtotime('-15 day'))?>,<?=date('Ymd')?>)"><img src="../img/sicon_twoweek.gif" align="absmiddle"></a>
				<a href="javascript:setDate('regdt[]',<?=date('Ymd',strtotime('-1 month'))?>,<?=date('Ymd')?>)"><img src="../img/sicon_month.gif" align="absmiddle"></a>
				<a href="javascript:setDate('regdt[]',<?=date('Ymd',strtotime('-2 month'))?>,<?=date('Ymd')?>)"><img src="../img/sicon_twomonth.gif" align="absmiddle"></a>
				<a href="javascript:setDate('regdt[]')"><img src="../img/sicon_all.gif" align=absmiddle></a>
			</td>
			<td>브랜드</td>
			<td>
				<select name="brandno">
					<option value="">-- 브랜드 선택 --</option>
					<?
					$bRes = $db->query("select * from gd_goods_brand order by sort");
					while ($tmp=$db->fetch($bRes)){ ?>
						<option value="<?=$tmp[sno]?>" <?=$selected[brandno][$tmp[sno]]?>><?=$tmp[brandnm]?></option>
					<? } ?>
				</select>
			</td>
		</tr>
		<tr>
			<td>마켓 판매상태</td>
			<td class=noline colspan="3">
				<label><input type="checkbox" name="status[]" value="all" <?=$checked['status']['all']?> onclick="all_check('status[]')">전체</label>
				<? if(is_array($arr_mall_status) && !empty($arr_mall_status)) { ?>
				<? foreach($arr_mall_status as $key => $val) {?>
					<label><input type="checkbox" name="status[]" value="<?=$key?>" <?=$checked['status'][$key]?>><?=$val?></label>
				<? } ?>
				<? } ?>
			</td>
		</tr>
		<tr>
			<td>링크 마켓</td>
			<td class=noline colspan="3">
				<select name='mall[]'>
				<? if(is_array($arr_mall_cd) && !empty($arr_mall_cd)) { ?>
				<? foreach($arr_mall_cd as $key => $val) {?>
					<? if($key == 'mall0005') continue; ?>
					<option value="<?=$key?>" <?=$selected['mall'][$key]?>><?=$val?></option>
				<? } ?>
				<? } ?>
				</select>
			</td>
		</tr>
	</table>

	<div class="button_top"><input type="image" src="../img/btn_search2.gif"></div>

	<div style="padding-top:15px"></div>

	<table width="100%" cellpadding="0" cellspacing="0">
		<tr>
			<td class="pageInfo"><font class="ver8">
			총 <b><?=$total?></b>개, 검색 <b><?=$pg->recode['total']?></b>개, <b><?=$pg->page['now']?></b> of <?=$pg->page['total']?> Pages
			</td>
			<td align="right">
			<table cellpadding="0" cellspacing="0" border="0">
			<tr>
				<td valign="bottom">
				<img src="../img/sname_date.gif"><a href="javascript:sort('regdt desc')"><img name="sort_regdt_desc" src="../img/list_up_off.gif"></a><a href="javascript:sort('regdt')"><img name="sort_regdt" src="../img/list_down_off.gif"></a><img src="../img/sname_dot.gif"><img src="../img/sname_product.gif"><a href="javascript:sort('goodsnm desc')"><img name="sort_goodsnm_desc" src="../img/list_up_off.gif"></a><a href="javascript:sort('goodsnm')"><img name="sort_goodsnm" src="../img/list_down_off.gif"></a><img src="../img/sname_dot.gif"><img src="../img/sname_price.gif"><a href="javascript:sort('price desc')"><img name="sort_price_desc" src="../img/list_up_off.gif"></a><a href="javascript:sort('price')"><img name="sort_price" src="../img/list_down_off.gif"></a></td>
				<td style="padding-left:20px">
				<img src="../img/sname_output.gif" align="absmiddle">
				<select name="page_num" onchange="this.form.submit()">
				<?
				$r_pagenum = array(10,20,40,60,100);
				foreach ($r_pagenum as $v){
				?>
				<option value="<?=$v?>" <?=$selected['page_num'][$v]?>><?=$v?>개 출력
				<? } ?>
				</select>
				</td>
			</tr>
			</table>
			</td>
		</tr>
	</table>
</form>

<form name="frmGoodsList" action="" method="POST">
	<input type="hidden" name="mode" value="extend">
	<input type="hidden" name="mall_cd" value="<?=$mall_cd?>">
	<table width="100%" cellpadding="0" cellspacing="0" border="0">
		<tr><td class="rnd" colspan="12"></td></tr>
		<tr class="rndbg">
			<th width="5%"><a href="javascript:chkBox(document.getElementsByName('chk[]'),'rev')" class=white><font class=small1><b>전체선택</a></th>
			<th width="5%">마켓</th>
			<th width="10%">마켓상품코드</th>
			<th width="5%">이미지</th>
			<th width="25%">상품명</th>
			<th width="15%">세트명</th>
			<th width="8%">판매가</th>
			<th width="7%">배송구분</th>
			<th width="15%">판매기간</th>
			<th width="5%">판매상태</th>
		</tr>
		<tr><td class="rnd" colspan="12"></td></tr>

		<?
		while ($data=$db->fetch($res)) {
			if($data['sale_status'] == '0004' || ($data['goodsnm'] == '' && !$data['goodsnm'])) {
				if($data['sale_status'] == '0004') $goods_nm_show = true;
				$none_data = true;
				$disabled = 'disabled';
			}
		?>
		<tr><td height="4" colspan="12"></td></tr>
		<tr>
			<td align="center" class="noline"><!--선택-->
				<input type="checkbox" name="chk[]" <?=$disabled?> value="<?=$data['glink_idx']?>" />
				<? unset($disabled); ?>
			</td>
			<td align="center" class="noline"><!--마켓-->
				<div><font class=ver81 color=444444><?=$arr_mall_cd[$data['mall_cd']]?></div>
				<?
				if(is_array($arr_mall_set[$data['mall_cd']]) && !empty($arr_mall_set[$data['mall_cd']])) {
				foreach($arr_mall_set[$data['mall_cd']] as $set_data) {//로그인 아이디 검색
					foreach($set_data as $cnt => $set_info) {
						if($set_info['set_cd'] == $data['set_cd']) {
							$mall_login_id = $set_info['mall_login_id'];
							$set_nm = $set_info['set_nm'];
						}
					}
				}
				}
				?>
				<div><font class=ver81 color=444444><?=$mall_login_id?></div>
			</td>
			<td align="center" class="noline"><!--마켓상품코드-->
				<div><font class=ver81 color=444444><a href="<?=str_replace('{mall_login_id}', $mall_login_id, str_replace('{mall_goods_cd}', $data['mall_goods_cd'], $arr_mall_goods_cd[$data['mall_cd']]))?>" target="_blank"><?=$data['mall_goods_cd']?></a></div>
			</td>
			<td align="center"><!--이미지-->
			<? if(!$data['img_l']) { ?>
					<input type="image" src="../../data/skin/season3/img/common/noimg_100.gif" style="width:30px;height:30px;" onclick="return false;">
			<? }
				else {
					$arr_img = explode('|', $data['img_l']);
					if(strstr($arr_img[0], 'http://')) {
						$img_url = $arr_img[0];
					}
					else {
						$img_url = '../../data/goods/'.$arr_img[0];
					}
					?>
					<input type="image" src="<?=$img_url?>" style="width:30px;height:30px;" onclick="javascript:popup('../goods/popup.register.php?mode=modify&goodsno=<?=$data['goodsno']?>',850,600); return false;">
					<?
				}
			?>
			</td>
			<td><!--상품명-->
				<? if($none_data == false || $goods_nm_show == true) { ?>
					<a href="javascript:popup('../goods/popup.register.php?mode=modify&goodsno=<?=$data['goodsno']?>',850,600)"><font color="303030"><?=$data['goodsnm']?></font></a>
				<? if ($icon){ ?><div style="padding-top:3px"><?=$icon?></div><? } ?>
				<? if ($data[runout]){ ?><div style="padding-top:3px"><img src="../../data/skin/<?=$cfg[tplSkin]?>/img/icon/good_icon_soldout.gif"></div><? } ?>
					<input type="hidden" name="goodsnm[<?=$data['glink_idx']?>]" value="<?=$data['goodsnm']?>" class="line" style="height:22px;width:60px;" />
				<? } else { ?>
					상품이 삭제되어 관리하실 수 없습니다.
				<? } ?>
			</td>
			<td align="center"><!--세트명-->
				<font class=ver81 color=444444><?=$set_nm?>
			</td>
			<td align="center"><!--판매가-->
				<? if($none_data == false || $goods_nm_show == true) {
					echo number_format($data['price']);
				} else { ?>
				-
				<? } ?>
			</td>
			<td align="center"><!--배송구분-->
				<? if($none_data == false || $goods_nm_show == true) { ?>
					<?=$arr_delivery_type[$data['delivery_type']]?>
					<? if($data['delivery_type'] >= 3) { //무료, 착불, 고정, 수량별 배송비에만 노출?>
						<?=$data['goods_delivery']?> 원
					<? } else {?>
							<?if($data['delivery_type'] == 1) {
								$goods_delivery = '0';
								$goods_delivery_type = '무료';
							} else {
								$goods_delivery = $base_delivery;
								$goods_delivery_type = '선불';
						} ?>
						<input type="hidden" name="goods_delivery[<?=$data['glink_idx']?>]" value="<?=$goods_delivery?>" />
					<? } ?>
				<? } else { ?>
				-
				<? } ?>
			</td>
			<td align=center><!--판매기간-->
				<div><font class=ver81 color=444444><?=substr($data['sale_start_date'], 0, 10)?></div>
				<div><font class=ver81 color=444444>~ <?=substr($data['sale_end_date'], 0, 10)?></div>
			</td>
			<td align=center><!--판매상태-->
				<? if($data['sale_status'] == '0001') { ?>
				<font color='#0033FF'><b><?=$arr_mall_status[$data['sale_status']]?></b></font>
				<? } else { ?>
				<font color='#CD0000'><b><?=$arr_mall_status[$data['sale_status']]?></b></font>
				<? } ?>
			</td>
		</tr>
		<tr><td height=4></td></tr>
		<tr><td colspan=12 class=rndline></td></tr>
		<? unset($none_data); ?>
		<? } ?>
	</table>

	<div align=center class=pageNavi><font class=ver8><?=$pg->page[navi]?></font></div>

	<table class=tb>
		<col class=cellC style="width:150px"><col class=cellL>
		<tr>
			<td>판매기간 연장</td>
			<td>
			<? if($mode == 'date'){ ?>
			<label><input type="radio" name="extend_set" value="none" onclick="extendSetShow(this.value);" checked="checked" /> 무기한</label>
			<label><input type="radio" name="extend_set" value="set" onclick="extendSetShow(this.value);" /> 설정함</label>
			<span name="extend_date_set">
				<input type="text" id="sale_term_start" name="sale_term_start" value="<?=date('Ymd')?>" disabled="disabled" readonly="readonly" onclick="calendar(event)" onkeydown="onlynumber()" class="cline"/> ~
				<input type="text" id="sale_term_end" name="sale_term_end" value="" disabled="disabled" readonly="readonly"  onclick="calendar(event)" onkeydown="onlynumber()" class="cline"/>
			</span>
			<? } else if($mode == 'select'){ ?>
			<input type="hidden" name="extend_term_nm" />
			<select name="extend_term">
				<option value="">== 기간을 선택해 주세요 ==</option>
				<? if(is_array($arr_extend_data) && !empty($arr_extend_data)) { ?>
				<? foreach($arr_extend_data as $row_val) { ?>
				<option value="<?=$row_val['value']?>"><?=$row_val['key']?></option>
				<? } ?>
				<? } ?>
			</select>
			<? } else if($mode == 'end_date'){ ?><!--2011-12-05 판매종료일만 선택 추가-->
			판매종료일자 : <input type="text" id="sale_term_end" name="sale_term_end" class="date" value="" readonly="readonly" onclick="calendar(event)" onkeydown="onlynumber()" class="cline" />
			<? } else { ?>
			지원불가
			<? } ?>
				<span class="noline"><input type="image" src="../img/btn_daysale.gif" align="absbottom" onclick="frm_check('<?=$mode?>');return false;" alt="판매기간 연장"></span>
			</td>
		</tr>
	</table>
</form>

<div id="MSG01">
<table cellpadding="1" cellspacing="0" border="0" class="small_ex">
<tr><td height="5"></td></tr>
<tr><td>
링크된 상품의 판매기간을 변경/연장하실 수 있습니다.<br/><br/><br/>

변경/연장할 상품을 선택 후 리스트 하단에서 기간을 선택 후 판매기간 연장 버튼을 눌러 SELLY와 마켓에 등록된 상품의 판매기간을 변경/연장하실 수 있습니다.<br/>
판매기간 관리는 마켓별로 관리를 하셔야 하며 검색조건 중 링크 마켓을 변경하여 원하는 마켓의 상품을 관리하실 수 있습니다.<br/><br/><br/>

링크된 상품을 e나무 <a href="../goods/list.php"><font color=white><u>[상품리스트]</u></font></a>에서 삭제하실 경우 더 이상 e나무에서 관리가 불가능합니다.<br/>
e나무 <a href="../goods/list.php"><font color=white><u>[상품리스트]</u></font></a>에서 상품을 삭제하신 경우 SELLY 관리자에 접속하여 관리를 하실 수 있습니다.<br/>
</td></tr>
</table>
</div>
<script>cssRound('MSG01')</script>

<? include "../_footer.php"; ?>