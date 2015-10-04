<?php

class Mzeis_Documentation_Block_Adminhtml_Page_Rename_Form extends Mage_Adminhtml_Block_Widget_Form
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('page_form');
    }

    /**
     * @return Mzeis_Documentation_Block_Adminhtml_Page_Rename_Form
     */
    protected function _prepareForm()
    {
        $model = Mage::registry('current_page');
        $model->setNewName($model->getName());

        $form   = new Varien_Data_Form(array(
            'id'        => 'rename_form',
            'action'    => $this->getUrl('*/*/renamePost'),
            'method'    => 'post'
        ));

        $form->setHtmlIdPrefix('page_');

        $fieldset   = $form->addFieldset('base_fieldset', array(
            'legend'    => $this->__('Page name'),
            'class'     => 'fieldset-wide',
        ));

        if ($model->getId()) {
            $primaryKey = $model->getResource()->getIdFieldName();
            $fieldset->addField($primaryKey, 'hidden', array(
                'name' => $primaryKey,
            ));
        }

        $fieldset->addField('name', 'hidden', array(
            'name' => 'page'
        ));

        $fieldset->addField('new_name', 'text', array(
            'name' => 'new_name',
            'label' => $this->__('New name'),
            'title' => $this->__('New name'),
            'note' => $this->__('Choose a unique name. The links on other pages will be adjusted accordingly.'),
            'required' => true
        ));

        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
