<?php

class Mzeis_Documentation_Block_Adminhtml_Page_View extends Mage_Adminhtml_Block_Template
{
    protected function _beforeToHtml()
    {
        $this->setChild('edit_button',
            $this->getLayout()->createBlock('adminhtml/widget_button')
                 ->setData(array(
                     'label' => Mage::helper('catalog')->__('Edit'),
                     'onclick' => 'window.location.href=\'' . $this->getEditUrl() . '\'',
                     'class' => 'edit'
                 ))
        );
        return parent::_beforeToHtml();
    }

    public function getEditUrl()
    {
        return $this->getUrl('*/*/edit', array('page' => $this->getPage()->getName()));
    }
}
