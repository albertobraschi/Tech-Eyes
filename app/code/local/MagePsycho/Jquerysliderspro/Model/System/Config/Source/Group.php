<?php
/**
 * @category   MagePsycho
 * @package    MagePsycho_Jquerysliderspro
 * @author     magepsycho@gmail.com
 * @website    http://www.magepsycho.com
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class MagePsycho_Jquerysliderspro_Model_System_Config_Source_Group
{
    protected $_options;

	public function getOptionArray()
    {
        $groupCollection = Mage::getModel('jquerysliderspro/group')->getCollection();
		$groups = array();
		foreach($groupCollection as $_group){
		  $groups[$_group->getId()] = $_group->getTitle();
		}
		return $groups;
    }

    public function getFormOptionArray()
    {
        if (!$this->_options) {
            $this->_options = Mage::getResourceModel('jquerysliderspro/group_collection')->loadData()->toOptionArray(false);
        }

        $options = $this->_options;
        array_unshift($options, array('value' => '', 'label' => Mage::helper('jquerysliderspro')->__('--Please Select--')));

        return $options;
    }
}