<?php

namespace Nambi\Blog\Ui\DataProvider;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Nambi\Blog\Model\ResourceModel\Post\Grid\CollectionFactory;

use Nambi\Blog\Ui\DataProvider\Post\Form\Modifier\Wysiwyg;

class PostDataProvider extends AbstractDataProvider
{
    protected $collection;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();

        parent::__construct(
            $name,
            $primaryFieldName,
            $requestFieldName,
            $meta,
            $data
        );
    }
      

      protected function _prepareForm()
    {
        $form = $this->_formFactory->create();

        $fieldset = $form->addFieldset(
            'base_fieldset',
            ['legend' => __('Post Information')]
        );

        /*
        TITLE
        */
        $fieldset->addField(
            'title',
            'text',
            [
                'name' => 'title',
                'label' => __('Title'),
                'title' => __('Title'),
                'required' => true
            ]
        );

        /*
        DESCRIPTION WYSIWYG
        */
        $fieldset->addField(
            'description',
            'editor',
            [
                'name' => 'description',
                'label' => __('Description'),
                'title' => __('Description'),
                'style' => 'height:500px;',
                'required' => false,

                'config' => $this->wysiwygConfig->getConfig(
                    [
                        'add_variables' => true,
                        'add_widgets' => true,
                        'add_images' => true,
                        'add_directives' => true,

                        /* IMPORTANT */
                        'is_pagebuilder_enabled' => false
                    ]
                ),

                'wysiwyg' => true
            ]
        );

        $form->setUseContainer(true);

        $this->setForm($form);

        return parent::_prepareForm();
    }
    


    public function getData()
{
    return [
        'totalRecords' => $this->getCollection()->getSize(),
        'items' => $this->getCollection()->getData()
    ];
}
}

