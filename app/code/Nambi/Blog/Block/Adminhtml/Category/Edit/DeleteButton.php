<?php

namespace Nambi\Blog\Block\Adminhtml\Category\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class DeleteButton implements ButtonProviderInterface
{
    public function getButtonData()
    {
        return [
            'label' => __('Delete'),
            'class' => 'delete',
            'on_click' => 'deleteConfirm(
                \'' . __('Are you sure you want to delete this category?') . '\',
                \'' . 'delete' . '\'
            )',
            'sort_order' => 20,
        ];
    }
}