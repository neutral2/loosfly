var mini_name, mini_obj, mini_content, mini_text, mini_preview, mini_color_mode, mini_idx_pre, mini_idx_pre2, mini_size_min;
var mini_editor_load = false;

function _ID(id){ return document.getElementById(id); }

function mini_editor_submit()
{
	if (mini_editor_load){
		//if (mini_idx_pre!=1) mini_text.value = mini_content.body.innerHTML;
		if (mini_text.value=="<P>&nbsp;</P>") mini_text.value = "";
	}
}

function mini_init()
{
	mini_obj = _ID("mini_editor_" + mini_name);
	mini_preview = _ID("mini_preview_" + mini_name);
	mini_content = mini_obj.contentWindow.document; 
	mini_text = document.getElementsByName(mini_name)[0];
	//window.status = "tmp_" + mini_name;
	mini_text.value = _ID("tmp_" + mini_name).value;

	var mini_bHeader = "<html><head><meta http-equiv='content-type' content='text/html; charset=euc-kr'><style>body,table {font:12px 굴림};p {margin:2px 0};</style></head>"; 

	mini_preview.contentWindow.document.open();
	mini_preview.contentWindow.document.write(mini_bHeader);
	mini_preview.contentWindow.document.close();

	var mini_bHeader = "<html><head><meta http-equiv='content-type' content='text/html; charset=euc-kr'><style>body,table {font:12px 굴림};p {margin:2px 0};td,th {border:1px #bfbfbf dotted};</style></head>"; 

	mini_content.designMode = "on";
	mini_content.open();
	mini_content.write(mini_bHeader);
	mini_content.close();
	//mini_content.body.onkeypress = mini_enterpress;

	mini_content.body.onclick = mini_reset;
	mini_content.body.onblur = function(){
		 mini_text.value = mini_content.body.innerHTML;
	}
	mini_vmode(0);

	mini_editor_load = true;
}

function mini_editor(name,path)
{
	if (!name) name = "mini_editor_content";
	if (!path) path = "";
	mini_path = path; mini_name = name;
	document.write('<table id=mini_out_frame width=100% height=100% cellpadding=0 cellspacing=0 style="position:relative">\
	<tr>\
		<td height=100% style="border-right:1px solid #000000;border-bottom:1px solid #000000">\
		<table width=100% height=100% cellpadding=0 cellspacing=0>\
		<tr><td height=1></td></tr>\
		<tr><td height=1 bgcolor=#fffffff></td></tr>\
		<tr>\
			<td style="background:buttonface;padding:5px 6px 0 6px">');
	mini_set_toolbar();
	document.write('</td>\
		</tr>\
		<tr>\
			<td id="mini_box" height=100% style="background:buttonface;padding:0 6px">\
			<table width=100% height=100%><tr><td class=mini_box>\
			<iframe id="mini_editor_' + name + '" style="width:100%;height:100%" frameborder=0></iframe>\
			<textarea name="' + name + '" style="display:none;width:100%;height:100%;font:12px 굴림;padding:14px 10px;border:0;overflow:auto;word-break:break-all"></textarea>\
			<iframe id="mini_preview_' + name + '" style="display:none;width:100%;height:100%" frameborder=0></iframe>\
			</td></tr></table>\
			</td>\
		</tr>\
		<tr>\
			<td style="background:buttonface;padding-top:3px">\
			<table cellpadding=0 cellspacing=0>\
			<tr>\
				<td><img id=mini_btn_edit src="' + mini_path + 'img/status_edit_up.gif" onClick="mini_vmode(0)" class=mini_hand></td>\
				<td><img id=mini_btn_source src="' + mini_path + 'img/status_source.gif" onClick="mini_vmode(1)" class=mini_hand></td>\
				<td><img id=mini_btn_preview src="' + mini_path + 'img/status_preview.gif" onClick="mini_vmode(2)" class=mini_hand></td>\
				<td width=100% background="' + mini_path + 'img/status_border.gif" style="padding:4px 8px 0 0" align=right>\
				<a href="javascript:mini_zoom(-50)" onfocus=blur()><img src="' + mini_path + 'img/btn_SizeUp.gif" border=0></a>\
				<a href="javascript:mini_zoom(50)" onfocus=blur()><img src="' + mini_path + 'img/btn_SizeDn.gif" border=0></a>\
				</td>\
			</tr>\
			</table>\
			</td>\
		</tr>\
		</table>\
		</td>\
	</tr>\
	</table><iframe name=mini_hidden_ifrm style="display:none"></iframe>');
}

function mini_zoom(idx)
{
	var obj = _ID('mini_out_frame');
	if (!mini_size_min) mini_size_min = obj.offsetHeight;
	var height = obj.offsetHeight + idx;
	if (height<mini_size_min) height = mini_size_min;
	obj.style.height = height;
}

function mini_set_toolbar()
{
	document.write('<table cellpadding=2 cellspacing=0>\
	<tr>\
		<td>' + mini_set_font() + '</td>\
		<td>' + mini_set_size() + '</td>\
		<td>' + mini_set_btn("Bold") + mini_set_btn("Italic") + mini_set_btn("Underline") + mini_set_btn("StrikeThrough") + '</td>\
		<td><img src="' + mini_path + 'img/seperator.gif"></td>\
		<td>' + mini_set_btn("ForeColor") + mini_set_btn("BackColor") + '</td>\
		<td><img src="' + mini_path + 'img/seperator.gif"></td>\
		<td>' + mini_set_btn("JustifyLeft") + mini_set_btn("JustifyCenter") + mini_set_btn("JustifyRight") + '</td>\
		<td><img src="' + mini_path + 'img/seperator.gif"></td>\
		<td>' + mini_set_btn("InsertTable") + mini_set_btn("CreateLink") + mini_set_btn("InsertImage") + '</td>\
	</tr>\
	<tr>\
		<td colspan=3></td>\
		<td>' + mini_color_box() + '</td>\
		<td colspan=3></td>\
		<td>' + mini_table_box() + '</td>\
	</tr>\
	</table>');
}

function mini_enterpress()
{
	var event = mini_obj.contentWindow.event;
	if (event.keyCode == 13){
		if (event.shiftKey == false){
			var rng = document.selection.createRange();
			rng.pasteHTML("<br>");
			event.cancelBubble = true;
			event.returnValue = false;
			rng.select();
			return false;
		} else {
			return event.keyCode = 13;
		}
	}
}

function mini_vmode(idx)
{
	if (mini_idx_pre==idx) return;

	var mini_box = _ID('mini_box');
	mini_btn_bottom(idx);

	switch (idx)
	{
		case 0:
			mini_obj.style.display = "block";
			mini_text.style.display = mini_preview.style.display = "none";
			//if (mini_idx_pre2!=0) mini_content.body.innerHTML = mini_text.value;
			mini_content.body.innerHTML = mini_text.value;
			break;
		case 1:
			mini_text.style.display = "block";
			mini_obj.style.display = mini_preview.style.display = "none";
			//if (mini_idx_pre2!=1) mini_text.value = mini_content.body.innerHTML;
			break;
		case 2:
			mini_preview.style.display = "block";
			mini_obj.style.display = mini_text.style.display = "none";
			//mini_preview.contentWindow.document.body.innerHTML = (mini_idx_pre) ? mini_text.value : mini_content.body.innerHTML;
			mini_preview.contentWindow.document.body.innerHTML = mini_text.value;
			break;
	}
	if (idx!=2) mini_idx_pre2 = idx;
	mini_idx_pre = idx;
}

function mini_command(str,value)
{
	var mode = false;
	if (!value) value = null;
	//var rng = mini_content.selection.createRange();
	//window.status = rng.text;
	switch (str){
		case "ForeColor": case "BackColor":
			var ready = true;
			if (_ID('mini_color_box').style.display=="block" && str!=mini_color_mode) mini_vlayer('mini_color_box');
			break;
		case "CreateLink":
			mode = true;
			break;
		case "InsertTable": 
			mini_vlayer('mini_table_box');
			return; break;
		case "InsertImage":
			window.open(mini_path + "popup.image.php","","width=400,height=510");
			return; break;
	}
	mini_command_exec(str,mode,value,0,ready);
}

function mini_command_exec(str,mode,value,ff,ready)
{
	if (document.all && ff) return;
	if (typeof(ready)=="undefined") mini_content.execCommand(str, mode, value);
	mini_reset(str);
	mini_obj.contentWindow.focus();

	if (str=="ForeColor" || str=="BackColor"){
		mini_color_mode = str;
		mini_vlayer('mini_color_box');
	}
}

function mini_in_array(el,arr)
{
	var ret = false;
	for (var i=0;i<arr.length;i++){
		if (el==arr[i]){
			ret = true;
			break;
		}
	}
	return ret;
}

function mini_reset(obj)
{
	var r_obj = new Array();
	var arr = new Array("Bold","Italic","Underline","StrikeThrough","FontName","FontSize");
	
	if (!obj) r_obj = arr;
	else if (mini_in_array(obj,arr)) r_obj[0] = obj;

	for (var i=0;i<r_obj.length;i++){
		switch (r_obj[i]){
			case "FontName": case "FontSize":
				mini_set_select('mini_btn' + r_obj[i], mini_content.queryCommandValue(r_obj[i]));
				break;
			default:
				mini_btn_onoff('mini_btn' + r_obj[i], mini_content.queryCommandValue(r_obj[i]));
				break;
		}
	}

	if (!obj){
		if (_ID('mini_table_box').style.display=="block") mini_vlayer('mini_table_box');
		if (_ID('mini_color_box').style.display=="block") mini_vlayer('mini_color_box');
	}
}

function mini_set_select(obj,ret)
{
	obj = _ID(obj);
	for (var i=0;i<obj.length;i++){
		if (obj.options[i].value==ret){
			obj.selectedIndex = i;
			break;
		}
	}
}

function mini_btn_onoff(obj, ret)
{
	obj = _ID(obj);
	if (!obj.disabled){
		if (ret) mini_btn_down(obj);
		else mini_btn_out(obj);
	}
}

function mini_btn_down(obj){
	with (obj.style){
		borderBottom	= "buttonhighlight 1px solid";
		borderLeft		= "buttonshadow 1px solid";
		borderRight		= "buttonhighlight 1px solid";
		borderTop		= "buttonshadow 1px solid";
	}
}

function mini_btn_up(obj){
	with (obj.style){
		borderBottom	= "buttonshadow 1px solid";
		borderLeft		= "buttonhighlight 1px solid";
		borderRight		= "buttonshadow 1px solid";
		borderTop		= "buttonhighlight 1px solid";
	}
}

function mini_btn_over(obj)
{
	if (obj.style.borderBottom != "buttonhighlight 1px solid") mini_btn_up(obj);
}

function mini_btn_out(obj)
{
	obj.style.borderColor = "buttonface";
}

function mini_btn_out2(obj){
	if (obj.style.borderBottom != "buttonhighlight 1px solid") obj.style.borderColor = "buttonface";
}

function mini_set_btn(mode)
{
	return "<img id=mini_btn" + mode + " src='" + mini_path + "img/btn_" + mode + ".gif' onClick=\"mini_command('" + mode + "')\" onmouseover=mini_btn_over(this) onmousedown=mini_btn_down(this) onmouseup=mini_btn_up(this) onmouseout=mini_btn_out2(this) class=mini_hand style='border:1px solid buttonface'>";
}

function mini_btn_bottom(idx)
{
	var r_btn = new Array("edit","source","preview");
	for (i=0;i<r_btn.length;i++){
		var obj = _ID("mini_btn_" + r_btn[i]);
		if (idx==i && typeof(mini_idx_pre)!="undefined") obj.src = obj.src.replace(".gif","_up.gif");
		else if (mini_idx_pre==i) obj.src = obj.src.replace("_up.gif",".gif"); 
	}
}

function mini_set_font()
{
	var name = new Array("굴림","돋움","바탕","궁서","굴림체","Arial","Courier","Tahoma");
	var ret = "<select id=mini_btnFontName onchange=\"mini_command('FontName',this[this.selectedIndex].value)\"><option>Font";
	for (i=0;i<name.length;i++){
		ret += "<option value='" + name[i] + "'>" + name[i];
	}
	ret += "</select>";
	return ret;
}

function mini_set_size()
{
	var ret = "<select id=mini_btnFontSize onchange=\"mini_command('FontSize',this[this.selectedIndex].value)\"><option>Size";
	for (i=1;i<=7;i++){
		ret += "<option value='" + i + "'>" + i;
	}
	ret += "</select>";
	return ret;
}

function mini_color_box()
{
	var ret = "";
	var arr = new Array(
			"#FFC0C0","#FFF000","#FFFFE0","#E0FFE0","#C0E0FF","#30C0FF","#F0C0FF","#FFFFFF",
			"#FF8080","#FFC000","#FFFF80","#80FFC0","#C0E0FF","#2080D0","#FF80FF","#C0C0C0",
			"#FF0000","#FF8000","#FFFF00","#00FF00","#00FFFF","#0000FF","#FF00FF","#808080",
			"#800000","#604800","#808000","#008000","#008080","#000080","#800080","#000000"
			);
	for (var i=0;i<arr.length;i++){
		if (i && i%8==0) ret += "</tr><tr>";
		ret += "<td class=mini_color_box style='background:" + arr[i] + "' onClick=\"mini_command_exec(mini_color_mode, false, '" + arr[i] + "',1)\"><a href='javascript:void(0)' onClick=\"mini_command_exec(mini_color_mode, false, '" + arr[i] + "')\"><div style='width:100%;height:100%;cursor:pointer;'></div></a></td>";
	}
	ret = "<div id=mini_color_box style='position:absolute;display:none;border:2px solid #efefef;padding:3px;background:#f7f7f7'><table><tr>" + ret + "</tr></table></div>";
	return ret;
}


function mini_table_box()
{
	var ret = "<table id=mini_table_inner border=1 bordercolor=#cccccc style='border-collapse:collapse'>";
	for (var i=0;i<10;i++){
		ret += "<tr>";
		for (var j=0;j<7;j++) ret += "<td style='width:20px;height:15px;font-size:0;' onmouseover='mini_chk_table(" + j + "," + i + ")' onclick='mini_set_table(" + j + "," + i + ",1)'><a href='javascript:mini_set_table(" + j + "," + i + ")'><span style='width:100%;height:100%' class=mini_hand></span></a></td>";
		ret += "</tr>";
	}
	ret += "</table><div id=mini_table_status style='font:8pt tahoma;border:1px solid #cccccc;width:100%;height:20px;margin-top:3px;padding-top:2px;background:#f7f7f7' align=center></div>";
	ret = "<div id=mini_table_box style='position:absolute;display:none;border:2px solid #efefef;padding:3px;background:#ffffff'>" + ret + "</div>";
	return ret;
}

function mini_chk_table(x,y)
{
	var obj = _ID('mini_table_inner');
	for (var i=0;i<10;i++){
		for (var j=0;j<7;j++){
			obj.rows[i].cells[j].style.background = (j<=x && i<=y) ? "#316AC5" : "#ffffff";
		}
	}
	_ID('mini_table_status').innerHTML = "<b>" + (x+1) + "</b> cells X <b>" + (y+1) + "</b> rows Table";
}

function mini_set_table(x,y,ff)
{
	if (document.all && ff) return;
	var ret = "<table width=100%>";
	for (var i=0;i<=y;i++){
		ret += "<tr>";
		for (var j=0;j<=x;j++) ret += "<td></td>";
		ret += "</tr>";
	}
	ret += "</table>";
	mini_vlayer('mini_table_box');
	mini_set_html(ret);
}

function mini_vlayer(obj)
{
	obj = _ID(obj);
	obj.style.display = (obj.style.display!="block") ? "block" : "none";
	if (obj.id=="mini_color_box"){
		var value = (obj.style.display=="block") ? true : false;
		mini_btn_onoff('mini_btn' + mini_color_mode, value);
	}
}

function mini_set_html(str)
{
	mini_obj.contentWindow.focus();
	if (mini_content.selection.type=="Control") mini_content.selection.clear();
	var rng = mini_content.selection.createRange();
	rng.pasteHTML(str);
}

window.onload = mini_init;