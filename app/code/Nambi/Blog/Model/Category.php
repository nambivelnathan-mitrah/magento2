<?php

namespace Nambi\Blog\Model;

use Magento\Framework\Model\AbstractModel;

class Category extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(
            \Nambi\Blog\Model\ResourceModel\Category::class
        );
    }
}