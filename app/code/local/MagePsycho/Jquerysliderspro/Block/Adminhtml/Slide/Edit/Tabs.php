<?php
/**
 * @category   MagePsycho
 * @package    MagePsycho_Jquerysliderspro
 * @author     magepsycho@gmail.com
 * @website    http://www.magepsycho.com
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class MagePsycho_Jquerysliderspro_Block_Adminhtml_Slide_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

	public function __construct()
	{
		parent::__construct();
		$this->setId('slide_tabs');
		$this->setDestElementId('edit_form');
		$this->setTitle(Mage::helper('jquerysliderspro')->__('Slide Information'));
	}

	protected function _beforeToHtml()
	{
		$this->addTab('form_section', array(
			'label'     => Mage::helper('jquerysliderspro')->__('General'),
			'title'     => Mage::helper('jquerysliderspro')->__('General'),
			'content'   => $this->getLayout()->createBlock('jquerysliderspro/adminhtml_slide_edit_tab_form')->toHtml(),
		));

		$this->addTab('content_section', array(
			'label'     => Mage::helper('jquerysliderspro')->__('Content'),
			'title'     => Mage::helper('jquerysliderspro')->__('Content'),
			'content'   => $this->getLayout()->createBlock('jquerysliderspro/adminhtml_slide_edit_tab_content')->toHtml(),
		));

		return parent::_beforeToHtml();
	}

}