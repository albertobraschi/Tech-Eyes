<?php

/*
 * @copyright  Copyright (c) 2011 by  ESS-UA.
 */

class Ess_M2ePro_Model_Connector_Server_Ebay_Item_Helper
{
    // ########################################

    public function getListRequestData(Ess_M2ePro_Model_Listing_Product $listingProduct, array $params = array())
    {
        // Set permissions
        //-----------------
        $permissions = array(
            'general'=>true,
            'variations'=>true,
            'qty'=>true,
            'price'=>true,
            'title'=>true,
            'subtitle'=>true,
            'description'=>true
        );

        if (isset($params['only_data'])) {
            foreach ($permissions as &$value) {
                $value = false;
            }
            $permissions = array_merge($permissions,$params['only_data']);
        }

        if (isset($params['all_data'])) {
            foreach ($permissions as &$value) {
                $value = true;
            }
        }
        //-----------------

        $requestData = array();

        // Prepare Variations
        //-------------------
        Mage::getModel('M2ePro/Ebay_Listing_Product_Variation_Updater')->updateVariations($listingProduct);
        $tempVariations = Mage::getModel('M2ePro/Connector_Server_Ebay_Item_HelperVariations')
                                                ->getRequestData($listingProduct,$params);

        $requestData['is_variation_item'] = false;
        if (is_array($tempVariations) && count($tempVariations) > 0) {
            $requestData['is_variation_item'] = true;
        }
        //-------------------

        // Get Variations
        //-------------------
        if ($permissions['variations'] && $requestData['is_variation_item']) {

            $requestData['variation'] = $tempVariations;
            $requestData['variation_image'] = Mage::getModel('M2ePro/Connector_Server_Ebay_Item_HelperVariations')
                                                    ->getImagesData($listingProduct,$params);
            if (count($requestData['variation_image']) == 0) {
                unset($requestData['variation_image']);
            }
        }
        //-------------------

        // Get General Info
        //-------------------
        $permissions['general'] && $requestData['sku'] = $listingProduct->getChildObject()->getSku();
        $permissions['general'] && $this->addSellingFormatData($listingProduct,$requestData);
        
        $this->addDescriptionData($listingProduct,$requestData,$permissions);

        if (($permissions['qty'] || $permissions['price']) && !$requestData['is_variation_item']) {
            $this->addQtyPriceData($listingProduct,$requestData,$permissions);
        }

        if ($permissions['general']) {

            $this->addCategoriesData($listingProduct,$requestData);
            $this->addStoreCategoriesData($listingProduct,$requestData);

            $this->addProductDetailsData($listingProduct,$requestData);
            $this->addItemSpecificsData($listingProduct,$requestData);
            $this->addAttributeSetData($listingProduct,$requestData);

            $requestData['item_condition'] = $listingProduct->getChildObject()->getItemCondition();
            $requestData['listing_enhancements'] = $listingProduct->getGeneralTemplate()->getChildObject()->getEnhancements();
        }
        //-------------------

        // Get Shipping Info
        //-------------------
        if ($permissions['general']) {

            $this->addShippingData($listingProduct,$requestData);

            $requestData['country'] = $listingProduct->getGeneralTemplate()->getChildObject()->getCountry();
            $requestData['postal_code'] = $listingProduct->getGeneralTemplate()->getChildObject()->getPostalCode();
            $requestData['address'] = $listingProduct->getGeneralTemplate()->getChildObject()->getAddress();
        }
        //-------------------

        // Get Payment Info
        //-------------------
        if ($permissions['general']) {

            $this->addPaymentData($listingProduct,$requestData);

            $requestData['vat_percent'] = $listingProduct->getGeneralTemplate()->getChildObject()->getVatPercent();
            $requestData['use_tax_table'] = $listingProduct->getGeneralTemplate()->getChildObject()->isUseEbayTaxTableEnabled();
            $requestData['use_local_shipping_rate_table'] = $listingProduct->getGeneralTemplate()->getChildObject()->isUseEbayLocalShippingRateTableEnabled();
        }
        //-------------------
        
        // Get Refund Info
        //-------------------
        if ($permissions['general']) {
            $requestData['return_policy'] = $listingProduct->getGeneralTemplate()->getChildObject()->getRefundOptions();
        }
        //-------------------

        // Get Images Info
        //-------------------
        $permissions['general'] && $this->addImagesData($listingProduct,$requestData);
        //-------------------

        return $requestData;
    }

    public function updateAfterListAction(Ess_M2ePro_Model_Listing_Product $listingProduct, array $nativeRequestData = array(), array $params = array())
    {
        // Add New eBay Item Id
        //---------------------
        $ebayItemsId = $this->createNewEbayItemsId($listingProduct,$params['ebay_item_id']);
        //---------------------

        // Save additional info
        //---------------------
        $additionalData = $listingProduct->getChildObject()->getData('additional_data');
        is_string($additionalData) && $additionalData = json_decode($additionalData,true);
        !is_array($additionalData) && $additionalData = array();
        $additionalData['is_eps_ebay_images_mode'] = $params['is_eps_ebay_images_mode'];
        $additionalData['ebay_item_fees'] = $params['ebay_item_fees'];
        $listingProduct->setData('additional_data', json_encode($additionalData))->save();
        //---------------------

        // Update Listing Product
        //---------------------
        $this->updateProductAfterAction($listingProduct,
                                        $nativeRequestData,
                                        $params,
                                        $ebayItemsId,
                                        false);
        //---------------------

        // Update Variations
        //---------------------
        Mage::getModel('M2ePro/Connector_Server_Ebay_Item_HelperVariations')
                   ->updateAfterAction($listingProduct,$nativeRequestData,$params,false);
        //---------------------
    }

    //----------------------------------------

    public function getRelistRequestData(Ess_M2ePro_Model_Listing_Product $listingProduct, array $params = array())
    {
        // Set permissions
        //-----------------
        $permissions = array(
            'base'=>true,
            'additional'=>true
        );

        if (isset($params['only_data'])) {
            foreach ($permissions as &$value) {
                $value = false;
            }
            $permissions = array_merge($permissions,$params['only_data']);
        }

        if (isset($params['all_data'])) {
            foreach ($permissions as &$value) {
                $value = true;
            }
        }
        //-----------------

        $requestData = array();

        // Get eBay Item Info
        //-------------------
        $requestData['item_id'] = $listingProduct->getChildObject()->getEbayItem()->getItemId();
        //-------------------
        
        // Prepare Variations
        //-------------------
        Mage::getModel('M2ePro/Ebay_Listing_Product_Variation_Updater')->updateVariations($listingProduct);
        $tempVariations = Mage::getModel('M2ePro/Connector_Server_Ebay_Item_HelperVariations')
                                                ->getRequestData($listingProduct,$params);

        $requestData['is_variation_item'] = false;
        if (is_array($tempVariations) && count($tempVariations) > 0) {
            $requestData['is_variation_item'] = true;
        }
        //-------------------

        // Add eBay image upload mode
        //---------------------
        $additionalData = $listingProduct->getChildObject()->getData('additional_data');
        is_string($additionalData) && $additionalData = json_decode($additionalData,true);
        !is_array($additionalData) && $additionalData = array();
        if (isset($additionalData['is_eps_ebay_images_mode'])) {
            $requestData['is_eps_ebay_images_mode'] = $additionalData['is_eps_ebay_images_mode'];
        }
        //---------------------
        
        // Get Variations
        //-------------------
        if ($permissions['additional'] && $requestData['is_variation_item']) {

            $requestData['variation'] = $tempVariations;
            $requestData['variation_image'] = Mage::getModel('M2ePro/Connector_Server_Ebay_Item_HelperVariations')
                                                    ->getImagesData($listingProduct,$params);
            if (count($requestData['variation_image']) == 0) {
                unset($requestData['variation_image']);
            }
        }
        //-------------------

        // Get General Info
        //-------------------
        if ($permissions['additional']) {

            $this->addDescriptionData($listingProduct,$requestData,array());
            $this->addShippingData($listingProduct,$requestData);

            if (!$requestData['is_variation_item']) {
                $this->addQtyPriceData($listingProduct,$requestData,array());
            }
        }
        //-------------------

        return $requestData;
    }

    public function updateAfterRelistAction(Ess_M2ePro_Model_Listing_Product $listingProduct, array $nativeRequestData = array(), array $params = array())
    {
        // Add New eBay Item Id
        //---------------------
        $ebayItemsId = $this->createNewEbayItemsId($listingProduct,$params['ebay_item_id']);
        //---------------------

        // Update Listing Product
        //---------------------
        $this->updateProductAfterAction($listingProduct,
                                        $nativeRequestData,
                                        $params,
                                        $ebayItemsId,
                                        false);
        //---------------------

        // Update Variations
        //---------------------
        Mage::getModel('M2ePro/Connector_Server_Ebay_Item_HelperVariations')
                   ->updateAfterAction($listingProduct,$nativeRequestData,$params,false);
        //---------------------
    }

    //----------------------------------------

    public function getReviseRequestData(Ess_M2ePro_Model_Listing_Product $listingProduct, array $params = array())
    {
        $requestData = $this->getListRequestData($listingProduct,$params);

        // Get eBay Item Info
        //-------------------
        $requestData['item_id'] = $listingProduct->getChildObject()->getEbayItem()->getItemId();
        //-------------------

        // Delete title and subtitle when item has bid(s)
        //-------------------
        if (!empty($requestData['title']) || !empty($requestData['subtitle'])) {

            $tempDeleteData = (is_null($listingProduct->getChildObject()->getOnlineQtySold()) ? 0 : $listingProduct->getChildObject()->getOnlineQtySold() > 0) ||
                              ($listingProduct->getChildObject()->isListingTypeAuction() && $listingProduct->getChildObject()->getOnlineBids() > 0);

            if (!empty($requestData['title']) && $tempDeleteData) {
                unset($requestData['title']);
            }
            if (!empty($requestData['subtitle']) && $tempDeleteData) {
                unset($requestData['subtitle']);
            }
        }
        //-------------------

        // Delete purchased variations
        //-------------------
        if (isset($requestData['variation']) && count($requestData['variation']) > 0) {

            $newVariations = array();
            
            foreach ($requestData['variation'] as $variation) {

                if ((int)$variation['qty'] > 0) {
                    $newVariations[] = $variation;
                    continue;
                }

				ksort($variation['specifics']);
				$variationKeys = array_keys($variation['specifics']);
				$variationValues = array_values($variation['specifics']);

                $tempOrdersItemsCollection = Mage::getModel('M2ePro/Ebay_Order_Item')->getCollection();
                $tempOrdersItemsCollection->addFieldToFilter('item_id', $requestData['item_id']);
                $ordersItems = $tempOrdersItemsCollection->getItems();

                $findOrderItem = false;

                foreach ($ordersItems as $orderItem) {

                    $variationOrder = $orderItem->getVariation();

                    if (empty($variationOrder)) {
                        continue;
                    }

					ksort($variationOrder);
					$orderItemVariationKeys = array_keys($variationOrder);
					$orderItemVariationValues = array_values($variationOrder);

					if (count($variation['specifics']) == count($variationOrder) &&
						count(array_diff($variationKeys,$orderItemVariationKeys)) <= 0 &&
						count(array_diff($variationValues,$orderItemVariationValues)) <= 0) {
						$findOrderItem = true;
						break;
					}
                }

				if ($findOrderItem) {
                    $variation['ignored'] = true;
				}

                $newVariations[] = $variation;
            }

            $requestData['variation'] = $newVariations;
        }
        //-------------------

        // Add eBay image upload mode
        //---------------------
        $additionalData = $listingProduct->getChildObject()->getData('additional_data');
        is_string($additionalData) && $additionalData = json_decode($additionalData,true);
        !is_array($additionalData) && $additionalData = array();
        if (isset($additionalData['is_eps_ebay_images_mode'])) {
            $requestData['is_eps_ebay_images_mode'] = $additionalData['is_eps_ebay_images_mode'];
        }
        //---------------------

        return $requestData;
    }

    public function updateAfterReviseAction(Ess_M2ePro_Model_Listing_Product $listingProduct, array $nativeRequestData = array(), array $params = array())
    {
        // Update Listing Product
        //---------------------
        $this->updateProductAfterAction($listingProduct,
                                        $nativeRequestData,
                                        $params,
                                        NULL,
                                        true);
        //---------------------

        // Update Variations
        //---------------------
        Mage::getModel('M2ePro/Connector_Server_Ebay_Item_HelperVariations')
                   ->updateAfterAction($listingProduct,$nativeRequestData,$params,true);
        //---------------------
    }

    //----------------------------------------

    public function getStopRequestData(Ess_M2ePro_Model_Listing_Product $listingProduct, array $params = array())
    {
        $requestData = array();
        
        // Get eBay Item Info
        //-------------------
        $requestData['item_id'] = $listingProduct->getChildObject()->getEbayItem()->getItemId();
        //-------------------

        return $requestData;
    }

    public function updateAfterStopAction(Ess_M2ePro_Model_Listing_Product $listingProduct, array $nativeRequestData = array(), array $params = array())
    {
        // Update Listing Product
        //---------------------
        $dataForUpdate = array(
            'status' => Ess_M2ePro_Model_Listing_Product::STATUS_STOPPED
        );
        if (isset($params['status_changer'])) {
            $dataForUpdate['status_changer'] = (int)$params['status_changer'];
        }
        if (isset($params['end_date_raw'])) {
            $dataForUpdate['end_date'] = Ess_M2ePro_Model_Connector_Server_Ebay_Abstract::ebayTimeToString($params['end_date_raw']);
        }
        $listingProduct->addData($dataForUpdate)->save();
        //---------------------

        // Update Variations
        //---------------------
        $productVariations = $listingProduct->getVariations(true);
        foreach ($productVariations as $variation) {
            /** @var $variation Ess_M2ePro_Model_Listing_Product_Variation */
            $dataForUpdate = array(
                'add' => Ess_M2ePro_Model_Listing_Product_Variation::ADD_NO
            );
            if ($variation->isListed()) {
                $dataForUpdate['status'] = Ess_M2ePro_Model_Listing_Product::STATUS_STOPPED;
            }
            $variation->addData($dataForUpdate)->save();
        }
        //---------------------
    }

    // ########################################

    protected function addSellingFormatData(Ess_M2ePro_Model_Listing_Product $listingProduct, array &$requestData)
    {
        if ($listingProduct->getChildObject()->isListingTypeFixed()) {
            $requestData['listing_type'] = Ess_M2ePro_Model_Ebay_Template_SellingFormat::EBAY_LISTING_TYPE_FIXED;
        } else {
            $requestData['listing_type'] = Ess_M2ePro_Model_Ebay_Template_SellingFormat::EBAY_LISTING_TYPE_AUCTION;
        }

        $requestData['duration'] = $listingProduct->getChildObject()->getDuration();
        $requestData['is_private'] = $listingProduct->getSellingFormatTemplate()->getChildObject()->isPrivateListing();

        $requestData['currency'] = $listingProduct->getSellingFormatTemplate()->getChildObject()->getCurrency();
        $requestData['hit_counter'] = $listingProduct->getDescriptionTemplate()->getChildObject()->getHitCounterType();
    }
    
    protected function addDescriptionData(Ess_M2ePro_Model_Listing_Product $listingProduct, array &$requestData, $permissions = array())
    {
        if (!isset($permissions['title']) || $permissions['title']) {
            $requestData['title'] = $listingProduct->getChildObject()->getTitle();
        }

        if (!isset($permissions['subtitle']) || $permissions['subtitle']) {
            $requestData['subtitle'] = $listingProduct->getChildObject()->getSubTitle();
        }

        if (!isset($permissions['description']) || $permissions['description']) {
            $requestData['description'] = $listingProduct->getChildObject()->getDescription();
        }
    }

    protected function addQtyPriceData(Ess_M2ePro_Model_Listing_Product $listingProduct, array &$requestData, $permissions = array())
    {
        if (!isset($permissions['qty']) || $permissions['qty']) {
            $requestData['qty'] = $listingProduct->getChildObject()->getQty();
        }

        if (!isset($permissions['price']) || $permissions['price']) {
            
            if ($listingProduct->getChildObject()->isListingTypeFixed()) {
                $requestData['price_fixed'] = $listingProduct->getChildObject()->getBuyItNowPrice();
                $this->addBestOfferData($listingProduct,$requestData);
            } else {
                $requestData['price_start'] = $listingProduct->getChildObject()->getStartPrice();
                $requestData['price_reserve'] = $listingProduct->getChildObject()->getReservePrice();
                $requestData['price_buyitnow'] = $listingProduct->getChildObject()->getBuyItNowPrice();
            }
        }
    }

    //----------------------------------------

    protected function addCategoriesData(Ess_M2ePro_Model_Listing_Product $listingProduct, array &$requestData)
    {
        $requestData['category_main_id'] = $listingProduct->getChildObject()->getMainCategory();
        $requestData['category_secondary_id'] = $listingProduct->getChildObject()->getSecondaryCategory();
    }

    protected function addStoreCategoriesData(Ess_M2ePro_Model_Listing_Product $listingProduct, array &$requestData)
    {
        $requestData['store_category_main_id'] = $listingProduct->getChildObject()->getMainStoreCategory();
        $requestData['store_category_secondary_id'] = $listingProduct->getChildObject()->getSecondaryStoreCategory();
    }

    //----------------------------------------
    
    protected function addBestOfferData(Ess_M2ePro_Model_Listing_Product $listingProduct, array &$requestData)
    {
        if ($listingProduct->getChildObject()->isListingTypeFixed()) {
            $requestData['bestoffer_mode'] = $listingProduct->getSellingFormatTemplate()->getChildObject()->isBestOfferEnabled();
            if ($requestData['bestoffer_mode']) {
                $requestData['bestoffer_accept_price'] = $listingProduct->getChildObject()->getBestOfferAcceptPrice();
                $requestData['bestoffer_reject_price'] = $listingProduct->getChildObject()->getBestOfferRejectPrice();
            }
        }
    }

    protected function addProductDetailsData(Ess_M2ePro_Model_Listing_Product $listingProduct, array &$requestData)
    {
        $requestData['product_details'] = array();

        $temp = $listingProduct->getChildObject()->getProductDetail('isbn');
        $temp && $requestData['product_details']['isbn'] = $temp;

        $temp = $listingProduct->getChildObject()->getProductDetail('epid');
        $temp && $requestData['product_details']['epid'] = $temp;

        $temp = $listingProduct->getChildObject()->getProductDetail('upc');
        $temp && $requestData['product_details']['upc'] = $temp;

        $temp = $listingProduct->getChildObject()->getProductDetail('ean');
        $temp && $requestData['product_details']['ean'] = $temp;
    }

    //----------------------------------------
    
    protected function addItemSpecificsData(Ess_M2ePro_Model_Listing_Product $listingProduct, array &$requestData)
    {
        $requestData['item_specifics'] = array();

        $tempListingSpecifics = $listingProduct->getGeneralTemplate()->getChildObject()->getSpecifics(true);
        foreach ($tempListingSpecifics as $tempSpecific) {

            $tempSpecific->setMagentoProduct($listingProduct->getMagentoProduct());

            $tempAttributeData = $tempSpecific->getAttributeData();
            $tempAttributeValues = $tempSpecific->getValues();

            if (!$tempSpecific->isItemSpecificsMode()) {
                continue;
            }

            $values = array();
            foreach ($tempAttributeValues as $tempAttributeValue) {
                if ($tempAttributeValue['value'] == '--') {
                    continue;
                }
                $values[] = $tempAttributeValue['value'];
            }

            $requestData['item_specifics'][] = array(
                'name' => $tempAttributeData['id'],
                'value' => $values
            );
        }
    }

    protected function addAttributeSetData(Ess_M2ePro_Model_Listing_Product $listingProduct, array &$requestData)
    {
        $requestData['attribute_set'] = array(
            'attribute_set_id' => 0,
            'attributes' => array()
        );

        $tempListingSpecifics = $listingProduct->getGeneralTemplate()->getChildObject()->getSpecifics(true);
        foreach ($tempListingSpecifics as $tempSpecific) {

            $tempSpecific->setMagentoProduct($listingProduct->getMagentoProduct());

            $tempAttributeData = $tempSpecific->getAttributeData();
            $tempAttributeValues = $tempSpecific->getValues();

            if (!$tempSpecific->isAttributeSetMode()) {
                continue;
            }

            $requestData['attribute_set']['attribute_set_id'] = $tempSpecific->getModeRelationId();
            $requestData['attribute_set']['attributes'][] = array(
                'id' => $tempAttributeData['id'],
                'value' => $tempAttributeValues
            );
        }
    }

    //----------------------------------------

    protected function addShippingData(Ess_M2ePro_Model_Listing_Product $listingProduct, array &$requestData)
    {
        $requestData['shipping'] = array();

        if ($listingProduct->getGeneralTemplate()->getChildObject()->isLocalShippingEnabled()) {

            $requestData['shipping']['local'] = array();

            if ($listingProduct->getGeneralTemplate()->getChildObject()->isLocalShippingFreightEnabled()) {
                $requestData['shipping']['local']['type'] = Ess_M2ePro_Model_Ebay_Template_General::EBAY_SHIPPING_TYPE_FREIGHT;
            }
            if ($listingProduct->getGeneralTemplate()->getChildObject()->isLocalShippingLocalEnabled()) {
                $requestData['shipping']['local']['type'] = Ess_M2ePro_Model_Ebay_Template_General::EBAY_SHIPPING_TYPE_LOCAL;
            }
            if ($listingProduct->getGeneralTemplate()->getChildObject()->isLocalShippingFlatEnabled()) {
                $requestData['shipping']['local']['type'] = Ess_M2ePro_Model_Ebay_Template_General::EBAY_SHIPPING_TYPE_FLAT;
            }

            if ($listingProduct->getGeneralTemplate()->getChildObject()->isLocalShippingCalculatedEnabled()) {

                $requestData['shipping']['local']['type'] = Ess_M2ePro_Model_Ebay_Template_General::EBAY_SHIPPING_TYPE_CALCULATED;
                $requestData['shipping']['local']['handing_fee'] = $listingProduct->getChildObject()->getLocalHandling();

                $requestData['shipping']['calculated'] = array(
                    'measurement_system' => $listingProduct->getGeneralTemplate()->getChildObject()->getCalculatedShipping()->getMeasurementSystem(),
                    'package_size' => $listingProduct->getChildObject()->getPackageSize(),
                    'originating_postal_code' => $listingProduct->getGeneralTemplate()->getChildObject()->getCalculatedShipping()->getPostalCode(),
                    'dimensions' => $listingProduct->getChildObject()->getDimensions(),
                    'weight' => $listingProduct->getChildObject()->getWeight()
                );
                if ($requestData['shipping']['calculated']['measurement_system'] == Ess_M2ePro_Model_Ebay_Template_General_CalculatedShipping::MEASUREMENT_SYSTEM_ENGLISH) {
                    $requestData['shipping']['calculated']['measurement_system'] = Ess_M2ePro_Model_Ebay_Template_General_CalculatedShipping::EBAY_MEASUREMENT_SYSTEM_ENGLISH;
                }
                if ($requestData['shipping']['calculated']['measurement_system'] == Ess_M2ePro_Model_Ebay_Template_General_CalculatedShipping::MEASUREMENT_SYSTEM_METRIC) {
                    $requestData['shipping']['calculated']['measurement_system'] = Ess_M2ePro_Model_Ebay_Template_General_CalculatedShipping::EBAY_MEASUREMENT_SYSTEM_METRIC;
                }
            }

            if ($listingProduct->getGeneralTemplate()->getChildObject()->isLocalShippingFlatEnabled() ||
                $listingProduct->getGeneralTemplate()->getChildObject()->isLocalShippingCalculatedEnabled()) {

                $requestData['shipping']['get_it_fast'] = $listingProduct->getGeneralTemplate()->getChildObject()->isGetItFastEnabled();
                $requestData['shipping']['dispatch_time'] = $listingProduct->getGeneralTemplate()->getChildObject()->getDispatchTime();
                $requestData['shipping']['local']['discount'] = $listingProduct->getGeneralTemplate()->getChildObject()->isLocalShippingDiscountEnabled();
                $requestData['shipping']['local']['cash_on_delivery'] = $listingProduct->getGeneralTemplate()->getChildObject()->isLocalShippingCashOnDeliveryEnabled();
                $requestData['shipping']['local']['cash_on_delivery_cost'] = $listingProduct->getChildObject()->getLocalShippingCashOnDeliveryCost();
                $requestData['shipping']['local']['methods'] = array();

                $tempShippingsMethods = $listingProduct->getGeneralTemplate()->getChildObject()->getShippings(true);
                foreach ($tempShippingsMethods as $tempMethod) {
                    if (!$tempMethod->isShippingTypeLocal()) {
                       continue;
                    }
                    $tempMethod->setMagentoProduct($listingProduct->getMagentoProduct());
                    $tempDataMethod = array(
                        'service' => $tempMethod->getShippingValue()
                    );
                    if ($listingProduct->getGeneralTemplate()->getChildObject()->isLocalShippingFlatEnabled()) {
                        $tempDataMethod['cost'] = $tempMethod->getCost();
                        $tempDataMethod['cost_additional'] = $tempMethod->getCostAdditional();
                    }
                    if ($listingProduct->getGeneralTemplate()->getChildObject()->isLocalShippingCalculatedEnabled()) {
                        $tempDataMethod['is_free'] = $tempMethod->isCostModeFree();
                    }
                    $requestData['shipping']['local']['methods'][] = $tempDataMethod;
                }
            }
        }

        if ($listingProduct->getGeneralTemplate()->getChildObject()->isInternationalShippingEnabled() &&
            !$listingProduct->getGeneralTemplate()->getChildObject()->isLocalShippingFreightEnabled() &&
            !$listingProduct->getGeneralTemplate()->getChildObject()->isLocalShippingLocalEnabled()) {
            
            $requestData['shipping']['international'] = array();

            if ($listingProduct->getGeneralTemplate()->getChildObject()->isInternationalShippingFlatEnabled()) {
                $requestData['shipping']['international']['type'] = Ess_M2ePro_Model_Ebay_Template_General::EBAY_SHIPPING_TYPE_FLAT;
            }

            if ($listingProduct->getGeneralTemplate()->getChildObject()->isInternationalShippingCalculatedEnabled()) {
                $requestData['shipping']['international']['type'] = Ess_M2ePro_Model_Ebay_Template_General::EBAY_SHIPPING_TYPE_CALCULATED;
                $requestData['shipping']['international']['handing_fee'] = $listingProduct->getChildObject()->getInternationalHandling();
                if (!isset($requestData['shipping']['calculated'])) {
                    $requestData['shipping']['calculated'] = array(
                        'measurement_system' => $listingProduct->getGeneralTemplate()->getChildObject()->getCalculatedShipping()->getMeasurementSystem(),
                        'package_size' => $listingProduct->getChildObject()->getPackageSize(),
                        'originating_postal_code' => $listingProduct->getGeneralTemplate()->getChildObject()->getCalculatedShipping()->getPostalCode(),
                        'dimensions' => $listingProduct->getChildObject()->getDimensions(),
                        'weight' => $listingProduct->getChildObject()->getWeight()
                    );
                    if ($requestData['shipping']['calculated']['measurement_system'] == Ess_M2ePro_Model_Ebay_Template_General_CalculatedShipping::MEASUREMENT_SYSTEM_ENGLISH) {
                        $requestData['shipping']['calculated']['measurement_system'] = Ess_M2ePro_Model_Ebay_Template_General_CalculatedShipping::EBAY_MEASUREMENT_SYSTEM_ENGLISH;
                    }
                    if ($requestData['shipping']['calculated']['measurement_system'] == Ess_M2ePro_Model_Ebay_Template_General_CalculatedShipping::MEASUREMENT_SYSTEM_METRIC) {
                        $requestData['shipping']['calculated']['measurement_system'] = Ess_M2ePro_Model_Ebay_Template_General_CalculatedShipping::EBAY_MEASUREMENT_SYSTEM_METRIC;
                    }
                }
            }

            $requestData['shipping']['international']['discount'] = $listingProduct->getGeneralTemplate()->getChildObject()->isInternationalShippingDiscountEnabled();
            $requestData['shipping']['international']['methods'] = array();

            $tempShippingsMethods = $listingProduct->getGeneralTemplate()->getChildObject()->getShippings(true);
            foreach ($tempShippingsMethods as $tempMethod) {
                if (!$tempMethod->isShippingTypeInternational()) {
                   continue;
                }
                $tempMethod->setMagentoProduct($listingProduct->getMagentoProduct());
                $tempDataMethod = array(
                    'service' => $tempMethod->getShippingValue(),
                    'locations' => $tempMethod->getLocations()
                );
                if ($listingProduct->getGeneralTemplate()->getChildObject()->isInternationalShippingFlatEnabled()) {
                    $tempDataMethod['cost'] = $tempMethod->getCost();
                    $tempDataMethod['cost_additional'] = $tempMethod->getCostAdditional();
                }
                $requestData['shipping']['international']['methods'][] = $tempDataMethod;
            }
        }
    }

    //----------------------------------------
    
    protected function addPaymentData(Ess_M2ePro_Model_Listing_Product $listingProduct, array &$requestData)
    {
        $requestData['payment'] = array(
            'methods' => $listingProduct->getGeneralTemplate()->getChildObject()->getPaymentMethods()
        );

        if (in_array('PayPal',$requestData['payment']['methods'])) {
            $requestData['payment']['paypal'] = array(
                'email' => $listingProduct->getGeneralTemplate()->getChildObject()->getPayPalEmailAddress(),
                'immediate_payment' => $listingProduct->getGeneralTemplate()->getChildObject()->isPayPalImmediatePaymentEnabled()
            );
        }
    }

    //----------------------------------------

    protected function addImagesData(Ess_M2ePro_Model_Listing_Product $listingProduct, array &$requestData)
    {
        $requestData['images'] = array(
            'gallery_type' => $listingProduct->getGeneralTemplate()->getChildObject()->getGalleryType(),
            'images' => $listingProduct->getChildObject()->getImagesForEbay()
        );
    }

    // ########################################

    protected function createNewEbayItemsId(Ess_M2ePro_Model_Listing_Product $listingProduct, $ebayRealItemId)
    {
        $dataForAdd = array(
            'item_id' => (double)$ebayRealItemId,
            'product_id' => (int)$listingProduct->getProductId(),
            'store_id' => (int)$listingProduct->getListing()->getStoreId()
        );
        return Mage::getModel('M2ePro/Ebay_Item')->setData($dataForAdd)->save()->getId();
    }

    protected function updateProductAfterAction(Ess_M2ePro_Model_Listing_Product $listingProduct,
                                                array $nativeRequestData = array(),
                                                array $params = array(),
                                                $ebayItemsId = NULL,
                                                $saveEbayQtySold = false)
    {
        $dataForUpdate = array(
            'status' => Ess_M2ePro_Model_Listing_Product::STATUS_LISTED
        );

        !is_null($ebayItemsId) && $dataForUpdate['ebay_item_id'] = (int)$ebayItemsId;

        isset($params['status_changer']) && $dataForUpdate['status_changer'] = (int)$params['status_changer'];
        isset($params['start_date_raw']) && $dataForUpdate['start_date'] = Ess_M2ePro_Model_Connector_Server_Ebay_Abstract::ebayTimeToString($params['start_date_raw']);
        isset($params['end_date_raw']) && $dataForUpdate['end_date'] = Ess_M2ePro_Model_Connector_Server_Ebay_Abstract::ebayTimeToString($params['end_date_raw']);

        if ($saveEbayQtySold) {

            $dataForUpdate['online_qty_sold'] = is_null($listingProduct->getChildObject()->getOnlineQtySold()) ? 0 : $listingProduct->getChildObject()->getOnlineQtySold();

            $tempIsVariation = $nativeRequestData['is_variation_item'] && isset($nativeRequestData['variation']);
            $tempUpdateFlag = $tempIsVariation || isset($nativeRequestData['qty']);

            if ($tempUpdateFlag) {
                $tempQty = $tempIsVariation ? $listingProduct->getChildObject()->getQty() : $nativeRequestData['qty'];
                $dataForUpdate['online_qty'] = (int)$tempQty + (int)$dataForUpdate['online_qty_sold'];
            }

        } else {

            $dataForUpdate['online_qty_sold'] = 0;

            $tempIsVariation = $nativeRequestData['is_variation_item'] && isset($nativeRequestData['variation']);
            $tempUpdateFlag = $tempIsVariation || isset($nativeRequestData['qty']);

            if ($tempUpdateFlag) {
                $tempQty = $tempIsVariation ? $listingProduct->getChildObject()->getQty() : $nativeRequestData['qty'];
                $dataForUpdate['online_qty'] = $tempQty;
            }
        }

        if ($listingProduct->getChildObject()->isListingTypeFixed()) {

            $dataForUpdate['online_start_price'] = NULL;
            $dataForUpdate['online_reserve_price'] = NULL;
            $dataForUpdate['online_bids'] = NULL;

            $tempIsVariation = $nativeRequestData['is_variation_item'] && isset($nativeRequestData['variation']);
            $tempUpdateFlag = $tempIsVariation || isset($nativeRequestData['price_fixed']);

            if ($tempUpdateFlag) {
                $tempPrice = $tempIsVariation ? $listingProduct->getChildObject()->getBuyItNowPrice() : $nativeRequestData['price_fixed'];
                $dataForUpdate['online_buyitnow_price'] = $tempPrice;
            }

        } else {

            $dataForUpdate['online_bids'] = 0;

            if (isset($nativeRequestData['price_start'])) {
                $dataForUpdate['online_start_price'] = (float)$nativeRequestData['price_start'];
            }
            if (isset($nativeRequestData['price_reserve'])) {
                $dataForUpdate['online_reserve_price'] = (float)$nativeRequestData['price_reserve'];
            }
            if (isset($nativeRequestData['price_buyitnow'])) {
                $dataForUpdate['online_buyitnow_price'] = (float)$nativeRequestData['price_buyitnow'];
            }
        }

        $listingProduct->addData($dataForUpdate)->save();
    }

    // ########################################
}