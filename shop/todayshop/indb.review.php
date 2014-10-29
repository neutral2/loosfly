<?
require_once('../lib/todayshop_cache.class.php');
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


$mode = $_POST[mode];
if(!$_POST['secret'])$_POST['secret']=0;

if ($mode) todayshop_cache::remove('*','goodsreview');	// 리뷰 캐시 삭제
switch ($mode){

	case "add_review":

		$query = "
		insert into ".GD_TODAYSHOP_GOODS_REVIEW." set
			goodsno		= '$_POST[goodsno]',
			subject		= '$_POST[subject]',
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

				if ($file['size'] > 0) {

					$name = 'TSRV'.sprintf("%010s", $sno);
					if (@move_uploaded_file($file['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/shop/data/review/'.$name)) {
						$attach = 1;
					}
				}
			}
		}

		$db->query("update ".GD_TODAYSHOP_GOODS_REVIEW." set parent=sno, contents='$_POST[contents]', attach='$attach' where sno='$sno'");
		confirm_reload("정상적으로 등록되었습니다","goods_review_list.php?goodsno=".$_POST[goodsno]);
		break;

	case "mod_review":

		### 접근체크
		list( $password ) = $db->fetch("select password from ".GD_TODAYSHOP_GOODS_REVIEW." where sno = '$_POST[sno]'");
		if ( !isset($sess) && $password != md5($_POST[password]) ) msg($msg='비밀번호를 잘못 입력 하셨습니다.',$code=-1); // 회원전용 & 로그인전

		if ($_POST[remove_attach] == 1) {
			$name = 'TSRV'.sprintf("%010s", $_POST[sno]);
			@unlink($_SERVER['DOCUMENT_ROOT'].'/shop/data/review/'.$name);

			$attach_query = ", attach = '0'";
		}

		// 이미지 업로드
		if ($_FILES['attach']['error'] === UPLOAD_ERR_OK) {	// UPLOAD_ERR_OK = 0
			$file = $_FILES['attach'];
			$_ext = strtolower(array_pop(explode('.',$file['name'])));

			if (strpos('jpg gif jpeg',$_ext) !== false) {	// 허용 확장자 검사

				if ($file['size'] > 0) {

					$name = 'TSRV'.sprintf("%010s", $_POST[sno]);
					if (@move_uploaded_file($file['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/shop/data/review/'.$name)) {

						$attach_query = ", attach = '1'";
					}
				}
			}
		}


		$query = "
		update ".GD_TODAYSHOP_GOODS_REVIEW." set
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
		insert into ".GD_TODAYSHOP_GOODS_REVIEW." set
			goodsno		= '$_POST[goodsno]',
			subject		= '$_POST[subject]',
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

				if ($file['size'] > 0) {

					$name = 'TSRV'.sprintf("%010s", $sno);
					if (@move_uploaded_file($file['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/shop/data/review/'.$name)) {
						$attach = 1;
					}
				}
			}
		}

		$db->query("update ".GD_TODAYSHOP_GOODS_REVIEW." set contents='$_POST[contents]', attach='$attach' where sno='$sno'");
		confirm_reload("정상적으로 등록되었습니다");
		break;

	case "del_review":

		### 접근체크
		list( $password ) = $db->fetch("select password from ".GD_TODAYSHOP_GOODS_REVIEW." where sno = '$_POST[sno]'");
		if ( !isset($sess) && $password != md5($_POST[password]) ) msg($msg='비밀번호를 잘못 입력 하셨습니다.',$code=-1); // 회원전용 & 로그인전

		$query = "delete from ".GD_TODAYSHOP_GOODS_REVIEW." where sno = '$_POST[sno]'";
		$db->query($query);

		$name = 'TSRV'.sprintf("%010s", $_POST[sno]);
		@unlink($_SERVER['DOCUMENT_ROOT'].'/shop/data/review/'.$name);

		confirm_reload("정상적으로 삭제되었습니다");
		break;

}

?>
