<?php

namespace App\Mail\Messages;

class CreateTicketMessage extends BaseMessage
{
    public function __construct(
        private readonly string $title,
        private readonly string $url
    )
    {
        parent::__construct();

        $this->subject = 'Новая заявка';
    }

    public function build(): BaseMessage
    {
        return $this->markdown('mail.ticket-created')->with($this->getWith());
    }

    protected function getWith(): array
    {
        return [
            'title' => $this->title,
            'link' => $this->url
        ];
    }
}
