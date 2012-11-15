<?php
/**
 * @category   MagePsycho
 * @package    MagePsycho_Jquerysliderspro
 * @author     magepsycho@gmail.com
 * @website    http://www.magepsycho.com
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class MagePsycho_Jquerysliderspro_Block_Adminhtml_Group_Edit_Tab_Settings extends Mage_Adminhtml_Block_Widget_Form
{
	protected function _prepareForm()
	{
		$form = new Varien_Data_Form();
		$this->setForm($form);
		$fieldset = $form->addFieldset('settings_section', array('legend'=>Mage::helper('jquerysliderspro')->__('Settings')));

		$fieldset->addField('slider_type', 'select', array(
			'label'     => Mage::helper('jquerysliderspro')->__('Slider Type'),
			'class'     => 'required-entry',
			'required'  => true,
			'name'      => 'slider_type',
			'values'    => Mage::getSingleton('jquerysliderspro/system_config_source_slidertype')->getFormOptionArray(),
			'note'		=> 'jQuery Slider Plugins'
		));

		$fieldset->addField('slider_width', 'text', array(
			'label'     => Mage::helper('jquerysliderspro')->__('Slider Width (px)'),
			'class'     => 'required-entry',
			'required'  => true,
			'name'      => 'slider_width',
		));

		$fieldset->addField('slider_height', 'text', array(
			'label'     => Mage::helper('jquerysliderspro')->__('Slider Height (px)'),
			'class'     => 'required-entry',
			'required'  => true,
			'name'      => 'slider_height',
		));

		$fieldset->addField('use_slider_settings', 'select', array(
			'label'     => Mage::helper('jquerysliderspro')->__('Use Slider Settings'),
			'onchange'	=> 'showHideSliderDiv(this.value)',
			'values'    => Mage::getSingleton('jquerysliderspro/system_config_source_slidersettingsfrom')->toOptionArray(),
			'name'      => 'use_slider_settings',
			'note'		=> '<strong>From Config Settings:</strong> Slider settings will be taken from System > Configuration<br /><strong>From Custom Settings:</strong> You can customize the slider settings from below'
		));

		########################### NIVO SLIDER ###########################
		$fieldset = $form->addFieldset('nivoslider_section', array('legend'=>Mage::helper('jquerysliderspro')->__('Nivo Slider')));
		
		$fieldset->addField('nivoslider_general_label', 'text', array(
            'name'         => 'nivoslider_general_label',
            'label'        => Mage::helper('jquerysliderspro')->__('General'),
        ));
        $form->getElement('nivoslider_general_label')->setRenderer(Mage::app()->getLayout()->createBlock(
            'jquerysliderspro/adminhtml_group_edit_renderer_label'
        ));

		$fieldset->addField('nivoslider_theme', 'select', array(
			'label'     => Mage::helper('jquerysliderspro')->__('Theme'),
			'class'     => '',
			'required'  => false,
			'name'      => 'nivoslider_theme',
			'values'    => Mage::getSingleton('jquerysliderspro/system_config_source_nivoslider_theme')->toOptionArray(),
			'note'		=> 'Theme Location: "js/jquerysliderspro/nivo-slider/themes"<br /> <strong>Note:</strong> You need to create new theme in order to  customize the look n feel of slider as described here:<br /> <a href="http://nivo.dev7studios.com/support/advanced-tutorials/creating-custom-themes-for-the-nivo-slider/"target="_blank">Creating Custom Themes for the Nivo Slider</a>.<br /> After that you just need to place the new theme in folder: "js/jquerysliderspro/nivo-slider/themes" and it will be auto-listed in the Theme dropdown for selection.',
		));


		$fieldset->addField('nivoslider_transition_label', 'text', array(
            'name'         => 'nivoslider_transition_label',
            'label'        => Mage::helper('jquerysliderspro')->__('Transition'),
        ));
        $form->getElement('nivoslider_transition_label')->setRenderer(Mage::app()->getLayout()->createBlock(
            'jquerysliderspro/adminhtml_group_edit_renderer_label'
        ));

		$fieldset->addField('nivoslider_effect', 'select', array(
			'label'     => Mage::helper('jquerysliderspro')->__('Transition Type'),
			'class'     => '',
			'required'  => false,
			'name'      => 'nivoslider_effect',
			'values'    => Mage::getSingleton('jquerysliderspro/system_config_source_nivoslider_transitioneffect')->toOptionArray(),
			'note'		=> '',
		));

		$fieldset->addField('nivoslider_slices', 'text', array(
			'label'     => Mage::helper('jquerysliderspro')->__('No Of Slices'),
			'class'     => '',
			'required'  => false,
			'name'      => 'nivoslider_slices',
			'note'		=> '',
		));

		$fieldset->addField('nivoslider_boxCols', 'text', array(
			'label'     => Mage::helper('jquerysliderspro')->__('Box Cols'),
			'class'     => '',
			'required'  => false,
			'name'      => 'nivoslider_boxCols',
			'note'		=> '',
		));

		$fieldset->addField('nivoslider_boxRows', 'text', array(
			'label'     => Mage::helper('jquerysliderspro')->__('Box Rows'),
			'class'     => '',
			'required'  => false,
			'name'      => 'nivoslider_boxRows',
			'note'		=> '',
		));

		$fieldset->addField('nivoslider_animSpeed', 'text', array(
			'label'     => Mage::helper('jquerysliderspro')->__('Animation Speed'),
			'class'     => '',
			'required'  => false,
			'name'      => 'nivoslider_animSpeed',
			'note'		=> '',
		));

		$fieldset->addField('nivoslider_pauseTime', 'text', array(
			'label'     => Mage::helper('jquerysliderspro')->__('Pause Time'),
			'class'     => '',
			'required'  => false,
			'name'      => 'nivoslider_pauseTime',
			'note'		=> '',
		));

		$fieldset->addField('nivoslider_navigation_label', 'text', array(
            'name'         => 'nivoslider_navigation_label',
            'label'        => Mage::helper('jquerysliderspro')->__('Arrow Navigation'),
        ));
        $form->getElement('nivoslider_navigation_label')->setRenderer(Mage::app()->getLayout()->createBlock(
            'jquerysliderspro/adminhtml_group_edit_renderer_label'
        ));

		$fieldset->addField('nivoslider_directionNav', 'select', array(
			'label'     => Mage::helper('jquerysliderspro')->__('Enable Arrow Navigation'),
			'class'     => '',
			'required'  => false,
			'name'      => 'nivoslider_directionNav',
			'values'	=> Mage::getSingleton('adminhtml/system_config_source_yesno')->toOptionArray(),
			'note'		=> '',
		));

		$fieldset->addField('nivoslider_directionNavHide', 'select', array(
			'label'     => Mage::helper('jquerysliderspro')->__('Hide Arrow Navigation on Hover'),
			'class'     => '',
			'required'  => false,
			'name'      => 'nivoslider_directionNavHide',
			'values'	=> Mage::getSingleton('adminhtml/system_config_source_yesno')->toOptionArray(),
			'note'		=> '',
		));


		$fieldset->addField('nivoslider_bullet_navigation_label', 'text', array(
            'name'         => 'nivoslider_bullet_navigation_label',
            'label'        => Mage::helper('jquerysliderspro')->__('Bullet Navigation'),
        ));
        $form->getElement('nivoslider_bullet_navigation_label')->setRenderer(Mage::app()->getLayout()->createBlock(
            'jquerysliderspro/adminhtml_group_edit_renderer_label'
        ));

		$fieldset->addField('nivoslider_controlNav', 'select', array(
			'label'     => Mage::helper('jquerysliderspro')->__('Enable Bullet Navigation'),
			'class'     => '',
			'required'  => false,
			'name'      => 'nivoslider_controlNav',
			'values'	=> Mage::getSingleton('adminhtml/system_config_source_yesno')->toOptionArray(),
			'note'		=> '',
		));

		$fieldset->addField('nivoslider_keyboardNav', 'select', array(
			'label'     => Mage::helper('jquerysliderspro')->__('Enable Keyboard Navigation'),
			'class'     => '',
			'required'  => false,
			'name'      => 'nivoslider_keyboardNav',
			'values'	=> Mage::getSingleton('adminhtml/system_config_source_yesno')->toOptionArray(),
			'note'		=> '',
		));

		$fieldset->addField('nivoslider_pauseOnHover', 'select', array(
			'label'     => Mage::helper('jquerysliderspro')->__('Pause On Hover'),
			'class'     => '',
			'required'  => false,
			'name'      => 'nivoslider_pauseOnHover',
			'values'	=> Mage::getSingleton('adminhtml/system_config_source_yesno')->toOptionArray(),
			'note'		=> '',
		));

		$fieldset->addField('nivoslider_manualAdvance', 'select', array(
			'label'     => Mage::helper('jquerysliderspro')->__('Enable Manual Advance'),
			'class'     => '',
			'required'  => false,
			'name'      => 'nivoslider_manualAdvance',
			'values'	=> Mage::getSingleton('adminhtml/system_config_source_yesno')->toOptionArray(),
			'note'		=> '',
		));

		$fieldset->addField('nivoslider_randomStart', 'select', array(
			'label'     => Mage::helper('jquerysliderspro')->__('Enable Random Start'),
			'class'     => '',
			'required'  => false,
			'name'      => 'nivoslider_randomStart',
			'values'	=> Mage::getSingleton('adminhtml/system_config_source_yesno')->toOptionArray(),
			'note'		=> '',
		));


		$fieldset->addField('nivoslider_caption_label', 'text', array(
            'name'         => 'nivoslider_caption_label',
            'label'        => Mage::helper('jquerysliderspro')->__('Caption'),
        ));
        $form->getElement('nivoslider_caption_label')->setRenderer(Mage::app()->getLayout()->createBlock(
            'jquerysliderspro/adminhtml_group_edit_renderer_label'
        ));

		$fieldset->addField('nivoslider_showCaption', 'select', array(
			'label'     => Mage::helper('jquerysliderspro')->__('Enable Caption'),
			'class'     => '',
			'required'  => false,
			'name'      => 'nivoslider_showCaption',
			'values'	=> Mage::getSingleton('adminhtml/system_config_source_yesno')->toOptionArray(),
			'note'		=> '',
		));

		$fieldset->addField('nivoslider_captionOpacity', 'select', array(
			'label'     => Mage::helper('jquerysliderspro')->__('Caption Opacity'),
			'class'     => '',
			'required'  => false,
			'name'      => 'nivoslider_captionOpacity',
			'values'	=> Mage::getSingleton('jquerysliderspro/system_config_source_nivoslider_opacity')->toOptionArray(),
			'note'		=> '',
		));


		########################### NIVO SLIDER ###########################


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