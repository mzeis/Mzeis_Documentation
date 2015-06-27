<?php

class Mzeis_Documentation_Model_Resource_Page extends Mage_Core_Model_Resource_Db_Abstract
{
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

}
