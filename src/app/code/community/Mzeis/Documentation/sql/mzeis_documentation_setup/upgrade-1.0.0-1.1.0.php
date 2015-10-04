<?php

/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

$adapter = $installer->getConnection();
$table = $installer->getTable('mzeis_documentation/page');

$adapter->addColumn($table,
    'module',
    array(
        'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
        'length' => 255,
        'nullable'  => true,
        'comment' => 'Module',
        'after' => 'page_id'
    )
);

$adapter->addColumn($table,
    'source',
    array(
        'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
        'length' => 32,
        'nullable'  => false,
        'default' => Mzeis_Documentation_Model_Page::SOURCE_DATABASE,
        'comment' => 'Page Source',
        'after' => 'name'
    )
);

$adapter->addColumn($table,
    'type',
    array(
        'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
        'length' => 32,
        'nullable'  => false,
        'default' => Mzeis_Documentation_Model_Page::TYPE_PROJECT,
        'comment' => 'Page Type',
        'after' => 'source'
    )
);

$adapter->addColumn($table,
    'format',
    array(
        'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
        'length' => 32,
        'nullable'  => false,
        'default' => Mzeis_Documentation_Model_Page::FORMAT_MAGE_CMS,
        'comment' => 'Page Format',
        'after' => 'type'
    )
);

$installer->endSetup();
