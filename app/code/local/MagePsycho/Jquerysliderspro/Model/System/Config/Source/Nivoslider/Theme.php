<?php
/**
 * @category   MagePsycho
 * @package    MagePsycho_Jquerysliderspro
 * @author     magepsycho@gmail.com
 * @website    http://www.magepsycho.com
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class MagePsycho_Jquerysliderspro_Model_System_Config_Source_Nivoslider_Theme
{
    public function toOptionArray()
    {
		$helper = Mage::helper('jquerysliderspro');
        return $helper->getFolders($helper->getSliderDir('nivo-slider/themes'));
    }
}