<?php

/** @var Mage_Core_Model_Resource_Setup $installer */
$installer = $this;

$installer->startSetup();

$table= $installer->getConnection()
    ->newTable($installer->getTable('sysint_simpleslider/slider'))
    ->addColumn(
        'slide_id',
        Varien_Db_Ddl_Table::TYPE_INTEGER,
        16,
        [
            'unsigned' => true,
            'nullable' => false,
            'primary' => true,
            'identity' => true,
        ],
        'Slide ID'
    )
    ->addColumn(
        'image',
        Varien_Db_Ddl_Table::TYPE_TEXT,
        null,
        [
            'nullable' => false,
        ]
    )
    ->addColumn(
        'display_from',
        Varien_Db_Ddl_Table::TYPE_DATE,
        null,
        [
            'nullable' => true,
        ]
    )
    ->addColumn(
        'display_to',
        Varien_Db_Ddl_Table::TYPE_DATE,
        null,
        [
            'nullable' => true,
        ]
    )
    ->addColumn(
        'is_active',
        Varien_Db_Ddl_Table::TYPE_SMALLINT,
        1,
        [
            'nullable' => false,
            'default'  => 1
        ]
    )
    ->setComment('Sysint SimpleSlider table');

$installer->getConnection()->createTable($table);


$installer->endSetup();