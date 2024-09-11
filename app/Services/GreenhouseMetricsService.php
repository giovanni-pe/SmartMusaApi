<?php
namespace App\Services;

use App\Repositories\GreenhouseRepository;

class GreenhouseMetricsService
{
    protected $repository;

    public function __construct(GreenhouseRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAvgHumidity($userId)
    {
        return $this->repository->getAvgHumidity($userId);
    }

    public function getAvgSoilHumidity($userId)
    {
        return $this->repository->getAvgSoilHumidity($userId);
    }

    public function getAvgAmbientTemperature($userId)
    {
        return $this->repository->getAvgAmbientTemperature($userId);
    }
}
