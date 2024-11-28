<?php

namespace Company\CustomGrid\Controller\Adminhtml\CustomItem;

use Company\CustomGrid\Api\Data\CustomItemInterface;
use Company\CustomGrid\Api\Data\CustomItemInterfaceFactory;
use Company\CustomGrid\Api\CustomItemRepositoryInterface;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\DataObject;
use Magento\Framework\Exception\CouldNotSaveException;

class Save extends Action implements HttpPostActionInterface
{
    /**
     * @see _isAllowed()
     */
    public const ADMIN_RESOURCE = 'Company_CustomGrid::management';
    private DataPersistorInterface $dataPersistor;
    private CustomItemRepositoryInterface $customItemRepository;
    private CustomItemInterfaceFactory $customItemDataFactory;

    /**
     * @param Context $context
     * @param DataPersistorInterface $dataPersistor
     * @param CustomItemRepositoryInterface $customItemRepository
     * @param CustomItemInterfaceFactory $customItemDataFactory
     */
    public function __construct(
        Context $context,
        DataPersistorInterface $dataPersistor,
        CustomItemRepositoryInterface $customItemRepository,
        CustomItemInterfaceFactory $customItemDataFactory
    ) {
        parent::__construct($context);
        $this->dataPersistor = $dataPersistor;
        $this->customItemRepository = $customItemRepository;
        $this->customItemDataFactory = $customItemDataFactory;
    }

    /**
     * @return ResponseInterface|ResultInterface
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $params = $this->getRequest()->getParams();

        try {
            /** @var CustomItemInterface|DataObject $customItem */
            $customItem = $this->customItemDataFactory->create();
            $customItem->addData($params['general']);
            $this->customItemRepository->save($customItem);

            $this->messageManager->addSuccessMessage(
                __('The CustomItem data was saved successfully')
            );

            $this->dataPersistor->clear('entity');
        } catch (CouldNotSaveException $exception) {
            $this->messageManager->addErrorMessage($exception->getMessage());
            $this->dataPersistor->set('entity', $params);

            return $resultRedirect->setPath('*/*/edit', [
                CustomItemInterface::ID => $this->getRequest()
                    ->getParam(CustomItemInterface::ID)
            ]);
        }

        return $resultRedirect->setPath('*/*/');
    }
}
