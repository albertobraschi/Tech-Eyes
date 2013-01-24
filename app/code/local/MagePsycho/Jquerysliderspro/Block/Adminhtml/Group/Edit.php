<?php
/**
 * @category   MagePsycho
 * @package    MagePsycho_Jquerysliderspro
 * @author     magepsycho@gmail.com
 * @website    http://www.magepsycho.com
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class MagePsycho_Jquerysliderspro_Block_Adminhtml_Group_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
		#echo Varien_Debug::backtrace(true, true); exit;
        parent::__construct();

        $this->_objectId	= 'id';
        $this->_blockGroup	= 'jquerysliderspro';
        $this->_controller	= 'adminhtml_group';

		if($this->getRequest()->getParam('id')) {
            $this->_addButton('addslide', array(
                'label' => $this->__('Add Slide'),
                'onclick'   => 'setLocation(\'' . $this->getUrl('*/adminhtml_slide/new', array('group_id' => $this->getRequest()->getParam('id'))) . '\')',
				'class'     => 'save',
            ), 0);
        }

        $this->_updateButton('save', 'label', Mage::helper('jquerysliderspro')->__('Save Group'));
        $this->_updateButton('delete', 'label', Mage::helper('jquerysliderspro')->__('Delete Group'));

        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

		$sliderType		= '';
		$useSliderSettings = '';
		if(Mage::registry('group_data') && Mage::registry('group_data')->getId()){
			$sliderType			= Mage::registry('group_data')->getSliderType();
			$useSliderSettings  = Mage::registry('group_data')->getUseSliderSettings();
		}

		if(Mage::getSingleton('adminhtml/session')->getFormData('slider_type')){
			$sliderType			= Mage::getSingleton('adminhtml/session')->getFormData('slider_type');
			$useSliderSettings  = Mage::getSingleton('adminhtml/session')->getFormData('use_slider_settings');
		}

        $this->_formScripts[] = "
            function showHideSliderDiv(useSliderSetting, sliderType){
				if(sliderType == null || sliderType == ''){
					var sliderType = $('slider_type').getValue();
				}
				var nivoFormDiv	= $('nivoslider_section');
				if(sliderType == 'nivoslider' && useSliderSetting == 'from_custom_settings'){
					nivoFormDiv.previous(0).show();
					nivoFormDiv.show();
				}else{
					nivoFormDiv.previous(0).hide();
					nivoFormDiv.hide();
				}
			}

			function showHideSliderWrapper(){
				showHideSliderDiv('".$useSliderSettings."', '".$sliderType."');
			}
			window.onload = showHideSliderWrapper;

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText()
    {
        if( Mage::registry('group_data') && Mage::registry('group_data')->getId() ) {
            return Mage::helper('jquerysliderspro')->__("Edit Group '%s'", $this->htmlEscape(Mage::registry('group_data')->getTitle()));
        } else {
            return Mage::helper('jquerysliderspro')->__('Add Group');
        }
    }
}