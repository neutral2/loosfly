var get_design_data_url = "/"+mobile_root+"/eAPI/mGetDesignData.php";
var get_display_data_url = "/"+mobile_root+"/eAPI/mGetDisplayData.php";
var get_design_data_url_event = "/"+mobile_root+"/eAPI/mGetDesignDataEvent.php";
var get_display_data_url_event = "/"+mobile_root+"/eAPI/mGetDisplayDataEvent.php";
var get_goods_data_url = "/"+mobile_root+"/eAPI/mGetGoodsData.php"; 


/*
 * displayGoods - 상품진열하기
 */
function displayGoods(mdesign_no, page_type) {
	var design_data;
	design_data = getDesignData(mdesign_no, page_type);

	if(design_data.mdesign_no) {
		var disp_data;
		disp_data = getDisplayData(design_data.mdesign_no, design_data.display_type);
		
		var displayHtml = "";
		
		if(page_type == "cate") {
			if(design_data.text_temp1) {
				displayHtml += "<div>" + design_data.event_body + "</div>";	
			}
		}
		
		displayHtml = createHtml(design_data, disp_data);
		document.write(displayHtml);
	}
	else {
		return false;
	}
}

/*
 * displayGoodsEvent - 상품진열하기(이벤트)
 */
function displayGoodsEvent(mevent_no) {
	var design_data;
	design_data = getDesignDataEvent(mevent_no);
	
	if(design_data.mevent_no) {
		var disp_data;
		disp_data = getDisplayDataEvent(design_data.mevent_no);

		var displayHtml = "";
		
		if(design_data.evnet_body) {
			displayHtml += "<div>" + design_data.event_body + "</div>";
		}
		displayHtml = createHtml(design_data, disp_data);
		document.write(displayHtml);
	}
	else {
		return false;
	}
}

/*
 * createHtml - html 생성
 */
function createHtml(design_data, disp_data) {
	
	var ret_html = "";

	switch(design_data.tpl) {
		case "tpl_01" :
			ret_html = createHtmlGallery(design_data, disp_data);
			break;
		case "tpl_02" :
			ret_html = createHtmlList(design_data, disp_data);
			break;
		case "tpl_03" :
			ret_html = createHtmlGoodsScroll(design_data, disp_data);
			break;
		case "tpl_04" :
			ret_html = createHtmlImageScroll(design_data, disp_data);
			break;
		case "tpl_05" :
			ret_html = createHtmlTab(design_data, disp_data);
			break;
		case "tpl_06" :
			ret_html = createHtmlMagazine(design_data, disp_data);
			break;
		case "tpl_07" :
			ret_html = createHtmlBannerRolling(design_data, disp_data);
			break;
	}

	return ret_html;
}

function createHtmlGallery(design_data, disp_data) {

	var page_goods_cnt = parseInt(design_data.line_cnt) * parseInt(design_data.disp_cnt);
	var page_cnt = disp_data.length / page_goods_cnt;
	var remain_cnt = disp_data.length % page_goods_cnt;

	var r_goods_cnt = 0;
	
	if(remain_cnt > 0) page_cnt ++;

	var tmp_html = "";
	for(var i=0; i<page_cnt; i++) {
		tmp_html += "<table>";
		for(var j=0; j<design_data.line_cnt; j++) {
			tmp_html += "<tr>";
			for(var k=0; k<design_data.disp_cnt; k++) { 
				tmp_html += "<td>";

				if(r_goods_cnt < disp_data.length) {
					tmp_html += "<div>" +  disp_data[r_goods_cnt].goodsnm + "</div>";
					var img_nm = "";
					if(disp_data[r_goods_cnt].img_mobile) {
						img_nm = disp_data[r_goods_cnt].img_mobile;
					}
					else {
						img_nm = disp_data[r_goods_cnt].img_l;
					}

					tmp_html += "<div>" +  img_nm + "</div>";

					tmp_html += "<div>" +  disp_data[r_goods_cnt].price + "</div>";
					tmp_html += "</td>";
				}
				r_goods_cnt ++;
			}
			tmp_html += "</tr>";
		}
		tmp_html += "</table>";
		
	}

	return tmp_html;
}

function createHtmlList(design_data, disp_data) {

	var page_goods_cnt = parseInt(design_data.line_cnt) * parseInt(design_data.disp_cnt);
	var page_cnt = disp_data.length / page_goods_cnt;
	var remain_cnt = disp_data.length % page_goods_cnt;

	var r_goods_cnt = 0;
	if(remain_cnt > 0) page_cnt ++;

	var tmp_html = "";
	for(var i=0; i<page_cnt && r_goods_cnt<disp_data.length; i++) {
		tmp_html += "<table>";
		for(var j=0; j<design_data.line_cnt && r_goods_cnt<disp_data.length; j++) {
			tmp_html += "<tr>";
			for(var k=0; k<design_data.disp_cnt && r_goods_cnt<disp_data.length; k++) { 
				tmp_html += "<td>";
				tmp_html += "<div>" +  disp_data[r_goods_cnt].goodsnm + "</div>";
				var img_nm = "";
				if(disp_data[r_goods_cnt].img_mobile) {
					img_nm = disp_data[r_goods_cnt].img_mobile;
				}
				else {
					// img_nm = disp_data[r_goods_cnt].img_l;
					img_nm = disp_data[r_goods_cnt].goods_img;
				}

				tmp_html += "<div>" +  img_nm + "</div>";
				tmp_html += "<div>" +  disp_data[r_goods_cnt].shortdesc + "</div>";
				//tmp_html += "<div>" +  disp_data[r_goods_cnt].price + "</div>";
				tmp_html += "<div>" +  disp_data[r_goods_cnt].goods_price + "</div>";
				tmp_html += "<div>" +  disp_data[r_goods_cnt].reserve + "</div>";
				tmp_html += "<div>" +  "상세페이지 바로가기" + "</div>";
				tmp_html += "</td>";
				r_goods_cnt ++;
				if (r_goods_cnt >= disp_data.length) break; 
			}
			tmp_html += "</tr>";
		}
		tmp_html += "</table>";
		
	}
	return tmp_html;

}

function createHtmlGoodsScroll(design_data, disp_data) {
	
	var page_goods_cnt = parseInt(design_data.line_cnt) * parseInt(design_data.disp_cnt);

	var page_cnt = Math.floor(disp_data.length / page_goods_cnt);
	
	var remain_cnt = disp_data.length % page_goods_cnt;
	
	if(remain_cnt > 0) {
		page_cnt = page_cnt + 1;
	}
	
	var item_width = Math.floor(99 / parseInt(design_data.disp_cnt));
	var item_style = "style=\"width:"+item_width+"%\"";

	var r_goods_cnt = 0;
	
	var tmp_html = "";
	
	tmp_html += "<div class=\"list_goodsscroll\" id=\"goodsscroll-"+design_data.mdesign_no+"\">";
	
	if(design_data.title != null && design_data.title != "undefined") {
		
		tmp_html += "<div class=\"list_title\"><div class=\"bullet\"></div><div class=\"title\">"+design_data.title+"</div></div>";

	}
	
	var goods_cnt = 0;
	
	for(var i=0; i<page_cnt; i++) {
		var hidden_class = "";

		if(i != 0) {
			hidden_class = " hidden";
		}

		tmp_html += "<div class=\"list_content"+hidden_class+"\" id=\"goodsscroll-"+design_data.mdesign_no+"-"+ (i + 1).toString() +"\">";
		tmp_html += "<div class=\"list_content_border\"></div>";
			
			for(var j=0; j<page_goods_cnt; j++) {
				var goodsno = "";
				var goods_img = "";
				var goodsnm = "";
				var goods_price = "";
				var js_html = "";

				if(disp_data[goods_cnt] != undefined) {
					
					if(disp_data[goods_cnt].goodsno != null && disp_data[goods_cnt].goodsno != "undefined") {
						goodsno = disp_data[goods_cnt].goodsno;
					}
					
					if(disp_data[goods_cnt].goods_img != null && disp_data[goods_cnt].goods_img != "undefined") {
						goods_img = disp_data[goods_cnt].goods_img;
					}

					if(disp_data[goods_cnt].goodsnm != null && disp_data[goods_cnt].goodsnm != "undefined") {
						goodsnm = disp_data[goods_cnt].goodsnm;
					}

					if(disp_data[goods_cnt].goods_price != null && disp_data[goods_cnt].goods_price != "undefined") {
						goods_price = disp_data[goods_cnt].goods_price;
					}

					if(design_data.display_type == '3') {
						js_html = "javascript:goCate('"+goodsno+"');"
					}
					else {
						js_html = "javascript:goGoods('"+goodsno+"');"
					}

				}

				tmp_html += "<div class=\"list_item\" "+item_style+" onClick=\""+js_html+"\">";
				if(goods_img != "") {
					tmp_html += "<div class=\"item_img\"><img src=\""+goods_img+"\" /></div>";
				}
				else {
					tmp_html += "<div class=\"item_img\"></div>";
				}
				tmp_html += "<div class=\"item_name\">"+goodsnm+"</div>";
				tmp_html += "<div class=\"item_price\">"+goods_price+"</div>";
				tmp_html += "</div>		";

				goods_cnt++;
			}
		tmp_html += "<div class=\"list_content_border\"></div>";
		tmp_html += "</div>";
		
		
	}
	tmp_html += "<div class=\"list_page\">";
	tmp_html += "<div class=\"list_page_wrap\">";
	tmp_html += "<div class=\"list_page_left\" onclick=\"javascript:scroll_btn('goodsscroll-"+design_data.mdesign_no+"', 'left');\"></div>";
	tmp_html += "<div class=\"list_page_num\"><span id=\"goodsscroll-"+design_data.mdesign_no+"-page\" class=\"n_page\">1</span> / <span id=\"goodsscroll-"+design_data.mdesign_no+"-tpage\">"+(page_cnt).toString()+"</span></div>";
	tmp_html += "<div class=\"list_page_right\" onclick=\"javascript:scroll_btn('goodsscroll-"+design_data.mdesign_no+"', 'right');\"></div>";
	tmp_html += "</div>";
	tmp_html += "</div>";
	tmp_html += "<div class=\"list_margin\"></div>";
	tmp_html += "</div>";
	
	return tmp_html;
}

function createHtmlImageScroll(design_data, disp_data) {
	
	var page_goods_cnt = parseInt(design_data.line_cnt) * parseInt(design_data.disp_cnt);
	var page_cnt = Math.floor(disp_data.length / page_goods_cnt);
	var remain_cnt = disp_data.length % page_goods_cnt;

	if(remain_cnt > 0) {
		page_cnt = page_cnt + 1;
	}
	
	var item_width = Math.floor(99 / parseInt(design_data.disp_cnt));
	var item_style = "style=\"width:"+item_width+"%\"";
	var r_goods_cnt = 0;
	var tmp_html = "";
	
	tmp_html += "<div class=\"list_imgscroll\" id=\"imgscroll-"+design_data.mdesign_no+"\">";
	
	if(design_data.title != null && design_data.title != "undefined") {
		
		tmp_html += "<div class=\"list_title\"><div class=\"bullet\"></div><div class=\"title\">"+design_data.title+"</div>";
	}
	else {
		tmp_html += "<div class=\"list_title\"><div class=\"title\"></div>";
	}

	tmp_html += "<div class=\"list_page\"><span id=\"imgscroll-"+design_data.mdesign_no+"-page\" class=\"n_page\">1</span> / <span id=\"imgscroll-"+design_data.mdesign_no+"-tpage\">"+page_cnt+"</span></div>";
	tmp_html += "</div>";
	
	tmp_html += "<div class=\"list_content_wrap\">";

	var goods_cnt = 0;
	

	for(var i=0; i<page_cnt; i++) {
		var hidden_class = "";

		if(i != 0) {
			hidden_class = " hidden";
		}

		tmp_html += "<div class=\"list_content"+hidden_class+"\" id=\"imgscroll-"+design_data.mdesign_no+"-"+ (i + 1).toString() +"\">";
		tmp_html += "<div class=\"list_content_border\"></div>";
			
			for(var j=0; j<page_goods_cnt; j++) {
				var goodsno = "";
				var goods_img = "";
				var goodsnm = "";
				var goods_price = "";
				var js_html = "";

				if(disp_data[goods_cnt] != undefined) {
					
					if(disp_data[goods_cnt].goodsno != null && disp_data[goods_cnt].goodsno != "undefined") {
						goodsno = disp_data[goods_cnt].goodsno;
					}
					
					if(disp_data[goods_cnt].goods_img != null && disp_data[goods_cnt].goods_img != "undefined") {
						goods_img = disp_data[goods_cnt].goods_img;
					}

					if(disp_data[goods_cnt].goodsnm != null && disp_data[goods_cnt].goodsnm != "undefined") {
						goodsnm = disp_data[goods_cnt].goodsnm;
					}

					if(disp_data[goods_cnt].goods_price != null && disp_data[goods_cnt].goods_price != "undefined") {
						goods_price = disp_data[goods_cnt].goods_price;
					}

					if(design_data.display_type == '3') {
						js_html = "javascript:goCate('"+goodsno+"');"
					}
					else {
						js_html = "javascript:goGoods('"+goodsno+"');"
					}

				}

				tmp_html += "<div class=\"list_item\" "+item_style+" onClick=\""+js_html+"\">";
				if(goods_img != "") {
					tmp_html += "<div class=\"item_img\"><img src=\""+goods_img+"\" /></div>";
				}
				else {
					tmp_html += "<div class=\"item_img\"></div>";
				}
				tmp_html += "<div class=\"item_text-wrap\">";
				tmp_html += "<div class=\"item_text\">";
				tmp_html += "<div class=\"item_name\">"+goodsnm+"</div>";
				tmp_html += "<div class=\"item_price\">"+goods_price+"</div>";
				tmp_html += "</div>";
				tmp_html += "</div>";
				tmp_html += "</div>";

				goods_cnt++;
			}
		tmp_html += "<div class=\"list_content_border\"></div>";
		tmp_html += "</div>";
	}

	tmp_html += "<div class=\"list_page_btn\">";
	tmp_html += "<div class=\"left_btn\">";
	tmp_html += "<div class=\"left_btn_img\" onclick=\"javascript:scroll_btn('imgscroll-"+design_data.mdesign_no+"', 'left');\"></div>";
	tmp_html += "</div>";
	tmp_html += "<div class=\"right_btn\">";
	tmp_html += "<div class=\"right_btn_img\" onclick=\"javascript:scroll_btn('imgscroll-"+design_data.mdesign_no+"', 'right');\"></div>";
	tmp_html += "</div>";
	tmp_html += "</div>";
	tmp_html += "</div>";
	tmp_html += "<div class=\"list_margin\"></div>";
	tmp_html += "</div>";

	return tmp_html;

}

function createHtmlTab(design_data, disp_data) {

	var tab_cnt = parseInt(design_data.tpl_opt.tab_num);
	
	var item_width = Math.floor(99 / parseInt(design_data.disp_cnt));
	var item_style = "style=\"width:"+item_width+"%\"";
	var tmp_html = "";

	var tab_width = Math.floor(98 / tab_cnt);
	var tab_style = "style=\"width:"+tab_width+"%\"";

	tmp_html += "<div class=\"list_tab\" id=\"tab-"+design_data.mdesign_no+"\">";
	tmp_html += "<div class=\"tab_title\">";

	for(var t_i=0; t_i<tab_cnt; t_i++) {
		var title_active = "";
		if(t_i == 0) {
			title_active = " title_active";
		}

		tmp_html += "<div class=\"title_wrap"+title_active+"\" "+tab_style+" id=\"tabcontent-"+design_data.mdesign_no+"-"+(t_i+1).toString()+"-title\"><div class=\"title\" onclick=\"javascript:tab_click('tabcontent-"+design_data.mdesign_no+"-"+(t_i+1).toString()+"');\">"+design_data.tpl_opt.tab_name[t_i+1]+"</div></div>";
	}
	tmp_html += "</div>";

	var page_goods_cnt = parseInt(design_data.line_cnt) * parseInt(design_data.disp_cnt);

	for(var i=0; i<tab_cnt; i++) {

		var tab_hidden_class = "";

		if( i != 0) {

			tab_hidden_class = " hidden";
		}

		tmp_html += "<div class=\"list_tabcontent"+tab_hidden_class+"\" id=\"tabcontent-"+design_data.mdesign_no+"-"+(i+1).toString()+"\">";
		
		var page_cnt = Math.floor(disp_data[i].length / page_goods_cnt);

		var remain_cnt = disp_data[i].length % page_goods_cnt;
		
		if(remain_cnt > 0) {
			page_cnt = page_cnt + 1;
		}		

		var goods_cnt = 0;

		for(var j=0; j<page_cnt; j++) {

			var hidden_class = "";

			if(j != 0 && i != 0) {
				hidden_class = " hidden";
			}
			
			tmp_html += "<div class=\"list_content\" id=\"tabcontent-"+design_data.mdesign_no+"-"+(i + 1).toString()+"-"+(j + 1).toString()+"\">";
			tmp_html += "<div class=\"list_content_tab_border\"></div>";

			for(var k=0; k<page_goods_cnt; k++) {
				var goodsno = "";
				var goods_img = "";
				var goodsnm = "";
				var goods_price = "";
				
				if(disp_data[i][goods_cnt] != undefined) {
					
					if(disp_data[i][goods_cnt].goodsno != null && disp_data[i][goods_cnt].goodsno != "undefined") {
						goodsno = disp_data[i][goods_cnt].goodsno;
					}
					
					if(disp_data[i][goods_cnt].goods_img != null && disp_data[i][goods_cnt].goods_img != "undefined") {
						goods_img = disp_data[i][goods_cnt].goods_img;
					}

					if(disp_data[i][goods_cnt].goodsnm != null && disp_data[i][goods_cnt].goodsnm != "undefined") {
						goodsnm = disp_data[i][goods_cnt].goodsnm;
					}

					if(disp_data[i][goods_cnt].goods_price != null && disp_data[i][goods_cnt].goods_price != "undefined") {
						goods_price = disp_data[i][goods_cnt].goods_price;
					}
				}

				tmp_html += "<div class=\"list_item\" "+item_style+" onClick=\"javascript:goGoods("+goodsno+");\">";
				if(goods_img != "") {
					tmp_html += "<div class=\"item_img\"><img src=\""+goods_img+"\" /></div>";
				}
				else {
					tmp_html += "<div class=\"item_img\"></div>";
				}
				tmp_html += "<div class=\"item_name\">"+goodsnm+"</div>";
				tmp_html += "<div class=\"item_price\">"+goods_price+"</div>";
				tmp_html += "</div>";

				goods_cnt ++;
			}
			
			tmp_html += "<div class=\"list_content_border\"></div>";
			tmp_html += "</div>";
			
		}
		
		tmp_html += "<div class=\"list_page\">";
		tmp_html += "<div class=\"list_page_wrap\">";
		tmp_html += "<div class=\"list_page_left\" onclick=\"javascript:scroll_btn('tabcontent-"+design_data.mdesign_no+"-"+(i + 1).toString()+"', 'left');\"></div>";
		tmp_html += "<div class=\"list_page_num\"><span id=\"tabcontent-"+design_data.mdesign_no+"-"+(i + 1).toString()+"-page\" class=\"n_page\">1</span> / <span id=\"tabcontent-"+design_data.mdesign_no+"-"+(i + 1).toString()+"-tpage\">"+(page_cnt).toString()+"</span></div>";
		tmp_html += "<div class=\"list_page_right\" onclick=\"javascript:scroll_btn('tabcontent-"+design_data.mdesign_no+"-"+(i + 1).toString()+"', 'right');\"></div>";
		tmp_html += "</div>";
		tmp_html += "</div>";
		tmp_html += "<div class=\"list_margin\"></div>";

		tmp_html += "</div>";

	}
	tmp_html += "</div>";

	
	return tmp_html;

}

function createHtmlMagazine(design_data, disp_data) {

	var page_cnt = disp_data.length;

	var table_width = page_cnt * 70;
	var table_style = "style=\"width:"+table_width+"%\"";
	
	var td_width = Math.floor(99 / page_cnt);
	var td_style = "style=\"width:"+td_width+"%\"";

	var tmp_html = "";
	tmp_html += "<div class=\"list_magazine\" id=\"magazine-"+design_data.mdesign_no+"\">";

	if(design_data.title != null && design_data.title != "undefined") {
		
		tmp_html += "<div class=\"list_title\"><div class=\"bullet\"></div><div class=\"title\">"+design_data.title+"</div></div>";
	}
	else {
		tmp_html += "<div class=\"list_title\"><div class=\"title\"></div></div>";
	}

	tmp_html += "<div class=\"list_content_wrap\">";
	tmp_html += "<div class=\"list_content_border\"></div>";
	tmp_html += "<table class=\"list_content_table\" "+table_style+">";
	tmp_html += "<tr>";

	for(var i=0; i<page_cnt; i++) {

		var goodsno = "";
		var goods_img = "";
		var goodsnm = "";
		var goods_price = "";
		var js_html = "";

		if(disp_data[i] != undefined) {
			
			if(disp_data[i].goodsno != null && disp_data[i].goodsno != "undefined") {
				goodsno = disp_data[i].goodsno;
			}
			
			if(disp_data[i].goods_img != null && disp_data[i].goods_img != "undefined") {
				goods_img = disp_data[i].goods_img;
			}

			if(disp_data[i].goodsnm != null && disp_data[i].goodsnm != "undefined") {
				goodsnm = disp_data[i].goodsnm;
			}

			if(disp_data[i].goods_price != null && disp_data[i].goods_price != "undefined") {
				goods_price = disp_data[i].goods_price;
			}

			if(design_data.display_type == '3') {
				js_html = "javascript:goCate('"+goodsno+"');"
			}
			else {
				js_html = "javascript:goGoods('"+goodsno+"');"
			}
		}
		
		tmp_html += "<td "+td_style+">";
		tmp_html += "<div class=\"list_content\" id=\"magazine-"+design_data.mdesign_no+"-"+(i + 1).toString()+"\">";
		tmp_html += "<div class=\"list_item\" onClick=\""+js_html+"\">";
		tmp_html += "<div class=\"item_img\"><img src=\""+goods_img+"\" /></div>";
		tmp_html += "<div class=\"item_text-wrap\">";
		tmp_html += "<div class=\"item_text\">";
		tmp_html += "<div class=\"item_name\">"+goodsnm+"</div>";
		tmp_html += "<div class=\"item_price\">"+goods_price+"</div>";
		tmp_html += "</div>";
		tmp_html += "</div>";
		tmp_html += "</div>";
		tmp_html += "</div>";
		tmp_html += "</td>";
		
	}

	tmp_html += "</tr>";
	tmp_html += "</table>";
	tmp_html += "<div class=\"list_content_border\"></div>";
	tmp_html += "</div>";
	tmp_html += "<div class=\"list_page\">";
	tmp_html += "<div class=\"list_page_wrap\">";
	tmp_html += "<div class=\"list_page_left\" onclick=\"javascript:scroll_btn('magazine-"+design_data.mdesign_no+"', 'left');\"></div>";
	tmp_html += "<div class=\"list_page_num\"><span id=\"magazine-"+design_data.mdesign_no+"-page\" class=\"n_page\">1</span> / <span id=\"magazine-"+design_data.mdesign_no+"-tpage\">"+page_cnt+"</span></div>";
	tmp_html += "<div class=\"list_page_right\" onclick=\"javascript:scroll_btn('magazine-"+design_data.mdesign_no+"', 'right');\"></div>";
	tmp_html += "</div>";
	tmp_html += "</div>";
	tmp_html += "<div class=\"list_margin\"></div>";
	tmp_html += "</div>";

	return tmp_html;
}

function createHtmlBannerRolling(design_data, disp_data) {

	var banner_cnt = parseInt(design_data.tpl_opt.banner_num);

	var tmp_html = "";
	var tmp_page_html = "";
	
	var page_width = Math.floor((90 / banner_cnt)-4);
	var page_style = "style=\"width:"+page_width+"%\"";

	var img_height = "style=\height:"+design_data.banner_height+"px\"";
	var img_width = "style=\width:"+design_data.banner_width+"px\"";

	tmp_html += "<div class=\"list_banner\" id=\"banner-"+design_data.mdesign_no+"\">";

	if(design_data.title != null && design_data.title != "undefined") {
		
		tmp_html += "<div class=\"list_title\"><div class=\"bullet\"></div><div class=\"title\">"+design_data.title+"</div></div>";
	}
	else {
		tmp_html += "<div class=\"list_title\"><div class=\"title\"></div></div>";
	}
	
	tmp_html += "<div class=\"list_content_border\"></div>";
	
	for(var i=0; i<banner_cnt; i++) {
		
		var hidden_class = "";
		var page_class = "";

		if(i != 0) {
			hidden_class = " hidden";
		}

		if(i == 0) {
			page_class = " now_page";
		}

		var banner_img = "";
		var link_url = "";
		
		if(disp_data[i].banner_img != null && disp_data[i].banner_img != "undefined") {
			banner_img = disp_data[i].banner_img;
		}

		if(disp_data[i].link_url != null && disp_data[i].link_url != "undefined") {
			link_url = disp_data[i].link_url;
		}

		if(banner_img) {
			tmp_html += "<div class=\"list_content"+hidden_class+"\" id=\"banner-"+design_data.mdesign_no+"-"+(i + 1).toString()+"\">";
			tmp_html += "<div class=\"list_item\" "+img_height+" onClick=\"document.location.href='"+disp_data[i].link_url+"'\">";
			tmp_html += "<img "+img_width+" src=\""+disp_data[i].banner_img+"\" />";
			tmp_html += "</div>";
			tmp_html += "</div>";
		}

		tmp_page_html += "<div class=\"list_page_box"+page_class+"\" "+page_style+" id=\"banner-"+design_data.mdesign_no+"-page-box-"+(i + 1).toString()+"\"></div>";		
	}
			
	tmp_html += "<div class=\"list_content_border\"></div>";
	tmp_html += "<div class=\"list_page\">";
	tmp_html += "<div class=\"list_page_wrap\">";
	tmp_html += tmp_page_html;
	tmp_html += "<div class=\"list_page_num hidden\"><span id=\"banner-"+design_data.mdesign_no+"-page\" class=\"n_page\">1</span> / <span id=\"banner-"+design_data.mdesign_no+"-tpage\">"+banner_cnt+"</span></div>";
	tmp_html += "</div>";
	tmp_html += "</div>";
	tmp_html += "<div class=\"list_margin\"></div>";
	tmp_html += "</div>";
	
	/* 배너 자동 롤링 스크립트 삽입 */
	tmp_html += "<script type=\"text/javascript\">auto_banner('banner-"+design_data.mdesign_no+"');</script>";
	return tmp_html;

}


/*
 * getDisplayData - e나무 DB내 진열 데이터 가져오기
 */
function getDesignData(mdesign_no, page_type) {
	var data_param = "mdesign_no=" + mdesign_no;
	
	if(!page_type) page_type = "main";

	data_param += "&page_type=" + page_type;
	
	var design_data;

	$.ajax({ 
		type : "post",
		url : get_design_data_url,
		cache:false,
		async:false,
		data: data_param,
		success: function (res) {
			design_data = res;
		},
		dataType:"json"
	});
	return design_data;
}

/*
 * getGoodsData - 진열 데이터 내 상품 가져오기
 */
function getDisplayData(mdesign_no, display_type) {
	var data_param = "mdesign_no=" + mdesign_no;	
	data_param += "&display_type=" + display_type;

	var display_data;
	$.ajax({ 
		type : "post",
		url : get_display_data_url,
		cache:false,
		async:false,
		data: data_param,
		success: function (res) {
			display_data = res;
			
		},
		dataType:"json"
	});
	return display_data;
}


/*
 * getDisplayDataEvent - e나무 DB내 진열 데이터 가져오기(이벤트)
 */
function getDesignDataEvent(mevent_no) {
	var data_param = "mevent_no=" + mevent_no;
	
	var design_data;

	$.ajax({ 
		type : "post",
		url : get_design_data_url_event,
		cache:false,
		async:false,
		data: data_param,
		success: function (res) {
			design_data = res;

		},
		dataType:"json"
	});

	return design_data;
}

/*
 * getGoodsDataEvent - 진열 데이터 내 상품 가져오기(이벤트)
 */
function getDisplayDataEvent(mevent_no) {
	var data_param = "mevent_no=" + mevent_no;	
	var display_data;
	$.ajax({ 
		type : "post",
		url : get_display_data_url_event,
		cache:false,
		async:false,
		data: data_param,
		success: function (res) {
			
			display_data = res;
		},
		dataType:"json"
	});
	return display_data;
}

function getGoodsData(goodsno) {

	var data_param = "goodsno=" + goodsno;	
	
	var display_data;

	$.ajax({ 
		type : "post",
		url : get_goods_data_url,
		cache:false,
		async:false,
		data: data_param,
		success: function (res) {
			
			display_data = res;
		},
		dataType:"json"
	});
	return display_data;

}