<?php
/**
 * NOTICE OF LICENSE
 * This source file is subject to the BETTER STORE SEARCH
 * License, which is available at this URL: http://www.betterstoresearch.com/docs/bss_license.txt
 * 
 * DISCLAIMER
 * By adding to, editing, or in any way modifying this code, WDCA is not held liable for any inconsistencies or abnormalities in the 
 * behaviour of this code. By adding to, editing, or in any way modifying this code, the Licensee terminates any agreement of support 
 * offered by WDCA, outlined in the provided Sweet Tooth License.  Upon discovery of modified code in the process of support, the Licensee 
 * is still held accountable for any and all billable time WDCA spent  during the support process.
 * WDCA does not guarantee compatibility with any other framework extension. WDCA is not responsbile for any inconsistencies or abnormalities in the
 * behaviour of this code if caused by other framework extension. If you did not receive a copy of the license, please send an email to 
 * contact@wdca.ca or call 1-888-699-WDCA(9322), so we can send you a copy immediately.
 * 
 * @category   [TBT]
 * @package    [TBT_Bss]
 * @copyright  Copyright (c) 2011 WDCA (http://www.wdca.ca)
 * @license    http://www.betterstoresearch.com/docs/bss_license.txt
*/

$installer = $this;

$installer->startSetup();

$installer->run("
	ALTER TABLE `{$this->getTable('bss_index')}` ENGINE = MYISAM ROW_FORMAT = DYNAMIC;
");

$message = Mage::getModel('adminnotification/inbox');
$message->setSeverity(Mage_AdminNotification_Model_Inbox::SEVERITY_NOTICE);
$message->setDateAdded(date("c", time()+2));
$message->setTitle("Better Store Search was successfully upgraded to version 3.0");
$message->setDescription("Better Store Search 3.0 was installed successfully. You will need to rebuild your search indexes and refresh cache even though it might say that indexes are already processed.");
$message->setUrl("http://www.betterstoresearch.com/changelog");
$message->save();
    

$installer->endSetup(); 