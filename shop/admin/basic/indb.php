<?

include "../lib.php";
require_once("../../lib/qfile.class.php");
require_once("../../lib/upload.lib.php");
$qfile = new qfile();

$mode = ($_POST[mode]) ? $_POST[mode] : $_GET[mode];
unset($_POST[mode]); unset($_POST[x]); unset($_POST[y]);

switch ($mode){

	case "inipayKeyCopy":
		$inipayKeyName	= $_POST['inicisKeyName'];
		$inipayKeyFiles	= array('keypass.enc','mcert.pem','mpriv.pem');

		$inipayConfFile	= "../../conf/pg.inipay.php";
		$inipayKeyDir	= "../../order/card/inipay/key/".$inipayKeyName;

		$inicisConfFile	= "../../conf/pg.inicis.php";
		$inicisKeyDir	= "../../order/card/inicis/key/".$inipayKeyName;

		// TX5에 키폴더 생성 및 키화일 복사
		if ( is_dir($inipayKeyDir) === false || is_file($inipayKeyDir.'/'.$inipayKeyFiles[0]) === false || is_file($inipayConfFile) === false) {
			mkdir($inipayKeyDir,0707);
			@chmod($inipayKeyDir,0707);
			foreach($inipayKeyFiles as $val) {
				copy($inicisKeyDir.'/'.$val, $inipayKeyDir.'/'.$val);
				@chmod($inipayKeyDir.'/'.$val,0707);
			}
		}

		// 설정 화일 저장 (기존의 inipay TX4 것을 그대로 가지고옴)
		if (is_file($inicisConfFile) && is_file($inipayConfFile) === false) {
			copy($inicisConfFile, $inipayConfFile);
			@chmod($inipayConfFile,0707);
		}
		exit();
		break;
	case "allatCopy":

		$allatbasicConfFile	= "../../conf/pg.allatbasic.php";

		$allatConfFile	= "../../conf/pg.allat.php";

		// 설정 화일 저장 (기존의 All@Pay™Plus 것을 그대로 가지고옴)
		if (is_file($allatConfFile) && is_file($allatbasicConfFile) === false) {
			copy($allatConfFile, $allatbasicConfFile);
			@chmod($allatbasicConfFile,0707);
		}
		exit();
		break;
	case "bank":
		include "../../conf/config.pay.php";
		$set = (array)$set;
		$set = array_map('strip_slashes',$set);
		$set = array_map('add_slashes',$set);

		if($_POST['set']['use']['a'])$set['use']['a'] = $_POST['set']['use']['a'];
		else unset($set['use']['a']);
		$qfile->open("../../conf/config.pay.php");
		$qfile->write("<? \n");
		if ($set) foreach ($set as $k=>$v) foreach ($v as $k2=>$v2)$qfile->write("\$set['$k']['$k2'] = '$v2'; \n");
		$qfile->write("?>");
		$qfile->close();
		break;
	case "config":

		if ($_POST[zipcode]) $_POST[zipcode] = implode("",$_POST[zipcode]);

		include "../../conf/config.php";
		$cfg = (array)$cfg;
		$cfg = array_map("stripslashes",$cfg);
		$cfg = array_map("addslashes",$cfg);
		$cfg = array_merge($cfg,(array)$_POST);

		$qfile->open("../../conf/config.php");
		$qfile->write("<? \n");
		$qfile->write("\$cfg = array( \n");
		foreach ($cfg as $k=>$v) $qfile->write("'$k' => '$v', \n");
		$qfile->write(") \n;");
		$qfile->write("?>");
		$qfile->close();

		break;

	case "delivery":

		$dmode = 1;
		include "setAreaName.inc.php";

		### 기본배송정책
		$set2['delivery']['default']	= &$_POST['default'];
		$set2['delivery']['default_msg']	= &$_POST['default_msg'];
		$set2['delivery']['free']	= &$_POST['free'];
		$set2['delivery']['basis']	= &$_POST['basis'];
		$set2['delivery']['deliveryType']	= &$_POST['deliveryType'];
		$set2['delivery']['freeDelivery']	= &$_POST['freeDelivery'];
		$set2['delivery']['goodsDelivery']	= &$_POST['goodsDelivery'];
		$set2['delivery']['deliverynm']	= &$_POST['deliverynm'];
		$set2['delivery']['deliveryOrder']	= &$_POST['deliveryOrder'];

		### 지역별 배송비
		$set2['delivery']['area_deli_type']	= $_POST['area_deli_type'];
		$set2['delivery']['overAdd']	= implode("|",$_POST['overAdd']);
		$set2['delivery']['overAddZip']	= implode("|",$_POST['overAddZip']);
		$set2['delivery']['overZipcode'] = implode("|",$overZipcode);
		$set2['delivery']['areaZip1'] = implode("|",$_POST['areaZip1']);
		$set2['delivery']['areaZip2'] = implode("|",$_POST['areaZip2']);
		if (isset($_POST['add_extra_fee'])) {
			$set2['delivery']['add_extra_fee'] = (int)$_POST['add_extra_fee'];
		}

		include "../../conf/config.pay.php";
		$set = (array)$set;
		$set = array_map('strip_slashes',$set);
		$set = array_map('add_slashes',$set);

		### 추가 배송정책
		$tmp = explode('|',$set['r_delivery']);
		foreach($tmp as $v)unset($v);
		unset($set['r_delivery']);
		if($_POST['r_delivery']){
			$set['r_delivery']['title'] = implode('|',$_POST['r_delivery']);
			for($i=0;$i<count($_POST[r_delivery]);$i++){
				$set[$_POST['r_delivery'][$i]]['r_free'] = $_POST['r_free'][$i];
				$set[$_POST['r_delivery'][$i]]['r_deliType'] = $_POST['r_deliType'][$i];
				$set[$_POST['r_delivery'][$i]]['r_default'] = $_POST['r_default'][$i];
				$set[$_POST['r_delivery'][$i]]['r_default_msg'] = $_POST['r_default_msg'][$i];
			}
		}

		$set = array_merge($set,$set2);

		### 기본 택배사
		if ($_POST[delivery]){
			$set['delivery']['defaultDelivery'] = $_POST['delivery']['0'];
		}

		$qfile->open("../../conf/config.pay.php");
		$qfile->write("<? \n");
		foreach ($set as $k=>$v){
			foreach ($v as $k2=>$v2){
				$qfile->write("\$set['$k']['$k2'] = '$v2'; \n");
			}
		}
		$qfile->write("?>");
		$qfile->close();

		### 택배사/배송추적 설정
		$db->query("update ".GD_LIST_DELIVERY." set useyn='n'");
		if ($_POST[delivery]) foreach ($_POST[delivery] as $v) $db->query("update ".GD_LIST_DELIVERY." set useyn='y' where deliveryno='$v'");
		break;

	case "emoney":

		$_POST['max'] = $_POST['max'][$_POST[k_max]];
		if ($_POST[k_max]) $_POST['max'] .= "%";
		unset($_POST[k_max]);
		$_POST['goods_emoney'] =  $_POST['goods_emoney'][$_POST['chk_goods_emoney']];
		$tmp['emoney'] = &$_POST;

		include "../../conf/config.pay.php";
		$set = (array)$set;
		$set = array_map('strip_slashes',$set);
		$set = array_map('add_slashes',$set);
		$set = array_merge($set,$tmp);

		$qfile->open("../../conf/config.pay.php");
		$qfile->write("<? \n");
		foreach ($set as $k=>$v) foreach ($v as $k2=>$v2) $qfile->write("\$set['$k']['$k2'] = '$v2'; \n");
		$qfile->write("?>");
		$qfile->close();

		break;

	case "registerDelivery":

		$db->query("insert into ".GD_LIST_DELIVERY." set deliverycomp='$_POST[deliverycomp]', deliveryurl='$_POST[deliveryurl]'");
		popupReload();
		break;

	case "modifyDelivery":

		$db->query("update ".GD_LIST_DELIVERY." set deliverycomp='$_POST[deliverycomp]', deliveryurl='$_POST[deliveryurl]' where deliveryno='$_POST[deliveryno]'");
		popupReload();
		break;

	case "addBank":

		$db->query("insert into ".GD_LIST_BANK." set bank='$_POST[bank]', account='$_POST[account]', name='$_POST[name]'");
		popupReload();
		break;

	case "modBank":

		$db->query("update ".GD_LIST_BANK." set bank='$_POST[bank]', account='$_POST[account]', name='$_POST[name]' where sno='$_POST[sno]'");
		popupReload();
		break;

	case "delBank":

		$db->query("update ".GD_LIST_BANK." set useyn='n' where sno='$_GET[sno]'");
		break;

	case "cfgemoney":

		include "../../conf/config.php";
		$cfg = (array)$cfg;
		$cfg = array_map("stripslashes",$cfg);
		$cfg = array_map("addslashes",$cfg);
		$cfg = array_merge($cfg,(array)$_POST);

		$qfile->open("../../conf/config.php");
		$qfile->write("<? \n");
		$qfile->write("\$cfg = array( \n");
		foreach ($cfg as $k=>$v) $qfile->write("'$k' => '$v', \n");
		$qfile->write("); \n;");
		$qfile->write("?>");
		$qfile->close();
		popupReload();
		break;

	case "ssl":
		include "../../conf/config.php";
		if($_POST['ssl_type']) $_POST['ssl']=1;
		else $_POST['ssl']=0;

		if($_POST['ssl_type'] == "") { $_POST['ssl_seal'] = "0";  $_POST['free_ssl_seal'] = "0"; }
		if($_POST['ssl_type'] == "free") { $_POST['ssl_seal'] = "0"; }
		if($_POST['ssl_type'] == "godo") { $_POST['free_ssl_seal'] = "0"; }

		$cfg = (array)$cfg;
		$cfg = array_map("stripslashes",$cfg);
		$cfg = array_map("addslashes",$cfg);
		$cfg = array_merge($cfg,(array)$_POST);

		$qfile->open("../../conf/config.php");
		$qfile->write("<? \n");
		$qfile->write("\$cfg = array( \n");
		foreach ($cfg as $k=>$v) $qfile->write("'$k' => '$v', \n");
		$qfile->write("); \n;");
		$qfile->write("?>");
		$qfile->close();
		break;

	case "admin_ip": //관리자 IP접속제한 설정

		if ($_POST['ip_permit'] == "" || ($_POST['ip_permit'] != 0 && $_POST['ip_permit'] != 1) ) { //설정값이 빈 값 혹은 0,1이 아닌경우 경고창 띄움
			msg('잘못된 설정입니다.', -1);
		}

		if($_POST['ip_permit'] == "1" && !$_POST['regist_ip']){ // 관리자IP접속제한을 사용함으로 선택하고 IP는 등록하지 않았을때 경고창 띄움
			msg('IP를 등록해 주세요.', -1);
		}

		$ip_permit = $_POST['ip_permit'];

		$set_ip_write = "<? \n";
		$set_ip_write .= "\$set_ip_permit = '$ip_permit'; \n";

		if ($_POST['ip_permit'] == "1") {
			$set_ip = array();

			if (is_array($_POST['regist_ip'])){
				$_POST['regist_ip'] = array_filter($_POST['regist_ip']); //배열의 빈값 제거.
				$_POST['regist_ip'] = array_unique($_POST['regist_ip']); //중복IP제거

				$i=0;
				foreach($_POST['regist_ip'] as $k=>$v) {

					if(!$v=trim($v)){
						continue;
					}
					$set_ip[] = $v;
					$i++;
				}
			}

			$set_ip_write .= "\$set_regist_ip = array( \n";

			foreach ($set_ip as $k=>$v) {
				$set_ip_write .= "'$k' => '$v', \n";
			}
			$set_ip_write .= "); \n;";
		}
		$set_ip_write .= "?>";

		$qfile->open("../../conf/config.admin_access_ip.php");
		$qfile->write($set_ip_write);
		$qfile->close();
		@chmod("../../conf/config.admin_access_ip.php",0707);
		break;

	case "memo":
		if($_POST['miniMemo']==null) $_POST['miniMemo'] = ' ';
		$qfile->open("../../conf/mini_memo.php");
		$qfile->write(htmlspecialchars(stripslashes($_POST['miniMemo'])));
		$qfile->close();
		@chmod("../../conf/mini_memo.php",0707);

		echo "<script>parent.location.reload();</script>";
		exit;
		break;

	case "orderSet" :
		include "../../conf/config.php";

		$arr = array(
			'stepStock' => $_POST['stepStock'],
			'autoCancel' => $_POST['autoCancel'],
			'autoCancelUnit' => $_POST['autoCancelUnit'],
			'autoCancelFail' => $_POST['autoCancelFail'],
			'orderPeriod' => $_POST['orderPeriod'],
			'orderPageNum' => $_POST['orderPageNum'],
			'autoCancelRecoverStock' => $_POST['autoCancelRecoverStock'],
			'autoCancelRecoverReserve' => $_POST['autoCancelRecoverReserve'],
			'autoCancelRecoverCoupon' => $_POST['autoCancelRecoverCoupon']
		);
		$cfg = (array)$cfg;
		$cfg = array_map("stripslashes",$cfg);
		$cfg = array_map("addslashes",$cfg);
		$cfg = array_merge($cfg,$arr);
		$qfile->open("../../conf/config.php");
		$qfile->write("<? \n");
		$qfile->write("\$cfg = array( \n");
		foreach ($cfg as $k=>$v) $qfile->write("'$k' => '$v', \n");
		$qfile->write(") \n;");
		$qfile->write("?>");
		$qfile->close();

		unset($set);

		include "../../conf/config.pay.php";
		$set = (array)$set;
		$set = array_map('strip_slashes',$set);
		$set = array_map('add_slashes',$set);
		$set['delivery']['basis']	= &$_POST['basis'];
		$qfile->open("../../conf/config.pay.php");
		$qfile->write("<? \n");
		foreach ($set as $k=>$v) foreach ($v as $k2=>$v2){
			$qfile->write("\$set['$k']['$k2'] = '$v2'; \n");
		}


		$qfile->write("?>");
		$qfile->close();
	break;

	case "cartSet" :

		$cartVal = array(
			'keepPeriod' =>($_POST['keepPeriodYn']=='Y' || is_null($_POST['keepPeriodYn']))?"0":$_POST['keepPeriod'],
			'runoutDel' => $_POST['runoutDel'],
			'redirectType' => $_POST['redirectType']
		);

		$qfile->open("../../conf/config.cart.php");
		$qfile->write("<? \n");
		$qfile->write("\$cartCfg = array( \n");
		foreach ($cartVal as $k=>$v){
			if($v!='')$qfile->write("'$k' => '$v', \n");
		}
		$qfile->write(") \n;");
		$qfile->write("?>");
		$qfile->close();
		@chmod("../../conf/config.cart.php",0707);

	break;
}

go($_SERVER[HTTP_REFERER]);

?>