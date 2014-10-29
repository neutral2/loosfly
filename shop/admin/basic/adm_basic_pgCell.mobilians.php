<?php

include "../_header.popup.php";

$config = Core::loader('config');
$mobilians = Core::loader('Mobilians');

$shopConfig = $config->load('config');
$mobiliansCfg = $config->load('mobilians');
$mobiliansPrefix = $mobilians->lookupPrefix();

$checked = array(
    'serviceType' => array($mobiliansCfg['serviceType'] => ' checked="checked"'),
);

?>
<script type="text/javascript">
window.onload = function()
{
	resizeFrame();
};

function mobiliansConfigFormSubmit(frm)
{
	var
	originEnv = "<?php echo $mobiliansCfg['serviceType']; ?>",
	selectRealEnv = null,
	warningMsg = "����ȯ���� �ǰŷ� ȯ������ �����ϼ̽��ϴ�.\r\n"
		   + "������� ����ڿ� ���Ǿ��� �ǰŷ� ȯ������ ��ȯ ��\r\n"
		   + "������ �����ʾ� Ŭ������ �߻��� �� �ֽ��ϴ�.\r\n"
		   + "����Ͻðڽ��ϱ�?";
	for (var serviceTypeIndex = 0, selectedServiceType = frm.serviceType[0]; selectedServiceType; selectedServiceType = frm.serviceType[++serviceTypeIndex]) {
		if(frm.serviceType[serviceTypeIndex].value === "10" && frm.serviceType[serviceTypeIndex].checked === true) selectRealEnv = true;
	}
	// �ǰŷ��� �����ߴµ� Ȯ��â�� ���� ���� �������� false
	if (originEnv !== "10" && selectRealEnv === true && confirm(warningMsg) === false) {
		return false;
	}
	else {
		return chkForm(frm);
	}
}

var IntervarId;
function resizeFrame()
{

    var oBody = document.body;
    var oFrame = parent.document.getElementById("pgifrm");
    var i_height = oBody.scrollHeight + (oFrame.offsetHeight-oFrame.clientHeight);
    oFrame.style.height = i_height;
	oFrame.height = i_height;

    if ( IntervarId ) clearInterval( IntervarId );
}
</script>
<div class="title title_top">
������� ���� <a href="javascript:manual('<?php echo $guideUrl; ?>board/view.php?id=basic&no=38')"><img src="../img/btn_q.gif" border=0 align=absmiddle></a>
</div>
<form action="<?php echo $shopConfig['rootDir']; ?>/admin/basic/adm_basic_pgCell.mobilians.indb.php" method="post" onsubmit="return mobiliansConfigFormSubmit(this);">
	<table border="1" bordercolor="#e1e1e1" style="border-collapse:collapse" width="100%">
		<col class="cellC"><col class="cellL">
		<tr>
			<td height="40">����ȯ��</td>
			<td class="noline">
				<div style="margin: 8px 0; padding-left: 10px;" class="red">
					<strong>�����ǻ���</strong>
					<ol style="padding: 0 0 0 20px; margin: 5px 0 0 0;">
						<li style="margin-bottom: 5px;">
							������� ���� ����� ���ؼ��� ���� ���� ID �Է� �� ����ȯ���� "�׽�Ʈ"�� ���� �Ͽ�, ���� �׽�Ʈ�� �������ּž� �մϴ�.<br/>
							�׽�Ʈ �� ������� ����ڿ� ���� �� ����ȯ���� "�ǰŷ�"�� �������ּž� �մϴ�.<br/>
							�� ������� ����ڿ� ���� ���� �ǰŷ��� �����Ͽ� �߻��ϴ� ������ ���ؼ��� ������� �� ������Ʈ ������ å���� ���� �ʽ��ϴ�. 
						</li>
						<li style="margin-bottom: 5px;">
							����ȯ�濡�� "�׽�Ʈ", "�ǰŷ�" ���� �� ��Ų��ġ�� �����ϼ̴��� Ȯ���Ͽ��ֽñ� �ٶ��, ��Ų��ġ ����� �޴����� �����Ͽ��ֽñ� �ٶ��ϴ�.<br/>
							�� 2013�� 06�� 07�� ���� �����ڸ� ��Ų��ġ�� �������ֽø� �˴ϴ�.
							<a href="javascript:manual('<?php echo $guideUrl; ?>board/view.php?id=basic&no=38')"><img src="../img/btn_q.gif" border="0" align="absmiddle"/></a>
						</li>
						<li>
							������� ���ɽð� : ���� �� ���ϱ����� ��� ó�� �����ϹǷ� ���� �� ���Ŀ��� ���θ�(������)�� �����ڿ��� �ٸ� ����(������, ������ ��)����<br/>
							ȯ�� ó���ؾ� �մϴ�.<br/>
							Ex1) 2013�� 5�� 01�� ���� > 5�� 31�� 24�ñ����� ���� ��� ����<br/>
							Ex2) 2013�� 5�� 31�� ���� > 6�� 1�� ���� ��� ��û �� ��� ���� ��� ó�� �Ұ� > �����ڿ��� �ٸ�����(������,������ ��)���� ȯ��ó���� ����
						</li>
					</ol>
				</div>
				<div style="margin: 8px 0;">
					<input id="svc-type-10" type="radio" name="serviceType" value="10"<?php echo $checked['serviceType']['10']; ?> required label="����ȯ��"/>
					<label for="svc-type-10">�ǰŷ�</label>
					<input id="svc-type-00" type="radio" name="serviceType" value="00"<?php echo $checked['serviceType']['00']; ?>/>
					<label for="svc-type-00">�׽�Ʈ</label>
					<input id="svc-type-no" type="radio" name="serviceType" value="no"<?php echo $checked['serviceType']['no']; ?>/>
					<label for="svc-type-no">������</label>
					<span class="extext">������� ������ �ŷ����·�, �׸� �ڼ��� ������ �ϴ�, "�ñ����ذ�!"�ڳʸ� �����ϼ���</span>
				</div>
			</td>
		</tr>
		<tr>
			<td height="40">����ID</td>
			<td>
				<input type="text" name="serviceId" value="<?php echo $mobiliansCfg['serviceId']; ?>" required label="����ID"/>
				<span class="extext">������𽺿��� �������� �߱޵Ǵ� ���̵� �Դϴ�.(���� 12�ڸ��̸�, <?php echo implode(',', $mobiliansPrefix); ?>�� ���۵Ǿ�� ��)</span>
			</td>
		</tr>
	</table>

	<div class="button">
		<input type="image" src="../img/btn_save.gif">
		<a href="javascript:history.back()"><img src="../img/btn_cancel.gif"></a>
	</div>
</form>
<!-- �ñ��� �ذ� : Start -->
<div id="MSG01">
	<table cellpadding="1" cellspacing="0" border="0" class="small_ex">
		<tr>
			<td>
				<img src="../img/icon_list.gif" align="absmiddle">
				<div style="margin-bottom: 7px;">
					<span style="font-weight: bold;">����ȯ��</span>
					<div>
						�ǰŷ� : ���θ��� ������ ��� ����ڵ��� ������� ���񽺸� ����� �� ������, ������ ������ �̷�����ϴ�.<br/>
						�׽�Ʈ : �����ڱ� ȸ���� ������� ���񽺸� ����� �� ������, ���������� �����ϵ� ������ ������ �̷�������� �ʽ��ϴ�.<br/>
						������ : ������� ���񽺸� ��Ȱ��ȭ ���� ������� ������ ������� �ʽ��ϴ�.
					</div>
				</div>
				<div>
					<span style="font-weight: bold;">������� ���� ����</span>
					<div>
						������𽺿� ����� ���� ���� ���Ϸ� �޴� �����Դϴ�.<br/>
						����ID : �������� ����� ���� �������� �߱޵Ǵ� ���̵� �Դϴ�.(���� 12�ڸ�)<br/>
						MasterID : ������� �������̵�� <a href="https://www.mcash.co.kr/cpmgr" target="_blank">[������� ������]</a> ���� �ÿ� ���˴ϴ�.
					</div>
				</div>
			</td>
		</tr>
	</table>
</div>
<script type="text/javascript">cssRound('MSG01');</script>