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
     * @return \Ochebernin\Weather\Api\Data\WeatherHistoryInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($id);

    /**
     * @param \Ochebernin\Weather\Api\Data\WeatherHistoryInterface
     * @return void
     */
    public function save(WeatherHistoryInterface $WeatherHistory);

    /**
     * @param \Ochebernin\Weather\Api\Data\WeatherHistoryInterface
     * @return void
     */
    public function delete(WeatherHistoryInterface $WeatherHistory);

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Ochebernin\Weather\Api\Data\WeatherHistorySearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria);
}
