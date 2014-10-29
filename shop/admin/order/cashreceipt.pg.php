<?

include '../_header.popup.php';

if ($_GET['crno']) $_POST['crno'] = (array) $_GET['crno'];

?>

<div class="title title_top">현금영수증 <?=($_GET['mode'] == 'approval' ? '발행' : '취소')?></div>

<div style="border:solid 1px #BDBDBD; padding:1px;">
<table cellpadding="3" border="1" borderColor="#DBDBDB" bgcolor="#F9F9F9" style="border-collapse: collapse;">
<tr>
	<th>주문번호</th>
	<th>결과메시지</th>
</tr>
<?
foreach($_POST['crno'] as $k => $crno)
{
	list($ordno, $status) = $db->fetch("select ordno, status from ".GD_CASHRECEIPT." where crno='{$crno}'");
	?>
<tr>
	<td><?=$ordno?></td>
	<td>
		<iframe name="cash<?=$k?>" src="./cashreceipt.indb.php?mode=<?=$_GET['mode']?>&crno=<?=$crno?>" frameborder="0" marginwidth="0" marginheight="0" width="100%"></iframe>
	</td>
</tr>
<? } ?>
</table>
</div>