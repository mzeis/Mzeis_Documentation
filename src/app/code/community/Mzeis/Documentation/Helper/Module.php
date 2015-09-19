<?php

class Mzeis_Documentation_Helper_Module extends Mage_Core_Helper_Abstract
{
    /**
     * @param string $name Module name
     * @return bool True if it is an active, existing module
     */
    public function isActiveModule($name)
    {
        return !is_null(Mage::getResourceSingleton('mzeis_documentation/module_collection')->getItemByColumnValue('name', $name));
    }
}
