<?php
/**
 * @category   MagePsycho
 * @package    MagePsycho_Jquerysliderspro
 * @author     magepsycho@gmail.com
 * @website    http://www.magepsycho.com
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class MagePsycho_Jquerysliderspro_Model_System_Config_Source_Target
{
   public function getOptionArray()
    {
        return array(
            '_self'				=> Mage::helper('jquerysliderspro')->__('Open in same window'),
            '_blank'		=> Mage::helper('jquerysliderspro')->__('Open in new window'),
        );
    }

	public function getFormOptionArray(){

		$options =  array(
			 array(
				  'value'     => '_self',
				  'label'     => Mage::helper('jquerysliderspro')->__('Open in same window'),
			  ),

			  array(
				  'value'     => '_blank',
				  'label'     => Mage::helper('jquerysliderspro')->__('Open in new window'),
			  ),
		);
		//array_unshift($options, array('value' => '', 'label' => Mage::helper('jquerysliderspro')->__('')));
        return $options;
	}
}