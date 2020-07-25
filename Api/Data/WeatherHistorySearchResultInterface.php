<?php

/**
 * @copyright Copyright © 2020 Ochebernin. All rights reserved.
 * @author    chebernin@gmail.com
 */

namespace Ochebernin\Weather\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface WeatherHistorySearchResultInterface extends SearchResultsInterface
{
    /**
     * @return WeatherHistoryInterface[]
     */
    public function getItems();

    /**
     * @param WeatherHistoryInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
