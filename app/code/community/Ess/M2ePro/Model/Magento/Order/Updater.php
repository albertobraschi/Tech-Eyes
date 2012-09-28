<?php

/*
 * @copyright  Copyright (c) 2011 by  ESS-UA.
 */

class Ess_M2ePro_Model_Magento_Order_Updater
{
    const STATUS_PROCESSING = 'processing';

    // ########################################

    /** @var $magentoOrder Mage_Sales_Model_Order */
    private $magentoOrder = NULL;

    private $needSaveMagentoOrder = false;

    // ########################################

    /**
     * Set magento order for updating
     *
     * @param Mage_Sales_Model_Order $order
     * @return Ess_M2ePro_Model_Magento_Order_Updater
     */
    public function setMagentoOrder(Mage_Sales_Model_Order $order)
    {
        $this->magentoOrder = $order;

        return $this;
    }

    // ########################################

    /**
     * Update shipping and billing addresses
     *
     * @param array $addressInfo
     */
    public function updateShippingAddress(array $addressInfo)
    {
        $billingAddress = $this->magentoOrder->getBillingAddress();
        if ($billingAddress instanceof Mage_Sales_Model_Order_Address) {
            $billingAddress->addData($addressInfo);
            $billingAddress->implodeStreetAddress()->save();
        }

        $shippingAddress = $this->magentoOrder->getShippingAddress();
        if ($shippingAddress instanceof Mage_Sales_Model_Order_Address) {
            $shippingAddress->addData($addressInfo);
            $shippingAddress->implodeStreetAddress()->save();
        }
    }

    // ########################################

    /**
     * Update customer address data
     *
     * @param array $customerInfo
     * @return null
     */
    public function updateCustomer(array $customerInfo)
    {
        // Update order data for guest account
        // ---------------------------
        if ($this->magentoOrder->getCustomerIsGuest()) {

            if ($this->magentoOrder->getCustomerEmail() != $customerInfo['email']) {
                $this->magentoOrder->setCustomerEmail($customerInfo['email']);
                $this->needSaveMagentoOrder = true;
            }

            return;
        }
        // ---------------------------

        /** @var $customer Mage_Customer_Model_Customer */
        $customer = Mage::getModel('customer/customer')->load($this->magentoOrder->getCustomerId());
        if (!$customer->getId()) {
            return;
        }

        if ($customer->getEmail() != $customerInfo['email'] &&
            strpos($customer->getEmail(), Ess_M2ePro_Model_Magento_Customer::FAKE_EMAIL_POSTFIX) !== false) {
            $customer->setEmail($customerInfo['email'])->save();
        }

        // Find same customer address
        // todo if only street differs - add to exist address
        // ---------------------------
        foreach ($customer->getAddressesCollection() as $address) {
            /** @var $address Mage_Customer_Model_Address */
            if ($address->getData('firstname') != $customerInfo['firstname'] ||
                $address->getData('lastname') != $customerInfo['lastname'] ||
                $address->getData('city') != $customerInfo['city']) {
                continue;
            }

            $newStreets = array_diff($address->getStreet(), $customerInfo['street']);
            if (count($newStreets) == 0) {
                return;
            }
        }
        // ---------------------------

        /** @var $customerAddress Mage_Customer_Model_Address */
        $customerAddress = Mage::getModel('customer/address')->setData($customerInfo)
            ->setCustomerId($customer->getId())
            ->setIsDefaultBilling(false)
            ->setIsDefaultShipping(false);
        $customerAddress->implodeStreetAddress();
        $customerAddress->save();
    }

    // ########################################

    /**
     * Update payment data (payment method, transactions, etc)
     *
     * @param array $newPaymentData
     */
    public function updatePaymentData(array $newPaymentData)
    {
        $payment = $this->magentoOrder->getPayment();

        if ($payment instanceof Mage_Sales_Model_Order_Payment) {
            $payment->setAdditionalData(serialize($newPaymentData))->save();
        }
    }

    // ########################################

    /**
     * Add notes
     *
     * @param array $comments
     * @return null
     */
    public function updateComments(array $comments)
    {
        if (empty($comments)) {
            return;
        }

        $comments = implode('<br /><br />', $comments);
        $this->magentoOrder->addStatusHistoryComment($comments);
        $this->needSaveMagentoOrder = true;
    }

    // ########################################

    /**
     * Update status
     *
     * @param $status
     * @return null
     */
    public function updateStatus($status)
    {
        if ($status == '' || $this->magentoOrder->getStatus() == $status) {
            return;
        }

        if ($status == self::STATUS_PROCESSING) {
            // todo why we can't just do setStatus('processing')?
            $this->magentoOrder->setIsInProcess(true);
        } else {
            $this->magentoOrder->setStatus($status);
        }

        $this->needSaveMagentoOrder = true;
    }

    // ########################################

    /**
     * Save magento order only once and only if it's needed
     */
    public function finishUpdate()
    {
        if ($this->needSaveMagentoOrder) {
            $this->magentoOrder->save();
        }
    }

    // ########################################
}