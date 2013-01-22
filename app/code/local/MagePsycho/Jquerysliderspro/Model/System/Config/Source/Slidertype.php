<?php
/**
 * @category   MagePsycho
 * @package    MagePsycho_Jquerysliderspro
 * @author     magepsycho@gmail.com
 * @website    http://www.magepsycho.com
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class MagePsycho_Jquerysliderspro_Model_System_Config_Source_Slidertype extends Varien_Object
{
    public function getOptionArray()
    {
        return array(
            'nivoslider'				=> Mage::helper('jquerysliderspro')->__('Nivo Slider'),
            /*'easyslider'		=> Mage::helper('jquerysliderspro')->__('Easy Slider'),
            'jcarousel'			=> Mage::helper('jquerysliderspro')->__('jCarousel'),*/
        );
    }

	public function getFormOptionArray(){

		$options =  array(
			 array(
				  'value'     => 'nivoslider',
				  'label'     => Mage::helper('jquerysliderspro')->__('Nivo Slider'),
			  ),

			 /*array(
				  'value'     => 'easyslider',
				  'label'     => Mage::helper('jquerysliderspro')->__('Easy Slider'),
			  ),

			 array(
				  'value'     => 'jcarousel',
				  'label'     => Mage::helper('jquerysliderspro')->__('jCarousel'),
			  ),*/
		);
		array_unshift($options, array('value' => '', 'label' => Mage::helper('jquerysliderspro')->__('--Please Select--')));
        return $options;
	}
}