<?php

namespace App\Services;

use App\Contracts\Repositories\TicketRepository;
use App\Contracts\Services\StatusService;
use App\Contracts\Services\TicketService as TicketServiceContract;
use App\Enums\StatusEnum;
use App\Exceptions\StatusException;
use App\Models\Status;

class TicketService extends BaseService implements TicketServiceContract
{
    public function __construct(
        private readonly TicketRepository $repository,
        private readonly StatusService $statusService
    )
    {
        parent::__construct($repository);
    }

    /**
     * @throws StatusException
     */
    public function createTicket(array $fields): array
    {
        if (! isset($fields['status_id'])) {
            $fields['status_id'] = $this->getWorkStatus()->id;
        }

        return $this->create($fields);
    }

    /**
     * @throws StatusException
     */
    private function getWorkStatus(): Status
    {
        $workStatus = StatusEnum::WORK->value;
        $status = $this->statusService->getByCode($workStatus);

        if ($status === null) {
            throw StatusException::notFound();
        }

        return $status;
    }


}
