<?php

namespace Nambi\Blog\Controller\Adminhtml\Category;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;
use Nambi\Blog\Model\CategoryFactory;

class Save extends Action
{
    protected $categoryFactory;

    public function __construct(
        Action\Context $context,
        CategoryFactory $categoryFactory
    ) {

        parent::__construct($context);

        $this->categoryFactory = $categoryFactory;
    }

    public function execute()
    {
        /*
        GET FORM DATA
        */

        $data = $this->getRequest()->getPostValue();

        /*
        REDIRECT RESULT
        */

        $resultRedirect = $this->resultFactory
            ->create(ResultFactory::TYPE_REDIRECT);

        /*
        NO DATA
        */

        if (!$data) {

            return $resultRedirect
                ->setPath('*/*/');
        }

        try {

            /*
            CATEGORY MODEL
            */

            $model = $this->categoryFactory->create();

            /*
            EDIT MODE
            */

            $id = $this->getRequest()->getParam('category_id');

            if ($id) {

                $model->load($id);
            }

            /*
            IMAGE SAVE
            */

            if (isset($data['thumbnail'][0]['name'])) {

                $data['thumbnail']
                    = 'blog/category/'
                    . $data['thumbnail'][0]['name'];

            } else {

                /*
                REMOVE IMAGE
                */

                if (isset($data['thumbnail']['delete'])
                    && $data['thumbnail']['delete'] == 1) {

                    $data['thumbnail'] = null;

                } else {

                    /*
                    KEEP OLD IMAGE
                    */

                    unset($data['thumbnail']);
                }
            }

            /*
            SET DATA
            */

            $model->setData($data);

            /*
            SAVE
            */

            $model->save();

            /*
            SUCCESS MESSAGE
            */

            $this->messageManager->addSuccessMessage(
                __('Category saved successfully.')
            );

            /*
            BACK BUTTON
            */

            if ($this->getRequest()->getParam('back')) {

                return $resultRedirect->setPath(
                    '*/*/edit',
                    ['category_id' => $model->getId()]
                );
            }

            /*
            GRID REDIRECT
            */

            return $resultRedirect->setPath('*/*/');

        } catch (\Exception $e) {

            /*
            ERROR MESSAGE
            */

            $this->messageManager->addErrorMessage(
                $e->getMessage()
            );

            /*
            REDIRECT BACK
            */

            return $resultRedirect->setPath(
                '*/*/edit',
                ['category_id' =>
                    $this->getRequest()->getParam('category_id')
                ]
            );
        }
    }
}