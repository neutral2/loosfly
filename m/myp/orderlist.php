<?php
	include dirname(__FILE__) . "/../_header.php";
	@include $shopRootDir . "/lib/page.class.php";

	chkMemberMobile();
	
	if (!$sess && !$_COOKIE[guest_ordno]) go("../mem/login.php?returnUrl=$_SERVER[PHP_SELF]");

	$db_table = "".GD_ORDER."";
	if ($sess[m_no]) $where[] = "m_no = '$sess[m_no]'";
	else {
		$where[] = "ordno = '$_COOKIE[guest_ordno]'";
		$where[] = "nameOrder = '$_COOKIE[guest_nameOrder]'";
		$where[] = "m_no = ''";
	}

	$pg = new Page($_GET[page],10);
	$pg->setQuery($db_table,$where,"ordno desc");
	$pg->exec();

	$res = $db->query($pg->query);
	while ($data=$db->fetch($res)){
		$data[str_step] = (!$data[step2]) ? $r_step[$data[step]] : $r_step2[$data[step2]];
		$data[str_settlekind] = $r_settlekind[$data[settlekind]];
		if($data[prn_settleprice]) $data[settleprice] = $data[prn_settleprice];
		$loop[] = $data;
	}

	$tpl->assign('loop',$loop);
	$tpl->assign('pg',$pg);
	$tpl->print_('tpl');
?>