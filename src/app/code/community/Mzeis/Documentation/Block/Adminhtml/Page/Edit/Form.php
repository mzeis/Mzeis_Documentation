<?php

class Mzeis_Documentation_Block_Adminhtml_Page_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    /**
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('page_form');
    }

    /**
     * @return Mzeis_Documentation_Block_Adminhtml_Page_Edit_Form
     */
    protected function _prepareForm()
    {
        $model = Mage::registry('current_page');

        $form   = new Varien_Data_Form(array(
            'id'        => 'edit_form',
            'action'    => $this->getUrl('*/*/save'),
            'method'    => 'post'
        ));

        $form->setHtmlIdPrefix('page_');

        $fieldset   = $form->addFieldset('base_fieldset', array(
            'legend'    => $this->__('Page Information'),
            'class'     => 'fieldset-wide',
        ));

        if ($model->getId()) {
            $primaryKey = $model->getResource()->getIdFieldName();
            $fieldset->addField($primaryKey, 'hidden', array(
                'name' => $primaryKey,
            ));
        }

        $fieldset->addField('name', 'hidden', array(
            'name' => 'name'
        ));

        $fieldset->addField('content', 'editor', array(
            'name'      => 'content',
            'label'     => $this->__('Content'),
            'title'     => $this->__('Content'),
            'style'     => 'height:36em',
            'required'  => true,
            'config'    => Mage::getSingleton('cms/wysiwyg_config')->getConfig()
        ));

        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }

    /**
     * Load WYSIWYG.
     *
     * @return void
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
            $this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
        }
    }
}
