<?
include "../_header.popup.php";
include "../../lib/page.class.php";
include "../../conf/config.pay.php";

$Query = "
	select
		*,
		date_format( regdt , '%Y.%m.%d %H:%i' ) as regdt,
		date_format( last_login , '%Y.%m.%d %H:%i' ) as last_login
	from
		".GD_MEMBER."
	where
		m_id = '".$_GET['m_id']."'
	";
$data = $db->fetch($Query);

foreach( member_grp() as $v ){
	if ($v[level] == $data[level]) $data[grpnm] = $v[grpnm];
}

$cntQuery = "
	select
		count(*)
	from
		".GD_MEMBER_CRM."
	where
		m_no = '$data[m_no]'
";
$cou_row = $db->fetch($cntQuery);
$cou_cnt = $cou_row['0'];

//쿠폰, 적립금,그룹dc 금액!
$dc_Query = "
SELECT
	coupon,
	emoney,
	memberdc,
	enuri,
	settlekind
FROM
	".GD_ORDER."
where
	m_no = '$data[m_no]' and
 	step = '4' and step2 = '0'
";
$DCsql = $db->query($dc_Query);
$dcprice = 0;

$bank	= 0;
$vbank	= 0;
$abank	= 0;
$card		= 0;
$phone		= 0;
$coupon = 0;
$emoney = 0;
$memberdc = 0;
$enuri = 0;
while( $DCdata = $db->fetch($DCsql) ){
	$dcprice = $dcprice + ($DCdata['coupon'] + $DCdata['emoney'] + $DCdata['memberdc'] + $DCdata['enuri']);
	if( $set['use']['a'] == "on" && $DCdata['settlekind'] == 'a' )	$bank	= $bank + 1;
	if( $set['use']['v'] == "on" && $DCdata['settlekind'] == 'v' )		$vbank	= $vbank + 1;
	if( $set['use']['o'] == "on" && $DCdata['settlekind'] == 'o' )	$abank	= $abank + 1;
	if( $set['use']['c'] == "on" && $DCdata['settlekind'] == 'c' )	$card		= $card + 1;
	if( $set['use']['h'] == "on" && $DCdata['settlekind'] == 'h' )	$phone	= $phone + 1;

	$coupon = $coupon + $DCdata['coupon'];
	$emoney = $emoney + $DCdata['emoney'];
	$memberdc = $memberdc + $DCdata['memberdc'];
	$enuri = $enuri + $DCdata['enuri'];
}

//고객 나이계산!!
if ($data['birth_year']) $age = date('Y') - $data['birth_year'];
$birthday_1 = sprintf("%01d", substr($data['birth'],0,2) );
$birthday_2 = sprintf("%01d", substr($data['birth'],2,2) );

// 회원가입 유입 경로 아이콘
$memIcon_inflow = ($data['inflow']) ? " <img src=\"../img/memIcon_".$data['inflow'].".gif\" align=\"absmiddle\" />" : "";
?>
<style>
.my_line							{ border-bottom:1px #e7e7e7 solid; }
.my_line_no1					{ font-family:verdana; font-size: 7pt; color:#6d6d6d; letter-spacing: -1px; border-bottom:1px #e7e7e7 solid; }
.my_line_no					{ font-family:verdana; font-size: 8pt; color:#6d6d6d; letter-spacing: -1px; border-bottom:1px #e7e7e7 solid; }
.my_line_sub					{ font-family:굴림; font-size: 9pt; color: #867461; border-bottom:1px #e7e7e7 solid; }
.my_line_r						{ border-right:1px #e7e7e7 solid; border-bottom:1px #e7e7e7 solid; }
</style>
<div onmouseup="move_stop();">
<table width="100%" height="100%" cellpadding="0" cellspacing="0" border="0">
<tr>
<td valign="top" align="center">

	<table width="730" cellpadding="0" cellspacing="0" border="0">
	<tr>
	<td height="5"></td>
	</tr>
	<tr>
	<td valign="top">
		<table width="100%" cellpadding="0" cellspacing="0" border="0" align="center" style="border:solid 3px #cecece">
		<tr>
		<td bgcolor=f7f7f7 height="35" style="padding-left:15px" class=main><b><?=$data['name']?> (<?=$_GET['m_id']?>) 회원 CRM 내역</b></td>
		</tr>
		</table>
	</td>
	</tr>

	<tr>
	<td height="12"></td>
	</tr>

	<tr>
	<td  valign="top">
		<table width="730" cellpadding="0" cellspacing="0" border="0" align="center">
		<tr><td colspan="10">
			<table border="0" cellspacing="0" cellpadding="0" width="100%">
			<tr>
				<td width=23><img src="../img/titledot.gif"></td>
				<td width=70 valign=bottom><b>기본정보</b></td>
				<td valign=bottom><font class=small1><?=$data['name']?>님은 현재 <font color="0074BA"><b>[<?=$data[grpnm]?>]</b></font>그룹에 속해있습니다.</font></td>
				<td valign=bottom align="right"><a href="info.php?m_id=<?=$data['m_id']?>" target="_blank"><img src="../img/i_edit.gif" /></a></td>
			</tr>
			<tr><td colspan=5 height=5></td></tr>
			<tr><td colspan=5 bgcolor=cccccc height=3></td></tr>
			<tr><td colspan=5 height=5></td></tr>
			</table>
		</td></tr>

		<tr><td colspan="15" height="1" bgcolor="#e4e4e4"></td></tr>

		<tr>
			<td width="100" height="25" style="padding-right:8px;font:8pt Dotum;letter-spacing:-1px;color:535353;" bgcolor=f6f6f6 align=right><b>이름</b></td>
			<td width="140" style="padding-left:8px;" class=def><?=$data['name']?></td>
			<td width="100" height="25" style="padding-right:8px;font:8pt Dotum;letter-spacing:-1px;color:535353;" bgcolor=f6f6f6 align=right><b>아이디</b></td>
			<td width="200" style="padding-left:8px;" class=def><?=$data['m_id']?></td>
			<td width="100" height="25" style="padding-right:8px;font:8pt Dotum;letter-spacing:-1px;color:535353;" bgcolor=f6f6f6 align=right><b>성별</b></td>
			<td width="180" style="padding-left:8px;" class=def><?=( $data['sex'] == 'm') ? '남' : '여'?></td>
		</tr>

		<tr><td colspan="15" height="1" bgcolor="#e4e4e4"></td></tr>

		<tr>
			<td height="25" style="padding-right:8px;font:8pt Dotum;letter-spacing:-1px;color:535353;" bgcolor=f6f6f6 align=right><b>닉네임</b></td>
			<td style="padding-left:8px;" class=def><?=$data['nickname']?></td>
			<td height="25" style="padding-right:8px;font:8pt Dotum;letter-spacing:-1px;color:535353;" bgcolor=f6f6f6 align=right><b>소속그룹</b></td>
			<td style="padding-left:8px;" class=def>
				<?=$data['grpnm']?>
				<a href="javascript:popup2('../member/sales_report.php?m_no=<?=$data['m_no']?>',400,220,'no')"><font class=ver811 color=0074ba><b>[실적보기]</b></font></a>
			</td>
			<td height="25" style="padding-right:8px;font:8pt Dotum;letter-spacing:-1px;color:535353;" bgcolor=f6f6f6 align=right><b>추천인</b></td>
			<td style="padding-left:8px;" class=def><?=$data['recommid']?></td>
		</tr>

		<tr><td colspan="15" height="1" bgcolor="#e4e4e4"></td></tr>

		<tr>
			<td height="25" style="padding-right:8px;font:8pt Dotum;letter-spacing:-1px;color:535353;" bgcolor=f6f6f6 align=right><b>나이</b></td>
			<td style="padding-left:8px;"><font class=small color=444444><?=$age + 1?></td>
			<td height="25" style="padding-right:8px;font:8pt Dotum;letter-spacing:-1px;color:535353;" bgcolor=f6f6f6 align=right><b>생일</b></td>
			<td style="padding-left:8px;" class=def><?=$birthday_1?>월 <?=$birthday_2?>일</td>
			<td height="25" style="padding-right:8px;font:8pt Dotum;letter-spacing:-1px;color:535353;" bgcolor=f6f6f6 align=right><b>이메일</b></td>
			<td style="padding-left:8px;"><font class=ver811 color=444444><?=$data['email']?> <a href="javascript:popup('../member/email.php?type=direct&m_id=<?=$data['m_id']?>',780,600)"><img src="../img/btn_smsmailsend.gif" align=absmiddle></a></td>
		</tr>

		<tr><td colspan="15" height="1" bgcolor="#e4e4e4"></td></tr>

		<tr>
			<td height="25" style="padding-right:8px;font:8pt Dotum;letter-spacing:-1px;color:535353;" bgcolor=f6f6f6 align=right><b>전화번호</b></td>
			<td style="padding-left:8px;"><font class=ver811 color=444444><?=$data['phone']?></td>
			<td height="25" style="padding-right:8px;font:8pt Dotum;letter-spacing:-1px;color:535353;" bgcolor=f6f6f6 align=right><b>핸드폰</b></td>
			<td style="padding-left:8px;"><font class=ver811 color=444444><?=$data['mobile']?> <a href="javascript:popup('../member/popup.sms.php?m_id=<?=$data['m_id']?>',780,600)"><img src="../img/btn_smsmailsend.gif" align=absmiddle></a></td>
			<td height="25" style="padding-right:8px;font:8pt Dotum;letter-spacing:-1px;color:535353;" bgcolor=f6f6f6 align=right><b>FAX</b></td>
			<td style="padding-left:8px;" class=def><font class=ver811 color=444444><?=$data['fax']?></font></td>
		</tr>

		<tr><td colspan="15" height="1" bgcolor="#e4e4e4"></td></tr>

		<tr>
			<td height="25" style="padding-right:8px;font:8pt Dotum;letter-spacing:-1px;color:535353;" bgcolor=f6f6f6 align=right><b>우편번호</b></td>
			<td style="padding-left:8px;"><font class=ver811 color=444444><?=$data['zipcode']?></td>
			<td height="25" style="padding-right:8px;font:8pt Dotum;letter-spacing:-1px;color:535353;" bgcolor=f6f6f6 align=right><b>주소</b></td>
			<td colspan=3 style="padding-left:8px;" class=def><?=$data['address']?> <?=$data['address_sub']?>
			<? if ($data['road_address']) { ?>
			<div style="padding:5px 0 0 0;font:12px dotum;color:#999;" id="div_road_address" ><?=$data['road_address'];?> <?=$data['address_sub']?></div>
			<? } ?>
	</td>
		</tr>

		<tr><td colspan="15" height="1" bgcolor="#e4e4e4"></td></tr>

		<tr>
			<td height="25" style="padding-right:8px;font:8pt Dotum;letter-spacing:-1px;color:535353;" bgcolor=f6f6f6 align=right><b>회사명</b></td>
			<td style="padding-left:8px;"><font class=ver811 color=444444><?=$data['company']?></font></td>
			<td height="25" style="padding-right:8px;font:8pt Dotum;letter-spacing:-1px;color:535353;" bgcolor=f6f6f6 align=right><b>사업자번호</b></td>
			<td style="padding-left:8px;"><font class=ver811 color=444444><?=$data['busino']?></font></td>
			<td height="25" style="padding-right:8px;font:8pt Dotum;letter-spacing:-1px;color:535353;" bgcolor=f6f6f6 align=right><b>업태/종목</b></td>
			<td style="padding-left:8px;" class=def><font class=ver811 color=444444><?=$data['service']?> / <?=$data['item']?></font></td>
		</tr>

		<tr><td colspan="15" height="1" bgcolor="#e4e4e4"></td></tr>

		<tr>
			<td height="25" style="padding-right:8px;font:8pt Dotum;letter-spacing:-1px;color:535353;" bgcolor=f6f6f6 align=right><b>회원가입일</b></td>
			<td style="padding-left:8px;"><font class=ver811 color=444444><?=$data['regdt']?></font><?=$memIcon_inflow?></td>
			<td height="25" style="padding-right:8px;font:8pt Dotum;letter-spacing:-1px;color:535353;" bgcolor=f6f6f6 align=right><b>최근로그인</b></td>
			<td style="padding-left:8px;"><font class=ver811 color=444444><?=$data['last_login']?> (<?=number_format($data['cnt_login'])?><font class=small1>번</font>)</font></td>
			<td height="25" style="padding-right:8px;font:8pt Dotum;letter-spacing:-1px;color:535353;" bgcolor=f6f6f6 align=right><b>최근로그인IP</b></td>
			<td style="padding-left:8px;"><font class=ver811 color=444444><?=$data['last_login_ip']?></font></td>
		</tr>

		<tr><td colspan="15" height="1" bgcolor="#e4e4e4"></td></tr>

		<tr>
			<td height="25" style="padding-right:8px;font:8pt Dotum;letter-spacing:-1px;color:535353;" bgcolor=f6f6f6 align=right><b>적립금</b></td>
			<td style="padding-left:8px;" class=def title="적립금 클릭시 상세정보를 보실 수 있습니다.">
			<a href="javascript:popupLayer('../member/popup.emoney.php?m_no=<?=$data['m_no']?>',600,500)"><font class="ver811" color="0074ba"><b><?=number_format($data['emoney'])?></b></font>원</a>
			<a href="javascript:popupLayer('../member/popup.emoney.php?m_no=<?=$data['m_no']?>',600,500)"><img src="../img/btn_pointview.gif" border=0 align=absmiddle hspace=2></a>
			</td>
			<td height="25" style="padding-right:8px;font:8pt Dotum;letter-spacing:-1px;color:535353;" bgcolor=f6f6f6 align=right><b>총구매액</b></td>
			<td style="padding-left:8px;" class=def title="구입금액 클릭시 상세정보를 보실 수 있습니다.">
			<a href="javascript:popup('../member/orderlist.php?m_no=<?=$data['m_no']?>',500,600)"><font class=ver811 color=0074ba><b><?=number_format($data['sum_sale'])?></b></font>원</a>
			<font class=ver811 color=0074ba>(<?=number_format($data['cnt_sale'])?><font class=small1>건</font>)</font>
			<a href="javascript:popup('../member/orderlist.php?m_no=<?=$data['m_no']?>',500,600)"><img src="../img/btn_orderview.gif" border=0 align=absmiddle hspace=2></a>
			</td>
			<td height="25" style="padding-right:8px;font:8pt Dotum;letter-spacing:-1px;color:535353;" bgcolor=f6f6f6 align=right><b>평균주문</b></td>
			<td style="padding-left:8px;"><font class=ver811 color=0074ba><b><?echo @number_format($data['sum_sale'] / $data['cnt_sale'])?></b></font>원</td>
		</tr>

		<tr><td colspan="15" height="1" bgcolor="#e4e4e4"></td></tr>

		<tr>
			<td height="25" style="padding-right:8px;font:8pt Dotum;letter-spacing:-1px;color:535353;" bgcolor=f6f6f6 align=right><b>쿠폰사용</b></td>
			<td style="padding-left:8px;"><font class=ver811 color=0074ba><b><?=number_format($coupon)?></b></font>원 <a href="javascript:popup('../member/popup.coupon.php?m_no=<?=$data['m_no']?>',750,600)"><img src="../img/btn_couponview.gif" border=0 align=absmiddle hspace=2></a></td>
			<td height="25" style="padding-right:8px;font:8pt Dotum;letter-spacing:-1px;color:535353;" bgcolor=f6f6f6 align=right><b>적립금사용</b></td>
			<td style="padding-left:8px;"><font class=ver811 color=0074ba><b><?=number_format($emoney)?></b></font>원</td>
			<td height="25" style="padding-right:8px;font:8pt Dotum;letter-spacing:-1px;color:535353;" bgcolor=f6f6f6 align=right><b>그룹DC금액</b></td>
			<td style="padding-left:8px;"><font class=ver811 color=0074ba><b><?=number_format($memberdc)?></b></font>원</td>
		</tr>

		<tr><td colspan="15" height="1" bgcolor="#e4e4e4"></td></tr>

		<tr>
			<td height="25" style="padding-right:8px;font:8pt Dotum;letter-spacing:-1px;color:535353;" bgcolor=f6f6f6 align=right><b>에누리금액</b></td>
			<td style="padding-left:8px;"><font class=ver811 color=0074ba><b><?=number_format($enuri)?></b></font>원</td>
			<td height="25" style="padding-right:8px;font:8pt Dotum;letter-spacing:-1px;color:535353;" bgcolor=f6f6f6 align=right><b>총할인금액</b></td>
			<td style="padding-left:8px;"><font class=ver811 color=0074ba><b><?=number_format($dcprice)?></b></font>원</td>
			<td height="25" style="padding-right:8px;font:8pt Dotum;letter-spacing:-1px;color:535353;" bgcolor=f6f6f6 align=right><b>주결제수단</b></td>
			<td style="padding: 4px 0px 4px 8px;" class=small><font color=555555>
			<?
			if( $bank > 0 ) echo "무통장입금 : ".$bank.'건 ('.@round(($bank / $data['cnt_sale']) * 100).'%)<br>';
			if( $card > 0 ) echo "신용카드 : ".$card.'건 ('.@round(($card / $data['cnt_sale']) * 100).'%)<br>';
			if( $abank > 0 ) echo "계좌이체 : ".$abank.'건 ('.@round(($abank / $data['cnt_sale']) * 100).'%)<br>';
			if( $vbank > 0 ) echo "가상계좌 : ".$vbank.'건 ('.@round(($vbank / $data['cnt_sale']) * 100).'%)<br>';
			if( $phone > 0 ) echo "핸드폰 : ".$phone.'건 ('.@round(($phone / $data['cnt_sale']) * 100).'%)';
			?></font>
			</td>
		</tr>

		<tr><td colspan="15" height="1" bgcolor="#e4e4e4"></td></tr>

		<tr>
			<td height="25" style="padding-right:8px;font:8pt Dotum;letter-spacing:-1px;color:535353;" bgcolor=f6f6f6 align=right><b>개인정보관련</b></td>
			<td style="padding-left:8px;">
			<div><span style="width:50%" class=ver811>이용자동의</span>: <?=( $data['private1'] == "y" ? '<font color=0074BA class=ver811>동의함</font>' : '<font color=EA0095>동의안함</font>' )?></div>
			<?if($cfg['private2YN'] == "Y"){?><div><span style="width:50%" class=ver811>제3자제공</span>: <?=( $data['private2'] == "y" ? '<font color=0074BA class=ver811>동의함</font>' : '<font color=EA0095>동의안함</font>' )?></div><?}?>
			<?if($cfg['private3YN'] == "Y"){?><div><span style="width:50%" class=ver811>위탁관련</span>: <?=( $data['private3'] == "y" ? '<font color=0074BA class=ver811>동의함</font>' : '<font color=EA0095>동의안함</font>' )?></div><?}?>
			</td>
			<td height="25" style="padding-right:8px;font:8pt Dotum;letter-spacing:-1px;color:535353;" bgcolor=f6f6f6 align=right><b>남기는 말씀</b></td>
			<td style="padding-left:8px;" class=def colspan=3><?=nl2br($data[memo])?></td>
		</tr>

		<tr><td colspan="15" height="1" bgcolor="#e4e4e4"></td></tr>

<? if ( preg_match( "/^rental_mxfree/i", $godo[ecCode] ) ){ ?>
		<tr><td colspan="10" height="20"></tr>
		<tr>
		<td colspan="10">
			<table border="0" cellspacing="0" cellpadding="0" width="100%">
			<tr><td colspan="10"><div class="title title_top">상담내역</div></td></tr>
			</table>
		</td>
		</tr>
		<tr>
		<td height="55" bgcolor="#eeeeee" align="center" colspan="10"><div><font color=444444>이 기능은 현재 사용하고 계신 <font color=EA0095><b>e나무 <?=$godo[ecName]?></b></font> 에는 지원하지 않습니다.<div>
		<div style="padding-top:3"><font color=EA0095><b>e나무 임대형(500/무제한), 독립형</b></font>에만 지원됩니다.</div></td>
		</tr>
<? } else { ?>
		<tr><td colspan="10" height="20"></tr>

		<tr>
		<td colspan="10">
			<table border="0" cellspacing="0" cellpadding="0" width="100%">
			<tr>
			<td width=23><img src="../img/titledot.gif"></td>
			<td width=120 valign=bottom><b>상담내역</b></td>
			<td align=right valign=bottom><a href="javascript:div_in('Crm_writeFormID');"><img src="../img/btn_cs_regist.gif"></a></td>
			<td valign=bottom><!-- <div id="sou_list_onID" style='display:block;cursor:pointer;' onclick="list_close();"><font class=small1 color=0074BA><b>[리스트보기 (<?=$cou_cnt?>개)]</div><div id="sou_list_offID" style='display:none;cursor:pointer;' onclick="list_close();"><font class=small1 color=0074BA><b>[리스트닫기]</div> --></td>
			</tr>
			<tr><td colspan=5 height=5></td></tr>
			<tr><td colspan=5 bgcolor=cccccc height=3></td></tr>
			</table>
		</td>
		</tr>


		<tr>
		<td valign="top" colspan="10">
			<table border="0" cellspacing="0" cellpadding="0" width="100%">
			<tr>
			<td valign="top">
				<table border="0" cellspacing="0" cellpadding="0">
				<tr align="center" bgcolor="F8F8F8">
				<td style="font-size:11px;font-family:돋움, 굴림;" width="45" height='30'><font class=small1 color=444444><b>No</b></td>
				<td style="font-size:11px;font-family:돋움, 굴림;" width="113"><font class=small1 color=444444><b>상담일</b></td>
				<td style="font-size:11px;font-family:돋움, 굴림;" width="88"><font class=small1 color=444444><b>처리자</b></td>
				<td style="font-size:11px;font-family:돋움, 굴림;" width="410"><font class=small1 color=444444><b>내용</b></td>
				<td style="font-size:11px;font-family:돋움, 굴림;" width="81"><font class=small1 color=444444><b>상담수단</b></td>
				</tr>
				<tr><td colspan="5" height='2' bgcolor='#DFDFDF'></td></tr>
				</table>

				<table border="0" cellspacing="0" cellpadding="0" id="addTr">
				<col width="40"><col width="1"><col width="100"><col width="1"><col width="80"><col width="1"><col width="407"><col width="1"><col width="80">
				</table>

				<table width="100%" border="0" cellspacing="0" cellpadding="0" id="_lodingID">
				<tr><td height=10></td></tr>
				<tr>
				<td align="center" style="font-size:12px;font-family:굴림;color:#AEAEAE">- 데이터 로딩중입니다 -</td>
				</tr>
				</table>

				<table width="" height='30' border="0" cellspacing="0" cellpadding="0" id="pageTr" align='center'>
				</table>
			</td>
			</tr>
			</table>
		</td>
		</tr>
<? } ?>

		<?
		$parent = array();
		$res = $db->query( "select distinct parent from ".GD_MEMBER_QNA." where m_no = '$data[m_no]' order by parent desc limit 0,3" );
		while ( $row = $db->fetch( $res ) ) $parent[] = $row['parent'];
		if ( count( $parent ) ) $where = "parent in ('" . implode( "','", $parent ) . "')";
		else $where = "0";

		$Query = "
		select
			*,
			date_format( regdt , '%Y.%m.%d' ) as regdts
		from
			".GD_MEMBER_QNA."
		where
			{$where}
		order by parent desc, ( case when parent=sno then 0 else 1 end ) asc, regdt desc
		";
		$Sql= $db->query($Query);
		$numrows = $db->count_($Sql);
		?>
		<tr><td colspan="10" height="20"></tr>
		<tr>
		<td colspan="10">
			<table border="0" cellspacing="0" cellpadding="0" width="100%">
			<tr>
			<td width=23><img src="../img/titledot.gif"></td>
			<td width=120 valign=bottom><b>1:1 문의내역</b></td>
			<td align=right valign=bottom style="padding-right:7"><font class=small1 color=444444>(최근 3건의 문의만 출력)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a href="../board/member_qna.php?skey=m_id&sword=<?=$data['m_id']?>&sitemcd=all" target="_blank"><img src="../img/btn_qa_allview.gif" align=absmiddle></a></td>
			</tr>
			<tr><td colspan=5 height=5></td></tr>
			<tr><td colspan=5 bgcolor=cccccc height=3></td></tr>
			</table>
		</td>
		</tr>
		<tr>
		<td valign="top" colspan="10">
			<table border="0" cellspacing="0" cellpadding="0" width="100%">
			<tr>
			<td valign="top">
				<table border="0" cellspacing="0" cellpadding="0">
				<col align="center" span='5'>
				<tr bgcolor="F8F8F8">
				<td style="font-size:11px;font-family:돋움, 굴림;" width="60" height='30'><font class=small1 color=444444><b>No</b></td>
				<td style="font-size:11px;font-family:돋움, 굴림;" width="410"><font class=small1 color=444444><b>제목</b></td>
				<td style="font-size:11px;font-family:돋움, 굴림;" width="80"><font class=small1 color=444444><b>질문유형</b></td>
				<td style="font-size:11px;font-family:돋움, 굴림;" width="100"><font class=small1 color=444444><b>작성자</b></td>
				<td style="font-size:11px;font-family:돋움, 굴림;" width="80"><font class=small1 color=444444><b>작성일</b></td>
				</tr>
				<tr><td colspan="5" height='2' bgcolor='#DFDFDF'></td></tr>
				</table>
				<table border="0" cellspacing="0" cellpadding="0" id="qna_TrID">
				<col align="center" span='5'>
				<?
				$qna_No = $numrows;
				$itemcds = codeitem( 'question' ); # 질문유형
				$itemcds_cnt = count($itemcds);
				while( $row = $db->fetch($Sql) ){
					list( $row[m_id] ) = $db->fetch("select m_id from ".GD_MEMBER." where m_no='$row[m_no]'" );
					if ( $row[sno] == $row[parent] ){ // 질문
						$itemcdTx =  $itemcds[$row['itemcd']];
						list( $row[replecnt] ) = $db->fetch("select count(*) from ".GD_MEMBER_QNA." where sno != parent and parent='$row[sno]'");
					}
					?>

					<?if ( $row[sno] == $row[parent] ){ // 질문?>
				<tr><td colspan="5" height='1' bgcolor='#DFDFDF'></td></tr>
				<tr height="27">
				<td width="60"><font class=ver71 color=666666><?=$qna_No?></font></td>
				<td align=left width="410" style='cursor:pointer;' onclick="div_in('qna_cont_<?=$row['sno']?>_ID');" title='내용보기'><font color=444444><?=$row['subject']?></font> <font class=ver8 color=FF6709>(<?=$row[replecnt]?>)</font></td>
				<td width="80"><font class=small1 color=666666><?=$itemcdTx?></font></td>
				<td width="100"><font color=0074BA class=ver811><b><?=$row[m_id]?></b></font></td>
				<td width="80"><font class=ver71 color=666666><?=$row['regdts']?></font></td>
				</tr>
				<tr id='qna_cont_<?=$row['sno']?>_ID' style='display:none;'>
					<td colspan="5" style='cursor:pointer;padding:5 65 5 65;' onclick="div_out('qna_cont_<?=$row['sno']?>_ID');" align="left" title='내용닫기'><font color=444444><?=$row['contents']?></font></td>
				</tr>
					<?} else if ( $row[sno] != $row[parent] ){ // 답글?>
				<tr><td colspan="5" height='1'><div style="border-top:dotted 1px #DCD8D6;"></td></tr>
				<tr height="27">
				<td width="60"><font class=ver71 color=666666><?=$qna_No?></font></td>
				<td align=left width="410" style='cursor:pointer;' onclick="div_in('qna_cont_<?=$row['sno']?>_ID');" title='내용보기'><img src="../img/btn_reply.gif" border=0 align=absmiddle> <font color=444444><?=$row['subject']?></font></td>
				<td width="80"><font class=small1 color=666666><?=$itemcdTx?></font></td>
				<td width="100"><font style="color:#616161;" class=ver8><?=$row[m_id]?></font></td>
				<td width="80"><font class=ver71 color=666666><?=$row['regdts']?></font></td>
				</tr>
				<tr id='qna_cont_<?=$row['sno']?>_ID' style='display:none;'>
					<td colspan="5" style='cursor:pointer;padding:5 65 5 97;' onclick="div_out('qna_cont_<?=$row['sno']?>_ID');" align="left" title='내용닫기'><font color=444444><?=$row['contents']?></font></td>
				</tr>
					<?}?>

				<?$qna_No--;
					}?>
				</table>
			</td>
			</tr>
			</table>
		</td>
		</tr>

		<tr><td colspan="15" height="1" bgcolor="#CCCCCC"></td></tr>

		<tr><td colspan="10" height="10"></tr>
		<tr>
		<td colspan="10">

<div id=MSG01>
<table cellpadding=1 cellspacing=0 border=0 class=small_ex>
<tr><td><img src="../img/icon_list.gif" align="absmiddle">적립금 및 구입금액을 클릭하시면 해당 내역을 보실 수 있습니다.</td></tr>
<tr><td><img src="../img/icon_list.gif" align=absmiddle>주문건수 및 주문관련 금액은 배송완료 기준입니다.</td></tr>
<tr><td><img src="../img/icon_list.gif" align=absmiddle>회원의 기본정보를 변경하려면 회원리스트>에서 수정버튼을 눌러 수정하세요.</td></tr>
<tr><td><img src="../img/icon_list.gif" align=absmiddle>1:1문의 관리는 최근 5개의 리스트만 보여지며, 전체를 보려면 전체보기를 클릭하세요.</td></tr>
</table>
</div>
<script>cssRound('MSG01')</script>

		</td>
		</tr>

		</table>
	</td>
	</tr>


	</table>

</td>
</tr>
</table>



<!-- 회원 상담내역 등록 start -->
<div style="display:none;position:absolute;top:350;left:200;z-index:10;" id="Crm_writeFormID">
<table width="350" border="0" cellspacing="0" cellpadding="0" style='border:2px #9f9f9f solid' bgcolor="#FFFFFF">
<form name="Crm_writeForm" method="post" action="">
<input type="hidden" name="c_sno" value="0">
	<tr onmousedown='move(event);' onmouseup='move_stop(event);' style='cursor:move'><td colspan="4" height='30' align=center bgcolor="#f9f9f9" id='write_TitleID'><font class=def color=636363><b>상담내역 등록</b></td></tr>

	<tr>
		<td width="60" height='25' style="color:#7C7C7C;font:bold 8pt verdana;" align='center'><font class=small1 color=636363>처리자ID : </td>
		<td width="115"><font class=small1 color=636363><?=$sess['m_id']?></td>
		<td width="90" style="color:#7C7C7C;font:bold 8pt verdana;" align='center'><font class=small1 color=636363>상담수단 : </td>
		<td width="85">
		<select name="counsel_Type">
			<option value="p">전화</option>
			<option value="m">메일</option>
			<option value="h">기타</option>
		</select>
		</td>
	</tr>

	<tr>
	<td height='25' align='center'><font class=small1 color=636363>상담시간 : </td>
	<td colspan="3" height="25"><input type="text" name="regdt" value="<?=date('Y-m-d H:i:s');?>" style="width:50%;height:18px;" class=ver71></td>
	</tr>

	<tr>
	<td colspan="4" height="70" style="padding-left:10"><textarea name="contents" style="width:97%;height:200px" class="line"></textarea></td>
	</tr>

	<tr id="write_submit_ID" style='display:block;' align=center>
		<td colspan='2' align='right' height="25" style="padding-right:3px;"><div onclick="view_Request('write',document.Crm_writeForm);" style="cursor:pointer;"><img src="../img/btn_daily_regist.gif"></div></td>
		<td colspan='2' align='left' height="25" style="padding-left:3px;"><div onclick="div_out('Crm_writeFormID');" style="cursor:pointer;"><img src="../img/btn_daily_close.gif"></div></td>
	</tr>
	<tr id="change_submit_ID" style='display:none;'>
		<td colspan='2' align='right' height="25" style="padding-right:3px;"><div onclick="view_Request('change',document.Crm_writeForm);" style="cursor:pointer;"><img src="../img/btn_daily_regist.gif"></td>
		<td colspan='2' align='left' height="25" style="padding-left:3px;"><div onclick="div_out('Crm_writeFormID');" style="cursor:pointer;"><img src="../img/btn_daily_close.gif"></div></td>
	</tr>
	<tr><td colspan=5 height=8></td></tr>
</form>
</table>
</div>
<!-- 회원 상담내역 등록 end -->

<!-- 정보 start -->
<form name="infoFm" method="post" action="">
<input type="hidden" name="page" value="1">
<input type="hidden" name="m_no" value="<?=$data['m_no']?>">
<input type="hidden" name="list_close" value="n">
<input type="hidden" name="sno" value="">
</font>
<!-- 정보 end -->

</div> <!-- 전체적인 div end -->
<script>
function opener_Link(opt){
	var m_id = "<?=$data[m_id]?>";
	if( opt == "qna" ) var url = "../board/member_qna.php?skey=m_id&sword="+m_id+"&sitemcd=all";
	parent.document.location.href = url;
}


function div_in(thisID){
	var obj = document.getElementById(thisID);
	if( obj.style.display == 'block' ) obj.style.display = 'none';
	else obj.style.display = 'block';
}

function div_out(thisID){
	document.Crm_writeForm.reset();
	document.getElementById(thisID).style.display = 'none';
}

function view(sno){
	document.infoFm.sno.value = sno;
	view_Request('view',document.infoFm);
}

//ajax 전송!
function view_Request(mode,form){
	var m_no = '<?=$data[m_no]?>';

	if( mode == "list" ){
		Table_close('addTr');
		Table_close('pageTr');
		document.getElementById('_lodingID').style.display = 'block';
		var page = document.infoFm.page.value;
		var get_out = "&m_no=<?=$data[m_no]?>&page="+page;

	}else if( mode == "write" || mode == "change" ){
		var sno = form.c_sno.value;
		var counsel_id = '<?=$sess[m_id]?>';
		var contents = form.contents.value.replace(/\n/gi, '%0A');
		var counsel_Type = form.counsel_Type.options.value;
		var regdt = form.regdt.value;

		if( !contents ){ alert('상담내용을 등록해주세요!');form.contents.focus();return; }

		var get_out = "&m_no=" + m_no +'&counsel_id='+ counsel_id +'&contents='+ encodeURIComponent(contents) +'&counsel_Type='+ counsel_Type +'&regdt='+ regdt+'&sno='+ sno;

	}else if( mode == "view" ){
		var sno = form.sno.value;
		var get_out = "&m_no=" + m_no +'&sno='+ sno;
	}

	var ajax = new Ajax.Request(
		"../member/Crm_view_proc.php?mode="+mode+ get_out +"&dummy="+new Date().getTime(),
		{
		method : 'get',
		onComplete : view_setResponse
		}
	);

}

//ajax 출력!!
function view_setResponse(req){
	//alert(req.responseText);
	var re_ajax = eval( '(' + req.responseText + ')' );

	if( re_ajax.mode == "write" ){
		if( re_ajax.insert_sno > 0 ){
			alert('상담내용이 등록되었습니다.');
			document.Crm_writeForm.reset();
			div_out("Crm_writeFormID");
			view_Request('list');
		}else{
			alert('등록 중 오류가 발생하여 다시한번 저장해 주시기 바랍니다.');
		}
	}

	if( re_ajax.mode == "view" ){
		document.infoFm.sno.value = '';

		div_in('Crm_writeFormID');

		document.getElementById('write_submit_ID').style.display = 'none';
		document.getElementById('change_submit_ID').style.display = 'block';

		document.getElementById('write_TitleID').innerHTML = "<font class=def color=636363><b>상담내역 수정</b></font>";
		var fm = document.Crm_writeForm;
		for(i=0; i < fm.counsel_Type.options.length; i++){
			if( fm.counsel_Type.options[i].value == re_ajax.data['counsel_Type'] ) fm.counsel_Type.selectedIndex = i;
		}
		fm.regdt.value = re_ajax.data['regdt'];
		fm.contents.value = re_ajax.data['contents'];
		fm.c_sno.value = re_ajax.data['sno'];
	}

	if( re_ajax.mode == "change" ){
		div_out("Crm_writeFormID");
		view_Request('list');
	}

	if( re_ajax.mode == "list" ){
		var pageing_len = re_ajax.pageing.length;
		var data_len = re_ajax.data.length;
		var addr_Tr = document.getElementById('addTr');
		document.getElementById('_lodingID').style.display = 'none';
		//리스트 출력start

		if( data_len > 0 ){
			pageing(pageing_len,re_ajax.pageing); //페이징 처리!!
		//	document.getElementById('sou_list_onID').innerHTML = "[리스트보기("+re_ajax.totalCnt+"개)]";

			for ( n = 0; n < data_len; n++ ){
				var oTr = addr_Tr.insertRow(-1);
				oTr.height='30';
				for( f = 0; f < 9; f++ ){
					var oTd = oTr.insertCell(-1);
					if( f == 0 ){   //번호
					oTd.innerHTML = "<div style='cursor:pointer;color:#666666' onclick='view(\""+re_ajax.data[n]['sno']+"\");' title='수정'>" + re_ajax.data[n]['myno'] + "<div>";
					oTd.className ='my_line_no1';
					oTd.style.padding='0 0 0 0';
					oTd.align='center';
					}else if( f == 1 ){   //구분
					oTd.innerHTML = "<img src=../img/item_line1.gif>";
					oTd.className ='my_line';
					oTd.style.padding='0 5 0 5';
					}else if( f == 2 ){   //상담일
					oTd.innerHTML = "<div style='color:#666666'>" + re_ajax.data[n]['regdt'] + "</div>";
					oTd.className ='my_line_no1';
					oTd.style.padding='0 0 0 0';
					oTd.align='center';
					}else if( f == 3 ){   //구분
					oTd.innerHTML = "<img src=../img/item_line1.gif>";
					oTd.className ='my_line';
					oTd.style.padding='0 5 0 5';
					}else if( f == 4 ){   //상담자 ID
					oTd.innerHTML ="<div style='color:#666666'>" +  re_ajax.data[n]['counsel_id'] + "</div>";
					oTd.className ='my_line_no1';
					oTd.style.padding='0 0 0 0';
					oTd.align='center';
					}else if( f == 5 ){   //구분
					oTd.innerHTML = "<img src=../img/item_line1.gif>";
					oTd.className ='my_line';
					}else if( f == 6 ){   //상담내용
					var contents = "<div style='cursor:pointer;font:9pt 굴림;color:#444444' title='내용보기' onclick='div_in(\"memo_cont_"+re_ajax.data[n]['sno']+"\")'>" + re_ajax.data[n]['contents'].substr(0,40) + "&nbsp;<a href='javascript:view(\""+re_ajax.data[n]['sno']+"\");'><img src='../img/btn_edit_qa.gif' hspace=2></a><div>";
					oTd.innerHTML = contents;
					oTd.className ='my_line_no1';
					oTd.style.padding='0 0 0 8';
					oTd.align='left';
					}else if( f == 7 ){   //구분
					oTd.innerHTML = "<img src=../img/item_line1.gif>";
					oTd.className ='my_line';
					}else if( f == 8 ){   //상담내용
					if( re_ajax.data[n]['counsel_Type'] == "p" ) var counsel_Type = "<div style='font:8pt 돋움;color:#666666'>전화</div>";
					else if( re_ajax.data[n]['counsel_Type'] == "m" ) var counsel_Type = "<div style='font:8pt 돋움;color:#666666'>메일</div>";
					else var counsel_Type = "<div style='font:8pt 돋움;color:#666666'>기타</div>";
					oTd.innerHTML = counsel_Type;
					oTd.className ='my_line_no1';
					oTd.style.padding='0 0 0 0';
					oTd.align='center';
					}
				} // f for end

				var oTr = addr_Tr.insertRow(-1);
				var oTd = oTr.insertCell(-1);
				oTd.colSpan = '9';
				oTd.className ='my_line_no1';
				oTd.innerHTML = "<div id='memo_cont_"+re_ajax.data[n]['sno']+"' style='padding-left:5px;padding:5 60 5 60;font:9pt 굴림;color:#444444;letter-spacing:0;display:none;cursor:pointer;' onclick='div_out(\"memo_cont_"+re_ajax.data[n]['sno']+"\")' title='클릭시닫기'>"+re_ajax.data[n]['contents'].replace(/\n/gi, '<br>')+"</div>";
			} //n for end
		}
	}
}


//뷰어창 이동!!
//MOVE
var appname = navigator.appName.charAt(0);
var Move_x = '';
var Move_y = '';
var target_Element = '';
function move(event){
	if( appname == "M" ){ //익스
		target_Element = event.srcElement;
	}else{ //익스외
		if (event.which !=1){
			return false;
		}
		else{
			type = true;
			target_Element = event.target;
		}
	}
	type = true;
	Move_x = event.clientX;
	Move_y = event.clientY;
	if( appname == "M" ) target_Element.onmousemove = view_start;
	else{
		document.onmousemove = Moview_start;
	}
}

//익스 moveing!!
function view_start(){

	if(type == true){

		var Nowx = event.clientX - Move_x;
		var Nowy = event.clientY - Move_y;
		var targetName = document.getElementById("Crm_writeFormID");
		targetName.style.left = int_n(targetName.style.left) + Nowx;
		targetName.style.top = int_n(targetName.style.top) + Nowy;
		Move_x = event.clientX;
		Move_y = event.clientY;
		return false;
	}
}
//익스외의 moveing!!
function Moview_start(event){
	if(type == true){
		var Nowx = event.clientX - Move_x;
		var Nowy = event.clientY - Move_y;
		var targetName = document.getElementById("Crm_writeFormID");
		targetName.style.left = int_n(targetName.style.left) + Nowx;
		targetName.style.top = int_n(targetName.style.top) + Nowy;
		Move_x = event.clientX;
		Move_y = event.clientY;
		return false;
	}
}

function move_stop(event){
	type =  false;
}

function int_n(cnt){
	if( isNaN(parseInt(cnt)) == true ) var re_cnt = 0;
	else var re_cnt = parseInt(cnt);
	return re_cnt;
}

document.onmouseup = move_stop;

//테이블의 tr 삭제하기
function Table_close(tableID){
	var addr_Tr = document.getElementById(tableID);
	var old_cnt = addr_Tr.rows.length;
	if( old_cnt > 0  ){
		for( jj=0; jj < old_cnt; jj++ ){ addr_Tr.deleteRow(); }
	}
}

function pageing(len,value){
	var total_page = value[0]; //총 페이지 수
	var now_page = value[1]; //해당 페이지
	var in_block = value[2]; //정의된 블록값
	var total_block = value[3] // 총 블럭수
	var now_block = value[4]; //해당 블록값

	var page_Tr = document.getElementById('pageTr');
	var pTr = page_Tr.insertRow(-1);

	//표시될 페이지 수
	var page_cnt = 0;
	if( total_page <= in_block ) page_cnt = total_page;
	else{
		if( total_block == now_block ){
			var lastblockcnt = eval(10) * ( eval(now_block) - eval(1) );
			var lastb_pagecnt = eval(total_page) - eval(lastblockcnt);
			page_cnt = lastb_pagecnt;
		}else page_cnt = in_block;
	}

	//페이징 리스트테이블 사이즈 조정!!
	var targetTrsize = eval(17) * ( eval(page_cnt) + eval(4) );
	document.getElementById('pageTr').width = targetTrsize;

	// 뒤로한간 이동 start ---
	var Endimg = "<font class=small color=666666>◀</font>";
	var pTd = pTr.insertCell(-1);
	pTd.width = 20;
	pTd.align = "center";
	if( now_page <= 1  ) pTd.innerHTML = Endimg;
	else{
		var Endcnt = eval(now_page) - eval(1);
		pTd.innerHTML = "<div onclick='pageMove(\""+Endcnt+"\");' style='cursor:pointer;color:#789FD2;'>" + Endimg + "</div>";
	}
	// 뒤로한간 이동 end  ---

	//페이지 표시!
	var npage;
	for( p=1; p <= page_cnt; p++ ){

		npage = ( eval(10) * ( eval(now_block) - eval(1) ) + eval(p) ) ;
	//	if( npage > total_page ) break;

		var pTd = pTr.insertCell(-1);
		pTd.width = 10;
		pTd.align = "center";

		if( now_page == npage ) pTd.innerHTML = "<font class=ver7 color=444444><b>" + npage + "</b>";
		else pTd.innerHTML = "<font class=ver7 color=444444><div onclick='pageMove(\""+npage+"\");' style='cursor:pointer;'>[" + npage +"]</div>";
	}

	// 앞으로 한간 이동 start ---
	var Nextimg = "<font class=small color=666666>▶</font>";
	var pTd = pTr.insertCell(-1);
	if( now_page >= total_page  ) pTd.innerHTML = Nextimg;
	else{
		var Nexcnt = eval(now_page) + eval(1);
		pTd.innerHTML = "<div onclick='pageMove(\""+Nexcnt+"\");' style='cursor:pointer;color:#789FD2;'>" + Nextimg + "</div>";
	}
	pTd.width = 20;
	pTd.align = "center";
	// 앞으로 한간 이동 end ---

}

function pageMove(page){
		document.infoFm.page.value = page;
		view_Request('list');
}

function list_close(){
	var fm = document.infoFm;
	if( fm.list_close.value == 'y' ){
		Table_close('addTr');
		Table_close('pageTr');
		document.getElementById("sou_list_onID").style.display = "block";
		document.getElementById("sou_list_offID").style.display = "none";
		fm.list_close.value = 'n';
	}else{
		view_Request('list');
		document.getElementById("sou_list_offID").style.display = "block";
		document.getElementById("sou_list_onID").style.display = "none";
		fm.list_close.value = 'y';
	}
}

<? if ( preg_match( "/^rental_mxfree/i", $godo[ecCode] ) == 0 ){ ?>
view_Request('list');
<? } ?>

function mall_listClose(listID,id1,id2){
	var target_listObj = document.getElementById(listID);
	var on_bot = document.getElementById(id1);
	var off_bot = document.getElementById(id2);

	if( target_listObj.style.display == "none" ){
		on_bot.style.display = "none";
		off_bot.style.display = "block";
		target_listObj.style.display = "block";
	}else{
		on_bot.style.display = "block";
		off_bot.style.display = "none";
		target_listObj.style.display = "none";
	}
}
</script>