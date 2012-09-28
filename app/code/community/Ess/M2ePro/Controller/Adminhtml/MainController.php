<?php

/*
 * @copyright  Copyright (c) 2011 by  ESS-UA.
 */

class Ess_M2ePro_Controller_Adminhtml_MainController extends Ess_M2ePro_Controller_Adminhtml_BaseController
{
    //#############################################

    public function preDispatch()
    {
        parent::preDispatch();

        if ($this->getRequest()->isXmlHttpRequest() &&
            !Mage::getSingleton('admin/session')->isLoggedIn()) {

            exit(json_encode( array(
                'error' => true,
                'message' => Mage::helper('M2ePro')->__('You have logged out. Refresh page please.')
            )));
        }

        if ($this->getRequest()->isGet() &&
            !$this->getRequest()->isPost() &&
            !$this->getRequest()->isXmlHttpRequest() &&
            Mage::getSingleton('M2ePro/Wizard')->isInstallationFinished()) {

            try {
                Mage::getModel('M2ePro/License_Server')->updateStatus(false);
                Mage::getModel('M2ePro/License_Server')->updateLock(false);
                Mage::getModel('M2ePro/License_Server')->updateMessages(false);
                //Mage::helper('M2ePro/Module')->xfabricUpdateTenantDataAtServer(false);
            } catch (Exception $exception) {}
        }

        return $this;
    }

    public function dispatch($action)
    {
        try {

            $this->getRequest()->isGet() &&
            !$this->getRequest()->isPost() &&
            !$this->getRequest()->isXmlHttpRequest() &&
            $this->updateDomainBackup();

            Mage::helper('M2ePro/Exception')->setFatalErrorHandler();
            return parent::dispatch($action);

        } catch (Exception $exception) {

            if ($this->getRequest()->getControllerName() == 'adminhtml_support') {
                exit($exception->getMessage());
            } else {

                if (Mage::helper('M2ePro/Server')->isDeveloper()) {
                    throw $exception;
                } else {

                    Mage::helper('M2ePro/Exception')->process($exception,true);

                    if (($this->getRequest()->isGet() || $this->getRequest()->isPost()) &&
                        !$this->getRequest()->isXmlHttpRequest()) {

                        $this->_getSession()->addError(Mage::helper('M2ePro/Exception')->getUserMessage($exception));
                        $this->_redirect('*/adminhtml_support/index');
                    } else {
                        exit($exception->getMessage());
                    }
                }
            }
        }
    }

    //#############################################

    public function loadLayout($ids=null, $generateBlocks=true, $generateXml=true)
    {
        if ($this->getRequest()->isGet() &&
            !$this->getRequest()->isPost() &&
            !$this->getRequest()->isXmlHttpRequest()) {

            $lockNotification = $this->addLockNotifications();

            $lockNotification ||
            !Mage::getSingleton('M2ePro/Wizard')->isInstallationFinished() ||
            $this->addLicenseActivationNotifications() ||
            $this->addLicenseValidationFailNotifications() ||
            $this->addLicenseModesNotifications() ||
            $this->addLicenseStatusesNotifications() ||
            $this->addLicenseExpirationDatesNotifications() ||
            $this->addLicenseTrialNotifications() ||
            $this->addLicensePreExpirationDateNotifications();

            $this->addServerNotifications();
            $this->addBrowserNotifications();

            $lockNotification ||
            !Mage::getSingleton('M2ePro/Wizard')->isInstallationFinished() ||
            $this->addCronNotifications();

            $lockNotification ||
            !Mage::getSingleton('M2ePro/Wizard')->isInstallationFinished() ||
            $this->addFeedbackNotifications();

            $lockNotification ||
            !Mage::getSingleton('M2ePro/Wizard')->isInstallationFinished() ||
            $this->addMyMessageNotifications();
        }

        is_array($ids) ? $ids[] = 'm2epro' : $ids = array('default','m2epro');
        return parent::loadLayout($ids, $generateBlocks, $generateXml);
    }

    protected function _addContent(Mage_Core_Block_Abstract $block)
    {
        if ($this->getRequest()->isGet() &&
            !$this->getRequest()->isPost() &&
            !$this->getRequest()->isXmlHttpRequest() &&
            Mage::getModel('M2ePro/License_Model')->isLock()) {
            return $this;
        }

        $blockGeneral = $this->getLayout()->createBlock('M2ePro/adminhtml_general');
        $this->getLayout()->getBlock('content')->append($blockGeneral);

        return parent::_addContent($block);
    }

    //#############################################

    private function addLockNotifications()
    {
        if (Mage::getModel('M2ePro/License_Model')->isLock()) {
            $this->_getSession()->addError(Mage::helper('M2ePro')->__('M2E Pro module is locked because of security reason. Please contact us.'));
            return true;
        }
        return false;
    }

    private function addServerNotifications()
    {
        $messages = Mage::getModel('M2ePro/License_Model')->getMessages();

        foreach ($messages as $message) {

            if (isset($message['text']) && isset($message['type']) && $message['text'] != '') {

                switch ($message['type']) {
                    case Ess_M2ePro_Model_License_Model::MESSAGE_TYPE_NOTICE:
                        $this->_getSession()->addNotice(Mage::helper('M2ePro')->__($message['text']));
                        break;
                    case Ess_M2ePro_Model_License_Model::MESSAGE_TYPE_ERROR:
                        $this->_getSession()->addError(Mage::helper('M2ePro')->__($message['text']));
                        break;
                    case Ess_M2ePro_Model_License_Model::MESSAGE_TYPE_WARNING:
                        $this->_getSession()->addWarning(Mage::helper('M2ePro')->__($message['text']));
                        break;
                    case Ess_M2ePro_Model_License_Model::MESSAGE_TYPE_SUCCESS:
                        $this->_getSession()->addSuccess(Mage::helper('M2ePro')->__($message['text']));
                        break;
                    default:
                        $this->_getSession()->addNotice(Mage::helper('M2ePro')->__($message['text']));
                        break;
                }
            }

        }
    }

    private function addBrowserNotifications()
    {
        // Check MS Internet Explorer 6
        if (isset($_SERVER['HTTP_USER_AGENT']) && strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 6.') !== false) {
            $this->_getSession()->addWarning(Mage::helper('M2ePro')->__('Magento and M2E Pro has Internet Explorer 7 as minimal browser requirement. Please upgrade your browser.'));
            return true;
        }
        return false;
    }

    // --------------------------------------------

    private function addLicenseActivationNotifications()
    {
        if (!Mage::getModel('M2ePro/License_Model')->getKey() ||
            !Mage::getModel('M2ePro/License_Model')->getDomain() ||
            !Mage::getModel('M2ePro/License_Model')->getIp() ||
            !Mage::getModel('M2ePro/License_Model')->getDirectory()) {
            $startLink = '<a href="'.$this->getUrl("*/adminhtml_license/index").'" target="_blank">';
            $endLink = '</a>';
            $message = Mage::helper('M2ePro')->__('M2E Pro module requires activation. Go to the %sl%license page%el%.');
            $this->_getSession()->addError(str_replace(array('%sl%','%el%'),array($startLink,$endLink),$message));
            return true;
        }

        return false;
    }

    private function addLicenseValidationFailNotifications()
    {
        // MAGENTO GO UGLY HACK
        //#################################
        if (Mage::helper('M2ePro/Magento')->isGoEdition()) {
            return false;
        }
        //#################################

        if (Mage::getModel('M2ePro/License_Model')->getDomain() != Mage::helper('M2ePro/Server')->getDomain() ||
            Mage::getModel('M2ePro/License_Model')->getIp() != Mage::helper('M2ePro/Server')->getIp() ||
            Mage::getModel('M2ePro/License_Model')->getDirectory() != Mage::helper('M2ePro/Server')->getBaseDirectory()) {
            $startLink = '<a href="'.$this->getUrl("*/adminhtml_license/index").'" target="_blank">';
            $endLink = '</a>';
            $message = Mage::helper('M2ePro')->__('M2E Pro license key validation is failed for this domain, IP or base directory. Go to the %sl%license page%el%.');
            $this->_getSession()->addError(str_replace(array('%sl%','%el%'),array($startLink,$endLink),$message));
            return true;
        }

        return false;
    }

    private function addLicenseModesNotifications()
    {
        $hasMessage = false;

        foreach (Mage::helper('M2ePro/Component')->getEnabledComponents() as $component) {

            if (Mage::getModel('M2ePro/License_Model')->isNoneMode($component)) {
                $startLink = '<a href="'.$this->getUrl("*/adminhtml_license/index").'" target="_blank">';
                $endLink = '</a>';
                $message = Mage::helper('M2ePro')->__('M2E Pro module requires activation for "%com%" component. Go to the %sl%license page%el%.');
                $this->_getSession()->addError(str_replace(array('%sl%','%el%','%com%'),array($startLink,$endLink,ucwords($component)),$message));
                $hasMessage = true;
            }
        }

        return $hasMessage;
    }

    private function addLicenseStatusesNotifications()
    {
        $hasMessage = false;

        foreach (Mage::helper('M2ePro/Component')->getEnabledComponents() as $component) {

            if (Mage::getModel('M2ePro/License_Model')->isSuspendedStatus($component)) {
                $startLink = '<a href="'.$this->getUrl("*/adminhtml_license/index").'" target="_blank">';
                $endLink = '</a>';
                $message = Mage::helper('M2ePro')->__('M2E Pro module license suspended for "%com%" component. Go to the %sl%license page%el%.');
                $this->_getSession()->addError(str_replace(array('%sl%','%el%','%com%'),array($startLink,$endLink,ucwords($component)),$message));
                $hasMessage = true;
            }
            if (Mage::getModel('M2ePro/License_Model')->isClosedStatus($component)) {
                $startLink = '<a href="'.$this->getUrl("*/adminhtml_license/index").'" target="_blank">';
                $endLink = '</a>';
                $message = Mage::helper('M2ePro')->__('M2E Pro module license closed for "%com%" component. Go to the %sl%license page%el%.');
                $this->_getSession()->addError(str_replace(array('%sl%','%el%','%com%'),array($startLink,$endLink,ucwords($component)),$message));
                $hasMessage = true;
            }

        }
        return $hasMessage;
    }

    private function addLicenseExpirationDatesNotifications()
    {
        $hasMessage = false;

        foreach (Mage::helper('M2ePro/Component')->getEnabledComponents() as $component) {

            if (Mage::getModel('M2ePro/License_Model')->isExpirationDate($component)) {
                $startLink = '<a href="'.$this->getUrl("*/adminhtml_license/index").'" target="_blank">';
                $endLink = '</a>';
                $message = Mage::helper('M2ePro')->__('M2E Pro module license has expired for "%com%" component. Go to the %sl%license page%el%.');
                $this->_getSession()->addError(str_replace(array('%sl%','%el%','%com%'),array($startLink,$endLink,ucwords($component)),$message));
                $hasMessage = true;
            }
        }

        return $hasMessage;
    }

    private function addLicenseTrialNotifications()
    {
        $hasMessage = false;

        foreach (Mage::helper('M2ePro/Component')->getEnabledComponents() as $component) {

            if (Mage::getModel('M2ePro/License_Model')->isTrialMode($component)) {
                $message = Mage::helper('M2ePro')->__('M2E Pro module is running under Trial License for "%com%" component, that will expire on');
                $message .= ' '.Mage::getModel('M2ePro/License_Model')->getTextExpirationDate($component).'.';
                $this->_getSession()->addWarning(str_replace(array('%com%'),array(ucwords($component)),$message));
                $hasMessage = true;
            }
        }

        return $hasMessage;
    }

    private function addLicensePreExpirationDateNotifications()
    {
        $hasMessage = false;

        foreach (Mage::helper('M2ePro/Component')->getEnabledComponents() as $component) {

            if (Mage::getModel('M2ePro/License_Model')->getIntervalBeforeExpirationDate($component) <= 60*60*24*3) {
                $message = Mage::helper('M2ePro')->__('M2E Pro module license will expire on');
                $message .= ' '.Mage::getModel('M2ePro/License_Model')->getTextExpirationDate($component).' for "%com%" component. ';
                $startLink = '<a href="'.$this->getUrl("*/adminhtml_license/index").'" target="_blank">';
                $endLink = '</a>';
                $message .= Mage::helper('M2ePro')->__('Go to the %sl%license page%el%.');
                $this->_getSession()->addWarning(str_replace(array('%sl%','%el%','%com%'),array($startLink,$endLink,ucwords($component)),$message));
                $hasMessage = true;
            }
        }

        return $hasMessage;
    }

    // --------------------------------------------

    private function addCronNotifications()
    {
        if (Mage::getModel('M2ePro/Cron')->isNotRunVeryLong()) {
            $allowedInactiveHours = (int)Mage::helper('M2ePro/Module')->getConfig()->getGroupValue('/cron/notification/', 'inactive_hours');
            $message = Mage::helper('M2ePro')->__('Last synchronization was performed by cron more than %hr% hours ago. Please check Magento cron job configuration.');
            $this->_getSession()->addNotice(str_replace('%hr%',$allowedInactiveHours,$message));
            return true;
        }
        return false;
    }

    private function addFeedbackNotifications()
    {
        if (Mage::getModel('M2ePro/Ebay_Feedback')->haveNew(true)) {
            $startLink = '<a href="'.$this->getUrl('*/adminhtml_ebay_feedback/index').'" target="_blank">';
            $endLink = '</a>';
            $message = Mage::helper('M2ePro')->__('New buyer negative feedback(s) was received. Go to the %sl%feedbacks page%el%.');
            $this->_getSession()->addNotice(str_replace(array('%sl%','%el%'),array($startLink,$endLink),$message));
            return true;
        }
        return false;
    }

    private function addMyMessageNotifications()
    {
        if (Mage::getModel('M2ePro/Ebay_Message')->haveNew()) {
            $startLink = '<a href="'.$this->getUrl("*/adminhtml_ebay_message/index").'" target="_blank">';
            $endLink = '</a>';
            $message = Mage::helper('M2ePro')->__('New buyer message(s) was received. Go to the %sl%messages page%el%.');
            $this->_getSession()->addNotice(str_replace(array('%sl%','%el%'),array($startLink,$endLink),$message));
            return true;
        }
        return false;
    }

    //#############################################

    private function updateDomainBackup()
    {
        $dateLastCheck = Mage::helper('M2ePro/Module')->getConfig()->getGroupValue('/backups/', 'date_last_check');

        if (is_null($dateLastCheck)) {
            $dateLastCheck = Mage::helper('M2ePro')->getCurrentGmtDate(true)-60*60*365;
        } else {
            $dateLastCheck = strtotime($dateLastCheck);
        }

        if (Mage::helper('M2ePro')->getCurrentGmtDate(true) >= $dateLastCheck + 60*60*24) {

            $domainBackup = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '127.0.0.1';
            strpos($domainBackup,'www.') === 0 && $domainBackup = substr($domainBackup,4);
            Mage::helper('M2ePro/Module')->getConfig()->setGroupValue('/backups/', 'domain', $domainBackup);

            $ipBackup = isset($_SERVER['SERVER_ADDR']) ? $_SERVER['SERVER_ADDR'] : NULL;
            is_null($ipBackup) && $ipBackup = isset($_SERVER['LOCAL_ADDR']) ? $_SERVER['LOCAL_ADDR'] : '127.0.0.1';
            Mage::helper('M2ePro/Module')->getConfig()->setGroupValue('/backups/', 'ip', $ipBackup);

            $directoryBackup = Mage::getBaseDir();
            Mage::helper('M2ePro/Module')->getConfig()->setGroupValue('/backups/', 'directory', $directoryBackup);

            Mage::helper('M2ePro/Module')->getConfig()->setGroupValue('/backups/', 'date_last_check', Mage::helper('M2ePro')->getCurrentGmtDate());

            //Mage::helper('M2ePro/Module')->xfabricAddCapabilityAccessFromServer(false);
        }
    }

    //#############################################
}