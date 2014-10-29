<?php
/**
 * 파라미터검증 Class
 *
 * @author gise, lee <birdmarine@godo.co.kr>
 * @version 1.0 2009/08/04 10:00:00
 * @copyright Copyright (c), Godosoft
 */

class Validation
{
	/**
	 * 문자열 검증 이메일형식
	 * @param String $value
	 * @return bool
	*/
	function check_email($value)
	{
		$pattern = "(^[_0-9a-zA-Z-]+(\.[_0-9a-zA-Z-]+)*@[0-9a-zA-Z-]+(\.[_0-9a-zA-Z-]+)*$)";
		return $this -> check_pattern($pattern,$value);
	}

	/**
	 * 문자열 검증 전화번호
	 * @param String $value
	 * @return bool
	*/
	function check_phone($value)
	{
		if(is_array($value))$value = implode('-',$value);
		$pattern = "^[0-9]{2,4}\-[0-9]{3,4}\-[0-9]{4}$";
		return $this -> check_pattern($pattern,$value);
	}

	/**
	 * 문자열 검증 date형식
	 * @param String $value
	 * @return bool
	*/
	function check_date($value)
	{
		$pattern = "^[0-9]{4}\-[0-9]{2}\-[0-9]{2}$";
		return $this -> check_pattern($pattern,$value);
	}

	/**
	 * 문자열 검증 time형식
	 * @param String $value
	 * @return bool
	*/
	function check_time($value)
	{
		$pattern = "^[0-9]{2}:[0-9]{2}$";
		return $this -> check_pattern($pattern,$value);
	}

	/**
	 * 문자열 검증 datetime형식
	 * @param String $value
	 * @return bool
	*/
	function check_datetime($value)
	{
		$pattern = "^[0-9]{4}\-[0-9]{2}\-[0-9]{2} [0-9]{2}:[0-9]{2}:[0-9]{2}$";
		return $this -> check_pattern($pattern,$value);
	}

	/**
	 * 문자열 검증 도메인형식
	 * @param String $value
	 * @return bool
	*/
	function check_domain($value)
	{
		$pattern = "^[.a-zA-Z0-9-]+\.[a-zA-Z]+$";
		return $this -> check_pattern($pattern,$value);
	}

	/**
	 * 문자열 검증 url형식
	 * @param String $value
	 * @return bool
	*/
	function check_url($value)
	{
		$pattern = "^[.a-zA-Z0-9-]+\.[a-zA-Z]+[^:space:]+$";
		return $this -> check_pattern($pattern,$value);
	}

	/**
	 * 문자열 검증 최소길이
	 * @param String $value
	 * @return bool
	*/
	function check_min($min,$value)
	{
		if($min > strlen($value))return false;
		return true;
	}

	/**
	 * 문자열 검증 최대길이
	 * @param String $value
	 * @return bool
	*/
	function check_max($max,$value)
	{
		if($max < strlen($value))return false;
		return true;
	}

	/**
	 * 문자열 검증 숫자형식
	 * @param String $value
	 * @return bool
	*/
	function check_digit($value)
	{
		if(is_numeric($value))return true;
		return false;
	}


	/**
	 * 문자열 검증 패턴
	 * @param String $pattern,$value
	 * @return bool
	*/
	function check_pattern($pattern,$value)
	{
		if(ereg($pattern,$value)){
			return true;
		}
		return false;
	}

	function check_require($value)
	{
		$value = trim($value);
		if( empty($value) )return false;
		return true;
	}
}
?>
