<?
include "../lib/library.php";
include "../conf/config.php";

if($_POST[resno][0])$resno1 = md5($_POST[resno][0]);
if($_POST[resno][1])$resno2 = md5($_POST[resno][1]);

### �Ǹ� ���� üũ
if ($_POST[mode]=="chkRealName"){

	header ("Cache-Control: no-cache, must-revalidate");
	header ("Pragma: no-cache");

	include "../conf/fieldset.php";

	if ( $realname[useyn] == 'y' && !empty($realname[id]) ){
		if ($_POST[resno][0] && $_POST[resno][1]){
			list ($chk) = $db->fetch("select * from ".GD_MEMBER." where resno1='$resno1' and resno2='$resno2'");
			if ($chk) msg("������ �ֹε�Ϲ�ȣ�� �̹� ������ �Ǿ� �ֽ��ϴ�",0);
		}

		require_once( "./realname/RNCheckRequest.php" );
		exit;
	}

	echo "
	<script>
	parent.document.frmAgree.action = '';
	parent.document.frmAgree.target = '';
	parent.document.frmAgree.submit();
	</script>
	";
	exit;
}

### ���̵� üũ
if ($_GET[mode]=="chkId"){
	include "../conf/fieldset.php";

	### ���̵� �Է�����
	if (preg_match('/^[\xa1-\xfea-zA-Z0-9_-]{4,20}$/',$_GET['m_id']) == 0) {
		msg('���̵� �Է� ���� �����Դϴ�');
		exit;
	}

	### �ź� ���̵� ���͸�
	if (find_in_set(strtoupper($_GET[m_id]),strtoupper($joinset[unableid]))){
		msg("��� �Ұ����� ���̵��Դϴ�");
		exit;
	}

	list ($chk) = $db->fetch("select m_id from ".GD_MEMBER." where m_id='$_GET[m_id]'");
	if ($chk) msg("�̹� ��ϵ� ���̵��Դϴ�");
	else {
		echo "<script>parent.document.frmMember.chk_id.value = 1;</script>";
		msg("����� �����մϴ�");
	}
	exit;
}

### �г��� üũ
if ($_GET[mode]=="chkNickname"){
	list ($chk) = $db->fetch("select nickname from ".GD_MEMBER." where nickname='".$_GET['nickname']."' and m_id != '".$_GET['m_id']."'");
	if ($chk){
		echo "<script>parent.document.frmMember.chk_nickname.value = '';</script>";
		msg("�̹� ��ϵ� �г����Դϴ�. �ٽ� �ۼ��� �ֽʽÿ�!");
	} else {
		echo "<script>parent.document.frmMember.chk_nickname.value = 1;</script>";
		msg("����� �����մϴ�");
	}
	exit;
}

### �̸��� üũ
if ($_GET[mode]=="chkEmail"){
	list ($chk) = $db->fetch("select email from ".GD_MEMBER." where email='$_GET[email]' and m_id != '".$_GET['m_id']."'");
	if ($chk){
		echo "<script>parent.document.frmMember.chk_email.value = '';</script>";
		msg("�̹� ��ϵ� �̸����Դϴ�. �ٽ� �ۼ��� �ֽʽÿ�!");
	} else {
		echo "<script>parent.document.frmMember.chk_email.value = 1;</script>";
		msg("����� �����մϴ�");
	}
	exit;
}

### ���� �缳��
if ($_POST[birth]) $birth = trim(sprintf("%02d%02d",$_POST[birth][0],$_POST[birth][1]));
$zipcode  = @implode("-",$_POST[zipcode]);
$phone	  = @implode("-",$_POST[phone]);
$mobile   = @implode("-",$_POST[mobile]);
$fax	  = @implode("-",$_POST[fax]);
$_POST[busino] = preg_replace("/[^0-9-]+/","",$_POST[busino]);
if (is_array($_POST[interest])) $interest = array_sum($_POST[interest]);
if ($_POST[marridate]) $_POST[marridate] = trim(sprintf("%4d%02d%02d",$_POST[marridate][0],$_POST[marridate][1],$_POST[marridate][2]));
$mailling  = ($_POST[mailling]) ? "y" : "n";
$sms	   = ($_POST[sms]) ? "y" : "n";
$private1  = ($_POST[private1]) ? "y" : "n";
$private2  = ($_POST[private2]) ? "y" : "n";
$private3  = ($_POST[private3]) ? "y" : "n";

$qr = "
name		= '$_POST[name]',
nickname	= '$_POST[nickname]',
sex			= '$_POST[sex]',
birth_year	= '$_POST[birth_year]',
birth		= '$birth',
calendar	= '$_POST[calendar]',
email		= '$_POST[email]',
zipcode		= '$zipcode',
address		= '$_POST[address]',
road_address= '$_POST[road_address]',
address_sub	= '$_POST[address_sub]',
phone		= '$phone',
mobile		= '$mobile',
fax			= '$fax',
company		= '$_POST[company]',
service		= '$_POST[service]',
item		= '$_POST[item]',
busino		= '$_POST[busino]',
mailling	= '$mailling',
sms			= '$sms',
marriyn		= '$_POST[marriyn]',
marridate	= '$_POST[marridate]',
job			= '$_POST[job]',
interest	= '$interest',
memo		= '$_POST[memo]',
ex1			= '$_POST[ex1]',
ex2			= '$_POST[ex2]',
ex3			= '$_POST[ex3]',
ex4			= '$_POST[ex4]',
ex5			= '$_POST[ex5]',
ex6			= '$_POST[ex6]',
private1	= '$_POST[private1]',
private2	= '$_POST[private2]',
private3	= '$_POST[private3]'
";

switch ($_POST[mode]){

	case "modMember":

		### �ߺ� �α��� ���� üũ
		if ($_POST['m_id'] != $sess[m_id]) msg("�α��� ���� ������ �ߺ��Ǿ����ϴ�. �ٽ� �α����Ͽ� �ֽʽÿ�.","./logout.php");

		### �г��� �ߺ����� üũ
		list ($chk) = $db->fetch("select nickname from ".GD_MEMBER." where nickname='".$_POST['nickname']."' and m_id != '".$_POST['m_id']."'");
		if ($chk) msg("�̹� ��ϵ� �г����Դϴ�",-1);

		if ($_POST['rncheck'] != "ipin") {
			### �ֹε�Ϲ�ȣ �ߺ����� üũ
			list ($chk) = $db->fetch("select resno1 from ".GD_MEMBER." where resno1='$resno1' and resno2='$resno2'");
			if ($resno1 && $resno2 && $chk) msg("�̹� ��ϵ� �ֹε�Ϲ�ȣ�Դϴ�",'join.php');
			else if ($resno1 && $resno2) $qr .= ", resno1 = '$resno1', resno2 = '$resno2'";

			### �ֹι�ȣ�� ���� üũ
			if ($_POST[resno][1] && $_POST[sex]) {
				$resno_01 = substr($_POST[resno][1], 0, 1);
				if ( ( ($resno_01 == "2" || $resno_01 == "4") && $_POST[sex]=="m") || ( ($resno_01 == "1" || $resno_01 == "3") && $_POST[sex]=="w") ){
					msg("�ֹε�Ϲ�ȣ�� ������ ��ġ���� �ʽ��ϴ�.", -1);
					exit;
				}
			}
		}

		### ��й�ȣ �˻�
		if($_POST['newPassword']) {

			list ($chk) = $db->fetch("SELECT COUNT(m_id) FROM ".GD_MEMBER." WHERE m_id = '".$_POST['m_id']."' AND password in (PASSWORD('".$_POST['originalPassword']."'),OLD_PASSWORD('".$_POST['originalPassword']."'),MD5('".$_POST['originalPassword']."'))");
			if (!$chk) msg("���� ��й�ȣ�� ��Ȯ�ϰ� �Է��Ͽ� �ּ���.", -1);

			// ��� ���� ���� (6�� �̻� 21~7E ���� ascii)
			if (!preg_match('/^[\x21-\x7E]{6,}$/',$_POST['newPassword'])) msg("����� �Ұ����� ��й�ȣ �Դϴ�.", -1);

			$password_query = " ,password = password('".$_POST['newPassword']."'), password_moddt = NOW() ";
		}
		else {
			$password_query = "";
		}


		### �̸��� �ߺ����� üũ
		list ($chk) = $db->fetch("select email from ".GD_MEMBER." where email='".$_POST['email']."' and m_id != '".$_POST['m_id']."'");
		if ($chk) msg("�̹� ��ϵ� �̸����Դϴ�",-1);

		$query = " update ".GD_MEMBER." set ";
		if($_POST['dupeinfo']) $query .= " dupeinfo	= '".$_POST['dupeinfo']."', rncheck = 'ipin', ";
		$query .= $qr;
		$query .= $password_query;
		$query .= " where m_no = '$sess[m_no]' ";

		if($db->query($query)){

			### �����̼� ������û ���� �з�
			if (isset($_POST['interest_category'])) {
				// ���� ��û ������ �ִ°�?
				if (($subscribe = $db->fetch("SELECT sno FROM ".GD_TODAYSHOP_SUBSCRIBE." WHERE m_id = '".$sess['m_id']."'",1)) != false) {
					// update
					$query = "
					UPDATE ".GD_TODAYSHOP_SUBSCRIBE." SET
						category = '".$_POST['interest_category']."'
					WHERE m_id = '".$sess['m_id']."'
					";
				}
				else {
					// insert
					$query = "
					INSERT INTO ".GD_TODAYSHOP_SUBSCRIBE." SET
						m_id = '".$sess['m_id']."',
						category = '".$_POST['interest_category']."'
					";
				}
				$db->query($query);
			}

			### ���̹� üũ�ƿ� ȸ������ - �������� �������� öȸ
			@include "../conf/naverCheckout.cfg.php";
			if($checkoutCfg['useYn']=='y'):
				if (isset($_POST['ncCancelAgreement']) && $_POST['ncCancelAgreement'] == 'y') {
					naverCheckoutHack($sess['m_no']);
				}
			endif;

			$_SESSION['sess']['endConfirm'] = 'y';

			// ȸ������ ���� �̺�Ʈ
			$info_cfg = $config->load('member_info');

			if ($info_cfg['event_use'] && (int)$info_cfg['event_emoney'] > 0) {
				$now = date('Y-m-d H:i:s');
				if ( $now >= $info_cfg['event_start_date'] && $now <= $info_cfg['event_end_date'] ) {

					// ���� ����
					$query = sprintf("SELECT count(sno) from ".GD_LOG_EMONEY." where m_no = %d and memo = 'ȸ������ ���� �̺�Ʈ' and regdt between '%s' and '%s'",$sess['m_no'], $info_cfg['event_start_date'], $info_cfg['event_end_date'] );
					list($history) = $db->fetch($query);
					if ($history < 1) {

						$query = sprintf("update ".GD_MEMBER." set emoney = emoney + %d where m_no = %d", $info_cfg['event_emoney'], $sess['m_no']);
						$db->query($query);


						$query = sprintf("insert into ".GD_LOG_EMONEY." set m_no = %d, ordno = '', emoney = %d, memo = 'ȸ������ ���� �̺�Ʈ', regdt = '%s'", $sess['m_no'], $info_cfg['event_emoney'], $now);
						$db->query($query);

						msg('"ȸ���������� �̺�Ʈ"\n\n������ '.number_format($info_cfg['event_emoney']).'���� ���޵Ǿ����ϴ�.');
						break(1);	// break case "modMember"
					}
				}
			}

			msg("ȸ�������� �����Ǿ����ϴ�.");

		}
		break;

	case "joinMember":

		include "../conf/fieldset.php";
		if (!$joinset[grp]) $joinset[grp] = 1;

		### ���̵� �Է�����
		if (preg_match('/^[\xa1-\xfea-zA-Z0-9_-]{4,20}$/',$_POST['m_id']) == 0) msg('���̵� �Է� ���� �����Դϴ�','join.php');

		### �ź� ���̵� ���͸�
		if (find_in_set(strtoupper($_POST[m_id]),strtoupper($joinset[unableid]))) msg("��� �Ұ����� ���̵��Դϴ�",-1);

		### ���̵� �ߺ����� üũ
		list ($chk) = $db->fetch("select m_id from ".GD_MEMBER." where m_id='$_POST[m_id]'");
		if ($chk) msg("�̹� ��ϵ� ���̵��Դϴ�",'join.php');

		# ������ �߰�
		if ($_POST[rncheck] == "ipin") {
			### dupeinfo �� �ʵ� dupeinfo ���� ���Ѵ�.
			list ($chk) = $db->fetch("select count(*) as cnt from ".GD_MEMBER." where dupeinfo = '".$_POST['dupeinfo']."'");
			if ($chk > 0) {
				msg("�̹� ȸ������� ���Դϴ�.", 'join.php');
			}
		} else if ($_POST[rncheck] == "hpauthDream") {
			### dupeinfo �� �ʵ� dupeinfo ���� ���Ѵ�.
			list ($chk) = $db->fetch("select count(*) as cnt from ".GD_MEMBER." where dupeinfo = '".$_POST['dupeinfo']."'");
			if ($chk > 0) {
				msg("�̹� ȸ������� ���Դϴ�.", 'join.php');
			}
		} else {
			### �ֹε�Ϲ�ȣ �ߺ����� üũ
			list ($chk) = $db->fetch("select resno1 from ".GD_MEMBER." where resno1='$resno1' and resno2='$resno2'");
			if ($resno1 && $resno2 && $chk){
				msg("�̹� ��ϵ� �ֹε�Ϲ�ȣ�Դϴ�",'join.php');
			}
			### dupeinfo �����ε� üũ�Ѵ�.
			if ($_POST['dupeinfo']) {
				list ($chk) = $db->fetch("select count(*) as cnt from ".GD_MEMBER." where dupeinfo = '".$_POST['dupeinfo']."'");
				if ($chk > 0) {
					msg("�̹� ȸ������� ���Դϴ�.", 'join.php');
				}
			}
		}

		### ȸ���簡�ԱⰣ üũ
		if ( $joinset[rejoin] > 0 ){
			$rejoindt = date('Ymd', time() - (($joinset[rejoin]-1)*86400));
			list ($chk) = $db->fetch("select regdt from ".GD_LOG_HACK." where resno1='$resno1' and resno2='$resno2' and date_format( regdt, '%Y%m%d' ) >={$rejoindt} order by regdt desc limit 1");
			if($resno1 && $resno2 && $chk) msg("ȸ��Ż�� �� {$joinset[rejoin]}�� ���� �簡���� �� �����ϴ�.\\nȸ������ {$chk}�� Ż���ϼ̽��ϴ�.",-1);

			if ($_POST['dupeinfo']) {
				list ($chk) = $db->fetch("select regdt from ".GD_LOG_HACK." where dupeinfo='".$_POST['dupeinfo']."' and date_format( regdt, '%Y%m%d' ) >={$rejoindt} order by regdt desc limit 1");
				if($_POST['dupeinfo'] && $chk) msg("ȸ��Ż�� �� {$joinset[rejoin]}�� ���� �簡���� �� �����ϴ�.\\nȸ������ {$chk}�� Ż���ϼ̽��ϴ�.",-1);
			}
		}

		if ($_POST[rncheck] != "ipin") {
			### �ֹι�ȣ�� ���� üũ
			if ($_POST[resno][1] && $_POST[sex]) {
				$resno_01 = substr($_POST[resno][1], 0, 1);
				if ( ( ($resno_01 == "2" || $resno_01 == "4") && $_POST[sex]=="m") || ( ($resno_01 == "1" || $resno_01 == "3") && $_POST[sex]=="w") ){
					msg("�ֹε�Ϲ�ȣ�� ������ ��ġ���� �ʽ��ϴ�.", -1);
					exit;
				}
			}
		}

		if ($_SESSION['adult'] == 1) {
			$m_adult = 1;
		}
		else {
			$m_adult = 0;
		}

		### ����Ÿ �Է�
		$query = "
		insert into ".GD_MEMBER." set
			m_id		= '$_POST[m_id]',
			password	= password('$_POST[password]'),
			password_moddt = now(),
			status		= '$joinset[status]',
			resno1		= '$resno1',
			resno2		= '$resno2',
			emoney		= '$joinset[emoney]',
			level		= '$joinset[grp]',
			regdt		= now(),
			recommid	= '$_POST[recommid]',
			LPINFO		= '$_COOKIE[LPINFO]',
			dupeinfo	= '$_POST[dupeinfo]',
			foreigner	= '$_POST[foreigner]',
			pakey		= '$_POST[pakey]',
			rncheck		= '$_POST[rncheck]',
			m_adult		= '$m_adult',
			$qr
		";
		$db->query($query);
		$m_no = $db->lastID();

		### ���̹� üũ�ƿ�(ȸ������)
		@include "../conf/naverCheckout.cfg.php";
		if($checkoutCfg['useYn']=='y' && $checkoutCfg['ncMemberYn']=='y'):
			if ($_POST['join_inflow'] == 'NCOneClick' && isset($_SESSION['NCOneClickInfo']) && $_SESSION['NCOneClickInfo']['NCUserNo'] == $_POST['NCUserNo']) {
				$naverCheckoutAPI = Core::loader('naverCheckoutAPI');
				$res = $naverCheckoutAPI->JoinComplete($_POST[m_id], $m_no, $_SESSION['NCOneClickInfo']['NCUserNo'], $_SESSION['NCOneClickInfo']['Timestamp']);
				if ($res === true) {
					$strSQL = "UPDATE ".GD_MEMBER." SET inflow = 'naverCheckout' WHERE m_no = '".$m_no."'";
					$db->query($strSQL);
					unset($_SESSION['NCOneClickInfo']);
					$returnPath = 'member/join_ok.php?mode=nc';
				} else {
					$strSQL = "DELETE FROM ".GD_MEMBER." WHERE m_no = '".$m_no."'";
					$db->query($strSQL);
					msg('���̹�üũ�ƿ� ������ ȸ�� ���� �Ϸᰡ ���еǾ� ������ �� �����ϴ�.\n(�ΰ����񽺸� �̿����� �������� �ƴϰų� ���� ���°� �ƴմϴ�.)', 'join.php');
				}
			}
		endif;

		### ������ ���� �Է�
		$code = codeitem('point');
		$query = "
		insert into ".GD_LOG_EMONEY." set
			m_no	= '$m_no',
			emoney	= '$joinset[emoney]',
			memo	= '" . $code['01'] . "',
			regdt	= now()
		";
		$db->query($query);

		### ��õ�� ������ üũ
		if($checked['useField']['recommid'] == "checked" && $_POST['recommid']){

			# �ڱ� �ڽ��� ��õ�� ���ϰ� ó��
			if( $_POST['recommid'] != $_POST['m_id'] ){

				list ($recomm_m_id,$recomm_m_no) = $db->fetch("select m_id,m_no from ".GD_MEMBER." where m_id='".$_POST['recommid']."'");

				# ��õ���� �ִ°��
				if($recomm_m_id){

					# ��õ�ο��� ������ ����
					if($joinset['recomm_emoney'] > 0){
						$query = "
						insert into ".GD_LOG_EMONEY." set
							m_no	= '".$recomm_m_no."',
							emoney	= '".$joinset['recomm_emoney']."',
							memo	= '".$_POST['m_id']." ȸ���� ��õ���� ����Ʈ ����',
							regdt	= now()
						";
						$db->query($query);

						$strSQL = "UPDATE ".GD_MEMBER." SET emoney = emoney + '".$joinset['recomm_emoney']."' WHERE m_no = '".$recomm_m_no."'";
						$db->query($strSQL);
					}

					# ��õ�ѻ��(������) ������ ����
					if($joinset['recomm_add_emoney'] > 0){
						$query = "
						insert into ".GD_LOG_EMONEY." set
							m_no	= '".$m_no."',
							emoney	= '".$joinset['recomm_add_emoney']."',
							memo	= '".$_POST['recommid']." ȸ���� ��õ�Ͽ� ����Ʈ ����',
							regdt	= now()
						";
						$db->query($query);

						$strSQL = "UPDATE ".GD_MEMBER." SET emoney = emoney + '".$joinset['recomm_add_emoney']."' WHERE m_no = '".$m_no."'";
						$db->query($strSQL);
					}

				# ��õ���� ���°��
				} else {
					$query = "
					insert into ".GD_LOG_EMONEY." set
						m_no	= '".$m_no."',
						emoney	= '0',
						memo	= '��õ�ξ��̵��� ������ �����ȵ�',
						regdt	= now()
					";
					$db->query($query);
				}
			}
		}

		### ȸ�����Ը���
		if ( $_POST[email] && $cfg[mailyn_10] == 'y' )
		{
			$modeMail = 10;
			include "../lib/automail.class.php";
			$automail = new automail();
			$automail->_set($modeMail,$_POST[email],$cfg);
			$automail->_assign($_POST);
			$automail->_send();
		}

		### ȸ������SMS
		sendSmsCase('join',$mobile);

		### ȸ���������� �߱�
		$date = date('Y-m-d H:i:s');
		$query = "select * from ".GD_COUPON." where coupontype = 2 and (( priodtype = 1 ) or ( priodtype = 0 and sdate <= '$date' and edate >= '$date' ))";
		$res = $db->query($query);
		$couponCnt=0;
		while($data = $db->fetch($res)){

			$query = "select count(a.sno) from ".GD_COUPON_APPLY." a left join ".GD_COUPON_APPLY."member b on a.sno=b.applysno where a.couponcd='$data[couponcd]' and b.m_no = '$m_no'";
			list($cnt) = $db->fetch($query);
			if(!$cnt){
				$newapplysno = new_uniq_id('sno',GD_COUPON_APPLY);
				$query = "insert into ".GD_COUPON_APPLY." set
							sno				= '$newapplysno',
							couponcd		= '$data[couponcd]',
							membertype		= '2',
							member_grp_sno  = '',
							regdt			= now()";
				$db->query($query);

				$query = "insert into ".GD_COUPON_APPLY."member set m_no='$m_no', applysno ='$newapplysno'";
				$db->query($query);
				$couponCnt++;
			}
		}

		### �����̼� ������û ���� �з�
		if (isset($_POST['interest_category'])) {
			// ���� ��û ������ �ִ°�?
			if (($subscribe = $db->fetch("SELECT sno FROM ".GD_TODAYSHOP_SUBSCRIBE." WHERE m_id = '".$sess['m_id']."'",1)) != false) {
				// update
				$query = "
				UPDATE ".GD_TODAYSHOP_SUBSCRIBE." SET
					category = '".$_POST['interest_category']."'
				WHERE m_id = '".$sess['m_id']."'
				";
			}
			else {
				// insert
				$query = "
				INSERT INTO ".GD_TODAYSHOP_SUBSCRIBE." SET
					m_id = '".$sess['m_id']."',
					category = '".$_POST['interest_category']."'
				";
			}
			$db->query($query);
		}

		### ���� �� ���� ó��
		if($joinset['status']=='0') {
			msg("������ ������ ����ó���˴ϴ�");
			go($sitelink->link('index.php'));
		}

		### ȸ�� �α���
		$result = $session->login($_POST['m_id'],$_POST['password']);
		member_log( $session->m_id );

		### ���� �߱� �޽���
		if($couponCnt){
			msg('ȸ�� ���� ������ �߱� �Ǿ����ϴ�!');
		}

		if ($returnPath != '') {
			go($sitelink->link($returnPath));
		} else {
			go($sitelink->link('member/join_ok.php'));
		}

}

go($_SERVER[HTTP_REFERER]);

?>
