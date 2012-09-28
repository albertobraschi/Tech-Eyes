<?php

/*
 * @copyright  Copyright (c) 2011 by  ESS-UA.
 */

class Ess_M2ePro_Model_Observer_Invoice
{
    //####################################

    public function salesOrderInvoicePay(Varien_Event_Observer $observer)
    {
        try {

            if (Mage::helper('M2ePro')->getGlobalValue('skip_invoice_observer')) {
                // Not process invoice observer when set such flag
                Mage::helper('M2ePro')->unsetGlobalValue('skip_invoice_observer');
                return;
            }

            /** @var $invoice Mage_Sales_Model_Order_Invoice */
            $invoice = $observer->getEvent()->getInvoice();
            $magentoOrder = $invoice->getOrder();

            if (is_null($magentoOrderId = $magentoOrder->getData('entity_id'))) {
                return;
            }

            /** @var $loadedOrder Ess_M2ePro_Model_Order */
            $loadedOrder = Mage::getModel('M2ePro/Order')->load($magentoOrderId, 'magento_order_id');

            if (!$loadedOrder->getId() || $loadedOrder->isComponentModeAmazon()) {
                return;
            }

            $result = $loadedOrder->getChildObject()->updatePaymentStatus();

            $result ? $this->addSessionSuccessMessage($loadedOrder)
                    : $this->addSessionErrorMessage($loadedOrder);

        } catch (Exception $exception) {

            Mage::helper('M2ePro/Exception')->process($exception,true);
            return;
        }
    }

    //####################################

    private function addSessionSuccessMessage(Ess_M2ePro_Model_Order $order)
    {
        $channel = '';
        $order->isComponentModeEbay()   && $channel = Ess_M2ePro_Helper_Component_Ebay::TITLE;
        $order->isComponentModeAmazon() && $channel = Ess_M2ePro_Helper_Component_Amazon::TITLE;

        if ($channel == '') {
            return;
        }

        $message = Mage::helper('M2ePro')->__('Payment status for %channel% Order was updated to Shipped.');
        Mage::getSingleton('adminhtml/session')->addSuccess(str_replace('%channel%', $channel, $message));
    }

    private function addSessionErrorMessage(Ess_M2ePro_Model_Order $order)
    {
        $channel = '';
        $url = '';

        if ($order->isComponentModeEbay()) {
            $channel = Ess_M2ePro_Helper_Component_Ebay::TITLE;
            $url = Mage::helper('adminhtml')->getUrl('M2ePro/adminhtml_ebay_order/view', array('id' => $order->getId()));
        } else if ($order->isComponentModeAmazon()) {
            $channel = Ess_M2ePro_Helper_Component_Amazon::TITLE;
            $url = Mage::helper('adminhtml')->getUrl('M2ePro/adminhtml_amazon_order/view', array('id' => $order->getId()));
        }

        if ($channel == '') {
            return;
        }

        $startLink = '<a href="' . $url . '" target="_blank">';
        $endLink = '</a>';
        $message = Mage::helper('M2ePro')->__('Payment status for %channel% Order was not updated. View %sl%order log%el% for more details.');

        Mage::getSingleton('adminhtml/session')->addError(str_replace(
            array('%channel%', '%sl%', '%el%'), array($channel, $startLink, $endLink), $message
        ));
    }

    //####################################
}