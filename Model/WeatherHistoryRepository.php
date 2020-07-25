<?php

/**
 * @copyright Copyright © 2020 Ochebernin. All rights reserved.
 * @author    chebernin@gmail.com
 */

namespace Ochebernin\Weather\Model;

use Ochebernin\Weather\Api\WeatherHistoryRepositoryInterface;
use Exception;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\NoSuchEntityException;
use Ochebernin\Weather\Api\Data\WeatherHistoryInterface;
use Ochebernin\Weather\Api\Data\WeatherHistorySearchResultInterface;
use Ochebernin\Weather\Api\Data\WeatherHistorySearchResultInterfaceFactory;
use Ochebernin\Weather\Model\ResourceModel\WeatherHistory\CollectionFactory as WeatherHistoryCollectionFactory;
use Ochebernin\Weather\Model\ResourceModel\WeatherHistory\Collection;

class WeatherHistoryRepository implements WeatherHistoryRepositoryInterface
{

    /**
     * @var WeatherHistoryFactory
     */
    private $weatherHistoryFactory;

    /**
     * @var WeatherHistoryCollectionFactory
     */
    private $weatherHistoryCollectionFactory;

    /**
     * @var WeatherHistorySearchResultInterfaceFactory
     */
    private $searchResultFactory;

    public function __construct(
        WeatherHistoryFactory $weatherHistoryFactory,
        WeatherHistoryCollectionFactory $weatherHistoryCollectionFactory,
        WeatherHistorySearchResultInterfaceFactory $weatherHistorySearchResultInterfaceFactory
    ) {
        $this->weatherHistoryFactory = $weatherHistoryFactory;
        $this->weatherHistoryCollectionFactory = $weatherHistoryCollectionFactory;
        $this->searchResultFactory = $weatherHistorySearchResultInterfaceFactory;
    }

    /**
     * @inheritDoc
     */
    public function getById($id)
    {
        $weatherHistory = $this->weatherHistoryFactory->create();
        $weatherHistory->getResource()->load($weatherHistory, $id);
        if (!$weatherHistory->getId()) {
            throw new NoSuchEntityException(__('Unable to find WeatherHistory with ID "%1"', $id));
        }
        return $weatherHistory;
    }

    /**
     * @inheritDoc
     * @throws AlreadyExistsException
     */
    public function save(WeatherHistoryInterface $weatherHistory)
    {
        /** @var $weatherHistory WeatherHistory **/
        $weatherHistory->getResource()->save($weatherHistory);
    }

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function delete(WeatherHistoryInterface $weatherHistory)
    {
        /** @var $weatherHistory WeatherHistory **/
        $weatherHistory->getResource()->delete($weatherHistory);
    }

    /**
     * @inheritDoc
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->weatherHistoryCollectionFactory->create();
        $this->addFiltersToCollection($searchCriteria, $collection);
        $this->addSortOrdersToCollection($searchCriteria, $collection);
        $this->addPagingToCollection($searchCriteria, $collection);
        $collection->load();
        return $this->buildSearchResult($searchCriteria, $collection);
    }

    private function addFiltersToCollection(SearchCriteriaInterface $searchCriteria, Collection $collection)
    {
        foreach ($searchCriteria->getFilterGroups() as $filterGroup) {
            $fields = $conditions = [];
            foreach ($filterGroup->getFilters() as $filter) {
                $fields[] = $filter->getField();
                $conditions[] = [$filter->getConditionType() => $filter->getValue()];
            }
            $collection->addFieldToFilter($fields, $conditions);
        }
    }

    private function addSortOrdersToCollection(SearchCriteriaInterface $searchCriteria, Collection $collection)
    {
        foreach ((array) $searchCriteria->getSortOrders() as $sortOrder) {
            $direction = $sortOrder->getDirection() == SortOrder::SORT_ASC ? 'asc' : 'desc';
            $collection->addOrder($sortOrder->getField(), $direction);
        }
    }

    private function addPagingToCollection(SearchCriteriaInterface $searchCriteria, Collection $collection)
    {
        $collection->setPageSize($searchCriteria->getPageSize());
        $collection->setCurPage($searchCriteria->getCurrentPage());
    }

    private function buildSearchResult(SearchCriteriaInterface $searchCriteria, Collection $collection)
    {
        /** @var WeatherHistorySearchResultInterface $searchResults */
        $searchResults = $this->searchResultFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }
}
