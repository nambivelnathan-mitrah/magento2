<?php

namespace Nambi\Blog\Ui\Component\Listing\Column;

use Magento\Ui\Component\Listing\Columns\Column;
use Nambi\Blog\Model\CategoryFactory;

class Category extends Column
{
    protected $categoryFactory;

    public function __construct(
        \Magento\Framework\View\Element\UiComponent\ContextInterface $context,
        \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory,
        CategoryFactory $categoryFactory,
        array $components = [],
        array $data = []
    ) {
        $this->categoryFactory = $categoryFactory;

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

                if (!empty($item['category_id'])) {

                    $category = $this->categoryFactory
                        ->create()
                        ->load($item['category_id']);

                    $item['category_id']
                        = $category->getCategoryName();
                }
            }
        }

        return $dataSource;
    }
}