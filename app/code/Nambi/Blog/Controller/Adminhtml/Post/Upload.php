<?php

namespace Nambi\Blog\Controller\Adminhtml\Post;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;
use Magento\MediaStorage\Model\File\UploaderFactory;
use Magento\Framework\Filesystem;
use Magento\Framework\App\Filesystem\DirectoryList;

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

            $uploader = $this->uploaderFactory->create(
                ['fileId' => 'thumbnail']
            );

            $uploader->setAllowedExtensions(
                ['jpg', 'jpeg', 'gif', 'png']
            );

            $uploader->setAllowRenameFiles(true);

            $mediaDirectory = $this->filesystem
                ->getDirectoryRead(DirectoryList::MEDIA);

            $target = $mediaDirectory->getAbsolutePath('blog/');

            $result = $uploader->save($target);

            $result['url'] = $this->_url->getBaseUrl(
                ['_type' => \Magento\Framework\UrlInterface::URL_TYPE_MEDIA]
            ) . 'blog/' . $result['file'];

        } catch (\Exception $e) {

            $result = ['error' => $e->getMessage()];
        }

        return $this->resultFactory
            ->create(ResultFactory::TYPE_JSON)
            ->setData($result);
    }
}