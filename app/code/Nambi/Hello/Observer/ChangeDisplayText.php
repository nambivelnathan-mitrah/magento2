<?php

namespace Nambi\Hello\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class ChangeDisplayText implements ObserverInterface
{

public function execute(Observer $observer)
{

$displayText = $observer->getData('nambi_text');

echo $displayText->getText() . " - Event <br>";

$displayText->setText('Execute event successfully.');

return $this;

}

}