<?php
/**
 * @category   MagePsycho
 * @package    MagePsycho_Jquerysliderspro
 * @author     magepsycho@gmail.com
 * @website    http://www.magepsycho.com
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class MagePsycho_Jquerysliderspro_Block_Adminhtml_Group_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

	public function __construct()
	{
		parent::__construct();
		$this->setId('group_tabs');
		$this->setDestElementId('edit_form');
		$this->setTitle(Mage::helper('jquerysliderspro')->__('Group Information'));
	}

	protected function _beforeToHtml()
	{
		$this->addTab('form_section', array(
			'label'     => Mage::helper('jquerysliderspro')->__('General'),
			'title'     => Mage::helper('jquerysliderspro')->__('General'),
			'content'   => $this->getLayout()->createBlock('jquerysliderspro/adminhtml_group_edit_tab_form')->toHtml(),
		));

		$this->addTab('settings_section', array(
			'label'     => Mage::helper('jquerysliderspro')->__('Settings'),
			'title'     => Mage::helper('jquerysliderspro')->__('Settings'),
			'content'   => $this->getLayout()->createBlock('jquerysliderspro/adminhtml_group_edit_tab_settings')->toHtml(),
		));

        $this->addTab('slides_section', array(
           'label'     => Mage::helper('jquerysliderspro')->__('Slides'),
		   'title'     => Mage::helper('jquerysliderspro')->__('Slides'),
            'content'  => $this->getLayout()->createBlock('jquerysliderspro/adminhtml_group_edit_tab_slides')->toHtml()
        ));

		if($this->getRequest()->getParam('continue_tab')){
			$this->setActiveTab('slides_section');
		}

		return parent::_beforeToHtml();
	}

}