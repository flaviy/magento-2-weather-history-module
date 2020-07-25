<?php

/**
 * @copyright Copyright © 2020 Ochebernin. All rights reserved.
 * @author    chebernin@gmail.com
 */

namespace Ochebernin\Weather\Api\Data;

/**
 * Interface WeatherHistoryInterface
 * @package Ochebernin\Weather\Api\Data
 */
interface WeatherHistoryInterface
{
    public const FIELD_CREATED = 'created';

    /**
     * @return int|null
     */
    public function getId(): ?int;

    /**
     * @param int $value
     * @return WeatherHistoryInterface
     */
    public function setId($value): WeatherHistoryInterface;

    /**
     * @return int|null
     */
    public function getTemperature(): ?int;

    /**
     * @param int $value
     * @return WeatherHistoryInterface
     */
    public function setTemperature(int $value): WeatherHistoryInterface;

    /**
     * @return string|null
     */
    public function getWeatherConditions(): ?string;

    /**
     * @param string $value
     * @return WeatherHistoryInterface
     */
    public function setWeatherConditions(string $value): WeatherHistoryInterface;

    /**
     * @return string|null
     */
    public function getWeatherIcon(): ?string;

    /**
     * @param string $value
     * @return WeatherHistoryInterface
     */
    public function setWeatherIcon(string $value): WeatherHistoryInterface;

    /**
     * @return \DateTime|null
     */
    public function getCreated(): ?\DateTime;

    /**
     * @param \DateTime $created
     * @return WeatherHistoryInterface
     */
    public function setCreated(\DateTime $created): WeatherHistoryInterface;
}
