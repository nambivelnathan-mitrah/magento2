<?php

namespace Nambi\Blog\Block\Frontend;


use Magento\Framework\View\Element\Template;
use Nambi\Blog\Model\ResourceModel\Post\CollectionFactory;
use Magento\Store\Model\StoreManagerInterface;

class Post extends Template
{
    protected $postCollectionFactory;

    protected $storeManager;

    public function __construct(
        Template\Context $context,
        CollectionFactory $postCollectionFactory,
        StoreManagerInterface $storeManager,
        array $data = []
    ) {
        $this->postCollectionFactory = $postCollectionFactory;
        $this->storeManager = $storeManager;

        parent::__construct($context, $data);
    }

public function getPosts()
{
    return [];
}

    public function getMediaUrl()
    {
        return $this->storeManager
            ->getStore()
            ->getBaseUrl(
                \Magento\Framework\UrlInterface::URL_TYPE_MEDIA
            );
    }
}