<?php
/**
 * @category   MagePsycho
 * @package    MagePsycho_Jquerysliderspro
 * @author     magepsycho@gmail.com
 * @website    http://www.magepsycho.com
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class MagePsycho_Jquerysliderspro_Model_System_Config_Source_Js_Jquerytypes
{
    public function toOptionArray()
    {
        return array(
            'local'    => Mage::helper('jquerysliderspro')->__('Local (1.7.1)'),
            'google'   => Mage::helper('jquerysliderspro')->__('Google CDN (1.7.1)'),
        );
    }
}