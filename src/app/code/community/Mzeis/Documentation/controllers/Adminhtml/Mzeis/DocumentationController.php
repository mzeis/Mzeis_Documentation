<?php

class Mzeis_Documentation_Adminhtml_Mzeis_DocumentationController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->_forward('view');
        $this->setFlag('', self::FLAG_NO_DISPATCH, true);
    }

    public function viewAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }
}
