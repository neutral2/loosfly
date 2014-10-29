// 파라미터 Parsing
var GET = (function(){
	var
	scriptParam = new Object(),
	scriptTag = document.getElementById("naver-common-inflow-script"),
	queryIndex = scriptTag.src.indexOf("?");
	if(queryIndex>-1)
	{
		var scriptTagParam = scriptTag.src.substr(scriptTag.src.indexOf("?")+1).split(/&/gi);
		for(var a=0; a<scriptTagParam.length; a++)
		{
			var
			splitIndex = scriptTagParam[a].indexOf("="),
			paramName = (splitIndex<0)?scriptTagParam[a]:scriptTagParam[a].substr(0, splitIndex),
			paramValue = (splitIndex<0)?null:scriptTagParam[a].substr(splitIndex+1);
			if(paramName.match(/(.+)\[(.*)\]$/))
			{
				if(RegExp.$2 && RegExp.$2.trim().length>0)
				{
					if(scriptParam[RegExp.$1]===undefined) scriptParam[RegExp.$1] = new Object();
					scriptParam[RegExp.$1][RegExp.$2] = paramValue;
				}
				else
				{
					if(scriptParam[RegExp.$1]===undefined) scriptParam[RegExp.$1] = new Array(paramValue);
					else scriptParam[RegExp.$1].push(paramValue);
				}
			}
			else
			{
				scriptParam[paramName] = paramValue;
			}
		}
	}
	return scriptParam;
})();

if(!window.wcs_add) window.wcs_add = new Object();
window.wcs_add["wa"] = GET.AccountID;

if(GET.WhiteList)
{
	wcs.checkoutWhitelist = GET.WhiteList;
	wcs.mileageWhitelist = GET.WhiteList;
}

wcs.setReferer(GET.Referer);

if(GET.Inflow) wcs.inflow(GET.Inflow);
else wcs.inflow();

(function(NCISL){
	if(document.attachEvent){window.attachEvent("onload", NCISL);}
	else{window.addEventListener("load", NCISL, false);}
})
(function(){

	if(GET.Path==="goods/goods_view.php" || GET.Path==="goods/view.php" || GET.Path==="goods/view_detail.php")
	{
		var
		naverMileageBaseAccumRate = wcs.getBaseAccumRate().toString().trim(),
		naverMileageAddAccumRate = wcs.getAddAccumRate().toString().trim();
		if(parseFloat(naverMileageBaseAccumRate)>0)
		{
			if(document.getElementById("naver-mileage-base-accum-rate")) document.getElementById("naver-mileage-base-accum-rate").innerHTML = naverMileageBaseAccumRate.replace(/\.0$/, "")+"%";
			if(parseFloat(naverMileageAddAccumRate)>0)
			{
				if(document.getElementById("naver-mileage-add-accum-rate")) document.getElementById("naver-mileage-add-accum-rate").innerHTML = "&nbsp;+&nbsp;추가&nbsp;"+naverMileageAddAccumRate.replace(/\.0$/, "")+"%";
			}
		}
	}

	if(GET.Path==="setGoods/goodsView/goodsView.php" || GET.Path==="goods/list.php" || GET.Path==="goods/cart.php")
	{
		var
		naverMileageBaseAccumRate = wcs.getBaseAccumRate().toString().trim(),
		naverMileageAddAccumRate = wcs.getAddAccumRate().toString().trim();
		if(parseFloat(naverMileageBaseAccumRate)>0)
		{
			jQuery(".naver-mileage-base-accum-rate").each(function(index, element){
				element.innerHTML = naverMileageBaseAccumRate.replace(/\.0$/, "")+"%";
			});
			if(parseFloat(naverMileageAddAccumRate)>0)
			{
				jQuery(".naver-mileage-add-accum-rate").each(function(index, element){
					element.innerHTML = "&nbsp;+&nbsp;추가&nbsp;"+naverMileageAddAccumRate.replace(/\.0$/, "")+"%";
				});
			}
		}
	}

	if(GET.AccountID && wcs.isCPA)
	{
		// CPA 스크립트(주문완료 페이지에서만 실행)
		if(GET.Path==="order/order_end.php" || GET.Path==="ord/order_end.php")
		{
			var
			_nao = new Object(),
			commonScriptOrderItem = document.getElementsByName("naver-common-inflow-script-order-item");

			// CPA로 전송할 상품이 있다면(CPA 수집동의시 자동생성)
			if(commonScriptOrderItem.length>0)
			{
				_nao["order"] = new Array();
				for(var a=0; a<commonScriptOrderItem.length; a++)
				{
					var
					orderItem = eval("("+commonScriptOrderItem[a].value+")"),
					cpaOrderItem = new Object();

					cpaOrderItem["oid"] = orderItem.ordno;
					cpaOrderItem["poid"] = orderItem.sno;
					if(orderItem.is_parent)
					{
						cpaOrderItem["pid"] = orderItem.goodsno;
						cpaOrderItem["parpid"] = null;
					}
					else
					{
						cpaOrderItem["pid"] = orderItem.goodsno.toString()+"-"+orderItem.optno.toString();
						cpaOrderItem["parpid"] = orderItem.goodsno;
					}
					cpaOrderItem["name"] = orderItem.goodsnm;
					cpaOrderItem["cnt"] = orderItem.ea;
					cpaOrderItem["price"] = orderItem.price;

					_nao["order"].push(cpaOrderItem);
				}
				_nao["chn"] = "AD";
				wcs.CPAOrder(_nao);
			}
		}
	}

	if (GET.AccountID) {
		if (GET.Path === "order/order_end.php" || GET.Path === "ord/order_end.php") {
			var commonScriptOrder = document.getElementById("naver-common-inflow-script-order");
			if (commonScriptOrder && commonScriptOrder !== null) {
				var
				saNao = new Object(),
				serviceType = "1",
				orderInfo = eval("("+commonScriptOrder.value+")");
				saNao["cnv"] = wcs.cnv(serviceType, orderInfo.goodsprice);
				wcs_do(saNao);
			}
		}
		else {
			wcs_do();
		}
	}

});