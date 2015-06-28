<?php

class Mzeis_Documentation_Block_Adminhtml_Page_List extends Mage_Adminhtml_Block_Template
{
    /**
     * @var $_allPagesCollection Mzeis_Documentation_Model_Resource_Page_Collection
     */
    protected $_allPagesCollection = null;
    /**
     * @var $_orphanPagesCollection Mzeis_Documentation_Model_Resource_Page_Collection
     */
    protected $_orphanPagesCollection = null;

    /**
     * @return Mzeis_Documentation_Model_Resource_Page_Collection
     */
    public function getAllPagesCollection()
    {
        if ($this->_allPagesCollection === null) {
            /**
             * @var $collection Mzeis_Documentation_Model_Resource_Page_Collection
             */
            $collection = Mage::getModel('mzeis_documentation/page')->getCollection();
            $collection->addOrder('name', Varien_Data_Collection::SORT_ORDER_ASC);
            $this->_allPagesCollection = $collection;
        }
        return $this->_allPagesCollection;
    }

    /**
     * @return Mzeis_Documentation_Model_Resource_Page_Collection
     */
    public function getOrphanPagesCollection()
    {
        if ($this->_orphanPagesCollection === null) {
            /**
             * @var $collection Mzeis_Documentation_Model_Resource_Page_Collection
             */
            $collection = Mage::getResourceModel('mzeis_documentation/page_orphan_collection');
            $this->_orphanPagesCollection = $collection;
        }
        return $this->_orphanPagesCollection;
    }
}
