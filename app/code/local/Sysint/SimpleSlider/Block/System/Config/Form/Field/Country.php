<?php

/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */
class Sysint_SimpleSlider_Block_System_Config_Form_Field_Country
    extends  Mage_Core_Block_Html_Select
{
    public function _toHtml()
    {
        $options = Mage::getSingleton('adminhtml/system_config_source_country')
            ->toOptionArray();
        foreach ($options as $option) {
            $this->addOption($option['value'], $option['label']);
        }

        return parent::_toHtml();
    }

    public function setInputName($value)
    {
        return $this->setName($value);
    }
}
