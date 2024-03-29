<? 
include "../../../lib/library.php";
include "../../../conf/config.php";
include "../../../conf/pg.$cfg[settlePg].php";
include "../../../conf/pg.escrow.php";

if ($escrow['type'] == 'INI') {
	include "./ini_escrow_gate.php";
	exit();
}

$ordno = $_GET[ordno];

$query = "
select 
	escrowno,deliverycomp,deliverycode,delivery,ddt  
from 
	".GD_ORDER." a
	left join ".GD_LIST_DELIVERY." b on a.deliveryno = b.deliveryno
where
	a.ordno = '$ordno'
";
$data = $db->fetch($query);
$year= substr($data[ddt],0,4);$mon= substr($data[ddt],4,2);$day= substr($data[ddt],6,2);
$frTime = mktime(0,0,0,$mon,$day,$year);
$toTime = mktime(0,0,0,$mon,$day,$year)+3600*24*3;
?>

<html>
<head>
<title>하나은행 매매보호 서비스 배송등록/수정 데모</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">

<style type="text/css">
	BODY{font-size:9pt; line-height:160%}
	TD{font-size:9pt; line-height:160%}
	A {color:blue;line-height:160%; background-color:#E0EFFE}
	INPUT{font-size:9pt;}
	SELECT{font-size:9pt;}
	.emp{background-color:#FDEAFE;}
</style>

<script language="Javascript">
	
function checkGLSHost(obj, obj0, obj1)
	{
		if (obj.value!="OTHEREXPRX") {
			if (obj.value=="choose") {
				alert ("이메일 도메인을 선택해 주세요. \n도메인 리스트에 없는 경우 직접 입력을 선택해 주세요.");
				obj0.value="";
				obj0.readOnly=true;
				obj0.style.background = "#DDDDDD";
				return false;
			}
			else {
				if(obj.value == "CJGLSLOGIS") {
				obj1.value="CJ GLS";
				}else if (obj.value == "HYUNDAIEXP"){
				obj1.value="현대택배";
				}else if (obj.value == "HANJINLOGI"){
				obj1.value="한진택배";
				}else if (obj.value == "KOREXEXPR"){
				obj1.value="대한통운";
				}else if (obj.value == "KGBLOGISTI"){
				obj1.value="KGB";
				}
				obj0.value=obj.value;
				obj1.readOnly=true;
				obj1.style.background = "#DDDDDD";
			}
		} else {
			obj0.value=obj.value;
			obj1.value="";
			obj1.readOnly=false;
			obj1.style.background = "white";
			obj1.focus();
		}
	}
	

function f_check(){
	if(document.all.hanatid.value == ""){
		alert("거래번호가 빠졌습니다.")
		return;
	}
	else if(document.all.mid.value == ""){
		alert("상점 아이디가 빠졌습니다.")
		return;
	}
	else if(document.all.EscrowType.value == ""){
		alert("에스크로 작업을 선택하십시요.")
		return;
	}
	else if(document.all.invno.value == ""){
		alert("운송장번호가 빠졌습니다.")
		return;
	}
	else if(document.all.transtype.value == ""){
		alert("배송종류가 빠졌습니다.")
		return;
	}
	document.ini.submit();
	
}

</script>

</head>

<body>
<form name=ini method=post action="sample/INIescrow.php">
<input type=hidden name=ordno value="<?=$ordno?>">

<table border=0 width=500>
	<tr>
	<td>
	<hr noshade size=1>
	<b>하나은행 매매보호 서비스 배송등록/수정 데모</b>
	<hr noshade size=1>
	</td>
	</tr>
</table>	
</table>
<br>

<table border=0 width=500>
<tr>
<td align=center>
<table width=500 cellspacing=0 cellpadding=0 border=0 bgcolor=#6699CC>
<tr>
<td>
<table width=100% cellspacing=1 cellpadding=2 border=0>
<tr bgcolor=#BBCCDD height=25>
<td align=center>
정보를 기입하신 후 확인버튼을 눌러주십시오
</td>
</tr>
<tr bgcolor=#FFFFFF>
<td valign=top>
<table width=100% cellspacing=0 cellpadding=2 border=0>
<tr>
<td align=center>
<br>
<table>
	<tr>
		<td width=30%>거래번호 : </td>
		<td width=70%><input type=text name=hanatid size=45 maxlength=40 value="<?=$data[escrowno]?>"></td>
	</tr>
	<tr>
		<td>상점 아이디 : </td>
		<td><input type=text name=mid size=15 maxlength=10 value="<?=$escrow[id]?>"</td>
	</tr>
	<tr>
		<td>에스크로 Type : </td>
		<td>	<select name=EscrowType >
			<option value="">선택하십시오
			<option value="dr" selected>1.배송등록
			<option value="du">2.배송수정
			</select>
		</td>
	</tr>
	
	<tr>
		<td>운송장 번호 : </td>
		<td><input type=text name=invno size=45 maxlength=40 value="<?=$data[deliverycode]?>"></td>
	</tr>
	
	<tr>
		<td>등록자 ID : </td>
		<td><input type=text name=adminID size=17 maxlength=12 value="<?=$sess[m_id]?>"></td>
	</tr>
	
	<tr>
		<td>등록자성명 : </td>
		<td><input type=text name=adminName size=25 maxlength=20 value="<?=$member[name]?>"></td>
	</tr>
	
	<tr>
		<td>배송회사 명 : </td>
		<td>	<input type=text name=compName size=40 maxlength=40 readOnly style="background-color:#DDDDDD"></td>
	</tr>
	
	
	<tr>
		<td>배송회사 ID : </td>
		<td>
		<select name="glsid_temp" onchange="javascript:checkGLSHost(this.form.glsid_temp, this.form.compID,this.form.compName)">
			 <option value=''>선택하십시오</option>
			<option value='CJGLSLOGIS'>CJ GLS:CJGLSLOGIS</option>
			<option value='HYUNDAIEXP'>현대택배:HYUNDAIEXP</option>
			<option value='HANJINLOGI'>한진택배:HANJINLOGI</option>
			<option value='KOREXEXPR'>대한통운:KOREXEXPR</option>
			<option value='KGBLOGISTI'>KGB:KGBLOGISTI</option>
			<option value='OTHEREXPRX'>기타:OTHEREXPRX</option>
		</select>
	    <input type="text" name="compID" size="15" readOnly style="background-color:#DDDDDD">	
	</td>
	</tr>
	
	<tr>
		<td>배송종류 : </td>
		<td>	<select name=transtype>
			<option value="" selected>선택하십시오
			<option value="S0" selected>1.일반배송 - S0
			<option value="S1">2.심야배송 - S1
			<option value="S2">3.주말배송 - S2
			<option value="S3">4.특급배송 - S3
			<option value="S4">5.빠른배송 - S4
			<option value="S5">6.제조사직배송 - S5
			</select>
		</td>
	</tr>
	
	<tr>
		<td>운송수단 : </td>
		<td>	<select name=transport >
			<option value="" selected>선택하십시오
			<option value="T0">1.화물차 - T0
			<option value="T1">2.이륜차 - T1
			<option value="T2">3.화물열차 - T2
			</select>
		</td>
	</tr>
	
	<tr>
		<td>배송비 : </td>
		<td>
		<input type=text name=transfee size=15 maxlength=10 value="<?=$data[delivery]?>">
		</td>
	</tr>
	
	<tr>
		<td>배송비 지급방법 : </td>
		<td>	<select name=paymeth >
			<option value="" selected>선택하십시오
			<option value="F0">1.선불 - F0
			<option value="F1">2.월불 - F1
			<option value="F2">3.착불 - F2
			</select>
		</td>
	</tr>
	
	<tr>
		<td>배송 주의사항 : </td>
		<td>	<select name=notice >
			<option value="" selected>선택하십시오
			<option value="C0">1.고가품 - C0
			<option value="C1">2.부패(변질) - C1
			<option value="C2">3.파손 - C2
			<option value="C3">4.상하 - C3
			<option value="C4">5.기타취급주의 - C4
			</select>
		</td>
	</tr>	
	<tr>
		<td>배송요청일자 (From) : </td>
		<td>	<input type=text name=transdate1 size=13 maxlength=8 value="<?=date("Ymd",$frTime)?>"></td>
	</tr>
	
	<tr>
		<td>배송요청일자 (To) : </td>
		<td>	<input type=text name=transdate2 size=13 maxlength=8 value="<?=date("Ymd",$toTime)?>"></td>
	</tr>
	
	<tr>
	<td colspan=2 align=center>
	<br>
	<input type="button" value="확 인" onClick=f_check()>
	<br><br>
	</td>
	</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>
<br>

</form>

<script>f_check();</script>

</body>
</html>