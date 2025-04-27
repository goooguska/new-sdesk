<?php

namespace App\Mail\Job;

use App\Contracts\Mailer;
use App\Mail\Messages\BaseMessage;
use App\Queue\BaseJob;

final class SendMessage extends BaseJob
{
    public int $tries = 5;

    public $queue = 'mail';

    public function __construct(
        public readonly string $toEmail,
        public readonly BaseMessage $message,
    ) {
        parent::__construct();
    }

    public function handle(Mailer $mailer): void
    {
        $mailer->send($this->toEmail, $this->message);
    }
}
