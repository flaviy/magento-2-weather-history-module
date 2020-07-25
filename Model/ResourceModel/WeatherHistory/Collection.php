<?php

/**
 * @copyright Copyright © 2020 Ochebernin. All rights reserved.
 * @author    chebernin@gmail.com
 */

namespace Ochebernin\Weather\Model\ResourceModel\WeatherHistory;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Ochebernin\Weather\Model\WeatherHistory;
use Ochebernin\Weather\Model\ResourceModel\WeatherHistory as WeatherHistoryResourceModel;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'entity_id';

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(WeatherHistory::class, WeatherHistoryResourceModel::class);
    }
}
