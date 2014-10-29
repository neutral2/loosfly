<?
/*------------------------------------------------------------------------------
ⓒ Copyright 2005, Flyfox All right reserved.
@파일내용: 파일다운로드 실행
@수정내용/수정자/수정일:
------------------------------------------------------------------------------*/

if ( $_GET['downfile_path'] and file_exists( $_GET['downfile_path'] ) ){

	//-- http://www.onaje.com/php/article.php4/40 참고 --//
	// downloading a file
	$filename = $_GET['downfile_path'];

	if ( $_GET['downfile_name'] ) $onlyname = $_GET['downfile_name'];
	else $onlyname=$_GET['downfile_path'];


	// fix for IE catching or PHP bug issue
	header( "Pragma: public" );
	header( "Expires: 0" ); // set expiration time
	header( "Cache-Control: must-revalidate, post-check=0, pre-check=0" );
	// browser must download file from server instead of cache

	// force download dialog
	header( "Content-Type: application/force-download" );
	header( "Content-Type: application/octet-stream" );
	header( "Content-Type: application/download" );

	// use the Content-Disposition header to supply a recommended filename and
	// force the browser to display the save dialog.
	header( "Content-Disposition: attachment; filename=".basename( $onlyname ).";" );

	/*
	The Content-transfer-encoding header should be binary, since the file will be read
	directly from the disk and the raw bytes passed to the downloading computer.
	The Content-length header is useful to set for downloads. The browser will be able to
	show a progress meter as a file downloads. The content-lenght can be determines by
	filesize function returns the size of a file.
	*/
	header( "Content-Transfer-Encoding: binary" );
	header( "Content-Length: ".filesize( $filename ) );

	readfile( "$filename" );
	exit();
	//-- http://www.onaje.com/php/article.php4/40 참고 -- END --//

}
else {
?>
	<script language="javascript"><!--
	alert( '파일을 다운받을 수 없습니다.  파일이 존재하지 않습니다.' );
	--></script>
<?
}
?>