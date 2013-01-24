<?php
/**
 * @category   MagePsycho
 * @package    MagePsycho_Jquerysliderspro
 * @author     magepsycho@gmail.com
 * @website    http://www.magepsycho.com
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class MagePsycho_Jquerysliderspro_Model_Group extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('jquerysliderspro/group');
    }

	public function loadByIdentifier($identifier) {
        $this->load($identifier, 'identifier');
        return $this;
    }

	public function getSlidesCollection($groupId){
		$collection = Mage::getModel('jquerysliderspro/slide')->getCollection();
        $collection->addFieldToFilter('group_id', $groupId);
        return $collection;
	}

	public function checkIfIdentifierExists($value, $editId = 0){
		$group = $this->getCollection()
				->addFieldToFilter('identifier', $value);
		if($editId > 0){
			$group->addFieldToFilter('group_id', array('neq' => $editId));
		}
		return $group->getFirstItem()->getId();
	}
}