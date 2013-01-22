<?php
/**
 * @category   MagePsycho
 * @package    MagePsycho_Jquerysliderspro
 * @author     info@magepsycho.com
 * @website    http://www.magepsycho.com
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class MagePsycho_Jquerysliderspro_Model_System_Config_Source_Domaintypes
{
    public function toOptionArray()
    {
        return array(
            '1'    => Mage::helper('jquerysliderspro')->__('Production'),
            '2'    => Mage::helper('jquerysliderspro')->__('Development'),
        );
    }
}