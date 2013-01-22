<?php
/**
 * @category   MagePsycho
 * @package    MagePsycho_Jquerysliderspro
 * @author     magepsycho@gmail.com
 * @website    http://www.magepsycho.com
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class MagePsycho_Jquerysliderspro_Block_Adminhtml_Slide_Edit_Tab_Content extends Mage_Adminhtml_Block_Widget_Form
{
	protected function _prepareForm()
	{
		$form = new Varien_Data_Form();
		$this->setForm($form);
		$fieldset = $form->addFieldset('content_form', array('legend'=>Mage::helper('jquerysliderspro')->__('Content')));

		$fieldset->addField('content_type', 'select', array(
			'label'     => Mage::helper('jquerysliderspro')->__('Content Type'),
			'class'     => 'required-entry',
			'required'  => true,
			'name'      => 'content_type',
			'onchange'	=> 'showHideContentDiv(this.value)',
			'values'    => Mage::getSingleton('jquerysliderspro/system_config_source_slidecontent')->getFormOptionArray(),
			'note'		=> '<strong>Note:</strong><br /> <strong>Image / Description:</strong> Uses Images(Description) for Slider.<!--<br /><strong>Html Content:</strong> Uses Html Content for Slider.--><br /><strong>Catalog Product:</strong> Uses Content(description, image etc) from Catalog Product for Slider.'
		));

		$fieldsetImage = $form->addFieldset('image_form', array('legend'=>Mage::helper('jquerysliderspro')->__('Image / Description')));
		$fieldsetImage->addField('imagefile', 'image', array(
			'label'     => Mage::helper('jquerysliderspro')->__('Image'),
			'required'  => false,
			'name'      => 'imagefile',
		));

		$fieldsetImage->addField('description', 'editor', array(
			'name'      => 'description',
			'label'     => Mage::helper('jquerysliderspro')->__('Description'),
			'title'     => Mage::helper('jquerysliderspro')->__('Description'),
			'style'     => 'width:274px; height:100px;',
			'wysiwyg'   => false,
			'required'  => false,
		));

		$fieldsetProduct = $form->addFieldset('product_form', array('legend'=>Mage::helper('jquerysliderspro')->__('Catalog Product')));
		$fieldsetProduct->addField('product_skus', 'editor', array(
			'name'      => 'product_skus',
			'label'     => Mage::helper('jquerysliderspro')->__('Product Skus'),
			'title'     => Mage::helper('jquerysliderspro')->__('Product Skus'),
			'style'     => 'width:274px; height:100px;',
			'wysiwyg'   => false,
			'required'  => false,
			'note'		=> 'Just use comma separated product skus. <br />For example: sku1,sku2,sku3'
		));

		$fieldsetHtml = $form->addFieldset('html_form', array('legend'=>Mage::helper('jquerysliderspro')->__('Html Content')));
		$fieldsetHtml->addField('html_content', 'editor', array(
			'name'      => 'html_content',
			'label'     => Mage::helper('jquerysliderspro')->__('Html Content'),
			'title'     => Mage::helper('jquerysliderspro')->__('Html Content'),
			'style'     => 'height:20em;width:50em;',
			'config'    => Mage::getSingleton('cms/wysiwyg_config')->getConfig(),
			'wysiwyg'   => true,
			'required'  => false,
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