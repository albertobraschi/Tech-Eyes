<?php

/*
 * @copyright  Copyright (c) 2011 by  ESS-UA.
 */

class Ess_M2ePro_Model_Ebay_Order extends Ess_M2ePro_Model_Component_Child_Ebay_Abstract
{
    const CHECKOUT_STATUS_INCOMPLETE = 0;
    const CHECKOUT_STATUS_COMPLETED  = 1;

    const PAYMENT_STATUS_NOT_SELECTED = 0;
    const PAYMENT_STATUS_ERROR        = 1;
    const PAYMENT_STATUS_PROCESS      = 2;
    const PAYMENT_STATUS_COMPLETED    = 3;

    const SHIPPING_STATUS_NOT_SELECTED = 0;
    const SHIPPING_STATUS_PROCESSING   = 1;
    const SHIPPING_STATUS_COMPLETED    = 2;

    const TAX_SHIPPING_EXCLUDED = 0;
    const TAX_SHIPPING_INCLUDED = 1;

    // Parser hack -> Mage::helper('M2ePro')->__('Magento Order was canceled.');
    // Parser hack -> Mage::helper('M2ePro')->__('Magento Order cannot be canceled.');
    // Parser hack -> Mage::helper('M2ePro')->__('"Prioritize Combined Orders" option is set to "No" in eBay account settings.');
    const LOG_CANCEL_SUCCEEDED    = 'Magento Order was canceled.';
    const LOG_CANCEL_FAILED       = 'Magento Order cannot be canceled.';
    const LOG_PRIORITIZE_DISABLED = '"Prioritize Combined Orders" option is disabled in eBay account settings.';

    // ########################################

    private $relatedEbayItems = NULL;

    /** @var $externalTransactionsCollection Ess_M2ePro_Model_Mysql4_Ebay_Order_ExternalTransaction_Collection */
    private $externalTransactionsCollection = NULL;

    private $subTotalPrice = NULL;

    private $grandTotalPrice = NULL;

    // ########################################

    public function _construct()
    {
        parent::_construct();
        $this->_init('M2ePro/Ebay_Order');
    }

    /**
     * @return Ess_M2ePro_Model_Order
     */
    public function getParentObject()
    {
        return parent::getParentObject();
    }

    // ########################################

    /**
     * @return Ess_M2ePro_Model_Ebay_Account
     */
    public function getEbayAccount()
    {
        return $this->getParentObject()->getAccount()->getChildObject();
    }

    // ########################################

    /**
     * @return array
     */
    public function getRelatedChannelItems()
    {
        if (is_null($this->relatedEbayItems)) {
            $this->relatedEbayItems = array();

            foreach ($this->getParentObject()->getItemsCollection()->getItems() as $item) {
                if (!is_null($item->getChildObject()->getEbayItem())) {
                    $this->relatedEbayItems[] = $item->getChildObject()->getEbayItem();
                }
            }
        }

        return $this->relatedEbayItems;
    }

    // ########################################

    public function getExternalTransactionsCollection()
    {
        if (is_null($this->externalTransactionsCollection)) {
            $this->externalTransactionsCollection = Mage::getModel('M2ePro/Ebay_Order_ExternalTransaction')->getCollection();
            $this->externalTransactionsCollection->addFieldToFilter('order_id', $this->getData('order_id'));
                                                 //->addFieldToFilter('transaction_id', array('neq' => 'SIS')); // SIS means payment method other than PayPal
        }

        return $this->externalTransactionsCollection;
    }

    //-----------------------------------------

    /**
     * @return bool
     */
    public function hasExternalTransactions()
    {
        return $this->getExternalTransactionsCollection()->getSize() > 0;
    }

    // ########################################

    public function getEbayOrderId()
    {
        return $this->getData('ebay_order_id');
    }

    public function getSellingManagerRecordNumber()
    {
        return $this->getData('selling_manager_record_number');
    }

    public function getBuyerName()
    {
        return $this->getData('buyer_name');
    }

    public function getBuyerEmail()
    {
        return $this->getData('buyer_email');
    }

    public function getBuyerUserId()
    {
        return $this->getData('buyer_user_id');
    }

    public function getCheckoutBuyerMessage()
    {
        return $this->getData('checkout_buyer_message');
    }

    public function getPaymentMethod()
    {
        return $this->getData('payment_method');
    }

    public function getShippingMethod()
    {
        return $this->getData('shipping_method');
    }

    public function getShippingPrice()
    {
        return (float)$this->getData('shipping_price');
    }

    /**
     * @return array
     */
    public function getShippingAddress()
    {
        $tempAddress = $this->getData('cache_shipping_address');

        if (is_array($tempAddress)) {
            return $tempAddress;
        }

        $address = @unserialize($this->getData('shipping_address'));

        if (is_array($address)) {
            // compatibility with M2E 3.x
            // -------------
            $address = array(
                'country_code' => $address['country_id'],
                'country_name' => null,
                'city'         => $address['city'],
                'state'        => $address['region_id'],
                'postal_code'  => $address['postcode'],
                'phone'        => $address['telephone'],
                'street'       => $address['street']
            );
            // -------------
        } else {
            $address = json_decode($this->getData('shipping_address'), true);
        }

        $address = is_array($address) ? $address : array();
        $this->setData('cache_shipping_address', $address);

        return $address;
    }

    /**
     * @return array
     */
    public function getShippingTrackingDetails()
    {
        // compatibility with M2E 3.x
        // -------------
        $tempTrackingDetails = @unserialize($this->getData('shipping_tracking_details'));
        $tempTrackingDetails === false && $tempTrackingDetails = json_decode($this->getData('shipping_tracking_details'), true);
        $tempTrackingDetails = is_array($tempTrackingDetails) ? $tempTrackingDetails : array();
        // -------------

        return $tempTrackingDetails;
    }

    public function getCurrency()
    {
        return $this->getData('currency');
    }

    public function getFinalFee()
    {
        return $this->getData('final_fee');
    }

    public function getTaxRate()
    {
        return (float)$this->getData('tax_rate');
    }

    public function getTaxAmount()
    {
        return (float)$this->getData('tax_amount');
    }

    //-----------------------------------------

    /**
     * @return bool
     */
    public function isShippingPriceIncludesTax()
    {
        if ($this->getTaxRate() <= 0) {
            return false;
        }

        return (int)$this->getData('tax_includes_shipping') == self::TAX_SHIPPING_EXCLUDED;
    }

    //-----------------------------------------

    /**
     * @return bool
     */
    public function isCheckoutCompleted()
    {
        return (int)$this->getData('checkout_status') == self::CHECKOUT_STATUS_COMPLETED;
    }

    //-----------------------------------------

    /**
     * @return bool
     */
    public function isPaymentCompleted()
    {
        return (int)$this->getData('payment_status') == self::PAYMENT_STATUS_COMPLETED;
    }

    /**
     * @return bool
     */
    public function isPaymentMethodNotSelected()
    {
        return (int)$this->getData('payment_status') == self::PAYMENT_STATUS_NOT_SELECTED;
    }

    /**
     * @return bool
     */
    public function isPaymentInProcess()
    {
        return (int)$this->getData('payment_status') == self::PAYMENT_STATUS_PROCESS;
    }

    /**
     * @return bool
     */
    public function isPaymentFailed()
    {
        return (int)$this->getData('payment_status') == self::PAYMENT_STATUS_ERROR;
    }

    /**
     * @return bool
     */
    public function isPaymentStatusUnknown()
    {
        return !$this->isPaymentCompleted() &&
               !$this->isPaymentMethodNotSelected() &&
               !$this->isPaymentInProcess() &&
               !$this->isPaymentFailed();
    }

    //-----------------------------------------

    /**
     * @return bool
     */
    public function isShippingCompleted()
    {
        return (int)$this->getData('shipping_status') == self::SHIPPING_STATUS_COMPLETED;
    }

    /**
     * @return bool
     */
    public function isShippingMethodNotSelected()
    {
        return (int)$this->getData('shipping_status') == self::SHIPPING_STATUS_NOT_SELECTED;
    }

    /**
     * @return bool
     */
    public function isShippingInProcess()
    {
        return (int)$this->getData('shipping_status') == self::SHIPPING_STATUS_PROCESSING;
    }

    /**
     * @return bool
     */
    public function isShippingStatusUnknown()
    {
        return !$this->isShippingCompleted() &&
               !$this->isShippingMethodNotSelected() &&
               !$this->isShippingInProcess();
    }

    //-----------------------------------------

    /**
     * @return bool
     */
    public function hasTax()
    {
        return $this->getTaxRate() > 0 && $this->getTaxAmount() > 0;
    }

    /**
     * @return bool
     */
    public function hasVat()
    {
        return $this->getTaxRate() > 0 && $this->getTaxAmount() == 0;
    }

    //-----------------------------------------

    public function getRawAddressData()
    {
        $shippingAddress = $this->getShippingAddress();

        $email = $this->getBuyerEmail();
        if (stripos($email, 'Invalid Request') !== false || $email == '') {
            $email = str_replace(' ', '-', strtolower($this->getBuyerUserId())) . Ess_M2ePro_Model_Magento_Customer::FAKE_EMAIL_POSTFIX;
        }

        return array(
            'buyer_name' => $this->getBuyerName(),
            'email'      => $email,
            'country_id' => $shippingAddress['country_code'],
            'region'     => $shippingAddress['state'],
            'city'       => $shippingAddress['city'],
            'postcode'   => $shippingAddress['postal_code'],
            'telephone'  => $shippingAddress['phone'],
            'street'     => array_filter($shippingAddress['street'])
        );
    }

    //-----------------------------------------

    public function getSubtotalPrice()
    {
        if (is_null($this->subTotalPrice)) {
            $this->subTotalPrice = $this->getResource()->getItemsTotal($this->getId());
        }

        return $this->subTotalPrice;
    }

    public function getGrandTotalPrice()
    {
        if (is_null($this->grandTotalPrice)) {
            $this->grandTotalPrice = $this->getSubtotalPrice();
            $this->grandTotalPrice += round((float)$this->getData('shipping_price'), 2);
            $this->grandTotalPrice += round((float)$this->getData('tax_amount'), 2);
        }

        return $this->grandTotalPrice;
    }

    // ########################################

    public function getStatusForMagentoOrder()
    {
        $status = '';
        $this->isCheckoutCompleted() && $status = $this->getEbayAccount()->getMagentoOrdersStatusNew();
        $this->isPaymentCompleted()  && $status = $this->getEbayAccount()->getMagentoOrdersStatusPaid();
        $this->isShippingCompleted() && $status = $this->getEbayAccount()->getMagentoOrdersStatusShipped();

        return $status;
    }

    // ########################################

    private function cancelRelatedMagentoOrders()
    {
        if (!$this->getParentObject()->isCombined()) {
            return;
        }

        $relatedOrders = $this->getResource()->getRelatedOrders($this);

        foreach ($relatedOrders as $order) {
            /** @var $order Ess_M2ePro_Model_Order */
            $magentoOrder = $order->getMagentoOrder();

            if (is_null($magentoOrder) || $magentoOrder->isCanceled()) {
                continue;
            }

            if ($isCancelSuccessful = $magentoOrder->canCancel()) {
                try {
                    $magentoOrder->cancel()->save();
                } catch (Exception $e) {
                    $isCancelSuccessful = false;
                }
            }

            $order->addWarningLog($isCancelSuccessful ? self::LOG_CANCEL_SUCCEEDED : self::LOG_CANCEL_FAILED);
        }
    }

    // ########################################

    public function getAssociatedStoreId()
    {
        $storeId = NULL;

        $relatedChannelItems = $this->getRelatedChannelItems();

        if (count($relatedChannelItems) == 0) {
            // 3rd party order
            // ---------------
            $storeId = $this->getEbayAccount()->getMagentoOrdersListingsOtherStoreId();
            // ---------------
        } else {
            // M2E order
            // ---------------
            if ($this->getEbayAccount()->isMagentoOrdersListingsStoreCustom()) {
                $storeId = $this->getEbayAccount()->getMagentoOrdersListingsStoreId();
            } else {
                $firstChannelItem = reset($relatedChannelItems);
                $storeId = $firstChannelItem->getStoreId();
            }
            // ---------------
        }

        if ($storeId === 0) {
            $storeId = Mage::helper('M2ePro/Magento')->getDefaultStoreId();
        }

        return $storeId;
    }

    // ########################################

    public function canCreateMagentoOrder($isFrontend = false)
    {
        if (!is_null($this->getParentObject()->getMagentoOrderId())) {
            return false;
        }

        $ebayAccount = $this->getEbayAccount();

        if (!$ebayAccount->isMagentoOrdersListingsModeEnabled() &&
            !$ebayAccount->isMagentoOrdersListingsOtherModeEnabled()) {
            return false;
        }

        if (!$this->isCheckoutCompleted() && $ebayAccount->isMagentoOrdersRulesCheckoutCompleted()) {
            return false;
        }

        if (!$this->isPaymentCompleted() && $ebayAccount->isMagentoOrdersRulesPaymentCompleted()) {
            return false;
        }

        // M2E order
        // ---------------
        if ($this->getParentObject()->hasListingItems() && !$ebayAccount->isMagentoOrdersListingsModeEnabled()) {
            return false;
        }
        // ---------------

        // 3rd party order
        // ---------------
        if ($this->getParentObject()->hasOtherListingItems() && !$ebayAccount->isMagentoOrdersListingsOtherModeEnabled()) {
            return false;
        }
        // ---------------

        if ($isFrontend || $this->getParentObject()->isSingle()) {
            return true;
        }

        if (!$ebayAccount->isMagentoOrdersRulesTransactionCancel()) {

            $log = $this->getParentObject()->makeLog(Ess_M2ePro_Model_Order::LOG_IMPORT_ORDER_FAILED, array('msg' => self::LOG_PRIORITIZE_DISABLED));
            $this->getParentObject()->addWarningLog($log);

            return false;
        }

        return true;
    }

    // ########################################

    public function beforeCreateMagentoOrder()
    {
        $this->cancelRelatedMagentoOrders();
    }

    public function afterCreateMagentoOrder()
    {
        if ($this->getEbayAccount()->isMagentoOrdersCustomerNewNotifyWhenOrderCreated()) {
            $this->getParentObject()->getMagentoOrder()->sendNewOrderEmail();
        }
    }

    // ########################################

    public function canCreatePaymentTransaction()
    {
        if ($this->getExternalTransactionsCollection()->getSize() <= 0) {
            return false;
        }

        $magentoOrder = $this->getParentObject()->getMagentoOrder();
        if (is_null($magentoOrder)) {
            return false;
        }

        return true;
    }

    // ----------------------------------------

    public function createPaymentTransactions()
    {
        if (!$this->canCreatePaymentTransaction()) {
            return NULL;
        }

        $paymentData = $this->getParentObject()->getProxy()->getPaymentData();
        $paymentTransactions = $paymentData['transactions'];

        foreach ($paymentTransactions as $transaction) {
            /** @var $paymentTransactionBuilder Ess_M2ePro_Model_Magento_Order_PaymentTransaction */
            $paymentTransactionBuilder = Mage::getModel('M2ePro/Magento_Order_PaymentTransaction');
            $paymentTransactionBuilder->setMagentoOrder($this->getParentObject()->getMagentoOrder());
            $paymentTransactionBuilder->setData($transaction);
            $paymentTransactionBuilder->buildPaymentTransaction();
        }
    }

    // ########################################

    public function canCreateInvoice()
    {
        if (!$this->isPaymentCompleted()) {
            return false;
        }

        if (!$this->getEbayAccount()->isMagentoOrdersInvoiceEnabled()) {
            return false;
        }

        $magentoOrder = $this->getParentObject()->getMagentoOrder();
        if (is_null($magentoOrder)) {
            return false;
        }

        if ($magentoOrder->hasInvoices() || !$magentoOrder->canInvoice()) {
            return false;
        }

        return true;
    }

    // ----------------------------------------

    public function createInvoice()
    {
        if (!$this->canCreateInvoice()) {
            return NULL;
        }

        $magentoOrder = $this->getParentObject()->getMagentoOrder();

        // Create invoice
        // -------------
        /** @var $invoiceBuilder Ess_M2ePro_Model_Magento_Order_Invoice */
        $invoiceBuilder = Mage::getModel('M2ePro/Magento_Order_Invoice');
        $invoiceBuilder->setMagentoOrder($magentoOrder);
        $invoiceBuilder->buildInvoice();
        // -------------

        $invoice = $invoiceBuilder->getInvoice();

        if ($this->getEbayAccount()->isMagentoOrdersCustomerNewNotifyWhenInvoiceCreated()) {
            $invoice->sendEmail();
        }

        return $invoice;
    }

    // ########################################

    public function canCreateShipment()
    {
        if (!$this->isShippingCompleted()) {
            return false;
        }

        if (!$this->getEbayAccount()->isMagentoOrdersShipmentEnabled()) {
            return false;
        }

        $magentoOrder = $this->getParentObject()->getMagentoOrder();
        if (is_null($magentoOrder)) {
            return false;
        }

        if ($magentoOrder->hasShipments() || !$magentoOrder->canShip()) {
            return false;
        }

        return true;
    }

    // ----------------------------------------

    public function createShipment()
    {
        if (!$this->canCreateShipment()) {
            return NULL;
        }

        $magentoOrder = $this->getParentObject()->getMagentoOrder();

        // Create shipment
        // -------------
        /** @var $shipmentBuilder Ess_M2ePro_Model_Magento_Order_Shipment */
        $shipmentBuilder = Mage::getModel('M2ePro/Magento_Order_Shipment');
        $shipmentBuilder->setMagentoOrder($magentoOrder);
        $shipmentBuilder->buildShipment();
        // -------------

        return $shipmentBuilder->getShipment();
    }

    // ########################################

    public function canCreateTracks()
    {
        $trackingDetails = $this->getShippingTrackingDetails();
        if (count($trackingDetails) == 0) {
            return false;
        }

        $magentoOrder = $this->getParentObject()->getMagentoOrder();
        if (is_null($magentoOrder)) {
            return false;
        }

        if (!$magentoOrder->hasShipments()) {
            return false;
        }

        return true;
    }

    public function createTracks()
    {
        if (!$this->canCreateTracks()) {
            return NULL;
        }

        $shipment = $this->getParentObject()->getMagentoOrder()->getShipmentsCollection()->getFirstItem();

        // Create tracks
        // -------------
        /** @var $trackBuilder Ess_M2ePro_Model_Magento_Order_Shipment_Track */
        $trackBuilder = Mage::getModel('M2ePro/Magento_Order_Shipment_Track');
        $trackBuilder->setTrackingDetails($this->getShippingTrackingDetails());
        $trackBuilder->setShipment($shipment);
        $trackBuilder->setSupportedCarriers(Mage::helper('M2ePro/Component_Ebay')->getCarriers());
        $trackBuilder->buildTracks();
        // -------------

        return $trackBuilder->getTracks();
    }

    // ########################################

    private function processDispatcher($action, array $params = array())
    {
        return Mage::getModel('M2ePro/Connector_Server_Ebay_Order_Dispatcher')->process($action, $this, $params);
    }

    //-----------------------------------------

    public function canUpdatePaymentStatus()
    {
        return !$this->isPaymentCompleted() && !$this->isPaymentStatusUnknown();
    }

    public function updatePaymentStatus(array $params = array())
    {
        if (!$this->canUpdatePaymentStatus()) {
            return false;
        }
        return $this->processDispatcher(Ess_M2ePro_Model_Connector_Server_Ebay_Order_Dispatcher::ACTION_PAY, $params);
    }

    //-----------------------------------------

    public function canUpdateShippingStatus(array $trackingDetails = array())
    {
        if (!$this->isPaymentCompleted() || $this->isShippingStatusUnknown()) {
            return false;
        }

        if (!$this->isShippingMethodNotSelected() && !$this->isShippingInProcess() && empty($trackingDetails)) {
            return false;
        }

        return true;
    }

    public function updateShippingStatus(array $trackingDetails = array())
    {
        if (!$this->canUpdateShippingStatus($trackingDetails)) {
            return false;
        }

        $params = array();
        $action = Ess_M2ePro_Model_Connector_Server_Ebay_Order_Dispatcher::ACTION_SHIP;

        if (!empty($trackingDetails['tracking_number'])) {
            $action = Ess_M2ePro_Model_Connector_Server_Ebay_Order_Dispatcher::ACTION_SHIP_TRACK;

            // Prepare tracking information
            // -------------
            $params['tracking_number'] = $trackingDetails['tracking_number'];

            $carriers = Mage::helper('M2ePro/Component_Ebay')->getCarriers();

            $params['carrier_code'] = isset($carriers[$trackingDetails['carrier_code']])
                ? $carriers[$trackingDetails['carrier_code']]
                : $trackingDetails['carrier_title'];
            if ($params['carrier_code'] == '' || filter_var($params['carrier_code'], FILTER_VALIDATE_URL) !== false) {
                $params['carrier_code'] = 'Other';
            }
            // -------------
        }

        return $this->processDispatcher($action, $params);
    }

    // ########################################

    public function deleteInstance()
    {
        Mage::getSingleton('core/resource')->getConnection('core_write')
            ->delete(Mage::getResourceModel('M2ePro/Ebay_Order_ExternalTransaction')->getMainTable(),array('order_id = ?'=>$this->getData('order_id')));

        return $this->delete();
    }

    // ########################################
}