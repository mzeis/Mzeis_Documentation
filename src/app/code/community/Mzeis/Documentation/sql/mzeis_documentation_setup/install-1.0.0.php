<?php

/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

$table = $installer->getConnection()
    ->newTable($installer->getTable('mzeis_documentation/page'))
    ->addColumn('page_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'identity'  => true,
        'nullable'  => false,
        'primary'   => true,
        ), 'Page ID')
    ->addColumn('name', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        'nullable'  => false,
        ), 'Page Name')
    ->addColumn('content', Varien_Db_Ddl_Table::TYPE_TEXT, '2M', array(
    ), 'Page Content')
    ->addColumn('created_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
    ), 'Creation Time')
    ->addColumn('created_user', Varien_Db_Ddl_Table::TYPE_TEXT, 40, array(
        'nullable'  => true,
    ), 'Creation User')
    ->addColumn('updated_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
    ), 'Update Time')
    ->addColumn('updated_user', Varien_Db_Ddl_Table::TYPE_TEXT, 40, array(
        'nullable'  => true,
    ), 'Update User')
    ->addIndex(
        $installer->getIdxName(
            'mzeis_documentation/page',
            array('name'),
            Varien_Db_Adapter_Interface::INDEX_TYPE_UNIQUE
        ),
        array('name'),
        array('type' => Varien_Db_Adapter_Interface::INDEX_TYPE_UNIQUE))
    ->setComment('Documentation Page Table');
$installer->getConnection()->createTable($table);

$installer->endSetup();
