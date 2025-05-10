<?php

namespace App\Services;

use App\Contracts\Repositories\TicketRepository;
use App\Contracts\Services\AuthService;
use App\Contracts\Services\StatusService;
use App\Contracts\Services\TicketService as TicketServiceContract;
use App\Contracts\Services\UserService;
use App\Enums\StatusEnum;
use App\Events\Ticket\CreatedEvent;
use App\Exceptions\StatusException;
use App\Exceptions\TicketException;
use App\Exceptions\UserException;
use App\Models\Status;

class TicketService extends BaseService implements TicketServiceContract
{
    public function __construct(
        private readonly TicketRepository $repository,
        private readonly StatusService $statusService,
        private readonly AuthService $authService,
        private readonly UserService $userService
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

        $assigner = $this->userService->getById($fields['assigned_id']);

        $createdTicket = $this->create($fields);

        event(new CreatedEvent($assigner['email'], $createdTicket));

        return $createdTicket;
    }

    /**
     * @throws UserException
     */
    public function getAllForCurrentUser(): array
    {
        $user = $this->authService->me();
        $userRole = $user->role->code;

        $userRole = match ($userRole) {
            'user' => 'creator_id',
            'manager' => 'assigned_id',
            default => false
        };

        if (! $userRole) {
            throw UserException::notSupportRole();
        }

        return $this->repository->getAllByUserIdAndRole($user->id, $userRole)->toArray();
    }

    /**
     * @throws TicketException
     */
    public function getTicketById(string $id): array
    {
        $ticket = $this->repository->getTicketById($id);
        if (! $ticket) {
            throw TicketException::notFound();
        }

        return $ticket->toArray();
    }

    public function getRatioDoneAndRejectedTicketsPerWeek(): array
    {
        return $this->repository->getRatioDoneAndRejectedTicketsPerWeek();
    }

    public function getDoneCountTicketsPerWeek(): array
    {
        return $this->repository->getDoneCountTicketsPerWeek();
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

    public function getCountTicketsPerWeekByCategory(): array
    {
        return $this->repository->getCountTicketsPerWeekByCategory();
    }
}
