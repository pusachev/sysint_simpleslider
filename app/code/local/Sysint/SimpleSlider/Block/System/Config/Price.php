<?php

/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */
class Sysint_SimpleSlider_Block_System_Config_Price
    extends  Mage_Adminhtml_Block_System_Config_Form_Field_Array_Abstract
{
    protected $_itemRenderer;

    public function _prepareToRender()
    {
        $this->addColumn('usd', array(
            'label' => Mage::helper('sysint_simpleslider')->__('USD'),
            'style' => 'width:100px',
        ));
        $this->addColumn('eur', array(
            'label' => Mage::helper('sysint_simpleslider')->__('EUR'),
            'style' => 'width:100px',
        ));
        $this->addColumn('uah', array(
            'label' => Mage::helper('sysint_simpleslider')->__('UAH'),
            'style' => 'width:100px',
        ));
        $this->addColumn('country_id', array(
            'label' => Mage::helper('sysint_simpleslider')->__('Country'),
            'renderer' => $this->_getRenderer(),
        ));

        $this->_addAfter = false;
        $this->_addButtonLabel = Mage::helper('sysint_simpleslider')->__('Add');
    }

    protected function _getRenderer()
    {
        if (!$this->_itemRenderer) {
            $this->_itemRenderer = $this->getLayout()->createBlock(
                'sysint_simpleslider/system_config_form_field_country', '',
                array('is_render_to_js_template' => true)
            );
        }

        return $this->_itemRenderer;
    }

    /**
     * @param Varien_Object $row
     */
    protected function _prepareArrayRow(Varien_Object $row)
    {
        $row->setData(
            'option_extra_attr_' . $this->_getRenderer()
                ->calcOptionHash($row->getData('country_id')),
            'selected="selected"'
        );
    }
}
