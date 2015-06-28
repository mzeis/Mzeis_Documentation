<?php

class Mzeis_Documentation_Helper_Page extends Mage_Core_Helper_Abstract
{
    /**
     * Creates an edit URL for the backend.
     *
     * @param string $page
     * @return string
     */
    public function getEditUrl($page)
    {
        return Mage::helper("adminhtml")->getUrl('adminhtml/mzeis_documentation/edit', array('_query' => array('page' => $page)));
    }

    /**
     * Creates a view URL for the backend.
     *
     * @param string $page
     * @return string
     */
    public function getViewUrl($page)
    {
        return Mage::helper("adminhtml")->getUrl('adminhtml/mzeis_documentation/view', array('_query' => array('page' => $page)));
    }
}
