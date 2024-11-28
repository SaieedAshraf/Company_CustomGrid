<?php

namespace Company\CustomGrid\Model\ResourceModel;

use Company\CustomGrid\Api\Data\CustomItemInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class CustomItem extends AbstractDb
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'custom_items_resource_model';

    /**
     * Initialize resource model.
     */
    protected function _construct()
    {
        $this->_init('custom_items', CustomItemInterface::ID);
        $this->_useIsObjectNew = true;
    }
}
