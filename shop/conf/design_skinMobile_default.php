<?
$design_skin = array();

$design_skin['default'] = array(
'outline_header'			=> 'outline/_header.htm ',
'outline_footer'			=> 'outline/_footer.htm',
);

$design_skin['outline/_header.htm'] = array(
'linkurl'			=> 'main/index.php',
'text'			=> '��ܷ��̾ƿ�',
);

$design_skin['outline/_footer.htm'] = array(
'linkurl'			=> 'outline/_footer.php',
'outline_header'			=> 'outline/_header.htm ',
'outline_footer'			=> 'outline/_footer.htm',
'text'			=> '�ϴܷ��̾ƿ�',
'_et'			=> 'codemirror',
);

$design_skin['outline/_sub_header.htm'] = array(
'linkurl'			=> 'main/index.php',
'text'			=> '���� ��� ������',
);

$design_skin['index.htm'] = array(
'linkurl'			=> 'index.php',
'outline_header'			=> 'outline/_header.htm ',
'outline_footer'			=> 'outline/_footer.htm',
'text'			=> '����� ����������',
);

$design_skin['goods/list.htm'] = array(
'linkurl'			=> 'goods/list.php',
'text'			=> '�з�ȭ��',
);

$design_skin['goods/view.htm'] = array(
'linkurl'			=> 'goods/view.php',
'outline_header'			=> 'outline/_header.htm ',
'outline_footer'			=> 'outline/_footer.htm',
'text'			=> '��ǰ��ȭ��',
);

$design_skin['goods/cart.htm'] = array(
'linkurl'			=> 'goods/cart.php',
'outline_header'			=> 'outline/_header.htm ',
'outline_footer'			=> 'outline/_footer.htm',
'text'			=> '��ٱ���',
);

$design_skin['goods/category.htm'] = array(
'text'			=> 'ī�װ�',
'linkurl'			=> 'goods/category.php',
);

$design_skin['ord/order.htm'] = array(
'linkurl'			=> 'ord/order.php',
'outline_header'			=> 'outline/_header.htm ',
'outline_footer'			=> 'outline/_footer.htm',
'text'			=> '�ֹ��ϱ�(�ֹ����ۼ�)',
);

$design_skin['ord/order_end.htm'] = array(
'text'			=> '�ֹ��Ϸ�',
'linkurl'			=> 'ord/order_end.php',
);

$design_skin['ord/order_fail.htm'] = array(
'text'			=> '�ֹ�����',
'linkurl'			=> 'ord/order_fail.php',
);

$design_skin['ord/settle.htm'] = array(
'linkurl'			=> 'ord/settle.php',
'outline_header'			=> 'outline/_header.htm ',
'outline_footer'			=> 'outline/_footer.htm',
'text'			=> '�����ϱ�(������)',
);

$design_skin['mem/login.htm'] = array(
'text'			=> '�α���',
'linkurl'			=> 'mem/login.php',
);

$design_skin['myp/couponlist.htm'] = array(
'text'			=> '������������',
'linkurl'			=> 'myp/couponlist.php',
);

$design_skin['myp/emoneylist.htm'] = array(
'linkurl'			=> 'myp/emoneylist.php',
'outline_header'			=> 'outline/_header.htm ',
'outline_footer'			=> 'outline/_footer.htm',
'text'			=> '�����ݳ���',
);

$design_skin['myp/index.htm'] = array(
'text'			=> '����������',
'linkurl'			=> 'myp/index.php',
);

$design_skin['myp/orderlist.htm'] = array(
'text'			=> '�ֹ�����/�����ȸ',
'linkurl'			=> 'myp/orderlist.php',
);

$design_skin['myp/orderview.htm'] = array(
'text'			=> '�ֹ������󼼺���',
'linkurl'			=> 'myp/orderview.php',
);

$design_skin['myp/wishlist.htm'] = array(
'text'			=> '��ǰ������',
'linkurl'			=> 'myp/wishlist.php',
);

$design_skin['proc/_cashreceiptOrder.htm'] = array(
'text'			=> '�ֹ��ϱ�_���ݿ������߱�',
'linkurl'			=> 'proc/_cashreceiptOrder.php',
);

$design_skin['proc/coupon_list.htm'] = array(
'text'			=> '�������������ϱ�',
'linkurl'			=> 'proc/coupon_list.php',
);

$design_skin['proc/orderitem.htm'] = array(
'linkurl'			=> 'proc/orderitem.php',
'text'			=> '�ֹ���ǰ',
);

$design_skin['goods/list/tpl_02.htm'] = array(
'linkurl'			=> 'goods/goods_list.php',
'text'			=> '����Ʈ��',
);

$design_skin['myp/review_register.htm'] = array(
'linkurl'			=> 'main/html.php?htmid=myp/review_register.htm',
'outline_header'			=> 'outline/_header.htm ',
'outline_footer'			=> 'outline/_footer.htm',
'text'			=> '�̿��ı� �ۼ�',
);

$design_skin['mem/NewNiceIpin.htm'] = array(
'linkurl'			=> 'mem/NewNiceIpin.php',
'text'			=> '������ ����',
);

$design_skin['mem/NiceIpin.htm'] = array(
'linkurl'			=> 'main/html.php?htmid=mem/NiceIpin.htm',
'outline_header'			=> 'outline/_header.htm ',
'outline_footer'			=> 'outline/_footer.htm',
'text'			=> '������ ����',
);

$design_skin['intro/intro.htm'] = array(
'text'			=> '�Ϲ� ��Ʈ��',
'linkurl'			=> 'main/html.php?htmid=intro/intro.htm',
);

$design_skin['intro/intro_adult.htm'] = array(
'text'			=> '�������� ��Ʈ��',
'linkurl'			=> 'main/html.php?htmid=intro/intro_adult.htm',
);

$design_skin['intro/intro_member.htm'] = array(
'text'			=> 'ȸ������ ��Ʈ��',
'linkurl'			=> 'main/html.php?htmid=intro/intro_member.htm',
);

$design_skin['service/_private1.txt'] = array(
'text'			=> '����������޹�ħ ����',
'linkurl'			=> 'main/html.php?htmid=service/_private1.txt',
);

$design_skin['service/private.htm'] = array(
'text'			=> '����������޹�ħ',
'linkurl'			=> 'main/html.php?htmid=service/private.htm',
);

?>