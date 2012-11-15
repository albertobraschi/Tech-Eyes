<?php
/**
 * @category   MagePsycho
 * @package    MagePsycho_Jquerysliderspro
 * @author     magepsycho@gmail.com
 * @website    http://www.magepsycho.com
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class MagePsycho_Jquerysliderspro_Model_System_Config_Source_Slide
{
    protected $_options;

	 public function getOptionArray()
    {
        $slideCollection = Mage::getModel('jquerysliderspro/slide')->getCollection();
		$slides = array();
		foreach($slideCollection as $_slide){
		  $slides[$_slide->getId()] = $_slide->getTitle();
		}
		return $slides;
    }

    public function getFormOptionArray()
    {
        if (!$this->_options) {
            $this->_options = Mage::getResourceModel('jquerysliderspro/slide_collection')->loadData()->toOptionArray(false);
        }

        $options = $this->_options;
        array_unshift($options, array('value' => '', 'label' => Mage::helper('jquerysliderspro')->__('--Please Select--')));

        return $options;
    }
}