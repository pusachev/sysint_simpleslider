<?php

/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */
class Sysint_SimpleSlider_Block_Adminhtml_Renderer_Grid_Image
    extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    const IMAGE_WIDTH   = 100;
    const IMAGE_HEIGHT  = 100;

    public function render(Varien_Object $row)
    {
        /** @var Sysint_SimpleSlider_Helper_Data $helper */
        $helper = Mage::helper('sysint_simpleslider');

        if (empty($this->_getValue($row))) {
            return $helper->__('No Image');
        }

        $path =$helper->resizeImage($this->_getValue($row), self::IMAGE_WIDTH, self::IMAGE_HEIGHT);

        $html = sprintf("<img width='100px' height='100px' src='%s'/>", $path);

        return $html;
    }
}
