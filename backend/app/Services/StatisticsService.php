<?php

namespace App\Services;

use App\Contracts\Services\StatisticsService as StatisticsServiceContract;
use App\Contracts\Services\StatusService;
use App\Contracts\Services\TicketService;

class StatisticsService implements StatisticsServiceContract
{
    public function __construct(
        private readonly TicketService $ticketService,
    ) {}

    public function getStatistics(): array
    {
        $statusRatioTickets = $this->ticketService->getRatioDoneAndRejectedTicketsPerWeek();
        $weeklyCountDoneTickets = $this->ticketService->getDoneCountTicketsPerWeek();
        $doneTicketsByCategory = $this->ticketService->getCountTicketsPerWeekByCategory();

        return [
            'categories' => $doneTicketsByCategory,
            'weekly' => $weeklyCountDoneTickets,
            'status' => [
                'done' => [
                    'percent' => $statusRatioTickets['done_percent'],
                    'count' => $statusRatioTickets['done'],
                ],
                'rejected' => [
                    'percent' => $statusRatioTickets['rejected_percent'],
                    'count' => $statusRatioTickets['rejected'],
                ],
                'total' => $statusRatioTickets['total'],
            ],
        ];
    }
}
