<?php

class Mzeis_Documentation_Model_Resource_Page extends Mage_Core_Model_Resource_Db_Abstract
{
    /**
     * Processes data after loading the page.
     *
     * If the database was not identified as the page source then try to load the page from the file.
     *
     * @param Mage_Core_Model_Abstract $object
     * @return Mage_Core_Model_Resource_Db_Abstract
     */
    protected function _afterLoad(Mage_Core_Model_Abstract $object)
    {
        parent::_afterLoad($object);

        /**
         * @var Mzeis_Documentation_Model_Page $object
         */
        if ($object->sourceIsDatabase()) {
            return $this;
        }

        Mage::getResourceSingleton('mzeis_documentation/page_file')->loadFromFile($object);

        if (!$object->hasModule()) {
            $object->setType(Mzeis_Documentation_Model_Page::TYPE_PROJECT);
        }
        return $this;
    }

    /**
     * Processes data before saving the page.
     *
     * Sets:
     * - creation time (for new pages)
     * - update time
     *
     * @param Mage_Core_Model_Abstract $object
     * @return Mzeis_Documentation_Model_Resource_Page
     */
    protected function _beforeSave(Mage_Core_Model_Abstract $object)
    {
        if ($object->isObjectNew() && !$object->hasCreatedAt()) {
            $object->setCreatedAt(Mage::getSingleton('core/date')->gmtDate());
        }

        $object->setUpdatedAt(Mage::getSingleton('core/date')->gmtDate());

        return parent::_beforeSave($object);
    }

    protected function _construct()
    {
        $this->_init('mzeis_documentation/page', 'page_id');
    }

    /**
     * Renames the links in all pages from the old to the new name.
     *
     * @param string $oldName
     * @param string $newName
     * @return void
     */
    public function renameLinks($oldName, $newName)
    {
        $adapter = $this->_getWriteAdapter();
        $adapter->update(
            $this->getMainTable(),
            array(
                'content' => new Zend_Db_Expr('REPLACE(content,' . $adapter->quote($oldName) . ', ' . $adapter->quote($newName) . ')')
            )
        );
    }
}
