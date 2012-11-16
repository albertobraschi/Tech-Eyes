<?php
class MagePsycho_Jquerysliderspro_Block_Adminhtml_Group_Grid_Renderer_Image extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
		$helper = Mage::helper('jquerysliderspro');
        if($row->getImagefile() == ""){
            return "(no image)";
        } else{
            return '<img src="' . $helper->getResizedUrl($row->getImagefile(), 75, 50) . '" width="75" height="50"/>';
        }
    }
}