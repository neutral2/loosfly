<?php /* Template_ 2.2.7 2014/03/03 15:41:12 /www/loosfly_godo_co_kr/shop/data/skin/loosfly/service/company.htm 000004868 */  $this->include_("dataBanner");?>
<?php $this->print_("header",$TPL_SCP,1);?>


<?php if($this->tpl_['side_inc']){?>
		<div class="blkLeftMenu">
<?php $this->print_("side_inc",$TPL_SCP,1);?>

		</div>
<?php }?>

<?PHP
	if( $_GET['tt'] == 1) {
?>
		<div id="blkContents">
			<div style="height:7px;"></div>
			<!-- 상단이미지 -->
			<div id="bxBodyTitle">
				<img src="/shop/data/skin/loosfly/img/jimmy/titles/showroom_title_01.gif" border=0>
			</div>
			<div style="height:20px;"></div>
			<div class="divindiv"><!-- Start indiv -->
				<table width="100%" cellSpacing="0" cellPadding="0" border="0" align="center">
				<tr>
					<td style="padding-left:20px;font-size:13px;line-height:20px">
						저희 루스플라이는 고객 여러분의 편의를 위해 오프라인 쇼룸을 운영하고 있습니다.<BR><BR>
						쇼룸을 방문하시면 루스플라이 전제품을 직접 체험하실 수 있으며<BR>사이즈, 색상등 일반적인 상담은 물론 앞으로 계획중인 맞춤제품에 관한 상담도 받아 보실 수 있습니다.<BR><BR>
						쇼룸 위치는 서울시 강남구 논현2동 99-22 예랑빌딩 4층입니다.<BR>아래의 약도와 찾아오시는 길 동영상을 참조하시면 됩니다.<BR>
					</td>
				</tr>
				<tr><td height="30"> </td></tr>
				<tr><td valign="bottom"><b>□ 루스플라이 쇼룸 전경</b></td></tr>
				<tr>
					<td><img src="/shop/data/skin/loosfly/img/jimmy/shop_photo/service/showroom_img_01.jpg" border=0></td>
				</tr>
				<tr><td height="30"> </td></tr>
				<tr><td valign="bottom"><b>□ 루스플라이 쇼룸 약도(청담CGV를 중심으로)</b></td></tr>
				<tr>
					<td><img src="/shop/data/skin/loosfly/img/jimmy/shop_photo/service/showroom_map_01.gif" border=0></td>
				</tr>
				<tr><td height="30"> </td></tr>
				<tr>
					<td align="center"><object width="800" height="415"><param name="movie" value="/shop/data/skin/loosfly/img/jimmy/shop_photo/service/way_to_showroom.mp4"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="/shop/data/skin/loosfly/img/jimmy/shop_photo/service/way_to_showroom.mp4" width="800" height="415" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="false"></embed></object></td>
				</tr>
				<tr><td height="50"> </td></tr>
				</table>
			</div><!-- End indiv -->
		</div>
<?PHP
	}
	else {
?>
		<div id="blkContents">
			<div style="height:7px;"></div>
			<!-- 상단이미지 -->
			<div id="bxBodyTitle">
				<img src="/shop/data/skin/loosfly/img/jimmy/titles/aboutloosfly_title_01.gif" border=0>
			</div>
			<div style="height:20px;"></div>
			<div class="divindiv"><!-- Start indiv -->
				<table width="100%" cellSpacing="0" cellPadding="0" border="0">
				<tr>
					<td><!-- 회사소개 로고 (배너관리에서 수정가능) --><?php if((is_array($TPL_R1=dataBanner( 23))&&!empty($TPL_R1)) || (is_object($TPL_R1) && in_array("Countable", class_implements($TPL_R1)) && $TPL_R1->count() > 0)) {foreach($TPL_R1 as $TPL_V1){?><?php echo $TPL_V1["tag"]?><?php }}?></td>
				</tr>
				<tr>
					<td style="padding-left:40px;font-size:13px;line-height:20px"><B>loosfly 루스플라이</B><BR><BR>
						loosfly는 loose와 fly의 합성어입니다.<BR>
						늘 긴장속에서 서로를 의식하고, 치열하게 경쟁하면서 사는 삶이 아닌,<BR>스스로 즐기면서 하늘을 날듯이 여유롭게 무대위를 날고자 하는 꿈을 나타낸 말입니다.<BR><BR>
						루스플라이는 2013년 2월에 설립되었습니다.<BR>하지만 지난 20여년간 무용의상 제작에 전념해 온 디자이너들의 노하우와<BR> 최고 수준에 있는 현역 무용가들의 열정이 만나 탄생된 제품들 입니다.<BR>
						기능성 원단을 사용함은 물론, 오랜시간 연구해 온 인체에 대한 심도있는 분석과 과학적인 패턴,<BR> 그리고 최신 패션 트렌드가 어우러져 세련되고 돋보이면서도 편안한 착용감을 주는 dance wear가 탄생했습니다.<BR><BR><BR>

						<B>smart clothing</B><BR><BR>
						예쁜 옷은 불편하다?  편한 옷은 예쁘지 않다?<BR>
						루스플라이의 제품들은 매력적인 디자인으로 당신을 돋보이게 만들면서도, 보이지 않는 부분에 숨어있는 원단의 기능성,<BR> 과학적이고 입체적인 패턴들이 편안한 착용감을 제공하여 어떤 동작에도 불편함이 없습니다.<BR>
						예쁘면서도 편안한 옷. 이제 루스플라이가 만들어 드립니다.<BR><BR><BR>

						<B>Where we are...</B><BR><BR>
						<img src="/shop/data/skin/loosfly/img/jimmy/map_02.gif"><BR>
					</td>
				</tr>
				<tr>
					<td height="30"> </td>
				</tr>
				<tr>
					<td align="center" colspan="2"><!-- 회사약도 (배너관리에서 수정가능) --><?php if((is_array($TPL_R1=dataBanner( 22))&&!empty($TPL_R1)) || (is_object($TPL_R1) && in_array("Countable", class_implements($TPL_R1)) && $TPL_R1->count() > 0)) {foreach($TPL_R1 as $TPL_V1){?><?php echo $TPL_V1["tag"]?><?php }}?></td>
				</tr>
				</table>
			</div><!-- End indiv -->
		</div>
<?PHP } ?>
<?php $this->print_("footer",$TPL_SCP,1);?>