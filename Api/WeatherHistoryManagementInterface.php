<?php


namespace Ochebernin\Weather\Api;

use Ochebernin\Weather\Api\Data\WeatherHistoryInterface;

interface WeatherHistoryManagementInterface
{
    public function createWeatherEntityRecord(array $weather): ?WeatherHistoryInterface;

    public function getLatestWeatherRecord();
}
