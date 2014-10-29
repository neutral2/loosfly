<?php
//POST값
$gubun			= $_POST['gubun'];
$s_type			= $_POST['s_type'];
$zipcode0		= $_POST['zipcode1'];
$zipcode1		= $_POST['zipcode2'];
$road_address	= $_POST['road_address'];
$address_sub	= $_POST['address_sub'];

if($_POST['ground_address']) {
	$address	= $_POST['ground_address'];
} else {
	$address		= $_POST['address'];
}
?>
<script type="text/javascript">
var gubun = "<?=$gubun?>";

if (gubun == "m")
{
	var o_zipcode0				= parent.opener.document.getElementById('m_zipcode0');
	var o_zipcode1				= parent.opener.document.getElementById('m_zipcode1');
	var o_address				= parent.opener.document.getElementById('m_address');
	var o_address_sub			= parent.opener.document.getElementById('m_address_sub');
	var o_road_address			= parent.opener.document.getElementById('m_road_address');
	var o_div_road_address		= parent.opener.document.getElementById("m_div_road_address");
	var o_div_road_address_sub	= parent.opener.document.getElementById("div_road_address_sub");
}
else {
	var o_zipcode0				= parent.opener.document.getElementById('zipcode0');
	var o_zipcode1				= parent.opener.document.getElementById('zipcode1');
	var o_address				= parent.opener.document.getElementById('address');
	var o_address_sub			= parent.opener.document.getElementById('address_sub');
	var o_road_address			= parent.opener.document.getElementById('road_address');
	var o_div_road_address		= parent.opener.document.getElementById("div_road_address");
	var o_div_road_address_sub	= parent.opener.document.getElementById("div_road_address_sub");
}

var s_type			= "<?=$s_type?>"; //주소검색 타입 zipcode : 기존 우편번호 검색 / road : 도로명주소 검색

var zipcode0		= "<?=$zipcode0?>";
var zipcode1		= "<?=$zipcode1?>";
var address			= "<?=$address?>";
var address_sub		= "<?=$address_sub?>";
var road_address	= "<?=$road_address?>";

o_zipcode0.value	= zipcode0;
o_zipcode1.value	= zipcode1;

if(s_type == "zipcode") {
	if (o_address_sub) { //나머지주소 필드가 따로 있을 경우
		o_address.value						= address;
		o_address_sub.value					= address_sub;
		o_road_address.value				= "";
		o_div_road_address.innerHTML		= "";
		o_div_road_address_sub.innerHTML	= "";
	} else {
		o_address.value						= address+" "+address_sub;
		o_road_address.value				= "";

		if(o_div_road_address) {
			o_div_road_address.innerHTML		= "";
		}
	}
} else {
	if (o_address_sub) { //나머지주소 필드가 따로 있을 경우
		o_address.value						= address;
		o_address_sub.value					= address_sub;
		o_road_address.value				= road_address;
		o_div_road_address.innerHTML		= road_address;
		o_div_road_address_sub.innerHTML	= address_sub;
		o_div_road_address_sub.style.display="";
	} else {
		o_address.value						= address+" "+address_sub;
		o_road_address.value				= road_address+" "+address_sub;

		if(o_div_road_address) {
			o_div_road_address.innerHTML	= road_address+" "+address_sub;
		}
	}
}
window.parent.close();
</script>