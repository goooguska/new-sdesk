@component('mail::layout')
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            {{ config('app.name') }}
        @endcomponent
    @endslot

    # Код подтверждения: {{ $code }}

    Используйте этот код для завершения входа в систему.

    **Срок действия:** {{ $expireMinutes }} минут

    @component('mail::button', ['url' => '#', 'color' => 'primary'])
        Войти в систему
    @endcomponent

    @component('mail::panel')
        Если вы не запрашивали этот код, проигнорируйте это письмо.
    @endcomponent

    @slot('footer')
        @component('mail::footer')
            © {{ date('Y') }} {{ config('app.name') }}. Все права защищены.
        @endcomponent
    @endslot
@endcomponent
