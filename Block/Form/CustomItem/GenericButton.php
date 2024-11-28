<?php

namespace Company\CustomGrid\Block\Form\CustomItem;

use Company\CustomGrid\Api\Data\CustomItemInterface;
use Magento\Backend\Block\Widget\Context;
use Magento\Framework\UrlInterface;

class GenericButton
{
    private Context $context;
    private UrlInterface $urlBuilder;

    /**
     * @param Context $context
     */
    public function __construct(
        Context $context
    ) {
        $this->context = $context;
        $this->urlBuilder = $context->getUrlBuilder();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return (int)$this->context->getRequest()->getParam(CustomItemInterface::ID);
    }

    /**
     * @param string $label
     * @param string $class
     * @param string $onclick
     * @param array $dataAttribute
     * @param int $sortOrder
     *
     * @return array
     */
    protected function wrapButtonSettings(
        string $label,
        string $class,
        string $onclick = '',
        array $dataAttribute = [],
        int $sortOrder = 0
    ): array {
        return [
            'label' => $label,
            'on_click' => $onclick,
            'data_attribute' => $dataAttribute,
            'class' => $class,
            'sort_order' => $sortOrder
        ];
    }

    /**
     * @param string $route
     * @param array $params
     *
     * @return string
     */
    protected function getUrl(
        string $route,
        array $params = []
    ): string {
        return $this->urlBuilder->getUrl($route, $params);
    }
}
