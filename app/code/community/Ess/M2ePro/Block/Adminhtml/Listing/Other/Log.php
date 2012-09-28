<?php

/*
 * @copyright  Copyright (c) 2011 by  ESS-UA.
 */

class Ess_M2ePro_Block_Adminhtml_Listing_Other_Log extends Ess_M2ePro_Block_Adminhtml_Component_Tabs_Container
{
    public function __construct()
    {
        parent::__construct();

        // Set header text
        //------------------------------
        $otherListingData = Mage::helper('M2ePro')->getGlobalValue('temp_data');

        if (isset($otherListingData['id'])) {

            $component = '';

            if (count(Mage::helper('M2ePro/Component')->getEnabledComponents()) > 1) {
                $otherListingData['component_mode'] == Ess_M2ePro_Helper_Component_Ebay::NICK   && $component = ' ' . Ess_M2ePro_Helper_Component_Ebay::TITLE;
                $otherListingData['component_mode'] == Ess_M2ePro_Helper_Component_Amazon::NICK && $component = ' ' . Ess_M2ePro_Helper_Component_Amazon::TITLE;
            }

            if ($otherListingData['component_mode'] == Ess_M2ePro_Helper_Component_Ebay::NICK) {
                $this->disableAmazonTab();
            } else if ($otherListingData['component_mode'] == Ess_M2ePro_Helper_Component_Amazon::NICK) {
                $this->disableEbayTab();
            }

            // Parser hack -> Mage::helper('M2ePro')->__('Log For eBay 3rd Party Listing');
            // Parser hack -> Mage::helper('M2ePro')->__('Log For Amazon 3rd Party Listing');
            $this->_headerText = Mage::helper('M2ePro')->__("Log For{$component} 3rd Party Listing");
            $this->_headerText .= ' "' . $this->escapeHtml($otherListingData['id']) . '"';

        } else {
            $this->_headerText = Mage::helper('M2ePro')->__('3rd Party Listings Log');
        }
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
                'onclick'   => 'CommonHandlerObj.back_click(\''.Mage::helper('M2ePro')->getBackUrl('*/adminhtml_listingOther/index').'\')',
                'class'     => 'back'
            ));
        }

        $this->_addButton('goto_ebay_listings', array(
            'label'     => Mage::helper('M2ePro')->__('3rd Party Listings'),
            'onclick'   => 'setLocation(\'' .$this->getUrl('*/adminhtml_listingOther/index').'\')',
            'class'     => 'button_link'
        ));

        $this->_addButton('goto_logs_cleaning', array(
            'label'     => Mage::helper('M2ePro')->__('Clearing'),
            'onclick'   => 'setLocation(\'' .$this->getUrl('*/adminhtml_logCleaning/index',array('back'=>Mage::helper('M2ePro')->makeBackUrlParam('*/adminhtml_log/listingOther'))).'\')',
            'class'     => 'button_link'
        ));

        $this->_addButton('reset', array(
            'label'     => Mage::helper('M2ePro')->__('Refresh'),
            'onclick'   => 'CommonHandlerObj.reset_click()',
            'class'     => 'reset'
        ));

        if (isset($otherListingData['id'])) {

            $this->_addButton('show_general_log', array(
                'label'     => Mage::helper('M2ePro')->__('Show General Log'),
                'onclick'   => 'setLocation(\'' .$this->getUrl('*/*/*').'\')',
                'class'     => 'show_general_log'
            ));
        }
        //------------------------------
    }

    // ########################################

    protected function getEbayTabBlock()
    {
        if (is_null($this->ebayTabBlock)) {
            $this->ebayTabBlock = $this->getLayout()->createBlock('M2ePro/adminhtml_ebay_listing_other_log_grid');
        }
        return $this->ebayTabBlock;
    }

    protected function getAmazonTabBlock()
    {
        if (is_null($this->amazonTabBlock)) {
            $this->amazonTabBlock = $this->getLayout()->createBlock('M2ePro/adminhtml_amazon_listing_other_log_grid');
        }
        return $this->amazonTabBlock;
    }

    // ########################################

    protected function _componentsToHtml()
    {
        $helpBlock = $this->getLayout()->createBlock('M2ePro/adminhtml_listing_other_log_help');
        return $helpBlock->toHtml() . parent::_componentsToHtml();
    }

    // ########################################
}