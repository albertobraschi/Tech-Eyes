<?php

$this->startSetup();
 
$this->addAttribute('catalog_category', 'elquesiga', array(
    'group'         => 'General Information',
    'input'         => 'text',
    'type'          => 'varchar',
    'label'         => 'El que siga',
    'backend'       => '',
    'visible'       => 1,
    'required'      => 0,
    'user_defined' => 1,
    'global'        => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
));
 
$this->endSetup();

?>