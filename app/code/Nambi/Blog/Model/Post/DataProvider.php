<?php

namespace Nambi\Blog\Model\Post;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Nambi\Blog\Model\ResourceModel\Post\CollectionFactory;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\UrlInterface;

class DataProvider extends AbstractDataProvider
{
    protected $loadedData = [];

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
        $items = $this->collection->getItems();

        foreach ($items as $post) {

            $data = $post->getData();

            /*
            IMAGE FIELD
            */
            if (isset($data['thumbnail'])
                && !empty($data['thumbnail'])) {

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

            $this->loadedData[$post->getId()] = $data;
        }

        return $this->loadedData;
    }
}