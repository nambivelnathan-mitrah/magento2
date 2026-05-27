<?php

namespace Nambi\Blog\Ui\Component\Listing\Column;

use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;
use Magento\Store\Model\StoreManagerInterface;

class Thumbnail extends Column
{
    protected $storeManager;

    public function __construct(
        \Magento\Framework\View\Element\UiComponent\ContextInterface $context,
        \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory,
        StoreManagerInterface $storeManager,
        array $components = [],
        array $data = []
    ) {

        $this->storeManager = $storeManager;

        parent::__construct(
            $context,
            $uiComponentFactory,
            $components,
            $data
        );
    }

    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {

            foreach ($dataSource['data']['items'] as & $item) {

                if (isset($item['thumbnail'])) {

                    $mediaUrl = $this->storeManager
                        ->getStore()
                        ->getBaseUrl(
                            UrlInterface::URL_TYPE_MEDIA
                        );

                    $imageUrl = $mediaUrl . $item['thumbnail'];

                    $item['thumbnail_src'] = $imageUrl;

                    $item['thumbnail_alt'] = 'Thumbnail';

                    $item['thumbnail_link'] = $imageUrl;

                    $item['thumbnail_orig_src'] = $imageUrl;
                }
            }
        }

        return $dataSource;
    }
}