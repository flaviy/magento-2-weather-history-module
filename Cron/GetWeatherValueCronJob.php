<?php


namespace Ochebernin\Weather\Cron;

use Ochebernin\Weather\Api\WeatherHistoryManagementInterface;
use Psr\Log\LoggerInterface;
use Ochebernin\Weather\Model\Service\WeatherService;

/**
 * Class GetWeatherValueCronJob
 * @package Ochebernin\Weather\Cron
 */
class GetWeatherValueCronJob
{

    private const CRON_TASK_WEATHER_REFRESH_STARTED = 'CRON Task: Weather refresh started';
    private const CRON_TASK_WEATHER_REFRESH_COMPLETED = 'CRON Task: Weather refresh completed';
    private const NEW_WEATHER_RECORD_ADDED = 'New weather record has been added';
    private const FAILED_TO_SAVE_NEW_WEATHER_RECORD = 'Failed to save new weather record';

    /**
     * @var LoggerInterface
     */
    private $logger;
    /**
     * @var WeatherService
     */
    private $weatherService;
    /**
     * @var WeatherHistoryManagementInterface
     */
    private $weatherHistoryManagement;

    public function __construct(
        LoggerInterface $logger,
        WeatherService $weatherService,
        WeatherHistoryManagementInterface $weatherHistoryManagement
    )
    {
        $this->logger = $logger;
        $this->weatherService = $weatherService;
        $this->weatherHistoryManagement = $weatherHistoryManagement;
    }

    /**
     * Cronjob Description
     *
     * @return void
     */
    public function execute(): void
    {
        $this->logger->debug(self::CRON_TASK_WEATHER_REFRESH_STARTED);
        $weather = $this->weatherService->getCurrentWeather();
        if(!empty($weather)) {
            if($this->weatherHistoryManagement->createWeatherEntityRecord($weather)) {
                $this->logger->debug(self::NEW_WEATHER_RECORD_ADDED);
            } else {
                $this->logger->debug(self::FAILED_TO_SAVE_NEW_WEATHER_RECORD);
            }
        }
        $this->logger->debug(self::CRON_TASK_WEATHER_REFRESH_COMPLETED);
    }
}
