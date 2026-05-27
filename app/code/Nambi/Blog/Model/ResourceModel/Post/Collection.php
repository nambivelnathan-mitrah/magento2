<?php

namespace Nambi\Blog\Model\ResourceModel\Post;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            \Nambi\Blog\Model\Post::class,
            \Nambi\Blog\Model\ResourceModel\Post::class
        );
    }
}