<?php

namespace Nambi\Blog\Model\Category\Source;

use Magento\Framework\Data\OptionSourceInterface;
use Nambi\Blog\Model\ResourceModel\Category\CollectionFactory;

class CategoryOptions implements OptionSourceInterface
{
    protected $collectionFactory;

    public function __construct(
        CollectionFactory $collectionFactory
    ) {
        $this->collectionFactory = $collectionFactory;
    }

    public function toOptionArray()
    {
        $options = [];

        $options[] = [
            'label' => __('Select Category'),
            'value' => ''
        ];

        $collection = $this->collectionFactory->create();

        foreach ($collection as $category) {

            $options[] = [
                'label' => $category->getCategoryName(),
                'value' => $category->getId()
            ];
        }

        return $options;
    }
}

