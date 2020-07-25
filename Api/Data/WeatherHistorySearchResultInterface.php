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
     * @return \Ochebernin\Weather\Api\Data\WeatherHistoryInterface[]
     */
    public function getItems();

    /**
     * @param \Ochebernin\Weather\Api\Data\WeatherHistoryInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
