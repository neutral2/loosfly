<?php /* Template_ 2.2.7 2013/07/19 15:11:39 /www/loosfly_godo_co_kr/shop/conf/email/tpl_0.php 000005834 */  $this->include_("dataBanner");?>
<div style="border:#cfcfcf 2px solid;width:800px;">
	<table cellspacing="0" cellpadding="0" width="800" border="0">
	<tbody><tr><td><img src="/shop/data/skin/loosfly/img/mail/mail_bar_order.gif"></td></tr>
	<tr>
		<td style="padding:5px;" height="400" valign="top">
			<div style="padding:10px;line-height:150%;">
				<?php echo $TPL_VAR["nameOrder"]?>��,<br>
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
					<td><b><?php echo $TPL_VAR["ordno"]?></b></td>
				</tr>
				<tr>
					<td>�ֹ��Ͻô� ��</td>
					<td><?php echo $TPL_VAR["nameOrder"]?></td>
				</tr>
				<tr>
					<td>��ȭ��ȣ</td>
					<td><?php echo $TPL_VAR["phoneOrder"]?></td>
				</tr>
				<tr>
					<td>�ڵ���</td>
					<td><?php echo $TPL_VAR["mobileOrder"]?></td>
				</tr>
				<tr>
					<td>�������</td>
					<td><?php echo $TPL_VAR["str_settlekind"]?></td>
				</tr>
				<tr>
					<td>�����ݾ�</td>
					<td><strong><?php echo number_format($TPL_VAR["settleprice"])?>��</strong></td>
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
					<td><?php echo $TPL_VAR["nameReceiver"]?></td>
				</tr>
				<tr>
					<td>�ּ�</td>
					<td>[<?php echo $TPL_VAR["zipcode"]?>] <?php echo $TPL_VAR["address"]?></td>
				</tr>
				<tr>
					<td>��ȭ��ȣ</td>
					<td><?php echo $TPL_VAR["phoneReceiver"]?></td>
				</tr>
				<tr>
					<td>�ڵ���</td>
					<td><?php echo $TPL_VAR["mobileReceiver"]?></td>
				</tr>
				<tr>
					<td>��۸޼���</td>
					<td><?php echo $TPL_VAR["memo"]?></td>
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
<?php if(is_array($TPL_R1=$TPL_VAR["cart"]->item)&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?>
				</colgroup><tbody>
				<tr>
					<td align="center" height="60"><?php echo goodsimg($TPL_V1["img"], 40,'', 3)?></td>
					<td>
						<div><?php echo $TPL_V1["goodsnm"]?> <?php if($TPL_V1["opt"]){?>[<?php echo implode("/",$TPL_V1["opt"])?>]<?php }?></div><?php if(is_array($TPL_R2=$TPL_V1["addopt"])&&!empty($TPL_R2)){foreach($TPL_R2 as $TPL_V2){?>[<?php echo $TPL_V2["optnm"]?>:<?php echo $TPL_V2["opt"]?>]<?php }}?> 
<?php if($TPL_V1["delivery_type"]== 1){?><div>(������)</div><?php }?>
					</td>
					<td align="center"><?php echo number_format($TPL_V1["reserve"])?>��</td>
					<td style="padding-right:10px" align="right"><?php echo number_format($TPL_V1["price"]+$TPL_V1["addprice"])?>��</td>
					<td align="center"><?php echo $TPL_V1["ea"]?>��</td>
					<td style="padding-right:10px" align="right"><?php echo number_format(($TPL_V1["price"]+$TPL_V1["addprice"])*$TPL_V1["ea"])?>��</td>
				</tr>
				<tr><td colspan="10" bgcolor="#dedede" height="1"></td></tr>
<?php }}?>
				<tr>
					<td colspan="10" align="right" bgcolor="#f7f7f7" height="60">
						��ǰ�հ�ݾ� &nbsp;<b id="cart_goodsprice"><?php echo number_format($TPL_VAR["cart"]->goodsprice)?></b>�� &nbsp; + &nbsp; ��ۺ�&nbsp;
<?php if($TPL_VAR["deli_msg"]){?>
						<?php echo $TPL_VAR["deli_msg"]?>

<?php }else{?>
						<b id="cart_delivery"><?php echo number_format($TPL_VAR["cart"]->delivery)?></b>��
<?php }?>
						&nbsp; = &nbsp; ���ֹ��ݾ� &nbsp;<b class="red" id="cart_totalprice"><?php echo number_format($TPL_VAR["cart"]->totalprice)?></b>�� &nbsp; 
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
				<td rowspan="2"><?php if(is_array($TPL_R1=dataBanner( 92))&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?><?php echo $TPL_V1["tag"]?><?php }}?></td>
				<td><img src="/shop/admin/img/mail/mail_bottom.gif"></td>
			</tr>
			<tr><td style="font:8pt tahoma" align="center">copyright(c) <strong><font color="#585858"><?php echo $TPL_VAR["cfg"]["shopname"]?> </font></strong>all right reserved.</td></tr>
			</tbody>
			</table>
		</td>
	</tr>
	<tr><td bgcolor="#71cbd2" height="20"></td></tr>
	</tbody>
	</table>
</div>