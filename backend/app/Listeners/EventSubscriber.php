<?php

namespace App\Listeners;

use App\Contracts\Mailer;
use App\Events\Ticket\CreatedEvent;
use App\Mail\Messages\CreateTicketMessage;
use Illuminate\Events\Dispatcher;

class EventSubscriber
{
    public function __construct(
        private readonly Mailer $mailer,
    ) {}

    public function subscribe(Dispatcher $events): void
    {
        $events->listen(
            CreatedEvent::class,
            [self::class, 'onCreatedEvent']
        );
    }

    public function onCreatedEvent(CreatedEvent $event): void
    {
        $this->mailer->sendToQueue(
            $event->getEmail(),
            new CreateTicketMessage(
                $event->getTitle(),
                $event->getDetailUrl($event->getTicketId())
            )
        );
    }
}
