<?

@include dirname(__FILE__) . "/../lib/library.php";

$mode = ($_POST[mode] ? $_POST[mode] : $_GET[mode] );

function spamFail() {
	global $_POST, $_SERVER;

	$str = "";
	$str .= "<script language='javascript'>";
	$str .= "alert('�ڵ���Ϲ������ڰ� ��ġ���� �ʽ��ϴ�. �ٽ� �Է��Ͽ� �ֽʽÿ�.');";
	$str .= "window.onload = function() { rtnForm.submit(); }";
	$str .= "</script>";
	$str .= "<div style='display:none;'>";
	$str .= "<form name='rtnForm' method='post' action='".$_SERVER['HTTP_REFERER']."'>";
	$str .= "<input type='text' name='email' value='".$_POST['email']."' />";
	$str .= "<input type='text' name='phone' value='".$_POST['phone']."' />";
	$str .= "<input type='text' name='secret' value='".$_POST['secret']."' />";
	$str .= "<input type='text' name='point' value='".$_POST['point']."' />";
	$str .= "<input type='text' name='subject' value='".$_POST['subject']."' />";
	$str .= "<input type='text' name='name' value='".$_POST['name']."' />";
	$str .= "<textarea name='contents'>".$_POST['contents']."</textarea>";
	$str .= "</form>";
	$str .= "</div>";
	exit($str);
}

switch($mode) {
	case "add_qna":
		@include $shopRootDir ."/conf/config.php";
		# Anti-Spam ����
		$switch = ($cfg['qnaSpamBoard']&1 ? '123' : '000') . ($cfg['qnaSpamBoard']&2 ? '4' : '0');
		$rst = antiSpam($switch, "goods/goods_qna_register.php", "post");
		if (substr($rst[code],0,1) == '4') spamFail();
		if ($rst[code] <> '0000') msg("���� ��ũ�� �����մϴ�.",-1);

		$query = "
		insert into ".GD_GOODS_QNA." set
			goodsno		= '$_POST[goodsno]',
			subject		= '$_POST[subject]',
			contents	= '$_POST[contents]',
			m_no		= '$sess[m_no]',
			name		= '$_POST[name]',
			password	= md5('$_POST[password]'),
			regdt		= now(),
			secret		= '".$_POST['secret']."',
			ip			= '$_SERVER[REMOTE_ADDR]',
			email		= '$_POST[email]',
			phone		= '$_POST[phone]',
			rcv_sms		= '$_POST[rcv_sms]',
			rcv_email	= '$_POST[rcv_email]'
		";
		$db->query($query);

		$db->query("update ".GD_GOODS_QNA." set parent=sno where sno='" . $db->lastID() . "'");
		//���Ẹ�ȼ���
		//$write_end_url = $sitelink->link("goods/indb.php?mode=add_qna_end","regular");
		msg('���������� ��ϵǾ����ϴ�',  '../goods/view.php?goodsno='.$_POST['goodsno'].'&view_area=qna');
		exit;
	break;
}

?>