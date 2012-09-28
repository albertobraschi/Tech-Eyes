<?php

/*
 * @copyright  Copyright (c) 2011 by  ESS-UA.
 */

class Ess_M2ePro_Model_Account extends Ess_M2ePro_Model_Component_Parent_Abstract
{
    // ########################################

    public function _construct()
    {
        parent::_construct();
        $this->_init('M2ePro/Account');
    }

    // ########################################

    public function isLocked()
    {
        if (parent::isLocked()) {
            return true;
        }

        return (bool)Mage::getModel('M2ePro/Template_General')
                            ->getCollection()
                            ->addFieldToFilter('account_id', $this->getId())
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
        return $this->getRelatedComponentItems('Template_General','account_id',$asObjects,$filters);
    }

    public function getOtherListings($asObjects = false, array $filters = array())
    {
        return $this->getRelatedComponentItems('Listing_Other','account_id',$asObjects,$filters);
    }

    public function getOrders($asObjects = false, array $filters = array())
    {
        return $this->getRelatedComponentItems('Order','account_id',$asObjects,$filters);
    }

    // ########################################

    public function getTitle()
    {
        return $this->getData('title');
    }

    // ########################################

    public function isSingleAccountMode()
    {
        return Mage::getModel('M2ePro/Account')->getCollection()->getSize() <= 1;
    }

    // ########################################
}