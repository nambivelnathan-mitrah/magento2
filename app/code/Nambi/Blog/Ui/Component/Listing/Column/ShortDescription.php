<?php

namespace Nambi\Blog\Ui\Component\Listing\Column;

use Magento\Ui\Component\Listing\Columns\Column;

class ShortDescription extends Column
{
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {

            foreach ($dataSource['data']['items'] as &$item) {

                if (!empty($item['short_description'])) {

                    $content = $item['short_description'];

                    // remove style/script blocks
                    $content = preg_replace(
                        '#<style(.*?)>(.*?)</style>#is',
                        '',
                        $content
                    );

                    $content = preg_replace(
                        '#<script(.*?)>(.*?)</script>#is',
                        '',
                        $content
                    );

                    // remove html tags
                    $content = strip_tags($content);

                    // decode html entities
                    $content = html_entity_decode($content);

                    // remove extra spaces
                    $content = trim($content);

                    // limit text
                    $content = substr($content, 0, 100);

                    $item['short_description'] = $content;
                }
            }
        }

        return $dataSource;
    }
}