<?php

/*
 * @copyright  Copyright (c) 2011 by  ESS-UA.
 */

class Ess_M2ePro_Model_Marketplace extends Ess_M2ePro_Model_Component_Parent_Abstract
{
    const STATUS_DISABLE = 0;
    const STATUS_ENABLE = 1;
    
    // ########################################

    public function _construct()
    {
        parent::_construct();
        $this->_init('M2ePro/Marketplace');
    }

    // ########################################

    public function isLocked()
    {
        if (parent::isLocked()) {
            return true;
        }

        return (bool)Mage::getModel('M2ePro/Template_General')
                            ->getCollection()
                            ->addFieldToFilter('marketplace_id', $this->getId())
                            ->getSize();
    }

    public function deleteInstance()
    {
        if ($this->isLocked()) {
            return false;
        }

        $otherListings = $this->getOtherListings(true);
        foreach ($otherListings as $otherListing) {
            $otherListing->deleteInstance();
        }

        $orders = $this->getOrders(true);
        foreach ($orders as $order) {
            $order->deleteInstance();
        }

        $this->deleteChildInstance();
        $this->delete();

        return true;
    }

    // ########################################

    public function getGeneralTemplates($asObjects = false, array $filters = array())
    {
        return $this->getRelatedComponentItems('Template_General','marketplace_id',$asObjects,$filters);
    }

    public function getOtherListings($asObjects = false, array $filters = array())
    {
        return $this->getRelatedComponentItems('Listing_Other','marketplace_id',$asObjects,$filters);
    }

    public function getOrders($asObjects = false, array $filters = array())
    {
        return $this->getRelatedComponentItems('Order','marketplace_id',$asObjects,$filters);
    }

    // ########################################

    public function getIdByCode($code)
    {
        return $this->load($code,'code')->getId();
    }

    public function isStatusEnabled()
    {
        return $this->getStatus() == self::STATUS_ENABLE;
    }

    // ########################################

    public function getTitle()
    {
        return $this->getData('title');
    }

    public function getCode()
    {
        return $this->getData('code');
    }

    public function getUrl()
    {
        return $this->getData('url');
    }

    public function getStatus()
    {
        return (int)$this->getData('status');
    }

    public function getGroupTitle()
    {
        return $this->getData('group_title');
    }

    public function getNativeId()
    {
        return (int)$this->getData('native_id');
    }

    // ########################################
}