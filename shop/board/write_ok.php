<?
if(!preg_match('/^[a-zA-Z0-9_]*$/',$_POST['id'])) exit;
include "../conf/bd_$_POST[id].php";
include "../lib/library.php";
require_once("../lib/upload.lib.php");

if($_POST['encode'] == 'y') {
	$_POST['subject'] = iconv('utf8','euckr',urldecode($_POST['subject']));
	$_POST['contents'] = iconv('utf8','euckr',urldecode($_POST['contents']));
} else if($_POST['encode'] == 'htmlencode') { //Ư�� �ѱ� ȣȯ 2013-05-08
	$_POST['subject'] = html_entity_decode($_POST['subject']);
	$_POST['contents'] = html_entity_decode($_POST['contents']);
}

### �߰��� �ʵ尡 �ִ����� üũ�� �ؼ� ������ �߰� -- ���߿� �̰��� ����ó���� �Ǿ�� ��
$strSQL = "DESC `".GD_BD_.$_POST[id]."`";
$res = $db->query($strSQL);
$fieldChk	= false;
while ($tmp_chk=$db->fetch($res)){
	if($tmp_chk['Field'] == "titleStyle"){
		$fieldChk	= true;
	}
}
if($fieldChk === false){
	$strSQL ="ALTER TABLE `".GD_BD_.$_POST[id]."` ADD titleStyle VARCHAR( 50 ) AFTER homepage;";
	$db->query($strSQL);
}

if ($bdLvlW && $bdLvlW>$sess[level] && $_POST['mode']=="write") msg("�� �ۼ� ������ �����ϴ�",-1);
if ($bdLvlP && $bdLvlP>$sess[level] && $_POST['mode']=="reply") msg("��� �ۼ� ������ �����ϴ�",-1);

# Anti-Spam ����
$switch = ($bdSpamBoard&1 ? '123' : '000') . ($bdSpamBoard&2 ? '4' : '0');
$rst = antiSpam($switch, "board/write.php", "post");
if (substr($rst[code],0,1) == '4') msg("�ڵ���Ϲ������ڰ� ��ġ���� �ʽ��ϴ�. �ٽ� �Է��Ͽ� �ֽʽÿ�.",-1);
if ($rst[code] <> '0000') msg("���� ��ũ�� �����մϴ�.",-1);

# ���� ��Ÿ���� �ִ°��
if (is_array($_POST['titleStyle'])){

	# ���� ����
	if($_POST['titleStyle']['C']){
		$titleStyle['C']	= "^C:".$_POST['titleStyle']['C'];
	}

	# ���� ũ��
	if($_POST['titleStyle']['S']){
		$titleStyle['S']	= "^S:".$_POST['titleStyle']['S'];
	}

	# ���� ����
	if($_POST['titleStyle']['B']){
		$titleStyle['B']	= "^B:".$_POST['titleStyle']['B'];
	}

	if(is_array($titleStyle)){
		$titleStyle	= implode("|",$titleStyle);
	}
}

//* bd class *//

if($_POST['mode']=="reply")
{
	$query = "select no from `".GD_BD_.$_POST[id]."` where no='".$_POST['no']."'";
	list($tmp) = $db->fetch($query);
	if(!$tmp) msg("������ �����Ǿ� �亯���� ���� �� �����ϴ�",-1);
}

$bd = Core::loader('miniSave');

$bd->db		= &$db;
$bd->id		= $_POST[id];
$bd->no		= $_POST[no];
$bd->mode	= $_POST[mode];
$bd->sess	= $sess;
$bd->style	= $titleStyle;
$bd->ici_admin	= $ici_admin;

$bd->bdMaxSize	= $bdMaxSize;
$bd->exec_();

$loc_url = $sitelink->link("board/list.php?id=$_POST[id]&".getReUrlQuery('no,id,mode', $_SERVER[HTTP_REFERER]),"regular");
go($loc_url);

//debug($db->log);

?>
