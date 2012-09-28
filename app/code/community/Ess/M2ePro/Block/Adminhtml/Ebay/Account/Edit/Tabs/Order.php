<?php

/*
 * @copyright  Copyright (c) 2011 by  ESS-UA.
 */

class Ess_M2ePro_Block_Adminhtml_Ebay_Account_Edit_Tabs_Order extends Mage_Adminhtml_Block_Widget
{
    protected $_possibleMagentoStatuses = null;

    public function __construct()
    {
        parent::__construct();

        // Initialization block
        //------------------------------
        $this->setId('ebayAccountEditTabsOrder');
        //------------------------------

        $this->setTemplate('M2ePro/ebay/account/tabs/order.phtml');
    }

    protected function _beforeToHtml()
    {
        $data = Mage::helper('M2ePro')->getGlobalValue('temp_data');
        $magentoOrdersSettings = !empty($data['magento_orders_settings']) ? json_decode($data['magento_orders_settings'], true) : array();

        //----------------------------
        $temp = Mage::getModel('core/website')->getCollection()->setOrder('sort_order','ASC')->toArray();
        $this->websites = $temp['items'];
        //----------------------------

        //----------------------------
        $temp = Mage::getModel('customer/group')->getCollection()->toArray();
        $this->groups = $temp['items'];
        //----------------------------

        //----------------------------
        $selectedStore = !empty($magentoOrdersSettings['listing']['store_id']) ? $magentoOrdersSettings['listing']['store_id'] : '';
        $blockStoreSwitcher = $this->getLayout()->createBlock('M2ePro/adminhtml_storeSwitcher', '', array(
            'id' => 'magento_orders_listings_store_id',
            'name' => 'magento_orders_settings[listing][store_id]',
            'selected' => $selectedStore
        ));
        $this->setChild('magento_orders_listings_store_id', $blockStoreSwitcher);
        //----------------------------

        //----------------------------
        $selectedStore = !empty($magentoOrdersSettings['listing_other']['store_id']) ? $magentoOrdersSettings['listing_other']['store_id'] : '';
        $blockStoreSwitcher = $this->getLayout()->createBlock('M2ePro/adminhtml_storeSwitcher', '', array(
            'id' => 'magento_orders_listings_other_store_id',
            'name' => 'magento_orders_settings[listing_other][store_id]',
            'selected' => $selectedStore
        ));
        $this->setChild('magento_orders_listings_other_store_id', $blockStoreSwitcher);
        //----------------------------

        return parent::_beforeToHtml();
    }

    public function getMagentoOrderStatusList()
    {
        if (is_null($this->_possibleMagentoStatuses)) {
            $this->_possibleMagentoStatuses = Mage::getSingleton('sales/order_config')->getStatuses();
        }

        return $this->_possibleMagentoStatuses;
    }
}