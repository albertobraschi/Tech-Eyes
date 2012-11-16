<?php
/**
 * @category   MagePsycho
 * @package    MagePsycho_Jquerysliderspro
 * @author     magepsycho@gmail.com
 * @website    http://www.magepsycho.com
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class MagePsycho_Jquerysliderspro_Model_System_Config_Source_Nivoslider_Transitioneffect
{
    public function toOptionArray()
    {
        return array(
            'random'				=> Mage::helper('jquerysliderspro')->__('random'),
            'sliceDown'				=> Mage::helper('jquerysliderspro')->__('sliceDown'),
            'sliceDownLeft'			=> Mage::helper('jquerysliderspro')->__('sliceDownLeft'),
            'sliceUp'				=> Mage::helper('jquerysliderspro')->__('sliceUp'),
            'sliceUpLeft'			=> Mage::helper('jquerysliderspro')->__('sliceUpLeft'),
            'sliceUpDown'			=> Mage::helper('jquerysliderspro')->__('sliceUpDown'),
            'sliceUpDownLeft'		=> Mage::helper('jquerysliderspro')->__('sliceUpDownLeft'),
            'slideInRight'			=> Mage::helper('jquerysliderspro')->__('slideInRight'),
            'slideInLeft'			=> Mage::helper('jquerysliderspro')->__('slideInLeft'),
            'fold'					=> Mage::helper('jquerysliderspro')->__('fold'),
            'fade'					=> Mage::helper('jquerysliderspro')->__('fade'),
            'boxRandom'				=> Mage::helper('jquerysliderspro')->__('boxRandom'),
            'boxRain'				=> Mage::helper('jquerysliderspro')->__('boxRain'),
            'boxRainReverse'		=> Mage::helper('jquerysliderspro')->__('boxRainReverse'),
            'boxRainGrow'			=> Mage::helper('jquerysliderspro')->__('boxRainGrow'),
            'boxRainGrowReverse'	=> Mage::helper('jquerysliderspro')->__('boxRainGrowReverse'),
        );
    }
}