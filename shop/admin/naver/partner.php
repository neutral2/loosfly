<?

@include "../../conf/partner.php";

$location = "네이버 지식쇼핑 > 지식쇼핑 설정";
include "../_header.php";

// 상품가격 설정
$inmemberdc = ($partner['unmemberdc'] == 'Y' ? 'N' : 'Y');
$incoupon = ($partner['uncoupon'] == 'Y' ? 'N' : 'Y');
$naver_version = $partner['naver_version'];
$useYn = $partner['useYn'];
$checked['cpaAgreement'][$partner['cpaAgreement']] = "checked";
$checked['inmemberdc'][$inmemberdc] = "checked";
$checked['incoupon'][$incoupon] = "checked";
$checked['naver_version'][$naver_version] = "checked";
$checked['useYn'][$useYn] = "checked";

if(isset($partner['cpaAgreementTime'])===false && $partner['cpaAgreement']==='true')
{
	$partner['cpaAgreementTime'] = date('Y.m.d h:i', filemtime(dirname(__FILE__).'/../../conf/partner.php'));
	require_once dirname(__FILE__).'/../../lib/qfile.class.php';
	$qfile = new qfile();
	$partner = array_map("addslashes",array_map("stripslashes",$partner));
	$qfile->open(dirname(__FILE__).'/../../conf/partner.php');
	$qfile->write("<? \n");
	$qfile->write("\$partner = array( \n");
	foreach ($partner as $k=>$v) $qfile->write("'$k' => '$v', \n");
	$qfile->write(") \n;");
	$qfile->write("?>");
	$qfile->close();
}
?>

<?php include dirname(__FILE__).'/../naverCommonInflowScript/configure.php'; ?>

<div class="title title_top">지식쇼핑 설정<span> <a href="javascript:manual('<?=$guideUrl?>board/view.php?id=marketing&no=2')"><img src="../img/btn_q.gif" border=0 align=absmiddle hspace=2></a></div>

<table border=4 bordercolor=#dce1e1 style="border-collapse:collapse; width: 800px;">
<tr><td style="padding:7 0 10 10">
<div style="padding-top:5"><b><font color="#bf0000">*필독*</font> 네이버 지식쇼핑 버전설정 안내입니다.</b></div>
<div style="padding-top:7"><font class=g9 color=666666>지식쇼핑 상품DB URL 버전이 업그레이드(1.0 → 2.0) 되었습니다.</font></div>
<div style="padding-top:5"><font class=g9 color=666666>업그레이드된 버전 변경관련 유의사항 입니다. 반드시 확인하신 후 변경해 주시길 바랍니다.</font></div>
<div style="padding-top:5"><font class=g9 color=666666>1) 지식쇼핑 1.0 사용 상점이 버전 변경을 원하지 않는 경우</font></div>
<div style="padding-top:5"><font class=g9 color=666666>&nbsp;&nbsp;&nbsp;&nbsp;- 기존의 사용하시던 1.0버전으로도 지식 쇼핑 서비스를 이용하실 수 있습니다.</font></div>
<div style="padding-top:5"></div>
<div style="padding-top:5"><font class=g9 color=666666>2) 지식쇼핑 1.0 고객이 2.0으로 변경하고자 하는 경우</font></div>
<div style="padding-top:5"><font class=g9 color=666666>&nbsp;&nbsp;&nbsp;&nbsp;- 지식쇼핑 2.0 으로 변경이 가능합니다.</font></div>
<div style="padding-top:5"><font class=g9 color=666666>&nbsp;&nbsp;&nbsp;&nbsp;단, 상점의 지식 쇼핑 버전과 네이버 지식쇼핑에 설정된 EP버전이 동일해야 합니다. </font><font color="#bf0000"><U>동일하게 설정되지 않은 경우 상품 Data가 모두 삭제됩니다.</U></font></div>
<div style="padding-top:5"><font class=g9 color=666666>&nbsp;&nbsp;&nbsp;&nbsp;*버전 변경 방법*&nbsp;</font></div>
<div style="padding-top:5"><font class=g9 color=666666>&nbsp;&nbsp;&nbsp;&nbsp;먼저 네이버 쇼핑광고센터(구MMC) > 상품관리 > 업데이트 현황 > 쇼핑몰 상품DB(EP) URL에서 2.0 으로 직접 설정할 수 있습니다.<a href="http://adadmin.shopping.naver.com/login/login_start" target="_blank">[설정하기]</a></font></div>
<div style="padding-top:5"><font class=g9 color=666666>&nbsp;&nbsp;&nbsp;&nbsp;네이버에서 2.0 으로 변경한 후 고도 솔루션 관리자 페이지에서도 2.0 으로 변경을 해주셔야 합니다. 관련문의 : 고도 마케팅팀 02-567-3719</font></div>
<div style="padding-top:5"><font class=g9 color=666666>3) 지식쇼핑 2.0 버전 사용 시 상품 이미지 전송</font></div>
<div style="padding-top:5"><font class=g9 color=666666>&nbsp;&nbsp;&nbsp;&nbsp;- 등록된 상품 이미지 중 확대(원본)이미지가 지식쇼핑 2.0의 기본이미지로 전송되어 설정됩니다.</font></div>
<div style="padding-top:5"><font class=g9 color=666666>&nbsp;&nbsp;&nbsp;&nbsp;- 등록된 확대(원본)이미지가 없을 경우, 상세이미지가 지식쇼핑 2.0의 기본이미지로 전송되어 설정됩니다.</font></div>
<div style="padding-top:5"><font class=g9 color=666666>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;이때, 상세이미지의 사이즈가 300x300(pixel) 이하일 경우, 지식쇼핑에 상품이 진열되지 않거나 품절상태로 진열될 수 있습니다.</font></div>
<div style="padding-top:5"><font class=g9 color=666666>&nbsp;&nbsp;&nbsp;&nbsp;- 확대(원본)이미지와 상세이미지가 등록되지 않은 상품은 지식쇼핑에 전달되지 않습니다.</font></div>
<div style="padding-top:5"><font class=g9 color=666666>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#bf0000"><U>* 지식쇼핑 2.0에 사용되는 상품이미지의 최소 사이즈는 300x300(pixel)입니다.</U></font></font></div>
<div style="padding-top:5"><font class=g9 color=666666>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#bf0000"><U>이 기준에 맞지 않는 이미지를 사용하시는 경우에는 상품이 품절상태로 진열될 수 있습니다.</U></font></font></div>
</td></tr>
</table>

<div style="padding-top:10"></div>

<form name=form method=post action="indb.php" style="width: 800px;" id="naver-service-configure" target="ifrmHidden">

<style type="text/css">
div#cpa-terms{
	border: solid #dce1e1 4px;
	width: 800px;
	margin-bottom: 20px;
	padding: 10px;
}
div#cpa-terms h2{
	font-size: 15px;
}
div#cpa-terms.summary .hide{
	display: none;
}
div#cpa-terms.detail .hide{
	display: block;
}
div#cpa-terms div.view{
	text-align: right;
}
div#cpa-terms div.view button{
	padding: 3px;
	margin: 0;
	background-color: #f9feef;
	border: solid 1px #cccccc;
}
div#cpa-terms.summary div.view button.detail-view{
	display: inline;
}
div#cpa-terms.summary div.view button.summary-view{
	display: none;
}
div#cpa-terms.detail div.view button.detail-view{
	display: none;
}
div#cpa-terms.detail div.view button.summary-view{
	display: inline;
}
#premium-log-analyze-info{
	border: solid #dce1e1 4px;
	width: 800px;
	margin-bottom: 20px;
	padding: 10px;
}
</style>
<div id="cpa-terms" class="summary">
	<div>
		네이버 지식쇼핑 CPA와 검색광고주를 위한 프리미엄 로그 분석을 사용함에 있어 공통스크립트 설치를 통해 수집되는 항목은 아래와 같습니다.<br/>
		해당 항목의 실제적인 수집은 스크립트 설치 동의와 상관없이 실제 네이버에서 해당 서비스 가입을 한 경우에만 일어납니다.
	</div>
	<h2>[지식쇼핑 CPA 수집 목적 및 항목]</h2>
	<ol>
		<li>
			<div>데이터 수집목적:</div>
			<div>- 네이버 지식쇼핑을 통해 유입되는 트래픽(Traffic)을 통한 구매전환 효과측정</div>
		</li>
		<li>
			<div>수집 데이터 항목:</div>
			<div>- 광고주 쇼핑몰에서 발생하는 이용자 주문의 일시 / 번호 / 상품 / 수량 / 금액 등</div>
		</li>
		<li>
			<div>수집 데이터 활용범위:</div>
			<div>- 데이터 수집에 따른 결과는 네이버 지식쇼핑 운영자인 엔에이치엔비즈니스플랫폼㈜ (이하 ‘NBP’라 함)의 내부 분석 목적의 활용</div>
			<div>- 데이터 수집에 따른 결과는 네이버 지식쇼핑 DB리스팅 노출순위(랭킹) 결정 요소로 활용</div>
		</li>
	</ol>
	<h2 class="hide">[검색광고의 프리미엄 로그 서비스 수집 목적 및 항목]</h2>
	<ol class="hide">
		<li>
			<div> 데이터 수집 목적:</div>
			<div>- 네이버검색광고주가 검색광고를 통해 본인의 사이트로 유입된 사용자의 이용행태 및 구매전환 효과 측정</div>
		</li>
		<li>
			<div>수집 데이터 항목:</div>
			<div>- 광고주 쇼핑몰에서 발생하는 이용자의 방문 페이지의 URL과 방문 시각, 구매금액 등</div>
		</li>
		<li>
			<div>수집 데이터 활용범위:</div>
			<div>- 데이터 수집에 따른 결과는 광고주에게 웹로그분석 보고서와 키워드 전환 보고서로 제공</div>
		</li>
	</ol>
	<h2 class="hide">[데이터 수집 관련 공통 주요사항]</h2>
	<ol class="hide">
		<li>
			광고주는 NBP가 제공하는 스크립트 설치가이드에 따라 쇼핑몰에 스크립트를 설치합니다.<br/>
			(네이버와 제휴된 호스팅사를 이용하는 경우 호스팅사에서 호스팅사 솔루션에 스크립트를 일괄 설치합니다.<br/>
			따라서 수집동의시 주문정보가 NBP에게 제공됩니다.)
		</li>
		<li>
			광고주는 NBP가 제공하는 스크립트 설치가이드에서 정한 데이터 수집 운영정책을 준수하여야 하며, 광고주가 해당 운영정책 위반시 NBP는 제재정책에 따라 광고주를 제재할 수 있습니다.
		</li>
		<li>
			광고주는 NBP가 요청하는 경우 정상적인 데이터 수집의 검증을 위해 NBP가 정한 기간과 양식에 따라 네이버 지식쇼핑 트래픽(Traffic)을 통해 쇼핑몰에서 발생한 거래내역(주문완료, 결제완료)과 취소/환불/반품내역을 NBP에게 제공합니다.
		</li>
		<li>
			광고주는 CPA / 프리미엄 로그분석 서비스 데이터 수집 동의 이후라도 언제든 자신의 판단에 따라 NBP에 사전 통지하고 쇼핑몰 내 스크립트를 삭제함으로써 본 동의를 철회할 수 있습니다. (네이버와 제휴된 호스팅사 광고주는 동의 철회를 원할 경우 NBP에 통보하여 동의 철회를 진행할 수 있으며 호스팅사에서 주문정보 전달을 중단하게 됩니다.)
		</li>
		<li>
			NBP는 서비스에 가입한 경우, 광고주의 데이터 수집 동의와 스크립트 설치가 완료된 이후부터 데이터 수집을 시작하며, 광고주가 동의를 철회하거나 광고주의 운영정책 위반으로 NBP가 제재조치로써 데이터 수집을 중단하기 전까지 해당 데이터를 계속 수집할 수 있습니다.
		</li>
		<li>
			NBP는 데이터 수집 및 광고주 스크립트 설치 지원 업무를 제3자에게 위탁하여 처리할 수 있습니다.
		</li>
	</ol>
	<h2 class="hide">[데이터 전송 검증을 위한 테스트]</h2>
	<ol class="hide">
		<li>
			<div>지식쇼핑 CPA:</div>
			<div>- CPA 수집동의 몰을 대상으로 NBP는 데이터의 정상적인 전송여부를 검증하기 위해 주기적으로 모니터링 및 테스트 주문을 발생시킬 수 있습니다.</div>
			<div>- 주문 테스트는 1회 당 4~10건 정도 진행되며, 해당 주문은 테스트 후 즉시 취소 처리합니다.</div>
		</li>
		<li>
			<div>프리미엄 로그 분석:</div>
			<div>- 서비스가입 및 수집 동의 몰을 대상으로 NBP는 데이터의 정상적인 전송여부를 검증하기 위해 테스트 주문을 발생시킬 수 있으며, 해당 주문은 테스트 후 즉시 취소 처리합니다.</div>
		</li>
	</ol>
	<div class="view">
		<button class="detail-view" onclick="document.getElementById('cpa-terms').className='detail';">자세히 보기</button>
		<button class="summary-view" onclick="document.getElementById('cpa-terms').className='summary';">간단히</button>
	</div>
	<div>본인은 상기 CPA 데이터 수집 동의 주요 사항에 기재된 내용을 성실히 이행할 것을 동의합니다.</div>
</div>
<div id="premium-log-analyze-info" class="red">프리미엄 로그분석 서비스 가입자도 반드시 CPA동의해주셔야 하며, 지식쇼핑 이용을 안 하시는 경우 아래 데이터 수집은 일어나지 않습니다.</div>

<input type=hidden name=mode value="naver">

<table class=tb border=0>
<col class=cellC><col class=cellL>
<?
@include "../../conf/fieldset.php";
list($grpnm,$grpdc) = $db->fetch("select grpnm,dc from ".GD_MEMBER_GRP." where level='".$joinset[grp]."'");
?>
<tr>
	<td>사용여부</td>
	<td class="noline">
	<label><input type="radio" name="useYn" value="y" <?php echo $checked['useYn']['y'];?>/>사용</label><label><input type="radio" name="useYn" value="n" <?php echo $checked['useYn']['n'];?> <?php echo $checked['useYn'][''];?> />사용안함</label>
	</td>
</tr>
<tr>
	<td>CPA 주문수집<br/>동의여부</td>
	<td class="noline">
		<label><input type="checkbox" name="cpaAgreement" value="true" required="required" <?php echo $checked['cpaAgreement']['true']; ?>/> CPA 주문수집에 동의함</label>
		<?php if(isset($partner['cpaAgreementTime'])){ ?>
		<span style="margin-left: 30px; color: #991299; font-weight: bold;">동의일시 : <?php echo $partner['cpaAgreementTime']; ?></span>
		<?php } ?>
		<br/>
		<span class="extext">
			네이버에서 CPA 주문수집에 동의하신 경우에만 주문완료시 주문정보를 네이버측으로 전송합니다.<br/>
			CPA 주문수집이 정상적으로 이루어 져야만 차후 CPA로의 과금전환이 이루어질수 있습니다.<br/>
			주문수집에 동의하신뒤에는 반드시 체크하여주시기 바라며, CPA 주문수집에대한 문의는 네이버 쇼핑광고센터로 문의주시기 바랍니다.<br/>
			<strong>네이버 쇼핑광고센터 : 02) 3469-3360</strong>
		</span>
	</td>
</tr>
<tr>
	<td>네이버지식쇼핑<br/>버전설정</td>
	<td class="noline"><input type="radio" name="naver_version" value="1" <?=$checked['naver_version']['1']?> <?=$checked['naver_version']['']?>>기존(v1.0)&nbsp;&nbsp;<input type="radio" name="naver_version" value="2" <?=$checked['naver_version']['2']?>>신규(v2.0) &nbsp; <span class="extext" style="font-weight:bold">버전설정 안내문구를 반드시 읽어주시기 바랍니다.</span></td>
</tr>
<tr>
	<td>상품가격 설정</td>
	<td class="noline">
	<div class="extext" style="padding-bottom:5px;">지식쇼핑에 노출되는 가격정보를 설정합니다.<br/>
		일반적으로 지식쇼핑에 노출되는 가격은 적용된 쿠폰과 지식쇼핑 가입시 등록한 회원그룹 할인율이 적용된 가격이 노출됩니다.<br/>
		설정 사항을 체크 하지 않을 경우 쿠폰 및 할인율이 적용되지 않은 판매가로 노출됩니다.
	</div>
	<div>
		<span class="noline"><input type="checkbox" name="inmemberdc" value="Y" <?=$checked['inmemberdc']['Y']?>/></span> 회원그룹 할인율 적용
		<div style="padding:3px 0px 0px 25px;">
			<div><b><?=$grpnm?></b> 할인율은 <b><?=number_format($grpdc)?>%</b>가 상품가격에 적용되어 지식쇼핑에 노출 됩니다.</div>
			<div class="extext">가입시 회원그룹 설정은 <a href="../member/fieldset.php" class="extext" style="font-weight:bold">회원관리 > 회원가입관리</a>에서 변경 가능합니다.</div>
			<div class="extext">회원그룹의 할인율 변경은 <a href="../member/group.php" class="extext" style="font-weight:bold">회원관리 > 회원그룹관리 </a>에서 변경 가능합니다.</div>
		</div>
	</div>
	<div>
		<span class="noline"><input type="checkbox" name="incoupon" value="Y" <?=$checked['incoupon']['Y']?>/></span> 쿠폰 적용
		<div style="padding:3px 0px 0px 25px;">
			<div class="extext">쿠폰은 <a href="../event/coupon.php" class="extext" style="font-weight:bold">프로모션/SNS > 쿠폰리스트 </a>에서 관리 가능합니다.</div>
		</div>
	</div>
	</td>
</tr>
<tr>
	<td>네이버지식쇼핑<br />무이자할부정보</td>
	<td><input type=text name=partner[nv_pcard] value="<?=$partner[nv_pcard]?>" class=lline></td>
</tr>
<tr>
	<td>네이버지식쇼핑<br />상품명 머릿말 설정</td>
	<td>
	<div><input type=text name="partner[goodshead]" value="<?=$partner[goodshead]?>" class=lline></div>
	<div class="extext">* 상품명 머리말 설정을 위한 치환코드</div>
	<div class="extext">- 머리말 상품에 입력된 "제조사"를 넣고 싶을 때 : {_maker}</div>
	<div class="extext">- 머리말 상품에 입력된 "브랜드"를 넣고 싶을 때 : {_brand}</div>
	</td>
</tr>
</table>
<div class="noline" style="text-align: center; padding: 10px;">
	<a href="javascript:document.form.submit();"><img src="../img/btn_naver_install.gif" align=”absmiddle”></a>
</div>
</form>

<div id=MSG02>
<table cellpadding=1 cellspacing=0 border=0 class=small_ex>
<tr><td><img src="../img/icon_list.gif" align=absmiddle>네이버지식쇼핑 무이자할부정보란?: 각 카드사별 무이자정보를 입력하실 수 있습니다. 예) 삼성3/현대6/국민12</td></tr>
<tr><td><img src="../img/icon_list.gif" align=absmiddle>무이자할부정보를 입력/저장후 아래 상품DB URL의 수동 업데이트를 실행하면 상품DB URL 정보 중 무이자 정보가 필드인 pcard필드의 정보가 변경됩니다.</td></tr>
<tr><td><img src="../img/icon_list.gif" align=absmiddle>변경된 무이자할부정보는 지식쇼핑 업데이트 주기에 따라 지식쇼핑에 반영되어집니다.</td></tr>
<tr><td><img src="../img/icon_list.gif" align=absmiddle>네이버에 노출되는 상품정보는 다시 등록하시는 것이 아닙니다.</td></tr>
<tr><td style="padding-left:10">현재 운영중인 쇼핑몰의 상품정보를 네이버가 매일 새벽에 자동으로 가져갑니다.</td></tr>
</table>
<br/>
<table cellpadding=1 cellspacing=0 border=0 class=small_ex>
<tr><td><img src="../img/icon_list.gif" align=absmiddle>네이버지식쇼핑에서 상품검색이 많이 될 수 있도록 상품명 머리말 설정을 활용하세요!</td></tr>
<tr><td><img src="../img/icon_list.gif" align=absmiddle>예시 1) 상품명 머리말 설정 : 공란</td></tr>
<tr>
	<td style="padding-left:10">
	<table style='border:1px solid #ffffff;width:400' class=small_ex>
	<col align="center" width="60"><col align="center" width="50"><col align="center" width="50"><col>
	<tr>
		<td>상품명</td>
		<td>제조사</td>
		<td>브랜드</td>
		<td>네이버 노출 상품명</td>
	</tr>
	<tr>
		<td>여자청바지</td>
		<td>스웨덴</td>
		<td>폴로</td>
		<td>여자청바지</td>
	</tr>
	</table>
	</td>
</tr>
<tr><td><img src="../img/icon_list.gif" align=absmiddle>예시 2) 상품명 머리말 설정 : [무료배송 / {_maker} / {_brand}]</td></tr>
<tr>
	<td style="padding-left:10">
	<table style='border:1px solid #ffffff;width:400' class=small_ex>
	<col align="center" width="60"><col align="center" width="50"><col align="center" width="50"><col>
	<tr>
		<td>상품명</td>
		<td>제조사</td>
		<td>브랜드</td>
		<td>네이버 노출 상품명</td>
	</tr>
	<tr>
		<td>여자청바지</td>
		<td>스웨덴</td>
		<td>폴로</td>
		<td>[무료배송 / 수에덴 / 폴로] 여자청바지</td>
	</tr>
	</table>
	</td>
</tr>
</table>
<script>cssRound('MSG02')</script>
</div>

<p>
<? if(in_array($naver_version,array('','1'))){	// 기존 EP(v1.0) ?>
<table width=100% cellpadding=0 cellspacing=0>
<col class=cellC><col style="padding:5px 10px;line-height:140%">
<tr class=rndbg>
	<th>업체</th>
	<th>상품 DB URL [페이지 미리보기]</th>
	<th>최근 업데이트일시</th>
	<th>업데이트</th>
</tr>
<tr><td class=rnd colspan=10></td></tr>
<tr>
	<td>네이버지식쇼핑<br>상품DB URL페이지</td>
	<td>
	<font color="57a300">[전체상품]</font> <?if(file_exists('../../conf/engine/naver_all.php')){?><a href="../../partner/naver.php" target=_blank><font class=ver8>http://<?=$_SERVER['HTTP_HOST'].$cfg[rootDir]?>/partner/naver.php</font> <img src="../img/btn_naver_view.gif" align=absmiddle></a><?}else{?>업데이트필요<?}?><br>

	<font color="57a300">[요약상품]</font> <?if(file_exists('../../conf/engine/naver_summary.php')){?><a href="../../partner/naver.php?mode=summary" target=_blank><font class=ver8>http://<?=$_SERVER['HTTP_HOST'].$cfg[rootDir]?>/partner/naver.php?mode=summary</font> <img src="../img/btn_naver_view.gif" align=absmiddle></a><?}else{?>업데이트필요<?}?><br>

	<font color="57a300">[신규상품]</font> <a href="../../partner/naver.php?mode=new" target=_blank><font class=ver8>http://<?=$_SERVER['HTTP_HOST'].$cfg[rootDir]?>/partner/naver.php?mode=new</font> <img src="../img/btn_naver_view.gif" align=absmiddle></a>
	</td>
	<td align=center><font class=ver81>
		<?if(file_exists('../../conf/engine/naver_all.php'))echo date('Y-m-d h:i:s',filectime ( '../../conf/engine/naver_all.php'));?>
	</td>
	<td align=center>
		<a href="../../partner/engine.php?mode=all" target='ifrmHidden'><img src="../img/btn_price_update.gif"></a>
	</td>
</tr>
<tr><td colspan=12 class=rndline></td></tr>
</table>
<div class=small1 ><img src="../img/icon_list.gif" align=absmiddle><b><font color=ff6600>상품정보 변경시나 상품 DB URL의 값이 없을 시에는 반드시 업데이트버튼을 눌러주세요</font></B></div>
<div style="padding-top:2"></div>
<table align=center>
<tr><td width=500>
 <div align=center class=small1 style='padding-bottom:3'><font color=6d6d6d>업데이트가 진행되면 아래 바를 통해 진행율이 보이게 됩니다.<br>완료메시지가 출력될때까지 다른 동작을 삼가하여주십시요.</font></div>
		<div style="height:8px;font:0;background:#f7f7f7;border:2 solid #cccccc">
		<div id=progressbar style="height:8px;background:#FF4E00;width:0"></div>
 </div>
</td></tr>
</table>
<? }else{	// 신규 EP(v2.0) ?>
<table width=100% cellpadding=0 cellspacing=0>
<col class=cellC><col style="padding:5px 10px;line-height:140%">
<tr class=rndbg>
	<th>업체</th>
	<th>상품 DB URL [페이지 미리보기]</th>
</tr>
<tr><td class=rnd colspan=10></td></tr>
<tr>
	<td>네이버지식쇼핑<br>상품DB URL페이지</td>
	<td>
	<font color="57a300">[전체상품]</font> <a href="../../partner/naver.php" target=_blank>
	<font class=ver8>http://<?=$_SERVER['HTTP_HOST'].$cfg[rootDir]?>/partner/naver.php</font>
	<img src="../img/btn_naver_view.gif" align=absmiddle></a><br>
	<font color="57a300">[요약상품]</font> <a href="../../partner/naver.php?mode=summary" target=_blank>
	<font class=ver8>http://<?=$_SERVER['HTTP_HOST'].$cfg[rootDir]?>/partner/naver.php?mode=summary</font>
	<img src="../img/btn_naver_view.gif" align=absmiddle></a>
	</td>
</tr>
<tr><td colspan=12 class=rndline></td></tr>
</table>
<? }?>

<br><br>
<!--
<table width=100% cellpadding=0 cellspacing=0>
<col class=cellC><col style="padding:5px 10px;line-height:140%">
<tr class=rndbg>
	<th>업체</th>
	<th style="padding-right:150px">개편 상품 DB URL [페이지 미리보기]</th>
</tr>
<tr><td class=rnd colspan=10></td></tr>
<tr>
	<td>네이버지식쇼핑<br>상품DB URL페이지</td>
	<td>
	<font color="57a300">[전체상품]</font> <a href="../../partner/naver2_all.php" target=_blank>
	<font class=ver8>http://<?=$_SERVER['HTTP_HOST'].$cfg[rootDir]?>/partner/naver2_all.php</font>
	<img src="../img/btn_naver_view.gif" align=absmiddle></a><br>
	<font color="57a300">[요약상품]</font> <a href="../../partner/naver2_summary.php" target=_blank>
	<font class=ver8>http://<?=$_SERVER['HTTP_HOST'].$cfg[rootDir]?>/partner/naver2_summary.php</font>
	<img src="../img/btn_naver_view.gif" align=absmiddle></a>
	</td>
</tr>
<tr><td colspan=12 class=rndline></td></tr>
</table>
<div class=small1 ><img src="../img/icon_list.gif" align=absmiddle><b><font color=ff6600>
새로 개편된 EP(Engine Page)주소입니다.
</font></B></div>
-->
<p>
<div style='padding:0 0 10 0; text-align:center;'>
<a href="https://adcenter.shopping.naver.com" target="_blank"><img src="../img/btn_naver_go.gif" border="0"></a>
</div>
<div id=MSG01>
<table cellpadding=2 cellspacing=0 border=0 class=small_ex>
<tr><td>
<img src="../img/icon_list.gif" align=absmiddle>입점승인시 자동으로 '상품DB URL'이 네이버지식쇼핑 광고주페이지에 등록되어집니다.
<br>
<div style="padding-top:6;"></div>
<img src="../img/icon_list.gif" align=absmiddle><span class="color_ffe">상품DB URL이란?</span><BR>
&nbsp;&nbsp;운영中인 쇼핑몰의 상품데이타 정보가 네이버지식쇼핑에 노출되도록 하는<br>
&nbsp;&nbsp;"<B>상점의 상품정보 데이타가 한곳에 모여있는 페이지의 주소값</B>"입니다.<br>
&nbsp;&nbsp;MMC에 등록된 상품DB URL은 광고주의 쇼핑몰 상품을 자동으로 지식쇼핑으로 가져오는 역할을 합니다.<br>
<br>
<div style="padding-top:6;"></div>
<img src="../img/icon_list.gif" align=absmiddle><span class="color_ffe">페이지 미리보기란?</span><BR>
&nbsp;&nbsp;현재 생성된 상품DB URL페이지의 정보를 확인할 수 있습니다.
<br>
<div style="padding-top:6;"></div>
<img src="../img/icon_list.gif" align=absmiddle><span class="color_ffe">업데이트란?</span><BR>
&nbsp;&nbsp;쇼핑몰 상품정보의 변경으로 지식쇼핑 상품정보 또한 업데이트가 필요로 하게 되며 이때 각각의 업데이트를 클릭하여 상품 DB URL 페이지에 대한 업데이트를 실행하시면<BR>
&nbsp;&nbsp;상품 DB URL 페이지가 업데이트가 되며 실제적으로는 지식쇼핑몰의 업데이트 주기에 따라 지식쇼핑의 상품정보가 업데이트 됩니다.<BR>
&nbsp;&nbsp;-순서: 쇼핑몰상품정보변경 ⇒ 업데이트 실행 ⇒ 지식쇼핑 업데이트(지식쇼핑 업데이트 주기에 따른 반영)
<br>
<div style="padding-top:6;"></div>
<img src="../img/icon_list.gif" align=absmiddle><span class="color_ffe">네이버지식쇼핑 무이자할부정보란?</span><BR>
&nbsp;&nbsp;무이자할부정보를 입력/저장후 상품DB URL의 업데이트를 실행하면 상품DB URL 정보 중 무이자 정보가 필드인 pcard필드의 정보가 변경됩니다.<BR>
&nbsp;&nbsp;변경된 무이자할부정보는 지식쇼핑 업데이트 주기에 따라 지식쇼핑에 반영되어집니다.
<BR>
<div style="padding-top:6;"></div>
<img src="../img/icon_list.gif" align=absmiddle><span class="color_ffe">상품DB URL 자동업데이트 주기</span><BR>
&nbsp;&nbsp;<B>지식쇼핑 업데이트 주기 :</B>[전체]의 경우는 전체상품을 업데이튼 하는 상품 페이지로 새벽 1시 하루에 한번 진행됩니다. <BR>
&nbsp;&nbsp;<B>지식쇼핑 업데이트 주기 :</B>[요약]은 요약정보(가격,상품명 등)을 업데이트 하는 상품DB 페이지로 <BR>
&nbsp;&nbsp;<B>지식쇼핑 업데이트 주기 :</B>가전,컴퓨터 카테고리 상품은 매일 09, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21시 (09~21시 매 시각마다 : 1일 13회) <BR>
&nbsp;&nbsp;<B>지식쇼핑 업데이트 주기 :</B>가전,컴퓨터 카테고리를 제외한 상품은 매일 10, 12, 14, 16, 18, 20시 (10~20시 매 짝수시각마다 : 1일 6회) 진행됩니다. <BR>
&nbsp;&nbsp;<B>지식쇼핑 업데이트 주기 :</B>[신규]는 새로운 신상품을 업데이트 하는 상품DB 페이지로 매일 12, 14, 16시 (1일 3회)에 진행됩니다. <BR>
<BR><BR>

<FIELDSET width="90%" style="padding: 0 30 0 30;">
<LEGEND align="center"  style="padding: 0 10 5 10;">
<div><img src="http://www.godo.co.kr/image/sub_naver_04_auto_matching_bt.gif" border="0"></div>
</LEGEND>

<br>
<font style="font:12pt"><b>지식쇼핑 카테고리 자동매칭 안내</b></font><br>
<div style="padding-top:4;"></div>
안녕하세요. 네이버 지식쇼핑 운영자입니다.<br>
자동 매칭 설정 기능과 관련하여 다음처럼 안내 드리오니, 꼭 확인하셔서 쇼핑몰 운영에 차질 없으시길 바랍니다.<br>
<br>
<div style="padding-top:12;"></div>
<font style="font:12px;"><b>1. 자동매칭이란?</b></font><br>

DB 카테고리 매칭을 광고주사이트에서 직접 하지 않고, 지식쇼핑 시스템에서 자동으로 매칭을 설정하는 기능입니다. <br>
상품의 DB가 많아, 수작업으로 모든 매칭을 진행하기기 어려우실 점을 감안하여 지식쇼핑에서 서비스해 드리는 기능입니다.<br>
<br>
<div style="padding-top:12;"></div>
<font style="font:12px;"><b>2 자동매칭 설정시 주의하실 점</b></font><br>
<br>
<div style="padding-top:5;"></div>
<span class="color_ffe"><b>(1) 자동매칭은 시스템에 의한 분류이므로, 오매칭의 가능성이 있습니다!</b></span><br>
자동매칭은 사람의 손을 거치지 않고 시스템에서 직접 카테고리를 분류하여 매칭하는 작업입니다. <br>
시스템은 상품명만을 그 기준으로 하기 때문에, 상품명이 모호하거나 / 상품명만으로 카테고리가 구별되지 않거나 / <br>
두개 이상의 카테고리에 존재할 수 있는 상품의 경우, 매칭이 정확하지 않을 확률이 높습니다. <br>
<br>
<div style="padding-top:5;"></div>
<span class="color_ffe"><b>(2) 자동매칭의 결과는 다시 한번 확인을 해주시기바랍니다!</b></span><br>
자동매칭 결과는 매일 지식쇼핑 어드민(MMC) > 상품관리 > 상품현황 (등록) 메뉴를 통해 확인하실 수 있습니다. <br>
혹시 오매칭이 되어 있는 상품이 있다면, 광고주께서 직접 매칭을 수정하실 수 있습니다.<br>
<br>
<div style="padding-top:5;"></div>
<span class="color_ffe"><b>(3) 자동매칭 오매칭으로 인한 CPC 오과금에 대해서는 환불이 불가능합니다!</b></span><br>
특히 2007년 3월19일 부터는 CPC과금이 카테고리별로 차등 적용되기 때문에,<br>
오매칭이 있을 경우 CPC과금에도 오과금이 발생할 수 있습니다.<br>
그러나 자동매칭의 오매칭으로 인한 CPC오과금에 대해서는 환불이 불가능하오니,
매칭의 결과는 꼭 확인해주셔야 합니다.<br>
<br>
<div style="padding-top:5;"></div>
<span class="color_ffe"><b>(4) 상품은 광고주께서 직접 매칭하실 것을 권해드리며, 자동매칭을 보조적인 수단으로의 이용을 부탁드립니다.</b></span><br>
지식쇼핑에서는 <b>광고주의 직접 수동 매칭을 권장하며</b>, 자동매칭은 보조적인 수단으로만 사용하실 것을 당부드립니다. <br>
자동매칭의 오매칭이 염려되시는 광고주께서는 지금 <u>지식쇼핑 어드민(MMC) > 쇼핑몰관리 > 서비스이용관리</u>에서 <br>
자동매칭 설정여부를 해제하시고, 직접 수동 매칭하실 것을 권해드립니다.<br>
<br>
자동매칭 관련하여, 문의사항은 MMC 상담게시판을 이용해주세요.<br>
감사합니다.  <br>
<br>
지식쇼핑 운영자 드림. <br><BR>
<BR>
</FIELDSET>
</td></tr>
</table>
</div>
<script>cssRound('MSG01','#F7F7F7')</script>
<? include "../_footer.php"; ?>