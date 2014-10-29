<div style="border:#cfcfcf 2px solid;width:800px;">
	<table cellspacing="0" cellpadding="0" width="800" border="0">
	<tbody><tr><td><img src="/shop/data/skin/loosfly/img/mail/mail_bar_order.gif"></td></tr>
	<tr>
		<td style="padding:5px;" height="400" valign="top">
			<div style="padding:10px;line-height:150%;">
				{nameOrder}님,<br>
				저희 루스플라이 쇼핑몰을 이용해 주셔서 감사합니다.<br>
				고객님의 주문이 접수되었습니다.<br>
				주문내역 및 배송정보는 저희 사이트내의 'my page'에서 확인하실 수 있습니다.<br>
				고객님께 빠르고 정확하게 제품이 전달될 수 있도록 최선을 다하겠습니다.
			</div>
			<div style="border:#efefef 5px solid;">
				<div style="padding:7px 0 0 10px;background-color:#f7f7f7;height:25px"><b>- 주문자 정보</b></div>
				<table style="font:9pt 굴림" cellpadding="2">
				<colgroup><col width="100">
				</colgroup><tbody>
				<tr><td height="5"></td></tr>
				<tr>
					<td>주문번호</td>
					<td><b>{ordno}</b></td>
				</tr>
				<tr>
					<td>주문하시는 분</td>
					<td>{nameOrder}</td>
				</tr>
				<tr>
					<td>전화번호</td>
					<td>{phoneOrder}</td>
				</tr>
				<tr>
					<td>핸드폰</td>
					<td>{mobileOrder}</td>
				</tr>
				<tr>
					<td>결제방법</td>
					<td>{str_settlekind}</td>
				</tr>
				<tr>
					<td>결제금액</td>
					<td><strong>{=number_format(settleprice)}원</strong></td>
				</tr>
				<tr><td height="10"><strong></strong></td></tr>
				</tbody>
				</table>
				<div style="padding-right:7px 0 0 10px;background-color:#f7f7f7;height:25px"><b>- 배송 정보</b></div>
				<table style="font: 9pt 굴림" cellpadding="2">
				<colgroup><col width="100"></colgroup>
				<tbody>
				<tr><td height="5"></td></tr>
				<tr>
					<td>받으시는 분</td>
					<td>{nameReceiver}</td>
				</tr>
				<tr>
					<td>주소</td>
					<td>[{zipcode}] {address}</td>
				</tr>
				<tr>
					<td>전화번호</td>
					<td>{phoneReceiver}</td>
				</tr>
				<tr>
					<td>핸드폰</td>
					<td>{mobileReceiver}</td>
				</tr>
				<tr>
					<td>배송메세지</td>
					<td>{memo}</td>
				</tr>
				<tr>
				<td height="10"></td></tr>
				</tbody>
				</table>
				<div style="padding:7px 0 0 10px;background-color:#f7f7f7;height:25px"><b>- 구매상품 정보</b></div>
				<table style="font:9pt 굴림" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
				<tr><td colspan="10" bgcolor="#303030" height="2"></td></tr>
				<tr bgcolor="#f0f0f0" height="23">
					<th class="input_txt" colspan="2">상품정보 :</th>
					<th class="input_txt">적립금 :</th>
					<th class="input_txt">판매가 :</th>
					<th class="input_txt">수량 :</th>
					<th class="input_txt">합계 :</th>
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
						<!--{ ? .delivery_type == 1 }--><div>(무료배송)</div><!--{ / }-->
					</td>
					<td align="center">{=number_format(.reserve)}원</td>
					<td style="padding-right:10px" align="right">{=number_format(.price + .addprice)}원</td>
					<td align="center">{.ea}개</td>
					<td style="padding-right:10px" align="right">{=number_format((.price + .addprice)*.ea)}원</td>
				</tr>
				<tr><td colspan="10" bgcolor="#dedede" height="1"></td></tr>
<!--{ / }-->
				<tr>
					<td colspan="10" align="right" bgcolor="#f7f7f7" height="60">
						상품합계금액 &nbsp;<b id="cart_goodsprice">{=number_format(cart->goodsprice)}</b>원 &nbsp; + &nbsp; 배송비&nbsp;
<!--{ ? deli_msg }-->
						{deli_msg}
<!--{ : }-->
						<b id="cart_delivery">{=number_format(cart->delivery)}</b>원
<!--{ / }-->
						&nbsp; = &nbsp; 총주문금액 &nbsp;<b class="red" id="cart_totalprice">{=number_format(cart->totalprice)}</b>원 &nbsp; 
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
