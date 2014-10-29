<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Copyright (c) 2013 GODO Co. Ltd
 * All right reserved.
 *
 * This software is the confidential and proprietary information of GODO Co., Ltd.
 * You shall not disclose such Confidential Information and shall use it only in accordance
 * with the terms of the license agreement  you entered into with GODO Co., Ltd
 *
 * Revision History
 * Author            Date              Description
 * ---------------   --------------    ------------------
 * workingparksee    2013.09.25        First Draft.
 */

/**
 * Description of Mobile2GoodsDisplay
 *
 * @author Mobile2GoodsDisplay.class.php workingparksee <parksee@godo.co.kr>
 * @version 1.0
 * @date 2013-09-25, 2013-09-25
 */
class Mobile2GoodsDisplay
{

	private $_dbo, $temporaryDesignData = array(), $_mobileShopConfig;

	function __construct()
	{
		@include dirname(__FILE__).'/../conf/config.mobileShop.php';
		$this->_dbo = Core::loader('GODO_DB');
		$this->_mobileShopConfig = $cfgMobileShop;
	}

	function initializeMainDisplay()
	{
		$designData = $this->_dbo->_select('SELECT * FROM gd_mobile_design WHERE page_type="main" ORDER BY mdesign_no ASC');

		if(empty($designData)) {

			$design1 = Array();

			$design1['page_type'] = 'main';
			$design1['chk'] = 'on';
			$design1['title'] = '신상품';
			$design1['line_cnt'] = '';
			$design1['disp_cnt'] = '';
			$design1['banner_width'] = '';
			$design1['banner_height'] = '';
			$design1['tpl'] = '';
			$design1['tpl_opt'] = '';

			$insertDesignQuery = $this->_dbo->_query_print('INSERT INTO gd_mobile_design SET [cv]', $design1);
			$this->_dbo->query($insertDesignQuery);
			$design1['mdesign_no'] = $this->_dbo->_last_insert_id();
			unset($insertDesignQuery);

			$designData[] = $design1;

			$design2 = Array();

			$design2['page_type'] = 'main';
			$design2['chk'] = 'on';
			$design2['title'] = '인기상품';
			$design2['line_cnt'] = '';
			$design2['disp_cnt'] = '';
			$design2['banner_width'] = '';
			$design2['banner_height'] = '';
			$design2['tpl'] = '';
			$design2['tpl_opt'] = '';

			$insertDesignQuery = $this->_dbo->_query_print('INSERT INTO gd_mobile_design SET [cv]', $design2);
			$this->_dbo->query($insertDesignQuery);
			$design2['mdesign_no'] = $this->_dbo->_last_insert_id();
			unset($insertDesignQuery);

			$designData[] = $design2;
		}
		return $designData;
	}

	function getDesignData($displayNo)
	{
		if (!isset($this->temporaryDesignData[$displayNo]) || !is_array($this->temporaryDesignData[$displayNo])) {
			$designQuery = $this->_dbo->_query_print('SELECT * FROM gd_mobile_design WHERE page_type="main" AND mdesign_no=[i] LIMIT 1', $displayNo);
			$this->temporaryDesignData[$displayNo] = $this->_dbo->fetch($designQuery, true);
		}
		return $this->temporaryDesignData[$displayNo];
	}
	
	function isInitStatus()
	{
		$mobileDesign = $this->_dbo->fetch('SELECT COUNT(mdesign_no) AS cnt FROM gd_mobile_design WHERE page_type="main"', true);
		if ($mobileDesign['cnt'] == 0) {
			return true;
		}
		else if ($mobileDesign['cnt'] == 2) {
			if ($this->designModified(1) || $this->designModified(2)) return false;
			else return true;
		}
		else {
			return false;
		}
	}


	function isPCDIsplay()
	{
		return ($this->_mobileShopConfig['vtype_main'] === 'pc');
	}

	function isMobileDisplay()
	{
		return ($this->_mobileShopConfig['vtype_main'] === 'mobile');
	}

	function displayTypeIsSet()
	{
		return isset($this->_mobileShopConfig['vtype_main']);
	}

	function saveMainDisplayType($displayType)
	{
		include dirname(__FILE__).'/lib/qfile.class.php';
		@include dirname(__FILE__).'/../conf/config.mobileShop.php';

		if (!$cfgMobileShop) return false;

		if ($displayType === 'pc') $cfgMobileShop['vtype_main'] = 'pc';
		else $cfgMobileShop['vtype_main'] = 'mobile';

		$qfile = new qfile();
		$qfile->open(dirname(__FILE__).'/../conf/config.mobileShop.php');
		$qfile->write("<? \n");
		$qfile->write("\$cfgMobileShop = array( \n");
		foreach ($cfgMobileShop as $key => $value) {
			$qfile->write("'$key' => '$value', \n");
		}
		$qfile->write(") \n;");
		$qfile->write("?>");
		$qfile->close();
		
		@include dirname(__FILE__).'/../conf/config.mobileShop.php';
		$this->_mobileShopConfig = $cfgMobileShop;
	}

	function designModified($displayNo)
	{
		$designData = $this->getDesignData($displayNo);
		if ($designData['line_cnt'] == '0' && $designData['disp_cnt'] == '0' && $designData['display_type'] == '' && $designData['tpl'] == '') {
			return false;
		}
		else {
			return true;
		}
	}
	
	function getDisplaySequence($mdesignNo)
	{
		$this->_dbo->query('SET @SEQUENCE =  0');
		$result = $this->_dbo->fetch('
			SELECT seqmap.sequence FROM (
				SELECT @SEQUENCE := @SEQUENCE + 1 AS sequence, mdesign_no
				FROM gd_mobile_design
				WHERE page_type="main"
				ORDER BY mdesign_no ASC
			) AS seqmap WHERE seqmap.mdesign_no = '.$mdesignNo.' LIMIT 1
		', true);
		return $result['sequence'];
	}
	
	function getPCDesignData($index)
	{
		$config = Core::loader('config');
		$cfg = $config->load('config');
		@include dirname(__FILE__).'/../conf/design_main.'.$cfg['tplSkin'].'.php';
		$cfg_step_key = array_keys($cfg_step);
		return $cfg_step[$cfg_step_key[$index]];
	}

	function makeDefaultMainDisplayDesign($mdesignNo, &$design)
	{
		$displaySequence = $this->getDisplaySequence($mdesignNo);
		$pcDesignData = $this->getPCDesignData($displaySequence-1);
		if ($design['chk'] == 'on') {
			$design['tpl'] = 'tpl_03';
			$design['title'] = $pcDesignData['title'];
			$design['display_type'] = '1';
			$design['line_cnt'] = '2';
			$design['disp_cnt'] = '3';
			return true;
		}
		else {
			return false;
		}
	}

	function getPCMainDisplayGoods($mdesignNo, $isAdmin = false)
	{
		$config = Core::loader('config');
		$cfg = $config->load('config');
		@include dirname(__FILE__).'/../conf/design_main.'.$cfg['tplSkin'].'.php';
		$cfg_step_key = array_keys($cfg_step);
		$displaySequence = $this->getDisplaySequence($mdesignNo);
		$displayGoods = array();
		$goodsDisplayQuery = $this->_dbo->_query_print('
			SELECT gd.goodsno, g.goodsnm, g.img_mobile, g.img_l, g.img_m, go.price, g.use_only_adult
			FROM gd_goods_display AS gd
			LEFT JOIN gd_goods AS g ON gd.goodsno=g.goodsno
			LEFT JOIN gd_goods_option AS go ON g.goodsno=go.goodsno AND go_is_deleted <> "1"
			WHERE gd.mode=[s] '.($isAdmin ? '' : 'AND g.open_mobile').' AND go.link=1
			ORDER BY gd.sort ASC
		', $cfg_step_key[$displaySequence-1]);
		$res = $this->_dbo->query($goodsDisplayQuery);
		while ($row = $this->_dbo->fetch($res, true)) {
			$goodsImagePrefix = '/shop/data/goods/';
			$zoomImage = array_notnull(explode('|', $row['img_l']));
			if (count($zoomImage)) {
				if (preg_match('/^http:\/\//i', $zoomImage[0])) $goodsImg = $zoomImage[0];
				else $goodsImg = $goodsImagePrefix.$zoomImage[0];
			}
			else {
				$detailImage = array_notnull(explode('|', $row['img_m']));
				if (preg_match('/^http:\/\//i', $detailImage[0])) $goodsImg = $detailImage[0];
				else $goodsImg = $goodsImagePrefix.$detailImage[0];
			}
			if($row['use_only_adult'] == '1' && !Clib_Application::session()->canAccessAdult()){
				$goodsImg = 'http://' . $_SERVER['HTTP_HOST'] . $cfg['rootDir'] . "/data/skin/" . $cfg['tplSkin'] . '/img/common/19.gif';
			}
			$displayGoods[] = array(
			    'goods_img' => $goodsImg,
			    'goods_price' => number_format($row['price']).' 원',
			    'goodsnm' => $row['goodsnm'],
			    'goodsno' => $row['goodsno'],
			);
		}
		return $displayGoods;
	}

}

?>
