<?php

/*
 * @copyright  Copyright (c) 2011 by  ESS-UA.
 */

abstract class Ess_M2ePro_Block_Adminhtml_Component_Switcher extends Ess_M2ePro_Block_Adminhtml_Switcher
{
    // ########################################

    protected function getComponentLabel($label)
    {
        $label = trim($label);

        if (is_null($this->getData('component_mode'))) {
            return trim(preg_replace(array('/%component%/', '/\s{2,}/'), ' ', $label));
        }

        $component = '';
        $this->getData('component_mode') == Ess_M2ePro_Helper_Component_Ebay::NICK   && $component = Mage::helper('M2ePro')->__(Ess_M2ePro_Helper_Component_Ebay::TITLE);
        $this->getData('component_mode') == Ess_M2ePro_Helper_Component_Amazon::NICK && $component = Mage::helper('M2ePro')->__(Ess_M2ePro_Helper_Component_Amazon::TITLE);

        if (strpos($label, '%component%') === false) {
            return "{$component} {$label}";
        }

        return str_replace('%component%', $component, $label);
    }

    // ########################################

    public function getParamName()
    {
        if (is_null($this->getData('component_mode'))) {
            return parent::getParamName();
        }

        return $this->getData('component_mode') . ucfirst($this->paramName);
    }

    public function getSwitchUrl()
    {
        $tab = NULL;
        strtolower($this->getData('component_mode')) == Ess_M2ePro_Helper_Component_Ebay::NICK   && $tab = Ess_M2ePro_Block_Adminhtml_Component_Abstract::TAB_ID_EBAY;
        strtolower($this->getData('component_mode')) == Ess_M2ePro_Helper_Component_Amazon::NICK && $tab = Ess_M2ePro_Block_Adminhtml_Component_Abstract::TAB_ID_AMAZON;

        $controllerName = $this->getData('controller_name') ? $this->getData('controller_name') : '*';

        return $this->getUrl("*/{$controllerName}/*", array('_current' => true, $this->getParamName() => null, 'tab' => $tab));
    }

    public function getSwitchCallback()
    {
        return 'switch' . ucfirst($this->getParamName());
    }

    // ########################################
}