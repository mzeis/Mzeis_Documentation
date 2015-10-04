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
     * Returns the link text for a page.
     *
     * @param Mzeis_Documentation_Model_Page $page
     * @return string
     */
    public function getLinkText(Mzeis_Documentation_Model_Page $page)
    {
        return ($page->getModule() ? $page->getModule() . ' > ' : '') . $page->getName();
    }

    /**
     * Creates an rename URL for the backend.
     *
     * @param string $page
     * @return string
     */
    public function getRenameUrl($page)
    {
        return Mage::helper("adminhtml")->getUrl('adminhtml/mzeis_documentation/rename', array('_query' => array('page' => $page)));
    }

    /**
     * Creates a view URL for the backend.
     *
     * @param Mzeis_Documentation_Model_Page $page
     * @return string
     */
    public function getViewUrl(Mzeis_Documentation_Model_Page $page)
    {
        $params['page'] = $page->getName();
        if ($page->hasModule()) {
            $params['module'] = $page->getModule();
        }

        return Mage::helper("adminhtml")->getUrl('adminhtml/mzeis_documentation/view', array('_query' => $params));
    }
}
