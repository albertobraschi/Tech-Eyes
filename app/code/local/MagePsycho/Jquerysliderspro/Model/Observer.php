<?php
/**
 * @category   MagePsycho
 * @package    MagePsycho_Jquerysliderspro
 * @author     magepsycho@gmail.com
 * @website    http://www.magepsycho.com
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class MagePsycho_Jquerysliderspro_Model_Observer {

	public function preDispatchCheck($observer = null) {
		$helper				= Mage::helper('jquerysliderspro');
		$isValid			= $helper->isValid();
		$isActive			= $helper->isActive();
		$coreSession		= Mage::getSingleton('core/session');
		if ($isActive && !$isValid) {
			$coreSession->getMessages(true);
			$coreSession->addError($helper->getMessage());
			return;
		}
        return $this;
	}

}