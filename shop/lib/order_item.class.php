<?php
class order_item implements ArrayAccess
{

	private $_db;

	private $_data;

	private $_cancel;

	public function __construct()
	{
		$this->_db = Core::loader('db');
	}

	/**
	 * Whether a offset exists
	 * @param string $offset An offset to check for
	 * @return boolean
	 */
	public function offsetExists($offset)
	{
		return array_key_exists($offset, $this->_data);
	}

	/**
	 * Offset to retrieve
	 * @param string $offset The offset to retrieve.
	 * @return mixed
	 */
	public function offsetGet($offset)
	{
		return $this->_data[$offset];
	}

	/**
	 * Offset to set
	 * @param string $offset The offset to assign the value to
	 * @param mixed $value The value to set
	 * @return void
	 */
	public function offsetSet($offset, $value)
	{
		$this->_data[$offset] = $value;
	}

	/**
	 * Offset to unset
	 * @param string $offset
	 * @return void
	 */
	public function offsetUnset($offset)
	{
		unset($this->_data[$offset]);
	}


	public function load($sno)
	{
		if (is_null($this->_data)) {
			$query = "
			select b.*,a.*, tg.tgsno from
				" . GD_ORDER_ITEM . " a
				left join " . GD_GOODS . " b on a.goodsno=b.goodsno
				left join " . GD_TODAYSHOP_GOODS . " tg on a.goodsno=tg.goodsno
			where
				a.sno='$sno'
			";
			$this->_data = $this->_db->fetch($query, 1);
		}

	}

	public function getSettleAmount()
	{
		return $this->getAmount() - $this->getDiscount();
	}

	public function getDiscount()
	{
		return $this->getPercentCouponDiscount() + $this->getMemberDiscount() + $this->getSpecialDiscount();
	}

	public function getMemberDiscount()
	{
		return $this['memberdc'] * $this['ea'];
	}

	// % 쿠폰 할인액 (저장 되는 값은 % 쿠폰 값만 저장됨)
	public function getPercentCouponDiscount()
	{
		return $this['coupon'] * $this['ea'];
	}

	// 쿠폰 적립금
	public function getCouponReserve()
	{
		return $this['coupon_emoney'] * $this['ea'];
	}

	// 주문상품의 주문 금액
	public function getAmount()
	{
		return $this['price'] * $this['ea'];
	}

	public function getCanceledAmount()
	{
		// 취소상태인 경우, 주문금액 - 할인액
		return $this->hasCanceled() ? $this->getAmount() - $this->getDiscount() : 0;
	}

	public function hasCanceled()
	{
		return $this['istep'] > 40 ? true : false;
	}

	public function hasRefunded()
	{
		return $this['istep'] == 44 && in_array($this['cyn'], array('r', 'y')) ? true : false;
	}

	public function getRefundedAmount()
	{
		if ($this->hasRefunded()) {
			$cancel = $this->_db->fetch("select * from gd_order_cancel where sno = '$this[cancel]'", 1);
			return array($cancel['sno']=>$cancel['rprice']);
		}
		else {
			return array();
		}

	}

	public function getRefundedFeeAmount()
	{
		if ($this->hasRefunded()) {
			$cancel = $this->_db->fetch("select * from gd_order_cancel where sno = '$this[cancel]'", 1);
			return array($cancel['sno']=>$cancel['rfee']);
		}
		else {
			return array();
		}

	}

	//tax amount
	public function getSupplyPrice()
	{
		if ($this['tax'] != '1') { // 면세
			return $this->getAmount();
		}
		else { // 과세 (vat 10%)
			return round($this->getAmount() / 1.1);
		}
	}

	public function getTax()
	{
		if ($this['tax'] != '1') { // 면세
			return 0;
		}
		else { // 과세 (vat 10%)
			return $this->getAmount() - $this->getSupplyPrice();
		}
	}

	public function getSpecialDiscount()
	{
		return $this['oi_special_discount_amount'] * $this['ea'];
	}

}
