<?php

class Mzeis_Documentation_Block_Adminhtml_Search extends Mage_Adminhtml_Block_Template
{
    /**
     * @var $_collection Mzeis_Documentation_Model_Resource_Page_Collection
     */
    protected $_collection = null;

    public function getSearchResultCollection()
    {
        if ($this->_collection === null) {
            /**
             * @var $collection Mzeis_Documentation_Model_Resource_Page_Collection
             */
            $collection = Mage::getModel('mzeis_documentation/page')->getCollection();
            $collection->addSearchFilter($this->getSearchString());
            $collection->addOrder('name', Varien_Data_Collection::SORT_ORDER_ASC);
            $this->_collection = $collection;
        }
        return $this->_collection;
    }

    /**
     * @return string
     */
    public function getSearchString()
    {
        return Mage::helper('mzeis_documentation/search')->getSearchText();
    }
}
