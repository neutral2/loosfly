<?php
	include dirname(__FILE__) . "/../_header.php";

	### �����Ҵ�
	$goodsno = $_GET['goodsno'];

	### ��ǰ ����Ÿ
	if ($ici_admin === false) $where = "c.hidden_mobile=0 and";
	$query = "
	select a.*,b.category from
		".GD_GOODS." a
		left join ".GD_GOODS_LINK." b on a.goodsno=b.goodsno $qrTmp
		left join ".GD_CATEGORY." c on b.category=c.category
	where $where
		a.goodsno='$goodsno'
	limit 1
	";
	$data = $db->fetch($query,1);

	### ��ǰ ���� ���� üũ
	if (!$data[open_mobile]) msg("�ش��ǰ�� ������ ���� ��ǰ�� �ƴմϴ�",-1);

	### �̹��� �迭
	$data[r_img] = explode("|",$data[img_m]);
	$data[l_img] = explode("|",$data[img_l]);
	$data[t_img] = array_map("toThumb",$data[r_img]);

	### ���ø� ���
	$tpl->assign($data);
	$tpl->print_('tpl');
?>