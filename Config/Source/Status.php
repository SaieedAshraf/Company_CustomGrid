<?php

namespace Company\CustomGrid\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class Status implements OptionSourceInterface
{
    private const STATUS_ENABLED = 1;
    private const STATUS_DISABLED = 0;

    private static function getOptionArray(): array
    {
        return [
            self::STATUS_ENABLED => __('Enabled'),
            self::STATUS_DISABLED => __('Disabled')
        ];
    }

    public function toOptionArray(): array
    {
        $options = [];
        foreach (self::getOptionArray() as $index => $value) {
            $options[] = ['value' => $index, 'label' => $value];
        }

        return $options;
    }
}
