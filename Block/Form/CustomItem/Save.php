<?php

namespace Company\CustomGrid\Block\Form\CustomItem;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class Save extends GenericButton implements ButtonProviderInterface
{
    /**
     * @return array
     */
    public function getButtonData(): array
    {
        return $this->wrapButtonSettings(
            __('Save')->getText(),
            'save primary',
            '',
            [
                'mage-init' => ['button' => ['event' => 'save']],
                'form-role' => 'save'
            ],
            30
        );
    }
}
