<?

include "../_header.php";


if ( $_POST['mode'] == 'send' ){

	$db->query("INSERT INTO ".GD_COOPERATION." ( itemcd, name, email, title, content, regdt ) VALUES ( '" . $_POST['itemcd'] . "', '" . $_POST['name'] . "', '" . $_POST['mail'] . "', '" . $_POST['title'] . "', '" . $_POST['content'] . "', now() )");

	msg( '�����Ͻ� ������ ���۵Ǿ����ϴ�.', $_SERVER[HTTP_REFERER] );
}


$tpl->print_('tpl');

?>