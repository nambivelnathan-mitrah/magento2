<?php

namespace Nambi\Blog\Model\Category;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Nambi\Blog\Model\ResourceModel\Category\CollectionFactory;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\UrlInterface;

class DataProvider extends AbstractDataProvider
{
    protected $loadedData;

    protected $storeManager;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        StoreManagerInterface $storeManager,
        array $meta = [],
        array $data = []
    ) {

        $this->collection = $collectionFactory->create();

        $this->storeManager = $storeManager;

        parent::__construct(
            $name,
            $primaryFieldName,
            $requestFieldName,
            $meta,
            $data
        );
    }

    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $items = $this->collection->getItems();

        foreach ($items as $category) {

            $data = $category->getData();

            /*
            IMAGE FIELD
            */

            if (!empty($data['thumbnail'])) {

                $imageName = basename($data['thumbnail']);

                $mediaUrl = $this->storeManager
                    ->getStore()
                    ->getBaseUrl(
                        UrlInterface::URL_TYPE_MEDIA
                    );

                $data['thumbnail'] = [[

                    'name' => $imageName,

                    'url' => $mediaUrl . $data['thumbnail']

                ]];
            }

            $this->loadedData[$category->getId()] = $data;
        }

        return $this->loadedData;
    }
}