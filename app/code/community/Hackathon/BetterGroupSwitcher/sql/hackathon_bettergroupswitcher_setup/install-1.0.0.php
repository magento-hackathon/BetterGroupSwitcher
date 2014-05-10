<?php

/* @var $installer Mage_Eav_Model_Entity_Setup */
$installer = $this;

$installer->startSetup();

$installer->addAttribute(
    Mage_Catalog_Model_Product::ENTITY,
    'add_to_customergroup',
    array(
        'type'     => 'int',
        'required' => false,
        'group'    => 'Customer Group',
        'input'    => 'select',
        'label'    => 'Add to customer group',
        'source'   => 'hackathon_bettergroupswitcher/source_customergroup',
        'note'     => 'Customer is added to this group, after purchasing the product.',
    )
);

$installer->endSetup();