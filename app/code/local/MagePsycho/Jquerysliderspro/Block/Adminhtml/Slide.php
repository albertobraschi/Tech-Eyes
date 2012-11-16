<?php
/**
 * @category   MagePsycho
 * @package    MagePsycho_Jquerysliderspro
 * @author     magepsycho@gmail.com
 * @website    http://www.magepsycho.com
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class MagePsycho_Jquerysliderspro_Block_Adminhtml_Slide extends Mage_Adminhtml_Block_Widget_Grid_Container
{
	public function __construct()
	{
		$this->_controller = 'adminhtml_slide';
		$this->_blockGroup = 'jquerysliderspro';
		$this->_headerText = Mage::helper('jquerysliderspro')->__('Manage Slides');
		$this->_addButtonLabel = Mage::helper('jquerysliderspro')->__('Add Slide');
		parent::__construct();
	}
}