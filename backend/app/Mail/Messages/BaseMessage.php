<?php

namespace App\Mail\Messages;

use Illuminate\Mail\Mailable;

abstract class BaseMessage extends Mailable
{
    public function __construct()
    {
        $this->subject('Новое сообщение');
    }

    public function build(): self
    {
        return $this->markdown('mail.message')->with($this->getWith());
    }

    protected function getWith(): array
    {
        return [];
    }
}
