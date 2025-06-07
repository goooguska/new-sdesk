<?php

namespace App\Repositories;

use App\Contracts\Repositories\TicketRepository as TicketRepositoryContract;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TicketRepository extends BaseRepository implements TicketRepositoryContract
{
    public function __construct(Ticket $model)
    {
        parent::__construct($model);

        $this->defaultRelations = ['assigned', 'creator', 'category', 'status'];
    }

    public function getAllByUserIdAndRole(int $userId, string $userRole): Collection
    {
        return $this->model
            ->with($this->defaultRelations)
            ->where($userRole, $userId)
            ->get();
    }

    public function getTicketById(string $id): ?Ticket
    {
        /** @var Ticket|null */
        return $this->model
            ->with($this->defaultRelations)
            ->where('id', $id)
            ->first();
    }

    /**
     * @param string $id
     * @param array  $fields
     *
     * @return Ticket|null
     */
    public function updateTicket(string $id, array $fields): ?Ticket
    {
        $model = $this->model->findOrFail($id);

        $model->fill($fields);

        if (! $model->isDirty() || $model->save()) {
            /** @var Ticket|null $updated */
            $updated = $this->model->with($this->defaultRelations)->find($id);

            return $updated;
        }

        throw new \RuntimeException("Ошибка при обновлении записи.");
    }

    public function getRatioDoneAndRejectedTicketsPerWeek(): array
    {
        $startOfWeek = Carbon::now()->startOfWeek(Carbon::MONDAY);
        $endOfWeek = Carbon::now()->endOfWeek(Carbon::SUNDAY);

        $data = $this->model
            ->newQuery()
            ->selectRaw('
                SUM(CASE WHEN statuses.code = \'done\' THEN 1 ELSE 0 END) as done,
                SUM(CASE WHEN statuses.code = \'rejected\' THEN 1 ELSE 0 END) as rejected
            ')
            ->join('statuses', 'tickets.status_id', '=', 'statuses.id')
            ->whereBetween('tickets.updated_at', [$startOfWeek, $endOfWeek])
            ->whereIn('statuses.code', ['done', 'rejected'])
            ->first();

        $done = (int) ($data->done ?? 0);
        $rejected = (int) ($data->rejected ?? 0);
        $total = $done + $rejected;

        return [
            'done' => $done,
            'rejected' => $rejected,
            'done_percent' => $total > 0 ? round(($done / $total) * 100) : 0,
            'rejected_percent' => $total > 0 ? round(($rejected / $total) * 100) : 0,
            'total' => $total,
        ];
    }

    public function getDoneCountTicketsPerWeek(): array
    {
        $startOfWeek = Carbon::now()->startOfWeek(Carbon::MONDAY);
        $endOfWeek = Carbon::now()->endOfWeek(Carbon::SUNDAY);

        $data = $this->model
            ->newQuery()
            ->selectRaw('TRIM(TO_CHAR(tickets.updated_at, \'Day\')) as day_name, COUNT(*) as count')
            ->join('statuses', 'tickets.status_id', '=', 'statuses.id')
            ->where("statuses.code", 'done')
            ->whereBetween('tickets.updated_at', [$startOfWeek, $endOfWeek])
            ->groupBy(DB::raw('TRIM(TO_CHAR(tickets.updated_at, \'Day\')), EXTRACT(DOW FROM tickets.updated_at)'))
            ->orderBy(DB::raw('EXTRACT(DOW FROM tickets.updated_at)'))
            ->pluck('count', 'day_name')
            ->toArray();

        $total = array_reduce($data, static function ($carry, $item) {
            return $carry + $item;
        });

        return [
            ...$data,
            'total' => $total,
        ];
    }

    public function getCountTicketsPerWeekByCategory(): array
    {
        $startOfWeek = Carbon::now()->startOfWeek(Carbon::MONDAY);
        $endOfWeek = Carbon::now()->endOfWeek(Carbon::SUNDAY);

        $data = $this->model
            ->newQuery()
            ->join('categories', 'tickets.category_id', '=', 'categories.id')
            ->whereBetween('tickets.created_at', [$startOfWeek, $endOfWeek])
            ->select('categories.name as name', DB::raw('count(tickets.id) as ticket_count'))
            ->groupBy('categories.name')
            ->pluck('ticket_count', 'name')
            ->toArray();

        return [
            ...$data,
            'total' => count($data),
        ];
    }
}
