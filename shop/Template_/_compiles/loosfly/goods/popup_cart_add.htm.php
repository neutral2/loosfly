<?php /* Template_ 2.2.7 2013/07/29 12:47:20 /www/loosfly_godo_co_kr/shop/data/skin/loosfly/goods/popup_cart_add.htm 000001903 */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Untitled Document</title>
<meta name="Generator" content="EditPlus">
<meta name="Author" content="">
<meta name="Keywords" content="">
<meta name="Description" content="">
<script src="/shop/data/skin/loosfly/common.js"></script>
<style>
	body{margin:0 auto;font:normal 18px/47px  "��������", "Nanum Gothic", "AppleGothic", "��������", "Malgun Gothic", "����", "Dotum", "Sans-serif";;}
</style>
</head>

<body>
<table width="350" height="300" cellspacing="0" cellpadding="0" style="border:#71cbd2 solid 3px">
	<tr>
		<td height="47" width="350" bgcolor="#71cbd2" style="color:#ffffff;padding-left:20px">��ٱ��� ���</td>
		<td height="47"><a href="javascript:closeCenterLayer()"><img src="/shop/data/skin/loosfly/img/jimmy/buttons/popup_close_01.gif" border="0"/></a></td>
	</tr>
	<tr>
		<td height="180" align="center" valign="middle" style="color:#747474;font-size:20px;font-weight:bold" colspan="2" >��ٱ��Ͽ� ��ҽ��ϴ�.<br/>���� Ȯ���Ͻðڽ��ϱ�?</td>
	</tr>	
	<tr>
		<td align="center" valign="middle" colspan="2">
<?php if($_REQUEST["preview"]=='y'){?>
			<a href="javascript:opener.location.href='<?php echo url("goods/goods_cart.php")?>&';self.close()" target="_top">
<?php }else{?>
			<a href="<?php echo url("goods/goods_cart.php")?>&" target="_top">
<?php }?>
			<img src="/shop/data/skin/loosfly/img/jimmy/buttons/cart_view_01.gif" border="0" /></a>
			&nbsp;&nbsp;<a href="javascript:parent.location.reload();"><img src="/shop/data/skin/loosfly/img/jimmy/buttons/continue_01.gif" border="0" /></a>
		</td>
	</tr>
</table>
</body>
</html>