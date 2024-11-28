<?php

namespace Company\CustomGrid\Mapper;

use Company\CustomGrid\Api\Data\CustomItemInterfaceFactory;
use Company\CustomGrid\Model\CustomItem;
use Magento\Framework\DataObject;

class CustomItemDataMapper
{
    private CustomItemInterfaceFactory $customItemData;

    /**
     * @param CustomItemInterfaceFactory $customItemData
     */
    public function __construct(
        CustomItemInterfaceFactory $customItemData
    ) {
        $this->customItemData = $customItemData;
    }

    /**
     * @param $collection
     * @return array
     */
    public function map($collection): array
    {
        $results = [];
        /** @var CustomItem $customItem */
        foreach ($collection->getItems() as $customItem) {
            /** @var DataObject $customItemData */
            $customItemData = $this->customItemData->create();
            $customItemData->addData($customItem->getData());

            $results[] = $customItemData;
        }

        return $results;
    }
}
