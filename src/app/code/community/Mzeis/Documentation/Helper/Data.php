<?php

class Mzeis_Documentation_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * @var string
     */
    const XML_PATH_HOMEPAGE = 'admin/mzeis_documentation/homepage';

    /**
     * @return string
     */
    public function getHomepageName()
    {
        return Mage::getStoreConfig(self::XML_PATH_HOMEPAGE);
    }
}
