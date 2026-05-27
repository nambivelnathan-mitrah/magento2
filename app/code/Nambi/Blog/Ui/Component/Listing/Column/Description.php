<?php

namespace Nambi\Blog\Ui\Component\Listing\Column;

use Magento\Ui\Component\Listing\Columns\Column;

class Description extends Column
{
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {

            foreach ($dataSource['data']['items'] as &$item) {

                if (isset($item['description'])) {

                    $content = $item['description'];

                    // remove style block
                    $content = preg_replace('/<style\b[^>]*>(.*?)<\/style>/is', '', $content);

                    // remove all html tags
                    $content = strip_tags($content);

                    // trim extra spaces
                    $content = trim($content);

                    // limit text
                    $content = substr($content, 0, 80);

                    $item['description'] = $content;
                }
            }
        }

        return $dataSource;
    }
}