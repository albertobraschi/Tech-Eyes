<?php

/*
 * @copyright  Copyright (c) 2011 by  ESS-UA.
 */

class Ess_M2ePro_Model_Ebay_Listing_Product_Variation_Option extends Ess_M2ePro_Model_Component_Child_Ebay_Abstract
{
    // ########################################

    public function _construct()
    {
        parent::_construct();
        $this->_init('M2ePro/Ebay_Listing_Product_Variation_Option');
    }

    // ########################################

    /**
     * @return Ess_M2ePro_Model_Magento_Product
     */
    public function getMagentoProduct()
    {
        return $this->getParentObject()->getMagentoProduct();
    }

    //-----------------------------------------

    /**
     * @return Ess_M2ePro_Model_Listing
     */
    public function getListing()
    {
        return $this->getParentObject()->getListing();
    }

    /**
     * @return Ess_M2ePro_Model_Listing_Product
     */
    public function getListingProduct()
    {
        return $this->getParentObject()->getListingProduct();
    }

    /**
     * @return Ess_M2ePro_Model_Listing_Product_Variation
     */
    public function getListingProductVariation()
    {
        return $this->getParentObject()->getListingProductVariation();
    }

    //-----------------------------------------

    /**
     * @return Ess_M2ePro_Model_Template_General
     */
    public function getGeneralTemplate()
    {
        return $this->getParentObject()->getGeneralTemplate();
    }

    /**
     * @return Ess_M2ePro_Model_Template_SellingFormat
     */
    public function getSellingFormatTemplate()
    {
        return $this->getParentObject()->getSellingFormatTemplate();
    }

    /**
     * @return Ess_M2ePro_Model_Template_Description
     */
    public function getDescriptionTemplate()
    {
        return $this->getParentObject()->getDescriptionTemplate();
    }

    /**
     * @return Ess_M2ePro_Model_Template_Synchronization
     */
    public function getSynchronizationTemplate()
    {
        return $this->getParentObject()->getSynchronizationTemplate();
    }

    //-----------------------------------------

    /**
     * @return Ess_M2ePro_Model_Ebay_Listing
     */
    public function getEbayListing()
    {
        return $this->getListing()->getChildObject();
    }

    /**
     * @return Ess_M2ePro_Model_Ebay_Listing_Product
     */
    public function getEbayListingProduct()
    {
        return $this->getListingProduct()->getChildObject();
    }

    /**
     * @return Ess_M2ePro_Model_Ebay_Listing_Product_Variation
     */
    public function getEbayListingProductVariation()
    {
        return $this->getListingProductVariation()->getChildObject();
    }

    //-----------------------------------------

    /**
     * @return Ess_M2ePro_Model_Ebay_Template_General
     */
    public function getEbayGeneralTemplate()
    {
        return $this->getGeneralTemplate()->getChildObject();
    }

    /**
     * @return Ess_M2ePro_Model_Ebay_Template_SellingFormat
     */
    public function getEbaySellingFormatTemplate()
    {
        return $this->getSellingFormatTemplate()->getChildObject();
    }

    /**
     * @return Ess_M2ePro_Model_Ebay_Template_Description
     */
    public function getEbayDescriptionTemplate()
    {
        return $this->getDescriptionTemplate()->getChildObject();
    }

    /**
     * @return Ess_M2ePro_Model_Ebay_Template_Synchronization
     */
    public function getEbaySynchronizationTemplate()
    {
        return $this->getSynchronizationTemplate()->getChildObject();
    }

    // ########################################

    public function getSku()
    {
        if (!$this->getListingProduct()->getMagentoProduct()->isSimpleTypeWithCustomOptions()) {
            return $this->getMagentoProduct()->getSku();
        }

        $tempSku = '';

        $mainProduct = $this->getListingProduct()->getMagentoProduct()->getProduct();
        $simpleAttributes = $mainProduct->getOptions();

        foreach ($simpleAttributes as $tempAttribute) {

            if (!(bool)(int)$tempAttribute->getData('is_require')) {
                continue;
            }

            if (!in_array($tempAttribute->getType(), array('drop_down', 'radio', 'multiple', 'checkbox'))) {
                continue;
            }

            if (strtolower($tempAttribute->getData('default_title')) != strtolower($this->getParentObject()->getAttribute()) &&
                strtolower($tempAttribute->getData('store_title')) != strtolower($this->getParentObject()->getAttribute()) &&
                strtolower($tempAttribute->getData('title')) != strtolower($this->getParentObject()->getAttribute())) {
                continue;
            }

            foreach ($tempAttribute->getValues() as $tempOption) {

                if (strtolower($tempOption->getData('default_title')) != strtolower($this->getParentObject()->getOption()) &&
                    strtolower($tempOption->getData('store_title')) != strtolower($this->getParentObject()->getOption()) &&
                    strtolower($tempOption->getData('title')) != strtolower($this->getParentObject()->getOption())) {
                    continue;
                }

                if (!is_null($tempOption->getData('sku')) &&
                    $tempOption->getData('sku') !== false) {
                    $tempSku = $tempOption->getData('sku');
                }

                break 2;
            }
        }

        return $tempSku;
    }

    public function getQty()
    {
        $qty = 0;

        $src = $this->getEbaySellingFormatTemplate()->getQtySource();

        switch ($src['mode']) {
            case Ess_M2ePro_Model_Ebay_Template_SellingFormat::QTY_MODE_SINGLE:
                $qty = 1;
                break;

            case Ess_M2ePro_Model_Ebay_Template_SellingFormat::QTY_MODE_NUMBER:
                $qty = (int)$src['value'];
                break;

            case Ess_M2ePro_Model_Ebay_Template_SellingFormat::QTY_MODE_ATTRIBUTE:
                $qty = (int)$this->getMagentoProduct()->getAttributeValue($src['attribute']);
                break;

            default:
            case Ess_M2ePro_Model_Ebay_Template_SellingFormat::QTY_MODE_PRODUCT:
                $qty = (int)$this->getMagentoProduct()->getQty();
                break;
        }

        if (!$this->getListingProduct()->getMagentoProduct()->isSimpleTypeWithCustomOptions()) {
            if (!$this->getMagentoProduct()->getStockAvailability() ||
                $this->getMagentoProduct()->getStatus() == Mage_Catalog_Model_Product_Status::STATUS_DISABLED)  {
                // Out of stock or disabled Item? Set QTY = 0
                $qty = 0;
            }
        }

        $qty < 0 && $qty = 0;

        return (int)floor($qty);
    }

    // ########################################

    public function getPrice()
    {
        $price = 0;

        // Configurable product
        if ($this->getListingProduct()->getMagentoProduct()->isConfigurableType()) {

            if ($this->getEbaySellingFormatTemplate()->isPriceVariationModeParent()) {
                $price = $this->getConfigurablePriceParent();
            } else {
                $price = $this->getBaseProductPrice();
            }

        // Bundle product
        } else if ($this->getListingProduct()->getMagentoProduct()->isBundleType()) {

            if ($this->getEbaySellingFormatTemplate()->isPriceVariationModeParent()) {
                $price = $this->getBundlePriceParent();
            } else {
                $price = $this->getBaseProductPrice();
            }

        // Simple with custom options
        } else if ($this->getListingProduct()->getMagentoProduct()->isSimpleTypeWithCustomOptions()) {
            $price = $this->getSimpleWithCustomOptionsPrice();
        // Grouped product
        } else if ($this->getListingProduct()->getMagentoProduct()->isGroupedType()) {
            $price = $this->getBaseProductPrice();
        }

        $price < 0 && $price = 0;

        return $price;
    }

    //-----------------------------------------
    
    protected function getConfigurablePriceParent()
    {
        $price = 0;

        $mainProduct = $this->getListingProduct()->getMagentoProduct()->getProduct();
        $configurableAttributes = $mainProduct->getTypeInstance(true)->getConfigurableAttributesAsArray($mainProduct);

        foreach ($configurableAttributes as $tempAttribute) {

            if ((!isset($tempAttribute['label']) || strtolower($tempAttribute['label']) != strtolower($this->getParentObject()->getAttribute())) &&
                (!isset($tempAttribute['frontend_label']) || strtolower($tempAttribute['frontend_label']) != strtolower($this->getParentObject()->getAttribute())) &&
                (!isset($tempAttribute['store_label']) || strtolower($tempAttribute['store_label']) != strtolower($this->getParentObject()->getAttribute()))) {
                continue;
            }

            foreach ($tempAttribute['values'] as $tempOption) {

                if ((!isset($tempOption['label']) || strtolower($tempOption['label']) != strtolower($this->getParentObject()->getOption())) &&
                    (!isset($tempOption['default_label']) || strtolower($tempOption['default_label']) != strtolower($this->getParentObject()->getOption())) &&
                    (!isset($tempOption['store_label']) || strtolower($tempOption['store_label']) != strtolower($this->getParentObject()->getOption()))) {
                    continue;
                }

                if ((bool)(int)$tempOption['is_percent']) {
                    // Base Price of Main product.
                    $src = $this->getEbaySellingFormatTemplate()->getBuyItNowPriceSource();
                    $basePrice = $this->getEbayListingProduct()->getBaseProductPrice($src['mode'],$src['attribute']);
                    $price = ($basePrice * (float)$tempOption['pricing_value']) / 100;
                } else {
                    $price = (float)$tempOption['pricing_value'];
                }

                break 2;
            }
        }

        $price < 0 && $price = 0;

        return $price;
    }

    protected function getBundlePriceParent()
    {
        $price = 0;

        $mainProduct = $this->getListingProduct()->getMagentoProduct()->getProduct();
        $mainProductInstance = $mainProduct->getTypeInstance(true);
        $bundleAttributes = $mainProductInstance->getOptionsCollection($mainProduct);

        foreach ($bundleAttributes as $tempAttribute) {

            if (!(bool)(int)$tempAttribute->getData('required')) {
                continue;
            }

            if (is_null($tempAttribute->getData('default_title')) ||
                strtolower($tempAttribute->getData('default_title')) != strtolower($this->getParentObject()->getAttribute())) {
                continue;
            }

            $tempOptions = $mainProductInstance->getSelectionsCollection(array(0 => $tempAttribute->getId()), $mainProduct)->getItems();

            foreach ($tempOptions as $tempOption) {

                if ((int)$tempOption->getId() != $this->getParentObject()->getProductId()) {
                    continue;
                }

                if ((bool)(int)$tempOption->getData('selection_price_type')) {
                    // Base Price of Main product.
                    $src = $this->getEbaySellingFormatTemplate()->getBuyItNowPriceSource();
                    $basePrice = $this->getEbayListingProduct()->getBaseProductPrice($src['mode'],$src['attribute']);
                    $price = ($basePrice * (float)$tempOption->getData('selection_price_value')) / 100;
                } else {
                    $price = (float)$tempOption->getData('selection_price_value');
                }

                break 2;
            }
        }

        $price < 0 && $price = 0;

        return $price;
    }

    protected function getSimpleWithCustomOptionsPrice()
    {
        $price = 0;

        $mainProduct = $this->getListingProduct()->getMagentoProduct()->getProduct();
        $simpleAttributes = $mainProduct->getOptions();

        foreach ($simpleAttributes as $tempAttribute) {

            if (!(bool)(int)$tempAttribute->getData('is_require')) {
                continue;
            }

            if (!in_array($tempAttribute->getType(), array('drop_down', 'radio', 'multiple', 'checkbox'))) {
                continue;
            }

            if ((is_null($tempAttribute->getData('default_title')) || strtolower($tempAttribute->getData('default_title')) != strtolower($this->getParentObject()->getAttribute())) &&
                (is_null($tempAttribute->getData('store_title')) || strtolower($tempAttribute->getData('store_title')) != strtolower($this->getParentObject()->getAttribute())) &&
                (is_null($tempAttribute->getData('title')) || strtolower($tempAttribute->getData('title')) != strtolower($this->getParentObject()->getAttribute()))) {
                continue;
            }

            foreach ($tempAttribute->getValues() as $tempOption) {

                if ((is_null($tempOption->getData('default_title')) || strtolower($tempOption->getData('default_title')) != strtolower($this->getParentObject()->getOption())) &&
                    (is_null($tempOption->getData('store_title')) || strtolower($tempOption->getData('store_title')) != strtolower($this->getParentObject()->getOption())) &&
                    (is_null($tempOption->getData('title')) || strtolower($tempOption->getData('title')) != strtolower($this->getParentObject()->getOption()))) {
                    continue;
                }

                if (!is_null($tempOption->getData('price_type')) &&
                    $tempOption->getData('price_type') !== false) {

                    switch ($tempOption->getData('price_type')) {
                        case 'percent':
                            $src = $this->getEbaySellingFormatTemplate()->getBuyItNowPriceSource();
                            $basePrice = $this->getEbayListingProduct()->getBaseProductPrice($src['mode'],$src['attribute']);
                            $price = ($basePrice * (float)$tempOption->getData('price')) / 100;
                            break;
                        case 'fixed':
                            $price = (float)$tempOption->getData('price');
                            break;
                    }
                }

                break 2;
            }
        }

        $price < 0 && $price = 0;

        return $price;
    }

    //-----------------------------------------

    protected function getBaseProductPrice()
    {
        $price = 0;

        $src = $this->getEbaySellingFormatTemplate()->getBuyItNowPriceSource();

        switch ($src['mode']) {

            case Ess_M2ePro_Model_Ebay_Template_SellingFormat::PRICE_NONE:
                $price = 0;
                break;

            case Ess_M2ePro_Model_Ebay_Template_SellingFormat::PRICE_SPECIAL:
                $price = $this->getMagentoProduct()->getSpecialPrice();
                $price <= 0 && $price = $this->getMagentoProduct()->getPrice();
                break;

            case Ess_M2ePro_Model_Ebay_Template_SellingFormat::PRICE_ATTRIBUTE:
                $price = $this->getMagentoProduct()->getAttributeValue($src['attribute']);
                break;

            default:
            case Ess_M2ePro_Model_Ebay_Template_SellingFormat::PRICE_PRODUCT:
                $price = $this->getMagentoProduct()->getPrice();
                break;
        }

        $price < 0 && $price = 0;

        return $price;
    }

    // ########################################

    public function getMainImageLink()
    {
        $imageLink = '';

        if ($this->getEbayDescriptionTemplate()->isImageMainModeProduct()) {
            $imageLink = $this->getMagentoProduct()->getImageLink('image');
        }
        if ($this->getEbayDescriptionTemplate()->isImageMainModeAttribute()) {
            $src = $this->getEbayDescriptionTemplate()->getImageMainSource();
            $imageLink = $this->getMagentoProduct()->getImageLink($src['attribute']);
        }

        return $imageLink;
    }
    
    public function getImagesForEbay()
    {
        if ($this->getEbayDescriptionTemplate()->isImageMainModeNone()) {
            return array();
        }

        $mainImage = $this->getMainImageLink();

        if ($mainImage == '') {
            return array();
        }

        return array($mainImage);
    }

    // ########################################
}