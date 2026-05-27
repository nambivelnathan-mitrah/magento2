<?php

namespace Nambi\Hello\Plugin\Model;

use Magento\Framework\Message\ManagerInterface;

class Product
{

    protected $messageManager;
    
    public function __construct(
        ManagerInterface $messageManager
    ) {
        $this->messageManager = $messageManager;
    }

    public function afterGetPrice(
        \Magento\Catalog\Model\Product $subject,
        $result ) {
        return $result + 0.22;

    }
    
/*
public function beforeGetName($subject)
{
    echo "Before Plugin <br>";
}
*/

        

    }






