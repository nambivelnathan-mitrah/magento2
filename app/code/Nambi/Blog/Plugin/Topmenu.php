<?php

namespace Nambi\Blog\Plugin;

use Magento\Framework\Data\Tree\Node;

class Topmenu
{
    public function beforeGetHtml(
        \Magento\Theme\Block\Html\Topmenu $subject
    ) {

        $menu = $subject->getMenu();

        $tree = $menu->getTree();

        $data = [
            'name' => 'Posts',

            'id' => 'blog-posts',

            'url' => $subject->getUrl(
                'blog/post/index'
            ),

            'is_active' => false
        ];

        $node = new Node(
            $data,
            'id',
            $tree,
            $menu
        );

        $menu->addChild($node);
    }
}