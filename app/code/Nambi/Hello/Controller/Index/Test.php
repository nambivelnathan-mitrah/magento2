<?php

namespace Nambi\Hello\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;

class Test extends Action
{

protected $_eventManager;

public function __construct(
    Context $context
){
    parent::__construct($context);
    $this->_eventManager = $context->getEventManager();
}

public function execute()
{

$textDisplay = new \Magento\Framework\DataObject(
['text' => 'Nambi']
);

$this->_eventManager->dispatch(
'nambi_hello_display_text',
['nambi_text' => $textDisplay]
);

echo $textDisplay->getText();
exit;

}

}