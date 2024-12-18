<?php

namespace Company\CustomGrid\Controller\Adminhtml\CustomItem;

use Company\CustomGrid\Api\CustomItemRepositoryInterface;
use Magento\Backend\App\Action;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;

class InlineEdit extends Action
{
    /**
     * @see _isAllowed()
     */
    public const ADMIN_RESOURCE = 'Company_CustomGrid::management';
    private CustomItemRepositoryInterface $customItemRepository;

    public function __construct(
        Action\Context $context,
        CustomItemRepositoryInterface $customItemRepository
    ) {
        parent::__construct($context);
        $this->customItemRepository = $customItemRepository;
    }

    /**
     * @return ResultInterface
     */
    public function execute()
    {
        $error = false;
        $messages = [];

        /** @var Json $resultJson */
        $resultJson = $this->resultFactory->create(ResultFactory::TYPE_JSON);

        $postItems = $this->getRequest()->getParam('items', []);

        if ($this->getRequest()->getParam('isAjax') && count($postItems)) {
            foreach ($postItems as $itemId => $itemData) {
                try {
                    $customItem = $this->customItemRepository->getById($itemId);
                    $customItem->addData($itemData);
                    $this->customItemRepository->save($customItem);
                } catch (LocalizedException $e) {
                    $messages[] = $e->getMessage();
                    $error = true;
                } catch (\Exception $e) {
                    $messages[] = __('Something went wrong while saving the item.');
                    $error = true;
                }
            }
        } else {
            $messages[] = __('Please correct the data sent.');
            $error = true;
        }

        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }
}
