<?php

/**
 * @copyright Copyright © 2020 Ochebernin. All rights reserved.
 * @author    chebernin@gmail.com
 */

namespace Ochebernin\Weather\Api\Data;

interface WeatherHistoryInterface
{
    /**
     * @return int|null
     */
    public function getId();

    /**
     * @param int $value
     * @return void
     */
    public function setId($value);

    /**
     * @return int|null
     */
    public function getTemperature();

    /**
     * @param int $value
     * @return void
     */
    public function setTemperature(int $value);

    /**
     * @return string|null
     */
    public function getWeatherConditions();

    /**
     * @param string $value
     * @return void
     */
    public function setWeatherConditions(string $value);

    /**
     * @return string|null
     */
    public function getWeatherIcon();

    /**
     * @param string $value
     * @return void
     */
    public function setWeatherIcon(string $value);
}
