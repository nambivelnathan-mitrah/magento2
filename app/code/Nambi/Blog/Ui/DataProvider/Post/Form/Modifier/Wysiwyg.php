<?php

namespace Nambi\Blog\Ui\DataProvider\Post\Form\Modifier;

use Magento\Ui\DataProvider\Modifier\ModifierInterface;
use Magento\Cms\Model\Wysiwyg\Config;

class Wysiwyg implements ModifierInterface
{
    protected $wysiwygConfig;

    public function __construct(
        Config $wysiwygConfig
    ) {
        $this->wysiwygConfig = $wysiwygConfig;
    }

    public function modifyMeta(array $meta)
    {
        $meta['general']['children']['description']['arguments']['data']['config']
            ['wysiwygConfigData'] = $this->wysiwygConfig->getConfig()->getData();

        $meta['general']['children']['description']['arguments']['data']['config']
            ['wysiwygConfigData']['is_pagebuilder_enabled'] = false;

        return $meta;
    }

    public function modifyData(array $data)
    {
        return $data;
    }
}