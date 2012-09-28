<?php

/*
 * @copyright  Copyright (c) 2011 by  ESS-UA.
 */

class Ess_M2ePro_Helper_Module extends Mage_Core_Helper_Abstract
{
    // ########################################
    
    /**
     * @return Ess_M2ePro_Model_Config_Module
     */
    public function getConfig()
    {
        return Mage::getSingleton('M2ePro/Config_Module');
    }

    // ########################################

    public function getName()
    {
        return 'm2epro';
    }

    public function getVersion()
    {
        $version = (string)Mage::getConfig()->getNode('modules/Ess_M2ePro/version');
        $version = strtolower($version);

        if (Mage::helper('M2ePro')->getCacheValue('MODULE_VERSION_UPDATER') === false) {
            Mage::helper('M2ePro/Ess')->getConfig()->setGroupValue('/modules/',$this->getName(),$version.'.r'.$this->getRevision());
            Mage::helper('M2ePro')->setCacheValue('MODULE_VERSION_UPDATER',array(),array(),60*60*24);
        }

        return $version;
    }

    public function getRevision()
    {
        $revision = '1560';

        if ($revision == str_replace('|','#','|REVISION_VERSION|')) {
            $revision = (int)exec('svnversion');
            $revision == 0 && $revision = 'N/A';
            $revision .= '-dev';
        }

        return $revision;
    }

    //----------------------------------------

    public function getVersionWithRevision()
    {
        return $this->getVersion().'r'.$this->getRevision();
    }

    // ########################################

    public function getApplicationKey()
    {
        return (string)Mage::helper('M2ePro/Ess')->getConfig()->getGroupValue('/'.$this->getName().'/','application_key');
    }

    public function getServerDirectory()
    {
        return Mage::helper('M2ePro/Ess')->getConfig()->getGroupValue('/'.$this->getName().'/server/','directory');
    }

    public function getServerScriptsPath()
    {
        $path = Mage::helper('M2ePro/Ess')->getServerBaseUrl().$this->getServerDirectory();
        return str_replace(':/', '://', str_replace('//', '/', $path));
    }

    // ########################################

    public function getXfabricFabricToken()
    {
        return (string)Mage::helper('M2ePro/Ess')->getConfig()->getGroupValue('/'.$this->getName().'/xfabric/','fabric_token');
    }

    public function getXfabricCapabilityToken()
    {
        return (string)Mage::helper('M2ePro/Ess')->getConfig()->getGroupValue('/'.$this->getName().'/xfabric/','capability_token');
    }

    public function getXfabricTenantId()
    {
        return (string)Mage::helper('M2ePro/Ess')->getConfig()->getGroupValue('/'.$this->getName().'/xfabric/','tenant_id');
    }

    public function getXfabricTenantToken()
    {
        return (string)Mage::helper('M2ePro/Ess')->getConfig()->getGroupValue('/'.$this->getName().'/xfabric/','tenant_token');
    }

    public function getXfabricModuleEndpoint()
    {
        return rtrim(Mage::getBaseUrl(),'/').'/m2epro/xfabric/';
    }

    //-----------------------------------------

    public function xfabricUpdateTenantDataAtServer($forceUpdate = false)
    {
        $dateLastUpdate = $this->getConfig()->getGroupValue('/xfabric/tenant_data/', 'date_last_update');

        if (is_null($dateLastUpdate)) {
            $dateLastUpdate = Mage::helper('M2ePro')->getCurrentGmtDate(true)-60*60*365;
        } else {
            $dateLastUpdate = strtotime($dateLastUpdate);
        }

        if (!$forceUpdate && Mage::helper('M2ePro')->getCurrentGmtDate(true) < $dateLastUpdate + 60*60*1) {
            return;
        }

        //$this->xfabricUpdateComponentTenantDataAtServer(Ess_M2ePro_Helper_Component_Amazon::NICK);

        $this->getConfig()->setGroupValue('/xfabric/tenant_data/', 'date_last_update', Mage::helper('M2ePro')->getCurrentGmtDate());
    }

    private function xfabricUpdateComponentTenantDataAtServer($component)
    {
        $tenantId = Mage::helper('M2ePro/Component_'.ucfirst($component))->getXfabricTenantId();

        if (empty($tenantId)) {
            return;
        }

        try {
            $params = array('tenant_id' => $tenantId);
            Mage::getModel('M2ePro/Connector_Server_M2ePro_Dispatcher')
                        ->processConnector('xfabric','update','tenantData',$params);
        } catch (Exception $exception) {}
    }

    public function xfabricAddCapabilityAccessFromServer($forceAdd = false)
    {
        $dateLastAdd = $this->getConfig()->getGroupValue('/xfabric/capability_access/', 'date_last_add');

        if (!$forceAdd && !is_null($dateLastAdd)) {
            return;
        }

        try {

            $data = Mage::getModel('M2ePro/Connector_Server_M2ePro_Dispatcher')
                            ->processConnector('xfabric','add','capability',array());

            if (empty($data)) {
                return;
            }

        } catch (Exception $exception) {
            return;
        }

        /** @var $essConfig Ess_M2ePro_Model_Config_Ess */
        $essConfig = Mage::helper('M2ePro/Ess')->getConfig();

        if (!empty($data['endpoint'])) {
            $tempEndpoint = rtrim($data['endpoint'],'/').'/';
            $essConfig->setGroupValue('/xfabric/', 'endpoint', $tempEndpoint);
        }

        !empty($data['fabric_token']) && $essConfig->setGroupValue('/'.$this->getName().'/xfabric/', 'fabric_token', $data['fabric_token']);
        !empty($data['capability_token']) && $essConfig->setGroupValue('/'.$this->getName().'/xfabric/', 'capability_token', $data['capability_token']);
        !empty($data['tenant_token']) && $essConfig->setGroupValue('/'.$this->getName().'/xfabric/', 'tenant_token', $data['tenant_token']);
        !empty($data['tenant_id']) && $essConfig->setGroupValue('/'.$this->getName().'/xfabric/', 'tenant_id', $data['tenant_id']);

        if (!empty($data['server_capabilities'][Ess_M2ePro_Helper_Component_Amazon::NICK]['destination_id'])) {
            $tempGroup = '/'.$this->getName().'/xfabric/'.Ess_M2ePro_Helper_Component_Amazon::NICK;
            $essConfig->setGroupValue($tempGroup, 'destination_id', $data['server_capabilities'][Ess_M2ePro_Helper_Component_Amazon::NICK]['destination_id']);
        }
        if (!empty($data['server_capabilities'][Ess_M2ePro_Helper_Component_Amazon::NICK]['tenant_id'])) {
            $tempGroup = '/'.$this->getName().'/xfabric/'.Ess_M2ePro_Helper_Component_Amazon::NICK;
            $essConfig->setGroupValue($tempGroup, 'tenant_id', $data['server_capabilities'][Ess_M2ePro_Helper_Component_Amazon::NICK]['tenant_id']);
        }

        Mage::helper('M2ePro/Ess')->updateXfabricWorkingEndpoint();

        $this->getConfig()->setGroupValue('/xfabric/capability_access/', 'date_last_add', Mage::helper('M2ePro')->getCurrentGmtDate());
    }

    // ########################################

    public function getMySqlTables()
    {
        return array(
            'ess_config',
            'm2epro_config',

            'm2epro_lock_item',
            'm2epro_locked_object',
            'm2epro_product_change',
            'm2epro_attribute_set',

            'm2epro_account',
            'm2epro_marketplace',

            'm2epro_order',
            'm2epro_order_item',
            'm2epro_order_log',

            'm2epro_xfabric_request',
            'm2epro_xfabric_schema',

            'm2epro_synchronization_log',
            'm2epro_synchronization_run',

            'm2epro_listing',
            'm2epro_listing_category',
            'm2epro_listing_log',
            'm2epro_listing_other',
            'm2epro_listing_other_log',
            'm2epro_listing_product',
            'm2epro_listing_product_variation',
            'm2epro_listing_product_variation_option',

            'm2epro_template_description',
            'm2epro_template_general',
            'm2epro_template_selling_format',
            'm2epro_template_synchronization',

            'm2epro_ebay_account',
            'm2epro_ebay_account_store_category',
            'm2epro_ebay_dictionary_category',
            'm2epro_ebay_dictionary_marketplace',
            'm2epro_ebay_dictionary_shipping',
            'm2epro_ebay_dictionary_shipping_category',
            'm2epro_ebay_feedback',
            'm2epro_ebay_feedback_template',
            'm2epro_ebay_item',
            'm2epro_ebay_listing',
            'm2epro_ebay_listing_other',
            'm2epro_ebay_listing_product',
            'm2epro_ebay_listing_product_variation',
            'm2epro_ebay_listing_product_variation_option',
            'm2epro_ebay_marketplace',
            'm2epro_ebay_message',
            'm2epro_ebay_order',
            'm2epro_ebay_order_item',
            'm2epro_ebay_order_external_transaction',
            'm2epro_ebay_template_description',
            'm2epro_ebay_template_general',
            'm2epro_ebay_template_general_calculated_shipping',
            'm2epro_ebay_template_general_payment',
            'm2epro_ebay_template_general_shipping',
            'm2epro_ebay_template_general_specific',
            'm2epro_ebay_template_selling_format',
            'm2epro_ebay_template_synchronization'
        );
    }

    public function getSummaryTextInfo()
    {
        $systemInfo = array();
        $systemInfo['name'] = Mage::helper('M2ePro/Server')->getSystem();

        $locationInfo = array();
        $locationInfo['domain'] = Mage::helper('M2ePro/Server')->getDomain();
        $locationInfo['ip'] = Mage::helper('M2ePro/Server')->getIp();
        $locationInfo['directory'] = Mage::helper('M2ePro/Server')->getBaseDirectory();

        $platformInfo = array();
        $platformInfo['name'] = Mage::helper('M2ePro/Magento')->getName();
        $platformInfo['edition'] = Mage::helper('M2ePro/Magento')->getEditionName();
        $platformInfo['version'] = Mage::helper('M2ePro/Magento')->getVersion();
        $platformInfo['revision'] = Mage::helper('M2ePro/Magento')->getRevision();

        $moduleInfo = array();
        $moduleInfo['name'] = Mage::helper('M2ePro/Module')->getName();
        $moduleInfo['version'] = Mage::helper('M2ePro/Module')->getVersion();
        $moduleInfo['revision'] = Mage::helper('M2ePro/Module')->getRevision();

        $phpInfo = Mage::helper('M2ePro/Server')->getPhpSettings();
        $phpInfo['api'] = Mage::helper('M2ePro/Server')->getPhpApiName();
        $phpInfo['version'] = Mage::helper('M2ePro/Server')->getPhpVersion();

        $mysqlInfo = Mage::Helper('M2ePro/Server')->getMysqlSettings();
        $mysqlInfo['api'] = Mage::helper('M2ePro/Server')->getMysqlApiName();
        $prefix = Mage::helper('M2ePro/Magento')->getDatabaseTablesPrefix();
        $mysqlInfo['prefix'] = $prefix != '' ? $prefix : 'Disabled';
        $mysqlInfo['version'] = Mage::helper('M2ePro/Server')->getMysqlVersion();

        $info = <<<DATA
-------------------------------- PLATFORM INFO -----------------------------------
Name: {$platformInfo['name']}
Edition: {$platformInfo['edition']}
Version: {$platformInfo['version']}
Revision: {$platformInfo['revision']}

-------------------------------- MODULE INFO -------------------------------------
Name: {$moduleInfo['name']}
Version: {$moduleInfo['version']}
Revision: {$moduleInfo['revision']}

-------------------------------- LOCATION INFO -----------------------------------
Domain: {$locationInfo['domain']}
Ip: {$locationInfo['ip']}
Directory: {$locationInfo['directory']}

-------------------------------- SYSTEM INFO -------------------------------------
Name: {$systemInfo['name']}

-------------------------------- PHP INFO ----------------------------------------
Version: {$phpInfo['version']}
Api: {$phpInfo['api']}
Memory Limit: {$phpInfo['memory_limit']}
Max Execution Time: {$phpInfo['max_execution_time']}

-------------------------------- MYSQL INFO --------------------------------------
Version: {$mysqlInfo['version']}
Api: {$mysqlInfo['api']}
Tables Prefix: {$mysqlInfo['prefix']}
Connection Timeout: {$mysqlInfo['connect_timeout']}
Wait Timeout: {$mysqlInfo['wait_timeout']}
DATA;

        return $info;
    }

    // ########################################
}