<?php
/**
 * @method Mzeis_Documentation_Model_Page getPage()
 */
class Mzeis_Documentation_Block_Adminhtml_Page_View extends Mage_Adminhtml_Block_Template
{
    protected function _beforeToHtml()
    {
        if ($this->isAllowedEdit()) {
            if ($this->getPage()->getId()) {
                $this->setChild('rename_button',
                    $this->getLayout()->createBlock('adminhtml/widget_button')
                         ->setData(array(
                             'label' => Mage::helper('catalog')->__('Rename'),
                             'onclick' => 'window.location.href=\'' . Mage::helper('mzeis_documentation/page')->getRenameUrl($this->getPage()->getName()) . '\'',
                             'class' => 'edit'
                         ))
                );
            }
            $this->setChild('edit_button',
                $this->getLayout()->createBlock('adminhtml/widget_button')
                     ->setData(array(
                         'label' => Mage::helper('catalog')->__('Edit'),
                         'onclick' => 'window.location.href=\'' . Mage::helper('mzeis_documentation/page')->getEditUrl($this->getPage()->getName()) . '\'',
                         'class' => 'edit'
                     ))
            );
        }
        return parent::_beforeToHtml();
    }

    /**
     * Returns whether the page can be edited.
     *
     * The page has to be a project documentation page and the user needs to have the privileges.
     *
     * @return bool
     */
    public function isAllowedEdit()
    {
        return $this->getPage()->isProjectPage() && is_null($this->getPage()->getModule()) && Mage::getSingleton('admin/session')->isAllowed('system/mzeis_documentation/edit');
    }

    /**
     * @param string $timestamp
     * @return string
     */
    public function printDate($timestamp)
    {
        return Mage::helper('core')->formatDate($timestamp, Mage_Core_Model_Locale::FORMAT_TYPE_SHORT, true);
    }

    /**
     * Renders the content.
     *
     * @return string
     */
    public function renderContent()
    {
        return Mage::getModel('mzeis_documentation/page_renderer')->renderContent($this->getPage());
    }
}
