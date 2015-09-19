<?php

class Mzeis_Documentation_Helper_Page_File extends Mage_Core_Helper_Abstract
{
    /**
     * Returns the allowed extensions for page files.
     *
     * @return array
     */
    public function getAllowedExtensions()
    {
        return array('md', 'markdown');
    }
}
