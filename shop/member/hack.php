<?

include "../_header.php"; chkMember();

if( $_POST['act'] == 'Y' && $sess && $_POST[password] ){

	extract($_POST);

	list( $cnt ) = $db->fetch("select count(password) from ".GD_MEMBER." where m_no='" . $sess['m_no'] . "' and password in (password('".$password."'),old_password('".$password."'),'".md5($password)."')");
	if ($cnt < 1) msg('��й�ȣ�� ��ġ���� �ʽ��ϴ�',-1);

	### aceī����
	$Acecounter->member_hack();
	if($Acecounter->scripts){
		echo $Acecounter->scripts;
	}

	### ���̹� üũ�ƿ�(ȸ������)
	@include "../conf/naverCheckout.cfg.php";
	if($checkoutCfg['useYn']=='y'):
		$res = naverCheckoutHack($sess['m_no']);
		if ($res['result'] === false) {
			msg('���̹�üũ�ƿ� ȸ�� öȸ�� ���еǾ� Ż���� �� �����ϴ�.'.($res['error'] ? '\n('.$res['error'].')' : ''),-1);
		}
	endif;

	if ( is_array( $outComplain ) ){
		foreach ( $outComplain as $k => $v ) $outComplain[$k] = pow( 2, $v );
		$outComplain = @array_sum($outComplain);
	}

	// Ż��α� ����
	list( $resno1, $resno2, $dupeinfo ) = $db->fetch("select resno1, resno2, dupeinfo from ".GD_MEMBER." where m_no='" . $sess['m_no'] . "'");
	$db->query("insert into ".GD_LOG_HACK." ( m_id, name, resno1, resno2, actor, itemcd, reason, ip, dupeinfo, regdt ) values ( '$sess[m_id]', '$member[name]', '$resno1', '$resno2', '1', '$outComplain', '$outComplain_text', '" . $_SERVER[REMOTE_ADDR] . "', '$dupeinfo', now() )" );


	{ // ����Ÿ ����
		$db->query("delete from ".GD_MEMBER." WHERE m_no='" . $sess['m_no'] . "'");
		$db->query("delete from ".GD_LOG_EMONEY." WHERE m_no='" . $sess['m_no'] . "'");
	}


	if ( $member[email] && $cfg[mailyn_12] == 'y'){ ### ȸ��Ż�����
		$modeMail = 12;
		include "../lib/automail.class.php";
		$automail = new automail();
		$automail->_set($modeMail,$member[email],$cfg);
		$automail->_assign('name',$member[name]);
		$automail->_send();
	}


	msg( "���������� ȸ��Ż��ó���� ���εǾ����ϴ�. \\n\\n �׵��� �̿��� �ּż� �������� �����մϴ�.", "../member/logout.php" );
}

$tpl->print_('tpl');

?>