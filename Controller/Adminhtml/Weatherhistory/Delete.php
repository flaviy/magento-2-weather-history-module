<?php

/**
 * @copyright Copyright © 2020 Ochebernin. All rights reserved.
 * @author    chebernin@gmail.com
 */

namespace Ochebernin\Weather\Controller\Adminhtml\Weatherhistory;

use Exception;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Ochebernin\Weather\Model\WeatherHistoryFactory;

class Delete extends Action
{
    const ADMIN_RESOURCE = 'Ochebernin_Weather::weather_history';

    /**
     * @var weatherHistoryFactory $objectFactory
     */
    protected $objectFactory;

    /**
     * @param Context $context
     * @param WeatherHistoryFactory $objectFactory
     */
    public function __construct(
        Context $context,
        WeatherHistoryFactory $objectFactory
    ) {
        $this->objectFactory = $objectFactory;
        parent::__construct($context);
    }

    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $id = $this->getRequest()->getParam('entity_id', null);

        try {
            $objectInstance = $this->objectFactory->create()->load($id);
            if ($objectInstance->getId()) {
                $objectInstance->delete();
                $this->messageManager->addSuccessMessage(__('You deleted the record.'));
            } else {
                $this->messageManager->addErrorMessage(__('Record does not exist.'));
            }
        } catch (Exception $exception) {
            $this->messageManager->addErrorMessage($exception->getMessage());
        }
        
        return $resultRedirect->setPath('*/*');
    }
}
