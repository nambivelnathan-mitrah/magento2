<?php

namespace Nambi\Blog\Controller\Adminhtml\Post;

use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Registry;
use Nambi\Blog\Model\PostFactory;

class Edit extends Action
{
    protected $resultPageFactory;
    protected $coreRegistry;
    protected $postFactory;

    public function __construct(
        Action\Context $context,
        PageFactory $resultPageFactory,
        Registry $coreRegistry,
        PostFactory $postFactory
    ) {
        parent::__construct($context);

        $this->resultPageFactory = $resultPageFactory;
        $this->coreRegistry = $coreRegistry;
        $this->postFactory = $postFactory;
    }

    public function execute()
    {
        // GET POST ID

        $postId = $this->getRequest()->getParam('post_id');

        // CREATE MODEL

        $model = $this->postFactory->create();

        // CHECK EDIT MODE

        if ($postId) {

            $model->load($postId);

            // CHECK RECORD EXISTS

            if (!$model->getId()) {

                $this->messageManager->addErrorMessage(
                    __('This post no longer exists.')
                );

                return $this->_redirect('*/*/');
            }
        }

        // REGISTER DATA

        $this->coreRegistry->register(
            'nambi_blog_post',
            $model
        );

        // CREATE PAGE

        $resultPage = $this->resultPageFactory->create();

        // ACTIVE MENU

        $resultPage->setActiveMenu('Nambi_Blog::post');

        // PAGE TITLE

        if ($postId) {

            $resultPage->getConfig()
                ->getTitle()
                ->prepend(__('Edit Post'));

        } else {

            $resultPage->getConfig()
                ->getTitle()
                ->prepend(__('Add New Post'));
        }

        return $resultPage;
    }
}