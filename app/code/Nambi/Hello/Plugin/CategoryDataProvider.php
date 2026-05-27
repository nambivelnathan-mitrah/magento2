<?php

namespace Nambi\Hello\Plugin;

use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\UrlInterface;

class CategoryDataProvider
{
    protected $storeManager;

    public function __construct(
        StoreManagerInterface $storeManager
    ) {
        $this->storeManager = $storeManager;
    }

    public function afterGetData(
        \Magento\Catalog\Model\Category\DataProvider $subject,
        $result
    ) {
        foreach ($result as $categoryId => $category) {

            if (!empty($category['second_image'])
                && !is_array($category['second_image'])) {

                $imageName = $category['second_image'];

                $mediaUrl = $this->storeManager
                    ->getStore()
                    ->getBaseUrl(UrlInterface::URL_TYPE_MEDIA);

                $imagePath = BP . '/pub/media/catalog/category/' . $imageName;

                $result[$categoryId]['second_image'] = [
                    [
                        'name' => basename($imageName),
                        'url'  => $mediaUrl . 'catalog/tmp/category/' . ltrim($imageName, '/'),
              
                        'size' => file_exists($imagePath)
                            ? filesize($imagePath)
                            : 0,
                        'type' => 'image/jpeg'
                    ]
                ];
            }
        }

        return $result;
    }
}
