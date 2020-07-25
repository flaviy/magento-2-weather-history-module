<?php

/**
 * @copyright Copyright © 2020 Ochebernin. All rights reserved.
 * @author    chebernin@gmail.com
 */

namespace Ochebernin\Weather\Controller\Adminhtml\Weatherhistory;

use Exception;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Controller\ResultInterface;
use Ochebernin\Weather\Api\WeatherHistoryRepositoryInterface;
use Ochebernin\Weather\Model\WeatherHistory;

/**
 * Grid inline edit controller
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class InlineEdit extends Action
{
    const ADMIN_RESOURCE = 'Ochebernin_Weather::weather_history';

    /**
     * @var JsonFactory
     */
    private $jsonFactory;

    /**
     * @var WeatherHistoryRepositoryInterface
     */
    private $repository;

    /**
     * @param Context $context
     * @param JsonFactory $jsonFactory
     * @param WeatherHistoryRepositoryInterface $repository
     */
    public function __construct(
        Context $context,
        JsonFactory $jsonFactory,
        WeatherHistoryRepositoryInterface $repository
    ) {
        parent::__construct($context);
        $this->jsonFactory = $jsonFactory;
        $this->repository = $repository;
    }

    /**
     * @return ResultInterface
     */
    public function execute()
    {
        /** @var Json $resultJson */
        $resultJson = $this->jsonFactory->create();
        $error = false;
        $messages = [];

        $postItems = $this->getRequest()->getParam('items', []);
        if (!($this->getRequest()->getParam('isAjax') && count($postItems))) {
            return $resultJson->setData([
                'messages' => [__('Please correct the data sent.')],
                'error' => true,
            ]);
        }

        try {
            foreach (array_keys($postItems) as $weatherHistoryId) {
                /** @var  WeatherHistory $weatherHistory */
                $weatherHistory = $this->repository->getById($weatherHistoryId);
                $weatherHistory->setData(array_merge($weatherHistory->getData(), $postItems[$weatherHistoryId]));
                $this->repository->save($weatherHistory);
            }
        } catch (Exception $e) {
            $messages[] = __('There was an error saving the data: ') . $e->getMessage();
            $error = true;
        }

        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }
}
