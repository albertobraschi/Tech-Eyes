<?php

/*
 * @copyright  Copyright (c) 2011 by  ESS-UA.
 */

class Ess_M2ePro_Model_Observer_Shipment
{
    //####################################
    
    public function salesOrderShipmentSaveAfter(Varien_Event_Observer $observer)
    {
        try {

            if (Mage::helper('M2ePro')->getGlobalValue('skip_shipment_observer')) {
                // Not process invoice observer when set such flag
                Mage::helper('M2ePro')->unsetGlobalValue('skip_shipment_observer');
                return;
            }

            /** @var $shipment Mage_Sales_Model_Order_Shipment */
            $shipment = $observer->getEvent()->getShipment();
            $magentoOrder = $shipment->getOrder();

            if (is_null($magentoOrderId = $magentoOrder->getData('entity_id'))) {
                return;
            }

            /** @var $loadedOrder Ess_M2ePro_Model_Order */
            $loadedOrder = Mage::getModel('M2ePro/Order')->load($magentoOrderId, 'magento_order_id');

            if (!$loadedOrder->getId()) {
                return;
            }

            // Prepare tracking information
            // -------------
            $track = $shipment->getTracksCollection()->getFirstItem();
            $trackingDetails = array();

            if ($track->getData('number') != '') {
                $trackingDetails = array(
                    'carrier_title'   => trim($track->getData('title')),
                    'carrier_code'    => trim($track->getData('carrier_code')),
                    'tracking_number' => $track->getData('number')
                );
            }
            // -------------

            $result = $loadedOrder->getChildObject()->updateShippingStatus($trackingDetails);

            $result ? $this->addSessionSuccessMessage($loadedOrder)
                    : $this->addSessionErrorMessage($loadedOrder);

        } catch (Exception $exception) {

            Mage::helper('M2ePro/Exception')->process($exception,true);

        }
    }

    //####################################

    private function addSessionSuccessMessage(Ess_M2ePro_Model_Order $order)
    {
        $channel = '';
        $message = '';

        if ($order->isComponentModeEbay()) {
            $channel = Ess_M2ePro_Helper_Component_Ebay::TITLE;
            $message = Mage::helper('M2ePro')->__('Shipping eBay Order Status was updated to Shipped.');
        }

        if ($order->isComponentModeAmazon()) {
            $channel = Ess_M2ePro_Helper_Component_Amazon::TITLE;
            $message = Mage::helper('M2ePro')->__('Updating Amazon Order Status to Shipped in Progress...');
        }

        if ($channel == '' || $message == '') {
            return;
        }

        Mage::getSingleton('adminhtml/session')->addSuccess(str_replace('%channel%', $channel, $message));
    }

    private function addSessionErrorMessage(Ess_M2ePro_Model_Order $order)
    {
        $channel = $url = '';

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
        $message = Mage::helper('M2ePro')->__('Shipping Status for %channel% Order was not updated. View %sl%order log%el% for more details.');

        Mage::getSingleton('adminhtml/session')->addError(str_replace(
            array('%channel%', '%sl%', '%el%'), array($channel, $startLink, $endLink), $message
        ));
    }

    //####################################
}