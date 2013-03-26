<?php

class TBT_Bss_Model_System_Config_Backend_Cms_Enable extends Mage_Core_Model_Config_Data
{

    public function _afterSave() 
    {
        if ($this->getOldValue() == 0 && $this->getValue() == 1)
        {
            Mage::getResourceSingleton( 'bss/cms_fulltext' )->rebuildIndex();
            Mage::getSingleton( 'core/session' )->addNotice( 'Better Store Search Index was successfully rebuilt.' );
            Mage::register("already_ran_cms_page_index", 1);
        }
        
        return parent::_afterSave();
        
    }    

}