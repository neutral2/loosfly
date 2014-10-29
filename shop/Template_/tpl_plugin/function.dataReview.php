<?php

/* Return Review Article Data Function */

// $limit = ��ǰ�ı� ���� ��
// $new = true �� �� ��ǰ�� �ܺ�ȣ���� �̹��� ������ ���� �� - ��Ų �� �̹��� ��� ���� �ʿ�
function dataReview($limit=5,$new=0)
{
	global $db;

	$query = "
	select *, a.regdt, a.name, a.point from
		".GD_GOODS_REVIEW." a
		left join ".GD_MEMBER." b on a.m_no=b.m_no
		left join ".GD_GOODS." c on a.goodsno=c.goodsno
	where
		sno = parent
	order by sno desc
	limit $limit
	";
	$res = $db->query($query);
	while ($data=$db->fetch($res)){
		if($new){
			if(preg_match('/^http(s)?:\/\//',$data[img_s])){
			} else if ($data[img_s]) {
				$data[img_s] = '../data/goods/'.$data[img_s];
			}
		}
		$loop[] = $data;
	}
	return $loop;
}

?>