<?php
include "../_header.popup.php";
?>
<script>
Event.observe(document, 'dom:loaded', function(){

	var idx = 0;

	$$('ul.group-list')[0].childElements().each(function(el){

		el.writeAttribute('idx',idx++);

		el.observe('click',function(e){

			var idx = e.srcElement.readAttribute('idx');
			var el = $$('ol.group-info')[0].childElements()[idx];

			var offset1 = $('el-group-info-wrap').positionedOffset();
			var offset2 = el.positionedOffset();


			$('el-group-info-wrap').scrollTop = offset2.top - offset1.top;

		});
	});

});
</script>
<style>
ul.group-list {margin:0;padding:0;}
ul.group-list li {list-style:none;margin:0 10px 5px 0;padding:0;display:inline-block;*display:inline;zoom:1;cursor:pointer;}

div.group-info-wrap {overflow:auto;height:450px;}

ol.group-info {margin:0;padding:0;list-style:none;}
ol.group-info li {border:1px solid #ddd;margin:10px 0 0 0;padding:10px;font-weight:bold;}

ol.group-info li ol.detail {margin:5px 0 0 10px;padding:0;list-style:none;}
ol.group-info li ol.detail li {margin:0;border:none;padding:0px;font-weight:normal;}
</style>

<div class="title title_top">���ڻ�ŷ� ����� ��ǰ�������� ����</div>

<ul class="group-list">
	<li>�Ƿ�</li>
	<li>����/�Ź�</li>
	<li>����</li>
	<li>�м���ȭ</li>
	<li>ħ����/Ŀư</li>
	<li>����</li>
	<li>������</li>
	<li>������ ������ǰ</li>
	<li>��������(������/��ǳ��)</li>
	<li>�繫����</li>
	<li>���б��(������ī�޶�/ķ�ڴ�)</li>
	<li>��������(MP3/���ڻ��� ��)</li>
	<li>�޴���</li>
	<li>�׺���̼�</li>
	<li>�ڵ�����ǰ</li>
	<li>�Ƿ���</li>
	<li>�ֹ��ǰ</li>
	<li>ȭ��ǰ</li>
	<li>�ͱݼ�/����/�ð��</li>
	<li>��ǰ(����깰)</li>
	<li>�Ϲݽ�ǰ</li>
	<li>�ǰ���ɽ�ǰ/ü��������ǰ</li>
	<li>�����ƿ�ǰ</li>
	<li>�Ǳ�</li>
	<li>��������ǰ</li>
	<li>����</li>
	<li>ȣ��/��ǿ���</li>
	<li>������Ű��</li>
	<li>�װ���</li>
	<li>�ڵ����뿩����</li>
	<li>��ǰ�뿩����(������, ��, ����û���� ��)</li>
	<li>��ǰ�뿩����(����, ���ƿ�ǰ, ����ǰ ��)</li>
	<li>������������(����, ����, ���ͳݰ��� ��)</li>
	<li>��ǰ��/����</li>
	<li>��Ÿ</li>
</ul>

<div class="group-info-wrap" id="el-group-info-wrap">

<ol class="group-info">
	<li>
	(1) �Ƿ�
	<ol class="detail">
		<li>1. ��ǰ ���� (������ ���� �Ǵ� ȥ����� ������� ǥ��, ��ɼ��� ��� ������ �Ǵ� �㰡��)</li>
		<li>2. ����</li>
		<li>3. ġ��</li>
		<li>4. ������, ����ǰ�� ��� �����ڸ� �Բ� ǥ��</li>
		<li>5. ������</li>
		<li>6. ��Ź��� �� ��޽� ���ǻ���</li>
		<li>7. ��������</li>
		<li>8. ǰ����������</li>
		<li>9. A/S å���ڿ� ��ȭ��ȣ</li>
	</ol>
	</li>


	<li>
	(2) ���� / �Ź�
	<ol class="detail">
		<li>1. ��ǰ ���� (�ȭ�� ��쿡�� �Ѱ�, �Ȱ��� �����Ͽ� ǥ��)</li>
		<li>2. ����</li>
		<li>3. ġ��</li>
		<li>�߱���: �ؿܻ����� ǥ��� ���������� ���� ǥ��(mm)</li>
		<li>������ (�� ��Ḧ ����ϴ� ����ȭ�� ����, cm)</li>
		<li>4. ������, ����ǰ�� ��� �����ڸ� �Բ� ǥ��</li>
		<li>5. ������</li>
		<li>6. ��޽� ���ǻ���</li>
		<li>7. ǰ����������</li>
		<li>8. A/S å���ڿ� ��ȭ��ȣ</li>
	</ol>
	</li>


	<li>
	(3) ����
	<ol class="detail">
		<li>1. ����</li>
		<li>2. ����</li>
		<li>3. ����</li>
		<li>4. ũ��</li>
		<li>5. ������, ����ǰ�� ��� �����ڸ� �Բ� ǥ��</li>
		<li>6. ������</li>
		<li>7. ��޽� ���ǻ���</li>
		<li>8. ǰ����������</li>
		<li>9. A/S å���ڿ� ��ȭ��ȣ</li>
	</ol>
	</li>


	<li>
	(4) �м���ȭ (���� / ��Ʈ / �׼�����)
	<ol class="detail">
		<li>1. ����</li>
		<li>2. ����</li>
		<li>3. ġ��</li>
		<li>4. ������, ����ǰ�� ��� �����ڸ� �Բ� ǥ��</li>
		<li>5. ������</li>
		<li>6. ��޽� ���ǻ���</li>
		<li>7. ǰ����������</li>
		<li>8. A/S å���ڿ� ��ȭ��ȣ</li>
	</ol>
	</li>


	<li>
	(5) ħ���� / Ŀư
	<ol class="detail">
		<li>1. ��ǰ ���� (������ ���� �Ǵ� ȥ����� ������� ǥ��)�����縦 ����� ��ǰ�� �����縦 �Բ� ǥ��</li>
		<li>2. ����</li>
		<li>3. ġ��</li>
		<li>4. ��ǰ����</li>
		<li>5. ������, ����ǰ�� ��� �����ڸ� �Բ� ǥ��</li>
		<li>6. ������</li>
		<li>7. ��Ź��� �� ��޽� ���ǻ���</li>
		<li>8. ǰ������ ����</li>
		<li>9. A/S å���ڿ� ��ȭ��ȣ</li>
	</ol>
	</li>


	<li>
	(6) ����(ħ�� / ���� / ��ũ�� / DIY��ǰ)
	<ol class="detail">
		<li>1. ǰ��</li>
		<li>2. KC ���� �� ���� (ǰ���濵 �� ����ǰ���������� �� ���� �� ǰ��ǥ�ô�����ǰ�� ����)</li>
		<li>3. ����</li>
		<li>4. ����ǰ</li>
		<li>5. �ֿ� ����</li>
		<li>6. ������, ����ǰ�� ��� �����ڸ� �Բ� ǥ�� (����ǰ �� �����ڰ� �ٸ� ��� �� ����ǰ�� ������, ������)</li>
		<li>7. ������ (����ǰ �� �������� �ٸ� ��� �� ����ǰ�� ������)</li>
		<li>8. ũ��</li>
		<li>9. ��� �� ��ġ���</li>
		<li>10. ǰ����������</li>
		<li>11. A/S å���ڿ� ��ȭ��ȣ</li>
	</ol>
	</li>


	<li>
	(7) ������(TV��)
	<ol class="detail">
		<li>1. ǰ�� �� �𵨸�</li>
		<li>2. �����ǰ �������� �� ���� (�����ǰ���������� �� ����������������ǰ, ��������Ȯ�δ�������ǰ, ���������ռ�Ȯ�δ�������ǰ�� ����)</li>
		<li>3. ��������, �Һ�����, �������Һ�ȿ����� (�������̿��ո�ȭ�� �� �ǹ�����ǰ�� ����)</li>
		<li>4. ���ϸ��� ��ó��</li>
		<li>5. ������, ����ǰ�� ��� �����ڸ� �Բ� ǥ��</li>
		<li>6. ������</li>
		<li>7. ũ�� (��������)</li>
		<li>8. ȭ���� (ũ��, �ػ�, ȭ����� ��)</li>
		<li>9. ǰ����������</li>
		<li>10. A/S å���ڿ� ��ȭ��ȣ</li>
	</ol>
	</li>


	<li>
	(8) ������ ������ǰ(����� / ��Ź�� / �ı⼼ô�� / ���ڷ�����)
	<ol class="detail">
		<li>1. ǰ�� �� �𵨸�</li>
		<li>2. �����ǰ �������� �� ���� (�����ǰ���������� �� ����������������ǰ, ��������Ȯ�δ�������ǰ, ���������ռ�Ȯ�δ�������ǰ�� ����)</li>
		<li>3. ��������, �Һ�����, �������Һ�ȿ����� (�������̿��ո�ȭ�� �� �ǹ�����ǰ�� ����)</li>
		<li>4. ���ϸ��� ��ó��</li>
		<li>5. ������, ����ǰ�� ��� �����ڸ� �Բ� ǥ��</li>
		<li>6. ������</li>
		<li>7. ũ��(�뷮, ���� ����)</li>
		<li>8. ǰ����������</li>
		<li>9. A/S å���ڿ� ��ȭ��ȣ</li>
	</ol>
	</li>


	<li>
	(9) ��������(������ / ��ǳ��)
	<ol class="detail">
		<li>1. ǰ�� �� �𵨸�</li>
		<li>2. �����ǰ �������� �� ���� (�����ǰ���������� �� ����������������ǰ, ��������Ȯ�δ�������ǰ, ���������ռ�Ȯ�δ�������ǰ�� ����)</li>
		<li>3. ��������, �Һ�����, �������Һ�ȿ����� (�������̿��ո�ȭ�� �� �ǹ�����ǰ�� ����)</li>
		<li>4. ���ϸ��� ��ó��</li>
		<li>5. ������, ����ǰ�� ��� �����ڸ� �Բ� ǥ��</li>
		<li>6. ������</li>
		<li>7. ũ��(���� �� �ǿܱ� ����)</li>
		<li>8. �ó������</li>
		<li>9. �߰���ġ���</li>
		<li>10. ǰ����������</li>
		<li>11. A/S å���ڿ� ��ȭ��ȣ</li>
	</ol>
	</li>


	<li>
	(10) �繫����(��ǻ�� / ��Ʈ�� / ������)
	<ol class="detail">
		<li>1. ǰ�� �� �𵨸�</li>
		<li>2. KCC ���� �� ���� (���Ĺ� �� ��������ǰ�� ����, MIC ���� �� ȥ�� ����) </li>
		<li>3. ��������, �Һ�����, �������Һ�ȿ����� (�������̿��ո�ȭ�� �� �ǹ�����ǰ�� ����)</li>
		<li>4. ���ϸ��� ��ó��</li>
		<li>5. ������, ����ǰ�� ��� �����ڸ� �Բ� ǥ��</li>
		<li>6. ������</li>
		<li>7. ũ��, ���� (���Դ� ��Ʈ�Ͽ� ����)</li>
		<li>8. �ֿ� ��� (��ǻ�Ϳ� ��Ʈ���� ��� ����, �뷮, �ü�� ���Կ��� �� / �������� ��� �μ� �ӵ� ��)</li>
		<li>9. ǰ����������</li>
		<li>10. A/S å���ڿ� ��ȭ��ȣ</li>
	</ol>
	</li>


	<li>
	(11) ���б��(������ī�޶� / ķ�ڴ�)
	<ol class="detail">
		<li>1. ǰ�� �� �𵨸�</li>
		<li>2. KCC ���� �� ���� (���Ĺ� �� ��������ǰ�� ����, MIC ���� �� ȥ�� ����)</li>
		<li>3. ���ϸ��� ��ó��</li>
		<li>4. ������, ����ǰ�� ��� �����ڸ� �Բ� ǥ��</li>
		<li>5. ������</li>
		<li>6. ũ��, ����</li>
		<li>7. �ֿ� ���</li>
		<li>8. ǰ����������</li>
		<li>9. A/S å���ڿ� ��ȭ��ȣ</li>
	</ol>
	</li>


	<li>
	(12) ��������(MP3 / ���ڻ��� ��)
	<ol class="detail">
		<li>1. ǰ�� �� �𵨸�</li>
		<li>2. KC ���� �� ���� (���Ĺ� �� ��������ǰ�� ����, MIC ���� �� ȥ�� ����) </li>
		<li>3. ��������, �Һ�����</li>
		<li>4. ���ϸ��� ��ó��</li>
		<li>5. ������, ����ǰ�� ��� �����ڸ� �Բ� ǥ��</li>
		<li>6. ������</li>
		<li>7. ũ��, ����</li>
		<li>8. �ֿ� ���</li>
		<li>9. ǰ����������</li>
		<li>10. A/S å���ڿ� ��ȭ��ȣ</li>
	</ol>
	</li>


	<li>
	(13) �޴���
	<ol class="detail">
		<li>1. ǰ�� �� �𵨸�</li>
		<li>2. KCC ���� �� ���� (���Ĺ� �� ��������ǰ�� ����, MIC ���� �� ȥ�� ����)</li>
		<li>3. ���ϸ��� ��ó��</li>
		<li>4. ������, ����ǰ�� ��� �����ڸ� �Բ� ǥ��</li>
		<li>5. ������</li>
		<li>6. ũ��, ����</li>
		<li>7. �̵���� ��������</li>
			<li>7-1. �̵���Ż�</li>
			<li>7-2. ��������</li>
			<li>7-3. �Һ����� �߰����� �δ���� (���Ժ�, ����ī�� ���Ժ� �� �߰��� �δ��Ͽ��� �� �ݾ�, �ΰ�����, �ǹ����Ⱓ, ����� ��)</li>
		<li>8. �ֿ���</li>
		<li>9. ǰ����������</li>
		<li>10. A/S å���ڿ� ��ȭ��ȣ</li>
	</ol>
	</li>


	<li>
	(14) ������̼�
	<ol class="detail">
		<li>1. ǰ�� �� �𵨸�</li>
		<li>2. KCC ���� �� ���� (���Ĺ� �� ��������ǰ�� ����, MIC ���� �� ȥ�� ����) </li>
		<li>3. ��������, �Һ�����</li>
		<li>4. ���ϸ��� ��ó��</li>
		<li>5. ������, ����ǰ�� ��� �����ڸ� �Բ� ǥ��</li>
		<li>6. ������</li>
		<li>7. ũ��, ���� </li>
		<li>8. �ֿ� ���</li>
		<li>9. �� ������Ʈ ��� �� ����Ⱓ</li>
		<li>10. ǰ����������</li>
		<li>11. A/S å���ڿ� ��ȭ��ȣ</li>
	</ol>
	</li>


	<li>
	(15) �ڵ�����ǰ (�ڵ�����ǰ / ��Ÿ �ڵ�����ǰ)
	<ol class="detail">
		<li>1. ǰ�� �� �𵨸�</li>
		<li>2. ���ϸ��� ��ó��</li>
		<li>3. �ڵ����������� ���� �ڵ�����ǰ �ڱ����� ���� (���� ��� �ڵ�����ǰ�� ����)</li>
		<li>4. ������, ����ǰ�� ��� �����ڸ� �Բ� ǥ��</li>
		<li>5. ������</li>
		<li>6. ũ��</li>
		<li>7. ��������</li>
		<li>8. ǰ����������</li>
		<li>9. A/S å���ڿ� ��ȭ��ȣ</li>
	</ol>
	</li>


	<li>
	(16) �Ƿ���
	<ol class="detail">
		<li>1. ǰ�� �� �𵨸�</li>
		<li>2. �Ƿ������ �㰡 �� �Ű� ��ȣ(�㰡 �� �Ű� ��� �Ƿ��⿡ ����) �� �������������� ����</li>
		<li>3. �����ǰ������������ KC ���� �� ���� (�������� �Ǵ� ��������Ȯ�� ��� �����ǰ�� ����)</li>
		<li>4. ��������, �Һ����� (�����ǰ�� ����)</li>
		<li>5. ���ϸ��� ��ó��</li>
		<li>6. ������, ����ǰ�� ��� �����ڸ� �Բ� ǥ��</li>
		<li>7. ������</li>
		<li>8. ��ǰ�� ������ �� �����</li>
		<li>9. ��޽� ���ǻ���</li>
		<li>10.ǰ����������</li>
		<li>11. A/S å���ڿ� ��ȭ��ȣ</li>
	</ol>
	</li>


	<li>
	(17) �ֹ��ǰ
	<ol class="detail">
		<li>1. ǰ�� �� �𵨸�</li>
		<li>2. ����</li>
		<li>3. ����ǰ</li>
		<li>4. ũ��</li>
		<li>5. ���ϸ��� ��ó��</li>
		<li>6. ������, ����ǰ�� ��� �����ڸ� �Բ� ǥ��</li>
		<li>7. ������</li>
		<li>8. ǰ����������</li>
		<li>9. A/S å���ڿ� ��ȭ��ȣ</li>
	</ol>
	</li>


	<li>
	(18) ȭ��ǰ
	<ol class="detail">
		<li>1. �뷮 �� �߷�</li>
		<li>2. ��ǰ �ֿ� ��� (�Ǻ�Ÿ��, ����(ȣ, ��) ��)</li>
		<li>3. ���������� ������</li>
		<li>4. �����</li>
		<li>5. ������, ����ǰ�� ��� �����ڸ� �Բ� ǥ��</li>
		<li>6. ������</li>
		<li>7. �ֿ伺��</li>
		<li>8. ��ɼ� ȭ��ǰ�� ��� ȭ��ǰ���� ���� ��ǰ�Ǿ�ǰ����û �ɻ� �� ���� (�̹�, �ָ�����, �ڿܼ����� ��)</li>
		<li>9. ��� �� ���ǻ���</li>
		<li>10. ǰ����������</li>
		<li>11. A/S å���ڿ� ��ȭ��ȣ</li>
	</ol>
	</li>


	<li>
	(19) �ͱݼ� / ���� / �ð��
	<ol class="detail">
		<li>1. ���� / ���� / ������� (�ð��� ���)</li>
		<li>2. �߷�</li>
		<li>3. ������, ����ǰ�� ��� �����ڸ� �Բ� ǥ��</li>
		<li>4. ������ (�������� ������ ���� �ٸ� ��� �Բ� ǥ��)</li>
		<li>5. ġ��</li>
		<li>6. ���� �� ���ǻ���</li>
		<li>7. �ֿ� ���</li>
			<li>7-1. �ͱݼ�, ������ - ���</li>
			<li>7-2. �ð� - ���, ��� ��</li>
		<li>8. ������ ��������</li>
		<li>9. ǰ����������</li>
		<li>10. A/S å���ڿ� ��ȭ��ȣ</li>
	</ol>
	</li>


	<li>
	(20) ��ǰ(����깰)
	<ol class="detail">
		<li>1. ��������� �뷮(�߷�), ����, ũ��</li>
		<li>2. ���꿬���ϰ� �������</li>
		<li>3. ������</li>
		<li>4. ������, ����ǰ�� ��� �����ڸ� �Բ� ǥ��</li>
		<li>5. ���ù��� ǥ�û���</li>
			<li>5-1. ��깰 - ��깰ǰ���������� �����ں�����깰 ǥ��, ������ǥ��</li>
			<li>5-2. ��깰 - ������ ���� ��� ǥ��, ������� ��� �̷°����� ���� ǥ�� ����</li>
			<li>5-3. ���깰 - ���깰ǰ���������� �����ں������깰 ǥ��, ������ǥ��</li>
		<li>6. ��ǰ����</li>
		<li>7. �Һ��ڻ�� ���� ��ȭ��ȣ</li>
	</ol>
	</li>


	<li>
	(21) �Ϲݽ�ǰ
	<ol class="detail">
		<li>1. ��������� �뷮(�߷�), ����, ũ��</li>
		<li>2. ���������ϰ� �������</li>
		<li>3. ������</li>
		<li>4. ������, ����ǰ�� ��� �����ڸ� �Բ� ǥ��</li>
		<li>5. ��ǰ�������� ���� ��� �� ���� ǥ�û���</li>
			<li>5-1. ��ǰ�� ����</li>
			<li>5-2. ���缺��</li>
			<li>5-3. ������ �� �Է�</li>
			<li>5-4. �����������ս�ǰ�� �ش��ϴ� ����� ǥ��</li>
			<li>5-5. �����ƽ� �Ǵ� ü��������ǰ � �ش��ϴ� ��� ���� ������ ����</li>
			<li>5-6. ���Խ�ǰ�� �ش��ϴ� ��� �Ű� �� ����</li>
		<li>6. �Һ��ڻ�� ���� ��ȭ��ȣ</li>
	</ol>
	</li>


	<li>
	(22) �ǰ���ɽ�ǰ / ü��������ǰ
	<ol class="detail">
		<li>1. ��������� �뷮(�߷�), ����, ũ��</li>
		<li>2. ���������ϰ� �������</li>
		<li>3. ������</li>
		<li>4. ������, ����ǰ�� ��� �����ڸ� �Բ� ǥ��</li>
		<li>5. ��ǰ������ �� �ǰ���ɽ�ǰ�� ���� ������ ���� ��� �� ���� ǥ�û���</li>
			<li>5-1. ��ǰ�� ����</li>
			<li>5-2. ���缺��</li>
			<li>5-3. ������ �� �Է�</li>
			<li>5-4. �����������ս�ǰ ����</li>
			<li>5-5. ���� ������ ����</li>
			<li>5-6. ���Խ�ǰ�� �ش��ϴ� ��� �Ű� �� ����</li>
			<li>5-7. ���� �� ���ǻ��� �� ���ۿ� �߻� ���ɼ�</li>
			<li>5-8. ������ ���� �� ġ�Ḧ ���� �Ǿ�ǰ�� �ƴ϶�� ������ ����</li>
		<li>6. �Һ��ڻ�� ���� ��ȭ��ȣ</li>
	</ol>
	</li>


	<li>
	(23) �����ƿ�ǰ
	<ol class="detail">
		<li>1. ǰ�� �� �𵨸�</li>
		<li>2. KC ���� �� (ǰ���濵 �� ����ǰ���������� �� ����������� �Ǵ� ��������Ȯ�δ�� ����ǰ�� ����)</li>
		<li>3. ũ��, �߷�</li>
		<li>4. ����</li>
		<li>5. ���� (������ ��� ȥ���)</li>
		<li>6. ��뿬��</li>
		<li>7. ���ϸ��� ��ó��</li>
		<li>8. ������, ����ǰ�� ��� �����ڸ� �Բ� ǥ��</li>
		<li>9. ������</li>
		<li>10. ��޹�� �� ��޽� ���ǻ���, ����ǥ�� (����, ��� ��)</li>
		<li>11. ǰ����������</li>
		<li>12. A/S å���ڿ� ��ȭ��ȣ</li>
	</ol>
	</li>


	<li>
	(24) �Ǳ�
	<ol class="detail">
		<li>1. ǰ�� �� �𵨸�</li>
		<li>2. ũ��</li>
		<li>3. ����</li>
		<li>4. ����</li>
		<li>5. ��ǰ ����</li>
		<li>6. ���ϸ��� ��ó��</li>
		<li>7. ������, ����ǰ�� ��� �����ڸ� �Բ� ǥ��</li>
		<li>8. ������</li>
		<li>9. ��ǰ�� ���� ���</li>
		<li>10. ǰ����������</li>
		<li>11. A/S å���ڿ� ��ȭ��ȣ</li>
	</ol>
	</li>


	<li>
	(25) ��������ǰ
	<ol class="detail">
		<li>1. ǰ�� �� �𵨸�</li>
		<li>2. ũ��, �߷�</li>
		<li>3. ����</li>
		<li>4. ����</li>
		<li>5. ��ǰ ����</li>
		<li>6. ���ϸ��� ��ó��</li>
		<li>7. ������, ����ǰ�� ��� �����ڸ� �Բ� ǥ��</li>
		<li>8. ������</li>
		<li>9. ��ǰ�� ���� ���</li>
		<li>10. ǰ����������</li>
		<li>11. A/S å���ڿ� ��ȭ��ȣ</li>
	</ol>
	</li>


	<li>
	(26) ����
	<ol class="detail">
		<li>1. ������</li>
		<li>2. ����, ���ǻ�</li>
		<li>3. ũ��</li>
		<li>4. �ʼ�</li>
		<li>5. ��ǰ ���� (���� �Ǵ� ��Ʈ�� ��� ���� ����, CD ��)</li>
		<li>6. �Ⱓ��</li>
		<li>7. ���� �Ǵ� å�Ұ�</li>
	</ol>
	</li>


	<li>
	(27) ȣ�� / ��� ����
	<ol class="detail">
		<li>1. ���� �Ǵ� ������</li>
		<li>2. ��������</li>
		<li>3. ���, ����Ÿ��</li>
		<li>4. ��밡�� �ο�, �ο� �߰� �� ���</li>
		<li>5. �δ�ü�, ���� ���� (���� ��)</li>
		<li>6. ��� ���� (ȯ��, ����� ��)</li>
		<li>7. ������ ����ó</li>
	</ol>
	</li>


	<li>
	(28) ������Ű��
	<ol class="detail">
		<li>1. �����</li>
		<li>2. �̿��װ���</li>
		<li>3. ����Ⱓ �� ����</li>
		<li>4. �� ���� �ο�, ��� ���� �ο�</li>
		<li>5. ��������</li>
		<li>6. ���� ���� (�Ļ�, �μ���, �������� ��)</li>
		<li>7. �߰� ��� �׸�� �ݾ� (����������, �����̿��, ������ �����, �ȳ���������, �Ļ���, ���û��� ��)</li>
		<li>8. ��� ���� (ȯ��, ����� ��)</li>
		<li>9. �ؿܿ����� ��� �ܱ����ΰ� �����ϴ� ����溸�ܰ�</li>
		<li>10. ������ ����ó</li>
	</ol>
	</li>


	<li>
	(29) �װ���
	<ol class="detail">
		<li>1. �������, �պ� �� ���� ����</li>
		<li>2. ��ȿ�Ⱓ</li>
		<li>3. ���ѻ��� (�����, �ͱ��� ���氡�� ���� ��)</li>
		<li>4. Ƽ�ϼ��ɹ��</li>
		<li>5. �¼�����</li>
		<li>6. �߰� ��� �׸�� �ݾ� (����������, �����̿�� ��)</li>
		<li>7. ��� ���� (ȯ��, ����� ��)</li>
		<li>8. ������ ����ó</li>
	</ol>
	</li>


	<li>
	(30) �ڵ��� �뿩 ���� (����ī)
	<ol class="detail">
		<li>1. ����</li>
		<li>2. ������ ���� ���� (�������� �����Ǵ� ��쿡 ����)</li>
		<li>3. �߰� ���� �� ��� (������å����, ������̼� ��)</li>
		<li>4. ���� ��ȯ �� ������ ���� ���</li>
		<li>5. ������ ���� �� �Ѽ� �� �Һ��� å��</li>
		<li>6. ���� ��� �Ǵ� �ߵ� �ؾ� �� ȯ�� ����</li>
		<li>7. �Һ��ڻ�� ���� ��ȭ��ȣ</li>
	</ol>
	</li>


	<li>
	(31) ��ǰ�뿩 ���� (������, ��, ����û���� ��)
	<ol class="detail">
		<li>1. ǰ�� �� �𵨸�</li>
		<li>2. ������ ���� ���� (�������� �����Ǵ� ��쿡 ����)</li>
		<li>3. �������� ���� (���� �� ���ͱ�ȯ �ֱ�, �߰� ��� ��)</li>
		<li>4. ��ǰ�� ���� �� �н� �� �Ѽ� �� �Һ��� å��</li>
		<li>5. �ߵ� �ؾ� �� ȯ�� ����</li>
		<li>6. ��ǰ ��� (�뷮, �Һ����� ��)</li>
		<li>7. �Һ��ڻ�� ���� ��ȭ��ȣ</li>
	</ol>
	</li>


	<li>
	(32) ��ǰ�뿩 ���� (����, ���ƿ�ǰ, ����ǰ ��)
	<ol class="detail">
		<li>1. ǰ�� �� �𵨸�</li>
		<li>2. ������ ���� ���� (�������� �����Ǵ� ��쿡 ����)</li>
		<li>3. ��ǰ�� ���� �� �н� �� �Ѽ� �� �Һ��� å��</li>
		<li>4. �ߵ� �ؾ� �� ȯ�� ����</li>
		<li>5. �Һ��ڻ�� ���� ��ȭ��ȣ</li>
	</ol>
	</li>


	<li>
	(33) ������ ������ (����, ����, ���ͳݰ��� ��)
	<ol class="detail">
		<li>1. ������ �Ǵ� ������</li>
		<li>2. �̿�����, �̿�Ⱓ</li>
		<li>3. ��ǰ ���� ��� (CD, �ٿ�ε�, �ǽð� ��Ʈ���� ��)</li>
		<li>4. �ּ� �ý��� ���, �ʼ� ����Ʈ����</li>
		<li>5. û��öȸ �Ǵ� ����� ���� �� ������ ���� ȿ��</li>
		<li>6. �Һ��ڻ�� ���� ��ȭ��ȣ</li>
	</ol>
	</li>


	<li>
	(34) ��ǰ�� / ����
	<ol class="detail">
		<li>1. ������</li>
		<li>2. ��ȿ�Ⱓ, �̿����� (��ȿ�Ⱓ ��� �� ���� ����, �������ǰ�� �� �Ⱓ ��)</li>
		<li>3. �̿� ���� ����</li>
		<li>4. �ܾ� ȯ�� ����</li>
		<li>5. �Һ��ڻ�� ���� ��ȭ��ȣ</li>
	</ol>
	</li>


	<li>
	(35) ��Ÿ
	<ol class="detail">
		<li>1. ǰ�� �� �𵨸�</li>
		<li>2. ���� ���� ���� �� �㰡 ���� �޾����� Ȯ���� �� �ִ� ��� �׿� ���� ����</li>
		<li>3. ������ �Ǵ� ������</li>
		<li>4. ������, ����ǰ�� ��� �����ڸ� �Բ� ǥ��</li>
		<li>5. A/S å���ڿ� ��ȭ��ȣ �Ǵ� �Һ��ڻ�� ���� ��ȭ��ȣ</li>
	</ol>
	</li>
</ol>
</div>
<script>
linecss();
table_design_load();
</script>