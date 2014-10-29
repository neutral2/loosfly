<?

$location = "문의/후기관리 > 문의/후기 게시판 설정";
include "../_header.php";

include "../../lib/page.class.php";
@include "../../conf/phone.php";
include "../../conf/config.php";

### 문의 설정
	$selected['qnaAllListSet'][$cfg['qnaAllListSet']] = "selected";
	$selected['qnaAuth_W'][$cfg['qnaAuth_W']] = "selected";
	$selected['qnaAuth_P'][$cfg['qnaAuth_P']] = "selected";
	$checked['qnaSecret'][$cfg['qnaSecret']] = "checked";
	if(!$cfg['qnaSpamComment'] && $cfg['qnaSpamComment'] != 0) $qnaSpamComment = 3;
	else $qnaSpamComment = $cfg['qnaSpamComment'];

	if(!$cfg['qnaSpamBoard'] && $cfg['qnaSpamBoard'] != 0) $qnaSpamBoard = 3;
	else $qnaSpamBoard = $cfg['qnaSpamBoard'];

### 후기 설정
	$selected['reviewAllListSet'][$cfg['reviewAllListSet']] = "selected";
	$selected['reviewAuth_W'][$cfg['reviewAuth_W']] = "selected";
	$selected['reviewAuth_P'][$cfg['reviewAuth_P']] = "selected";
	$checked['reviewWriteAuth'][$cfg['reviewWriteAuth']] = "checked";
	if(!$cfg['reviewSpamComment'] && $cfg['reviewSpamComment'] != 0) $reviewSpamComment = 3;
	else $reviewSpamComment = $cfg['reviewSpamComment'];

	if(!$cfg['reviewSpamBoard'] && $cfg['reviewSpamBoard'] != 0) $reviewSpamBoard = 3;
	else $reviewSpamBoard = $cfg['reviewSpamBoard'];
?>

<form method="post" action="../board/customer_indb.php?mode=replySet" name="fmSet">
<div class="title title_top">상품문의게시판 설정 <span>리스트 개수 제한 및 글쓰기에 대한 권한을 설정하실 수 있습니다</span> <a href="javascript:manual('<?=$guideUrl?>board/view.php?id=board&no=11')"><img src="../img/btn_q.gif" border="0" align="absmiddle" hspace="2"></a></div>
<table class="tb">
<col class="cellC"><col class="cellL">
<tr>
	<td style="line-height:17px;">게시판<br />페이지별 게시글 개수</td>
	<td><select name="qnaAllListSet">
			<option value="10" <?=$selected['qnaAllListSet'][10]?>>10개씩 출력</option>
			<option value="20" <?=$selected['qnaAllListSet'][20]?>>20개씩 출력</option>
			<option value="30" <?=$selected['qnaAllListSet'][30]?>>30개씩 출력</option>
			<option value="40" <?=$selected['qnaAllListSet'][40]?>>40개씩 출력</option>
			<option value="50" <?=$selected['qnaAllListSet'][50]?>>50개씩 출력</option>
		</select> <span class="extext">게시판 전체보기의 페이지별 게시글 노출 개수를 설정합니다.</span></td>
</tr>
<tr>
	<td style="line-height:17px;">상품정보<br />페이지별 게시글 개수</td>
	<td><input type="text" name="qnaListCnt" value="<?=$cfg['qnaListCnt']?>" size="6" class="rline" onkeydown="onlynumber();" /> 개 <span class="extext">상품 상세보기 하단의 페이지별 게시글 노출 개수를 설정합니다.</span></td>
</tr>
<tr>
	<td>글쓰기 권한</td>
	<td class="noline">
		<table>
			<tr>
				<td>
			<table align="left" border="0">
			<tr>
				<td align="center">글쓰기</td>
				<td align="center">답글쓰기</td>
			</tr>
			<tr>
				<?
				$r_level = array("W","P");

				$res2 = $db->query("select * from ".GD_MEMBER_GRP." order by level");
				while ($data=$db->fetch($res2)) $memberGrp[$data['level']] = $data['grpnm'];

				$selected['qnaAuth_W'][$qnaAuth_W] = "selected";
				$selected['qnaAuth_P'][$qnaAuth_P] = "selected";

				for ($i=0;$i<count($r_level);$i++){
				?>
				<td>
					<select name="qnaAuth_<?=$r_level[$i]?>">
					<option value=''>제한없음</option>
					<? foreach ($memberGrp as $k => $v){ ?>
					<option value="<?=$k?>" <?=$selected["qnaAuth_$r_level[$i]"][$k]?> style="background-color:#E9FFE9"><?=$v?> - lv[<?=$k?>]</option>
					<? } ?>
					</select>
				</td>
				<? } ?>
			</tr>
			</table>
				</td>
			</tr>
			<tr>
				<td>
			<div style="padding:3 0 6 0"><font class="extext"><a href="/shop/admin/member/group.php" target="_new"><font class="extext_l">[그룹관리]</font></a> 에서 그룹을 만드세요</div>
			<div>그룹권한시 설정 권한 보다 그룹 레벨이 높은 등급은 전부 권한이 있습니다.</font></div>
				</td>
			</tr>
		</table>
	</td>
</tr>
<tr>
	<td>비밀글 기능</td>
	<td class="noline"><input type="radio" name="qnaSecret" value="" <?=$checked['qnaSecret']['']?>> 미사용&nbsp;&nbsp;
	<input type="radio" name="qnaSecret" value="secret" <?=$checked['qnaSecret']['secret']?>> 사용</td>
</tr>
<tr>
	<td>코멘트 스팸방지</td>
	<td class="noline">
		<label><input type="checkbox" name="qnaSpamComment[]" value="1" <? if ($qnaSpamComment&1) echo"checked" ?>>외부유입차단</label>&nbsp;&nbsp;
		<label><input type="checkbox" name="qnaSpamComment[]" value="2" <? if ($qnaSpamComment&2) echo"checked" ?>>자동등록방지문자</label>&nbsp;&nbsp;
		<div style="padding:2px"></div>
		<font class="extext">이 스팸방지기능은 새로 업그레이드 된 기능입니다. 기능사용 전에 꼭 <a href="javascript:manual('<?=$guideUrl?>board/view.php?id=board&no=9')"><u>패치안내</u></a>를 읽어보세요</font>
	</td>
</tr>
<tr>
	<td>게시글 스팸방지</td>
	<td class="noline">
		<label><input type="checkbox" name="qnaSpamBoard[]" value="1" <? if ($qnaSpamBoard&1) echo"checked" ?>>외부유입차단</label>&nbsp;&nbsp;
		<label><input type="checkbox" name="qnaSpamBoard[]" value="2" <? if ($qnaSpamBoard&2) echo"checked" ?>>자동등록방지문자</label> <font class="extext"><a href="javascript:popupLayer('../board/popup.captcha.php')"><font class="extext_l">[이미지설정]</font></a>
		<div style="padding:2px"></div>
		<font class="extext">스팸방지에 대해 자세히 숙지하시려면 <a href="http://www.godo.co.kr/edu/edu_board_list.html?cate=adminen&in_view=y&sno=408#Go_view" target="_blank"><font class="extext_l">[교육자료]</font></a> 를 확인하세요</font></font><br>
		</div>
	</td>
</tr>
</table>

<div style="padding-top:20px"></div>

<div class="title title_top">상품후기게시판 설정 <span>리스트 개수 제한 및 글쓰기에 대한 권한을 설정하실 수 있습니다</span> <a href="javascript:manual('<?=$guideUrl?>board/view.php?id=board&no=11')"><img src="../img/btn_q.gif" align="absmiddle" hspace="2" /></a></div>
<table class="tb">
<col class="cellC" /><col class="cellL" />
<tr>
	<td style="line-height:17px;">게시판<br />페이지별 게시글 개수</td>
	<td><select name="reviewAllListSet">
			<option value="10" <?=$selected['reviewAllListSet'][10]?>>10개씩 출력</option>
			<option value="20" <?=$selected['reviewAllListSet'][20]?>>20개씩 출력</option>
			<option value="30" <?=$selected['reviewAllListSet'][30]?>>30개씩 출력</option>
			<option value="40" <?=$selected['reviewAllListSet'][40]?>>40개씩 출력</option>
			<option value="50" <?=$selected['reviewAllListSet'][50]?>>50개씩 출력</option>
		</select> <span class="extext">게시판 전체보기의 페이지별 게시글 노출 개수를 설정합니다.</span></td>
</tr>
<tr>
	<td style="line-height:17px;">상품정보<br />페이지별 게시글 개수</td>
	<td><input type="text" name="reviewListCnt" value="<?=$cfg['reviewListCnt']?>" size="6" class="rline" onkeydown="onlynumber();" /> 개 <span class="extext">게시판 전체보기의 페이지별 게시글 노출 개수를 설정합니다.</span></td>
</tr>
<tr>
	<td>글쓰기 권한</td>
	<td class="noline">
		<table>
			<tr>
				<td>
			<table align="left" border="0">
			<tr>
				<td align="center">글쓰기</td>
				<td align="center">답글쓰기</td>
			</tr>
			<tr>
				<?
				$r_level = array("W","P");

				$res2 = $db->query("select * from ".GD_MEMBER_GRP." order by level");
				while ($data=$db->fetch($res2)) $memberGrp[$data['level']] = $data['grpnm'];

				$selected['reviewAuth_W'][$reviewAuth_W] = "selected";
				$selected['reviewAuth_P'][$reviewAuth_P] = "selected";

				for ($i=0;$i<count($r_level);$i++){
				?>
				<td>
					<select name="reviewAuth_<?=$r_level[$i]?>">
					<option value=''>제한없음</option>
					<? foreach ($memberGrp as $k => $v){ ?>
					<option value="<?=$k?>" <?=$selected["reviewAuth_$r_level[$i]"][$k]?> style="background-color:#E9FFE9"><?=$v?> - lv[<?=$k?>]</option>
					<? } ?>
					</select>
				</td>
				<? } ?>
			</tr>
			</table>
				</td>
			</tr>
			<tr>
				<td>
			<div style="padding:3 0 6 0"><font class="extext"><a href="/shop/admin/member/group.php" target="_new"><font class="extext_l">[그룹관리]</font></a> 에서 그룹을 만드세요</div>
			<div>그룹권한시 설정 권한 보다 그룹 레벨이 높은 등급은 전부 권한이 있습니다.</font></div>
				</td>
			</tr>
		</table>
	</td>
</tr>
<tr>
	<td>코멘트 스팸방지</td>
	<td class="noline">
		<label><input type="checkbox" name="reviewSpamComment[]" value="1" <? if ($reviewSpamComment&1) echo"checked" ?>>외부유입차단</label>&nbsp;&nbsp;
		<label><input type="checkbox" name="reviewSpamComment[]" value="2" <? if ($reviewSpamComment&2) echo"checked" ?>>자동등록방지문자</label>&nbsp;&nbsp;
		<div style="padding:2px"></div>
		<font class="extext">이 스팸방지기능은 새로 업그레이드 된 기능입니다. 기능사용 전에 꼭 <a href="javascript:manual('<?=$guideUrl?>board/view.php?id=board&no=9')"><u>패치안내</u></a>를 읽어보세요</font>
	</td>
</tr>
<tr>
	<td>게시글 스팸방지</td>
	<td class="noline">
		<label><input type="checkbox" name="reviewSpamBoard[]" value="1" <? if ($reviewSpamBoard&1) echo"checked" ?>>외부유입차단</label>&nbsp;&nbsp;
		<label><input type="checkbox" name="reviewSpamBoard[]" value="2" <? if ($reviewSpamBoard&2) echo"checked" ?>>자동등록방지문자</label> <font class="extext"><a href="javascript:popupLayer('../board/popup.captcha.php')"><font class="extext_l">[이미지설정]</font></a>
		<div style="padding:2px"></div>
		<font class="extext">스팸방지에 대해 자세히 숙지하시려면 <a href="http://www.godo.co.kr/edu/edu_board_list.html?cate=adminen&in_view=y&sno=408#Go_view" target="_blank"><font class="extext_l">[교육자료]</font></a> 를 확인하세요</font></font><br>
		</div>
	</td>
</tr>
</table>
<div class="button_top"><input type="image" src="../img/btn_save3.gif" /></div>
</form>

<script>window.onload = function(){ UNM.inner();};</script>
<? include "../_footer.php"; ?>