<?php

/*
 * @copyright  Copyright (c) 2011 by  ESS-UA.
 */

class Ess_M2ePro_Block_Adminhtml_Ebay_Listing_Product extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        parent::__construct();

        // Initialization block
        //------------------------------
        $this->setId('ebayListingProduct');
        $this->_blockGroup = 'M2ePro';
        $this->_controller = 'adminhtml_ebay_listing_product';
        //------------------------------

        // Set header text
        //------------------------------
        if (count(Mage::helper('M2ePro/Component')->getEnabledComponents()) > 1) {
            $componentName = ' ' . Ess_M2ePro_Helper_Component_Ebay::TITLE;
        } else {
            $componentName = '';
        }

        $listingData = Mage::helper('M2ePro')->getGlobalValue('temp_data');
        $headerText = Mage::helper('M2ePro')->__("Add Products To{$componentName} Listing \"%title%\" ");
        $this->_headerText = str_replace('%title%', $this->escapeHtml($listingData['title']), $headerText);
        //------------------------------

        // Set buttons actions
        //------------------------------
        $this->removeButton('back');
        $this->removeButton('reset');
        $this->removeButton('delete');
        $this->removeButton('add');
        $this->removeButton('save');
        $this->removeButton('edit');

        if (!is_null($this->getRequest()->getParam('back'))) {

            $this->_addButton('back', array(
                'label'     => Mage::helper('M2ePro')->__('Back'),
                'onclick'   => 'ProductGridHandlerObj.back_click(\''.Mage::helper('M2ePro')->getBackUrl('*/adminhtml_listing/index',array('tab' => Ess_M2ePro_Block_Adminhtml_Component_Abstract::TAB_ID_EBAY)).'\')',
                'class'     => 'back'
            ));
        }
        
        $this->_addButton('reset', array(
            'label'     => Mage::helper('M2ePro')->__('Refresh'),
            'onclick'   => 'ProductGridHandlerObj.reset_click()',
            'class'     => 'reset'
        ));

        $this->_addButton('save_and_list', array(
            'label'     => Mage::helper('M2ePro')->__('Save And List'),
            'onclick'   => 'ProductGridHandlerObj.save_and_list_click(\''.$this->getUrl('*/adminhtml_ebay_listing/product',array('id' => $listingData['id'],'back' => Mage::helper('M2ePro')->getBackUrlParam('*/adminhtml_listing/index'))).'\')',
            'class'     => 'save'
        ));

        $this->_addButton('save', array(
            'label'     => Mage::helper('M2ePro')->__('Save'),
            'onclick'   => 'ProductGridHandlerObj.save_click(\''.$this->getUrl('*/adminhtml_ebay_listing/product',array('id' => $listingData['id'],'back' => Mage::helper('M2ePro')->getBackUrlParam('*/adminhtml_listing/index',array('tab' => Ess_M2ePro_Block_Adminhtml_Component_Abstract::TAB_ID_EBAY)))).'\')',
            'class'     => 'save'
        ));
        //------------------------------
    }

    public function getGridHtml()
    {
        $helpBlock = $this->getLayout()->createBlock('M2ePro/adminhtml_ebay_listing_product_help');

        return $helpBlock->toHtml() . parent::getGridHtml();
    }
}