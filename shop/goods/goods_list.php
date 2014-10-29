<?
if(!preg_match('/^[0-9]*$/',$_GET['category'])) exit;

$rtm[] = microtime();
include "../_header.php";
include "../lib/page.class.php";
include "../conf/config.pay.php";
if (is_file(dirname(__FILE__) . "/../conf/config.soldout.php"))
	include dirname(__FILE__) . "/../conf/config.soldout.php";
$rtm[] = microtime();

$goodsSort = Core::loader('GoodsSort');
// $_GET['category'] �Ķ���Ͱ� ���� ��츦 ���� ����Ʈ ó���� ���� �߰��Ǵ� ����
if ($_GET['category'] == ''){
	list($default_category)  = $db->fetch("select category from ".GD_CATEGORY." where level=0 and hidden=0 and length( category ) = 3 order by category limit 1");
	if (strlen($default_category) != 3) {
		msg('�з��������� ī�װ��� �������� �ʾҽ��ϴ�.',-1);
	} else {
		$_GET['category'] = $default_category;
	}
}

### ī�װ� ��ȸ ���� üũ
if($_GET['category']){
	$up_cate_chk = true;
	$tmp_category = $_GET['category'];

	while($up_cate_chk){
		list($clevel, $clevel_auth, $cauth_step, $themeNo) = $db->fetch("select level, level_auth, auth_step, themeno from ".GD_CATEGORY." where category='".$tmp_category."' limit 1");
		if($clevel){//���Ѽ�������
			if( $clevel <= $sess['level']) break;
			switch($clevel_auth){//����üũ
				case '1'://��μ���
					msg('�̿� ������ �����ϴ�.\\nȸ������� ���ų� ȸ�������� �ʿ��մϴ�.',getReferer());
					break;
				case '2'://ī�װ���
					if( (!$sess['level'] ? '0' : $sess['level']) < $clevel ) msg('�̿� ������ �����ϴ�.\\nȸ������� ���ų� ȸ�������� �ʿ��մϴ�.',getReferer());
					break;
			}
		}
		$tmp_category = substr($tmp_category, 0, strlen($tmp_category)-3);
		if( strlen($tmp_category / 3) > 1) $up_cate_chk = true;
		else $up_cate_chk = false;
	}

	$query = "select category, level, level_auth, auth_step from gd_category where category like '".$_GET['category']."%' ";
	$res = $db->_select($query);

	if(is_array($res)){
		for($i=0; $i<count($res); $i++){
			if($res[$i]['level_auth'] == '1' || $res[$i]['level_auth'] == '2') {
				$notCategory['level'][] = $res[$i]['level'];
				$notCategory['category'][] = $res[$i]['category'];
			}
		}
	}
}

### ����з���������
if ($ici_admin === false && getCateHideCnt($_GET['category']) > 0) msg('�ش�з��� ������ ���� �з��� �ƴմϴ�.',-1);

### ȯ�溯�� ȣ��
@include "../conf/category/{$_GET['category']}.php";

### ����Ʈ ���ø� �⺻ ȯ�溯��
if (!$lstcfg[cols]) $lstcfg[cols]	= 5;
if (!$lstcfg[size]) $lstcfg[size]	= $cfg[img_s];
if (!$lstcfg[tpl]) $lstcfg[tpl]	= "tpl_01";
if (!count($lstcfg[page_num])) $lstcfg[page_num] = array(20,20,32,48);

if (!$lstcfg[rcols]) $lstcfg[rcols]	= 4;
if (!$lstcfg[rsize]) $lstcfg[rsize]	= $cfg[img_s];
if (!$lstcfg[rtpl]) $lstcfg[rtpl]	= "tpl_01";
if (!$lstcfg[rpage_num] || $lstcfg[rpage_num]==0) $lstcfg[rpage_num] = 4;

// ���÷��� ���� ������
// ���ø����� �۷ι� ������ �ҷ����� �ʴ� ��� scope �� �������� �ʾ� tpl, rtplŰ�� ���� ���� ������ϴ�
$_dpCfg_keys = array('alphaRate','dOpt1','dOpt2','dOpt3','dOpt4','dOpt5','dOpt6','dOpt7','dOpt8','dOpt9','dOpt10','dOpt11');
foreach(array('rtpl','tpl') as $k => $v) {
	foreach($_dpCfg_keys as $_k => $_v) {
		$dpCfg[$v][$_v] = $lstcfg[$_v][$v];
	}
}

### �����Ҵ�
$category		= $_GET['category'];
if (!$_GET[page_num]) $_GET[page_num] = $lstcfg[page_num][0];
$selected[page_num][$_GET[page_num]] = "selected";
if (!$_GET[sort]) $_GET[sort] = "a.sort";

### ��ǰ ����Ʈ
$db_table = "
".GD_CATEGORY." AS h FORCE INDEX (idx)
STRAIGHT_JOIN ".GD_GOODS_LINK." as a on a.category = h.category
STRAIGHT_JOIN ".GD_GOODS." AS b ON ( a.goodsno = b.goodsno and b.open = 1)
STRAIGHT_JOIN ".GD_GOODS_OPTION." AS c ON ( a.goodsno = c.goodsno AND c.link = 1)
LEFT JOIN ".GD_GOODS_BRAND." AS d ON ( b.brandno = d.sno )
";

if ($ici_admin === false) $where[] = "a.hidden=0";
$where[] = "h.category like '$category%'";
if($notCategory){
	for($i=0; $i<count($notCategory['level']); $i++){
		if(!$sess['level']){//��ȸ���ϰ�� ���� ī�װ��� ����
			$where[] = "a.category not like '".$notCategory['category'][$i]."'";
		}
		else if($sess['level'] < $notCategory['level'][$i]){ //����ī�װ����� ����
			$where[] = "a.category not like '".$notCategory['category'][$i]."%'";
		}
	}
}
//$where[] = "open";	// remove to join condition.
if ($tpl->var_['']['connInterpark']) $where[] = "b.inpk_prdno!=''";

// ǰ�� ��ǰ ����
if ($cfg_soldout['exclude_category']) {
	$where[] = " !( b.runout = 1 OR (b.usestock = 'o' AND b.totstock < 1) ) ";
}
// ���ܽ�Ű�� �ʴ� �ٸ�, �� �ڷ� �������� ����
else if ($cfg_soldout['back_category']) {
	$sortField = "`soldout` ASC, ".$sortField;
	$_add_field = ",IF (b.runout = 1 , 1, IF (b.usestock = 'o' AND b.totstock = 0, 1, 0)) as `soldout`";
}
// ǰ�� ��ǰ�� �����Ͽ� �Ϲ������� ������
else {
}

// ����Ʈ �˻� �߰� ����
if($smartSearch) {
	$ssQuery = $smartSearch->ssQuery();
	if($ssQuery) $where[] = $ssQuery;
}

$pg = new Page($_GET[page],$_GET[page_num]);
$pg->cntQuery = "select count(distinct a.goodsno) from ".$db_table." where " . implode(" and ", $where);

$pg->field = "
	a.goodsno,
	b.*,
	c.price, c.reserve, c.opt1, c.opt2, c.consumer,
	d.brandnm,
	h.level, h.level_auth, h.auth_step
	$_add_field
	";

$pg->setQuery($db_table,$where,$sortField,'group by a.goodsno order by b.goodscd desc');//a.goodsno desc');
$pg->exec();

$res = $db->query($pg->query);
while ($data=$db->fetch($res)){
	$arr_goodsno[]=$data[goodsno];	##ũ���׿� �迭 �߰�
	$data['stock'] = $data['totstock'];

	### ����� ���� �ڵ� ǰ�� ó��
	if ($data[usestock] && $data[stock]==0) $data[runout] = 1;

	### ������ ��å����
	if(!$data['use_emoney']){
		if( !$set['emoney']['chk_goods_emoney'] ){
			if( $set['emoney']['goods_emoney'] ) $data['reserve'] = getDcprice($data['price'],$set['emoney']['goods_emoney'].'%');
		}else{
			$data['reserve']	= $set['emoney']['goods_emoney'];
		}
	}

	### �Ｎ�������� ��ȿ�� �˻�
	list($data[coupon],$data[coupon_emoney]) = getCouponInfo($data[goodsno],$data[price]);
	$data[reserve] += $data[coupon_emoney];

	### ��ٿ����� �ݾ�
	if($about_coupon->use){
	    $data['coupon']  += (int) getDcPrice($data['price'], $about_coupon->sale);
	}

	### ������
	$data[icon] = setIcon($data[icon],$data[regdt]);

	$cauth_step = explode(':', $data['auth_step']);
	$data['auth_step'] = array();
	$data['auth_step'][0] = (in_array('1', $cauth_step) ? 'Y' : 'N' ) ;
	$data['auth_step'][1] = (in_array('2', $cauth_step) ? 'Y' : 'N' ) ;
	$data['auth_step'][2] = (in_array('3', $cauth_step) ? 'Y' : 'N' ) ;

	$data['shortdesc'] = ($lstcfg[tpl] == "tpl_10") ? htmlspecialchars($data['shortdesc']) : $data['shortdesc'];	// ©������ ���� ����

	// ��� ����
	$loop[] = setGoodsOuputVar($data);
}

#####ũ���׿�######
$criteo = new Criteo();
if($criteo->begin()) {
	$criteo->get_list($arr_goodsno);
	$systemHeadTagEnd .= $criteo->scripts;
	$tpl->assign('systemHeadTagEnd',$systemHeadTagEnd);
}
###################


$tpl->assign(array(
			pg		=> $pg,
			loopM	=> $loop,
			lstcfg	=> $lstcfg,
			slevel	=> $sess['level'],
			));
$rtm[] = microtime();
$tpl->print_('tpl');
$rtm[] = microtime();
?>