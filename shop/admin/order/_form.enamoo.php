<?php

list($pg) = $db->fetch("SELECT `pg` FROM `".GD_ORDER."` WHERE `ordno`=".$_GET['ordno']);
switch($pg)
{
	case 'ipay':
		require dirname(__FILE__).'/../order/_form.ipaypg.php';
		break;
	default:
		require dirname(__FILE__).'/../order/_form.php';
		break;
}

?>