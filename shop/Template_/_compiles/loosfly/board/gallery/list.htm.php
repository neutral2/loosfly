<?php /* Template_ 2.2.7 2014/10/24 11:31:33 /www/loosfly_godo_co_kr/shop/data/skin/loosfly/board/gallery/list.htm 000012691 */ 
if (is_array($TPL_VAR["list"])) $TPL_list_1=count($TPL_VAR["list"]); else if (is_object($TPL_VAR["list"]) && in_array("Countable", class_implements($TPL_VAR["list"]))) $TPL_list_1=$TPL_VAR["list"]->count();else $TPL_list_1=0;?>
<?php $this->print_("header",$TPL_SCP,1);?>

<script type="text/javascript" language="javascript">
	article_action=function(element, picPath) {
		document.getElementById(element).src = picPath;
	};
</script>

<style>
.archive_title a{ color:#71cbd2; }
.archive_title a:hover{ color:#f47d30; }
</style>
		<div style="width:1040px; margin:0 auto;font:normal 12px/20px  "나눔고딕", "Nanum Gothic", "AppleGothic", "맑은고딕", "Malgun Gothic", "돋움", "Dotum", "Sans-serif"; font-color:#3f3f3f; letter-spacing:0;">
			<div style="height:2px;"></div>
			<div style="width:255px; height:40px; background:#f5f5f5; margin:0 auto;text-align:center;">
				<span style="color:#a4a4a4; letter-spacing:3px; font:normal 14px/40px 'Courier New', Courier, monospace;">loosfly's stories</span>
			</div>
			<div style="height:15px;border:#cfcfcf 0 solid; border-bottom-width:1px;"></div>
			<div style="height:25px;"></div>
			<div style="position:relative;float:left;width:220px;">
				<div style="text-align:left;color:#3f3f3f;font-size:14px;letter-spacing:5px;">Archive</div>
				<div style="height:10px;"></div>
				<table width="100%" cellpadding="0" cellspacing="0" border="0">
<?php if($TPL_list_1){foreach($TPL_VAR["list"] as $TPL_V1){?>
					<tr><td><?php if($GLOBALS["bdUseSubSpeech"]&&$TPL_V1["category"]){?>[<?php echo $TPL_V1["category"]?>]<?php }?><span class="archive_title"><?php echo $TPL_V1["link"]["view"]?><?php echo $TPL_V1["subject"]?><?php echo $TPL_VAR["link"]["end"]?></span></td></tr>
<?php }}?>
				</table>
			</div>
			<div style="position:relative;float:left;width:20px;"></div>
			<div style="position:relative;float:right;width:800px;">
<?PHP if( $_GET['pg'] < 2 ) { ?>
<!------------------------------------------------------------------------------------------------------------------------------------------------------>
				<table width="100%" align="center" cellpadding="0" cellspacing="0" border="0" onmouseover="article_action('arc_pic07', '/shop/data/skin/loosfly/stories/img/stories_main_thumb_07a.jpg')" onmouseout="article_action('arc_pic07', '/shop/data/skin/loosfly/stories/img/stories_main_thumb_07.jpg')" style="cursor:pointer" onclick="location.href='/shop/board/view.php?id=stories&no=10&title=Collaboration Opening Film'">
				<tr>
					<td><img src="/shop/data/skin/loosfly/stories/img/stories_main_thumb_07.gif"></td>
					<td><img id="arc_pic07" src="/shop/data/skin/loosfly/stories/img/stories_main_thumb_07.jpg"></td>
				</tr>
				<tr><td colspan="2" height="60">
					늘 열정적으로 왕성한 활동을 펼치는 현대무용가 <span style="color:#71cbd2;font-size:14px;line-height:35px">최수진님의 새로운 프로젝트 연습장면을 담아보았습니다.</span><br>이루다, 이윤희, 강효형 등 쟁쟁한 무용가 여러분들과의 멋진 콜라보레이션이 기대됩니다.
				</td></tr>
				<tr><td colspan="2" height="15" style="border:#cfcfcf 0 solid; border-bottom-width:1px;"> </td></tr>
				<tr><td colspan="2" height="40"> </td></tr>
				</table>
<!------------------------------------------------------------------------------------------------------------------------------------------------------>
				<table width="100%" align="center" cellpadding="0" cellspacing="0" border="0" onmouseover="article_action('arc_pic06', '/shop/data/skin/loosfly/stories/img/stories_main_thumb_06a.jpg')" onmouseout="article_action('arc_pic06', '/shop/data/skin/loosfly/stories/img/stories_main_thumb_06.jpg')" style="cursor:pointer" onclick="location.href='/shop/board/view.php?id=stories&no=9&title=GRIPTION Rehearsal'">
				<tr>
					<td><img id="arc_pic06" src="/shop/data/skin/loosfly/stories/img/stories_main_thumb_06.jpg"></td>
					<td><img src="/shop/data/skin/loosfly/stories/img/stories_main_thumb_06.gif"></td>
				</tr>
				<tr><td colspan="2" height="60">
					<span style="color:#71cbd2;font-size:14px;line-height:35px">M Theater 신진안무가 Next B에 초청된 아트디렉터 최수진님 안무의 "Gription" 리허설을 렌즈에 담았습니다.</span><br>이해하기 쉬우면서도 독특한 안무와 최수진, 안남근, 이윤희 등 세분 무용수의 매력적인 몸짓이 돋보인 멋진 공연이었습니다.
				</td></tr>
				<tr><td colspan="2" height="15" style="border:#cfcfcf 0 solid; border-bottom-width:1px;"> </td></tr>
				<tr><td colspan="2" height="40"> </td></tr>
				</table>
<!------------------------------------------------------------------------------------------------------------------------------------------------------>
				<table width="100%" align="center" cellpadding="0" cellspacing="0" border="0" onmouseover="article_action('arc_pic05', '/shop/data/skin/loosfly/stories/img/stories_main_thumb_05a.jpg')" onmouseout="article_action('arc_pic05', '/shop/data/skin/loosfly/stories/img/stories_main_thumb_05.jpg')" style="cursor:pointer" onclick="location.href='/shop/board/view.php?id=stories&no=8&title=MOTION FIVE Rehearsal'">
				<tr>
					<td><img src="/shop/data/skin/loosfly/stories/img/stories_main_thumb_05.gif"></td>
					<td><img id="arc_pic05" src="/shop/data/skin/loosfly/stories/img/stories_main_thumb_05.jpg"></td>
				</tr>
				<tr><td colspan="2" height="60">
					<span style="color:#71cbd2;font-size:14px;line-height:35px">미나유 선생님의 열정이 담긴 Motion Five공연 리허설 장면입니다.</span><br>미나유선생님의 식지 않는 열정과 김성용, 김영진, 최수진, 기은주, 김지형 다섯분 무용수들의 에너지가 어우러진 인상깊은 무대였습니다.
				</td></tr>
				<tr><td colspan="2" height="15" style="border:#cfcfcf 0 solid; border-bottom-width:1px;"> </td></tr>
				<tr><td colspan="2" height="40"> </td></tr>
				</table>
<!------------------------------------------------------------------------------------------------------------------------------------------------------>
				<table width="100%" align="center" cellpadding="0" cellspacing="0" border="0" onmouseover="article_action('arc_pic04', '/shop/data/skin/loosfly/stories/img/stories_main_thumb_04a.jpg')" onmouseout="article_action('arc_pic04', '/shop/data/skin/loosfly/stories/img/stories_main_thumb_04.jpg')" style="cursor:pointer" onclick="location.href='/shop/board/view.php?id=stories&no=7&title=Soojin in the Showroom'">
				<tr>
					<td><img id="arc_pic04" src="/shop/data/skin/loosfly/stories/img/stories_main_thumb_04.jpg"></td>
					<td><img src="/shop/data/skin/loosfly/stories/img/stories_main_thumb_04.gif"></td>
				</tr>
				<tr><td colspan="2" height="60">
					<span style="color:#f47d30;font-size:14px;line-height:35px">루스플라이 아트디렉터인 현대무용가 최수진씨가 쇼룸을 찾아주셨습니다.</span><br>새로 만들어진 제품들을 테스트해보면서 다양한 의견을 교환했는데요, 항상 에너지 가득하고 열정에 차 있는 최수진씨의 모습을 렌즈에 담아봤습니다.
				</td></tr>
				<tr><td colspan="2" height="15" style="border:#cfcfcf 0 solid; border-bottom-width:1px;"> </td></tr>
				<tr><td colspan="2" height="40"> </td></tr>
				</table>
<!------------------------------------------------------------------------------------------------------------------------------------------------------>
				<table width="100%" align="center" cellpadding="0" cellspacing="0" border="0" onmouseover="article_action('arc_pic03', '/shop/data/skin/loosfly/stories/img/stories_main_thumb_03a.jpg')" onmouseout="article_action('arc_pic03', '/shop/data/skin/loosfly/stories/img/stories_main_thumb_03.jpg')" style="cursor:pointer" onclick="location.href='/shop/board/view.php?id=stories&no=5&title=Soojin - Music Video Shooting'">
				<tr>
					<td><img src="/shop/data/skin/loosfly/stories/img/stories_main_thumb_03.gif"></td>
					<td><img id="arc_pic03" src="/shop/data/skin/loosfly/stories/img/stories_main_thumb_03.jpg"></td>
				</tr>
				<tr><td colspan="2" height="60">
					<span style="color:#71cbd2;font-size:14px;line-height:35px">월간윤종신 11월호 '그댄 여전히 멋있는 사람' 뮤직비디오</span>에 출연한 루스플라이 아트디렉터 겸 메인모델 최수진씨의 촬영장 화보입니다.<br>힘든 상황에서도 지치지 않는 열정으로 프로다운 멋진 모습을 보여주었습니다.
				</td></tr>
				<tr><td colspan="2" height="15" style="border:#cfcfcf 0 solid; border-bottom-width:1px;"> </td></tr>
				<tr><td colspan="2" height="10"> </td></tr>
				<tr><td colspan="2" height="20" align=right><a href="http://www.loosfly.com/shop/board/list.php?id=stories&pg=2">next >></a></td></tr>
				<tr><td colspan="2" height="40"> </td></tr>
				</table>
<?PHP } else { ?>
<!------------------------------------------------------------------------------------------------------------------------------------------------------>
				<table width="100%" align="center" cellpadding="0" cellspacing="0" border="0" onmouseover="article_action('arc_pic02', '/shop/data/skin/loosfly/stories/img/stories_main_thumb_02a.jpg')" onmouseout="article_action('arc_pic02', '/shop/data/skin/loosfly/stories/img/stories_main_thumb_02.jpg')" style="cursor:pointer" onclick="location.href='/shop/board/view.php?id=stories&no=6&title=Joomi in the Dance Studio'">
				<tr>
					<td><img id="arc_pic02" src="/shop/data/skin/loosfly/stories/img/stories_main_thumb_02.jpg"></td>
					<td><img src="/shop/data/skin/loosfly/stories/img/stories_main_thumb_02.gif"></td>
				</tr>
				<tr><td colspan="2" height="60">
					<span style="color:#f47d30;font-size:14px;line-height:35px">떠오르는 현대무용가 이주미</span>씨의 개인 안무연습 화보입니다.<br>공연을 앞두고 안무구상과 연습에 몰두하는 아름다운 모습을 렌즈에 담아봤습니다.
				</td></tr>
				<tr><td colspan="2" height="15" style="border:#cfcfcf 0 solid; border-bottom-width:1px;"> </td></tr>
				<tr><td colspan="2" height="40"> </td></tr>
				</table>
<!------------------------------------------------------------------------------------------------------------------------------------------------------>
				<table width="100%" align="center" cellpadding="0" cellspacing="0" border="0" onmouseover="article_action('arc_pic01', '/shop/data/skin/loosfly/stories/img/stories_main_thumb_01a.jpg')" onmouseout="article_action('arc_pic01', '/shop/data/skin/loosfly/stories/img/stories_main_thumb_01.jpg')" style="cursor:pointer" onclick="location.href='/shop/board/view.php?id=stories&no=4&title='Designed by Dance and Dreams">
				<tr>
					<td><img id="arc_pic01" src="/shop/data/skin/loosfly/stories/img/stories_main_thumb_01.jpg"></td>
					<td><img src="/shop/data/skin/loosfly/stories/img/stories_main_thumb_01.gif"></td>
				</tr>
				<tr><td colspan="2" height="60">
					루스플라이의 모든 제품은 <span style="color:#71cbd2;font-size:14px;line-height:35px">댄스앤드림에서 디자인</span>됩니다.
				</td></tr>
				<tr><td colspan="2" height="15" style="border:#cfcfcf 0 solid; border-bottom-width:1px;"> </td></tr>
				<tr><td colspan="2" height="40"> </td></tr>
				</table>
<!------------------------------------------------------------------------------------------------------------------------------------------------------>
				<table width="100%" align="center" cellpadding="0" cellspacing="0" border="0" onmouseover="article_action('arc_pic00', '/shop/data/skin/loosfly/stories/img/stories_main_thumb_00a.jpg')" onmouseout="article_action('arc_pic00', '/shop/data/skin/loosfly/stories/img/stories_main_thumb_00.jpg')" style="cursor:pointer" onclick="location.href='/shop/board/view.php?id=stories&no=3&title=Soojin in the Media'">
				<tr>
					<td><img src="/shop/data/skin/loosfly/stories/img/stories_main_thumb_00.gif"></td>
					<td><img id="arc_pic00" src="/shop/data/skin/loosfly/stories/img/stories_main_thumb_00.jpg"></td>
				</tr>
				<tr><td colspan="2" height="60">
					2013년 여름 다양한 장르의 댄스를 선보였던 <span style="color:#f47d30;font-size:14px;">m.net 댄싱9 시즌1 홍보영상 촬영현장</span>스케치입니다.<br>열심히 촬영에 임하고 계신 최수진씨의 모습을 담아봤습니다.
				</td></tr>
				<tr><td colspan="2" height="15" style="border:#cfcfcf 0 solid; border-bottom-width:1px;"> </td></tr>
				<tr><td colspan="2" height="10"> </td></tr>
				<tr><td colspan="2" height="20" align=left><a href="http://www.loosfly.com/shop/board/list.php?id=stories"><< previous</a></td></tr>
				<tr><td colspan="2" height="40"> </td></tr>
				</table>
<!------------------------------------------------------------------------------------------------------------------------------------------------------>
<?PHP } ?>
			</div>
		</div>
<?php $this->print_("footer",$TPL_SCP,1);?>