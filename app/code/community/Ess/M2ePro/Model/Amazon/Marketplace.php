<?php

/*
 * @copyright  Copyright (c) 2011 by  ESS-UA.
 */

class Ess_M2ePro_Model_Amazon_Marketplace extends Ess_M2ePro_Model_Component_Child_Amazon_Abstract
{
    // ########################################

    public function _construct()
    {
        parent::_construct();
        $this->_init('M2ePro/Amazon_Marketplace');
    }

    // ########################################

    public function isLocked()
    {
        if (parent::isLocked()) {
            return true;
        }

        $accounts = Mage::getModel('M2ePro/Amazon_Account')->getCollection()->getItems();
        foreach ($accounts as $account) {
            /** @var $account Ess_M2ePro_Model_Amazon_Account */
            if ($account->isExistMarketplaceItem($this->getId())) {
                return true;
            }
        }

        return false;
    }

    // ########################################

    public function getDeveloperKey()
    {
        return $this->getData('developer_key');
    }

    public function getDefaultCurrency()
    {
        return $this->getData('default_currency');
    }

    // ########################################
}