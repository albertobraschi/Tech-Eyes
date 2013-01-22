<?php
/**
 * @category   MagePsycho
 * @package    MagePsycho_Jquerysliderspro
 * @author     magepsycho@gmail.com
 * @website    http://www.magepsycho.com
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class MagePsycho_Jquerysliderspro_Block_Slider extends Mage_Core_Block_Template
{
	protected function _construct() {
        parent::_construct();
    }

    protected function _beforeToHtml() {
		$helper = Mage::helper('jquerysliderspro');
		if($this->getData('identifier')){
			$slider = Mage::getModel('jquerysliderspro/group')->loadByIdentifier($this->getData('identifier'));
			if($slider && $slider->getStatus() == 1){
				$this->setSlider($slider);
				$this->setTemplate('jquerysliderspro/'.$slider->getSliderType().'/slider.phtml');
			}
		}
        return parent::_beforeToHtml();
    }
}