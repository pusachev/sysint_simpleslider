<?php

/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */
class Sysint_SimpleSlider_Block_Adminhtml_Slider
    extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    /**
     * SP_Events_Block_Adminhtml_Event constructor.
     */
    public function __construct()
    {
        $this->_controller = 'adminhtml_slider';
        $this->_blockGroup = 'sysint_simpleslider';
        $this->_headerText = Mage::helper('sysint_simpleslider')->__('Slider grid');
        $this->_addButtonLabel = Mage::helper('sysint_simpleslider')->__('Add slide');

        parent::__construct();
    }
}
