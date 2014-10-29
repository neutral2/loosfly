<?php
 ### kcp 모바일 결제

	@include dirname(__FILE__)."/../../../../conf/pg.kcp.php";
	@include dirname(__FILE__)."/../../../../conf/pg_mobile.kcp.php";
	@include dirname(__FILE__)."/../../../../conf/pg.escrow.php";

	$page_type = $_GET['page_type'];

	if(is_array($pg_mobile)) {
		$pg_mobile = array_merge($pg_mobile, $pg);
	}
	else {
		$pg_mobile = $pg;
	}

	if(!preg_match('/mypage/',$_SERVER[SCRIPT_NAME])){
	$item = $cart -> item;
	}

	foreach($item as $v){
	$i++;
	if($i == 1) $ordnm = $v[goodsnm];
	$good_info .= "seq=".$i.chr(31);
	$good_info .= "ordr_numb=".$ordno.$i.chr(31);
	$good_info .= "good_name=".addslashes(substr($v[goodsnm],0,30)).chr(31);
	$good_info .= "good_cntx=".$v[ea].chr(31);
	$good_info .= "good_amtx=".$v[price].chr(30);
	}
	//상품명에 특수문자 및 태그 제거
	$ordnm	= pg_text_replace(strip_tags($ordnm));
	if($i > 1)$ordnm .= " 외".($i-1)."건";

	## 무이자 설정값
	if( $pg_mobile[zerofee] == 'yes' ){ $pg_mobile[zerofeeFl] = 'Y'; }
	else if( $pg_mobile[zerofee] == 'admin' ) { $pg_mobile[zerofeeFl] = ''; }
	else { $pg_mobile[zerofeeFl] = 'N';}

?>
<?
    /* = -------------------------------------------------------------------------- = */
    /* =   환경 설정 파일 Include END                                               = */
    /* ============================================================================== */

	$g_conf_home_dir  = $_SERVER['DOCUMENT_ROOT'].$cfg[rootDir]."/order/card/kcp/mobile/receipt";     // BIN 절대경로 입력 (bin전까지)
	$g_conf_gw_url    = "paygw.kcp.co.kr";
    $g_conf_site_cd   = $pg[id];
	$g_conf_site_key  = $pg[key];
	$g_conf_site_name = "KCP SHOP";
	$g_conf_gw_port   = "8090";        // 포트번호(변경불가)
?>
<?
    /* kcp와 통신후 kcp 서버에서 전송되는 결제 요청 정보*/
    $req_tx          = $_POST[ "req_tx"         ]; // 요청 종류
    $res_cd          = $_POST[ "res_cd"         ]; // 응답 코드
    $tran_cd         = $_POST[ "tran_cd"        ]; // 트랜잭션 코드
    $ordr_idxx       = $_POST[ "ordno"      ]; // 쇼핑몰 주문번호
    $good_name       = $ordnm					; // 상품명
    $good_mny        = $_POST[ "settleprice"       ]; // 결제 총금액
    $buyr_name       = $_POST[ "nameOrder"      ]; // 주문자명
    $buyr_tel1       = implode("-",$_POST['phoneOrder']); // 주문자 전화번호
    $buyr_tel2       = implode("-",$_POST['mobileOrder']); // 주문자 핸드폰 번호
    $buyr_mail       = $_POST[ "email"      ]; // 주문자 E-mail 주소
    $enc_info        = $_POST[ "enc_info"       ]; // 암호화 정보
    $enc_data        = $_POST[ "enc_data"       ]; // 암호화 데이터

	/*
     * 기타 파라메터 추가 부분 - Start -
     */
    $param_opt_1     = $_POST[ "param_opt_1"    ]; // 기타 파라메터 추가 부분
    $param_opt_2     = $_POST[ "param_opt_2"    ]; // 기타 파라메터 추가 부분
    $param_opt_3     = $_POST[ "param_opt_3"    ]; // 기타 파라메터 추가 부분
    /*
     * 기타 파라메터 추가 부분 - End -
     */

	 ### 마감일자 계산

	 $ipgm_date = date("Ymd",strtotime("now"."+3 days"));

	 switch ($_POST[settlekind]){	// 결제 방법
		case "c":	// 신용카드
			$use_pay_method		= "100000000000";
			$pay_method = "CARD";
			$paynm			= "신용카드";
			break;
//		case "o":	// 계좌이체
//			$use_pay_method		= "SC0030";
//			$pay_method = "";
//			$paynm			= "계좌이체";
//			break;
		case "v":	// 가상계좌
			$use_pay_method		= "001000000000";
			$pay_method = "VCNT";
			$paynm			= "가상계좌";
			break;
		case "h":	// 핸드폰
			$use_pay_method		= "000010000000";
			$pay_method = "MOBX";
			$paynm			= "핸드폰";
			break;
	}

	//ssl 보안서버 관련 추가
	if($_SERVER['SERVER_PORT'] == 80) {
		$Port = "";
	} elseif($_SERVER['SERVER_PORT'] == 443) {
		$Port = "";
	} else {
		$Port = $_SERVER['SERVER_PORT'];
	}

	if (strlen($Port)>0) $Port = ":".$Port;

	$Protocol = $_SERVER['HTTPS']=='on'?'https://':'http://';
	$host = parse_url($_SERVER['HTTP_HOST']);

	if ($host['path']) {
		$Host = $host['path'];
	} else {
		$Host = $host['host'];
	}

?>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<meta http-equiv="Cache-Control" content="No-Cache">
<meta http-equiv="Pragma" content="No-Cache">
<meta name="viewport" content="user-scalable=0, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, width=device-width" />

<!-- 거래등록 하는 kcp 서버와 통신을 위한 스크립트-->
<script language="javascript" src="<?=$cfg[rootDir]?>/order/card/kcp/mobile/approval_key.js" type="text/javascript"></script>

<style type="text/css">
	.LINE { background-color:#afc3ff }
	.HEAD { font-family:"굴림","굴림체"; font-size:9pt; color:#065491; background-color:#eff5ff; text-align:left; padding:3px; }
	.TEXT { font-family:"굴림","굴림체"; font-size:9pt; color:#000000; background-color:#FFFFFF; text-align:left; padding:3px; }
	    B { font-family:"굴림","굴림체"; font-size:13pt; color:#065491;}
	INPUT { font-family:"굴림","굴림체"; font-size:9pt; }
	SELECT{font-size:9pt;}
	.COMMENT { font-family:"굴림","굴림체"; font-size:9pt; line-height:160% }
</style>
<script language="javascript">
	self.name = "tar_opener";

	/* 주문번호 생성 예제 */
    function init_orderid()
    {
        var today = new Date();
        var year  = today.getFullYear();
        var month = today.getMonth()+ 1;
        var date  = today.getDate();
        var time  = today.getTime();

        if(parseInt(month) < 10) {
            month = "0" + month;
        }

        var vOrderID = year + "" + month + "" + date + "" + time;
        var vDEL_YMD = year + "" + month + "" + date;

        document.forms[0].ordr_idxx.value = vOrderID;
        self.name = "tar_opener";
    }

	/* kcp web 결제창 호출 (변경불가)*/
    function call_pay_form()
    {

       var v_frm = document.sm_form;

        layer_cont_obj   = document.getElementById("content");
        layer_card_obj = document.getElementById("layer_card");

        layer_cont_obj.style.display = "none";
        layer_card_obj.style.display = "block";

        v_frm.target = "frm_card";
        v_frm.action = PayUrl;

		if(v_frm.Ret_URL.value == "")
		{
			/* Ret_URL값은 현 페이지의 URL 입니다. */
			alert("연동시 Ret_URL을 반드시 설정하셔야 됩니다.");
			return false;
		}
		else
        {
			v_frm.submit();
		}

        v_frm.submit();
    }


	/* kcp 통신을 통해 받은 암호화 정보 체크 후 결제 요청*/
    function chk_pay()
    {
        /*kcp 결제서버에서 가맹점 주문페이지로 폼값을 보내기위한 설정(변경불가)*/
        self.name = "tar_opener";

        var pay_form = document.pay_form;

        if (pay_form.res_cd.value == "3001" )
        {
            alert("사용자가 취소하였습니다.");
            pay_form.res_cd.value = "";
            return false;
        }
        else if (pay_form.res_cd.value == "3000" )
        {
            alert("30만원 이상 결제 할수 없습니다.");
            pay_form.res_cd.value = "";
            return false;
        }

        if (pay_form.enc_data.value != "" && pay_form.enc_info.value != "" && pay_form.tran_cd.value !="" )
        {
            jsf__show_progress(true);
            alert("페이지 하단의 확인 버튼을 눌러 주세요.");
        }
        else
        {
             jsf__show_progress(false);
             return false;
        }
    }

	function  jsf__show_progress( show )
    {
        if ( show == true )
        {
            document.getElementById("show_pay_btn") .style.display  = 'inline';
            document.getElementById("show_progress").style.display = 'inline';
            document.getElementById("show_req_btn") .style.display = 'none';
        }
        else
        {
            document.getElementById("show_pay_btn") .style.display  = 'none';
            document.getElementById("show_progress").style.display = 'none';
            document.getElementById("show_req_btn") .style.display = 'inline';
        }
    }

    /* 최종 결제 요청*/
    function jsf__pay ()
    {
        var pay_form = document.pay_form;
        pay_form.submit();
    }

</script>

<div id="content">

<form name="sm_form" method="POST">

<table border="0" width="100%">
	<tr>
		<td align="center">
			<b style="color:blue">* 스마트폰 <?=$paynm?> 결제 *</b>
		</td>
	</tr>
</table>
<BR>
<table width="50%" border="0" align="center">
<tr>
	<td width="50%" valign="top">
		<table border="0" width="90%" class="LINE" cellspacing="1" cellpadding="1" align="center">
      <tr>
          <td class="TEXT" colspan="2" style="text-align:center"><b>주문 정보</b></td>
      </tr>
      <tr>
          <td class="HEAD">상&nbsp;&nbsp;품&nbsp;&nbsp;명</td>
          <td class="TEXT"><input type="text" name='good_name' maxlength="100" value='<?=$good_name?>'></td>
      </tr>
      <tr>
          <td class="HEAD">상&nbsp;품&nbsp;금&nbsp;액</td>
          <td class="TEXT"><input type="text" name='good_mny' size="9" maxlength="9" value='<?=$good_mny?>' ></td>
      </tr>
      <tr>
          <td class="HEAD">주문자&nbsp;이름</td>
          <td class="TEXT"><input type="text" name='buyr_name' size="20" maxlength="20" value="<?=$buyr_name?>"></td>
      </tr>
      <tr>
          <td class="HEAD">주문자&nbsp;연락처</td>
          <td class="TEXT"><input type="text" name='buyr_tel1' size="20" maxlength="20" value='<?=$buyr_tel1?>'></td>
      </tr>
      <tr>
          <td class="HEAD">주문자&nbsp;핸드폰&nbsp;번호</td>
          <td class="TEXT"><input type="text" name='buyr_tel2' size="20" maxlength="20" value='<?=$buyr_tel2?>'></td>
      </tr>
      <tr>
          <td class="HEAD">주문자&nbsp;E-mail</td>
          <td class="TEXT"><input type="text" name='buyr_mail' size="20" maxlength="30" value='<?=$buyr_mail?>'></td>
      </tr>
	  <?php
		if ($use_pay_method	== "001000000000"){
	  ?>
	  <tr>
          <td class="HEAD">마&nbsp;감&nbsp;일&nbsp;자</td>
          <td class="TEXT"><input type="text" name='ipgm_date' size="20" maxlength="30" value='<?=$ipgm_date?>'></td>
      </tr>
	  <?php	 } ?>
		</table>
	</td>
</tr>
</table>

<table width="100%" border="0">
      <tr id='show_req_btn' align="center">
          <td class="TEXT" colspan="2" style="text-align:center">
              <!-- <input type="submit" value="결제등록 요청버튼"> -->
              <input type="button" name="submitChecked" onClick="kcp_AJAX();" value="결제등록요청" />
              <input type="button" name="btn" value="Reload" onClick="javascript:location.reload()">
          </td>
      </tr>
      <tr id='show_progress' style='display:none;'>
          <td class="TEXT" colspan="2" style="text-align:center">반드시 확인버튼을 클릭 하셔야만 결제가 진행됩니다.</td>
      </tr>
      <tr id='show_pay_btn' align="center" style='display:none;'>
          <td class="TEXT" colspan="2" style="text-align:center">
              <!-- <input type="submit" value="결제버튼"> -->
              <input type="button" name="btn" onClick="jsf__pay();" value="확인" />
          </td>
      </tr>
</table>
<!-- 필수 사항 -->

<!-- 요청 구분 -->
<input type='hidden' name='req_tx'       value='pay'>
<!-- 사이트 코드 -->
<input type="hidden" name='site_cd'      value="<?=$g_conf_site_cd?>">
<!-- 사이트 키 -->
<input type='hidden' name='site_key'     value='<?=$g_conf_site_key?>'>
 <!-- 사이트 이름 -->
<input type="hidden" name='shop_name'    value="<?=$g_conf_site_name?>">
<!-- 결제수단-->
<input type="hidden" name='pay_method'   value="<?=$pay_method?>">
<!-- 주문번호 -->
<input type="hidden"   name='ordr_idxx'    value="<?=$_POST['ordno']?>">
<!-- 최대 할부개월수 -->
<input type="hidden" name='quotaopt'     value="12">
<!-- 통화 코드 -->
<input type="hidden" name='currency'     value="410">
<!-- 결제등록 키 -->
<input type="hidden" name='approval_key' id="approval">
<!-- 리턴 URL (kcp와 통신후 결제를 요청할 수 있는 암호화 데이터를 전송 받을 가맹점의 주문페이지 URL) -->
<!-- 반드시 가맹점 주문페이지의 URL을 입력 해주시기 바랍니다. -->
<input type="hidden" name='Ret_URL'      value="<?=$Protocol.$Host.$Port?><?=$cfg['rootDir']?>/order/card/kcp/mobile/nscreen_card_return.php?page_type=<?=$page_type?>">
<!-- 인증시 필요한 파라미터(변경불가)-->
<input type='hidden' name='ActionResult' value='<?=strtolower($pay_method)?>'>
<!-- 인증시 필요한 파라미터(변경불가)-->
<input type="hidden" name='escw_used'    value="N">

<input type="hidden" name='approval_url' value="<?=$cfg[rootDir]?>/order/card/kcp/mobile/order_approval.php"/>

<!-- 기타 파라메터 추가 부분 - Start - -->
<input type="hidden" name='param_opt_1'	 value="<?=$param_opt_1?>"/>
<input type="hidden" name='param_opt_2'	 value="<?=$param_opt_2?>"/>
<input type="hidden" name='param_opt_3'	 value="<?=$param_opt_3?>"/>
<!-- 기타 파라메터 추가 부분 - End - -->
<?php
	if ($use_pay_method	== "100000000000"){	// 신용카드 일 때
?>
<!-- 사용 카드 설정 //-->
<input type="hidden" name='used_card'    value="">

<!-- 무이자 옵션
		※ 설정할부    (가맹점 관리자 페이지에 설정 된 무이자 설정을 따른다)                             - "" 로 설정
		※ 일반할부    (KCP 이벤트 이외에 설정 된 모든 무이자 설정을 무시한다)                           - "N" 로 설정
		※ 무이자 할부 (가맹점 관리자 페이지에 설정 된 무이자 이벤트 중 원하는 무이자 설정을 세팅한다)   - "Y" 로 설정 //-->
<input type="hidden" name="kcp_noint"       value="<?=$pg_mobile['zerofeeFl']?>"/>

<!-- 무이자 설정
		※ 주의 1 : 할부는 결제금액이 50,000 원 이상일 경우에만 가능
		※ 주의 2 : 무이자 설정값은 무이자 옵션이 Y일 경우에만 결제 창에 적용
		예) 전 카드 2,3,6개월 무이자(국민,비씨,엘지,삼성,신한,현대,롯데,외환) : ALL-02:03:04
		BC 2,3,6개월, 국민 3,6개월, 삼성 6,9개월 무이자 : CCBC-02:03:06,CCKM-03:06,CCSS-03:06:04 //-->
<input type="hidden" name="kcp_noint_quota" value="<?=$pg_mobile['zerofee_period']?>"/>
<?php	 } ?>
</form>
</div>

<!-- 스마트폰에서 KCP 결제창을 레이어 형태로 구현-->
<div id="layer_card" style="position:absolute; left:1px; top:1px; width:310;height:400; z-index:1; display:none;">
    <table width="310" border="-" cellspacing="0" cellpadding="0" style="text-align:center">
        <tr>
            <td>
                <iframe name="frm_card" frameborder="0" border="0" width="310" height="400" scrolling="auto"></iframe>
            </td>
        </tr>
    </table>
</div>

<form name="pay_form" method="POST" action="<?=$cfg[rootDir]?>/order/card/kcp/mobile/nscreen_card_return.php?page_type=<?=$page_type?>">
    <input type="hidden" name="req_tx"         value="pay">      <!-- 요청 구분          -->
    <input type="hidden" name="res_cd"         value="<?=$res_cd?>">      <!-- 결과 코드          -->
    <input type="hidden" name="tran_cd"        value="<?=$tran_cd?>">     <!-- 트랜잭션 코드      -->
    <input type="hidden" name="ordr_idxx"      value="<?=$ordr_idxx?>">   <!-- 주문번호           -->
    <input type="hidden" name="good_mny"       value="<?=$good_mny?>">    <!-- 휴대폰 결제금액    -->
    <input type="hidden" name="good_name"      value="<?=$good_name?>">   <!-- 상품명             -->
    <input type="hidden" name="buyr_name"      value="<?=$buyr_name?>">   <!-- 주문자명           -->
    <input type="hidden" name="buyr_tel1"      value="<?=$buyr_tel1?>">   <!-- 주문자 전화번호    -->
    <input type="hidden" name="buyr_tel2"      value="<?=$buyr_tel2?>">   <!-- 주문자 휴대폰번호  -->
    <input type="hidden" name="buyr_mail"      value="<?=$buyr_mail?>">   <!-- 주문자 E-mail      -->
    <input type="hidden" name="enc_info"       value="<?=$enc_info?>">    <!-- 암호화 정보        -->
    <input type="hidden" name="enc_data"       value="<?=$enc_data?>">    <!-- 암호화 데이터      -->
    <input type="hidden" name="use_pay_method" value="<?=$use_pay_method?>">      <!-- 요청된 결제 수단   -->
	<input type="hidden" name="param_opt_1"	   value="<?=$param_opt_1?>">
	<input type="hidden" name="param_opt_2"	   value="<?=$param_opt_2?>">
	<input type="hidden" name="param_opt_3"	   value="<?=$param_opt_3?>">
</form>