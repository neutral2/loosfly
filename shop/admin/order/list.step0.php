<?
$location = "�ֹ����� > �ܰ躰 �ֹ����� > �Աݴ�� ����Ʈ";
include "../_header.php";
@include "../../conf/config.pay.php";
include "../../lib/page.class.php";
@include "../../conf/phone.php";
include "../../lib/sAPI.class.php";

$sAPI = new sAPI();

$code_arr['grp_cd'] = 'mall_cd';
$selly_mall_cd = $sAPI->getcode($code_arr, 'hash');
unset($code_arr);
/**
	2011-01-13 by x-ta-c
	�� ��¥ ������ ���� �ϼ�, ��, ����� ����
	from : yyyy-mm-dd hh:ii:ss
	to : Ÿ�ӽ����� (�ٽ� ��ȯ�ؾ� �ϹǷ� �׳� Ÿ�ӽ�����)
 */
function getPassedDay($from, $to) {

	$from = strtotime(array_shift(explode(" ",$from)));	// ��¥�θ�

	$time_gap = $from - $to;

	if ($time_gap > 0)
		$suffix = '��';
	else
		$suffix = '����';

	$time_gap = abs($time_gap);

	$Y=date('Y',$time_gap)-1970;
	$m=date('n',$time_gap)-1;
	$d=date('j',$time_gap)-1;

	if($Y)
		return $Y.'�� '.$suffix;
	elseif($m)
		return $m.'�� '.$suffix;
	elseif($d)
		return $d.'�� '.$suffix;
	else
		return '-';

}	// function

if (get_magic_quotes_gpc()) {
	stripslashes_all($_POST); stripslashes_all($_GET); stripslashes_all($_COOKIE);
}

// ���� �ֹ� ����
	@include(dirname(__FILE__).'/_cfg.integrate.php');

// �⺻ ��
	$now = time();
	$today = mktime(0,0,0,date('m',$now), date('d',$now), date('Y',$now));

	if (empty($_GET)) {
		$loc = $sess['m_id'].preg_replace('/[^a-zA-Z0-9]/','_',($_SERVER['PHP_SELF']));
		list($_data) = $db->fetch("SELECT `value` FROM gd_env WHERE `category` = 'form_helper' AND `name` = 'searchCondition'");
		$data = $_data ? unserialize($_data) : array();

		if (!empty($data[$loc])) {
			parse_str( iconv('utf-8','euc-kr',urldecode($data[$loc])),$_GET );
		}
		// �Ⱓ ����
		if (!empty($_GET['regdt'][0]) && !empty($_GET['regdt'][1])) {
			$gap = abs( strtotime($_GET['regdt'][1]) - strtotime($_GET['regdt'][0]) );
			$_GET['regdt'][0] = date('Ymd',$now - $gap);
			$_GET['regdt'][1] = date('Ymd',$now);
		}
		unset($loc,$data,$_data);
	}

// ���� ������ ����
	$integrate_order = Core::loader('integrate_order');
	$integrate_order -> doSync();

// get �Ķ���� ó�� �� �⺻�� ����
	unset($_GET['x'],$_GET['y']);


	$_GET['sort']			= !empty($_GET['sort']) ? $_GET['sort'] : 'o.ord_date desc';		// ����
	$_GET['mode']			= !empty($_GET['mode']) ? $_GET['mode'] : '';					// �� ����
	$_GET['channel']		= !empty($_GET['channel']) ? $_GET['channel'] : array();			// �Ǹ�ä��
	$_GET['ord_status']		= isset($_GET['ord_status']) ? $_GET['ord_status'] : -1;	// ó������
	$_GET['pay_method']		= !empty($_GET['pay_method']) ? $_GET['pay_method'] : '';		// ��������
	$_GET['ord_type']		= !empty($_GET['ord_type']) ? $_GET['ord_type'] : '';		// ��������
	$_GET['skey']			= !empty($_GET['skey']) ? $_GET['skey'] : '';					// �ֹ��˻� ����
	$_GET['sword']			= !empty($_GET['sword']) ? trim($_GET['sword']) : '';					// �ֹ��˻� Ű����
	$_GET['dtkind']			= !empty($_GET['dtkind']) ? $_GET['dtkind'] : 'ord_date';				// ��¥ ����
	$_GET['regdt']			= !empty($_GET['regdt']) ? $_GET['regdt'] : array(date('Ymd',strtotime('-'.(int)$cfg['orderPeriod'].' day',$now)), date('Ymd',$now));					// ��¥
	$_GET['regdt_range']	= !empty($_GET['regdt']) ? $_GET['regdt'] : '';					// ��¥ �Ⱓ ( regdt[0] ���� ��ĥ )
	$_GET['regdt_time']		= !empty($_GET['regdt_time']) ? $_GET['regdt_time'] : array(-1,-1);		// �ð�
	$_GET['sgkey']			= !empty($_GET['sgkey']) ? $_GET['sgkey'] : '';					// ��ǰ�˻� ����
	$_GET['sgword']			= !empty($_GET['sgword']) ? trim($_GET['sgword']) : '';				// ��ǰ�˻� Ű����

	$_GET['flg_egg']			= !empty($_GET['flg_egg']) ? $_GET['flg_egg'] : '';					// ���ں�������

	$_GET['flg_escrow']		= !empty($_GET['flg_escrow']) ? $_GET['flg_escrow'] : '';			// ����ũ��
	$_GET['flg_cashreceipt']	= !empty($_GET['flg_cashreceipt']) ? $_GET['flg_cashreceipt'] : '';		// ���ݿ�����
	$_GET['flg_coupon']		= !empty($_GET['flg_coupon']) ? $_GET['flg_coupon'] : '';			// �������
	$_GET['flg_aboutcoupon']	= !empty($_GET['flg_aboutcoupon']) ? $_GET['flg_aboutcoupon'] : '';		// ��ٿ�����
	$_GET['pay_method_p']	= !empty($_GET['pay_method_p']) ? $_GET['pay_method_p'] : '';	// ������(����Ʈ)
	$_GET['flg_cashbag']			= !empty($_GET['flg_cashbag']) ? $_GET['flg_cashbag'] : '';					// okĳ�ù� ����

	$_GET['chk_inflow']		= !empty($_GET['chk_inflow']) ? $_GET['chk_inflow'] : array();	// ȫ��ä�� (���԰��)
	$_GET['page']			= !empty($_GET['page']) ? $_GET['page'] : 1;						// ������
	$_GET['page_num']		= !empty($_GET['page_num']) ? $_GET['page_num'] : ($cfg['orderPageNum'] ? $cfg['orderPageNum'] : 20);	// �������� ���ڵ��

	$_GET['ord_status'] = 0;	$_GET['pay_method'] = 'a';

// �˻��� ����

	#0. �ʱ�ȭ
		$arWhere = array();

	#1. �Ǹ� ä��
		$_tmp = array();

		if (sizeof($_GET['channel']) < 1 || $_GET['channel']['all']) {
			$_GET['channel'] = array();
			$_GET['channel']['all'] = 1;
		}
		elseif (sizeof($_GET['channel']) === 6) {
			$_GET['channel'] = array();
			$_GET['channel']['all'] = 1;
		}
		else {

			if ($_GET['channel']['mobile'] || $_GET['channel']['todayshop']) $_GET['channel']['enamoo'] = 1;
			foreach($_GET['channel'] as $k=>$v) {
				if ($k == 'mobile') {
					$arWhere[] = 'o.flg_mobile = \'1\'';
				}
				else if ($k == 'todayshop') {
					$arWhere[] = 'exists(SELECT * FROM '.GD_ORDER_ITEM.' AS oi JOIN '.GD_GOODS.' AS g ON oi.goodsno=g.goodsno WHERE oi.ordno=o.ordno AND g.todaygoods=\'y\')';
				}
				else {
					$_tmp[] = " o.channel = '$k' ";
				}
			}

		}

	#1-1. ���� �Ǹ� ä��
		if(!$_GET['sub_channel']['all']) {
			if(sizeof($_GET['sub_channel']) < 1) {
				$arWhere[] = " o.channel != 'selly' ";
			}
			else {
				foreach($_GET['sub_channel'] as $s_k => $s_v) {
					$_tmp[] = " (o.channel = 'selly' AND o.sub_channel = '$s_k') ";
				}
			}
		}

		if (sizeof($_tmp) > 0) $arWhere[] = '('.implode(' OR ',$_tmp).')';
		unset($_tmp);

	#2. �ֹ� ����
		// ���Ա� �̹Ƿ� ���� ó�������� ����
		$arWhere[] = "(o.ord_status = 0)";

	#3. ���� ����
		if($_GET['pay_method']) {
			$arWhere[] = $db->_query_print('o.pay_method= [s]',$_GET['pay_method']);
		}

	#4. ���� �˻�
		if($_GET['sword'] && $_GET['skey']) {
			$es_sword = $db->_escape($_GET['sword']);
			switch($_GET['skey']) {
				case 'all':
					$_where = array();

					foreach($integrate_cfg['skey'] as $cond) {
						if (preg_match($cond['pattern'],$es_sword)) {
							$_condition = $cond['field'];

							if ($cond['condition'] == 'like') $_condition .= ' like \'%'.$es_sword.'%\'';
							else if ($cond['condition'] == 'equal') $_condition .= ' = \''.$es_sword.'\'';
							else continue;

							$_where[] = $_condition;
						}
					}

					if (sizeof($_where) > 0) $arWhere[] = "(".implode(' OR ',$_where).")";
					break;
				case 'ordno': $arWhere[] = "o.ordno = '{$es_sword}'"; break;
				case 'ord_name': $arWhere[] = "o.ord_name like '%{$es_sword}%'"; break;
				case 'rcv_name': $arWhere[] = "o.rcv_name like '%{$es_sword}%'"; break;
				case 'pay_bank_name': $arWhere[] = "o.pay_bank_name like '%{$es_sword}%'"; break;
				case 'm_id': $arWhere[] = "m.m_id = '{$es_sword}'"; break;
				case 'ord_phone': $arWhere[] = "o.ord_phone like '%{$es_sword}%'"; break;
				case 'rcv_phone': $arWhere[] = "o.rcv_phone like '%{$es_sword}%'"; break;
				case 'rcv_address': $arWhere[] = "o.rcv_address like '%{$es_sword}%'"; break;
				case 'dlv_no': $arWhere[] = "o.dlv_no like '%{$es_sword}%'"; break;
			}
		}

	#5. ó������
		if($_GET['regdt'][0]) {
			if(!$_GET['regdt'][1]) $_GET['regdt'][1] = date('Ymd',$now);

			$tmp_start = substr($_GET['regdt'][0],0,4).'-'.substr($_GET['regdt'][0],4,2).'-'.substr($_GET['regdt'][0],6,2);
			$tmp_end = substr($_GET['regdt'][1],0,4).'-'.substr($_GET['regdt'][1],4,2).'-'.substr($_GET['regdt'][1],6,2);

			if ((int)$_GET['regdt_time'][0] !== -1 && (int)$_GET['regdt_time'][1] !== -1) {

				$tmp_start .= ' '.sprintf('%02d',$_GET['regdt_time'][0]).':00:00';
				$tmp_end .= ' '.sprintf('%02d',$_GET['regdt_time'][1]).':59:59';
			}
			else {
				$tmp_start .= ' 00:00:00';
				$tmp_end .= ' 23:59:59';
			}

			$arWhere[] = $db->_query_print('o.ord_date between [s] and [s]',$tmp_start,$tmp_end);

			/*switch($_GET['dtkind']) {
				case 'ord_date': $arWhere[] = $db->_query_print('o.ord_date between [s] and [s]',$tmp_start,$tmp_end); break;
				case 'pay_date': $arWhere[] = $db->_query_print('o.pay_date between [s] and [s]',$tmp_start,$tmp_end); break;
				case 'dlv_date': $arWhere[] = $db->_query_print('o.dlv_date between [s] and [s]',$tmp_start,$tmp_end); break;
				case 'fin_date': $arWhere[] = $db->_query_print('o.fin_date between [s] and [s]',$tmp_start,$tmp_end); break;
			}*/
		}

	#6. ��ǰ�˻�
		$join_GD_PURCHASE = '';
		if($_GET['sgword'] && $_GET['sgkey']) {
			$es_sgword = $db->_escape($_GET['sgword']);
			switch($_GET['sgkey']) {
				case 'goodsnm': $arWhere[] = "oi.goodsnm like '%{$es_sgword}%'"; break;
				case 'brandnm': $arWhere[] = "EXISTS (SELECT ordno FROM ".GD_ORDER_ITEM." AS _oi WHERE _oi.brandnm like '%{$es_sgword}%' AND _oi.ordno = o.ordno) "; break;
				case 'maker': $arWhere[] = "EXISTS (SELECT ordno FROM ".GD_ORDER_ITEM." AS _oi WHERE _oi.maker like '%{$es_sgword}%' AND _oi.ordno = o.ordno) "; break;
				case 'goodsno': $arWhere[] = "oi.goodsno like '%{$es_sgword}%'"; break;
				case 'purchase': $arWhere[] = "pch.comnm like '%{$es_sgword}%'"; $join_GD_PURCHASE = 'INNER JOIN '.GD_PURCHASE_GOODS.' AS pchg ON pchg.goodsno = oi.goodsno INNER JOIN '.GD_PURCHASE.' AS pch ON pchg.pchsno = pch.pchsno'; break;
			}
		}

	#7. ���ں�������
		if($_GET['flg_egg']) {
			$arWhere[] = $db->_query_print('o.flg_egg = [s]',$_GET['flg_egg']);
		}

	#8. ������ ����
		$tmp_arWhere = array();

		if($_GET['flg_escrow']) {
			$tmp_arWhere[] = $db->_query_print('o.flg_escrow = [s]',$_GET['flg_escrow']);
		}

		if($_GET['flg_cashreceipt']) {
			$tmp_arWhere[] = 'o.flg_cashreceipt != ""';
		}
		if($_GET['flg_coupon']) {
			$tmp_arWhere[] = 'co.ordno is not null';
			$join_GD_COUPON_ORDER='left join '.GD_COUPON_ORDER.' as co on o.ordno=co.ordno';
		}
		else {
			$join_GD_COUPON_ORDER='';
		}

		if($_GET['flg_aboutcoupon']=='1') {
			$tmp_arWhere[] = 'o.flg_aboutcoupon = "Y"';
		}

		if($_GET['pay_method_p']=='1') {
			$tmp_arWhere[] = 'o.pay_method= "p"';
		}

		if($_GET['flg_cashbag']=='Y') {
			$tmp_arWhere[] = 'o.flg_cashbag = "Y"';
		}

		if (sizeof($tmp_arWhere) > 0) {
			$arWhere[] = '('.implode(' OR ',$tmp_arWhere).')';
			unset($tmp_arWhere);
		}

	#9. ȫ��ä��
		if(count($_GET['chk_inflow'])) {
			$es_inflow = array();
			foreach($_GET['chk_inflow'] as $v) {
				if($v == 'naver_price') {
					$es_inflow[] = '"naver_elec"';
					$es_inflow[] = '"naver_bea"';
					$es_inflow[] = '"naver_milk"';
				}
				else {
					$es_inflow[] = '"'.$db->_escape($v).'"';
				}
			}
			$arWhere[] = 'o.flg_inflow in ('.implode(',',$es_inflow).')';
		}

	#10. �������� (���� �ʵ尡 ����, inflow ���� sugi �� ���ڵ�)
		if($_GET['ord_type'] == 'offline') {
			$arWhere[] = 'o.flg_inflow = \'sugi\'';
		}
		else if ($_GET['ord_type'] == 'online') {
			$arWhere[] = 'o.flg_inflow <> \'sugi\'';
		}

	#xx. ����¡ query ����
		$_paging_query = http_build_query($_GET);	// php5 �����Լ�. but! lib.func.php �ȿ� php4�� ����.

// ���� ����
	$db_table = "".GD_INTEGRATE_ORDER." AS o
			LEFT JOIN ".GD_INTEGRATE_ORDER_ITEM." as oi
			ON o.ordno = oi.ordno and o.channel = oi.channel
			left join ".GD_MEMBER." AS m
			ON o.m_no=m.m_no
			";
	$db_table .= $join_GD_PURCHASE;
	$orderby = $_GET['sort'];

	$pg = new Page($_GET['page'],$_GET['page_num']);
	$pg->vars['page']= $_paging_query;
	$pg->cntQuery = "SELECT count(DISTINCT o.ordno) FROM ".$db_table." WHERE ".implode(' AND ',$arWhere);
	$pg->field = "
			o.*,

			m.m_id,
			m.m_no,

			oi.goodsnm,
			oi.goodsno,
			COUNT(oi.channel) AS goodscnt
	";
	$pg->setQuery($db_table,$arWhere,$orderby,"group by o.ordno");
	$pg->exec();
	$res = $db->query($pg->query);

?>
<script type="text/javascript" src="./integrate_order_common.js"></script>

<div class="title title_top" style="position:relative;padding-bottom:15px">�Աݴ�� ����Ʈ <a href="javascript:manual('<?=$guideUrl?>board/view.php?id=order&no=25')"><img src="../img/btn_q.gif" border=0 hspace=2 align=absmiddle></a></div>

<form name="frmSearch" id="frmSearch" method="get" action="">
	<input type="hidden" name="mode" value="<?=$_GET['mode']?>"/>	<!-- �ֹ��� or �ֹ�ó���帧 -->

	<table class="tb">
	<col class="cellC"><col class="cellL" style="width:250px">
	<col class="cellC"><col class="cellL">
	<tr>
		<td><span class="small1">�Ǹ�ä��</span></td>
		<td colspan="3" class="noline">
			<label><input type="checkbox" name="channel[all]"		value="1"	onClick="nsGodoFormHelper.magic_check(this);" <?=($_GET['channel']['all'] ? 'checked' : '' )?>/>��ü</label>
			<? foreach ($integrate_cfg['channels'] as $k => $v) { 
				if($k == 'selly') continue;
				?>
				<? if( $k == 'shople') { ?>
				<label><input type="checkbox" name="channel[<?=$k?>]"	value="1" disabled/><?=$v?> <img src="../img/icon_int_order_<?=$k?>.gif" align="absmiddle"/></label>
				<? } else { ?>
				<label><input type="checkbox" name="channel[<?=$k?>]"	value="1"	onClick="nsGodoFormHelper.magic_check(this);" <?=($_GET['channel'][$k] ? 'checked' : '' )?>/><?=$v?> <img src="../img/icon_int_order_<?=$k?>.gif" align="absmiddle"/></label>
				<? } ?>
			<? } ?>
		</td>
	</tr>
	<tr>
		<td><span class="small1">����(����)</span></td>
		<td colspan="3" class="noline">
			<?  if(is_array($selly_mall_cd) && !empty($selly_mall_cd)) { ?>
			<label><input type="checkbox" name="sub_channel[all]"		value="1"	onClick="nsGodoFormHelper.magic_check(this);" <?=($_GET['sub_channel']['all'] ? 'checked' : '' )?>/>��ü <img src="../img/icon_int_order_selly.gif" align="absmiddle"/></label>
			<?
			foreach ($selly_mall_cd as $k => $v) { 
				if($k == 'mall0005') continue;
				?>
			<label><input type="checkbox" name="sub_channel[<?=$k?>]"	value="1"	onClick="nsGodoFormHelper.magic_check(this);" <?=($_GET['sub_channel'][$k] ? 'checked' : '' )?>/><?=$v?> </label>
			<? } ?>
			<div><span class="extext">����(����) �ֹ������� e������ ��ϵǾ� ���� ���� ��ǰ�� �ֹ������� �Բ� ���� �� �� �ֽ��ϴ�.</span></div>
			<? } else { ?>
				<a href="../selly/setting.php"><span class="extext">����(����) �ֹ������� �����ؼ� ���÷��� ���� ���� ��û �� �������� ���ֽñ� �ٶ��ϴ�.</span></a>
			<? } ?>
			
		</td>
	</tr>
	<tr>
		<td><span class="small1">�ֹ��˻�</span></td>
		<td colspan="3">

			<select name="ord_status">
				<option value="0" selected >�ֹ�����</option>
			</select>

			<select name="pay_method">
				<option value=""> = �������� = </option>
				<? foreach ($integrate_cfg['pay_method'] as $k=>$v) { ?>
				<? if ($k != 'a') continue; ?>
				<option value="<?=$k?>" selected><?=$v?></option>
				<? } ?>
			</select>

			<select name="ord_type">
				<option value=""> = �������� = </option>
				<option value="online" <?=$_GET['ord_type'] == 'online' ? 'selected' : ''?>>�¶�������</option>
				<option value="offline" <?=$_GET['ord_type'] == 'offline' ? 'selected' : ''?>>��������</option>
			</select>

			<select name="skey">
				<option value="all"> = ���հ˻� = </option>
				<option value="ordno"			<?=($_GET['skey'] == 'ordno') ? 'selected' : ''?>			>�ֹ���ȣ</option>
				<option value="ord_name"		<?=($_GET['skey'] == 'ord_name') ? 'selected' : ''?>		>�ֹ��ڸ�</option>
				<option value="m_id"			<?=($_GET['skey'] == 'm_id') ? 'selected' : ''?>			>�ֹ���ID</option>
				<option value="ord_phone"			<?=($_GET['skey'] == 'ord_phone') ? 'selected' : ''?>			>�ֹ��ڿ���ó</option>
				<option value="pay_bank_name"		<?=($_GET['skey'] == 'pay_bank_name') ? 'selected' : ''?>	>�Ա��ڸ�</option>
				<option value="rcv_name"	<?=($_GET['skey'] == 'rcv_name') ? 'selected' : ''?>	>�����ڸ�</option>
				<option value="rcv_phone"	<?=($_GET['skey'] == 'rcv_phone') ? 'selected' : ''?>	>�����ڿ���ó</option>
				<option value="rcv_address"	<?=($_GET['skey'] == 'rcv_address') ? 'selected' : ''?>	>������ּ�</option>
				<option value="dlv_no"	<?=($_GET['skey'] == 'dlv_no') ? 'selected' : ''?>	>�����ȣ</option>
			</select>

			<input type="text" name="sword" value="<?=htmlspecialchars($_GET['sword'])?>" class="line" />

		</td>
	</tr>
	<tr>
		<td><span class="small1">ó������</span></td>
		<td colspan="3">

			<select name="dtkind">
				<option value="ord_date"		<?=($_GET['dtkind'] == 'ord_date' ? 'selected' : '')?>		>�ֹ���</option>
				<!--option value="pay_date"			<?=($_GET['dtkind'] == 'pay_date' ? 'selected' : '')?>			>�Ա���</option>
				<option value="dlv_date"			<?=($_GET['dtkind'] == 'dlv_date' ? 'selected' : '')?>			>�����</option>
				<option value="fin_date"	<?=($_GET['dtkind'] == 'fin_date' ? 'selected' : '')?>	>��ۿϷ���</option-->
			</select>

			<input type="text" name="regdt[]" value="<?=$_GET['regdt'][0]?>" onclick="calendar(event)" size="12" class="line"/>

			<select name="regdt_time[]">
			<option value="-1">---</option>
			<? for ($i=0;$i<24;$i++) {?>
			<option value="<?=$i?>" <?=($_GET['regdt_time'][0] === $i ? 'selected' : '')?>><?=sprintf('%02d',$i)?>��</option>
			<? } ?>
			</select>
			-
			<input type="text" name="regdt[]" value="<?=$_GET['regdt'][1]?>" onclick="calendar(event)" size="12" class="line"/>
			<select name="regdt_time[]">
			<option value="-1">---</option>
			<? for ($i=0;$i<24;$i++) {?>
			<option value="<?=$i?>" <?=($_GET['regdt_time'][1] === $i ? 'selected' : '')?>><?=sprintf('%02d',$i)?>��</option>
			<? } ?>
			</select>

			<a href="javascript:setDate('regdt[]',<?=date("Ymd")?>,<?=date("Ymd")?>)"><img src="../img/sicon_today.gif" align="absmiddle"/></a>
			<a href="javascript:setDate('regdt[]',<?=date("Ymd",strtotime("-7 day"))?>,<?=date("Ymd")?>)"><img src="../img/sicon_week.gif" align="absmiddle"/></a>
			<a href="javascript:setDate('regdt[]',<?=date("Ymd",strtotime("-15 day"))?>,<?=date("Ymd")?>)"><img src="../img/sicon_twoweek.gif" align="absmiddle"/></a>
			<a href="javascript:setDate('regdt[]',<?=date("Ymd",strtotime("-1 month"))?>,<?=date("Ymd")?>)"><img src="../img/sicon_month.gif" align="absmiddle"/></a>
			<a href="javascript:setDate('regdt[]',<?=date("Ymd",strtotime("-2 month"))?>,<?=date("Ymd")?>)"><img src="../img/sicon_twomonth.gif" align="absmiddle"/></a>
			<a href="javascript:setDate('regdt[]')"><img src="../img/sicon_all.gif" align="absmiddle"/></a>

		</td>
	</tr>
	<tr class="blindable">
		<td><span class="small1">��ǰ�˻�</span></td>
		<td>
			<select name="sgkey">
				<option value="goodsnm"	<?=($_GET['sgkey'] == 'goodsnm') ? 'selected' : ''?>	>��ǰ��</option>
				<option value="goodsno"	<?=($_GET['sgkey'] == 'goodsno') ? 'selected' : ''?>	>��ǰ��ȣ</option>
				<option value="brandnm"	<?=($_GET['sgkey'] == 'brandnm') ? 'selected' : ''?>	>�귣��</option>
				<option value="maker"	<?=($_GET['sgkey'] == 'maker') ? 'selected' : ''?>		>������</option>
				<option value="purchase"	<?=($_GET['sgkey'] == 'purchase') ? 'selected' : ''?>	>����ó(����ó)</option>
			</select>
			<input type=text name="sgword" value="<?=htmlspecialchars($_GET['sgword'])?>" class="line"/>
		</td>
		<td><span class="small1">���ں�������</span> <a href="../basic/egg.intro.php"><img src="../img/btn_question.gif"/></a></td>
		<td class="noline">
			<select name="flg_egg">
				<option value=""	<?=($_GET['flg_egg'] == '') ? 'selected' : ''?>	>��ü</option>
				<option value="n"	<?=($_GET['flg_egg'] == 'n') ? 'selected' : ''?>>�̹߱�</option>
				<option value="f"	<?=($_GET['flg_egg'] == 'f') ? 'selected' : ''?>>�߱޽���</option>
				<option value="y"	<?=($_GET['flg_egg'] == 'y') ? 'selected' : ''?>>�߱޿Ϸ�</option>
			</select>
		</td>
	</tr>
	<tr class="blindable">
		<td><span class="small1">����������</span></td>
		<td colspan="3" class="noline">
			<input type="checkbox" name="flg_escrow" value="y" <?=frmChecked('y',$_GET['flg_escrow'])?>>����ũ�� <img src="../img/btn_escrow.gif" align="absmiddle"/></input>
			<input type="checkbox" name="flg_cashreceipt" value="1" <?=frmChecked('1',$_GET['flg_cashreceipt'])?>>���ݿ����� <img src="../img/icon_cash_receipt.gif"/></input>
			<input type="checkbox" name="flg_coupon" value="1" <?=frmChecked('1',$_GET['flg_coupon'])?>>�������</input>
			<input type="checkbox" name="flg_aboutcoupon" value="1" <?=frmChecked('1',$_GET['flg_aboutcoupon'])?>>��ٿ�����</input>
			<input type="checkbox" name="pay_method_p" value="1" <?=frmChecked('1',$_GET['pay_method_p'])?>>������(����Ʈ)</input>
			<input type="checkbox" name="flg_cashbag" value="Y" <?=frmChecked('Y',$_GET['flg_cashbag'])?>><img src="../img/icon_okcashbag.gif" align="absmiddle"/>OKĳ�ù�����</input>
		</td>
	</tr>
	<tr class="blindable">
		<td><span class="small1">ȫ��ä��<br>(���԰��)</span></td>
		<td colspan="3" class="noline">
			<? foreach ($integrate_cfg['inflows'] as $k=>$v) { ?>
			<label class="small1"><input type="checkbox" name="chk_inflow[]" value="<?=$k?>" <?=(in_array($k,$_GET['chk_inflow']) ? 'checked' : '')?> /><img src="../img/inflow_<?=$k?>.gif" align="absmiddle"/> <?=$v?></label>
			<? } ?>
		</td>
	</tr>
	</table>

	<div class="button_top">
	<table width="100%">
	<tr>
		<td width="35%" align="left">&nbsp;</td>
		<td width="30%" align="center"><input type="image" src="../img/btn_search2.gif"/></td>
		<td width="35%" align="right">
		<a href="javascript:void(0);" onClick="nsGodoFormHelper.save();"><img src="../img/btn_search_form_save.gif"></a>
		<a href="javascript:void(0);" onClick="nsGodoFormHelper.reset();"><img src="../img/btn_search_form_reset.gif"></a>
		<a href="javascript:void(0);" onClick="nsGodoFormHelper.toggle();"><img src="../img/btn_search_form_toggle_open.gif" id="el-godo-form-helper-toggle-btn"></a>
		</td>
	</tr>
	</table>
	</div>

	<div style="padding-top:15px"></div>

	<table width="100%" cellpadding="0" cellspacing="0">
	<tr>
		<td align="right">
		<select name="page_num" onchange="this.form.submit();">
			<?
			$r_pagenum = array(10,20,40,60,100);
			if ((int)$cfg['orderPageNum'] > 0 && !in_array((int)$cfg['orderPageNum'] ,$r_pagenum)) {
				$r_pagenum[] = (int)$cfg['orderPageNum'];
				sort($r_pagenum);
			}
			foreach ($r_pagenum as $v){
			?>
			<option value="<?=$v?>" <?=$_GET['page_num'] == $v ? 'selected' : ''?>><?=$v?>�� ���</option>
			<? } ?>
		</select>
		</td>
	</tr>
	</table>
</form>

<form name=frmList method=post action="indb.php">
	<input type="hidden" name="mode" value="integrate_multi_action">
	<input type="hidden" name="ord_status" value=""><!-- ���������ϴ� ���°� -->

	<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<col width="25"><col width="35"><col width="100"><col width="60"><col width="160"><col><col width="90"><col width="60"><col width="50"><col width="100"><col width="70">
	<tr><td class="rnd" colspan="20"></td></tr>
	<tr class="rndbg">
		<th><a href="javascript:void(0)" onClick="chkBoxAll()" class=white>����</a></th>
		<th>��ȣ</th>
		<th>�ֹ��Ͻ�</th>
		<th>�������</th>
		<th colspan="2">�ֹ���ȣ (�ֹ���ǰ)</th>
		<th>ȫ��ä��</th>
		<th>�ֹ���</th>
		<th>�Ա���</th>
		<th>�Ա�����</th>
		<th>�ֹ���</th>
	</tr>
	<tr><td class="rnd" colspan="20"></td></tr>
	<?
	$idx_grp = 0;
	$idx = $pg->idx; $pr = 1;
	while ($data=$db->fetch($res,1)){

		if ($_GET[sgword])
			list($goodsnm) = $db->fetch("select goodsnm, if({$_GET[sgkey]} LIKE '%{$_GET[sgword]}%', 0, 1) as resort from ".GD_ORDER_ITEM." where ordno='$data[ordno]' order by resort, sno");
		else
			list($goodsnm) = $db->fetch("select goodsnm from ".GD_ORDER_ITEM." where ordno='$data[ordno]' order by sno");

		if($data['goodscnt']>1) $goodsnm = $data['goodsnm'].' ��'.($data['goodscnt']-1).'��';
		else $goodsnm = $data['goodsnm'];

		$grp[settleprice][''] += $data[pay_amount];

		// ������, ���� ��ư ��Ȱ��ȭ
		if ($data['ord_status'] >= 10 OR ($data['channel'] != 'enamoo' AND $data['ord_status'] > 2)) {
			$disabled = 'disabled';
			$bgcolor = '#F0F4FF';
		}
		else {
			$disabled = '';
			$bgcolor = '#ffffff';
		}
	?>
		<tr height=25 bgcolor="<?=$bgcolor?>" bg="<?=$bgcolor?>" align=center>
			<td class=noline><input type=checkbox class="chk_ordno" name="chk[<?=$data['channel']?>][]" value="<?=$data['ordno']?>" onclick="iciSelect(this)" required label=">���û����� �����ϴ�" <?=$disabled?>></td>
			<td><font class=ver8 color=616161><?=$pr*$idx--?></font></td>
			<td><font class=ver81 color=616161><?=substr($data[ord_date],0,-3)?></font></td>
			<td><font class=ver81 color=616161><?=getPassedDay($data[ord_date],$today)?></font></td>
			<td align=left>
			<a href="view.php?ordno=<?=$data[ordno]?>"><font class=ver81 color=<?=$data['flg_inflow'] == 'sugi' ? 'ED6C0A' : '0074BA'?>><b><?=$data[ordno]?><?=$data['flg_inflow'] == 'sugi' ? '<span class="small1">(����)</span>' : ''?></b></font></a>
			<a href="javascript:popup('popup.order.php?ordno=<?=$data[ordno]?>',800,600)"><img src="../img/btn_newwindow.gif" border=0 align=absmiddle></a>
			</td>
			<td align=left>
			<div>
				<?=($data['channel'] != 'enamoo') ? '<img src="../img/icon_int_order_'.$data['channel'].'.gif" align="absmiddle">' : ''?>
				<? if (!empty($data[old_ordno])){	?><a href="javascript:popup('popup.order.php?ordno=<?=$data[ordno]?>',800,600)"><img src="../img/icon_twice_order.gif"></a><? } ?>
				<? if ($data['flg_escrow']=="y"){	?><a href="javascript:popup('popup.order.php?ordno=<?=$data[ordno]?>',800,600)"><img src="../img/btn_escrow.gif"></a><? } ?>
				<? if ($data[flg_egg]=="y"){		?><a href="javascript:popup('popup.order.php?ordno=<?=$data[ordno]?>',800,600)"><img src="../img/icon_guar_order.gif"></a><? } ?>
				<? if (!empty($data[flg_cashreceipt])){	?><img src="../img/icon_cash_receipt.gif"><? } ?>
				<? if ($data[flg_cashbag]=="Y"){		?><a href="javascript:popup('popup.order.php?ordno=<?=$data[ordno]?>',800,600)"><img src="../img/icon_okcashbag.gif" align=absmiddle></a><? } ?>
				<font class=small1 color=444444><?=$goodsnm?></font>
			</div>
			</td>
			<td><? if ($data['flg_inflow']!="" && $data['flg_inflow']!="sugi"){ ?><a href="javascript:popup('popup.order.php?ordno=<?=$data['ordno']?>',800,600)"><img src="../img/inflow_<?=$data['flg_inflow']?>.gif" align="absmiddle" alt="<?=$integrate_cfg['inflows'][$data['flg_inflow']]?>" /></a><? } ?></td>
			<td><? if ($data[m_id]) { ?><span id="navig" name="navig" m_id="<?=$data[m_id]?>" m_no="<?=$data[m_no]?>"><? } ?><font class=small1 color=0074BA>
			<b><?=$data[ord_name]?></b><? if ($data[m_id]){ ?> (<?=$data[m_id]?>)</font><? if ($data[m_id]) { ?></span><? } ?>
			<? } ?>
			</td>
			<td class=small4><?=$data[pay_bank_account]?></td>
			<td class=small4><?=$data[bankName]?></td>
			<td class=ver81><b><?=number_format($data[pay_amount])?></b></td>
		</tr>
		<tr><td colspan=20 bgcolor=E4E4E4></td></tr>
	<?
		}
		$cnt = $pr * ($idx+1);
	?>
	<tr>
		<td>

		<a href="javascript:chkBoxAll(document.getElementsByName('chk[]'),'rev')"><img src="../img/btn_allchoice.gif" border=0></a>

		</td>
		<td align=right height=30 colspan=9 style=padding-right:8>�հ�: <!--(<?=$cnt?>��)--> <font class=ver9><b><?=number_format($grp[settleprice][$preStepMsg])?></font>��</b></td>
		<td colspan=3></td>
	</tr>

	<tr bgcolor="#f7f7f7" height="30">
		<td colspan="10" align="right" style="padding-right:8px">��ü�հ� : <span class="ver9"><b><?=number_format(@array_sum($grp[settleprice]))?>��</b></span></td>
		<td colspan="3"></td>
	</tr>
	<tr><td height="4"></td></tr>
	<tr><td colspan="12" class="rndline"></td></tr>
	</table>

	<div class=pageNavi align=center><font class=ver8><?=$pg->page[navi]?></font></div>

	������ �ֹ����� :
	<a href="javascript:void(0);" onClick="fnSetOrder(1);"><img src="../img/btn_int_order_confirm.gif" align="absmiddle"></a>
	<a href="javascript:void(0);" onClick="fnRequestSMS();"><img src="../img/btn_int_order_press_pay_sms.gif" align="absmiddle"></a>
</form>

<p>


<form name="frmDnXls" method="post">
<input type="hidden" name="mode"/>
<input type="hidden" name="search" value="<? echo htmlspecialchars(serialize($_GET));?>"/>
</form>

<!-- �ֹ����� ����Ʈ&�ٿ�ε� : Start -->
<table width="100%" border="0" cellpadding="10" cellspacing="0" style="border:1px #dddddd solid;">
<tr>
	<td width="50%" align="center" bgcolor="#f6f6f6" style="font:16pt tahoma;"><img src="../img/icon_down.gif" border="0" align="absmiddle"/><b>download</b></td>
	<td width="50%" align="center" bgcolor="#f6f6f6" style="font:16pt tahoma;border-left:1px #dddddd solid;"><img src="../img/icon_down.gif" border="0" align="absmiddle"/><b>print</b></td>
</tr>
<tr>
	<td align="center">
	<table border="0" cellpadding="4" cellpadding="0" border="0">
	<tr align="center">
	<td><a href="javascript:fnExcelDownload('order')"><img src="../img/btn_order_data_order.gif" border="0"/></a></td>
	<td><a href="javascript:fnExcelDownload('goods')"><img src="../img/btn_order_data_goods.gif" border="0"/></a></td>
	</tr>
	<tr align="center">
	<td><a href="javascript:popupLayer('../data/popup.orderxls.php?mode=orderXls',550,700)"><img src="../img/btn_order_data_order_ot.gif" border="0"/></a></td>
	<td><a href="javascript:popupLayer('../data/popup.orderxls.php?mode=orderGoodsXls',550,700)"><img src="../img/btn_order_data_goods_ot.gif" border="0"/></a></td>
	</tr>
	</table>
	</td>
	<td align="center" style="border-left:1px #dddddd solid;">
	<form method="get" name="frmPrint">
	<input type="hidden" name="ordnos"/>

	<table border="0" cellpadding="4" cellpadding="0" border="0">
	<tr align="center">
	<td><select NAME="type">
	<option value="report">�ֹ�������</option>
	<option value="report_customer">�ֹ�������(������)</option>
	<option value="reception">���̿�����</option>
	<option value="tax">���ݰ�꼭</option>
	<option value="particular">�ŷ�������</option>
	</select></td>
	</tr>
	<tr>
	<td align="center"><strong class=noline><label for="r1"><input class="no_line" type="radio" name="list_type" value="list" id="r1" onclick="openLayer('psrch','none')" checked>��ϼ���</input></label>&nbsp;&nbsp;&nbsp;<label for="r2"><input class="no_line" type="radio" name="list_type" value="term" id="r2" onclick="openLayer('psrch','block')">�Ⱓ����</input></label></strong></td>
	</tr>
	<tr>
	<td align="cemter"><div style="float:left; display:none;" id="psrch">
	<input type="text" name="regdt[]" onclick="calendar(event)" size="12" class="line"/> -
	<input type="text" name="regdt[]" onclick="calendar(event)" size="12" class="line"/>
	<select name="settlekind">
	<option value=""> - ������� - </option>
	<? foreach ( $r_settlekind as $k => $v ) echo "<option value=\"{$k}\">{$v}</option>"; ?>
	</select>
	<select name="step">
	<option value=""> - �ܰ輱�� - </option>
	<? foreach ( $r_step as $k => $v ) echo "<option value=\"step_{$k}\">{$v}</option>"; ?>
	<option value="step2_1">�ֹ����</option>
	<option value="step2_2">ȯ�Ұ���</option>
	<option value="step2_3">��ǰ����</option>
	<option value="step2_50">�����õ�</option>
	<option value="step2_54">��������</option>
	</select>
	</div></td>
	</tr>
	<tr>
	<td align="center"><a href="javascript:fnOrderPrint('frmPrint', 'frmList');" style="padding-top:20px"><img src="../img/btn_print.gif" border="0" align="absmiddle"/></a></td>
	</tr>
	</table>
	</form>
	</td>
</tr>
</table>
<!-- �ֹ����� ����Ʈ : End -->

<div id=MSG01>
<table cellpadding=1 cellspacing=0 border=0 class=small_ex>
<tr><td><img src="../img/icon_list.gif" align="absmiddle">������ ������ �ֹ��� ���� �� �Աݴ�� ������ �ֹ��ǿ� ���� ����Ʈ�Դϴ�.</td></tr>
<tr><td><img src="../img/icon_list.gif" align="absmiddle">(������ �Ա�Ȯ�λ��� ���� �ֹ����� Ȯ���� �����մϴ�)</td></tr>
<tr><td><img src="../img/icon_list.gif" align="absmiddle">�˻��Ŵ� ���ǿ� �°� �Աݴ�� ������ �ֹ����� ��ȸ�� �� �ֽ��ϴ�.</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td><img src="../img/icon_list.gif" align="absmiddle">�Ա�Ȯ��ó��</td></tr>
<tr><td><img src="../img/icon_list.gif" align="absmiddle">&nbsp;&nbsp;������ ������ �ֹ��� ���� �� �Ա�Ȯ���� �� �ֹ��ǵ��� �����Ͽ� �Ա�Ȯ�� ���·� �ֹ����¸� ���� �մϴ�.</td></tr>
<tr><td><img src="../img/icon_list.gif" align="absmiddle">&nbsp;&nbsp;�ڵ��Ա�Ȯ�� ���񽺸� ������̽� ���, �ڵ����� �Ա�Ȯ��ó���� �Ǿ� �Ա�Ȯ�θ���Ʈ�� �Ѿ�ϴ�.</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td><img src="../img/icon_list.gif" align="absmiddle">�Աݿ�û SMS�߼�</td></tr>
<tr><td><img src="../img/icon_list.gif" align="absmiddle">&nbsp;&nbsp;��� ���ڸ� Ȯ�� �Ͻ� �� �Աݿ�û SMS(����)�� �߼��ϰ��� �ϴ� �ֹ����� ������ �ּ���.</td></tr>
<tr><td><img src="../img/icon_list.gif" align="absmiddle">&nbsp;&nbsp;�����Ͻ� �� �Աݿ�û SMS�߼��� �Ͻø� �ش� �������� �Աݿ�û ������ ���۵˴ϴ�.</td></tr>
<tr><td><img src="../img/icon_list.gif" align="absmiddle">&nbsp;&nbsp;�߼۵Ǵ� SMS�� ������ ������������ "ȸ������ > SMS���� >  SMS�ڵ��߼�/���� > �Աݿ�û �߼�" �������� ����/�����Ͻ� �� �ֽ��ϴ�.</td></tr>
<tr><td><img src="../img/icon_list.gif" align="absmiddle">&nbsp;&nbsp;(�߼۳��� �ϴܿ� �������� �ڵ��߼��� üũ���� ���� ��쿡�� ������ �ֹ��ǿ� SMS�� �߼۵��� �ʽ��ϴ�.)</td></tr>

</table>
</div>
<script>cssRound('MSG01')</script>

<script>window.onload = function(){ UNM.inner();};</script>
<? @include dirname(__FILE__) . "/../interpark/_order_list.php"; // ������ũ_��Ŭ��� ?>

<? include "../_footer.php"; ?>