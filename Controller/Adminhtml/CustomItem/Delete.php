<?php

namespace Company\CustomGrid\Controller\Adminhtml\CustomItem;

use Company\CustomGrid\Api\Data\CustomItemInterface;
use Company\CustomGrid\Api\CustomItemRepositoryInterface;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;

class Delete extends Action implements HttpPostActionInterface, HttpGetActionInterface
{
    /**
     * @see _isAllowed()
     */
    public const ADMIN_RESOURCE = 'Company_CustomGrid::management';
    private CustomItemRepositoryInterface $customGridRepository;

    /**
     * @param Context $context
     * @param CustomItemRepositoryInterface $customGridRepository
     */
    public function __construct(
        Context $context,
        CustomItemRepositoryInterface $customGridRepository
    ) {
        parent::__construct($context);
        $this->customGridRepository = $customGridRepository;
    }

    /**
     * @return ResultInterface
     */
    public function execute()
    {
        /** @var ResultInterface $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setPath('*/*/');
        $customGridId = (int)$this->getRequest()->getParam(CustomItemInterface::ID);

        try {
            $this->customGridRepository->delete($customGridId);
            $this->messageManager->addSuccessMessage(
                __('You have successfully deleted custom item')
            );
        } catch (CouldNotDeleteException|NoSuchEntityException $exception) {
            $this->messageManager->addErrorMessage($exception->getMessage());
        }

        return $resultRedirect;
    }
}
