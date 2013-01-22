<?php
/**
 * @category   MagePsycho
 * @package    MagePsycho_Jquerysliderspro
 * @author     magepsycho@gmail.com
 * @website    http://www.magepsycho.com
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class MagePsycho_Jquerysliderspro_Block_Adminhtml_Group_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
	protected function _prepareForm()
	{
		$form = new Varien_Data_Form();
		$this->setForm($form);
		$fieldset = $form->addFieldset('group_form', array('legend'=>Mage::helper('jquerysliderspro')->__('General')));

		$fieldset->addField('title', 'text', array(
			'label'     => Mage::helper('jquerysliderspro')->__('Title'),
			'class'     => 'required-entry',
			'required'  => true,
			'name'      => 'title',
		));

		$fieldset->addField('identifier', 'text', array(
			'label'     => Mage::helper('jquerysliderspro')->__('Identifier'),
			'class'     => 'required-entry',
			'required'  => true,
			'name'      => 'identifier',
			'note'		=> 'This code will be used for accessing entire Group slides. It should be unique.'
		));

		$fieldset->addField('status', 'select', array(
			'label'     => Mage::helper('jquerysliderspro')->__('Status'),
			'name'      => 'status',
			'values'    => Mage::getSingleton('jquerysliderspro/system_config_source_status')->getFormOptionArray(),

		));

		$form->setFieldNameSuffix('general');

		if ( Mage::getSingleton('adminhtml/session')->getGroupData() ) {
			$form->setValues(Mage::getSingleton('adminhtml/session')->getGroupData());
			Mage::getSingleton('adminhtml/session')->setGroupData(null);
		} elseif ( Mage::registry('group_data') ) {
			$form->setValues(Mage::registry('group_data')->getData());
		}
		return parent::_prepareForm();
	}
}