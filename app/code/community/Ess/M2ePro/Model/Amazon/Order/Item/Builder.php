<?php

/*
 * @copyright  Copyright (c) 2011 by  ESS-UA.
 */

class Ess_M2ePro_Model_Amazon_Order_Item_Builder extends Mage_Core_Model_Abstract
{
    // ########################################

    public function initialize(array $data)
    {
        // Init general data
        // ------------------
        $this->setData('amazon_order_item_id', $data['amazon_order_item_id']);
        $this->setData('order_id', $data['order_id']);
        $this->setData('sku', trim($data['sku']));
        $this->setData('general_id', trim($data['general_id']));
        $this->setData('is_isbn_general_id', (int)$data['is_isbn_general_id']);
        $this->setData('title', trim($data['title']));
        // ------------------

        // Init sale data
        // ------------------
        $this->setData('price', (float)$data['price']);
        $this->setData('currency', trim($data['currency']));
        $this->setData('tax_amount', (float)$data['tax_amount']);
        $this->setData('discount_amount', (float)$data['discount_amount']);
        $this->setData('qty_purchased', (int)$data['qty_purchased']);
        $this->setData('qty_shipped', (int)$data['qty_shipped']);
        // ------------------
    }

    // ########################################

    public function process()
    {
        // Process item for combined order
        // ------------------
        // todo check whether amazon has combined orders or not
        // ------------------

        return $this->createOrderItem();
    }

    // ########################################

    /**
     * @return Ess_M2ePro_Model_Order_Item
     */
    private function createOrderItem()
    {
        $existItem = Mage::helper('M2ePro/Component_Amazon')->getCollection('Order_Item')
            ->addFieldToFilter('order_id', $this->getData('order_id'))
            ->addFieldToFilter('sku', $this->getData('sku'))
            ->getFirstItem();

        $existItem->addData($this->getData());
        $existItem->save();

        return $existItem;
    }

    // ########################################
}