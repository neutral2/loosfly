function getGoodsListDataOther() {

	var category = $("[name=list_category]").val();


	var kw = $("[name=list_kw]").val();

	var item_cnt = 0;

	var data_param;
	data_param = "mode=get_goods";

	if(kw) {
		data_param += "&kw=" + kw;
	}
	else {
		data_param += "&category=" + category;
	}

	item_cnt = $(".goods-other-item").length;

	data_param += "&item_cnt=" + item_cnt;

	try {
		$.ajax({
			type: "post",
			url: "/"+ mobile_root + "/proc/mAjaxAction.php",
			cache:false,
			async:false,
			data: data_param,
			success: function (res) {
				if(res != null) {
					makeGoodsListOther(res.goods_data, kw, category);
				}
			},
			dataType:"json"
		});
	}
	catch(e) {
		alert(e);
	}

}

var objSwipe = null;

function makeGoodsListOther(goods_data, kw, category) {

	var goods_src = "";

	if(kw) {
		goods_src = '../goods/view.php?kw=' + kw;
	}
	else {
		goods_src = '../goods/view.php?category=' + category;
	}

	if(goods_data.length > 0) {

		var add_html = "";

		for(var i=0; i<goods_data.length; i++) {

			if((i+1) % 5 == 1) {
				add_html += '<div class="goods-other-content" >';
				add_html += '<div class="goods-other-item right-margin left-margin">';
			}
			else if((i+1) % 5 == 0){
				add_html += '<div class="goods-other-item">';
			}
			else {
				add_html += '<div class="goods-other-item right-margin">';
			}

			add_html += '<a href="'+goods_src+'&goodsno='+goods_data[i].goodsno+'">'+goods_data[i].img_html+'</a>';

			add_html += '</div>';

			if((i+1) % 5 ==0 || (i+1) == goods_data.length) {
				add_html += '</div>';
			}
		}
	}


	$("#swipe-other-goods>div").append(add_html);

	var startSlide_idx = 0;
	if(objSwipe != null) {
		startSlide_idx = objSwipe.getPos();
	}

	objSwipe = new Swipe(document.getElementById('swipe-other-goods'), {
		startSlide: startSlide_idx,
		speed: 200,
		auto: 0,
		callback: function(event, index, elem) {

			if(($(".goods-other-item").length - 10) < (index * 5)) {
				getGoodsListDataOther();
			}

		}
	});


}

function getReviewData() {


	var data_param = "mode=get_review";
	var item_cnt = $("#review-table .title").length;
	var goodsno = "";

	if($("[name=goodsno]").length > 0) {
		goodsno = $("[name=goodsno]").val();
	}

	data_param += "&item_cnt=" + item_cnt + "&goodsno="+goodsno;

	try {
		$.ajax({
			type: "post",
			url: "/"+ mobile_root + "/proc/mAjaxAction.php",
			cache:false,
			async:false,
			data: data_param,
			success: function (res) {

				if(res != null) {
					makeReviewList(res, goodsno);
				}
				else {
					$(".more-btn").hide();
				}
			},
			dataType:"json"
		});
	}
	catch(e) {
		alert(e);
	}
}

function makeReviewList(review_data, goodsno) {


	if(review_data.length > 0) {

		var add_html = "";

		for(var i=0; i<review_data.length; i++) {
			add_html+= '<tr class="title" onclick="view_content(this, '+review_data[i].sno+');">';
			add_html+= '	<td class="first">'+review_data[i].idx+'</td>';
			add_html+= '	<td class="img">'+review_data[i].img_html+'</td>';
			add_html+= '	<td class="left last">';
			add_html+= '		<div class="point-star">';

			for(var k=0; k<5; k++) {
				if(k < review_data[i].point) {
					add_html+= '<span class="active">★</span>';
				}
				else {
					add_html+= '★';
				}
			}

			add_html+= '</div>';

			if(goodsno) {
				add_html+= '	<div>'+review_data[i].review_name+' | '+review_data[i].regdt+'</div>';
			}
			add_html+= '		<div>'+review_data[i].subject+'</div>';
			add_html+= '		</td>';
			add_html+= '</tr>';
			add_html+= '<tr class="content-board" id="content-'+review_data[i].sno+'">';
			add_html+= '	<td colspan=3 class="">';
			add_html+= '		<div class="content-review">'+review_data[i].contents+'</div>';

			if(review_data[i].image) {
				add_html+= '<div>'+review_data[i].image+'</div>';
			}

			for(var j=0; j<review_data[i].reply.length; j++) {
				add_html+= '			<div class="content-reply">';
				add_html+= '				<div class="reply-icon"></div>';
				if(review_data[i].reply[j].subject) {
					add_html+= review_data[i].reply[j].subject +'<br />';
				}

				add_html+= review_data[i].reply[j].contents;
				add_html+= '			</div>';
			}

			add_html+= '		</td>';
			add_html+= '	</tr>';

		}
	}

	$("#review-table").append(add_html);

	if(review_data.length < 10) {
		$(".more-btn").hide();
	}


}

function getQnaData() {

	var data_param = "mode=get_qna";
	var item_cnt = $("#review-table .title").length;
	var goodsno = "";

	if($("[name=goodsno]").length > 0) {
		goodsno = $("[name=goodsno]").val();
	}

	data_param += "&item_cnt=" + item_cnt + "&goodsno="+goodsno;

	try {
		$.ajax({
			type: "post",
			url: "/"+ mobile_root + "/proc/mAjaxAction.php",
			cache:false,
			async:false,
			data: data_param,
			success: function (res) {
				if(res != null) {
					makeQnaList(res, goodsno);
				}
				else {
					$(".more-btn").hide();
				}
			},
			dataType:"json"
		});
	}
	catch(e) {
		alert(e);
	}
}

function makeQnaList(review_data, goodsno) {


	if(review_data.length > 0) {

		var add_html = "";

		for(var i=0; i<review_data.length; i++) {
			add_html+= '<tr class="title" onclick="view_content(this, '+review_data[i].sno+');">';
			add_html+= '	<td class="first">'+review_data[i].idx+'</td>';
			add_html+= '	<td class="img">'+review_data[i].img_html+'</td>';
			add_html+= '	<td class="left last">';
			add_html+= '		<div class="answer-yn">';

			if(review_data[i].reply_cnt > 0) {
				add_html+= '<div class="answer-y"></div>';
			}
			else {
				add_html+= '<div class="answer-n"></div>';
			}

			add_html+= '</div>';

			if(goodsno) {
				add_html+= '	<div>'+review_data[i].review_name+' | '+review_data[i].regdt+'</div>';
			}
			add_html+= '		<div>'+review_data[i].subject+'</div>';
			add_html+= '		</td>';
			add_html+= '</tr>';
			add_html+= '<tr class="content-board" id="content-'+review_data[i].sno+'">';
			add_html+= '	<td colspan=3 class="">';

			if(review_data[i].accessable) {
				add_html+= '	<div class="content-review">';
				add_html+= '		<div class="question-icon"></div>' + review_data[i].contents;
				add_html+= '	</div>';

				for(var j=0; j<review_data[i].reply.length; j++) {
					add_html+= '			<div class="content-reply">';
					add_html+= '				<div class="answer-icon"></div>';
					if(review_data[i].reply[j].subject) {
						add_html+= review_data[i].reply[j].subject +'<br />';
					}

					add_html+= review_data[i].reply[j].contents;
					add_html+= '			</div>';
				}
			}
			else {

				add_html+= '	<div class="content-review">';
				if(review_data[i].m_no > 0) {
					add_html+= '		비밀글 입니다.';
				}
				else {
					add_html+= '		비밀번호 : <input type="password" id="goods-qna-password-'+review_data[i].sno+'" name="password" required="required"/><button type="button" data-sno="'+review_data[i].sno+'"  class="goods-qna-certification">확인</button>';
				}
				add_html+= '</div>';

			}
			add_html+= '		</td>';
			add_html+= '	</tr>';

		}
	}

	$("#review-table").append(add_html);

	if(review_data.length < 10) {
		$(".more-btn").hide();
	}


}


function getOrderListData() {

	var data_param = "mode=get_order_list_data";
	var item_cnt = $("#norderlist-area table").length;

	data_param += "&item_cnt=" + item_cnt;

	try {
		$.ajax({
			type: "post",
			url: "/"+ mobile_root + "/proc/mAjaxAction.php",
			cache:false,
			async:false,
			data: data_param,
			success: function (res) {

				if(res != null) {
					makeOrderList(res);
				}
				else {
					$(".more-btn").hide();
				}
			},
			dataType:"json"
		});
	}
	catch(e) {
		alert(e);
	}
}


function makeOrderList(order_data) {

	if(order_data.length > 0) {

		var add_html = "";

		for(var i=0; i<order_data.length; i++) {

			add_html+= '<div class="sub_title"><div class="point"></div>주문번호 : '+order_data[i].ordno+'<button class="ord_more_btn" onclick="javascript:location.href=\'./orderview.php?ordno='+order_data[i].ordno+'\';">상세보기</button></div>';
			add_html+= '<table>';
			add_html+= '<tr>';
			add_html+= '	<th>상품명</tr>';
			add_html+= '	<td class="goods-nm">'+order_data[i].goodsnm+'</td>';
			add_html+= '</tr>';
			add_html+= '<tr>';
			add_html+= '	<th>주문일시</tr>';
			add_html+= '	<td>'+order_data[i].orddt+'</td>';
			add_html+= '</tr>';
			add_html+= '<tr>';
			add_html+= '	<th>결제방법</tr>';
			add_html+= '	<td>'+order_data[i].str_settlekind+'</td>';
			add_html+= '</tr>';
			add_html+= '<tr>';
			add_html+= '	<th>주문금액</tr>';
			add_html+= '	<td class="goods-price">'+order_data[i].str_settleprice+'원</td>';
			add_html+= '</tr>';
			add_html+= '<tr>';
			add_html+= '	<th>주문상태</tr>';
			add_html+= '	<td>'+order_data[i].str_step+'</td>';
			add_html+= '</tr>';
			add_html+= '</table>';

		}
	}

	$("#norderlist-area").append(add_html);

	if(order_data.length < 10) {
		$(".more-btn").hide();
	}
}

function getLogEmoney() {

	var data_param = "mode=get_log_emoney";
	var item_cnt = $("#emoney-table .emoney-item").length;

	data_param += "&item_cnt=" + item_cnt;

	try {
		$.ajax({
			type: "post",
			url: "/"+ mobile_root + "/proc/mAjaxAction.php",
			cache:false,
			async:false,
			data: data_param,
			success: function (res) {

				if(res != null) {
					makeLogEmoneyList(res);
				}
				else {
					$(".more-btn").hide();
				}
			},
			dataType:"json"
		});
	}
	catch(e) {
		alert(e);
	}
}

function makeLogEmoneyList(log_emoney_data) {

	if(log_emoney_data.length > 0) {

		var add_html = "";

		for(var i=0; i<log_emoney_data.length; i++) {

			add_html+= '<tr class="emoney-item">';
			add_html+= '	<td class="left first">'+log_emoney_data[i].memo+'</td>';

			if(log_emoney_data[i].emoney > 0) {
				add_html+= '	<td class="right">'+log_emoney_data[i].emoney+'원</td>';
			}
			else {
				add_html+= '	<td class="right"></td>';
			}

			if(log_emoney_data[i].emoney < 0) {
				add_html+= '	<td class="right"></td>';
			}
			else {
				add_html+= '	<td class="right">'+log_emoney_data[i].emoney+'원</td>';
			}

			add_html+= '</tr>';
		}
	}

	$("#emoney-table").append(add_html);

	if(log_emoney_data.length < 10) {
		$(".more-btn").hide();
	}
}


function getMemberQnaData() {

	var data_param = "mode=get_member_qna";
	var item_cnt = $("#member-qna-table .title").length;

	data_param += "&item_cnt=" + item_cnt;

	try {
		$.ajax({
			type: "post",
			url: "/"+ mobile_root + "/proc/mAjaxAction.php",
			cache:false,
			async:false,
			data: data_param,
			success: function (res) {
				if(res != null) {
					makeMemberQnaList(res);
				}
				else {
					$(".more-btn").hide();
				}
			},
			dataType:"json"
		});
	}
	catch(e) {
		alert(e);
	}
}

function makeMemberQnaList(member_qna_data) {


	if(member_qna_data.length > 0) {

		var add_html = "";

		for(var i=0; i<member_qna_data.length; i++) {
			add_html+= '<tr class="title" onclick="view_content(this, '+member_qna_data[i].sno+');">';
			add_html+= '	<td class="first">'+member_qna_data[i].idx+'</td>';
			add_html+= '	<td class="">'+member_qna_data[i].itemcd+'</td>';
			add_html+= '	<td class="left last">';
			add_html+= '		<div class="answer-yn">';

			if(member_qna_data[i].reply_cnt > 0) {
				add_html+= '<div class="answer-y"></div>';
			}
			else {
				add_html+= '<div class="answer-n"></div>';
			}

			add_html+= '</div>';
			add_html+= '		<div>'+member_qna_data[i].subject+'</div>';
			add_html+= '		</td>';
			add_html+= '</tr>';
			add_html+= '<tr class="content-board" id="content-'+member_qna_data[i].sno+'">';
			add_html+= '	<td colspan=3 class="">';

			add_html+= '	<div class="content-review">';
			add_html+= '		<div class="question-icon"></div>';

			if(member_qna_data[i].ordno >0) {
				add_html+= ' 주문번호 : '+member_qna_data[i].ordno + '<br />';
			}

			add_html+= member_qna_data[i].contents;

			add_html+= '	</div>';

			for(var j=0; j<member_qna_data[i].reply.length; j++) {
				add_html+= '			<div class="content-reply">';
				add_html+= '				<div class="answer-icon"></div>';
				if(member_qna_data[i].reply[j].subject) {
					add_html+= member_qna_data[i].reply[j].subject +'<br />';
				}

				add_html+= member_qna_data[i].reply[j].contents;
				add_html+= '			</div>';
			}

			add_html+= '		</td>';
			add_html+= '	</tr>';

		}
	}

	$("#member-qna-table").append(add_html);

	if(member_qna_data.length < 10) {
		$(".more-btn").hide();
	}


}
