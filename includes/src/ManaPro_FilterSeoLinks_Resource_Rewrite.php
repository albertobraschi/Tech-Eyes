<?php
/**
 * @category    Mana
 * @package     ManaPro_FilterSeoLinks
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

/**
 * SQL Selects for SEO friendly layered navigation URLs
 * @author Mana Team
 *
 */
class ManaPro_FilterSeoLinks_Resource_Rewrite extends Mage_Core_Model_Mysql4_Url_Rewrite {
	public function isFilterName($name) {
		Mana_Core_Profiler::start('mln', __CLASS__, __METHOD__, $name);
		/* @var $core Mana_Core_Helper_Data */ $core = Mage::helper(strtolower('Mana_Core'));
		/* @var $helper Mana_Filters_Helper_Data */ $helper = Mage::helper(strtolower('Mana_Filters'));
		$result = $core->collectionFind($helper->getFilterOptionsCollection(true), 'code', $name) != false;
		///* @var $select Varien_Db_Select */ $select = $this->_getReadAdapter()->select();
		//$select 
		//	->from(array('a' => $this->_resources->getTableName('eav_attribute')), 'attribute_id')
		//	->join(array('t' => $this->_resources->getTableName('eav_entity_type')), 't.entity_type_id = a.entity_type_id', null)
		//	->where('a.attribute_code = ?', $name)
		//	->where('t.entity_type_code = ?', 'catalog_product');
		//$result = $this->_getReadAdapter()->fetchOne($select) != '';
		Mana_Core_Profiler::stop('mln', __CLASS__, __METHOD__, $name);
		return $result;
	}
	public function getFilterName($candidates) {
		/* @var $core Mana_Core_Helper_Data */ $core = Mage::helper(strtolower('Mana_Core'));
		/* @var $helper Mana_Filters_Helper_Data */ $helper = Mage::helper(strtolower('Mana_Filters'));
		$collection = $helper->getFilterOptionsCollection(true);
		foreach ($collection as $item) {
			if (in_array(strtolower($item->getCode()), $candidates)) {
				return $item->getCode();
			}
		}
		return false;
		///* @var $select Varien_Db_Select */ $select = $this->_getReadAdapter()->select();
		//$select 
		//	->from(array('a' => $this->_resources->getTableName('eav_attribute')), 'attribute_code')
		//	->join(array('t' => $this->_resources->getTableName('eav_entity_type')), 't.entity_type_id = a.entity_type_id', null)
		//	->where('a.attribute_code IN (?)', $candidates)
		//	->where('t.entity_type_code = ?', 'catalog_product');
		//return $this->_getReadAdapter()->fetchOne($select);
	}
	
	public function getCategoryValue($model, $urlKey) {
		Mana_Core_Profiler::start('mln', __CLASS__, __METHOD__, 'select');
		$path = $this->_getReadAdapter()->fetchOne("SELECT path FROM {$this->_resources->getTableName('catalog_category_entity')} WHERE entity_id = ?", $model->getCategoryId());
		/* @var $select Varien_Db_Select */ $select = $this->_getReadAdapter()->select();
		$select
			->from(array('e' => $this->_resources->getTableName('catalog_category_entity')), 'entity_id')
			->join(array('v' => $this->_resources->getTableName('catalog_category_entity_varchar')), 'v.entity_id = e.entity_id', null)
			->join(array('a' => $this->_resources->getTableName('eav_attribute')), 'a.attribute_id = v.attribute_id', null)
			->join(array('t' => $this->_resources->getTableName('eav_entity_type')), 't.entity_type_id = a.entity_type_id', null)
			->where('LOWER(v.value) = ?', $urlKey)
			->where('t.entity_type_code = ?', 'catalog_category')
			->where('a.attribute_code = ?', 'url_key')
			->where('e.path LIKE ?', $path.'/%')
			->where('v.store_id IN (?)', array(0, $model->getStoreId()));
		$result = $this->_getReadAdapter()->fetchOne($select);
		Mana_Core_Profiler::stop('mln', __CLASS__, __METHOD__, 'select');
		return $result;
	}
	
	public function getFilterValue($model, $name, $candidates) {
		/* @var $core Mana_Core_Helper_Data */ $core = Mage::helper(strtolower('Mana_Core'));
		/* @var $helper Mana_Filters_Helper_Data */ $helper = Mage::helper(strtolower('Mana_Filters'));
		if (!$filter = $core->collectionFind($helper->getFilterOptionsCollection(true), 'code', $name)) {
			return $candidates[0];
		}
		$attribute = $filter->getAttribute();
		///* @var $select Varien_Db_Select */ $select = $this->_getReadAdapter()->select();
		//$select
		//	->from(array('a' => $this->_resources->getTableName('eav_attribute')), array('attribute_id', 'backend_model', 'source_model', 'backend_type', 'frontend_input'))
		//	->join(array('t' => $this->_resources->getTableName('eav_entity_type')), 't.entity_type_id = a.entity_type_id', null)
		//	->where('a.attribute_code = ?', $name)
		//	->where('t.entity_type_code = ?', 'catalog_product');
		//$attribute = $this->_getReadAdapter()->fetchRow($select);
			
		/* @var $select Varien_Db_Select */ $select = $this->_getReadAdapter()->select();
		if ($attribute->getData('backend_model') == 'eav/entity_attribute_backend_array' || $attribute->getData('source_model') == 'eav/entity_attribute_source_table' || $attribute->getData('frontend_input') == 'select' && !$attribute->getData('source_model')) {
			Mana_Core_Profiler::start('mln', __CLASS__, __METHOD__, 'select');
			$select
				->from(array('o' => $this->_resources->getTableName('eav_attribute_option')), 'option_id')
				->join(array('v' => $this->_resources->getTableName('eav_attribute_option_value')), 'o.option_id = v.option_id', null)
				->where('LOWER(v.value) IN (?)', $candidates)
				->where('o.attribute_id = ?', $attribute->getId())
				->where('v.store_id IN (?)', array(0, $model->getStoreId()));
			$result = $this->_getReadAdapter()->fetchOne($select);
			Mana_Core_Profiler::stop('mln', __CLASS__, __METHOD__, 'select');
			return $result;
		}
		else {
			return $candidates[0];
		}
	}
	public function getCategoryLabel($categoryId) {
		/* @var $select Varien_Db_Select */ $select = $this->_getReadAdapter()->select();
		$select
			->from(array('e' => $this->_resources->getTableName('catalog_category_entity')), null)
			->join(array('v' => $this->_resources->getTableName('catalog_category_entity_varchar')), 'v.entity_id = e.entity_id', 'LOWER(value)')
			->join(array('a' => $this->_resources->getTableName('eav_attribute')), 'a.attribute_id = v.attribute_id', null)
			->join(array('t' => $this->_resources->getTableName('eav_entity_type')), 't.entity_type_id = a.entity_type_id', null)
			->where('e.entity_id = ?', $categoryId)
			->where('t.entity_type_code = ?', 'catalog_category')
			->where('a.attribute_code = ?', 'url_key')
			->where('v.store_id IN (?)', array(0, Mage::app()->getStore()->getId()));
		return $this->_getReadAdapter()->fetchOne($select);
	}
	public function getFilterValueLabel($code, $value) {
		/* @var $core Mana_Core_Helper_Data */ $core = Mage::helper(strtolower('Mana_Core'));
		/* @var $helper Mana_Filters_Helper_Data */ $helper = Mage::helper(strtolower('Mana_Filters'));
		$attribute = $core->collectionFind($helper->getFilterOptionsCollection(true), 'code', $code)->getAttribute();
		///* @var $select Varien_Db_Select */ $select = $this->_getReadAdapter()->select();
		//$select
		//	->from(array('a' => $this->_resources->getTableName('eav_attribute')), array('attribute_id', 'backend_model', 'source_model', 'backend_type', 'frontend_input'))
		//	->join(array('t' => $this->_resources->getTableName('eav_entity_type')), 't.entity_type_id = a.entity_type_id', null)
		//	->where('a.attribute_code = ?', $code)
		//	->where('t.entity_type_code = ?', 'catalog_product');
		//$attribute = $this->_getReadAdapter()->fetchRow($select);
			
		/* @var $select Varien_Db_Select */ $select = $this->_getReadAdapter()->select();
		if ($attribute->getData('backend_model') == 'eav/entity_attribute_backend_array' || $attribute->getData('source_model') == 'eav/entity_attribute_source_table' || $attribute->getData('frontend_input') == 'select' && !$attribute->getData('source_model')) {
			/* @var $core Mana_Core_Helper_Data */ $core = Mage::helper(strtolower('Mana_Core'));
			$select
				->from(array('o' => $this->_resources->getTableName('eav_attribute_option')), null)
				->join(array('v' => $this->_resources->getTableName('eav_attribute_option_value')), 'o.option_id = v.option_id', 'LOWER(value)')
				->where('o.option_id = ?', $value)
				->where('o.attribute_id = ?', $attribute->getData('attribute_id'))
				->where('v.store_id IN (?)', array(0, Mage::app()->getStore()->getId()));
			return $core->labelToUrl($this->_getReadAdapter()->fetchOne($select));
		}
		else {
			return $value;
		}
	}
}