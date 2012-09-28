<?php
/**
 * @category    Mana
 * @package     ManaPro_FilterShowMore
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */
/* BASED ON SNIPPET: Models/Observer */
/**
 * This class observes certain (defined in etc/config.xml) events in the whole system and provides public methods - handlers for
 * these events.
 * @author Mana Team
 *
 */
class ManaPro_FilterShowMore_Model_Observer {
	/* BASED ON SNIPPET: Models/Event handler */
	/**
	 * In case filter item list is too long, truncates it and sets a flag on whole filter to enable additional 
	 * show more/show less actions on it. 
	 * @param Varien_Event_Observer $observer
	 */
	public function limitNumberOfVisibleItems($observer) {
		/* @var $filter Mage_Catalog_Model_Layer_Filter_Abstract */ $filter = $observer->getEvent()->getFilter();
		/* @var $items Varien_Object */ $items = $observer->getEvent()->getItems();
		
		/* @var $_helper ManaPro_FilterShowMore_Helper_Data */ $_helper = Mage::helper(strtolower('ManaPro_FilterShowMore'));
		if (Mage::getStoreConfigFlag('mana_filters/display/show_more_preload')) {
			$filter->setMIsShowMoreApplied(count($items->getItems()) > $filter->getFilterOptions()->getShowMoreItemCount());
		}
		else {
			if (!$filter->getMIsShowMoreDisabled()) {
				/* @var $m Mana_Core_Helper_Data */ $m = Mage::helper(strtolower('Mana_Core'));
				$maxItemCount = $filter->getFilterOptions()->getShowMoreItemCount();
				if (count($items->getItems()) > $maxItemCount) {
					if (!$_helper->isShowAllRequested($filter)) {
						$items->setItems(array_slice($items->getItems(), 0, $maxItemCount));
					}
					$filter->setMIsShowMoreApplied(true);
				}
			}
		}
	}
	
	/* BASED ON SNIPPET: Models/Event handler */
	/**
	 * Raises flag is config value changed this module's replicated tables rely on (handles event "m_db_is_config_changed")
	 * @param Varien_Event_Observer $observer
	 */
	public function isConfigChanged($observer) {
		/* @var $result Varien_Object */ $result = $observer->getEvent()->getResult();
		/* @var $configData Mage_Core_Model_Config_Data */ $configData = $observer->getEvent()->getConfigData();
		
		Mage::helper('mana_db')->checkIfPathsChanged($result, $configData, array(
			'mana_filters/display/show_more_item_count',
		));
	}
	/* BASED ON SNIPPET: Models/Event handler */
	/**
	 * Adds columns to replication update select (handles event "m_db_update_columns")
	 * @param Varien_Event_Observer $observer
	 */
	public function prepareUpdateColumns($observer) {
		/* @var $target Mana_Db_Model_Replication_Target */ $target = $observer->getEvent()->getTarget();
		/* @var $options array */ $options = $observer->getEvent()->getOptions();
		
		switch ($target->getEntityName()) {
			case 'mana_filters/filter2_store':
				$target->getSelect('main')->columns(array(
					'global.show_more_item_count AS show_more_item_count',
				));
				break;
		}
	}
	/* BASED ON SNIPPET: Models/Event handler */
	/**
	 * Adds values to be updated (handles event "m_db_update_process")
	 * @param Varien_Event_Observer $observer
	 */
	public function processUpdate($observer) {
		/* @var $object Mana_Db_Model_Object */ $object = $observer->getEvent()->getObject();
		/* @var $values array */ $values = $observer->getEvent()->getValues();
		/* @var $options array */ $options = $observer->getEvent()->getOptions();
		
		switch ($object->getEntityName()) {
			case 'mana_filters/filter2':
				if (!Mage::helper('mana_db')->hasOverriddenValue($object, $values, 3)) {
					$object->setShowMoreItemCount(Mage::helper('mana_db')->getLatestConfig('mana_filters/display/show_more_item_count'));
				}
				break;
			case 'mana_filters/filter2_store':
				if (!Mage::helper('mana_db')->hasOverriddenValue($object, $values, 3)) {
					$object->setShowMoreItemCount($values['show_more_item_count']);
				}
				break;
		}
	}
	/* BASED ON SNIPPET: Models/Event handler */
	/**
	 * Adds columns to replication insert select (handles event "m_db_insert_columns")
	 * @param Varien_Event_Observer $observer
	 */
	public function prepareInsertColumns($observer) {
		/* @var $target Mana_Db_Model_Replication_Target */ $target = $observer->getEvent()->getTarget();
		/* @var $options array */ $options = $observer->getEvent()->getOptions();
		
		switch ($target->getEntityName()) {
			case 'mana_filters/filter2_store':
				$target->getSelect('main')->columns(array(
					'global.show_more_item_count AS show_more_item_count',
				));
				break;
		}
	}
	/* BASED ON SNIPPET: Models/Event handler */
	/**
	 * Adds values to be inserted (handles event "m_db_insert_process")
	 * @param Varien_Event_Observer $observer
	 */
	public function processInsert($observer) {
		/* @var $object Mana_Db_Model_Object */ $object = $observer->getEvent()->getObject();
		/* @var $values array */ $values = $observer->getEvent()->getValues();
		/* @var $options array */ $options = $observer->getEvent()->getOptions();
		
		switch ($object->getEntityName()) {
			case 'mana_filters/filter2':
				$object->setShowMoreItemCount(Mage::helper('mana_db')->getLatestConfig('mana_filters/display/show_more_item_count'));
				break;
			case 'mana_filters/filter2_store':
				$object->setShowMoreItemCount($values['show_more_item_count']);
				break;
		}
	}
	/* BASED ON SNIPPET: Models/Event handler */
	/**
	 * Adds fields into CRUD form (handles event "m_crud_form")
	 * @param Varien_Event_Observer $observer
	 */
	public function addFields($observer) {
		/* @var $formBlock Mana_Admin_Block_Crud_Card_Form */ $formBlock = $observer->getEvent()->getForm();
		$form = $formBlock->getForm();
		
		switch ($formBlock->getEntityName()) {
			case 'mana_filters/filter2':
			case 'mana_filters/filter2_store':
				if ($form->getId() == 'mf_general') {
					$field = $form->getElement('mfs_display')->addField('show_more_item_count', 'text', array(
						'label' => Mage::helper('manapro_filtershowmore')->__('Item Limit'),
						'name' => 'show_more_item_count',
						'required' => true,
						'default_bit' => 3,
						'default_label' => Mage::helper('mana_admin')->isGlobal() 
							? Mage::helper('manapro_filtershowmore')->__('Use System Configuration') 
							: Mage::helper('manapro_filtershowmore')->__('Same For All Stores'),
					), 'position');
					$field->setRenderer(Mage::getSingleton('core/layout')->getBlockSingleton('mana_admin/crud_card_field'));
				}
				break;
		}
	}
	/* BASED ON SNIPPET: Models/Event handler */
	/**
	 * Adds edited data received via HTTP to specified model (handles event "m_db_add_edited_data")
	 * @param Varien_Event_Observer $observer
	 */
	public function addEditedData($observer) {
		/* @var $object Mana_Db_Model_Object */ $object = $observer->getEvent()->getObject();
		/* @var $fields array */ $fields = $observer->getEvent()->getFields();
		/* @var $useDefault array */ $useDefault = $observer->getEvent()->getUseDefault();
		
		switch ($object->getEntityName()) {
			case 'mana_filters/filter2':
			case 'mana_filters/filter2_store':
				Mage::helper('mana_db')->updateDefaultableField($object, 'show_more_item_count', 3, $fields, $useDefault);
				break;
		}
	}
	/* BASED ON SNIPPET: Models/Event handler */
	/**
	 * Validates edited data (handles event "m_db_validate")
	 * @param Varien_Event_Observer $observer
	 */
	public function validate($observer) {
		/* @var $object Mana_Db_Model_Object */ $object = $observer->getEvent()->getObject();
		/* @var $result Mana_Db_Model_Validation */ $result = $observer->getEvent()->getResult();
		
        switch ($object->getEntityName()) {
            case 'mana_filters/filter2':
            case 'mana_filters/filter2_store':
                $t = Mage::helper('manapro_filtershowmore');
                if (trim($object->getShowMoreItemCount()) === '') {
                    $result->addError($t->__('Please fill in %s field', $t->__('Item Limit')));
                }
                break;
        }
	}
	
}