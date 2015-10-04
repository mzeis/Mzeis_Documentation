<?php

class Mzeis_Documentation_Model_Resource_Module_Collection extends Varien_Data_Collection
{
    public function getNewEmptyItem()
    {
        return Mage::getModel('mzeis_documentation/module');
    }

    /**
     * Load data
     *
     * @return $this
     */
    public function loadData($printQuery = false, $logQuery = false)
    {
        if ($this->isLoaded()) {
            return $this;
        }

        $this->clear();

        foreach ((array)Mage::getConfig()->getNode('modules')->children() as $name => $config) {
            if ($config->is('active')) {
                $module = $this->getNewEmptyItem();
                $module->setName($name);
                $this->addItem($module);
            }
        }

        $this->_setIsLoaded(true);

        return $this;
    }
}
