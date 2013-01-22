<?php
/**
 * @category   MagePsycho
 * @package    MagePsycho_Jquerysliderspro
 * @author     magepsycho@gmail.com
 * @website    http://www.magepsycho.com
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class MagePsycho_Jquerysliderspro_Model_System_Config_Source_Slidersettingsfrom
{
    public function toOptionArray()
    {
        return array(
			'from_config_settings'				=> Mage::helper('jquerysliderspro')->__('From Config Settings'),
            'from_custom_settings'				=> Mage::helper('jquerysliderspro')->__('From Custom Settings'),
        );
    }
}