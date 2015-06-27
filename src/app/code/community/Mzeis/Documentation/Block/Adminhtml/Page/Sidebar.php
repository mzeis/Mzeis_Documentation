<?php

class Mzeis_Documentation_Block_Adminhtml_Page_Sidebar extends Mage_Adminhtml_Block_Template
{
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
        return Mage::helper('mzeis_documentation/page')->getViewUrl(Mage::helper('mzeis_documentation')->getHomepageName());
    }
}
