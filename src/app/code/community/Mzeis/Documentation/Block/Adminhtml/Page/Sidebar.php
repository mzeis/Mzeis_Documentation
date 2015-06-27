<?php

class Mzeis_Documentation_Block_Adminhtml_Page_Sidebar extends Mage_Adminhtml_Block_Template
{
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
