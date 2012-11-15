<?php
/**
 * @category   MagePsycho
 * @package    MagePsycho_Jquerysliderspro
 * @author     magepsycho@gmail.com
 * @website    http://www.magepsycho.com
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class MagePsycho_Jquerysliderspro_Model_Mysql4_Group extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {
        $this->_init('jquerysliderspro/group', 'group_id');
    }
}