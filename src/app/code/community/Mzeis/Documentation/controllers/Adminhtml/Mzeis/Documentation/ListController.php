<?php

require_once Mage::getModuleDir('controllers', 'Mzeis_Documentation') . '/Adminhtml/Mzeis/DocumentationController.php';

class Mzeis_Documentation_Adminhtml_Mzeis_Documentation_ListController extends Mzeis_Documentation_Adminhtml_Mzeis_DocumentationController
{
    public function allPagesAction()
    {
        $this->_initAction();
        $this->renderLayout();
    }

    public function orphanPagesAction()
    {
        $this->_initAction();
        $this->renderLayout();
    }
}
