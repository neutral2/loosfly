<?

include "../_header.php";
include "../lib/page.class.php";
include "../conf/config.pay.php";

### ����Ʈ ���ø� ȯ�� ����
$lstcfg[cols]	= 4;
$lstcfg[size]	= 80;
$lstcfg[tpl]	= "tpl_02";
$lstcfg[page_num] = array(10,20,30,50);

### �����Ҵ�
if (!$_GET[page_num]) $_GET[page_num] = $lstcfg[page_num][0];
$selected[page_num][$_GET[page_num]] = "selected";
if (!$_GET[sort]) $_GET[sort] = "a.sno";

### �ӽ� ���̺� ����
$query = "
create temporary table gd_today(
	sno	int unsigned not null auto_increment primary key,
	goodsno int
)
";
$db->query($query);

### ���ú���ǰ ����Ʈ��
$todayGoodsIdx = explode(",",$_COOKIE[todayGoodsIdx]);
foreach ($todayGoodsIdx as $v){
	if ($v) $db->query("insert into gd_today values ('',$v)");
}

### ��ǰ ����Ʈ
$pg = new Page($_GET[page],$_GET[page_num]);
$pg->field = "b.*,c.*";
$db_table = "
gd_today a,
".GD_GOODS." b,
".GD_GOODS_OPTION." c
";

$where[] = "a.goodsno=b.goodsno";
$where[] = "a.goodsno=c.goodsno";
$where[] = "link and go_is_deleted <> '1' and go_is_display = '1'";

$pg->setQuery($db_table,$where,$_GET[sort]);
$pg->exec();

$res = $db->query($pg->query);
while ($data=$db->fetch($res)){

	### ������ ��å����
	if(!$data['use_emoney']){
		if( !$set['emoney']['chk_goods_emoney'] ){
			if( $set['emoney']['goods_emoney'] ) $data['reserve'] = getDcprice($data['price'],$set['emoney']['goods_emoney'].'%');
		}else{
			$data['reserve']	= $set['emoney']['goods_emoney'];
		}
	}

	### ������
	$data[icon] = setIcon($data[icon],$data[regdt]);

	$loop[] = setGoodsOuputVar($data);

}

$tpl->assign(array(
			pg		=> $pg,
			loop	=> $loop,
			lstcfg	=> $lstcfg,
			));
$tpl->print_('tpl');

?>
