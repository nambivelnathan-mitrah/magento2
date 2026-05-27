<?php

namespace Nambi\Blog\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Category extends AbstractDb
{
    protected function _construct()
    {
        $this->_init(
            'nambi_blog_category',
            'category_id'
        );
    }
}