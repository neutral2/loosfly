<?
$location = "기본관리 > 관리자 IP접속제한 설정";
include "../_header.php";
@include "../../conf/config.admin_access_ip.php";

//초기값 세팅
if(!$set_ip_permit) $set_ip_permit = '0';

//등록된 IP개수
$set_ip_cnt = count($set_regist_ip);

//현재 접속 IP
$accessIP = $_SERVER['REMOTE_ADDR'];
$ex_accessIP = explode(".",$accessIP);
?>

<script type="text/javascript">
<!--
function validateForm(obj) {
	if(obj.ip_permit[1].checked == true) {

		if(!obj["regist_ip[]"]) {
		
			alert("최소 1개 이상의 등록된 IP가 있어야 합니다.\n접속가능 IP를 등록해 주세요.");			
			return false;
		}

		var regist_ip = (obj["regist_ip[]"].length===undefined) ? new Array(obj["regist_ip[]"]) : obj["regist_ip[]"], a=0;
		for(var i=0; i<regist_ip.length; i++) {
			if(regist_ip[i].value == "") a++;
		}

		if(regist_ip.length===a) {
			alert('최소 1개 이상의 등록된 IP가 있어야 합니다.\n접속가능 IP를 등록해 주세요.');
			return false;
		}

	}
	
}	
//-->
</script>

<form name="form" method="post" action="indb.php" onsubmit="return validateForm(this);">
<input type="hidden" name="mode" value="admin_ip">
<div class="title title_top">관리자 IP접속제한 설정<span></span> <a href="javascript:manual('<?=$guideUrl?>board/view.php?id=basic&no=35')"><img src="../img/btn_q.gif" border="0" align="absmiddle"></a></div>

<table class=tb>
<col class=cellC><col class=cellL>
<tr>
	<td>접속제한 설정</td>
	<td>
	<input type="radio" name="ip_permit" value="0" style='border:0px' onclick="cl_none()" <?if($set_ip_permit=='0'){?>checked<?}?>>
	관리자 접속 IP 모두 허용
	&nbsp;
	<input type="radio" name="ip_permit" value="1" style='border:0px' onclick="cl_use()" <?if($set_ip_permit=='1'){?>checked<?}?>>
	관리자 접속 IP 제한 (등록된 IP만 접속 가능)
	</td>
</tr>
<tr>
	<td rowspan="2">접속가능 IP 등록</td>
	<td>
	<div id="IP_regist" disabled>
		<div style="margin-bottom:10px;float:left;">
			<div style="margin-bottom:10px;float:left;">
				<input type="text" id="class0" name="class[]" maxlength="3" size="3" onkeyup="onlyNumber(this);" onkeypress="onlyNumber(this);" style="IME-MODE:disabled;" disabled />.
				<input type="text" id="class1" name="class[]" maxlength="3" size="3" onkeyup="onlyNumber(this);" onkeypress="onlyNumber(this);" style="IME-MODE:disabled;" disabled />.
				<input type="text" id="class2" name="class[]" maxlength="3" size="3" onkeyup="onlyNumber(this);" onkeypress="onlyNumber(this);" style="IME-MODE:disabled;" disabled />.
				<input type="text" id="class3" name="class[]" maxlength="3" size="3" onkeyup="onlyNumber(this);" onkeypress="onlyNumber(this);" style="IME-MODE:disabled;" disabled />
			</div>
			<div id="add_f" style="display:none;float:left;">
				~ <input type="text" id="class4" maxlength="3" size="3" onkeyup="onlyNumber(this);" style="IME-MODE:disabled;"/>
			</div>
			<div style="float:left;" class="noline">
				<input type="image" id="b2" src='../img/i_add.gif' onClick='fnRegist();return false;' style='border:0;margin:2px 5px;vertical-align:top;cursor:pointer;' disabled />
				<input type="checkbox" id="chkbox" onclick="fnAdd('add_f',this)" value="1" /> 대역지정하기
			</div>
			<div style="float:left;padding-left:20px;margin:2px 5px;">
				<span style="color:#627DCE;" >[ 현재접속IP : <?=$accessIP?>  <input type="image" id="b1" src='../img/btn_s_apply.gif' onClick='fnApply();return false;' style='border:0;vertical-align:middle;cursor:pointer;' disabled /> ]</span>
				<input type="hidden" name="accessIP" value="<?=$ex_accessIP[0]?>" />
				<input type="hidden" name="accessIP" value="<?=$ex_accessIP[1]?>" />
				<input type="hidden" name="accessIP" value="<?=$ex_accessIP[2]?>" />
				<input type="hidden" name="accessIP" value="<?=$ex_accessIP[3]?>" />
			</div>
		</div>		

		<div class="extext" style="clear:both;margin:5px 0 0 3px;line-height:150%">
		최대 10개까지 접속가능 IP등록이 가능합니다. <br />
		IP대역대 등록은 4번째 입력란에만 적용할 수 있으며, 빈칸으로 두시면 대역대(0~255)로 등록됩니다.
		</div>
		<div style="color:#7F7F7F;"><b>※유동적으로 변경되는 IP를 등록시 접속이 제한되실 수 있으니 주의바랍니다.</b></div>
		
	</div>
	</td>
</tr>
<tr>
	<td>
	<div id="IP_list" disabled>		
		<? for($i=0; $i<$set_ip_cnt; $i++) { ?>
		<div id="regip_<?=$i?>" style="padding:4px 0px;">
			<span id="ip_addr_<?=$i?>" style="width:100px;"><?=$set_regist_ip[$i]?></span>&nbsp;&nbsp;&nbsp;<input type='hidden' id='regist_ip<?=$i?>' name='regist_ip[]' value='<?=$set_regist_ip[$i]?>' /><input type="image" id="bb<?=$i?>" src='../img/i_del.gif' onClick='javascript:delDIV(<?=$i?>);return false;' style='border:0;vertical-align:top;cursor:pointer;' disabled />
		</div>
		<? } ?>
	</div> 
	</td>
</tr>
</table>

<div class="button">
<input type="image" src="../img/btn_register.gif">
</div>

<script src="../ip_access.js"></script>

<?if($set_ip_permit == '0'){?><script>cl_none()</script><?}?>
<?if($set_ip_permit == '1'){?><script>cl_use()</script><?}?>


<? include "../_footer.php"; ?>