<?php

/*
 * @copyright  Copyright (c) 2011 by  ESS-UA.
 */

class Ess_M2ePro_Model_Magento_Order_Shipment
{
    /** @var $magentoOrder Mage_Sales_Model_Order */
    private $magentoOrder = NULL;

    /** @var $shipment Mage_Sales_Model_Order_Shipment */
    private $shipment = NULL;

    // ########################################

    public function setMagentoOrder(Mage_Sales_Model_Order $magentoOrder)
    {
        $this->magentoOrder = $magentoOrder;
        return $this;
    }

    // ########################################

    public function getShipment()
    {
        return $this->shipment;
    }

    // ########################################

    public function buildShipment()
    {
        $this->prepareShipment();
        $this->magentoOrder->getShipmentsCollection()->addItem($this->shipment);
    }

    // ########################################

    protected function prepareShipment()
    {
        // Skip shipment observer
        // -----------------
        Mage::helper('M2ePro')->unsetGlobalValue('skip_shipment_observer');
        Mage::helper('M2ePro')->setGlobalValue('skip_shipment_observer', true);
        // -----------------

        // Create shipment
        // -----------------
        $this->shipment = $this->magentoOrder->prepareShipment();
        $this->shipment->register();

        Mage::getModel('core/resource_transaction')->addObject($this->shipment)
                                                   ->addObject($this->shipment->getOrder())
                                                   ->save();
        // -----------------

        //$this->magentoOrder->setIsInProcess(true)->save(); // todo do we need this?
    }

    // ########################################
}