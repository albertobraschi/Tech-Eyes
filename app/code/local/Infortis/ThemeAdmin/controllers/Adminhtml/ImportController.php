<?php

class Infortis_ThemeAdmin_Adminhtml_ImportController extends Mage_Adminhtml_Controller_Action
{
	public function indexAction()
	{
		$this->getResponse()->setRedirect($this->getUrl("adminhtml/system_config/edit/section/themeadmin/"));
	}
	
	public function blocksAction()
	{		
		$overwrite = Mage::helper('themeadmin')->getCfg('install/overwrite_blocks');
		Mage::getSingleton('themeadmin/import_cms')->importCmsItems('cms/block', 'blocks', $overwrite);
		
		$this->getResponse()->setRedirect($this->getUrl("adminhtml/system_config/edit/section/themeadmin/"));
	}
	
	public function pagesAction()
	{
		$overwrite = Mage::helper('themeadmin')->getCfg('install/overwrite_pages');
		Mage::getSingleton('themeadmin/import_cms')->importCmsItems('cms/page', 'pages', $overwrite);
		
		$this->getResponse()->setRedirect($this->getUrl("adminhtml/system_config/edit/section/themeadmin/"));
	}
}
