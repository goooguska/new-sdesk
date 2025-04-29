@component('elements.header')
    @slot('title')
        {{ $title }}
    @endslot
@endcomponent

@yield('body')

@component('elements.footer')
@endcomponent
