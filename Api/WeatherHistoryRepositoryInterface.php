<?php

/**
 * @copyright Copyright © 2020 Ochebernin. All rights reserved.
 * @author    chebernin@gmail.com
 */

namespace Ochebernin\Weather\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Ochebernin\Weather\Api\Data\WeatherHistoryInterface;
use Ochebernin\Weather\Api\Data\WeatherHistorySearchResultInterface;

interface WeatherHistoryRepositoryInterface
{
    /**
     * @param int $id
     * @return WeatherHistoryInterface
     * @throws NoSuchEntityException
     */
    public function getById($id);

    /**
     * @param WeatherHistoryInterface $WeatherHistory
     * @return void
     */
    public function save(WeatherHistoryInterface $WeatherHistory);

    /**
     * @param WeatherHistoryInterface $WeatherHistory
     * @return void
     */
    public function delete(WeatherHistoryInterface $WeatherHistory);

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return WeatherHistorySearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria);
}
