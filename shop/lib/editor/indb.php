<?
require_once("../upload.lib.php");

switch ($_POST[mode]){

	case "InsertImage":

		//$dir = "upload/";
		$dir = "../../data/editor/";

		if (!preg_match("/^image/",$_FILES[mini_file][type])){
			echo "<script>alert('이미지 파일만 업로드가 가능합니다');</script>";
			exit;
		}

		if (is_uploaded_file($_FILES[mini_file][tmp_name])){
			$div = explode(".",$_FILES[mini_file][name]);
			$filename = time().".".$div[count($div)-1];
			$upload = new upload_file($_FILES['mini_file'],$dir.$filename,'image');
			if(!$upload -> upload()){
				echo "<script>alert('이미지 파일만 업로드가 가능합니다');</script>";
				exit;
			}
		}
		$src = "http://".$_SERVER[SERVER_NAME].dirname($_SERVER[PHP_SELF])."/".$dir.$filename;
		if ($_POST[imgWidth] && $_POST[imgHeight]) $size = " width='$_POST[imgWidth]' height='$_POST[imgHeight]'";

		if ($filename) echo "<script>parent.opener.mini_set_html(\"<img src='$src' $size>\");</script>";
		echo "<script>parent.window.close();</script>";
		break;

}

?>