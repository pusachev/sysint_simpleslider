<?php

/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */
class Sysint_SimpleSlider_Block_Adminhtml_Renderer_Form_Image
    extends Varien_Data_Form_Element_Image
{

    /**
     * Get image preview url
     *
     * @return string
     */
    protected function _getUrl()
    {
        return sprintf("sysint_simpleslider/%s", $this->getValue());
    }

    /**
     * Return html code of delete checkbox element
     *
     * @return string
     */
    protected function _getDeleteCheckbox()
    {
       return '';
    }
}