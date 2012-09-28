<?php

/*
 * @copyright  Copyright (c) 2011 by  ESS-UA.
 */

class Ess_M2ePro_Model_Amazon_Order_Item_Proxy extends Ess_M2ePro_Model_Order_Item_Proxy
{
    // ########################################

    public function getPrice()
    {
        return $this->item->getPrice() / $this->item->getQtyPurchased();
    }

    public function getQty()
    {
        return $this->item->getQtyPurchased();
    }

    public function getTaxRate()
    {
        return 0; // todo
    }

    public function hasVat()
    {
        return false; // todo
    }

    public function hasTax()
    {
        return false; // todo
    }

    // ########################################
}