<?php

/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */
class Sysint_SimpleSlider_Block_Awesome_Slider extends Mage_Core_Block_Template
{
    /** @var Sysint_SimpleSlider_Helper_Data */
    protected $_helper;

    /** {@inheritdoc} */
    protected function _construct()
    {
        $this->_helper = Mage::helper('sysint_simpleslider');
    }

    /**
     * @return Varien_Data_Collection
     */
    public function getSlides()
    {
        return Mage::getModel('sysint_simpleslider/slider')
            ->getCollection()
            ->addFieldToFilter('slide_id', '1')
            //->addFieldToFilter('is_active', 0)
            ->addFieldToFilter(
                ['slide_id', 'is_active'],
                [
                    ['in' => [1,3,5]],
                    ['eq' => 10]
                ]
            );
    }

    /**
     * @return string[]
     */
    public function test()
    {
       return $this->_helper->getPriceList();
    }

    /** {@inheritdoc} */
    protected function _toHtml()
    {
        if(!$this->_helper->isEnabled()) {
            return '';
        }

        return parent::_toHtml();
    }
}
