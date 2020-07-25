<?php

namespace Ochebernin\Weather\Model\Service;

use Ochebernin\Weather\Model\Config;
use Psr\Log\LoggerInterface;
use GuzzleHttp\Client as HttpClient;

/**
 * Class WeatherService
 * @package Ochebernin\Weather\Model\Service
 */
class WeatherService
{
    public const API_REQUEST_FAILED = 'API request failed';
    public const API_REQUEST_SENT = 'API request sent';
    public const API_REQUEST_SUCCEED = 'API request successfully completed';
    /**
     * @var Config
     */
    private $config;
    /**
     * @var LoggerInterface
     */
    private $logger;
    /**
     * @var HttpClient
     */
    private $httpClient;


    /**
     * WeatherService constructor.
     * @param Config $config
     * @param LoggerInterface $logger
     * @param HttpClient $httpClient
     */
    public function __construct(
        Config $config,
        LoggerInterface $logger,
        HttpClient $httpClient

    ) {
        $this->config = $config;
        $this->logger = $logger;
        $this->httpClient = $httpClient;
    }

    /**
     * @return array
     */
    public function getCurrentWeather(): array
    {
        $weather = [];
        try {
            $requestUrl = $this->config->getApiURL();
            $this->logger->info(self::API_REQUEST_SENT, ['url' => $requestUrl]);
            $response = $this->httpClient->get($requestUrl);
            if($response->getStatusCode() !== 200) {
                $this->logger->error(self::API_REQUEST_FAILED, ['headers' => $response->getHeaders(), 'body' => $response->getBody()]);
                throw new \RuntimeException($response->getReasonPhrase() ?? self::API_REQUEST_FAILED);
            }
            $weather = json_decode($response->getBody(), true);
            $this->logger->debug(self::API_REQUEST_SUCCEED, ['body' => $weather]);

        } catch (\Exception $exception) {
            $this->logger->error(self::API_REQUEST_FAILED, ['message' => $exception->getMessage()]);
        }

        return $weather;

    }
}
