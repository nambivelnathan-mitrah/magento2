<?php

namespace Nambi\Hello\Model\ResourceModel\Product\Grid;

use Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult;

class Collection extends SearchResult
{
    /**
     * @var \Magento\Framework\Api\Search\AggregationInterface
     */
    protected $aggregations;

    /**
     * Get aggregations
     */
    public function getAggregations()
    {
        return $this->aggregations;
    }

    /**
     * Set aggregations
     */
    public function setAggregations($aggregations)
    {
        $this->aggregations = $aggregations;
    }

    /**
     * Get search criteria
     */
    public function getSearchCriteria()
    {
        return null;
    }

    /**
     * Set search criteria
     */
    public function setSearchCriteria(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria = null
    ) {
        return $this;
    }

    /**
     * Get total count
     */
    public function getTotalCount()
    {
        return $this->getSize();
    }

    /**
     * Set total count
     */
    public function setTotalCount($totalCount)
    {
        return $this;
    }

    /**
     * Set items
     */
    public function setItems(array $items = null)
    {
        return $this;
    }
}
