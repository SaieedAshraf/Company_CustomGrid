<?php

namespace Company\CustomGrid\Block\Form\CustomItem;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class Back extends GenericButton implements ButtonProviderInterface
{
    /**
     * @return array
     */
    public function getButtonData(): array
    {
        return $this->wrapButtonSettings(
            __('Back')->getText(),
            'back',
            sprintf("location.href = '%s';", $this->getUrl('*/*/')),
            [],
            10
        );
    }
}
