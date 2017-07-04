<?php

/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */
class Sysint_SimpleSlider_Block_Adminhtml_Slider_Edit_Tabs_General
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
            'sider_form',
            array(
                'legend' => Mage::helper('sysint_simpleslider')->__('Slider information')
            )
        );

        $model = Mage::registry('slider_data');

        if ($model && $model->getId()) {
            $fieldset->addField(
                'slide_id',
                'hidden',
                [
                    'name'      => 'slide_id',
                    'required'  => true
                ]
            );
        }


        $fieldset->addField(
            'display_from',
            'date',
            [
                'name'               => 'display_from',
                'label'              => Mage::helper('sysint_simpleslider')->__('Display Date From'),
                'tabindex'           => 1,
                'image'              => $this->getSkinUrl('images/grid-cal.gif'),
                'format'             => Mage::app()->getLocale()
                                                   ->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT)
            ]
        );

        $fieldset->addField(
            'display_to',
            'date',
            [
                'name'               => 'display_to',
                'label'              => Mage::helper('sysint_simpleslider')->__('Display Date To'),
                'tabindex'           => 1,
                'image'              => $this->getSkinUrl('images/grid-cal.gif'),
                'format'             => Mage::app()->getLocale()
                                                   ->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT)
            ]
        );


        $fieldset->addField(
            'is_active',
            'select',
            array(
                'label' => Mage::helper('sysint_simpleslider')->__('Status'),
                'name' => 'is_active',
                'values' => array(
                    [
                        'value' => 1,
                        'label' => Mage::helper('sysint_simpleslider')->__('Enabled'),
                    ],
                    [
                        'value' => 0,
                        'label' => Mage::helper('sysint_simpleslider')->__('Disabled'),
                    ],
                ),
            )
        );

        $data = Mage::getSingleton('adminhtml/session')->getData('slider_data') ?
                Mage::getSingleton('adminhtml/session')->getData('slider_data') :
                Mage::registry('slider_data')->getData();

        $form->setValues($data);

        return parent::_prepareForm();
    }
}
