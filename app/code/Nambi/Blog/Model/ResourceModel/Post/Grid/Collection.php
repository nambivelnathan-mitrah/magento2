<?php

namespace Nambi\Blog\Model\ResourceModel\Post\Grid;

use Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult;

class Collection extends SearchResult
{
    public function __construct(
        \Magento\Framework\Data\Collection\EntityFactoryInterface $entityFactory,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Framework\Data\Collection\Db\FetchStrategyInterface $fetchStrategy,
        \Magento\Framework\Event\ManagerInterface $eventManager,
        $mainTable = 'nambi_blog_post',
        $resourceModel = \Nambi\Blog\Model\ResourceModel\Post::class
    ) {

        parent::__construct(
            $entityFactory,
            $logger,
            $fetchStrategy,
            $eventManager,
            $mainTable,
            $resourceModel
        );
    }

    protected function _initSelect()
    {
        parent::_initSelect();

        $this->getSelect()
            ->joinLeft(
                ['mapping' => $this->getTable('nambi_blog_post_category')],
                'main_table.post_id = mapping.post_id',
                []
            )
            ->joinLeft(
                ['category' => $this->getTable('nambi_blog_category')],
                'mapping.category_id = category.category_id',
                [
                    'categories' => new \Zend_Db_Expr(
                        'GROUP_CONCAT(category.category_name SEPARATOR ", ")'
                    )
                ]
            )
            ->group('main_table.post_id');

        return $this;
    }
}