<?php

class Mzeis_Documentation_Block_Adminhtml_Page_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    protected function _construct()
    {
        parent::_construct();
        $this->_objectId = 'page';
        $this->_blockGroup = 'mzeis_documentation';
        $this->_controller = 'adminhtml_page';
    }

    /**
     * @return Mzeis_Documentation_Model_Page
     */
    protected function _getPage(){
        return Mage::registry('current_page');
    }

    /**
     * Prepare layout
     *
     * @return Mage_Core_Block_Abstract
     */
    protected function _prepareLayout()
    {
        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('page_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'page_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'page_content');
                }
            }

            function saveAndContinueEdit() {
                editForm.submit($('edit_form').action + 'back/edit/');
            }
        ";
        return parent::_prepareLayout();
    }

    public function __construct()
    {
        parent::__construct();
        $this->removeButton('delete');
        $this->removeButton('reset');
        $this->addButton('saveandcontinue', array(
            'label' => $this->__('Save and Continue Edit'),
            'onclick' => 'saveAndContinueEdit()',
            'class' => 'save',
        ), -100);
    }

    /**
     * @return string
     */
    public function getBackUrl()
    {
        return $this->getUrl('*/*/view', array('_query' => array($this->_objectId => $this->getRequest()->getParam('page'))));
    }

    /**
     * @return string
     */
    public function getDeleteUrl()
    {
        return $this->getUrl('*/*/delete', array('_query' => array($this->_objectId => $this->getRequest()->getParam('page'))));
    }

    /**
     * @return string
     */
    public function getHeaderText()
    {
        return $this->__('Page "%s"', $this->escapeHtml($this->_getPage()->getName()));
    }

    /**
     * @return string
     */
    public function getSaveUrl()
    {
        return $this->getUrl('*/*/save', array('_current' => true, 'back' => null));
    }
}
