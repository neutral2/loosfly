<?
$now = time();

// �ٸ� ���������� �ҷ����⵵ �ϹǷ� ġȯ�Ѵ�.
$type = isset($_POST['type']) ? $_POST['type'] : 1;

### �з��� ���� üũ
$query = "SELECT category,count(*) cnt FROM ".GD_SMS_SAMPLE." GROUP BY category";
$res = $db->query($query);
while ($data=$db->fetch($res)) $cnt[$data[category]] = $data[cnt];
?>

<script language="JavaScript" type="text/JavaScript">
function clearBg(obj){
	obj.style.backgroundImage = "url(../img/long_message01_none.gif)";
}
function chg_sms_type(){
	if(document.getElementsByName('sms_type')[0].checked == true){
		document.getElementById("tr_sms_msg").style.display = "table-row";
		document.getElementById("tr_lms_subject").style.display = "none";
		document.getElementById("tr_lms_msg").style.display = "none";
		document.getElementById("sms_msg").disabled = false;
		document.getElementById("lms_subject").disabled = true;
		document.getElementById("lms_msg").disabled = true;
		document.getElementsByName('vLength')[0].style.color = "#000";
		document.getElementById("byte_limit").innerHTML = "80 Byte";
		if(document.getElementById("lms_msg").value){
			var str = document.getElementById("lms_msg").value;
			if (chkByte(str)>80){
				alert("SMS ������ 80bytes���� �Դϴ�.");
				str = strCut(str,80);
			}
			document.getElementById("sms_msg").value = str;
			document.getElementById("sms_msg").focus();
			document.getElementById("sms_msg").value = document.getElementById("sms_msg").value + '';
			document.getElementsByName('vLength')[0].value = chkByte(str);
			document.getElementById("lms_subject").value = '';
			document.getElementById("lms_msg").value = '';
		}
	} else {
		alert("LMS ���� ����� �ΰ� �Ǹ� �ִ� 2000bytes ���� ���� ���� �մϴ�.");
		document.getElementById("tr_sms_msg").style.display = "none";
		document.getElementById("tr_lms_subject").style.display = "table-row";
		document.getElementById("tr_lms_msg").style.display = "table-row";
		document.getElementById("sms_msg").disabled = true;
		document.getElementById("lms_subject").disabled = false;
		document.getElementById("lms_msg").disabled = false;
		document.getElementsByName('vLength')[0].style.color = "#f00";
		document.getElementById("byte_limit").innerHTML = "2000 Byte";
		if(document.getElementById("sms_msg").value){
			var str = document.getElementById("sms_msg").value;
			document.getElementById("lms_msg").value = str;
			document.getElementById("lms_msg").focus();
			document.getElementById("lms_msg").value = document.getElementById("lms_msg").value + '';
			document.getElementsByName('vLength')[0].value = chkByte(str);
			document.getElementById("sms_msg").value = '';
		}
	}
}
function insChr(str)
{
	if(document.getElementsByName('sms_type')[0].checked == true){
		var msg = 	document.getElementById("sms_msg");
	} else {
		var msg = 	document.getElementById("lms_msg");
	}
	msg.value = msg.value + str;
	chkLength(msg,'m');
}
function chkLength(obj,tcode){
	str = obj.value;
	if(tcode == 's'){
		if(document.getElementsByName('sms_type')[1].checked == true){
			var specialChars = /[\{\}\[\]\/?.,;:|\)*~`!^\-_+<>@\#$%&\\\=\(\'\"]/gi;
			if(specialChars.test(str)){
				alert("Ư�� ���ڴ� ��� �� �� �����ϴ�.");
				obj.value = str.split(specialChars).join("");
				str = obj.value;
				document.getElementsByName('vLength')[0].value = parseInt(chkByte(str),10) + parseInt(chkByte(document.getElementById("lms_msg").value),10);
				return;
			}
			var strByte = parseInt(chkByte(str),10) + parseInt(chkByte(document.getElementById("lms_msg").value),10);
			if (strByte>2000){
				alert("����� ������ �޽����� 2000bytes�� ���� �� �����ϴ�.");
				var cutByte = 2000 - parseInt(chkByte(document.getElementById("lms_msg").value),10);
				obj.value = strCut(str,cutByte);
				str = obj.value;
				document.getElementsByName('vLength')[0].value = parseInt(chkByte(str),10) + parseInt(chkByte(document.getElementById("lms_msg").value),10);
			}
			if (chkByte(str)>40){
				alert("������ 40bytes���� �Դϴ�.");
				obj.value = strCut(str,40);
				str = obj.value;
				document.getElementsByName('vLength')[0].value = parseInt(chkByte(str),10) + parseInt(chkByte(document.getElementById("lms_msg").value),10);
				return;
			} else {
				document.getElementsByName('vLength')[0].value = parseInt(chkByte(str),10) + parseInt(chkByte(document.getElementById("lms_msg").value),10);
			}
		}
	} else if(tcode == 'm'){
		if(document.getElementsByName('sms_type')[0].checked == true){
			document.getElementsByName('vLength')[0].value = chkByte(str);
			if (chkByte(str)>80){
				alert("�޽����� 80bytes�� �ʰ��Ͽ� LMS ����� �ΰ� �Ǹ� �ִ� 2000bytes ���� ���� ���� �մϴ�.");
				document.getElementsByName('sms_type')[1].checked = true;
				document.getElementById("tr_sms_msg").style.display = "none";
				document.getElementById("tr_lms_subject").style.display = "table-row";
				document.getElementById("tr_lms_msg").style.display = "table-row";
				document.getElementById("sms_msg").disabled = true;
				document.getElementById("lms_subject").disabled = false;
				document.getElementById("lms_msg").disabled = false;
				document.getElementsByName('vLength')[0].style.color = "#f00";
				document.getElementById("byte_limit").innerHTML = "2000 Byte";
				document.getElementById("lms_msg").value = str;
				document.getElementById("lms_msg").focus();
				document.getElementById("lms_msg").value = document.getElementById("lms_msg").value + '';
			}
		} else {
			var strByte = parseInt(chkByte(str),10) + parseInt(chkByte(document.getElementById("lms_subject").value),10);
			if (strByte>2000){
				alert("�޽����� 2000bytes�� �ʰ��� �� �����ϴ�.");
				var cutByte = 2000 - parseInt(chkByte(document.getElementById("lms_subject").value),10);
				obj.value = strCut(str,cutByte);
				str = obj.value;
			}
			//LMS �� ����� �޼��� ���� 2000byte
			document.getElementsByName('vLength')[0].value = parseInt(chkByte(str),10) + parseInt(chkByte(document.getElementById("lms_subject").value),10);
		}
		// �޼��� ������ ���� �� �ٽ� sms �� ��ȯ �Ǵ� �κ��� ��ܿ� ���� �Ͽ� ��ȯ�ϴ� �κа� ���� �ʾ� ����
	}
}

function fnSMSReserve(v) {

	if (v == 1) {
		$('reserve_date_wrap').setStyle({display:'inline'});
	}
	else {
		$('reserve_date_wrap').setStyle({display:'none'});

	}

}

</script>

<table cellpadding="0" cellspacing="0" border="0">
<tr>
	<td valign="top">

		<table>
		<tr>
			<td>
			<table width="146" cellpadding="0" cellspacing="0" border="0">
			<tr>
				<td style="font-size:11px;"><input type="radio" name="sms_type" value="sms" onClick="chg_sms_type();" checked style="border:none;">SMS(�ܹ�)
				<input type="radio" name="sms_type" value="lms" onClick="chg_sms_type();" style="border:none;">LMS(�幮)</td>
			</tr>
			<tr>
				<td style="height:56px;background:url('../img/sms_top.gif') no-repeat top left;text-align:right;"><a href="javascript:openLayer('special');" onfocus="blur();"><img src="../img/btn_smstext.gif" style="margin-right:15px;margin-bottom:5px;"/></a></td>
			</tr>
			<tr id="tr_sms_msg">
				<td background="../img/sms_bg.gif" align="center" height="81"><textarea name="sms_msg" id="sms_msg" style="font:9pt ����ü;overflow:hidden;border:0;width:98px;height:74px; background:url(../img/short_message01.gif) no-repeat;" onkeydown="chkLength(this,'m');" onkeyup="chkLength(this,'m');" onchange="chkLength(this,'m');" onFocus="clearBg(this);" required msgR="�޼����� �Է����ּ���"></textarea></td>
			</tr>
			<tr id="tr_lms_subject" style="display:none;">
				<td background="../img/sms_subject_bg.gif" align="center" height="38"><textarea name="lms_subject" id="lms_subject" style="font:9pt ����ü;overflow:hidden;border:0;width:98px;height:31px; background:url(../img/long_message01.gif) no-repeat;" onkeydown="chkLength(this,'s');" onkeyup="chkLength(this,'s');" onchange="chkLength(this,'s');" onFocus="clearBg(this);" disabled></textarea></td>
			</tr>
			<tr id="tr_lms_msg" style="display:none;">
				<td background="../img/sms_long_bg.gif" align="center" height="127"><textarea name="lms_msg" id="lms_msg" style="font:9pt ����ü;overflow:hidden;border:0;padding-top:3px;width:98px;height:110px; background:url(../img/long_message02.gif) no-repeat" onkeydown="chkLength(this,'m');" onkeyup="chkLength(this,'m');" onchange="chkLength(this,'m');" onFocus="clearBg(this);" required msgR="�޼����� �Է����ּ���" disabled></textarea></td>
			</tr>
			<tr><td height="31" background="../img/sms_bottom.gif" align="center"><input name="vLength" type="text" style="width:26px;text-align:right;border:0;font-size:8pt;font-style:verdana;" value="0">/<font class="ver8" color="#262626" id="byte_limit">80 Bytes</font></td></tr>
			</table>

			</td>
		</tr>

		<tr>
			<td align="center">
			<? if ($is_sms_selector === true)  { ?>
			<input type="image" onClick="fnSetSmsMessage();return false;" src="../img/btn_smsreg.gif" class="null" />

			<? } else { ?>
			<input type="image" src="../img/btn_smssend.gif" class="null" />
			<? } ?>

			</td>
		</tr>
		</table>

	</td>
	<td valign="top">

		<br>

		<!-- Ư�� ���� ǥ -->
		<table id="special" style="position:absolute;border:1px solid #cccccc;background:#f7f7f7;padding:5px;display:none;">
		<tr>
			<? for ($i=0;$i<count($r_sms_chr);$i++){ ?>
			<td style="border:1px solid #dddddd;width:20px;height:20px;background:#ffffff" align="center" onClick="insChr(this.innerHTML);" class="hand" onmouseover="this.style.background='#FFC0FF'" onmouseout="this.style.background=''">
			<?=$r_sms_chr[$i]?>
			</td>
			<? if ($i%15==14){ ?></tr><tr><? } ?>
			<? } ?>
		</tr>
		</table>
		<!-- Ư�� ���� ǥ -->


		<table class=tb>
		<col class=cellC><col class=cellL>
		<tr>
			<td>���� SMS ����Ʈ</td>
			<td><span id="span_sms" style="font-weight:bold"><font class="ver9" color="0074ba"><b><?=number_format(getSmsPoint())?></b></font></span><font color="262626">��</font>

			<a href="javascript:location.href='../member/sms.pay.php';"><img src="../img/btn_smspoint.gif" align="absmiddle"></a>

			</td>
		</tr>
		<tr>
			<td width="100">�����»��</td>
			<td><input type="text" name="callback" value="<?=str_replace("-","",$cfg[smsRecall])?>" size="12"  class="line"/></td>
		</tr>

		<tr>
			<td>�޴»��</td>
			<td>
				<? if ($type == 1) { ?>
					<? if ($total > 1) { ?>
					�� �߼� �ο� <?=number_format($total)?> ��
					<textarea name="phone" style="display:none;"><?=$phone?></textarea>
					<? } else { ?>
					<input type="text" name="phone" value="<?=str_replace("-","",$phone)?>" size="12"> (<?=number_format($total)?> ��)
					<? } ?>
				<? } else { ?>
				<?=$to_tran?> (<?=number_format($total)?> ��)
				<? } ?>
			</td>
		</tr>
		<tr>
			<td>�߼ۼ���</td>
			<td>
			<label class="noline"><input type="radio" name="reserve" value="0" onClick="fnSMSReserve(0);" checked>��ù߼�</label>
			<label class="noline"><input type="radio" name="reserve" value="1" onClick="fnSMSReserve(1);" >����߼�</label>

			<div id="reserve_date_wrap" style="display:none;">
			<input class="line" type="text" name="reserve_date" id="reserve_date" value="<?=date('Ymd',$now)?>" onclick="calendar(event)" onkeydown="onlynumber()" >

			<select name="reserve_hour">
				<? $h = date('H',$now + 3600); ?>
				<? for ($i=1;$i<=24;$i++) { ?>
				<option value="<?=$i?>" <?=($i == $h ? 'selected' : '')?>><?=$i?>��</option>
				<? } ?>
			</select>

			<select name="reserve_minute">
				<? for ($i=0;$i<=60;$i = $i + 10) { ?>
				<option value="<?=$i?>"><?=$i?>��</option>
				<? } ?>
			</select>
			</div>
			</td>
		</tr>
		<tr>
			<td>�߼���Ȳ</td>
			<td>
				<div style="background:#D7D7D7;border:0 solid #C5C5C5;width:100%;height:10px;font-size:0;margin-bottom:10px;">
				<div id="sms_bar" style="width:0;height:10px;font-size:0;background:#ff0000;"></div>
				</div>
			</td>
		</tr>
		</table>

		<br>

		<font color="262626"><b><font size="1" face="helvetica">��</font> ���ڸ޼�������</b></font> &nbsp;<span class="small"><font class="small" color="444444">�޼����� Ŭ���ϸ� �޼���â�� �ٷ� �Է��� �˴ϴ�</font></span>&nbsp;&nbsp;
		<a href="javascript:popupLayer('../member/sms.sample_reg.php?mode=sms_sample_reg');"><img src="../img/btn_smsadd.gif" align="absmiddle" /></a>

		<div style="height:5;font-size:0"></div>
		<table border="1" bordercolor="#dddddd" style="border-collapse:collapse;">
		<col align="center" span="10">
		<tr>
			<td width="100"><a href="sms.sample_list.php?ifrmScroll=1" target="ifrmSms"><font class="small1" color="161616">��ü����</font></a></td>
			<? $idx=1; foreach($r_sms_category as $v){ ?>
			<td width="100" height="25"><a href="sms.sample_list.php?ifrmScroll=1&category=<?=$v?>" target="ifrmSms"><font class="small" color="161616"><?=$v?></a> (<font color="0074ba"><b><?=number_format($cnt[$v])?></b></font>)</td>
			<? if (++$idx%6==0){ ?></tr><tr><? } ?>
			<? } ?>
		</tr>
		</table>

		<iframe id="ifrmSms" name="ifrmSms" src="../member/sms.sample_list.php?ifrmScroll=1" style="width:100%;height:100px" frameborder="0" scrolling="no"></iframe>

	</td>
</tr>
</table>
</div>

<script>
table_design_load();
</script>