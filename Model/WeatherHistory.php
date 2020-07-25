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
    protected function _construct(): void
    {
        $this->_init(WeatherHistoryResourceModel::class);
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->_getData('entity_id');
    }

    /**
     * @param int $value
     * @return WeatherHistory
     */
    public function setId($value): WeatherHistoryInterface
    {
        $this->setData('entity_id', $value);
        return $this;
    }

    /**
     * @return int|null
     */
    public function getTemperature(): ?int
    {
        return $this->getData('temperature');
    }

    /**
     * @param int $value
     * @return WeatherHistory
     */
    public function setTemperature(int $value): WeatherHistoryInterface
    {
        $this->setData('temperature', $value);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getWeatherConditions(): ?string
    {
        return $this->getData('weather_conditions');
    }

    /**
     * @param string $value
     * @return WeatherHistory
     */
    public function setWeatherConditions(string $value): WeatherHistoryInterface
    {
        $this->setData('weather_conditions', $value);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getWeatherIcon(): ?string
    {
        return $this->getData('weather_icon');
    }

    /**
     * @param string $value
     * @return WeatherHistory
     */
    public function setWeatherIcon(string $value): WeatherHistoryInterface
    {
        $this->setData('weather_icon', $value);
        return $this;
    }

    public function getCreated(): ?\DateTime
    {
        return $this->getData(self::FIELD_CREATED);
    }

    public function setCreated(\DateTime $created): WeatherHistoryInterface
    {
        $this->setData(self::FIELD_CREATED, $created);
        return $this;
    }
}
