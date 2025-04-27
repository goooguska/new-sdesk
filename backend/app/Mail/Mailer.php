<?php

namespace App\Mail;

use App\Contracts\Mailer as MailerContract;
use App\Mail\Job\SendMessage;
use App\Mail\Messages\BaseMessage;
use Illuminate\Support\Facades\Mail;

class Mailer implements MailerContract
{
    public function send(string $toEmail, BaseMessage $message): void
    {
        Mail::to($toEmail)->send($message);
    }

    public function sendToQueue(string $toEmail, BaseMessage $message): void
    {
        dispatch(
            new SendMessage($toEmail, $message),
        );
    }
}
