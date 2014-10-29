// SNS Post
SNS = {
	items : {},
	serialize: function(data) {
		var result = new Array();
		for(var key in data) {
			result[result.length] = key + "=" + escape(data[key]);
		}
		return result.join("&");
	},
	init: function(itemno, cfgdata) {
		if (!cfgdata.page) cfgdata.page = 1;
		if (cfgdata.isAdmin) {
			cfgdata.isAdmin = true;
			cfgdata.engineurl = "../../partner/sns.engine.php";
		}
		else {
			cfgdata.isAdmin = false;
			cfgdata.engineurl = "../partner/sns.engine.php";
		}
		SNS.items[itemno] = cfgdata;
		SNS.getProfile(itemno);
		SNS.getPosts(itemno);
	},
	setProfile: function(itemno, jsonData) {
		switch(SNS.items[itemno].sns) {
			case 'twitter' : {
				var screen_name = jsonData.screen_name;
				var name = jsonData.name;
				var img = jsonData.profile_image_url.replace(/(http:\/\/[^\s]*)/g, "<a href='http://twitter.com/"+screen_name+"' target='_blank'><img src='$1' height='48' /></a>");
				document.getElementById("snsTitle_img_"+itemno).innerHTML = img;
				document.getElementById("snsTitle_id_"+itemno).innerHTML = screen_name;
				document.getElementById("snsTitle_name_"+itemno).innerHTML = name;
				document.getElementById("snsLink_"+itemno).href = "http://twitter.com/"+screen_name;
				break;
			}
			case 'me2day' : {
				var id = jsonData.id;
				var nickname = jsonData.nickname;
				var description = jsonData.description;
				var img = jsonData.face.replace(/(http:\/\/[^\s]*)/g, "<a href='http://me2day.net/"+id+"' target='_blank'><img src='$1' height='48' /></a>");
				document.getElementById("snsTitle_img_"+itemno).innerHTML = img;
				document.getElementById("snsTitle_id_"+itemno).innerHTML = nickname;
				document.getElementById("snsTitle_name_"+itemno).innerHTML = description;
				document.getElementById("snsLink_"+itemno).href = "http://me2day.net/"+id;
				break;
			}
		}
	},
	getProfile: function(itemno) {
		var pars = SNS.serialize(SNS.items[itemno]) + "&mode=profile";
		new Ajax.Request(SNS.items[itemno].engineurl, {
			method : 'get',
			parameters : pars,
			onSuccess : function(req) {
				eval("var res =" + req.responseText);
				SNS.setProfile(itemno, res);
			},
			onFailure : function() { }
		});
	},
	setPosts: function(itemno, jsonData) {
		switch(SNS.items[itemno].sns) {
			case 'twitter' : {
				for(var i = 0; i < jsonData.length; i++) {
					var arrDate = jsonData[i].created_at.split(" ");
					var arrTime = arrDate[3].split(":");
					arrTime[0] = parseInt(arrTime[0])+9; // GMT+9
					arrDate[3] = arrTime.join(":");
					arrDate.splice(4, 1);
					var created_at = arrDate.join(" ");
					document.getElementById("snsPost_"+itemno+"_"+i).innerHTML = jsonData[i].text.replace(/(http:\/\/[^\s]*)/g, "<a href='$1' target='_blank'>$1</a>");
					document.getElementById("snsPostInfo_"+itemno+"_"+i).innerHTML = created_at;
					document.getElementById("snsPostBox_"+itemno+"_"+i).style.display = "block";
				}
				for(var i = 0; i < jsonData.length; i++) {
					var aTags =document.getElementById("snsPost_"+itemno+"_"+i).getElementsByTagName("A");
					for(var j = 0; j < aTags.length; j++) {
						aTags[j].style.color = SNS.items[itemno].fontClr;
						aTags[j].style.textDecoration = "underline";
					}
				}

				break;
			}
			case 'me2day' : {
				for(var i = 0; i < jsonData.length; i++) {
					document.getElementById("snsPost_"+itemno+"_"+i).innerHTML = jsonData[i].body;
					document.getElementById("snsPostInfo_"+itemno+"_"+i).innerHTML = jsonData[i].pubDate.substring(0, 19).replace(/T/g, " ");
					document.getElementById("snsPostBox_"+itemno+"_"+i).style.display = "block";
				}
				for(var i = 0; i < jsonData.length; i++) {
					var aTags =document.getElementById("snsPost_"+itemno+"_"+i).getElementsByTagName("A");
					for(var j = 0; j < aTags.length; j++) {
						aTags[j].style.color = SNS.items[itemno].fontClr;
						aTags[j].style.textDecoration = "underline";
					}
				}
				break;
			}
			default : return;
		}
		for(var i = jsonData.length; i < SNS.items[itemno].postCount; i++) {
			document.getElementById("snsPost_"+itemno+"_"+i).innerHTML = "";
			document.getElementById("snsPostInfo_"+itemno+"_"+i).innerHTML = "";
			document.getElementById("snsPostBox_"+itemno+"_"+i).style.display = "none";
		}
	},
	getPosts: function(itemno) {
		if (!SNS.items[itemno].isAdmin && SNS.items[itemno].itv) clearTimeout(SNS.items[itemno].itv);
		var pars = SNS.serialize(SNS.items[itemno]) + "&mode=post";
		new Ajax.Request(SNS.items[itemno].engineurl, {
			method : 'get',
			parameters : pars,
			onSuccess : function(req) {
				eval("var res =" + req.responseText);
				if(res.length == 0) {
					switch(SNS.items[itemno].lastAct) {
						case "prev": { SNS.items[itemno].page++; break; }
						case "next": { SNS.items[itemno].page--; break; }
					}
					return;
				}
				SNS.setPosts(itemno, res);
				if (!SNS.items[itemno].isAdmin) {
					SNS.items[itemno].itv = setTimeout(function() {
						SNS.getPosts(itemno);
					}, 30 * 1000);
				}
			},
			onFailure : function() { }
		});
	},
	expand: function(snsno, mode) {
		switch(mode) {
			case 'expand' : {
				if(document.getElementById("snsBox_"+snsno)) document.getElementById("snsBox_"+snsno).style.display = "block";
				break;
			}
			case 'collapse' : {
				if(document.getElementById("snsBox_"+snsno)) document.getElementById("snsBox_"+snsno).style.display = "none";
				break;
			}
		}
	},
	goPrevPage: function(itemno) {
		if (SNS.items[itemno].page > 1) {
			SNS.items[itemno].lastAct = "prev";
			SNS.items[itemno].page--;
		}
		SNS.getPosts(itemno);
	},
	goNextPage: function(itemno) {
		SNS.items[itemno].lastAct = "next";
		SNS.items[itemno].page++;
		SNS.getPosts(itemno);
	}
}
// SNS Post