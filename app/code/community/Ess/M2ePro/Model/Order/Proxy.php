<?php

/*
 * @copyright  Copyright (c) 2011 by  ESS-UA.
 */

abstract class Ess_M2ePro_Model_Order_Proxy
{
    const CHECKOUT_GUEST    = 'guest';
    const CHECKOUT_REGISTER = 'register';

    // ########################################

    /** @var $order Ess_M2ePro_Model_Ebay_Order|Ess_M2ePro_Model_Amazon_Order */
    protected $order = NULL;

    protected $items = array();

    /** @var $store Mage_Core_Model_Store */
    protected $store = NULL;

    protected $addressData = array();

    protected $comments = array();

    // ########################################

    /**
     * Set order object which should be a source for magento order
     *
     * @param Ess_M2ePro_Model_Component_Child_Abstract $order
     * @return Ess_M2ePro_Model_Order_Proxy
     */
    public function setOrder(Ess_M2ePro_Model_Component_Child_Abstract $order)
    {
        $this->order = $order;

        return $this;
    }

    // ########################################

    /**
     * Return proxy objects for order items
     *
     * @return Ess_M2ePro_Model_Order_Item_Proxy[]
     */
    public function getItems()
    {
        if (count($this->items) == 0) {
            foreach ($this->order->getParentObject()->getItemsCollection()->getItems() as $item) {
                $this->items[] = $item->getProxy();
            }
        }

        return $this->items;
    }

    // ########################################

    /**
     * Set store where order will be imported to
     *
     * @param Mage_Core_Model_Store $store
     * @return Ess_M2ePro_Model_Order_Proxy
     */
    public function setStore(Mage_Core_Model_Store $store)
    {
        $this->store = $store;

        return $this;
    }

    /**
     * Return store order will be imported to
     *
     * @return Mage_Core_Model_Store
     */
    public function getStore()
    {
        return $this->store;
    }

    // ########################################

    /**
     * Return checkout method
     *
     * @abstract
     * @return string
     */
    abstract public function getCheckoutMethod();

    /**
     * Check whether checkout method is guest
     *
     * @return bool
     */
    public function isCheckoutMethodGuest()
    {
        return $this->getCheckoutMethod() == self::CHECKOUT_GUEST;
    }

    // ########################################

    /**
     * Return buyer email
     *
     * @abstract
     * @return string
     */
    abstract public function getBuyerEmail();

    /**
     * Return customer object
     *
     * @abstract
     * @return Mage_Customer_Model_Customer
     */
    abstract public function getCustomer();

    /**
     * Return shipping address info
     *
     * @return array
     */
    public function getAddressData()
    {
        if (empty($this->addressData)) {
            $rawAddressData = $this->order->getRawAddressData();

            // Prepare buyer name
            // -----------------------
            $buyerNameParts = $this->getNameParts($rawAddressData['buyer_name']);
            $this->addressData['firstname'] = $buyerNameParts['firstname'];
            $this->addressData['lastname'] = $buyerNameParts['lastname'];
            // -----------------------

            // Prepare recipient name
            // -----------------------
            $recipientNameParts = !empty($rawAddressData['recipient_name'])
                ? $this->getNameParts($rawAddressData['recipient_name'])
                : $buyerNameParts;
            $this->addressData['recipient_firstname'] = $recipientNameParts['firstname'];
            $this->addressData['recipient_lastname'] = $recipientNameParts['lastname'];
            // -----------------------

            $this->addressData['email'] = $rawAddressData['email'];
            $this->addressData['country_id'] = $rawAddressData['country_id'];
            $this->addressData['region'] = $rawAddressData['region'];
            $this->addressData['city'] = $rawAddressData['city'];
            $this->addressData['postcode'] = $rawAddressData['postcode'] != '' ? $rawAddressData['postcode'] : '0000';
            $this->addressData['telephone'] = $rawAddressData['telephone'] != '' ? $rawAddressData['telephone'] : '0000000';
            $this->addressData['street'] = !empty($rawAddressData['street']) ? $rawAddressData['street'] : array();
            $this->addressData['save_in_address_book'] = 0;

            $regionCollection = Mage::getModel('directory/region')->getCollection();
            $regionCollection->addFieldToFilter('country_id', $rawAddressData['country_id']);

            if ($this->addressData['region'] != '') {
                $regionCollection->addFieldToFilter('code', $rawAddressData['region']);
            }

            $regionId = $regionCollection->getFirstItem()->getData('region_id');

            $this->addressData['region_id'] = $regionId ? $regionId : 1;
        }

        return $this->addressData;
    }

    private function getNameParts($fullName)
    {
        $spacePosition = strpos($fullName, ' ');

        if ($spacePosition === false) {
            $firstName = $fullName != '' ? $fullName : Mage::helper('M2ePro')->__('N/A');
            $lastName = Mage::helper('M2ePro')->__('N/A');
        } else {
            $firstName = trim(substr($fullName, 0, $spacePosition));
            $lastName = trim(substr($fullName, $spacePosition + 1));
        }

        return array(
            'firstname' => $firstName,
            'lastname'  => $lastName
        );
    }

    // ########################################

    /**
     * Return order currency code
     *
     * @abstract
     * @return string
     */
    abstract public function getCurrency();

    /**
     * Return payment data
     *
     * @abstract
     * @return array
     */
    abstract public function getPaymentData();

    /**
     * Return shipping data
     *
     * @abstract
     * @return array
     */
    abstract public function getShippingData();

    /**
     * Return order comments array
     *
     * @return array
     */
    public function getComments()
    {
        return array();
    }

    // ########################################

    /**
     * Return tax rate
     *
     * @abstract
     * @return float
     */
    abstract public function getTaxRate();

    /**
     * Check whether order has Tax (not VAT)
     *
     * @abstract
     * @return bool
     */
    abstract public function hasTax();

    /**
     * Check whether order has VAT (value added tax)
     *
     * @abstract
     * @return bool
     */
    abstract public function hasVat();

    /**
     * Check whether shipping price includes tax
     *
     * @abstract
     * @return bool
     */
    abstract public function isShippingPriceIncludesTax();

    /**
     * Check whether tax mode option is set to "None" in Account settings
     *
     * @abstract
     * @return bool
     */
    abstract public function isTaxModeNone();

    /**
     * Check whether tax mode option is set to "Channel" in Account settings
     *
     * @abstract
     * @return bool
     */
    abstract public function isTaxModeChannel();

    /**
     * Check whether tax mode option is set to "Magento" in Account settings
     *
     * @abstract
     * @return bool
     */
    abstract public function isTaxModeMagento();

    /**
     * Check whether tax mode option is set to "Mixed" in Account settings
     *
     * @abstract
     * @return bool
     */
    public function isTaxModeMixed()
    {
        return !$this->isTaxModeNone() &&
               !$this->isTaxModeChannel() &&
               !$this->isTaxModeMagento();
    }

    // ########################################
}