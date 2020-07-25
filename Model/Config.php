<?php

namespace Ochebernin\Weather\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;

/**
 * Class Config
 * @package PGC\TruckType\Model
 * @codeCoverageIgnore
 */
class Config
{
    public const XML_PATH_API_URL = 'ochebernin_weather_history/api_settings/api_url';
    public const XML_PATH_IMG_URL = 'ochebernin_weather_history/api_settings/img_url';

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @return string
     */
    public function getApiURL(): ?string
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_API_URL,
            ScopeConfigInterface::SCOPE_TYPE_DEFAULT
        );
    }

    /**
     * @return string
     */
    public function getImgURL(): ?string
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_IMG_URL,
            ScopeConfigInterface::SCOPE_TYPE_DEFAULT
        );
    }
}
