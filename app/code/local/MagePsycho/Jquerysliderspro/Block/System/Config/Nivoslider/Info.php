<?php
/**
 * @category   MagePsycho
 * @package    MagePsycho_Jquerysliderspro
 * @author     magepsycho@gmail.com
 * @website    http://www.magepsycho.com
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class MagePsycho_Jquerysliderspro_Block_System_Config_Nivoslider_Info extends Mage_Adminhtml_Block_Abstract implements Varien_Data_Form_Element_Renderer_Interface
{
    /**
     * Render fieldset html
     *
     * @param Varien_Data_Form_Element_Abstract $element
     * @return string
     */
    public function render(Varien_Data_Form_Element_Abstract $element)
    {
        $html = '<div style="border:1px solid #CCCCCC;margin-bottom:10px;padding:10px 10px 10px 10px;">
    <h4>About Nivo Slider</h4>
    <p>The world\'s most awesome jQuery slider: Nivo Slider is world renowned as the most beautiful and easy to use slider on the market. Completely free and totally open source, there literally is no better way to make your website look totally stunning.<br />
    For more details: <a href="http://nivo.dev7studios.com" target="_blank">Visit Homepage</a>
    </p>
    </div>
';

        return $html;
    }
}