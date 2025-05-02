<?php

namespace App\Listeners;

use App\Events\TestEvent;
use Illuminate\Events\Dispatcher;

class EventSubscriber
{
    public function __construct() {}

    public function subscribe(Dispatcher $events): void
    {
        $events->listen(
            TestEvent::class,
            [self::class, 'onTestEvent']
        );
    }

    public function onTestEvent(TestEvent $event): void
    {
        //
    }
}
