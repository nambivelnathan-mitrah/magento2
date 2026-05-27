<?php

// namespace Nambi\Hello\Controller\Adminhtml\Product;

// use Magento\Backend\App\Action;
// use Magento\Framework\View\Result\PageFactory;

// class Index extends Action
// {
//     protected $resultPageFactory;

//     public function __construct(
//         Action\Context $context,
//         PageFactory $resultPageFactory
//     ) {
//         parent::__construct($context);
//         $this->resultPageFactory = $resultPageFactory;
//     }

//     public function execute()
//     {
//         $page = $this->resultPageFactory->create();
//         $page->getConfig()->getTitle()->prepend(__('Products'));
//         return $page;
//     }

    
// public function execute()
// {
//     $page = $this->resultPageFactory->create();

//     var_dump($page->getLayout()->getUpdate()->getHandles());
//     exit;
// }
//     protected function _isAllowed()
//     {
//         return true;
//     }
// }