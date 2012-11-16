<?php
class MagePsycho_Jquerysliderspro_Block_Adminhtml_Group_Edit_Renderer_Label extends Mage_Adminhtml_Block_Widget implements Varien_Data_Form_Element_Renderer_Interface
{
	public function render(Varien_Data_Form_Element_Abstract $element)
    {
         $html = '<tr><td colspan="2"><h4 style=" border-bottom: 1px solid #CCCCCC; margin: 0;color: #494848; font-size: 1.05em;">' . $element->getLabel() . '</h4></td></tr>';
        return $html;
    }
}