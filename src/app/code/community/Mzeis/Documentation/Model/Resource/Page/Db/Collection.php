<?php

class Mzeis_Documentation_Model_Resource_Page_Db_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    protected function _construct()
    {
        $this->_init('mzeis_documentation/page');
    }

    /**
     * Constrains the collection to pages of the given module.
     *
     * @param string $name Module name
     * @return Mzeis_Documentation_Model_Resource_Page_Db_Collection
     */
    public function addModuleFilter($name)
    {
        $this->addFieldToFilter('module', $name);
        return $this;
    }

    /**
     * Filters the collection by page name(s).
     *
     * @param array $pageNames
     * @return Mzeis_Documentation_Model_Resource_Page_Db_Collection
     */
    public function addPageFilter(array $pageNames)
    {
        $this->addFieldToFilter('name', $pageNames);
        return $this;
    }

    /**
     * Adds the search condition for a string to the collection.
     *
     * @param string $text Search string
     * @return Mzeis_Documentation_Model_Resource_Page_Db_Collection
     */
    public function addSearchFilter($text)
    {
        $this->addFieldToFilter(
            array('content','name'),
            array(
                array('like' => "%${text}%"),
                array('like' => "%${text}%")
            )
        );
        return $this;
    }

    /**
     * Filters the collection by page type.
     *
     * @param string $type Page type
     * @return Mzeis_Documentation_Model_Resource_Page_Db_Collection
     */
    public function addTypeFilter($type)
    {
        $this->addFieldToFilter('type', $type);
        return $this;
    }
}
