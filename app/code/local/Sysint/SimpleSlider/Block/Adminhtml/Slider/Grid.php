<?php

/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */
class Sysint_SimpleSlider_Block_Adminhtml_Slider_Grid
    extends Mage_Adminhtml_Block_Widget_Grid
{
    /**
     * Sysint_SimpleSlider_Block_Adminhtml_Slider_Grid constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('sliderGrid');
        $this->setDefaultSort('slide_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }

    /**
     * @return Mage_Adminhtml_Block_Widget_Grid
     */
    protected function _prepareCollection()
    {
        $collection = Mage::getSingleton('sysint_simpleslider/slider')
                        ->getCollection();
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    /**
     * @return Sysint_SimpleSlider_Block_Adminhtml_Slider_Grid
     */
    protected function _prepareColumns()
    {
        $this->addColumn(
            'slide_id',
            array(
                'header'    => Mage::helper('sysint_simpleslider')->__('ID'),
                'align'     => 'right',
                'width'     => '50px',
                'index'     => 'slide_id',
            )
        );

        $this->addColumn(
            'image',
            array(
                'header'    => Mage::helper('sysint_simpleslider')->__('image'),
                'align'     => 'center',
                'index'     => 'image',
                'renderer'  => 'sysint_simpleslider/adminhtml_renderer_grid_image'
            )
        );

        $this->addColumn(
            'display_from',
            array(
                'header'    => Mage::helper('sysint_simpleslider')->__('Display From'),
                'align'     =>'left',
                'index'     => 'display_from'
            )
        );

        $this->addColumn(
            'display_to',
            array(
                'header'    => Mage::helper('sysint_simpleslider')->__('Display To'),
                'align'     =>'left',
                'index'     => 'display_to',
            )
        );

        $this->addColumn(
            'is_active',
            array(
                'header'    => Mage::helper('sysint_simpleslider')->__('Status'),
                'align'     => 'left',
                'width'     => '80px',
                'index'     => 'is_active',
                'type'      => 'options',
                'options'   => array(
                    1 =>  Mage::helper('sysint_simpleslider')->__('Enabled'),
                    0 =>  Mage::helper('sysint_simpleslider')->__('Disabled'),
                ),
            )
        );

        $this->addColumn(
            'action',
            array(
                'header'    =>  Mage::helper('sysint_simpleslider')->__('Action'),
                'width'     => '100',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('sysint_simpleslider')->__('Edit'),
                        'url'       => array('base'=> '*/*/edit'),
                        'field'     => 'slide_id'
                    ),
                    array(
                        'caption'   => Mage::helper('sysint_simpleslider')->__('Delete'),
                        'url'       => array('base'=> '*/*/delete'),
                        'field'     => 'slide_id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'slide_id',
                'is_system' => true,
            )
        );

        return parent::_prepareColumns();
    }

    /**
     * @return MageKeeper_Slider_Block_Adminhtml_Slider_Grid
     */
    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('slide_id');
        $this->getMassactionBlock()->setFormFieldName('slide_ids');

        $this->getMassactionBlock()
            ->addItem(
                'delete',
                [
                    'label'    => Mage::helper('sysint_simpleslider')->__('Delete'),
                    'url'      => $this->getUrl('*/*/massDelete'),
                    'confirm'  => Mage::helper('sysint_simpleslider')->__('Are you sure?')
                ]
            );

        return $this;
    }

    /**
     * @param Sysint_SimpleSlider_Model_Slider $item
     * @return string
     */
    public function getRowUrl($item)
    {
        return $this->getUrl('*/*/edit', array(
            'slide_id' => $item->getId(),
        ));
    }
}
