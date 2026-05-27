<?php

namespace Nambi\Hello\Plugin;

class CategorySave
{
    public function beforeExecute(
        \Magento\Catalog\Controller\Adminhtml\Category\Save $subject
    ) {
        $request = $subject->getRequest();
        $postData = $request->getPostValue();

        if (isset($postData['second_image'][0]['name'])) {
            $postData['second_image']
                = $postData['second_image'][0]['name'];
        }

        $request->setPostValue($postData);

        return null;
    }
}
