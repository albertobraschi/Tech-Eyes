<?php

/*
 * @copyright  Copyright (c) 2011 by  ESS-UA.
 */

class Ess_M2ePro_Model_Observer_Product
{
    private $_productNameOld = '';
    private $_productCategoriesOld = array();

    private $_productStatusOld = '';
    private $_productPriceOld = 0;
    private $_productSpecialPriceOld = 0;

    private $_productSpecialPriceFromDate = NULL;
    private $_productSpecialPriceToDate = NULL;

    private $_productCustomAttributes = array();

    //####################################

    public function catalogProductSaveBefore(Varien_Event_Observer $observer)
    {
        try {

            $productNew = $observer->getEvent()->getProduct();

            if (!($productNew instanceof Mage_Catalog_Model_Product)) {
                return;
            }

            $productOld = Mage::getModel('catalog/product')->load($productNew->getId());

            // Save preview name
            $this->_productNameOld = $productOld->getName();

            // Save preview categories
            $this->_productCategoriesOld = $productOld->getCategoryIds();

            // Get listing where is product
            $listingArray = Mage::getResourceModel('M2ePro/Listing')->getListingsWhereIsProduct($productOld->getId());

            if (count($listingArray) > 0) {

                // Save preview status
                $this->_productStatusOld = (int)$productOld->getStatus();

                // Save preview prices
                //--------------------
                $this->_productPriceOld = (float)$productOld->getPrice();
                $this->_productSpecialPriceOld = (float)$productOld->getSpecialPrice();

                $this->_productSpecialPriceFromDate = $productOld->getSpecialFromDate();
                $this->_productSpecialPriceToDate = $productOld->getSpecialToDate();
                //--------------------

                // Save preview attributes
                //--------------------
                /** @var $magentoProductModel Ess_M2ePro_Model_Magento_Product */
                $magentoProductModel = Mage::getModel('M2ePro/Magento_Product')->setProduct($productOld);
                $this->_productCustomAttributes = $this->getCustomAttributes($listingArray);
                foreach ($this->_productCustomAttributes as &$attribute) {
                    $attribute['value_old'] = $magentoProductModel->getAttributeValue($attribute['attribute']);
                }
                //--------------------
            }

        } catch (Exception $exception) {

            Mage::helper('M2ePro/Exception')->process($exception,true);
            return;
        }
    }

    public function catalogProductSaveAfter(Varien_Event_Observer $observer)
    {
        try {

            $productNew = $observer->getEvent()->getProduct();

            if (!($productNew instanceof Mage_Catalog_Model_Product)) {
                return;
            }

            // Update product name for listing log
            //--------------------
            $nameOld = $this->_productNameOld;
            $nameNew = $productNew->getName();

            if ($nameOld != $nameNew && $productNew->getStoreId() == Mage_Core_Model_App::ADMIN_STORE_ID) {
                Mage::getModel('M2ePro/Listing_Log')->updateProductTitle($productNew->getId(),$nameNew);
            }
            //--------------------

            // Get listing where is product
            $listingArray = Mage::getResourceModel('M2ePro/Listing')->getListingsWhereIsProduct($productNew->getId());

            if (count($listingArray) > 0) {

                  // Save global changes
                  //--------------------
                  Mage::getModel('M2ePro/ProductChange')
                                    ->updateAttribute( $productNew->getId(),
                                                       'product_instance',
                                                       'any_old',
                                                       'any_new',
                                                        Ess_M2ePro_Model_ProductChange::CREATOR_TYPE_OBSERVER );
                  //--------------------
                
                  // Save changes for status
                  //--------------------
                  $statusOld = (int)$this->_productStatusOld;
                  $statusNew = (int)$productNew->getStatus();

                  $rez = Mage::getModel('M2ePro/ProductChange')
                                ->updateAttribute(  $productNew->getId(),
                                                    'status',
                                                    $statusOld,
                                                    $statusNew,
                                                    Ess_M2ePro_Model_ProductChange::CREATOR_TYPE_OBSERVER );

                  if ($rez !== false) {

                      $statusOld = ($statusOld == Mage_Catalog_Model_Product_Status::STATUS_ENABLED)?'Enabled':'Disabled';
                      $statusNew = ($statusNew == Mage_Catalog_Model_Product_Status::STATUS_ENABLED)?'Enabled':'Disabled';

                      foreach ($listingArray as $listingTemp) {

                             $tempLog = Mage::getModel('M2ePro/Listing_Log');
                             $tempLog->setComponentMode($listingTemp['component_mode']);
                             $tempLog->addProductMessage($listingTemp['id'],
                                                         $productNew->getId(),
                                                         Ess_M2ePro_Model_Listing_Log::INITIATOR_EXTENSION,
                                                         NULL,
                                                         Ess_M2ePro_Model_Listing_Log::ACTION_CHANGE_PRODUCT_STATUS,
                                                         // Parser hack -> Mage::helper('M2ePro')->__('From [%from%] to [%to%]');
                                                         // Parser hack -> Mage::helper('M2ePro')->__('Enabled');
                                                         // Parser hack -> Mage::helper('M2ePro')->__('Disabled');
                                                         Mage::getModel('M2ePro/Log_Abstract')->encodeDescription('From [%from%] to [%to%]',array('from'=>$statusOld,'to'=>$statusNew)),
                                                         Ess_M2ePro_Model_Listing_Log::TYPE_NOTICE,
                                                         Ess_M2ePro_Model_Listing_Log::PRIORITY_LOW );
                      }
                  }
                  //--------------------

                  // Save changes for price
                  //--------------------
                  $priceOld = round((float)$this->_productPriceOld,2);
                  $priceNew = round((float)$productNew->getPrice(),2);

                  $rez = Mage::getModel('M2ePro/ProductChange')
                                ->updateAttribute(  $productNew->getId(),
                                                    'price',
                                                    $priceOld,
                                                    $priceNew,
                                                    Ess_M2ePro_Model_ProductChange::CREATOR_TYPE_OBSERVER );

                  if ($rez !== false) {

                      foreach ($listingArray as $listingTemp) {

                             $tempLog = Mage::getModel('M2ePro/Listing_Log');
                             $tempLog->setComponentMode($listingTemp['component_mode']);
                             $tempLog->addProductMessage($listingTemp['id'],
                                                         $productNew->getId(),
                                                         Ess_M2ePro_Model_Listing_Log::INITIATOR_EXTENSION,
                                                         NULL,
                                                         Ess_M2ePro_Model_Listing_Log::ACTION_CHANGE_PRODUCT_PRICE,
                                                         // Parser hack -> Mage::helper('M2ePro')->__('From [%from%] to [%to%]');
                                                         Mage::getModel('M2ePro/Log_Abstract')->encodeDescription('From [%from%] to [%to%]',array('!from'=>$priceOld,'!to'=>$priceNew)),
                                                         Ess_M2ePro_Model_Listing_Log::TYPE_NOTICE,
                                                         Ess_M2ePro_Model_Listing_Log::PRIORITY_LOW );
                      }
                  }
                  //--------------------

                  // Save changes for special price
                  //--------------------
                  $specialPriceOld = round((float)$this->_productSpecialPriceOld,2);
                  $specialPriceNew = round((float)$productNew->getSpecialPrice(),2);

                  $rez = Mage::getModel('M2ePro/ProductChange')
                                ->updateAttribute(  $productNew->getId(),
                                                    'special_price',
                                                    $specialPriceOld,
                                                    $specialPriceNew,
                                                    Ess_M2ePro_Model_ProductChange::CREATOR_TYPE_OBSERVER );

                  if ($rez !== false) {

                      foreach ($listingArray as $listingTemp) {

                            $tempLog = Mage::getModel('M2ePro/Listing_Log');
                            $tempLog->setComponentMode($listingTemp['component_mode']);
                            $tempLog->addProductMessage( $listingTemp['id'],
                                                         $productNew->getId(),
                                                         Ess_M2ePro_Model_Listing_Log::INITIATOR_EXTENSION,
                                                         NULL,
                                                         Ess_M2ePro_Model_Listing_Log::ACTION_CHANGE_PRODUCT_SPECIAL_PRICE,
                                                         // Parser hack -> Mage::helper('M2ePro')->__('From [%from%] to [%to%]');
                                                         Mage::getModel('M2ePro/Log_Abstract')->encodeDescription('From [%from%] to [%to%]',array('!from'=>$specialPriceOld,'!to'=>$specialPriceNew)),
                                                         Ess_M2ePro_Model_Listing_Log::TYPE_NOTICE,
                                                         Ess_M2ePro_Model_Listing_Log::PRIORITY_LOW );
                      }
                  }
                  //--------------------

                  // Save changes for special price from date
                  //--------------------
                  $specialPriceFromDateOld = $this->_productSpecialPriceFromDate;
                  $specialPriceFromDateNew = $productNew->getSpecialFromDate();

                  $rez = Mage::getModel('M2ePro/ProductChange')
                                ->updateAttribute(  $productNew->getId(),
                                                    'special_price_from_date',
                                                    $specialPriceFromDateOld,
                                                    $specialPriceFromDateNew,
                                                    Ess_M2ePro_Model_ProductChange::CREATOR_TYPE_OBSERVER );

                  if ($rez !== false) {

                      if (is_null($specialPriceFromDateOld) || $specialPriceFromDateOld === false || $specialPriceFromDateOld == '') {
                          $specialPriceFromDateOld = 'None';
                      }

                      if (is_null($specialPriceFromDateNew) || $specialPriceFromDateNew === false || $specialPriceFromDateNew == '') {
                          $specialPriceFromDateNew = 'None';
                      }

                      foreach ($listingArray as $listingTemp) {

                          $tempLog = Mage::getModel('M2ePro/Listing_Log');
                          $tempLog->setComponentMode($listingTemp['component_mode']);
                          $tempLog->addProductMessage($listingTemp['id'],
                                                     $productNew->getId(),
                                                     Ess_M2ePro_Model_Listing_Log::INITIATOR_EXTENSION,
                                                     NULL,
                                                     Ess_M2ePro_Model_Listing_Log::ACTION_CHANGE_PRODUCT_SPECIAL_PRICE_FROM_DATE,
                                                     // Parser hack -> Mage::helper('M2ePro')->__('From [%from%] to [%to%]');
                                                     // Parser hack -> Mage::helper('M2ePro')->__('None');
                                                     Mage::getModel('M2ePro/Log_Abstract')->encodeDescription('From [%from%] to [%to%]',array('!from'=>$specialPriceFromDateOld,'!to'=>$specialPriceFromDateNew)),
                                                     Ess_M2ePro_Model_Listing_Log::TYPE_NOTICE,
                                                     Ess_M2ePro_Model_Listing_Log::PRIORITY_LOW );
                      }
                  }
                  //--------------------

                  // Save changes for special price to date
                  //--------------------
                  $specialPriceToDateOld = $this->_productSpecialPriceToDate;
                  $specialPriceToDateNew = $productNew->getSpecialToDate();

                  $rez = Mage::getModel('M2ePro/ProductChange')
                                ->updateAttribute(  $productNew->getId(),
                                                    'special_price_to_date',
                                                    $specialPriceToDateOld,
                                                    $specialPriceToDateNew,
                                                    Ess_M2ePro_Model_ProductChange::CREATOR_TYPE_OBSERVER );

                  if ($rez !== false) {

                      if (is_null($specialPriceToDateOld) || $specialPriceToDateOld === false || $specialPriceToDateOld == '') {
                          $specialPriceToDateOld = 'None';
                      }

                      if (is_null($specialPriceToDateNew) || $specialPriceToDateNew === false || $specialPriceToDateNew == '') {
                          $specialPriceToDateNew = 'None';
                      }

                      foreach ($listingArray as $listingTemp) {

                          $tempLog = Mage::getModel('M2ePro/Listing_Log');
                          $tempLog->setComponentMode($listingTemp['component_mode']);
                          $tempLog->addProductMessage($listingTemp['id'],
                                                     $productNew->getId(),
                                                     Ess_M2ePro_Model_Listing_Log::INITIATOR_EXTENSION,
                                                     NULL,
                                                     Ess_M2ePro_Model_Listing_Log::ACTION_CHANGE_PRODUCT_SPECIAL_PRICE_TO_DATE,
                                                     // Parser hack -> Mage::helper('M2ePro')->__('From [%from%] to [%to%]');
                                                     // Parser hack -> Mage::helper('M2ePro')->__('None');
                                                     Mage::getModel('M2ePro/Log_Abstract')->encodeDescription('From [%from%] to [%to%]',array('!from'=>$specialPriceToDateOld,'!to'=>$specialPriceToDateNew)),
                                                     Ess_M2ePro_Model_Listing_Log::TYPE_NOTICE,
                                                     Ess_M2ePro_Model_Listing_Log::PRIORITY_LOW );
                      }
                  }
                  //--------------------

                  // Save changes for custom attributes
                  //--------------------
                  /** @var $magentoProductModel Ess_M2ePro_Model_Magento_Product */
                  $magentoProductModel = Mage::getModel('M2ePro/Magento_Product')->setProduct($productNew);

                  foreach ($this->_productCustomAttributes as $attribute) {

                      $customAttributeOld = $attribute['value_old'];
                      $customAttributeNew = $magentoProductModel->getAttributeValue($attribute['attribute']);

                      $rez = Mage::getModel('M2ePro/ProductChange')
                                    ->updateAttribute(  $productNew->getId(),
                                                        $attribute['attribute'],
                                                        $customAttributeOld,
                                                        $customAttributeNew,
                                                        Ess_M2ePro_Model_ProductChange::CREATOR_TYPE_OBSERVER );

                      if ($rez !== false) {

                          $customAttributeOld = $this->cutAttributeLength($customAttributeOld);
                          $customAttributeNew = $this->cutAttributeLength($customAttributeNew);

                          foreach ($attribute['listings'] as $listingTemp) {

                                 $tempLog = Mage::getModel('M2ePro/Listing_Log');
                                 $tempLog->setComponentMode($listingTemp['component_mode']);
                                 $tempLog->addProductMessage($listingTemp['id'],
                                                             $productNew->getId(),
                                                             Ess_M2ePro_Model_Listing_Log::INITIATOR_EXTENSION,
                                                             NULL,
                                                             Ess_M2ePro_Model_Listing_Log::ACTION_CHANGE_CUSTOM_ATTRIBUTE,
                                                             // Parser hack -> Mage::helper('M2ePro')->__('Attribute "%attr%" from [%from%] to [%to%]');
                                                             Mage::getModel('M2ePro/Log_Abstract')->encodeDescription('Attribute "%attr%" from [%from%] to [%to%]',array('!attr'=>$attribute['attribute'],'!from'=>$customAttributeOld,'!to'=>$customAttributeNew)),
                                                             Ess_M2ePro_Model_Listing_Log::TYPE_NOTICE,
                                                             Ess_M2ePro_Model_Listing_Log::PRIORITY_LOW );
                              }
                      }
                  }
                  //--------------------

                  // Update listings products variations
                  //--------------------
                  foreach ($listingArray as $listingTemp) {

                      $listingsProductsTemp = Mage::getModel('M2ePro/Listing')
                                                        ->loadInstance($listingTemp['id'])
                                                        ->getProducts(true,array('product_id'=>$productNew->getId()));

                      foreach ($listingsProductsTemp as $listingProductTemp) {

                          $variationUpdaterModelPrefix = ucwords($listingProductTemp->getData('component_mode')).'_';
                          Mage::getModel('M2ePro/'.$variationUpdaterModelPrefix.'Listing_Product_Variation_Updater')
                                    ->updateVariations($listingProductTemp);
                      }
                  }
                  //--------------------
            }
            
            // Synch changes for categories
            //--------------------
            $categoriesNew = $productNew->getCategoryIds();

            $addedCategories = array_diff($categoriesNew,$this->_productCategoriesOld);
            foreach ($addedCategories as $categoryId) {
               Ess_M2ePro_Model_Observer_Category::synchChangesWithListings($categoryId,$productNew->getStoreId(),array($productNew),array());
            }

            $deletedCategories = array_diff($this->_productCategoriesOld,$categoriesNew);
            foreach ($deletedCategories as $categoryId) {
               Ess_M2ePro_Model_Observer_Category::synchChangesWithListings($categoryId,$productNew->getStoreId(),array(),array($productNew));
            }
            //--------------------

        } catch (Exception $exception) {

            Mage::helper('M2ePro/Exception')->process($exception,true);
            return;
        }
    }

    //-----------------------------------

    public function catalogProductDeleteBefore(Varien_Event_Observer $observer)
    {
        try {

            $productDeleted = $observer->getEvent()->getProduct();

            if (!($productDeleted instanceof Mage_Catalog_Model_Product)) {
                return;
            }

            $productId = $productDeleted->getId();
            $listingsData = array();

            $listingsProductsVariationsOptions = Mage::getModel('M2ePro/Listing_Product_Variation_Option')
                ->getCollection()
                ->addFieldToFilter('product_id', $productId)
                ->getItems();

            foreach ($listingsProductsVariationsOptions as $listingsProductsVariationsOption) {
                $listingsProduct = $listingsProductsVariationsOption->getListingProduct();
                $listingsData[] = array(
                    'listing_id' => $listingsProduct->getData('listing_id'),
                    'component_mode' => $listingsProduct->getData('component_mode')
                );
                if ($listingsProduct->getStatus() == Ess_M2ePro_Model_Listing_Product::STATUS_LISTED) {
                    try {
                        $listingsProduct->stopAction();
                    } catch (Exception $exception) {
                        Mage::helper('M2ePro/Exception')->process($exception,true);
                    }
                }
                $listingsProduct->setStatus(Ess_M2ePro_Model_Listing_Product::STATUS_NOT_LISTED)->save();
                $productVariations = $listingsProduct->getVariations(true);

                foreach ($productVariations as $productVariation) {
                    $productVariation->deleteInstance();
                }
            }

            $listingsData = array_unique($listingsData);

            foreach ($listingsData as $data) {
                Mage::getModel('M2ePro/Listing_Log')
                    ->setComponentMode($data['component_mode'])
                    ->addProductMessage($data['listing_id'],
                                        $productId,
                                        Ess_M2ePro_Model_Listing_Log::INITIATOR_EXTENSION,
                                        NULL,
                                        Ess_M2ePro_Model_Listing_Log::ACTION_DELETE_PRODUCT_FROM_MAGENTO,
                                        // Parser hack -> Mage::helper('M2ePro')->__('Variation option was deleted. Item was reset.');
                                        'Variation option was deleted. Item was reset.',
                                        Ess_M2ePro_Model_Listing_Log::TYPE_WARNING,
                                        Ess_M2ePro_Model_Listing_Log::PRIORITY_HIGH);
            }

            $listingsData = array();

            $listingsProducts = Mage::getModel('M2ePro/Listing_Product')
                ->getCollection()
                ->addFieldToFilter('product_id', $productId)
                ->getItems();

            foreach ($listingsProducts as $listingsProduct) {
                $listingsData[] = array(
                    'listing_id' => $listingsProduct->getData('listing_id'),
                    'component_mode' => $listingsProduct->getData('component_mode')
                );

                if ($listingsProduct->getStatus() == Ess_M2ePro_Model_Listing_Product::STATUS_LISTED) {
                    try {
                        $listingsProduct->stopAction(array('remove' => true));
                    } catch (Exception $exception) {
                        Mage::helper('M2ePro/Exception')->process($exception,true);
                    }
                }
                $temp = Mage::getModel('M2ePro/Listing_Product')->load($listingsProduct->getId());
                if ($temp->getId()) {
                    $temp->setStatus(Ess_M2ePro_Model_Listing_Product::STATUS_NOT_LISTED)->save();
                    $temp->deleteInstance();
                }
            }

            $productsChangesItems = Mage::getModel('M2ePro/ProductChange')
                ->getCollection()
                ->addFieldToFilter('product_id', $productId)
                ->getItems();
            foreach ($productsChangesItems as $item) {
                $item->delete();
            }

            $listingsData = array_unique($listingsData);

            foreach ($listingsData as $data) {
                Mage::getModel('M2ePro/Listing_Log')
                    ->setComponentMode($data['component_mode'])
                    ->addProductMessage($data['listing_id'],
                                        $productId,
                                        Ess_M2ePro_Model_Listing_Log::INITIATOR_EXTENSION,
                                        NULL,
                                        Ess_M2ePro_Model_Listing_Log::ACTION_DELETE_PRODUCT_FROM_MAGENTO,
                                        NULL,
                                        Ess_M2ePro_Model_Listing_Log::TYPE_WARNING,
                                        Ess_M2ePro_Model_Listing_Log::PRIORITY_HIGH );
            }

        } catch (Exception $exception) {

            Mage::helper('M2ePro/Exception')->process($exception,true);
            return;
        }
    }

    //####################################

    private function getCustomAttributes($listingsArray)
    {
        try {

            $attributes = array();

            foreach ($listingsArray as $listingTemp) {

                /** @var $listingModel Ess_M2ePro_Model_Listing */
                $listingModel = Mage::getModel('M2ePro/Listing')->loadInstance($listingTemp['id']);

                $tempAttributesGeneralTemplate = $listingModel->getGeneralTemplate()->getUsedAttributes();
                $tempAttributesSellingFormatTemplate = $listingModel->getSellingFormatTemplate()->getUsedAttributes();
                $tempAttributesDescriptionTemplate = $listingModel->getDescriptionTemplate()->getUsedAttributes();

                $tempListingAttributes = array_merge($tempAttributesGeneralTemplate,$tempAttributesSellingFormatTemplate);
                $tempListingAttributes = array_merge($tempListingAttributes,$tempAttributesDescriptionTemplate);
                $tempListingAttributes = array_unique($tempListingAttributes);

                foreach ($tempListingAttributes as $attribute) {

                    $hash = md5($attribute);

                    if (!isset($attributes[$hash])) {
                        $attributes[$hash] = array(
                            'attribute' => $attribute,
                            'listings' => array($listingTemp)
                        );
                    } else {
                        $attributes[$hash]['listings'][] = $listingTemp;
                    }
                }
            }

        } catch (Exception $exception) {

            Mage::helper('M2ePro/Exception')->process($exception,true);
            return array();
        }

        return array_values($attributes);
    }

    private function cutAttributeLength($attribute, $length = 50)
    {
        if (strlen($attribute) > $length) {
            return substr($attribute, 0, $length) . ' ...';
        }

        return $attribute;
    }

    //####################################
}