@component('mail::layout')
    @slot('header')
        @component('mail::header', ['url' => config('app.frontend_url')])
            {{ config('app.name') }}
        @endcomponent
    @endslot

    # Код подтверждения: {{ $code }}

    Используйте этот код для завершения входа в систему.

    **Срок действия:** {{ $expireMinutes }} минут

    @component('mail::button', [
        'url' => config('app.frontend_url') . '/auth/2fa?email=' . urlencode($email),
        'color' => 'primary'
    ])
        Перейти к подтверждению
    @endcomponent

    @component('mail::panel')
        Если вы не запрашивали этот код, проигнорируйте это письмо.<br>
        IP адрес входа: {{ $ipAddress ?? request()->ip() }}
    @endcomponent

    @slot('footer')
        @component('mail::footer')
            © {{ date('Y') }} {{ config('app.name') }}. Все права защищены.
        @endcomponent
    @endslot
@endcomponent
