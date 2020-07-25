<?php


namespace Ochebernin\Weather\Model;

use Magento\Framework\Api\SortOrder;
use Ochebernin\Weather\Api\Data\WeatherHistoryInterface;
use Ochebernin\Weather\Api\Data\WeatherHistoryInterfaceFactory;
use Ochebernin\Weather\Api\WeatherHistoryManagementInterface;
use Ochebernin\Weather\Api\WeatherHistoryRepositoryInterface;
use Magento\Framework\Api\SortOrderBuilder;
use Magento\Framework\Api\SearchCriteriaBuilder;

/**
 * Class WeatherHistoryManagement
 * @package Ochebernin\Weather\Model
 */
class WeatherHistoryManagement implements WeatherHistoryManagementInterface
{

    /**
     * @var WeatherHistoryInterfaceFactory
     */
    private $weatherHistoryFactory;
    /**
     * @var WeatherHistoryRepositoryInterface
     */
    private $weatherHistoryRepository;
    /**
     * @var SortOrderBuilder
     */
    private $sortOrderBuilder;
    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * WeatherHistoryManagement constructor.
     * @param WeatherHistoryInterfaceFactory $weatherHistoryFactory
     * @param WeatherHistoryRepositoryInterface $weatherHistoryRepository
     * @param SortOrderBuilder $sortOrderBuilder
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     */
    public function __construct(
        WeatherHistoryInterfaceFactory $weatherHistoryFactory,
        WeatherHistoryRepositoryInterface $weatherHistoryRepository,
        SortOrderBuilder $sortOrderBuilder,
        SearchCriteriaBuilder $searchCriteriaBuilder
    )
    {
        $this->weatherHistoryFactory = $weatherHistoryFactory;
        $this->weatherHistoryRepository = $weatherHistoryRepository;
        $this->sortOrderBuilder = $sortOrderBuilder;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    /**
     * @param array $weather
     * @return WeatherHistoryInterface|null
     */
    public function createWeatherEntityRecord(array $weather): ?WeatherHistoryInterface
    {
        if(empty($weather['main']['temp']) || empty($weather['weather'])) {
            return null;
        }
        $weatherConditions = '';
        foreach ($weather['weather'] as $weatherCondition) {
            if(!empty($weatherCondition['description'])) {
                $weatherConditions.= ($weatherCondition['description'].', ');
            }
        }
        $weatherHistoryRecord = $this->weatherHistoryFactory->create();
        $weatherHistoryRecord->setTemperature($weather['main']['temp'])
            ->setWeatherConditions(rtrim($weatherConditions, ', '))
            ->setCreated(new \DateTime());
        if(!empty($weather['weather'][0]['icon'])) {
            $weatherHistoryRecord->setWeatherIcon($weather['weather'][0]['icon']);
        }
        try {
            $this->weatherHistoryRepository->save($weatherHistoryRecord);
        } catch (\Exception $exception) {
            return null;
        }
        return $weatherHistoryRecord;
    }

    /**
     * @return WeatherHistoryInterface|null
     */
    public function getLatestWeatherRecord(): ?WeatherHistoryInterface
    {
        $sortOrder = $this->sortOrderBuilder->setField(WeatherHistoryInterface::FIELD_CREATED)->setDirection(
            SortOrder::SORT_DESC
        )->create();

        /** @var WeatherHistoryInterface[] $weatherItems */
        $weatherItems =  $this->weatherHistoryRepository->getList(
            $this->searchCriteriaBuilder
                ->setPageSize(1)
                ->addSortOrder($sortOrder)
                ->create()
        );
        if(!empty($items = $weatherItems->getItems())) {
            return array_pop($items);
        }
        return null;
    }

}
