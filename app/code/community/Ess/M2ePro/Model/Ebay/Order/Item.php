<?php

/*
 * @copyright  Copyright (c) 2011 by  ESS-UA.
 */

class Ess_M2ePro_Model_Ebay_Order_Item extends Ess_M2ePro_Model_Component_Child_Ebay_Abstract
{
    // Parser hack -> Mage::helper('M2ePro')->__('Product import is disabled in eBay Account settings.');
    // Parser hack -> Mage::helper('M2ePro')->__('Data obtaining for eBay Item failed.');
    // Parser hack -> Mage::helper('M2ePro')->__('Product for eBay Item "%id%" was created in Magento catalog.');
    const LOG_IMPORT_PRODUCT_DISABLED  = 'Product import is disabled in eBay Account settings.';
    const LOG_IMPORT_PRODUCT_FAILED    = 'Data obtaining for eBay Item failed.';
    const LOG_IMPORT_PRODUCT_SUCCEEDED = 'Product for eBay Item "%id%" was created in Magento catalog.';

    // ########################################

    /** @var $ebayItem Ess_M2ePro_Model_Ebay_Item */
    private $ebayItem = NULL;

    // ########################################

    public function _construct()
    {
        parent::_construct();
        $this->_init('M2ePro/Ebay_Order_Item');
    }

    /**
     * @return Ess_M2ePro_Model_Order_Item
     */
    public function getParentObject()
    {
        return parent::getParentObject();
    }

    // ########################################

    /**
     * @return Ess_M2ePro_Model_Ebay_Order
     */
    public function getEbayOrder()
    {
        return $this->getParentObject()->getOrder()->getChildObject();
    }

    // ########################################

    public function getEbayItem()
    {
        if (is_null($this->ebayItem)) {
            $this->ebayItem = Mage::getModel('M2ePro/Ebay_Item')->load($this->getItemId(), 'item_id');
        }

        return !is_null($this->ebayItem->getId()) ? $this->ebayItem : NULL;
    }

    // ########################################

    public function getTransactionId()
    {
        return $this->getData('transaction_id');
    }

    public function getItemId()
    {
        return $this->getData('item_id');
    }

    public function getTitle()
    {
        return $this->getData('title');
    }

    public function getSku()
    {
        return $this->getData('sku');
    }

    public function getConditionDisplayName()
    {
        return $this->getData('condition_display_name');
    }

    public function getPrice()
    {
        return (float)$this->getData('price');
    }

    public function getBuyItNowPrice()
    {
        return (float)$this->getData('buy_it_now_price');
    }

    public function getCurrency()
    {
        return $this->getData('currency');
    }

    public function getQtyPurchased()
    {
        return (int)$this->getData('qty_purchased');
    }

    public function getVariation()
    {
        // compatibility with M2E 3.x
        // -------------
        $tempVariation = @unserialize($this->getData('variation'));
        $tempVariation === false && $tempVariation = json_decode($this->getData('variation'), true);
        $tempVariation = is_array($tempVariation) ? $tempVariation : array();
        // -------------

        return $tempVariation;
    }

    public function getAutoPay()
    {
        return (bool)$this->getData('auto_pay');
    }

    public function getListingType()
    {
        return $this->getData('listing_type');
    }

    // ########################################

    public function getAssociatedProductId()
    {
        $order = $this->getParentObject()->getOrder();
        /** @var $ebayAccount Ess_M2ePro_Model_Ebay_Account */
        $ebayAccount = $order->getAccount()->getChildObject();

        // Item was listed by M2E
        // ----------------
        if (!is_null($this->getEbayItem())) {
            return $this->getEbayItem()->getProductId();
        }
        // ----------------

        // 3rd party Item
        // ----------------
        $sku = $this->getSku() ? $this->getSku() : Mage::helper('M2ePro')->convertStringToSku($this->getTitle());

        $product = Mage::getModel('catalog/product')->loadByAttribute('sku', $sku);
        if ($product && $product->getId()) {
            return $product->getId();
        }
        // ----------------

        if (!$ebayAccount->isMagentoOrdersListingsOtherProductImportEnabled()) {
            $log = $order->makeLog(Ess_M2ePro_Model_Order::LOG_IMPORT_ORDER_FAILED, array('msg' => self::LOG_IMPORT_PRODUCT_DISABLED));
            $order->addErrorLog($log);

            return NULL;
        }

        $product = $this->createProduct();

        return !is_null($product) ? $product->getId() : NULL;
    }

    private function createProduct()
    {
        $order = $this->getParentObject()->getOrder();

        /** @var $itemImporter Ess_M2ePro_Model_Ebay_Order_Item_Importer */
        $itemImporter = Mage::getModel('M2ePro/Ebay_Order_Item_Importer');
        $itemImporter->setItem($this);

        $rawItemData = $itemImporter->getDataFromChannel();

        if (is_null($rawItemData)) {
            $log = $order->makeLog(Ess_M2ePro_Model_Order::LOG_IMPORT_ORDER_FAILED, array('msg' => self::LOG_IMPORT_PRODUCT_FAILED));
            $order->addErrorLog($log);

            return NULL;
        }

        $productData = $itemImporter->prepareDataForProductCreation($rawItemData);

        // Try to find exist product with sku from eBay
        // ----------------
        $product = Mage::getModel('catalog/product')->loadByAttribute('sku', $productData['sku']);
        if ($product && $product->getId()) {
            return $product;
        }
        // ----------------

        $storeId = $order->getAccount()->getChildObject()->getMagentoOrdersListingsOtherStoreId();
        if ($storeId === 0) {
            $storeId = Mage::helper('M2ePro/Magento')->getDefaultStoreId();
        }

        $productData['store_id'] = $storeId;

        // Create product in magento
        // ----------------
        /** @var $productBuilder Ess_M2ePro_Model_Magento_Product_Builder */
        $productBuilder = Mage::getModel('M2ePro/Magento_Product_Builder')->setData($productData);
        $productBuilder->buildProduct();
        // ----------------

        $log = $order->makeLog(self::LOG_IMPORT_PRODUCT_SUCCEEDED, array('!id' => $this->getItemId()));
        $order->addSuccessLog($log);

        return $productBuilder->getProduct();
    }

    // ########################################

    /**
     * Check whether item is similar with other item (has same product id, price etc)
     *
     * @param Ess_M2ePro_Model_Ebay_Order_Item $item
     * @return bool
     */
    public function isSimilarWith(Ess_M2ePro_Model_Ebay_Order_Item $item)
    {
        if (is_null($this->getParentObject()->getProductId()) || is_null($item->getParentObject()->getProductId())) {
            return false;
        }

        if ($this->getPrice() != $item->getPrice()) {
            return false;
        }

        $compareToVariation = $this->getParentObject()->getProxy()->getLowerCasedVariation();
        $compareWithVariation = $item->getParentObject()->getProxy()->getLowerCasedVariation();

        ksort($compareToVariation);
        ksort($compareWithVariation);

        $compareToVariationKeys = array_keys($compareToVariation);
        $compareToVariationValues = array_values($compareToVariation);

        $compareWithVariationKeys = array_keys($compareWithVariation);
        $compareWithVariationValues = array_values($compareWithVariation);

        if (count($compareToVariation) == count($compareWithVariation) &&
            count(array_diff($compareToVariationKeys,$compareWithVariationKeys)) == 0 &&
            count(array_diff($compareToVariationValues,$compareWithVariationValues)) == 0) {
            return true;
        }

        return false;
    }

    // ########################################

    public function deleteInstance()
    {
        return $this->delete();
    }

    // ########################################
}