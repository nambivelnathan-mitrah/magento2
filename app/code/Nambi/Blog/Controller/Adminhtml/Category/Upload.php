<?php

namespace Nambi\Blog\Controller\Adminhtml\Category;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;
use Magento\MediaStorage\Model\File\UploaderFactory;
use Magento\Framework\Filesystem;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\UrlInterface;

class Upload extends Action
{
    protected $uploaderFactory;

    protected $filesystem;

    public function __construct(
        Action\Context $context,
        UploaderFactory $uploaderFactory,
        Filesystem $filesystem
    ) {

        parent::__construct($context);

        $this->uploaderFactory = $uploaderFactory;

        $this->filesystem = $filesystem;
    }

    public function execute()
    {
        $result = [];

        try {

            /*
            CREATE UPLOADER
            */

            $uploader = $this->uploaderFactory->create(
                ['fileId' => 'thumbnail']
            );

            /*
            ALLOWED FILE TYPES
            */

            $uploader->setAllowedExtensions(
                ['jpg', 'jpeg', 'gif', 'png']
            );

            /*
            RENAME DUPLICATE FILES
            */

            $uploader->setAllowRenameFiles(true);

            /*
            MEDIA PATH
            */

            $mediaDirectory = $this->filesystem
                ->getDirectoryWrite(
                    DirectoryList::MEDIA
                );

            /*
            TARGET FOLDER
            */

            $target = $mediaDirectory
                ->getAbsolutePath('blog/category/');

            /*
            SAVE FILE
            */

            $result = $uploader->save($target);

            if (!$result) {

                throw new \Exception(
                    __('File cannot be saved.')
                );
            }

            /*
            FILE URL
            */

            $result['url'] = $this->_url->getBaseUrl(
                ['_type' => UrlInterface::URL_TYPE_MEDIA]
            ) . 'blog/category/' . $result['file'];

            /*
            REQUIRED FOR MAGENTO UI COMPONENT
            */

            $result['name'] = $result['file'];

            $result['tmp_name'] = $result['file'];

            $result['path'] = $target;

        } catch (\Exception $e) {

            $result = [

                'error' => $e->getMessage(),

                'errorcode' => $e->getCode()
            ];
        }

        /*
        RETURN JSON
        */

        return $this->resultFactory
            ->create(ResultFactory::TYPE_JSON)
            ->setData($result);
    }
}