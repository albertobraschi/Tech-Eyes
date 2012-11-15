<?php
/**
 * @category   MagePsycho
 * @package    MagePsycho_Jquerysliderspro
 * @author     magepsycho@gmail.com
 * @website    http://www.magepsycho.com
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class MagePsycho_Jquerysliderspro_Model_Mysql4_Slide_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('jquerysliderspro/slide');
    }

	public function addSliderGroupFilter($groupId) {
        $this->getSelect()->where('group_id = ?', $groupId);
        return $this;
    }

	public function toOptionArray()
    {
        return $this->_toOptionArray('slide_id', 'title');
    }
}