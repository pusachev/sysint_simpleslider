<?php

/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */
class  Sysint_SimpleSlider_Block_Adminhtml_Slider_Edit_Tabs_Image
    extends Mage_Adminhtml_Block_Widget_Form
{
    /**
     * @return Mage_Adminhtml_Block_Widget_Form
     */
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);

        $fieldset = $form->addFieldset(
            'slider_form_image',
            array(
                'legend' => Mage::helper('sysint_simpleslider')->__('Image')
            )
        );

        $fieldset->addType('slider_image',  'Sysint_SimpleSlider_Block_Adminhtml_Renderer_Form_Image');

        $fieldset->addField(
            'image',
            'slider_image',
            [
                'label' => Mage::helper('sysint_simpleslider')->__('Image'),
                'required' => true,
                'name' => 'image',
                'value' => 'test'
            ]
        );

        $data = Mage::getSingleton('adminhtml/session')->getData('slider_data') ?
            Mage::getSingleton('adminhtml/session')->getData('slider_data') :
            Mage::registry('slider_data')->getData();

        $form->setValues($data);

        return parent::_prepareForm();
    }
}
