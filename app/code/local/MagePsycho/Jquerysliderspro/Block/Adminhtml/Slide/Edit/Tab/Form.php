<?php
/**
 * @category   MagePsycho
 * @package    MagePsycho_Jquerysliderspro
 * @author     magepsycho@gmail.com
 * @website    http://www.magepsycho.com
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class MagePsycho_Jquerysliderspro_Block_Adminhtml_Slide_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
	protected function _prepareForm()
	{
		$form = new Varien_Data_Form();
		$this->setForm($form);
		$fieldset = $form->addFieldset('slide_form', array('legend'=>Mage::helper('jquerysliderspro')->__('General')));

		$hiddenGroupIdField = null;
		if($groupId = $this->getRequest()->getParam('group_id')){
			$isGroupDisabled = true;
			if($groupId > 0){
				$hiddenGroupIdField = '<input type="hidden" name="group_id" value="'.$groupId.'" />';
			}else{
				$hiddenGroupIdField = '<input type="hidden" name="group_id" value="'.Mage::registry('slide_data')->getGroupId().'" />';
			}
		}else{
			$isGroupDisabled = false;
			$hiddenGroupIdField = null;
		}

		$fieldset->addField('group_id', 'select', array(
			'label'     => Mage::helper('jquerysliderspro')->__('Group'),
			'name'      => 'group_id',
			'required'  => true,
			'disabled'	=> $isGroupDisabled,
			'values'    => Mage::getSingleton('jquerysliderspro/system_config_source_group')->getFormOptionArray(),
			'after_element_html' => $hiddenGroupIdField,
		));

		$fieldset->addField('title', 'text', array(
			'label'     => Mage::helper('jquerysliderspro')->__('Title'),
			'class'     => 'required-entry',
			'required'  => true,
			'name'      => 'title',
		));

		$fieldset->addField('link', 'text', array(
			'label'     => Mage::helper('jquerysliderspro')->__('Link'),
			//'class'     => 'required-entry',
			'required'  => false,
			'name'      => 'link',
			'note'		=> '<b>Notes: </b><br /> 1. You need to use {{base_url}} as base url of store, used for internal link.<br />Example: {{base_url}}/promotions.html <br /> 2. You can use full url too, used for external link.<br />Example: http://my-another-store.com/some-page-link'
		));

		$fieldset->addField('target', 'select', array(
			'label'     => Mage::helper('jquerysliderspro')->__('Link Target'),
			//'class'     => 'required-entry',
			'required'  => false,
			'name'      => 'target',
			'values'    => Mage::getSingleton('jquerysliderspro/system_config_source_target')->getFormOptionArray(),
		));

		$fieldset->addField('sort_order', 'text', array(
			'label'     => Mage::helper('jquerysliderspro')->__('Sort Order'),
			//'class'     => 'required-entry',
			'required'  => false,
			'name'      => 'sort_order',
		));

		$fieldset->addField('status', 'select', array(
			'label'     => Mage::helper('jquerysliderspro')->__('Status'),
			'name'      => 'status',
			'values'    => Mage::getSingleton('jquerysliderspro/system_config_source_status')->getFormOptionArray(),
		));

		if ( Mage::getSingleton('adminhtml/session')->getSlideData() ) {
			$form->setValues(Mage::getSingleton('adminhtml/session')->getSlideData());
			Mage::getSingleton('adminhtml/session')->setSlideData(null);
		} elseif ( Mage::registry('slide_data') ) {
			$form->setValues(Mage::registry('slide_data')->getData());
		}
		return parent::_prepareForm();
	}


}