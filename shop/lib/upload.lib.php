<?php

function reverse_file_array($arr)
{
	if(!$arr)return false;
	foreach($arr as $k => $v)
		foreach($v as $k1 => $v1)$tmp[$k1][$k] = $v1;
	return 	$tmp;
}

class upload_file
{
	var $file;
	var $target;
	var $extType;
	var $chkType;

	function upload_file($file='',$target='',$chkType='')
	{
		if($file){
			$this->upload_set(&$file,$target,$chkType);
		}
	}

	/**
	 * 변수 할당
	 * @void
	*/
	function upload_set(&$file,$target,$chkType='')
	{
		$this->file = &$file;
		$this->target = $target;
		switch($this->chkType){
			case "design":
				$this->extType = array('html','php');
				$this->chkType = "text";
			break;
			default:
				$this->extType = array('html','htm','php');
				$this->chkType = $chkType;
			break;
		}
	}

	/**
	 * 일반 업로드 파일 확장자 검증
	 * @return bool
	*/
	function file_extension_check()
	{
		if($this->file['name']){
			$tmp = explode('.',$this->file['name']);
			$extension = strtolower($tmp[count($tmp)-1]);
			if(in_array($extension,$this->extType))return false;
		}
		return true;
	}

	/**
	 * 일반 업로드 파일 검증
	 * @return bool
	*/
	function file_type_check()
	{
		if($this->file['tmp_name'] && ($mime = Core::helper('File')->mime($this->file['tmp_name'])) != 'unknown' ) {
			if($this->chkType&&!preg_match('/'.$this->chkType.'/',$mime))return false;
		}
		return true;
	}

	/**
	 * 파일업로드
	 * @return bool
	*/
	function upload()
	{
		if($this->file['tmp_name']){
			if(!$this->file_extension_check()){
				return false;
			}
			if(!$this->file_type_check()){
				return false;
			}
			@move_uploaded_file($this->file['tmp_name'],$this->target);
			@chmod($this->target,0707);
		}
		return true;
	}
}
?>