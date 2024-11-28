<?php

namespace Company\CustomGrid\Controller\Adminhtml\CustomItem;

use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;

class Create extends Action implements HttpGetActionInterface
{
    /**
     * @see _isAllowed()
     */
    public const ADMIN_RESOURCE = 'Company_CustomGrid::management';

    /**
     * @return Page|ResultInterface
     */
    public function execute()
    {
        /** @var Page $resultPage */
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->setActiveMenu('Company_CustomGrid::management');
        $resultPage->getConfig()->getTitle()->prepend(__('Add CustomItem'));

        return $resultPage;
    }
}
