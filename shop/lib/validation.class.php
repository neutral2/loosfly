<?php
/**
 * �Ķ���Ͱ��� Class
 *
 * @author gise, lee <birdmarine@godo.co.kr>
 * @version 1.0 2009/08/04 10:00:00
 * @copyright Copyright (c), Godosoft
 */

class Validation
{
	/**
	 * ���ڿ� ���� �̸�������
	 * @param String $value
	 * @return bool
	*/
	function check_email($value)
	{
		$pattern = "(^[_0-9a-zA-Z-]+(\.[_0-9a-zA-Z-]+)*@[0-9a-zA-Z-]+(\.[_0-9a-zA-Z-]+)*$)";
		return $this -> check_pattern($pattern,$value);
	}

	/**
	 * ���ڿ� ���� ��ȭ��ȣ
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
	 * ���ڿ� ���� date����
	 * @param String $value
	 * @return bool
	*/
	function check_date($value)
	{
		$pattern = "^[0-9]{4}\-[0-9]{2}\-[0-9]{2}$";
		return $this -> check_pattern($pattern,$value);
	}

	/**
	 * ���ڿ� ���� time����
	 * @param String $value
	 * @return bool
	*/
	function check_time($value)
	{
		$pattern = "^[0-9]{2}:[0-9]{2}$";
		return $this -> check_pattern($pattern,$value);
	}

	/**
	 * ���ڿ� ���� datetime����
	 * @param String $value
	 * @return bool
	*/
	function check_datetime($value)
	{
		$pattern = "^[0-9]{4}\-[0-9]{2}\-[0-9]{2} [0-9]{2}:[0-9]{2}:[0-9]{2}$";
		return $this -> check_pattern($pattern,$value);
	}

	/**
	 * ���ڿ� ���� ����������
	 * @param String $value
	 * @return bool
	*/
	function check_domain($value)
	{
		$pattern = "^[.a-zA-Z0-9-]+\.[a-zA-Z]+$";
		return $this -> check_pattern($pattern,$value);
	}

	/**
	 * ���ڿ� ���� url����
	 * @param String $value
	 * @return bool
	*/
	function check_url($value)
	{
		$pattern = "^[.a-zA-Z0-9-]+\.[a-zA-Z]+[^:space:]+$";
		return $this -> check_pattern($pattern,$value);
	}

	/**
	 * ���ڿ� ���� �ּұ���
	 * @param String $value
	 * @return bool
	*/
	function check_min($min,$value)
	{
		if($min > strlen($value))return false;
		return true;
	}

	/**
	 * ���ڿ� ���� �ִ����
	 * @param String $value
	 * @return bool
	*/
	function check_max($max,$value)
	{
		if($max < strlen($value))return false;
		return true;
	}

	/**
	 * ���ڿ� ���� ��������
	 * @param String $value
	 * @return bool
	*/
	function check_digit($value)
	{
		if(is_numeric($value))return true;
		return false;
	}


	/**
	 * ���ڿ� ���� ����
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
