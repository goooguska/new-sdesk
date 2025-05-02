<?php

namespace App\Mail\Messages;

class TwoFactorMessage extends BaseMessage
{
    public function __construct(private readonly string $code)
    {
        parent::__construct();

        $this->subject = 'Двухфакторная аутентификация';
    }

    public function build(): BaseMessage
    {
        return $this->markdown('mail.two-factor')->with($this->getWith());
    }

    protected function getWith(): array
    {
        $expireMinutes = config('auth.two_factor.expire', 300) / 60;

        return [
            'title' => $this->subject,
            'code' => $this->code,
            'expireMinutes' => $expireMinutes,
        ];
    }
}
