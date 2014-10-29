<?php
/**
 * Clib_Collection_Goods_Abstract
 * @author extacy @ godosoft development team.
 */
class Clib_Collection_Goods_Abstract extends Clib_Collection_Abstract
{
	/**
	 * {@inheritdoc}
	 */
	protected $valueModel = 'goods';

	protected function construct()
	{
		$model = $this->getValueModel();
		$this->addFilter('todaygoods', 'n');
		//$this->getResource()->group(Clib_Application::getAlias($model->getTableName()).'.'.$model->getIdColumnName());
	}

	/**
	 *
	 * @param object $categoryId
	 * @return
	 */
	public function setCategoryFilter($categoryId)
	{
		$this->addFilter('goods_link.category', Clib_Application::database()->wildcard($categoryId, 1), 'like');
	}

	/**
	 *
	 * @param string $regdt_start, $regdt_end format('Y-m-d H:i:s')
	 * @return
	 */
	public function setRegdtFilter($regdt_start, $regdt_end)
	{
		$this->addRangeFilter('regdt', array(
			$regdt_start,
			$regdt_end,
		));
	}

}
