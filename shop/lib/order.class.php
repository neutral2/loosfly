<?php
class order implements ArrayAccess
{

	private $_db;

	private $_data;

	private $_order_item;

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


	public function load($ordno)
	{
		$query = "select b.m_id,a.* from " . GD_ORDER . " a left join " . GD_MEMBER . " b on a.m_no=b.m_no where ordno='$ordno'";
		$this->_data = $this->_db->fetch($query, 1);
		$this->_order_item = null;
	}


	public function getOrderItems()
	{
		if (is_null($this->_order_item)) {
			$this->_loadOrderItems();
		}

		return (array) $this->_order_item;
	}

	private function _loadOrderItems()
	{
		$query = "select sno from " . GD_ORDER_ITEM . " where ordno='{$this['ordno']}' order by sno";
		$rs = $this->_db->query($query);

		$item = new order_item();

		$this->_order_item = array();

		while ($row = $this->_db->fetch($rs, 1)) {
			$_item = clone $item;
			$_item->load($row['sno']);
			$this->_order_item[] = $_item;
		}
	}

	public function getDiscount()
	{
		return $this->getMemberDiscount() + $this[emoney] + $this[coupon] + $this[enuri] + $this[ncash_emoney] + $this[ncash_cash] + $this[o_special_discount_amount];
	}

	public function getDiscountDetailArray($format = false)
	{
		$discount_detail = array();

		if ($this->getMemberDiscount()) {
			$discount_detail['회원할인'] = $this->getMemberDiscount();
		}

		if ($this['coupon']) {
			$discount_detail['쿠폰할인'] = array('%할인'=>$this->getPercentCouponDiscount(), '금액할인'=>$this['coupon'] - $this->getPercentCouponDiscount() - $this['about_dc_sum'], );
		}

		if ($this['o_special_discount_amount']) {
			$discount_detail['상품할인'] = $this['o_special_discount_amount'];
		}

		if ($this['about_coupon_flag']) {
			$discount_detail['쿠폰할인']['어바웃'] = $this['about_dc_sum'];
		}

		if ($this['emoney']) {
			$discount_detail['적립금사용'] = $this['emoney'];
		}

		if ($this['ncash_emoney']) {
			$discount_detail['네이버마일리지사용'] = $this['ncash_emoney'];
		}

		if ($this['ncash_cash']) {
			$discount_detail['네이버캐쉬사용'] = $this['ncash_cash'];
		}

		if ($format) {
			$tmp = array();
			foreach ($discount_detail as $k=>$v) {

				$operator = '+';
				if (sizeof($tmp) == 0)$operator = '';

				if (is_array($v)) {

					$_tmp = array();

					foreach ($v as $k2=>$v2) {
						if ($v2) {
							$_tmp[] = sprintf('%s : %s원', $k2, number_format($v2));
						}
					}

					$tmp[] = sprintf('%s %s(%s)', $operator, $k, implode(' / ', $_tmp));
				}
				else {
					$tmp[] = sprintf('%s %s(%s원)', $operator, $k, number_format($v));
				}

			}
			return $tmp;
		}

		return $discount_detail;
	}

	public function getPercentCouponDiscount()
	{
		$amount = 0;

		foreach ($this->getOrderItems() as $item) {
			$amount += $item->getPercentCouponDiscount();
		}

		return $amount;
	}

	public function getMemberDiscount()
	{
		$amount = 0;

		foreach ($this->getOrderItems() as $item) {
			$amount += $item->getMemberDiscount();
		}
		return $amount;
	}

	public function getAmount()
	{
		$amount = 0;

		foreach ($this->getOrderItems() as $item) {
			$amount += $item->getAmount();
		}
		return $amount;
	}

	public function getCanceledAmount()
	{
		$amount = 0;

		$cnt = 0; // all count;
		$cnt2 = 0; // canceled count;

		foreach ($this->getOrderItems() as $item) {
			$cnt++;
			if ($item->hasCanceled()) {
				$cnt2++;
			}
			$amount += $item->getCanceledAmount();
		}

		// 전체 주문 품목 취소일 경우
		// 배송비 - 에누리 - 적립금사용액 - 네이버마일리지 - 네이버캐시 - 금액할인 + 보증보험수수료 를 합산한다.
		if ($cnt == $cnt2) {
			$amount += $this->getDeliveryFee() - $this[enuri] - $this[emoney] - $this['ncash_emoney'] - $this['ncash_cash'] - ($this[coupon] - $this->getPercentCouponDiscount()) + $this[eggFee];
		}

		return $amount;
	}

	public function getCanceledDetailArray($format = false)
	{
		$amount = array();

		$cnt = 0; // all count;
		$cnt2 = 0; // canceled count;

		foreach ($this->getOrderItems() as $item) {
			$cnt++;
			if ($item->hasCanceled()) {
				$cnt2++;

				$amount['취소상품 판매금액'] += $item->getAmount();
				$amount['상품별할인 적용금액'] += $item->getDiscount();
			}
		}

		$amount['상품별할인 적용금액'] = $amount['상품별할인 적용금액'] * -1;

		// 전체 주문 품목 취소일 경우
		// + 배송비 - 에누리 - 적립금사용액 - 네이버마일리지 - 네이버캐시 - 금액할인 + 보증보험수수료 를 합산한다.
		if ($cnt == $cnt2) {
			if ($this[coupon] - $this->getPercentCouponDiscount()) {
				$amount['금액할인'] = -($this[coupon] - $this->getPercentCouponDiscount());
			}

			if ($this->getDeliveryFee()) {
				$amount['배송비'] = $this->getDeliveryFee();
			}

			if ($this[enuri]) {
				$amount['에누리'] = -$this[enuri];
			}

			if ($this[emoney]) {
				$amount['적립금'] = -$this[emoney];
			}

			if ($this[ncash_emoney]) {
				$amount['네이버 마일리지'] = -$this[ncash_emoney];
			}

			if ($this[ncash_cash]) {
				$amount['네이버 캐쉬'] = -$this[ncash_cash];
			}

			if ($this[eggFee]) {
				$amount['보증보험수수료'] = $this[eggFee];
			}

		}


		if ($format) {
			$tmp = array();
			foreach ($amount as $k=>$v) {
				$operator = $v > 0 ? '+' : '-';
				if (sizeof($tmp) == 0)$operator = '';
				$tmp[] = sprintf('%s %s(%s원)', $operator, $k, number_format(abs($v)));
			}
			return $tmp;
		}

		return $amount;
	}


	public function getCanceledCount()
	{
		$amount = 0;

		foreach ($this->getOrderItems() as $item) {
			if ($item->hasCanceled())$amount++;
		}
		return $amount;
	}

	public function getRefundedAmount()
	{
		$amount = array();

		foreach ($this->getOrderItems() as $item) {
			$amount = $amount + $item->getRefundedAmount();
		}

		return array_sum($amount);
	}

	public function getRefundedFeeAmount()
	{
		$amount = array();

		foreach ($this->getOrderItems() as $item) {
			$amount = $amount + $item->getRefundedFeeAmount();
		}

		return array_sum($amount);
	}

	public function getSettleAmount()
	{
		return $this->getAmount() + $this->getDeliveryFee() - $this->getDiscount() + $this[eggFee];
	}

	public function getRealSettleAmount()
	{
		// 최초결제금액 - 취소금액(환불예정 금액 포함)
		return $this->getSettleAmount() - $this->getCanceledAmount();
	}

	public function getDeliveryFeeDetailArray($format = false)
	{
		$delivery_fee_detail = array();

		$delivery_type_label = array(0=>'기본 배송비', 1=>'무료배송', 3=>'착불 배송비', 2=>'상품별 배송비', 4=>'고정 배송비', 5=>'수량별 배송비', );

		foreach ($this->getOrderItems() as $item) {

			/*
			 [0] : 기본배송비
			 [1] : 무료배송
			 [2] : 상품별 배송비
			 [4] : 고정 배송비
			 [5] : 수량별 배송비
			 [3] : 착불 배송비
			 */
			if (in_array($item['oi_delivery_type'], array(2, 4, 5))) {
				// 수량별 배송비는 구매 수량을 곱한다.
				$item_delivery_fee = $item['oi_delivery_type'] == 5 ? $item['oi_goods_delivery'] * $item['ea'] : $item['oi_goods_delivery'];
				$delivery_fee_detail[$delivery_type_label[$item['oi_delivery_type']]] += $item_delivery_fee;
			}

		}


		$total_item_delivery_fee = array_sum($delivery_fee_detail);
		if (($_fee = $this['delivery'] - $total_item_delivery_fee) > 0) {
			$delivery_fee_detail['기본배송비'] = $_fee;
		}

		if ($format) {
			$tmp = array();
			foreach ($delivery_fee_detail as $k=>$v) {
				$operator = '+';
				if (sizeof($tmp) == 0)$operator = '';
				$tmp[] = sprintf('%s %s(%s원)', $operator, $k, number_format($v));
			}

			return $tmp;

		}

		return $delivery_fee_detail;

	}

	public function getDeliveryFee()
	{
		return $this['delivery'];
	}

	public function getStepMsg()
	{
		return getStepMsg($this[step], $this[step2], $this[ordno]);
	}

	public function hasExchanged()
	{
		list($cnt) = $this->_db->fetch("select count(*) from " . GD_ORDER . " where oldordno='{$this[ordno]}'");

		return $cnt > 0 ? true : false;
	}


}
