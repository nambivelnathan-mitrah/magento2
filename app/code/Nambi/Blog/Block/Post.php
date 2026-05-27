<?php

namespace Nambi\Blog\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\DataObject\IdentityInterface;
use Nambi\Blog\Model\ResourceModel\Post\CollectionFactory;
use Nambi\Blog\Model\ResourceModel\Category\CollectionFactory as CategoryCollectionFactory;
use Magento\Store\Model\StoreManagerInterface;

class Post extends Template implements IdentityInterface
{
    protected $postCollectionFactory;

    protected $categoryCollectionFactory;

    protected $storeManager;

    protected $postCollection;

    public function __construct(
        Template\Context $context,
        CollectionFactory $postCollectionFactory,
        CategoryCollectionFactory $categoryCollectionFactory,
        StoreManagerInterface $storeManager,
        array $data = []
    ) {
        $this->postCollectionFactory = $postCollectionFactory;

        $this->categoryCollectionFactory = $categoryCollectionFactory;

        $this->storeManager = $storeManager;

        parent::__construct($context, $data);
    }

    /*
    CATEGORY LIST
    */
    public function getCategories()
    {
        return $this->categoryCollectionFactory
            ->create();
    }

    /*
    POSTS
    */
    public function getPosts()
    {
        if (!$this->postCollection) {

            $collection = $this->postCollectionFactory
                ->create();

            /*
            SEARCH
            */
            $search = $this->getRequest()
                ->getParam('q');

            if ($search) {

                $collection->addFieldToFilter(
                    'title',
                    ['like' => '%' . $search . '%']
                );
            }

            /*
            CATEGORY FILTER
            */
            $categoryId = $this->getRequest()
                ->getParam('category_id');

            if ($categoryId) {

                $collection->addFieldToFilter(
                    'category_id',
                    $categoryId
                );
            }

            /*
            PAGINATION
            */
            $page = (int)$this->getRequest()
                ->getParam('p', 1);

            $pageSize = 6;

            $collection->setPageSize($pageSize);

            $collection->setCurPage($page);

            $this->postCollection = $collection;
        }

        return $this->postCollection;
    }



public function getCategoryName($categoryId)
{
    $collection = $this->categoryCollectionFactory
        ->create();

    $collection->addFieldToFilter(
        'category_id',
        $categoryId
    );

    $category = $collection->getFirstItem();

    return $category->getCategoryName();
}




    public function getPostDetails()
{
    $postId = $this->getRequest()
        ->getParam('id');

    $collection = $this->postCollectionFactory
        ->create();

    $collection->addFieldToFilter(
        'post_id',
        $postId
    );

    return $collection->getFirstItem();
}




public function getPreviousPost()
{
    $postId = $this->getRequest()
        ->getParam('id');

    $collection = $this->postCollectionFactory
        ->create();

    $collection->addFieldToFilter(
        'post_id',
        ['lt' => $postId]
    );

    $collection->setOrder(
        'post_id',
        'DESC'
    );

    $collection->setPageSize(1);

    return $collection->getFirstItem();
}

public function getNextPost()
{
    $postId = $this->getRequest()
        ->getParam('id');

    $collection = $this->postCollectionFactory
        ->create();

    $collection->addFieldToFilter(
        'post_id',
        ['gt' => $postId]
    );

    $collection->setOrder(
        'post_id',
        'ASC'
    );

    $collection->setPageSize(1);

    return $collection->getFirstItem();
}



    /*
    PAGER HTML
    */
    // protected function _prepareLayout()
    // {
    //     parent::_prepareLayout();

    //     if ($this->getPosts()) {

    //         $pager = $this->getLayout()
    //             ->createBlock(
    //                 \Magento\Theme\Block\Html\Pager::class,
    //                 'blog.post.pager'
    //             )
    //             ->setAvailableLimit([4 => 4, 8 => 8, 12=> 12])
    //             ->setShowPerPage(true)
    //             ->setCollection(
    //                 $this->getPosts()
    //             );

    //         $this->setChild(
    //             'pager',
    //             $pager
    //         );

    //         $this->getPosts()
    //             ->load();
    //     }

    //     return $this;
    // }



    protected function _prepareLayout()
{
    parent::_prepareLayout();

    $page = (int)$this->getRequest()->getParam('p', 1);

    $pageSize = 4;

    $collection = $this->getPosts();

    $collection->setPageSize($pageSize);

    $collection->setCurPage($page);

    $pager = $this->getLayout()
        ->createBlock(
            \Magento\Theme\Block\Html\Pager::class,
            'blog.post.pager'
        );

    $pager->setAvailableLimit([4 => 4]);

    $pager->setShowPerPage(true);

    $pager->setCollection($collection);

    $this->setChild('pager', $pager);

    return $this;
}

    /*
    GET PAGER
    */
    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }

    /*
    MEDIA URL
    */
    public function getMediaUrl()
    {
        return $this->storeManager
            ->getStore()
            ->getBaseUrl(
                \Magento\Framework\UrlInterface::URL_TYPE_MEDIA
            );
    }

    public function getIdentities()
    {
        return [];
    }
}