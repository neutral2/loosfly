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
		<div style="width:1040px; margin:0 auto;font:normal 12px/20px  "��������", "Nanum Gothic", "AppleGothic", "��������", "Malgun Gothic", "����", "Dotum", "Sans-serif"; font-color:#3f3f3f; letter-spacing:0;">
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
					�� ���������� �ռ��� Ȱ���� ��ġ�� ���빫�밡 <span style="color:#71cbd2;font-size:14px;line-height:35px">�ּ������� ���ο� ������Ʈ ��������� ��ƺ��ҽ��ϴ�.</span><br>�̷��, ������, ��ȿ�� �� ������ ���밡 �����е���� ���� �ݶ󺸷��̼��� ���˴ϴ�.
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
					<span style="color:#71cbd2;font-size:14px;line-height:35px">M Theater �����ȹ��� Next B�� ��û�� ��Ʈ���� �ּ����� �ȹ��� "Gription" ���㼳�� ��� ��ҽ��ϴ�.</span><br>�����ϱ� ����鼭�� ��Ư�� �ȹ��� �ּ���, �ȳ���, ������ �� ���� ������� �ŷ����� ������ ������ ���� �����̾����ϴ�.
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
					<span style="color:#71cbd2;font-size:14px;line-height:35px">�̳��� �������� ������ ��� Motion Five���� ���㼳 ����Դϴ�.</span><br>�̳����������� ���� �ʴ� ������ �輺��, �迵��, �ּ���, ������, ������ �ټ��� ��������� �������� ��췯�� �λ���� ���뿴���ϴ�.
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
					<span style="color:#f47d30;font-size:14px;line-height:35px">�罺�ö��� ��Ʈ������ ���빫�밡 �ּ������� ����� ã���ּ̽��ϴ�.</span><br>���� ������� ��ǰ���� �׽�Ʈ�غ��鼭 �پ��� �ǰ��� ��ȯ�ߴµ���, �׻� ������ �����ϰ� ������ �� �ִ� �ּ������� ����� ��� ��ƺý��ϴ�.
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
					<span style="color:#71cbd2;font-size:14px;line-height:35px">���������� 11��ȣ '�״� ������ ���ִ� ���' ��������</span>�� �⿬�� �罺�ö��� ��Ʈ���� �� ���θ� �ּ������� �Կ��� ȭ���Դϴ�.<br>���� ��Ȳ������ ��ġ�� �ʴ� �������� ���δٿ� ���� ����� �����־����ϴ�.
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
					<span style="color:#f47d30;font-size:14px;line-height:35px">�������� ���빫�밡 ���ֹ�</span>���� ���� �ȹ����� ȭ���Դϴ�.<br>������ �յΰ� �ȹ������ ������ �����ϴ� �Ƹ��ٿ� ����� ��� ��ƺý��ϴ�.
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
					�罺�ö����� ��� ��ǰ�� <span style="color:#71cbd2;font-size:14px;line-height:35px">�����ص帲���� ������</span>�˴ϴ�.
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
					2013�� ���� �پ��� �帣�� ������ �������� <span style="color:#f47d30;font-size:14px;">m.net ����9 ����1 ȫ������ �Կ�����</span>����ġ�Դϴ�.<br>������ �Կ��� ���ϰ� ��� �ּ������� ����� ��ƺý��ϴ�.
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