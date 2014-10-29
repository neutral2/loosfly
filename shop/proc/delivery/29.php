<?
	### 대한통운-미국상사  http://kglops.korex.co.kr:7070/kglops/RetrieveCuAmEMAILBlTrackList02.UserLogin.laf?hblNo=

	$out = split_betweenStr($out,"<body>","</body>");

	$out[0] = str_replace('images/','http://kglops.korex.co.kr:7070/kglops/images/',$out[0]);
?>

<style type="text/css">
<!--
.style1 {
	color: #999999;
	font-size: 18px;
}
.style2 {color: #003366}
-->
</style>

<?=$out[0]?>