var mobile_root = getMobileHomepath();

$(document).ready(function() {

	if (navigator.userAgent.indexOf('iPhone') != -1 || navigator.userAgent.indexOf('iPad') != -1) {
		addEventListener("load", function() {
			setTimeout(hideURLbar, 0);
		}, false);
	}

	if (navigator.userAgent.indexOf('Linux') != -1) {
		addEventListener("load", function() {
			setTimeout(hideURLbar, 0);
		}, false);
	}

	$("[id$=btn]").live('onClick', function(e) {
		$(e.target).addClass('no_focus');
	});

	$("[id$=btn]").live('touchstart', function(e) {
		$(e.target).addClass('active');
	});

	$("[id$=btn]").live('touchend', function(e) {
		$(e.target).removeClass('active');
	});


	$(window).bind("orientationchange", function() {
		var $viewport = $('head').children('meta[name="viewport"]');

			if(window.orientation == 90 || window.orientation == -90 || window.orientation == 270) {
				//landscape
				$viewport.attr('content', 'height=device-width,width=device-height,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=yes');
			} else {
				//portrait
				$viewport.attr('content', 'height=device-height,width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=yes');
			}
	});

	if(location.pathname.indexOf("/goods/list") != -1) {
		$("input[name='item_cnt']").each(function(i, obj) {
			obj.value = 0;
		});
		getGoodsListData();
	}
});


function goUrl(url) {

	$.mobile.changePage(url, "fade");
}

function hideURLbar() {
	window.scrollTo(0, 1);
}

function getGoodsListData() {

	var category = $("[name=category]").val();


	var kw = $("[name=kw]").val();

	var view_type = $.cookie('goods_view_type');
	var sort_type = $.cookie('sort_type');

	if(sort_type == "" || sort_type == "undefined") {
		sort_type = "sort";
	}
	var item_cnt = 0;

	var data_param;
	data_param = "mode=get_goods";

	if(kw) {
		data_param += "&kw=" + kw;
	}

	if(view_type == 'gallery') {
		item_cnt = $(".goods-item").length;
		data_param += "&view_type=" + view_type
	}
	else if(view_type == 'list') {
		item_cnt = $(".goods-list-item").length;

		data_param += "&view_type=" + view_type
	}
	else {
		item_cnt = $("[name=item_cnt]").val();
	}

	data_param += "&category=" + category;
	data_param += "&sort_type=" + sort_type;

	data_param += "&item_cnt=" + item_cnt;

	try {
		$.ajax({
			type: "post",
			url: "/"+ mobile_root + "/proc/mAjaxAction.php",
			cache:false,
			async:false,
			data: data_param,
			success: function (res) {
				if(res == null) {
					$(".more-btn").hide();
				}
				makeGoodsList(res.goods_data, kw, category);
			},
			dataType:"json"
		});
	}
	catch(e) {
		alert(e);
	}

}

function makeGoodsList(goods_data, kw, category) {

	if($(".goods-sort").length > 0) {

		$(".goods_item_list").hide();

		var goods_src = "";

		if(kw) {
			goods_src = '../goods/view.php?kw=' + kw;
		}
		else {
			goods_src = '../goods/view.php?category=' + category;
		}


		var view_type = $.cookie('goods_view_type');

		if(view_type == 'gallery') {

			if(goods_data.length > 0) {

				var add_html = "";

				for(var i=0; i<goods_data.length; i++) {

					if((i+1) % 3 == 1) {
						add_html += '<div class="goods-row">';
					}

					add_html += '<div class="goods-item"';
					if((i+1) % 3 == 1 || (i+1) % 3 == 2) {
						add_html += ' style="margin-right:5%;" ';
					}
					add_html += '>';
					add_html += '<div class="goods-img"><a href="'+goods_src+'&goodsno='+goods_data[i].goodsno+'">'+goods_data[i].img_html+'</a></div>';
					add_html += '<div class="goods-nm"><a href="'+goods_src+'&goodsno='+goods_data[i].goodsno+'">'+goods_data[i].goodsnm+'</a></div>';
					if (goods_data[i].price != null) {
						add_html += '<div class="goods-price"><a href="' + goods_src + '&goodsno=' + goods_data[i].goodsno + '">' + goods_data[i].price + '원</a></div>';
					}
					//add_html += '<div class="goods-btn"><div class="del-btn" onClick="javascript:delGoods(\''+goods_data[i].goodsno+'\');"></div><div class="cart-order-btn"></div></div>';
					add_html += '</div>';
					if((i+1) % 3 ==0 || (i+1) == goods_data.length) {
						add_html += '<div style="width:100%; height:0px; clear:both;"></div>';
						add_html += '</div>';
					}
				}
			}

			if(goods_data.length < 9) {
				$(".more-btn").hide();
			}


			$(".goods-content").append(add_html);
		}
		else {

			if(goods_data.length > 0) {

				var add_html = "";

				// 네이버 마일리지 적립률 확인
				try {
					var
					naverMileageBaseAccumRate = wcs.getBaseAccumRate().toString().trim(),
					naverMileageAddAccumRate = wcs.getAddAccumRate().toString().trim(),
					naverMileageAccumRate = (parseFloat(naverMileageBaseAccumRate) + parseFloat(naverMileageAddAccumRate)).toString();
				}
				catch (exception) {
					
				}

				for(var i=0; i<goods_data.length; i++) {

					if((i+1) % 2 == 0) {
						add_html += '<div class="goods-list-item goods-list-item-gray">';
					}
					else {
						add_html += '<div class="goods-list-item ">';
					}

					add_html += '<div class="goods-list-img"><a href="'+goods_src+'&goodsno='+goods_data[i].goodsno+'">'+goods_data[i].img_html+'</a></div>';
					add_html += '	<div class="goods-list-info"><a href="'+goods_src+'&goodsno='+goods_data[i].goodsno+'">';
					add_html += '		<div class="goods-nm">'+goods_data[i].goodsnm+'</div>';

					if (goods_data[i].price != "" && goods_data[i].price != null) {

						add_html += '		<div class="goods-price">상품가격 : <span class="red">' + goods_data[i].price + '원</span></div>';

						if (goods_data[i].reserve != "0" && goods_data[i].reserve != "" && goods_data[i].reserve != "undefined") {

							add_html += '		<div class="goods-reserve">적립금 : ' + goods_data[i].reserve + '원</div>';
						}
						if (goods_data[i].NaverMileageAccum) {
							var naver_mileage_accum_rate = "<span class=\"naver-mileage-accum-rate\" style=\"font-weight: bold; color: #1ec228;\">" + naverMileageAccumRate + "%</span>";
							naver_mileage_accum_rate = naver_mileage_accum_rate + " 적립 <img src=\"/shop/proc/naver_mileage/images/n_mileage_on.png\"/>";
							add_html += "<div class=\"goods-nvmileage naver-mileage-accum\">네이버 마일리지 : " + naver_mileage_accum_rate + "</div>";
						}
					}
					else {
						add_html += '		<div class="goods-price"></div>';
					}

					add_html += '	</a></div>';
					add_html += '	<a href="'+goods_src+'&goodsno='+goods_data[i].goodsno+'"><div class="goods-list-arrow"></div></a>';
					add_html += '</div>';
				}

			}


			if(goods_data.length < 10) {

				$(".more-btn").hide();
			}

			$(".goods-content").append(add_html);
		}


	}
	else {
		if($("#goods-item-list").length > 0) {

			var item_cnt = $("[name=item_cnt]").val();

			if(item_cnt == 0 && goods_data.length <1) {
				var no_goods_html = "";
				no_goods_html = "<li class=\"more\">검색 결과가 없습니다</li>";
				$("#goods-item-list").append(no_goods_html);
			}
			else {

				$(".more").addClass('hidden');

				var j = 0;
				for(var i=0; i<goods_data.length; i++) {

					var goods_html ="";
					goods_html = "<li><dl><dt class=\"hidden\">상품이미지</dt><dd class=\"gl_img\"><a href=\"../goods/view.php?goodsno=" + goods_data[i].goodsno + "\">" + goods_data[i].img_html +"</a></dd>";
					goods_html += "<dt class=\"hidden\">상품정보</dt>";
					goods_html += "<dd class=\"gl_goods\">";
					goods_html += "<div class=\"hidden\">상품명</div>";
					goods_html += "<div class=\"gl_name\"><a href=\"../goods/view.php?goodsno="+goods_data[i].goodsno+"\">"+goods_data[i].goodsnm+"</a></div>";

					if (goods_data[i].price != "") {
						goods_html += "<div class=\"gl_price\">상품가격 : <span class=\"r_price\">"+goods_data[i].price+"원</div>";
						goods_html += "<div class=\"gl_reserve\">적립금 : " + goods_data[i].reserve + "원</div>";
						if (goods_data[i].NaverMileageAccum) {
							var naver_mileage_accum_rate = "<span class=\"naver-mileage-accum-rate\" style=\"font-weight: bold; color: #1ec228;\"></span>";
							naver_mileage_accum_rate = naver_mileage_accum_rate + " 적립 <img src=\"/shop/proc/naver_mileage/images/n_mileage_on.png\"/>";
							goods_html += "<div class=\"gl_naver_mileage goods-nvmileage\">네이버 마일리지 : " + naver_mileage_accum_rate + "</div>";
						}
					}
					else {
						goods_html += "<div class=\"gl_price\"></div>";
					}

					goods_html += "<dt class=\"gl_arrow\" onClick=\"javascript:document.location.href='../goods/view.php?goodsno="+goods_data[i].goodsno+"';\"></dt></dl></li>";
					$("#goods-item-list").append(goods_html);

					j++;
				}

				$("[name=item_cnt]").val(parseInt($("[name=item_cnt]").val()) + j);

				if(j == 10) {
					var more_html = "";
					more_html += "<li class=\"more\" onClick=\"javascript:getGoodsListData();\">더 보기...</li>";
					$("#goods-item-list").append(more_html);

				}
			}
		}
	}

}

function getCategoryData(now_cate) {

	var data_param;

	data_param = "mode=get_category";
	data_param += "&now_cate=" + now_cate;

	try {
		$.ajax({
			type: "post",
			url: "/"+ mobile_root + "/proc/mAjaxAction.php",
			cache:false,
			async:false,
			data: data_param,
			success: function (res) {
				if (res.child_res != null) {
					if (res.child_res.length > 0) {
						makeCateList(res.child_res);
					}
					else {
						showCategoryMsg("하위카테고리가 없습니다");
					}
				}
				else {
					showCategoryMsg("하위카테고리가 없습니다");
				}

				if(res.cate_path.length >0) {
					makePath(res.cate_path);
				}
				else {

					if($("#cate-area div.top_path").length > 0) {
						$("#cate-area div.top_path").show();
						$("#cate-area div.top_path").html("<div class='now_path'><div class='pathitem activeitem allpath' onClick='javascript:cateSelect(\"\");'>전체카테고리</div></div>");
					}
					else {
						$(".cate_path").html("");
						$("#cate-area div.top_title").html("카테고리 ");
					}
				}


			},
			dataType:'json'
		});
	}
	catch(e) {
		alert(e);
	}
}

function makePath(path_data) {
	/*
	if($(".cate_path").length > 0) {
		$(".cate_path").html("");
		var path_html = "";
		path_html += "<div class='now_path'>";
		for(var i=0; i<path_data.length; i++) {
			path_html+=path_data[i];

			if(path_data[i+1] != "undefined" && path_data[i+1]) {
				path_html+= " > ";
			}
		}
		path_html += "</div>";
		$(".cate_path").append(path_html);

		var item_html = "";
		item_html += "<div class='cate_path_item'><div class='cate_path_nm' onclick='javascript:upCateSelect();'>이전 카테고리 보기</div></div>";
		$(".cate_path").append(item_html);
		$(".cate_path_nm").animate({"margin-left":"0%"},300);
		$(".cate_path_item").animate({"margin-right":"0%"},300);
		$(".cate_path").animate({"margin-left":"0%"},300);
	}
	*/
	//$("#cate-area div.top_title").text());


		//$("#cate-area div.top_title").html("");

		if($("#cate-area div.top_path").length > 0) {
			var path_items = $("#cate-area div.top_path div.now_path div.pathitem");

			var now_cate = $("[name=now_cate]").val();

			if (path_items.length > path_data.length) {
				var path_html = "";
				for (var i = 0; i < path_items.length; i++) {

					var active_item = "";
					var first_item = "";
					var arrow_html = "";
					var go_now_cate = "";

					if(i == path_data.length) {
						active_item = " activeitem";
					}

					if(i == 0) {
						first_item = " allpath";
					}
					else {
						arrow_html = "<div class='patharrow'></div>";
					}

					go_now_cate = now_cate.substr(0, i*3);

					path_html += arrow_html+"<div class='pathitem"+active_item+first_item+"' onClick='javascript:cateSelect(\"" + go_now_cate + "\");'>" + $(path_items[i]).html() + "</div>";

					if(i == path_data.length) {
						break;
					}
				}

				$("#cate-area div.top_path").slideDown(100);
			}
			else {

				$(".pathitem").removeClass('activeitem');

				var path_html = "";

				path_html = $("#cate-area div.top_path div.now_path").html();


				for (var i = path_items.length-1; i < path_data.length; i++) {

					var go_now_cate = "";
					go_now_cate = now_cate.substr(0, (i+1)*3);

					var active_item = "";
					if(i == path_data.length-1) {
						active_item = " activeitem";
					}

					path_html += "<div class='patharrow'></div><div class='pathitem"+active_item+"' onClick='javascript:cateSelect(\"" + go_now_cate + "\");'>" + path_data[i] + "</div>";
				}

				$("#cate-area div.top_path").slideDown(100);
			}


			$("#cate-area div.top_path div.now_path").html(path_html);
		}
		else {
			var path_html = "";
			path_html += "<div class='now_path'>";
			for(var i=0; i<path_data.length; i++) {
				path_html+= "<div class='pathitem longtextdot'>"+path_data[i]+"</div>";

				if(path_data[i+1] != "undefined" && path_data[i+1]) {
					path_html+= "<div class='patharrow'></div>";
				}
			}
			path_html += "</div>";
			var item_html = "";
			if (path_data.length > 0) item_html += "<div class='btnimg' onclick='javascript:upCateSelect();'></div>";
			path_html += item_html;
			$("#cate-area div.top_title").html(path_html);
		}

}

function makeCateList(cate_data) {
	if($(".cate_list").length > 0) {
		$(".cate_list").html("");
		for(var i=0; i<cate_data.length; i++) {
			var item_html = "";
			if (cate_data[i].sub_count>0) {

				if(i % 2 == 1) {
					item_html += "<div class='cate_item cate_item2'><div class='cate_nm'  onclick='javascript:cateSelect(\""+cate_data[i].category+"\");'>"+cate_data[i].catnm+"</div><div class='cate_nm_arrow'></div><div class='cate_prd_btn' onclick='javascript:goCate(\""+cate_data[i].category+"\");'></div></div>"
				}
				else {
					item_html += "<div class='cate_item'><div class='cate_nm'  onclick='javascript:cateSelect(\""+cate_data[i].category+"\");'>"+cate_data[i].catnm+"</div><div class='cate_nm_arrow'></div><div class='cate_prd_btn' onclick='javascript:goCate(\""+cate_data[i].category+"\");'></div></div>"
				}

			} else {

				if (i % 2 == 1) {
					item_html += "<div class='cate_item cate_item2'><div class='cate_nm' onclick='javascript:showCategoryMsg(\"하위카테고리가 없습니다\")'>" + cate_data[i].catnm + "</div><div class='cate_prd_btn' onclick='javascript:goCate(\"" + cate_data[i].category + "\");'></div></div>"
				}
				else {
					item_html += "<div class='cate_item'><div class='cate_nm' onclick='javascript:showCategoryMsg(\"하위카테고리가 없습니다\")'>" + cate_data[i].catnm + "</div><div class='cate_prd_btn' onclick='javascript:goCate(\"" + cate_data[i].category + "\");'></div></div>"
				}

			}
			$(".cate_list").append(item_html);
		}

		$(".cate_item_arrow").animate({"margin-right":"0%"},300);
		$(".cate_nm").animate({"margin-left":"0%"},300);
		$(".cate_item").animate({"margin-right":"0%"},300);
		$(".cate_item2").animate({"margin-right":"0%"},300);
		$(".cate_list").animate({"margin-left":"0%"},300);
	}
}

function upCateSelect() {
	var now_cate = $("[name=now_cate]").val();
	var tmp_cate = now_cate.substr(0, now_cate.length -3);
	$("[name=now_cate]").val(tmp_cate);
	getCategoryData(tmp_cate);

}

function cateSelect(category) {
	$("[name=now_cate]").val(category);
	getCategoryData(category);
}

function goCate(category) {
	document.location.href="/"+ mobile_root + "/goods/list.php?category=" + category;
}

function goGoods(goodsno) {
	document.location.href="/"+ mobile_root + "/goods/view.php?goodsno=" + goodsno;
}

function getMobileHomepath() {
	// 각 URL 최상위 홈PATH를 구한다. 모바일의 홈이 여러 종류일수 있으므로  2012-09-20 khs
	var path1 = document.location.pathname;

	if (path1.charAt(0) == '/')	{
		path1 = path1.substring(1);
	}
	var x = path1.split("/");

	return x[0];
}

/* FAQ 스크립트 시작*/
$(function() {

	var article = $('.faq .article');
	//article.addClass('hide');
	//article.find('.a').slideUp(100);

	$('.faq .article .q').live("click", function(e){
		var article = $('.faq .article');
		var myArticle = $(this).parents('.article:first');

		if(myArticle.hasClass('hide')) {
			//article.addClass('hide').removeClass('show');
			//article.find('.a').slideUp(100);
			myArticle.removeClass('hide').addClass('show');
			myArticle.find('.a').slideDown(100);
		} else {
			myArticle.removeClass('show').addClass('hide');
			myArticle.find('.a').slideUp(100);
		}
	});
});

function getFaqListData(flag) {

	var itemcd = $("[name=faq_cate]").val();
	var item_cnt = $("[name=item_cnt]").val();

	var data_param;
	data_param = "mode=get_faq";

	data_param += "&itemcd=" + itemcd;

	if(flag == 1)		$("[name=item_cnt]").val(0);
	else if(flag == 2)	data_param += "&item_cnt=" + item_cnt;

	try {
		$.ajax({
			type: "post",
			url: "/"+ mobile_root + "/proc/mAjaxAction.php",
			cache:false,
			async:false,
			data: data_param,
			success: function (res) {
				makeFaqList(flag, res.faq_data);
			},
			dataType:"json"
		});
	}
	catch(e) {
		alert(e);
	}

}

function makeFaqList(flag, faq_data) {

	if($("#faq-item-list").length > 0) {

		var item_cnt = $("[name=item_cnt]").val();

		if(item_cnt == 0 && faq_data.length <1) {
			var no_faq_html = "";
			no_faq_html += "<li class=\"article\">";
			no_faq_html += "<div class=\"q nodata\">검색 결과가 없습니다.</div>";
			no_faq_html += "</li>";
			if(flag == 1) $("#faq-item-list").html(no_faq_html);
			else if(flag == 2) $("#faq-item-list").append(no_faq_html);
		}
		else {
			$("#faq-item-list").find("[class=\"q more\"]").remove();

			var j = 0;
			var buffer = "";
			for(var i=0; i<faq_data.length; i++) {
				var faq_html ="";
				faq_html = "<li class=\"article\">";
				faq_html += "<div class=\"q trigger\"><div class=\"arrow down\"></div><div class=\"title\">"+faq_data[i].question+"</div></div>";
				faq_html += "<div class=\"a\">";
				if(faq_data[i].descant) {
					faq_html += "<div class=\"block\"><div class='question'></div> "+faq_data[i].descant+"</div>";
				}
				faq_html += "<div><div class='answer'></div> "+faq_data[i].answer+"</div></div>";
				faq_html += "</li>";

				buffer += faq_html;

				j++;
			}

			if(flag == 1) {
				$("#faq-item-list").html(buffer);

				$("[name=item_cnt]").val(j);
			} else if(flag == 2) {
				$("#faq-item-list").append(buffer);

				$("[name=item_cnt]").val(parseInt($("[name=item_cnt]").val()) + j);
			}
/*
			if(j == 10) {
				var more_html = "";
				more_html += "<li class=\"q more\" onClick=\"javascript:getFaqListData(2);\">더 보기...</li>";
				$("#faq-item-list").append(more_html);

			}
*/
			if(j == 10) $("#btn_faq_more_box").show();
			else $("#btn_faq_more_box").hide();
		}
	}
	var article = $('.faq .article');
	article.addClass('hide');
}
/* FAQ 스크립트 종료*/

//나머지주소 수정시, 도로명/지번 나머지 주소가 같아지도록
function SameAddressSub(text) {
	var div_road_address	 = document.getElementById('div_road_address');
	var div_road_address_sub = document.getElementById('div_road_address_sub');	

	if(div_road_address.innerHTML == "") {
		div_road_address_sub.style.display="none";
	} else {
		div_road_address_sub.style.display="";
		div_road_address_sub.innerHTML = text.value;
	}	
}
 
