<title>���̺� ����</title>
<style>
body {background:#D6D3CE}
body,td,input {font:9pt ����}
</style>
<script>
var opener = window.dialogArguments;
</script>

<form method=post target=ifrm action="indb.php">
<input type=hidden name=mode value="insertTable">

<table width=100%>
<tr>
	<td style="font:bold 22px tahoma;padding:10 10 0 10">
	INSERT TABLE
	</td>
</tr>
<tr><td><hr></td></tr>
<tr>
	<td style="padding:0 10">

	<table width=100%>
	<tr>
		<td>
		��(CELLS) :
		<input type=text name=cols size=10 value=4>
		</td>
		<td>
		��(ROWS) : 
		<input type=text name=rows size=10 value=3>
		</td>
	</tr>
	</table>

	</td>
</tr>
<tr><td><hr></td></tr>
<tr>
	<td align=center style="padding:5">
	
	<input type=submit value="Ȯ��" style="width:100">
	<input type=button value="���" style="width:100" onclick="window.close()">
	
	</td>
</tr>
</table>

</form>

<iframe name=ifrm style="display:none"></iframe>