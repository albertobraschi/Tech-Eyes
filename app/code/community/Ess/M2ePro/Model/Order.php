<?php

/*
 * @copyright  Copyright (c) 2011 by  ESS-UA.
 */

class Ess_M2ePro_Model_Order extends Ess_M2ePro_Model_Component_Parent_Abstract
{
    // Parser hack -> Mage::helper('M2ePro')->__('Store does not exist.');
    // Parser hack -> Mage::helper('M2ePro')->__('Payment method "M2E Pro Payment" is not enabled. Please enable it in magento system configuration.');
    // Parser hack -> Mage::helper('M2ePro')->__('Shipping method "M2E Pro Shipping" is not enabled. Please enable it in magento system configuration.');
    // Parser hack -> Mage::helper('M2ePro')->__('Magento Order was not created. Reason: %msg%');
    // Parser hack -> Mage::helper('M2ePro')->__('Magento Order was created.');
    // Parser hack -> Mage::helper('M2ePro')->__('Magento Order was created with error: %msg%');
    // Parser hack -> Mage::helper('M2ePro')->__('Payment Transaction was not created. Reason: %msg%');
    // Parser hack -> Mage::helper('M2ePro')->__('Invoice was not created. Reason: %msg%');
    // Parser hack -> Mage::helper('M2ePro')->__('Invoice was created.');
    // Parser hack -> Mage::helper('M2ePro')->__('Shipment was not created. Reason: %msg%');
    // Parser hack -> Mage::helper('M2ePro')->__('Shipment was created.');
    // Parser hack -> Mage::helper('M2ePro')->__('Tracking details were not imported. Reason: %msg%');
    // Parser hack -> Mage::helper('M2ePro')->__('Tracking details were imported.');
    const LOG_STORE_MISSING                     = 'Store does not exist.';
    const LOG_PAYMENT_METHOD_DISABLED           = 'Payment method "M2E Pro Payment" is not enabled. Please enable it in magento system configuration.';
    const LOG_SHIPPING_METHOD_DISABLED          = 'Shipping method "M2E Pro Shipping" is not enabled. Please enable it in magento system configuration.';
    const LOG_IMPORT_ORDER_FAILED               = 'Magento Order was not created. Reason: %msg%';
    const LOG_IMPORT_ORDER_SUCCEEDED            = 'Magento Order was created.';
    const LOG_IMPORT_ORDER_SUCCEEDED_WITH_ERROR = 'Magento Order was created with error: %msg%';
    const LOG_IMPORT_TRANSACTION_FAILED         = 'Payment Transaction was not created. Reason: %msg%';
    const LOG_IMPORT_INVOICE_FAILED             = 'Invoice was not created. Reason: %msg%';
    const LOG_IMPORT_INVOICE_SUCCEEDED          = 'Invoice was created.';
    const LOG_IMPORT_SHIPMENT_FAILED            = 'Shipment was not created. Reason: %msg%';
    const LOG_IMPORT_SHIPMENT_SUCCEEDED         = 'Shipment was created.';
    const LOG_IMPORT_TRACK_FAILED               = 'Tracking details were not imported. Reason: %msg%';
    const LOG_IMPORT_TRACK_SUCCEEDED            = 'Tracking details were imported.';

    // ########################################

    private $account = NULL;

    private $marketplace = NULL;

    private $magentoOrder = NULL;

    private $itemsCollection = NULL;

    private $logsCollection = NULL;

    private $proxy = NULL;

    // ########################################

    public function _construct()
    {
        parent::_construct();
        $this->_init('M2ePro/Order');
    }

    /**
     * @return Ess_M2ePro_Model_Ebay_Order|Ess_M2ePro_Model_Amazon_Order
     */
    public function getChildObject()
    {
        return parent::getChildObject();
    }

    // ########################################

    public function deleteInstance()
    {
        if ($this->isLocked()) {
            return false;
        }

        foreach ($this->getLogsCollection()->getItems() as $log) {
            /** @var $log Ess_M2ePro_Model_Order_Log */
            $log->deleteInstance();
        }

        foreach ($this->getItemsCollection()->getItems() as $item) {
            /** @var $item Ess_M2ePro_Model_Order_Item */
            $item->deleteInstance();
        }

        $this->deleteChildInstance();

        $this->account = NULL;
        $this->magentoOrder = NULL;
        $this->itemsCollection = NULL;
        $this->logsCollection = NULL;
        $this->proxy = NULL;

        $this->delete();

        return true;
    }

    // ########################################

    public function getAccountId()
    {
        return $this->getData('account_id');
    }

    public function getMarketplaceId()
    {
        return $this->getData('marketplace_id');
    }

    public function getMagentoOrderId()
    {
        return $this->getData('magento_order_id');
    }

    public function getStoreId()
    {
        return $this->getData('store_id');
    }

    // ########################################

    /**
     * @throws LogicException
     * @return Ess_M2ePro_Model_Account
     */
    public function getAccount()
    {
        if (is_null($this->account)) {
            $this->account = Mage::helper('M2ePro/Component')->getComponentObject($this->getComponentMode(), 'Account', $this->getAccountId());
        }

        return $this->account;
    }

    /**
     * @throws LogicException
     * @return Ess_M2ePro_Model_Marketplace
     */
    public function getMarketplace()
    {
        if (is_null($this->marketplace)) {
            $this->marketplace = Mage::helper('M2ePro/Component')->getComponentObject($this->getComponentMode(), 'Marketplace', $this->getMarketplaceId());
        }

        return $this->marketplace;
    }

    // ########################################

    /**
     * @return Mage_Core_Model_Mysql4_Collection_Abstract
     */
    public function getItemsCollection()
    {
        if (is_null($this->itemsCollection)) {
            $this->itemsCollection = Mage::helper('M2ePro/Component')->getComponentCollection($this->getComponentMode(), 'Order_Item');
            $this->itemsCollection->addFieldToFilter('order_id', $this->getId());

            foreach ($this->itemsCollection as $item) {
                /** @var $item Ess_M2ePro_Model_Order_Item */
                $item->setOrder($this);
            }
        }

        return $this->itemsCollection;
    }

    // ---------------------------------------

    /**
     * @return bool
     */
    public function isSingle()
    {
        return $this->getItemsCollection()->count() == 1;
    }

    /**
     * @return bool
     */
    public function isCombined()
    {
        return $this->getItemsCollection()->count() > 1;
    }

    // ---------------------------------------

    public function hasListingItems()
    {
        $relatedChannelItems = $this->getChildObject()->getRelatedChannelItems();

        return count($relatedChannelItems) > 0;
    }

    public function hasOtherListingItems()
    {
        $relatedChannelItems = $this->getChildObject()->getRelatedChannelItems();

        return count($relatedChannelItems) != $this->getItemsCollection()->count();
    }

    // ########################################

    /**
     * @return Ess_M2ePro_Model_Mysql4_Order_Log_Collection
     */
    public function getLogsCollection()
    {
        if (is_null($this->logsCollection)) {
            $this->logsCollection = Mage::getModel('M2ePro/Order_Log')->getCollection();
            $this->logsCollection->addFieldToFilter('order_id', $this->getId());
        }

        return $this->logsCollection;
    }

    // ---------------------------------------

    public function addSuccessLog($message)
    {
        Mage::getModel('M2ePro/Order_Log')->addSuccess($this->getComponentMode(), $this->getId(), $message);
    }

    public function addNoticeLog($message)
    {
        Mage::getModel('M2ePro/Order_Log')->addNotice($this->getComponentMode(), $this->getId(), $message);
    }

    public function addWarningLog($message)
    {
        Mage::getModel('M2ePro/Order_Log')->addWarning($this->getComponentMode(), $this->getId(), $message);
    }

    public function addErrorLog($message)
    {
        Mage::getModel('M2ePro/Order_Log')->addError($this->getComponentMode(), $this->getId(), $message);
    }

    // ---------------------------------------

    public function makeLog($message, array $params = array())
    {
        return Mage::getSingleton('M2ePro/Log_Abstract')->encodeDescription($message, $params);
    }

    // ########################################

    /**
     * @return null|Mage_Sales_Model_Order
     */
    public function getMagentoOrder()
    {
        if (is_null($this->getMagentoOrderId())) {
            return NULL;
        }

        if (is_null($this->magentoOrder)) {
            $this->magentoOrder = Mage::getModel('sales/order')->load($this->getMagentoOrderId());
        }

        return !is_null($this->magentoOrder->getId()) ? $this->magentoOrder : NULL;
    }

    // ########################################

    /**
     * @return Ess_M2ePro_Model_Order_Proxy
     */
    public function getProxy()
    {
        if (is_null($this->proxy)) {
            $this->isComponentModeEbay()   && $this->proxy = Mage::getModel('M2ePro/Ebay_Order_Proxy');
            $this->isComponentModeAmazon() && $this->proxy = Mage::getModel('M2ePro/Amazon_Order_Proxy');

            $this->proxy->setOrder($this->getChildObject());
        }

        return $this->proxy;
    }

    // ########################################

    private function associateWithStore()
    {
        $storeId = !is_null($this->getStoreId()) ? $this->getStoreId() : $this->getChildObject()->getAssociatedStoreId();

        if (is_null($this->getStoreId()) && !is_null($storeId)) {
            $this->setData('store_id', $storeId)->save();
        }

        // Load needed to have original store config
        $store = Mage::getModel('core/store')->load($storeId);

        if (is_null($store->getId())) {
            $log = $this->makeLog(self::LOG_IMPORT_ORDER_FAILED, array('msg' => self::LOG_STORE_MISSING));
            $this->addErrorLog($log);

            return false;
        }

        if (!Mage::getStoreConfig('payment/m2epropayment/active', $store)) {
            $log = $this->makeLog(self::LOG_IMPORT_ORDER_FAILED, array('msg' => self::LOG_PAYMENT_METHOD_DISABLED));
            $this->addErrorLog($log);

            return false;
        }

        if (!Mage::getStoreConfig('carriers/m2eproshipping/active', $store)) {
            $log = $this->makeLog(self::LOG_IMPORT_ORDER_FAILED, array('msg' => self::LOG_SHIPPING_METHOD_DISABLED));
            $this->addErrorLog($log);

            return false;
        }

        $this->getProxy()->setStore($store);

        return true;
    }

    // ########################################

    private function associateItemsWithProducts()
    {
        foreach ($this->getItemsCollection()->getItems() as $item) {
            /** @var $item Ess_M2ePro_Model_Order_Item */
            if (!$item->associateWithProduct()) {
                return false;
            }
        }

        return true;
    }

    // ########################################

    public function createMagentoOrder()
    {
        try {

            if (!$this->getChildObject()->canCreateMagentoOrder()) {
                return NULL;
            }

            // Store must be initialized before products
            // ---------------
            if (!$this->associateWithStore() || !$this->associateItemsWithProducts()) {
                return NULL;
            }
            // ---------------

            $this->getChildObject()->beforeCreateMagentoOrder();

            // Create magento order
            // ---------------
            /** @var $magentoQuoteBuilder Ess_M2ePro_Model_Magento_Quote */
            $magentoQuoteBuilder = Mage::getModel('M2ePro/Magento_Quote');
            $magentoQuoteBuilder->setProxyOrder($this->getProxy());
            $magentoQuoteBuilder->buildQuote();

            /** @var $magentoOrderBuilder Ess_M2ePro_Model_Magento_Order */
            $magentoOrderBuilder = Mage::getModel('M2ePro/Magento_Order');
            $magentoOrderBuilder->setQuote($magentoQuoteBuilder->getQuote());
            $magentoOrderBuilder->buildOrder();
            $magentoOrderBuilder->addComments($magentoQuoteBuilder->getComments());

            $this->magentoOrder = $magentoOrderBuilder->getOrder();
            $this->setData('magento_order_id', $this->magentoOrder->getId())->save();

            unset($magentoQuoteBuilder);
            unset($magentoOrderBuilder);
            // ---------------

            $this->getChildObject()->afterCreateMagentoOrder();

            $this->addSuccessLog(self::LOG_IMPORT_ORDER_SUCCEEDED);

        } catch (Exception $e) {

            if (is_null($this->getMagentoOrderId())) {
                $this->addErrorLog($this->makeLog(self::LOG_IMPORT_ORDER_FAILED, array('msg' => $e->getMessage())));
            } else {
                $this->addWarningLog($this->makeLog(self::LOG_IMPORT_ORDER_SUCCEEDED_WITH_ERROR, array('msg' => $e->getMessage())));
            }

            Mage::helper('M2ePro/Exception')->process($e);

            return NULL;
        }

        return $this->magentoOrder;
    }

    public function updateMagentoOrderStatus()
    {
        $magentoOrder = $this->getMagentoOrder();

        if (is_null($magentoOrder)) {
            return;
        }

        // Set status according to account settings
        // ---------------
        /** @var $magentoOrderUpdater Ess_M2ePro_Model_Magento_Order_Updater */
        $magentoOrderUpdater = Mage::getModel('M2ePro/Magento_Order_Updater');
        $magentoOrderUpdater->setMagentoOrder($magentoOrder);
        $magentoOrderUpdater->updateStatus($this->getChildObject()->getStatusForMagentoOrder());
        $magentoOrderUpdater->finishUpdate();
        // ---------------
    }

    // ########################################

    public function createPaymentTransactions()
    {
        try {

            $paymentTransaction = $this->getChildObject()->createPaymentTransactions();

        } catch (Exception $e) {

            $log = $this->makeLog(self::LOG_IMPORT_TRANSACTION_FAILED, array('msg' => $e->getMessage()));
            $this->addErrorLog($log);

            Mage::helper('M2ePro/Exception')->process($e);

            return NULL;
        }

        return $paymentTransaction;
    }

    // ########################################

    public function createInvoice()
    {
        try {

            $invoice = $this->getChildObject()->createInvoice();

        } catch (Exception $e) {

            $log = $this->makeLog(self::LOG_IMPORT_INVOICE_FAILED, array('msg' => $e->getMessage()));
            $this->addErrorLog($log);

            Mage::helper('M2ePro/Exception')->process($e);

            return NULL;
        }

        if (!is_null($invoice)) {
            $this->addSuccessLog(self::LOG_IMPORT_INVOICE_SUCCEEDED);
        }

        return $invoice;
    }

    // ########################################

    public function createShipment()
    {
        try {

            $shipment = $this->getChildObject()->createShipment();

        } catch (Exception $e) {

            $log = $this->makeLog(self::LOG_IMPORT_SHIPMENT_FAILED, array('msg' => $e->getMessage()));
            $this->addErrorLog($log);

            Mage::helper('M2ePro/Exception')->process($e);

            return NULL;
        }

        if (!is_null($shipment)) {
            $this->addSuccessLog(self::LOG_IMPORT_SHIPMENT_SUCCEEDED);
        }

        return $shipment;
    }

    // ########################################

    public function createTracks()
    {
        try {

            $tracks = $this->getChildObject()->createTracks();

        } catch (Exception $e) {

            $log = $this->makeLog(self::LOG_IMPORT_TRACK_FAILED, array('msg' => $e->getMessage()));
            $this->addErrorLog($log);

            Mage::helper('M2ePro/Exception')->process($e);

            return NULL;
        }

        if (!is_null($tracks)) {
            $this->addSuccessLog(self::LOG_IMPORT_TRACK_SUCCEEDED);
        }

        return $tracks;
    }

    // ########################################
}