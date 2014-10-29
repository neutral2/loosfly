<?

include "../_header.php";
include "../lib/page.class.php";
include "../conf/config.pay.php";

include "../conf/design.main.php";
@include "../conf/design_main.$cfg[tplSkin].php";
if (is_file(dirname(__FILE__) . "/../conf/config.soldout.php"))
	include dirname(__FILE__) . "/../conf/config.soldout.php";
$r_page_num = array(20,40,60,80);
if (!$_GET[page_num]) $_GET[page_num] = $lstcfg[page_num][0];
$selected[page_num][$_GET[page_num]] = "selected";
if (!$_GET[sort]) $_GET[sort] = "a.sort";

$db_table = "
".GD_GOODS_DISPLAY." a
left join ".GD_GOODS." b on a.goodsno=b.goodsno
left join ".GD_GOODS_OPTION." c on a.goodsno=c.goodsno and link
left join ".GD_GOODS_BRAND." d on b.brandno=d.sno
";

$where[] = "a.mode = '5'";
$where[] = "b.open";
if ($tpl->var_['']['connInterpark']) $where[] = "b.inpk_prdno!=''";
if( $cfg['shopMainGoodsConf'] == "E" ){
	$where[] = " a.tplSkin = '".$cfg['tplSkin']."'";
}else{
	$where[] = " (a.tplSkin = '' OR a.tplSkin IS NULL)";
}
// 품절 상품 제외
if ($cfg_soldout['exclude_main']) {
	$where[] = " !( b.runout = 1 OR (b.usestock = 'o' AND b.totstock < 1) ) ";
}
// 제외시키지 않는 다면, 맨 뒤로 보낼지를 결정
else if ($cfg_soldout['back_main']) {
	$_GET[sort] = "`soldout` ASC, ".$_GET[sort];
	$_add_field .= ",IF (b.runout = 1 , 1, IF (b.usestock = 'o' AND b.totstock = 0, 1, 0)) as `soldout`";
}
// 품절 상품을 포함하여 일반적으로 리스팅
else {
}
$pg = new Page($_GET[page],$_GET[page_num]);
$pg->field = "
distinct b.goodsno,b.*,
c.price,c.reserve,c.consumer,c.stock,d.brandnm,c.opt1,c.opt2
$_add_field
";
$pg->setQuery($db_table,$where,$_GET[sort]);
$pg->exec();

$res = $db->query($pg->query);
while ($data=$db->fetch($res)){
	$data['stock'] = $data['totstock'];
	### 실재고에 따른 자동 품절 처리
	if ($data[usestock] && $data[stock]==0) $data[runout] = 1;

	### 적립금 정책적용
	if(!$data['use_emoney']){
		if( !$set['emoney']['chk_goods_emoney'] ){
			if( $set['emoney']['goods_emoney'] ) $data['reserve'] = getDcprice($data['price'],$set['emoney']['goods_emoney'].'%');
		}else{
			$data['reserve']	= $set['emoney']['goods_emoney'];
		}
	}

	### 즉석할인쿠폰 유효성 검사
	list($data[coupon],$data[coupon_emoney]) = getCouponInfo($data[goodsno],$data[price]);
	$data[reserve] += $data[coupon_emoney];

	### 어바웃쿠폰 금액
	if($about_coupon->use){
	    $data['coupon']  += (int) getDcPrice($data['price'], $about_coupon->sale);
	}

	### 아이콘
	$data[icon] = setIcon($data[icon],$data[regdt]);

	// 출력 제어
	$loop[] = setGoodsOuputVar($data);
}

$tpl->assign(array(
			'loop'	=> $loop,
			'pg'	=> $pg,
			'slevel' => $sess['level']
			));
$tpl->print_('tpl');

?>
