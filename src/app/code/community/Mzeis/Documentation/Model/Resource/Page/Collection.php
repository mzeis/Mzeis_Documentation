<?php

class Mzeis_Documentation_Model_Resource_Page_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{

    /**
     * Adds the search condition for a string to the collection.
     *
     * @param string $text Search string
     */
    public function addSearchFilter($text)
    {
        $this->addFieldToFilter(
            array('content','name'),
            array(
                array('like' => "%${text}%"),
                array('like' => "%${text}%")
            )
        );
        return $this;
    }

    protected function _construct()
    {
        $this->_init('mzeis_documentation/page');
    }

}
