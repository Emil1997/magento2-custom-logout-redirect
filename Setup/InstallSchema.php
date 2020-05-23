<?php

namespace Elite\RedirectLogout\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{

    /**
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @throws \Zend_Db_Exception
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $table = $setup->getConnection()->newTable(
            $setup->getTable('elite_redirect_logout')
        )->addColumn(
            'url',
            Table::TYPE_TEXT,
            null,
            [ 'nullable' => false, 'default' => '/' ],
            'Redirect Url'
        );

        $setup->getConnection()->createTable($table);

        $setup->endSetup();
    }
}
