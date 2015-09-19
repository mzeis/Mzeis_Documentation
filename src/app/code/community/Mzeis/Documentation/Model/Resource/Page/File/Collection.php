<?php

class Mzeis_Documentation_Model_Resource_Page_File_Collection extends Varien_Data_Collection_Filesystem
{
    /**
     * Filenames regex pre-filter
     *
     * @var string
     */
    protected $_allowedFilesMask = '/^[a-z0-9\.\-\_]+\.(?:md|markdown)$/i';

    protected $_itemObjectClass = 'Mzeis_Documentation_Model_Page';

    protected $_moduleName = null;

    /**
     * Constrains the collection to pages of the given module.
     *
     * @param string $name Module name
     * @return Mzeis_Documentation_Model_Resource_Page_File_Collection
     */
    public function addModuleFilter($name)
    {
        $this->_moduleName = $name;
        $this->addTargetDir($this->_getBaseDir());
    }

    /**
     * Filters the collection by page name(s).
     *
     * @param array $pageNames
     * @return $this
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
     * @return Mzeis_Documentation_Model_Resource_Page_Collection
     */
    public function addSearchFilter($text)
    {
        $this->addFieldToFilter('content', array('like' => "%${text}%"), 'or');
        $this->addFieldToFilter('name', array('like' => "%${text}%"), 'or');
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
        $this->addFieldToFilter('type', $type);
        return $this;
    }

    /**
     * Callback method for 'like' fancy filter
     *
     * Overrides the original method by allowing multi-line data.
     *
     * @param string $field
     * @param mixed $filterValue
     * @param array $row
     * @return bool
     * @see addFieldToFilter()
     * @see addCallbackFilter()
     */
    public function filterCallbackLike($field, $filterValue, $row)
    {
        $filterValueRegex = str_replace('%', '(.*?)', preg_quote($filterValue, '/'));
        return (bool)preg_match("/^{$filterValueRegex}$/sim", $row[$field]);
    }

    /**
     * Data collecting.
     *
     * @param bool $printQuery
     * @param bool $logQuery
     * @return Mzeis_Documentation_Model_Resource_Page_File_Collection
     */
    public function loadData($printQuery = false, $logQuery = false)
    {
        if (empty($this->_targetDirs)) {
            $this->addTargetDir(Mage::app()->getConfig()->getOptions()->getCodeDir());
        }
        parent::loadData($printQuery, $logQuery);
        return $this;
    }

    /**
     * Generate item row basing on the filename
     *
     * @param string $filename
     * @return array
     */
    protected function _generateRow($filename)
    {
        $result = parent::_generateRow($filename);
        $result['module'] = $this->_moduleName;
        $result = Mage::getResourceSingleton('mzeis_documentation/page_file')->getPageData($result);
        return $result;
    }

    /**
     * Returns the module base directory.
     *
     * @return string
     */
    protected function _getBaseDir()
    {
        return Mage::getModuleDir('base', $this->_moduleName);
    }
}
