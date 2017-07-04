<?php

class Sysint_SimpleSlider_Model_Slider
    extends Mage_Core_Model_Abstract
{
    /**
     * {@inheritdoc}
     */
    protected function _construct()
    {
        $this->_init("sysint_simpleslider/slider");
    }

    /**
     * Processing object before delete data
     *
     * @return Mage_Core_Model_Abstract
     */
    protected function _beforeDelete()
    {
        return parent::_beforeDelete();
    }
}
