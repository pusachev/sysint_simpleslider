<?php

/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2016, Pavel Usachev
 */

class Sysint_SimpleSlider_Model_Resource_Slider
    extends Mage_Core_Model_Resource_Db_Abstract
{
    /**
     * {@inheritdoc}
     */
    protected function _construct()
    {
        $this->_init("sysint_simpleslider/slider", "slide_id");
    }

    protected function _beforeDelete(Mage_Core_Model_Abstract $object)
    {
        $table = $this->getMainTable();

        $adapter = $this->_getReadAdapter();
        $select = $adapter->select()
                         ->from($table, 'image')
                         ->where('slide_id=?', (int)$object->getId());

        $image =  $adapter->fetchOne($select);

        Mage::helper('sysint_simpleslider')->deleteAllSliderImages($image);

        return parent::_beforeDelete($object);
    }
}
