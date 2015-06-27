<?php

class Mzeis_Documentation_Adminhtml_Mzeis_DocumentationController extends Mage_Adminhtml_Controller_Action
{
    /**
     * @return void
     */
    protected function _initAction()
    {
        $this->loadLayout()
             ->_setActiveMenu('system/mzeis_documentation');
    }

    /**
     * @return Mzeis_Documentation_Model_Page
     */
    protected function _initPage()
    {
        $name = $this->getRequest()->getParam('page', null);
        $page = Mage::getModel('mzeis_documentation/page');
        $page->setName($name);
        $page->loadByName($name);
        Mage::register('current_page', $page);
        return $page;
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        $action = strtolower($this->getRequest()->getActionName());
        switch ($action) {
            case 'delete':
                $aclResource = 'system/mzeis_documentation/delete';
                break;
            case 'edit':
            case 'save':
                $aclResource = 'system/mzeis_documentation/edit';
                break;
            default:
                $aclResource = 'system/mzeis_documentation';
                break;

        }
        return Mage::getSingleton('admin/session')->isAllowed($aclResource);
    }

    public function deleteAction()
    {
        if ($name = $this->getRequest()->getParam('page')) {
            try {
                $model = Mage::getModel('mzeis_documentation/page');
                $model->load($name, 'name');
                $model->delete();

                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('mzeis_documentation')->__('The page has been deleted.'));
                $this->_redirect('*/*/');
                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('_query' => array('page' => $name)));
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('mzeis_documentation')->__('Unable to find a page to delete.'));
        $this->_redirect('*/*/');
    }

    public function editAction()
    {
        $this->_initPage();
        $this->_initAction();
        $this->renderLayout();
    }

    public function indexAction()
    {
        $this->getRequest()->setParam('page', Mage::helper('mzeis_documentation')->getHomepageName());
        $this->_forward('view');
    }

    public function saveAction()
    {
        $back = $this->getRequest()->getParam('back', false);

        if ($data = $this->getRequest()->getPost()) {
            try {
                $page = $this->_initPage();
                $page->addData($data);

                if (!$page->getId()) {
                    $page->setCreatedUser(Mage::getSingleton('admin/session')->getUser()->getUsername());
                }
                $page->setUpdatedUser(Mage::getSingleton('admin/session')->getUser()->getUsername());
                $page->save();
                $this->_getSession()->addSuccess(
                    Mage::helper('mzeis_documentation')->__('The page has been saved.')
                );
            } catch (Exception $e) {
                Mage::logException($e);
                $this->_getSession()->addError($e->getMessage());
                $back = true;
            }
        }

        if ($back) {
            $this->_redirect('*/*/edit', array('_query' => array('page' => $page->getName()), '_current' => true));
            return;
        }
        $this->_redirect('*/*/view', array('_query' => array('page' => $page->getName()), '_current' => true));
    }

    public function viewAction()
    {
        $this->_initAction();

        $name = $this->getRequest()->getParam('page', null);
        $page = Mage::getModel('mzeis_documentation/page')->loadByName($name);
        if (!$page->getId()) {
            $page->setName($name);
        }

        $block = $this->getLayout()->getBlock('mzeis.documentation.page.view');
        if ($block) {
            $block->setPage($page);
        }
        $block = $this->getLayout()->getBlock('mzeis.documentation.page.sidebar');
        if ($block) {
            $block->setPage($page);
        }
        $this->renderLayout();
    }
}
