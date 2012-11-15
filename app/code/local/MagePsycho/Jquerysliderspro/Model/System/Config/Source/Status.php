<?php
/**
 * @category   MagePsycho
 * @package    MagePsycho_Jquerysliderspro
 * @author     magepsycho@gmail.com
 * @website    http://www.magepsycho.com
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class MagePsycho_Jquerysliderspro_Model_System_Config_Source_Status extends Varien_Object
{
    const STATUS_ENABLED	= 1;
    const STATUS_DISABLED	= 2;

    static public function getOptionArray()
    {
        return array(
            self::STATUS_ENABLED    => Mage::helper('jquerysliderspro')->__('Enabled'),
            self::STATUS_DISABLED   => Mage::helper('jquerysliderspro')->__('Disabled')
        );
    }

	public function getFormOptionArray(){
		return array(
			 array(
				  'value'     => self::STATUS_ENABLED,
				  'label'     => Mage::helper('jquerysliderspro')->__('Enabled'),
			  ),

			  array(
				  'value'     => self::STATUS_DISABLED,
				  'label'     => Mage::helper('jquerysliderspro')->__('Disabled'),
			  ),
		);
	}
}