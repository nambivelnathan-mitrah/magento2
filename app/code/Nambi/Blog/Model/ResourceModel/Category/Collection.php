<?php

namespace Nambi\Blog\Model\ResourceModel\Category;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            \Nambi\Blog\Model\Category::class,
            \Nambi\Blog\Model\ResourceModel\Category::class
        );
    }
}