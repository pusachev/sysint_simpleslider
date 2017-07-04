<?php

/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2016, Pavel Usachev
 */

/**
 * Class SP_Events_Helper_Data
 */
class Sysint_SimpleSlider_Helper_Data
    extends Mage_Core_Helper_Abstract
{
    const XML_PATH_SYSTEM_ENABLED = 'sysint_simpleslider/general/enabled';
    const XML_PATH_SYSTEM_PRICE   = 'sysint_simpleslider/general/price';

    const ALLOWED_EXTENSION_IMAGE_NODE_PATH  = 'default/sysint_simpleslider/extension/image_allowed';

    const IMAGE_DIRECTORY = 'sysint_simpleslider';
    const RESIZE_IMAGE_QUALITY = 75;

    /**
     * @var Varien_Io_File
     */
    protected $_ioFile;

    /**
     * @var array;
     */
    protected $_allowedExtensions;

    /**
     * Sysint_SimpleSlider_Helper_Data constructor.
     */
    public function __construct()
    {
        $this->_ioFile = new Varien_Io_File();
        $this->_allowedExtensions = $this->_getAllowedExtensions();
    }

    /**
     * @return bool
     */
    public function isEnabled()
    {
        return Mage::getStoreConfigFlag(self::XML_PATH_SYSTEM_ENABLED);
    }

    /**
     * @return string[]
     */
    public function getPriceList()
    {
        $priceList =  Mage::getStoreConfig(self::XML_PATH_SYSTEM_PRICE);

        if(isset($priceList)) {
            $priceList = unserialize($priceList);
        } else {
            $priceList = [];
        }

        return $priceList;
    }


    /**
     * @param array $data
     */
    public function savePostData(array $data)
    {
        if (is_array($data['image']) && isset($data['image']['value'])) {
            if (empty($data['image']['delete'])) {
                $data['image'] = $data['image']['value'];
            } else {
                $this->deleteAllSliderImages($data['image']['value']);
                $data['image'] = '';
            }
        }

        if ($imageName = $this->uploadFile()) {
            $data['image'] = $imageName;
        }

        $model = Mage::getModel('sysint_simpleslider/slider');
        $model->setData($data);
        $model->save();
    }

    /**
     * @return string|bool
     */
    public function uploadFile()
    {
        if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') {
            try {
                $uploader = new Varien_File_Uploader('image');
                $uploader->setAllowedExtensions($this->_allowedExtensions);
                $uploader->setAllowRenameFiles(true);
                $uploader->setAllowCreateFolders(true);
                $uploader->setFilesDispersion(false);
                $path = Mage::getBaseDir('media') . DS . 'sysint_simpleslider' . DS;
                $imageName = preg_replace('/\s+/', '_', $_FILES['image']['name']);

                $uploader->save($path, $imageName);

                return $imageName;

            } catch (Exception $e) {
                Mage::logException($e);
                Mage::getSingleton('adminhtml/session')->addError($this->__('Image upload failed'));
            }
        }

        return false;
    }

    /**
     * @param string    $fileName
     * @param int       $width
     * @param int       $height
     *
     * @return string
     */
    public function resizeImage($fileName, $width, $height)
    {
        $basePath = $this->getBaseImagePath($fileName);
        $newPath = $this->getResizedImagePath($fileName, $width, $height);

        //if image has already resized then just return URL
        if (file_exists($basePath) && is_file($basePath) && !file_exists($newPath)) {
            $imageObj = new Varien_Image($basePath);
            $imageObj->constrainOnly(true);
            $imageObj->quality(self::RESIZE_IMAGE_QUALITY);
            $imageObj->keepAspectRatio(false);
            $imageObj->keepFrame(false);
            $imageObj->resize($width, $height);
            $imageObj->save($newPath);
        }

        return $this->getResizedImageUrl($fileName, $width, $height);
    }

    /**
     * @param string        $fileName
     * @param null|int      $width
     * @param null|int      $height
     */
    public function deleteImage($fileName, $width = null, $height = null)
    {
        $filePath = '';

        if (null == $width && null === $height) {
            $filePath = $this->getBaseImagePath($fileName);
        } else {
            $filePath = $this->getResizedImagePath($fileName, $width, $height);
        }

        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }

    /**
     * @param string    $imageName
     * @param int       $width
     * @param int       $height
     *
     * @return string
     */
    public function getResizedImageUrl($imageName, $width, $height)
    {
        $format = '%s/'.self::IMAGE_DIRECTORY.'/%s/%s';

        $resizedDirectory = sprintf('%s_%s', $width, $height);

        return sprintf(
            $format,
            Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA),
            $resizedDirectory,
            $imageName
        );
    }

    /**
     * Recursive find and delete image
     *
     * @param string        $imageName
     * @param null|string   $dir
     *
     * @return void;
     */
    public function deleteAllSliderImages($imageName, $dir = null)
    {
        $format = '%s%s'.self::IMAGE_DIRECTORY;

        $basePath = sprintf(
            $format,
            Mage::getBaseDir(Mage_Core_Model_Store::URL_TYPE_MEDIA),
            DS
        );

        $dir = (null === $dir) ? $basePath : $dir;

        if (is_dir($dir)) {
            foreach (scandir($dir) as $item) {
                if (!strcmp($item, '.') || !strcmp($item, '..')) {
                    continue;
                }
                $this->deleteAllSliderImages($imageName,$dir . "/" . $item);
            }
        } else {
            if (false !== strpos($dir, $imageName)) {
                unlink($dir);
            }
        }
    }

    /**
     * @param string $imageName
     * @return string
     */
    public function getBaseImagePath($imageName)
    {
        $format = '%s%s'.self::IMAGE_DIRECTORY.'%s%s';

        return sprintf(
            $format,
            Mage::getBaseDir(Mage_Core_Model_Store::URL_TYPE_MEDIA),
            DS,
            DS,
            $imageName
        );
    }

    /**
     * @param string        $imageName
     * @param int|string    $width
     * @param int|string    $height
     *
     * @return string
     */
    public function getResizedImagePath($imageName, $width, $height)
    {
        $format = '%s%s'.self::IMAGE_DIRECTORY.'%s%s%s%s';

        $resizedDirectory = sprintf('%s_%s', $width, $height);

        return sprintf(
            $format,
            Mage::getBaseDir(Mage_Core_Model_Store::URL_TYPE_MEDIA),
            DS,
            DS,
            $resizedDirectory,
            DS,
            $imageName
        );
    }

    /**
     * @return array
     */
    protected function _getAllowedExtensions()
    {
        $config = Mage::getConfig()
            ->loadModulesConfiguration('config.xml')
            ->getNode(self::ALLOWED_EXTENSION_IMAGE_NODE_PATH)
            ->asArray();

        return array_keys($config);
    }
}
