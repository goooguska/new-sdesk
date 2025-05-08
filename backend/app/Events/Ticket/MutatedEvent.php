<?php

namespace App\Events\Ticket;

use App\Events\Event;

class MutatedEvent extends Event
{
    public function getDetailUrl($ticketId): string
    {
        $frontendUrl = rtrim(config('app.frontend_url', 'http://localhost:5173'), '/');

        return url("$frontendUrl/tickets/$ticketId");
    }
}
