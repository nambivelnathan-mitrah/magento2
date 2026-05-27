<?php

namespace Nambi\Hello\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Message\ManagerInterface;
use Magento\Customer\Model\Session;

class AddToCart implements ObserverInterface
{

protected $messageManager;
protected $customerSession;

public function __construct(
ManagerInterface $messageManager,
Session $customerSession

){
$this->messageManager = $messageManager;
$this->customerSession = $customerSession;
}

public function execute(Observer $observer)
{

$product = $observer->getEvent()->getProduct();
$request = $observer->getEvent()->getRequest();

$productName = $product->getName();
$productQty = $request->getParam('qty');

  if (!$productQty || $productQty <= 0) {
            $productQty = 1;
            $request->setParam('qty', 1);
        }





$customerName = "Guest";

if ($this->customerSession->isLoggedIn()) {
    $customerName = $this->customerSession->getCustomer()->getName();
}


$this->messageManager->addSuccessMessage(
" Welcome " . $customerName. " | Product Name : " . $productName . " | Quantity : " . $productQty . " | Successfully Product Added to Cart" 


);

}

}
