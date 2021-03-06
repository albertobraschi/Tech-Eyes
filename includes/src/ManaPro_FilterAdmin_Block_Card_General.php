<?php
/**
 * @category    Mana
 * @package     ManaPro_FilterAdmin
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

/**
 * Enter description here ...
 * @author Mana Team
 *
 */
class ManaPro_FilterAdmin_Block_Card_General extends Mana_Admin_Block_Crud_Card_Form implements Mage_Adminhtml_Block_Widget_Tab_Interface {
	/**
     * @return Mage_Adminhtml_Block_Widget_Form
     */
    protected function _prepareForm() {
		// form - collection of fieldsets
		$form = new Varien_Data_Form(array(
			'id' => 'mf_general',
			'html_id_prefix' => 'mf_general_',
			'use_container' => true,
			'method' => 'post',
			'action' => $this->getUrl('*/*/save', array('_current' => true)),
			'field_name_suffix' => 'fields',
			'model' => Mage::registry('m_crud_model'),
		));
        /** @noinspection PhpUndefinedMethodInspection */
        Mage::helper('mana_core/js')->options('edit-form', array('subforms' => array('#mf_general' => '#mf_general')));
		
		// fieldset - collection of fields
        /** @noinspection PhpParamsInspection */
        $fieldset = $form->addFieldset('mfs_general', array(
			'title' => $this->__('General Information'),
			'legend' => $this->__('General Information'),
		));
		$fieldset->setRenderer($this->getLayout()->getBlockSingleton('mana_admin/crud_card_fieldset'));

        /** @noinspection PhpUndefinedMethodInspection */
        $field = $fieldset->addField('name', 'text', array(
			'label' => $this->__('Name'),
			'name' => 'name',
			'required' => true,
			'default_bit' => 2,
			'default_label' => Mage::helper('mana_admin')->isGlobal() 
				? $this->__('Use Product Attribute') 
				: $this->__('Use Product Attribute'),
		));
		$field->setRenderer($this->getLayout()->getBlockSingleton('mana_admin/crud_card_field'));
		
		$field = $fieldset->addField('is_enabled', 'select', array(
			'label' => $this->__('In Category'),
			'name' => 'is_enabled',
			'required' => true,
			'options' => Mage::getSingleton('mana_filters/source_filterable')->getOptionArray(),
			'default_bit' => 0,
			'default_label' => Mage::helper('mana_admin')->isGlobal() 
				? $this->__('Use Product Attribute') 
				: $this->__('Same For All Stores'),
		));
        /** @noinspection PhpParamsInspection */
        $field->setRenderer($this->getLayout()->getBlockSingleton('mana_admin/crud_card_field'));

        /** @noinspection PhpUndefinedMethodInspection */
        $field = $fieldset->addField('is_enabled_in_search', 'select', array(
			'label' => $this->__('In Search'),
			'name' => 'is_enabled_in_search',
			'required' => true,
			'options' => Mage::getSingleton('mana_filters/source_filterable')->getOptionArray(),
			'default_bit' => 4,
			'default_label' => Mage::helper('mana_admin')->isGlobal() 
				? $this->__('Use Product Attribute') 
				: $this->__('Same For All Stores'),
		));
		$field->setRenderer($this->getLayout()->getBlockSingleton('mana_admin/crud_card_field'));
		
		// fieldset - collection of fields
        /** @noinspection PhpParamsInspection */
		$fieldset = $form->addFieldset('mfs_display', array(
			'title' => $this->__('Display Settings'),
			'legend' => $this->__('Display Settings'),
		));
		$fieldset->setRenderer($this->getLayout()->getBlockSingleton('mana_admin/crud_card_fieldset'));

        $field = $fieldset->addField('display', 'select', array(
			'label' => $this->__('Display'),
			'name' => 'display',
			'required' => true,
			'options' => Mage::getSingleton('mana_filters/source_display_'.$form->getModel()->getType())->getOptionArray(),
			'default_bit' => 1,
			'default_label' => Mage::helper('mana_admin')->isGlobal() 
				? $this->__('Use System Configuration') 
				: $this->__('Same For All Stores'),
		));
        /** @noinspection PhpParamsInspection */
        $field->setRenderer($this->getLayout()->getBlockSingleton('mana_admin/crud_card_field'));
		
		$field = $fieldset->addField('position', 'text', array(
			'label' => $this->__('Position'),
			'name' => 'position',
			'required' => true,
			'default_bit' => 5,
			'default_label' => Mage::helper('mana_admin')->isGlobal() 
				? $this->__('Use Product Attribute') 
				: $this->__('Same For All Stores'),
		));
		$field->setRenderer($this->getLayout()->getBlockSingleton('mana_admin/crud_card_field'));

        if ($form->getModel()->getType() == 'attribute') {
            $fieldset->addField('sort_method', 'select', array(
                'label' => $this->__('Sort Items By'),
                'name' => 'sort_method',
                'options' => Mage::getSingleton('mana_filters/sort')->getOptionArray(),
                'required' => true,
                'default_bit' => 25,
                'default_label' => Mage::helper('mana_admin')->isGlobal()
                    ? $this->__('Use System Configuration')
                    : $this->__('Same For All Stores'),
            ))->setRenderer($this->getLayout()->getBlockSingleton('mana_admin/crud_card_field'));
        }
        // result
        $this->setForm($form);
        return parent::_prepareForm();
	}

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	// TAB PROPERTIES
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	/**
     * Return Tab label
     *
     * @return string
     */
    public function getTabLabel() {
    	return $this->__('General');
    }
    /**
     * Return Tab title
     *
     * @return string
     */
    public function getTabTitle() {
    	return $this->__('General');
    }
    /**
     * Can show tab in tabs
     *
     * @return boolean
     */
    public function canShowTab() {
    	return true;
    }
    /**
     * Tab is hidden
     *
     * @return boolean
     */
    public function isHidden() {
    	return false;
    }
    public function getAjaxUrl() {
    	return Mage::helper('mana_admin')->getStoreUrl('*/*/tabGeneral', 
			array('id' => Mage::app()->getRequest()->getParam('id')), 
			array('ajax' => 1)
		);
    }
}