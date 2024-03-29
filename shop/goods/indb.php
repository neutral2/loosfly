<?

include "../lib/library.php";

function confirm_reload($str,$url='')
{
	if($url){
		echo "
		<script>
		alert('$str');
		if (opener){ opener.location.reload(); window.close(); }
		else location.href='$url';
		</script>
		";
	}else{
		echo "
		<script>
		alert('$str');
		if (opener){ opener.location.reload(); window.close(); }
		else parent.location.reload();
		</script>
		";
	}
	exit;
}

function spamFail() {
	global $_POST, $_SERVER;

	$str = "";
	$str .= "<script language='javascript'>";
	$str .= "alert('자동등록방지문자가 일치하지 않습니다. 다시 입력하여 주십시요.');";
	$str .= "window.onload = function() { rtnForm.submit(); }";
	$str .= "</script>";
	$str .= "<div style='display:none;'>";
	$str .= "<form name='rtnForm' method='post' action='".$_SERVER['HTTP_REFERER']."'>";
	$str .= "<input type='text' name='email' value='".$_POST['email']."' />";
	$str .= "<input type='text' name='phone' value='".$_POST['phone']."' />";
	$str .= "<input type='text' name='secret' value='".$_POST['secret']."' />";
	$str .= "<input type='text' name='point' value='".$_POST['point']."' />";
	$str .= "<input type='text' name='subject' value='".$_POST['subject']."' />";
	$str .= "<textarea name='contents'>".$_POST['contents']."</textarea>";
	$str .= "</form>";
	$str .= "</div>";
	exit($str);
}

$mode = ($_POST[mode] ? $_POST[mode] : $_GET[mode] );
if(!$_POST['secret'])$_POST['secret']=0;

if($_POST['encode'] == 'y') {
	$_POST['subject'] = iconv('utf8','euckr',urldecode($_POST['subject']));
	$_POST['contents'] = iconv('utf8','euckr',urldecode($_POST['contents']));
} else if($_POST['encode'] == 'htmlencode') { //특정 한글 호환 2013-05-08
	$_POST['subject'] = html_entity_decode($_POST['subject']);
	$_POST['contents'] = html_entity_decode($_POST['contents']);
}

switch ($mode){

	case "add_review":
		# Anti-Spam 검증
		$switch = ($cfg['reviewSpamBoard']&1 ? '123' : '000') . ($cfg['reviewSpamBoard']&2 ? '4' : '0');
		$rst = antiSpam($switch, "goods/goods_review_register.php", "post");
		if (substr($rst[code],0,1) == '4') spamFail();
		if ($rst[code] <> '0000') msg("무단 링크를 금지합니다.",-1);

		$query = "
		insert into ".GD_GOODS_REVIEW." set
			goodsno		= '$_POST[goodsno]',
			subject		= '$_POST[subject]',
			contents	= '$_POST[contents]',
			point		= '$_POST[point]',
			m_no		= '$sess[m_no]',
			name		= '$_POST[name]',
			password	= md5('$_POST[password]'),
			regdt		= now(),
			ip			= '$_SERVER[REMOTE_ADDR]'
		";
		$db->query($query);
		$sno=$db->lastID();

		$attach = 0;

		// 이미지 업로드
		if ($_FILES['attach']['error'] === UPLOAD_ERR_OK) {	// UPLOAD_ERR_OK = 0
			$file = $_FILES['attach'];
			$_ext = strtolower(array_pop(explode('.',$file['name'])));

			if (strpos('jpg gif jpeg',$_ext) !== false) {	// 허용 확장자 검사

				if ($file['error'] == 0 && $file['size'] > 0) {

					$name = 'RV'.sprintf("%010s", $sno);
					if (@move_uploaded_file($file['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/shop/data/review/'.$name)) {
						$attach = 1;
					}
				}
			}
		}

		$db->query("update ".GD_GOODS_REVIEW." set parent=sno, attach='$attach' where sno='$sno'");

		if($_POST['referer'] == 'orderview'){
			echo "<script>".
			"alert('정상적으로 등록되었습니다');".
			"opener.location.href='../goods/goods_review.php';".
			"window.close();".
			"</script>";
		}else{
			confirm_reload("정상적으로 등록되었습니다","goods_review_list.php?goodsno=".$_POST[goodsno]);
		}
		break;

	case "mod_review":

		# Anti-Spam 검증
		$switch = ($cfg['reviewSpamBoard']&1 ? '123' : '000') . ($cfg['reviewSpamBoard']&2 ? '4' : '0');
		$rst = antiSpam($switch, "goods/goods_review_register.php", "post");
		if (substr($rst[code],0,1) == '4') spamFail();
		if ($rst[code] <> '0000') msg("무단 링크를 금지합니다.",-1);

		### 접근체크
		list( $password ) = $db->fetch("select password from ".GD_GOODS_REVIEW." where sno = '$_POST[sno]'");
		if ( !isset($sess) && $password != md5($_POST[password]) ) msg($msg='비밀번호를 잘못 입력 하셨습니다.',$code=-1); // 회원전용 & 로그인전

		if ($_POST[remove_attach] == 1) {
			$name = 'RV'.sprintf("%010s", $_POST[sno]);
			@unlink($_SERVER['DOCUMENT_ROOT'].'/shop/data/review/'.$name);

			$attach_query = ", attach = '0'";
		}

		// 이미지 업로드
		if ($_FILES['attach']['error'] === UPLOAD_ERR_OK) {	// UPLOAD_ERR_OK = 0
			$file = $_FILES['attach'];
			$_ext = strtolower(array_pop(explode('.',$file['name'])));

			if (strpos('jpg gif jpeg',$_ext) !== false) {	// 허용 확장자 검사

				if ($file['error'] == 0 && $file['size'] > 0) {

					$name = 'RV'.sprintf("%010s", $_POST[sno]);
					if (@move_uploaded_file($file['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/shop/data/review/'.$name)) {

						$attach_query = ", attach = '1'";
					}
				}
			}
		}

		$query = "
		update ".GD_GOODS_REVIEW." set
			subject		= '$_POST[subject]',
			contents	= '$_POST[contents]',
			point		= '$_POST[point]',
			name		= '$_POST[name]'
			$attach_query
		where sno = '$_POST[sno]'
		";
		$db->query($query);
		confirm_reload("정상적으로 수정되었습니다");
		break;

	case "reply_review":

		$query = "
		insert into ".GD_GOODS_REVIEW." set
			goodsno		= '$_POST[goodsno]',
			subject		= '$_POST[subject]',
			contents	= '$_POST[contents]',
			parent		= '$_POST[sno]',
			m_no		= '$sess[m_no]',
			name		= '$_POST[name]',
			password	= md5('$_POST[password]'),
			regdt		= now(),
			ip			= '$_SERVER[REMOTE_ADDR]'
		";
		$db->query($query);
		$sno=$db->lastID();

		$attach = 0;

		// 이미지 업로드
		if ($_FILES['attach']['error'] === UPLOAD_ERR_OK) {	// UPLOAD_ERR_OK = 0
			$file = $_FILES['attach'];
			$_ext = strtolower(array_pop(explode('.',$file['name'])));

			if (strpos('jpg gif jpeg',$_ext) !== false) {	// 허용 확장자 검사

				if ($file['error'] == 0 && $file['size'] > 0) {

					$name = 'RV'.sprintf("%010s", $sno);
					if (@move_uploaded_file($file['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/shop/data/review/'.$name)) {
						$attach = 1;
					}
				}
			}
		}

		$db->query("update ".GD_GOODS_REVIEW." set attach='$attach' where sno='$sno'");
		confirm_reload("정상적으로 등록되었습니다");
		break;

	case "del_review":

		### 접근체크
		list( $password ) = $db->fetch("select password from ".GD_GOODS_REVIEW." where sno = '$_POST[sno]'");
		if ( !isset($sess) && $password != md5($_POST[password]) ) msg($msg='비밀번호를 잘못 입력 하셨습니다.',$code=-1); // 회원전용 & 로그인전

		$query = "delete from ".GD_GOODS_REVIEW." where sno = '$_POST[sno]'";
		$db->query($query);

		$name = 'RV'.sprintf("%010s", $_POST[sno]);
		@unlink($_SERVER['DOCUMENT_ROOT'].'/shop/data/review/'.$name);

		confirm_reload("정상적으로 삭제되었습니다");
		break;

	case "add_qna":
		include "../conf/config.php";
		# Anti-Spam 검증
		$switch = ($cfg['qnaSpamBoard']&1 ? '123' : '000') . ($cfg['qnaSpamBoard']&2 ? '4' : '0');
		$rst = antiSpam($switch, "goods/goods_qna_register.php", "post");
		if (substr($rst[code],0,1) == '4') spamFail();
		if ($rst[code] <> '0000') msg("무단 링크를 금지합니다.",-1);

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
		//무료보안서버
		$write_end_url = $sitelink->link("goods/indb.php?mode=add_qna_end","regular");
		echo "<script>location.href='$write_end_url';</script>";
		exit;
		break;

	case "add_qna_end":
		//무료보안서버 관련 부모창 새로고침을 위해 https 에서 http로 전환
		echo "<script>alert('정상적으로 등록되었습니다');opener.location.reload();opener.focus();window.close();</script>";
		exit;
		break;

	case "mod_qna":
		include "../conf/config.php";
		# Anti-Spam 검증
		$switch = ($cfg['qnaSpamBoard']&1 ? '123' : '000') . ($cfg['qnaSpamBoard']&2 ? '4' : '0');
		$rst = antiSpam($switch, "goods/goods_qna_register.php", "post");
		if (substr($rst[code],0,1) == '4') spamFail();
		if ($rst[code] <> '0000') msg("무단 링크를 금지합니다.",-1);

		### 접근체크
		list( $password ) = $db->fetch("select password from ".GD_GOODS_QNA." where sno = '$_POST[sno]'");
		if ( !isset($sess) && $password != md5($_POST[password]) ) msg($msg='비밀번호를 잘못 입력 하셨습니다.',$code=-1); // 회원전용 & 로그인전
		list($parent) = $db->fetch("select parent from ".GD_GOODS_QNA ." where sno='$_POST[sno]' limit 1");

		$query = "
			update ".GD_GOODS_QNA." set
				subject		= '$_POST[subject]',
				contents	= '$_POST[contents]',
				name		= '$_POST[name]',
				secret		= '".$_POST['secret']."',
				email		= '".$_POST['email']."',
				phone		= '".$_POST['phone']."',
				rcv_sms		= '".$_POST['rcv_sms']."',
				rcv_email	= '".$_POST['rcv_email']."'
			where sno = '$_POST[sno]'
			";
		$db->query($query);

		//무료보안서버
		$write_end_url = $sitelink->link("goods/indb.php?mode=mod_qna_end","regular");
		echo "<script>location.href='$write_end_url';</script>";
		exit;
		break;

	case "mod_qna_end":
		//무료보안서버 관련 부모창 새로고침을 위해 https 에서 http로 전환
		echo "<script>alert('정상적으로 수정되었습니다');opener.location.reload();opener.focus();window.close();</script>";
		exit;
		break;

	case "del_qna":

		### 접근체크
		list( $password,$m_no,$parent ) = $db->fetch("select password,m_no,parent from ".GD_GOODS_QNA." where sno = '$_POST[sno]'");
		if ( !isset($sess) && $password != md5($_POST[password]) ) msg($msg='비밀번호를 잘못 입력 하셨습니다.',$code=-1); // 회원전용 & 로그인전

		if(isset($sess)){
			if($parent!=$_POST[sno]){
				list($om_no) = $db->fetch("select m_no from ".GD_GOODS_QNA." where sno = '$parent'");
				if($sess[m_no]!=$om_no && $sess[m_no]!=$m_no){
					confirm_reload("권한이 없습니다.");
					exit;
				}
			}
		}

		$query = "delete from ".GD_GOODS_QNA." where sno = '$_POST[sno]'";
		if($parent == $_POST[sno]){
			list($cnt) = $db->fetch("select count(*) from ".GD_GOODS_QNA." where parent='$parent'");
			if($cnt > 1) $query = "update ".GD_GOODS_QNA." set subject='삭제된 게시물 입니다.',contents='삭제된 게시물 입니다.' where sno='".$_POST['sno']."'";
		}
		$db->query($query);
		confirm_reload("정상적으로 삭제되었습니다");
		break;

	case "reply_qna":

		list($parent) = $db->fetch("select parent from ".GD_GOODS_QNA." where sno='$_POST[sno]'");
		$query = "
		insert into ".GD_GOODS_QNA." set
			goodsno		= '$_POST[goodsno]',
			subject		= '$_POST[subject]',
			contents	= '$_POST[contents]',
			parent		= '$parent',
			m_no		= '$sess[m_no]',
			name		= '$_POST[name]',
			password	= md5('$_POST[password]'),
			regdt		= now(),
			secret		= '".$_POST['secret']."',
			ip			= '$_SERVER[REMOTE_ADDR]'
		";
		$db->query($query);
		//무료보안서버
		$write_end_url = $sitelink->link("goods/indb.php?mode=reply_qna_end","regular");
		echo "<script>location.href='$write_end_url';</script>";
		exit;
		break;

	case "reply_qna_end":
		//무료보안서버 관련 부모창 새로고침을 위해 https 에서 http로 전환
		echo "<script>alert('정상적으로 등록되었습니다');opener.location.reload();opener.focus();window.close();</script>";
		exit;
		break;

	case "auth_qna":
		include "../conf/config.php";
		### 접근체크
		list( $password ) = $db->fetch("select password,contents from ".GD_GOODS_QNA." where sno = '$_POST[sno]'");
		if ( $password != md5($_POST[password]) ) msg($msg='비밀번호를 잘못 입력 하셨습니다.',$code=-1); // 회원전용 & 로그인전
		if($_SESSION['qna_auth']) $r_qna_auth = unserialize($_SESSION['qna_auth']);
		$r_qna_auth[] = $_POST[sno];
		$_SESSION['qna_auth'] = serialize(array_unique($r_qna_auth));
		?>
		<script type="text/javascript">
		opener.view_content('<?php echo $_POST['sno'];?>');
		self.close();
		</script>
		<?php
		break;

	case "request_stocked_noti" :
		$goodsno = isset($_POST['goodsno']) ? trim($_POST['goodsno']) : '';
		$m_id = isset($_SESSION['sess']['m_id']) ? trim($_SESSION['sess']['m_id']) : '';
		$ip = isset($_SERVER['REMOTE_ADDR']) ? trim($_SERVER['REMOTE_ADDR']) : '';

		$opt = isset($_POST['opt']) ? $_POST['opt'] : array();
		$name = isset($_POST['name']) ? trim($_POST['name']) : '';
		$phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
		$phone = str_replace("-", "", $phone);

		if (empty($goodsno) || empty($m_id)){
			msg("잘못된 접근입니다.", "popup_request_stocked_noti.php?goodsno=".$goodsno);
			exit;
		}

		if (empty($name)){
			msg("이름을 입력해주세요", "popup_request_stocked_noti.php?goodsno=".$goodsno);
			exit;
		}

		if (!is_numeric($phone) || strlen($phone) < 10 || strlen($phone) > 11){
			msg("올바른 전화번호를 입력해주세요", "popup_request_stocked_noti.php?goodsno=".$goodsno);
			exit;
		}

		list($cnt, $optno) = $db->fetch("SELECT count(*) FROM ".GD_GOODS_OPTION." WHERE goodsno='".$goodsno."' and go_is_deleted <> '1' and go_is_display = '1'");

		if (count($opt)<=0 && $cnt > 1) {
			msg("재입고를 신청할 옵션을 선택하세요.", "popup_request_stocked_noti.php?goodsno=".$goodsno);
			exit;
		}else if(count($opt)<=0 && $cnt == 1){
			list($opt[]) = $db->fetch("SELECT optno FROM ".GD_GOODS_OPTION." WHERE goodsno='".$goodsno."' and go_is_deleted <> '1' and go_is_display = '1'");
		}

		$res = $db->query("
		SELECT
			*
		FROM
			".GD_GOODS_STOCKED_NOTI." gsn,
			".GD_GOODS." g,
			".GD_GOODS_OPTION." go
		WHERE
				gsn.goodsno = '".$goodsno."'
			AND gsn.m_id = '".$m_id."'
			AND gsn.goodsno = g.goodsno
			AND go.goodsno = g.goodsno
			AND go.optno = gsn.optno and go_is_deleted <> '1' and go_is_display = '1'
			AND gsn.optno in ('".implode("','", $opt)."')");

		$exists = false;
		while ($data = $db->fetch($res)) {
			$exists = true;
			$optExists[] = $data['optno'];
		}

		foreach($opt as $v){
			if(in_array($v, $optExists)){
				continue;
			}
			$res = "SELECT opt1, opt2 FROM ".GD_GOODS_OPTION." WHERE optno='".$v."' AND goodsno='".$goodsno."' and go_is_deleted <> '1' and go_is_display = '1' LIMIT 1";
			$data = $db->fetch($res);

			$query = "
			INSERT INTO ".GD_GOODS_STOCKED_NOTI." SET
				m_id = '".$m_id."' ,
				goodsno = '".$goodsno."' ,
				optno = '".$v."',
				opt1 = '".$data['opt1']."',
				opt2 = '".$data['opt2']."',
				name = '".$name."' ,
				phone = '".$phone."' ,
				regdt = NOW(),
				ip = '".$ip."',
				sended = '0'
			";
			$db->query($query);
		}
		?>
		<script type="text/javascript">
			alert('SMS 알림 신청이 완료되었습니다.');
			self.close();
		</script>
		<?
		exit;
		break;

		// 2013-01-16 dn 상품 QA 게시판 비회원 글 비밀번호 입력후 수정 폼 보여지게 수정 관련 비회원 비밀번호 인증 로직 소스 추가
		case "auth_nomember":
			include "../conf/config.php";
			### 접근체크
			list( $password, $contents, $goodsno ) = $db->fetch("select password,contents,goodsno from ".GD_GOODS_QNA." where sno = '$_POST[sno]'");
			if ( $password != md5($_POST[password]) ) {
				msg($msg='비밀번호를 잘못 입력 하셨습니다.',$code=-1); // 회원전용 & 로그인전
			}
			else {
				if($_SESSION['qna_auth']) $r_qna_auth = unserialize($_SESSION['qna_auth']);
				$r_qna_auth[] = $_POST[sno];
				$_SESSION['qna_auth'] = serialize(array_unique($r_qna_auth));
				go('goods_qna_register.php?mode=mod_qna&goodsno='.$goodsno.'&sno='.$_POST[sno]);
			}

		break;
}

?>
