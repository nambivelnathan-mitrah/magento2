<?php

namespace Nambi\Hello\Model\Config\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class Skills extends AbstractSource
{
    public function getAllOptions()
    {
        return [
 
            ['label' => '-- Please Select --', 'value' => ''],
            ['label' => 'PHP', 'value' => 1],
            ['label' => 'Magento', 'value' => 2],
            ['label' => 'Python', 'value' => 3],
            ['label' => 'JavaScript', 'value' => 4],
        ];
    }



}
