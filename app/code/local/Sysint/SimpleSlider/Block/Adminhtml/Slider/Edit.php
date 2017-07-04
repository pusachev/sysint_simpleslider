<?php

/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */
class Sysint_SimpleSlider_Block_Adminhtml_Slider_Edit
    extends Mage_Adminhtml_Block_Widget_Form_Container
{
    /**
     * Sysint_SimpleSlider_Block_Adminhtml_Slider_Edit constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->_objectId    = 'slide_id';
        $this->_blockGroup  = 'sysint_simpleslider';
        $this->_controller  = 'adminhtml_slider';
        $this->_mode        = 'edit';

        $objectId = (int)$this->getRequest()->getParam($this->_objectId);

        if (!empty($objectId)) {
            $this->_addButton('delete', array(
                'label'     => Mage::helper('adminhtml')->__('Delete'),
                'class'     => 'delete',
                'onclick'   => 'deleteConfirm(\''. Mage::helper('adminhtml')->__('Are you sure you want to do this?')
                    .'\', \'' . $this->getDeleteUrl() . '\')',
            ));
        }

        $object = Mage::getModel('sysint_simpleslider/slider')->load($objectId);
        Mage::register('slider_data', $object);
    }

    /**
     * @return string
     */
    public function getHeaderText()
    {
        if( Mage::registry('slider_data') && Mage::registry('slider_data')->getId() ) {
            return Mage::helper('sysint_simpleslider')->__(
                "Edit item '%s'",
                $this->escapeHtml(Mage::registry('slider_data')->getId())
            );
        } else {
            return Mage::helper('sysint_simpleslider')->__('Add item');
        }
    }
}
