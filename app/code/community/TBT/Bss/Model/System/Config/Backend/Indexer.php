<?php

class TBT_Bss_Model_System_Config_Backend_Indexer extends Mage_Core_Model_Config_Data
{

    public function _afterSave() 
    {
        
        if ($this->isValueChanged() && Mage::registry("already_ran_cms_page_index") != 1)
        {
            Mage::getResourceSingleton( 'bss/cms_fulltext' )->rebuildIndex();
            Mage::getSingleton('core/session')->addNotice('Better Store Search Index was successfully rebuilt.');
        }
        
        return parent::_afterSave();
        
    }
    

}