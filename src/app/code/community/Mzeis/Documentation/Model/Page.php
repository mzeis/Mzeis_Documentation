<?php

class Mzeis_Documentation_Model_Page extends Mage_Core_Model_Abstract
{

    protected function _construct()
    {
        $this->_init('mzeis_documentation/page');
    }

    /**
     * Loads the page by the name.
     *
     * @param $name
     * @return Mzeis_Documentation_Model_Page
     */
    public function loadByName($name)
    {
        $this->load($name, 'name');
        return $this;
    }

}
