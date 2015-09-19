<?php

/**
 * Class Mzeis_Documentation_Model_Resource_Page_Orphan_Collection
 */
class Mzeis_Documentation_Model_Resource_Page_Orphan_Collection extends Mzeis_Documentation_Model_Resource_Page_Db_Collection
{
    /**
     * Adds condition to search for the link to the page in all other pages.
     *
     * @return Mzeis_Documentation_Model_Resource_Page_Orphan_Collection
     */
    protected function _initSelect()
    {
        parent::_initSelect();
        $this->addFieldToFilter('name', array('neq' => Mage::helper('mzeis_documentation')->getHomepageName()));
        $this->addTypeFilter(Mzeis_Documentation_Model_Page::TYPE_PROJECT);

        $subSelect = $this->getConnection()->select();
        $subSelect->from(array('mdp2' => $this->getTable('mzeis_documentation/page')), new Zend_Db_Expr('1)'));
        $this->getSelect()->exists($subSelect, 'mdp2.content LIKE ' . new Zend_Db_Expr("CONCAT('%[[',main_table.name,']]%')"), false);

        $this->addOrder('name', Varien_Data_Collection::SORT_ORDER_ASC);

        return $this;
    }
}
