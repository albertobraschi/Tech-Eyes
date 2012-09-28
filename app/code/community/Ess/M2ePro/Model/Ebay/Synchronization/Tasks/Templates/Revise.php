<?php

/*
 * @copyright  Copyright (c) 2011 by  ESS-UA.
 */

class Ess_M2ePro_Model_Ebay_Synchronization_Tasks_Templates_Revise extends Ess_M2ePro_Model_Ebay_Synchronization_Tasks
{
    const PERCENTS_START = 15;
    const PERCENTS_END = 30;
    const PERCENTS_INTERVAL = 15;

    private $_synchronizations = array();

    private $_checkedQtyListingsProductsIds = array();
    private $_checkedPriceListingsProductsIds = array();

    //####################################

    public function __construct()
    {
        parent::__construct();
        $this->_synchronizations = Mage::helper('M2ePro')->getGlobalValue('synchTemplatesArray');
    }

    //####################################

    public function process()
    {
        // PREPARE SYNCH
        //---------------------------
        $this->prepareSynch();
        //---------------------------

        // RUN SYNCH
        //---------------------------
        $this->execute();
        //---------------------------

        // CANCEL SYNCH
        //---------------------------
        $this->cancelSynch();
        //---------------------------
    }

    //####################################

    private function prepareSynch()
    {
        $this->_lockItem->activate();

        if (count(Mage::helper('M2ePro/Component')->getEnabledComponents()) > 1) {
            $componentName = Ess_M2ePro_Helper_Component_Ebay::TITLE.' ';
        } else {
            $componentName = '';
        }

        $this->_profiler->addEol();
        $this->_profiler->addTitle($componentName.'Revise Actions');
        $this->_profiler->addTitle('--------------------------');
        $this->_profiler->addTimePoint(__CLASS__,'Total time');
        $this->_profiler->increaseLeftPadding(5);

        $this->_lockItem->setPercents(self::PERCENTS_START);
        $this->_lockItem->setStatus(Mage::helper('M2ePro')->__('The "Revise" action is started. Please wait...'));
    }

    private function cancelSynch()
    {
        $this->_lockItem->setPercents(self::PERCENTS_END);
        $this->_lockItem->setStatus(Mage::helper('M2ePro')->__('The "Revise" action is finished. Please wait...'));

        $this->_profiler->decreaseLeftPadding(5);
        $this->_profiler->addTitle('--------------------------');
        $this->_profiler->saveTimePoint(__CLASS__);

        $this->_lockItem->activate();
    }

    //####################################

    private function execute()
    {
        $this->executeQtyChanged();

        $this->_lockItem->setPercents(self::PERCENTS_START + 1*self::PERCENTS_INTERVAL/9);
        $this->_lockItem->activate();

        $this->executePriceChanged();

        $this->_lockItem->setPercents(self::PERCENTS_START + 2*self::PERCENTS_INTERVAL/9);
        $this->_lockItem->activate();

        //-------------------------

        $this->executeSpecialPriceIntervalChanged();

        $this->_lockItem->setPercents(self::PERCENTS_START + 3*self::PERCENTS_INTERVAL/9);
        $this->_lockItem->activate();

        //-------------------------

        $this->executeTitleChanged();

        $this->_lockItem->setPercents(self::PERCENTS_START + 4*self::PERCENTS_INTERVAL/9);
        $this->_lockItem->activate();

        $this->executeSubTitleChanged();

        $this->_lockItem->setPercents(self::PERCENTS_START + 5*self::PERCENTS_INTERVAL/9);
        $this->_lockItem->activate();

        $this->executeDescriptionChanged();

        $this->_lockItem->setPercents(self::PERCENTS_START + 6*self::PERCENTS_INTERVAL/9);
        $this->_lockItem->activate();

        //-------------------------

        $this->executeSellingFormatTemplatesChanged();

        $this->_lockItem->setPercents(self::PERCENTS_START + 7*self::PERCENTS_INTERVAL/9);
        $this->_lockItem->activate();

        $this->executeDescriptionsTemplatesChanged();

        $this->_lockItem->setPercents(self::PERCENTS_START + 8*self::PERCENTS_INTERVAL/9);
        $this->_lockItem->activate();

        $this->executeGeneralsTemplatesChanged();
    }

    //####################################

    private function executeQtyChanged()
    {
        $this->_profiler->addTimePoint(__METHOD__,'Update quantity');

        // Get attributes for products changes
        //------------------------------------
        $attributesForProductsChanges = array();
        $attributesForProductsChanges[] = 'product_instance';
        //------------------------------------

        // Get changed listings products
        //------------------------------------
        $changedListingsProducts = Mage::getModel('M2ePro/Listing_Product')->getChangedItemsByAttributes($attributesForProductsChanges);
        //------------------------------------

        // Filter only needed listings products
        //------------------------------------
        foreach ($changedListingsProducts as $changedListingProduct) {

            /** @var $listingProduct Ess_M2ePro_Model_Listing_Product */

            $listingProduct = Mage::helper('M2ePro/Component_Ebay')->getObject('Listing_Product',$changedListingProduct['id']);

            $this->inspectReviseQtyRequirements($listingProduct);
        }
        //------------------------------------

        // Get changed listings products variations options
        //------------------------------------
        $changedListingsProductsVariationsOptions = Mage::getModel('M2ePro/Listing_Product_Variation_Option')->getChangedItemsByAttributes($attributesForProductsChanges);
        //------------------------------------

        // Filter only needed listings products variations options
        //------------------------------------
        foreach ($changedListingsProductsVariationsOptions as $changedListingProductVariationOption) {

            /** @var $listingProductVariationOption Ess_M2ePro_Model_Listing_Product_Variation_Option */

            $listingProductVariationOption = Mage::helper('M2ePro/Component_Ebay')->getObject('Listing_Product_Variation_Option',$changedListingProductVariationOption['id']);

            $this->inspectReviseQtyRequirements($listingProductVariationOption->getListingProduct());
        }
        //------------------------------------

        $this->_profiler->saveTimePoint(__METHOD__);
    }

    private function executePriceChanged()
    {
        $this->_profiler->addTimePoint(__METHOD__,'Update price');

        // Get attributes for products changes
        //------------------------------------
        $attributesForProductsChanges = array();
        $attributesForProductsChanges[] = 'product_instance';
        //------------------------------------

        // Get changed listings products
        //------------------------------------
        $changedListingsProducts = Mage::getModel('M2ePro/Listing_Product')->getChangedItemsByAttributes($attributesForProductsChanges);
        //------------------------------------

        // Filter only needed listings products
        //------------------------------------
        foreach ($changedListingsProducts as $changedListingProduct) {

            /** @var $listingProduct Ess_M2ePro_Model_Listing_Product */

            $listingProduct = Mage::helper('M2ePro/Component_Ebay')->getObject('Listing_Product',$changedListingProduct['id']);

            $this->inspectRevisePriceRequirements($listingProduct);
        }
        //------------------------------------

        // Get changed listings products variations options
        //------------------------------------
        $changedListingsProductsVariationsOptions = Mage::getModel('M2ePro/Listing_Product_Variation_Option')->getChangedItemsByAttributes($attributesForProductsChanges);
        //------------------------------------

        // Filter only needed listings products variations options
        //------------------------------------
        foreach ($changedListingsProductsVariationsOptions as $changedListingProductVariationOption) {

            /** @var $listingProductVariationOption Ess_M2ePro_Model_Listing_Product_Variation_Option */

            $listingProductVariationOption = Mage::helper('M2ePro/Component_Ebay')->getObject('Listing_Product_Variation_Option',$changedListingProductVariationOption['id']);

            $this->inspectRevisePriceRequirements($listingProductVariationOption->getListingProduct());
        }
        //------------------------------------

        $this->_profiler->saveTimePoint(__METHOD__);
    }

    //-----------------------------------

    private function executeSpecialPriceIntervalChanged()
    {
        $this->_profiler->addTimePoint(__METHOD__,'Update special price interval');

        // Get attributes for products changes
        //------------------------------------
        $attributesForProductChange = array();
        $attributesForProductChange[] = 'special_price_from_date';
        $attributesForProductChange[] = 'special_price_to_date';
        //------------------------------------

        // Get changed listings products
        //------------------------------------
        $changedListingsProducts = Mage::getModel('M2ePro/Listing_Product')->getChangedItemsByAttributes($attributesForProductChange);
        //------------------------------------

        // Filter only needed listings products
        //------------------------------------
        foreach ($changedListingsProducts as $changedListingProduct) {

            /** @var $listingProduct Ess_M2ePro_Model_Listing_Product */

            $listingProduct = Mage::helper('M2ePro/Component_Ebay')->getObject('Listing_Product',$changedListingProduct['id']);

            if (!$listingProduct->isListed()) {
                continue;
            }

            if ($this->_runnerActions->isExistProductAction($listingProduct,Ess_M2ePro_Model_Connector_Server_Ebay_Item_Dispatcher::ACTION_REVISE,array('only_data'=>array('price'=>true,'variations'=>true)))) {
                continue;
            }

            if (!$listingProduct->getListing()->isSynchronizationNowRun()) {
                continue;
            }

            $attributeNeeded = '';

            $src = $listingProduct->getSellingFormatTemplate()->getChildObject()->getStartPriceSource();
            if ($src['mode'] == Ess_M2ePro_Model_Ebay_Template_SellingFormat::PRICE_PRODUCT) {
                $attributeNeeded = 'price';
            }
            if ($src['mode'] == Ess_M2ePro_Model_Ebay_Template_SellingFormat::PRICE_SPECIAL) {
                $attributeNeeded = 'special_price';
            }
            if ($src['mode'] == Ess_M2ePro_Model_Ebay_Template_SellingFormat::PRICE_ATTRIBUTE) {
                $attributeNeeded = $src['attribute'];
            }

            if ($attributeNeeded != 'special_price') {

                $src = $listingProduct->getSellingFormatTemplate()->getChildObject()->getReservePriceSource();
                if ($src['mode'] == Ess_M2ePro_Model_Ebay_Template_SellingFormat::PRICE_PRODUCT) {
                    $attributeNeeded = 'price';
                }
                if ($src['mode'] == Ess_M2ePro_Model_Ebay_Template_SellingFormat::PRICE_SPECIAL) {
                    $attributeNeeded = 'special_price';
                }
                if ($src['mode'] == Ess_M2ePro_Model_Ebay_Template_SellingFormat::PRICE_ATTRIBUTE) {
                    $attributeNeeded = $src['attribute'];
                }

                if ($attributeNeeded != 'special_price') {

                    $src = $listingProduct->getSellingFormatTemplate()->getChildObject()->getBuyItNowPriceSource();
                    if ($src['mode'] == Ess_M2ePro_Model_Ebay_Template_SellingFormat::PRICE_PRODUCT) {
                        $attributeNeeded = 'price';
                    }
                    if ($src['mode'] == Ess_M2ePro_Model_Ebay_Template_SellingFormat::PRICE_SPECIAL) {
                        $attributeNeeded = 'special_price';
                    }
                    if ($src['mode'] == Ess_M2ePro_Model_Ebay_Template_SellingFormat::PRICE_ATTRIBUTE) {
                        $attributeNeeded = $src['attribute'];
                    }

                    if ($attributeNeeded != 'special_price') {
                        continue;
                    }
                }
            }

            if (!$listingProduct->getSynchronizationTemplate()->getChildObject()->isReviseWhenChangePrice()) {
                continue;
            }

            if (!$listingProduct->isRevisable()) {
                continue;
            }

            $this->_runnerActions->setProduct($listingProduct,Ess_M2ePro_Model_Connector_Server_Ebay_Item_Dispatcher::ACTION_REVISE,array('only_data'=>array('price'=>true,'variations'=>true)));
        }
        //------------------------------------

        // Get changed listings products variations options
        //------------------------------------
        $changedListingsProductsVariationsOptions = Mage::getModel('M2ePro/Listing_Product_Variation_Option')->getChangedItemsByAttributes($attributesForProductChange);
        //------------------------------------

        // Filter only needed listings products variations options
        //------------------------------------
        foreach ($changedListingsProductsVariationsOptions as $changedListingProductVariationOption) {

            /** @var $listingProductVariationOption Ess_M2ePro_Model_Listing_Product_Variation_Option */

            $listingProductVariationOption = Mage::helper('M2ePro/Component_Ebay')->getObject('Listing_Product_Variation_Option',$changedListingProductVariationOption['id']);

            if (!$listingProductVariationOption->getListingProduct()->isListed()) {
                continue;
            }

            if ($this->_runnerActions->isExistProductAction($listingProductVariationOption->getListingProduct(),Ess_M2ePro_Model_Connector_Server_Ebay_Item_Dispatcher::ACTION_REVISE,array('only_data'=>array('variations'=>true)))) {
                continue;
            }

            if (!$listingProductVariationOption->getListingProduct()->getMagentoProduct()->isSimpleTypeWithCustomOptions() &&
                !$listingProductVariationOption->getListingProduct()->getMagentoProduct()->isGroupedType()) {
                continue;
            }

            if (!$listingProductVariationOption->getListing()->isSynchronizationNowRun()) {
                continue;
            }

            $attributeNeeded = '';

            $src = $listingProductVariationOption->getSellingFormatTemplate()->getChildObject()->getStartPriceSource();
            if ($src['mode'] == Ess_M2ePro_Model_Ebay_Template_SellingFormat::PRICE_PRODUCT) {
                $attributeNeeded = 'price';
            }
            if ($src['mode'] == Ess_M2ePro_Model_Ebay_Template_SellingFormat::PRICE_SPECIAL) {
                $attributeNeeded = 'special_price';
            }
            if ($src['mode'] == Ess_M2ePro_Model_Ebay_Template_SellingFormat::PRICE_ATTRIBUTE) {
                $attributeNeeded = $src['attribute'];
            }

            if ($attributeNeeded != 'special_price') {

                $src = $listingProductVariationOption->getSellingFormatTemplate()->getChildObject()->getReservePriceSource();
                if ($src['mode'] == Ess_M2ePro_Model_Ebay_Template_SellingFormat::PRICE_PRODUCT) {
                    $attributeNeeded = 'price';
                }
                if ($src['mode'] == Ess_M2ePro_Model_Ebay_Template_SellingFormat::PRICE_SPECIAL) {
                    $attributeNeeded = 'special_price';
                }
                if ($src['mode'] == Ess_M2ePro_Model_Ebay_Template_SellingFormat::PRICE_ATTRIBUTE) {
                    $attributeNeeded = $src['attribute'];
                }

                if ($attributeNeeded != 'special_price') {

                    $src = $listingProductVariationOption->getSellingFormatTemplate()->getChildObject()->getBuyItNowPriceSource();
                    if ($src['mode'] == Ess_M2ePro_Model_Ebay_Template_SellingFormat::PRICE_PRODUCT) {
                        $attributeNeeded = 'price';
                    }
                    if ($src['mode'] == Ess_M2ePro_Model_Ebay_Template_SellingFormat::PRICE_SPECIAL) {
                        $attributeNeeded = 'special_price';
                    }
                    if ($src['mode'] == Ess_M2ePro_Model_Ebay_Template_SellingFormat::PRICE_ATTRIBUTE) {
                        $attributeNeeded = $src['attribute'];
                    }

                    if ($attributeNeeded != 'special_price') {
                        continue;
                    }
                }
            }

            if (!$listingProductVariationOption->getSynchronizationTemplate()->getChildObject()->isReviseWhenChangePrice()) {
                continue;
            }

            if (!$listingProductVariationOption->getListingProduct()->isRevisable()) {
                continue;
            }

            $this->_runnerActions->setProduct($listingProductVariationOption->getListingProduct(),Ess_M2ePro_Model_Connector_Server_Ebay_Item_Dispatcher::ACTION_REVISE,array('only_data'=>array('variations'=>true)));
        }
        //------------------------------------

        $this->_profiler->saveTimePoint(__METHOD__);
    }

    //####################################

    private function executeTitleChanged()
    {
        $this->_profiler->addTimePoint(__METHOD__,'Update title');

        // Get attributes for products changes
        //------------------------------------
        $attributesForProductChange = array();

        foreach ($this->_synchronizations as &$synchronization) {

            if (!$synchronization['instance']->getChildObject()->isReviseWhenChangeTitle()) {
                continue;
            }

            foreach ($synchronization['listings'] as &$listing) {

                /** @var $listing Ess_M2ePro_Model_Listing */
                
                if (!$listing->isSynchronizationNowRun()) {
                    continue;
                }

                $attributesForProductChange = array_merge($attributesForProductChange,$listing->getDescriptionTemplate()->getChildObject()->getTitleAttributes());
            }
        }

        $attributesForProductChange = array_unique($attributesForProductChange);
        //------------------------------------

        // Get changed listings products
        //------------------------------------
        $changedListingsProducts = Mage::getModel('M2ePro/Listing_Product')->getChangedItemsByAttributes($attributesForProductChange);
        //------------------------------------

        // Filter only needed listings products
        //------------------------------------
        foreach ($changedListingsProducts as $changedListingProduct) {

            /** @var $listingProduct Ess_M2ePro_Model_Listing_Product */

            $listingProduct = Mage::helper('M2ePro/Component_Ebay')->getObject('Listing_Product',$changedListingProduct['id']);

            if (!$listingProduct->isListed()) {
                continue;
            }

            if ($this->_runnerActions->isExistProductAction($listingProduct,Ess_M2ePro_Model_Connector_Server_Ebay_Item_Dispatcher::ACTION_REVISE,array('only_data'=>array('title'=>true)))) {
                continue;
            }

            if (!$listingProduct->getListing()->isSynchronizationNowRun()) {
                continue;
            }

            if (!in_array($changedListingProduct['pc_attribute'],$listingProduct->getDescriptionTemplate()->getChildObject()->getTitleAttributes())) {
                continue;
            }

            if (!$listingProduct->getSynchronizationTemplate()->getChildObject()->isReviseWhenChangeTitle()) {
                continue;
            }

            if (!$listingProduct->isRevisable()) {
                continue;
            }

            $this->_runnerActions->setProduct($listingProduct,Ess_M2ePro_Model_Connector_Server_Ebay_Item_Dispatcher::ACTION_REVISE,array('only_data'=>array('title'=>true)));
        }
        //------------------------------------

        // Get changed listings products variations options
        //------------------------------------
        $changedListingsProductsVariationsOptions = Mage::getModel('M2ePro/Listing_Product_Variation_Option')->getChangedItemsByAttributes(array('name'));
        //------------------------------------

        // Filter only needed listings products variations options
        //------------------------------------
        foreach ($changedListingsProductsVariationsOptions as $changedListingProductVariationOption) {

            /** @var $listingProductVariationOption Ess_M2ePro_Model_Listing_Product_Variation_Option */
            
            $listingProductVariationOption = Mage::helper('M2ePro/Component_Ebay')->getObject('Listing_Product_Variation_Option',$changedListingProductVariationOption['id']);

            if (!$listingProductVariationOption->getListingProduct()->isListed()) {
                continue;
            }

            if ($this->_runnerActions->isExistProductAction($listingProductVariationOption->getListingProduct(),Ess_M2ePro_Model_Connector_Server_Ebay_Item_Dispatcher::ACTION_REVISE,array('only_data'=>array('variations'=>true)))) {
                continue;
            }
            
            if (!$listingProductVariationOption->getListing()->isSynchronizationNowRun()) {
                continue;
            }

            if (!$listingProductVariationOption->getSynchronizationTemplate()->getChildObject()->isReviseWhenChangeTitle()) {
                continue;
            }

            if (!$listingProductVariationOption->getListingProduct()->isRevisable()) {
                continue;
            }

            $this->_runnerActions->setProduct($listingProductVariationOption->getListingProduct(),Ess_M2ePro_Model_Connector_Server_Ebay_Item_Dispatcher::ACTION_REVISE,array('only_data'=>array('variations'=>true)));
        }
        //------------------------------------

        $this->_profiler->saveTimePoint(__METHOD__);
    }

    private function executeSubTitleChanged()
    {
        $this->_profiler->addTimePoint(__METHOD__,'Update subtitle');

        // Get attributes for products changes
        //------------------------------------
        $attributesForProductChange = array();

        foreach ($this->_synchronizations as &$synchronization) {

            if (!$synchronization['instance']->getChildObject()->isReviseWhenChangeSubTitle()) {
                continue;
            }

            foreach ($synchronization['listings'] as &$listing) {

                /** @var $listing Ess_M2ePro_Model_Listing */
                
                if (!$listing->isSynchronizationNowRun()) {
                    continue;
                }

                $attributesForProductChange = array_merge($attributesForProductChange,$listing->getDescriptionTemplate()->getChildObject()->getSubTitleAttributes());
            }
        }

        $attributesForProductChange = array_unique($attributesForProductChange);
        //------------------------------------

        // Get changed listings products
        //------------------------------------
        $changedListingsProducts = Mage::getModel('M2ePro/Listing_Product')->getChangedItemsByAttributes($attributesForProductChange);
        //------------------------------------

        // Filter only needed listings products
        //------------------------------------
        foreach ($changedListingsProducts as $changedListingProduct) {

            /** @var $listingProduct Ess_M2ePro_Model_Listing_Product */
            
            $listingProduct = Mage::helper('M2ePro/Component_Ebay')->getObject('Listing_Product',$changedListingProduct['id']);

            if (!$listingProduct->isListed()) {
                continue;
            }

            if ($this->_runnerActions->isExistProductAction($listingProduct,Ess_M2ePro_Model_Connector_Server_Ebay_Item_Dispatcher::ACTION_REVISE,array('only_data'=>array('subtitle'=>true)))) {
                continue;
            }

            if (!$listingProduct->getListing()->isSynchronizationNowRun()) {
                continue;
            }

            if (!in_array($changedListingProduct['pc_attribute'],$listingProduct->getDescriptionTemplate()->getChildObject()->getSubTitleAttributes())) {
                continue;
            }

            if (!$listingProduct->getSynchronizationTemplate()->getChildObject()->isReviseWhenChangeSubTitle()) {
                continue;
            }

            if (!$listingProduct->isRevisable()) {
                continue;
            }

            $this->_runnerActions->setProduct($listingProduct,Ess_M2ePro_Model_Connector_Server_Ebay_Item_Dispatcher::ACTION_REVISE,array('only_data'=>array('subtitle'=>true)));
        }
        //------------------------------------

        $this->_profiler->saveTimePoint(__METHOD__);
    }

    private function executeDescriptionChanged()
    {
        $this->_profiler->addTimePoint(__METHOD__,'Update description');

        // Get attributes for products changes
        //------------------------------------
        $attributesForProductChange = array();

        foreach ($this->_synchronizations as &$synchronization) {

            if (!$synchronization['instance']->getChildObject()->isReviseWhenChangeDescription()) {
                continue;
            }

            foreach ($synchronization['listings'] as &$listing) {

                /** @var $listing Ess_M2ePro_Model_Listing */
                
                if (!$listing->isSynchronizationNowRun()) {
                    continue;
                }

                $attributesForProductChange = array_merge($attributesForProductChange,$listing->getDescriptionTemplate()->getChildObject()->getDescriptionAttributes());
            }
        }

        $attributesForProductChange = array_unique($attributesForProductChange);
        //------------------------------------

        // Get changed listings products
        //------------------------------------
        $changedListingsProducts = Mage::getModel('M2ePro/Listing_Product')->getChangedItemsByAttributes($attributesForProductChange);
        //------------------------------------

        // Filter only needed listings products
        //------------------------------------
        foreach ($changedListingsProducts as $changedListingProduct) {

            /** @var $listingProduct Ess_M2ePro_Model_Listing_Product */
            
            $listingProduct = Mage::helper('M2ePro/Component_Ebay')->getObject('Listing_Product',$changedListingProduct['id']);

            if (!$listingProduct->isListed()) {
                continue;
            }

            if ($this->_runnerActions->isExistProductAction($listingProduct,Ess_M2ePro_Model_Connector_Server_Ebay_Item_Dispatcher::ACTION_REVISE,array('only_data'=>array('description'=>true)))) {
                continue;
            }

            if (!$listingProduct->getListing()->isSynchronizationNowRun()) {
                continue;
            }

            if (!in_array($changedListingProduct['pc_attribute'],$listingProduct->getDescriptionTemplate()->getChildObject()->getDescriptionAttributes())) {
                continue;
            }
            
            if (!$listingProduct->getSynchronizationTemplate()->getChildObject()->isReviseWhenChangeDescription()) {
                continue;
            }

            if (!$listingProduct->isRevisable()) {
                continue;
            }

            $this->_runnerActions->setProduct($listingProduct,Ess_M2ePro_Model_Connector_Server_Ebay_Item_Dispatcher::ACTION_REVISE,array('only_data'=>array('description'=>true)));
        }
        //------------------------------------

        $this->_profiler->saveTimePoint(__METHOD__);
    }

    //####################################

    private function executeSellingFormatTemplatesChanged()
    {
        $this->_profiler->addTimePoint(__METHOD__,'Update Selling Format Template');

        // Get changed templates
        //------------------------------------
        $templatesCollection = Mage::helper('M2ePro/Component_Ebay')->getModel('Template_SellingFormat')->getCollection();
        $templatesCollection->getSelect()->where('`main_table`.`update_date` != `main_table`.`synch_date`');
        $templatesCollection->getSelect()->orWhere('`main_table`.`synch_date` IS NULL');
        $templatesArray = $templatesCollection->toArray();
        //------------------------------------
        
        // Set eBay actions for listed products
        //------------------------------------
        foreach ($templatesArray['items'] as $templateArray) {

            /** @var $template Ess_M2ePro_Model_Template_SellingFormat */
            $template = Mage::helper('M2ePro/Component_Ebay')->getObject('Template_SellingFormat',$templateArray['id']);

            $listings = $template->getListings(true);

            foreach ($listings as $listing) {

                /** @var $listing Ess_M2ePro_Model_Listing */
                
                if (!$listing->isSynchronizationNowRun()) {
                    continue;
                }

                $listing->setSellingFormatTemplate($template);

                if (!$listing->getSynchronizationTemplate()->isReviseSellingFormatTemplate()) {
                    continue;
                }

                $listingsProducts = $listing->getProducts(true,array('status'=>array('in'=>array(Ess_M2ePro_Model_Listing_Product::STATUS_LISTED))));

                foreach ($listingsProducts as $listingProduct) {

                    /** @var $listingProduct Ess_M2ePro_Model_Listing_Product */

                    if (!$listingProduct->isListed()) {
                        continue;
                    }

                    if ($this->_runnerActions->isExistProductAction($listingProduct,Ess_M2ePro_Model_Connector_Server_Ebay_Item_Dispatcher::ACTION_REVISE,array('all_data'=>true))) {
                        continue;
                    }

                    $listingProduct->setListing($listing);

                    if (!$listingProduct->isRevisable()) {
                        continue;
                    }

                    $this->_runnerActions->setProduct($listingProduct,Ess_M2ePro_Model_Connector_Server_Ebay_Item_Dispatcher::ACTION_REVISE,array('all_data'=>true));
                }
            }

            $template->addData(array('synch_date'=>$template->getData('update_date')))->save();
        }
        //------------------------------------

        $this->_profiler->saveTimePoint(__METHOD__);
    }

    private function executeDescriptionsTemplatesChanged()
    {
        $this->_profiler->addTimePoint(__METHOD__,'Update description template');

        // Get changed templates
        //------------------------------------
        $templatesCollection = Mage::helper('M2ePro/Component_Ebay')->getModel('Template_Description')->getCollection();
        $templatesCollection->getSelect()->where('`main_table`.`update_date` != `main_table`.`synch_date`');
        $templatesCollection->getSelect()->orWhere('`main_table`.`synch_date` IS NULL');
        $templatesArray = $templatesCollection->toArray();
        //------------------------------------

        // Set eBay actions for listed products
        //------------------------------------
        foreach ($templatesArray['items'] as $templateArray) {

            /** @var $template Ess_M2ePro_Model_Template_Description */
            $template = Mage::helper('M2ePro/Component_Ebay')->getObject('Template_Description',$templateArray['id']);

            $listings = $template->getListings(true);

            foreach ($listings as $listing) {

                /** @var $listing Ess_M2ePro_Model_Listing */

                if (!$listing->isSynchronizationNowRun()) {
                    continue;
                }

                $listing->setDescriptionTemplate($template);

                if (!$listing->getSynchronizationTemplate()->isReviseDescriptionTemplate()) {
                    continue;
                }

                $listingsProducts = $listing->getProducts(true,array('status'=>array('in'=>array(Ess_M2ePro_Model_Listing_Product::STATUS_LISTED))));

                foreach ($listingsProducts as $listingProduct) {

                    /** @var $listingProduct Ess_M2ePro_Model_Listing_Product */

                    if (!$listingProduct->isListed()) {
                        continue;
                    }

                    if ($this->_runnerActions->isExistProductAction($listingProduct,Ess_M2ePro_Model_Connector_Server_Ebay_Item_Dispatcher::ACTION_REVISE,array('all_data'=>true))) {
                        continue;
                    }

                    $listingProduct->setListing($listing);

                    if (!$listingProduct->isRevisable()) {
                        continue;
                    }

                    $this->_runnerActions->setProduct($listingProduct,Ess_M2ePro_Model_Connector_Server_Ebay_Item_Dispatcher::ACTION_REVISE,array('all_data'=>true));
                }
            }

            $template->addData(array('synch_date'=>$template->getData('update_date')))->save();
        }
        //------------------------------------

        $this->_profiler->saveTimePoint(__METHOD__);
    }

    private function executeGeneralsTemplatesChanged()
    {
        $this->_profiler->addTimePoint(__METHOD__,'Update general template');

        // Get changed templates
        //------------------------------------
        $templatesCollection = Mage::helper('M2ePro/Component_Ebay')->getModel('Template_General')->getCollection();
        $templatesCollection->getSelect()->where('`main_table`.`update_date` != `main_table`.`synch_date`');
        $templatesCollection->getSelect()->orWhere('`main_table`.`synch_date` IS NULL');
        $templatesArray = $templatesCollection->toArray();
        //------------------------------------

        // Set eBay actions for listed products
        //------------------------------------
        foreach ($templatesArray['items'] as $templateArray) {

            /** @var $template Ess_M2ePro_Model_Template_General */
            $template = Mage::helper('M2ePro/Component_Ebay')->getObject('Template_General',$templateArray['id']);

            $listings = $template->getListings(true);

            foreach ($listings as $listing) {

                /** @var $listing Ess_M2ePro_Model_Listing */

                if (!$listing->isSynchronizationNowRun()) {
                    continue;
                }

                $listing->setGeneralTemplate($template);

                if (!$listing->getSynchronizationTemplate()->isReviseGeneralTemplate()) {
                    continue;
                }

                $listingsProducts = $listing->getProducts(true,array('status'=>array('in'=>array(Ess_M2ePro_Model_Listing_Product::STATUS_LISTED))));

                foreach ($listingsProducts as $listingProduct) {

                    /** @var $listingProduct Ess_M2ePro_Model_Listing_Product */
                    
                    if (!$listingProduct->isListed()) {
                        continue;
                    }

                    if ($this->_runnerActions->isExistProductAction($listingProduct,Ess_M2ePro_Model_Connector_Server_Ebay_Item_Dispatcher::ACTION_REVISE,array('all_data'=>true))) {
                        continue;
                    }

                    $listingProduct->setListing($listing);

                    if (!$listingProduct->isRevisable()) {
                        continue;
                    }

                    $this->_runnerActions->setProduct($listingProduct,Ess_M2ePro_Model_Connector_Server_Ebay_Item_Dispatcher::ACTION_REVISE,array('all_data'=>true));
                }
            }

            $template->addData(array('synch_date'=>$template->getData('update_date')))->save();
        }
        //------------------------------------

        $this->_profiler->saveTimePoint(__METHOD__);
    }

    //####################################

    private function inspectReviseQtyRequirements(Ess_M2ePro_Model_Listing_Product $listingProduct)
    {
        // Is checked before?
        //--------------------
        if (in_array($listingProduct->getId(),$this->_checkedQtyListingsProductsIds)) {
            return false;
        } else {
            $this->_checkedQtyListingsProductsIds[] = $listingProduct->getId();
        }
        //--------------------

        // Prepare actions params
        //--------------------
        $actionParams = array('only_data'=>array('qty'=>true,'variations'=>true));
        $isVariationProduct = !$listingProduct->getMagentoProduct()->isSimpleTypeWithoutCustomOptions();
        //--------------------

        // eBay available status
        //--------------------
        if (!$listingProduct->isListed()) {
            return false;
        }

        if (!$listingProduct->isRevisable()) {
            return false;
        }

        if ($this->_runnerActions->isExistProductAction($listingProduct,Ess_M2ePro_Model_Connector_Server_Ebay_Item_Dispatcher::ACTION_REVISE,$actionParams)) {
            return false;
        }
        //--------------------

        // Correct synchronization
        //--------------------
        if (!$listingProduct->getListing()->isSynchronizationNowRun()) {
            return false;
        }
        if (!$listingProduct->getSynchronizationTemplate()->getChildObject()->isReviseWhenChangeQty()) {
            return false;
        }
        //--------------------

        // Check filters
        //--------------------
        if (!$isVariationProduct) {

            $productQty = $listingProduct->getChildObject()->getQty();
            $channelQty = $listingProduct->getChildObject()->getOnlineQty() - $listingProduct->getChildObject()->getOnlineQtySold();

            if ($productQty > 0 && $productQty != $channelQty) {
                $this->_runnerActions->setProduct($listingProduct,Ess_M2ePro_Model_Connector_Server_Ebay_Item_Dispatcher::ACTION_REVISE,$actionParams);
                return true;
            }

        } else {

            $totalQty = 0;
            $hasChange = false;

            $variations = $listingProduct->getVariations(true);

            foreach ($variations as $variation) {

                /** @var $variation Ess_M2ePro_Model_Listing_Product_Variation */

                $productQty = $variation->getChildObject()->getQty();
                $channelQty = $variation->getChildObject()->getOnlineQty() - $variation->getChildObject()->getOnlineQtySold();

                if ($productQty != $channelQty && !$this->isHasVariationTheSale($listingProduct,$variation)) {
                    $hasChange = true;
                }

                $totalQty += $productQty;
            }

            if ($totalQty > 0 && $hasChange) {
                $this->_runnerActions->setProduct($listingProduct,Ess_M2ePro_Model_Connector_Server_Ebay_Item_Dispatcher::ACTION_REVISE,$actionParams);
                return true;
            }
        }
        //--------------------

        return false;
    }

    private function inspectRevisePriceRequirements(Ess_M2ePro_Model_Listing_Product $listingProduct)
    {
        // Is checked before?
        //--------------------
        if (in_array($listingProduct->getId(),$this->_checkedPriceListingsProductsIds)) {
            return false;
        } else {
            $this->_checkedPriceListingsProductsIds[] = $listingProduct->getId();
        }
        //--------------------

        // Prepare actions params
        //--------------------
        $actionParams = array('only_data'=>array('price'=>true,'variations'=>true));
        $isVariationProduct = !$listingProduct->getMagentoProduct()->isSimpleTypeWithoutCustomOptions();
        //--------------------

        // eBay available status
        //--------------------
        if (!$listingProduct->isListed()) {
            return false;
        }

        if (!$listingProduct->isRevisable()) {
            return false;
        }

        if ($this->_runnerActions->isExistProductAction($listingProduct,Ess_M2ePro_Model_Connector_Server_Ebay_Item_Dispatcher::ACTION_REVISE,$actionParams)) {
            return false;
        }
        //--------------------

        // Correct synchronization
        //--------------------
        if (!$listingProduct->getListing()->isSynchronizationNowRun()) {
            return false;
        }
        if (!$listingProduct->getSynchronizationTemplate()->getChildObject()->isReviseWhenChangePrice()) {
            return false;
        }
        //--------------------

        // Check filters
        //--------------------
        if (!$isVariationProduct) {

            $hasChange = false;

            //---------
            $currentPrice = $listingProduct->getChildObject()->getBuyItNowPrice();
            $onlinePrice = $listingProduct->getChildObject()->getOnlineBuyItNowPrice();

            if ($currentPrice != $onlinePrice) {
                $hasChange = true;
            }

            if ($hasChange) {
                $this->_runnerActions->setProduct($listingProduct,Ess_M2ePro_Model_Connector_Server_Ebay_Item_Dispatcher::ACTION_REVISE,$actionParams);
                return true;
            }
            //---------

            if ($listingProduct->getChildObject()->isListingTypeAuction()) {

                //---------
                $currentPrice = $listingProduct->getChildObject()->getStartPrice();
                $onlinePrice = $listingProduct->getChildObject()->getOnlineStartPrice();

                if ($currentPrice != $onlinePrice) {
                    $hasChange = true;
                }

                if ($hasChange) {
                    $this->_runnerActions->setProduct($listingProduct,Ess_M2ePro_Model_Connector_Server_Ebay_Item_Dispatcher::ACTION_REVISE,$actionParams);
                    return true;
                }
                //---------
                $currentPrice = $listingProduct->getChildObject()->getReservePrice();
                $onlinePrice = $listingProduct->getChildObject()->getOnlineReservePrice();

                if ($currentPrice != $onlinePrice) {
                    $hasChange = true;
                }

                if ($hasChange) {
                    $this->_runnerActions->setProduct($listingProduct,Ess_M2ePro_Model_Connector_Server_Ebay_Item_Dispatcher::ACTION_REVISE,$actionParams);
                    return true;
                }
                //---------
            }

        } else {

            $variations = $listingProduct->getVariations(true);

            foreach ($variations as $variation) {

                $currentPrice = $variation->getChildObject()->getPrice();
                $onlinePrice = $variation->getChildObject()->getOnlinePrice();

                if ($currentPrice != $onlinePrice) {
                    $this->_runnerActions->setProduct($listingProduct,Ess_M2ePro_Model_Connector_Server_Ebay_Item_Dispatcher::ACTION_REVISE,$actionParams);
                    return true;
                }
            }
        }
        //--------------------

        return false;
    }

    //------------------------------------

    private function isHasVariationTheSale(Ess_M2ePro_Model_Listing_Product $listingProduct,
                                           Ess_M2ePro_Model_Listing_Product_Variation $variation)
    {
        $currentSpecifics = array();

        $options = $variation->getOptions(true);
        foreach ($options as $option) {
            /** @var $option Ess_M2ePro_Model_Listing_Product_Variation_Option */
            $currentSpecifics[$option->getAttribute()] = $option->getOption();
        }

        ksort($currentSpecifics);
        $variationKeys = array_keys($currentSpecifics);
        $variationValues = array_values($currentSpecifics);

        $tempOrdersItemsCollection = Mage::getModel('M2ePro/Ebay_Order_Item')->getCollection();
        $tempOrdersItemsCollection->addFieldToFilter('item_id', $listingProduct->getChildObject()->getEbayItem()->getItemId());
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

            if (count($currentSpecifics) == count($variationOrder) &&
                count(array_diff($variationKeys,$orderItemVariationKeys)) <= 0 &&
                count(array_diff($variationValues,$orderItemVariationValues)) <= 0) {
                $findOrderItem = true;
                break;
            }
        }

        return $findOrderItem;
    }

    //####################################
}