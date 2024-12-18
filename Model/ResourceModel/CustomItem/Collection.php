<?php

namespace Company\CustomGrid\Model\ResourceModel\CustomItem;

use Company\CustomGrid\Model\CustomItem;
use Company\CustomGrid\Model\ResourceModel\CustomItem as CustomItemResource;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'custom_items_collection';

    /**
     * Initialize collection model.
     */
    protected function _construct()
    {
        $this->_init(CustomItem::class, CustomItemResource::class);
    }
}
