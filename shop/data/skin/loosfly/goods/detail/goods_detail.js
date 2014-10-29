// JavaScript Document

	function getXMLHttpRequest() {
	       if (window.ActiveXObject) { // 마이크로 소프트 IE 
			try {
				return new ActiveXObject("Msxml2.XMLHTTP"); // IE 업 버전
			} 
			catch(e) {
				try {
					return new ActiveXObject("Microsoft.XMLHTTP"); // IE 다운 버전
				} 
				catch(e1) { 
					return null; 
				}
			}
		}
		else if (window.XMLHttpRequest) { // 기타 웹 브라우저들
			return new XMLHttpRequest();
		} 

		return null;
	}
	var httpRequest = null;
 
	function sendRequest(url, params, callback, method) {
		httpRequest = getXMLHttpRequest();
 
		var httpMethod = method ? method : 'GET';
		if (httpMethod != 'GET' && httpMethod != 'POST') {
			httpMethod = 'GET';
		}
 
		var httpUrl = url;
		var httpParams = (params == null || params == '') ? null : params;
		if (httpMethod == 'GET' && httpParams != null) {
			httpUrl = httpUrl + "?" + httpParams;
		}
 
		// open(): 요청의 초기화, GET/POST 선택, 접속할 URL 입력
		httpRequest.open(httpMethod, httpUrl, true);
		httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		httpRequest.onreadystatechange = callback; // 콜백함수 등록
 
		// send(): 웹 서버에 요청 전송
		httpRequest.send(httpMethod == 'POST' ? httpParams : null);
	}

	change_src = function() {
		if(httpRequest.readyState == 4) {
			if(httpRequest.status == 200) {
				$('#frmDescription').attr('src',fname);
				return;
			}
		}
		$('#frmDescription').attr('src','');
	}
