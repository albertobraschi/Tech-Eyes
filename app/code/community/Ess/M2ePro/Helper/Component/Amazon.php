<?php

/*
 * @copyright  Copyright (c) 2011 by  ESS-UA.
 */

class Ess_M2ePro_Helper_Component_Amazon extends Mage_Core_Helper_Abstract
{
    const NICK  = 'amazon';
    const TITLE = 'Amazon';

    const MARKETPLACE_US = 29;

    // ########################################

    public function isEnabled()
    {
        return (bool)Mage::helper('M2ePro/Module')->getConfig()->getGroupValue('/component/'.self::NICK.'/', 'mode');
    }

    public function isDefault()
    {
        return Mage::helper('M2ePro/Component')->getDefaultComponent() == self::NICK;
    }

    public function isObject($modelName, $value, $field = NULL)
    {
        $mode = Mage::helper('M2ePro/Component')->getComponentMode($modelName, $value, $field);
        return !is_null($mode) && $mode == self::NICK;
    }

    //-----------------------------------------

    public function getModel($modelName)
    {
        return Mage::helper('M2ePro/Component')->getComponentModel(self::NICK,$modelName);
    }

    public function getObject($modelName, $value, $field = NULL)
    {
        return Mage::helper('M2ePro/Component')->getComponentObject(self::NICK, $modelName, $value, $field);
    }

    public function getCollection($modelName)
    {
        return $this->getModel($modelName)->getCollection();
    }

    // ########################################

    public function getAccount($value, $field = NULL)
    {
        is_null($field) && $field = 'id';

        $cacheKey = self::NICK.'_ACCOUNT_DATA_'.$field.'_'.$value;
        $cacheData = Mage::helper('M2ePro')->getCacheValue($cacheKey);

        if ($cacheData === false) {
            $cacheData = $this->getObject('Account',$value,$field);
            if (is_null($cacheData->getId())) {
                throw new Exception('Such account does not exist!');
            }
            Mage::helper('M2ePro')->setCacheValue($cacheKey,$cacheData,array(self::NICK),60*60*24);
        }

        return $cacheData;
    }

    public function getMarketplace($value, $field = NULL)
    {
        is_null($field) && $field = 'id';

        $cacheKey = self::NICK.'_MARKETPLACE_DATA_'.$field.'_'.$value;
        $cacheData = Mage::helper('M2ePro')->getCacheValue($cacheKey);

        if ($cacheData === false) {
            $cacheData = $this->getObject('Marketplace',$value,$field);
            if (is_null($cacheData->getId())) {
                throw new Exception('Such marketplace does not exist!');
            }
            Mage::helper('M2ePro')->setCacheValue($cacheKey,$cacheData,array(self::NICK),60*60*24);
        }

        return $cacheData;
    }

    // ########################################

    public static function isASIN($string)
    {
        if (empty($string)) {
            return false;
        }

        if ((int)$string[0] <= 0) {
            return true;
        }

        return false;
    }

    public static function isISBN($string)
    {
        if (empty($string)) {
            return false;
        }

        if ((int)$string[0] > 0) {
            return true;
        }

        return false;
    }

    // ########################################

    public function getRegisterUrl($marketplaceId = NULL)
    {
        $marketplaceId = (int)$marketplaceId;
        $marketplaceId == 0 && $marketplaceId = self::MARKETPLACE_US;

        $domain = $this->getMarketplace($marketplaceId)->getUrl();
        $applicationName = Mage::helper('M2ePro/Module')->getConfig()->getGroupValue('/amazon/', 'application_name');

        return 'https://sellercentral.'.$domain.'/gp/mws/registration/register.html?ie=UTF8&*Version*=1&*entries*=0&applicationName='.rawurlencode($applicationName).'&appDevMWSAccountId='.$this->getMarketplace($marketplaceId)->getDeveloperKey();
    }

    public function getItemUrl($productId, $marketplaceId = NULL)
    {
        $marketplaceId = (int)$marketplaceId;
        $marketplaceId == 0 && $marketplaceId = self::MARKETPLACE_US;

        $domain = $this->getMarketplace($marketplaceId)->getUrl();

        return 'http://'.$domain.'/gp/product/'.$productId;
    }

    // ---------------------------------------

    public function getXfabricDestinationId()
    {
        $essConfig = Mage::helper('M2ePro/Ess')->getConfig();
        $moduleName = Mage::helper('M2ePro/Module')->getName();
        return (string)$essConfig->getGroupValue('/'.$moduleName.'/xfabric/'.self::NICK.'/','destination_id');
    }

    public function getXfabricTenantId()
    {
        $essConfig = Mage::helper('M2ePro/Ess')->getConfig();
        $moduleName = Mage::helper('M2ePro/Module')->getName();
        return (string)$essConfig->getGroupValue('/'.$moduleName.'/xfabric/'.self::NICK.'/','tenant_id');
    }

    // ---------------------------------------

    public function clearAllCache()
    {
        Mage::helper('M2ePro')->removeTagCacheValues(self::NICK);
    }

    // ########################################

    public function getCarriers()
    {
        return array(
            'usps' => 'USPS',
            'ups' => 'UPS',
            'fedex' => 'FedEx',
            'dhl' => 'DHL',
            'Fastway',
            'GLS',
            'GO!',
            'Hermes Logistik Gruppe',
            'Royal Mail',
            'Parcelforce',
            'City Link',
            'TNT',
            'Target',
            'SagawaExpress',
            'NipponExpress',
            'YamatoTransport'
        );
    }

    // ########################################
}