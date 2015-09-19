<?php

class Mzeis_Documentation_Block_Adminhtml_Page_Sidebar extends Mage_Adminhtml_Block_Template
{
    /**
     * @var Mzeis_Documentation_Model_Resource_Module_Collection
     */
    protected $_moduleCollection = null;

    /**
     * Returns the URL of the "All pages" page.
     *
     * @return string
     */
    public function getAllPagesUrl() {
        return $this->getUrl('adminhtml/mzeis_documentation_list/allPages');
    }

    /**
     * Returns the URL of the system configuration section.
     *
     * @return string
     */
    public function getConfigurationUrl() {
        return Mage::helper("adminhtml")->getUrl('adminhtml/system_config/edit', array('section' => 'admin'));
    }

    /**
     * Returns the URL of the documentation homepage.
     *
     * @return string
     */
    public function getHomepageUrl()
    {
        $homepage = Mage::getModel('mzeis_documentation/page');
        $homepage->setName(Mage::helper('mzeis_documentation')->getHomepageName());
        return Mage::helper('mzeis_documentation/page')->getViewUrl($homepage);
    }

    public function getModuleCollection()
    {
        if (is_null($this->_moduleCollection)) {
            $this->_moduleCollection = Mage::getResourceModel('mzeis_documentation/module_collection');
        }
        return $this->_moduleCollection;
    }

    /**
     * Returns the URL of the "Orphan pages" page.
     *
     * @return string
     */
    public function getOrphanPagesUrl() {
        return $this->getUrl('adminhtml/mzeis_documentation_list/orphanPages');
    }
}
