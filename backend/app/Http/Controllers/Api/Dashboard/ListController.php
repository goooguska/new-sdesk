<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Contracts\Services\StatisticsService;

class ListController
{
    public function __construct(private readonly StatisticsService $dashboardService) {}

    public function statistics()
    {
        return $this->dashboardService->getStatistics();
    }
}
