<?php /* Template_ 2.2.7 2013/12/17 17:43:13 /www/loosfly_godo_co_kr/shop/data/skin/loosfly/setGoods/goodsView/goodsView.htm 000013832 */ 
if (is_array($TPL_VAR["goodsInfo"])) $TPL_goodsInfo_1=count($TPL_VAR["goodsInfo"]); else if (is_object($TPL_VAR["goodsInfo"]) && in_array("Countable", class_implements($TPL_VAR["goodsInfo"]))) $TPL_goodsInfo_1=$TPL_VAR["goodsInfo"]->count();else $TPL_goodsInfo_1=0;?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="euc-kr"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>��ǰ �󼼺���</title>
	<script type="text/javascript" src="/shop/setGoods/js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="/shop/setGoods/js/default.js"></script>
	<script src="/shop/lib/js/prototype.js"></script>
	<script type="text/javascript" src="/shop/data/skin/loosfly/common.js"></script>
	<!--link rel="stylesheet" type="text/css" href="/shop/setGoods/css/style.css"/-->
	<link rel="stylesheet" type="text/css" href="/shop/data/skin/loosfly/setGoods/css/goodsView.css"/>
	<?php echo $TPL_VAR["naverCommonInflowScript"]?>

	<script>
<?php if($TPL_VAR["naverNcash"]=='Y'){?>
		function mileage_info() {
			window.open("http://static.mileage.naver.net/static/20130708/ext/intro.html", "mileageIntroPopup", "width=404, height=412, status=no, resizable=no");
		}
<?php }?>

		function chkOption(obj){
			if (!selectDisabled(obj)) return false;
		}

		function selectDisabled(oSelect){
			var isOptionDisabled = oSelect.options[oSelect.selectedIndex].disabled;
			if (isOptionDisabled){
				oSelect.selectedIndex = oSelect.preSelIndex;
				return false;
			} else oSelect.preSelIndex = oSelect.selectedIndex;
			return true;
		}

		function act(action,target){
			var form = document.frmView;
			form.action = "/shop/goods/"+action + ".php";
			if(target == "cat"){
				form.target = "ifrmHidden";
			}else if(target == "order"){
				opener.parent.name="frmview2";
				form.target=opener.parent.name;
			}else{
				alert('�������� ������ �ƴմϴ�');
				return false ;
			}

			var opt_cnt = 0, data;

			if (opt_cnt > 0) {
				form.submit();
				self.close();
			}else {
				if (chkForm(form)){
					form.submit();
					self.close();
				}
			}

			return;
		}

	</script>
	<?php echo $TPL_VAR["acecounterHeader"]?>

</head>
<body>

<form name=frmView method=post onsubmit="return false">
<div id="wrap">
	<div class="titleBar"><div class="titleBar-txt">��ǰ �̸�����</div><!--div class="close"><a href="javascript:window.close()"><img src="/shop/data/skin/loosfly/setGoods/img/front/btn_layerpop_close.gif"/></a></div--></div>

	<input type=hidden name=preview value="y">
	<input type=hidden name="cody" value="y">
<?php if($TPL_goodsInfo_1){$TPL_I1=-1;foreach($TPL_VAR["goodsInfo"] as $TPL_K1=>$TPL_V1){$TPL_I1++;?>
	<div id="content">
		<div id="left">
			<input type=hidden name=mode value="addItem">

			<input type=hidden name=goodsno[<?php echo $TPL_I1?>] value="<?php if(!$TPL_V1["open"]||!$TPL_V1["runout"]){?><?php echo $TPL_V1["goodsno"]?><?php }?>">

			<input type=hidden name=goodsCoupon[<?php echo $TPL_I1?>] value="<?php echo $TPL_V1["coupon"]?>">
<?php if($TPL_V1["min_ea"]> 1){?><input type="hidden" name="min_ea[<?php echo $TPL_I1?>]" value="<?php echo $TPL_V1["min_ea"]?>"><?php }?>
<?php if($TPL_V1["max_ea"]!='0'){?><input type="hidden" name="max_ea[<?php echo $TPL_I1?>]" value="<?php echo $TPL_V1["max_ea"]?>"><?php }?>
			<div class="photo"  >
				<div><?php echo goodsimg($TPL_V1["r_img"][ 0], 300,'id="objImg"','4')?></div>
			</div>
		</div>

		<div id="right">
			<div class="name">
				<div style="padding-top:10px:word-wrap:break-word;"><?php echo $TPL_V1["goodsnm"]?></div>
			</div>
			<div class="infoBOx">
				<div class="info1">
					<table>
<?php if($TPL_V1["runout"]&&$GLOBALS["cfg_soldout"]["price"]=='image'){?>
						<tr>
							<td width="90" align="right">�ǸŰ��� :</td>
							<td><img src="/shop/data/goods/icon/custom/soldout_price"></td>
						</tr>
<?php }elseif($TPL_V1["runout"]&&$GLOBALS["cfg_soldout"]["price"]=='string'){?>
						<tr>
							<td width="90" align="right">�ǸŰ��� :</td>
							<td><?php echo $GLOBALS["cfg_soldout"]["price_string"]?></td>
						</tr>
<?php }elseif(!$TPL_V1["strprice"]){?>
						<tr>
							<td width="90" align="right">�ǸŰ��� :</td>
							<td>
<?php if($TPL_V1["consumer"]){?>
									<strike><?php echo number_format($TPL_V1["consumer"])?></strike> ��
<?php }?>
									<b><?php echo number_format($TPL_V1["price"])?>��</b>
							</td>
						</tr>

<?php if($TPL_V1["memberdc"]){?>
							<tr>
								<td width="90" align="right">ȸ�����ΰ� :</td>
								<td style="color:#ef1c21"><?php echo number_format($TPL_V1["realprice"])?>��&nbsp;(-<?php echo number_format($TPL_V1["memberdc"])?>��)</td>
							</tr>
<?php }?>

<?php if($TPL_V1["coupon"]){?>
							<tr>
								<td width="90" align="right">�������밡 :</td>
								<td style="color:#ef1c21"><?php echo number_format($TPL_V1["couponprice"])?>��&nbsp;(-<?php echo number_format($TPL_V1["coupon"])?>��)</td>
							</tr>
							<div><?php echo $TPL_VAR["about_coupon"]?></div>
<?php }?>
							<tr>
								<td width="90" align="right">������ :</td>
								<td><?php echo number_format($TPL_V1["reserve"])?>��</td>
							</tr>
<?php if($TPL_V1["naverNcash"]=='Y'){?>
							<tr class="naver-mileage-accum" style="display: none;">
								<th>���̹�&nbsp;&nbsp;<br/>���ϸ��� :</th>
								<td>
<?php if($TPL_V1["exception"]){?>
									<?php echo $TPL_V1["exception"]?>

<?php }else{?>
									<span class="naver-mileage-accum-rate" style="font-weight:bold;color:#1ec228;"><?php echo $TPL_V1["NaverMileageAccumRate"]?>%</span> ����
<?php }?>
									<img src="<?php echo $GLOBALS["cfg"]["rootDir"]?>/proc/naver_mileage/images/n_mileage_info4.png" onclick="javascript:mileage_info();" style="cursor: pointer; vertical-align: middle;">
								</td>
							</tr>
<?php }?>

<?php if($TPL_V1["coupon_emoney"]){?>
							<tr>
								<td width="90" align="right">���������� :</td>
								<td><span id=obj_coupon_emoney style="font-weight:bold;color:#EF1C21"></span> &nbsp;<span style="font:bold 9pt tahoma; color:#FF0000" ><?php echo number_format($TPL_V1["coupon_emoney"])?>��</span></td>
							</tr>
<?php }?>

<?php if($TPL_V1["delivery_type"]== 1){?>
							<tr>
								<td width="90" align="right">��ۺ� :</td>
								<td>������</td>
							</tr>
<?php }elseif($TPL_V1["delivery_type"]== 2){?>
							<tr>
								<td width="90" align="right">������ۺ� :</td>
								<td><?php echo number_format($TPL_V1["goods_delivery"])?>��</td>
							</tr>
<?php }elseif($TPL_V1["delivery_type"]== 3){?>
							<tr>
								<td width="90" align="right">���ҹ�ۺ� :</td>
								<td><?php echo number_format($TPL_V1["goods_delivery"])?>��</td>
							</tr>
<?php }elseif($TPL_V1["delivery_type"]== 4){?>
							<tr>
								<td width="90" align="right">������ۺ� :</td>
								<td><?php echo number_format($TPL_V1["goods_delivery"])?>��</td>
							</tr>
<?php }elseif($TPL_V1["delivery_type"]== 5){?>
							<tr>
								<td width="90" align="right">��������ۺ� :</td>
								<td><?php echo number_format($TPL_V1["goods_delivery"])?>�� (������ ���� ��ۺ� �߰��˴ϴ�.)</td>
							</tr>
<?php }?>
<?php }else{?>
						<tr>
							<td width="90" align="right">�ǸŰ��� :</td>
							<td><b><?php echo $TPL_V1["strprice"]?></b></td>
						</tr>
<?php }?>
					</table>
				</div>

				<div class="info2">
					<table style="margin-top:5px">
<?php if($TPL_V1["origin"]){?>
							<tr>
								<td width="90" align="right">������ :</td>
								<td><?php echo $TPL_V1["origin"]?></td>
							</tr>
<?php }?>
<?php if($TPL_V1["maker"]){?>
							<tr>
								<td width="90" align="right">������ :</td>
								<td><?php echo $TPL_V1["maker"]?></td>
							</tr>
<?php }?>
<?php if($TPL_V1["brand"]){?>
							<tr>
								<td width="90" align="right">�귣�� :</td>
								<td><?php echo $TPL_V1["brand"]["brandnm"]?></td>
							</tr>
<?php }?>
<?php if($TPL_V1["launchdt"]){?>
							<tr>
								<td width="90" align="right">����� :</td>
								<td><?php echo $TPL_V1["launchdt"]?></td>
							</tr>
<?php }?>
<?php if((is_array($TPL_R2=$TPL_V1["ex"])&&!empty($TPL_R2)) || (is_object($TPL_R2) && in_array("Countable", class_implements($TPL_R2)) && $TPL_R2->count() > 0)) {$TPL_I2=-1;foreach($TPL_R2 as $TPL_K2=>$TPL_V2){$TPL_I2++;?>
							<tr>
								<td width="90" align="right"><div id="ex<?php echo $TPL_I2?>"><?php echo $TPL_K2?> :</div></td>
								<td><?php echo $TPL_V2?></td>
							</tr>
<?php }}?>


							<tr>
								<td width="90" align="right">���ż��� :</div></td>
<?php if(!$TPL_V1["open"]){?>
								<td>�ش��ǰ�� ������ ���� ��ǰ�� �ƴմϴ�.</td>
<?php }else{?>
<?php if(!$TPL_V1["runout"]){?>
									<td>
										<input type=text name=ea[<?php echo $TPL_I1?>] size=2 value=<?php if($TPL_V1["min_ea"]){?><?php echo $TPL_V1["min_ea"]?><?php }else{?>1<?php }?> class=line style="text-align:right;height:18px"> ��
										<div style="padding-left:10px;" class="stxt">
<?php if($TPL_V1["min_ea"]> 1){?><div>�ּұ��ż��� : <?php echo $TPL_V1["min_ea"]?>��</div><?php }?>
<?php if($TPL_V1["max_ea"]!='0'){?><div>�ִ뱸�ż��� : <?php echo $TPL_V1["max_ea"]?>��</div><?php }?>
										</div>
									</td>
<?php }else{?>
									<td>ǰ���� ��ǰ�Դϴ�</td>
<?php }?>
<?php }?>

							</tr>

<?php if($TPL_V1["chk_point"]){?>
							<tr>
								<td width="90" align="right">����ȣ��</td>
								<td><?php if((is_array($TPL_R2=array_fill( 0,$TPL_V1["chk_point"],''))&&!empty($TPL_R2)) || (is_object($TPL_R2) && in_array("Countable", class_implements($TPL_R2)) && $TPL_R2->count() > 0)) {foreach($TPL_R2 as $TPL_V2){?>��<?php }}?></td>
							</tr>
<?php }?>

<?php if($TPL_V1["icon"]){?>
							<tr>
								<td width="90" align="right">��ǰ����</td>
								<td><?php echo $TPL_V1["icon"]?></td>
							</tr>
<?php }?>
					</table>
				</div>

				<!-- �ɼ� -->
<?php if($TPL_V1["open"]&&!$TPL_V1["runout"]){?>
<?php if($TPL_VAR["opt"][$TPL_I1]){?>
					<div class="info1" style="height:40px">
						<table style="margin-top:5px">
							<tr>
								<td width="90" align="right"><?php echo $TPL_V1["optnm"]?> :</td>
								<td>
									<select name="opt[<?php echo $TPL_I1?>][]" onchange="chkOption(this);" required msgR="<?php echo $TPL_V1["optnm"]?> ������ ���ּ���">
										<option value="">== �ɼǼ��� ==</option>
<?php if((is_array($TPL_R2=$TPL_VAR["opt"][$TPL_I1])&&!empty($TPL_R2)) || (is_object($TPL_R2) && in_array("Countable", class_implements($TPL_R2)) && $TPL_R2->count() > 0)) {foreach($TPL_R2 as $TPL_V2){?>
<?php if((is_array($TPL_R3=$TPL_V2)&&!empty($TPL_R3)) || (is_object($TPL_R3) && in_array("Countable", class_implements($TPL_R3)) && $TPL_R3->count() > 0)) {foreach($TPL_R3 as $TPL_V3){?>
												<option value="<?php echo $TPL_V3["opt1"]?><?php if($TPL_V3["opt2"]){?>|<?php echo $TPL_V3["opt2"]?><?php }?>" <?php if($TPL_V1["usestock"]&&!$TPL_V3["stock"]){?> disabled class=disabled<?php }?>><?php echo $TPL_V3["opt1"]?><?php if($TPL_V3["opt2"]){?>/<?php echo $TPL_V3["opt2"]?><?php }?> <?php if($TPL_V3["price"]!=$TPL_V1["price"]){?>(<?php echo number_format($TPL_V3["price"])?>��)<?php }?><?php if($TPL_V1["usestock"]&&!$TPL_V3["stock"]){?> [ǰ��]<?php }?></option>

<?php }}?>
<?php }}else{?>
											�����;���
<?php }?>
									</select>
								</td>
							</tr>
						</table>
					</div>
<?php }?>


					<!-- �߰� �ɼ� -->

					<div class="info2" style="height:40px">
						<table style="margin-top:5px">
<?php if((is_array($TPL_R2=$TPL_VAR["option_val"][$TPL_I1]["addopt"])&&!empty($TPL_R2)) || (is_object($TPL_R2) && in_array("Countable", class_implements($TPL_R2)) && $TPL_R2->count() > 0)) {$TPL_I2=-1;foreach($TPL_R2 as $TPL_K2=>$TPL_V2){$TPL_I2++;?>
							<tr>
								<td width="90" align="right"><?php echo $TPL_K2?> :</td>
								<td>
<?php if($TPL_VAR["option_val"][$TPL_I1]["addoptreq"][$TPL_I2]){?>
									<select name="addopt[<?php echo $TPL_I1?>][]" required label="<?php echo $TPL_K2?>">
										<option value="">==<?php echo $TPL_K2?> ����==</option>
<?php }else{?>
									<select name="addopt[<?php echo $TPL_I1?>][]" label="<?php echo $TPL_K1?>">
										<option value="">==<?php echo $TPL_K2?> ����==</option>
										<option value="-1">���þ���</option>
<?php }?>
<?php if((is_array($TPL_R3=$TPL_V2)&&!empty($TPL_R3)) || (is_object($TPL_R3) && in_array("Countable", class_implements($TPL_R3)) && $TPL_R3->count() > 0)) {foreach($TPL_R3 as $TPL_V3){?>
										<option value="<?php echo $TPL_V3["sno"]?>^<?php echo $TPL_K2?>^<?php echo $TPL_V3["opt"]?>^<?php echo $TPL_V3["addprice"]?>"><?php echo $TPL_V3["opt"]?>

<?php if($TPL_V3["addprice"]){?>
											(<?php echo number_format($TPL_V3["addprice"])?>�� �߰�)
<?php }?>
<?php }}?>
									</select>
								</td>
							</tr>
<?php }}?>
						</table>
					</div>
<?php }?>


				<div class="btnList">
<?php if(($TPL_goodsInfo_1- 1)==$TPL_I1){?>
						<a href="javascript:act('../order/order','order')"><img src="/shop/data/skin/loosfly/setGoods/img/front/btn_buynow.gif" /></a>
						<a href="javascript:cartAdd(frmView,'<?php echo $TPL_VAR["cartCfg"]->redirectType?>')"><img src="/shop/data/skin/loosfly/setGoods/img/front/btn_cart.gif" /></a>
<?php }?>
				</div>
			</div>
		</div>

		<div class="clear"></div>
	</div>
<?php }}?>

	</div>
</div>
</form>
<iframe name="ifrmHidden" src='/shop/blank.php' style="display:none;width:100%;width:0px;height:0px"></iframe><!-- //display:none; -->
</body>
</html>