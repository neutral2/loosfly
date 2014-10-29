<?

$location = "인터파크 오픈스타일 입점 > 오픈스타일 입점신청 / 진행상황";
include "../_header.php";

?>
<div class="title title_top">오픈스타일 입점신청 / 진행상황 <span>인터파크 샵플러스 입점신청 및 진행상황을 확인합니다</span></div>
<style type="text/css">
.table_td_openstyle td{
	font-family: "돋움";
	font-size: 12px;
	line-height: 18px;
	color: #666666;	
}

img{
	border:0px;
}
</style>
<div id="promotion"><script>panel('promotion', 'interpark');</script></div>
<!-- 고도인터파크 부분 -->
<script id=script name=script src="http://godointerpark.godo.co.kr/outflowjs/OpenStyleProgress.js.php?godosno=<?=$godo[sno]?>&hashdata=<?=md5($godo[sno])?>"></script>
<!-- 고도 인터파크 부분 -->

<div style="padding-top:20px"></div>

<!-- <script>cssRound('MSG01')</script> -->

<? include "../_footer.php"; ?>