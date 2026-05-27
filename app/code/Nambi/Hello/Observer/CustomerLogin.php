<?php

namespace Nambi\Hello\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class CustomerLogin implements ObserverInterface
{

public function execute(Observer $observer)
{

$customer = $observer->getEvent()->getCustomer();

echo "Event Working" .  $customer->getFirstname();

exit;

}

}