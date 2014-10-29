<?
if (!$_GET['sns'] || !$_GET['snsid'] || !$_GET['postCount']) exit;

switch($_GET['sns']) {
	case 'twitter': {
		if ($_GET['mode'] == 'profile') {
			$contents = file_get_contents('http://api.twitter.com/1/users/show/'.$_GET['snsid'].'.json');
		}
		else {
			$page = ($_GET['page'] && is_numeric($_GET['page']))? $_GET['page'] : 1;
			$contents = file_get_contents('http://api.twitter.com/1/statuses/user_timeline/'.$_GET['snsid'].'.json?include_rts=true&count='.$_GET['postCount'].'&page='.$page);
		}
		break;
	}
	case 'me2day': {
		if ($_GET['mode'] == 'profile') {
			$contents = file_get_contents('http://me2day.net/api/get_person/'.$_GET['snsid'].'.json');
		}
		else {
			$page = ($_GET['page'] && is_numeric($_GET['page']))? $_GET['page'] : 1;
			$offset = ($page - 1) * $_GET['postCount'];
			$contents = file_get_contents('http://me2day.net/api/get_posts/'.$_GET['snsid'].'.json?count='.$_GET['postCount'].'&offset='.$offset);
		}
		break;
	}
	default : exit;
}

//echo iconv('EUC-KR', 'UTF-8//IGNORE', $contents);
echo $contents;
?>