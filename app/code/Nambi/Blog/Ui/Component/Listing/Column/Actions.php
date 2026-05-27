<?php

namespace Nambi\Blog\Ui\Component\Listing\Column;

use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;

class Actions extends Column
{
    protected $urlBuilder;

    const EDIT_URL = 'nambi_blog/category/edit';

    public function __construct(
        \Magento\Framework\View\Element\UiComponent\ContextInterface $context,
        \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    ) {

        $this->urlBuilder = $urlBuilder;

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

                if (isset($item['category_id'])) {

                    $item[$this->getData('name')]['edit'] = [

                        'href' => $this->urlBuilder->getUrl(
                            self::EDIT_URL,
                            [
                                'category_id' =>
                                    $item['category_id']
                            ]
                        ),

                        'label' => __('Edit')
                    ];
                }
            }
        }

        return $dataSource;
    }
}