<?php
/**
 * NOTICE OF LICENSE
 * This source file is subject to the BETTER STORE SEARCH
 * License, which is available at this URL: http://www.betterstoresearch.com/docs/bss_license.txt
 *
 * DISCLAIMER
 * By adding to, editing, or in any way modifying this code, WDCA is not held liable for any inconsistencies or abnormalities in the
 * behaviour of this code. By adding to, editing, or in any way modifying this code, the Licensee terminates any agreement of support
 * offered by WDCA, outlined in the provided Sweet Tooth License.  Upon discovery of modified code in the process of support, the Licensee
 * is still held accountable for any and all billable time WDCA spent  during the support process.
 * WDCA does not guarantee compatibility with any other framework extension. WDCA is not responsbile for any inconsistencies or abnormalities in the
 * behaviour of this code if caused by other framework extension. If you did not receive a copy of the license, please send an email to
 * contact@wdca.ca or call 1-888-699-WDCA(9322), so we can send you a copy immediately.
 *
 * @category   [TBT]
 * @package    [TBT_Bss]
 * @copyright  Copyright (c) 2012 WDCA (http://www.wdca.ca)
 * @license    http://www.betterstoresearch.com/docs/bss_license.txt
 */

/**
 *
 * @category   TBT
 * @author     WDCA Sweet Tooth Team <contact@wdca.ca>
 */

class TBT_Bss_Model_Mysql4_Setup extends Mage_Core_Model_Resource_Setup
{

    protected $_firstInstallation = false;

    /**
     * Dispatches _preApply() and _postApply() before and after it falls back to its parent
     * method, which will:
     * @return TBT_Bss_Model_Mysql4_Setup
     */
    public function applyUpdates()
    {
        $dbVer = $this->_getResource()->getDbVersion($this->_resourceName);
        $configVer = (string) $this->_moduleConfig->version;

        $updatesApplied = false;

        if ($dbVer === false) {

            $this->_firstInstallation = true;
        }

        if ($dbVer !== false) {
            $status = version_compare($configVer, $dbVer);
            if ($status == self::VERSION_COMPARE_GREATER) {
                $updatesApplied = true;
            }
        } elseif ($configVer) {
            $updatesApplied = true;
        }

        if ($updatesApplied) {
            $this->_preApply();
        }

        parent::applyUpdates();

        if ($updatesApplied) {
            $this->_postApply();
        }

        return $this;
    }
    
    public function isFirstInstallation()
    {
        return $this->_firstInstallation;
    }

    /**
     * Runs before install/update SQL has been executed
     * @return TBT_Bss_Model_Mysql4_Setup
     */
    protected function _preApply()
    {
        return $this;
    }

    /**
     * Runs after install/update SQL has been executed
     * @return TBT_Bss_Model_Mysql4_Setup
     */
    protected function _postApply()
    {

        if ($this->_firstInstallation) {
            $this->_createFirstInstallNotice();
        } else {
            $this->_createSuccessfulUpdateNotice();
        }

        return $this;
    }
    
   
    protected function _createFirstInstallNotice()
    {
        $version = Mage::getConfig()->getNode('modules/TBT_Bss/version');
        
        $url = Mage::getModel('core/config_data')->load("web/unsecure/base_url",'path')->getValue() .
            Mage::getUrl('bssadmin/diagnostictest/runTestsweet',array("_nosid"=>true));
        
        $firstInstalledMsgTitle = "Better Store Search v{$version} was successfully installed!";

        $firstInstalledMsgDesc = "Better Store Search v{$version} was successfully installed on your store. <a target='_blank' href='"
            . $url
            . "'> Run our diagnostics tool </a> to ensure your system is healthy";
        
        $this->createInstallNotice($firstInstalledMsgTitle, $firstInstalledMsgDesc);
        
        return $this;
    }
    
    /**
     * This method will create a backend notification regarding a successful
     * Sweet Tooth installation, with the appropriate version number.
     * @return TBT_Bss_Model_Mysql4_Setup
     */
    protected function _createSuccessfulUpdateNotice()
    {
        $version = Mage::getConfig()->getNode('modules/TBT_Bss/version');
        $msgTitle = "Better Store Search was successfully updated to version {$version} !";
        $msgDesc = "Better Store Search was successfully updated to version {$version} on your store.";
        
        $this->createInstallNotice($msgTitle, $msgDesc);
        
        return $this;
    }
    
    /**
     * Creates an installation message notice in the backend.
     * @param string $msgTitle
     * @param string $msgDesc
     * @param string $url=null if null default Sweet Tooth URL is used.
     * @return TBT_Bss_Model_Mysql4_Setup
     */
    public function createInstallNotice($msgTitle, $msgDesc, $url = null, $severity = null)
    {
        $message = Mage::getModel('adminnotification/inbox');
        $message->setDateAdded(date("c", time()));
        
               
        if ($severity === null) {
            $severity = Mage_AdminNotification_Model_Inbox::SEVERITY_NOTICE;
        }
        
        if ($url == null) {
            $message->setUrl("http://www.betterstoresearch.com/changelog");
        }
      
        $message->setTitle($msgTitle);
        $message->setDescription($msgDesc);
        $message->setUrl($url);  
        $message->setSeverity($severity);
        $message->save();
        
        return $this;
    }

}
