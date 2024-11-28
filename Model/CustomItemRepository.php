<?php

namespace Company\CustomGrid\Model;

use Company\CustomGrid\Api\CustomItemRepositoryInterface;
use Company\CustomGrid\Api\Data\CustomItemInterface;
use Company\CustomGrid\Mapper\CustomItemDataMapper;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResultsInterface;
use Magento\Framework\Api\SearchResultsInterfaceFactory;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Company\CustomGrid\Model\ResourceModel\CustomItem as CustomItemResource;
use Company\CustomGrid\Model\CustomItemFactory;
use Magento\Framework\Exception\NoSuchEntityException;
use Company\CustomGrid\Model\ResourceModel\CustomItem\CollectionFactory as CustomItemCollectionFactory;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;

class CustomItemRepository implements CustomItemRepositoryInterface
{
    private CustomItemFactory $customItemFactory;
    private CustomItemCollectionFactory $customItemCollectionFactory;
    private CollectionProcessorInterface $collectionProcessor;
    private SearchResultsInterfaceFactory $searchResultsFactory;
    private SearchCriteriaBuilder $searchCriteriaBuilder;
    private CustomItemDataMapper $customGridDataMapper;
    private CustomItemResource $customItemResource;

    public function __construct(
        CustomItemFactory $customItemFactory,
        CustomItemCollectionFactory $customItemCollectionFactory,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        CollectionProcessorInterface $collectionProcessor,
        SearchResultsInterfaceFactory $searchResultsFactory,
        CustomItemDataMapper $customGridDataMapper,
        CustomItemResource $customItemResource
    ) {
        $this->customItemFactory = $customItemFactory;
        $this->customItemCollectionFactory = $customItemCollectionFactory;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->collectionProcessor = $collectionProcessor;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->customGridDataMapper = $customGridDataMapper;
        $this->customItemResource = $customItemResource;
    }

    /**
     * @param $id
     * @return CustomItem
     * @throws NoSuchEntityException
     */
    public function getById($id): CustomItem
    {
        $customItem = $this->customItemFactory->create();
        $this->customItemResource->load($customItem, $id);
        if (!$customItem->getId()) {
            throw new NoSuchEntityException(__('Custom item with specified ID "%1" not found.', $id));
        }

        return $customItem;
    }

    /**
     * @throws CouldNotSaveException
     */
    public function save($customGrid): int
    {
        try {
            $customItemModel = $this->customItemFactory->create();
            $customItemModel->addData($customGrid->getData());
            $customItemModel->setHasDataChanges(true);

            if (!$customItemModel->getData(CustomItemInterface::ID)) {
                $customItemModel->isObjectNew(true);
            }

            $this->customItemResource->save($customItemModel);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__('Could not save CustomItem.'));
        }

        return (int)$customItemModel->getData(CustomItemInterface::ID);
    }

    /**
     * @throws CouldNotDeleteException
     */
    public function delete($id): void
    {
        try {
            $customItemModel = $this->customItemFactory->create();
            $this->customItemResource->load($customItemModel, $id, CustomItemInterface::ID);

            if (!$customItemModel->getData(CustomItemInterface::ID)) {
                throw new NoSuchEntityException(
                    __('Could not find CustomItem with id: `%id`', ['id' => $id])
                );
            }

            $this->customItemResource->delete($customItemModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__('Could not delete CustomItem.'));
        }
    }

    public function getList(SearchCriteriaInterface $searchCriteria): SearchResultsInterface
    {
        $customGridCollection = $this->customItemCollectionFactory->create();
        $searchResult = $this->searchResultsFactory->create();
        $searchResult->setSearchCriteria($searchCriteria);
        $this->collectionProcessor->process($searchCriteria, $customGridCollection);

        //Converting collection items to data objects
        $customGridData = $this->customGridDataMapper->map($customGridCollection);
        $searchResult->setItems($customGridData);
        $searchResult->setTotalCount($customGridCollection->getSize());

        return $searchResult;
    }
}
