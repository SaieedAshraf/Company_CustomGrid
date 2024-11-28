<?php

namespace Company\CustomGrid\Controller\Adminhtml\CustomItem;

use Magento\Backend\App\Action;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;

class Index extends Action implements HttpGetActionInterface
{
    /**
     * @see _isAllowed()
     */
    public const ADMIN_RESOURCE = 'Company_CustomGrid::management';

    /**
     * @return ResultInterface|ResponseInterface
     */
    public function execute()
    {
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);

        $resultPage->setActiveMenu('Company_CustomGrid::management');
        $resultPage->addBreadcrumb(__('CustomGrid'), __('CustomGrid'));
        $resultPage->addBreadcrumb(__('Manage CustomGrid'), __('Manage CustomGrid'));
        $resultPage->getConfig()->getTitle()->prepend(__('Custom items List'));

        return $resultPage;
    }
}
