<?php

namespace Nambi\Hello\Model;

use Magento\Framework\Model\AbstractModel;

class Product extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(\Nambi\Hello\Model\ResourceModel\Product::class);
    }
}