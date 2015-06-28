<?php

class Mzeis_Documentation_Block_Adminhtml_Page_Rename extends Mage_Adminhtml_Block_Widget_Form_Container
{
    protected function _construct()
    {
        parent::_construct();
        $this->_objectId = 'page';
        $this->_blockGroup = 'mzeis_documentation';
        $this->_controller = 'adminhtml_page';
        $this->_mode = 'rename';
    }

    /**
     * @return Mzeis_Documentation_Model_Page
     */
    protected function _getPage(){
        return Mage::registry('current_page');
    }

    public function __construct()
    {
        parent::__construct();
        $this->removeButton('delete');
        $this->removeButton('reset');
        $this->updateButton('save', 'label', $this->__('Rename'));
        $this->updateButton('save', 'onclick', 'renameForm.submit();');
        $this->_formScripts[] = "renameForm = new varienForm('rename_form', '{$this->getValidationUrl()}');";

    }

    /**
     * @return string
     */
    public function getBackUrl()
    {
        return $this->getViewUrl();
    }

    /**
     * @return string
     */
    public function getHeaderText()
    {
        return $this->__('Rename page "%s"', $this->escapeHtml($this->_getPage()->getName()));
    }

    /**
     * @return string
     */
    public function getSaveUrl()
    {
        return $this->getUrl('*/*/save', array('_current' => true, 'back' => null));
    }

    /**
     * @return string
     */
    public function getViewUrl()
    {
        return $this->getUrl('*/*/view', array('_query' => array($this->_objectId => $this->getRequest()->getParam('page'))));
    }
}
