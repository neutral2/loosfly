<?php /* Template_ 2.2.7 2012/12/12 17:44:18 /www/loosfly_godo_co_kr/shop/data/skin_mobile/default/outline/_footer.htm 000001688 */ ?>
<footer>
	<hr class="hidden" />
<?php if($GLOBALS["mainpage"]){?>
	<ul id="fnb">
		<li><a href="<?php echo $GLOBALS["cfg"]["rootDir"]?>/?pc" title="PC�������� ����" class="btn_pcmode"><span class="hidden">PC�������� ����</span></a></li>
	</ul>
<?php }?>

	<div align='center'>
		<ul>
			<li><hr widht=100%></li>
		</ul>
		<nav class="bottom">
			<a href="<?php echo $GLOBALS["mobileRootDir"]?>/service/agrmt.php">�̿���</a>
		</nav>
		<ul>
			<li style='display:inline'><?php echo $GLOBALS["cfg"]["shopName"]?></li>
			<li style='display:inline'>|</li>
			<li style='display:inline'>��ǥ�̻�:<?php echo $GLOBALS["cfg"]["ceoName"]?></li>
		</ul>
		<ul>
			<li style='display:inline'>�ּ�:<?php echo $GLOBALS["cfg"]["address"]?></li>
		</ul>
		<ul>
			<li style='display:inline'>����ڹ�ȣ:<?php echo $GLOBALS["cfg"]["compSerial"]?></li>
			<li style='display:inline'>|</li>
			<li style='display:inline'>����Ǹž��Ű�:<?php echo $GLOBALS["cfg"]["orderSerial"]?></li>
		</ul>
		<ul>
			<li style='display:inline'>������: �Խ��ǿ� �������ּ���.</li>
		</ul>
	</div>

	<div id="copyright" style='padding-top:5'>
		<ul><li>
			COPYRIGHT (C) <span><?php echo $GLOBALS["cfg"]["shopName"]?></span> ALL RIGHTS RESERVED.</li>
		</ul>
		<ul><li>SYSTEM BY <span style='color:blue'>Godo</span>Mall</li>
		</ul>
	</div>
</footer>

</div>

<script>setTimeout(scrollTo, 0, 0, 0);</script>

<iframe id="ifrmHidden" name="ifrmHidden" src='<?php echo $GLOBALS["cfg"]["rootDir"]?>/blank.php'></iframe>

</body>
</html>