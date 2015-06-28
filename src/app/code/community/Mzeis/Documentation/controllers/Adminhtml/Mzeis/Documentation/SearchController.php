<?php

require_once Mage::getModuleDir('controllers', 'Mzeis_Documentation') . '/Adminhtml/Mzeis/DocumentationController.php';

class Mzeis_Documentation_Adminhtml_Mzeis_Documentation_SearchController extends Mzeis_Documentation_Adminhtml_Mzeis_DocumentationController
{
    public function indexAction()
    {
        $this->_initAction();
        $this->renderLayout();
    }
}
