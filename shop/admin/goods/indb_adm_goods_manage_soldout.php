<?
include "../lib.php";
$arTarget = isset($_POST['target']) ? $_POST['target'] : '';
$arRunout = isset($_POST['runout']) ? $_POST['runout'] : '';

$_instr['show'] = '';
$_instr['hide'] = '';

if (is_array($arTarget)) {

	// where �� �����.
	foreach ($arTarget as $key => $goodsno) {

		$isRunout = ($arRunout[$goodsno] == 1) ? true : false;

		if ($isRunout) {
			$_instr['true'] .= $goodsno.',';
		}
		else {
			$_instr['false'] .= $goodsno.',';
		}
	}

	// �� �޸� ���� �� ����..
	foreach ($_instr as $s => $in) {
		if ($in == '') continue;
		$db->query( "update ".GD_GOODS." set runout='".($s == 'true' ? 1 : 0)."' where goodsno IN (".( preg_replace('/,$/','',$in) ).")" );
	}

}

echo '
<script>
alert("����Ǿ����ϴ�.");
parent.location.reload();
</script>
';
