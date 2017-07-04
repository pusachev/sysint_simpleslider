<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */

$model = Mage::getModel('sysint_simpleslider/slider');

for ($i=0; $i < 10; $i++) {
    $model->setData([
        'image' => 'test_test.png',
    ]);

    $model->save();
}
