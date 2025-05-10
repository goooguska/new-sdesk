<?php

namespace App\Listeners;

use App\Contracts\Mailer;
use App\Events\Ticket\CreatedEvent;
use App\Events\Ticket\UpdatedEvent;
use App\Mail\Messages\CreateTicketMessage;
use App\Mail\Messages\UpdateTicketMessage;
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

        $events->listen(
            UpdatedEvent::class,
            [self::class, 'onUpdatedEvent']
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

    public function onUpdatedEvent(UpdatedEvent $event): void
    {
        $this->mailer->sendToQueue(
            $event->getEmail(),
            new UpdateTicketMessage(
                $event->getTitle(),
                $event->getDetailUrl($event->getTicketId()),
                $event->getStatus()
            )
        );
    }
}
