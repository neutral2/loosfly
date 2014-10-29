// JavaScript Document

	function getXMLHttpRequest() {
	       if (window.ActiveXObject) { // ����ũ�� ����Ʈ IE 
			try {
				return new ActiveXObject("Msxml2.XMLHTTP"); // IE �� ����
			} 
			catch(e) {
				try {
					return new ActiveXObject("Microsoft.XMLHTTP"); // IE �ٿ� ����
				} 
				catch(e1) { 
					return null; 
				}
			}
		}
		else if (window.XMLHttpRequest) { // ��Ÿ �� ��������
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
 
		// open(): ��û�� �ʱ�ȭ, GET/POST ����, ������ URL �Է�
		httpRequest.open(httpMethod, httpUrl, true);
		httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		httpRequest.onreadystatechange = callback; // �ݹ��Լ� ���
 
		// send(): �� ������ ��û ����
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
