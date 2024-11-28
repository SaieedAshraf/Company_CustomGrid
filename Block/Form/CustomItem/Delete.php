<?php

namespace Company\CustomGrid\Block\Form\CustomItem;

use Company\CustomGrid\Api\Data\CustomItemInterface;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class Delete extends GenericButton implements ButtonProviderInterface
{
    /**
     * @return array
     */
    public function getButtonData(): array
    {
        if (!$this->getId()) {
            return [];
        }

        return $this->wrapButtonSettings(
            __('Delete')->getText(),
            'delete',
            sprintf("deleteConfirm('%s', '%s')",
                __('Are you sure you want to delete this custom item?'),
                $this->getUrl(
                    '*/*/delete',
                    [CustomItemInterface::ID => $this->getId()]
                )
            ),
            [],
            20
        );
    }
}
