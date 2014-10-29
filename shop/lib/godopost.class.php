<?php

class godopost {
	
	var $linked;
	var $config;
	var $server='godopost.godo.co.kr';
	var $shopid;
	var $max_reserve=200;

	var $_request;

	function godopost() {
		$config = Core::loader('config');
		$godo = $config->load('godo');
		$godopost = $config->load('godopost');

		$this->shopid=$godo['sno'];
		
		if($godopost['compdivcd']) {
			$this->linked=true;
			$this->config = &$godopost;
		}
		else {
			$this->linked=false;
		}
		include_once(SHOPROOT.'/lib/httpSock.class.php');
	}

	
	function get_regino($prepay_number,$collect_number) {
		if(!$this->linked) return false;
		
		$number = (int)$number;
		$requestPost = array(
			'shopid'=>$this->shopid,
			'compdivcd'=>$this->config['compdivcd'],
			'prepay_number'=>$prepay_number,
			'collect_number'=>$collect_number,
		);
		
		
		$url = 'http://'.$this->server.'/request_regino.php';
		$httpSock = new httpSock($url,'POST',$requestPost);
		$httpSock->send();
		
		$result = $httpSock->resContent;
		if(substr($result,0,4)=='9999') {
			$result = substr($result,4);
			
			$prepay_result = substr($result,0,strpos($result,'@'));
			$collect_result = substr($result,strpos($result,'@')+1);
			
			return array(
				'prepay'=>explode('|',$prepay_result),
				'collect'=>explode('|',$collect_result),
			);
		}
		else {
			return false;
		}
	}

	function reserve_reset() {
		$this->_request=array();
	}

	function reserve_add(&$request) {
		$this->_request[]=$request;
	}

	function reserve_send() {
		if(!$this->linked) return false;
		
		
		$requestPost = array(
			'shopid'=>$this->shopid,
			'compdivcd'=>$this->config['compdivcd'],
			'requests'=>&$this->_request
		);
		
		$url = 'http://'.$this->server.'/request_order.php';
		$httpSock = new httpSock($url,'POST',$requestPost);
		$httpSock->send();
		
		$result = $httpSock->resContent;
		if(substr($result,0,4)=='9999') {
			$result = substr($result,4);
			$ar_regino=explode(',',$result);
			return $ar_regino;
		}
		else {
			return false;
		}
	}

	function result_confirm() {
		if(!$this->linked) return false;
		
		$requestPost = array(
			'shopid'=>$this->shopid,
			'compdivcd'=>$this->config['compdivcd'],
		);
		
		$url = 'http://'.$this->server.'/request_result.php';
		$httpSock = new httpSock($url,'POST',$requestPost);
		$httpSock->send();
		
		$result = $httpSock->resContent;
		if(substr($result,0,4)=='9999') {
			$result = substr($result,4);
			$result = unserialize($result);
			return $result;
		}
		else {
			return false;
		}

	}

}

?>
