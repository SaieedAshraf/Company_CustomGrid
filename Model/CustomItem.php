<?php

namespace Company\CustomGrid\Model;

use Company\CustomGrid\Model\ResourceModel\CustomItem as CustomItemResource;
use Magento\Framework\Model\AbstractModel;

class CustomItem extends AbstractModel
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'custom_items_model';

    /**
     * Initialize magento model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(CustomItemResource::class);
    }
}
