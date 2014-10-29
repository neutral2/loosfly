<?
@include dirname(__FILE__) . "/../lib/library.php";

$mode=$_POST['mode'];


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
	$str .= "<input type='text' name='name' value='".$_POST['name']."' />";
	$str .= "<textarea name='contents'>".$_POST['contents']."</textarea>";
	$str .= "</form>";
	$str .= "</div>";
	exit($str);
}

switch($mode) {
	case "add_review":
		# Anti-Spam 검증
		$switch = ($cfg['reviewSpamBoard']&1 ? '123' : '000') . ($cfg['reviewSpamBoard']&2 ? '4' : '0');
		$rst = antiSpam($switch, "myp/review_register.php", "post");
 
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
			ip			= '$_SERVER[REMOTE_ADDR]',
			is_mobile	= 'y'
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
					$tmp_name = $name.'_tmp';
					if (@move_uploaded_file($file['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/shop/data/review/'.$tmp_name)) {
						chmod($file['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/shop/data/review/'.$tmp_name, 0707);
						$attach = 1;
					}
		
					$img_size = getimagesize( $_SERVER['DOCUMENT_ROOT'].'/shop/data/review/'.$tmp_name);
		
					if($img_size[0] > 700) {
		
						thumbnail($_SERVER['DOCUMENT_ROOT'].'/shop/data/review/'.$tmp_name,$_SERVER['DOCUMENT_ROOT'].'/shop/data/review/'.$name,700);
		
					}
					else {
						copy($_SERVER['DOCUMENT_ROOT'].'/shop/data/review/'.$tmp_name,$_SERVER['DOCUMENT_ROOT'].'/shop/data/review/'.$name);
					}
		
					@unlink($_SERVER['DOCUMENT_ROOT'].'/shop/data/review/'.$tmp_name);
				}
			}
		}

		$db->query("update ".GD_GOODS_REVIEW." set parent=sno, attach='$attach' where sno='$sno'");


		msg('정상적으로 등록되었습니다', '../goods/view.php?goodsno='.$_POST['goodsno'].'&view_area=review');

	case 'mod_review' :

		# Anti-Spam 검증
		$switch = ($cfg['reviewSpamBoard']&1 ? '123' : '000') . ($cfg['reviewSpamBoard']&2 ? '4' : '0');
		$rst = antiSpam($switch, "myp/review_register.php", "post");
 
		if (substr($rst[code],0,1) == '4') spamFail();
		if ($rst[code] <> '0000') msg("무단 링크를 금지합니다.",-1);

		### 접근체크
		list( $password ) = $db->fetch("select password from ".GD_GOODS_REVIEW." where sno = '$_POST[sno]'");
		if ( !isset($sess) && $password != md5($_POST[password]) ) msg($msg='비밀번호를 잘못 입력 하셨습니다.',$code=-1); // 회원전용 & 로그인전

		$attach_query = ", attach = '0'";

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
		msg("정상적으로 수정되었습니다", '../goods/view.php?goodsno='.$_POST['goodsno'].'&view_area=review');
		break;

	case 'del_goodsview' :
		$goodsno = $_POST['goodsno'];
		
		$tmp_goods_idx = $_COOKIE['todayGoodsMobileIdx'];

		$arr_tmp_goods_idx = explode(',', $tmp_goods_idx);

		if(!empty($arr_tmp_goods_idx) && is_array($arr_tmp_goods_idx)) {
			foreach($arr_tmp_goods_idx as $goods_idx) {
				if($goods_idx != $goodsno) {
					$arr_goods_idx[] = $goods_idx;
				}
			}
		}

		$serialize_goods_data = $_COOKIE['todayGoodsMobile'];
		//unset($_COOKIE['todayGoodsMobileIdx'], $_COOKIE['todayGoodsMobile']);
		
		$goods_arr = unserialize(stripslashes($serialize_goods_data));

		if(!empty($goods_arr) && is_array($goods_arr)) {
			foreach($goods_arr as $goods_row) {
				if($goods_row['goodsno'] != $goodsno) {
					$goods_data[] = $goods_row;
					
				}
			}
		}

		$date = 1;
		

		setcookie('todayGoodsMobileIdx',implode(",",$arr_goods_idx),time()+3600*24*$date,'/');
		setcookie('todayGoodsMobile',serialize($goods_data),time()+3600*24*$date,'/');

		msg("삭제 되었습니다", "viewgoods.php", "parent");
		
		break;

	case 'add_member_qna' :


		$query = "
		insert into ".GD_MEMBER_QNA." set
			itemcd		= '$_POST[itemcd]',
			subject		= '$_POST[subject]',
			contents	= '$_POST[contents]',
			m_no		= '$sess[m_no]',
			email		= '$_POST[email]',
			mobile		= '$mobile',
			mailling	= '$mailling',
			sms			= '$sms',
			ordno		= '$_POST[ordno]',
			regdt		= now(),
			ip			= '$_SERVER[REMOTE_ADDR]'
		";
		$db->query($query);

		$db->query("update ".GD_MEMBER_QNA." set parent=sno where sno='" . $db->lastID() . "'");

		msg('정상적으로 등록되었습니다', '../myp/qna.php');

		break;
}
?>