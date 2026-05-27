<?php

namespace Nambi\Blog\Controller\Adminhtml\Post;

use Magento\Backend\App\Action;
use Nambi\Blog\Model\PostFactory;

class Save extends Action
{
    /*
    POST FACTORY
    */

    protected $postFactory;

    /*
    CONSTRUCTOR
    */

    public function __construct(
        Action\Context $context,
        PostFactory $postFactory
    ) {

        parent::__construct($context);

        $this->postFactory = $postFactory;
    }

    /*
    EXECUTE
    */

    public function execute()
    {
        /*
        GET FORM DATA
        */

        $data = $this->getRequest()->getPostValue();

        /*
        NO DATA
        */

        if (!$data) {

            return $this->_redirect(
                'nambi_blog/post/index'
            );
        }

        try {

            /*
            MODEL
            */

            $model = $this->postFactory->create();

            /*
            EDIT MODE
            */

            $id = $this->getRequest()
                ->getParam('post_id');

            if ($id) {

                $model->load($id);
            }

            /*
            IMAGE SAVE
            */

            if (isset($data['thumbnail'][0]['name'])) {

                $data['thumbnail']
                    = 'blog/'
                    . $data['thumbnail'][0]['name'];

            } else {

                /*
                REMOVE IMAGE FIELD
                */

                unset($data['thumbnail']);
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

            $this->messageManager
                ->addSuccessMessage(
                    __('Post Saved Successfully')
                );

        } catch (\Exception $e) {

            /*
            ERROR MESSAGE
            */

            $this->messageManager
                ->addErrorMessage(
                    $e->getMessage()
                );
        }

        /*
        REDIRECT
        */

        return $this->_redirect(
            'nambi_blog/post/index'
        );
    }
}