<?php

class Mzeis_Documentation_Helper_Search extends Mage_Core_Helper_Abstract
{
    /**
     * @return string
     */
    public function getSearchText()
    {
        return $this->_getRequest()->getParam('search_text', null);
    }
}
