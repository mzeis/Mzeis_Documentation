<?php

require_once Mage::getModuleDir('controllers', 'Mzeis_Documentation') . '/Adminhtml/Mzeis/DocumentationController.php';

class Mzeis_Documentation_Adminhtml_Mzeis_Documentation_ModuleController extends Mzeis_Documentation_Adminhtml_Mzeis_DocumentationController
{
    public function viewAction()
    {
        $this->_initAction();
        $moduleName = $this->getRequest()->getParam('module');
        $module = Mage::getModel('mzeis_documentation/module');
        $module->setName($moduleName);

        $block = $this->getLayout()->getBlock('mzeis.documentation.module.view');
        if ($block) {
            $block->setModule($module);
        }
        $this->renderLayout();
    }
}
