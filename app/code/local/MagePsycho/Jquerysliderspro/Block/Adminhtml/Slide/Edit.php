<?php
/**
 * @category   MagePsycho
 * @package    MagePsycho_Jquerysliderspro
 * @author     magepsycho@gmail.com
 * @website    http://www.magepsycho.com
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class MagePsycho_Jquerysliderspro_Block_Adminhtml_Slide_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();

        $this->_objectId	= 'id';
        $this->_blockGroup	= 'jquerysliderspro';
        $this->_controller	= 'adminhtml_slide';

        $this->_updateButton('save', 'label', Mage::helper('jquerysliderspro')->__('Save Slide'));
        $this->_updateButton('delete', 'label', Mage::helper('jquerysliderspro')->__('Delete Slide'));

        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

		$contentType = 'none';
		if(Mage::registry('slide_data') && Mage::registry('slide_data')->getId()){
			$contentType = Mage::registry('slide_data')->getContentType();
		}

        $this->_formScripts[] = "
			function showHideContentDiv(value){
				var imageFormDiv	= $('image_form');
				var htmlFormDiv		= $('html_form');
				var productFormDiv	= $('product_form');
				if(value == 'html_content'){
					imageFormDiv.previous(0).hide();
					imageFormDiv.hide();
					htmlFormDiv.previous(0).show();
					htmlFormDiv.show();
					productFormDiv.previous(0).hide();
					productFormDiv.hide();
				}

				if(value == 'image'){
					imageFormDiv.previous(0).show();
					imageFormDiv.show();
					htmlFormDiv.previous(0).hide();
					htmlFormDiv.hide();
					productFormDiv.previous(0).hide();
					productFormDiv.hide();
				}

				if(value == 'catalog_product'){
					imageFormDiv.previous(0).hide();
					imageFormDiv.hide();
					htmlFormDiv.previous(0).hide();
					htmlFormDiv.hide();
					productFormDiv.previous(0).show();
					productFormDiv.show();
				}

				if(value == 'none'){
					imageFormDiv.previous(0).hide();
					imageFormDiv.hide();
					htmlFormDiv.previous(0).hide();
					htmlFormDiv.hide();
					productFormDiv.previous(0).hide();
					productFormDiv.hide();
				}
			}
			function showHideContentWrapper(){
				showHideContentDiv('".$contentType."');
			}
			window.onload = showHideContentWrapper;
            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

	protected function _prepareLayout() {
		parent::_prepareLayout();
		if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
			$this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
		}
	}

    public function getHeaderText()
    {
        if( Mage::registry('slide_data') && Mage::registry('slide_data')->getId() ) {
            return Mage::helper('jquerysliderspro')->__("Edit Slide '%s'", $this->htmlEscape(Mage::registry('slide_data')->getTitle()));
        } else {
            return Mage::helper('jquerysliderspro')->__('Add Slide');
        }
    }
}