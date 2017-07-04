<?php

/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */
class Sysint_SimpleSlider_Block_Adminhtml_Slider_Edit_Tabs
    extends  Mage_Adminhtml_Block_Widget_Tabs
{
    /**
     * Sysint_SimpleSlider_Block_Adminhtml_Slider_Edit_Tabs constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->setId('slider_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('sysint_simpleslider')->__('Slider Information'));
    }

    /**
     * @return Mage_Core_Block_Abstract
     * @throws Exception
     */
    protected function _beforeToHtml()
    {
        $this->addTab('general',
            [
                'label'     => Mage::helper('sysint_simpleslider')->__('General'),
                'title'     => Mage::helper('sysint_simpleslider')->__('General'),
                'content'   => $this->getLayout()->createBlock('sysint_simpleslider/adminhtml_slider_edit_tabs_general')->toHtml(),
            ]
        );

        $this->addTab('image',
            [
                'label'     => Mage::helper('sysint_simpleslider')->__('Image'),
                'title'     => Mage::helper('sysint_simpleslider')->__('Image'),
                'content'   => $this->getLayout()->createBlock('sysint_simpleslider/adminhtml_slider_edit_tabs_image')->toHtml(),
            ]
        );

        return parent::_beforeToHtml();
    }
}