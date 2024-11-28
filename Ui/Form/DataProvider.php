<?php

namespace Company\CustomGrid\Ui\Form;

use Company\CustomGrid\Api\Data\CustomItemInterface;
use Company\CustomGrid\Model\ResourceModel\CustomItem\CollectionFactory;
use Magento\Framework\App\RequestInterface;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    private $loadedData = [];
    private RequestInterface $request;

    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $employeeCollectionFactory
     * @param RequestInterface $request
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $employeeCollectionFactory,
        RequestInterface $request,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $employeeCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->request = $request;
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if ($this->loadedData) {
            return $this->loadedData;
        }

        $this->loadedData = parent::getData();
        $itemsById = [];

        foreach ($this->loadedData['items'] as $item) {
            $itemsById[(int)$item[CustomItemInterface::ID]] = $item;
        }

        if ($id = $this->request->getParam(CustomItemInterface::ID)) {
            $this->loadedData['entity'] = $itemsById[(int)$id];
        }

        return $this->loadedData;
    }
}
