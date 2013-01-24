<?php
/**
 * @category   MagePsycho
 * @package    MagePsycho_Jquerysliderspro
 * @author     magepsycho@gmail.com
 * @website    http://www.magepsycho.com
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class MagePsycho_Jquerysliderspro_Model_System_Config_Source_Nivoslider_Opacity
{
    public function toOptionArray()
    {
        $range = range(0, 1, 0.1);
        $array = array();
        foreach($range as $val){
            $array["$val"] = $val;
        }
        return $array;
    }
}