<?
class Lms
{
	var $msgOn, $smsPass, $smsPt, $r_data;

	function Lms($msgOn=false)
	{
		$this->msgOn = $msgOn;
		$this -> getSno();
		$this -> r_data = array();
	}

	function getSno()
	{
		// get godo's serial
		$file = dirname(__FILE__)."/../conf/godomall.cfg.php";
		if (!is_file($file)) return false;
		$file = file($file);
		$this->godo = decode($file[1],1);
		if (!$this->godo[sno]){
			if ($this->msgOn) msg("업체고유번호가 지정되어 있지 않습니다",1);
			return false;
		}
		// get smsPassword
		$file = dirname(__FILE__)."/../conf/config.php";
		if (!is_file($file)) return false;
		@include($file);
		$this -> smsPass = $cfg[smsPass];
		if(!$this -> smsPass)$this -> smsPass = "1111";
		// get smsPoint
		$tmp = array(	 'type'=>'search', 'sno' => $this->godo[sno], 'pass' => $this->smsPass );
		$res = $this -> lms_socket($tmp);
		/*
		if(!preg_match('/result=\[[0-9]+\]/',$res)){
			return false;
		}
		*/
		$res = str_replace(array('result','=','[',']'),'',$res);
		$this -> smsPt = $res;
		return true;
	}

	function lms_socket($arr){
		$host = "godosms.godo.co.kr";
		$port = 1686;
		
		foreach($arr as $k => $v) {
			$strSms .= $k.":".$v."\n";
		}

		if($strSms){
			$strSms = base64_encode($strSms);
			$sock = @fsockopen($host, $port, $errno, $errstr, 30);
			@fputs($sock, $strSms);
			$response = fread($sock, 256);
			fclose($sock);
		}
		if($response)return base64_decode($response);
	}

	function send($tran_msg,$tran_phone,$tran_callback='',$send_date='',$alram_etc='',$tran_type='send',$tran_subject='')
	{
		if ( $this->smsPt <= 0 ){
			if ($this->msgOn) msg("SMS 잔여콜수가 부족합니다. 추가 충전하셔서 사용하세요");
			return false;
		}
		
		//if (!trim($tran_msg) || !trim($tran_phone)) return false;

		$tran_phone = str_replace("-","",$tran_phone);
		$tran_callback = str_replace("-","",$tran_callback);
		$tran_subject = addslashes($tran_subject);
		$tran_msg = addslashes($tran_msg);
		$add = false;
		$tp = count($this -> r_data) - 1;

		if($tp > -1 && $tran_type == 'send'){
			if($this -> r_data[$tp][msg] == $tran_msg){
				$tmp = explode(',',$this -> r_data[$tp][hp]);
				if(count($tmp) < 30) $add= true;
				else $this -> update();
			}
		}
		
		##set msg
		if($add){
			$this -> r_data[$tp][hp] .= ",".$tran_phone;
		}else{
			$this -> r_data[] = array(
				'type' => $tran_type,
				'sno' => $this->godo[sno],
				'pass' => $this -> smsPass,
				'callback' => $tran_callback,
				'hp' => $tran_phone,
				'res_date' => $send_date,
				'res_etc' => $alram_etc,
				'subject' => $tran_subject,
				'__head__' => '__body__',
				'msg' => $tran_msg
			);
		}

		$this->smsPt = $this->smsPt - 3;
		return true;
	}

	function update()
	{
		if($this -> r_data){
			foreach($this -> r_data as $v) {
				$res = $this -> lms_socket($v);
			}
		}
		$this -> r_data = array();
		$file = dirname(__FILE__)."/../conf/sms.cfg.php";
		if(is_file($file)) unlink($file);
		$fp = fopen($file,"w");
		fwrite($fp,"<?/* \n");
		fwrite($fp,$this->smsPt."\n");
		fwrite($fp,"*/?>");
		fclose($fp);
		@chmod($file,0707);

	}

	function log($msg,$to_tran,$type,$cnt,$reserve='',$subject='')
	{	
		$to_tran = str_replace("-","",$to_tran);
		$query = "
		insert into ".GD_SMS_LOG." set
			sms_type	= 'lms',
			msg		= '".addslashes($msg)."',
			subject		= '".addslashes($subject)."',
			type	= '$type',
			to_tran	= '$to_tran',
			cnt		= '$cnt',
			reservedt = '$reserve',
			regdt	= now()
		";
		$GLOBALS[db]->query($query);
	}

	function lms_Control($phone,$msg,$alram_Date,$etc_data,$type,$subject){
		if( $type == "new" ){
			$this->send($msg,$phone,$phone,$alram_Date,$etc_data,'res_send',$subject);
			$this->update_ok_eNamoo = true;
			$this->update();
		}else if( $type == "delete" ){
			$this->send($msg,$phone,$phone,$alram_Date,$etc_data,'res_delete',$subject);
			$this->update_ok_eNamoo = true;
			$this->update();
			$this->smsPt = $this->smsPt + 2;
		}else{
			$this->send($msg,$phone,$phone,$alram_Date,$etc_data,'res_delete',$subject);
			$this->send($msg,$phone,$phone,$alram_Date,$etc_data,'res_send',$subject);
			$this->update_ok_eNamoo = true;
			$this->update();
			$this->smsPt = $this->smsPt + 2;
		}
		return true;
	}
}

?>