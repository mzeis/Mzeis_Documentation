<?php

class Mzeis_Documentation_Model_Resource_Page_Collection extends Varien_Data_Collection
{
    /**
     * @var Mzeis_Documentation_Model_Resource_Page_Db_Collection
     */
    protected $_dbCollection = null;

    /**
     * @var Mzeis_Documentation_Model_Resource_Page_File_Collection
     */
    protected $_fileCollection = null;

    public function __construct()
    {
        $this->_dbCollection = Mage::getResourceModel('mzeis_documentation/page_db_collection');
        $this->_fileCollection = Mage::getResourceModel('mzeis_documentation/page_file_collection');
    }

    /**
     * Constrains the collection to pages of the given module.
     *
     * @param string $name Module name
     * @return Mzeis_Documentation_Model_Resource_Page_Collection
     */
    public function addModuleFilter($name)
    {
        $this->_dbCollection->addModuleFilter($name);
        $this->_fileCollection->addModuleFilter($name);
        return $this;
    }

    /**
     * Adds sort criteria.
     *
     * Note that files can only be sorted after one criterion.
     *
     * @param string $field
     * @param string $direction
     * @return Mzeis_Documentation_Model_Resource_Page_Collection
     */
    public function addOrder($field, $direction = Varien_Data_Collection_Db::SORT_ORDER_DESC)
    {
        $this->_dbCollection->addOrder($field, $direction);
        $this->_fileCollection->setOrder($field, $direction);
        return $this;
    }

    /**
     * Adds the search condition for a string to the collection.
     *
     * @param string $text Search string
     * @return Mzeis_Documentation_Model_Resource_Page_Collection
     */
    public function addSearchFilter($text)
    {
        $this->_dbCollection->addSearchFilter($text);
        $this->_fileCollection->addSearchFilter($text);
        return $this;
    }

    /**
     * Load data
     *
     * @return Mzeis_Documentation_Model_Resource_Page_Collection
     */
    public function loadData($printQuery = false, $logQuery = false)
    {
        if ($this->isLoaded()) {
            return $this;
        }

        $this->clear();

        foreach ($this->_dbCollection as $item) {
            $this->addItem($item);
        }

        foreach ($this->_fileCollection as $item) {
            $this->addItem($item);
        }

        $this->_setIsLoaded(true);

        return $this;
    }

    /**
     * Filters the collection by page name(s).
     *
     * @param array $pageNames Array of page names
     * @return Mzeis_Documentation_Model_Resource_Page_Collection
     */
    public function addPageFilter(array $pageNames)
    {
        $this->_dbCollection->addPageFilter($pageNames);
        $this->_fileCollection->addPageFilter($pageNames);
        return $this;
    }

    /**
     * Filters the collection by page type.
     *
     * @param string $type Page type
     * @return Mzeis_Documentation_Model_Resource_Page_Collection
     */
    public function addTypeFilter($type)
    {
        $this->_dbCollection->addTypeFilter($type);
        $this->_fileCollection->addTypeFilter($type);
        return $this;
    }
}
