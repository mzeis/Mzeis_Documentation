<?php

/**
 * @method string getName()
 * @method setName(string $value)
 */
class Mzeis_Documentation_Model_Module extends Varien_Object
{
    /**
     * @var Mzeis_Documentation_Model_Resource_Module_Page_Collection
     */
    protected $_pageCollection = null;

    /**
     * Returns the URL to the overview page of the module.
     *
     * @return string
     */
    public function getOverviewUrl()
    {
        return Mage::helper("adminhtml")->getUrl('adminhtml/mzeis_documentation_module/view', array('module' => $this->getName()));
    }

    /**
     * @return Mzeis_Documentation_Model_Resource_Module_File_Collection
     */
    public function getPageCollection()
    {
        if (is_null($this->_pageCollection)) {
            $this->_pageCollection = Mage::getResourceModel('mzeis_documentation/page_collection');
            $this->_pageCollection->addModuleFilter($this->getName());
        }

        return $this->_pageCollection;
    }

    /**
     * Returns the URL to a specific page of the module.
     *
     * @param string $page
     * @return string
     */
    public function getPageUrl($page)
    {
        return Mage::helper('adminhtml')->getUrl('adminhtml/mzeis_documentation/view', array('_query' => array('page' => $page, 'module' => $this->getName())));
    }


}
