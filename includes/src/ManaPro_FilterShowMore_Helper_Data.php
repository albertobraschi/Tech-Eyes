<?php
/**
 * @category    Mana
 * @package     ManaPro_FilterShowMore
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */
/* BASED ON SNIPPET: New Module/Helper/Data.php */
/**
 * Generic helper functions for ManaPro_FilterShowMore module. This class is a must for any module even if empty.
 * @author Mana Team
 */
class ManaPro_FilterShowMore_Helper_Data extends Mage_Core_Helper_Abstract {
	public function getShowAllSuffix() {
        /* @var $_core Mana_Core_Helper_Data */ $_core = Mage::helper(strtolower('Mana_Core'));
		return $_core->getStoreConfig('mana_filters/seo/show_all_suffix');
	}
	/**
	 * Returns true if all the items show be shown for that filter (as specified in URL) and false if item list
	 * should be truncated
	 * @param Mana_Filters_Model_Filter_Attribute $filter
	 * @return boolean
	 */
	public function isShowAllRequested($filter) {
    	$value = Mage::app()->getRequest()->getParam($filter->getRequestVar().$this->getShowAllSuffix());
		return $value && $value == 1 ? true : false;    
	}
	/**
	 * Returns current URL modified to enable showing full item list 
	 * @param Mana_Filters_Model_Filter_Attribute $filter
	 * @return string
	 */
	public function getShowMoreUrl($filter) {
    	/* @var $ext Mana_Filters_Helper_Extended */ $ext = Mage::helper(strtolower('Mana_Filters/Extended'));
        $params = array('_secure' => Mage::app()->getFrontController()->getRequest()->isSecure());
		$params['_current']     = true;
        $params['_use_rewrite'] = true;
        $params['_query']       = array($filter->getRequestVar().$this->getShowAllSuffix() => 1);
        return Mage::helper('mana_filters')->markLayeredNavigationUrl(Mage::getUrl('*/*/*', $params), '*/*/*', $params);
	}
	/**
	 * Returns current URL modified to enable showing truncated item list 
	 * @param Mana_Filters_Model_Filter_Attribute $filter
	 * @return string
	 */
	public function getShowLessUrl($filter) {
    	/* @var $ext Mana_Filters_Helper_Extended */ $ext = Mage::helper(strtolower('Mana_Filters/Extended'));
        $params = array('_secure' => Mage::app()->getFrontController()->getRequest()->isSecure());
		$params['_current']     = true;
        $params['_use_rewrite'] = true;
        $params['_query']       = array($filter->getRequestVar().$this->getShowAllSuffix() => null);
        return Mage::helper('mana_filters')->markLayeredNavigationUrl(Mage::getUrl('*/*/*', $params), '*/*/*', $params);
	}
}