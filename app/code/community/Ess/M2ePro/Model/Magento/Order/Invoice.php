<?php

/*
 * @copyright  Copyright (c) 2011 by  ESS-UA.
 */

class Ess_M2ePro_Model_Magento_Order_Invoice
{
    /** @var $magentoOrder Mage_Sales_Model_Order */
    private $magentoOrder = NULL;

    /** @var $invoice Mage_Sales_Model_Order_Invoice */
    private $invoice = NULL;

    // ########################################

    public function setMagentoOrder(Mage_Sales_Model_Order $magentoOrder)
    {
        $this->magentoOrder = $magentoOrder;
        return $this;
    }

    // ########################################

    public function getInvoice()
    {
        return $this->invoice;
    }

    // ########################################

    public function buildInvoice()
    {
        $this->prepareInvoice();
    }

    // ########################################

    private function prepareInvoice()
    {
        // Skip invoice observer
        // -----------------
        Mage::helper('M2ePro')->unsetGlobalValue('skip_invoice_observer');
        Mage::helper('M2ePro')->setGlobalValue('skip_invoice_observer', true);
        // -----------------

        // Create invoice
        // -----------------
        $this->invoice = $this->magentoOrder->prepareInvoice();
        $this->invoice->register();

        $transactionSave = Mage::getModel('core/resource_transaction')->addObject($this->invoice)
                                                                      ->addObject($this->invoice->getOrder());

        $transactionSave->save();
        // -----------------
    }

    // ########################################
}