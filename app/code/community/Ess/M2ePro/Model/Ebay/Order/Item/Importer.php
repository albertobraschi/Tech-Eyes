<?php

/*
 * @copyright  Copyright (c) 2011 by  ESS-UA.
 */

class Ess_M2ePro_Model_Ebay_Order_Item_Importer
{
    /** @var $item Ess_M2ePro_Model_Ebay_Order_Item */
    private $item = NULL;

    // ########################################

    public function setItem(Ess_M2ePro_Model_Ebay_Order_Item $item)
    {
        $this->item = $item;

        return $this;
    }

    // ########################################

    public function getDataFromChannel()
    {
        $params = array();
        $params['item_id'] = $this->item->getItemId();
        count($this->item->getVariation()) > 0 && $params['variation_sku'] = $this->item->getSku();

        $itemData = Mage::getModel('M2ePro/Connector_Server_Ebay_Dispatcher')
                                  ->processVirtual('item', 'get', 'info',
                                                   $params, 'result',
                                                   NULL, $this->item->getParentObject()->getOrder()->getAccount(), NULL);

        return $itemData;
    }

    // ########################################

    public function prepareDataForProductCreation(array $itemData)
    {
        $dataForProduct = array();

        $dataForProduct['title'] = trim(strip_tags($itemData['title']));
        $dataForProduct['short_description'] = trim(Mage::helper('M2ePro')->stripInvisibleTags($itemData['title']));

        $dataForProduct['description'] = isset($itemData['description']) ? $itemData['description'] : $dataForProduct['title'];
        //$dataForProduct['description'] = trim($dataForProduct['description']);
        $dataForProduct['description'] = Mage::helper('M2ePro')->stripInvisibleTags($dataForProduct['description']); // todo do we need this?

        $dataForProduct['sku'] = $itemData['sku'] != '' ? $itemData['sku'] : Mage::helper('M2ePro')->convertStringToSku($itemData['title']);
        $dataForProduct['sku'] = trim(strip_tags($dataForProduct['sku']));

        $dataForProduct['price'] = $this->getNewProductPrice($itemData);
        $dataForProduct['qty'] = $itemData['qty'] > 0 ? (int)$itemData['qty'] : 1;

        $dataForProduct['images'] = $this->getNewProductImages($itemData);

        return $dataForProduct;
    }

    private function getNewProductPrice(array $itemData)
    {
        $allowedCurrencies = Mage::getSingleton('directory/currency')->getConfigAllowCurrencies();
        $baseCurrencies = Mage::getSingleton('directory/currency')->getConfigBaseCurrencies();

        $isCurrencyAllowed = in_array($itemData['price_currency'], $allowedCurrencies);

        if ($isCurrencyAllowed && in_array($itemData['price_currency'], $baseCurrencies)) {
            return (float)$itemData['price'];
        }

        if (!$isCurrencyAllowed && !in_array($itemData['converted_price_currency'], $allowedCurrencies)) {
            return (float)$itemData['price'];
        }

        if (!$isCurrencyAllowed && in_array($itemData['converted_price_currency'], $baseCurrencies)) {
            return (float)$itemData['converted_price'];
        }

        $price = $isCurrencyAllowed ? $itemData['price'] : $itemData['converted_price_currency'];
        $currency = $isCurrencyAllowed ? $itemData['price_currency'] : $itemData['converted_price_currency'];

        $convertRate = Mage::getSingleton('directory/currency')->load($baseCurrencies[0])->getAnyRate($currency);
        $convertRate <= 0 && $convertRate = 1;

        return round($price / $convertRate, 2);
    }

    private function getNewProductImages(array $itemData)
    {
        if (count($itemData['pictureUrl']) == 0) {
            return array();
        }

        try {
            $destinationFolder = $this->createDestinationFolder($itemData['title']);
        } catch (Exception $e) {
            return array();
        }

        $images = array();
        $imageCounter = 1;

        foreach ($itemData['pictureUrl'] as $url) {
            preg_match('/\.(jpg|jpeg|png|gif)/', $url, $matches);

            $extension = isset($matches[0]) ? $matches[0] : '.jpg';
            $imagePath = $destinationFolder . DS . Mage::helper('M2ePro')->convertStringToSku($itemData['title']) . '-' . $imageCounter . $extension;

            try {
                $this->downloadImage($url, $imagePath);
            } catch (Exception $e) {
                continue;
            }

            $images[] = str_replace(Mage::getSingleton('catalog/product_media_config')->getBaseTmpMediaPath(), '', $imagePath);
            $imageCounter++;
        }

        return $images;
    }

    private function createDestinationFolder($itemTitle)
    {
        $baseTmpImageName = Mage::helper('M2ePro')->convertStringToSku($itemTitle);

        $destinationFolder = Mage::getSingleton('catalog/product_media_config')->getBaseTmpMediaPath();
        $destinationFolder .= DS . $baseTmpImageName{0} . DS . $baseTmpImageName{1};

        if (!(@is_dir($destinationFolder) || @mkdir($destinationFolder, 0777, true))) {
            throw new Exception("Unable to create directory '{$destinationFolder}'.");
        }

        return $destinationFolder;
    }


    // ########################################

    public function downloadImage($url, $imagePath)
    {
        // Prepare image file
        // ---------
        $fileHandler = fopen($imagePath, 'w+');
        // ---------

        // Send request
        // ---------
        $curlHandler = curl_init();
        curl_setopt($curlHandler, CURLOPT_URL, $url);

        curl_setopt($curlHandler, CURLOPT_FILE, $fileHandler);
        curl_setopt($curlHandler, CURLOPT_REFERER, $url);
        curl_setopt($curlHandler, CURLOPT_AUTOREFERER, 1);

        curl_exec($curlHandler);
        curl_close($curlHandler);

        fclose($fileHandler);
        // ---------

        // Check if download was successful
        // ---------
        $imageInfo = is_file($imagePath) ? getimagesize($imagePath) : NULL;

        if (empty($imageInfo)) {
            throw new Exception("Image {$url} was not downloaded.");
        }
        // ---------
    }

    // ########################################
}