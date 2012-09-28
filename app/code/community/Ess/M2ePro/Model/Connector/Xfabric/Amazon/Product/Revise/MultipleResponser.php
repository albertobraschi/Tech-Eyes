<?php

/*
 * @copyright  Copyright (c) 2011 by  ESS-UA.
 */

class Ess_M2ePro_Model_Connector_Xfabric_Amazon_Product_Revise_MultipleResponser extends Ess_M2ePro_Model_Connector_Xfabric_Amazon_Product_Responser
{
    // ########################################

    protected function validateSucceededResponseData($response)
    {
        if (!isset($response['updates'])) {
            return false;
        }

        return true;
    }

    protected function processSucceededListingsProducts(array $listingsProducts = array())
    {
        foreach ($listingsProducts as $listingProduct) {

            /** @var $listingProduct Ess_M2ePro_Model_Listing_Product */

            $requestData = $this->getListingProductRequestNativeData($listingProduct);

            $tempParams = array(
                'status_changer' => $this->getStatusChanger(),
                'qty' => $requestData['qty'],
                'price' => $requestData['price']
            );

            Mage::getModel('M2ePro/Connector_Xfabric_Amazon_Product_Helper')
                        ->updateAfterReviseAction($listingProduct,$tempParams);

            // Parser hack -> Mage::helper('M2ePro')->__('Item was successfully revised');
            $this->addListingsProductsLogsMessage($listingProduct, 'Item was successfully revised',
                                                  Ess_M2ePro_Model_Log_Abstract::TYPE_SUCCESS,
                                                  Ess_M2ePro_Model_Log_Abstract::PRIORITY_MEDIUM);
        }
    }

    // ########################################
}