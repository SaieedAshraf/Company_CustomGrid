<?php

namespace Company\CustomGrid\Controller\Adminhtml\CustomItem;

use Company\CustomGrid\Api\CustomItemRepositoryInterface;
use Company\CustomGrid\Api\Data\CustomItemInterface;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Api\SearchCriteriaBuilderFactory;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Exception\CouldNotSaveException;

class MassStatus extends Action implements HttpPostActionInterface
{
    private CustomItemRepositoryInterface $customGridRepository;
    private SearchCriteriaBuilderFactory $searchCriteriaBuilderFactory;

    public function __construct(
        Context $context,
        CustomItemRepositoryInterface $customGridRepository,
        SearchCriteriaBuilderFactory $searchCriteriaBuilderFactory
    ) {
        parent::__construct($context);
        $this->customGridRepository = $customGridRepository;
        $this->searchCriteriaBuilderFactory = $searchCriteriaBuilderFactory;
    }

    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $params = $this->getRequest()->getParams();
        $status = $params['status'];

        $searchCriteria = $this->searchCriteriaBuilderFactory->create();

        if (array_key_exists('selected', $params)) {
            $searchCriteria->addFilter('id', $params['selected'], 'in');
        }

        $customItems = $this->customGridRepository->getList(
            $searchCriteria->create()
        )->getItems();

        try {
            foreach ($customItems as $customItem) {
                /** @var CustomItemInterface $customItem */
                $customItem->setStatus($status);
                $this->customGridRepository->save($customItem);
            }

            $this->messageManager->addSuccessMessage(
                __('Custom item data has been saved successfully')
            );
        } catch (CouldNotSaveException $exception) {
            $this->messageManager->addErrorMessage($exception->getMessage());
        }

        return $resultRedirect->setPath('*/*/');
    }
}
