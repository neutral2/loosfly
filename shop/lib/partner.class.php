<?
class Partner
{
	function getGodoCfg(){
		global $db;
		$file	= dirname(__FILE__)."/../conf/godomall.cfg.php";
		$file	= file($file);
		$godo	= decode($file[1],1);
		return $godo;
	}

	function getBasicDc(){
		global $db;
		### �⺻ ȸ�� ������
		@include dirname(__FILE__)."/../conf/fieldset.php";
		if($joinset['grp'] != ''){
			$memberdc = $db->fetch("select dc,excep,excate from ".GD_MEMBER_GRP." where level='".$joinset['grp']."' limit 1");
		}
		return $memberdc;
	}

	function getCatnm(){
		global $db;
		### ī�װ��� �迭
		$query = "select * from ".GD_CATEGORY;
		$res = $db->query($query);
		while ($data=$db->fetch($res)) $catnm[$data['category']] = $data['catnm'];
		return $catnm;
	}

	function getGoodsSql(){
		### ��ǰ ����Ÿ
		$query = "select a.*,d.*,b.category
					from ".GD_GOODS." a left join ".GD_GOODS_BRAND." d on a.brandno=d.sno, ".GD_GOODS_LINK." b";
		$where[] = "b.goodsno=a.goodsno";
		$where[] = "b.category!=''";
		$where[] = "a.open=1";
		$where[] = "a.runout=0";

		if ($where) $where = " where ".implode(" and ",$where);
		$query .= $where . ' group by a.goodsno, b.goodsno';
		return $query;
	}

	function getGoodsOption($goodsno){
		global $db;
		$query ="select price,reserve from ".GD_GOODS_OPTION." where goodsno='".$goodsno."' and link  and go_is_deleted <> '1' and go_is_display = '1' limit 1";
		$v = $db->fetch($query);
		return $v;
	}

	function getGoodsnm($partner,$param){
		### ��ǰ�� �Ӹ��� ����
		if($partner['goodshead'])$param['goodsnm'] = str_replace(array('{_maker}','{_brand}'),array($param['maker'],$param['brandnm']),$partner['goodshead']).$param['goodsnm'];
		return strip_tags($param['goodsnm']);
	}

	function getGoodsImg($img,$url){
		global $cfg;
		list($img) = explode("|",$img);
		if(preg_match('/http:\/\//',$img))$img_url = $img;
		else $img_url = $url.'/data/goods/'.$img;
		return $img_url;
	}

	function getReviewCnt($goodsno){
		global $db;
		### review ����
		$query = "select count(*) from ".GD_GOODS_REVIEW." where goodsno='".$goodsno."'";
		list($review) = $db->fetch($query);
		return $review;
	}

	function getEvent($goodsno,$tdate){
		global $db;
		$query = "select b.subject,b.sno from ".GD_EVENT." b left join ".GD_GOODS_DISPLAY." a on a.mode = concat('e',b.sno) where a.goodsno='".$goodsno."' and b.sdate <='".$tdate."' and b.edate>='".$tdate."' limit 1";
		$ret = $db->fetch($query);
		return $ret;
	}
}
?>