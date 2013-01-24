<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    Mage
 * @package     Mage_Catalog
 * @copyright   Copyright (c) 2011 Magento Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

$installer = $this;
/** @var $installer Mage_Catalog_Model_Resource_Setup */

$installer->updateAttribute(
    Mage_Catalog_Model_Product::ENTITY,
    'url_key',
    'frontend_label',
    'URL Key'
);

$installer->updateAttribute(
    Mage_Catalog_Model_Category::ENTITY,
    'url_key',
    'frontend_label',
    'URL Key'
);

$installer->updateAttribute(
    Mage_Catalog_Model_Product::ENTITY,
    'options_container',
    'frontend_label',
    'Display Product Options In'
);
$installer = $this;
$installer->startSetup();
$entityTypeId     = $installer->getEntityTypeId('catalog_category');
$attributeSetId   = $installer->getDefaultAttributeSetId($entityTypeId);
$attributeGroupId = $installer->getDefaultAttributeGroupId($entityTypeId, $attributeSetId);
$installer->addAttribute('catalog_category', 'new_cat_attrb',  array(
    'type'     => 'int',
    'label'    => 'New Category Attribute',
    'input'    => 'text',
    'global'   => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
    'visible'           => true,
    'required'          => false,
    'user_defined'      => false,
    'default'           => 0
));
$installer->addAttributeToGroup(
    $entityTypeId,
    $attributeSetId,
    $attributeGroupId,
    'new_cat_attrb',
    '11'                    //last Magento's attribute position in General tab is 10
);
$attributeId = $installer->getAttributeId($entityTypeId, 'new_cat_attrb');
$installer->run("
INSERT INTO `{$installer->getTable('catalog_category_entity_int')}`
(`entity_type_id`, `attribute_id`, `entity_id`, `value`)
    SELECT '{$entityTypeId}', '{$attributeId}', `entity_id`, '1'
        FROM `{$installer->getTable('catalog_category_entity')}`;
");
//this will set data of your custom attribute for root category
Mage::getModel('catalog/category')
    ->load(1)
    ->setImportedCatId(0)
    ->setInitialSetupFlag(true)
    ->save();
//this will set data of your custom attribute for default category
Mage::getModel('catalog/category')
    ->load(2)
    ->setImportedCatId(0)
    ->setInitialSetupFlag(true)
    ->save();
$installer->endSetup();