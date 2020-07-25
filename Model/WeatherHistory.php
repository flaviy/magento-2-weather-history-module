<?php

/**
 * @copyright Copyright © 2020 Ochebernin. All rights reserved.
 * @author    chebernin@gmail.com
 */

namespace Ochebernin\Weather\Model;

use Magento\Framework\Model\AbstractModel;
use Ochebernin\Weather\Api\Data\WeatherHistoryInterface;
use Ochebernin\Weather\Model\ResourceModel\WeatherHistory as WeatherHistoryResourceModel;

class WeatherHistory extends AbstractModel implements WeatherHistoryInterface
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(WeatherHistoryResourceModel::class);
    }

    /**
     * @return int|null
     */
    public function getId()
    {
        return $this->_getData('entity_id');
    }

    /**
     * @param int $value
     * @return void
     */
    public function setId($value)
    {
        $this->setData('entity_id', $value);
    }

    /**
     * @return int|null
     */
    public function getTemperature()
    {
        return $this->getData('temperature');
    }

    /**
     * @param int $value
     * @return void
     */
    public function setTemperature(int $value)
    {
        $this->setData('temperature', $value);
    }

    /**
     * @return string|null
     */
    public function getWeatherConditions()
    {
        return $this->getData('weather_conditions');
    }

    /**
     * @param string $value
     * @return void
     */
    public function setWeatherConditions(string $value)
    {
        $this->setData('weather_conditions', $value);
    }

    /**
     * @return string|null
     */
    public function getWeatherIcon()
    {
        return $this->getData('weather_icon');
    }

    /**
     * @param string $value
     * @return void
     */
    public function setWeatherIcon(string $value)
    {
        $this->setData('weather_icon', $value);
    }
}
