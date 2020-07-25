<?php

/**
 * @copyright Copyright © 2020 Ochebernin. All rights reserved.
 * @author    chebernin@gmail.com
 */
namespace Ochebernin\Weather\Controller\Adminhtml\Weatherhistory;

use Exception;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\Exception\LocalizedException;
use Magento\Ui\Component\MassAction\Filter;
use Magento\Framework\Controller\ResultFactory;
use Ochebernin\Weather\Model\ResourceModel\WeatherHistory\Collection;

/**
 * Class MassDelete
 */
class MassDelete extends Action
{
    const ADMIN_RESOURCE = 'Ochebernin_Weather::weather_history';

    /**
     * @var Filter
     */
    protected $filter;

    /**
     * @var Collection $objectCollection
     */
    protected $objectCollection;

    /**
     * @param Context $context
     * @param Filter $filter
     * @param Collection $objectCollection
     */
    public function __construct(Context $context, Filter $filter, Collection $objectCollection)
    {
        $this->filter = $filter;
        $this->objectCollection = $objectCollection;
        parent::__construct($context);
    }

    /**
     * Execute action
     *
     * @return Redirect
     * @throws LocalizedException|Exception
     */
    public function execute(): Redirect
    {
        $collection = $this->filter->getCollection($this->objectCollection);
        $collectionSize = $collection->getSize();
        $collection->walk('delete');

        $this->messageManager->addSuccessMessage(__('A total of %1 record(s) have been deleted.', $collectionSize));

        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('*/*/');
    }
}
