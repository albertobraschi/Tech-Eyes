<?php
/**
 * @category   MagePsycho
 * @package    MagePsycho_Jquerysliderspro
 * @author     magepsycho@gmail.com
 * @website    http://www.magepsycho.com
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class MagePsycho_Jquerysliderspro_Model_System_Config_Source_Slidecontent extends Varien_Object
{
    public function getOptionArray()
    {
        return array(
            'image'				=> Mage::helper('jquerysliderspro')->__('Image / Description'),
           // 'html_content'		=> Mage::helper('jquerysliderspro')->__('Html Content'),
            'catalog_product'   => Mage::helper('jquerysliderspro')->__('Catalog Product'),
        );
    }

	public function getFormOptionArray(){
		$options =  array(
			 array(
				  'value'     => 'image',
				  'label'     => Mage::helper('jquerysliderspro')->__('Image / Description'),
			  ),

			 /*array(
				  'value'     => 'html_content',
				  'label'     => Mage::helper('jquerysliderspro')->__('Html Content'),
			  ),*/

			 array(
				  'value'     => 'catalog_product',
				  'label'     => Mage::helper('jquerysliderspro')->__('Catalog Product'),
			  ),
		);
		array_unshift($options, array('value' => '', 'label' => Mage::helper('jquerysliderspro')->__('--Please Select--')));
        return $options;
	}
}