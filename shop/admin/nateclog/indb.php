<?
@require "../lib.php";
@require "../../lib/lib.enc.php";
@require "../../lib/load.class.php";
@require "../../lib/qfile.class.php";
@require "../../lib/upload.lib.php";
@require "../../conf/config.php";
@require "../../conf/clog.cfg.php";

if($_POST['useBrandCLog'] == "")$_POST['useBrandCLog'] = "n";
$arr = array( 
'useBrandCLog'=>$_POST['useBrandCLog'],
'useBrandCLogID'=>$_POST['useBrandCLogID'],
); 

$qfile = new qfile();

foreach($arr as $k=>$v)
{
	if(is_array($v)):
		foreach ($v as $k1=>$v1)$clogCfg[$k][] = addslashes($v1);
	else:
		$clogCfg[$k] = addslashes($v);
	endif;
	
}

$qfile->open("../../conf/clog.cfg.php");

$qfile->write("<? \n");
$qfile->write("\$clogCfg = array( \n");
foreach ($clogCfg as $k=>$v)
{
	if(is_array($v)):
		$qfile->write("'$k' => array(");
		foreach ($v as $k1=>$v1) $qfile->write("'$v1',");
		$qfile->write("), \n");
	else:
		$qfile->write("'$k' => '$v', \n");
	endif;
	$str .= "ok - ".$k."=>".$v."<br>";
}

$qfile->write(") \n;");
$qfile->write("?>");

$qfile->close();

@chmod("../../conf/clog.cfg.php",0707);
?>
<script type="text/javascript">parent.location.reload();</script>