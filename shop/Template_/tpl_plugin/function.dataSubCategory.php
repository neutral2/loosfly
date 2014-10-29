<?php

/* Return Sub Category Data Function */

function dataSubCategory( $parentcategory, $gcntyn=false ){

	global $db, $sess;

	# 카테고리 정보
	for ($i=0;$i<2;$i++){
		$length = strlen($parentcategory) + 3;
		$query = "
		select
			category,catnm,sort,level,level_auth
		from
			".GD_CATEGORY."
		where
			category like '$parentcategory%'
			and length(category)=$length
		";
		if ($GLOBALS[ici_admin] === false) $query .= "and hidden=0";
		$res = $db->query($query);

		if ($db->count_($res)) break;
		else if ($length>6) $parentcategory = substr($parentcategory,0,-3);
	}

	### 상품 개수 추출
	if ( $gcntyn == true ){
		if ($GLOBALS[ici_admin] === false) $where[] = "a.hidden=0";
		$where[] = "a.category like '$parentcategory%'";
		$where[] = "open";
		if ($GLOBALS['tpl']->var_['']['connInterpark']) $where[] = "b.inpk_prdno!=''";

		$query = "
		select
			left(category,$length),count(distinct a.goodsno)
		from
			".GD_GOODS_LINK." a,
			".GD_GOODS." b
		where
			a.goodsno = b.goodsno
			and ".implode(" and ", $where)."
		group by left(category,$length)
		";
		$res2 = $db->query($query);
		while ($data2=$db->fetch($res2)) $gcnt[$data2[0]] = $data2[1];
	}

	### 데이타 조작
	$i = 0;
	while ($data=$db->fetch($res)){
		$member_auth = false;
		if($data['level']){//권한 설정되어 있는지 체크
			switch($data['level_auth']){//권한체크
				case '1': //모두숨김
					if( (!$sess['level'] ? 0 : $sess['level']) >= $data['level'] ) $member_auth = true;
					break;
				default: $member_auth = true; break;
			}
		}
		else $member_auth = true;

		if($member_auth){
			$data['gcnt'] = $gcnt[ $data['category'] ];
			$cate[$data[sort]][] = $data;
		}
	}

	### 배열 순서 재정의
	if ($cate) $cate = resort($cate);

	return $cate;
}
?>