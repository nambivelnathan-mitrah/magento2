<?php

namespace Nambi\Hello\Model\Ui\DataProvider;

use Magento\Framework\View\Element\UiComponent\DataProvider\DataProvider as MagentoDataProvider;

class ProductDataProvider extends MagentoDataProvider
{
    /**
     * Modify loaded data if needed
     */
    public function getData()
    {
        $data = parent::getData();

        // Example: debug or modify data
        // foreach ($data['items'] as &$item) {
        //     $item['name'] = strtoupper($item['name']);
        // }

        return $data;
    }
}