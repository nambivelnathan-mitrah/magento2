<?php

namespace Nambi\Blog\Controller\Adminhtml\Category;

use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;
use Nambi\Blog\Model\CategoryFactory;

class Edit extends Action
{
    protected $resultPageFactory;

    protected $categoryFactory;

    public function __construct(
        Action\Context $context,
        PageFactory $resultPageFactory,
        CategoryFactory $categoryFactory
    ) {

        $this->resultPageFactory = $resultPageFactory;

        $this->categoryFactory = $categoryFactory;

        parent::__construct($context);
    }

    public function execute()
    {
        $id = $this->getRequest()
            ->getParam('category_id');

        $model = $this->categoryFactory
            ->create();

        if ($id) {

            $model->load($id);

            if (!$model->getId()) {

                $this->messageManager
                    ->addErrorMessage(
                        __('Category no longer exists.')
                    );

                return $this->_redirect('*/*/');
            }
        }

        $resultPage = $this->resultPageFactory
            ->create();

        $resultPage->getConfig()
            ->getTitle()
            ->prepend(__('Edit Category'));

        return $resultPage;
    }
}