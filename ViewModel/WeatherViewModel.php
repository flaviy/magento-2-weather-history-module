<?php

namespace Ochebernin\Weather\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Ochebernin\Weather\Api\Data\WeatherHistoryInterface;
use Ochebernin\Weather\Api\WeatherHistoryManagementInterface;

class WeatherViewModel implements ArgumentInterface
{
    private $lastRecord;

    /**
     * @var WeatherHistoryManagementInterface
     */
    private $weatherHistoryManagement;

    public function __construct(
        WeatherHistoryManagementInterface  $weatherHistoryManagement
    )
    {
        $this->weatherHistoryManagement = $weatherHistoryManagement;
    }

    /**
     * @return WeatherHistoryInterface | null
     */
    private function getLatestWeatherRecord() : ?WeatherHistoryInterface
    {
        if(!$this->lastRecord) {
            $this->lastRecord = $this->weatherHistoryManagement->getLatestWeatherRecord();
        }
        return $this->lastRecord;
    }

    /**
     * @return string
     */
    public function getTemperature(): string
    {
        /** @var WeatherHistoryInterface | null $weatherRecord */
        $weatherRecord = $this->getLatestWeatherRecord();
        return $weatherRecord && $weatherRecord->getTemperature() ? (string) $weatherRecord->getTemperature() : '';
    }

    /**
     * @return string
     */
    public function getWeatherConditions(): string
    {
        /** @var WeatherHistoryInterface | null $weatherRecord */
        $weatherRecord = $this->getLatestWeatherRecord();
        return $weatherRecord && $weatherRecord->getWeatherConditions() ? $weatherRecord->getWeatherConditions()  : '';
    }

}
