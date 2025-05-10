<?php

namespace App\Mail\Messages;

class UpdateTicketMessage extends BaseMessage
{
    public function __construct(
        private readonly string $title,
        private readonly string $url,
        private readonly string $status,
    )
    {
        parent::__construct();

        $this->subject = 'Обновление заявки';
    }

    public function build(): BaseMessage
    {
        return $this->markdown('mail.ticket-updated')->with($this->getWith());
    }

    protected function getWith(): array
    {
        return [
            'title' => 'Статус вашей заявки был обновлён',
            'ticket' => $this->title,
            'status' => $this->status,
            'link' => $this->url
        ];
    }
}
