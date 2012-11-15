<?php
/**
 * @category   MagePsycho
 * @package    MagePsycho_Jquerysliderspro
 * @author     magepsycho@gmail.com
 * @website    http://www.magepsycho.com
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class MagePsycho_Jquerysliderspro_Model_System_Config_Source_Js_Jqueryinclusion
{
    public function toOptionArray()
    {
        return array(
            'head'			=> Mage::helper('jquerysliderspro')->__('Head (head.phtml)'),
            'ondemand'		=> Mage::helper('jquerysliderspro')->__('On Demand'),
        );
    }
}