<?php

namespace App\Contracts;

use App\Mail\Messages\BaseMessage;

interface Mailer
{
    public function send(string $toEmail, BaseMessage $message): void;

    public function sendToQueue(string $toEmail, BaseMessage $message): void;
}
