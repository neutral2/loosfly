<div style="border:#cfcfcf 2px solid;width:800px;">
	<table cellspacing="0" cellpadding="0" width="800" border="0">
	<tbody><tr><td><img src="/shop/data/skin/loosfly/img/mail/mail_bar_order.gif"></td></tr>
	<tr>
		<td style="padding:5px;" height="400" valign="top">
			<div style="padding:10px;line-height:150%;">
				{nameOrder}��,<br>
				���� �罺�ö��� ���θ��� �̿��� �ּż� �����մϴ�.<br>
				������ �ֹ��� �����Ǿ����ϴ�.<br>
				�ֹ����� �� ��������� ���� ����Ʈ���� 'my page'���� Ȯ���Ͻ� �� �ֽ��ϴ�.<br>
				���Բ� ������ ��Ȯ�ϰ� ��ǰ�� ���޵� �� �ֵ��� �ּ��� ���ϰڽ��ϴ�.
			</div>
			<div style="border:#efefef 5px solid;">
				<div style="padding:7px 0 0 10px;background-color:#f7f7f7;height:25px"><b>- �ֹ��� ����</b></div>
				<table style="font:9pt ����" cellpadding="2">
				<colgroup><col width="100">
				</colgroup><tbody>
				<tr><td height="5"></td></tr>
				<tr>
					<td>�ֹ���ȣ</td>
					<td><b>{ordno}</b></td>
				</tr>
				<tr>
					<td>�ֹ��Ͻô� ��</td>
					<td>{nameOrder}</td>
				</tr>
				<tr>
					<td>��ȭ��ȣ</td>
					<td>{phoneOrder}</td>
				</tr>
				<tr>
					<td>�ڵ���</td>
					<td>{mobileOrder}</td>
				</tr>
				<tr>
					<td>�������</td>
					<td>{str_settlekind}</td>
				</tr>
				<tr>
					<td>�����ݾ�</td>
					<td><strong>{=number_format(settleprice)}��</strong></td>
				</tr>
				<tr><td height="10"><strong></strong></td></tr>
				</tbody>
				</table>
				<div style="padding-right:7px 0 0 10px;background-color:#f7f7f7;height:25px"><b>- ��� ����</b></div>
				<table style="font: 9pt ����" cellpadding="2">
				<colgroup><col width="100"></colgroup>
				<tbody>
				<tr><td height="5"></td></tr>
				<tr>
					<td>�����ô� ��</td>
					<td>{nameReceiver}</td>
				</tr>
				<tr>
					<td>�ּ�</td>
					<td>[{zipcode}] {address}</td>
				</tr>
				<tr>
					<td>��ȭ��ȣ</td>
					<td>{phoneReceiver}</td>
				</tr>
				<tr>
					<td>�ڵ���</td>
					<td>{mobileReceiver}</td>
				</tr>
				<tr>
					<td>��۸޼���</td>
					<td>{memo}</td>
				</tr>
				<tr>
				<td height="10"></td></tr>
				</tbody>
				</table>
				<div style="padding:7px 0 0 10px;background-color:#f7f7f7;height:25px"><b>- ���Ż�ǰ ����</b></div>
				<table style="font:9pt ����" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
				<tr><td colspan="10" bgcolor="#303030" height="2"></td></tr>
				<tr bgcolor="#f0f0f0" height="23">
					<th class="input_txt" colspan="2">��ǰ���� :</th>
					<th class="input_txt">������ :</th>
					<th class="input_txt">�ǸŰ� :</th>
					<th class="input_txt">���� :</th>
					<th class="input_txt">�հ� :</th>
				</tr>
				<tr><td colspan="10" bgcolor="#d6d6d6" height="1"></td></tr>
				</tbody><colgroup>
					<col width="60">
					<col>
					<col width="60">
					<col width="80">
					<col width="50">
					<col width="80">
<!--{ @ cart->item }-->
				</colgroup><tbody>
				<tr>
					<td align="center" height="60">{=goodsimg(.img,40,'',3)}</td>
					<td>
						<div>{.goodsnm} <!--{ ? .opt }-->[{=implode("/",.opt)}]<!--{ / }--></div><!--{ @ .addopt }-->[{..optnm}:{..opt}]<!--{ / }--> 
						<!--{ ? .delivery_type == 1 }--><div>(������)</div><!--{ / }-->
					</td>
					<td align="center">{=number_format(.reserve)}��</td>
					<td style="padding-right:10px" align="right">{=number_format(.price + .addprice)}��</td>
					<td align="center">{.ea}��</td>
					<td style="padding-right:10px" align="right">{=number_format((.price + .addprice)*.ea)}��</td>
				</tr>
				<tr><td colspan="10" bgcolor="#dedede" height="1"></td></tr>
<!--{ / }-->
				<tr>
					<td colspan="10" align="right" bgcolor="#f7f7f7" height="60">
						��ǰ�հ�ݾ� &nbsp;<b id="cart_goodsprice">{=number_format(cart->goodsprice)}</b>�� &nbsp; + &nbsp; ��ۺ�&nbsp;
<!--{ ? deli_msg }-->
						{deli_msg}
<!--{ : }-->
						<b id="cart_delivery">{=number_format(cart->delivery)}</b>��
<!--{ / }-->
						&nbsp; = &nbsp; ���ֹ��ݾ� &nbsp;<b class="red" id="cart_totalprice">{=number_format(cart->totalprice)}</b>�� &nbsp; 
					</td>
				</tr>
				<tr><td colspan="10" bgcolor="#efefef" height="1"> </td></tr>
				</tbody>
				</table>
			</div>
		</td>
	</tr>
	<tr><td bgcolor="#cfcfcf" height="1"></td></tr>
	<tr>
		<td style="padding:10px;" align="center">
			<table>
			<tbody>
			<tr>
				<td rowspan="2"><!--{ @ dataBanner( 92 ) }-->{.tag}<!--{ / }--></td>
				<td><img src="/shop/admin/img/mail/mail_bottom.gif"></td>
			</tr>
			<tr><td style="font:8pt tahoma" align="center">copyright(c) <strong><font color="#585858">{cfg.shopname} </font></strong>all right reserved.</td></tr>
			</tbody>
			</table>
		</td>
	</tr>
	<tr><td bgcolor="#71cbd2" height="20"></td></tr>
	</tbody>
	</table>
</div>
