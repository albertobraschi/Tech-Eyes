<?php

/*
 * @copyright  Copyright (c) 2011 by  ESS-UA.
 */

class Ess_M2ePro_Model_Ebay_Listing_Product_Variation_Updater extends Ess_M2ePro_Model_Listing_Product_Variation_Updater
{
    // ########################################

    public function __construct()
    {
        $this->setComponentMode(Ess_M2ePro_Helper_Component_Ebay::NICK);
    }

    // ########################################

    public function updateVariations(Ess_M2ePro_Model_Listing_Product $listingProduct)
    {
        if (!$listingProduct->getChildObject()->isListingTypeFixed() ||
            !$listingProduct->getGeneralTemplate()->getChildObject()->isVariationMode()) {
            return;
        }

        parent::updateVariations($listingProduct);
    }

    public function isAddedNewVariationsAttributes(Ess_M2ePro_Model_Listing_Product $listingProduct)
    {
        if (!$listingProduct->getChildObject()->isListingTypeFixed() ||
            !$listingProduct->getGeneralTemplate()->getChildObject()->isVariationMode()) {
            return false;
        }

        return parent::isAddedNewVariationsAttributes($listingProduct);
    }

    // ########################################
}